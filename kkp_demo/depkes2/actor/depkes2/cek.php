<?php



	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('cek_controller')) {
	// do nothing
} else if (defined('CLASS_cek_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_cek_CONTROLLER', TRUE);

#include_once 'class.cek.inc.php';
class cek_controller extends depkes2_manager {
	var $cek_label;
	var $optional_arr;
	function cek_controller() {
		$this->cek_label = array (
			'id_cek_1' => 'Id Check Alkes',
			'id_golongan' => 'Kelas',
			'no_daftar' => 'No Daftar',
			'no_tt' => 'Nama Pemohon',
			'read_kaseksi' => 'Read Kaseksi',
			'read_kasubdit' => 'Read Kasubdit',
			'read_direktur' => 'Read Direktur',
			'indi_kasubdit' => 'Indikator Kasubdit',
			'indi_kaseksi' => 'Indikator Kaseksi',
			'jenis_izin_produksi' => 'Jenis Izin Produksi',
			'indi_direktur' => 'Indikator Direktur',
			'no_rekomendasi' => 'No Rekomendasi',
			'date_rekomendasi' => 'Tgl Rekomendasi',
			'nama_produk' => 'Jenis Alkes Yang Diproduksi',
			'nama_pabrik' => 'Nama Pabrik',
			'no_bap' => 'NO BAP',
			'date_bap' => 'Tgl BAP',
			'alamat' => 'Alamat Pabrik',
			'lisensi' => 'Licensi',
			'status_penilai' => 'Status Penilaian',
			'nama_penilai' => 'Nama Penilai',
			'urut_no_tt' => 'Nomor Tanda Terima',
			'subdit' => 'Subdit',
			'golongan' => 'Kelas',
			'date_1' => 'Tanggal Penilai',
			'date_rekomendasi' => 'Tanggal Rekomendasi',
			'date_bap' => 'Tanggal BAP',
			'status_kaseksi' => 'Status Kaseksi',
			'nama_kaseksi' => 'Nama Kaseksi',
			'date_2' => 'Tanggal Kaseksi',
			'status_kasubdit' => 'Status Kasubdit',
			'nama_kasubdit' => 'Nama Kasubdit',
			'date_3' => 'Tanggal Kasubdit',
			'no_pemohon' => 'Nomor Pemohon',
			'date_pemohon' => 'Tanggal Pemohon',
			'status_direktur' =>'Status Direktur',
			'nama_direktur' => 'Nama Direktur',
			'date_4' => 'Tanggal Direktur',
			'keterangan' => 'Keterangan',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert',
			'lisensi' => 'Licensi',
			'nama_produk' => 'Nama Produk',
			'lisensi2' => 'Licensi (2)',
			'nama_produk2' => 'Nama Produk (2)',
			'lisensi3' => 'Licensi (3)',
			'nama_produk3' => 'Nama Produk (3)',
			'lisensi4' => 'Licensi (4)',
			'nama_produk4' => 'Nama Produk (4)',
			'lisensi5' => 'Licensi (5)',
			'nama_produk5' => 'Nama Produk (5)',
			'id_kategori' => 'Kategori',
			'id_sub_kategori' => 'Sub Kategori'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_cek_1' => TRUE,
			'id_golongan' => FALSE,
			'no_daftar' => FALSE,
			'no_rekomendasi' => FALSE,
			'nama_produk' => FALSE,
			'nama_pabrik' => FALSE,
			'alamat' => FALSE,
			'lisensi' => FALSE,
			'status_penilai' => FALSE,
			'nama_penilai' => FALSE,
			'date_1' => FALSE,
			'status_kaseksi' => FALSE,
			'nama_kaseksi' => FALSE,
			'date_2' => FALSE,
			'status_kasubdit' => FALSE,
			'nama_kasubdit' => FALSE,
			'date_3' => FALSE,
			'status_direktur' => FALSE,
			'nama_direktur' => FALSE,
			'date_4' => FALSE,
			'keterangan' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE
		);
	}

	function no_tt_form(&$config) {
		global $ses;
		$userlog = $ses->loginid;
                eval($this->load_config);
                $selected = $value_arr['no_tt'];
    
		$bag = $ses->action;

		#include_once 'class.pendaftar.inc.php';
		$fk_sql = "
SELECT
	tt.no_tt as skey,
	tt.urut_no_tt as svalue,
	pendaftar.nama_pendaftar as svalue2
FROM
	".$GLOBALS[my_tt]."                  tt
	LEFT JOIN                            subdit       ON (subdit.id_subdit = tt.kode_subdit)
	LEFT JOIN ".$GLOBALS[my_table]."     cek          ON (cek.no_tt = tt.no_tt)
	LEFT JOIN ".$GLOBALS[my_pendaftar]." pendaftar    ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
	LEFT JOIN ".$GLOBALS[my_insubdit]."  inbox_subdit ON (inbox_subdit.no_tt = tt.no_tt )
	[lr] JOIN ".$GLOBALS[my_inseksi]."   inbox_seksi  ON (inbox_seksi.id_inbox_subdit = inbox_subdit.id_inbox)
[where]
ORDER BY
	tt.date_insert
		";
		
		if ($_GET['id_cek_1']){
		  /*
		   * EDIT
		   */
			if($bag=='kaseksi'){
				$fk_sql = str_replace('[where]', "WHERE inbox_seksi.insert_by='$userlog'", $fk_sql);
				$fk_sql = str_replace('[lr]', "LEFT", $fk_sql);
			} else {
				$fk_sql = str_replace('[where]', "", $fk_sql);
				$fk_sql = str_replace('[lr]', "RIGHT", $fk_sql);
			}
		} else{
		  /*
		   * ADD
		   */
			if ($bag=='kaseksi') {
				$fk_sql = str_replace('[where]', "WHERE (inbox_seksi.insert_by='$userlog') ".
				" AND cek.no_tt IS NULL", $fk_sql);
				$fk_sql = str_replace('[lr]', "RIGHT", $fk_sql);
			/*
			 * ADDED BY : 566
			 */
			} else if ($bag=='penilai') {
				$fk_sql = str_replace('[where]', "WHERE inbox_seksi.koordinator='$userlog'  AND cek.no_tt IS NULL", $fk_sql);
				$fk_sql = str_replace('[lr]', "RIGHT", $fk_sql);
			} else {
				$fk_sql = str_replace('[where]', "WHERE cek.no_tt IS NULL", $fk_sql);
				$fk_sql = str_replace('[lr]', "LEFT", $fk_sql);
			}
		}
		
		#global $adodb; $adodb->debug = 1;
		#$result = pendaftar::select($fk_sql);
		
		//echo ($fk_sql);

		global $adodb; $adodb->debug = 0;$rs = $adodb->Execute($fk_sql);
		$result = $rs->GetRows();
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('no_tt');
		$default_value = array(
			array (
			'lisensi' => 'Licensi',
				'skey' => '',
				'svalue' => __('No Tanda terima - ').' Nama Pemohon'
			)
		);


		$jas ="
		b = document.theform.no_tt.value;
		sql = 'SELECT pendaftar.alamat_pendaftar as alamat, subdit.subdit as propinsi".
		" FROM ".$GLOBALS[my_pendaftar]." pendaftar ".
		" LEFT JOIN ".$GLOBALS[my_tt]." tt ON (tt.kode_pendaftar = pendaftar.kode_pendaftar) ".
		" LEFT JOIN subdit ON (subdit.id_subdit = tt.kode_subdit) ".
		" WHERE tt.no_tt =\''+ b +'\'';
		jumpto1('frame_tt.php?sql='+sql+'&a='+b)
		";

	$GLOBALS['out_before_footer'] = '
 	<iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto name=\'iframe_entry1\' id=\'iframe_entry1\' style="width:0;height:0" src=""></iframe>
	<script language=javascript>
	function jumpto1(inputurl){
	document.getElementById(\'iframe_entry1\').src=inputurl
	}
	</script>
	'.$GLOBALS['out_before_footer']
			;
		$field_arr[] = array ('name' => 'alamat', 'type' => 'C', 'max_length'=>'0');
		$optional_arr['alamat']= 'user_defined';
		$label_arr['alamat'] = 'Alamat';
		$value_arr['alamat'] = '<input type=text name=alamat class=text size=50 disabled>';

		$field_arr[] = array ('name' => 'propinsi', 'type' => 'C', 'max_length'=>'0');
		$optional_arr['propinsi']= 'user_defined';
		$label_arr['propinsi'] = 'Subdit';
		$value_arr['propinsi'] = '<input type=text name=propinsi class=text size=30 disabled>';



		$result = array_merge($default_value, $result);
		$optional_arr['no_tt'] = 'user_defined';
		$value_arr['no_tt'] = $this->select_form('no_tt', $result, $selected,$multiple=FALSE,$jas);
		if ($_GET['action'] == 'edit') {
			$value_arr['no_tt'] .= "<input type=hidden name=nott>
			<script language=javascript>document.theform.no_tt.disabled = true;</script>";
		}
		
		$optional_arr['no_tt_rule'] = "\n".
		"       if(theform.no_tt.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['no_tt']." ".__('empty').".');\n".
		"               theform.no_tt.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";
	}

        function id_kategori_form(&$config) {
                eval($this->load_config);

                $selected = $value_arr['id_kategori'];

		/*
		 * COMMENT GIVEN BY : 566
		 *
		 * SQL Query to get category
		 */
                $fk_sql = "SELECT id_kategori as skey, nama_kategori as svalue FROM ".$GLOBALS[my_kat]." ORDER BY svalue";

		global $adodb; $adodb->debug = 0;$rs = $adodb->Execute($fk_sql);
		$result = $rs->GetRows();
                $default_value = array(array ('skey' => '','svalue' => __('Choose').' '.$this->cek_label['id_kategori']));
                $result = array_merge($default_value, $result);

		$jas ="
		b = document.theform.id_kategori.value; 
		c = '".$GLOBALS[my_subkat]."';
		jumpto2('frame_kat.php?a='+b+'&b='+c);";
		$GLOBALS['out_before_footer'] = '<iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto name=\'iframe_entry2\' id=\'iframe_entry2\' style="width:0;height:0" src=""></iframe>
		<script language=javascript>
			function jumpto2(inputurl) { document.getElementById(\'iframe_entry2\').src=inputurl; }
		</script>'.$GLOBALS['out_before_footer'];

		$optional_arr['id_kategori'] = 'user_defined';
		$value_arr['id_kategori'] = $this->select_form('id_kategori', $result, $selected, $multiple=FALSE, $jas);
		$optional_arr['id_kategori_rule'] = "";
	}

        function id_sub_kategori_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_sub_kategori'];
                if ($selected) {
			$fk_sql = "SELECT id_subkategori as skey, nama_subkategori as svalue ".
			" FROM ".$GLOBALS[my_subkat]." ".
			" WHERE id_subkategori='".$selected."'";
		} else {
			$fk_sql = "SELECT id_subkategori as skey, nama_subkategori as svalue ".
			" FROM ".$GLOBALS[my_subkat]." ".
			" LIMIT 0"; #ORDER BY svalue";
		}
		global $adodb; $adodb->debug = 0;$rs = $adodb->Execute($fk_sql);
		$result = $rs->GetRows();
                $default_value = array(array ('skey' => '','svalue' => __('Choose').' '.$this->cek_label['id_sub_kategori']));
                $result = array_merge($default_value, $result);
                $optional_arr['id_sub_kategori'] = 'user_defined';
                $value_arr['id_sub_kategori'] = $this->select_form('id_sub_kategori', $result, $selected).
		"<script language=javascript>
		function id_sub_kategori_add(text, value, selected) {
	        index = document.theform.id_sub_kategori.options.length;
        	document.theform.id_sub_kategori.options[index] = new Option(text, value, selected);
	        return index;
		}
		</script>
		";
		$optional_arr['id_sub_kategori_rule'] = "";
        }

	/*
	 * This function was made by 566
	 * The purpose is to show combo box for category
	 */
	function _show_category_($combo_name_, $content_, $default_) {
		$rr_ .= '<select name="'.$combo_name_.'" class="text">';
		$rr_ .= '<option value="0" selected>Pilih Kategori</option>';
		foreach ($content_['value'] as $i_ => $v_) {
			$selected_ = ($v_ == $default_) ? " selected" : "";
			$rr_ .= '<option value="'.$v_.'"'.$selected_.'>'.$content_['caption'][$i_].'</option>';
		}
		$rr_ .= '</select>';

		return $rr_;
	} // end : function _show_category_()

	// create add cek form
	function add_cek_form() {
		include_once 'class.xform.inc.php';
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;

		/*
		 * ADDED BY : 566
		 */
		global $my_kat;

		//print_r($_GET);exit();
		$record = $_GET;
		$label_arr = $this->cek_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('no_tt','I','8');

		list($suf1, $suf2, $suf3) = split(" ", strtolower($GLOBALS[my_title]));

		if ($suf2 == 'produksi' || $suf2 == 'penyalur') {
			$field_arr[] = xform::xf('no_pemohon','C','255');
			$field_arr[] = xform::xf('date_pemohon','I','8');
			if ($suf1 == 'perubahan') {
				$field_arr[] = xform::xf('perubahan','C','255');
				$label_arr[perubahan] = 'Detail Perubahan';
			}

			if ($suf1 == 'registrasi') {
				$field_arr[] = xform::xf('no_bap','C','255');
				$field_arr[] = xform::xf('date_bap','I','8');

				$field_arr[] = xform::xf('no_rekomendasi','C','255');
				$field_arr[] = xform::xf('date_rekomendasi','I','8');
			} else {
				$field_arr[] = xform::xf('no_sk_lama','C','255');
				$field_arr[] = xform::xf('date_sk_lama','I','8');

				$label_arr[no_sk_lama] = 'Nomor Keputusan Lama';
				$label_arr[date_sk_lama] = 'Tanggal Keputusan Lama';

				if ($suf1 == 'adendum')
					{
					$field_arr[] = xform::xf('no_rekomendasi','C','255');
					$field_arr[] = xform::xf('date_rekomendasi','I','8');

						$field_arr[] = xform::xf('no_bap','C','255');
						$label_arr[no_bap] = 'Jumlah Item Sebelumnya';
					}
			}

			if ($suf2 == 'penyalur') {
				$field_arr[] = xform::xf('lisensi','C','255');
			} else {
				$field_arr[] = xform::xf('nama_produk','C','255');
			}

			if ($suf2 == 'penyalur') {
				//$field_arr[] = xform::xf('lisensi2','C','255');
				//$field_arr[] = xform::xf('nama_produk2','C','255');
				//$field_arr[] = xform::xf('lisensi3','C','255');
				//$field_arr[] = xform::xf('nama_produk3','C','255');
				//$field_arr[] = xform::xf('lisensi4','C','255');
				//$field_arr[] = xform::xf('nama_produk4','C','255');
				//$field_arr[] = xform::xf('lisensi5','C','255');
				//$field_arr[] = xform::xf('nama_produk5','C','255');
			}
		} else if ($suf2 == 'edar') {
			$field_arr[] = xform::xf('nama_produk','C','255');
			$field_arr[] = xform::xf('jenis','C','255');
			$field_arr[] = xform::xf('id_kategori','C','255');
			$field_arr[] = xform::xf('id_sub_kategori','C','255');
			$field_arr[] = xform::xf('ukuran','C','255');
			$field_arr[] = xform::xf('kemasan','C','255');
			$field_arr[] = xform::xf('lisensi','C','255');

			if ($suf1 != 'registrasi') {
				$field_arr[] = xform::xf('no_sk_lama','C','255');
				$field_arr[] = xform::xf('date_sk_lama','I','8');

				$label_arr[no_sk_lama] = 'Nomor Keputusan Lama';
				$label_arr[date_sk_lama] = 'Tanggal Keputusan Lama';
			}

			$label_arr[nama_produk] = 'Nama Produk';
			$label_arr[jenis] = 'Jenis Produk';
			$label_arr[id_kategori] = 'Kategori';
			$label_arr[id_sub_kategori] = 'Sub Kategori';
			if ($suf3 == 'alkes') $label_arr[ukuran] = 'Tipe / Ukuran';
			else if ($suf3 == 'pkrt') $label_arr[ukuran] = 'Bentuk Sediaan / Warna';
			$label_arr[kemasan] = 'Kemasan';
		}

		$field_arr[] = xform::xf('kelengkapan','C','255');

		if ($suf2 == 'produksi' || $suf2 == 'edar') $field_arr[] = xform::xf('id_golongan','I','8');

		/*
		 * COMMENT GIVEN BY : 566
		 */
		//if ($GLOBALS['suf2'] == 'edar') {
		//	$field_arr[] = xform::xf('status_penilai','C','255');
		//}

		/*.~.*.~.*.~.*.~.*.~.* BEGIN OF xform TO DEFINE Kelas UP TO Keterangan *.~.*.~.*.~.*.~.*.~.*/

		/*
		 * MODIFIED BY : 566
		 *
		 * BEFORE :
		 * $field_arr[] = xform::xf('indi_kasubdit','C','255');
		 *
		 * AFTER :
		 */
		if ($ses->action== 'kasubdit' || $ses->action== 'admin') {
		  /*.~.*.~.*.~.*.~.*.~.* KASUBDIT *.~.*.~.*.~.*.~.*.~.*/
		  $field_arr[]                   = xform::xf('indi_kasubdit','C','255');
		  $label_arr['indi_kasubdit']    = "Indikator kasubdit";

		  $field_arr[]                   = xform::xf('status_kasubdit','C','255');
		  $label_arr['status_kasubdit']  = "Status kasubdit";

		  $field_arr[]                   = xform::xf('nama_kasubdit','C','255');
		  $label_arr['nama_kasubdit']    = "Nama kasubdit";

		  $field_arr[]                   = xform::xf('date_3','I','8');
		  $label_arr['date_3']           = "Tanggal kasubdit";

		  $field_arr[]                   = xform::xf('read_kasubdit','C','255');
		  $label_arr['read_kasubdit']    = "Read Kasubdit";

		  /*.~.*.~.*.~.*.~.*.~.* KASEKSI *.~.*.~.*.~.*.~.*.~.*/
		  $field_arr[]                 = xform::xf('indi_kaseksi','C','255');
		  $label_arr['indi_kaseksi']   = "Indikator Kaseksi";
		  
		  $field_arr[]                 = xform::xf('status_kaseksi','C','255');;
		  $label_arr['status_kaseksi'] = "Status Kaseksi";
		  
		  $field_arr[]                 = xform::xf('nama_kaseksi','C','255');
		  $label_arr['nama_kaseksi']   = "Nama Kaseksi";
		  
		  $field_arr[]                 = xform::xf('date_2','I','8');
		  $label_arr['date_2']         = "Tanggal Kaseksi";
		  
		  $field_arr[]                 = xform::xf('read_kaseksi','C','255');
		  $label_arr['read_kaseksi']   = "Read Kaseksi";

		} else if ($ses->action== 'kaseksi') {
		  /*.~.*.~.*.~.*.~.*.~.* KASEKSI *.~.*.~.*.~.*.~.*.~.*/
		  $field_arr[]                 = xform::xf('indi_kaseksi','C','255');
		  $label_arr['indi_kaseksi']   = "Indikator Kaseksi";
		  
		  $field_arr[]                 = xform::xf('status_kaseksi','C','255');;
		  $label_arr['status_kaseksi'] = "Status Kaseksi";
		  
		  $field_arr[]                 = xform::xf('nama_kaseksi','C','255');
		  $label_arr['nama_kaseksi']   = "Nama Kaseksi";
		  
		  $field_arr[]                 = xform::xf('date_2','I','8');
		  $label_arr['date_2']         = "Tanggal Kaseksi";
		  
		  $field_arr[]                 = xform::xf('read_kaseksi','C','255');
		  $label_arr['read_kaseksi']   = "Read Kaseksi";
		}

		/*.~.*.~.*.~.*.~.*.~.* PENILAI *.~.*.~.*.~.*.~.*.~.*/
		$field_arr[]                   = xform::xf('indi_penilai','C','255');
		$label_arr['indi_penilai']     = "Indikator Penilai";

		$field_arr[]                   = xform::xf('status_penilai','C','255');;
		$label_arr['status_penilai']   = "Status Penilai";

		$field_arr[]                   = xform::xf('nama_penilai','C','255');;
		$label_arr['nama_penilai']     = "Nama Penilai";
				
		$field_arr[]                   = xform::xf('date_1','I','8');
		$label_arr['date_1']           = "Tanggal Penilai";

		$field_arr[]                   = xform::xf('read_penilai','C','255');
		$label_arr['read_penilai']     = "Read Penilai";

		$field_arr[] = xform::xf('keterangan','C','255');

		//$field_arr[]                 = xform::xf('nama_kaseksi','C','255');
		//$label_arr['nama_kaseksi']   = "Nama Kaseksi";

		/*.~.*.~.*.~.*.~.*.~.* END OF xform TO DEFINE Kelas UP TO Keterangan *.~.*.~.*.~.*.~.*.~.*/

		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." cek WHERE id_cek_1='{$record['id_cek_1']}'");

		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_cek_1'] = 'protect';
			$mode = 'edit';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['kelengkapan_rule'] = '';
		$optional_arr['id_cek_1_rule'] = '';
		$optional_arr['id_golongan_rule'] = '';
		$optional_arr['no_daftar_rule'] = '';
		$optional_arr['no_rekomendasi_rule'] = '';
		$optional_arr['date_rekomendasi_rule'] = '';
		$optional_arr['no_bap_rule'] = '';
		$optional_arr['date_bap_rule'] = '';
		$optional_arr['no_pemohon_rule'] = '';
		$optional_arr['date_pemohon_rule'] = '';
		$optional_arr['nama_produk_rule'] = '';
		$optional_arr['nama_pabrik_rule'] = '';
		$optional_arr['alamat_rule'] = '';
		$optional_arr['lisensi_rule'] = '';
		$optional_arr['status_penilai_rule'] = '';
		$optional_arr['nama_penilai_rule'] = '';
		$optional_arr['date_1_rule'] = '';
		$optional_arr['status_kaseksi_rule'] = '';
		$optional_arr['nama_kaseksi_rule'] = '';
		$optional_arr['date_2_rule'] = '';
		$optional_arr['status_kasubdit_rule'] = '';
		$optional_arr['nama_kasubdit_rule'] = '';
		$optional_arr['date_3_rule'] = '';
		$optional_arr['status_direktur_rule'] = '';
		$optional_arr['nama_direktur_rule'] = '';
		$optional_arr['date_4_rule'] = '';
		$optional_arr['keterangan_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		$optional_arr['no_sk_lama_rule'] = '';
		$optional_arr['date_sk_lama_rule'] = '';
		$optional_arr['lisensi_rule'] = '';
		$optional_arr['nama_produk_rule'] = '';
		$optional_arr['lisensi2_rule'] = '';
		$optional_arr['nama_produk2_rule'] = '';
		$optional_arr['lisensi3_rule'] = '';
		$optional_arr['nama_produk3_rule'] = '';
		$optional_arr['lisensi4_rule'] = '';
		$optional_arr['nama_produk4_rule'] = '';
		$optional_arr['lisensi5_rule'] = '';
		$optional_arr['nama_produk5_rule'] = '';
		$optional_arr['npwp_rule'] = '';

		eval($this->save_config);

		if ($suf2 == 'edar') {
			$this->id_kategori_form($config);
			$this->id_sub_kategori_form($config);
		}
		
		/*
		 * ADDED BY : 566
		 *
		 * This is to show license and category for "izin penyalur" and
		 * only to show category for "izin produksi"
		 */
		if ($suf2=="produksi") {
			/*
			 * Show only category for "izin produksi"
			 */

			$optional_arr['nama_produk'] = 'user_defined';
			$label_arr['nama_produk']    = 'Nama Produk';

			/*
			 * Build a query to get category based on $my_kat
			 */
			$sql_ = "SELECT id_kategori AS value_, nama_kategori AS caption_ FROM $my_kat ORDER BY nama_kategori ASC";

			$rs = $adodb->Execute($sql_);

			while(! $rs->EOF){
				$r_['value'][]   = $rs->fields['value_'];
				$r_['caption'][] = $rs->fields['caption_'];
				$rs->MoveNext();
			}

			/*
			 * Start to show more than one combo box of category
			 */
			$c_ =	'
				<table border="0">
				';

			// Set default how many category to show
			$default_category_to_show = 0;
			for ($i_=1;$i_<=17;$i_++) {
				if ($value_arr['__nama_produk'.$i_]!="") $default_category_to_show++;
			}
			$maximum_category_to_show = 17;
			if ($mode=="add") $default_category_to_show = 3;

			/*
			 * Show all category
			 */
			for ($i_ = 1;$i_ <= $maximum_category_to_show; $i_++) {
				$c_ .= '
				<tr id="tr_'.$i_.'" valign="top">
				  <td>Kategori :<br>'.$this->_show_category_("__kategori_produk".$i_, $r_, $value_arr['__kategori_produk'.$i_]).'</td>
				  <td>&nbsp; Nama Produk:<br>&nbsp; <textarea name="__nama_produk'.$i_.'" class="text">'.$value_arr['__nama_produk'.$i_].'</textarea></td>
				</tr>
				';
			} // end : for ($i_

			/*
			 * Add link to add more category,
			 */
			$c_ .= 	'
				<tr id="tr_'.$i_.'" valign="top" align="right">
				  <td colspan="2" id="add_more"><a href="javascript:show_it()">Tambah Kategori dan Nama Produk</a></td>
				</tr>
				</table>';

			/*
			 * Add javascript function to set default how many category to show
			 */
			$c_ .= '
				<script language="javascript">
				for (i=1; i<='.$maximum_category_to_show.'; i++) {
					state = (i <= '.$default_category_to_show.') ? "block" : "none";
					document.getElementById("tr_" + i).style.display = state;
				}';

			/*
			 * Add javascript function to handle link about adding more category
			 */
			$c_ .= '
				function show_it() {
					shown_id = 0;
					for (i=1; i<='.$maximum_category_to_show.'; i++) {
						state = document.getElementById("tr_" + i).style.display;
						if (state=="none") {
							document.getElementById("tr_" + i).style.display = "block";
							shown_id = i;
							break;
						}
					}
					if (shown_id=='.$maximum_category_to_show.') document.getElementById("add_more").innerHTML = "&nbsp;";
				}
				</script>
				';
			/*
			 * Throw $c_ to $value_arr['nama_produk']
			 */
			$value_arr['nama_produk'] = $c_;
		} elseif ($suf2=="penyalur") {
			/*
			 * Show license and category for "izin penyalur"
			 */

			$optional_arr['lisensi']  = 'user_defined';
			$label_arr['lisensi']     = 'Lisensi';

			/*
			 * Build a query to get category based on $my_kat
			 */
			$sql_ = "SELECT id_kategori AS value_, nama_kategori AS caption_ FROM $my_kat ORDER BY nama_kategori ASC";

			$rs = $adodb->Execute($sql_);

			while(! $rs->EOF){
				$r_['value'][]   = $rs->fields['value_'];
				$r_['caption'][] = $rs->fields['caption_'];
				$rs->MoveNext();
			}

			/*
			 * Set maximum license and category to show
			 */
			$maximum_license_to_show = 10;
			$maximum_category_to_show = 17;

			/*
			 * Start to show more than one license
			 */
			$c_ =	'<table border="0">';

			// Set default license to show
			$default_license_to_show = 1;
			if ($value_arr['lisensi']=="") {
				// add

				/*
				 * For adding, set to 1 for dedault license to show
				 */
				$default_license_to_show = 1;
			} else {
				// edit

				/*
				 * For editing, set to number of registered licenses for dedault license to show
				 * It's based on pattern of license
				 *
				 * Set a blank pattern of license for initialization
				 * Thus, try to explode and then mappong the pattern of license
				 */
				$full_license__ = explode("+++",$value_arr['lisensi']);
				$default_license_to_show = count($full_license__);

				/*
				 * Set a blank pattern of license for initialization
				 */
				for ($i=1;$i<=$maximum_license_to_show;$i++) {
					$license_pattern['license_'.$i] = "";
					$default_show_category__[$i]    = 0;
					for ($j=1;$j<=$maximum_category_to_show;$j++) {
						$license_pattern['license_'.$i.'_category_'.$j] = 0;
						$license_pattern['license_'.$i.'_product_'.$j]  = "";
					}
				}

				/*
				 * Try to explode and then mapping the pattern of license
				 */
				for ($i=0;$i<$default_license_to_show;$i++) {
					$xplode = explode("==>",$full_license__[$i]);
					$license_pattern['license_'.($i+1)] = $xplode[0];

					$xplode_category_n_product = explode("***",$xplode[1]);
					$default_show_category__[$i+1] = count($xplode_category_n_product);
					foreach ($xplode_category_n_product as $index => $category_n_product) {
						$category_n_product__ = explode("===",$category_n_product);
						$license_pattern['license_'.($i+1).'_category_'.($index+1)] = $category_n_product__[0];

						$xplode_product = explode(",,,",$category_n_product__[1]);
						$break_line     = "\n";
						$temp_product__ = "";
						foreach ($xplode_product as $product___) {
							$temp_product__ .= ($temp_product__=="") ? $product___ : $break_line.$product___ ;
						}
						$license_pattern['license_'.($i+1).'_product_'.($index+1)] = $temp_product__;
					}
				}
			}

			/*
			 * Try to show license including category
			 */
			for ($i_ = 1;$i_ <= $maximum_license_to_show; $i_++) {
				// Initialize table for showing category
				$d_ =	'<table border="0">';

				// Set default how many category to show
				if ($default_show_category__[$i_]==0) {
					$default_category_to_show = 3;
				} else {
					$default_category_to_show = $default_show_category__[$i_];
				}

				/*
				 * Start to show category
				 */
				for ($i_i = 1;$i_i <= $maximum_category_to_show; $i_i++) {
					$d_ .= '
						<tr id="tr_license_'.$i_.'_category_'.$i_i.'" valign="top">
						  <td>Kategori :<br>'.$this->_show_category_("__lisensi_".$i_."_kategori_".$i_i, $r_, $license_pattern['license_'.$i_.'_category_'.$i_i]).'</td>
						  <td>&nbsp; Nama Produk:<br>&nbsp; <textarea name="__lisensi_'.$i_.'_nama_produk_'.$i_i.'" class="text">'.$license_pattern['license_'.$i_.'_product_'.$i_i].'</textarea></td>
						</tr>
						';
				} // end : for ($i_i

				/*
				 * Add link to add more category,
				 */
				$d_ .= 	'
					<tr valign="top" align="right">
					  <td colspan="2" id="add_category_'.$i_.'"><a href="javascript:add_category('.$i_.')">Tambah Kategori dan Nama Produk</a></td>
					</tr>
					</table>';

				/*
				 * Add javascript function to set default how many category to show
				 */
				$d_ .=	'<script language="javascript">
					for (i=1; i<='.$maximum_category_to_show.'; i++) {
						state = (i <= '.$default_category_to_show.') ? "block" : "none";
						document.getElementById("tr_license_'.$i_.'_category_" + i).style.display = state;
					}
					</script>
					';
				/*
				 * End to show category
				 *
				 * Category thrown to $d_
				 */

				/*
				 * Show license including category which just made from $d_
				 */
				$c_ .= '
					<tr id="tr_license_'.$i_.'" valign="top">
					  <td>Lisensi #'.$i_.' : <input type="text" name="__lisensi_'.$i_.'" value="'.$license_pattern['license_'.$i_].'" class="text"></td>
					  <td>'.$d_.'</td>
					</tr>
					';
			} // end : for ($i_

			$c_ .= 	'
				<tr id="tr_'.$i_.'" valign="top" align="left">
				  <td colspan="2" id="add_license_'.$i_.'"><a href="javascript:add_license()">Tambah Lisensi</a></td>
				</tr>
				</table>

				<script language="javascript">
				for (i=1; i<='.$maximum_license_to_show.'; i++) {
					state = (i <= '.$default_license_to_show.') ? "block" : "none";
					document.getElementById("tr_license_" + i).style.display = state;
				}

				function add_license() {
					shown_id = 0;
					for (i=1; i<='.$maximum_license_to_show.'; i++) {
						state = document.getElementById("tr_license_" + i).style.display;
						if (state=="none") {
							document.getElementById("tr_license_" + i).style.display = "block";
							shown_id = i;
							break;
						}
					}
					if (shown_id=='.$maximum_license_to_show.') document.getElementById("add_license_'.$i_.'").innerHTML = "&nbsp;";
				}

				function add_category(license_id) {
					shown_id = 0;
					for (i=1; i<='.$maximum_category_to_show.'; i++) {
						state = document.getElementById("tr_license_" + license_id + "_category_" + i).style.display;
						if (state=="none") {
							document.getElementById("tr_license_" + license_id + "_category_" + i).style.display = "block";
							shown_id = i;
							break;
						}
					}
					if (shown_id=='.$maximum_category_to_show.') document.getElementById("add_category_" + license_id).innerHTML = "&nbsp;";
				}
				</script>
				';

			$value_arr['lisensi'] = $c_;
		} else {
			//$value_arr['nama_produk'] = '';
		}
		/*
		 * END OF ADDITION BY : 566
		 *
		 * This is to show more than one combo box of category
		 */

		if ($suf2 == 'penyalur') {
			/*
			 * COMMENT GIVEN BY : 566
			 */
			//$optional_arr['lisensi'] = 'user_defined';
			//$value_arr['lisensi'] = '<input name="lisensi" class="text" size=40 value="'.$value_arr['lisensi'].'">';
			//$optional_arr['lisensi2'] = 'user_defined';
			//$value_arr['lisensi2'] = '<input name="lisensi2" class="text" size=40 value="'.$value_arr['lisensi2'].'">';
			//$optional_arr['lisensi3'] = 'user_defined';
			//$value_arr['lisensi3'] = '<input name="lisensi3" class="text" size=40 value="'.$value_arr['lisensi3'].'">';
			//$optional_arr['lisensi4'] = 'user_defined';
			//$value_arr['lisensi4'] = '<input name="lisensi4" class="text" size=40 value="'.$value_arr['lisensi4'].'">';
			//$optional_arr['lisensi5'] = 'user_defined';
			//$value_arr['lisensi5'] = '<input name="lisensi5" class="text" size=40 value="'.$value_arr['lisensi5'].'">';

		
			$optional_arr['nama_produk2'] = 'user_defined';
			$value_arr['nama_produk2'] = '<textarea name="nama_produk2" class="text" rows="3" cols="50">'.$value_arr['nama_produk2'].'</textarea>';
			$optional_arr['nama_produk3'] = 'user_defined';
			$value_arr['nama_produk3'] = '<textarea name="nama_produk3" class="text" rows="3" cols="50">'.$value_arr['nama_produk3'].'</textarea>';
			$optional_arr['nama_produk4'] = 'user_defined';
			$value_arr['nama_produk4'] = '<textarea name="nama_produk4" class="text" rows="3" cols="50">'.$value_arr['nama_produk4'].'</textarea>';
			$optional_arr['nama_produk5'] = 'user_defined';
			$value_arr['nama_produk5'] = '<textarea name="nama_produk5" class="text" rows="3" cols="50">'.$value_arr['nama_produk5'].'</textarea>';
		}

		$optional_arr['keterangan'] = 'user_defined';
		$value_arr['keterangan'] = '<textarea name="keterangan" class="text" rows="3" cols="50">'.$value_arr['keterangan'].'</textarea>';

		$optional_arr['nama_penilai'] = 'user_defined';
		$optional_arr['date_1'] = 'user_defined';
		$optional_arr['status_penilai'] = 'user_defined';
		
		$optional_arr['nama_kaseksi'] = 'user_defined';
		$optional_arr['date_2'] = 'user_defined';
		$optional_arr['status_kaseksi'] = 'user_defined';
		
		$optional_arr['nama_kasubdit'] = 'user_defined';
		$optional_arr['date_3'] = 'user_defined';
		$optional_arr['status_kasubdit'] = 'user_defined';
		
		$optional_arr['nama_direktur'] = 'user_defined';
		$optional_arr['date_4'] = 'user_defined';
		$optional_arr['status_direktur'] = 'user_defined';
		
		$optional_arr['indi_kaseksi'] = 'user_defined';
		$optional_arr['indi_kasubdit'] = 'user_defined';
		$optional_arr['indi_direktur'] = 'user_defined';
		
		/*
		 * ADDED BY : 566
		 */
		$optional_arr['indi_penilai'] = 'user_defined';
		$optional_arr['read_penilai'] = 'user_defined';
		
		$optional_arr['read_kaseksi'] = 'user_defined';
		$optional_arr['read_kasubdit'] = 'user_defined';
		$optional_arr['read_direktur'] = 'user_defined';

		if($value_arr['status_penilai'] == '0'){$ok1 = 'checked';$ok1text='0';$ok2='';$ok1t='Sudah Lengkap';}else{$ok1='';$ok2='checked';$ok1text='1';$ok1t='Belum Lengkap';}
		if($value_arr['status_kaseksi'] == '0'){$ok3 = 'checked';$ok2text='0';$ok4='';$ok2t='Sudah Lengkap';}else{$ok3='';$ok4='checked';$ok2text='1';$ok2t='Belum Lengkap';}
		if($value_arr['status_kasubdit'] == '0'){$ok5 = 'checked';$ok3text='0';$ok6='';$ok3t='Sudah Lengkap';}else{$ok5='';$ok6='checked';$ok3text='1';$ok3t='Belum Lengkap';}
		if($value_arr['status_direktur'] == '0'){$ok7 = 'checked';$ok4text='0';$ok8='';$ok4t='Sudah Lengkap';}else{$ok7='';$ok8='checked';$ok4text='1';$ok4t='Belum Lengkap';}

		if($value_arr['indi_kaseksi'] == '0'){$sel1 = 'selected';$sel2 ='';}else{$sel1='';$sel2='selected';}
		if($value_arr['indi_kasubdit'] == '0'){$sel3 = 'selected';$sel4 ='';}else{$sel3='';$sel4='selected';}
		if($value_arr['indi_direktur'] == '0'){$sel5 = 'selected';$sel6 ='';}else{$sel5='';$sel6='selected';}
		
		/*
		 * ADDED BY : 566
		 */
		if($value_arr['indi_penilai'] == '0'){$sel7 = 'selected';$sel8 ='';}else{$sel7='';$sel8='selected';}

		if( $value_arr['date_1'] == '0'){ $tgl1 = '';}else{ if( $value_arr['date_1'] != ''){$tgl1 = date('d/m/Y',$value_arr['date_1']);}}
		if( $value_arr['date_2'] == '0'){ $tgl2 = '';}else{ if( $value_arr['date_2'] != ''){$tgl2 = date('d/m/Y',$value_arr['date_2']);}}
		if( $value_arr['date_3'] == '0'){ $tgl3 = '';}else{ if( $value_arr['date_3'] != ''){$tgl3 = date('d/m/Y',$value_arr['date_3']);}}
		if( $value_arr['date_4'] == '0'){ $tgl4 = '';}else{ if( $value_arr['date_4'] != ''){$tgl4 = date('d/m/Y',$value_arr['date_4']);}}

		/*
		 * MODIFIED BY : 566
		 *
		 * BEFORE :
		 * if($ses->action == 'penilai') {
		 *
		 * AFTER :
		 */
		if($ses->action == 'kaseksi') {

			if( $value_arr['date_1'] == '0'){ $tgl1 = '';}else{ if( $value_arr['date_1'] != ''){$tgl1 = date('d/m/Y',$value_arr['date_1']);}}
		//print ($value_arr['date_2']);
			                                          if( $value_arr['date_2'] == '0'){ $tgl2 = date('d/m/Y');}else{ if( $value_arr['date_2'] != ''){$tgl2 = date('d/m/Y',$value_arr['date_2']);}}
								                                                            if( $value_arr['date_3'] == '0'){ $tgl3 = '';}else{ if( $value_arr['date_3'] != ''){$tgl3 = date('d/m/Y',$value_arr['date_3']);}}
															                                                                              if( $value_arr['date_4'] == '0'){ $tgl4 = '';}else{ if( $value_arr['date_4'] != ''){$tgl4 = date('d/m/Y',$value_arr['date_4']);}}

																								      
			$value_arr['nama_penilai'] = '<input type="text" name="nama_penilai" value="'.$value_arr['nama_penilai'].'" readonly size=11 class="text">';
			$value_arr['date_1'] = '<input type="text" name="date_1" value="'.date('d/m/Y').'" readonly size=11 class="text">';

			$value_arr['indi_penilai'] ='<select name="indi_penilai" class="text"><option value="0" '.$sel7.'>Return</option><option value="1" '.$sel8.'>OK</option></select>';
							
			$value_arr['status_penilai'] = '<input type="radio" name="status_penilai" value="0" '.$ok1.' >Sudah Lengkap <input type="radio" name="status_penilai" value="1" '.$ok2.'>Belum Lengkap'.
			
			/*
			 * COMMENT GIVEN BY : 566
			 */
			//<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">

			'<input type="hidden" name="date_2" value="'.$tgl2.'">
			<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">
			<input type="hidden" name="date_3" value="'.$tgl3.'">
			<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">
			<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
			<input type="hidden" name="date_4" value="'.$tgl4.'">
			<input type="hidden" name="status_direktur" value="'.$ok4text.'">
			';
			
			/*
			 * ADDED BY : 566
			 *
			 * DO NOT EVER TRY TO MOVE BELOW CODE ANYWHERE
			 */
			$value_arr['indi_kaseksi'] ='<select name="indi_kaseksi" class="text"><option value="0" '.$sel1.'>Return</option><option value="1" '.$sel2.'>OK</option></select>';
			$value_arr['status_kaseksi'] = '<input type="radio" name="status_kaseksi" value="0" '.$ok3.' >Sudah Lengkap <input type="radio" name="status_kaseksi" value="1" '.$ok4.'>Belum Lengkap';
			$value_arr['nama_kaseksi'] = '<input type="text" name="nama_kaseksi" value="'.$ses->loginid.'" readonly size=11 class="text">';
			$value_arr['date_2'] = '<input type="text" name="date_2" value="'.date('d/m/Y').'" readonly size=11 class="text">';
			$read = $value_arr['read_kaseksi'];
			if($read == '1') { $select = "checked"; } else { $select = ""; }
			$value_arr['read_kaseksi']='<input type="checkbox" name="read_kaseksi" '.$select.' class="text">';
			$read_pen = $value_arr['read_penilai'];
			if($read_pen == '1'){$select = "checked";}else{$select = "";}
			$value_arr['read_penilai']='<input type="checkbox" name="read_penilai" '.$select.' class="text">';
			
			/*
			 * COMMENT GIVEN BY : 566
			 */
			// $optional_arr['nama_kaseksi'] = TRUE;
			// $optional_arr['date_2'] = TRUE;
			// $optional_arr['status_kaseksi'] = TRUE;
			$optional_arr['nama_kasubdit'] = TRUE;
			$optional_arr['date_3'] = TRUE;
			$optional_arr['status_kasubdit'] = TRUE;
			$optional_arr['nama_direktur'] = TRUE;
			$optional_arr['date_4'] = TRUE;
			$optional_arr['status_direktur'] = TRUE;

			 
//print_r($_POST);exit();

		}else{
			/*
			 * MODIFIED BY : 566
			 *
			 * BEFORE :
			 * if($ses->action == 'kaseksi') {
			 *
			 * AFTER :
			 */
			if($ses->action == 'penilai') {
				/*
				 * MODIFIED BY : 566
				 *
			 	 * BEFORE :
				 * $value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';
				 *
				 * AFTER :
				 */
				$value_arr['status_penilai'] = '<input type="radio" name="status_penilai" value="0" '.$ok1.' >Sudah Lengkap <input type="radio" name="status_penilai" value="1" '.$ok2.'>Belum Lengkap';

				/*
				 * COMMENT GIVEN BY : 566
				 */
				// $value_arr['indi_kasubdit'] ='<select name="indi_kasubdit" class="text"><option value="0" '.$sel3.'>Return</option><option value="1" '.$sel4.'>OK</option></select>';

				$value_arr['nama_penilai'] = '<input type="text" name="nama_penilai" value="'.$ses->loginid.'" readonly size=11 class="text">';
				$value_arr['nama_kaseksi'] = '<input type="text" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'" readonly size=11 class="text">';
				$value_arr['indi_penilai'] ='<select name="indi_penilai" class="text"><option value="0" '.$sel7.'>Return</option><option value="1" '.$sel8.'>OK</option></select>';
				$value_arr['indi_kaseksi'] ='<select name="indi_kaseksi" class="text"><option value="0" '.$sel1.'>Return</option><option value="1" '.$sel2.'>OK</option></select>';

				$read = $value_arr['read_kaseksi'];
				if($read == '1'){$select = "checked";}else{$select = "";}
				$value_arr['read_kaseksi']='<input type="checkbox" name="read_kaseksi" '.$select.' class="text">';
				
				/*
				 * ADDED BY : 566
				 */
				$read_pen = $value_arr['read_penilai'];
				if($read_pen == '1'){$select = "checked";}else{$select = "";}
				$value_arr['read_penilai']='<input type="checkbox" name="read_penilai" '.$select.' class="text">';

				$value_arr['date_1'] = '<input type="text" name="date_1" value="'.date('d/m/Y').'" readonly size=11 class="text">';
				$value_arr['date_2'] = '<input type="text" name="date_2" value="'.date('d/m/Y').'" readonly size=11 class="text">';
				$value_arr['status_kaseksi'] = '<input type="radio" name="status_kaseksi" value="0" '.$ok3.' >Sudah Lengkap <input type="radio" name="status_kaseksi" value="1" '.$ok4.'>Belum Lengkap
				<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">
				<input type="hidden" name="date_1" value="'.$tgl1.'">
				<input type="hidden" name="status_penilai" value="'.$ok1text.'">
				<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">
				<input type="hidden" name="date_3" value="'.$tgl3.'">
				<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">
				<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
				<input type="hidden" name="date_4" value="'.$tgl4.'">
				<input type="hidden" name="status_direktur" value="'.$ok4text.'">
				';

				/*
				 * COMMENT GIVEN BY : 566
				 */
				// $optional_arr['nama_penilai'] = TRUE;
				// $optional_arr['date_1'] = TRUE;

				$optional_arr['nama_kasubdit'] = TRUE;
				$optional_arr['indi_direktur'] = TRUE;
				$optional_arr['date_3'] = TRUE;
				$optional_arr['status_kasubdit'] = TRUE;
				$optional_arr['nama_direktur'] = TRUE;
				$optional_arr['date_4'] = TRUE;
				$optional_arr['status_direktur'] = TRUE;
				$optional_arr['read_direktur'] = TRUE;
				$optional_arr['read_kasubdit'] = TRUE;;
			}else{
				if($ses->action == 'kasubdit' || $ses->action == 'admin'){
					/*
					 * ADDED BY : 566
					 */
					$value_arr['indi_kaseksi']   ='<select name="indi_kaseksi" class="text"><option value="0" '.$sel1.'>Return</option><option value="1" '.$sel2.'>OK</option></select>';
					$value_arr['status_kaseksi'] = '<input type="radio" name="status_kaseksi" value="0" '.$ok3.' >Sudah Lengkap <input type="radio" name="status_kaseksi" value="1" '.$ok4.'>Belum Lengkap';
					$value_arr['date_2']         = '<input type="text" name="date_2" value="'.date('d/m/Y').'" readonly size=11 class="text">';
					$read                        = $value_arr['read_kaseksi'];
					if($read == '1') { $select = "checked"; } else { $select = ""; }
					$value_arr['read_kaseksi']   = '<input type="checkbox" name="read_kaseksi" '.$select.' class="text">';
					$value_arr['indi_penilai']   = '<select name="indi_penilai" class="text"><option value="0" '.$sel7.'>Return</option><option value="1" '.$sel8.'>OK</option></select>';
					$value_arr['status_penilai'] = '<input type="radio" name="status_penilai" value="0" '.$ok1.' >Sudah Lengkap <input type="radio" name="status_penilai" value="1" '.$ok2.'>Belum Lengkap';
					$value_arr['date_1']         = '<input type="text" name="date_1" value="'.date('d/m/Y').'" readonly size=11 class="text">';
					$value_arr['read_penilai']   = '<input type="checkbox" name="read_penilai" '.$select.' class="text">';

					/*
					 * COMMENT GIVEN BY : 566
					 */
					// $value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';
					// $value_arr['status_kaseksi'] = ''.$ok2t.', '.$value_arr['nama_kaseksi'].', '.$tgl2.'';

					/*
					 * ADDED BY : 566
					 */
					$value_arr['nama_kasubdit'] = '<input type="text" name="nama_kasubdit" value="'.(($ses->action == 'kasubdit') ? $ses->loginid : $value_arr['nama_kasubdit']).'" readonly size=11 class="text">';
					$value_arr['indi_kaseksi']  = '<select name="indi_kaseksi" class="text"><option value="0" '.$sel1.'>Return</option><option value="1" '.$sel2.'>OK</option></select>';

					$read = $value_arr['read_kasubdit'];
					if($read == '1'){$select = "checked";}else{$select = "";}
					$value_arr['read_kasubdit']='<input type="checkbox" name="read_kasubdit" '.$select.' class="text">';

					$value_arr['indi_kasubdit'] ='<select name="indi_kasubdit" class="text"><option value="0" '.$sel3.'>Return</option><option value="1" '.$sel4.'>OK</option></select>';
     					$value_arr['indi_direktur'] ='<select name="indi_direktur" class="text"><option value="0" '.$sel5.'>Return</option><option value="1" '.$sel6.'>OK</option></select>';
					$value_arr['date_3'] = '<input type="text" name="date_3" value="'.date('d/m/Y').'" readonly size=11 class="text">
				       
				 <input type="hidden" name="date_3" value="'.date("d/m/Y"
			 ).'">	';
					$value_arr['status_kasubdit'] = '<input type="radio" name="status_kasubdit" value="0" '.$ok5.' >Sudah Lengkap <input type="radio" name="status_kasubdit" value="1" '.$ok6.'>Belum Lengkap
					<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">
					<input type="hidden" name="date_1" value="'.$tgl1.'">
					<input type="hidden" name="status_penilai" value="'.$ok1text.'">
					<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">
					<input type="hidden" name="date_2" value="'.$tgl2.'">
					<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">
					<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
					<input type="hidden" name="date_4" value="'.$tgl4.'">
					<input type="hidden" name="status_direktur" value="'.$ok4text.'">
					';
					
					/*
					 * MODIFIED BY : 566
					 *
					 * DO NOT EVER TRY TO MOVE BELOW CODE ANYWHERE
					 */
					$value_arr['nama_kaseksi'] = '<input type="text" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'" readonly size=11 class="text">';
					$value_arr['nama_penilai'] = '<input type="text" name="nama_penilai" value="'.$value_arr['nama_penilai'].'" readonly size=11 class="text">';

					/*
					 * COMMENT GIVEN BY : 566
					 */
					// $optional_arr['nama_kaseksi'] = TRUE;
					// $optional_arr['date_2'] = TRUE;
					// $optional_arr['read_kaseksi'] = TRUE;
					// $optional_arr['nama_penilai'] = TRUE;
					// $optional_arr['date_1'] = TRUE;

					$optional_arr['nama_direktur'] = TRUE;
					$optional_arr['date_4'] = TRUE;
					$optional_arr['status_direktur'] = TRUE;
					$optional_arr['read_direktur'] = TRUE;
				}else{
					if($ses->action == 'direktur'){
						//print_r($ses);
					$field_arr[] = xform::xf('indi_direktur','C','255');
					$field_arr[] = xform::xf('read_direktur','C','255');
					$field_arr[] = xform::xf('status_direktur','C','255');
					$field_arr[] = xform::xf('nama_direktur','C','255');
					$field_arr[] = xform::xf('date_4','C','255');

					$optional_arr['indi_direktur'] = 'user_defined';
					$optional_arr['read_direktur'] = 'user_defined';
					$optional_arr['status_direktur'] = 'user_defined';
					$optional_arr['nama_direktur'] = 'user_defined';
					$optional_arr['date_4'] = 'user_defined';
					
					
					$this->slip_field($config,'indi_direktur','after','status_penilai');
					$this->slip_field($config,'status_direktur','after','indi_direktur');
					$this->slip_field($config,'read_direktur','after','status_direktur');
					$this->slip_field($config,'nama_direktur','after','read_direktur');
					$this->slip_field($config,'date_4','after','nama_direktur');
					
				
		
					$value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';
						$value_arr['indi_kasubdit'] ='<select name="indi_kasubdit" class="text"><option value="0" '.$sel3.'>Return</option><option value="1" '.$sel4.'>OK</option></select>';
						$value_arr['indi_direktur'] ='<select name="indi_direktur" class="text"><option value="0" '.$sel5.'>Return</option><option value="1" '.$sel6.'>OK</option></select>';

						
						
						$read = $value_arr['read_direktur'];
						if($read == '1'){$select = "checked";}else{$select = "";}
						$value_arr['read_direktur']='<input type="checkbox" name="read_direktur" '.$select.' class="text">';

						$value_arr['status_kaseksi'] = ''.$ok2t.', '.$value_arr['nama_kaseksi'].', '.$tgl2.'';
						$value_arr['status_kasubdit'] = ''.$ok3t.', '.$value_arr['nama_kasubdit'].', '.$tgl3.'';

						$value_arr['nama_direktur'] = '<input type="text" name="nama_direktur" value="'.$ses->loginid.'" readonly size=11 class="text">';
						$value_arr['date_4'] = '<input type="text" name="date_4" value="'.date('d/m/Y').'" readonly size=11 class="text">';
						$value_arr['status_direktur'] = '<input type="radio" name="status_direktur" value="0" '.$ok7.' >Sudah Lengkap <input type="radio" name="status_direktur" value="1" '.$ok8.'>Belum Lengkap
						<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">
						<input type="hidden" name="date_1" value="'.$tgl1.'">
						<input type="hidden" name="status_penilai" value="'.$ok1text.'">
						<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">
						<input type="hidden" name="date_2" value="'.$tgl2.'">
						<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">
						<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">
						<input type="hidden" name="date_3" value="'.$tgl3.'">
						<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">
						';

						//print_r($value_arr);
						//$optional_arr['read_direktur'] = 'user_defined';
						//$optional_arr['read_direktur'] = FALSE;
						//$optional_arr['nama_direktur']= TRUE;
						//$optional_arr['date_4']= FALSE;
						//$optional_arr['indi_direktur'] = FALSE;
						
						$optional_arr['nama_penilai'] = TRUE;
						$optional_arr['date_1'] = TRUE;
                         			$optional_arr['indi_penilai'] = TRUE;					                       //$optional_arr['status_penilai'] = TRUE;
						
						$optional_arr['status_kaseksi'] = TRUE;
						
						$optional_arr['read_penilai'] = true;
						//$optional_arr['read_direktur'] = false;

						/*
						$optional_arr['nama_kaseksi'] = TRUE;
						$optional_arr['date_2'] = TRUE;
						$optional_arr['status_kaseksi'] = FALSE;
						*/
						//$optional_arr['indi_kaseksi'] = TRUE;

						/*
						$optional_arr['nama_kasubdit'] = TRUE;
						$optional_arr['date_3'] = TRUE;
						$optional_arr['read_kaseksi'] = FALSE;
						$optional_arr['read_kasubdit'] = TRUE;
						$optional_arr['read_penilai'] = TRUE;
						*/
					}else{
						$value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';
						$value_arr['status_kaseksi'] = ''.$ok2t.', '.$value_arr['nama_kaseksi'].', '.$tgl2.'';
						$value_arr['status_kasubdit'] = ''.$ok3t.', '.$value_arr['nama_kasubdit'].', '.$tgl3.'';
						$value_arr['status_direktur'] = ''.$ok4t.', '.$value_arr['nama_direktur'].', '.$tgl4.'';
						
						$optional_arr['nama_penilai'] = TRUE;
						$optional_arr['date_1'] = TRUE;

						$optional_arr['nama_kaseksi'] = TRUE;
						$optional_arr['date_2'] = TRUE;

						$optional_arr['nama_kasubdit'] = TRUE;
						$optional_arr['date_3'] = TRUE;

						$optional_arr['nama_direktur'] = TRUE;
						$optional_arr['date_4'] = TRUE;
					}
				}
			}
		}

		//$optional_arr['nama_penilai_format']='Nama Penilai : nama_penilai Tanggal Satu date_1';
		//$optional_arr['nama_kaseksi_format']='Nama Kaseksi : nama_kaseksi Tanggal Dua date_2';
		//$optional_arr['nama_kasubdit_format']='Nama Kasubdit : nama_kasubdit Tanggal Tiga date_3';
		//$optional_arr['nama_direktur_format']='Nama Direktur : nama_direktur Tanggal Empat date_4';

		$this->no_tt_form($config);

		/*
		 * COMMENT GIVEN BY : 566
		 *
		 * BELOW FOR HEADER "kelengkapan"
		 */
		## KOMENTAR PENILAI
		$komentarPenilai = '';
		if ($GLOBALS['suf2'] == 'edar') $komentarPenilai = "<td>Komentar Penilai</td>";

		$has = '';
		$has .='<table>';
		if ($ses->action == 'penilai') {
			$has .= '<tr>
                                   <td>No</td>
                                   <td>Nama Kelengkapan</td>
                                   <td>Status Penilai</td>
                                   <td>Komentar Penilai</td>
                                 </tr>';
		} else if ($ses->action == 'kaseksi') {
			// $has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Status Kaseksi</td><td>Komentar Kaseksi</td></tr>';
			$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Status Kaseksi</td><td>Komentar Kaseksi</td></tr>';
		} else if ($ses->action == 'kasubdit') {
			$has .= '<tr><td>No</td><td>Nama Kelengkapan</td>'.$komentarPenilai.
			'<td>Komentar Kaseksi</td><td>Status Kasubdit</td><td>Komentar Kasubdit</td></tr>';
		} else if ($ses->action == 'direktur') {
			$has .= '<tr><td>No</td><td>Nama Kelengkapan</td>'.$komentarPenilai.
			'<td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Status Direktur</td>'.
			'<td>Komentar Direktur</td></tr>';
		} else if ($ses->action == 'admin') {
			$has .= '<tr><td>No</td><td>Nama Kelengkapan</td>'.$komentarPenilai.
			'<td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Komentar Direktur</td></tr>';
		}

		global $adodb;
		$sqlx = "SELECT id_kelengkapan,nama_kelengkapan FROM ".$GLOBALS[my_kelengkapan]." kelengkapan ORDER BY id_kelengkapan";
		$rsx = $adodb->Execute($sqlx);
		$a=1;
		while(! $rsx->EOF){
			if($_GET['id_cek_1']){
				$sqld = "SELECT id_cek_1,id_kelengkapan,status_penilai,status_kaseksi,status_kasubdit,status_direktur,alasan_penilai,alasan_kaseksi,alasan_kasubdit,alasan_direktur FROM ".$GLOBALS[my_detail]." detail_cek WHERE id_cek_1='".$_GET['id_cek_1']."' AND id_kelengkapan='".$rsx->fields['id_kelengkapan']."'";
				$rsd = $adodb->Execute($sqld);
				$id_cek_1x = $rsd->fields['id_cek_1'];
				$id_kelengkapanx = $rsd->fields['id_kelengkapan'];
				$status_penilaix = $rsd->fields['status_penilai'];
				$status_kaseksix = $rsd->fields['status_kaseksi'];
				$status_kasubditx = $rsd->fields['status_kasubdit'];
				$status_direkturx = $rsd->fields['status_direktur'];
				$alasan_penilaix = $rsd->fields['alasan_penilai'];
				$alasan_kaseksix = $rsd->fields['alasan_kaseksi'];
				$alasan_kasubditx = $rsd->fields['alasan_kasubdit'];
				$alasan_direkturx = $rsd->fields['alasan_direktur'];
				if($id_kelengkapanx == $rsx->fields['id_kelengkapan']) {
					if($status_penilaix == "1"){$check1 = "checked";$text1='Ada';}else{$check1 = "";$text1='Tidak';}
					if($status_kaseksix == "1"){$check2 = "checked";$text2='Ada';}else{$check2 = "";$text2='Tidak';}
					if($status_kasubditx == "1"){$check3 = "checked";$text3='Ada';}else{$check3 = "";$text3='Tidak';}
					if($status_direkturx == "1"){$check4 = "checked";$text4='Ada';}else{$check4 = "";$text4='Tidak';}
				}
			}

			$id_kelengkapan = $rsx->fields['id_kelengkapan'];
			$nama_kelengkapan = $rsx->fields['nama_kelengkapan'];
			$has .= "<tr><td>".$a."<input type=hidden name=id_kelengkapan[".$a."] value='".$id_kelengkapan."'></td><td>".$nama_kelengkapan."</td>";

			## KOMENTAR PENILAI
			$komentarPenilai = '';
			if ($GLOBALS['suf2'] == 'edar') {
				if ($check1 == "checked") { 
					$komentarPenilai = "<td valign=top>".
					"<input type=hidden name=status_penilaix[".$a."] ".
					" value='".$status_penilaix."'>".$text1.",<br>".
					"<input type=hidden name=alasan_penilaix[".$a."] ".
					" value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";
				} else { 
					$komentarPenilai .= "<td valign=top>".
					"<input type=hidden name=alasan_penilaix[".$a."] ".
					" value='".$alasan_penilaix."'>".$text1.",<br>".
					" ".$alasan_penilaix."</td>";
				}
			}

			/*
			 * COMMENT GIVEN BY : 566
			 *
			 * BELOW FOR CONTENT "kelengkapan"
			 */
			if($ses->action == 'penilai'){
				$has .= "
				<td valign=top>
				<input type=checkbox name=status_penilaix[".$a."] value=1 class=text ".$check1.">
				</td>
				<td valign=top>
				<textarea name=alasan_penilaix[".$a."] class='text'>".
				$alasan_penilaix."</textarea>
				</td>
				<input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>
				<input type=hidden name=alasan_kaseksix[".$a."] value='".$alasan_kaseksix."'>
				<input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>
				<input type=hidden name=alasan_kasubditx[".$a."] value='".$alasan_kasubditx."'>
				<input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>
				<input type=hidden name=alasan_direkturx[".$a."] value='".$alasan_direkturx."'>
				";
			} else if ($ses->action == 'kaseksi'){
				$has .= $komentarPenilai;
				/*
				$has .= "<td valign=top>
				           &nbsp;$alasan_penilaix
				         </td>
				*/
				$has .= "<td valign=top>".
				/*
				 * MODIFIED BY : 566
				 *
				 * BEFORE :
				 * <input type=checkbox name=status_kaseksix[".$a."] value=1 class=text ".$check2.">
				 *
				 * AFTER :
				 */
					"<input type=checkbox name=status_penilaix[".$a."] value=1 class=text ".$check1.">
				         </td>
				         <td valign=top>
                       		           <textarea name=alasan_kaseksix[".$a."] class='text'>".$alasan_kaseksix."</textarea>
					   <input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>
					   <input type=hidden name=alasan_kasubditx[".$a."] value='".$alasan_kasubditx."'>
					   <input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>
					   <input type=hidden name=alasan_direkturx[".$a."] value='".$alasan_direkturx."'>
					 </td>";
			} else if ($ses->action == 'kasubdit'){
				$has .= $komentarPenilai;
				if ($check2 == "checked") { 
					$has .= "<td valign=top>
					<input type=hidden name=status_kaseksix[".$a."] value='".
					$status_kaseksix."'>".$text2.",<br>
					<input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".
					$alasan_kaseksix."'>".$alasan_kaseksix."
					</td>";
				} else { 
					$has .= "<td valign=top>
					<input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".
					$alasan_kaseksix."'>".$text2.",<br>".$alasan_kaseksix."
					</td>";
				}

				$has .= "<td valign=top>
				<input type=checkbox name=status_penilaix[".$a."] value=1 class=text ".$check1.">
				</td>
				<td valign=top>
				<textarea name=alasan_kasubditx[".$a."] class='text'>".
				$alasan_kasubditx."</textarea>
				<input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>
				<input type=hidden name=alasan_direkturx[".$a."] value='".$alasan_direkturx."'>
				</td>";
			} else if ($ses->action == 'direktur') {
				$has .= $komentarPenilai;
				if ($check2 == "checked") { 
					$has .= "<td valign=top>
					<input type=hidden name=status_kaseksix[".$a."] value='".
					$status_kaseksix."'>".$text2.",<br>
					<input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".
					$alasan_kaseksix."'>".$alasan_kaseksix."
					</td>";
				} else { 
					$has .= "<td valign=top>
					<input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".
					$alasan_kaseksix."'>".$text2.",<br>".$alasan_kaseksix."
					</td>";
				}
				if ($check3 == "checked") { 
					$has .= "<td valign=top>
					<input type=hidden name=status_kasubditx[".$a."] value='".
					$status_kasubditx."'>".$text3.",<br>
					<input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".
					$alasan_kasubditx."'>".$alasan_kasubditx."
					</td>";
				} else { 
					$has .= "<td valign=top>
					<input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".
					$alasan_kasubditx."'>".$text3.",<br>".$alasan_kasubditx."
					</td>";
				}

				$has .= "<td valign=top>
				<input type=checkbox name=status_direkturx[".$a."] value=1 class=text ".$check4.">
				</td>
				<td valign=top>
				<textarea name=alasan_direkturx[".$a."] class='text'>".
				$alasan_direkturx."</textarea></td></tr>";
			} else if ($ses->action == 'admin') {
				$has .= $komentarPenilai;
				if ($check2 == "checked") { 
					$has .= "<td valign=top>
					<input type=hidden name=status_kaseksix[".$a."] value='".
					$status_kaseksix."'>".$text2.",<br>
					<input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".
					$alasan_kaseksix."'>".$alasan_kaseksix."
					</td>";
				} else { 
					$has .= "<td valign=top>
					<input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".
					$alasan_kaseksix."'>".$text2.",<br>".$alasan_kaseksix."
					</td>";
				}
				if ($check3 == "checked") { 
					$has .= "<td valign=top>
					<input type=hidden name=status_kasubditx[".$a."] value='".
					$status_kasubditx."'>".$text3.",<br>
					<input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".
					$alasan_kasubditx."'>".$alasan_kasubditx."
					</td>";
				} else { 
					$has .= "<td valign=top>
					<input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".
					$alasan_kasubditx."'>".$text3.",<br>".$alasan_kasubditx."
					</td>";
				}
				if ($check4 == "checked") {
					$has .= "<td valign=top>
					<input type=hidden name=status_direkturx[".$a."] value='".
					$status_direkturx."'>".$text4.",<br>
					<input type=hidden name=alasan_direkturx[".$a."] class='text' value='".
					$alasan_direkturx."'>".$alasan_direkturx."
					</td>";
				} else { 
					$has .= "<td valign=top>
					<input type=hidden name=alasan_direkturx[".$a."] class='text' value='".
					$alasan_direkturx."'>".$text4.",<br>".$alasan_direkturx."
					</td>";
				}
			}

			$a=$a+1;
			$rsx->MoveNext();
		}
		$has .= '</tr></table>';
		

		$optional_arr['kelengkapan']='user_defined';
		$label_arr['kelengkapan']='Kelengkapan';
		$value_arr['kelengkapan'] = $has;

		$this -> slip_field($config,'alamat','after','no_tt');
		$this -> slip_field($config,'propinsi','after','alamat');

		$optional_arr['id_golongan'] = 'user_defined';

		list($suf1, $suf2, $suf3) = split(" ", strtolower($GLOBALS[my_title]));
		if ($suf2 != 'penyalur') {
	                $arr = array();
        	        $arr['name'] = 'id_golongan';
                	$arr['selected'] = $value_arr['id_golongan'];
	                $arr['sql'] = 'SELECT id_golongan as val, golongan as txt FROM '.$GLOBALS[my_kelas].' kelas ORDER BY txt';
                	$value_arr['id_golongan'] = xform::dbs($arr);
		} else {
			$optional_arr[id_golongan] = TRUE;
		}

		$label_arr['nama_produk'] = 'Nama Produk';

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_cek_1']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Cek Kelengkapan ".$GLOBALS[my_title];
		$label_arr['form_width'] = '100%';
		$label_arr['form_name'] = 'theform';

		$_form = new form();
		$_form->set_config(
			array (
				'field_arr'	=> $field_arr,
				'label_arr'	=> $label_arr,
				'value_arr'	=> $value_arr,
				'optional_arr'	=> $optional_arr
			)
		);
		
		return $_form->parse_field();
	}

	// create update cek form
	function update_cek_form() {
		return $this->add_cek_form();
	}

	function view_cek_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		#$field_arr = cek::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_cek_1'] = 'protect';

		$record = array (
			'id_cek_1' => ${$GLOBALS['get_vars']}['id_cek_1']
		);
		#$result = cek::get($record);
		#$value_arr = $result[0];
		$value_arr = $record;
		$label_arr = $this->cek_label;
		global $adodb;

		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'KELENGKAPAN IZIN ALKES','',0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$sqlA = "SELECT
		date_bap,
		date_rekomendasi,
		id_cek_1,
		no_tt,
		no_rekomendasi,
		id_golongan,
		no_bap,
		no_pemohon,
		date_pemohon,
		nama_produk,
		id_golongan as golongan,
		CASE WHEN status_penilai ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_penilai,
		nama_penilai,
		date_1,
		CASE WHEN status_kaseksi ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_kaseksi,
		nama_kaseksi,
		date_2,
		CASE WHEN status_kasubdit ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_kasubdit,
		nama_kasubdit,
		date_3,
		CASE WHEN status_direktur ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_direktur,
		nama_direktur,
		date_4,
		keterangan,
		insert_by,
		date_insert,
		no_sk_lama,
		date_sk_lama,
		lisensi,
		lisensi2,
		nama_produk2,
		lisensi3,
		nama_produk3,
		lisensi4,
		nama_produk4,
		lisensi5,
		nama_produk5
		FROM ".$GLOBALS[my_table]." cek
		WHERE
		id_cek_1 ='".$value_arr['id_cek_1']."'
		";
		$hasil=$adodb->Execute($sqlA);
		while(! $hasil->EOF){
			foreach ($hasil->fields as $key => $val) {
				if (ereg('date_', $key)) 
					if ($val>0) $hasil->fields[$key] = date('d/m/Y', $val);
					else $hasil->fields[$key] = ' ';
			}
#print_r($hasil);
			$id_cek_1 = $hasil->fields['id_cek_1'];
			$no_tt = $hasil->fields['no_tt'];
			$no_rekomendasi = $hasil->fields['no_rekomendasi'];
			$date_rekomendasi = $hasil->fields['date_rekomendasi'];
			$no_bap = $hasil->fields['no_bap'];
			$date_bap = $hasil->fields['date_bap'];
			$no_pemohon = $hasil->fields['no_pemohon'];
			$date_pemohon = $hasil->fields['date_pemohon'];
			$no_pemohon = $hasil->fields['no_pemohon'];
			$date_pemohon = $hasil->fields['date_pemohon'];
			$id_golongan = $hasil->fields['id_golongan'];
			$nama_produk = $hasil->fields['nama_produk'];
			$status_penilai = $hasil->fields['status_penilai'];
			$nama_penilai = $hasil->fields['nama_penilai'];
			$status_kaseksi = $hasil->fields['status_kaseksi'];
			$nama_kaseksi = $hasil->fields['nama_kaseksi'];
			$status_kasubdit = $hasil->fields['status_kasubdit'];
			$nama_kasubdit = $hasil->fields['nama_kasubdit'];
			$status_direktur = $hasil->fields['status_direktur'];
			$nama_direktur = $hasil->fields['nama_direktur'];
			$keterangan = $hasil->fields['keterangan'];
			$no_sk_lama = $hasil->fields[no_sk_lama];
			$date_sk_lama = $hasil->fields[date_sk_lama];
			$tgl1 = $hasil->fields[date_1];
			$tgl2 = $hasil->fields[date_2];
			$tgl3 = $hasil->fields[date_3];
			$tgl4 = $hasil->fields[date_4];
			$lisensi = ucwords(strtolower($hasil->fields[lisensi]));
			$nama_produk = ucwords(strtolower($hasil->fields[nama_produk]));
			$lisensi2 = ucwords(strtolower($hasil->fields[lisensi2]));
			$nama_produk2 = ucwords(strtolower($hasil->fields[nama_produk2]));
			$lisensi3 = ucwords(strtolower($hasil->fields[lisensi3]));
			$nama_produk3 = ucwords(strtolower($hasil->fields[nama_produk3]));
			$lisensi4 = ucwords(strtolower($hasil->fields[lisensi4]));
			$nama_produk4 = ucwords(strtolower($hasil->fields[nama_produk4]));
			$lisensi5 = ucwords(strtolower($hasil->fields[lisensi5]));
			$nama_produk5 = ucwords(strtolower($hasil->fields[nama_produk5]));

			$sqlB = "
			SELECT
			tt.urut_no_tt,
			pendaftar.alamat_pabrik,
			pendaftar.nama_pabrik
			FROM
			".$GLOBALS[my_pendaftar]." pendaftar
			LEFT OUTER JOIN ".$GLOBALS[my_tt]." tt ON (tt.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit = tt.kode_subdit)
			WHERE tt.no_tt ='".$no_tt."'
			";

			$hasilB = $adodb->Execute($sqlB);
			$alamat_pabrik = $hasilB->fields['alamat_pabrik'];
			$urut_no_tt = $hasilB->fields['urut_no_tt'];

			$sqlG = "
			SELECT
			golongan
			FROM
			".$GLOBALS[my_kelas]." kelas
			WHERE id_golongan ='".$id_golongan."'";
			$hasilG = $adodb->Execute($sqlG);
			$golongan = $hasilG->fields['golongan'];


			$sqlC = "
			SELECT
			subdit.subdit
			FROM
			".$GLOBALS[my_pendaftar]." pendaftar
			LEFT OUTER JOIN ".$GLOBALS[my_tt]." tt ON (tt.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt.kode_subdit)
			WHERE tt.no_tt ='".$no_tt."'";
			$hasilC = $adodb->Execute($sqlC);
			$subdit = $hasilC->fields['subdit'];

			$sqlP = "
			SELECT
			pendaftar.nama_pabrik
			FROM
			".$GLOBALS[my_pendaftar]." pendaftar
			LEFT OUTER JOIN ".$GLOBALS[my_tt]." tt ON (tt.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON (subdit.id_subdit=tt.kode_subdit)
			WHERE tt.no_tt ='".$no_tt."'";
			$hasilP = $adodb->Execute($sqlP);
			$nama_pabrik = $hasilP->fields['nama_pabrik'];

			$pdf->Cell(50,7,'No Tanda Terima','',0,'L');$pdf->Cell(50,7,': '.$urut_no_tt.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Nama Pabrik','',0,'L');$pdf->Cell(50,7,': '.$nama_pabrik.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Alamat Pabrik'.$nama_direktur.'','',0,'L');$pdf->Cell(50,7,': '.$alamat_pabrik.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Subdit ','',0,'L');$pdf->Cell(50,7,': '.$subdit.'','',0,'L');
			$pdf->Ln(5);
			
			$pdf->Cell(50,7,'No Pemohon','',0,'L');$pdf->Cell(50,7,': '.$no_pemohon.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Tanggal Pemohon','',0,'L');$pdf->Cell(50,7,': '.$date_pemohon.'','',0,'L');
			$pdf->Ln(5);
			
			list($suf1, $suf2, $suf3) = split(" ", strtolower($GLOBALS[my_title]));
			
			if ($suf1 == 'registrasi') {
				$pdf->Cell(50,7,'No Rekomendasi','',0,'L');$pdf->Cell(50,7,': '.$no_rekomendasi.'','',0,'L');
				$pdf->Ln(5);
				$pdf->Cell(50,7,'Tanggal Rekomendasi','',0,'L');$pdf->Cell(50,7,': '.$date_rekomendasi.'','',0,'L');
				$pdf->Ln(5);
				$pdf->Cell(50,7,'No BAP','',0,'L');$pdf->Cell(50,7,': '.$no_bap.'','',0,'L');
				$pdf->Ln(5);
				$pdf->Cell(50,7,'Tanggal BAP','',0,'L');$pdf->Cell(50,7,': '.$date_bap.'','',0,'L');
				$pdf->Ln(5);
			} else {
				$pdf->Cell(50,7,'No Keputusan Lama','',0,'L');$pdf->Cell(50,7,': '.$no_sk_lama.'','',0,'L');
				$pdf->Ln(5);
				$pdf->Cell(50,7,'Tanggal Keputusan Lama','',0,'L');$pdf->Cell(50,7,': '.$date_sk_lama.'','',0,'L');
				$pdf->Ln(5);
			
			}

			if ($suf2 == 'penyalur') {
				$pdf->Cell(50,7,'Lisensi','',0,'L');$pdf->Cell(50,7,': '.$lisensi.'','',0,'L');
				$pdf->Ln(5);
			}

			$pnama_produk = explode("\n", $nama_produk);
			$ii = 0;
			foreach ($pnama_produk as $key => $val) {
				#if ($ii==0) $title = 'Jenis Produksi Alkes';
				#if (eregi('registrasi produksi', $GLOBALS[my_title])) {
				if ($ii==0) $title = 'Nama Produk';
				#}
				else $title = ' ';
				if (trim($title)) $titik2 = ': ';
				else $titik2 = '  ';
				$pdf->Cell(50,7,$title,'',0,'L');$pdf->Cell(50,7,$titik2.$val.'','',0,'L');
				$pdf->Ln(5);
				$ii++;
			}
			
			if ($suf2 == 'penyalur') {
				if ($lisensi2 || $nama_produk2) {
				$pdf->Cell(50,7,'Lisensi (2)','',0,'L');$pdf->Cell(50,7,': '.$lisensi2.'','',0,'L');
				$pdf->Ln(5);
				$pnama_produk = explode("\n", $nama_produk2);
				$ii = 0;
				foreach ($pnama_produk as $key => $val) {
					if ($ii==0) $title = 'Nama Produk (2)';
					else $title = ' ';
					if (trim($title)) $titik2 = ': ';
					else $titik2 = '  ';
					$pdf->Cell(50,7,$title,'',0,'L');$pdf->Cell(50,7,$titik2.$val.'','',0,'L');
					$pdf->Ln(5);
					$ii++;
				}
				}
				if ($lisensi3 || $nama_produk3) {
				$pdf->Cell(50,7,'Lisensi (3)','',0,'L');$pdf->Cell(50,7,': '.$lisensi3.'','',0,'L');
				$pdf->Ln(5);
				$pnama_produk = explode("\n", $nama_produk3);
				$ii = 0;
				foreach ($pnama_produk as $key => $val) {
					if ($ii==0) $title = 'Nama Produk (3)';
					else $title = ' ';
					if (trim($title)) $titik2 = ': ';
					else $titik2 = '  ';
					$pdf->Cell(50,7,$title,'',0,'L');$pdf->Cell(50,7,$titik2.$val.'','',0,'L');
					$pdf->Ln(5);
					$ii++;
				}
				}
				if ($lisensi4 || $nama_produk4) {
				$pdf->Cell(50,7,'Lisensi (4)','',0,'L');$pdf->Cell(50,7,': '.$lisensi4.'','',0,'L');
				$pdf->Ln(5);
				$pnama_produk = explode("\n", $nama_produk4);
				$ii = 0;
				foreach ($pnama_produk as $key => $val) {
					if ($ii==0) $title = 'Nama Produk (4)';
					else $title = ' ';
					if (trim($title)) $titik2 = ': ';
					else $titik2 = '  ';
					$pdf->Cell(50,7,$title,'',0,'L');$pdf->Cell(50,7,$titik2.$val.'','',0,'L');
					$pdf->Ln(5);
					$ii++;
				}
				}
				if ($lisensi5 || $nama_produk5) {
				$pdf->Cell(50,7,'Lisensi (5)','',0,'L');$pdf->Cell(50,7,': '.$lisensi5.'','',0,'L');
				$pdf->Ln(5);
				$pnama_produk = explode("\n", $nama_produk5);
				$ii = 0;
				foreach ($pnama_produk as $key => $val) {
					if ($ii==0) $title = 'Nama Produk (5)';
					else $title = ' ';
					if (trim($title)) $titik2 = ': ';
					else $titik2 = '  ';
					$pdf->Cell(50,7,$title,'',0,'L');$pdf->Cell(50,7,$titik2.$val.'','',0,'L');
					$pdf->Ln(5);
					$ii++;
				}
				}
			}
			
			#$pdf->Ln(5);
			$pdf->SetFont('Arial','B',11);
			$pdf->Ln(5);
			$pdf->Cell(6,7,'No','LRT',0,'L');
			
			if ($GLOBALS['suf2'] == 'edar') {
				$pdf->Cell(35,7,'Nama','LRT',0,'C');
				$pdf->Cell(35,7,'Status','LRT',0,'C');
			} else {
				$pdf->Cell(70,7,'Nama','LRT',0,'C');
			}
			
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Ln();
			
			$pdf->Cell(6,7,'','LRB',0,'L');

			if ($GLOBALS['suf2'] == 'edar') {
				$pdf->Cell(35,7,'Kelengkapan','LRB',0,'C');
				$pdf->Cell(35,7,'Penilai','LRB',0,'C');
			} else {
				$pdf->Cell(70,7,'Kelengkapan','LRB',0,'C');
			}

			$pdf->Cell(35,7,'Kaseksi','LRB',0,'C');
			$pdf->Cell(35,7,'Kasubdit','LRB',0,'C');
			$pdf->Cell(35,7,'Direktur','LRB',0,'C');
			$pdf->Ln();
			$sqlD = "
			SELECT
			kelengkapan.nama_kelengkapan,
			CASE WHEN detail.status_penilai ='1' THEN 'Ada' else 'Tidak' END AS status_penilai,
			detail.alasan_penilai,
			CASE WHEN detail.status_kaseksi ='1' THEN 'Ada' else 'Tidak' END AS status_kaseksi,
			detail.alasan_kaseksi,
			CASE WHEN detail.status_kasubdit ='1' THEN 'Ada' else 'Tidak' END AS status_kasubdit,
			detail.alasan_kasubdit,
			CASE WHEN detail.status_direktur ='1' THEN 'Ada' else 'Tidak' END AS status_direktur,
			detail.alasan_direktur
			FROM
			".$GLOBALS[my_detail]." detail
			RIGHT OUTER JOIN ".$GLOBALS[my_kelengkapan]." kelengkapan ON (kelengkapan.id_kelengkapan = detail.id_kelengkapan)
			WHERE
			id_cek_1='".$id_cek_1."'
			";

			$hasilD = $adodb->Execute($sqlD);

			$no =1;
			while(! $hasilD->EOF){
				$pdf->Cell(6,3,'','LTR',0,'L');
				
				if ($GLOBALS['suf2'] == 'edar') {
					$pdf->Cell(35,3,'','LTR',0,'L');
					$pdf->Cell(35,3,'','LTR',0,'L');
				} else {
					$pdf->Cell(70,3,'','LTR',0,'L');
				}

				$pdf->Cell(35,3,'','TRL',0,'L');
				$pdf->Cell(35,3,'','LTR',0,'L');
				$pdf->Cell(35,3,'','TRL',0,'L');
				$pdf->Ln();
				$nama_kelengkapan = $hasilD->fields['nama_kelengkapan'];
				$status_penilaix = $hasilD->fields['status_penilai'];
				$alasan_penilaix = $hasilD->fields['alasan_penilai'];
				$status_kaseksix = $hasilD->fields['status_kaseksi'];
				$alasan_kaseksix = $hasilD->fields['alasan_kaseksi'];
				$status_kasubditx = $hasilD->fields['status_kasubdit'];
				$alasan_kasubditx = $hasilD->fields['alasan_kasubdit'];
				$status_direkturx = $hasilD->fields['status_direktur'];
				$alasan_direkturx = $hasilD->fields['alasan_direktur'];
				$pdf->SetFont('Arial','',8);

				if ($GLOBALS['suf2'] == 'edar') {
					$status_penilaix = $status_penilaix.
					", ".str_replace("\n", " ", $alasan_penilaix);
				} else {
					$status_penilaix = '';
				}
				$status_kaseksix = $status_kaseksix.", ".str_replace("\n", " ", $alasan_kaseksix);
				$status_kasubditx = $status_kasubditx.", ".str_replace("\n", " ", $alasan_kasubditx);
				$status_direkturx = $status_direkturx.", ".str_replace("\n", " ", $alasan_direkturx);

				$jml_nama_kelengkapan = strlen($nama_kelengkapan);
				$jml_alasan_penilaix = strlen($status_penilaix);
				$jml_alasan_kaseksix = strlen($status_kaseksix);
				$jml_alasan_kasubditx = strlen($status_kasubditx);
				$jml_alasan_direkturx = strlen($status_direkturx);

				$max = max($jml_nama_kelengkapan,$jml_alasan_penilaix,$jml_alasan_kaseksix,$jml_alasan_kasubditx,$jml_alasan_direkturx);
					
					$maxEdar = 40;
					if ($GLOBALS['suf2'] == 'edar') $maxEdar = 20;

					if ($max<$maxEdar) $x16 = $max;
					else $x16 = $maxEdar;
					
					$jml_hight_arr = explode('.',$max/$x16);
					$jml_hight = $jml_hight_arr[0] * 7;


					for($a=0;$a<=$max;$a=$a+1){
						$g = $a%$x16;
						if(($g == 0)&&($a != 0)){
							$optional_arr['nama_penilai'] = TRUE;
							$optional_arr['date_1'] = TRUE;

							$optional_arr['nama_kaseksi'] = TRUE;
							$optional_arr['date_2'] = TRUE;

							$optional_arr['nama_direktur'] = TRUE;
							$optional_arr['date_4'] = TRUE;
							$optional_arr['status_direktur'] = TRUE;
							$noX=$no;
							if($noX==$noZ){
								$noX='';
							}else{
								$noZ=$noX;
							}

							$nama_kelengkapanY .= $nama_kelengkapan[$a];
							$status_penilaiY .= $status_penilaix[$a];
							$alasan_penilaiY .= $alasan_penilaix[$a];
							$status_kaseksiY .= $status_kaseksix[$a];
							$alasan_kaseksiY .= $alasan_kaseksix[$a];
							$status_kasubditY .= $status_kasubditx[$a];
							$alasan_kasubditY .= $alasan_kasubditx[$a];
							$status_direkturY .= $status_direkturz[$a];
							$alasan_direkturY .= $status_direkturz[$a];

							#if ($a<=$x16) {
							#echo $nama_kelengkapanY."<br>\n";
							$pdf->Cell(6,4,''.$noX.'','LR',0,'L');
							
							if ($GLOBALS['suf2'] == 'edar') {
								$pdf->Cell(35,4,''.$nama_kelengkapanY.'','LR',0,'L');
								$pdf->Cell(35,4,''.$status_penilaiY.'','L',0,'L');
							} else {
								$pdf->Cell(70,4,''.$nama_kelengkapanY.'','LR',0,'L');
							}

							$pdf->Cell(35,4,''.$status_kaseksiY.'','L',0,'L');
							$pdf->Cell(35,4,''.$status_kasubditY.'','LR',0,'L');
							$pdf->Cell(35,4,''.$status_direkturY.'','LR',0,'L');
							$pdf->Ln();
							#} else {
							#if (trim($alasan_penilaiY) && trim($alasan_kaseksiY) && trim($alasan_kasubditY) && trim($alasan_direkturY)) {
							#if ($a>$x16) {
							#$pdf->Cell(6,3,'','LR',0,'L');
							#$pdf->Cell(35,3,'','LR',0,'L');
							#$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
							#$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
							#$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
							#$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');
							#$pdf->Ln();
							#}
							#}
							$noY = '';
							$nama_kelengkapanY = '';
							$status_penilaiY = '';
							$alasan_penilaiY = '';
							$status_kaseksiY = '';
							$alasan_kaseksiY = '';
							$status_kasubditY = '';
							$alasan_kasubditY = '';
							$status_direkturY = '';
							$alasan_direkturY = '';
						}else{
							$noY .= $no[$a];
							$nama_kelengkapanY .= $nama_kelengkapan[$a];
							$status_penilaiY .= $status_penilaix[$a];
							$alasan_penilaiY .= $alasan_penilaix[$a];
							$status_kaseksiY .= $status_kaseksix[$a];
							$alasan_kaseksiY .= $alasan_kaseksix[$a];
							$status_kasubditY .= $status_kasubditx[$a];
							$alasan_kasubditY .= $alasan_kasubditx[$a];
							$status_direkturY .= $status_direkturx[$a];
       							$alasan_direkturY .= $alasan_direkturx[$a];
							$optional_arr['nama_penilai'] = TRUE;
							$optional_arr['date_1'] = TRUE;

							$optional_arr['nama_kaseksi'] = TRUE;
							$optional_arr['date_2'] = TRUE;

							$optional_arr['nama_direktur'] = TRUE;
							$optional_arr['date_4'] = TRUE;
							$optional_arr['status_direktur'] = TRUE;
						}
					}

					$noX=$no;
					if($noX==$noZ){
						$noX='';
					}else{
						$noZ=$noX;
					}

     					#		$pdf->Cell(6,3,''.$noX.'','LR',0,'L');
					#		$pdf->Cell(35,3,''.$nama_kelengkapanY.'','LR',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');

					$noY = '';
					$nama_kelengkapanY = '';
					$status_penilaiY = '';
					$alasan_penilaiY = '';
					$status_kaseksiY = '';
					$alasan_kaseksiY = '';
					$status_kasubditY = '';
					$alasan_kasubditY = '';
					$status_direkturY = '';
					$alasan_direkturY = '';
					#$pdf->Ln();
					$pdf->Cell(6,3,'','LBR',0,'L');
					
					if ($GLOBALS['suf2'] == 'edar') {
						$pdf->Cell(35,3,'','LBR',0,'L');
						$pdf->Cell(35,3,'','LBR',0,'L');
					} else {
						$pdf->Cell(70,3,'','LBR',0,'L');
					}

					$pdf->Cell(35,3,'','BRL',0,'L');
					$pdf->Cell(35,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','BRL',0,'L');
					$pdf->Ln();

				$no = $no+1;
			$hasilD->MoveNext();
			}

		$hasil->MoveNext();
		}
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Golongan','',0,'L');$pdf->Cell(50,7,': '.$golongan.'','',0,'L');
		$pdf->Ln(5);
		
		if ($GLOBALS['suf2'] == 'edar') {
			$pdf->Cell(50,7,'Status Penilai','',0,'L');$pdf->Cell(50,7,': '.$status_penilai.', '.$nama_penilai.', '.$tgl1.'','',0,'L');
			$pdf->Ln(5);
		}

		$pdf->Cell(50,7,'Status kaseksi','',0,'L');$pdf->Cell(50,7,': '.$status_kaseksi.', '.$nama_kaseksi.', '.$tgl2.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Status kasubdit','',0,'L');$pdf->Cell(50,7,': '.$status_kasubdit.', '.$nama_kasubdit.', '.$tgl3.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Status Direktur','',0,'L');$pdf->Cell(50,7,': '.$status_direktur.', '.$nama_direktur.', '.$tgl4.'','',0,'L');
		$pdf->Ln(5);
		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_sk]." sk WHERE id_cek_1='".$_GET[id_cek_1]."'");
		$pdf->Cell(50,7,'No SK','',0,'L');$pdf->Cell(50,7,': '.$rs->fields[no_sk],'',0,'L');
		$pdf->Ln(5);
		if ($suf2 == 'produksi') {
			$pdf->Cell(50,7,'No Izin produksi','',0,'L');$pdf->Cell(50,7,': '.$rs->fields[izin_produksi],'',0,'L');
		}

		$pdf->Output();


		$_form = $lamp;

		return $_form;
	}
	// handle event add cek
	function add_cek() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses, $suf1, $suf2;
#$adodb->debug = 1;	
		// build record
		$record = $_POST;

		if ($record['nott']) $record['no_tt'] = $record['nott'];
//print_r($_POST);exit();
		$record[date_sk_lama] = $this->parsedate(trim($record[date_sk_lama]));
		$record[date_rekomendasi] = $this->parsedate(trim($record[date_rekomendasi]));
		$record[date_pemohon] = $this->parsedate(trim($record[date_pemohon]));
		$record[date_1] = $this->parsedate(trim($record[date_1]));
		$record[date_2] = $this->parsedate(trim($record[date_2]));
		$record[date_3] = $this->parsedate(trim($record[date_3]));
		$record[date_4] = $this->parsedate(trim($record[date_4]));
		$record[date_bap] = $this->parsedate(trim($record[date_bap]));

		/*
		 * ADDED BY : 566
		 *
		 * Below is to process license for "izin penyalur" and to process category for "izin produksi"
		 */
		if ($suf2=="penyalur") {
			/*
			 * Sample pattern
			 *
			 * license #1 = PT. SGG
			 *	Category #1a = 1
			 *	Product #1a  = sgg_101,sgg_102,sgg_103
			 *	Category #2a = 2
			 *	Product #2a  = sgg_201,sgg_202,sgg_203
			 *
			 * license #2 = PT. VW
			 *	Category #1a = 5
			 *	Product #1a  = vw_501,vw_502,vw_503
			 *	Category #2a = 7
			 *	Product #2a  = vw_701,vw_702,vw_703
			 *
			 * It would be :
			 *	PT. SGG==>1===sgg_101,,,sgg_102,,,sgg_103***2===sgg_201,,,sgg_202,,,sgg_203
			 *	+++
			 *	PT. VW==>5===vw_501,,,vw_502,,,vw_503***7===vw_701,,,vw_702,,,vw_703
			 *
			 * Explanation :
			 *	PT. VW==>5===vw_501,,,vw_502,,,vw_503***7===vw_701,,,vw_702,,,vw_703
			 *      |<-->||<-->| |<-->|
			 *     $license  ^  $product
			 *               |
			 *           $category
			 */
			$maximum_license_to_show  = 10;
			$maximum_category_to_show = 17;
			$break_line               = "\r\n";
			$pattern  = "";
			$license  = "";

			for ($i=1;$i<=$maximum_license_to_show;$i++) {
				if ($record['__lisensi_'.$i]!="") {
					$temp_pattern  = "";
					for ($j=1;$j<=$maximum_category_to_show;$j++) {
						if ($record['__lisensi_'.$i.'_nama_produk_'.$j]!="") {
							$product_arr = explode($break_line,$record['__lisensi_'.$i.'_nama_produk_'.$j]);
							$temp_product  = "";
							foreach ($product_arr as $value) {
								if ($value!="") {
									if ($temp_product=="") {
										$temp_product .= $value;
									} else {
										$temp_product .= ",,,".$value;
									}
								}
							}

							if ($temp_pattern=="") {
								$temp_pattern .= $record['__lisensi_'.$i.'_kategori_'.$j]."===".$temp_product;
							} else {
								$temp_pattern .= "***".$record['__lisensi_'.$i.'_kategori_'.$j]."===".$temp_product;
							}
						}
					}
					if ($pattern=="") {
						$pattern .= $record['__lisensi_'.$i]."==>".$temp_pattern;
					} else {
						$pattern .= "+++".$record['__lisensi_'.$i]."==>".$temp_pattern;
					}
				}
			}
			$record['lisensi'] = $pattern;
		} elseif ($suf2=="produksi") {
			$temp_kategori_produk_[] = "";
			$temp_nama_produk_[]     = "";
			for ($i_=1;$i_<=17;$i_++) {
				if ($record['__nama_produk'.$i_]=="") {
					$record['__kategori_produk'.$i_] = NULL;
				} else {
					$temp_kategori_produk_[] = $record['__kategori_produk'.$i_];
					$temp_nama_produk_[]     = $record['__nama_produk'.$i_];
				}
			}

			for ($i_=1;$i_<=17;$i_++) {
				if (isset($temp_kategori_produk_[$i_])) {
					$record['__kategori_produk'.$i_] = $temp_kategori_produk_[$i_];
					$record['__nama_produk'.$i_]     = $temp_nama_produk_[$i_];
				} else {
					$record['__kategori_produk'.$i_] = NULL;
					$record['__nama_produk'.$i_]     = "";
				}
			}
		}

#$adodb->debug = 1;
		
		switch ($ses->action) {
			/*
			 * ADDED BY : 566
			 */
			case 'penilai' : $record[read_penilai]  = ($record[read_penilai]=='on')?'1':'0'; break;
			
			case 'kaseksi' : 
			  /*
			   * ADDED BY : 566
			   */
			  $record[read_penilai]  = ($record[read_penilai]=='on')?'1':'0';

			  $record[read_kaseksi]  = ($record[read_kaseksi]=='on') ?'1':'0'; break;
			case 'admin': 
			case 'kasubdit': 
			  /*
			   * ADDED BY : 566
			   */
			  $record[read_penilai]  = ($record[read_penilai]=='on')?'1':'0';
			  $record[read_kaseksi]  = ($record[read_kaseksi]=='on') ?'1':'0';

			  $record[read_kasubdit] = ($record[read_kasubdit]=='on')?'1':'0'; break;
			case 'direktur': $record[read_direktur] = ($record[read_direktur]=='on')?'1':'0'; break;
		}

		$read_kaseksi = $record[read_kaseksi];
		
		foreach ($record as $k => $v) $record[$k] = trim($v);

		// add record
                $rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." WHERE id_cek_1='".intval($record['oldpkvalue'])."'");
                if ($rs && ! $rs->EOF) {
                        $adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
                        $st = "Updated";
                } else {
			if (!isset($record[read_kaseksi])) $record[read_kaseksi] = '0';
			if (!isset($record[read_kasubdit])) $record[read_kasubdit] = '0';
			if (!isset($record[read_direktur])) $record[read_direktur] = '0';
                        $record['insert_by'] = $ses->loginid;
                        $record['date_insert'] = time();
                        $adodb->Execute($adodb->GetInsertSQL($rs, $record));
                        $st = "Added";
                }
		
		// last id
		if ($st == 'Added') {
			$rsx = $adodb->Execute("SELECT currval('".$GLOBALS[my_table]."_id_cek_1_seq') AS id_cek_1");
			$id_cek_1 = $rsx->fields['id_cek_1'];
		} else {
			$id_cek_1 = $rs->fields[id_cek_1];
		}

//		if ($ses->action=="penilai") {
		$adodb->Execute("DELETE FROM ".$GLOBALS[my_detail]." WHERE id_cek_1='".$id_cek_1."'");
		
		$rsx = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_detail]." LIMIT 1");
		$jml_kelengkapan = count($_POST['id_kelengkapan']);
		for($a=1;$a<=$jml_kelengkapan;$a++){
			$id_kelengkapanx = $_POST['id_kelengkapan'][$a];
			$status_penilaix = $_POST['status_penilaix'][$a];
			$status_kaseksix = $_POST['status_kaseksix'][$a];
			$status_kasubditx = $_POST['status_kasubditx'][$a];
			$status_direkturx = $_POST['status_direkturx'][$a];
			$alasan_penilaix = $_POST['alasan_penilaix'][$a];
			$alasan_kaseksix = $_POST['alasan_kaseksix'][$a];
			$alasan_kasubditx = $_POST['alasan_kasubditx'][$a];
			$alasan_direkturx = $_POST['alasan_direkturx'][$a];

			// build record
			$record = array (
				'id_cek_1' => $id_cek_1,
				'id_kelengkapan' => $id_kelengkapanx,
				'status_penilai' => $status_penilaix,
				'status_kaseksi' => $status_kaseksix,
				'status_kasubdit' => $status_kasubditx,
				'status_direktur' => $status_direkturx,
				'alasan_penilai' => $alasan_penilaix,
				'alasan_kaseksi' => $alasan_kaseksix,
				'alasan_kasubdit' => $alasan_kasubditx,
				'alasan_direktur' => $alasan_direkturx
			);
			
			// add record
			$adodb->Execute($adodb->GetInsertSQL($rsx, $record));
			#detail_cek::add($record);
		}
//		} // end : if ($ses->action=="penilai")

		$rs = $adodb->Execute("SELECT urut_no_tt FROM ".$GLOBALS[my_tt]." WHERE no_tt='".$_POST[no_tt]."'");
		$record[urut_no_tt] = $rs->fields[urut_no_tt];
		$status = "Successfull $st Cek Kelengkapan ".$GLOBALS[my_title]." '<b>{$record['urut_no_tt']}</b>'";
		$this->log($status);

		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return ( $_block->get_str() );
	}

	// handle event update cek
	function update_cek() {
		return $this->add_cek();
	}

	// handle delete cek
	function delete_cek() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['get_vars']}, ${$GLOBALS['post_vars']};

		global $adodb;
		$query = "";
		$query3 = "";
		for ($i=0;$i<count(${$GLOBALS['post_vars']}['pk_str']);$i++) {
			if ($query) $query .= " OR ";
			if ($query3) $query3 .= " OR ";

			$var_pie = explode("&", ${$GLOBALS['post_vars']}['pk_str'][$i]);
			$query2 = "";
			$query4 = "";
			foreach ($var_pie as $key => $value) {
				list($myvar, $myval) = explode("=", $value);
				if ($query2) $query2 .= " AND ";
				$query2 .= "$myvar='".urldecode($myval)."'";
				if ($myvar=='fill_this') {
					if ($query4) $query4 .= " AND ";
					$query4 .= "$myvar='".urldecode($myval)."'";
				}
			}
			if ($query2) $query .= "($query2)";
			if ($query4) $query3 .= "($query4)";
		}

		global $self_close_js;
		if ($query) {
			$rs = $adodb->Execute("SELECT tt.urut_no_tt FROM ".$GLOBALS[my_table]." cek LEFT JOIN ".$GLOBALS[my_tt]." tt USING (no_tt) WHERE $query");
                        while (!$rs->EOF) {
                                if ($msg) $msg .= ", ";
                                $msg .= "'".$rs->fields[urut_no_tt]."'";
                                $rs->MoveNext();
                        }

		        $success = $adodb->Execute("delete from ".$GLOBALS[my_table]." where ".$query);
			$adodb->Execute("delete from ".$GLOBALS[my_detail]." where ".$query);
		}
                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'Cek Kelengkapan '.$GLOBALS[my_title].' <font color=red>'.$msg.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'Cek Kelengkapan '.$GLOBALS[my_title].' <font color=red>'.$msg.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete Cek Kelengkapan '.$GLOBALS[my_title].' Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list cek
	function list_cek($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']},$ses;

		/*
		 * ADDED BY : 566
		 */
		global $suf2;

		$bag = $ses->action;
		$user = $ses->loginid;

		/*
		 * BEGIN : Get License
		 */
		$sql_lic = "SELECT lisensi FROM ".
				$GLOBALS[my_table]." cek
				LEFT JOIN ".$GLOBALS[my_tt]." tt ON (tt.no_tt = cek.no_tt)
				LEFT JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (tt.kode_pendaftar = pendaftar.kode_pendaftar)
				LEFT JOIN subdit ON tt.kode_subdit = subdit.id_subdit ";

		$rs_lic = $adodb->Execute($sql_lic);

		$full_license__ = explode("+++",$rs_lic->fields['lisensi']);
		$default_license_to_show = count($full_license__);

		/*
		 * Set a blank pattern of license for initialization
		 */
		for ($i=1;$i<=$maximum_license_to_show;$i++) {
			$license_pattern['license_'.$i] = "";
		}

		/*
		 * Try to explode and then mapping the pattern of license
		 */
		for ($i=0;$i<$default_license_to_show;$i++) {
			$xplode = explode("==>",$full_license__[$i]);
			$license_pattern['license_'.($i+1)] = $xplode[0];
		}

		$show_license_ = "";
		foreach ($license_pattern as $license_factory) {
			$show_license_ .= ($license_factory!="") ? (($show_license_=="") ? $license_factory : "\n".$license_factory) : "";
		}
		/*
		 * END : Get License
		 */

			#CASE WHEN tt_1_alkes.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
			#ELSE
			#'Izin Produksi PKRT' END as jenis_izin_produksi,
			#cek.no_tt,
			#cek.no_tt as alamat,
			#cek.no_tt as subdit,
			#cek.id_golongan as golongan,
			$sql = "SELECT
			cek.id_cek_1,
			tt.urut_no_tt,
			pendaftar.nama_pabrik,
			pendaftar.alamat_pabrik as alamat,
			subdit.subdit,
			no_pemohon,
			date_pemohon,
			[perubahan]
			[membaca]
			[lisensi1]";

			/*
			 * MODIFICATION BY : 566
			 *
			 * BEFORE :
			 *   cek.nama_produk
			 * AFTER :
			 */
			if ($suf2=="penyalur") {
			  //$sql .= "lisensi, ";
			  $sql .= "'".$show_license_."' AS lisensi,";
			} else {
			  $sql .= "__nama_produk1 || __nama_produk2 ||
				   __nama_produk3 || __nama_produk4 || 
				   __nama_produk5 || __nama_produk6 || 
				   __nama_produk7 || __nama_produk8 || 
				   __nama_produk9 || __nama_produk10 || 
				   __nama_produk11 || __nama_produk12 || 
				   __nama_produk13 || __nama_produk14 || 
				   __nama_produk15 || __nama_produk16 || 
				   __nama_produk17 AS nama_produk, ";
			}

			$sql .= "[lisensi2]
			[kelas1]
			CASE WHEN cek.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek.nama_penilai,
			cek.date_1,
			CASE WHEN cek.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek.nama_kaseksi,
			cek.date_2,
			CASE WHEN cek.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek.nama_kasubdit,
			cek.date_3,
			CASE WHEN cek.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			CASE WHEN cek.read_direktur ='1' THEN 'Read'
					else 'Unread'
			END AS read_direktur,
			cek.nama_direktur,
			cek.date_4,
			cek.keterangan,
			cek.insert_by,
			cek.date_insert,".

			/*
			 * ADDED BY : 566
			 */
			"CASE WHEN cek.indi_penilai='0' THEN 'Return'
			else 'OK' END AS indi_penilai,
			Case WHEN cek.read_penilai='0' THEN 'Unread'
			else 'Read' END AS read_penilai,
			
			CASE WHEN cek.indi_kaseksi='0' THEN 'Return'
			else 'OK' END AS indi_kaseksi,
			Case WHEN cek.read_kaseksi='0' THEN 'Unread'
			else 'Read' END AS read_kaseksi,

			CASE WHEN cek.indi_kasubdit='0' THEN 'Return'
			else 'OK' END AS indi_kasubdit,
			Case WHEN cek.read_kasubdit='0' THEN 'Unread'
			else 'Read' END AS read_kasubdit,
			cek.id_cek_1 as detail
			FROM 
				".$GLOBALS[my_table]." cek
				LEFT JOIN ".$GLOBALS[my_tt]." tt ON (tt.no_tt = cek.no_tt)
				LEFT JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (tt.kode_pendaftar = pendaftar.kode_pendaftar)
				LEFT JOIN subdit ON tt.kode_subdit = subdit.id_subdit ";

			/*
			 * ADDED BY : 566
			 */
			switch ($bag) {
			  case "admin" :
			  case "penilai" :
			  case "kasubdit" :
			    $sql .= "LEFT JOIN kaseksi ON subdit.id_subdit = kaseksi.id_subdit AND cek.nama_kaseksi=kaseksi.userid ";
			    break;
			  default :
			    $sql .= "LEFT JOIN kaseksi ON subdit.id_subdit = kaseksi.id_subdit ";
			}

			$sql .= "	[kelas2]
			[where]
			ORDER BY tt.urut_no_tt DESC
			";

		$label_arr = $this->cek_label;
		
		list($suf1, $suf2, $suf3) = split(" ", strtolower($GLOBALS[my_title]));
		if ($suf1 == 'registrasi') {
			$sql = str_replace('[membaca]', 'no_rekomendasi, date_rekomendasi, no_bap, date_bap, ', $sql);
		} else {
			$sql = str_replace('[membaca]', 'no_sk_lama, date_sk_lama, ', $sql);
					$label_arr[no_sk_lama] = 'Nomor Keputusan Lama';
			$label_arr[date_sk_lama] = 'Tanggal Keputusan Lama';
		}

		if ($suf2 == 'penyalur') {
			$sql = str_replace('[kelas1]', '', $sql);
			$sql = str_replace('[kelas2]', '', $sql);

			/*
			 * MODIFIED BY : 566
			 *
			 * BEFORE :
			 *   $sql = str_replace('[lisensi1]', 'lisensi,', $sql);
			 *   $sql = str_replace('[lisensi2]', 'nama_produk, lisensi2, nama_produk2, lisensi3, nama_produk3, lisensi4, nama_produk4, lisensi5, nama_produk5, ', $sql);
			 *
			 * AFTER :
			 */
			$sql = str_replace('[lisensi1]', '', $sql);
			$sql = str_replace('[lisensi2]', '', $sql);
		} else {
			$sql = str_replace('[kelas1]', 'kelas.golongan,', $sql);
			$sql = str_replace('[kelas2]', "LEFT JOIN ".$GLOBALS[my_kelas]." kelas ON cek.id_golongan = kelas.id_golongan", $sql);
			$sql = str_replace('[lisensi1]', '', $sql);
			$sql = str_replace('[lisensi2]', '', $sql);
				
		}
		if ($suf1 == 'perubahan') {
			$sql = str_replace('[perubahan]', 'cek.perubahan, ', $sql);
		} else {
			$sql = str_replace('[perubahan]', '', $sql);
		}
		$label_arr[perubahan] = 'Detail Perubahan';
	
		switch ($bag) {
			case 'penilai':
			$sql = str_replace('[where]', "WHERE cek.nama_penilai ='' OR cek.nama_penilai = '$user'", $sql);
			
			case 'kaseksi':
			/*
			 * MODIFIED BY : 566
			 *
			 * BEFORE :
			 *   $sql = str_replace('[where]', "WHERE cek.nama_kaseksi ='' OR cek.nama_kaseksi = '$user'", $sql);
			 *   break;
			 *
			 * AFTER :
			 */
			$sql = str_replace('[where]', "WHERE kaseksi.userid ='' OR kaseksi.userid = '$user'", $sql);
			break;

			case 'kasubdit':
			$sql = str_replace('[where]', "WHERE cek.nama_kasubdit ='' OR cek.nama_kasubdit = '$user'", $sql);
			break;
			
			case 'direktur':
			$sql = str_replace('[where]', "WHERE cek.nama_direktur ='' OR cek.nama_direktur = '$user' ", $sql);
			break;

			case 'admin':
			$sql = str_replace('[where]', "", $sql);
			break;

		}

		//print $sql;
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;
		$optional_arr['detail'] = FALSE;

		$vsel_arr = array (
			'id_cek_1' => TRUE,
			'name' => TRUE,
			'detail' => FALSE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();

		switch ($bag) {
			case 'penilai':
			$eval_arr['urut_no_tt'] = '
			if ($prs->fields[read_penilai] == "Read"){
				if ($prs->fields[indi_penilai] == "Return"){
					$str .="<div align=center><font color=blue>&nbsp;%s</font></div>";
				} else {
					$str .="<div align=center>&nbsp;%s</div>";
				}
			} else {
				$str .="<div align=center><font color=red>&nbsp;%s</font></div>";
			}
			';
			break;

			case 'kaseksi':
			$eval_arr['urut_no_tt'] = '
			if ($prs->fields[read_kaseksi] == "Read"){
				if ($prs->fields[indi_kaseksi] == "Return"){
					$str .="<div align=center><font color=blue>&nbsp;%s</font></div>";
				} else {
					$str .="<div align=center>&nbsp;%s</div>";
				}
			} else {
				$str .="<div align=center><font color=red>&nbsp;%s</font></div>";
			}
			';
			break;

			case 'kasubdit':
			$eval_arr['urut_no_tt'] = '
			if ($prs->fields[read_kasubdit] == "Read"){
				if ($prs->fields[indi_kasubdit] == "Return"){
					$str .="<div align=center><font color=blue>&nbsp;%s</font></div>";
				} else {
					$str .="<div align=center>&nbsp;%s</div>";
				}
			} else {
				$str .="<div align=center><font color=red>&nbsp;%s</font></div>";
			}
			';
			break;	
			
			case 'direktur':
			//	print $sql;
			$eval_arr['urut_no_tt'] = '
			if ($prs->fields[read_direktur] == "Read"){
				if ($prs->fields[indi_direktur] == "Return"){
					$str .="<div align=center><font color=blue>&nbsp;%s</font></div>";
				} else {
					$str .="<div align=center>&nbsp;%s</div>";
				}
			} else {
				$str .="<div align=center><font color=red>&nbsp;%s</font></div>";
			}
			';
			break;
		}

		$eval_arr['detail'] = '
		$USql = "
			SELECT
			kelengkapan_alkes.nama_kelengkapan,
			CASE WHEN detail_cek.status_penilai =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_penilai,
			detail_cek.alasan_penilai,
			CASE WHEN detail_cek.status_kaseksi =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kaseksi,
			detail_cek.alasan_kaseksi,
			CASE WHEN detail_cek.status_kasubdit =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kasubdit,
			detail_cek.alasan_kasubdit,
			CASE WHEN detail_cek.status_direktur =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_direktur,
			detail_cek.alasan_direktur
			FROM
			detail_cek
			LEFT OUTER JOIN kelengkapan_alkes ON(kelengkapan_alkes.id_kelengkapan = detail_cek.id_kelengkapan)
			WHERE
			id_cek_1=\'%s\' AND detail_cek.alasan_kaseksi IS NOT NULL
			";
			global $adodb;

      			$str .="<table cellspacing=1 cellpadding=1><tr align=center class=title_table><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Kelengkapan</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Penilai</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Penilai</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Kaseksi</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Kaseksi</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Kasubdit</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Kasubdit</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Direktur</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Direktur</b></td></tr>";
			$S = $adodb->Execute($USql);
			$c =0;
			while(! $S->EOF){
			$c= $c+1;
			$FA = $S->fields[\'nama_kelengkapan\'];
			$FB = $S->fields[\'status_penilai\'];
			$FC = $S->fields[\'alasan_penilai\'];
			$FD = $S->fields[\'status_kaseksi\'];
			$FE = $S->fields[\'alasan_kaseksi\'];
			$FF = $S->fields[\'status_kasubdit\'];
			$FG = $S->fields[\'alasan_kasubdit\'];
			$FH = $S->fields[\'status_direktur\'];
			$FI = $S->fields[\'alasan_direktur\'];

   			$str .= "<tr><td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$c.".".$FA."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FB."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FC."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FD."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FE."</td>";
			$str .= "<td style=\'border-width:1px;boder-style:solid;border-color:#000000\'>&nbsp;".$FF."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FG."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FH."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FI."</td></tr>";
			$S->MoveNext();
			}
   		$str .="</table>";
		';

		$pk = array (
			'id_cek_1' => TRUE
		);
//		if ($this->get_permission('fill_this')) {

		/*
		 * MODIFIED BY : 566
		 *
  		 * BEFORE :
		 *   if($bag=='kaseksi' || ($bag == 'penilai' && $GLOBALS['suf2'] == 'edar')) { # || $bag=='admin'){
		 *
		 * AFTER :
		 */
  		if($bag == 'penilai') {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 800, 600, null, null, \'add_cek\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
		}

//		}
//		if ($this->get_permission('fill_this')) {

			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 800, 600, null, null, \'edit_cek\');'.
			'win.focus()',
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));

			$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'location.href=\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\';'.
			'',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {

			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' .
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_cek\')'.
			'win.focus()):' .
			'alert(\''.__('Cancelling Delete').'\');',
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_cek\');'.
			'win.focus()',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$config = array (
			'id'		=> 'cek',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> "<nobr>".$edit_anchor." ".$view_anchor."</nobr>",
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Cek Kelengkapan '.$GLOBALS[my_title].' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print cek
	function print_cek() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_cek($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$cek_controller = new cek_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_controller->add_cek_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $cek_controller->add_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangeno_tt();"';
			$out_content = $cek_controller->update_cek_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $cek_controller->update_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $cek_controller->view_cek_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $cek_controller->delete_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_controller->import_cek_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $cek_controller->import_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $cek_controller->print_cek();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $cek_controller->list_cek();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Cek Kelengkapan '.$GLOBALS[my_title].' Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

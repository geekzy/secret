<?php
/* vim: set ai tabstop=8 nowrap: */
    
//ini_set('max_execution_time', 360);

//srand((double)microtime()*1000000);
//if (rand(0,1)) exit;

//srand((double)microtime()*1000000);
//sleep(rand(0,300));

// include library support
//include 'class.http_mini_navigator.php';

require_once('http_navigator/User_Agent.php');
require_once('http_navigator/Cookie_Jar.php');
Protocol::implementor('HTTP', 'Protocol_HTTP');
#Debug::level(DEBUG_OUTPUT_LINE);
class http_navigator extends User_Agent {
	var $ua;
	var $rs;
	function http_navigator() {
	$options = array(
    'protocols_allowed' => array('HTTP'),
    'cookie_jar'        => true,
    'keep_alive'        => 0,
    'timeout'           => 5,
    'timeout_rw'        => 10,
    'requests_redirectable' => array('GET', 'HEAD', 'POST')
    );
$this->ua = new User_Agent($options);
	}
	function get_url($url) {
		$this->rs = $this->ua->get($url);
	}
	function get_body() {
		return $this->rs->get_body();
	}
	function post_url($data, $url) {
		$pd = explode('&', $data);
		$data = array();
		foreach ($pd as $pl) {
			$pp = explode('=', $pl);
			$data[$pp[0]] = $pp[1];
		}
		print_r($data);
		$this->rs = $this->ua->post($url, $data);
	}
}
include 'class.kurusetra_code.php';

if (! function_exists('getmicrotime')) {
// get time precision micro
function getmicrotime(){
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}
} // end of getmicrotime

if (! defined('CLASS_KURUSETRA')) {
    define('CLASS_KURUSETRA', TRUE);



class kurusetra {
	var $tkuru;
	var $skuru;
	var $lstat;
	var $rstat;
	var $pstat;
	var $tstat;
	var $sstat;
	var $estat; // explore
	var $astat; // army
	var $fstat; // fire
	var $bstat; // building
	var $kuru ;
	var $kode;
	var $http;
	var $raja_arr;
	var $musuh_arr;
	var $mahameru_arr;
	var $dr_raja_arr;
	var $ignore_arr;
	var $load_var;
	var $time_start;
	var $time_stop;
	var $total_start;
	var $total_stop;

	function kurusetra() {
		$this->init();
		eval($this->load_var);
		$this->total_start = $this->getmicrotime();
		$kode = new kurusetra_code();
		$http = new http_navigator();
	}
	// get time precision micro
	function getmicrotime(){
		return getmicrotime();
	}
	// initialize variable
	function init() {
		$this->load_var = ''.
		'		$tkuru =& $this->tkuru;'.
		'		$skuru =& $this->skuru;'.
		'		$lstat =& $this->lstat;'.
		'		$rstat =& $this->rstat;'.
		'		$pstat =& $this->pstat;'.
		'		$tstat =& $this->tstat;'.
		'		$sstat =& $this->sstat;'.
		'		$estat =& $this->estat;'.
		'		$astat =& $this->astat;'.
		'		$fstat =& $this->fstat;'.
		'		$bstat =& $this->bstat;'.
		'		$kuru =& $this->kuru;'.
		'		$kode =& $this->kode;'.
		'		$http =& $this->http;'.
		'		$raja_arr =& $this->raja_arr;'.
		'		$musuh_arr =& $this->musuh_arr;'.
		'		$mahameru_arr =& $this->mahameru_arr;'.
		'		$dr_raja_arr =& $this->dr_raja_arr;'.
		'		';
		$this->time_start = ''.
		'		$start_time = getmicrotime();'.
		'		';
		$this->time_stop = ''.
		'		$stop_time = getmicrotime();'.
		'		$proc_time = $stop_time - $start_time;'.
		'		$proc_time = sprintf("%01.1f", $proc_time);'.
		'		echo "\n";'.
		'//		echo "$proc_time \\033[1;32m[DONE]\\033[0;39m\n";'.
		'		';
		eval($this->load_var);

		$kuru['kondisi_minimal_telik'] = 88;
		$kuru['kondisi_minimal_resi'] = 96;

		// kegiatan telik sandi
		$tkuru['mencuri_uang'] = 1;
		$tkuru['mencuri_makanan'] = 2;
		$tkuru['mencuri_daun'] = 3;
		$tkuru['mencuri_menyan'] = 4;
		$tkuru['menculik_penduduk'] = 5;
		$tkuru['membunuh_resi'] = 6; // kalo kurawa meracuni populasi
		$tkuru['menghancurkan_rumah'] = 7;
		$tkuru['mencuri_data_bangunan'] = 8;
		$tkuru['mencuri_data_pasukan'] = 9;
		$tkuru['meracuni_populasi'] = 98;
		$tkuru['merampok'] = 99;

		// sihir resi
		$skuru['sesaji_dewi_sri'] = 1;
		$skuru['sesaji_bathara_kwera'] = 2;
		$skuru['sesaji_tambang_gaib'] = 3;
		$skuru['sesaji_bathara_wisnu'] = 4;
		$skuru['sesaji_bathara_kama'] = 5;
		$skuru['sesaji_bathara_brahma'] = 6;
		$skuru['sesaji_bathara_siwa'] = 7;
		$skuru['bandung_bondowoso'] = 8;
		$skuru['pancasona'] = 9;
		$skuru['segoro_geni'] = 10;
		$skuru['kaca_benggala'] = 11;
		$skuru['mantera_purnama_raja'] = 12;
		$skuru['cakra_narendra'] = 13;
		$skuru['mageri_urip'] = 14;
		$skuru['mata_elang_sakti'] = 15;
		$skuru['lampah_lumpuh'] = 16;
		$skuru['samber_nyawa'] = 17;
		$skuru['cambuk_kilat'] = 18;


		// ringkasan status
		$lstat = array();
		$lstat['total_uang'] = 'total uang';
		$lstat['total_makanan'] = 'total makanan';
		$lstat['total_daun_lontar'] = 'total daun lontar';
		$lstat['total_menyan'] = 'total menyan';
		$lstat['luas_kerajaan'] = 'luas kerajaan';
		$lstat['nilai_kerajaan'] = 'nilai kerajaan';
		$lstat['ketenaran'] = 'ketenaran';
		$lstat['tanggal'] = 'tanggal';
		
		$lstat['total_uang'] = 'uang';
		$lstat['total_makanan'] = 'makanan';
		$lstat['total_daun_lontar'] = 'lontar';
		$lstat['total_menyan'] = 'menyan';
		$lstat['nilai_kerajaan'] = 'nilai';
		$lstat['ketenaran'] = 'tenar';

		// politik
		$pstat['dinyatakan_perang'] = 'kita dinyatakan perang oleh dewan raja';
		$pstat['menyatakan_perang'] = 'kita menyatakan perang dengan dewan raja';
		$pstat['damai'] = 'dewan raja kita tidak menyatakan/dinyatakan perang';

		// status kerajaan
		$rstat['dewan_raja'] = 'dewan raja';
		$rstat['luas_kerajaan'] = 'luas kerajaan';
		$rstat['tanah_kosong'] = 'tanah kosong';
		$rstat['populasi'] = 'populasi';
		$rstat['efektifitas_kerja'] = 'efektifitas kerja';
		$rstat['efektifitas_kerja'] = 'efektifitas';
		$rstat['bukan_sipil'] = 'bukan sipil';
		$rstat['bukan_sipil'] = 'non sipil';
		$rstat['penduduk_sipil'] = 'penduduk sipil';
		$rstat['penduduk_sipil'] = 'sipil';
		$rstat['pengangguran'] = 'pengangguran';
		$rstat['kurang_pekerja'] = 'kurang pekerja';
		$rstat['kurang_pekerja'] = 'kekurangan';
		$rstat['ksatriya_alit'] = 'ksatriya alit';
		$rstat['wanamarta_alit'] = 'wanamarta alit';
		$rstat['jatayu_alit'] = 'jatayu alit';
		$rstat['kurawa_alit'] = 'kurawa alit';
		$rstat['raksasa_alit'] = 'raksasa alit';
		$rstat['dedemit_alit'] = 'dedemit alit';
		$rstat['cakrabuana'] = 'cakrabuana';
		$rstat['kera_putih'] = 'kera putih';
		$rstat['garuda_kencana'] = 'garuda kencana';
		$rstat['taring_durjana'] = 'taring durjana';
		$rstat['buto_wesi'] = 'buto wesi';
		$rstat['pocong_sakti'] = 'pocong sakti';

		$rstat['pasopati'] = 'pasopati';
		$rstat['macan_putih'] = 'macan putih';
		$rstat['alap_alap_benua'] = 'alap-alap benua';
		$rstat['srakabala'] = 'srakabala';
		$rstat['buto_abang'] = 'buto abang';
		$rstat['tengkorak_urip'] = 'tengkorak urip';

		$rstat['panggada'] = 'panggada';
		$rstat['macan_kumbang'] = 'macan kumbang';
		$rstat['rajawali_putih'] = 'rajawali putih';
		$rstat['kapetengan'] = 'kapetengan';
		$rstat['buto_ireng'] = 'buto ireng';
		$rstat['wewe_gombel'] = 'wewe gombel';

		$rstat['telik_sandi'] = 'telik sandi';
		$rstat['danyang'] = 'danyang';
		$rstat['resi'] = 'resi';
		$rstat['dukun'] = 'dukun';
		$rstat['draft_pasukan'] = 'draft pasukan';

		// halaman telik sandi
		$tstat = array();
		$tstat['jumlah_telik_sandi'] = 'jumlah telik sandi yang dimiliki';
		$tstat['kondisi_telik_sandi'] = 'kondisi fisik telik sandi saat ini';
		$tstat['mencuri_uang'] = 'mencuri uang';
		$tstat['mencuri_makanan'] = 'mencuri makanan';
		$tstat['mencuri_daun'] = 'mencuri daun lontar';
		$tstat['mencuri_menyan'] = 'mencuri menyan';
		$tstat['menculik_penduduk'] = 'menculik penduduk sipil';
		$tstat['membunuh_resi'] = 'membunuh resi/dukun';
		$tstat['menghancurkan_rumah'] = 'menghancurkan rumah musuh';
		$tstat['mencuri_data_bangunan'] = 'mencuri data bangunan';
		$tstat['mencuri_data_pasukan'] = 'mencuri data pasukan';
		$tstat['meracuni_populasi'] = 'meracuni populasi';
		$tstat['merampok'] = 'merampok';

		// halaman resi
		$sstat = array();
		$sstat['jumlah_resi'] = 'jumlah resi yang dimiliki';
		$sstat['jumlah_dukun'] = 'jumlah dukun yang dimiliki';
		$sstat['kondisi_resi'] = 'kondisi fisik resi saat ini';
		$sstat['kondisi_dukun'] = 'kondisi fisik dukun saat ini';
		$sstat['sesaji_dewi_sri'] = 'sesaji dewi sri';
		$sstat['sesaji_bathara_kwera'] = 'sesaji bathara kwera';
		$sstat['sesaji_tambang_gaib'] = 'sesaji tambang gaib';
		$sstat['sesaji_bathara_wisnu'] = 'sesaji bathara wisnu';
		$sstat['sesaji_bathara_kama'] = 'sesaji bathara kama';
		$sstat['sesaji_bathara_brahma'] = 'sesaji bathara brahma';
		$sstat['sesaji_bathara_siwa'] = 'sesaji bathara siwa';
		$sstat['bandung_bondowoso'] = 'bandung bondowoso';
		$sstat['pancasona'] = 'pancasona';
		$sstat['segoro_geni'] = 'segoro geni';
		$sstat['kaca_benggala'] = 'kaca benggala';
		$sstat['mantera_purnama_raja'] = 'mantera purnama raja';
		$sstat['cakra_narendra'] = 'cakra narendra';
		$sstat['mageri_urip'] = 'mageri urip';
		$sstat['mata_elang_sakti'] = 'mata elang sakti';
		$sstat['lampah_lumpuh'] = 'lampah lumpuh';
		$sstat['samber_nyawa'] = 'samber nyawa';
		$sstat['cambuk_kilat'] = 'cambuk kilat';

		$estat['luas_kerajaan'] = 'luas kerajaan';
		$estat['jumlah_tanah_kosong'] = 'jumlah tanah kosong';
		$estat['akan_datang_tongkat_baru'] = 'akan datang tongkat baru';
		$estat['kebutuhan_uang'] = 'uang';
		$estat['kebutuhan_jatayu_alit'] = 'jatayu alit';
		$estat['kebutuhan_kurawa_alit'] = 'kurawa alit';
		$estat['kebutuhan_ksatriya_alit'] = 'ksatriya alit';
		$estat['kebutuhan_wanamarta_alit'] = 'wanamarta alit';
		$estat['kebutuhan_dedemit_alit'] = 'dedemit alit';
		$estat['kebutuhan_raksasa_alit'] = 'raksasa alit';
		$estat['lama_pencarian_tongkat'] = 'lama pencarian tongkat';
		$estat['jumlah_maksimal_tongkat_jatayu'] = 'jumlah maksimal tongkat yang dapat dicari berdasarkan uang, jatayu alit, dan nilai kerajaan yang dimiliki saat ini';
		$estat['jumlah_maksimal_tongkat_kurawa'] = 'jumlah maksimal tongkat yang dapat dicari berdasarkan uang, kurawa alit, dan nilai kerajaan yang dimiliki saat ini';
		$estat['jumlah_maksimal_tongkat_dedemit'] = 'jumlah maksimal tongkat yang dapat dicari berdasarkan uang, dedemit alit, dan nilai kerajaan yang dimiliki saat ini';
		$estat['jumlah_maksimal_tongkat_raksasa'] = 'jumlah maksimal tongkat yang dapat dicari berdasarkan uang, raksasa alit, dan nilai kerajaan yang dimiliki saat ini';
		$estat['jumlah_maksimal_tongkat_ksatriya'] = 'jumlah maksimal tongkat yang dapat dicari berdasarkan uang, ksatriya alit, dan nilai kerajaan yang dimiliki saat ini';
		$estat['jumlah_maksimal_tongkat_wanamarta'] = 'jumlah maksimal tongkat yang dapat dicari berdasarkan uang, wanamarta alit, dan nilai kerajaan yang dimiliki saat ini';

		$astat['jenis_pasukan'] = 'jenis pasukan';
		$astat['total_pasukan'] = 'total pasukan';
		$astat['total_populasi'] = 'populasi';
		#$astat['jatayu_alit_tersedia'] = 'jatayu alit tersedia';
		#$astat['kurawa_alit_tersedia'] = 'kurawa alit tersedia';
		#$astat['raksasa_alit_tersedia'] = 'raksasa alit tersedia';
		#$astat['dedemit_alit_tersedia'] = 'dedemit alit tersedia';
		#$astat['ksatriya_alit_tersedia'] = 'ksatriya alit tersedia';
		#$astat['wanamarta_alit_tersedia'] = 'wanamarta alit tersedia';
		#$astat['draft_pasukan_saat_ini'] = 'draft pasukan saat ini';
		$astat['draft_pasukan_saat_ini'] = 'saat ini';
		#$astat['draft_pasukan_yang_diinginkan'] = 'draft pasukan yang diinginkan';
		$astat['draft_pasukan_yang_diinginkan'] = 'diinginkan';
		$astat['dilatih'] = 'dilatih';
		$astat['jatayu_alit_tersedia'] = 'jatayu alit';
		$astat['kurawa_alit_tersedia'] = 'kurawa alit';
		$astat['raksasa_alit_tersedia'] = 'raksasa alit';
		$astat['dedemit_alit_tersedia'] = 'dedemit alit';
		$astat['ksatriya_alit_tersedia'] = 'ksatriya alit';
		$astat['wanamarta_alit_tersedia'] = 'wanamarta alit';

		$fstat['biaya_memecat'] = 'biaya memecat';

		$bstat['luas_kerajaan'] = 'luas kerajaan';
		$bstat['jumlah_bangunan'] = 'jumlah bangunan';
		$bstat['jumlah_tanah_kosong'] = 'jumlah tanah kosong';
		$bstat['harga_bangunan_tanpa_akselerasi'] = 'harga bangunan tanpa akselerasi';
		$bstat['rumah'] = 'rumah';
		$bstat['sawah'] = 'sawah';
		$bstat['pasar'] = 'pasar';
		$bstat['tambang'] = 'tambang';
		$bstat['rumah_sakit'] = 'rumah sakit';
		$bstat['pertukangan'] = 'pertukangan';
		$bstat['sekolah'] = 'sekolah';
		$bstat['kebun_lontar'] = 'kebun lontar';
		$bstat['padepokan'] = 'padepokan';
		$bstat['candi_indra'] = 'candi indra';
		$bstat['benteng'] = 'benteng';
		$bstat['ringin_kencono'] = 'ringin kencono';
		$bstat['pertapaan'] = 'pertapaan';
		$bstat['kebun_menyan'] = 'kebun menyan';
		$bstat['gua_rahasia'] = 'gua rahasia';
 

		//$kuru['username'] = $username;
		//$kuru['password'] = $password;
		//$kuru['kodePencegahan'] = '';
		$kuru['base_url'] = 'http://perang.kurusetra.com';
		$kuru['login_url'] = $kuru['base_url'].'/login.php';
		$kuru['waplogin_url'] = $kuru['base_url'].'/wap2/login.php';
		$kuru['login_data'] = 'username=[ID]&password=[PW]&kodePencegahan=[CODE]';
		$kuru['waplogin_data'] = 'username=[ID]&password=[PW]&login=1';
		$kuru['kode_url'] = $kuru['base_url'].'/kode.php';
		$kuru['kode_png'] = 'kode.png';
		$kuru['menu_base'] = $kuru['base_url'].'/atas.php';
		$kuru['menu_jatayu'] = $kuru['menu_base'].'?suku=3';
		$kuru['status'] = $kuru['base_url'].'/aksi_status.php';
		$kuru['kondisi_kerajaan'] = $kuru['base_url'].'/kurusetra.php?aksi=StatusKerajaan';
		$kuru['penasehat'] = $kuru['base_url'].'/kurusetra.php?aksi=PenasehatKerajaan';
		$kuru['utusan_url'] = $kuru['base_url'].'/kurusetra.php?aksi=MengirimSurat';
		$kuru['utusan_data'] = 'targetpulau=[TP]&targetwilayah=[TW]&target=[TA]&surat=[SR]&budal=Kirim';
		$kuru['forum'] = $kuru['base_url'].'/kurusetra.php?aksi=ForumDewanRaja';
		$kuru['politik'] = $kuru['base_url'].'/kurusetra.php?aksi=PolitikDewanRaja';
		$kuru['bangunan_url'] = $kuru['base_url'].'/kurusetra.php?aksi=BangunanKerajaan';
		$kuru['bangunan_data'] = 'rumah=[RM]&sawah=[SW]&pasar=[PS]&tambang=[TB]&rumah_sakit=[RS]&pertukangan=[PT]&sekolah=[SK]&kebun_lontar=[KL]&padepokan=[PD]&candi_indra=[CI]&benteng=[BT]&ringin_kencono=[RK]&pertapaan=[PP]&kebun_menyan=[KM]&gua_rahasia=[GR]&akselerasi=[AK]&subhari=20&subbangunan=0&subtotal=0&budal=Bangun';
		$kuru['pasukan_url'] = $kuru['base_url'].'/kurusetra.php?aksi=MelatihPasukan';
		$kuru['pasukan_data'] = 'modify_draft=[DR]&elite=[EL]&attacker=[AT]&defender=[DF]&bandit=[BA]&wizard=[WZ]&subpasukan=[SP]&subtotal=[ST]&budal=Latih';
		$kuru['ilmu_pengetahuan_url'] = $kuru['base_url'].'/kurusetra.php?aksi=IlmuPengetahuan';
		$kuru['ilmu_pengetahuan_data'] = 'ilmu_pesugihan=[IP]&ilmu_irigasi=[IR]&ilmu_kepadatan_penduduk=[IK]&ilmu_konstruksi_bangunan=[IB]&ilmu_strategi_serang=[IS]&ilmu_strategi_bertahan=[IT]&ilmu_pengobatan=[IO]&ilmu_telik_sandi=[IN]&ilmu_gaib=[IG]&budal=Belajar';
		$kuru['jimat'] = $kuru['base_url'].'/kurusetra.php?aksi=JimatJagadKurusetra';
		$kuru['singgasana_agung'] = $kuru['base_url'].'/kurusetra.php?aksi=TitisanRajaAgung';
		$kuru['puncak_mahameru_url'] = $kuru['base_url'].'/kurusetra.php?aksi=ArenaDuelKurusetra';
		$kuru['eksplorasi_url'] = $kuru['base_url'].'/kurusetra.php?aksi=Eksplorasi';
		$kuru['eksplorasi_data'] = 'explore_amount=[EA]&budal=OK';
		$kuru['bantuan'] = $kuru['base_url'].'/kurusetra.php?aksi=MengirimBantuan';
		$kuru['persiapan_perang'] = $kuru['base_url'].'/kurusetra.php?aksi=Peperangan';
		$kuru['serbu_data'] = 'targetpulau=[TP]&targetwilayah=[TW]&target=[TA]&jendral=[JD]&elite=[EL]&attacker=[AT]&kopral=[KP]&danyang=[DY]&budal=Serbu';
		$kuru['perjalanan_perang'] = $kuru['base_url'].'/kurusetra.php?aksi=PerkembanganPerjalananPasukan';
		$kuru['telik_sandi_url'] = $kuru['base_url'].'/kurusetra.php?aksi=TelikSandi';
		$kuru['telik_sandi_data'] = 'targetpulau=[TP]&targetwilayah=[TW]&target=[TA]&bandit=[BA]&kegiatan=[KG]&budal=Kirim';
		$kuru['aji_ajian_url'] = $kuru['base_url'].'/kurusetra.php?aksi=AjiAjian';
		$kuru['aji_ajian_data'] = 'targetpulau=[TP]&targetwilayah=[TW]&target=[TA]&sihir=[SH]&budal=Rapal';
		$kuru['aji_ajian_url2'] = $kuru['base_url'].'/kurusetra.php?aksi=PerkembanganAjiAjian';
		$kuru['rangking'] = $kuru['base_url'].'/kurusetra.php?aksi=RangkingKurusetra';
		$kuru['peserta_mahameru_url'] = $kuru['base_url'].'/PengikutDuel.php';
		$kuru['jagad_raya_url'] = $kuru['base_url'].'/kurusetra.php?aksi=JagadRayaKurusetra';
		$kuru['jagad_raya_data'] = 'targetpulau=[TP]&targetwilayah=[TW]&ganti=Ganti';
		$kuru['pecat_url'] = $kuru['base_url'].'/kurusetra.php?aksi=MemecatPasukan';
		$kuru['pecat_data'] = 'kopral=[KP]&elite=[EL]&attacker=[AT]&defender=[DF]&bandit=[BA]&resi=[WZ]&subpasukan=0&subtotal=0&budal=Pecat';
		$kuru['berita_lokal'] = $kuru['base_url'].'/kurusetra.php?aksi=BeritaKerajaan';
		$kuru['rumor'] = $kuru['base_url'].'/kurusetra.php?aksi=RumorDewanRaja';
		$kuru['setting_permainan'] = $kuru['base_url'].'/kurusetra.php?aksi=SettingPermainan';
		$kuru['forum_strategi'] = $kuru['base_url'].'/forumUmum.php?idkategori=1';
		$kuru['manual'] = $kuru['base_url']."JavaScript:buka('manual/manual.php','man','scrollbars=0,menubar=0,toolbar=0,status=0,width=700,height=550,left=0,top=0,resizeable=0')";
		$kuru['logout'] = $kuru['base_url'].'/logout.php';

		$kuru['default_draft'] = '50';
	
		$kuru['minimum_setara'] = 0.7;
		$kuru['maksimum_setara'] = 1.1;
		$kuru['bandit_ratio'] = 4;
		$kuru['resi_ratio'] = 3;
		$kuru['defend_ratio'] = 8;
	}

	/*
	 * Login
	 */
	function login($username, $password, $skip_init=FALSE) {
		eval($this->load_var);
		eval($this->time_start);		
		echo "kodePencegahan: ";
		$kuru['username'] = $username;
		$kuru['password'] = $password;
		$http->get_url($kuru['kode_url']);
		$fd = fopen($kuru['kode_png'], 'wb'); 
		fwrite($fd, $http->get_body());
		fclose($fd);
		$kuru['kodePencegahan'] = $kode->get_code($kuru['kode_png']);
		echo "'{$kuru['kodePencegahan']}' ";
		eval($this->time_stop);

		eval($this->time_start);
		echo "Logging you in, hang tight! @web ";
		$data = $kuru['login_data'];
		$data = str_replace('[ID]', $kuru['username'], $data);
		$data = str_replace('[PW]', $kuru['password'], $data);
		$data = str_replace('[CODE]', $kuru['kodePencegahan'], $data);
		//echo "$data ";
		$http->post_url($data, $kuru['login_url']);
		eval($this->time_stop);
		if (! $skip_init) $this->init_data();
	}
	function serbu($target) {
		eval($this->load_var);
		eval($this->time_start);

		list($pulau, $wilayah, $raja) = explode(":", $target);
		if (empty($pulau) || empty($wilayah) || empty($raja)) return FALSE;
	
		$data = $kuru['serbu_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		$data = str_replace('[TA]', '', $data);
		$data = str_replace('[JD]', '', $data);
		$data = str_replace('[EL]', '', $data);
		$data = str_replace('[AT]', '', $data);
		$data = str_replace('[KP]', '', $data);
		$data = str_replace('[DY]', '', $data);
		$data = str_replace('budal', 'ganti', $data);
		$data = str_replace('Serbu', 'Ganti', $data);
	
		$http->post_url($data, $kuru['persiapan_perang']);
		$body = $http->get_body();
		$body = strip_tags($body);
		$piece = explode("\n", $body);
		//$piece = explode("\n", strip_tags(str_replace('</td>', "\n", strip_tags($http->get_body(), '<td>'))));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = trim($vv);
			$vv = str_replace(':', "\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = array_search(strtolower(trim($p2[$i])), $astat);
			if ($kstatus=='jenis_pasukan') {
				$kuru['elite_siap'] = ereg_replace('[^0-9]', '', $p2[$i+5]);
				$kuru['attack_siap'] = ereg_replace('[^0-9]', '', $p2[$i+8]);
				$kuru['alit_siap'] = ereg_replace('[^0-9]', '', $p2[$i+11]);
				$kuru['danyang_siap'] = ereg_replace('[^0-9]', '', $p2[$i+14]);
			}
		}
		if (($kuru[elite_siap]+$kuru[attack_siap]) < $kuru[danyang_siap])
			$kuru[danyang_siap] = $kuru[elite_siap] + $kuru[attack_siap];

		$data = $kuru['serbu_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		$data = str_replace('[TA]', $raja, $data);
		$data = str_replace('[JD]', 5, $data);
		$data = str_replace('[EL]', intval($kuru[elite_siap]), $data);
		$data = str_replace('[AT]', intval($kuru[attack_siap]), $data);
		$data = str_replace('[KP]', 0, $data);
		$data = str_replace('[DY]', intval($kuru[danyang_siap]), $data);
	
		if (intval($kuru[attack_siap])) {
			$http->post_url($data, $kuru['persiapan_perang']);
			$body = $http->get_body();
		} else {
			$body = '';
		}
		
		if (strpos(strtolower($body), 'genderang') !== false) {
			$fd = fopen('/tmp/serbu-'.date('Hi').'.txt', 'w');
			fwrite($fd, $body);
			fclose($fd);
		} else {
			//echo $body;
		}
	}
	function waplogin($username, $password, $skip_init=FALSE) {
		eval($this->load_var);
		//eval($this->time_start);		
		//echo "kodePencegahan: ";
		$kuru['username'] = $username;
		$kuru['password'] = $password;
		//$http->get_url($kuru['kode_url']);
		//$fd = fopen($kuru['kode_png'], 'wb'); 
		//fwrite($fd, $http->get_body());
		//fclose($fd);
		//$kuru['kodePencegahan'] = $kode->get_code($kuru['kode_png']);
		//echo "'{$kuru['kodePencegahan']}' ";
		//eval($this->time_stop);

		eval($this->time_start);
		echo "Logging you in, hang tight! @wap ";
		$data = $kuru['waplogin_data'];
		$data = str_replace('[ID]', $kuru['username'], $data);
		$data = str_replace('[PW]', $kuru['password'], $data);
		//$data = str_replace('[CODE]', $kuru['kodePencegahan'], $data);
		//echo "$data ";
		$http->post_url($data, $kuru['waplogin_url']);
		eval($this->time_stop);
		$body = $http->get_body();
		$body = str_replace('</b>', "\n", $body);
		$body = str_replace('<br/>', "\n", $body);
		$body = str_replace('</td>', "\n", $body);
		$piece = explode("\n", strip_tags($body));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = trim($vv);
			if ($vv[0]!='[') $vv = str_replace('[', "\n", $vv);
			else $vv = str_replace('[', "", $vv);
			//$vv = str_replace(':', "\n", $vv);
			$vv = str_replace(']', "\n", $vv);
			$vv = ereg_replace("\n$", "", $vv);
			$vv = ereg_replace("\n$", "", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = array_search(strtolower(trim($p2[$i])), $lstat);
			if (! $kstatus) $kstatus = array_search(strtolower(trim($p2[$i])), $rstat);
			if ($kstatus && in_array($kstatus, array('dewan_raja'))) { $kuru[$kstatus] = str_replace(' ', '', $p2[$i+1]); $kuru['nama_kerajaan'] = strtolower(trim($p2[$i-1]));}
			else if ($kstatus) $kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
			if ($kstatus && in_array($kstatus, array('efektifitas_kerja', 'draft_pasukan'))) $kuru[$kstatus] /= 100;
		}
		unset($tmp);unset($p2);
		$kuru['total_alit'] = $kuru['ksatriya_alit'] + $kuru['wanamarta_alit'] + $kuru['jatayu_alit'] + $kuru['kurawa_alit'] + $kuru['raksasa_alit'] + $kuru['dedemit_alit'];
		$kuru['total_elite'] = $kuru['cakrabuana'] + $kuru['kera_putih'] + $kuru['garuda_kencana'] + $kuru['taring_durjana'] + $kuru['buto_wesi'] + $kuru['pocong_sakti'];
		$kuru['total_attack'] = $kuru['pasopati'] + $kuru['macan_putih'] + $kuru['alap_alap_benua'] + $kuru['srakabala'] + $kuru['buto_abang'] + $kuru['tengkorak_urip'];
		$kuru['total_defend'] = $kuru['panggada'] + $kuru['macan_kumbang'] + $kuru['rajawali_putih'] + $kuru['kapetengan'] + $kuru['buto_ireng'] + $kuru['wewe_gombel'];
		if ($kuru['dukun']) $kuru['resi'] = $kuru['dukun'];
		eval($this->time_stop);
		//if (! $skip_init) $this->init_data();
	}
	// GET ENEMY STATUS
	function data_telik($target='') {
		eval($this->load_var);
		eval($this->time_start);
		if (!isset($kuru['dinyatakan_perang']) &&
			!isset($kuru['menyatakan_perang']) &&
			!isset($kuru['damai'])) $this->politik();
		echo "GET ENEMY STATUS ";
		if (! $target) $target = $kuru['dinyatakan_perang'];
		if (! $target) $target = $kuru['menyatakan_perang'];
		if (! $target) {echo "\033[1;31m[FAILED]\033[0;39m\n"; return FALSE;}
		list($pulau, $wilayah, $raja) = explode(":", $target);
		$data = $kuru['telik_sandi_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		$data = str_replace('[TA]', 0, $data);
		$data = str_replace('[BA]', 0, $data);
		$data = str_replace('[KG]', 0, $data);
		$data = str_replace('budal', 'ganti', $data);
		$data = str_replace('Kirim', 'Ganti', $data);
		echo "$data ";
		$http->post_url($data, $kuru['telik_sandi_url']);
		$piece = explode("\n", strip_tags($http->get_body(), '<option>'));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = str_replace(':', "\n", $vv);
			$vv = str_replace('</option>', "\n", $vv);
			$vv = str_replace('">', "\">\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			unset($lstatus);
			$kstatus = array_search(strtolower(trim($p2[$i])), $tstat);
			if (! $kstatus && strstr(strtolower(trim($p2[$i])), '<option')) $lstatus = strtolower(trim($p2[$i+1]));
			if (! $kstatus && $lstatus && ! in_array($lstatus, $tstat)) { 
				$raja_arr[$lstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i]); 
				if (	! strstr($kuru['dinyatakan_perang'], "$pulau:$wilayah") 
					&& ! strstr($kuru['menyatakan_perang'], "$pulau:$wilayah") 
					&& array_key_exists($lstatus, $mahameru_arr)) 
					$musuh_arr[$lstatus] =& $raja_arr[$lstatus]; 
				else if (strstr($kuru['dinyatakan_perang'], "$pulau:$wilayah") 
					|| strstr($kuru['menyatakan_perang'], "$pulau:$wilayah"))
					$musuh_arr[$lstatus] =& $raja_arr[$lstatus]; 
					
				$dr_raja_arr[$lstatus] = "$pulau:$wilayah";
			}
			if ($kstatus) $kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	
	// STEAL ENEMY
	function telik($kegiatan='auto', $target='auto') {
		eval($this->load_var);
		eval($this->time_start);
		if ($kuru['kondisi_telik_sandi']=='') $this->data_telik();
		echo "STEAL ENEMY ";
		if ($target=='auto') {
			//print_r($musuh_arr);
			foreach ($musuh_arr as $k => $v) {
				//echo $k." ## ".$kuru['nilai_'.$k].' ## '.$kuru['tenar_'.$k].' ## '.$kuru['tanah_'.$k]." ## ".$kuru['ratio_'.$k]."\n";
				$daftar[$kuru['nilai_'.$k]][$kuru['tanah_'.$k]] = $k;
			}
			ksort($daftar);
			//print_r($daftar);
			foreach ($daftar as $k => $v) {
				if ($k <= (int)($kuru['nilai_kerajaan']*$kuru['minimum_setara'])) { unset($daftar[$k]);}
				else if ($k >= (int)($kuru['nilai_kerajaan']*$kuru['maksimum_setara'])) { unset($daftar[$k]);}
				else { $baru[] = $v[key($v)];}

			}
			//print_r($daftar);
			//print_r($dr_raja_arr);
			//exit;
			if (count($baru)) ksort($baru);
			srand ((float) microtime() * 10000000);
			if (count($baru)) $rand_target = array_rand ($baru);
			if ($kuru['dinyatakan_perang']) $target_dr = $kuru['dinyatakan_perang'];
			else if ($kuru['menyatakan_perang']) $target_dr = $kuru['menyatakan_perang'];
			$target = $dr_raja_arr[$baru[$rand_target]].':'.$baru[$rand_target];
		}
		
		if ($kuru['total_makanan']<20000) $kegiatan = 'mencuri_makanan';
		else if ($kuru['total_uang']<100000) $kegiatan = 'mencuri_uang';
		else if ($kegiatan=='auto') $kegiatan = 'mencuri_uang';
		
		if ($kuru['kondisi_telik_sandi'] <= $kuru['kondisi_minimal_telik']) {/*echo "\nkondisi minimal telik\n";*/echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		list($pulau, $wilayah, $raja) = explode(":", $target);
		if (!(int)$raja) $raja = $raja_arr[strtolower($raja)];
		if (!$pulau || !$wilayah || !$raja) {/*echo "\nerror target\n";*/echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		$kegiatan = $tkuru[$kegiatan];
		$data = $kuru['telik_sandi_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		$data = str_replace('[TA]', $raja, $data);
		$data = str_replace('[BA]', $kuru['jumlah_telik_sandi'], $data);
		$data = str_replace('[KG]', $kegiatan, $data);
		echo array_search($raja, $raja_arr)." $data ";
		$http->post_url($data, $kuru['telik_sandi_url']);
		$this->write_file('telik_'.$kuru['username'].'_'.$raja);
		eval($this->time_stop);
	}
	// GET SELF STATUS
	function status() {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET SELF STATUS ";
		$http->get_url($kuru['status']);
		$piece = explode("\n", strip_tags($http->get_body()));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = str_replace('[', "\n", $vv);
			//$vv = str_replace(':', "\n", $vv);
			$vv = str_replace(']', "", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = array_search(strtolower(trim($p2[$i])), $lstat);
			if (! $kstatus) $kstatus = array_search(strtolower(trim($p2[$i])), $rstat);
			if ($kstatus && in_array($kstatus, array('dewan_raja'))) { $kuru[$kstatus] = str_replace(' ', '', $p2[$i+1]); $kuru['nama_kerajaan'] = strtolower(trim($p2[$i-2]));}
			else if ($kstatus) $kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
			if ($kstatus && in_array($kstatus, array('efektifitas_kerja', 'draft_pasukan'))) $kuru[$kstatus] /= 100;
		}
		unset($tmp);unset($p2);
		$kuru['total_alit'] = $kuru['ksatriya_alit'] + $kuru['wanamarta_alit'] + $kuru['jatayu_alit'] + $kuru['kurawa_alit'] + $kuru['raksasa_alit'] + $kuru['dedemit_alit'];
		$kuru['total_elite'] = $kuru['cakrabuana'] + $kuru['kera_putih'] + $kuru['garuda_kencana'] + $kuru['taring_durjana'] + $kuru['buto_wesi'] + $kuru['pocong_sakti'];
		$kuru['total_attack'] = $kuru['pasopati'] + $kuru['macan_putih'] + $kuru['alap_alap_benua'] + $kuru['srakabala'] + $kuru['buto_abang'] + $kuru['tengkorak_urip'];
		$kuru['total_defend'] = $kuru['panggada'] + $kuru['macan_kumbang'] + $kuru['rajawali_putih'] + $kuru['kapetengan'] + $kuru['buto_ireng'] + $kuru['wewe_gombel'];
		if ($kuru['dukun']) $kuru['resi'] = $kuru['dukun'];
		eval($this->time_stop);
		/* Untuk menu atas
		$piece = explode("\n", $http->get_body());
		foreach ($piece as $kk => $vv) {
			if (eregi("<a .*href[ ]*=[ ]*[\"]?([^\" ]+)[\"]?", $vv, $regs) || 
			eregi("<a .*href[ ]*=[ ]*[\']?([^\' ]+)[\']?", $vv, $regs)	) {
				$href = $regs[1];
				if (eregi("<a [^>]+>([^<]+)</a>", $vv, $regs)) {
					$link = $regs[1];
					echo "\$kuru['$link'] = \$kuru['base_url'].'$href';\n";
				}
			}
		}
		unset($piece);
		*/
	}
	// GET WAR STATUS
	function politik() {
		eval($this->load_var);
		eval($this->time_start);	
		echo "GET WAR STATUS ";
		$http->get_url($kuru['politik']);
		$piece = explode("\n", strtolower(strip_tags($http->get_body(), '<br>')));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = strtolower($vv);
			$vv = str_replace('[', "\n", $vv);
			$vv = str_replace(']', "\n", $vv);
			$vv = str_replace('-', "\n", $vv);
			$vv = str_replace('<br>', "\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = array_search(strtolower(trim($p2[$i])), $pstat);
			if ($kstatus) 
			{	/*echo "\nstatus: $kstatus\n";*/$kuru[$kstatus] = ereg_replace('[^0-9:]', '', $p2[$i+1]);}
				
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// GET ARMY PRICE
	function data_pasukan() {
		eval($this->load_var);
		eval($this->time_start);		
		echo "GET ARMY PRICE ";
		$http->get_url($kuru['pasukan_url']);
		$body = $http->get_body();
		$body = ereg_replace("<[^/]+/>", "\n", $body);
		$body = strip_tags($body);
		$piece = explode("\n", $body);
		//$piece = explode("\n", strip_tags(str_replace('</td>', "\n", strip_tags($http->get_body(), '<td>'))));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = trim($vv);
			$vv = str_replace(':', "\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = array_search(strtolower(trim($p2[$i])), $astat);
			/*
			if ($kstatus=='jenis_pasukan') {
				$kuru['elite_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+6]);
				$kuru['elite_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+7]);
				$kuru["harga_elite"] = ereg_replace('[^0-9]', '', $p2[$i+8]);
				$kuru['attack_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+11]);
				$kuru['attack_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+12]);
				$kuru["harga_attack"] = ereg_replace('[^0-9]', '', $p2[$i+13]);
				$kuru['defend_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+16]);
				$kuru['defend_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+17]);
				$kuru["harga_defend"] = ereg_replace('[^0-9]', '', $p2[$i+18]);
				$kuru['bandit_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+21]);
				$kuru['bandit_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+22]);
				$kuru["harga_bandit"] = ereg_replace('[^0-9]', '', $p2[$i+23]);
				$kuru['resi_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+26]);
				$kuru['resi_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+27]);
				$kuru["harga_resi"] = ereg_replace('[^0-9]', '', $p2[$i+28]);
			*/
			if ($kstatus=='draft_pasukan_yang_diinginkan') {
				$kuru['elite_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+10]);
				$kuru['elite_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+12]);
				$kuru["harga_elite"] = ereg_replace('[^0-9]', '', $p2[$i+8]);
				$kuru['attack_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+17]);
				$kuru['attack_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+19]);
				$kuru["harga_attack"] = ereg_replace('[^0-9]', '', $p2[$i+15]);
				$kuru['defend_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+24]);
				$kuru['defend_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+26]);
				$kuru["harga_defend"] = ereg_replace('[^0-9]', '', $p2[$i+22]);
				#$kuru['bandit_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+21]);
				#$kuru['bandit_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+22]);
				#$kuru["harga_bandit"] = ereg_replace('[^0-9]', '', $p2[$i+23]);
				#$kuru['resi_dimiliki'] = ereg_replace('[^0-9]', '', $p2[$i+26]);
				#$kuru['resi_dilatih'] = ereg_replace('[^0-9]', '', $p2[$i+27]);
				#$kuru["harga_resi"] = ereg_replace('[^0-9]', '', $p2[$i+28]);
				$kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
			
			} else if ($kstatus) {
				$kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
			}
			if ($kstatus && in_array($kstatus, array('draft_pasukan_saat_ini', 'draft_pasukan_yang_diinginkan'))) $kuru[$kstatus] /= 10;
		}
		$kuru['total_alit_tersedia'] =	$kuru['jatayu_alit_tersedia'] +
						$kuru['kurawa_alit_tersedia'] +
						$kuru['dedemit_alit_tersedia'] +
						$kuru['ksatriya_alit_tersedia'] +
						$kuru['wanamarta_alit_tersedia'] +
						$kuru['raksasa_alit_tersedia'];
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// BUILD ARMY
	function pasukan($pasukan='auto', $ratio=1) {
		eval($this->load_var);
		eval($this->time_start);
		#if ($kuru['total_uang']=='' ||
		#	$kuru['total_alit']=='' ||
		#	$kuru['luas_kerajaan']) $this->status();
		#if ($kuru['harga_elite']=='') $this->data_pasukan();
		$this->data_pasukan();
		echo "BUILD ARMY ";
		#if (! $kuru['total_alit']) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		if ($pasukan=='auto') {
			//$kuru['total_alit'] = 900;
			//$kuru['total_uang'] = 10000000000;
			//echo "bandit: (latih){$kuru['bandit_dilatih']} (milik){$kuru['bandit_dimiliki']} (ratio){$kuru['bandit_ratio']}\n";
			//echo "defend: (latih){$kuru['defend_dilatih']} (milik){$kuru['defend_dimiliki']} (ratio){$kuru['defend_ratio']}\n";
			//echo "resi: (latih){$kuru['resi_dilatih']} (milik){$kuru['resi_dimiliki']} (ratio){$kuru['resi_ratio']}\n";
			//echo "luas: {$kuru['luas_kerajaan']}\n";
			if ($kuru['draft_pasukan_saat_ini'] >= $kuru['default_draft']-1 && $kuru['kebutuhan_alit']*5 > $kuru['total_alit']) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
			$p_arr = array('ba'=>'bandit', 'wz'=>'resi', 'df'=>'defend', 'el'=>'elite', 'at'=>'attack');
			$ta = $kuru['total_alit'];
			$tu = $kuru['total_uang'];
			while ($ta) {
				reset($p_arr);
				$never_build = TRUE;
				foreach ($p_arr as $k => $v) {
					$build_v = FALSE;
					if ($ta && $k=='ba' && $kuru['bandit_dilatih']+$kuru['bandit_dimiliki'] < round($kuru['luas_kerajaan']*$kuru['bandit_ratio'])) {$build_v=1;}
					if ($ta && $k=='wz' && $kuru['resi_dilatih']+$kuru['resi_dimiliki'] < round($kuru['luas_kerajaan']*$kuru['resi_ratio'])) {$build_v=1;}
					if ($ta && $k=='df' && $kuru['defend_dilatih']+$kuru['defend_dimiliki'] < round($kuru['luas_kerajaan']*$kuru['defend_ratio'])) {$build_v=1;}
					if ($build_v && $tu - $kuru['harga_'.$v] > 0) {
						${$k}++;
						$ta--;
						$never_build=FALSE;
						$tu=$tu-$kuru['harga_'.$v];
						$kuru[$v.'_dilatih']++;
						/*echo "latih .. $v\n";*/
					}
				}
				if ($never_build && $tu - $kuru['harga_elite'] > 0) {
					$el++;
					$ta--;
					$tu=$tu-$kuru['harga_elite'];
				} else if ($never_build) {
					$ta = 0;
				}
			}
			//echo "sisa uang: $tu\n";
			//echo "sisa alit: $ta\n";
			//echo "exit .. \n";
			//exit;
		} else if ($ratio <= 1) {
			switch ($pasukan) {
				case 'elite': $el = floor($ratio*$kuru['total_uang']/$kuru['harga_elite']);break;
				case 'attack': $at = floor($ratio*$kuru['total_uang']/$kuru['harga_attack']);break;
				case 'defend': $df = floor($ratio*$kuru['total_uang']/$kuru['harga_defend']);break;
			#	case 'bandit': $ba = floor($ratio*$kuru['total_uang']/$kuru['harga_bandit']);break;
			#	case 'wizard': $wz = floor($ratio*$kuru['total_uang']/$kuru['harga_resi']);break;
			}
		} else {
			switch ($pasukan) {
				case 'elite': $el = $ratio;break;
				case 'attack': $at = $ratio;break;
				case 'defend': $df = $ratio;break;
				case 'bandit': $ba = $ratio;break;
				case 'wizard': $wz = $ratio;break;
			}
		}
		if ($pasukan!='auto') {
			if ($el>$kuru['total_alit_tersedia']) $el = $kuru['total_alit_tersedia'];
			else if ($at>$kuru['total_alit_tersedia']) $at = $kuru['total_alit_tersedia'];
			else if ($df>$kuru['total_alit_tersedia']) $df = $kuru['total_alit_tersedia'];
			else if ($ba>$kuru['total_alit_tersedia']) $ba = $kuru['total_alit_tersedia'];
			else if ($wz>$kuru['total_alit_tersedia']) $wz = $kuru['total_alit_tersedia'];
		}
		$data = $kuru['pasukan_data'];
		$data = str_replace('[DR]', $kuru['draft_pasukan'], $data);
		$data = str_replace('[EL]', (int)$el, $data);
		$data = str_replace('[AT]', (int)$at, $data);
		$data = str_replace('[DF]', (int)$df, $data);
		$data = str_replace('[BA]', (int)$ba, $data);
		$data = str_replace('[WZ]', (int)$wz, $data);
		$data = str_replace('[SP]', '0', $data);
		$data = str_replace('[ST]', '0', $data);
		#if (!$el && !$at && !$df && !$ba && !$wz) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		#echo "$data ";
		$http->post_url($data, $kuru['pasukan_url']);
		eval($this->time_stop);
	}
	function draft_pasukan($draft=FALSE) {
		eval($this->load_var);
		eval($this->time_start);
		if (! $draft) $draft = $kuru['default_draft'];
		if ($kuru['draft_pasukan_yang_diinginkan']=='') { $this->data_pasukan();}
		echo "SET ARMY DRAFT ";
		//if ($kuru['draft_pasukan_yang_diinginkan']==$draft) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		$data = $kuru['pasukan_data'];
		$data = str_replace('[DR]', $draft, $data);
		$data = str_replace('[EL]', '0', $data);
		$data = str_replace('[AT]', '0', $data);
		$data = str_replace('[DF]', '0', $data);
		$data = str_replace('[BA]', '0', $data);
		$data = str_replace('[WZ]', '0', $data);
		$data = str_replace('[SP]', '0', $data);
		$data = str_replace('[ST]', '0', $data);
		$data = str_replace('budal', 'draft', $data);
		$data = str_replace('Latih', 'Ganti', $data);
		echo "$data ";
		$http->post_url($data, $kuru['pasukan_url']);
		eval($this->time_stop);
	}
	// GET CURSE STATUS
	function status_sihir() {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET CURSE STATUS ";
		$http->get_url($kuru['aji_ajian_url2']);
		$piece = explode("\n", strip_tags(str_replace('</td>', "\n", strip_tags($http->get_body(), '<td>'))));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			unset($lstatus);
			$kstatus = array_search(strtolower(trim($p2[$i])), $sstat);
			if ($kstatus) $kuru['status_'.$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
		}
		unset($tmp);unset($p2);
		if ($kuru['jumlah_dukun']) $kuru['jumlah_resi'] = $kuru['jumlah_dukun'];
		if ($kuru['kondisi_dukun']) $kuru['kondisi_resi'] = $kuru['kondisi_dukun'];
		eval($this->time_stop);
	}
	// GET MAGIC PRICE
	// GET FRIEND STATUS
	function data_sihir() {
		eval($this->load_var);
		eval($this->time_start);
		if ($kuru['dewan_raja']=='' ||
			$kuru['nama_kerajaan']=='') $this->status();
		echo "GET FRIEND STATUS ";
		$target = $kuru['dewan_raja'].":".$kuru['nama_kerajaan'];
		list($pulau, $wilayah, $raja) = explode(":", $target);
		$data = $kuru['aji_ajian_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		$data = str_replace('[TA]', 0, $data);
		$data = str_replace('[SH]', 0, $data);
		$data = str_replace('budal', 'ganti', $data);
		$data = str_replace('Rapal', 'Ganti', $data);
		echo "$data ";
		$http->post_url($data, $kuru['aji_ajian_url']);
		$piece = explode("\n", strip_tags($http->get_body(), '<option>'));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = str_replace(':', "\n", $vv);
			$vv = str_replace('--', "\n", $vv);
			$vv = str_replace('menyan', "\n", $vv);
			$vv = str_replace('*', "\n", $vv);
			$vv = str_replace('</option>', "\n", $vv);
			$vv = str_replace('">', "\">\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			unset($lstatus);
			$kstatus = array_search(strtolower(trim($p2[$i])), $sstat);
			if (! $kstatus && strstr(strtolower(trim($p2[$i])), '<option')) $lstatus = strtolower(trim($p2[$i+1]));
			if (! $kstatus && $lstatus) $raja_arr[$lstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i]);
			if ($kstatus) $kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// CAST MAGIC
	function sihir ($sihir, $target) {
		eval($this->load_var);
		eval($this->time_start);
		if ($kuru['kondisi_resi']=='') $this->data_sihir();
		echo "CAST MAGIC ".
		$sihir = $skuru[$sihir];
		if ($target=='self') $target = $kuru['dewan_raja'].":".$kuru['nama_kerajaan'];
		list($pulau, $wilayah, $raja) = explode(":", $target);
		$raja = $raja_arr[strtolower($raja)];
		$data = $kuru['aji_ajian_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		$data = str_replace('[TA]', $raja, $data);
		$data = str_replace('[SH]', $sihir, $data);
		if (! ($kuru['kondisi_resi'] >= $kuru['kondisi_minimal_resi']) || 
			! ($kuru['total_menyan'] >= $kuru[array_search($sihir, $skuru)]) || 
			$kuru['status_'.array_search($sihir, $skuru)]) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		echo array_search($raja, $raja_arr)." $data ";
		$http->post_url($data, $kuru['aji_ajian_url']);
		$this->write_file('sihir');
		eval($this->time_stop);
	}

	// DO LEARN
	function belajar($ilmu='auto') {
		eval($this->load_var);
		eval($this->time_start);
		//if ($kuru['total_daun_lontar']=='') $this->status();
		echo "DO LEARN ";
		if ($ilmu=='auto') $dla = floor($kuru['total_daun_lontar']/9);
		if ($ilmu!='auto') $dla = 0;
		$dla = 0;
		switch ($ilmu) {
			case 'auto': $dla = floor($kuru['total_daun_lontar']/9);break;
			case 'pesugihan': $ip = $kuru['total_daun_lontar'];break;
			case 'irigasi': $ir = $kuru['total_daun_lontar'];break;
			case 'kepadatan_penduduk': $ik = $kuru['total_daun_lontar'];break;
			case 'konstruksi_bangunan': $ib = $kuru['total_daun_lontar'];break;
			case 'strategi_serang': $is = $kuru['total_daun_lontar'];break;
			case 'strategi_bertahan': $it = $kuru['total_daun_lontar'];break;
			case 'pengobatan': $io = $kuru['total_daun_lontar'];break;
			case 'ilmu_telik_sandi': $in = $kuru['total_daun_lontar'];break;
			case 'ilmu_gaib': $ig = $kuru['total_daun_lontar'];break;
		}
		if ($dla) $ip = $ir = $ik = $ib = $is = $it = $io = $in = $ig = $dla;
		$data = $kuru['ilmu_pengetahuan_data'];
		$data = str_replace('[IP]', (int)$ip, $data);
		$data = str_replace('[IR]', (int)$ir, $data);
		$data = str_replace('[IK]', (int)$ik, $data);
		$data = str_replace('[IB]', (int)$ib, $data);
		$data = str_replace('[IS]', (int)$is, $data);
		$data = str_replace('[IT]', (int)$it, $data);
		$data = str_replace('[IO]', (int)$io, $data);
		$data = str_replace('[IN]', (int)$in, $data);
		$data = str_replace('[IG]', (int)$ig, $data);
		if (!$ip && !$ir && !$ik && !$ib && !$is && !$it && !$io && !$in && !$ig) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		echo "$data ";
		$http->post_url($data, $kuru['ilmu_pengetahuan_url']);
		eval($this->time_stop);
	}
	function penasehat() {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET SELF STAT ";
		$http->get_url($kuru['penasehat']);
		$keyword = 'penambahan';
		$piece = explode("\n", strip_tags($http->get_body()));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = strstr(strtolower(trim($p2[$i])), $keyword);
			if ($kstatus) {
				$kstatus = strtolower(trim($p2[$i]));
				$kuru["ripis_terima"] = ereg_replace('[^0-9]', '', $p2[$i+4]);
				$kuru["ripis_keluar"] = ereg_replace('[^0-9]', '', $p2[$i+5]);
				$kuru["ripis_sisa"] = ereg_replace('[^0-9-]', '', $p2[$i+6]);
				$kuru["makanan_terima"] = ereg_replace('[^0-9]', '', $p2[$i+8]);
				$kuru["makanan_keluar"] = ereg_replace('[^0-9]', '', $p2[$i+9]);
				$kuru["makanan_sisa"] = ereg_replace('[^0-9-]', '', $p2[$i+10]);
				$kuru["lontar_terima"] = ereg_replace('[^0-9]', '', $p2[$i+12]);
				$kuru["lontar_keluar"] = ereg_replace('[^0-9]', '', $p2[$i+13]);
				$kuru["lontar_sisa"] = ereg_replace('[^0-9-]', '', $p2[$i+14]);
				$kuru["menyan_terima"] = ereg_replace('[^0-9]', '', $p2[$i+16]);
				$kuru["menyan_keluar"] = ereg_replace('[^0-9]', '', $p2[$i+17]);
				$kuru["menyan_sisa"] = ereg_replace('[^0-9-]', '', $p2[$i+18]);
				$kuru["populasi"] = ereg_replace('[^0-9]', '', $p2[$i+20]);
				$kuru["makanan_konsumsi"] = ereg_replace('[^0-9]', '', $p2[$i+23]);
				$kuru["makanan_busuk"] = ereg_replace('[^0-9]', '', $p2[$i+24]);
				$kuru["menyerang_sukses"] = ereg_replace('[^0-9]', '', $p2[$i+32]);
				$kuru["menyerang_gagal"] = ereg_replace('[^0-9]', '', $p2[$i+33]);
				$kuru["bertahan_sukses"] = ereg_replace('[^0-9]', '', $p2[$i+34]);
				$kuru["bertahan_gagal"] = ereg_replace('[^0-9]', '', $p2[$i+35]);
				$kuru["nilai_perang"] = ereg_replace('[^0-9-]', '', $p2[$i+36]);
				$kuru["rasio_perang"] = ereg_replace('[^0-9-]', '', $p2[$i+37]);
				$kuru["status_tongkat"] = ereg_replace('[^0-9]', '', $p2[$i+40]);
				$kuru["status_rampok"] = ereg_replace('[^0-9]', '', $p2[$i+41]);
				$kuru["status_etnis"] = ereg_replace('[^0-9]', '', $p2[$i+42]);
			}
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// SEND MESSAGE
	function utusan($pesan, $target='self') {
		eval($this->load_var);
		eval($this->time_start);
		if ($kuru['dewan_raja']=='' ||
			$kuru['nama_kerajaan']=='') $this->status();
		if ($target=='self') $target = $kuru['dewan_raja'].":".$kuru['nama_kerajaan'];
		list($pulau, $wilayah, $raja) = explode(":", $target);
		$raja = $raja_arr[strtolower($raja)];
		if ($raja=='') { $this->data_sihir();$raja = $raja_arr[strtolower($raja)];}
		if ($raja=='') { $this->data_telik();$raja = $raja_arr[strtolower($raja)];}
		echo "SEND MESSAGE ";
		$data = $kuru['utusan_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		$data = str_replace('[TA]', $raja, $data);
		$data = str_replace('[SR]', $pesan, $data);
		echo "$data ";
		$http->post_url($data, $kuru['utusan_url']);
		eval($this->time_stop);
	}

	/* Cari Semua Dewan Raja
	for ($i=1;$i<31;$i++) {
		for ($j=1;$j<31;$j++) {
			jagad_raya("$i:$j");
			echo $http->get_body();
		}
	}
	*/
	// LOOK WORLD
	function jagad_raya($target) {
		eval($this->load_var);
		eval($this->time_start);
		echo "LOOK WORLD ";
		list($pulau, $wilayah) = explode(":", $target);
		$data = $kuru['jagad_raya_data'];
		$data = str_replace('[TP]', $pulau, $data);
		$data = str_replace('[TW]', $wilayah, $data);
		echo "$data ";
		$http->post_url($data, $kuru['jagad_raya_url']);
		eval($this->time_stop);
	}

	function write_file($filename, $string='') {
		eval($this->load_var);
		if (! $string) $string = strip_tags($http->get_body());
		$fp = fopen ($filename."_".date("Hi").'.log', 'wb');
		fwrite($fp, $string);
		fclose($fp);
	}

	function enemy_ratio() {
		eval($this->load_var);
		if (!isset($kuru['dinyatakan_perang']) &&
			!isset($kuru['menyatakan_perang']) &&
			!isset($kuru['damai'])) $this->politik();
		$target = $kuru['dinyatakan_perang'];
		if (! $target) $target = $kuru['menyatakan_perang'];
		if (! $target) return;
		$this->ratio($target);
	}

	function friend_ratio() {
		eval($this->load_var);
		if ($kuru['dewan_raja']=='') $this->status();
		$target = $kuru['dewan_raja'];
		$this->ratio($target);
	}

	function ratio($target) {
		eval($this->load_var);
		eval($this->time_start);
		echo "CALCULATE RATIO ";
		if (! $target) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		$this->jagad_raya($target);
		echo "$target ";
		$piece = explode("\n", strip_tags(str_replace('</td>', "\n", strip_tags($http->get_body(), '<td>'))));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = array_key_exists(strtolower(trim(str_replace('&nbsp;(aktif)', '', $p2[$i]))), $raja_arr);
			if ($kstatus) {
				$kstatus = strtolower(trim(str_replace('&nbsp;(aktif)', '', $p2[$i])));
				$kuru["tanah_".$kstatus] = ereg_replace('[^0-9]', '', $p2[$i+1]);
				$kuru["nilai_".$kstatus] = ereg_replace('[^0-9]', '', $p2[$i+2]);
				$kuru["tenar_".$kstatus] = ereg_replace('[^0-9]', '', $p2[$i+3]);
				$kuru["ratio_".$kstatus] = floor($kuru['nilai_'.$kstatus]/$kuru['tanah_'.$kstatus])-100;
			}
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// ARMY TRIP
	function perjalanan() {
		eval($this->load_var);
		eval($this->time_start);
		echo "ARMY TRIP ";
		$keyword = 'jenderal';
		$http->get_url($kuru['perjalanan_perang']);
		$piece = explode("\n", strip_tags(str_replace('</td>', "\n", strip_tags($http->get_body(), '<td>'))));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			$kstatus = strstr(strtolower(trim($p2[$i])), $keyword);
			if ($kstatus) {
				$kstatus = strtolower(trim($p2[$i]));
				$kuru["jendral1_waktu"] = ereg_replace('[^0-9]', '', $p2[$i+7])/100;
				$kuru["jendral1_alit"] = ereg_replace('[^0-9]', '', $p2[$i+8]);
				$kuru["jendral1_elite"] = ereg_replace('[^0-9]', '', $p2[$i+9]);
				$kuru["jendral1_attack"] = ereg_replace('[^0-9]', '', $p2[$i+10]);
				$kuru["jendral1_danyang"] = ereg_replace('[^0-9]', '', $p2[$i+11]);
				$kuru["jendral2_waktu"] = ereg_replace('[^0-9]', '', $p2[$i+13])/100;
				$kuru["jendral2_alit"] = ereg_replace('[^0-9]', '', $p2[$i+14]);
				$kuru["jendral2_elite"] = ereg_replace('[^0-9]', '', $p2[$i+15]);
				$kuru["jendral2_attack"] = ereg_replace('[^0-9]', '', $p2[$i+16]);
				$kuru["jendral2_danyang"] = ereg_replace('[^0-9]', '', $p2[$i+17]);
				$kuru["jendral3_waktu"] = ereg_replace('[^0-9]', '', $p2[$i+19])/100;
				$kuru["jendral3_alit"] = ereg_replace('[^0-9]', '', $p2[$i+20]);
				$kuru["jendral3_elite"] = ereg_replace('[^0-9]', '', $p2[$i+21]);
				$kuru["jendral3_attack"] = ereg_replace('[^0-9]', '', $p2[$i+22]);
				$kuru["jendral3_danyang"] = ereg_replace('[^0-9]', '', $p2[$i+23]);
				$kuru["jendral4_waktu"] = ereg_replace('[^0-9]', '', $p2[$i+25])/100;
				$kuru["jendral4_alit"] = ereg_replace('[^0-9]', '', $p2[$i+26]);
				$kuru["jendral4_elite"] = ereg_replace('[^0-9]', '', $p2[$i+27]);
				$kuru["jendral4_attack"] = ereg_replace('[^0-9]', '', $p2[$i+28]);
				$kuru["jendral4_danyang"] = ereg_replace('[^0-9]', '', $p2[$i+29]);
				$kuru["jendral5_waktu"] = ereg_replace('[^0-9]', '', $p2[$i+31])/100;
				$kuru["jendral5_alit"] = ereg_replace('[^0-9]', '', $p2[$i+32]);
				$kuru["jendral5_elite"] = ereg_replace('[^0-9]', '', $p2[$i+33]);
				$kuru["jendral5_attack"] = ereg_replace('[^0-9]', '', $p2[$i+34]);
				$kuru["jendral5_danyang"] = ereg_replace('[^0-9]', '', $p2[$i+35]);
			}
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// LOGOUT
	function logout() {
		eval($this->load_var);
		eval($this->time_start);
		echo "LOGOUT ";
		$http->get_url($kuru['logout']);
		$this->clear_nol();
		eval($this->time_stop);
		$this->total_stop = $this->getmicrotime();
		echo "TOTAL PROCESS : ".($this->total_stop-$this->total_start)."\n";
	}
	// GET DATA EXPLORE
	function data_eksplorasi() {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET DATA EXPLORE ";
		$http->get_url($kuru['eksplorasi_url']);
		$piece = explode("\n", strip_tags($http->get_body(), '<option>'));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = str_replace(':', "\n", $vv);
			$vv = str_replace('-', "\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			unset($lstatus);
			$kstatus = array_search(strtolower(trim($p2[$i])), $estat);
			if ($kstatus) $kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
		}
		$kuru['kebutuhan_alit'] =	$kuru['kebutuhan_jatayu_alit'] + 
									$kuru['kebutuhan_kurawa_alit'] + 
									$kuru['kebutuhan_ksatriya_alit'] + 
									$kuru['kebutuhan_dedemit_alit'] +
									$kuru['kebutuhan_raksasa_alit'] +
									$kuru['kebutuhan_wanamarta_alit'];
		$kuru['jumlah_maksimal_tongkat'] =	$kuru['jumlah_maksimal_tongkat_jatayu'] + 
											$kuru['jumlah_maksimal_tongkat_kurawa'] + 
											$kuru['jumlah_maksimal_tongkat_ksatriya'] + 
											$kuru['jumlah_maksimal_tongkat_dedemit'] +
											$kuru['jumlah_maksimal_tongkat_raksasa'] +
											$kuru['jumlah_maksimal_tongkat_wanamarta'];
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// DO EXPLORE
	function eksplorasi($depa='10') {
		eval($this->load_var);
		eval($this->time_start);
		if ($kuru['akan_datang_tongkat_baru']=='' ||
			$kuru['kebutuhan_alit']=='') { $this->data_eksplorasi();}
		if ($kuru['draft_pasukan_saat_ini']=='') { $this->data_pasukan();}
		if ($kuru['total_alit']=='') { $this->status();}
		if ($kuru['draft_pasukan_saat_ini'] < ($kuru['default_draft']-1) || 
			$kuru['akan_datang_tongkat_baru']) {echo "DO EXPLORE DRAFT, TONGKAT \033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		else if ($kuru['total_uang'] < $kuru['kebutuhan_uang']*$depa) {echo "DO EXPLORE UANG \033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		else if ($kuru['kebutuhan_alit']*$depa < $kuru['total_alit']) { echo "DO EXPLORE ALIT \033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		else if ($kuru['kebutuhan_alit']*$depa > $kuru['total_alit']) {
			$kurang_alit = $kuru['kebutuhan_alit']*$depa - $kuru['total_alit'];
			if ($kuru['resi_dimiliki']<$kurang_alit) $kurang_alit = $kuru['resi_dimiliki'];
			$this->pecat('wizard', $kurang_alit);
			$this->data_eksplorasi();
			if ($kuru['jumlah_maksimal_tongkat']<$depa) $depa = $kuru['jumlah_maksimal_tongkat'];
		}
		echo "DO EXPLORE ";
		
		$data = $kuru['eksplorasi_data'];
		$data = str_replace('[EA]', $depa, $data);
		echo "$data ";
		$http->post_url($data, $kuru['eksplorasi_url']);
		eval($this->time_stop);
	}
	// GET FIRE DATA
	function data_pecat() {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET FIRE DATA ";
		$http->get_url($kuru['pecat_url']);
		$piece = explode("\n", strip_tags($http->get_body(), '<option>'));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = str_replace(':', "\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			unset($lstatus);
			$kstatus = array_search(strtolower(trim($p2[$i])), $fstat);
			if ($kstatus) $kuru[$kstatus] = (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// DO FIRE
	function pecat($pasukan, $ratio) {
		eval($this->load_var);
		eval($this->time_start);		
		if ($kuru['biaya_memecat']=='') $this->data_pecat();
		echo "DO FIRE ARMY ";
		switch ($pasukan) {
			case 'alit': $kp = $ratio;break;
			case 'elite': $el = $ratio;break;
			case 'attack': $at = $ratio;break;
			case 'defend': $df = $ratio;break;
			case 'bandit': $ba = $ratio;break;
			case 'wizard': $wz = $ratio;break;
		}

		$data = $kuru['pecat_data'];
		$data = str_replace('[KP]', (int)$kp, $data);
		$data = str_replace('[EL]', (int)$el, $data);
		$data = str_replace('[AT]', (int)$at, $data);
		$data = str_replace('[DF]', (int)$df, $data);
		$data = str_replace('[BA]', (int)$ba, $data);
		$data = str_replace('[WZ]', (int)$wz, $data);
		if (!$el && !$at && !$df && !$ba && !$wz) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		echo "$data ";
		$http->post_url($data, $kuru['pecat_url']);
		eval($this->time_stop);
	}
	// GET BUILDING DATA
	function data_bangunan() {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET BUILDING DATA ";
		$http->get_url($kuru['bangunan_url']);
		$piece = explode("\n", strip_tags($http->get_body(), '<option>'));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = str_replace(':', "\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			unset($lstatus);
			$dibangun = (int)ereg_replace('[^0-9]', '', $p2[$i]);
			$p2[$i] = ereg_replace("\([0-9]+\)", "", $p2[$i]);
			$kstatus = array_search(strtolower(trim($p2[$i])), $bstat);
			if ($kstatus) $kuru[$kstatus] = $dibangun + (int)ereg_replace('[^0-9]', '', $p2[$i+1]);
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
	// BUILD BUILDING
	function bangunan() {
		eval($this->load_var);
		eval($this->time_start);		
		if ($kuru['harga_bangunan_tanpa_akselerasi']=='' ||
			$kuru['jumlah_tanah_kosong']) $this->data_bangunan();
		if ($kuru['luas_kerajaan']==''||
			$kuru['total_uang']=='') $this->status();
		echo "DO BUILD BUILDING ";
		if (! $kuru['jumlah_tanah_kosong']) {echo "\033[1;31m[FAILED]\033[0;39m\n";return FALSE;}
		$b_arr = array('rumah', 'sawah', 'kebun_lontar', 'sekolah', 'benteng', 'kebun_menyan', 'pasar', 'tambang', 'rumah_sakit', 'pertukangan', 'padepokan', 'candi_indra', 'ringin_kencono', 'pertapaan', 'gua_rahasia');
		$tk = $kuru['jumlah_tanah_kosong'];
		$tu = $kuru['total_uang'];
		while ($tk) {
			reset($b_arr);
			$never_build = TRUE;
			foreach ($b_arr as $k => $v) {
				$build_v = FALSE;
				if ($tu && $tk && $v=='rumah' && round($kuru[$v]*100/$kuru['luas_kerajaan']) < 25) {$build_v=1;}
				if ($tu && $tk && $v=='sawah' && round($kuru[$v]*100/$kuru['luas_kerajaan']) < 25) {$build_v=1;}
				if ($tu && $tk && $v=='kebun_lontar' && round($kuru[$v]*100/$kuru['luas_kerajaan']) < 5) {$build_v=1;}
				if ($tu && $tk && $v=='sekolah' && round($kuru[$v]*100/$kuru['luas_kerajaan']) < 15) {$build_v=1;}
				if ($tu && $tk && $v=='benteng' && round($kuru[$v]*100/$kuru['luas_kerajaan']) < 15) {$build_v=1;}
				if ($tu && $tk && $v=='kebun_menyan' && round($kuru[$v]*100/$kuru['luas_kerajaan']) < 5) {$build_v=1;}
				if ($tu && $tk && $v=='pasar' && round($kuru[$v]*100/$kuru['luas_kerajaan']) < 10) {$build_v=1;}
				if ($build_v && $tu - (2*$kuru['harga_bangunan_tanpa_akselerasi'])) {
					${$v}++;
					$tk--;
					$kuru[$v]++;
					$never_build=FALSE;
					$tu=$tu-(2*$kuru['harga_bangunan_tanpa_akselerasi']);
				}
			}
			if ($never_build && $tu - (2*$kuru['harga_bangunan_tanpa_akselerasi'])) {
				$tambang++;
				$tk--;
				$tu=$tu-(2*$kuru['harga_bangunan_tanpa_akselerasi']);
			} else if ($never_build) {
				$tk = 0;
			}
		}
		$data = $kuru['bangunan_data'];
		$data = str_replace('[RM]', (int)$rumah, $data);
		$data = str_replace('[SW]', (int)$sawah, $data);
		$data = str_replace('[KL]', (int)$kebun_lontar, $data);
		$data = str_replace('[SK]', (int)$sekolah, $data);
		$data = str_replace('[BT]', (int)$benteng, $data);
		$data = str_replace('[KM]', (int)$kebun_menyan, $data);
		$data = str_replace('[PS]', (int)$pasar, $data);
		$data = str_replace('[TB]', (int)$tambang, $data);
		$data = str_replace('[RS]', (int)$rumah_sakit, $data);
		$data = str_replace('[PT]', (int)$pertukangan, $data);
		$data = str_replace('[PD]', (int)$padepokan, $data);
		$data = str_replace('[CI]', (int)$candi_indra, $data);
		$data = str_replace('[RK]', (int)$ringin_kencono, $data);
		$data = str_replace('[PP]', (int)$pertapaan, $data);
		$data = str_replace('[GR]', (int)$gua_rahasia, $data);
		$data = str_replace('[AK]', 'on', $data);
		echo "$data ";
		$http->post_url($data, $kuru['bangunan_url']);
		eval($this->time_stop);
	}
	function init_data() {
		$this->status(); 
		$this->politik(); 
		$this->data_telik(); 
		$this->enemy_ratio(); 
		$this->data_sihir(); 
		$this->friend_ratio(); 
		$this->status_sihir(); 
		$this->data_pasukan(); 
		$this->perjalanan(); 
		$this->draft_pasukan();
		$this->telik_mahameru();
	}

	function clear_nol() {
		eval($this->load_var);
		foreach ($kuru as $k => $v) {
			if (!$v) unset($kuru[$k]);
			if (strstr($k,"_url")) unset($kuru[$k]);
			if (strstr($k,"_data")) unset($kuru[$k]);
			if (strstr($v,"http://")) unset($kuru[$k]);
		}
		reset($kuru);
	}

	// GET MAHAMERU ENEMY
	function peserta_mahameru($get_param='') {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET MAHAMERY ENEMY ";
		
		$http->get_url($kuru['peserta_mahameru_url'].$get_param);
		$piece = explode("\n", strip_tags(str_replace('</td>', "\n", strip_tags($http->get_body(), '<td><a>')), '<a>'));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			$vv = ereg_replace('href="([^"]+)"', " >\\1<br><a ", $vv);
			$vv = ereg_replace('href=\'([^\']+)\'', " >\\1<br><a ", $vv);
			$vv = ereg_replace('href=([^>]+)', " >\\1<br><a ", $vv);
			$vv = str_replace('<br>', "\n", $vv);
			$tmp .= $vv."\n";
		}
		$tmp = strip_tags($tmp);

		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			if (! $get_param && ereg(str_replace($kuru['base_url'].'/', '', $kuru['peserta_mahameru_url']), $p2[$i])) 
				$next_peserta[] = trim(ereg_replace(str_replace($kuru['base_url'].'/', '', $kuru['peserta_mahameru_url']), '', $p2[$i]));
			$kstatus = ereg('\[[0-9]+:[0-9]+\]', $p2[$i]);
			if ($kstatus) {
				$kstatus = strtolower(trim($p2[$i]));
				ereg('([^\[]+)\[([0-9]+:[0-9]+)\]', $kstatus, $regs);
				$raja = trim($regs[1]);
				$daerah = trim($regs[2]);
				$mahameru_arr[$raja] = $daerah;
				$kuru["luas_".$raja] = ereg_replace('[^0-9]', '', $p2[$i+1]);
				$kuru["nilai_".$raja] = ereg_replace('[^0-9]', '', $p2[$i+2]);
				$kuru["duel_".$raja] = ereg_replace('[^0-9]', '', $p2[$i+3]);
			}
		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
		if (! $get_param) {
			for ($i=0;$i<count($next_peserta);$i++)
				$this->peserta_mahameru($next_peserta[$i]);
			$this->ignore_mahameru();
		}
	}
	function ignore_mahameru($arr='') {
		if (! $arr) $arr =& $this->ignore_arr;
		if (! $arr) $arr = array();
		$mahameru_arr =& $this->mahameru_arr;
		reset($mahameru_arr);
		foreach ($mahameru_arr as $k => $v)
			if (in_array($k, $arr))
				unset($mahameru_arr[$k]);
		ksort($mahameru_arr);
		//print_r($mahameru_arr);
	}
	function telik_mahameru() {
		eval($this->load_var);
	
		if ($kuru['nilai_kerajaan']=='') $this->status();
		if ($kuru['masa_duel']=='') $this->puncak_mahameru();
		if ($kuru['masa_duel']) $this->peserta_mahameru();
		else return FALSE;
		$mahameru_arr =& $this->mahameru_arr;
		/*
		$uniq = array_unique($mahameru_arr);
		foreach ($uniq as $k => $v) {
			$this->data_telik($v);
		}
		*/
		reset($mahameru_arr);
		foreach ($mahameru_arr as $k => $v) {
			//echo $k." ## ".$kuru['nilai_'.$k].' ## '.$kuru['tenar_'.$k].' ## '.$kuru['tanah_'.$k]." ## ".$kuru['ratio_'.$k]."\n";
			$daftar[$kuru['nilai_'.$k]][$kuru['duel_'.$k]] = $k;
		}
		ksort($daftar);
		//print_r($daftar);
		foreach ($daftar as $k => $v) {
			if ($k <= (int)($kuru['nilai_kerajaan']*$kuru['minimum_setara'])) { unset($daftar[$k]); /*echo "unset $k\n";*/}
			else if ($k >= (int)($kuru['nilai_kerajaan']*$kuru['maksimum_setara'])) { unset($daftar[$k]); /*echo "unset $k\n";*/}
			else { $baru[] = $v[key($v)];}

		}
		if (count($baru)) ksort($baru);
		srand ((float) microtime() * 10000000);
		if (count($baru)) $rand_target = array_rand ($baru);
		$target = $mahameru_arr[$baru[$rand_target]].':'.$baru[$rand_target];
		$this->data_telik($target);
		//$this->telik('mencuri_uang', $target);
		//echo "target: $target\n";
	}
	function puncak_mahameru() {
		eval($this->load_var);
		eval($this->time_start);
		echo "GET MAHAMERU STATUS ";
		
		$http->get_url($kuru['puncak_mahameru_url']);
		$piece = explode("\n", strtolower(strip_tags($http->get_body())));
		foreach ($piece as $kk => $vv) {
			if (trim($vv)=='') continue;
			//$vv = str_replace('[', "\n", $vv);
			//$vv = str_replace(']', "\n", $vv);
			$tmp .= $vv."\n";
		}
		unset($piece);
		$p2 = explode("\n", $tmp);
		for ($i=0;$i<count($p2);$i++) {
			if (strstr($p2[$i], strtolower('Masa duel belum dimulai')))
				$kuru['masa_duel'] = FALSE;
			else if (strstr($p2[$i], strtolower('Nilai Duel anda')))
				$kuru['masa_duel'] = TRUE;
			//else if (strstr($p2[$i], strtolower('Saat ini kerajaan anda telah mendapatkan ijin dari Bathara Guru untuk memasuki kawasan Puncak Mahameru.')))
			//	$kuru['ijin_mahameru'] = TRUE;
			//else if (strstr($p2[$i], strtolower('Syarat Minimal mengikuti duel di Puncak Mahameru')))
			//	$kuru['ijin_mahameru'] = FALSE;

		}
		unset($tmp);unset($p2);
		eval($this->time_stop);
	}
}

} // end of define
?>

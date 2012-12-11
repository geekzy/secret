<?php

// Global variable for table object
$master_siswa = NULL;

//
// Table class for master_siswa
//
class cmaster_siswa {
	var $TableVar = 'master_siswa';
	var $TableName = 'master_siswa';
	var $TableType = 'TABLE';
	var $no_absen;
	var $A_nis_nasional;
	var $A_nama_Lengkap;
	var $A_nama_panggilan;
	var $A_jenis_kelamin;
	var $A_tempat_lahir;
	var $A_tanggal_lahir;
	var $A_agama;
	var $A_kewarganegaraan;
	var $A_anak_keberapa;
	var $A_jumlah_saudara_kandung;
	var $A_jumlah_saudara_tiri;
	var $A_jumlah_saudara_angkat;
	var $A_status_yatim;
	var $A_bahasa;
	var $B_alamat;
	var $B_telepon_rumah;
	var $B_tinggal;
	var $B_jarak;
	var $B_hp;
	var $C_golongan_darah;
	var $C_penyakit;
	var $C_jasmani;
	var $C_tinggi;
	var $C_berat;
	var $D_tamatan_dari;
	var $D_sttb;
	var $D_tanggal_sttb;
	var $D_danum;
	var $D_tanggal_danum;
	var $D_lama_belajar;
	var $D_dari_sekolah;
	var $D_alasan;
	var $D_kelas;
	var $D_kelompok;
	var $D_tanggal;
	var $D_saat_ini_tingkat;
	var $D_saat_ini_kelas;
	var $D_saat_ini_kelompok;
	var $D_no_psb;
	var $D_nilai_danum_sd;
	var $D_jumlah_pelajaran_danum;
	var $D_nilai_ujian_psb;
	var $D_tahun_psb;
	var $D_diterima;
	var $D_spp;
	var $D_spp_potongan;
	var $D_status_lama_baru;
	var $E_nama_ayah;
	var $E_tempat_lahir;
	var $E_tanggal_lahir;
	var $E_agama;
	var $E_kewarganegaraan;
	var $E_pendidikan;
	var $E_pekerjaan;
	var $E_pengeluaran;
	var $E_alamat;
	var $E_telepon;
	var $E_hp;
	var $E_hidup;
	var $F_nama_ibu;
	var $F_tempat_lahir;
	var $F_tanggal_lahir;
	var $F_agama;
	var $F_kewarganegaraan;
	var $F_pendidikan;
	var $F_pekerjaan;
	var $F_pengeluaran;
	var $F_alamat;
	var $F_telepon;
	var $F_hp;
	var $F_hidup;
	var $G_nama_wali;
	var $G_tempat_lahir;
	var $G_tanggal_lahir;
	var $G_agama;
	var $G_kewarganegaraan;
	var $G_pendidikan;
	var $G_pekerjaan;
	var $G_pengeluaran;
	var $G_alamat;
	var $G_telepon;
	var $G_hp;
	var $H_kesenian;
	var $H_olahraga;
	var $H_kemasyarakatan;
	var $H_lainlain;
	var $I_tanggal_meninggalkan;
	var $I_alasan;
	var $I_tanggal_lulus;
	var $I_sttb;
	var $I_danum;
	var $I_nilai_danum_smp;
	var $I_tahun1;
	var $I_tahun2;
	var $I_tahun3;
	var $I_tk1;
	var $I_tk2;
	var $I_tk3;
	var $I_dari1;
	var $I_dari2;
	var $I_dari3;
	var $J_melanjutkan;
	var $J_tanggal_bekerja;
	var $J_nama_perusahaan;
	var $J_penghasilan;
	var $kode_otomatis;
	var $apakah_valid;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = FALSE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes

	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = FALSE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 2;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function cmaster_siswa() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// no_absen
		$this->no_absen = new cField('master_siswa', 'master_siswa', 'x_no_absen', 'no_absen', '`no_absen`', 2, -1, FALSE, '`no_absen`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->no_absen->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['no_absen'] =& $this->no_absen;

		// A_nis_nasional
		$this->A_nis_nasional = new cField('master_siswa', 'master_siswa', 'x_A_nis_nasional', 'A_nis_nasional', '`A_nis_nasional`', 200, -1, FALSE, '`A_nis_nasional`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_nis_nasional'] =& $this->A_nis_nasional;

		// A_nama_Lengkap
		$this->A_nama_Lengkap = new cField('master_siswa', 'master_siswa', 'x_A_nama_Lengkap', 'A_nama_Lengkap', '`A_nama_Lengkap`', 200, -1, FALSE, '`A_nama_Lengkap`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_nama_Lengkap'] =& $this->A_nama_Lengkap;

		// A_nama_panggilan
		$this->A_nama_panggilan = new cField('master_siswa', 'master_siswa', 'x_A_nama_panggilan', 'A_nama_panggilan', '`A_nama_panggilan`', 200, -1, FALSE, '`A_nama_panggilan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_nama_panggilan'] =& $this->A_nama_panggilan;

		// A_jenis_kelamin
		$this->A_jenis_kelamin = new cField('master_siswa', 'master_siswa', 'x_A_jenis_kelamin', 'A_jenis_kelamin', '`A_jenis_kelamin`', 200, -1, FALSE, '`A_jenis_kelamin`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_jenis_kelamin'] =& $this->A_jenis_kelamin;

		// A_tempat_lahir
		$this->A_tempat_lahir = new cField('master_siswa', 'master_siswa', 'x_A_tempat_lahir', 'A_tempat_lahir', '`A_tempat_lahir`', 200, -1, FALSE, '`A_tempat_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_tempat_lahir'] =& $this->A_tempat_lahir;

		// A_tanggal_lahir
		$this->A_tanggal_lahir = new cField('master_siswa', 'master_siswa', 'x_A_tanggal_lahir', 'A_tanggal_lahir', '`A_tanggal_lahir`', 135, 7, FALSE, '`A_tanggal_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->A_tanggal_lahir->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['A_tanggal_lahir'] =& $this->A_tanggal_lahir;

		// A_agama
		$this->A_agama = new cField('master_siswa', 'master_siswa', 'x_A_agama', 'A_agama', '`A_agama`', 200, -1, FALSE, '`A_agama`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_agama'] =& $this->A_agama;

		// A_kewarganegaraan
		$this->A_kewarganegaraan = new cField('master_siswa', 'master_siswa', 'x_A_kewarganegaraan', 'A_kewarganegaraan', '`A_kewarganegaraan`', 200, -1, FALSE, '`A_kewarganegaraan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_kewarganegaraan'] =& $this->A_kewarganegaraan;

		// A_anak_keberapa
		$this->A_anak_keberapa = new cField('master_siswa', 'master_siswa', 'x_A_anak_keberapa', 'A_anak_keberapa', '`A_anak_keberapa`', 17, -1, FALSE, '`A_anak_keberapa`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->A_anak_keberapa->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['A_anak_keberapa'] =& $this->A_anak_keberapa;

		// A_jumlah_saudara_kandung
		$this->A_jumlah_saudara_kandung = new cField('master_siswa', 'master_siswa', 'x_A_jumlah_saudara_kandung', 'A_jumlah_saudara_kandung', '`A_jumlah_saudara_kandung`', 17, -1, FALSE, '`A_jumlah_saudara_kandung`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->A_jumlah_saudara_kandung->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['A_jumlah_saudara_kandung'] =& $this->A_jumlah_saudara_kandung;

		// A_jumlah_saudara_tiri
		$this->A_jumlah_saudara_tiri = new cField('master_siswa', 'master_siswa', 'x_A_jumlah_saudara_tiri', 'A_jumlah_saudara_tiri', '`A_jumlah_saudara_tiri`', 17, -1, FALSE, '`A_jumlah_saudara_tiri`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->A_jumlah_saudara_tiri->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['A_jumlah_saudara_tiri'] =& $this->A_jumlah_saudara_tiri;

		// A_jumlah_saudara_angkat
		$this->A_jumlah_saudara_angkat = new cField('master_siswa', 'master_siswa', 'x_A_jumlah_saudara_angkat', 'A_jumlah_saudara_angkat', '`A_jumlah_saudara_angkat`', 17, -1, FALSE, '`A_jumlah_saudara_angkat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->A_jumlah_saudara_angkat->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['A_jumlah_saudara_angkat'] =& $this->A_jumlah_saudara_angkat;

		// A_status_yatim
		$this->A_status_yatim = new cField('master_siswa', 'master_siswa', 'x_A_status_yatim', 'A_status_yatim', '`A_status_yatim`', 200, -1, FALSE, '`A_status_yatim`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_status_yatim'] =& $this->A_status_yatim;

		// A_bahasa
		$this->A_bahasa = new cField('master_siswa', 'master_siswa', 'x_A_bahasa', 'A_bahasa', '`A_bahasa`', 200, -1, FALSE, '`A_bahasa`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_bahasa'] =& $this->A_bahasa;

		// B_alamat
		$this->B_alamat = new cField('master_siswa', 'master_siswa', 'x_B_alamat', 'B_alamat', '`B_alamat`', 200, -1, FALSE, '`B_alamat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['B_alamat'] =& $this->B_alamat;

		// B_telepon_rumah
		$this->B_telepon_rumah = new cField('master_siswa', 'master_siswa', 'x_B_telepon_rumah', 'B_telepon_rumah', '`B_telepon_rumah`', 200, -1, FALSE, '`B_telepon_rumah`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['B_telepon_rumah'] =& $this->B_telepon_rumah;

		// B_tinggal
		$this->B_tinggal = new cField('master_siswa', 'master_siswa', 'x_B_tinggal', 'B_tinggal', '`B_tinggal`', 200, -1, FALSE, '`B_tinggal`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['B_tinggal'] =& $this->B_tinggal;

		// B_jarak
		$this->B_jarak = new cField('master_siswa', 'master_siswa', 'x_B_jarak', 'B_jarak', '`B_jarak`', 2, -1, FALSE, '`B_jarak`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->B_jarak->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['B_jarak'] =& $this->B_jarak;

		// B_hp
		$this->B_hp = new cField('master_siswa', 'master_siswa', 'x_B_hp', 'B_hp', '`B_hp`', 200, -1, FALSE, '`B_hp`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['B_hp'] =& $this->B_hp;

		// C_golongan_darah
		$this->C_golongan_darah = new cField('master_siswa', 'master_siswa', 'x_C_golongan_darah', 'C_golongan_darah', '`C_golongan_darah`', 200, -1, FALSE, '`C_golongan_darah`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['C_golongan_darah'] =& $this->C_golongan_darah;

		// C_penyakit
		$this->C_penyakit = new cField('master_siswa', 'master_siswa', 'x_C_penyakit', 'C_penyakit', '`C_penyakit`', 200, -1, FALSE, '`C_penyakit`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['C_penyakit'] =& $this->C_penyakit;

		// C_jasmani
		$this->C_jasmani = new cField('master_siswa', 'master_siswa', 'x_C_jasmani', 'C_jasmani', '`C_jasmani`', 200, -1, FALSE, '`C_jasmani`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['C_jasmani'] =& $this->C_jasmani;

		// C_tinggi
		$this->C_tinggi = new cField('master_siswa', 'master_siswa', 'x_C_tinggi', 'C_tinggi', '`C_tinggi`', 2, -1, FALSE, '`C_tinggi`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->C_tinggi->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['C_tinggi'] =& $this->C_tinggi;

		// C_berat
		$this->C_berat = new cField('master_siswa', 'master_siswa', 'x_C_berat', 'C_berat', '`C_berat`', 2, -1, FALSE, '`C_berat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->C_berat->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['C_berat'] =& $this->C_berat;

		// D_tamatan_dari
		$this->D_tamatan_dari = new cField('master_siswa', 'master_siswa', 'x_D_tamatan_dari', 'D_tamatan_dari', '`D_tamatan_dari`', 200, -1, FALSE, '`D_tamatan_dari`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_tamatan_dari'] =& $this->D_tamatan_dari;

		// D_sttb
		$this->D_sttb = new cField('master_siswa', 'master_siswa', 'x_D_sttb', 'D_sttb', '`D_sttb`', 200, -1, FALSE, '`D_sttb`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_sttb'] =& $this->D_sttb;

		// D_tanggal_sttb
		$this->D_tanggal_sttb = new cField('master_siswa', 'master_siswa', 'x_D_tanggal_sttb', 'D_tanggal_sttb', '`D_tanggal_sttb`', 135, 7, FALSE, '`D_tanggal_sttb`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_tanggal_sttb->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['D_tanggal_sttb'] =& $this->D_tanggal_sttb;

		// D_danum
		$this->D_danum = new cField('master_siswa', 'master_siswa', 'x_D_danum', 'D_danum', '`D_danum`', 200, -1, FALSE, '`D_danum`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_danum'] =& $this->D_danum;

		// D_tanggal_danum
		$this->D_tanggal_danum = new cField('master_siswa', 'master_siswa', 'x_D_tanggal_danum', 'D_tanggal_danum', '`D_tanggal_danum`', 135, 7, FALSE, '`D_tanggal_danum`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_tanggal_danum->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['D_tanggal_danum'] =& $this->D_tanggal_danum;

		// D_lama_belajar
		$this->D_lama_belajar = new cField('master_siswa', 'master_siswa', 'x_D_lama_belajar', 'D_lama_belajar', '`D_lama_belajar`', 2, -1, FALSE, '`D_lama_belajar`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_lama_belajar->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['D_lama_belajar'] =& $this->D_lama_belajar;

		// D_dari_sekolah
		$this->D_dari_sekolah = new cField('master_siswa', 'master_siswa', 'x_D_dari_sekolah', 'D_dari_sekolah', '`D_dari_sekolah`', 200, -1, FALSE, '`D_dari_sekolah`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_dari_sekolah'] =& $this->D_dari_sekolah;

		// D_alasan
		$this->D_alasan = new cField('master_siswa', 'master_siswa', 'x_D_alasan', 'D_alasan', '`D_alasan`', 200, -1, FALSE, '`D_alasan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_alasan'] =& $this->D_alasan;

		// D_kelas
		$this->D_kelas = new cField('master_siswa', 'master_siswa', 'x_D_kelas', 'D_kelas', '`D_kelas`', 200, -1, FALSE, '`D_kelas`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_kelas'] =& $this->D_kelas;

		// D_kelompok
		$this->D_kelompok = new cField('master_siswa', 'master_siswa', 'x_D_kelompok', 'D_kelompok', '`D_kelompok`', 200, -1, FALSE, '`D_kelompok`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_kelompok'] =& $this->D_kelompok;

		// D_tanggal
		$this->D_tanggal = new cField('master_siswa', 'master_siswa', 'x_D_tanggal', 'D_tanggal', '`D_tanggal`', 135, 7, FALSE, '`D_tanggal`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_tanggal->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['D_tanggal'] =& $this->D_tanggal;

		// D_saat_ini_tingkat
		$this->D_saat_ini_tingkat = new cField('master_siswa', 'master_siswa', 'x_D_saat_ini_tingkat', 'D_saat_ini_tingkat', '`D_saat_ini_tingkat`', 200, -1, FALSE, '`D_saat_ini_tingkat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_saat_ini_tingkat'] =& $this->D_saat_ini_tingkat;

		// D_saat_ini_kelas
		$this->D_saat_ini_kelas = new cField('master_siswa', 'master_siswa', 'x_D_saat_ini_kelas', 'D_saat_ini_kelas', '`D_saat_ini_kelas`', 200, -1, FALSE, '`D_saat_ini_kelas`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_saat_ini_kelas'] =& $this->D_saat_ini_kelas;

		// D_saat_ini_kelompok
		$this->D_saat_ini_kelompok = new cField('master_siswa', 'master_siswa', 'x_D_saat_ini_kelompok', 'D_saat_ini_kelompok', '`D_saat_ini_kelompok`', 200, -1, FALSE, '`D_saat_ini_kelompok`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_saat_ini_kelompok'] =& $this->D_saat_ini_kelompok;

		// D_no_psb
		$this->D_no_psb = new cField('master_siswa', 'master_siswa', 'x_D_no_psb', 'D_no_psb', '`D_no_psb`', 200, -1, FALSE, '`D_no_psb`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_no_psb'] =& $this->D_no_psb;

		// D_nilai_danum_sd
		$this->D_nilai_danum_sd = new cField('master_siswa', 'master_siswa', 'x_D_nilai_danum_sd', 'D_nilai_danum_sd', '`D_nilai_danum_sd`', 5, -1, FALSE, '`D_nilai_danum_sd`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_nilai_danum_sd->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['D_nilai_danum_sd'] =& $this->D_nilai_danum_sd;

		// D_jumlah_pelajaran_danum
		$this->D_jumlah_pelajaran_danum = new cField('master_siswa', 'master_siswa', 'x_D_jumlah_pelajaran_danum', 'D_jumlah_pelajaran_danum', '`D_jumlah_pelajaran_danum`', 3, -1, FALSE, '`D_jumlah_pelajaran_danum`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_jumlah_pelajaran_danum->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['D_jumlah_pelajaran_danum'] =& $this->D_jumlah_pelajaran_danum;

		// D_nilai_ujian_psb
		$this->D_nilai_ujian_psb = new cField('master_siswa', 'master_siswa', 'x_D_nilai_ujian_psb', 'D_nilai_ujian_psb', '`D_nilai_ujian_psb`', 5, -1, FALSE, '`D_nilai_ujian_psb`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_nilai_ujian_psb->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['D_nilai_ujian_psb'] =& $this->D_nilai_ujian_psb;

		// D_tahun_psb
		$this->D_tahun_psb = new cField('master_siswa', 'master_siswa', 'x_D_tahun_psb', 'D_tahun_psb', '`D_tahun_psb`', 200, -1, FALSE, '`D_tahun_psb`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_tahun_psb'] =& $this->D_tahun_psb;

		// D_diterima
		$this->D_diterima = new cField('master_siswa', 'master_siswa', 'x_D_diterima', 'D_diterima', '`D_diterima`', 200, -1, FALSE, '`D_diterima`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_diterima'] =& $this->D_diterima;

		// D_spp
		$this->D_spp = new cField('master_siswa', 'master_siswa', 'x_D_spp', 'D_spp', '`D_spp`', 5, -1, FALSE, '`D_spp`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_spp->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['D_spp'] =& $this->D_spp;

		// D_spp_potongan
		$this->D_spp_potongan = new cField('master_siswa', 'master_siswa', 'x_D_spp_potongan', 'D_spp_potongan', '`D_spp_potongan`', 5, -1, FALSE, '`D_spp_potongan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->D_spp_potongan->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['D_spp_potongan'] =& $this->D_spp_potongan;

		// D_status_lama_baru
		$this->D_status_lama_baru = new cField('master_siswa', 'master_siswa', 'x_D_status_lama_baru', 'D_status_lama_baru', '`D_status_lama_baru`', 200, -1, FALSE, '`D_status_lama_baru`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D_status_lama_baru'] =& $this->D_status_lama_baru;

		// E_nama_ayah
		$this->E_nama_ayah = new cField('master_siswa', 'master_siswa', 'x_E_nama_ayah', 'E_nama_ayah', '`E_nama_ayah`', 200, -1, FALSE, '`E_nama_ayah`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_nama_ayah'] =& $this->E_nama_ayah;

		// E_tempat_lahir
		$this->E_tempat_lahir = new cField('master_siswa', 'master_siswa', 'x_E_tempat_lahir', 'E_tempat_lahir', '`E_tempat_lahir`', 200, -1, FALSE, '`E_tempat_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_tempat_lahir'] =& $this->E_tempat_lahir;

		// E_tanggal_lahir
		$this->E_tanggal_lahir = new cField('master_siswa', 'master_siswa', 'x_E_tanggal_lahir', 'E_tanggal_lahir', '`E_tanggal_lahir`', 135, 7, FALSE, '`E_tanggal_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->E_tanggal_lahir->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['E_tanggal_lahir'] =& $this->E_tanggal_lahir;

		// E_agama
		$this->E_agama = new cField('master_siswa', 'master_siswa', 'x_E_agama', 'E_agama', '`E_agama`', 200, -1, FALSE, '`E_agama`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_agama'] =& $this->E_agama;

		// E_kewarganegaraan
		$this->E_kewarganegaraan = new cField('master_siswa', 'master_siswa', 'x_E_kewarganegaraan', 'E_kewarganegaraan', '`E_kewarganegaraan`', 200, -1, FALSE, '`E_kewarganegaraan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_kewarganegaraan'] =& $this->E_kewarganegaraan;

		// E_pendidikan
		$this->E_pendidikan = new cField('master_siswa', 'master_siswa', 'x_E_pendidikan', 'E_pendidikan', '`E_pendidikan`', 200, -1, FALSE, '`E_pendidikan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_pendidikan'] =& $this->E_pendidikan;

		// E_pekerjaan
		$this->E_pekerjaan = new cField('master_siswa', 'master_siswa', 'x_E_pekerjaan', 'E_pekerjaan', '`E_pekerjaan`', 200, -1, FALSE, '`E_pekerjaan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_pekerjaan'] =& $this->E_pekerjaan;

		// E_pengeluaran
		$this->E_pengeluaran = new cField('master_siswa', 'master_siswa', 'x_E_pengeluaran', 'E_pengeluaran', '`E_pengeluaran`', 5, -1, FALSE, '`E_pengeluaran`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->E_pengeluaran->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['E_pengeluaran'] =& $this->E_pengeluaran;

		// E_alamat
		$this->E_alamat = new cField('master_siswa', 'master_siswa', 'x_E_alamat', 'E_alamat', '`E_alamat`', 200, -1, FALSE, '`E_alamat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_alamat'] =& $this->E_alamat;

		// E_telepon
		$this->E_telepon = new cField('master_siswa', 'master_siswa', 'x_E_telepon', 'E_telepon', '`E_telepon`', 200, -1, FALSE, '`E_telepon`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_telepon'] =& $this->E_telepon;

		// E_hp
		$this->E_hp = new cField('master_siswa', 'master_siswa', 'x_E_hp', 'E_hp', '`E_hp`', 200, -1, FALSE, '`E_hp`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_hp'] =& $this->E_hp;

		// E_hidup
		$this->E_hidup = new cField('master_siswa', 'master_siswa', 'x_E_hidup', 'E_hidup', '`E_hidup`', 200, -1, FALSE, '`E_hidup`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['E_hidup'] =& $this->E_hidup;

		// F_nama_ibu
		$this->F_nama_ibu = new cField('master_siswa', 'master_siswa', 'x_F_nama_ibu', 'F_nama_ibu', '`F_nama_ibu`', 200, -1, FALSE, '`F_nama_ibu`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_nama_ibu'] =& $this->F_nama_ibu;

		// F_tempat_lahir
		$this->F_tempat_lahir = new cField('master_siswa', 'master_siswa', 'x_F_tempat_lahir', 'F_tempat_lahir', '`F_tempat_lahir`', 200, -1, FALSE, '`F_tempat_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_tempat_lahir'] =& $this->F_tempat_lahir;

		// F_tanggal_lahir
		$this->F_tanggal_lahir = new cField('master_siswa', 'master_siswa', 'x_F_tanggal_lahir', 'F_tanggal_lahir', '`F_tanggal_lahir`', 135, 7, FALSE, '`F_tanggal_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->F_tanggal_lahir->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['F_tanggal_lahir'] =& $this->F_tanggal_lahir;

		// F_agama
		$this->F_agama = new cField('master_siswa', 'master_siswa', 'x_F_agama', 'F_agama', '`F_agama`', 200, -1, FALSE, '`F_agama`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_agama'] =& $this->F_agama;

		// F_kewarganegaraan
		$this->F_kewarganegaraan = new cField('master_siswa', 'master_siswa', 'x_F_kewarganegaraan', 'F_kewarganegaraan', '`F_kewarganegaraan`', 200, -1, FALSE, '`F_kewarganegaraan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_kewarganegaraan'] =& $this->F_kewarganegaraan;

		// F_pendidikan
		$this->F_pendidikan = new cField('master_siswa', 'master_siswa', 'x_F_pendidikan', 'F_pendidikan', '`F_pendidikan`', 200, -1, FALSE, '`F_pendidikan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_pendidikan'] =& $this->F_pendidikan;

		// F_pekerjaan
		$this->F_pekerjaan = new cField('master_siswa', 'master_siswa', 'x_F_pekerjaan', 'F_pekerjaan', '`F_pekerjaan`', 200, -1, FALSE, '`F_pekerjaan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_pekerjaan'] =& $this->F_pekerjaan;

		// F_pengeluaran
		$this->F_pengeluaran = new cField('master_siswa', 'master_siswa', 'x_F_pengeluaran', 'F_pengeluaran', '`F_pengeluaran`', 5, -1, FALSE, '`F_pengeluaran`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->F_pengeluaran->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['F_pengeluaran'] =& $this->F_pengeluaran;

		// F_alamat
		$this->F_alamat = new cField('master_siswa', 'master_siswa', 'x_F_alamat', 'F_alamat', '`F_alamat`', 200, -1, FALSE, '`F_alamat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_alamat'] =& $this->F_alamat;

		// F_telepon
		$this->F_telepon = new cField('master_siswa', 'master_siswa', 'x_F_telepon', 'F_telepon', '`F_telepon`', 200, -1, FALSE, '`F_telepon`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_telepon'] =& $this->F_telepon;

		// F_hp
		$this->F_hp = new cField('master_siswa', 'master_siswa', 'x_F_hp', 'F_hp', '`F_hp`', 200, -1, FALSE, '`F_hp`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_hp'] =& $this->F_hp;

		// F_hidup
		$this->F_hidup = new cField('master_siswa', 'master_siswa', 'x_F_hidup', 'F_hidup', '`F_hidup`', 200, -1, FALSE, '`F_hidup`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['F_hidup'] =& $this->F_hidup;

		// G_nama_wali
		$this->G_nama_wali = new cField('master_siswa', 'master_siswa', 'x_G_nama_wali', 'G_nama_wali', '`G_nama_wali`', 200, -1, FALSE, '`G_nama_wali`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_nama_wali'] =& $this->G_nama_wali;

		// G_tempat_lahir
		$this->G_tempat_lahir = new cField('master_siswa', 'master_siswa', 'x_G_tempat_lahir', 'G_tempat_lahir', '`G_tempat_lahir`', 200, -1, FALSE, '`G_tempat_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_tempat_lahir'] =& $this->G_tempat_lahir;

		// G_tanggal_lahir
		$this->G_tanggal_lahir = new cField('master_siswa', 'master_siswa', 'x_G_tanggal_lahir', 'G_tanggal_lahir', '`G_tanggal_lahir`', 135, 7, FALSE, '`G_tanggal_lahir`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->G_tanggal_lahir->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['G_tanggal_lahir'] =& $this->G_tanggal_lahir;

		// G_agama
		$this->G_agama = new cField('master_siswa', 'master_siswa', 'x_G_agama', 'G_agama', '`G_agama`', 200, -1, FALSE, '`G_agama`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_agama'] =& $this->G_agama;

		// G_kewarganegaraan
		$this->G_kewarganegaraan = new cField('master_siswa', 'master_siswa', 'x_G_kewarganegaraan', 'G_kewarganegaraan', '`G_kewarganegaraan`', 200, -1, FALSE, '`G_kewarganegaraan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_kewarganegaraan'] =& $this->G_kewarganegaraan;

		// G_pendidikan
		$this->G_pendidikan = new cField('master_siswa', 'master_siswa', 'x_G_pendidikan', 'G_pendidikan', '`G_pendidikan`', 200, -1, FALSE, '`G_pendidikan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_pendidikan'] =& $this->G_pendidikan;

		// G_pekerjaan
		$this->G_pekerjaan = new cField('master_siswa', 'master_siswa', 'x_G_pekerjaan', 'G_pekerjaan', '`G_pekerjaan`', 200, -1, FALSE, '`G_pekerjaan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_pekerjaan'] =& $this->G_pekerjaan;

		// G_pengeluaran
		$this->G_pengeluaran = new cField('master_siswa', 'master_siswa', 'x_G_pengeluaran', 'G_pengeluaran', '`G_pengeluaran`', 5, -1, FALSE, '`G_pengeluaran`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->G_pengeluaran->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['G_pengeluaran'] =& $this->G_pengeluaran;

		// G_alamat
		$this->G_alamat = new cField('master_siswa', 'master_siswa', 'x_G_alamat', 'G_alamat', '`G_alamat`', 200, -1, FALSE, '`G_alamat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_alamat'] =& $this->G_alamat;

		// G_telepon
		$this->G_telepon = new cField('master_siswa', 'master_siswa', 'x_G_telepon', 'G_telepon', '`G_telepon`', 200, -1, FALSE, '`G_telepon`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_telepon'] =& $this->G_telepon;

		// G_hp
		$this->G_hp = new cField('master_siswa', 'master_siswa', 'x_G_hp', 'G_hp', '`G_hp`', 200, -1, FALSE, '`G_hp`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['G_hp'] =& $this->G_hp;

		// H_kesenian
		$this->H_kesenian = new cField('master_siswa', 'master_siswa', 'x_H_kesenian', 'H_kesenian', '`H_kesenian`', 200, -1, FALSE, '`H_kesenian`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['H_kesenian'] =& $this->H_kesenian;

		// H_olahraga
		$this->H_olahraga = new cField('master_siswa', 'master_siswa', 'x_H_olahraga', 'H_olahraga', '`H_olahraga`', 200, -1, FALSE, '`H_olahraga`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['H_olahraga'] =& $this->H_olahraga;

		// H_kemasyarakatan
		$this->H_kemasyarakatan = new cField('master_siswa', 'master_siswa', 'x_H_kemasyarakatan', 'H_kemasyarakatan', '`H_kemasyarakatan`', 200, -1, FALSE, '`H_kemasyarakatan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['H_kemasyarakatan'] =& $this->H_kemasyarakatan;

		// H_lainlain
		$this->H_lainlain = new cField('master_siswa', 'master_siswa', 'x_H_lainlain', 'H_lainlain', '`H_lainlain`', 200, -1, FALSE, '`H_lainlain`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['H_lainlain'] =& $this->H_lainlain;

		// I_tanggal_meninggalkan
		$this->I_tanggal_meninggalkan = new cField('master_siswa', 'master_siswa', 'x_I_tanggal_meninggalkan', 'I_tanggal_meninggalkan', '`I_tanggal_meninggalkan`', 135, 7, FALSE, '`I_tanggal_meninggalkan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->I_tanggal_meninggalkan->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['I_tanggal_meninggalkan'] =& $this->I_tanggal_meninggalkan;

		// I_alasan
		$this->I_alasan = new cField('master_siswa', 'master_siswa', 'x_I_alasan', 'I_alasan', '`I_alasan`', 200, -1, FALSE, '`I_alasan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_alasan'] =& $this->I_alasan;

		// I_tanggal_lulus
		$this->I_tanggal_lulus = new cField('master_siswa', 'master_siswa', 'x_I_tanggal_lulus', 'I_tanggal_lulus', '`I_tanggal_lulus`', 135, 7, FALSE, '`I_tanggal_lulus`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->I_tanggal_lulus->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['I_tanggal_lulus'] =& $this->I_tanggal_lulus;

		// I_sttb
		$this->I_sttb = new cField('master_siswa', 'master_siswa', 'x_I_sttb', 'I_sttb', '`I_sttb`', 200, -1, FALSE, '`I_sttb`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_sttb'] =& $this->I_sttb;

		// I_danum
		$this->I_danum = new cField('master_siswa', 'master_siswa', 'x_I_danum', 'I_danum', '`I_danum`', 200, -1, FALSE, '`I_danum`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_danum'] =& $this->I_danum;

		// I_nilai_danum_smp
		$this->I_nilai_danum_smp = new cField('master_siswa', 'master_siswa', 'x_I_nilai_danum_smp', 'I_nilai_danum_smp', '`I_nilai_danum_smp`', 5, -1, FALSE, '`I_nilai_danum_smp`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->I_nilai_danum_smp->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['I_nilai_danum_smp'] =& $this->I_nilai_danum_smp;

		// I_tahun1
		$this->I_tahun1 = new cField('master_siswa', 'master_siswa', 'x_I_tahun1', 'I_tahun1', '`I_tahun1`', 200, -1, FALSE, '`I_tahun1`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_tahun1'] =& $this->I_tahun1;

		// I_tahun2
		$this->I_tahun2 = new cField('master_siswa', 'master_siswa', 'x_I_tahun2', 'I_tahun2', '`I_tahun2`', 200, -1, FALSE, '`I_tahun2`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_tahun2'] =& $this->I_tahun2;

		// I_tahun3
		$this->I_tahun3 = new cField('master_siswa', 'master_siswa', 'x_I_tahun3', 'I_tahun3', '`I_tahun3`', 200, -1, FALSE, '`I_tahun3`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_tahun3'] =& $this->I_tahun3;

		// I_tk1
		$this->I_tk1 = new cField('master_siswa', 'master_siswa', 'x_I_tk1', 'I_tk1', '`I_tk1`', 200, -1, FALSE, '`I_tk1`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_tk1'] =& $this->I_tk1;

		// I_tk2
		$this->I_tk2 = new cField('master_siswa', 'master_siswa', 'x_I_tk2', 'I_tk2', '`I_tk2`', 200, -1, FALSE, '`I_tk2`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_tk2'] =& $this->I_tk2;

		// I_tk3
		$this->I_tk3 = new cField('master_siswa', 'master_siswa', 'x_I_tk3', 'I_tk3', '`I_tk3`', 200, -1, FALSE, '`I_tk3`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_tk3'] =& $this->I_tk3;

		// I_dari1
		$this->I_dari1 = new cField('master_siswa', 'master_siswa', 'x_I_dari1', 'I_dari1', '`I_dari1`', 200, -1, FALSE, '`I_dari1`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_dari1'] =& $this->I_dari1;

		// I_dari2
		$this->I_dari2 = new cField('master_siswa', 'master_siswa', 'x_I_dari2', 'I_dari2', '`I_dari2`', 200, -1, FALSE, '`I_dari2`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_dari2'] =& $this->I_dari2;

		// I_dari3
		$this->I_dari3 = new cField('master_siswa', 'master_siswa', 'x_I_dari3', 'I_dari3', '`I_dari3`', 200, -1, FALSE, '`I_dari3`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['I_dari3'] =& $this->I_dari3;

		// J_melanjutkan
		$this->J_melanjutkan = new cField('master_siswa', 'master_siswa', 'x_J_melanjutkan', 'J_melanjutkan', '`J_melanjutkan`', 200, -1, FALSE, '`J_melanjutkan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['J_melanjutkan'] =& $this->J_melanjutkan;

		// J_tanggal_bekerja
		$this->J_tanggal_bekerja = new cField('master_siswa', 'master_siswa', 'x_J_tanggal_bekerja', 'J_tanggal_bekerja', '`J_tanggal_bekerja`', 135, 7, FALSE, '`J_tanggal_bekerja`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->J_tanggal_bekerja->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['J_tanggal_bekerja'] =& $this->J_tanggal_bekerja;

		// J_nama_perusahaan
		$this->J_nama_perusahaan = new cField('master_siswa', 'master_siswa', 'x_J_nama_perusahaan', 'J_nama_perusahaan', '`J_nama_perusahaan`', 200, -1, FALSE, '`J_nama_perusahaan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['J_nama_perusahaan'] =& $this->J_nama_perusahaan;

		// J_penghasilan
		$this->J_penghasilan = new cField('master_siswa', 'master_siswa', 'x_J_penghasilan', 'J_penghasilan', '`J_penghasilan`', 5, -1, FALSE, '`J_penghasilan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->J_penghasilan->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['J_penghasilan'] =& $this->J_penghasilan;

		// kode_otomatis
		$this->kode_otomatis = new cField('master_siswa', 'master_siswa', 'x_kode_otomatis', 'kode_otomatis', '`kode_otomatis`', 200, -1, FALSE, '`kode_otomatis`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis'] =& $this->kode_otomatis;

		// apakah_valid
		$this->apakah_valid = new cField('master_siswa', 'master_siswa', 'x_apakah_valid', 'apakah_valid', '`apakah_valid`', 200, -1, FALSE, '`apakah_valid`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['apakah_valid'] =& $this->apakah_valid;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "master_siswa_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`master_siswa`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = " D_saat_ini_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' ";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `master_siswa` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `master_siswa` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `master_siswa` WHERE ";
		$SQL .= ew_QuotedName('kode_otomatis') . '=' . ew_QuotedValue($rs['kode_otomatis'], $this->kode_otomatis->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`kode_otomatis` = '@kode_otomatis@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@kode_otomatis@", ew_AdjustSql($this->kode_otomatis->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "master_siswalist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "master_siswalist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("master_siswaview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "master_siswaadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("master_siswaedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("master_siswaadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("master_siswadelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->kode_otomatis->CurrentValue)) {
			$sUrl .= "kode_otomatis=" . urlencode($this->kode_otomatis->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=master_siswa" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["kode_otomatis"]; // kode_otomatis

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->kode_otomatis->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->no_absen->setDbValue($rs->fields('no_absen'));
		$this->A_nis_nasional->setDbValue($rs->fields('A_nis_nasional'));
		$this->A_nama_Lengkap->setDbValue($rs->fields('A_nama_Lengkap'));
		$this->A_nama_panggilan->setDbValue($rs->fields('A_nama_panggilan'));
		$this->A_jenis_kelamin->setDbValue($rs->fields('A_jenis_kelamin'));
		$this->A_tempat_lahir->setDbValue($rs->fields('A_tempat_lahir'));
		$this->A_tanggal_lahir->setDbValue($rs->fields('A_tanggal_lahir'));
		$this->A_agama->setDbValue($rs->fields('A_agama'));
		$this->A_kewarganegaraan->setDbValue($rs->fields('A_kewarganegaraan'));
		$this->A_anak_keberapa->setDbValue($rs->fields('A_anak_keberapa'));
		$this->A_jumlah_saudara_kandung->setDbValue($rs->fields('A_jumlah_saudara_kandung'));
		$this->A_jumlah_saudara_tiri->setDbValue($rs->fields('A_jumlah_saudara_tiri'));
		$this->A_jumlah_saudara_angkat->setDbValue($rs->fields('A_jumlah_saudara_angkat'));
		$this->A_status_yatim->setDbValue($rs->fields('A_status_yatim'));
		$this->A_bahasa->setDbValue($rs->fields('A_bahasa'));
		$this->B_alamat->setDbValue($rs->fields('B_alamat'));
		$this->B_telepon_rumah->setDbValue($rs->fields('B_telepon_rumah'));
		$this->B_tinggal->setDbValue($rs->fields('B_tinggal'));
		$this->B_jarak->setDbValue($rs->fields('B_jarak'));
		$this->B_hp->setDbValue($rs->fields('B_hp'));
		$this->C_golongan_darah->setDbValue($rs->fields('C_golongan_darah'));
		$this->C_penyakit->setDbValue($rs->fields('C_penyakit'));
		$this->C_jasmani->setDbValue($rs->fields('C_jasmani'));
		$this->C_tinggi->setDbValue($rs->fields('C_tinggi'));
		$this->C_berat->setDbValue($rs->fields('C_berat'));
		$this->D_tamatan_dari->setDbValue($rs->fields('D_tamatan_dari'));
		$this->D_sttb->setDbValue($rs->fields('D_sttb'));
		$this->D_tanggal_sttb->setDbValue($rs->fields('D_tanggal_sttb'));
		$this->D_danum->setDbValue($rs->fields('D_danum'));
		$this->D_tanggal_danum->setDbValue($rs->fields('D_tanggal_danum'));
		$this->D_lama_belajar->setDbValue($rs->fields('D_lama_belajar'));
		$this->D_dari_sekolah->setDbValue($rs->fields('D_dari_sekolah'));
		$this->D_alasan->setDbValue($rs->fields('D_alasan'));
		$this->D_kelas->setDbValue($rs->fields('D_kelas'));
		$this->D_kelompok->setDbValue($rs->fields('D_kelompok'));
		$this->D_tanggal->setDbValue($rs->fields('D_tanggal'));
		$this->D_saat_ini_tingkat->setDbValue($rs->fields('D_saat_ini_tingkat'));
		$this->D_saat_ini_kelas->setDbValue($rs->fields('D_saat_ini_kelas'));
		$this->D_saat_ini_kelompok->setDbValue($rs->fields('D_saat_ini_kelompok'));
		$this->D_no_psb->setDbValue($rs->fields('D_no_psb'));
		$this->D_nilai_danum_sd->setDbValue($rs->fields('D_nilai_danum_sd'));
		$this->D_jumlah_pelajaran_danum->setDbValue($rs->fields('D_jumlah_pelajaran_danum'));
		$this->D_nilai_ujian_psb->setDbValue($rs->fields('D_nilai_ujian_psb'));
		$this->D_tahun_psb->setDbValue($rs->fields('D_tahun_psb'));
		$this->D_diterima->setDbValue($rs->fields('D_diterima'));
		$this->D_spp->setDbValue($rs->fields('D_spp'));
		$this->D_spp_potongan->setDbValue($rs->fields('D_spp_potongan'));
		$this->D_status_lama_baru->setDbValue($rs->fields('D_status_lama_baru'));
		$this->E_nama_ayah->setDbValue($rs->fields('E_nama_ayah'));
		$this->E_tempat_lahir->setDbValue($rs->fields('E_tempat_lahir'));
		$this->E_tanggal_lahir->setDbValue($rs->fields('E_tanggal_lahir'));
		$this->E_agama->setDbValue($rs->fields('E_agama'));
		$this->E_kewarganegaraan->setDbValue($rs->fields('E_kewarganegaraan'));
		$this->E_pendidikan->setDbValue($rs->fields('E_pendidikan'));
		$this->E_pekerjaan->setDbValue($rs->fields('E_pekerjaan'));
		$this->E_pengeluaran->setDbValue($rs->fields('E_pengeluaran'));
		$this->E_alamat->setDbValue($rs->fields('E_alamat'));
		$this->E_telepon->setDbValue($rs->fields('E_telepon'));
		$this->E_hp->setDbValue($rs->fields('E_hp'));
		$this->E_hidup->setDbValue($rs->fields('E_hidup'));
		$this->F_nama_ibu->setDbValue($rs->fields('F_nama_ibu'));
		$this->F_tempat_lahir->setDbValue($rs->fields('F_tempat_lahir'));
		$this->F_tanggal_lahir->setDbValue($rs->fields('F_tanggal_lahir'));
		$this->F_agama->setDbValue($rs->fields('F_agama'));
		$this->F_kewarganegaraan->setDbValue($rs->fields('F_kewarganegaraan'));
		$this->F_pendidikan->setDbValue($rs->fields('F_pendidikan'));
		$this->F_pekerjaan->setDbValue($rs->fields('F_pekerjaan'));
		$this->F_pengeluaran->setDbValue($rs->fields('F_pengeluaran'));
		$this->F_alamat->setDbValue($rs->fields('F_alamat'));
		$this->F_telepon->setDbValue($rs->fields('F_telepon'));
		$this->F_hp->setDbValue($rs->fields('F_hp'));
		$this->F_hidup->setDbValue($rs->fields('F_hidup'));
		$this->G_nama_wali->setDbValue($rs->fields('G_nama_wali'));
		$this->G_tempat_lahir->setDbValue($rs->fields('G_tempat_lahir'));
		$this->G_tanggal_lahir->setDbValue($rs->fields('G_tanggal_lahir'));
		$this->G_agama->setDbValue($rs->fields('G_agama'));
		$this->G_kewarganegaraan->setDbValue($rs->fields('G_kewarganegaraan'));
		$this->G_pendidikan->setDbValue($rs->fields('G_pendidikan'));
		$this->G_pekerjaan->setDbValue($rs->fields('G_pekerjaan'));
		$this->G_pengeluaran->setDbValue($rs->fields('G_pengeluaran'));
		$this->G_alamat->setDbValue($rs->fields('G_alamat'));
		$this->G_telepon->setDbValue($rs->fields('G_telepon'));
		$this->G_hp->setDbValue($rs->fields('G_hp'));
		$this->H_kesenian->setDbValue($rs->fields('H_kesenian'));
		$this->H_olahraga->setDbValue($rs->fields('H_olahraga'));
		$this->H_kemasyarakatan->setDbValue($rs->fields('H_kemasyarakatan'));
		$this->H_lainlain->setDbValue($rs->fields('H_lainlain'));
		$this->I_tanggal_meninggalkan->setDbValue($rs->fields('I_tanggal_meninggalkan'));
		$this->I_alasan->setDbValue($rs->fields('I_alasan'));
		$this->I_tanggal_lulus->setDbValue($rs->fields('I_tanggal_lulus'));
		$this->I_sttb->setDbValue($rs->fields('I_sttb'));
		$this->I_danum->setDbValue($rs->fields('I_danum'));
		$this->I_nilai_danum_smp->setDbValue($rs->fields('I_nilai_danum_smp'));
		$this->I_tahun1->setDbValue($rs->fields('I_tahun1'));
		$this->I_tahun2->setDbValue($rs->fields('I_tahun2'));
		$this->I_tahun3->setDbValue($rs->fields('I_tahun3'));
		$this->I_tk1->setDbValue($rs->fields('I_tk1'));
		$this->I_tk2->setDbValue($rs->fields('I_tk2'));
		$this->I_tk3->setDbValue($rs->fields('I_tk3'));
		$this->I_dari1->setDbValue($rs->fields('I_dari1'));
		$this->I_dari2->setDbValue($rs->fields('I_dari2'));
		$this->I_dari3->setDbValue($rs->fields('I_dari3'));
		$this->J_melanjutkan->setDbValue($rs->fields('J_melanjutkan'));
		$this->J_tanggal_bekerja->setDbValue($rs->fields('J_tanggal_bekerja'));
		$this->J_nama_perusahaan->setDbValue($rs->fields('J_nama_perusahaan'));
		$this->J_penghasilan->setDbValue($rs->fields('J_penghasilan'));
		$this->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$this->apakah_valid->setDbValue($rs->fields('apakah_valid'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// no_absen
		// A_nis_nasional
		// A_nama_Lengkap
		// A_nama_panggilan
		// A_jenis_kelamin
		// A_tempat_lahir
		// A_tanggal_lahir
		// A_agama
		// A_kewarganegaraan
		// A_anak_keberapa
		// A_jumlah_saudara_kandung
		// A_jumlah_saudara_tiri
		// A_jumlah_saudara_angkat
		// A_status_yatim
		// A_bahasa
		// B_alamat
		// B_telepon_rumah
		// B_tinggal
		// B_jarak
		// B_hp
		// C_golongan_darah
		// C_penyakit
		// C_jasmani
		// C_tinggi
		// C_berat
		// D_tamatan_dari
		// D_sttb
		// D_tanggal_sttb
		// D_danum
		// D_tanggal_danum
		// D_lama_belajar
		// D_dari_sekolah
		// D_alasan
		// D_kelas
		// D_kelompok
		// D_tanggal
		// D_saat_ini_tingkat
		// D_saat_ini_kelas
		// D_saat_ini_kelompok
		// D_no_psb
		// D_nilai_danum_sd
		// D_jumlah_pelajaran_danum
		// D_nilai_ujian_psb
		// D_tahun_psb
		// D_diterima
		// D_spp
		// D_spp_potongan
		// D_status_lama_baru
		// E_nama_ayah
		// E_tempat_lahir
		// E_tanggal_lahir
		// E_agama
		// E_kewarganegaraan
		// E_pendidikan
		// E_pekerjaan
		// E_pengeluaran
		// E_alamat
		// E_telepon
		// E_hp
		// E_hidup
		// F_nama_ibu
		// F_tempat_lahir
		// F_tanggal_lahir
		// F_agama
		// F_kewarganegaraan
		// F_pendidikan
		// F_pekerjaan
		// F_pengeluaran
		// F_alamat
		// F_telepon
		// F_hp
		// F_hidup
		// G_nama_wali
		// G_tempat_lahir
		// G_tanggal_lahir
		// G_agama
		// G_kewarganegaraan
		// G_pendidikan
		// G_pekerjaan
		// G_pengeluaran
		// G_alamat
		// G_telepon
		// G_hp
		// H_kesenian
		// H_olahraga
		// H_kemasyarakatan
		// H_lainlain
		// I_tanggal_meninggalkan
		// I_alasan
		// I_tanggal_lulus
		// I_sttb
		// I_danum
		// I_nilai_danum_smp
		// I_tahun1
		// I_tahun2
		// I_tahun3
		// I_tk1
		// I_tk2
		// I_tk3
		// I_dari1
		// I_dari2
		// I_dari3
		// J_melanjutkan
		// J_tanggal_bekerja
		// J_nama_perusahaan
		// J_penghasilan
		// kode_otomatis
		// apakah_valid
		// no_absen

		$this->no_absen->ViewValue = $this->no_absen->CurrentValue;
		$this->no_absen->ViewCustomAttributes = "";

		// A_nis_nasional
		$this->A_nis_nasional->ViewValue = $this->A_nis_nasional->CurrentValue;
		$this->A_nis_nasional->ViewCustomAttributes = "";

		// A_nama_Lengkap
		$this->A_nama_Lengkap->ViewValue = $this->A_nama_Lengkap->CurrentValue;
		$this->A_nama_Lengkap->ViewCustomAttributes = "";

		// A_nama_panggilan
		$this->A_nama_panggilan->ViewValue = $this->A_nama_panggilan->CurrentValue;
		$this->A_nama_panggilan->ViewCustomAttributes = "";

		// A_jenis_kelamin
		$this->A_jenis_kelamin->ViewValue = $this->A_jenis_kelamin->CurrentValue;
		$this->A_jenis_kelamin->ViewCustomAttributes = "";

		// A_tempat_lahir
		$this->A_tempat_lahir->ViewValue = $this->A_tempat_lahir->CurrentValue;
		$this->A_tempat_lahir->ViewCustomAttributes = "";

		// A_tanggal_lahir
		$this->A_tanggal_lahir->ViewValue = $this->A_tanggal_lahir->CurrentValue;
		$this->A_tanggal_lahir->ViewValue = ew_FormatDateTime($this->A_tanggal_lahir->ViewValue, 7);
		$this->A_tanggal_lahir->ViewCustomAttributes = "";

		// A_agama
		if (strval($this->A_agama->CurrentValue) <> "") {
			$sFilterWrk = "`agama` = '" . ew_AdjustSql($this->A_agama->CurrentValue) . "'";
		$sSqlWrk = "SELECT `agama` FROM `master_agama`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->A_agama->ViewValue = $rswrk->fields('agama');
				$rswrk->Close();
			} else {
				$this->A_agama->ViewValue = $this->A_agama->CurrentValue;
			}
		} else {
			$this->A_agama->ViewValue = NULL;
		}
		$this->A_agama->ViewCustomAttributes = "";

		// A_kewarganegaraan
		$this->A_kewarganegaraan->ViewValue = $this->A_kewarganegaraan->CurrentValue;
		$this->A_kewarganegaraan->ViewCustomAttributes = "";

		// A_anak_keberapa
		$this->A_anak_keberapa->ViewValue = $this->A_anak_keberapa->CurrentValue;
		$this->A_anak_keberapa->ViewCustomAttributes = "";

		// A_jumlah_saudara_kandung
		$this->A_jumlah_saudara_kandung->ViewValue = $this->A_jumlah_saudara_kandung->CurrentValue;
		$this->A_jumlah_saudara_kandung->ViewCustomAttributes = "";

		// A_jumlah_saudara_tiri
		$this->A_jumlah_saudara_tiri->ViewValue = $this->A_jumlah_saudara_tiri->CurrentValue;
		$this->A_jumlah_saudara_tiri->ViewCustomAttributes = "";

		// A_jumlah_saudara_angkat
		$this->A_jumlah_saudara_angkat->ViewValue = $this->A_jumlah_saudara_angkat->CurrentValue;
		$this->A_jumlah_saudara_angkat->ViewCustomAttributes = "";

		// A_status_yatim
		$this->A_status_yatim->ViewValue = $this->A_status_yatim->CurrentValue;
		$this->A_status_yatim->ViewCustomAttributes = "";

		// A_bahasa
		$this->A_bahasa->ViewValue = $this->A_bahasa->CurrentValue;
		$this->A_bahasa->ViewCustomAttributes = "";

		// B_alamat
		$this->B_alamat->ViewValue = $this->B_alamat->CurrentValue;
		$this->B_alamat->ViewCustomAttributes = "";

		// B_telepon_rumah
		$this->B_telepon_rumah->ViewValue = $this->B_telepon_rumah->CurrentValue;
		$this->B_telepon_rumah->ViewCustomAttributes = "";

		// B_tinggal
		$this->B_tinggal->ViewValue = $this->B_tinggal->CurrentValue;
		$this->B_tinggal->ViewCustomAttributes = "";

		// B_jarak
		$this->B_jarak->ViewValue = $this->B_jarak->CurrentValue;
		$this->B_jarak->ViewCustomAttributes = "";

		// B_hp
		$this->B_hp->ViewValue = $this->B_hp->CurrentValue;
		$this->B_hp->ViewCustomAttributes = "";

		// C_golongan_darah
		$this->C_golongan_darah->ViewValue = $this->C_golongan_darah->CurrentValue;
		$this->C_golongan_darah->ViewCustomAttributes = "";

		// C_penyakit
		$this->C_penyakit->ViewValue = $this->C_penyakit->CurrentValue;
		$this->C_penyakit->ViewCustomAttributes = "";

		// C_jasmani
		$this->C_jasmani->ViewValue = $this->C_jasmani->CurrentValue;
		$this->C_jasmani->ViewCustomAttributes = "";

		// C_tinggi
		$this->C_tinggi->ViewValue = $this->C_tinggi->CurrentValue;
		$this->C_tinggi->ViewCustomAttributes = "";

		// C_berat
		$this->C_berat->ViewValue = $this->C_berat->CurrentValue;
		$this->C_berat->ViewCustomAttributes = "";

		// D_tamatan_dari
		$this->D_tamatan_dari->ViewValue = $this->D_tamatan_dari->CurrentValue;
		$this->D_tamatan_dari->ViewCustomAttributes = "";

		// D_sttb
		$this->D_sttb->ViewValue = $this->D_sttb->CurrentValue;
		$this->D_sttb->ViewCustomAttributes = "";

		// D_tanggal_sttb
		$this->D_tanggal_sttb->ViewValue = $this->D_tanggal_sttb->CurrentValue;
		$this->D_tanggal_sttb->ViewValue = ew_FormatDateTime($this->D_tanggal_sttb->ViewValue, 7);
		$this->D_tanggal_sttb->ViewCustomAttributes = "";

		// D_danum
		$this->D_danum->ViewValue = $this->D_danum->CurrentValue;
		$this->D_danum->ViewCustomAttributes = "";

		// D_tanggal_danum
		$this->D_tanggal_danum->ViewValue = $this->D_tanggal_danum->CurrentValue;
		$this->D_tanggal_danum->ViewValue = ew_FormatDateTime($this->D_tanggal_danum->ViewValue, 7);
		$this->D_tanggal_danum->ViewCustomAttributes = "";

		// D_lama_belajar
		$this->D_lama_belajar->ViewValue = $this->D_lama_belajar->CurrentValue;
		$this->D_lama_belajar->ViewCustomAttributes = "";

		// D_dari_sekolah
		$this->D_dari_sekolah->ViewValue = $this->D_dari_sekolah->CurrentValue;
		$this->D_dari_sekolah->ViewCustomAttributes = "";

		// D_alasan
		$this->D_alasan->ViewValue = $this->D_alasan->CurrentValue;
		$this->D_alasan->ViewCustomAttributes = "";

		// D_kelas
		$this->D_kelas->ViewValue = $this->D_kelas->CurrentValue;
		$this->D_kelas->ViewCustomAttributes = "";

		// D_kelompok
		$this->D_kelompok->ViewValue = $this->D_kelompok->CurrentValue;
		$this->D_kelompok->ViewCustomAttributes = "";

		// D_tanggal
		$this->D_tanggal->ViewValue = $this->D_tanggal->CurrentValue;
		$this->D_tanggal->ViewValue = ew_FormatDateTime($this->D_tanggal->ViewValue, 7);
		$this->D_tanggal->ViewCustomAttributes = "";

		// D_saat_ini_tingkat
		$this->D_saat_ini_tingkat->ViewValue = $this->D_saat_ini_tingkat->CurrentValue;
		$this->D_saat_ini_tingkat->ViewCustomAttributes = "";

		// D_saat_ini_kelas
		$this->D_saat_ini_kelas->ViewValue = $this->D_saat_ini_kelas->CurrentValue;
		$this->D_saat_ini_kelas->ViewCustomAttributes = "";

		// D_saat_ini_kelompok
		$this->D_saat_ini_kelompok->ViewValue = $this->D_saat_ini_kelompok->CurrentValue;
		$this->D_saat_ini_kelompok->ViewCustomAttributes = "";

		// D_no_psb
		$this->D_no_psb->ViewValue = $this->D_no_psb->CurrentValue;
		$this->D_no_psb->ViewCustomAttributes = "";

		// D_nilai_danum_sd
		$this->D_nilai_danum_sd->ViewValue = $this->D_nilai_danum_sd->CurrentValue;
		$this->D_nilai_danum_sd->ViewCustomAttributes = "";

		// D_jumlah_pelajaran_danum
		$this->D_jumlah_pelajaran_danum->ViewValue = $this->D_jumlah_pelajaran_danum->CurrentValue;
		$this->D_jumlah_pelajaran_danum->ViewCustomAttributes = "";

		// D_nilai_ujian_psb
		$this->D_nilai_ujian_psb->ViewValue = $this->D_nilai_ujian_psb->CurrentValue;
		$this->D_nilai_ujian_psb->ViewCustomAttributes = "";

		// D_tahun_psb
		$this->D_tahun_psb->ViewValue = $this->D_tahun_psb->CurrentValue;
		$this->D_tahun_psb->ViewCustomAttributes = "";

		// D_diterima
		$this->D_diterima->ViewValue = $this->D_diterima->CurrentValue;
		$this->D_diterima->ViewCustomAttributes = "";

		// D_spp
		$this->D_spp->ViewValue = $this->D_spp->CurrentValue;
		$this->D_spp->ViewCustomAttributes = "";

		// D_spp_potongan
		$this->D_spp_potongan->ViewValue = $this->D_spp_potongan->CurrentValue;
		$this->D_spp_potongan->ViewCustomAttributes = "";

		// D_status_lama_baru
		$this->D_status_lama_baru->ViewValue = $this->D_status_lama_baru->CurrentValue;
		$this->D_status_lama_baru->ViewCustomAttributes = "";

		// E_nama_ayah
		$this->E_nama_ayah->ViewValue = $this->E_nama_ayah->CurrentValue;
		$this->E_nama_ayah->ViewCustomAttributes = "";

		// E_tempat_lahir
		$this->E_tempat_lahir->ViewValue = $this->E_tempat_lahir->CurrentValue;
		$this->E_tempat_lahir->ViewCustomAttributes = "";

		// E_tanggal_lahir
		$this->E_tanggal_lahir->ViewValue = $this->E_tanggal_lahir->CurrentValue;
		$this->E_tanggal_lahir->ViewValue = ew_FormatDateTime($this->E_tanggal_lahir->ViewValue, 7);
		$this->E_tanggal_lahir->ViewCustomAttributes = "";

		// E_agama
		if (strval($this->E_agama->CurrentValue) <> "") {
			$sFilterWrk = "`agama` = '" . ew_AdjustSql($this->E_agama->CurrentValue) . "'";
		$sSqlWrk = "SELECT `agama` FROM `master_agama`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->E_agama->ViewValue = $rswrk->fields('agama');
				$rswrk->Close();
			} else {
				$this->E_agama->ViewValue = $this->E_agama->CurrentValue;
			}
		} else {
			$this->E_agama->ViewValue = NULL;
		}
		$this->E_agama->ViewCustomAttributes = "";

		// E_kewarganegaraan
		$this->E_kewarganegaraan->ViewValue = $this->E_kewarganegaraan->CurrentValue;
		$this->E_kewarganegaraan->ViewCustomAttributes = "";

		// E_pendidikan
		$this->E_pendidikan->ViewValue = $this->E_pendidikan->CurrentValue;
		$this->E_pendidikan->ViewCustomAttributes = "";

		// E_pekerjaan
		$this->E_pekerjaan->ViewValue = $this->E_pekerjaan->CurrentValue;
		$this->E_pekerjaan->ViewCustomAttributes = "";

		// E_pengeluaran
		$this->E_pengeluaran->ViewValue = $this->E_pengeluaran->CurrentValue;
		$this->E_pengeluaran->ViewCustomAttributes = "";

		// E_alamat
		$this->E_alamat->ViewValue = $this->E_alamat->CurrentValue;
		$this->E_alamat->ViewCustomAttributes = "";

		// E_telepon
		$this->E_telepon->ViewValue = $this->E_telepon->CurrentValue;
		$this->E_telepon->ViewCustomAttributes = "";

		// E_hp
		$this->E_hp->ViewValue = $this->E_hp->CurrentValue;
		$this->E_hp->ViewCustomAttributes = "";

		// E_hidup
		$this->E_hidup->ViewValue = $this->E_hidup->CurrentValue;
		$this->E_hidup->ViewCustomAttributes = "";

		// F_nama_ibu
		$this->F_nama_ibu->ViewValue = $this->F_nama_ibu->CurrentValue;
		$this->F_nama_ibu->ViewCustomAttributes = "";

		// F_tempat_lahir
		$this->F_tempat_lahir->ViewValue = $this->F_tempat_lahir->CurrentValue;
		$this->F_tempat_lahir->ViewCustomAttributes = "";

		// F_tanggal_lahir
		$this->F_tanggal_lahir->ViewValue = $this->F_tanggal_lahir->CurrentValue;
		$this->F_tanggal_lahir->ViewValue = ew_FormatDateTime($this->F_tanggal_lahir->ViewValue, 7);
		$this->F_tanggal_lahir->ViewCustomAttributes = "";

		// F_agama
		if (strval($this->F_agama->CurrentValue) <> "") {
			$sFilterWrk = "`agama` = '" . ew_AdjustSql($this->F_agama->CurrentValue) . "'";
		$sSqlWrk = "SELECT `agama` FROM `master_agama`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->F_agama->ViewValue = $rswrk->fields('agama');
				$rswrk->Close();
			} else {
				$this->F_agama->ViewValue = $this->F_agama->CurrentValue;
			}
		} else {
			$this->F_agama->ViewValue = NULL;
		}
		$this->F_agama->ViewCustomAttributes = "";

		// F_kewarganegaraan
		$this->F_kewarganegaraan->ViewValue = $this->F_kewarganegaraan->CurrentValue;
		$this->F_kewarganegaraan->ViewCustomAttributes = "";

		// F_pendidikan
		$this->F_pendidikan->ViewValue = $this->F_pendidikan->CurrentValue;
		$this->F_pendidikan->ViewCustomAttributes = "";

		// F_pekerjaan
		$this->F_pekerjaan->ViewValue = $this->F_pekerjaan->CurrentValue;
		$this->F_pekerjaan->ViewCustomAttributes = "";

		// F_pengeluaran
		$this->F_pengeluaran->ViewValue = $this->F_pengeluaran->CurrentValue;
		$this->F_pengeluaran->ViewCustomAttributes = "";

		// F_alamat
		$this->F_alamat->ViewValue = $this->F_alamat->CurrentValue;
		$this->F_alamat->ViewCustomAttributes = "";

		// F_telepon
		$this->F_telepon->ViewValue = $this->F_telepon->CurrentValue;
		$this->F_telepon->ViewCustomAttributes = "";

		// F_hp
		$this->F_hp->ViewValue = $this->F_hp->CurrentValue;
		$this->F_hp->ViewCustomAttributes = "";

		// F_hidup
		$this->F_hidup->ViewValue = $this->F_hidup->CurrentValue;
		$this->F_hidup->ViewCustomAttributes = "";

		// G_nama_wali
		$this->G_nama_wali->ViewValue = $this->G_nama_wali->CurrentValue;
		$this->G_nama_wali->ViewCustomAttributes = "";

		// G_tempat_lahir
		$this->G_tempat_lahir->ViewValue = $this->G_tempat_lahir->CurrentValue;
		$this->G_tempat_lahir->ViewCustomAttributes = "";

		// G_tanggal_lahir
		$this->G_tanggal_lahir->ViewValue = $this->G_tanggal_lahir->CurrentValue;
		$this->G_tanggal_lahir->ViewValue = ew_FormatDateTime($this->G_tanggal_lahir->ViewValue, 7);
		$this->G_tanggal_lahir->ViewCustomAttributes = "";

		// G_agama
		if (strval($this->G_agama->CurrentValue) <> "") {
			$sFilterWrk = "`agama` = '" . ew_AdjustSql($this->G_agama->CurrentValue) . "'";
		$sSqlWrk = "SELECT `agama` FROM `master_agama`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->G_agama->ViewValue = $rswrk->fields('agama');
				$rswrk->Close();
			} else {
				$this->G_agama->ViewValue = $this->G_agama->CurrentValue;
			}
		} else {
			$this->G_agama->ViewValue = NULL;
		}
		$this->G_agama->ViewCustomAttributes = "";

		// G_kewarganegaraan
		$this->G_kewarganegaraan->ViewValue = $this->G_kewarganegaraan->CurrentValue;
		$this->G_kewarganegaraan->ViewCustomAttributes = "";

		// G_pendidikan
		$this->G_pendidikan->ViewValue = $this->G_pendidikan->CurrentValue;
		$this->G_pendidikan->ViewCustomAttributes = "";

		// G_pekerjaan
		$this->G_pekerjaan->ViewValue = $this->G_pekerjaan->CurrentValue;
		$this->G_pekerjaan->ViewCustomAttributes = "";

		// G_pengeluaran
		$this->G_pengeluaran->ViewValue = $this->G_pengeluaran->CurrentValue;
		$this->G_pengeluaran->ViewCustomAttributes = "";

		// G_alamat
		$this->G_alamat->ViewValue = $this->G_alamat->CurrentValue;
		$this->G_alamat->ViewCustomAttributes = "";

		// G_telepon
		$this->G_telepon->ViewValue = $this->G_telepon->CurrentValue;
		$this->G_telepon->ViewCustomAttributes = "";

		// G_hp
		$this->G_hp->ViewValue = $this->G_hp->CurrentValue;
		$this->G_hp->ViewCustomAttributes = "";

		// H_kesenian
		$this->H_kesenian->ViewValue = $this->H_kesenian->CurrentValue;
		$this->H_kesenian->ViewCustomAttributes = "";

		// H_olahraga
		$this->H_olahraga->ViewValue = $this->H_olahraga->CurrentValue;
		$this->H_olahraga->ViewCustomAttributes = "";

		// H_kemasyarakatan
		$this->H_kemasyarakatan->ViewValue = $this->H_kemasyarakatan->CurrentValue;
		$this->H_kemasyarakatan->ViewCustomAttributes = "";

		// H_lainlain
		$this->H_lainlain->ViewValue = $this->H_lainlain->CurrentValue;
		$this->H_lainlain->ViewCustomAttributes = "";

		// I_tanggal_meninggalkan
		$this->I_tanggal_meninggalkan->ViewValue = $this->I_tanggal_meninggalkan->CurrentValue;
		$this->I_tanggal_meninggalkan->ViewValue = ew_FormatDateTime($this->I_tanggal_meninggalkan->ViewValue, 7);
		$this->I_tanggal_meninggalkan->ViewCustomAttributes = "";

		// I_alasan
		$this->I_alasan->ViewValue = $this->I_alasan->CurrentValue;
		$this->I_alasan->ViewCustomAttributes = "";

		// I_tanggal_lulus
		$this->I_tanggal_lulus->ViewValue = $this->I_tanggal_lulus->CurrentValue;
		$this->I_tanggal_lulus->ViewValue = ew_FormatDateTime($this->I_tanggal_lulus->ViewValue, 7);
		$this->I_tanggal_lulus->ViewCustomAttributes = "";

		// I_sttb
		$this->I_sttb->ViewValue = $this->I_sttb->CurrentValue;
		$this->I_sttb->ViewCustomAttributes = "";

		// I_danum
		$this->I_danum->ViewValue = $this->I_danum->CurrentValue;
		$this->I_danum->ViewCustomAttributes = "";

		// I_nilai_danum_smp
		$this->I_nilai_danum_smp->ViewValue = $this->I_nilai_danum_smp->CurrentValue;
		$this->I_nilai_danum_smp->ViewCustomAttributes = "";

		// I_tahun1
		$this->I_tahun1->ViewValue = $this->I_tahun1->CurrentValue;
		$this->I_tahun1->ViewCustomAttributes = "";

		// I_tahun2
		$this->I_tahun2->ViewValue = $this->I_tahun2->CurrentValue;
		$this->I_tahun2->ViewCustomAttributes = "";

		// I_tahun3
		$this->I_tahun3->ViewValue = $this->I_tahun3->CurrentValue;
		$this->I_tahun3->ViewCustomAttributes = "";

		// I_tk1
		$this->I_tk1->ViewValue = $this->I_tk1->CurrentValue;
		$this->I_tk1->ViewCustomAttributes = "";

		// I_tk2
		$this->I_tk2->ViewValue = $this->I_tk2->CurrentValue;
		$this->I_tk2->ViewCustomAttributes = "";

		// I_tk3
		$this->I_tk3->ViewValue = $this->I_tk3->CurrentValue;
		$this->I_tk3->ViewCustomAttributes = "";

		// I_dari1
		$this->I_dari1->ViewValue = $this->I_dari1->CurrentValue;
		$this->I_dari1->ViewCustomAttributes = "";

		// I_dari2
		$this->I_dari2->ViewValue = $this->I_dari2->CurrentValue;
		$this->I_dari2->ViewCustomAttributes = "";

		// I_dari3
		$this->I_dari3->ViewValue = $this->I_dari3->CurrentValue;
		$this->I_dari3->ViewCustomAttributes = "";

		// J_melanjutkan
		$this->J_melanjutkan->ViewValue = $this->J_melanjutkan->CurrentValue;
		$this->J_melanjutkan->ViewCustomAttributes = "";

		// J_tanggal_bekerja
		$this->J_tanggal_bekerja->ViewValue = $this->J_tanggal_bekerja->CurrentValue;
		$this->J_tanggal_bekerja->ViewValue = ew_FormatDateTime($this->J_tanggal_bekerja->ViewValue, 7);
		$this->J_tanggal_bekerja->ViewCustomAttributes = "";

		// J_nama_perusahaan
		$this->J_nama_perusahaan->ViewValue = $this->J_nama_perusahaan->CurrentValue;
		$this->J_nama_perusahaan->ViewCustomAttributes = "";

		// J_penghasilan
		$this->J_penghasilan->ViewValue = $this->J_penghasilan->CurrentValue;
		$this->J_penghasilan->ViewCustomAttributes = "";

		// kode_otomatis
		$this->kode_otomatis->ViewValue = $this->kode_otomatis->CurrentValue;
		$this->kode_otomatis->ViewCustomAttributes = "";

		// apakah_valid
		if (strval($this->apakah_valid->CurrentValue) <> "") {
			switch ($this->apakah_valid->CurrentValue) {
				case "y":
					$this->apakah_valid->ViewValue = $this->apakah_valid->FldTagCaption(1) <> "" ? $this->apakah_valid->FldTagCaption(1) : $this->apakah_valid->CurrentValue;
					break;
				case "t":
					$this->apakah_valid->ViewValue = $this->apakah_valid->FldTagCaption(2) <> "" ? $this->apakah_valid->FldTagCaption(2) : $this->apakah_valid->CurrentValue;
					break;
				default:
					$this->apakah_valid->ViewValue = $this->apakah_valid->CurrentValue;
			}
		} else {
			$this->apakah_valid->ViewValue = NULL;
		}
		$this->apakah_valid->ViewCustomAttributes = "";

		// no_absen
		$this->no_absen->LinkCustomAttributes = "";
		$this->no_absen->HrefValue = "";
		$this->no_absen->TooltipValue = "";

		// A_nis_nasional
		$this->A_nis_nasional->LinkCustomAttributes = "";
		$this->A_nis_nasional->HrefValue = "";
		$this->A_nis_nasional->TooltipValue = "";

		// A_nama_Lengkap
		$this->A_nama_Lengkap->LinkCustomAttributes = "";
		$this->A_nama_Lengkap->HrefValue = "";
		$this->A_nama_Lengkap->TooltipValue = "";

		// A_nama_panggilan
		$this->A_nama_panggilan->LinkCustomAttributes = "";
		$this->A_nama_panggilan->HrefValue = "";
		$this->A_nama_panggilan->TooltipValue = "";

		// A_jenis_kelamin
		$this->A_jenis_kelamin->LinkCustomAttributes = "";
		$this->A_jenis_kelamin->HrefValue = "";
		$this->A_jenis_kelamin->TooltipValue = "";

		// A_tempat_lahir
		$this->A_tempat_lahir->LinkCustomAttributes = "";
		$this->A_tempat_lahir->HrefValue = "";
		$this->A_tempat_lahir->TooltipValue = "";

		// A_tanggal_lahir
		$this->A_tanggal_lahir->LinkCustomAttributes = "";
		$this->A_tanggal_lahir->HrefValue = "";
		$this->A_tanggal_lahir->TooltipValue = "";

		// A_agama
		$this->A_agama->LinkCustomAttributes = "";
		$this->A_agama->HrefValue = "";
		$this->A_agama->TooltipValue = "";

		// A_kewarganegaraan
		$this->A_kewarganegaraan->LinkCustomAttributes = "";
		$this->A_kewarganegaraan->HrefValue = "";
		$this->A_kewarganegaraan->TooltipValue = "";

		// A_anak_keberapa
		$this->A_anak_keberapa->LinkCustomAttributes = "";
		$this->A_anak_keberapa->HrefValue = "";
		$this->A_anak_keberapa->TooltipValue = "";

		// A_jumlah_saudara_kandung
		$this->A_jumlah_saudara_kandung->LinkCustomAttributes = "";
		$this->A_jumlah_saudara_kandung->HrefValue = "";
		$this->A_jumlah_saudara_kandung->TooltipValue = "";

		// A_jumlah_saudara_tiri
		$this->A_jumlah_saudara_tiri->LinkCustomAttributes = "";
		$this->A_jumlah_saudara_tiri->HrefValue = "";
		$this->A_jumlah_saudara_tiri->TooltipValue = "";

		// A_jumlah_saudara_angkat
		$this->A_jumlah_saudara_angkat->LinkCustomAttributes = "";
		$this->A_jumlah_saudara_angkat->HrefValue = "";
		$this->A_jumlah_saudara_angkat->TooltipValue = "";

		// A_status_yatim
		$this->A_status_yatim->LinkCustomAttributes = "";
		$this->A_status_yatim->HrefValue = "";
		$this->A_status_yatim->TooltipValue = "";

		// A_bahasa
		$this->A_bahasa->LinkCustomAttributes = "";
		$this->A_bahasa->HrefValue = "";
		$this->A_bahasa->TooltipValue = "";

		// B_alamat
		$this->B_alamat->LinkCustomAttributes = "";
		$this->B_alamat->HrefValue = "";
		$this->B_alamat->TooltipValue = "";

		// B_telepon_rumah
		$this->B_telepon_rumah->LinkCustomAttributes = "";
		$this->B_telepon_rumah->HrefValue = "";
		$this->B_telepon_rumah->TooltipValue = "";

		// B_tinggal
		$this->B_tinggal->LinkCustomAttributes = "";
		$this->B_tinggal->HrefValue = "";
		$this->B_tinggal->TooltipValue = "";

		// B_jarak
		$this->B_jarak->LinkCustomAttributes = "";
		$this->B_jarak->HrefValue = "";
		$this->B_jarak->TooltipValue = "";

		// B_hp
		$this->B_hp->LinkCustomAttributes = "";
		$this->B_hp->HrefValue = "";
		$this->B_hp->TooltipValue = "";

		// C_golongan_darah
		$this->C_golongan_darah->LinkCustomAttributes = "";
		$this->C_golongan_darah->HrefValue = "";
		$this->C_golongan_darah->TooltipValue = "";

		// C_penyakit
		$this->C_penyakit->LinkCustomAttributes = "";
		$this->C_penyakit->HrefValue = "";
		$this->C_penyakit->TooltipValue = "";

		// C_jasmani
		$this->C_jasmani->LinkCustomAttributes = "";
		$this->C_jasmani->HrefValue = "";
		$this->C_jasmani->TooltipValue = "";

		// C_tinggi
		$this->C_tinggi->LinkCustomAttributes = "";
		$this->C_tinggi->HrefValue = "";
		$this->C_tinggi->TooltipValue = "";

		// C_berat
		$this->C_berat->LinkCustomAttributes = "";
		$this->C_berat->HrefValue = "";
		$this->C_berat->TooltipValue = "";

		// D_tamatan_dari
		$this->D_tamatan_dari->LinkCustomAttributes = "";
		$this->D_tamatan_dari->HrefValue = "";
		$this->D_tamatan_dari->TooltipValue = "";

		// D_sttb
		$this->D_sttb->LinkCustomAttributes = "";
		$this->D_sttb->HrefValue = "";
		$this->D_sttb->TooltipValue = "";

		// D_tanggal_sttb
		$this->D_tanggal_sttb->LinkCustomAttributes = "";
		$this->D_tanggal_sttb->HrefValue = "";
		$this->D_tanggal_sttb->TooltipValue = "";

		// D_danum
		$this->D_danum->LinkCustomAttributes = "";
		$this->D_danum->HrefValue = "";
		$this->D_danum->TooltipValue = "";

		// D_tanggal_danum
		$this->D_tanggal_danum->LinkCustomAttributes = "";
		$this->D_tanggal_danum->HrefValue = "";
		$this->D_tanggal_danum->TooltipValue = "";

		// D_lama_belajar
		$this->D_lama_belajar->LinkCustomAttributes = "";
		$this->D_lama_belajar->HrefValue = "";
		$this->D_lama_belajar->TooltipValue = "";

		// D_dari_sekolah
		$this->D_dari_sekolah->LinkCustomAttributes = "";
		$this->D_dari_sekolah->HrefValue = "";
		$this->D_dari_sekolah->TooltipValue = "";

		// D_alasan
		$this->D_alasan->LinkCustomAttributes = "";
		$this->D_alasan->HrefValue = "";
		$this->D_alasan->TooltipValue = "";

		// D_kelas
		$this->D_kelas->LinkCustomAttributes = "";
		$this->D_kelas->HrefValue = "";
		$this->D_kelas->TooltipValue = "";

		// D_kelompok
		$this->D_kelompok->LinkCustomAttributes = "";
		$this->D_kelompok->HrefValue = "";
		$this->D_kelompok->TooltipValue = "";

		// D_tanggal
		$this->D_tanggal->LinkCustomAttributes = "";
		$this->D_tanggal->HrefValue = "";
		$this->D_tanggal->TooltipValue = "";

		// D_saat_ini_tingkat
		$this->D_saat_ini_tingkat->LinkCustomAttributes = "";
		$this->D_saat_ini_tingkat->HrefValue = "";
		$this->D_saat_ini_tingkat->TooltipValue = "";

		// D_saat_ini_kelas
		$this->D_saat_ini_kelas->LinkCustomAttributes = "";
		$this->D_saat_ini_kelas->HrefValue = "";
		$this->D_saat_ini_kelas->TooltipValue = "";

		// D_saat_ini_kelompok
		$this->D_saat_ini_kelompok->LinkCustomAttributes = "";
		$this->D_saat_ini_kelompok->HrefValue = "";
		$this->D_saat_ini_kelompok->TooltipValue = "";

		// D_no_psb
		$this->D_no_psb->LinkCustomAttributes = "";
		$this->D_no_psb->HrefValue = "";
		$this->D_no_psb->TooltipValue = "";

		// D_nilai_danum_sd
		$this->D_nilai_danum_sd->LinkCustomAttributes = "";
		$this->D_nilai_danum_sd->HrefValue = "";
		$this->D_nilai_danum_sd->TooltipValue = "";

		// D_jumlah_pelajaran_danum
		$this->D_jumlah_pelajaran_danum->LinkCustomAttributes = "";
		$this->D_jumlah_pelajaran_danum->HrefValue = "";
		$this->D_jumlah_pelajaran_danum->TooltipValue = "";

		// D_nilai_ujian_psb
		$this->D_nilai_ujian_psb->LinkCustomAttributes = "";
		$this->D_nilai_ujian_psb->HrefValue = "";
		$this->D_nilai_ujian_psb->TooltipValue = "";

		// D_tahun_psb
		$this->D_tahun_psb->LinkCustomAttributes = "";
		$this->D_tahun_psb->HrefValue = "";
		$this->D_tahun_psb->TooltipValue = "";

		// D_diterima
		$this->D_diterima->LinkCustomAttributes = "";
		$this->D_diterima->HrefValue = "";
		$this->D_diterima->TooltipValue = "";

		// D_spp
		$this->D_spp->LinkCustomAttributes = "";
		$this->D_spp->HrefValue = "";
		$this->D_spp->TooltipValue = "";

		// D_spp_potongan
		$this->D_spp_potongan->LinkCustomAttributes = "";
		$this->D_spp_potongan->HrefValue = "";
		$this->D_spp_potongan->TooltipValue = "";

		// D_status_lama_baru
		$this->D_status_lama_baru->LinkCustomAttributes = "";
		$this->D_status_lama_baru->HrefValue = "";
		$this->D_status_lama_baru->TooltipValue = "";

		// E_nama_ayah
		$this->E_nama_ayah->LinkCustomAttributes = "";
		$this->E_nama_ayah->HrefValue = "";
		$this->E_nama_ayah->TooltipValue = "";

		// E_tempat_lahir
		$this->E_tempat_lahir->LinkCustomAttributes = "";
		$this->E_tempat_lahir->HrefValue = "";
		$this->E_tempat_lahir->TooltipValue = "";

		// E_tanggal_lahir
		$this->E_tanggal_lahir->LinkCustomAttributes = "";
		$this->E_tanggal_lahir->HrefValue = "";
		$this->E_tanggal_lahir->TooltipValue = "";

		// E_agama
		$this->E_agama->LinkCustomAttributes = "";
		$this->E_agama->HrefValue = "";
		$this->E_agama->TooltipValue = "";

		// E_kewarganegaraan
		$this->E_kewarganegaraan->LinkCustomAttributes = "";
		$this->E_kewarganegaraan->HrefValue = "";
		$this->E_kewarganegaraan->TooltipValue = "";

		// E_pendidikan
		$this->E_pendidikan->LinkCustomAttributes = "";
		$this->E_pendidikan->HrefValue = "";
		$this->E_pendidikan->TooltipValue = "";

		// E_pekerjaan
		$this->E_pekerjaan->LinkCustomAttributes = "";
		$this->E_pekerjaan->HrefValue = "";
		$this->E_pekerjaan->TooltipValue = "";

		// E_pengeluaran
		$this->E_pengeluaran->LinkCustomAttributes = "";
		$this->E_pengeluaran->HrefValue = "";
		$this->E_pengeluaran->TooltipValue = "";

		// E_alamat
		$this->E_alamat->LinkCustomAttributes = "";
		$this->E_alamat->HrefValue = "";
		$this->E_alamat->TooltipValue = "";

		// E_telepon
		$this->E_telepon->LinkCustomAttributes = "";
		$this->E_telepon->HrefValue = "";
		$this->E_telepon->TooltipValue = "";

		// E_hp
		$this->E_hp->LinkCustomAttributes = "";
		$this->E_hp->HrefValue = "";
		$this->E_hp->TooltipValue = "";

		// E_hidup
		$this->E_hidup->LinkCustomAttributes = "";
		$this->E_hidup->HrefValue = "";
		$this->E_hidup->TooltipValue = "";

		// F_nama_ibu
		$this->F_nama_ibu->LinkCustomAttributes = "";
		$this->F_nama_ibu->HrefValue = "";
		$this->F_nama_ibu->TooltipValue = "";

		// F_tempat_lahir
		$this->F_tempat_lahir->LinkCustomAttributes = "";
		$this->F_tempat_lahir->HrefValue = "";
		$this->F_tempat_lahir->TooltipValue = "";

		// F_tanggal_lahir
		$this->F_tanggal_lahir->LinkCustomAttributes = "";
		$this->F_tanggal_lahir->HrefValue = "";
		$this->F_tanggal_lahir->TooltipValue = "";

		// F_agama
		$this->F_agama->LinkCustomAttributes = "";
		$this->F_agama->HrefValue = "";
		$this->F_agama->TooltipValue = "";

		// F_kewarganegaraan
		$this->F_kewarganegaraan->LinkCustomAttributes = "";
		$this->F_kewarganegaraan->HrefValue = "";
		$this->F_kewarganegaraan->TooltipValue = "";

		// F_pendidikan
		$this->F_pendidikan->LinkCustomAttributes = "";
		$this->F_pendidikan->HrefValue = "";
		$this->F_pendidikan->TooltipValue = "";

		// F_pekerjaan
		$this->F_pekerjaan->LinkCustomAttributes = "";
		$this->F_pekerjaan->HrefValue = "";
		$this->F_pekerjaan->TooltipValue = "";

		// F_pengeluaran
		$this->F_pengeluaran->LinkCustomAttributes = "";
		$this->F_pengeluaran->HrefValue = "";
		$this->F_pengeluaran->TooltipValue = "";

		// F_alamat
		$this->F_alamat->LinkCustomAttributes = "";
		$this->F_alamat->HrefValue = "";
		$this->F_alamat->TooltipValue = "";

		// F_telepon
		$this->F_telepon->LinkCustomAttributes = "";
		$this->F_telepon->HrefValue = "";
		$this->F_telepon->TooltipValue = "";

		// F_hp
		$this->F_hp->LinkCustomAttributes = "";
		$this->F_hp->HrefValue = "";
		$this->F_hp->TooltipValue = "";

		// F_hidup
		$this->F_hidup->LinkCustomAttributes = "";
		$this->F_hidup->HrefValue = "";
		$this->F_hidup->TooltipValue = "";

		// G_nama_wali
		$this->G_nama_wali->LinkCustomAttributes = "";
		$this->G_nama_wali->HrefValue = "";
		$this->G_nama_wali->TooltipValue = "";

		// G_tempat_lahir
		$this->G_tempat_lahir->LinkCustomAttributes = "";
		$this->G_tempat_lahir->HrefValue = "";
		$this->G_tempat_lahir->TooltipValue = "";

		// G_tanggal_lahir
		$this->G_tanggal_lahir->LinkCustomAttributes = "";
		$this->G_tanggal_lahir->HrefValue = "";
		$this->G_tanggal_lahir->TooltipValue = "";

		// G_agama
		$this->G_agama->LinkCustomAttributes = "";
		$this->G_agama->HrefValue = "";
		$this->G_agama->TooltipValue = "";

		// G_kewarganegaraan
		$this->G_kewarganegaraan->LinkCustomAttributes = "";
		$this->G_kewarganegaraan->HrefValue = "";
		$this->G_kewarganegaraan->TooltipValue = "";

		// G_pendidikan
		$this->G_pendidikan->LinkCustomAttributes = "";
		$this->G_pendidikan->HrefValue = "";
		$this->G_pendidikan->TooltipValue = "";

		// G_pekerjaan
		$this->G_pekerjaan->LinkCustomAttributes = "";
		$this->G_pekerjaan->HrefValue = "";
		$this->G_pekerjaan->TooltipValue = "";

		// G_pengeluaran
		$this->G_pengeluaran->LinkCustomAttributes = "";
		$this->G_pengeluaran->HrefValue = "";
		$this->G_pengeluaran->TooltipValue = "";

		// G_alamat
		$this->G_alamat->LinkCustomAttributes = "";
		$this->G_alamat->HrefValue = "";
		$this->G_alamat->TooltipValue = "";

		// G_telepon
		$this->G_telepon->LinkCustomAttributes = "";
		$this->G_telepon->HrefValue = "";
		$this->G_telepon->TooltipValue = "";

		// G_hp
		$this->G_hp->LinkCustomAttributes = "";
		$this->G_hp->HrefValue = "";
		$this->G_hp->TooltipValue = "";

		// H_kesenian
		$this->H_kesenian->LinkCustomAttributes = "";
		$this->H_kesenian->HrefValue = "";
		$this->H_kesenian->TooltipValue = "";

		// H_olahraga
		$this->H_olahraga->LinkCustomAttributes = "";
		$this->H_olahraga->HrefValue = "";
		$this->H_olahraga->TooltipValue = "";

		// H_kemasyarakatan
		$this->H_kemasyarakatan->LinkCustomAttributes = "";
		$this->H_kemasyarakatan->HrefValue = "";
		$this->H_kemasyarakatan->TooltipValue = "";

		// H_lainlain
		$this->H_lainlain->LinkCustomAttributes = "";
		$this->H_lainlain->HrefValue = "";
		$this->H_lainlain->TooltipValue = "";

		// I_tanggal_meninggalkan
		$this->I_tanggal_meninggalkan->LinkCustomAttributes = "";
		$this->I_tanggal_meninggalkan->HrefValue = "";
		$this->I_tanggal_meninggalkan->TooltipValue = "";

		// I_alasan
		$this->I_alasan->LinkCustomAttributes = "";
		$this->I_alasan->HrefValue = "";
		$this->I_alasan->TooltipValue = "";

		// I_tanggal_lulus
		$this->I_tanggal_lulus->LinkCustomAttributes = "";
		$this->I_tanggal_lulus->HrefValue = "";
		$this->I_tanggal_lulus->TooltipValue = "";

		// I_sttb
		$this->I_sttb->LinkCustomAttributes = "";
		$this->I_sttb->HrefValue = "";
		$this->I_sttb->TooltipValue = "";

		// I_danum
		$this->I_danum->LinkCustomAttributes = "";
		$this->I_danum->HrefValue = "";
		$this->I_danum->TooltipValue = "";

		// I_nilai_danum_smp
		$this->I_nilai_danum_smp->LinkCustomAttributes = "";
		$this->I_nilai_danum_smp->HrefValue = "";
		$this->I_nilai_danum_smp->TooltipValue = "";

		// I_tahun1
		$this->I_tahun1->LinkCustomAttributes = "";
		$this->I_tahun1->HrefValue = "";
		$this->I_tahun1->TooltipValue = "";

		// I_tahun2
		$this->I_tahun2->LinkCustomAttributes = "";
		$this->I_tahun2->HrefValue = "";
		$this->I_tahun2->TooltipValue = "";

		// I_tahun3
		$this->I_tahun3->LinkCustomAttributes = "";
		$this->I_tahun3->HrefValue = "";
		$this->I_tahun3->TooltipValue = "";

		// I_tk1
		$this->I_tk1->LinkCustomAttributes = "";
		$this->I_tk1->HrefValue = "";
		$this->I_tk1->TooltipValue = "";

		// I_tk2
		$this->I_tk2->LinkCustomAttributes = "";
		$this->I_tk2->HrefValue = "";
		$this->I_tk2->TooltipValue = "";

		// I_tk3
		$this->I_tk3->LinkCustomAttributes = "";
		$this->I_tk3->HrefValue = "";
		$this->I_tk3->TooltipValue = "";

		// I_dari1
		$this->I_dari1->LinkCustomAttributes = "";
		$this->I_dari1->HrefValue = "";
		$this->I_dari1->TooltipValue = "";

		// I_dari2
		$this->I_dari2->LinkCustomAttributes = "";
		$this->I_dari2->HrefValue = "";
		$this->I_dari2->TooltipValue = "";

		// I_dari3
		$this->I_dari3->LinkCustomAttributes = "";
		$this->I_dari3->HrefValue = "";
		$this->I_dari3->TooltipValue = "";

		// J_melanjutkan
		$this->J_melanjutkan->LinkCustomAttributes = "";
		$this->J_melanjutkan->HrefValue = "";
		$this->J_melanjutkan->TooltipValue = "";

		// J_tanggal_bekerja
		$this->J_tanggal_bekerja->LinkCustomAttributes = "";
		$this->J_tanggal_bekerja->HrefValue = "";
		$this->J_tanggal_bekerja->TooltipValue = "";

		// J_nama_perusahaan
		$this->J_nama_perusahaan->LinkCustomAttributes = "";
		$this->J_nama_perusahaan->HrefValue = "";
		$this->J_nama_perusahaan->TooltipValue = "";

		// J_penghasilan
		$this->J_penghasilan->LinkCustomAttributes = "";
		$this->J_penghasilan->HrefValue = "";
		$this->J_penghasilan->TooltipValue = "";

		// kode_otomatis
		$this->kode_otomatis->LinkCustomAttributes = "";
		$this->kode_otomatis->HrefValue = "";
		$this->kode_otomatis->TooltipValue = "";

		// apakah_valid
		$this->apakah_valid->LinkCustomAttributes = "";
		$this->apakah_valid->HrefValue = "";
		$this->apakah_valid->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('no_absen', $this->no_absen->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nis_nasional', $this->A_nis_nasional->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nama_Lengkap', $this->A_nama_Lengkap->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nama_panggilan', $this->A_nama_panggilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jenis_kelamin', $this->A_jenis_kelamin->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_tempat_lahir', $this->A_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_tanggal_lahir', $this->A_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_agama', $this->A_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_kewarganegaraan', $this->A_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_anak_keberapa', $this->A_anak_keberapa->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jumlah_saudara_kandung', $this->A_jumlah_saudara_kandung->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jumlah_saudara_tiri', $this->A_jumlah_saudara_tiri->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jumlah_saudara_angkat', $this->A_jumlah_saudara_angkat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_status_yatim', $this->A_status_yatim->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_bahasa', $this->A_bahasa->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_alamat', $this->B_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_telepon_rumah', $this->B_telepon_rumah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_tinggal', $this->B_tinggal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_jarak', $this->B_jarak->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_hp', $this->B_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_golongan_darah', $this->C_golongan_darah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_penyakit', $this->C_penyakit->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_jasmani', $this->C_jasmani->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_tinggi', $this->C_tinggi->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_berat', $this->C_berat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tamatan_dari', $this->D_tamatan_dari->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_sttb', $this->D_sttb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tanggal_sttb', $this->D_tanggal_sttb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_danum', $this->D_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tanggal_danum', $this->D_tanggal_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_lama_belajar', $this->D_lama_belajar->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_dari_sekolah', $this->D_dari_sekolah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_alasan', $this->D_alasan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_kelas', $this->D_kelas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_kelompok', $this->D_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tanggal', $this->D_tanggal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_saat_ini_tingkat', $this->D_saat_ini_tingkat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_saat_ini_kelas', $this->D_saat_ini_kelas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_saat_ini_kelompok', $this->D_saat_ini_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_no_psb', $this->D_no_psb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_nilai_danum_sd', $this->D_nilai_danum_sd->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_jumlah_pelajaran_danum', $this->D_jumlah_pelajaran_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_nilai_ujian_psb', $this->D_nilai_ujian_psb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tahun_psb', $this->D_tahun_psb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_diterima', $this->D_diterima->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_spp', $this->D_spp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_spp_potongan', $this->D_spp_potongan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_status_lama_baru', $this->D_status_lama_baru->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_nama_ayah', $this->E_nama_ayah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_tempat_lahir', $this->E_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_tanggal_lahir', $this->E_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_agama', $this->E_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_kewarganegaraan', $this->E_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_pendidikan', $this->E_pendidikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_pekerjaan', $this->E_pekerjaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_pengeluaran', $this->E_pengeluaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_alamat', $this->E_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_telepon', $this->E_telepon->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_hp', $this->E_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_hidup', $this->E_hidup->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_nama_ibu', $this->F_nama_ibu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_tempat_lahir', $this->F_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_tanggal_lahir', $this->F_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_agama', $this->F_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_kewarganegaraan', $this->F_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_pendidikan', $this->F_pendidikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_pekerjaan', $this->F_pekerjaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_pengeluaran', $this->F_pengeluaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_alamat', $this->F_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_telepon', $this->F_telepon->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_hp', $this->F_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_hidup', $this->F_hidup->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_nama_wali', $this->G_nama_wali->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_tempat_lahir', $this->G_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_tanggal_lahir', $this->G_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_agama', $this->G_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_kewarganegaraan', $this->G_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_pendidikan', $this->G_pendidikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_pekerjaan', $this->G_pekerjaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_pengeluaran', $this->G_pengeluaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_alamat', $this->G_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_telepon', $this->G_telepon->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_hp', $this->G_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_kesenian', $this->H_kesenian->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_olahraga', $this->H_olahraga->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_kemasyarakatan', $this->H_kemasyarakatan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_lainlain', $this->H_lainlain->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tanggal_meninggalkan', $this->I_tanggal_meninggalkan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_alasan', $this->I_alasan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tanggal_lulus', $this->I_tanggal_lulus->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_sttb', $this->I_sttb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_danum', $this->I_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_nilai_danum_smp', $this->I_nilai_danum_smp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tahun1', $this->I_tahun1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tahun2', $this->I_tahun2->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tahun3', $this->I_tahun3->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tk1', $this->I_tk1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tk2', $this->I_tk2->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tk3', $this->I_tk3->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_dari1', $this->I_dari1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_dari2', $this->I_dari2->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_dari3', $this->I_dari3->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_melanjutkan', $this->J_melanjutkan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_tanggal_bekerja', $this->J_tanggal_bekerja->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_nama_perusahaan', $this->J_nama_perusahaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_penghasilan', $this->J_penghasilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis', $this->kode_otomatis->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apakah_valid', $this->apakah_valid->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('no_absen', $this->no_absen->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nis_nasional', $this->A_nis_nasional->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nama_Lengkap', $this->A_nama_Lengkap->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nama_panggilan', $this->A_nama_panggilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jenis_kelamin', $this->A_jenis_kelamin->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_tempat_lahir', $this->A_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_tanggal_lahir', $this->A_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_agama', $this->A_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_kewarganegaraan', $this->A_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_anak_keberapa', $this->A_anak_keberapa->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jumlah_saudara_kandung', $this->A_jumlah_saudara_kandung->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jumlah_saudara_tiri', $this->A_jumlah_saudara_tiri->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_jumlah_saudara_angkat', $this->A_jumlah_saudara_angkat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_status_yatim', $this->A_status_yatim->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_bahasa', $this->A_bahasa->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_alamat', $this->B_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_telepon_rumah', $this->B_telepon_rumah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_tinggal', $this->B_tinggal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_jarak', $this->B_jarak->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('B_hp', $this->B_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_golongan_darah', $this->C_golongan_darah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_penyakit', $this->C_penyakit->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_jasmani', $this->C_jasmani->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_tinggi', $this->C_tinggi->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('C_berat', $this->C_berat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tamatan_dari', $this->D_tamatan_dari->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_sttb', $this->D_sttb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tanggal_sttb', $this->D_tanggal_sttb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_danum', $this->D_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tanggal_danum', $this->D_tanggal_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_lama_belajar', $this->D_lama_belajar->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_dari_sekolah', $this->D_dari_sekolah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_alasan', $this->D_alasan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_kelas', $this->D_kelas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_kelompok', $this->D_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tanggal', $this->D_tanggal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_saat_ini_tingkat', $this->D_saat_ini_tingkat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_saat_ini_kelas', $this->D_saat_ini_kelas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_saat_ini_kelompok', $this->D_saat_ini_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_no_psb', $this->D_no_psb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_nilai_danum_sd', $this->D_nilai_danum_sd->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_jumlah_pelajaran_danum', $this->D_jumlah_pelajaran_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_nilai_ujian_psb', $this->D_nilai_ujian_psb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_tahun_psb', $this->D_tahun_psb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_diterima', $this->D_diterima->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_spp', $this->D_spp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_spp_potongan', $this->D_spp_potongan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D_status_lama_baru', $this->D_status_lama_baru->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_nama_ayah', $this->E_nama_ayah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_tempat_lahir', $this->E_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_tanggal_lahir', $this->E_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_agama', $this->E_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_kewarganegaraan', $this->E_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_pendidikan', $this->E_pendidikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_pekerjaan', $this->E_pekerjaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_pengeluaran', $this->E_pengeluaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_alamat', $this->E_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_telepon', $this->E_telepon->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_hp', $this->E_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('E_hidup', $this->E_hidup->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_nama_ibu', $this->F_nama_ibu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_tempat_lahir', $this->F_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_tanggal_lahir', $this->F_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_agama', $this->F_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_kewarganegaraan', $this->F_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_pendidikan', $this->F_pendidikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_pekerjaan', $this->F_pekerjaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_pengeluaran', $this->F_pengeluaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_alamat', $this->F_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_telepon', $this->F_telepon->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_hp', $this->F_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('F_hidup', $this->F_hidup->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_nama_wali', $this->G_nama_wali->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_tempat_lahir', $this->G_tempat_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_tanggal_lahir', $this->G_tanggal_lahir->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_agama', $this->G_agama->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_kewarganegaraan', $this->G_kewarganegaraan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_pendidikan', $this->G_pendidikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_pekerjaan', $this->G_pekerjaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_pengeluaran', $this->G_pengeluaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_alamat', $this->G_alamat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_telepon', $this->G_telepon->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('G_hp', $this->G_hp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_kesenian', $this->H_kesenian->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_olahraga', $this->H_olahraga->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_kemasyarakatan', $this->H_kemasyarakatan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('H_lainlain', $this->H_lainlain->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tanggal_meninggalkan', $this->I_tanggal_meninggalkan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_alasan', $this->I_alasan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tanggal_lulus', $this->I_tanggal_lulus->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_sttb', $this->I_sttb->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_danum', $this->I_danum->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_nilai_danum_smp', $this->I_nilai_danum_smp->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tahun1', $this->I_tahun1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tahun2', $this->I_tahun2->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tahun3', $this->I_tahun3->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tk1', $this->I_tk1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tk2', $this->I_tk2->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_tk3', $this->I_tk3->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_dari1', $this->I_dari1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_dari2', $this->I_dari2->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('I_dari3', $this->I_dari3->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_melanjutkan', $this->J_melanjutkan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_tanggal_bekerja', $this->J_tanggal_bekerja->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_nama_perusahaan', $this->J_nama_perusahaan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('J_penghasilan', $this->J_penghasilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis', $this->kode_otomatis->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apakah_valid', $this->apakah_valid->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->no_absen);
				$Doc->ExportCaption($this->A_nis_nasional);
				$Doc->ExportCaption($this->A_nama_Lengkap);
				$Doc->ExportCaption($this->A_nama_panggilan);
				$Doc->ExportCaption($this->A_jenis_kelamin);
				$Doc->ExportCaption($this->A_tempat_lahir);
				$Doc->ExportCaption($this->A_tanggal_lahir);
				$Doc->ExportCaption($this->A_agama);
				$Doc->ExportCaption($this->A_kewarganegaraan);
				$Doc->ExportCaption($this->A_anak_keberapa);
				$Doc->ExportCaption($this->A_jumlah_saudara_kandung);
				$Doc->ExportCaption($this->A_jumlah_saudara_tiri);
				$Doc->ExportCaption($this->A_jumlah_saudara_angkat);
				$Doc->ExportCaption($this->A_status_yatim);
				$Doc->ExportCaption($this->A_bahasa);
				$Doc->ExportCaption($this->B_alamat);
				$Doc->ExportCaption($this->B_telepon_rumah);
				$Doc->ExportCaption($this->B_tinggal);
				$Doc->ExportCaption($this->B_jarak);
				$Doc->ExportCaption($this->B_hp);
				$Doc->ExportCaption($this->C_golongan_darah);
				$Doc->ExportCaption($this->C_penyakit);
				$Doc->ExportCaption($this->C_jasmani);
				$Doc->ExportCaption($this->C_tinggi);
				$Doc->ExportCaption($this->C_berat);
				$Doc->ExportCaption($this->D_tamatan_dari);
				$Doc->ExportCaption($this->D_sttb);
				$Doc->ExportCaption($this->D_tanggal_sttb);
				$Doc->ExportCaption($this->D_danum);
				$Doc->ExportCaption($this->D_tanggal_danum);
				$Doc->ExportCaption($this->D_lama_belajar);
				$Doc->ExportCaption($this->D_dari_sekolah);
				$Doc->ExportCaption($this->D_alasan);
				$Doc->ExportCaption($this->D_kelas);
				$Doc->ExportCaption($this->D_kelompok);
				$Doc->ExportCaption($this->D_tanggal);
				$Doc->ExportCaption($this->D_saat_ini_tingkat);
				$Doc->ExportCaption($this->D_saat_ini_kelas);
				$Doc->ExportCaption($this->D_saat_ini_kelompok);
				$Doc->ExportCaption($this->D_no_psb);
				$Doc->ExportCaption($this->D_nilai_danum_sd);
				$Doc->ExportCaption($this->D_jumlah_pelajaran_danum);
				$Doc->ExportCaption($this->D_nilai_ujian_psb);
				$Doc->ExportCaption($this->D_tahun_psb);
				$Doc->ExportCaption($this->D_diterima);
				$Doc->ExportCaption($this->D_spp);
				$Doc->ExportCaption($this->D_spp_potongan);
				$Doc->ExportCaption($this->D_status_lama_baru);
				$Doc->ExportCaption($this->E_nama_ayah);
				$Doc->ExportCaption($this->E_tempat_lahir);
				$Doc->ExportCaption($this->E_tanggal_lahir);
				$Doc->ExportCaption($this->E_agama);
				$Doc->ExportCaption($this->E_kewarganegaraan);
				$Doc->ExportCaption($this->E_pendidikan);
				$Doc->ExportCaption($this->E_pekerjaan);
				$Doc->ExportCaption($this->E_pengeluaran);
				$Doc->ExportCaption($this->E_alamat);
				$Doc->ExportCaption($this->E_telepon);
				$Doc->ExportCaption($this->E_hp);
				$Doc->ExportCaption($this->E_hidup);
				$Doc->ExportCaption($this->F_nama_ibu);
				$Doc->ExportCaption($this->F_tempat_lahir);
				$Doc->ExportCaption($this->F_tanggal_lahir);
				$Doc->ExportCaption($this->F_agama);
				$Doc->ExportCaption($this->F_kewarganegaraan);
				$Doc->ExportCaption($this->F_pendidikan);
				$Doc->ExportCaption($this->F_pekerjaan);
				$Doc->ExportCaption($this->F_pengeluaran);
				$Doc->ExportCaption($this->F_alamat);
				$Doc->ExportCaption($this->F_telepon);
				$Doc->ExportCaption($this->F_hp);
				$Doc->ExportCaption($this->F_hidup);
				$Doc->ExportCaption($this->G_nama_wali);
				$Doc->ExportCaption($this->G_tempat_lahir);
				$Doc->ExportCaption($this->G_tanggal_lahir);
				$Doc->ExportCaption($this->G_agama);
				$Doc->ExportCaption($this->G_kewarganegaraan);
				$Doc->ExportCaption($this->G_pendidikan);
				$Doc->ExportCaption($this->G_pekerjaan);
				$Doc->ExportCaption($this->G_pengeluaran);
				$Doc->ExportCaption($this->G_alamat);
				$Doc->ExportCaption($this->G_telepon);
				$Doc->ExportCaption($this->G_hp);
				$Doc->ExportCaption($this->H_kesenian);
				$Doc->ExportCaption($this->H_olahraga);
				$Doc->ExportCaption($this->H_kemasyarakatan);
				$Doc->ExportCaption($this->H_lainlain);
				$Doc->ExportCaption($this->I_tanggal_meninggalkan);
				$Doc->ExportCaption($this->I_alasan);
				$Doc->ExportCaption($this->I_tanggal_lulus);
				$Doc->ExportCaption($this->I_sttb);
				$Doc->ExportCaption($this->I_danum);
				$Doc->ExportCaption($this->I_nilai_danum_smp);
				$Doc->ExportCaption($this->I_tahun1);
				$Doc->ExportCaption($this->I_tahun2);
				$Doc->ExportCaption($this->I_tahun3);
				$Doc->ExportCaption($this->I_tk1);
				$Doc->ExportCaption($this->I_tk2);
				$Doc->ExportCaption($this->I_tk3);
				$Doc->ExportCaption($this->I_dari1);
				$Doc->ExportCaption($this->I_dari2);
				$Doc->ExportCaption($this->I_dari3);
				$Doc->ExportCaption($this->J_melanjutkan);
				$Doc->ExportCaption($this->J_tanggal_bekerja);
				$Doc->ExportCaption($this->J_nama_perusahaan);
				$Doc->ExportCaption($this->J_penghasilan);
				$Doc->ExportCaption($this->kode_otomatis);
				$Doc->ExportCaption($this->apakah_valid);
			} else {
				$Doc->ExportCaption($this->no_absen);
				$Doc->ExportCaption($this->A_nis_nasional);
				$Doc->ExportCaption($this->A_nama_Lengkap);
				$Doc->ExportCaption($this->A_nama_panggilan);
				$Doc->ExportCaption($this->A_jenis_kelamin);
				$Doc->ExportCaption($this->A_tempat_lahir);
				$Doc->ExportCaption($this->A_tanggal_lahir);
				$Doc->ExportCaption($this->A_agama);
				$Doc->ExportCaption($this->A_kewarganegaraan);
				$Doc->ExportCaption($this->A_anak_keberapa);
				$Doc->ExportCaption($this->A_jumlah_saudara_kandung);
				$Doc->ExportCaption($this->A_jumlah_saudara_tiri);
				$Doc->ExportCaption($this->A_jumlah_saudara_angkat);
				$Doc->ExportCaption($this->A_status_yatim);
				$Doc->ExportCaption($this->A_bahasa);
				$Doc->ExportCaption($this->B_alamat);
				$Doc->ExportCaption($this->B_telepon_rumah);
				$Doc->ExportCaption($this->B_tinggal);
				$Doc->ExportCaption($this->B_jarak);
				$Doc->ExportCaption($this->B_hp);
				$Doc->ExportCaption($this->C_golongan_darah);
				$Doc->ExportCaption($this->C_penyakit);
				$Doc->ExportCaption($this->C_jasmani);
				$Doc->ExportCaption($this->C_tinggi);
				$Doc->ExportCaption($this->C_berat);
				$Doc->ExportCaption($this->D_tamatan_dari);
				$Doc->ExportCaption($this->D_sttb);
				$Doc->ExportCaption($this->D_tanggal_sttb);
				$Doc->ExportCaption($this->D_danum);
				$Doc->ExportCaption($this->D_tanggal_danum);
				$Doc->ExportCaption($this->D_lama_belajar);
				$Doc->ExportCaption($this->D_dari_sekolah);
				$Doc->ExportCaption($this->D_alasan);
				$Doc->ExportCaption($this->D_kelas);
				$Doc->ExportCaption($this->D_kelompok);
				$Doc->ExportCaption($this->D_tanggal);
				$Doc->ExportCaption($this->D_saat_ini_tingkat);
				$Doc->ExportCaption($this->D_saat_ini_kelas);
				$Doc->ExportCaption($this->D_saat_ini_kelompok);
				$Doc->ExportCaption($this->D_no_psb);
				$Doc->ExportCaption($this->D_nilai_danum_sd);
				$Doc->ExportCaption($this->D_jumlah_pelajaran_danum);
				$Doc->ExportCaption($this->D_nilai_ujian_psb);
				$Doc->ExportCaption($this->D_tahun_psb);
				$Doc->ExportCaption($this->D_diterima);
				$Doc->ExportCaption($this->D_spp);
				$Doc->ExportCaption($this->D_spp_potongan);
				$Doc->ExportCaption($this->D_status_lama_baru);
				$Doc->ExportCaption($this->E_nama_ayah);
				$Doc->ExportCaption($this->E_tempat_lahir);
				$Doc->ExportCaption($this->E_tanggal_lahir);
				$Doc->ExportCaption($this->E_agama);
				$Doc->ExportCaption($this->E_kewarganegaraan);
				$Doc->ExportCaption($this->E_pendidikan);
				$Doc->ExportCaption($this->E_pekerjaan);
				$Doc->ExportCaption($this->E_pengeluaran);
				$Doc->ExportCaption($this->E_alamat);
				$Doc->ExportCaption($this->E_telepon);
				$Doc->ExportCaption($this->E_hp);
				$Doc->ExportCaption($this->E_hidup);
				$Doc->ExportCaption($this->F_nama_ibu);
				$Doc->ExportCaption($this->F_tempat_lahir);
				$Doc->ExportCaption($this->F_tanggal_lahir);
				$Doc->ExportCaption($this->F_agama);
				$Doc->ExportCaption($this->F_kewarganegaraan);
				$Doc->ExportCaption($this->F_pendidikan);
				$Doc->ExportCaption($this->F_pekerjaan);
				$Doc->ExportCaption($this->F_pengeluaran);
				$Doc->ExportCaption($this->F_alamat);
				$Doc->ExportCaption($this->F_telepon);
				$Doc->ExportCaption($this->F_hp);
				$Doc->ExportCaption($this->F_hidup);
				$Doc->ExportCaption($this->G_nama_wali);
				$Doc->ExportCaption($this->G_tempat_lahir);
				$Doc->ExportCaption($this->G_tanggal_lahir);
				$Doc->ExportCaption($this->G_agama);
				$Doc->ExportCaption($this->G_kewarganegaraan);
				$Doc->ExportCaption($this->G_pendidikan);
				$Doc->ExportCaption($this->G_pekerjaan);
				$Doc->ExportCaption($this->G_pengeluaran);
				$Doc->ExportCaption($this->G_alamat);
				$Doc->ExportCaption($this->G_telepon);
				$Doc->ExportCaption($this->G_hp);
				$Doc->ExportCaption($this->H_kesenian);
				$Doc->ExportCaption($this->H_olahraga);
				$Doc->ExportCaption($this->H_kemasyarakatan);
				$Doc->ExportCaption($this->H_lainlain);
				$Doc->ExportCaption($this->I_tanggal_meninggalkan);
				$Doc->ExportCaption($this->I_alasan);
				$Doc->ExportCaption($this->I_tanggal_lulus);
				$Doc->ExportCaption($this->I_sttb);
				$Doc->ExportCaption($this->I_danum);
				$Doc->ExportCaption($this->I_nilai_danum_smp);
				$Doc->ExportCaption($this->I_tahun1);
				$Doc->ExportCaption($this->I_tahun2);
				$Doc->ExportCaption($this->I_tahun3);
				$Doc->ExportCaption($this->I_tk1);
				$Doc->ExportCaption($this->I_tk2);
				$Doc->ExportCaption($this->I_tk3);
				$Doc->ExportCaption($this->I_dari1);
				$Doc->ExportCaption($this->I_dari2);
				$Doc->ExportCaption($this->I_dari3);
				$Doc->ExportCaption($this->J_melanjutkan);
				$Doc->ExportCaption($this->J_tanggal_bekerja);
				$Doc->ExportCaption($this->J_nama_perusahaan);
				$Doc->ExportCaption($this->J_penghasilan);
				$Doc->ExportCaption($this->kode_otomatis);
				$Doc->ExportCaption($this->apakah_valid);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->no_absen);
					$Doc->ExportField($this->A_nis_nasional);
					$Doc->ExportField($this->A_nama_Lengkap);
					$Doc->ExportField($this->A_nama_panggilan);
					$Doc->ExportField($this->A_jenis_kelamin);
					$Doc->ExportField($this->A_tempat_lahir);
					$Doc->ExportField($this->A_tanggal_lahir);
					$Doc->ExportField($this->A_agama);
					$Doc->ExportField($this->A_kewarganegaraan);
					$Doc->ExportField($this->A_anak_keberapa);
					$Doc->ExportField($this->A_jumlah_saudara_kandung);
					$Doc->ExportField($this->A_jumlah_saudara_tiri);
					$Doc->ExportField($this->A_jumlah_saudara_angkat);
					$Doc->ExportField($this->A_status_yatim);
					$Doc->ExportField($this->A_bahasa);
					$Doc->ExportField($this->B_alamat);
					$Doc->ExportField($this->B_telepon_rumah);
					$Doc->ExportField($this->B_tinggal);
					$Doc->ExportField($this->B_jarak);
					$Doc->ExportField($this->B_hp);
					$Doc->ExportField($this->C_golongan_darah);
					$Doc->ExportField($this->C_penyakit);
					$Doc->ExportField($this->C_jasmani);
					$Doc->ExportField($this->C_tinggi);
					$Doc->ExportField($this->C_berat);
					$Doc->ExportField($this->D_tamatan_dari);
					$Doc->ExportField($this->D_sttb);
					$Doc->ExportField($this->D_tanggal_sttb);
					$Doc->ExportField($this->D_danum);
					$Doc->ExportField($this->D_tanggal_danum);
					$Doc->ExportField($this->D_lama_belajar);
					$Doc->ExportField($this->D_dari_sekolah);
					$Doc->ExportField($this->D_alasan);
					$Doc->ExportField($this->D_kelas);
					$Doc->ExportField($this->D_kelompok);
					$Doc->ExportField($this->D_tanggal);
					$Doc->ExportField($this->D_saat_ini_tingkat);
					$Doc->ExportField($this->D_saat_ini_kelas);
					$Doc->ExportField($this->D_saat_ini_kelompok);
					$Doc->ExportField($this->D_no_psb);
					$Doc->ExportField($this->D_nilai_danum_sd);
					$Doc->ExportField($this->D_jumlah_pelajaran_danum);
					$Doc->ExportField($this->D_nilai_ujian_psb);
					$Doc->ExportField($this->D_tahun_psb);
					$Doc->ExportField($this->D_diterima);
					$Doc->ExportField($this->D_spp);
					$Doc->ExportField($this->D_spp_potongan);
					$Doc->ExportField($this->D_status_lama_baru);
					$Doc->ExportField($this->E_nama_ayah);
					$Doc->ExportField($this->E_tempat_lahir);
					$Doc->ExportField($this->E_tanggal_lahir);
					$Doc->ExportField($this->E_agama);
					$Doc->ExportField($this->E_kewarganegaraan);
					$Doc->ExportField($this->E_pendidikan);
					$Doc->ExportField($this->E_pekerjaan);
					$Doc->ExportField($this->E_pengeluaran);
					$Doc->ExportField($this->E_alamat);
					$Doc->ExportField($this->E_telepon);
					$Doc->ExportField($this->E_hp);
					$Doc->ExportField($this->E_hidup);
					$Doc->ExportField($this->F_nama_ibu);
					$Doc->ExportField($this->F_tempat_lahir);
					$Doc->ExportField($this->F_tanggal_lahir);
					$Doc->ExportField($this->F_agama);
					$Doc->ExportField($this->F_kewarganegaraan);
					$Doc->ExportField($this->F_pendidikan);
					$Doc->ExportField($this->F_pekerjaan);
					$Doc->ExportField($this->F_pengeluaran);
					$Doc->ExportField($this->F_alamat);
					$Doc->ExportField($this->F_telepon);
					$Doc->ExportField($this->F_hp);
					$Doc->ExportField($this->F_hidup);
					$Doc->ExportField($this->G_nama_wali);
					$Doc->ExportField($this->G_tempat_lahir);
					$Doc->ExportField($this->G_tanggal_lahir);
					$Doc->ExportField($this->G_agama);
					$Doc->ExportField($this->G_kewarganegaraan);
					$Doc->ExportField($this->G_pendidikan);
					$Doc->ExportField($this->G_pekerjaan);
					$Doc->ExportField($this->G_pengeluaran);
					$Doc->ExportField($this->G_alamat);
					$Doc->ExportField($this->G_telepon);
					$Doc->ExportField($this->G_hp);
					$Doc->ExportField($this->H_kesenian);
					$Doc->ExportField($this->H_olahraga);
					$Doc->ExportField($this->H_kemasyarakatan);
					$Doc->ExportField($this->H_lainlain);
					$Doc->ExportField($this->I_tanggal_meninggalkan);
					$Doc->ExportField($this->I_alasan);
					$Doc->ExportField($this->I_tanggal_lulus);
					$Doc->ExportField($this->I_sttb);
					$Doc->ExportField($this->I_danum);
					$Doc->ExportField($this->I_nilai_danum_smp);
					$Doc->ExportField($this->I_tahun1);
					$Doc->ExportField($this->I_tahun2);
					$Doc->ExportField($this->I_tahun3);
					$Doc->ExportField($this->I_tk1);
					$Doc->ExportField($this->I_tk2);
					$Doc->ExportField($this->I_tk3);
					$Doc->ExportField($this->I_dari1);
					$Doc->ExportField($this->I_dari2);
					$Doc->ExportField($this->I_dari3);
					$Doc->ExportField($this->J_melanjutkan);
					$Doc->ExportField($this->J_tanggal_bekerja);
					$Doc->ExportField($this->J_nama_perusahaan);
					$Doc->ExportField($this->J_penghasilan);
					$Doc->ExportField($this->kode_otomatis);
					$Doc->ExportField($this->apakah_valid);
				} else {
					$Doc->ExportField($this->no_absen);
					$Doc->ExportField($this->A_nis_nasional);
					$Doc->ExportField($this->A_nama_Lengkap);
					$Doc->ExportField($this->A_nama_panggilan);
					$Doc->ExportField($this->A_jenis_kelamin);
					$Doc->ExportField($this->A_tempat_lahir);
					$Doc->ExportField($this->A_tanggal_lahir);
					$Doc->ExportField($this->A_agama);
					$Doc->ExportField($this->A_kewarganegaraan);
					$Doc->ExportField($this->A_anak_keberapa);
					$Doc->ExportField($this->A_jumlah_saudara_kandung);
					$Doc->ExportField($this->A_jumlah_saudara_tiri);
					$Doc->ExportField($this->A_jumlah_saudara_angkat);
					$Doc->ExportField($this->A_status_yatim);
					$Doc->ExportField($this->A_bahasa);
					$Doc->ExportField($this->B_alamat);
					$Doc->ExportField($this->B_telepon_rumah);
					$Doc->ExportField($this->B_tinggal);
					$Doc->ExportField($this->B_jarak);
					$Doc->ExportField($this->B_hp);
					$Doc->ExportField($this->C_golongan_darah);
					$Doc->ExportField($this->C_penyakit);
					$Doc->ExportField($this->C_jasmani);
					$Doc->ExportField($this->C_tinggi);
					$Doc->ExportField($this->C_berat);
					$Doc->ExportField($this->D_tamatan_dari);
					$Doc->ExportField($this->D_sttb);
					$Doc->ExportField($this->D_tanggal_sttb);
					$Doc->ExportField($this->D_danum);
					$Doc->ExportField($this->D_tanggal_danum);
					$Doc->ExportField($this->D_lama_belajar);
					$Doc->ExportField($this->D_dari_sekolah);
					$Doc->ExportField($this->D_alasan);
					$Doc->ExportField($this->D_kelas);
					$Doc->ExportField($this->D_kelompok);
					$Doc->ExportField($this->D_tanggal);
					$Doc->ExportField($this->D_saat_ini_tingkat);
					$Doc->ExportField($this->D_saat_ini_kelas);
					$Doc->ExportField($this->D_saat_ini_kelompok);
					$Doc->ExportField($this->D_no_psb);
					$Doc->ExportField($this->D_nilai_danum_sd);
					$Doc->ExportField($this->D_jumlah_pelajaran_danum);
					$Doc->ExportField($this->D_nilai_ujian_psb);
					$Doc->ExportField($this->D_tahun_psb);
					$Doc->ExportField($this->D_diterima);
					$Doc->ExportField($this->D_spp);
					$Doc->ExportField($this->D_spp_potongan);
					$Doc->ExportField($this->D_status_lama_baru);
					$Doc->ExportField($this->E_nama_ayah);
					$Doc->ExportField($this->E_tempat_lahir);
					$Doc->ExportField($this->E_tanggal_lahir);
					$Doc->ExportField($this->E_agama);
					$Doc->ExportField($this->E_kewarganegaraan);
					$Doc->ExportField($this->E_pendidikan);
					$Doc->ExportField($this->E_pekerjaan);
					$Doc->ExportField($this->E_pengeluaran);
					$Doc->ExportField($this->E_alamat);
					$Doc->ExportField($this->E_telepon);
					$Doc->ExportField($this->E_hp);
					$Doc->ExportField($this->E_hidup);
					$Doc->ExportField($this->F_nama_ibu);
					$Doc->ExportField($this->F_tempat_lahir);
					$Doc->ExportField($this->F_tanggal_lahir);
					$Doc->ExportField($this->F_agama);
					$Doc->ExportField($this->F_kewarganegaraan);
					$Doc->ExportField($this->F_pendidikan);
					$Doc->ExportField($this->F_pekerjaan);
					$Doc->ExportField($this->F_pengeluaran);
					$Doc->ExportField($this->F_alamat);
					$Doc->ExportField($this->F_telepon);
					$Doc->ExportField($this->F_hp);
					$Doc->ExportField($this->F_hidup);
					$Doc->ExportField($this->G_nama_wali);
					$Doc->ExportField($this->G_tempat_lahir);
					$Doc->ExportField($this->G_tanggal_lahir);
					$Doc->ExportField($this->G_agama);
					$Doc->ExportField($this->G_kewarganegaraan);
					$Doc->ExportField($this->G_pendidikan);
					$Doc->ExportField($this->G_pekerjaan);
					$Doc->ExportField($this->G_pengeluaran);
					$Doc->ExportField($this->G_alamat);
					$Doc->ExportField($this->G_telepon);
					$Doc->ExportField($this->G_hp);
					$Doc->ExportField($this->H_kesenian);
					$Doc->ExportField($this->H_olahraga);
					$Doc->ExportField($this->H_kemasyarakatan);
					$Doc->ExportField($this->H_lainlain);
					$Doc->ExportField($this->I_tanggal_meninggalkan);
					$Doc->ExportField($this->I_alasan);
					$Doc->ExportField($this->I_tanggal_lulus);
					$Doc->ExportField($this->I_sttb);
					$Doc->ExportField($this->I_danum);
					$Doc->ExportField($this->I_nilai_danum_smp);
					$Doc->ExportField($this->I_tahun1);
					$Doc->ExportField($this->I_tahun2);
					$Doc->ExportField($this->I_tahun3);
					$Doc->ExportField($this->I_tk1);
					$Doc->ExportField($this->I_tk2);
					$Doc->ExportField($this->I_tk3);
					$Doc->ExportField($this->I_dari1);
					$Doc->ExportField($this->I_dari2);
					$Doc->ExportField($this->I_dari3);
					$Doc->ExportField($this->J_melanjutkan);
					$Doc->ExportField($this->J_tanggal_bekerja);
					$Doc->ExportField($this->J_nama_perusahaan);
					$Doc->ExportField($this->J_penghasilan);
					$Doc->ExportField($this->kode_otomatis);
					$Doc->ExportField($this->apakah_valid);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

		// Row Inserting event
function Row_Inserting($rsold, &$rsnew) {
	if ($_SESSION['kode_otomatis_tingkat']=="")
	{
		 return FALSE;
	}
	
	else
	{
		return TRUE;
	 }
}               

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>

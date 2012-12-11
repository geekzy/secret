<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_siswainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_siswa_edit = new cmaster_siswa_edit();
$Page =& $master_siswa_edit;

// Page init
$master_siswa_edit->Page_Init();

// Page main
$master_siswa_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var master_siswa_edit = new ew_Page("master_siswa_edit");

// page properties
master_siswa_edit.PageID = "edit"; // page ID
master_siswa_edit.FormID = "fmaster_siswaedit"; // form ID
var EW_PAGE_ID = master_siswa_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
master_siswa_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_no_absen"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->no_absen->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_no_absen"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->no_absen->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_nama_Lengkap"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_nama_Lengkap->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_nama_panggilan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_nama_panggilan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_jenis_kelamin"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_jenis_kelamin->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_tempat_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_tempat_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_tanggal_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_tanggal_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_agama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_agama->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_kewarganegaraan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_kewarganegaraan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_anak_keberapa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_anak_keberapa->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_anak_keberapa"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_anak_keberapa->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_kandung"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_kandung->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_kandung"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_kandung->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_tiri"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_tiri->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_tiri"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_tiri->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_angkat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_angkat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_angkat"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_angkat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_status_yatim"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_status_yatim->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_A_bahasa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->A_bahasa->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_B_alamat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->B_alamat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_B_telepon_rumah"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->B_telepon_rumah->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_B_tinggal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->B_tinggal->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_B_jarak"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->B_jarak->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_B_jarak"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->B_jarak->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_B_hp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->B_hp->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_C_golongan_darah"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->C_golongan_darah->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_C_penyakit"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->C_penyakit->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_C_jasmani"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->C_jasmani->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_C_tinggi"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->C_tinggi->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_C_tinggi"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->C_tinggi->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_C_berat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->C_berat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_C_berat"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->C_berat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_tamatan_dari"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_tamatan_dari->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_sttb"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_sttb->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal_sttb"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_tanggal_sttb->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal_sttb"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_tanggal_sttb->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_danum"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_danum->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal_danum"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_tanggal_danum->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal_danum"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_tanggal_danum->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_lama_belajar"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_lama_belajar->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_lama_belajar"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_lama_belajar->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_dari_sekolah"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_dari_sekolah->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_alasan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_alasan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_kelas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_kelas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_kelompok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_tanggal->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_tanggal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_saat_ini_kelas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_saat_ini_kelas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_saat_ini_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_saat_ini_kelompok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_no_psb"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_no_psb->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_nilai_danum_sd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_nilai_danum_sd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_nilai_danum_sd"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_nilai_danum_sd->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_jumlah_pelajaran_danum"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_jumlah_pelajaran_danum->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_jumlah_pelajaran_danum"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_jumlah_pelajaran_danum->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_nilai_ujian_psb"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_nilai_ujian_psb->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_nilai_ujian_psb"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_nilai_ujian_psb->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_tahun_psb"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_tahun_psb->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_diterima"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_diterima->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_spp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_spp->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_spp"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_spp->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_spp_potongan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_spp_potongan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D_spp_potongan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_spp_potongan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_status_lama_baru"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->D_status_lama_baru->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_nama_ayah"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_nama_ayah->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_tempat_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_tempat_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_tanggal_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_tanggal_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->E_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_E_agama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_agama->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_kewarganegaraan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_kewarganegaraan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_pendidikan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_pendidikan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_pekerjaan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_pekerjaan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_pengeluaran"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_pengeluaran->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_pengeluaran"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->E_pengeluaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_E_alamat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_alamat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_telepon"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_telepon->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_hp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_hp->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_E_hidup"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->E_hidup->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_nama_ibu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_nama_ibu->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_tempat_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_tempat_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_tanggal_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_tanggal_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->F_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_F_agama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_agama->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_kewarganegaraan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_kewarganegaraan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_pendidikan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_pendidikan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_pekerjaan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_pekerjaan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_pengeluaran"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_pengeluaran->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_pengeluaran"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->F_pengeluaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_F_alamat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_alamat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_telepon"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_telepon->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_hp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_hp->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_F_hidup"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->F_hidup->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_nama_wali"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_nama_wali->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_tempat_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_tempat_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_tanggal_lahir"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_tanggal_lahir->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->G_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_G_agama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_agama->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_kewarganegaraan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_kewarganegaraan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_pendidikan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_pendidikan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_pekerjaan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_pekerjaan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_pengeluaran"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_pengeluaran->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_pengeluaran"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->G_pengeluaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_G_alamat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_alamat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_telepon"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_telepon->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_G_hp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->G_hp->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_H_kesenian"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->H_kesenian->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_H_olahraga"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->H_olahraga->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_H_kemasyarakatan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->H_kemasyarakatan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_H_lainlain"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->H_lainlain->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tanggal_meninggalkan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tanggal_meninggalkan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tanggal_meninggalkan"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->I_tanggal_meninggalkan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_I_alasan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_alasan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tanggal_lulus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tanggal_lulus->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tanggal_lulus"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->I_tanggal_lulus->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_I_sttb"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_sttb->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_danum"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_danum->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_nilai_danum_smp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_nilai_danum_smp->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_nilai_danum_smp"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->I_nilai_danum_smp->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_I_tahun1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tahun1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tahun2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tahun2->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tahun3"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tahun3->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tk1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tk1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tk2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tk2->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_tk3"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_tk3->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_dari1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_dari1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_dari2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_dari2->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_I_dari3"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->I_dari3->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_J_melanjutkan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->J_melanjutkan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_J_tanggal_bekerja"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->J_tanggal_bekerja->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_J_tanggal_bekerja"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->J_tanggal_bekerja->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_J_nama_perusahaan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->J_nama_perusahaan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_J_penghasilan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->J_penghasilan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_J_penghasilan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->J_penghasilan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_apakah_valid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_siswa->apakah_valid->FldCaption()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
master_siswa_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
master_siswa_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
master_siswa_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_siswa_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// multi page properties
master_siswa_edit.MultiPage = new ew_MultiPage();
master_siswa_edit.MultiPage.AddElement("x_no_absen", 1);
master_siswa_edit.MultiPage.AddElement("x_A_nama_Lengkap", 1);
master_siswa_edit.MultiPage.AddElement("x_A_nama_panggilan", 1);
master_siswa_edit.MultiPage.AddElement("x_A_jenis_kelamin", 1);
master_siswa_edit.MultiPage.AddElement("x_A_tempat_lahir", 1);
master_siswa_edit.MultiPage.AddElement("x_A_tanggal_lahir", 1);
master_siswa_edit.MultiPage.AddElement("x_A_agama", 1);
master_siswa_edit.MultiPage.AddElement("x_A_kewarganegaraan", 1);
master_siswa_edit.MultiPage.AddElement("x_A_anak_keberapa", 1);
master_siswa_edit.MultiPage.AddElement("x_A_jumlah_saudara_kandung", 1);
master_siswa_edit.MultiPage.AddElement("x_A_jumlah_saudara_tiri", 1);
master_siswa_edit.MultiPage.AddElement("x_A_jumlah_saudara_angkat", 1);
master_siswa_edit.MultiPage.AddElement("x_A_status_yatim", 1);
master_siswa_edit.MultiPage.AddElement("x_A_bahasa", 1);
master_siswa_edit.MultiPage.AddElement("x_B_alamat", 2);
master_siswa_edit.MultiPage.AddElement("x_B_telepon_rumah", 2);
master_siswa_edit.MultiPage.AddElement("x_B_tinggal", 2);
master_siswa_edit.MultiPage.AddElement("x_B_jarak", 2);
master_siswa_edit.MultiPage.AddElement("x_B_hp", 2);
master_siswa_edit.MultiPage.AddElement("x_C_golongan_darah", 3);
master_siswa_edit.MultiPage.AddElement("x_C_penyakit", 3);
master_siswa_edit.MultiPage.AddElement("x_C_jasmani", 3);
master_siswa_edit.MultiPage.AddElement("x_C_tinggi", 3);
master_siswa_edit.MultiPage.AddElement("x_C_berat", 3);
master_siswa_edit.MultiPage.AddElement("x_D_tamatan_dari", 4);
master_siswa_edit.MultiPage.AddElement("x_D_sttb", 4);
master_siswa_edit.MultiPage.AddElement("x_D_tanggal_sttb", 4);
master_siswa_edit.MultiPage.AddElement("x_D_danum", 4);
master_siswa_edit.MultiPage.AddElement("x_D_tanggal_danum", 4);
master_siswa_edit.MultiPage.AddElement("x_D_lama_belajar", 4);
master_siswa_edit.MultiPage.AddElement("x_D_dari_sekolah", 4);
master_siswa_edit.MultiPage.AddElement("x_D_alasan", 4);
master_siswa_edit.MultiPage.AddElement("x_D_kelas", 4);
master_siswa_edit.MultiPage.AddElement("x_D_kelompok", 4);
master_siswa_edit.MultiPage.AddElement("x_D_tanggal", 4);
master_siswa_edit.MultiPage.AddElement("x_D_saat_ini_kelas", 4);
master_siswa_edit.MultiPage.AddElement("x_D_saat_ini_kelompok", 4);
master_siswa_edit.MultiPage.AddElement("x_D_no_psb", 4);
master_siswa_edit.MultiPage.AddElement("x_D_nilai_danum_sd", 4);
master_siswa_edit.MultiPage.AddElement("x_D_jumlah_pelajaran_danum", 4);
master_siswa_edit.MultiPage.AddElement("x_D_nilai_ujian_psb", 4);
master_siswa_edit.MultiPage.AddElement("x_D_tahun_psb", 4);
master_siswa_edit.MultiPage.AddElement("x_D_diterima", 4);
master_siswa_edit.MultiPage.AddElement("x_D_spp", 4);
master_siswa_edit.MultiPage.AddElement("x_D_spp_potongan", 4);
master_siswa_edit.MultiPage.AddElement("x_D_status_lama_baru", 5);
master_siswa_edit.MultiPage.AddElement("x_E_nama_ayah", 5);
master_siswa_edit.MultiPage.AddElement("x_E_tempat_lahir", 5);
master_siswa_edit.MultiPage.AddElement("x_E_tanggal_lahir", 5);
master_siswa_edit.MultiPage.AddElement("x_E_agama", 5);
master_siswa_edit.MultiPage.AddElement("x_E_kewarganegaraan", 5);
master_siswa_edit.MultiPage.AddElement("x_E_pendidikan", 5);
master_siswa_edit.MultiPage.AddElement("x_E_pekerjaan", 5);
master_siswa_edit.MultiPage.AddElement("x_E_pengeluaran", 5);
master_siswa_edit.MultiPage.AddElement("x_E_alamat", 5);
master_siswa_edit.MultiPage.AddElement("x_E_telepon", 5);
master_siswa_edit.MultiPage.AddElement("x_E_hp", 5);
master_siswa_edit.MultiPage.AddElement("x_E_hidup", 5);
master_siswa_edit.MultiPage.AddElement("x_F_nama_ibu", 6);
master_siswa_edit.MultiPage.AddElement("x_F_tempat_lahir", 6);
master_siswa_edit.MultiPage.AddElement("x_F_tanggal_lahir", 6);
master_siswa_edit.MultiPage.AddElement("x_F_agama", 6);
master_siswa_edit.MultiPage.AddElement("x_F_kewarganegaraan", 6);
master_siswa_edit.MultiPage.AddElement("x_F_pendidikan", 6);
master_siswa_edit.MultiPage.AddElement("x_F_pekerjaan", 6);
master_siswa_edit.MultiPage.AddElement("x_F_pengeluaran", 6);
master_siswa_edit.MultiPage.AddElement("x_F_alamat", 6);
master_siswa_edit.MultiPage.AddElement("x_F_telepon", 6);
master_siswa_edit.MultiPage.AddElement("x_F_hp", 6);
master_siswa_edit.MultiPage.AddElement("x_F_hidup", 6);
master_siswa_edit.MultiPage.AddElement("x_G_nama_wali", 7);
master_siswa_edit.MultiPage.AddElement("x_G_tempat_lahir", 7);
master_siswa_edit.MultiPage.AddElement("x_G_tanggal_lahir", 7);
master_siswa_edit.MultiPage.AddElement("x_G_agama", 7);
master_siswa_edit.MultiPage.AddElement("x_G_kewarganegaraan", 7);
master_siswa_edit.MultiPage.AddElement("x_G_pendidikan", 7);
master_siswa_edit.MultiPage.AddElement("x_G_pekerjaan", 7);
master_siswa_edit.MultiPage.AddElement("x_G_pengeluaran", 7);
master_siswa_edit.MultiPage.AddElement("x_G_alamat", 7);
master_siswa_edit.MultiPage.AddElement("x_G_telepon", 7);
master_siswa_edit.MultiPage.AddElement("x_G_hp", 7);
master_siswa_edit.MultiPage.AddElement("x_H_kesenian", 8);
master_siswa_edit.MultiPage.AddElement("x_H_olahraga", 8);
master_siswa_edit.MultiPage.AddElement("x_H_kemasyarakatan", 8);
master_siswa_edit.MultiPage.AddElement("x_H_lainlain", 8);
master_siswa_edit.MultiPage.AddElement("x_I_tanggal_meninggalkan", 9);
master_siswa_edit.MultiPage.AddElement("x_I_alasan", 9);
master_siswa_edit.MultiPage.AddElement("x_I_tanggal_lulus", 9);
master_siswa_edit.MultiPage.AddElement("x_I_sttb", 9);
master_siswa_edit.MultiPage.AddElement("x_I_danum", 9);
master_siswa_edit.MultiPage.AddElement("x_I_nilai_danum_smp", 9);
master_siswa_edit.MultiPage.AddElement("x_I_tahun1", 9);
master_siswa_edit.MultiPage.AddElement("x_I_tahun2", 9);
master_siswa_edit.MultiPage.AddElement("x_I_tahun3", 9);
master_siswa_edit.MultiPage.AddElement("x_I_tk1", 9);
master_siswa_edit.MultiPage.AddElement("x_I_tk2", 9);
master_siswa_edit.MultiPage.AddElement("x_I_tk3", 9);
master_siswa_edit.MultiPage.AddElement("x_I_dari1", 9);
master_siswa_edit.MultiPage.AddElement("x_I_dari2", 9);
master_siswa_edit.MultiPage.AddElement("x_I_dari3", 9);
master_siswa_edit.MultiPage.AddElement("x_J_melanjutkan", 10);
master_siswa_edit.MultiPage.AddElement("x_J_tanggal_bekerja", 10);
master_siswa_edit.MultiPage.AddElement("x_J_nama_perusahaan", 10);
master_siswa_edit.MultiPage.AddElement("x_J_penghasilan", 10);
master_siswa_edit.MultiPage.AddElement("x_apakah_valid", 1);

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $master_siswa->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $master_siswa->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $master_siswa_edit->ShowPageHeader(); ?>
<?php
$master_siswa_edit->ShowMessage();
?>
<form name="fmaster_siswaedit" id="fmaster_siswaedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return master_siswa_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="master_siswa">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" cellpadding="0"><tr><td>
<div id="master_siswa_edit" class="yui-navset">
	<ul class="yui-nav">
		<li class="selected"><a href="#tab_master_siswa_1"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(1) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_2"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(2) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_3"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(3) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_4"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(4) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_5"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(5) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_6"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(6) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_7"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(7) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_8"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(8) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_9"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(9) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_10"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(10) ?></span></em></a></li>
	</ul>            
	<div class="yui-content">
		<div id="tab_master_siswa_1">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->no_absen->Visible) { // no_absen ?>
	<tr id="r_no_absen"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->no_absen->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->no_absen->CellAttributes() ?>><span id="el_no_absen">
<input type="text" name="x_no_absen" id="x_no_absen" size="30" value="<?php echo $master_siswa->no_absen->EditValue ?>"<?php echo $master_siswa->no_absen->EditAttributes() ?>>
</span><?php echo $master_siswa->no_absen->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_A_nis_nasional" id="x_A_nis_nasional" value="<?php echo ew_HtmlEncode($master_siswa->A_nis_nasional->CurrentValue) ?>">
<?php if ($master_siswa->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
	<tr id="r_A_nama_Lengkap"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_nama_Lengkap->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_nama_Lengkap->CellAttributes() ?>><span id="el_A_nama_Lengkap">
<input type="text" name="x_A_nama_Lengkap" id="x_A_nama_Lengkap" size="30" maxlength="50" value="<?php echo $master_siswa->A_nama_Lengkap->EditValue ?>"<?php echo $master_siswa->A_nama_Lengkap->EditAttributes() ?>>
</span><?php echo $master_siswa->A_nama_Lengkap->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_nama_panggilan->Visible) { // A_nama_panggilan ?>
	<tr id="r_A_nama_panggilan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_nama_panggilan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_nama_panggilan->CellAttributes() ?>><span id="el_A_nama_panggilan">
<input type="text" name="x_A_nama_panggilan" id="x_A_nama_panggilan" size="30" maxlength="50" value="<?php echo $master_siswa->A_nama_panggilan->EditValue ?>"<?php echo $master_siswa->A_nama_panggilan->EditAttributes() ?>>
</span><?php echo $master_siswa->A_nama_panggilan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_jenis_kelamin->Visible) { // A_jenis_kelamin ?>
	<tr id="r_A_jenis_kelamin"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jenis_kelamin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_jenis_kelamin->CellAttributes() ?>><span id="el_A_jenis_kelamin">
<input type="text" name="x_A_jenis_kelamin" id="x_A_jenis_kelamin" size="30" maxlength="1" value="<?php echo $master_siswa->A_jenis_kelamin->EditValue ?>"<?php echo $master_siswa->A_jenis_kelamin->EditAttributes() ?>>
</span><?php echo $master_siswa->A_jenis_kelamin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_tempat_lahir->Visible) { // A_tempat_lahir ?>
	<tr id="r_A_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_tempat_lahir->CellAttributes() ?>><span id="el_A_tempat_lahir">
<input type="text" name="x_A_tempat_lahir" id="x_A_tempat_lahir" size="30" maxlength="20" value="<?php echo $master_siswa->A_tempat_lahir->EditValue ?>"<?php echo $master_siswa->A_tempat_lahir->EditAttributes() ?>>
</span><?php echo $master_siswa->A_tempat_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_tanggal_lahir->Visible) { // A_tanggal_lahir ?>
	<tr id="r_A_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_tanggal_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_tanggal_lahir->CellAttributes() ?>><span id="el_A_tanggal_lahir">
<input type="text" name="x_A_tanggal_lahir" id="x_A_tanggal_lahir" value="<?php echo $master_siswa->A_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->A_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_A_tanggal_lahir" name="cal_x_A_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_A_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_A_tanggal_lahir" // button id
});
</script>
</span><?php echo $master_siswa->A_tanggal_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_agama->Visible) { // A_agama ?>
	<tr id="r_A_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_agama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_agama->CellAttributes() ?>><span id="el_A_agama">
<select id="x_A_agama" name="x_A_agama"<?php echo $master_siswa->A_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->A_agama->EditValue)) {
	$arwrk = $master_siswa->A_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->A_agama->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $master_siswa->A_agama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_kewarganegaraan->Visible) { // A_kewarganegaraan ?>
	<tr id="r_A_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_kewarganegaraan->CellAttributes() ?>><span id="el_A_kewarganegaraan">
<input type="text" name="x_A_kewarganegaraan" id="x_A_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->A_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->A_kewarganegaraan->EditAttributes() ?>>
</span><?php echo $master_siswa->A_kewarganegaraan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_anak_keberapa->Visible) { // A_anak_keberapa ?>
	<tr id="r_A_anak_keberapa"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_anak_keberapa->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_anak_keberapa->CellAttributes() ?>><span id="el_A_anak_keberapa">
<input type="text" name="x_A_anak_keberapa" id="x_A_anak_keberapa" size="30" value="<?php echo $master_siswa->A_anak_keberapa->EditValue ?>"<?php echo $master_siswa->A_anak_keberapa->EditAttributes() ?>>
</span><?php echo $master_siswa->A_anak_keberapa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_jumlah_saudara_kandung->Visible) { // A_jumlah_saudara_kandung ?>
	<tr id="r_A_jumlah_saudara_kandung"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jumlah_saudara_kandung->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_kandung->CellAttributes() ?>><span id="el_A_jumlah_saudara_kandung">
<input type="text" name="x_A_jumlah_saudara_kandung" id="x_A_jumlah_saudara_kandung" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_kandung->EditValue ?>"<?php echo $master_siswa->A_jumlah_saudara_kandung->EditAttributes() ?>>
</span><?php echo $master_siswa->A_jumlah_saudara_kandung->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_jumlah_saudara_tiri->Visible) { // A_jumlah_saudara_tiri ?>
	<tr id="r_A_jumlah_saudara_tiri"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jumlah_saudara_tiri->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_tiri->CellAttributes() ?>><span id="el_A_jumlah_saudara_tiri">
<input type="text" name="x_A_jumlah_saudara_tiri" id="x_A_jumlah_saudara_tiri" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_tiri->EditValue ?>"<?php echo $master_siswa->A_jumlah_saudara_tiri->EditAttributes() ?>>
</span><?php echo $master_siswa->A_jumlah_saudara_tiri->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_jumlah_saudara_angkat->Visible) { // A_jumlah_saudara_angkat ?>
	<tr id="r_A_jumlah_saudara_angkat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jumlah_saudara_angkat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_angkat->CellAttributes() ?>><span id="el_A_jumlah_saudara_angkat">
<input type="text" name="x_A_jumlah_saudara_angkat" id="x_A_jumlah_saudara_angkat" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_angkat->EditValue ?>"<?php echo $master_siswa->A_jumlah_saudara_angkat->EditAttributes() ?>>
</span><?php echo $master_siswa->A_jumlah_saudara_angkat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_status_yatim->Visible) { // A_status_yatim ?>
	<tr id="r_A_status_yatim"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_status_yatim->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_status_yatim->CellAttributes() ?>><span id="el_A_status_yatim">
<input type="text" name="x_A_status_yatim" id="x_A_status_yatim" size="30" maxlength="15" value="<?php echo $master_siswa->A_status_yatim->EditValue ?>"<?php echo $master_siswa->A_status_yatim->EditAttributes() ?>>
</span><?php echo $master_siswa->A_status_yatim->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->A_bahasa->Visible) { // A_bahasa ?>
	<tr id="r_A_bahasa"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_bahasa->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->A_bahasa->CellAttributes() ?>><span id="el_A_bahasa">
<input type="text" name="x_A_bahasa" id="x_A_bahasa" size="30" maxlength="50" value="<?php echo $master_siswa->A_bahasa->EditValue ?>"<?php echo $master_siswa->A_bahasa->EditAttributes() ?>>
</span><?php echo $master_siswa->A_bahasa->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($master_siswa->kode_otomatis->CurrentValue) ?>">
<?php if ($master_siswa->apakah_valid->Visible) { // apakah_valid ?>
	<tr id="r_apakah_valid"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->apakah_valid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->apakah_valid->CellAttributes() ?>><span id="el_apakah_valid">
<select id="x_apakah_valid" name="x_apakah_valid"<?php echo $master_siswa->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($master_siswa->apakah_valid->EditValue)) {
	$arwrk = $master_siswa->apakah_valid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->apakah_valid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $master_siswa->apakah_valid->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_2">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->B_alamat->Visible) { // B_alamat ?>
	<tr id="r_B_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_alamat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->B_alamat->CellAttributes() ?>><span id="el_B_alamat">
<input type="text" name="x_B_alamat" id="x_B_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->B_alamat->EditValue ?>"<?php echo $master_siswa->B_alamat->EditAttributes() ?>>
</span><?php echo $master_siswa->B_alamat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->B_telepon_rumah->Visible) { // B_telepon_rumah ?>
	<tr id="r_B_telepon_rumah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_telepon_rumah->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->B_telepon_rumah->CellAttributes() ?>><span id="el_B_telepon_rumah">
<input type="text" name="x_B_telepon_rumah" id="x_B_telepon_rumah" size="30" maxlength="15" value="<?php echo $master_siswa->B_telepon_rumah->EditValue ?>"<?php echo $master_siswa->B_telepon_rumah->EditAttributes() ?>>
</span><?php echo $master_siswa->B_telepon_rumah->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->B_tinggal->Visible) { // B_tinggal ?>
	<tr id="r_B_tinggal"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_tinggal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->B_tinggal->CellAttributes() ?>><span id="el_B_tinggal">
<input type="text" name="x_B_tinggal" id="x_B_tinggal" size="30" maxlength="20" value="<?php echo $master_siswa->B_tinggal->EditValue ?>"<?php echo $master_siswa->B_tinggal->EditAttributes() ?>>
</span><?php echo $master_siswa->B_tinggal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->B_jarak->Visible) { // B_jarak ?>
	<tr id="r_B_jarak"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_jarak->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->B_jarak->CellAttributes() ?>><span id="el_B_jarak">
<input type="text" name="x_B_jarak" id="x_B_jarak" size="30" value="<?php echo $master_siswa->B_jarak->EditValue ?>"<?php echo $master_siswa->B_jarak->EditAttributes() ?>>
</span><?php echo $master_siswa->B_jarak->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->B_hp->Visible) { // B_hp ?>
	<tr id="r_B_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_hp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->B_hp->CellAttributes() ?>><span id="el_B_hp">
<input type="text" name="x_B_hp" id="x_B_hp" size="30" maxlength="20" value="<?php echo $master_siswa->B_hp->EditValue ?>"<?php echo $master_siswa->B_hp->EditAttributes() ?>>
</span><?php echo $master_siswa->B_hp->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_3">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->C_golongan_darah->Visible) { // C_golongan_darah ?>
	<tr id="r_C_golongan_darah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_golongan_darah->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->C_golongan_darah->CellAttributes() ?>><span id="el_C_golongan_darah">
<input type="text" name="x_C_golongan_darah" id="x_C_golongan_darah" size="30" maxlength="2" value="<?php echo $master_siswa->C_golongan_darah->EditValue ?>"<?php echo $master_siswa->C_golongan_darah->EditAttributes() ?>>
</span><?php echo $master_siswa->C_golongan_darah->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->C_penyakit->Visible) { // C_penyakit ?>
	<tr id="r_C_penyakit"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_penyakit->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->C_penyakit->CellAttributes() ?>><span id="el_C_penyakit">
<input type="text" name="x_C_penyakit" id="x_C_penyakit" size="30" maxlength="100" value="<?php echo $master_siswa->C_penyakit->EditValue ?>"<?php echo $master_siswa->C_penyakit->EditAttributes() ?>>
</span><?php echo $master_siswa->C_penyakit->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->C_jasmani->Visible) { // C_jasmani ?>
	<tr id="r_C_jasmani"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_jasmani->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->C_jasmani->CellAttributes() ?>><span id="el_C_jasmani">
<input type="text" name="x_C_jasmani" id="x_C_jasmani" size="30" maxlength="100" value="<?php echo $master_siswa->C_jasmani->EditValue ?>"<?php echo $master_siswa->C_jasmani->EditAttributes() ?>>
</span><?php echo $master_siswa->C_jasmani->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->C_tinggi->Visible) { // C_tinggi ?>
	<tr id="r_C_tinggi"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_tinggi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->C_tinggi->CellAttributes() ?>><span id="el_C_tinggi">
<input type="text" name="x_C_tinggi" id="x_C_tinggi" size="30" value="<?php echo $master_siswa->C_tinggi->EditValue ?>"<?php echo $master_siswa->C_tinggi->EditAttributes() ?>>
</span><?php echo $master_siswa->C_tinggi->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->C_berat->Visible) { // C_berat ?>
	<tr id="r_C_berat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_berat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->C_berat->CellAttributes() ?>><span id="el_C_berat">
<input type="text" name="x_C_berat" id="x_C_berat" size="30" value="<?php echo $master_siswa->C_berat->EditValue ?>"<?php echo $master_siswa->C_berat->EditAttributes() ?>>
</span><?php echo $master_siswa->C_berat->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_4">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->D_tamatan_dari->Visible) { // D_tamatan_dari ?>
	<tr id="r_D_tamatan_dari"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tamatan_dari->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_tamatan_dari->CellAttributes() ?>><span id="el_D_tamatan_dari">
<input type="text" name="x_D_tamatan_dari" id="x_D_tamatan_dari" size="30" maxlength="30" value="<?php echo $master_siswa->D_tamatan_dari->EditValue ?>"<?php echo $master_siswa->D_tamatan_dari->EditAttributes() ?>>
</span><?php echo $master_siswa->D_tamatan_dari->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_sttb->Visible) { // D_sttb ?>
	<tr id="r_D_sttb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_sttb->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_sttb->CellAttributes() ?>><span id="el_D_sttb">
<input type="text" name="x_D_sttb" id="x_D_sttb" size="30" maxlength="30" value="<?php echo $master_siswa->D_sttb->EditValue ?>"<?php echo $master_siswa->D_sttb->EditAttributes() ?>>
</span><?php echo $master_siswa->D_sttb->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_tanggal_sttb->Visible) { // D_tanggal_sttb ?>
	<tr id="r_D_tanggal_sttb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tanggal_sttb->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_tanggal_sttb->CellAttributes() ?>><span id="el_D_tanggal_sttb">
<input type="text" name="x_D_tanggal_sttb" id="x_D_tanggal_sttb" value="<?php echo $master_siswa->D_tanggal_sttb->EditValue ?>"<?php echo $master_siswa->D_tanggal_sttb->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_D_tanggal_sttb" name="cal_x_D_tanggal_sttb" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_D_tanggal_sttb", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_D_tanggal_sttb" // button id
});
</script>
</span><?php echo $master_siswa->D_tanggal_sttb->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_danum->Visible) { // D_danum ?>
	<tr id="r_D_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_danum->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_danum->CellAttributes() ?>><span id="el_D_danum">
<input type="text" name="x_D_danum" id="x_D_danum" size="30" maxlength="30" value="<?php echo $master_siswa->D_danum->EditValue ?>"<?php echo $master_siswa->D_danum->EditAttributes() ?>>
</span><?php echo $master_siswa->D_danum->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_tanggal_danum->Visible) { // D_tanggal_danum ?>
	<tr id="r_D_tanggal_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tanggal_danum->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_tanggal_danum->CellAttributes() ?>><span id="el_D_tanggal_danum">
<input type="text" name="x_D_tanggal_danum" id="x_D_tanggal_danum" value="<?php echo $master_siswa->D_tanggal_danum->EditValue ?>"<?php echo $master_siswa->D_tanggal_danum->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_D_tanggal_danum" name="cal_x_D_tanggal_danum" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_D_tanggal_danum", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_D_tanggal_danum" // button id
});
</script>
</span><?php echo $master_siswa->D_tanggal_danum->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_lama_belajar->Visible) { // D_lama_belajar ?>
	<tr id="r_D_lama_belajar"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_lama_belajar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_lama_belajar->CellAttributes() ?>><span id="el_D_lama_belajar">
<input type="text" name="x_D_lama_belajar" id="x_D_lama_belajar" size="30" value="<?php echo $master_siswa->D_lama_belajar->EditValue ?>"<?php echo $master_siswa->D_lama_belajar->EditAttributes() ?>>
</span><?php echo $master_siswa->D_lama_belajar->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_dari_sekolah->Visible) { // D_dari_sekolah ?>
	<tr id="r_D_dari_sekolah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_dari_sekolah->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_dari_sekolah->CellAttributes() ?>><span id="el_D_dari_sekolah">
<input type="text" name="x_D_dari_sekolah" id="x_D_dari_sekolah" size="30" maxlength="30" value="<?php echo $master_siswa->D_dari_sekolah->EditValue ?>"<?php echo $master_siswa->D_dari_sekolah->EditAttributes() ?>>
</span><?php echo $master_siswa->D_dari_sekolah->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_alasan->Visible) { // D_alasan ?>
	<tr id="r_D_alasan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_alasan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_alasan->CellAttributes() ?>><span id="el_D_alasan">
<input type="text" name="x_D_alasan" id="x_D_alasan" size="30" maxlength="50" value="<?php echo $master_siswa->D_alasan->EditValue ?>"<?php echo $master_siswa->D_alasan->EditAttributes() ?>>
</span><?php echo $master_siswa->D_alasan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_kelas->Visible) { // D_kelas ?>
	<tr id="r_D_kelas"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_kelas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_kelas->CellAttributes() ?>><span id="el_D_kelas">
<input type="text" name="x_D_kelas" id="x_D_kelas" size="30" maxlength="10" value="<?php echo $master_siswa->D_kelas->EditValue ?>"<?php echo $master_siswa->D_kelas->EditAttributes() ?>>
</span><?php echo $master_siswa->D_kelas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_kelompok->Visible) { // D_kelompok ?>
	<tr id="r_D_kelompok"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_kelompok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_kelompok->CellAttributes() ?>><span id="el_D_kelompok">
<input type="text" name="x_D_kelompok" id="x_D_kelompok" size="30" maxlength="20" value="<?php echo $master_siswa->D_kelompok->EditValue ?>"<?php echo $master_siswa->D_kelompok->EditAttributes() ?>>
</span><?php echo $master_siswa->D_kelompok->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_tanggal->Visible) { // D_tanggal ?>
	<tr id="r_D_tanggal"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tanggal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_tanggal->CellAttributes() ?>><span id="el_D_tanggal">
<input type="text" name="x_D_tanggal" id="x_D_tanggal" value="<?php echo $master_siswa->D_tanggal->EditValue ?>"<?php echo $master_siswa->D_tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_D_tanggal" name="cal_x_D_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_D_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_D_tanggal" // button id
});
</script>
</span><?php echo $master_siswa->D_tanggal->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_D_saat_ini_tingkat" id="x_D_saat_ini_tingkat" value="<?php echo ew_HtmlEncode($master_siswa->D_saat_ini_tingkat->CurrentValue) ?>">
<?php if ($master_siswa->D_saat_ini_kelas->Visible) { // D_saat_ini_kelas ?>
	<tr id="r_D_saat_ini_kelas"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_saat_ini_kelas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_saat_ini_kelas->CellAttributes() ?>><span id="el_D_saat_ini_kelas">
<input type="text" name="x_D_saat_ini_kelas" id="x_D_saat_ini_kelas" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_kelas->EditValue ?>"<?php echo $master_siswa->D_saat_ini_kelas->EditAttributes() ?>>
</span><?php echo $master_siswa->D_saat_ini_kelas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_saat_ini_kelompok->Visible) { // D_saat_ini_kelompok ?>
	<tr id="r_D_saat_ini_kelompok"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_saat_ini_kelompok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_saat_ini_kelompok->CellAttributes() ?>><span id="el_D_saat_ini_kelompok">
<input type="text" name="x_D_saat_ini_kelompok" id="x_D_saat_ini_kelompok" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_kelompok->EditValue ?>"<?php echo $master_siswa->D_saat_ini_kelompok->EditAttributes() ?>>
</span><?php echo $master_siswa->D_saat_ini_kelompok->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_no_psb->Visible) { // D_no_psb ?>
	<tr id="r_D_no_psb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_no_psb->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_no_psb->CellAttributes() ?>><span id="el_D_no_psb">
<input type="text" name="x_D_no_psb" id="x_D_no_psb" size="30" maxlength="20" value="<?php echo $master_siswa->D_no_psb->EditValue ?>"<?php echo $master_siswa->D_no_psb->EditAttributes() ?>>
</span><?php echo $master_siswa->D_no_psb->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_nilai_danum_sd->Visible) { // D_nilai_danum_sd ?>
	<tr id="r_D_nilai_danum_sd"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_nilai_danum_sd->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_nilai_danum_sd->CellAttributes() ?>><span id="el_D_nilai_danum_sd">
<input type="text" name="x_D_nilai_danum_sd" id="x_D_nilai_danum_sd" size="30" value="<?php echo $master_siswa->D_nilai_danum_sd->EditValue ?>"<?php echo $master_siswa->D_nilai_danum_sd->EditAttributes() ?>>
</span><?php echo $master_siswa->D_nilai_danum_sd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_jumlah_pelajaran_danum->Visible) { // D_jumlah_pelajaran_danum ?>
	<tr id="r_D_jumlah_pelajaran_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_jumlah_pelajaran_danum->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_jumlah_pelajaran_danum->CellAttributes() ?>><span id="el_D_jumlah_pelajaran_danum">
<input type="text" name="x_D_jumlah_pelajaran_danum" id="x_D_jumlah_pelajaran_danum" size="30" value="<?php echo $master_siswa->D_jumlah_pelajaran_danum->EditValue ?>"<?php echo $master_siswa->D_jumlah_pelajaran_danum->EditAttributes() ?>>
</span><?php echo $master_siswa->D_jumlah_pelajaran_danum->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_nilai_ujian_psb->Visible) { // D_nilai_ujian_psb ?>
	<tr id="r_D_nilai_ujian_psb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_nilai_ujian_psb->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_nilai_ujian_psb->CellAttributes() ?>><span id="el_D_nilai_ujian_psb">
<input type="text" name="x_D_nilai_ujian_psb" id="x_D_nilai_ujian_psb" size="30" value="<?php echo $master_siswa->D_nilai_ujian_psb->EditValue ?>"<?php echo $master_siswa->D_nilai_ujian_psb->EditAttributes() ?>>
</span><?php echo $master_siswa->D_nilai_ujian_psb->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_tahun_psb->Visible) { // D_tahun_psb ?>
	<tr id="r_D_tahun_psb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tahun_psb->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_tahun_psb->CellAttributes() ?>><span id="el_D_tahun_psb">
<input type="text" name="x_D_tahun_psb" id="x_D_tahun_psb" size="30" maxlength="4" value="<?php echo $master_siswa->D_tahun_psb->EditValue ?>"<?php echo $master_siswa->D_tahun_psb->EditAttributes() ?>>
</span><?php echo $master_siswa->D_tahun_psb->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_diterima->Visible) { // D_diterima ?>
	<tr id="r_D_diterima"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_diterima->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_diterima->CellAttributes() ?>><span id="el_D_diterima">
<input type="text" name="x_D_diterima" id="x_D_diterima" size="30" maxlength="1" value="<?php echo $master_siswa->D_diterima->EditValue ?>"<?php echo $master_siswa->D_diterima->EditAttributes() ?>>
</span><?php echo $master_siswa->D_diterima->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_spp->Visible) { // D_spp ?>
	<tr id="r_D_spp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_spp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_spp->CellAttributes() ?>><span id="el_D_spp">
<input type="text" name="x_D_spp" id="x_D_spp" size="30" value="<?php echo $master_siswa->D_spp->EditValue ?>"<?php echo $master_siswa->D_spp->EditAttributes() ?>>
</span><?php echo $master_siswa->D_spp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->D_spp_potongan->Visible) { // D_spp_potongan ?>
	<tr id="r_D_spp_potongan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_spp_potongan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_spp_potongan->CellAttributes() ?>><span id="el_D_spp_potongan">
<input type="text" name="x_D_spp_potongan" id="x_D_spp_potongan" size="30" value="<?php echo $master_siswa->D_spp_potongan->EditValue ?>"<?php echo $master_siswa->D_spp_potongan->EditAttributes() ?>>
</span><?php echo $master_siswa->D_spp_potongan->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_5">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->D_status_lama_baru->Visible) { // D_status_lama_baru ?>
	<tr id="r_D_status_lama_baru"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_status_lama_baru->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->D_status_lama_baru->CellAttributes() ?>><span id="el_D_status_lama_baru">
<input type="text" name="x_D_status_lama_baru" id="x_D_status_lama_baru" size="30" maxlength="1" value="<?php echo $master_siswa->D_status_lama_baru->EditValue ?>"<?php echo $master_siswa->D_status_lama_baru->EditAttributes() ?>>
</span><?php echo $master_siswa->D_status_lama_baru->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_nama_ayah->Visible) { // E_nama_ayah ?>
	<tr id="r_E_nama_ayah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_nama_ayah->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_nama_ayah->CellAttributes() ?>><span id="el_E_nama_ayah">
<input type="text" name="x_E_nama_ayah" id="x_E_nama_ayah" size="30" maxlength="50" value="<?php echo $master_siswa->E_nama_ayah->EditValue ?>"<?php echo $master_siswa->E_nama_ayah->EditAttributes() ?>>
</span><?php echo $master_siswa->E_nama_ayah->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_tempat_lahir->Visible) { // E_tempat_lahir ?>
	<tr id="r_E_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_tempat_lahir->CellAttributes() ?>><span id="el_E_tempat_lahir">
<input type="text" name="x_E_tempat_lahir" id="x_E_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->E_tempat_lahir->EditValue ?>"<?php echo $master_siswa->E_tempat_lahir->EditAttributes() ?>>
</span><?php echo $master_siswa->E_tempat_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_tanggal_lahir->Visible) { // E_tanggal_lahir ?>
	<tr id="r_E_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_tanggal_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_tanggal_lahir->CellAttributes() ?>><span id="el_E_tanggal_lahir">
<input type="text" name="x_E_tanggal_lahir" id="x_E_tanggal_lahir" value="<?php echo $master_siswa->E_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->E_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_E_tanggal_lahir" name="cal_x_E_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_E_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_E_tanggal_lahir" // button id
});
</script>
</span><?php echo $master_siswa->E_tanggal_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_agama->Visible) { // E_agama ?>
	<tr id="r_E_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_agama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_agama->CellAttributes() ?>><span id="el_E_agama">
<select id="x_E_agama" name="x_E_agama"<?php echo $master_siswa->E_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->E_agama->EditValue)) {
	$arwrk = $master_siswa->E_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->E_agama->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $master_siswa->E_agama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_kewarganegaraan->Visible) { // E_kewarganegaraan ?>
	<tr id="r_E_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_kewarganegaraan->CellAttributes() ?>><span id="el_E_kewarganegaraan">
<input type="text" name="x_E_kewarganegaraan" id="x_E_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->E_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->E_kewarganegaraan->EditAttributes() ?>>
</span><?php echo $master_siswa->E_kewarganegaraan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_pendidikan->Visible) { // E_pendidikan ?>
	<tr id="r_E_pendidikan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_pendidikan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_pendidikan->CellAttributes() ?>><span id="el_E_pendidikan">
<input type="text" name="x_E_pendidikan" id="x_E_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->E_pendidikan->EditValue ?>"<?php echo $master_siswa->E_pendidikan->EditAttributes() ?>>
</span><?php echo $master_siswa->E_pendidikan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_pekerjaan->Visible) { // E_pekerjaan ?>
	<tr id="r_E_pekerjaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_pekerjaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_pekerjaan->CellAttributes() ?>><span id="el_E_pekerjaan">
<input type="text" name="x_E_pekerjaan" id="x_E_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->E_pekerjaan->EditValue ?>"<?php echo $master_siswa->E_pekerjaan->EditAttributes() ?>>
</span><?php echo $master_siswa->E_pekerjaan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_pengeluaran->Visible) { // E_pengeluaran ?>
	<tr id="r_E_pengeluaran"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_pengeluaran->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_pengeluaran->CellAttributes() ?>><span id="el_E_pengeluaran">
<input type="text" name="x_E_pengeluaran" id="x_E_pengeluaran" size="30" value="<?php echo $master_siswa->E_pengeluaran->EditValue ?>"<?php echo $master_siswa->E_pengeluaran->EditAttributes() ?>>
</span><?php echo $master_siswa->E_pengeluaran->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_alamat->Visible) { // E_alamat ?>
	<tr id="r_E_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_alamat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_alamat->CellAttributes() ?>><span id="el_E_alamat">
<input type="text" name="x_E_alamat" id="x_E_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->E_alamat->EditValue ?>"<?php echo $master_siswa->E_alamat->EditAttributes() ?>>
</span><?php echo $master_siswa->E_alamat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_telepon->Visible) { // E_telepon ?>
	<tr id="r_E_telepon"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_telepon->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_telepon->CellAttributes() ?>><span id="el_E_telepon">
<input type="text" name="x_E_telepon" id="x_E_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->E_telepon->EditValue ?>"<?php echo $master_siswa->E_telepon->EditAttributes() ?>>
</span><?php echo $master_siswa->E_telepon->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_hp->Visible) { // E_hp ?>
	<tr id="r_E_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_hp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_hp->CellAttributes() ?>><span id="el_E_hp">
<input type="text" name="x_E_hp" id="x_E_hp" size="30" maxlength="30" value="<?php echo $master_siswa->E_hp->EditValue ?>"<?php echo $master_siswa->E_hp->EditAttributes() ?>>
</span><?php echo $master_siswa->E_hp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->E_hidup->Visible) { // E_hidup ?>
	<tr id="r_E_hidup"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_hidup->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->E_hidup->CellAttributes() ?>><span id="el_E_hidup">
<input type="text" name="x_E_hidup" id="x_E_hidup" size="30" maxlength="20" value="<?php echo $master_siswa->E_hidup->EditValue ?>"<?php echo $master_siswa->E_hidup->EditAttributes() ?>>
</span><?php echo $master_siswa->E_hidup->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_6">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->F_nama_ibu->Visible) { // F_nama_ibu ?>
	<tr id="r_F_nama_ibu"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_nama_ibu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_nama_ibu->CellAttributes() ?>><span id="el_F_nama_ibu">
<input type="text" name="x_F_nama_ibu" id="x_F_nama_ibu" size="30" maxlength="50" value="<?php echo $master_siswa->F_nama_ibu->EditValue ?>"<?php echo $master_siswa->F_nama_ibu->EditAttributes() ?>>
</span><?php echo $master_siswa->F_nama_ibu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_tempat_lahir->Visible) { // F_tempat_lahir ?>
	<tr id="r_F_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_tempat_lahir->CellAttributes() ?>><span id="el_F_tempat_lahir">
<input type="text" name="x_F_tempat_lahir" id="x_F_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->F_tempat_lahir->EditValue ?>"<?php echo $master_siswa->F_tempat_lahir->EditAttributes() ?>>
</span><?php echo $master_siswa->F_tempat_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_tanggal_lahir->Visible) { // F_tanggal_lahir ?>
	<tr id="r_F_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_tanggal_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_tanggal_lahir->CellAttributes() ?>><span id="el_F_tanggal_lahir">
<input type="text" name="x_F_tanggal_lahir" id="x_F_tanggal_lahir" value="<?php echo $master_siswa->F_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->F_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_F_tanggal_lahir" name="cal_x_F_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_F_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_F_tanggal_lahir" // button id
});
</script>
</span><?php echo $master_siswa->F_tanggal_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_agama->Visible) { // F_agama ?>
	<tr id="r_F_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_agama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_agama->CellAttributes() ?>><span id="el_F_agama">
<select id="x_F_agama" name="x_F_agama"<?php echo $master_siswa->F_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->F_agama->EditValue)) {
	$arwrk = $master_siswa->F_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->F_agama->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $master_siswa->F_agama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_kewarganegaraan->Visible) { // F_kewarganegaraan ?>
	<tr id="r_F_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_kewarganegaraan->CellAttributes() ?>><span id="el_F_kewarganegaraan">
<input type="text" name="x_F_kewarganegaraan" id="x_F_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->F_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->F_kewarganegaraan->EditAttributes() ?>>
</span><?php echo $master_siswa->F_kewarganegaraan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_pendidikan->Visible) { // F_pendidikan ?>
	<tr id="r_F_pendidikan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_pendidikan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_pendidikan->CellAttributes() ?>><span id="el_F_pendidikan">
<input type="text" name="x_F_pendidikan" id="x_F_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->F_pendidikan->EditValue ?>"<?php echo $master_siswa->F_pendidikan->EditAttributes() ?>>
</span><?php echo $master_siswa->F_pendidikan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_pekerjaan->Visible) { // F_pekerjaan ?>
	<tr id="r_F_pekerjaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_pekerjaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_pekerjaan->CellAttributes() ?>><span id="el_F_pekerjaan">
<input type="text" name="x_F_pekerjaan" id="x_F_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->F_pekerjaan->EditValue ?>"<?php echo $master_siswa->F_pekerjaan->EditAttributes() ?>>
</span><?php echo $master_siswa->F_pekerjaan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_pengeluaran->Visible) { // F_pengeluaran ?>
	<tr id="r_F_pengeluaran"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_pengeluaran->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_pengeluaran->CellAttributes() ?>><span id="el_F_pengeluaran">
<input type="text" name="x_F_pengeluaran" id="x_F_pengeluaran" size="30" value="<?php echo $master_siswa->F_pengeluaran->EditValue ?>"<?php echo $master_siswa->F_pengeluaran->EditAttributes() ?>>
</span><?php echo $master_siswa->F_pengeluaran->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_alamat->Visible) { // F_alamat ?>
	<tr id="r_F_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_alamat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_alamat->CellAttributes() ?>><span id="el_F_alamat">
<input type="text" name="x_F_alamat" id="x_F_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->F_alamat->EditValue ?>"<?php echo $master_siswa->F_alamat->EditAttributes() ?>>
</span><?php echo $master_siswa->F_alamat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_telepon->Visible) { // F_telepon ?>
	<tr id="r_F_telepon"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_telepon->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_telepon->CellAttributes() ?>><span id="el_F_telepon">
<input type="text" name="x_F_telepon" id="x_F_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->F_telepon->EditValue ?>"<?php echo $master_siswa->F_telepon->EditAttributes() ?>>
</span><?php echo $master_siswa->F_telepon->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_hp->Visible) { // F_hp ?>
	<tr id="r_F_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_hp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_hp->CellAttributes() ?>><span id="el_F_hp">
<input type="text" name="x_F_hp" id="x_F_hp" size="30" maxlength="30" value="<?php echo $master_siswa->F_hp->EditValue ?>"<?php echo $master_siswa->F_hp->EditAttributes() ?>>
</span><?php echo $master_siswa->F_hp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->F_hidup->Visible) { // F_hidup ?>
	<tr id="r_F_hidup"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_hidup->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->F_hidup->CellAttributes() ?>><span id="el_F_hidup">
<input type="text" name="x_F_hidup" id="x_F_hidup" size="30" maxlength="20" value="<?php echo $master_siswa->F_hidup->EditValue ?>"<?php echo $master_siswa->F_hidup->EditAttributes() ?>>
</span><?php echo $master_siswa->F_hidup->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_7">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->G_nama_wali->Visible) { // G_nama_wali ?>
	<tr id="r_G_nama_wali"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_nama_wali->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_nama_wali->CellAttributes() ?>><span id="el_G_nama_wali">
<input type="text" name="x_G_nama_wali" id="x_G_nama_wali" size="30" maxlength="50" value="<?php echo $master_siswa->G_nama_wali->EditValue ?>"<?php echo $master_siswa->G_nama_wali->EditAttributes() ?>>
</span><?php echo $master_siswa->G_nama_wali->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_tempat_lahir->Visible) { // G_tempat_lahir ?>
	<tr id="r_G_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_tempat_lahir->CellAttributes() ?>><span id="el_G_tempat_lahir">
<input type="text" name="x_G_tempat_lahir" id="x_G_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->G_tempat_lahir->EditValue ?>"<?php echo $master_siswa->G_tempat_lahir->EditAttributes() ?>>
</span><?php echo $master_siswa->G_tempat_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_tanggal_lahir->Visible) { // G_tanggal_lahir ?>
	<tr id="r_G_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_tanggal_lahir->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_tanggal_lahir->CellAttributes() ?>><span id="el_G_tanggal_lahir">
<input type="text" name="x_G_tanggal_lahir" id="x_G_tanggal_lahir" value="<?php echo $master_siswa->G_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->G_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_G_tanggal_lahir" name="cal_x_G_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_G_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_G_tanggal_lahir" // button id
});
</script>
</span><?php echo $master_siswa->G_tanggal_lahir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_agama->Visible) { // G_agama ?>
	<tr id="r_G_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_agama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_agama->CellAttributes() ?>><span id="el_G_agama">
<select id="x_G_agama" name="x_G_agama"<?php echo $master_siswa->G_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->G_agama->EditValue)) {
	$arwrk = $master_siswa->G_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->G_agama->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $master_siswa->G_agama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_kewarganegaraan->Visible) { // G_kewarganegaraan ?>
	<tr id="r_G_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_kewarganegaraan->CellAttributes() ?>><span id="el_G_kewarganegaraan">
<input type="text" name="x_G_kewarganegaraan" id="x_G_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->G_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->G_kewarganegaraan->EditAttributes() ?>>
</span><?php echo $master_siswa->G_kewarganegaraan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_pendidikan->Visible) { // G_pendidikan ?>
	<tr id="r_G_pendidikan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_pendidikan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_pendidikan->CellAttributes() ?>><span id="el_G_pendidikan">
<input type="text" name="x_G_pendidikan" id="x_G_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->G_pendidikan->EditValue ?>"<?php echo $master_siswa->G_pendidikan->EditAttributes() ?>>
</span><?php echo $master_siswa->G_pendidikan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_pekerjaan->Visible) { // G_pekerjaan ?>
	<tr id="r_G_pekerjaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_pekerjaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_pekerjaan->CellAttributes() ?>><span id="el_G_pekerjaan">
<input type="text" name="x_G_pekerjaan" id="x_G_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->G_pekerjaan->EditValue ?>"<?php echo $master_siswa->G_pekerjaan->EditAttributes() ?>>
</span><?php echo $master_siswa->G_pekerjaan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_pengeluaran->Visible) { // G_pengeluaran ?>
	<tr id="r_G_pengeluaran"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_pengeluaran->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_pengeluaran->CellAttributes() ?>><span id="el_G_pengeluaran">
<input type="text" name="x_G_pengeluaran" id="x_G_pengeluaran" size="30" value="<?php echo $master_siswa->G_pengeluaran->EditValue ?>"<?php echo $master_siswa->G_pengeluaran->EditAttributes() ?>>
</span><?php echo $master_siswa->G_pengeluaran->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_alamat->Visible) { // G_alamat ?>
	<tr id="r_G_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_alamat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_alamat->CellAttributes() ?>><span id="el_G_alamat">
<input type="text" name="x_G_alamat" id="x_G_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->G_alamat->EditValue ?>"<?php echo $master_siswa->G_alamat->EditAttributes() ?>>
</span><?php echo $master_siswa->G_alamat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_telepon->Visible) { // G_telepon ?>
	<tr id="r_G_telepon"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_telepon->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_telepon->CellAttributes() ?>><span id="el_G_telepon">
<input type="text" name="x_G_telepon" id="x_G_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->G_telepon->EditValue ?>"<?php echo $master_siswa->G_telepon->EditAttributes() ?>>
</span><?php echo $master_siswa->G_telepon->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->G_hp->Visible) { // G_hp ?>
	<tr id="r_G_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_hp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->G_hp->CellAttributes() ?>><span id="el_G_hp">
<input type="text" name="x_G_hp" id="x_G_hp" size="30" maxlength="30" value="<?php echo $master_siswa->G_hp->EditValue ?>"<?php echo $master_siswa->G_hp->EditAttributes() ?>>
</span><?php echo $master_siswa->G_hp->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_8">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->H_kesenian->Visible) { // H_kesenian ?>
	<tr id="r_H_kesenian"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_kesenian->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->H_kesenian->CellAttributes() ?>><span id="el_H_kesenian">
<input type="text" name="x_H_kesenian" id="x_H_kesenian" size="30" maxlength="50" value="<?php echo $master_siswa->H_kesenian->EditValue ?>"<?php echo $master_siswa->H_kesenian->EditAttributes() ?>>
</span><?php echo $master_siswa->H_kesenian->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->H_olahraga->Visible) { // H_olahraga ?>
	<tr id="r_H_olahraga"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_olahraga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->H_olahraga->CellAttributes() ?>><span id="el_H_olahraga">
<input type="text" name="x_H_olahraga" id="x_H_olahraga" size="30" maxlength="50" value="<?php echo $master_siswa->H_olahraga->EditValue ?>"<?php echo $master_siswa->H_olahraga->EditAttributes() ?>>
</span><?php echo $master_siswa->H_olahraga->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->H_kemasyarakatan->Visible) { // H_kemasyarakatan ?>
	<tr id="r_H_kemasyarakatan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_kemasyarakatan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->H_kemasyarakatan->CellAttributes() ?>><span id="el_H_kemasyarakatan">
<input type="text" name="x_H_kemasyarakatan" id="x_H_kemasyarakatan" size="30" maxlength="50" value="<?php echo $master_siswa->H_kemasyarakatan->EditValue ?>"<?php echo $master_siswa->H_kemasyarakatan->EditAttributes() ?>>
</span><?php echo $master_siswa->H_kemasyarakatan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->H_lainlain->Visible) { // H_lainlain ?>
	<tr id="r_H_lainlain"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_lainlain->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->H_lainlain->CellAttributes() ?>><span id="el_H_lainlain">
<input type="text" name="x_H_lainlain" id="x_H_lainlain" size="30" maxlength="50" value="<?php echo $master_siswa->H_lainlain->EditValue ?>"<?php echo $master_siswa->H_lainlain->EditAttributes() ?>>
</span><?php echo $master_siswa->H_lainlain->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_9">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->I_tanggal_meninggalkan->Visible) { // I_tanggal_meninggalkan ?>
	<tr id="r_I_tanggal_meninggalkan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tanggal_meninggalkan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tanggal_meninggalkan->CellAttributes() ?>><span id="el_I_tanggal_meninggalkan">
<input type="text" name="x_I_tanggal_meninggalkan" id="x_I_tanggal_meninggalkan" value="<?php echo $master_siswa->I_tanggal_meninggalkan->EditValue ?>"<?php echo $master_siswa->I_tanggal_meninggalkan->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_I_tanggal_meninggalkan" name="cal_x_I_tanggal_meninggalkan" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_I_tanggal_meninggalkan", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_I_tanggal_meninggalkan" // button id
});
</script>
</span><?php echo $master_siswa->I_tanggal_meninggalkan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_alasan->Visible) { // I_alasan ?>
	<tr id="r_I_alasan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_alasan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_alasan->CellAttributes() ?>><span id="el_I_alasan">
<input type="text" name="x_I_alasan" id="x_I_alasan" size="30" maxlength="50" value="<?php echo $master_siswa->I_alasan->EditValue ?>"<?php echo $master_siswa->I_alasan->EditAttributes() ?>>
</span><?php echo $master_siswa->I_alasan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_tanggal_lulus->Visible) { // I_tanggal_lulus ?>
	<tr id="r_I_tanggal_lulus"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tanggal_lulus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tanggal_lulus->CellAttributes() ?>><span id="el_I_tanggal_lulus">
<input type="text" name="x_I_tanggal_lulus" id="x_I_tanggal_lulus" value="<?php echo $master_siswa->I_tanggal_lulus->EditValue ?>"<?php echo $master_siswa->I_tanggal_lulus->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_I_tanggal_lulus" name="cal_x_I_tanggal_lulus" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_I_tanggal_lulus", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_I_tanggal_lulus" // button id
});
</script>
</span><?php echo $master_siswa->I_tanggal_lulus->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_sttb->Visible) { // I_sttb ?>
	<tr id="r_I_sttb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_sttb->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_sttb->CellAttributes() ?>><span id="el_I_sttb">
<input type="text" name="x_I_sttb" id="x_I_sttb" size="30" maxlength="30" value="<?php echo $master_siswa->I_sttb->EditValue ?>"<?php echo $master_siswa->I_sttb->EditAttributes() ?>>
</span><?php echo $master_siswa->I_sttb->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_danum->Visible) { // I_danum ?>
	<tr id="r_I_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_danum->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_danum->CellAttributes() ?>><span id="el_I_danum">
<input type="text" name="x_I_danum" id="x_I_danum" size="30" maxlength="30" value="<?php echo $master_siswa->I_danum->EditValue ?>"<?php echo $master_siswa->I_danum->EditAttributes() ?>>
</span><?php echo $master_siswa->I_danum->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_nilai_danum_smp->Visible) { // I_nilai_danum_smp ?>
	<tr id="r_I_nilai_danum_smp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_nilai_danum_smp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_nilai_danum_smp->CellAttributes() ?>><span id="el_I_nilai_danum_smp">
<input type="text" name="x_I_nilai_danum_smp" id="x_I_nilai_danum_smp" size="30" value="<?php echo $master_siswa->I_nilai_danum_smp->EditValue ?>"<?php echo $master_siswa->I_nilai_danum_smp->EditAttributes() ?>>
</span><?php echo $master_siswa->I_nilai_danum_smp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_tahun1->Visible) { // I_tahun1 ?>
	<tr id="r_I_tahun1"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tahun1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tahun1->CellAttributes() ?>><span id="el_I_tahun1">
<input type="text" name="x_I_tahun1" id="x_I_tahun1" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun1->EditValue ?>"<?php echo $master_siswa->I_tahun1->EditAttributes() ?>>
</span><?php echo $master_siswa->I_tahun1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_tahun2->Visible) { // I_tahun2 ?>
	<tr id="r_I_tahun2"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tahun2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tahun2->CellAttributes() ?>><span id="el_I_tahun2">
<input type="text" name="x_I_tahun2" id="x_I_tahun2" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun2->EditValue ?>"<?php echo $master_siswa->I_tahun2->EditAttributes() ?>>
</span><?php echo $master_siswa->I_tahun2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_tahun3->Visible) { // I_tahun3 ?>
	<tr id="r_I_tahun3"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tahun3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tahun3->CellAttributes() ?>><span id="el_I_tahun3">
<input type="text" name="x_I_tahun3" id="x_I_tahun3" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun3->EditValue ?>"<?php echo $master_siswa->I_tahun3->EditAttributes() ?>>
</span><?php echo $master_siswa->I_tahun3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_tk1->Visible) { // I_tk1 ?>
	<tr id="r_I_tk1"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tk1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tk1->CellAttributes() ?>><span id="el_I_tk1">
<input type="text" name="x_I_tk1" id="x_I_tk1" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk1->EditValue ?>"<?php echo $master_siswa->I_tk1->EditAttributes() ?>>
</span><?php echo $master_siswa->I_tk1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_tk2->Visible) { // I_tk2 ?>
	<tr id="r_I_tk2"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tk2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tk2->CellAttributes() ?>><span id="el_I_tk2">
<input type="text" name="x_I_tk2" id="x_I_tk2" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk2->EditValue ?>"<?php echo $master_siswa->I_tk2->EditAttributes() ?>>
</span><?php echo $master_siswa->I_tk2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_tk3->Visible) { // I_tk3 ?>
	<tr id="r_I_tk3"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tk3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_tk3->CellAttributes() ?>><span id="el_I_tk3">
<input type="text" name="x_I_tk3" id="x_I_tk3" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk3->EditValue ?>"<?php echo $master_siswa->I_tk3->EditAttributes() ?>>
</span><?php echo $master_siswa->I_tk3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_dari1->Visible) { // I_dari1 ?>
	<tr id="r_I_dari1"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_dari1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_dari1->CellAttributes() ?>><span id="el_I_dari1">
<input type="text" name="x_I_dari1" id="x_I_dari1" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari1->EditValue ?>"<?php echo $master_siswa->I_dari1->EditAttributes() ?>>
</span><?php echo $master_siswa->I_dari1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_dari2->Visible) { // I_dari2 ?>
	<tr id="r_I_dari2"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_dari2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_dari2->CellAttributes() ?>><span id="el_I_dari2">
<input type="text" name="x_I_dari2" id="x_I_dari2" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari2->EditValue ?>"<?php echo $master_siswa->I_dari2->EditAttributes() ?>>
</span><?php echo $master_siswa->I_dari2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->I_dari3->Visible) { // I_dari3 ?>
	<tr id="r_I_dari3"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_dari3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->I_dari3->CellAttributes() ?>><span id="el_I_dari3">
<input type="text" name="x_I_dari3" id="x_I_dari3" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari3->EditValue ?>"<?php echo $master_siswa->I_dari3->EditAttributes() ?>>
</span><?php echo $master_siswa->I_dari3->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_10">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_siswa->J_melanjutkan->Visible) { // J_melanjutkan ?>
	<tr id="r_J_melanjutkan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_melanjutkan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->J_melanjutkan->CellAttributes() ?>><span id="el_J_melanjutkan">
<input type="text" name="x_J_melanjutkan" id="x_J_melanjutkan" size="30" maxlength="30" value="<?php echo $master_siswa->J_melanjutkan->EditValue ?>"<?php echo $master_siswa->J_melanjutkan->EditAttributes() ?>>
</span><?php echo $master_siswa->J_melanjutkan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->J_tanggal_bekerja->Visible) { // J_tanggal_bekerja ?>
	<tr id="r_J_tanggal_bekerja"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_tanggal_bekerja->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->J_tanggal_bekerja->CellAttributes() ?>><span id="el_J_tanggal_bekerja">
<input type="text" name="x_J_tanggal_bekerja" id="x_J_tanggal_bekerja" value="<?php echo $master_siswa->J_tanggal_bekerja->EditValue ?>"<?php echo $master_siswa->J_tanggal_bekerja->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_J_tanggal_bekerja" name="cal_x_J_tanggal_bekerja" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_J_tanggal_bekerja", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_J_tanggal_bekerja" // button id
});
</script>
</span><?php echo $master_siswa->J_tanggal_bekerja->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->J_nama_perusahaan->Visible) { // J_nama_perusahaan ?>
	<tr id="r_J_nama_perusahaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_nama_perusahaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->J_nama_perusahaan->CellAttributes() ?>><span id="el_J_nama_perusahaan">
<input type="text" name="x_J_nama_perusahaan" id="x_J_nama_perusahaan" size="30" maxlength="30" value="<?php echo $master_siswa->J_nama_perusahaan->EditValue ?>"<?php echo $master_siswa->J_nama_perusahaan->EditAttributes() ?>>
</span><?php echo $master_siswa->J_nama_perusahaan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_siswa->J_penghasilan->Visible) { // J_penghasilan ?>
	<tr id="r_J_penghasilan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_penghasilan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_siswa->J_penghasilan->CellAttributes() ?>><span id="el_J_penghasilan">
<input type="text" name="x_J_penghasilan" id="x_J_penghasilan" size="30" value="<?php echo $master_siswa->J_penghasilan->EditValue ?>"<?php echo $master_siswa->J_penghasilan->EditAttributes() ?>>
</span><?php echo $master_siswa->J_penghasilan->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
		</div>
	</div>
</div>
</td></tr></table>
<script type="text/javascript">
<!--
ew_TabView(master_siswa_edit);

//-->
</script>	
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$master_siswa_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$master_siswa_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_siswa_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'master_siswa';

	// Page object name
	var $PageObjName = 'master_siswa_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_siswa;
		if ($master_siswa->UseTokenInUrl) $PageUrl .= "t=" . $master_siswa->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $master_siswa;
		if ($master_siswa->UseTokenInUrl) {
			if ($objForm)
				return ($master_siswa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_siswa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_siswa_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_siswa)
		if (!isset($GLOBALS["master_siswa"])) {
			$GLOBALS["master_siswa"] = new cmaster_siswa();
			$GLOBALS["Table"] =& $GLOBALS["master_siswa"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_siswa', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $master_siswa;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("master_siswalist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $master_siswa;

		// Load key from QueryString
		if (@$_GET["kode_otomatis"] <> "")
			$master_siswa->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
		if (@$_POST["a_edit"] <> "") {
			$master_siswa->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$master_siswa->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$master_siswa->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$master_siswa->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($master_siswa->kode_otomatis->CurrentValue == "")
			$this->Page_Terminate("master_siswalist.php"); // Invalid key, return to list
		switch ($master_siswa->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("master_siswalist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$master_siswa->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $master_siswa->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$master_siswa->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$master_siswa->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$master_siswa->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $master_siswa;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $master_siswa;
		if (!$master_siswa->no_absen->FldIsDetailKey) {
			$master_siswa->no_absen->setFormValue($objForm->GetValue("x_no_absen"));
		}
		if (!$master_siswa->A_nis_nasional->FldIsDetailKey) {
			$master_siswa->A_nis_nasional->setFormValue($objForm->GetValue("x_A_nis_nasional"));
		}
		if (!$master_siswa->A_nama_Lengkap->FldIsDetailKey) {
			$master_siswa->A_nama_Lengkap->setFormValue($objForm->GetValue("x_A_nama_Lengkap"));
		}
		if (!$master_siswa->A_nama_panggilan->FldIsDetailKey) {
			$master_siswa->A_nama_panggilan->setFormValue($objForm->GetValue("x_A_nama_panggilan"));
		}
		if (!$master_siswa->A_jenis_kelamin->FldIsDetailKey) {
			$master_siswa->A_jenis_kelamin->setFormValue($objForm->GetValue("x_A_jenis_kelamin"));
		}
		if (!$master_siswa->A_tempat_lahir->FldIsDetailKey) {
			$master_siswa->A_tempat_lahir->setFormValue($objForm->GetValue("x_A_tempat_lahir"));
		}
		if (!$master_siswa->A_tanggal_lahir->FldIsDetailKey) {
			$master_siswa->A_tanggal_lahir->setFormValue($objForm->GetValue("x_A_tanggal_lahir"));
			$master_siswa->A_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->A_tanggal_lahir->CurrentValue, 7);
		}
		if (!$master_siswa->A_agama->FldIsDetailKey) {
			$master_siswa->A_agama->setFormValue($objForm->GetValue("x_A_agama"));
		}
		if (!$master_siswa->A_kewarganegaraan->FldIsDetailKey) {
			$master_siswa->A_kewarganegaraan->setFormValue($objForm->GetValue("x_A_kewarganegaraan"));
		}
		if (!$master_siswa->A_anak_keberapa->FldIsDetailKey) {
			$master_siswa->A_anak_keberapa->setFormValue($objForm->GetValue("x_A_anak_keberapa"));
		}
		if (!$master_siswa->A_jumlah_saudara_kandung->FldIsDetailKey) {
			$master_siswa->A_jumlah_saudara_kandung->setFormValue($objForm->GetValue("x_A_jumlah_saudara_kandung"));
		}
		if (!$master_siswa->A_jumlah_saudara_tiri->FldIsDetailKey) {
			$master_siswa->A_jumlah_saudara_tiri->setFormValue($objForm->GetValue("x_A_jumlah_saudara_tiri"));
		}
		if (!$master_siswa->A_jumlah_saudara_angkat->FldIsDetailKey) {
			$master_siswa->A_jumlah_saudara_angkat->setFormValue($objForm->GetValue("x_A_jumlah_saudara_angkat"));
		}
		if (!$master_siswa->A_status_yatim->FldIsDetailKey) {
			$master_siswa->A_status_yatim->setFormValue($objForm->GetValue("x_A_status_yatim"));
		}
		if (!$master_siswa->A_bahasa->FldIsDetailKey) {
			$master_siswa->A_bahasa->setFormValue($objForm->GetValue("x_A_bahasa"));
		}
		if (!$master_siswa->B_alamat->FldIsDetailKey) {
			$master_siswa->B_alamat->setFormValue($objForm->GetValue("x_B_alamat"));
		}
		if (!$master_siswa->B_telepon_rumah->FldIsDetailKey) {
			$master_siswa->B_telepon_rumah->setFormValue($objForm->GetValue("x_B_telepon_rumah"));
		}
		if (!$master_siswa->B_tinggal->FldIsDetailKey) {
			$master_siswa->B_tinggal->setFormValue($objForm->GetValue("x_B_tinggal"));
		}
		if (!$master_siswa->B_jarak->FldIsDetailKey) {
			$master_siswa->B_jarak->setFormValue($objForm->GetValue("x_B_jarak"));
		}
		if (!$master_siswa->B_hp->FldIsDetailKey) {
			$master_siswa->B_hp->setFormValue($objForm->GetValue("x_B_hp"));
		}
		if (!$master_siswa->C_golongan_darah->FldIsDetailKey) {
			$master_siswa->C_golongan_darah->setFormValue($objForm->GetValue("x_C_golongan_darah"));
		}
		if (!$master_siswa->C_penyakit->FldIsDetailKey) {
			$master_siswa->C_penyakit->setFormValue($objForm->GetValue("x_C_penyakit"));
		}
		if (!$master_siswa->C_jasmani->FldIsDetailKey) {
			$master_siswa->C_jasmani->setFormValue($objForm->GetValue("x_C_jasmani"));
		}
		if (!$master_siswa->C_tinggi->FldIsDetailKey) {
			$master_siswa->C_tinggi->setFormValue($objForm->GetValue("x_C_tinggi"));
		}
		if (!$master_siswa->C_berat->FldIsDetailKey) {
			$master_siswa->C_berat->setFormValue($objForm->GetValue("x_C_berat"));
		}
		if (!$master_siswa->D_tamatan_dari->FldIsDetailKey) {
			$master_siswa->D_tamatan_dari->setFormValue($objForm->GetValue("x_D_tamatan_dari"));
		}
		if (!$master_siswa->D_sttb->FldIsDetailKey) {
			$master_siswa->D_sttb->setFormValue($objForm->GetValue("x_D_sttb"));
		}
		if (!$master_siswa->D_tanggal_sttb->FldIsDetailKey) {
			$master_siswa->D_tanggal_sttb->setFormValue($objForm->GetValue("x_D_tanggal_sttb"));
			$master_siswa->D_tanggal_sttb->CurrentValue = ew_UnFormatDateTime($master_siswa->D_tanggal_sttb->CurrentValue, 7);
		}
		if (!$master_siswa->D_danum->FldIsDetailKey) {
			$master_siswa->D_danum->setFormValue($objForm->GetValue("x_D_danum"));
		}
		if (!$master_siswa->D_tanggal_danum->FldIsDetailKey) {
			$master_siswa->D_tanggal_danum->setFormValue($objForm->GetValue("x_D_tanggal_danum"));
			$master_siswa->D_tanggal_danum->CurrentValue = ew_UnFormatDateTime($master_siswa->D_tanggal_danum->CurrentValue, 7);
		}
		if (!$master_siswa->D_lama_belajar->FldIsDetailKey) {
			$master_siswa->D_lama_belajar->setFormValue($objForm->GetValue("x_D_lama_belajar"));
		}
		if (!$master_siswa->D_dari_sekolah->FldIsDetailKey) {
			$master_siswa->D_dari_sekolah->setFormValue($objForm->GetValue("x_D_dari_sekolah"));
		}
		if (!$master_siswa->D_alasan->FldIsDetailKey) {
			$master_siswa->D_alasan->setFormValue($objForm->GetValue("x_D_alasan"));
		}
		if (!$master_siswa->D_kelas->FldIsDetailKey) {
			$master_siswa->D_kelas->setFormValue($objForm->GetValue("x_D_kelas"));
		}
		if (!$master_siswa->D_kelompok->FldIsDetailKey) {
			$master_siswa->D_kelompok->setFormValue($objForm->GetValue("x_D_kelompok"));
		}
		if (!$master_siswa->D_tanggal->FldIsDetailKey) {
			$master_siswa->D_tanggal->setFormValue($objForm->GetValue("x_D_tanggal"));
			$master_siswa->D_tanggal->CurrentValue = ew_UnFormatDateTime($master_siswa->D_tanggal->CurrentValue, 7);
		}
		if (!$master_siswa->D_saat_ini_tingkat->FldIsDetailKey) {
			$master_siswa->D_saat_ini_tingkat->setFormValue($objForm->GetValue("x_D_saat_ini_tingkat"));
		}
		if (!$master_siswa->D_saat_ini_kelas->FldIsDetailKey) {
			$master_siswa->D_saat_ini_kelas->setFormValue($objForm->GetValue("x_D_saat_ini_kelas"));
		}
		if (!$master_siswa->D_saat_ini_kelompok->FldIsDetailKey) {
			$master_siswa->D_saat_ini_kelompok->setFormValue($objForm->GetValue("x_D_saat_ini_kelompok"));
		}
		if (!$master_siswa->D_no_psb->FldIsDetailKey) {
			$master_siswa->D_no_psb->setFormValue($objForm->GetValue("x_D_no_psb"));
		}
		if (!$master_siswa->D_nilai_danum_sd->FldIsDetailKey) {
			$master_siswa->D_nilai_danum_sd->setFormValue($objForm->GetValue("x_D_nilai_danum_sd"));
		}
		if (!$master_siswa->D_jumlah_pelajaran_danum->FldIsDetailKey) {
			$master_siswa->D_jumlah_pelajaran_danum->setFormValue($objForm->GetValue("x_D_jumlah_pelajaran_danum"));
		}
		if (!$master_siswa->D_nilai_ujian_psb->FldIsDetailKey) {
			$master_siswa->D_nilai_ujian_psb->setFormValue($objForm->GetValue("x_D_nilai_ujian_psb"));
		}
		if (!$master_siswa->D_tahun_psb->FldIsDetailKey) {
			$master_siswa->D_tahun_psb->setFormValue($objForm->GetValue("x_D_tahun_psb"));
		}
		if (!$master_siswa->D_diterima->FldIsDetailKey) {
			$master_siswa->D_diterima->setFormValue($objForm->GetValue("x_D_diterima"));
		}
		if (!$master_siswa->D_spp->FldIsDetailKey) {
			$master_siswa->D_spp->setFormValue($objForm->GetValue("x_D_spp"));
		}
		if (!$master_siswa->D_spp_potongan->FldIsDetailKey) {
			$master_siswa->D_spp_potongan->setFormValue($objForm->GetValue("x_D_spp_potongan"));
		}
		if (!$master_siswa->D_status_lama_baru->FldIsDetailKey) {
			$master_siswa->D_status_lama_baru->setFormValue($objForm->GetValue("x_D_status_lama_baru"));
		}
		if (!$master_siswa->E_nama_ayah->FldIsDetailKey) {
			$master_siswa->E_nama_ayah->setFormValue($objForm->GetValue("x_E_nama_ayah"));
		}
		if (!$master_siswa->E_tempat_lahir->FldIsDetailKey) {
			$master_siswa->E_tempat_lahir->setFormValue($objForm->GetValue("x_E_tempat_lahir"));
		}
		if (!$master_siswa->E_tanggal_lahir->FldIsDetailKey) {
			$master_siswa->E_tanggal_lahir->setFormValue($objForm->GetValue("x_E_tanggal_lahir"));
			$master_siswa->E_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->E_tanggal_lahir->CurrentValue, 7);
		}
		if (!$master_siswa->E_agama->FldIsDetailKey) {
			$master_siswa->E_agama->setFormValue($objForm->GetValue("x_E_agama"));
		}
		if (!$master_siswa->E_kewarganegaraan->FldIsDetailKey) {
			$master_siswa->E_kewarganegaraan->setFormValue($objForm->GetValue("x_E_kewarganegaraan"));
		}
		if (!$master_siswa->E_pendidikan->FldIsDetailKey) {
			$master_siswa->E_pendidikan->setFormValue($objForm->GetValue("x_E_pendidikan"));
		}
		if (!$master_siswa->E_pekerjaan->FldIsDetailKey) {
			$master_siswa->E_pekerjaan->setFormValue($objForm->GetValue("x_E_pekerjaan"));
		}
		if (!$master_siswa->E_pengeluaran->FldIsDetailKey) {
			$master_siswa->E_pengeluaran->setFormValue($objForm->GetValue("x_E_pengeluaran"));
		}
		if (!$master_siswa->E_alamat->FldIsDetailKey) {
			$master_siswa->E_alamat->setFormValue($objForm->GetValue("x_E_alamat"));
		}
		if (!$master_siswa->E_telepon->FldIsDetailKey) {
			$master_siswa->E_telepon->setFormValue($objForm->GetValue("x_E_telepon"));
		}
		if (!$master_siswa->E_hp->FldIsDetailKey) {
			$master_siswa->E_hp->setFormValue($objForm->GetValue("x_E_hp"));
		}
		if (!$master_siswa->E_hidup->FldIsDetailKey) {
			$master_siswa->E_hidup->setFormValue($objForm->GetValue("x_E_hidup"));
		}
		if (!$master_siswa->F_nama_ibu->FldIsDetailKey) {
			$master_siswa->F_nama_ibu->setFormValue($objForm->GetValue("x_F_nama_ibu"));
		}
		if (!$master_siswa->F_tempat_lahir->FldIsDetailKey) {
			$master_siswa->F_tempat_lahir->setFormValue($objForm->GetValue("x_F_tempat_lahir"));
		}
		if (!$master_siswa->F_tanggal_lahir->FldIsDetailKey) {
			$master_siswa->F_tanggal_lahir->setFormValue($objForm->GetValue("x_F_tanggal_lahir"));
			$master_siswa->F_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->F_tanggal_lahir->CurrentValue, 7);
		}
		if (!$master_siswa->F_agama->FldIsDetailKey) {
			$master_siswa->F_agama->setFormValue($objForm->GetValue("x_F_agama"));
		}
		if (!$master_siswa->F_kewarganegaraan->FldIsDetailKey) {
			$master_siswa->F_kewarganegaraan->setFormValue($objForm->GetValue("x_F_kewarganegaraan"));
		}
		if (!$master_siswa->F_pendidikan->FldIsDetailKey) {
			$master_siswa->F_pendidikan->setFormValue($objForm->GetValue("x_F_pendidikan"));
		}
		if (!$master_siswa->F_pekerjaan->FldIsDetailKey) {
			$master_siswa->F_pekerjaan->setFormValue($objForm->GetValue("x_F_pekerjaan"));
		}
		if (!$master_siswa->F_pengeluaran->FldIsDetailKey) {
			$master_siswa->F_pengeluaran->setFormValue($objForm->GetValue("x_F_pengeluaran"));
		}
		if (!$master_siswa->F_alamat->FldIsDetailKey) {
			$master_siswa->F_alamat->setFormValue($objForm->GetValue("x_F_alamat"));
		}
		if (!$master_siswa->F_telepon->FldIsDetailKey) {
			$master_siswa->F_telepon->setFormValue($objForm->GetValue("x_F_telepon"));
		}
		if (!$master_siswa->F_hp->FldIsDetailKey) {
			$master_siswa->F_hp->setFormValue($objForm->GetValue("x_F_hp"));
		}
		if (!$master_siswa->F_hidup->FldIsDetailKey) {
			$master_siswa->F_hidup->setFormValue($objForm->GetValue("x_F_hidup"));
		}
		if (!$master_siswa->G_nama_wali->FldIsDetailKey) {
			$master_siswa->G_nama_wali->setFormValue($objForm->GetValue("x_G_nama_wali"));
		}
		if (!$master_siswa->G_tempat_lahir->FldIsDetailKey) {
			$master_siswa->G_tempat_lahir->setFormValue($objForm->GetValue("x_G_tempat_lahir"));
		}
		if (!$master_siswa->G_tanggal_lahir->FldIsDetailKey) {
			$master_siswa->G_tanggal_lahir->setFormValue($objForm->GetValue("x_G_tanggal_lahir"));
			$master_siswa->G_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->G_tanggal_lahir->CurrentValue, 7);
		}
		if (!$master_siswa->G_agama->FldIsDetailKey) {
			$master_siswa->G_agama->setFormValue($objForm->GetValue("x_G_agama"));
		}
		if (!$master_siswa->G_kewarganegaraan->FldIsDetailKey) {
			$master_siswa->G_kewarganegaraan->setFormValue($objForm->GetValue("x_G_kewarganegaraan"));
		}
		if (!$master_siswa->G_pendidikan->FldIsDetailKey) {
			$master_siswa->G_pendidikan->setFormValue($objForm->GetValue("x_G_pendidikan"));
		}
		if (!$master_siswa->G_pekerjaan->FldIsDetailKey) {
			$master_siswa->G_pekerjaan->setFormValue($objForm->GetValue("x_G_pekerjaan"));
		}
		if (!$master_siswa->G_pengeluaran->FldIsDetailKey) {
			$master_siswa->G_pengeluaran->setFormValue($objForm->GetValue("x_G_pengeluaran"));
		}
		if (!$master_siswa->G_alamat->FldIsDetailKey) {
			$master_siswa->G_alamat->setFormValue($objForm->GetValue("x_G_alamat"));
		}
		if (!$master_siswa->G_telepon->FldIsDetailKey) {
			$master_siswa->G_telepon->setFormValue($objForm->GetValue("x_G_telepon"));
		}
		if (!$master_siswa->G_hp->FldIsDetailKey) {
			$master_siswa->G_hp->setFormValue($objForm->GetValue("x_G_hp"));
		}
		if (!$master_siswa->H_kesenian->FldIsDetailKey) {
			$master_siswa->H_kesenian->setFormValue($objForm->GetValue("x_H_kesenian"));
		}
		if (!$master_siswa->H_olahraga->FldIsDetailKey) {
			$master_siswa->H_olahraga->setFormValue($objForm->GetValue("x_H_olahraga"));
		}
		if (!$master_siswa->H_kemasyarakatan->FldIsDetailKey) {
			$master_siswa->H_kemasyarakatan->setFormValue($objForm->GetValue("x_H_kemasyarakatan"));
		}
		if (!$master_siswa->H_lainlain->FldIsDetailKey) {
			$master_siswa->H_lainlain->setFormValue($objForm->GetValue("x_H_lainlain"));
		}
		if (!$master_siswa->I_tanggal_meninggalkan->FldIsDetailKey) {
			$master_siswa->I_tanggal_meninggalkan->setFormValue($objForm->GetValue("x_I_tanggal_meninggalkan"));
			$master_siswa->I_tanggal_meninggalkan->CurrentValue = ew_UnFormatDateTime($master_siswa->I_tanggal_meninggalkan->CurrentValue, 7);
		}
		if (!$master_siswa->I_alasan->FldIsDetailKey) {
			$master_siswa->I_alasan->setFormValue($objForm->GetValue("x_I_alasan"));
		}
		if (!$master_siswa->I_tanggal_lulus->FldIsDetailKey) {
			$master_siswa->I_tanggal_lulus->setFormValue($objForm->GetValue("x_I_tanggal_lulus"));
			$master_siswa->I_tanggal_lulus->CurrentValue = ew_UnFormatDateTime($master_siswa->I_tanggal_lulus->CurrentValue, 7);
		}
		if (!$master_siswa->I_sttb->FldIsDetailKey) {
			$master_siswa->I_sttb->setFormValue($objForm->GetValue("x_I_sttb"));
		}
		if (!$master_siswa->I_danum->FldIsDetailKey) {
			$master_siswa->I_danum->setFormValue($objForm->GetValue("x_I_danum"));
		}
		if (!$master_siswa->I_nilai_danum_smp->FldIsDetailKey) {
			$master_siswa->I_nilai_danum_smp->setFormValue($objForm->GetValue("x_I_nilai_danum_smp"));
		}
		if (!$master_siswa->I_tahun1->FldIsDetailKey) {
			$master_siswa->I_tahun1->setFormValue($objForm->GetValue("x_I_tahun1"));
		}
		if (!$master_siswa->I_tahun2->FldIsDetailKey) {
			$master_siswa->I_tahun2->setFormValue($objForm->GetValue("x_I_tahun2"));
		}
		if (!$master_siswa->I_tahun3->FldIsDetailKey) {
			$master_siswa->I_tahun3->setFormValue($objForm->GetValue("x_I_tahun3"));
		}
		if (!$master_siswa->I_tk1->FldIsDetailKey) {
			$master_siswa->I_tk1->setFormValue($objForm->GetValue("x_I_tk1"));
		}
		if (!$master_siswa->I_tk2->FldIsDetailKey) {
			$master_siswa->I_tk2->setFormValue($objForm->GetValue("x_I_tk2"));
		}
		if (!$master_siswa->I_tk3->FldIsDetailKey) {
			$master_siswa->I_tk3->setFormValue($objForm->GetValue("x_I_tk3"));
		}
		if (!$master_siswa->I_dari1->FldIsDetailKey) {
			$master_siswa->I_dari1->setFormValue($objForm->GetValue("x_I_dari1"));
		}
		if (!$master_siswa->I_dari2->FldIsDetailKey) {
			$master_siswa->I_dari2->setFormValue($objForm->GetValue("x_I_dari2"));
		}
		if (!$master_siswa->I_dari3->FldIsDetailKey) {
			$master_siswa->I_dari3->setFormValue($objForm->GetValue("x_I_dari3"));
		}
		if (!$master_siswa->J_melanjutkan->FldIsDetailKey) {
			$master_siswa->J_melanjutkan->setFormValue($objForm->GetValue("x_J_melanjutkan"));
		}
		if (!$master_siswa->J_tanggal_bekerja->FldIsDetailKey) {
			$master_siswa->J_tanggal_bekerja->setFormValue($objForm->GetValue("x_J_tanggal_bekerja"));
			$master_siswa->J_tanggal_bekerja->CurrentValue = ew_UnFormatDateTime($master_siswa->J_tanggal_bekerja->CurrentValue, 7);
		}
		if (!$master_siswa->J_nama_perusahaan->FldIsDetailKey) {
			$master_siswa->J_nama_perusahaan->setFormValue($objForm->GetValue("x_J_nama_perusahaan"));
		}
		if (!$master_siswa->J_penghasilan->FldIsDetailKey) {
			$master_siswa->J_penghasilan->setFormValue($objForm->GetValue("x_J_penghasilan"));
		}
		if (!$master_siswa->kode_otomatis->FldIsDetailKey) {
			$master_siswa->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		if (!$master_siswa->apakah_valid->FldIsDetailKey) {
			$master_siswa->apakah_valid->setFormValue($objForm->GetValue("x_apakah_valid"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $master_siswa;
		$this->LoadRow();
		$master_siswa->no_absen->CurrentValue = $master_siswa->no_absen->FormValue;
		$master_siswa->A_nis_nasional->CurrentValue = $master_siswa->A_nis_nasional->FormValue;
		$master_siswa->A_nama_Lengkap->CurrentValue = $master_siswa->A_nama_Lengkap->FormValue;
		$master_siswa->A_nama_panggilan->CurrentValue = $master_siswa->A_nama_panggilan->FormValue;
		$master_siswa->A_jenis_kelamin->CurrentValue = $master_siswa->A_jenis_kelamin->FormValue;
		$master_siswa->A_tempat_lahir->CurrentValue = $master_siswa->A_tempat_lahir->FormValue;
		$master_siswa->A_tanggal_lahir->CurrentValue = $master_siswa->A_tanggal_lahir->FormValue;
		$master_siswa->A_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->A_tanggal_lahir->CurrentValue, 7);
		$master_siswa->A_agama->CurrentValue = $master_siswa->A_agama->FormValue;
		$master_siswa->A_kewarganegaraan->CurrentValue = $master_siswa->A_kewarganegaraan->FormValue;
		$master_siswa->A_anak_keberapa->CurrentValue = $master_siswa->A_anak_keberapa->FormValue;
		$master_siswa->A_jumlah_saudara_kandung->CurrentValue = $master_siswa->A_jumlah_saudara_kandung->FormValue;
		$master_siswa->A_jumlah_saudara_tiri->CurrentValue = $master_siswa->A_jumlah_saudara_tiri->FormValue;
		$master_siswa->A_jumlah_saudara_angkat->CurrentValue = $master_siswa->A_jumlah_saudara_angkat->FormValue;
		$master_siswa->A_status_yatim->CurrentValue = $master_siswa->A_status_yatim->FormValue;
		$master_siswa->A_bahasa->CurrentValue = $master_siswa->A_bahasa->FormValue;
		$master_siswa->B_alamat->CurrentValue = $master_siswa->B_alamat->FormValue;
		$master_siswa->B_telepon_rumah->CurrentValue = $master_siswa->B_telepon_rumah->FormValue;
		$master_siswa->B_tinggal->CurrentValue = $master_siswa->B_tinggal->FormValue;
		$master_siswa->B_jarak->CurrentValue = $master_siswa->B_jarak->FormValue;
		$master_siswa->B_hp->CurrentValue = $master_siswa->B_hp->FormValue;
		$master_siswa->C_golongan_darah->CurrentValue = $master_siswa->C_golongan_darah->FormValue;
		$master_siswa->C_penyakit->CurrentValue = $master_siswa->C_penyakit->FormValue;
		$master_siswa->C_jasmani->CurrentValue = $master_siswa->C_jasmani->FormValue;
		$master_siswa->C_tinggi->CurrentValue = $master_siswa->C_tinggi->FormValue;
		$master_siswa->C_berat->CurrentValue = $master_siswa->C_berat->FormValue;
		$master_siswa->D_tamatan_dari->CurrentValue = $master_siswa->D_tamatan_dari->FormValue;
		$master_siswa->D_sttb->CurrentValue = $master_siswa->D_sttb->FormValue;
		$master_siswa->D_tanggal_sttb->CurrentValue = $master_siswa->D_tanggal_sttb->FormValue;
		$master_siswa->D_tanggal_sttb->CurrentValue = ew_UnFormatDateTime($master_siswa->D_tanggal_sttb->CurrentValue, 7);
		$master_siswa->D_danum->CurrentValue = $master_siswa->D_danum->FormValue;
		$master_siswa->D_tanggal_danum->CurrentValue = $master_siswa->D_tanggal_danum->FormValue;
		$master_siswa->D_tanggal_danum->CurrentValue = ew_UnFormatDateTime($master_siswa->D_tanggal_danum->CurrentValue, 7);
		$master_siswa->D_lama_belajar->CurrentValue = $master_siswa->D_lama_belajar->FormValue;
		$master_siswa->D_dari_sekolah->CurrentValue = $master_siswa->D_dari_sekolah->FormValue;
		$master_siswa->D_alasan->CurrentValue = $master_siswa->D_alasan->FormValue;
		$master_siswa->D_kelas->CurrentValue = $master_siswa->D_kelas->FormValue;
		$master_siswa->D_kelompok->CurrentValue = $master_siswa->D_kelompok->FormValue;
		$master_siswa->D_tanggal->CurrentValue = $master_siswa->D_tanggal->FormValue;
		$master_siswa->D_tanggal->CurrentValue = ew_UnFormatDateTime($master_siswa->D_tanggal->CurrentValue, 7);
		$master_siswa->D_saat_ini_tingkat->CurrentValue = $master_siswa->D_saat_ini_tingkat->FormValue;
		$master_siswa->D_saat_ini_kelas->CurrentValue = $master_siswa->D_saat_ini_kelas->FormValue;
		$master_siswa->D_saat_ini_kelompok->CurrentValue = $master_siswa->D_saat_ini_kelompok->FormValue;
		$master_siswa->D_no_psb->CurrentValue = $master_siswa->D_no_psb->FormValue;
		$master_siswa->D_nilai_danum_sd->CurrentValue = $master_siswa->D_nilai_danum_sd->FormValue;
		$master_siswa->D_jumlah_pelajaran_danum->CurrentValue = $master_siswa->D_jumlah_pelajaran_danum->FormValue;
		$master_siswa->D_nilai_ujian_psb->CurrentValue = $master_siswa->D_nilai_ujian_psb->FormValue;
		$master_siswa->D_tahun_psb->CurrentValue = $master_siswa->D_tahun_psb->FormValue;
		$master_siswa->D_diterima->CurrentValue = $master_siswa->D_diterima->FormValue;
		$master_siswa->D_spp->CurrentValue = $master_siswa->D_spp->FormValue;
		$master_siswa->D_spp_potongan->CurrentValue = $master_siswa->D_spp_potongan->FormValue;
		$master_siswa->D_status_lama_baru->CurrentValue = $master_siswa->D_status_lama_baru->FormValue;
		$master_siswa->E_nama_ayah->CurrentValue = $master_siswa->E_nama_ayah->FormValue;
		$master_siswa->E_tempat_lahir->CurrentValue = $master_siswa->E_tempat_lahir->FormValue;
		$master_siswa->E_tanggal_lahir->CurrentValue = $master_siswa->E_tanggal_lahir->FormValue;
		$master_siswa->E_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->E_tanggal_lahir->CurrentValue, 7);
		$master_siswa->E_agama->CurrentValue = $master_siswa->E_agama->FormValue;
		$master_siswa->E_kewarganegaraan->CurrentValue = $master_siswa->E_kewarganegaraan->FormValue;
		$master_siswa->E_pendidikan->CurrentValue = $master_siswa->E_pendidikan->FormValue;
		$master_siswa->E_pekerjaan->CurrentValue = $master_siswa->E_pekerjaan->FormValue;
		$master_siswa->E_pengeluaran->CurrentValue = $master_siswa->E_pengeluaran->FormValue;
		$master_siswa->E_alamat->CurrentValue = $master_siswa->E_alamat->FormValue;
		$master_siswa->E_telepon->CurrentValue = $master_siswa->E_telepon->FormValue;
		$master_siswa->E_hp->CurrentValue = $master_siswa->E_hp->FormValue;
		$master_siswa->E_hidup->CurrentValue = $master_siswa->E_hidup->FormValue;
		$master_siswa->F_nama_ibu->CurrentValue = $master_siswa->F_nama_ibu->FormValue;
		$master_siswa->F_tempat_lahir->CurrentValue = $master_siswa->F_tempat_lahir->FormValue;
		$master_siswa->F_tanggal_lahir->CurrentValue = $master_siswa->F_tanggal_lahir->FormValue;
		$master_siswa->F_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->F_tanggal_lahir->CurrentValue, 7);
		$master_siswa->F_agama->CurrentValue = $master_siswa->F_agama->FormValue;
		$master_siswa->F_kewarganegaraan->CurrentValue = $master_siswa->F_kewarganegaraan->FormValue;
		$master_siswa->F_pendidikan->CurrentValue = $master_siswa->F_pendidikan->FormValue;
		$master_siswa->F_pekerjaan->CurrentValue = $master_siswa->F_pekerjaan->FormValue;
		$master_siswa->F_pengeluaran->CurrentValue = $master_siswa->F_pengeluaran->FormValue;
		$master_siswa->F_alamat->CurrentValue = $master_siswa->F_alamat->FormValue;
		$master_siswa->F_telepon->CurrentValue = $master_siswa->F_telepon->FormValue;
		$master_siswa->F_hp->CurrentValue = $master_siswa->F_hp->FormValue;
		$master_siswa->F_hidup->CurrentValue = $master_siswa->F_hidup->FormValue;
		$master_siswa->G_nama_wali->CurrentValue = $master_siswa->G_nama_wali->FormValue;
		$master_siswa->G_tempat_lahir->CurrentValue = $master_siswa->G_tempat_lahir->FormValue;
		$master_siswa->G_tanggal_lahir->CurrentValue = $master_siswa->G_tanggal_lahir->FormValue;
		$master_siswa->G_tanggal_lahir->CurrentValue = ew_UnFormatDateTime($master_siswa->G_tanggal_lahir->CurrentValue, 7);
		$master_siswa->G_agama->CurrentValue = $master_siswa->G_agama->FormValue;
		$master_siswa->G_kewarganegaraan->CurrentValue = $master_siswa->G_kewarganegaraan->FormValue;
		$master_siswa->G_pendidikan->CurrentValue = $master_siswa->G_pendidikan->FormValue;
		$master_siswa->G_pekerjaan->CurrentValue = $master_siswa->G_pekerjaan->FormValue;
		$master_siswa->G_pengeluaran->CurrentValue = $master_siswa->G_pengeluaran->FormValue;
		$master_siswa->G_alamat->CurrentValue = $master_siswa->G_alamat->FormValue;
		$master_siswa->G_telepon->CurrentValue = $master_siswa->G_telepon->FormValue;
		$master_siswa->G_hp->CurrentValue = $master_siswa->G_hp->FormValue;
		$master_siswa->H_kesenian->CurrentValue = $master_siswa->H_kesenian->FormValue;
		$master_siswa->H_olahraga->CurrentValue = $master_siswa->H_olahraga->FormValue;
		$master_siswa->H_kemasyarakatan->CurrentValue = $master_siswa->H_kemasyarakatan->FormValue;
		$master_siswa->H_lainlain->CurrentValue = $master_siswa->H_lainlain->FormValue;
		$master_siswa->I_tanggal_meninggalkan->CurrentValue = $master_siswa->I_tanggal_meninggalkan->FormValue;
		$master_siswa->I_tanggal_meninggalkan->CurrentValue = ew_UnFormatDateTime($master_siswa->I_tanggal_meninggalkan->CurrentValue, 7);
		$master_siswa->I_alasan->CurrentValue = $master_siswa->I_alasan->FormValue;
		$master_siswa->I_tanggal_lulus->CurrentValue = $master_siswa->I_tanggal_lulus->FormValue;
		$master_siswa->I_tanggal_lulus->CurrentValue = ew_UnFormatDateTime($master_siswa->I_tanggal_lulus->CurrentValue, 7);
		$master_siswa->I_sttb->CurrentValue = $master_siswa->I_sttb->FormValue;
		$master_siswa->I_danum->CurrentValue = $master_siswa->I_danum->FormValue;
		$master_siswa->I_nilai_danum_smp->CurrentValue = $master_siswa->I_nilai_danum_smp->FormValue;
		$master_siswa->I_tahun1->CurrentValue = $master_siswa->I_tahun1->FormValue;
		$master_siswa->I_tahun2->CurrentValue = $master_siswa->I_tahun2->FormValue;
		$master_siswa->I_tahun3->CurrentValue = $master_siswa->I_tahun3->FormValue;
		$master_siswa->I_tk1->CurrentValue = $master_siswa->I_tk1->FormValue;
		$master_siswa->I_tk2->CurrentValue = $master_siswa->I_tk2->FormValue;
		$master_siswa->I_tk3->CurrentValue = $master_siswa->I_tk3->FormValue;
		$master_siswa->I_dari1->CurrentValue = $master_siswa->I_dari1->FormValue;
		$master_siswa->I_dari2->CurrentValue = $master_siswa->I_dari2->FormValue;
		$master_siswa->I_dari3->CurrentValue = $master_siswa->I_dari3->FormValue;
		$master_siswa->J_melanjutkan->CurrentValue = $master_siswa->J_melanjutkan->FormValue;
		$master_siswa->J_tanggal_bekerja->CurrentValue = $master_siswa->J_tanggal_bekerja->FormValue;
		$master_siswa->J_tanggal_bekerja->CurrentValue = ew_UnFormatDateTime($master_siswa->J_tanggal_bekerja->CurrentValue, 7);
		$master_siswa->J_nama_perusahaan->CurrentValue = $master_siswa->J_nama_perusahaan->FormValue;
		$master_siswa->J_penghasilan->CurrentValue = $master_siswa->J_penghasilan->FormValue;
		$master_siswa->kode_otomatis->CurrentValue = $master_siswa->kode_otomatis->FormValue;
		$master_siswa->apakah_valid->CurrentValue = $master_siswa->apakah_valid->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $master_siswa;
		$sFilter = $master_siswa->KeyFilter();

		// Call Row Selecting event
		$master_siswa->Row_Selecting($sFilter);

		// Load SQL based on filter
		$master_siswa->CurrentFilter = $sFilter;
		$sSql = $master_siswa->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $master_siswa;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$master_siswa->Row_Selected($row);
		$master_siswa->no_absen->setDbValue($rs->fields('no_absen'));
		$master_siswa->A_nis_nasional->setDbValue($rs->fields('A_nis_nasional'));
		$master_siswa->A_nama_Lengkap->setDbValue($rs->fields('A_nama_Lengkap'));
		$master_siswa->A_nama_panggilan->setDbValue($rs->fields('A_nama_panggilan'));
		$master_siswa->A_jenis_kelamin->setDbValue($rs->fields('A_jenis_kelamin'));
		$master_siswa->A_tempat_lahir->setDbValue($rs->fields('A_tempat_lahir'));
		$master_siswa->A_tanggal_lahir->setDbValue($rs->fields('A_tanggal_lahir'));
		$master_siswa->A_agama->setDbValue($rs->fields('A_agama'));
		$master_siswa->A_kewarganegaraan->setDbValue($rs->fields('A_kewarganegaraan'));
		$master_siswa->A_anak_keberapa->setDbValue($rs->fields('A_anak_keberapa'));
		$master_siswa->A_jumlah_saudara_kandung->setDbValue($rs->fields('A_jumlah_saudara_kandung'));
		$master_siswa->A_jumlah_saudara_tiri->setDbValue($rs->fields('A_jumlah_saudara_tiri'));
		$master_siswa->A_jumlah_saudara_angkat->setDbValue($rs->fields('A_jumlah_saudara_angkat'));
		$master_siswa->A_status_yatim->setDbValue($rs->fields('A_status_yatim'));
		$master_siswa->A_bahasa->setDbValue($rs->fields('A_bahasa'));
		$master_siswa->B_alamat->setDbValue($rs->fields('B_alamat'));
		$master_siswa->B_telepon_rumah->setDbValue($rs->fields('B_telepon_rumah'));
		$master_siswa->B_tinggal->setDbValue($rs->fields('B_tinggal'));
		$master_siswa->B_jarak->setDbValue($rs->fields('B_jarak'));
		$master_siswa->B_hp->setDbValue($rs->fields('B_hp'));
		$master_siswa->C_golongan_darah->setDbValue($rs->fields('C_golongan_darah'));
		$master_siswa->C_penyakit->setDbValue($rs->fields('C_penyakit'));
		$master_siswa->C_jasmani->setDbValue($rs->fields('C_jasmani'));
		$master_siswa->C_tinggi->setDbValue($rs->fields('C_tinggi'));
		$master_siswa->C_berat->setDbValue($rs->fields('C_berat'));
		$master_siswa->D_tamatan_dari->setDbValue($rs->fields('D_tamatan_dari'));
		$master_siswa->D_sttb->setDbValue($rs->fields('D_sttb'));
		$master_siswa->D_tanggal_sttb->setDbValue($rs->fields('D_tanggal_sttb'));
		$master_siswa->D_danum->setDbValue($rs->fields('D_danum'));
		$master_siswa->D_tanggal_danum->setDbValue($rs->fields('D_tanggal_danum'));
		$master_siswa->D_lama_belajar->setDbValue($rs->fields('D_lama_belajar'));
		$master_siswa->D_dari_sekolah->setDbValue($rs->fields('D_dari_sekolah'));
		$master_siswa->D_alasan->setDbValue($rs->fields('D_alasan'));
		$master_siswa->D_kelas->setDbValue($rs->fields('D_kelas'));
		$master_siswa->D_kelompok->setDbValue($rs->fields('D_kelompok'));
		$master_siswa->D_tanggal->setDbValue($rs->fields('D_tanggal'));
		$master_siswa->D_saat_ini_tingkat->setDbValue($rs->fields('D_saat_ini_tingkat'));
		$master_siswa->D_saat_ini_kelas->setDbValue($rs->fields('D_saat_ini_kelas'));
		$master_siswa->D_saat_ini_kelompok->setDbValue($rs->fields('D_saat_ini_kelompok'));
		$master_siswa->D_no_psb->setDbValue($rs->fields('D_no_psb'));
		$master_siswa->D_nilai_danum_sd->setDbValue($rs->fields('D_nilai_danum_sd'));
		$master_siswa->D_jumlah_pelajaran_danum->setDbValue($rs->fields('D_jumlah_pelajaran_danum'));
		$master_siswa->D_nilai_ujian_psb->setDbValue($rs->fields('D_nilai_ujian_psb'));
		$master_siswa->D_tahun_psb->setDbValue($rs->fields('D_tahun_psb'));
		$master_siswa->D_diterima->setDbValue($rs->fields('D_diterima'));
		$master_siswa->D_spp->setDbValue($rs->fields('D_spp'));
		$master_siswa->D_spp_potongan->setDbValue($rs->fields('D_spp_potongan'));
		$master_siswa->D_status_lama_baru->setDbValue($rs->fields('D_status_lama_baru'));
		$master_siswa->E_nama_ayah->setDbValue($rs->fields('E_nama_ayah'));
		$master_siswa->E_tempat_lahir->setDbValue($rs->fields('E_tempat_lahir'));
		$master_siswa->E_tanggal_lahir->setDbValue($rs->fields('E_tanggal_lahir'));
		$master_siswa->E_agama->setDbValue($rs->fields('E_agama'));
		$master_siswa->E_kewarganegaraan->setDbValue($rs->fields('E_kewarganegaraan'));
		$master_siswa->E_pendidikan->setDbValue($rs->fields('E_pendidikan'));
		$master_siswa->E_pekerjaan->setDbValue($rs->fields('E_pekerjaan'));
		$master_siswa->E_pengeluaran->setDbValue($rs->fields('E_pengeluaran'));
		$master_siswa->E_alamat->setDbValue($rs->fields('E_alamat'));
		$master_siswa->E_telepon->setDbValue($rs->fields('E_telepon'));
		$master_siswa->E_hp->setDbValue($rs->fields('E_hp'));
		$master_siswa->E_hidup->setDbValue($rs->fields('E_hidup'));
		$master_siswa->F_nama_ibu->setDbValue($rs->fields('F_nama_ibu'));
		$master_siswa->F_tempat_lahir->setDbValue($rs->fields('F_tempat_lahir'));
		$master_siswa->F_tanggal_lahir->setDbValue($rs->fields('F_tanggal_lahir'));
		$master_siswa->F_agama->setDbValue($rs->fields('F_agama'));
		$master_siswa->F_kewarganegaraan->setDbValue($rs->fields('F_kewarganegaraan'));
		$master_siswa->F_pendidikan->setDbValue($rs->fields('F_pendidikan'));
		$master_siswa->F_pekerjaan->setDbValue($rs->fields('F_pekerjaan'));
		$master_siswa->F_pengeluaran->setDbValue($rs->fields('F_pengeluaran'));
		$master_siswa->F_alamat->setDbValue($rs->fields('F_alamat'));
		$master_siswa->F_telepon->setDbValue($rs->fields('F_telepon'));
		$master_siswa->F_hp->setDbValue($rs->fields('F_hp'));
		$master_siswa->F_hidup->setDbValue($rs->fields('F_hidup'));
		$master_siswa->G_nama_wali->setDbValue($rs->fields('G_nama_wali'));
		$master_siswa->G_tempat_lahir->setDbValue($rs->fields('G_tempat_lahir'));
		$master_siswa->G_tanggal_lahir->setDbValue($rs->fields('G_tanggal_lahir'));
		$master_siswa->G_agama->setDbValue($rs->fields('G_agama'));
		$master_siswa->G_kewarganegaraan->setDbValue($rs->fields('G_kewarganegaraan'));
		$master_siswa->G_pendidikan->setDbValue($rs->fields('G_pendidikan'));
		$master_siswa->G_pekerjaan->setDbValue($rs->fields('G_pekerjaan'));
		$master_siswa->G_pengeluaran->setDbValue($rs->fields('G_pengeluaran'));
		$master_siswa->G_alamat->setDbValue($rs->fields('G_alamat'));
		$master_siswa->G_telepon->setDbValue($rs->fields('G_telepon'));
		$master_siswa->G_hp->setDbValue($rs->fields('G_hp'));
		$master_siswa->H_kesenian->setDbValue($rs->fields('H_kesenian'));
		$master_siswa->H_olahraga->setDbValue($rs->fields('H_olahraga'));
		$master_siswa->H_kemasyarakatan->setDbValue($rs->fields('H_kemasyarakatan'));
		$master_siswa->H_lainlain->setDbValue($rs->fields('H_lainlain'));
		$master_siswa->I_tanggal_meninggalkan->setDbValue($rs->fields('I_tanggal_meninggalkan'));
		$master_siswa->I_alasan->setDbValue($rs->fields('I_alasan'));
		$master_siswa->I_tanggal_lulus->setDbValue($rs->fields('I_tanggal_lulus'));
		$master_siswa->I_sttb->setDbValue($rs->fields('I_sttb'));
		$master_siswa->I_danum->setDbValue($rs->fields('I_danum'));
		$master_siswa->I_nilai_danum_smp->setDbValue($rs->fields('I_nilai_danum_smp'));
		$master_siswa->I_tahun1->setDbValue($rs->fields('I_tahun1'));
		$master_siswa->I_tahun2->setDbValue($rs->fields('I_tahun2'));
		$master_siswa->I_tahun3->setDbValue($rs->fields('I_tahun3'));
		$master_siswa->I_tk1->setDbValue($rs->fields('I_tk1'));
		$master_siswa->I_tk2->setDbValue($rs->fields('I_tk2'));
		$master_siswa->I_tk3->setDbValue($rs->fields('I_tk3'));
		$master_siswa->I_dari1->setDbValue($rs->fields('I_dari1'));
		$master_siswa->I_dari2->setDbValue($rs->fields('I_dari2'));
		$master_siswa->I_dari3->setDbValue($rs->fields('I_dari3'));
		$master_siswa->J_melanjutkan->setDbValue($rs->fields('J_melanjutkan'));
		$master_siswa->J_tanggal_bekerja->setDbValue($rs->fields('J_tanggal_bekerja'));
		$master_siswa->J_nama_perusahaan->setDbValue($rs->fields('J_nama_perusahaan'));
		$master_siswa->J_penghasilan->setDbValue($rs->fields('J_penghasilan'));
		$master_siswa->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$master_siswa->apakah_valid->setDbValue($rs->fields('apakah_valid'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_siswa;

		// Initialize URLs
		// Call Row_Rendering event

		$master_siswa->Row_Rendering();

		// Common render codes for all row types
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

		if ($master_siswa->RowType == EW_ROWTYPE_VIEW) { // View row

			// no_absen
			$master_siswa->no_absen->ViewValue = $master_siswa->no_absen->CurrentValue;
			$master_siswa->no_absen->ViewCustomAttributes = "";

			// A_nis_nasional
			$master_siswa->A_nis_nasional->ViewValue = $master_siswa->A_nis_nasional->CurrentValue;
			$master_siswa->A_nis_nasional->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->ViewValue = $master_siswa->A_nama_Lengkap->CurrentValue;
			$master_siswa->A_nama_Lengkap->ViewCustomAttributes = "";

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->ViewValue = $master_siswa->A_nama_panggilan->CurrentValue;
			$master_siswa->A_nama_panggilan->ViewCustomAttributes = "";

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->ViewValue = $master_siswa->A_jenis_kelamin->CurrentValue;
			$master_siswa->A_jenis_kelamin->ViewCustomAttributes = "";

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->ViewValue = $master_siswa->A_tempat_lahir->CurrentValue;
			$master_siswa->A_tempat_lahir->ViewCustomAttributes = "";

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->ViewValue = $master_siswa->A_tanggal_lahir->CurrentValue;
			$master_siswa->A_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->A_tanggal_lahir->ViewValue, 7);
			$master_siswa->A_tanggal_lahir->ViewCustomAttributes = "";

			// A_agama
			if (strval($master_siswa->A_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->A_agama->CurrentValue) . "'";
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
					$master_siswa->A_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->A_agama->ViewValue = $master_siswa->A_agama->CurrentValue;
				}
			} else {
				$master_siswa->A_agama->ViewValue = NULL;
			}
			$master_siswa->A_agama->ViewCustomAttributes = "";

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->ViewValue = $master_siswa->A_kewarganegaraan->CurrentValue;
			$master_siswa->A_kewarganegaraan->ViewCustomAttributes = "";

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->ViewValue = $master_siswa->A_anak_keberapa->CurrentValue;
			$master_siswa->A_anak_keberapa->ViewCustomAttributes = "";

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->ViewValue = $master_siswa->A_jumlah_saudara_kandung->CurrentValue;
			$master_siswa->A_jumlah_saudara_kandung->ViewCustomAttributes = "";

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->ViewValue = $master_siswa->A_jumlah_saudara_tiri->CurrentValue;
			$master_siswa->A_jumlah_saudara_tiri->ViewCustomAttributes = "";

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->ViewValue = $master_siswa->A_jumlah_saudara_angkat->CurrentValue;
			$master_siswa->A_jumlah_saudara_angkat->ViewCustomAttributes = "";

			// A_status_yatim
			$master_siswa->A_status_yatim->ViewValue = $master_siswa->A_status_yatim->CurrentValue;
			$master_siswa->A_status_yatim->ViewCustomAttributes = "";

			// A_bahasa
			$master_siswa->A_bahasa->ViewValue = $master_siswa->A_bahasa->CurrentValue;
			$master_siswa->A_bahasa->ViewCustomAttributes = "";

			// B_alamat
			$master_siswa->B_alamat->ViewValue = $master_siswa->B_alamat->CurrentValue;
			$master_siswa->B_alamat->ViewCustomAttributes = "";

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->ViewValue = $master_siswa->B_telepon_rumah->CurrentValue;
			$master_siswa->B_telepon_rumah->ViewCustomAttributes = "";

			// B_tinggal
			$master_siswa->B_tinggal->ViewValue = $master_siswa->B_tinggal->CurrentValue;
			$master_siswa->B_tinggal->ViewCustomAttributes = "";

			// B_jarak
			$master_siswa->B_jarak->ViewValue = $master_siswa->B_jarak->CurrentValue;
			$master_siswa->B_jarak->ViewCustomAttributes = "";

			// B_hp
			$master_siswa->B_hp->ViewValue = $master_siswa->B_hp->CurrentValue;
			$master_siswa->B_hp->ViewCustomAttributes = "";

			// C_golongan_darah
			$master_siswa->C_golongan_darah->ViewValue = $master_siswa->C_golongan_darah->CurrentValue;
			$master_siswa->C_golongan_darah->ViewCustomAttributes = "";

			// C_penyakit
			$master_siswa->C_penyakit->ViewValue = $master_siswa->C_penyakit->CurrentValue;
			$master_siswa->C_penyakit->ViewCustomAttributes = "";

			// C_jasmani
			$master_siswa->C_jasmani->ViewValue = $master_siswa->C_jasmani->CurrentValue;
			$master_siswa->C_jasmani->ViewCustomAttributes = "";

			// C_tinggi
			$master_siswa->C_tinggi->ViewValue = $master_siswa->C_tinggi->CurrentValue;
			$master_siswa->C_tinggi->ViewCustomAttributes = "";

			// C_berat
			$master_siswa->C_berat->ViewValue = $master_siswa->C_berat->CurrentValue;
			$master_siswa->C_berat->ViewCustomAttributes = "";

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->ViewValue = $master_siswa->D_tamatan_dari->CurrentValue;
			$master_siswa->D_tamatan_dari->ViewCustomAttributes = "";

			// D_sttb
			$master_siswa->D_sttb->ViewValue = $master_siswa->D_sttb->CurrentValue;
			$master_siswa->D_sttb->ViewCustomAttributes = "";

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->ViewValue = $master_siswa->D_tanggal_sttb->CurrentValue;
			$master_siswa->D_tanggal_sttb->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal_sttb->ViewValue, 7);
			$master_siswa->D_tanggal_sttb->ViewCustomAttributes = "";

			// D_danum
			$master_siswa->D_danum->ViewValue = $master_siswa->D_danum->CurrentValue;
			$master_siswa->D_danum->ViewCustomAttributes = "";

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->ViewValue = $master_siswa->D_tanggal_danum->CurrentValue;
			$master_siswa->D_tanggal_danum->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal_danum->ViewValue, 7);
			$master_siswa->D_tanggal_danum->ViewCustomAttributes = "";

			// D_lama_belajar
			$master_siswa->D_lama_belajar->ViewValue = $master_siswa->D_lama_belajar->CurrentValue;
			$master_siswa->D_lama_belajar->ViewCustomAttributes = "";

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->ViewValue = $master_siswa->D_dari_sekolah->CurrentValue;
			$master_siswa->D_dari_sekolah->ViewCustomAttributes = "";

			// D_alasan
			$master_siswa->D_alasan->ViewValue = $master_siswa->D_alasan->CurrentValue;
			$master_siswa->D_alasan->ViewCustomAttributes = "";

			// D_kelas
			$master_siswa->D_kelas->ViewValue = $master_siswa->D_kelas->CurrentValue;
			$master_siswa->D_kelas->ViewCustomAttributes = "";

			// D_kelompok
			$master_siswa->D_kelompok->ViewValue = $master_siswa->D_kelompok->CurrentValue;
			$master_siswa->D_kelompok->ViewCustomAttributes = "";

			// D_tanggal
			$master_siswa->D_tanggal->ViewValue = $master_siswa->D_tanggal->CurrentValue;
			$master_siswa->D_tanggal->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal->ViewValue, 7);
			$master_siswa->D_tanggal->ViewCustomAttributes = "";

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->ViewValue = $master_siswa->D_saat_ini_tingkat->CurrentValue;
			$master_siswa->D_saat_ini_tingkat->ViewCustomAttributes = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->ViewValue = $master_siswa->D_saat_ini_kelas->CurrentValue;
			$master_siswa->D_saat_ini_kelas->ViewCustomAttributes = "";

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->ViewValue = $master_siswa->D_saat_ini_kelompok->CurrentValue;
			$master_siswa->D_saat_ini_kelompok->ViewCustomAttributes = "";

			// D_no_psb
			$master_siswa->D_no_psb->ViewValue = $master_siswa->D_no_psb->CurrentValue;
			$master_siswa->D_no_psb->ViewCustomAttributes = "";

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->ViewValue = $master_siswa->D_nilai_danum_sd->CurrentValue;
			$master_siswa->D_nilai_danum_sd->ViewCustomAttributes = "";

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->ViewValue = $master_siswa->D_jumlah_pelajaran_danum->CurrentValue;
			$master_siswa->D_jumlah_pelajaran_danum->ViewCustomAttributes = "";

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->ViewValue = $master_siswa->D_nilai_ujian_psb->CurrentValue;
			$master_siswa->D_nilai_ujian_psb->ViewCustomAttributes = "";

			// D_tahun_psb
			$master_siswa->D_tahun_psb->ViewValue = $master_siswa->D_tahun_psb->CurrentValue;
			$master_siswa->D_tahun_psb->ViewCustomAttributes = "";

			// D_diterima
			$master_siswa->D_diterima->ViewValue = $master_siswa->D_diterima->CurrentValue;
			$master_siswa->D_diterima->ViewCustomAttributes = "";

			// D_spp
			$master_siswa->D_spp->ViewValue = $master_siswa->D_spp->CurrentValue;
			$master_siswa->D_spp->ViewCustomAttributes = "";

			// D_spp_potongan
			$master_siswa->D_spp_potongan->ViewValue = $master_siswa->D_spp_potongan->CurrentValue;
			$master_siswa->D_spp_potongan->ViewCustomAttributes = "";

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->ViewValue = $master_siswa->D_status_lama_baru->CurrentValue;
			$master_siswa->D_status_lama_baru->ViewCustomAttributes = "";

			// E_nama_ayah
			$master_siswa->E_nama_ayah->ViewValue = $master_siswa->E_nama_ayah->CurrentValue;
			$master_siswa->E_nama_ayah->ViewCustomAttributes = "";

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->ViewValue = $master_siswa->E_tempat_lahir->CurrentValue;
			$master_siswa->E_tempat_lahir->ViewCustomAttributes = "";

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->ViewValue = $master_siswa->E_tanggal_lahir->CurrentValue;
			$master_siswa->E_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->E_tanggal_lahir->ViewValue, 7);
			$master_siswa->E_tanggal_lahir->ViewCustomAttributes = "";

			// E_agama
			if (strval($master_siswa->E_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->E_agama->CurrentValue) . "'";
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
					$master_siswa->E_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->E_agama->ViewValue = $master_siswa->E_agama->CurrentValue;
				}
			} else {
				$master_siswa->E_agama->ViewValue = NULL;
			}
			$master_siswa->E_agama->ViewCustomAttributes = "";

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->ViewValue = $master_siswa->E_kewarganegaraan->CurrentValue;
			$master_siswa->E_kewarganegaraan->ViewCustomAttributes = "";

			// E_pendidikan
			$master_siswa->E_pendidikan->ViewValue = $master_siswa->E_pendidikan->CurrentValue;
			$master_siswa->E_pendidikan->ViewCustomAttributes = "";

			// E_pekerjaan
			$master_siswa->E_pekerjaan->ViewValue = $master_siswa->E_pekerjaan->CurrentValue;
			$master_siswa->E_pekerjaan->ViewCustomAttributes = "";

			// E_pengeluaran
			$master_siswa->E_pengeluaran->ViewValue = $master_siswa->E_pengeluaran->CurrentValue;
			$master_siswa->E_pengeluaran->ViewCustomAttributes = "";

			// E_alamat
			$master_siswa->E_alamat->ViewValue = $master_siswa->E_alamat->CurrentValue;
			$master_siswa->E_alamat->ViewCustomAttributes = "";

			// E_telepon
			$master_siswa->E_telepon->ViewValue = $master_siswa->E_telepon->CurrentValue;
			$master_siswa->E_telepon->ViewCustomAttributes = "";

			// E_hp
			$master_siswa->E_hp->ViewValue = $master_siswa->E_hp->CurrentValue;
			$master_siswa->E_hp->ViewCustomAttributes = "";

			// E_hidup
			$master_siswa->E_hidup->ViewValue = $master_siswa->E_hidup->CurrentValue;
			$master_siswa->E_hidup->ViewCustomAttributes = "";

			// F_nama_ibu
			$master_siswa->F_nama_ibu->ViewValue = $master_siswa->F_nama_ibu->CurrentValue;
			$master_siswa->F_nama_ibu->ViewCustomAttributes = "";

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->ViewValue = $master_siswa->F_tempat_lahir->CurrentValue;
			$master_siswa->F_tempat_lahir->ViewCustomAttributes = "";

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->ViewValue = $master_siswa->F_tanggal_lahir->CurrentValue;
			$master_siswa->F_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->F_tanggal_lahir->ViewValue, 7);
			$master_siswa->F_tanggal_lahir->ViewCustomAttributes = "";

			// F_agama
			if (strval($master_siswa->F_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->F_agama->CurrentValue) . "'";
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
					$master_siswa->F_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->F_agama->ViewValue = $master_siswa->F_agama->CurrentValue;
				}
			} else {
				$master_siswa->F_agama->ViewValue = NULL;
			}
			$master_siswa->F_agama->ViewCustomAttributes = "";

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->ViewValue = $master_siswa->F_kewarganegaraan->CurrentValue;
			$master_siswa->F_kewarganegaraan->ViewCustomAttributes = "";

			// F_pendidikan
			$master_siswa->F_pendidikan->ViewValue = $master_siswa->F_pendidikan->CurrentValue;
			$master_siswa->F_pendidikan->ViewCustomAttributes = "";

			// F_pekerjaan
			$master_siswa->F_pekerjaan->ViewValue = $master_siswa->F_pekerjaan->CurrentValue;
			$master_siswa->F_pekerjaan->ViewCustomAttributes = "";

			// F_pengeluaran
			$master_siswa->F_pengeluaran->ViewValue = $master_siswa->F_pengeluaran->CurrentValue;
			$master_siswa->F_pengeluaran->ViewCustomAttributes = "";

			// F_alamat
			$master_siswa->F_alamat->ViewValue = $master_siswa->F_alamat->CurrentValue;
			$master_siswa->F_alamat->ViewCustomAttributes = "";

			// F_telepon
			$master_siswa->F_telepon->ViewValue = $master_siswa->F_telepon->CurrentValue;
			$master_siswa->F_telepon->ViewCustomAttributes = "";

			// F_hp
			$master_siswa->F_hp->ViewValue = $master_siswa->F_hp->CurrentValue;
			$master_siswa->F_hp->ViewCustomAttributes = "";

			// F_hidup
			$master_siswa->F_hidup->ViewValue = $master_siswa->F_hidup->CurrentValue;
			$master_siswa->F_hidup->ViewCustomAttributes = "";

			// G_nama_wali
			$master_siswa->G_nama_wali->ViewValue = $master_siswa->G_nama_wali->CurrentValue;
			$master_siswa->G_nama_wali->ViewCustomAttributes = "";

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->ViewValue = $master_siswa->G_tempat_lahir->CurrentValue;
			$master_siswa->G_tempat_lahir->ViewCustomAttributes = "";

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->ViewValue = $master_siswa->G_tanggal_lahir->CurrentValue;
			$master_siswa->G_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->G_tanggal_lahir->ViewValue, 7);
			$master_siswa->G_tanggal_lahir->ViewCustomAttributes = "";

			// G_agama
			if (strval($master_siswa->G_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->G_agama->CurrentValue) . "'";
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
					$master_siswa->G_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->G_agama->ViewValue = $master_siswa->G_agama->CurrentValue;
				}
			} else {
				$master_siswa->G_agama->ViewValue = NULL;
			}
			$master_siswa->G_agama->ViewCustomAttributes = "";

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->ViewValue = $master_siswa->G_kewarganegaraan->CurrentValue;
			$master_siswa->G_kewarganegaraan->ViewCustomAttributes = "";

			// G_pendidikan
			$master_siswa->G_pendidikan->ViewValue = $master_siswa->G_pendidikan->CurrentValue;
			$master_siswa->G_pendidikan->ViewCustomAttributes = "";

			// G_pekerjaan
			$master_siswa->G_pekerjaan->ViewValue = $master_siswa->G_pekerjaan->CurrentValue;
			$master_siswa->G_pekerjaan->ViewCustomAttributes = "";

			// G_pengeluaran
			$master_siswa->G_pengeluaran->ViewValue = $master_siswa->G_pengeluaran->CurrentValue;
			$master_siswa->G_pengeluaran->ViewCustomAttributes = "";

			// G_alamat
			$master_siswa->G_alamat->ViewValue = $master_siswa->G_alamat->CurrentValue;
			$master_siswa->G_alamat->ViewCustomAttributes = "";

			// G_telepon
			$master_siswa->G_telepon->ViewValue = $master_siswa->G_telepon->CurrentValue;
			$master_siswa->G_telepon->ViewCustomAttributes = "";

			// G_hp
			$master_siswa->G_hp->ViewValue = $master_siswa->G_hp->CurrentValue;
			$master_siswa->G_hp->ViewCustomAttributes = "";

			// H_kesenian
			$master_siswa->H_kesenian->ViewValue = $master_siswa->H_kesenian->CurrentValue;
			$master_siswa->H_kesenian->ViewCustomAttributes = "";

			// H_olahraga
			$master_siswa->H_olahraga->ViewValue = $master_siswa->H_olahraga->CurrentValue;
			$master_siswa->H_olahraga->ViewCustomAttributes = "";

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->ViewValue = $master_siswa->H_kemasyarakatan->CurrentValue;
			$master_siswa->H_kemasyarakatan->ViewCustomAttributes = "";

			// H_lainlain
			$master_siswa->H_lainlain->ViewValue = $master_siswa->H_lainlain->CurrentValue;
			$master_siswa->H_lainlain->ViewCustomAttributes = "";

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->ViewValue = $master_siswa->I_tanggal_meninggalkan->CurrentValue;
			$master_siswa->I_tanggal_meninggalkan->ViewValue = ew_FormatDateTime($master_siswa->I_tanggal_meninggalkan->ViewValue, 7);
			$master_siswa->I_tanggal_meninggalkan->ViewCustomAttributes = "";

			// I_alasan
			$master_siswa->I_alasan->ViewValue = $master_siswa->I_alasan->CurrentValue;
			$master_siswa->I_alasan->ViewCustomAttributes = "";

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->ViewValue = $master_siswa->I_tanggal_lulus->CurrentValue;
			$master_siswa->I_tanggal_lulus->ViewValue = ew_FormatDateTime($master_siswa->I_tanggal_lulus->ViewValue, 7);
			$master_siswa->I_tanggal_lulus->ViewCustomAttributes = "";

			// I_sttb
			$master_siswa->I_sttb->ViewValue = $master_siswa->I_sttb->CurrentValue;
			$master_siswa->I_sttb->ViewCustomAttributes = "";

			// I_danum
			$master_siswa->I_danum->ViewValue = $master_siswa->I_danum->CurrentValue;
			$master_siswa->I_danum->ViewCustomAttributes = "";

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->ViewValue = $master_siswa->I_nilai_danum_smp->CurrentValue;
			$master_siswa->I_nilai_danum_smp->ViewCustomAttributes = "";

			// I_tahun1
			$master_siswa->I_tahun1->ViewValue = $master_siswa->I_tahun1->CurrentValue;
			$master_siswa->I_tahun1->ViewCustomAttributes = "";

			// I_tahun2
			$master_siswa->I_tahun2->ViewValue = $master_siswa->I_tahun2->CurrentValue;
			$master_siswa->I_tahun2->ViewCustomAttributes = "";

			// I_tahun3
			$master_siswa->I_tahun3->ViewValue = $master_siswa->I_tahun3->CurrentValue;
			$master_siswa->I_tahun3->ViewCustomAttributes = "";

			// I_tk1
			$master_siswa->I_tk1->ViewValue = $master_siswa->I_tk1->CurrentValue;
			$master_siswa->I_tk1->ViewCustomAttributes = "";

			// I_tk2
			$master_siswa->I_tk2->ViewValue = $master_siswa->I_tk2->CurrentValue;
			$master_siswa->I_tk2->ViewCustomAttributes = "";

			// I_tk3
			$master_siswa->I_tk3->ViewValue = $master_siswa->I_tk3->CurrentValue;
			$master_siswa->I_tk3->ViewCustomAttributes = "";

			// I_dari1
			$master_siswa->I_dari1->ViewValue = $master_siswa->I_dari1->CurrentValue;
			$master_siswa->I_dari1->ViewCustomAttributes = "";

			// I_dari2
			$master_siswa->I_dari2->ViewValue = $master_siswa->I_dari2->CurrentValue;
			$master_siswa->I_dari2->ViewCustomAttributes = "";

			// I_dari3
			$master_siswa->I_dari3->ViewValue = $master_siswa->I_dari3->CurrentValue;
			$master_siswa->I_dari3->ViewCustomAttributes = "";

			// J_melanjutkan
			$master_siswa->J_melanjutkan->ViewValue = $master_siswa->J_melanjutkan->CurrentValue;
			$master_siswa->J_melanjutkan->ViewCustomAttributes = "";

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->ViewValue = $master_siswa->J_tanggal_bekerja->CurrentValue;
			$master_siswa->J_tanggal_bekerja->ViewValue = ew_FormatDateTime($master_siswa->J_tanggal_bekerja->ViewValue, 7);
			$master_siswa->J_tanggal_bekerja->ViewCustomAttributes = "";

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->ViewValue = $master_siswa->J_nama_perusahaan->CurrentValue;
			$master_siswa->J_nama_perusahaan->ViewCustomAttributes = "";

			// J_penghasilan
			$master_siswa->J_penghasilan->ViewValue = $master_siswa->J_penghasilan->CurrentValue;
			$master_siswa->J_penghasilan->ViewCustomAttributes = "";

			// kode_otomatis
			$master_siswa->kode_otomatis->ViewValue = $master_siswa->kode_otomatis->CurrentValue;
			$master_siswa->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			if (strval($master_siswa->apakah_valid->CurrentValue) <> "") {
				switch ($master_siswa->apakah_valid->CurrentValue) {
					case "y":
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->FldTagCaption(1) <> "" ? $master_siswa->apakah_valid->FldTagCaption(1) : $master_siswa->apakah_valid->CurrentValue;
						break;
					case "t":
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->FldTagCaption(2) <> "" ? $master_siswa->apakah_valid->FldTagCaption(2) : $master_siswa->apakah_valid->CurrentValue;
						break;
					default:
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->CurrentValue;
				}
			} else {
				$master_siswa->apakah_valid->ViewValue = NULL;
			}
			$master_siswa->apakah_valid->ViewCustomAttributes = "";

			// no_absen
			$master_siswa->no_absen->LinkCustomAttributes = "";
			$master_siswa->no_absen->HrefValue = "";
			$master_siswa->no_absen->TooltipValue = "";

			// A_nis_nasional
			$master_siswa->A_nis_nasional->LinkCustomAttributes = "";
			$master_siswa->A_nis_nasional->HrefValue = "";
			$master_siswa->A_nis_nasional->TooltipValue = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->LinkCustomAttributes = "";
			$master_siswa->A_nama_Lengkap->HrefValue = "";
			$master_siswa->A_nama_Lengkap->TooltipValue = "";

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->LinkCustomAttributes = "";
			$master_siswa->A_nama_panggilan->HrefValue = "";
			$master_siswa->A_nama_panggilan->TooltipValue = "";

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->LinkCustomAttributes = "";
			$master_siswa->A_jenis_kelamin->HrefValue = "";
			$master_siswa->A_jenis_kelamin->TooltipValue = "";

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->A_tempat_lahir->HrefValue = "";
			$master_siswa->A_tempat_lahir->TooltipValue = "";

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->A_tanggal_lahir->HrefValue = "";
			$master_siswa->A_tanggal_lahir->TooltipValue = "";

			// A_agama
			$master_siswa->A_agama->LinkCustomAttributes = "";
			$master_siswa->A_agama->HrefValue = "";
			$master_siswa->A_agama->TooltipValue = "";

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->A_kewarganegaraan->HrefValue = "";
			$master_siswa->A_kewarganegaraan->TooltipValue = "";

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->LinkCustomAttributes = "";
			$master_siswa->A_anak_keberapa->HrefValue = "";
			$master_siswa->A_anak_keberapa->TooltipValue = "";

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_kandung->HrefValue = "";
			$master_siswa->A_jumlah_saudara_kandung->TooltipValue = "";

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_tiri->HrefValue = "";
			$master_siswa->A_jumlah_saudara_tiri->TooltipValue = "";

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_angkat->HrefValue = "";
			$master_siswa->A_jumlah_saudara_angkat->TooltipValue = "";

			// A_status_yatim
			$master_siswa->A_status_yatim->LinkCustomAttributes = "";
			$master_siswa->A_status_yatim->HrefValue = "";
			$master_siswa->A_status_yatim->TooltipValue = "";

			// A_bahasa
			$master_siswa->A_bahasa->LinkCustomAttributes = "";
			$master_siswa->A_bahasa->HrefValue = "";
			$master_siswa->A_bahasa->TooltipValue = "";

			// B_alamat
			$master_siswa->B_alamat->LinkCustomAttributes = "";
			$master_siswa->B_alamat->HrefValue = "";
			$master_siswa->B_alamat->TooltipValue = "";

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->LinkCustomAttributes = "";
			$master_siswa->B_telepon_rumah->HrefValue = "";
			$master_siswa->B_telepon_rumah->TooltipValue = "";

			// B_tinggal
			$master_siswa->B_tinggal->LinkCustomAttributes = "";
			$master_siswa->B_tinggal->HrefValue = "";
			$master_siswa->B_tinggal->TooltipValue = "";

			// B_jarak
			$master_siswa->B_jarak->LinkCustomAttributes = "";
			$master_siswa->B_jarak->HrefValue = "";
			$master_siswa->B_jarak->TooltipValue = "";

			// B_hp
			$master_siswa->B_hp->LinkCustomAttributes = "";
			$master_siswa->B_hp->HrefValue = "";
			$master_siswa->B_hp->TooltipValue = "";

			// C_golongan_darah
			$master_siswa->C_golongan_darah->LinkCustomAttributes = "";
			$master_siswa->C_golongan_darah->HrefValue = "";
			$master_siswa->C_golongan_darah->TooltipValue = "";

			// C_penyakit
			$master_siswa->C_penyakit->LinkCustomAttributes = "";
			$master_siswa->C_penyakit->HrefValue = "";
			$master_siswa->C_penyakit->TooltipValue = "";

			// C_jasmani
			$master_siswa->C_jasmani->LinkCustomAttributes = "";
			$master_siswa->C_jasmani->HrefValue = "";
			$master_siswa->C_jasmani->TooltipValue = "";

			// C_tinggi
			$master_siswa->C_tinggi->LinkCustomAttributes = "";
			$master_siswa->C_tinggi->HrefValue = "";
			$master_siswa->C_tinggi->TooltipValue = "";

			// C_berat
			$master_siswa->C_berat->LinkCustomAttributes = "";
			$master_siswa->C_berat->HrefValue = "";
			$master_siswa->C_berat->TooltipValue = "";

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->LinkCustomAttributes = "";
			$master_siswa->D_tamatan_dari->HrefValue = "";
			$master_siswa->D_tamatan_dari->TooltipValue = "";

			// D_sttb
			$master_siswa->D_sttb->LinkCustomAttributes = "";
			$master_siswa->D_sttb->HrefValue = "";
			$master_siswa->D_sttb->TooltipValue = "";

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->LinkCustomAttributes = "";
			$master_siswa->D_tanggal_sttb->HrefValue = "";
			$master_siswa->D_tanggal_sttb->TooltipValue = "";

			// D_danum
			$master_siswa->D_danum->LinkCustomAttributes = "";
			$master_siswa->D_danum->HrefValue = "";
			$master_siswa->D_danum->TooltipValue = "";

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->LinkCustomAttributes = "";
			$master_siswa->D_tanggal_danum->HrefValue = "";
			$master_siswa->D_tanggal_danum->TooltipValue = "";

			// D_lama_belajar
			$master_siswa->D_lama_belajar->LinkCustomAttributes = "";
			$master_siswa->D_lama_belajar->HrefValue = "";
			$master_siswa->D_lama_belajar->TooltipValue = "";

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->LinkCustomAttributes = "";
			$master_siswa->D_dari_sekolah->HrefValue = "";
			$master_siswa->D_dari_sekolah->TooltipValue = "";

			// D_alasan
			$master_siswa->D_alasan->LinkCustomAttributes = "";
			$master_siswa->D_alasan->HrefValue = "";
			$master_siswa->D_alasan->TooltipValue = "";

			// D_kelas
			$master_siswa->D_kelas->LinkCustomAttributes = "";
			$master_siswa->D_kelas->HrefValue = "";
			$master_siswa->D_kelas->TooltipValue = "";

			// D_kelompok
			$master_siswa->D_kelompok->LinkCustomAttributes = "";
			$master_siswa->D_kelompok->HrefValue = "";
			$master_siswa->D_kelompok->TooltipValue = "";

			// D_tanggal
			$master_siswa->D_tanggal->LinkCustomAttributes = "";
			$master_siswa->D_tanggal->HrefValue = "";
			$master_siswa->D_tanggal->TooltipValue = "";

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_tingkat->HrefValue = "";
			$master_siswa->D_saat_ini_tingkat->TooltipValue = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_kelas->HrefValue = "";
			$master_siswa->D_saat_ini_kelas->TooltipValue = "";

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_kelompok->HrefValue = "";
			$master_siswa->D_saat_ini_kelompok->TooltipValue = "";

			// D_no_psb
			$master_siswa->D_no_psb->LinkCustomAttributes = "";
			$master_siswa->D_no_psb->HrefValue = "";
			$master_siswa->D_no_psb->TooltipValue = "";

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->LinkCustomAttributes = "";
			$master_siswa->D_nilai_danum_sd->HrefValue = "";
			$master_siswa->D_nilai_danum_sd->TooltipValue = "";

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->LinkCustomAttributes = "";
			$master_siswa->D_jumlah_pelajaran_danum->HrefValue = "";
			$master_siswa->D_jumlah_pelajaran_danum->TooltipValue = "";

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->LinkCustomAttributes = "";
			$master_siswa->D_nilai_ujian_psb->HrefValue = "";
			$master_siswa->D_nilai_ujian_psb->TooltipValue = "";

			// D_tahun_psb
			$master_siswa->D_tahun_psb->LinkCustomAttributes = "";
			$master_siswa->D_tahun_psb->HrefValue = "";
			$master_siswa->D_tahun_psb->TooltipValue = "";

			// D_diterima
			$master_siswa->D_diterima->LinkCustomAttributes = "";
			$master_siswa->D_diterima->HrefValue = "";
			$master_siswa->D_diterima->TooltipValue = "";

			// D_spp
			$master_siswa->D_spp->LinkCustomAttributes = "";
			$master_siswa->D_spp->HrefValue = "";
			$master_siswa->D_spp->TooltipValue = "";

			// D_spp_potongan
			$master_siswa->D_spp_potongan->LinkCustomAttributes = "";
			$master_siswa->D_spp_potongan->HrefValue = "";
			$master_siswa->D_spp_potongan->TooltipValue = "";

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->LinkCustomAttributes = "";
			$master_siswa->D_status_lama_baru->HrefValue = "";
			$master_siswa->D_status_lama_baru->TooltipValue = "";

			// E_nama_ayah
			$master_siswa->E_nama_ayah->LinkCustomAttributes = "";
			$master_siswa->E_nama_ayah->HrefValue = "";
			$master_siswa->E_nama_ayah->TooltipValue = "";

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->E_tempat_lahir->HrefValue = "";
			$master_siswa->E_tempat_lahir->TooltipValue = "";

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->E_tanggal_lahir->HrefValue = "";
			$master_siswa->E_tanggal_lahir->TooltipValue = "";

			// E_agama
			$master_siswa->E_agama->LinkCustomAttributes = "";
			$master_siswa->E_agama->HrefValue = "";
			$master_siswa->E_agama->TooltipValue = "";

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->E_kewarganegaraan->HrefValue = "";
			$master_siswa->E_kewarganegaraan->TooltipValue = "";

			// E_pendidikan
			$master_siswa->E_pendidikan->LinkCustomAttributes = "";
			$master_siswa->E_pendidikan->HrefValue = "";
			$master_siswa->E_pendidikan->TooltipValue = "";

			// E_pekerjaan
			$master_siswa->E_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->E_pekerjaan->HrefValue = "";
			$master_siswa->E_pekerjaan->TooltipValue = "";

			// E_pengeluaran
			$master_siswa->E_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->E_pengeluaran->HrefValue = "";
			$master_siswa->E_pengeluaran->TooltipValue = "";

			// E_alamat
			$master_siswa->E_alamat->LinkCustomAttributes = "";
			$master_siswa->E_alamat->HrefValue = "";
			$master_siswa->E_alamat->TooltipValue = "";

			// E_telepon
			$master_siswa->E_telepon->LinkCustomAttributes = "";
			$master_siswa->E_telepon->HrefValue = "";
			$master_siswa->E_telepon->TooltipValue = "";

			// E_hp
			$master_siswa->E_hp->LinkCustomAttributes = "";
			$master_siswa->E_hp->HrefValue = "";
			$master_siswa->E_hp->TooltipValue = "";

			// E_hidup
			$master_siswa->E_hidup->LinkCustomAttributes = "";
			$master_siswa->E_hidup->HrefValue = "";
			$master_siswa->E_hidup->TooltipValue = "";

			// F_nama_ibu
			$master_siswa->F_nama_ibu->LinkCustomAttributes = "";
			$master_siswa->F_nama_ibu->HrefValue = "";
			$master_siswa->F_nama_ibu->TooltipValue = "";

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->F_tempat_lahir->HrefValue = "";
			$master_siswa->F_tempat_lahir->TooltipValue = "";

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->F_tanggal_lahir->HrefValue = "";
			$master_siswa->F_tanggal_lahir->TooltipValue = "";

			// F_agama
			$master_siswa->F_agama->LinkCustomAttributes = "";
			$master_siswa->F_agama->HrefValue = "";
			$master_siswa->F_agama->TooltipValue = "";

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->F_kewarganegaraan->HrefValue = "";
			$master_siswa->F_kewarganegaraan->TooltipValue = "";

			// F_pendidikan
			$master_siswa->F_pendidikan->LinkCustomAttributes = "";
			$master_siswa->F_pendidikan->HrefValue = "";
			$master_siswa->F_pendidikan->TooltipValue = "";

			// F_pekerjaan
			$master_siswa->F_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->F_pekerjaan->HrefValue = "";
			$master_siswa->F_pekerjaan->TooltipValue = "";

			// F_pengeluaran
			$master_siswa->F_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->F_pengeluaran->HrefValue = "";
			$master_siswa->F_pengeluaran->TooltipValue = "";

			// F_alamat
			$master_siswa->F_alamat->LinkCustomAttributes = "";
			$master_siswa->F_alamat->HrefValue = "";
			$master_siswa->F_alamat->TooltipValue = "";

			// F_telepon
			$master_siswa->F_telepon->LinkCustomAttributes = "";
			$master_siswa->F_telepon->HrefValue = "";
			$master_siswa->F_telepon->TooltipValue = "";

			// F_hp
			$master_siswa->F_hp->LinkCustomAttributes = "";
			$master_siswa->F_hp->HrefValue = "";
			$master_siswa->F_hp->TooltipValue = "";

			// F_hidup
			$master_siswa->F_hidup->LinkCustomAttributes = "";
			$master_siswa->F_hidup->HrefValue = "";
			$master_siswa->F_hidup->TooltipValue = "";

			// G_nama_wali
			$master_siswa->G_nama_wali->LinkCustomAttributes = "";
			$master_siswa->G_nama_wali->HrefValue = "";
			$master_siswa->G_nama_wali->TooltipValue = "";

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->G_tempat_lahir->HrefValue = "";
			$master_siswa->G_tempat_lahir->TooltipValue = "";

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->G_tanggal_lahir->HrefValue = "";
			$master_siswa->G_tanggal_lahir->TooltipValue = "";

			// G_agama
			$master_siswa->G_agama->LinkCustomAttributes = "";
			$master_siswa->G_agama->HrefValue = "";
			$master_siswa->G_agama->TooltipValue = "";

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->G_kewarganegaraan->HrefValue = "";
			$master_siswa->G_kewarganegaraan->TooltipValue = "";

			// G_pendidikan
			$master_siswa->G_pendidikan->LinkCustomAttributes = "";
			$master_siswa->G_pendidikan->HrefValue = "";
			$master_siswa->G_pendidikan->TooltipValue = "";

			// G_pekerjaan
			$master_siswa->G_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->G_pekerjaan->HrefValue = "";
			$master_siswa->G_pekerjaan->TooltipValue = "";

			// G_pengeluaran
			$master_siswa->G_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->G_pengeluaran->HrefValue = "";
			$master_siswa->G_pengeluaran->TooltipValue = "";

			// G_alamat
			$master_siswa->G_alamat->LinkCustomAttributes = "";
			$master_siswa->G_alamat->HrefValue = "";
			$master_siswa->G_alamat->TooltipValue = "";

			// G_telepon
			$master_siswa->G_telepon->LinkCustomAttributes = "";
			$master_siswa->G_telepon->HrefValue = "";
			$master_siswa->G_telepon->TooltipValue = "";

			// G_hp
			$master_siswa->G_hp->LinkCustomAttributes = "";
			$master_siswa->G_hp->HrefValue = "";
			$master_siswa->G_hp->TooltipValue = "";

			// H_kesenian
			$master_siswa->H_kesenian->LinkCustomAttributes = "";
			$master_siswa->H_kesenian->HrefValue = "";
			$master_siswa->H_kesenian->TooltipValue = "";

			// H_olahraga
			$master_siswa->H_olahraga->LinkCustomAttributes = "";
			$master_siswa->H_olahraga->HrefValue = "";
			$master_siswa->H_olahraga->TooltipValue = "";

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->LinkCustomAttributes = "";
			$master_siswa->H_kemasyarakatan->HrefValue = "";
			$master_siswa->H_kemasyarakatan->TooltipValue = "";

			// H_lainlain
			$master_siswa->H_lainlain->LinkCustomAttributes = "";
			$master_siswa->H_lainlain->HrefValue = "";
			$master_siswa->H_lainlain->TooltipValue = "";

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->LinkCustomAttributes = "";
			$master_siswa->I_tanggal_meninggalkan->HrefValue = "";
			$master_siswa->I_tanggal_meninggalkan->TooltipValue = "";

			// I_alasan
			$master_siswa->I_alasan->LinkCustomAttributes = "";
			$master_siswa->I_alasan->HrefValue = "";
			$master_siswa->I_alasan->TooltipValue = "";

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->LinkCustomAttributes = "";
			$master_siswa->I_tanggal_lulus->HrefValue = "";
			$master_siswa->I_tanggal_lulus->TooltipValue = "";

			// I_sttb
			$master_siswa->I_sttb->LinkCustomAttributes = "";
			$master_siswa->I_sttb->HrefValue = "";
			$master_siswa->I_sttb->TooltipValue = "";

			// I_danum
			$master_siswa->I_danum->LinkCustomAttributes = "";
			$master_siswa->I_danum->HrefValue = "";
			$master_siswa->I_danum->TooltipValue = "";

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->LinkCustomAttributes = "";
			$master_siswa->I_nilai_danum_smp->HrefValue = "";
			$master_siswa->I_nilai_danum_smp->TooltipValue = "";

			// I_tahun1
			$master_siswa->I_tahun1->LinkCustomAttributes = "";
			$master_siswa->I_tahun1->HrefValue = "";
			$master_siswa->I_tahun1->TooltipValue = "";

			// I_tahun2
			$master_siswa->I_tahun2->LinkCustomAttributes = "";
			$master_siswa->I_tahun2->HrefValue = "";
			$master_siswa->I_tahun2->TooltipValue = "";

			// I_tahun3
			$master_siswa->I_tahun3->LinkCustomAttributes = "";
			$master_siswa->I_tahun3->HrefValue = "";
			$master_siswa->I_tahun3->TooltipValue = "";

			// I_tk1
			$master_siswa->I_tk1->LinkCustomAttributes = "";
			$master_siswa->I_tk1->HrefValue = "";
			$master_siswa->I_tk1->TooltipValue = "";

			// I_tk2
			$master_siswa->I_tk2->LinkCustomAttributes = "";
			$master_siswa->I_tk2->HrefValue = "";
			$master_siswa->I_tk2->TooltipValue = "";

			// I_tk3
			$master_siswa->I_tk3->LinkCustomAttributes = "";
			$master_siswa->I_tk3->HrefValue = "";
			$master_siswa->I_tk3->TooltipValue = "";

			// I_dari1
			$master_siswa->I_dari1->LinkCustomAttributes = "";
			$master_siswa->I_dari1->HrefValue = "";
			$master_siswa->I_dari1->TooltipValue = "";

			// I_dari2
			$master_siswa->I_dari2->LinkCustomAttributes = "";
			$master_siswa->I_dari2->HrefValue = "";
			$master_siswa->I_dari2->TooltipValue = "";

			// I_dari3
			$master_siswa->I_dari3->LinkCustomAttributes = "";
			$master_siswa->I_dari3->HrefValue = "";
			$master_siswa->I_dari3->TooltipValue = "";

			// J_melanjutkan
			$master_siswa->J_melanjutkan->LinkCustomAttributes = "";
			$master_siswa->J_melanjutkan->HrefValue = "";
			$master_siswa->J_melanjutkan->TooltipValue = "";

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->LinkCustomAttributes = "";
			$master_siswa->J_tanggal_bekerja->HrefValue = "";
			$master_siswa->J_tanggal_bekerja->TooltipValue = "";

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->LinkCustomAttributes = "";
			$master_siswa->J_nama_perusahaan->HrefValue = "";
			$master_siswa->J_nama_perusahaan->TooltipValue = "";

			// J_penghasilan
			$master_siswa->J_penghasilan->LinkCustomAttributes = "";
			$master_siswa->J_penghasilan->HrefValue = "";
			$master_siswa->J_penghasilan->TooltipValue = "";

			// kode_otomatis
			$master_siswa->kode_otomatis->LinkCustomAttributes = "";
			$master_siswa->kode_otomatis->HrefValue = "";
			$master_siswa->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$master_siswa->apakah_valid->LinkCustomAttributes = "";
			$master_siswa->apakah_valid->HrefValue = "";
			$master_siswa->apakah_valid->TooltipValue = "";
		} elseif ($master_siswa->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// no_absen
			$master_siswa->no_absen->EditCustomAttributes = "";
			$master_siswa->no_absen->EditValue = ew_HtmlEncode($master_siswa->no_absen->CurrentValue);

			// A_nis_nasional
			$master_siswa->A_nis_nasional->EditCustomAttributes = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->EditCustomAttributes = "";
			$master_siswa->A_nama_Lengkap->EditValue = ew_HtmlEncode($master_siswa->A_nama_Lengkap->CurrentValue);

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->EditCustomAttributes = "";
			$master_siswa->A_nama_panggilan->EditValue = ew_HtmlEncode($master_siswa->A_nama_panggilan->CurrentValue);

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->EditCustomAttributes = "";
			$master_siswa->A_jenis_kelamin->EditValue = ew_HtmlEncode($master_siswa->A_jenis_kelamin->CurrentValue);

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->A_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->A_tempat_lahir->CurrentValue);

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->A_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->A_tanggal_lahir->CurrentValue, 7));

			// A_agama
			$master_siswa->A_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->A_agama->EditValue = $arwrk;

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->A_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->A_kewarganegaraan->CurrentValue);

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->EditCustomAttributes = "";
			$master_siswa->A_anak_keberapa->EditValue = ew_HtmlEncode($master_siswa->A_anak_keberapa->CurrentValue);

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_kandung->EditValue = ew_HtmlEncode($master_siswa->A_jumlah_saudara_kandung->CurrentValue);

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_tiri->EditValue = ew_HtmlEncode($master_siswa->A_jumlah_saudara_tiri->CurrentValue);

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_angkat->EditValue = ew_HtmlEncode($master_siswa->A_jumlah_saudara_angkat->CurrentValue);

			// A_status_yatim
			$master_siswa->A_status_yatim->EditCustomAttributes = "";
			$master_siswa->A_status_yatim->EditValue = ew_HtmlEncode($master_siswa->A_status_yatim->CurrentValue);

			// A_bahasa
			$master_siswa->A_bahasa->EditCustomAttributes = "";
			$master_siswa->A_bahasa->EditValue = ew_HtmlEncode($master_siswa->A_bahasa->CurrentValue);

			// B_alamat
			$master_siswa->B_alamat->EditCustomAttributes = "";
			$master_siswa->B_alamat->EditValue = ew_HtmlEncode($master_siswa->B_alamat->CurrentValue);

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->EditCustomAttributes = "";
			$master_siswa->B_telepon_rumah->EditValue = ew_HtmlEncode($master_siswa->B_telepon_rumah->CurrentValue);

			// B_tinggal
			$master_siswa->B_tinggal->EditCustomAttributes = "";
			$master_siswa->B_tinggal->EditValue = ew_HtmlEncode($master_siswa->B_tinggal->CurrentValue);

			// B_jarak
			$master_siswa->B_jarak->EditCustomAttributes = "";
			$master_siswa->B_jarak->EditValue = ew_HtmlEncode($master_siswa->B_jarak->CurrentValue);

			// B_hp
			$master_siswa->B_hp->EditCustomAttributes = "";
			$master_siswa->B_hp->EditValue = ew_HtmlEncode($master_siswa->B_hp->CurrentValue);

			// C_golongan_darah
			$master_siswa->C_golongan_darah->EditCustomAttributes = "";
			$master_siswa->C_golongan_darah->EditValue = ew_HtmlEncode($master_siswa->C_golongan_darah->CurrentValue);

			// C_penyakit
			$master_siswa->C_penyakit->EditCustomAttributes = "";
			$master_siswa->C_penyakit->EditValue = ew_HtmlEncode($master_siswa->C_penyakit->CurrentValue);

			// C_jasmani
			$master_siswa->C_jasmani->EditCustomAttributes = "";
			$master_siswa->C_jasmani->EditValue = ew_HtmlEncode($master_siswa->C_jasmani->CurrentValue);

			// C_tinggi
			$master_siswa->C_tinggi->EditCustomAttributes = "";
			$master_siswa->C_tinggi->EditValue = ew_HtmlEncode($master_siswa->C_tinggi->CurrentValue);

			// C_berat
			$master_siswa->C_berat->EditCustomAttributes = "";
			$master_siswa->C_berat->EditValue = ew_HtmlEncode($master_siswa->C_berat->CurrentValue);

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->EditCustomAttributes = "";
			$master_siswa->D_tamatan_dari->EditValue = ew_HtmlEncode($master_siswa->D_tamatan_dari->CurrentValue);

			// D_sttb
			$master_siswa->D_sttb->EditCustomAttributes = "";
			$master_siswa->D_sttb->EditValue = ew_HtmlEncode($master_siswa->D_sttb->CurrentValue);

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->EditCustomAttributes = "";
			$master_siswa->D_tanggal_sttb->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->D_tanggal_sttb->CurrentValue, 7));

			// D_danum
			$master_siswa->D_danum->EditCustomAttributes = "";
			$master_siswa->D_danum->EditValue = ew_HtmlEncode($master_siswa->D_danum->CurrentValue);

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->EditCustomAttributes = "";
			$master_siswa->D_tanggal_danum->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->D_tanggal_danum->CurrentValue, 7));

			// D_lama_belajar
			$master_siswa->D_lama_belajar->EditCustomAttributes = "";
			$master_siswa->D_lama_belajar->EditValue = ew_HtmlEncode($master_siswa->D_lama_belajar->CurrentValue);

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->EditCustomAttributes = "";
			$master_siswa->D_dari_sekolah->EditValue = ew_HtmlEncode($master_siswa->D_dari_sekolah->CurrentValue);

			// D_alasan
			$master_siswa->D_alasan->EditCustomAttributes = "";
			$master_siswa->D_alasan->EditValue = ew_HtmlEncode($master_siswa->D_alasan->CurrentValue);

			// D_kelas
			$master_siswa->D_kelas->EditCustomAttributes = "";
			$master_siswa->D_kelas->EditValue = ew_HtmlEncode($master_siswa->D_kelas->CurrentValue);

			// D_kelompok
			$master_siswa->D_kelompok->EditCustomAttributes = "";
			$master_siswa->D_kelompok->EditValue = ew_HtmlEncode($master_siswa->D_kelompok->CurrentValue);

			// D_tanggal
			$master_siswa->D_tanggal->EditCustomAttributes = "";
			$master_siswa->D_tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->D_tanggal->CurrentValue, 7));

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->EditCustomAttributes = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_kelas->EditValue = ew_HtmlEncode($master_siswa->D_saat_ini_kelas->CurrentValue);

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_kelompok->EditValue = ew_HtmlEncode($master_siswa->D_saat_ini_kelompok->CurrentValue);

			// D_no_psb
			$master_siswa->D_no_psb->EditCustomAttributes = "";
			$master_siswa->D_no_psb->EditValue = ew_HtmlEncode($master_siswa->D_no_psb->CurrentValue);

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->EditCustomAttributes = "";
			$master_siswa->D_nilai_danum_sd->EditValue = ew_HtmlEncode($master_siswa->D_nilai_danum_sd->CurrentValue);

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->EditCustomAttributes = "";
			$master_siswa->D_jumlah_pelajaran_danum->EditValue = ew_HtmlEncode($master_siswa->D_jumlah_pelajaran_danum->CurrentValue);

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->EditCustomAttributes = "";
			$master_siswa->D_nilai_ujian_psb->EditValue = ew_HtmlEncode($master_siswa->D_nilai_ujian_psb->CurrentValue);

			// D_tahun_psb
			$master_siswa->D_tahun_psb->EditCustomAttributes = "";
			$master_siswa->D_tahun_psb->EditValue = ew_HtmlEncode($master_siswa->D_tahun_psb->CurrentValue);

			// D_diterima
			$master_siswa->D_diterima->EditCustomAttributes = "";
			$master_siswa->D_diterima->EditValue = ew_HtmlEncode($master_siswa->D_diterima->CurrentValue);

			// D_spp
			$master_siswa->D_spp->EditCustomAttributes = "";
			$master_siswa->D_spp->EditValue = ew_HtmlEncode($master_siswa->D_spp->CurrentValue);

			// D_spp_potongan
			$master_siswa->D_spp_potongan->EditCustomAttributes = "";
			$master_siswa->D_spp_potongan->EditValue = ew_HtmlEncode($master_siswa->D_spp_potongan->CurrentValue);

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->EditCustomAttributes = "";
			$master_siswa->D_status_lama_baru->EditValue = ew_HtmlEncode($master_siswa->D_status_lama_baru->CurrentValue);

			// E_nama_ayah
			$master_siswa->E_nama_ayah->EditCustomAttributes = "";
			$master_siswa->E_nama_ayah->EditValue = ew_HtmlEncode($master_siswa->E_nama_ayah->CurrentValue);

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->E_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->E_tempat_lahir->CurrentValue);

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->E_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->E_tanggal_lahir->CurrentValue, 7));

			// E_agama
			$master_siswa->E_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->E_agama->EditValue = $arwrk;

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->E_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->E_kewarganegaraan->CurrentValue);

			// E_pendidikan
			$master_siswa->E_pendidikan->EditCustomAttributes = "";
			$master_siswa->E_pendidikan->EditValue = ew_HtmlEncode($master_siswa->E_pendidikan->CurrentValue);

			// E_pekerjaan
			$master_siswa->E_pekerjaan->EditCustomAttributes = "";
			$master_siswa->E_pekerjaan->EditValue = ew_HtmlEncode($master_siswa->E_pekerjaan->CurrentValue);

			// E_pengeluaran
			$master_siswa->E_pengeluaran->EditCustomAttributes = "";
			$master_siswa->E_pengeluaran->EditValue = ew_HtmlEncode($master_siswa->E_pengeluaran->CurrentValue);

			// E_alamat
			$master_siswa->E_alamat->EditCustomAttributes = "";
			$master_siswa->E_alamat->EditValue = ew_HtmlEncode($master_siswa->E_alamat->CurrentValue);

			// E_telepon
			$master_siswa->E_telepon->EditCustomAttributes = "";
			$master_siswa->E_telepon->EditValue = ew_HtmlEncode($master_siswa->E_telepon->CurrentValue);

			// E_hp
			$master_siswa->E_hp->EditCustomAttributes = "";
			$master_siswa->E_hp->EditValue = ew_HtmlEncode($master_siswa->E_hp->CurrentValue);

			// E_hidup
			$master_siswa->E_hidup->EditCustomAttributes = "";
			$master_siswa->E_hidup->EditValue = ew_HtmlEncode($master_siswa->E_hidup->CurrentValue);

			// F_nama_ibu
			$master_siswa->F_nama_ibu->EditCustomAttributes = "";
			$master_siswa->F_nama_ibu->EditValue = ew_HtmlEncode($master_siswa->F_nama_ibu->CurrentValue);

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->F_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->F_tempat_lahir->CurrentValue);

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->F_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->F_tanggal_lahir->CurrentValue, 7));

			// F_agama
			$master_siswa->F_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->F_agama->EditValue = $arwrk;

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->F_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->F_kewarganegaraan->CurrentValue);

			// F_pendidikan
			$master_siswa->F_pendidikan->EditCustomAttributes = "";
			$master_siswa->F_pendidikan->EditValue = ew_HtmlEncode($master_siswa->F_pendidikan->CurrentValue);

			// F_pekerjaan
			$master_siswa->F_pekerjaan->EditCustomAttributes = "";
			$master_siswa->F_pekerjaan->EditValue = ew_HtmlEncode($master_siswa->F_pekerjaan->CurrentValue);

			// F_pengeluaran
			$master_siswa->F_pengeluaran->EditCustomAttributes = "";
			$master_siswa->F_pengeluaran->EditValue = ew_HtmlEncode($master_siswa->F_pengeluaran->CurrentValue);

			// F_alamat
			$master_siswa->F_alamat->EditCustomAttributes = "";
			$master_siswa->F_alamat->EditValue = ew_HtmlEncode($master_siswa->F_alamat->CurrentValue);

			// F_telepon
			$master_siswa->F_telepon->EditCustomAttributes = "";
			$master_siswa->F_telepon->EditValue = ew_HtmlEncode($master_siswa->F_telepon->CurrentValue);

			// F_hp
			$master_siswa->F_hp->EditCustomAttributes = "";
			$master_siswa->F_hp->EditValue = ew_HtmlEncode($master_siswa->F_hp->CurrentValue);

			// F_hidup
			$master_siswa->F_hidup->EditCustomAttributes = "";
			$master_siswa->F_hidup->EditValue = ew_HtmlEncode($master_siswa->F_hidup->CurrentValue);

			// G_nama_wali
			$master_siswa->G_nama_wali->EditCustomAttributes = "";
			$master_siswa->G_nama_wali->EditValue = ew_HtmlEncode($master_siswa->G_nama_wali->CurrentValue);

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->G_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->G_tempat_lahir->CurrentValue);

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->G_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->G_tanggal_lahir->CurrentValue, 7));

			// G_agama
			$master_siswa->G_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->G_agama->EditValue = $arwrk;

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->G_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->G_kewarganegaraan->CurrentValue);

			// G_pendidikan
			$master_siswa->G_pendidikan->EditCustomAttributes = "";
			$master_siswa->G_pendidikan->EditValue = ew_HtmlEncode($master_siswa->G_pendidikan->CurrentValue);

			// G_pekerjaan
			$master_siswa->G_pekerjaan->EditCustomAttributes = "";
			$master_siswa->G_pekerjaan->EditValue = ew_HtmlEncode($master_siswa->G_pekerjaan->CurrentValue);

			// G_pengeluaran
			$master_siswa->G_pengeluaran->EditCustomAttributes = "";
			$master_siswa->G_pengeluaran->EditValue = ew_HtmlEncode($master_siswa->G_pengeluaran->CurrentValue);

			// G_alamat
			$master_siswa->G_alamat->EditCustomAttributes = "";
			$master_siswa->G_alamat->EditValue = ew_HtmlEncode($master_siswa->G_alamat->CurrentValue);

			// G_telepon
			$master_siswa->G_telepon->EditCustomAttributes = "";
			$master_siswa->G_telepon->EditValue = ew_HtmlEncode($master_siswa->G_telepon->CurrentValue);

			// G_hp
			$master_siswa->G_hp->EditCustomAttributes = "";
			$master_siswa->G_hp->EditValue = ew_HtmlEncode($master_siswa->G_hp->CurrentValue);

			// H_kesenian
			$master_siswa->H_kesenian->EditCustomAttributes = "";
			$master_siswa->H_kesenian->EditValue = ew_HtmlEncode($master_siswa->H_kesenian->CurrentValue);

			// H_olahraga
			$master_siswa->H_olahraga->EditCustomAttributes = "";
			$master_siswa->H_olahraga->EditValue = ew_HtmlEncode($master_siswa->H_olahraga->CurrentValue);

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->EditCustomAttributes = "";
			$master_siswa->H_kemasyarakatan->EditValue = ew_HtmlEncode($master_siswa->H_kemasyarakatan->CurrentValue);

			// H_lainlain
			$master_siswa->H_lainlain->EditCustomAttributes = "";
			$master_siswa->H_lainlain->EditValue = ew_HtmlEncode($master_siswa->H_lainlain->CurrentValue);

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->EditCustomAttributes = "";
			$master_siswa->I_tanggal_meninggalkan->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->I_tanggal_meninggalkan->CurrentValue, 7));

			// I_alasan
			$master_siswa->I_alasan->EditCustomAttributes = "";
			$master_siswa->I_alasan->EditValue = ew_HtmlEncode($master_siswa->I_alasan->CurrentValue);

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->EditCustomAttributes = "";
			$master_siswa->I_tanggal_lulus->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->I_tanggal_lulus->CurrentValue, 7));

			// I_sttb
			$master_siswa->I_sttb->EditCustomAttributes = "";
			$master_siswa->I_sttb->EditValue = ew_HtmlEncode($master_siswa->I_sttb->CurrentValue);

			// I_danum
			$master_siswa->I_danum->EditCustomAttributes = "";
			$master_siswa->I_danum->EditValue = ew_HtmlEncode($master_siswa->I_danum->CurrentValue);

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->EditCustomAttributes = "";
			$master_siswa->I_nilai_danum_smp->EditValue = ew_HtmlEncode($master_siswa->I_nilai_danum_smp->CurrentValue);

			// I_tahun1
			$master_siswa->I_tahun1->EditCustomAttributes = "";
			$master_siswa->I_tahun1->EditValue = ew_HtmlEncode($master_siswa->I_tahun1->CurrentValue);

			// I_tahun2
			$master_siswa->I_tahun2->EditCustomAttributes = "";
			$master_siswa->I_tahun2->EditValue = ew_HtmlEncode($master_siswa->I_tahun2->CurrentValue);

			// I_tahun3
			$master_siswa->I_tahun3->EditCustomAttributes = "";
			$master_siswa->I_tahun3->EditValue = ew_HtmlEncode($master_siswa->I_tahun3->CurrentValue);

			// I_tk1
			$master_siswa->I_tk1->EditCustomAttributes = "";
			$master_siswa->I_tk1->EditValue = ew_HtmlEncode($master_siswa->I_tk1->CurrentValue);

			// I_tk2
			$master_siswa->I_tk2->EditCustomAttributes = "";
			$master_siswa->I_tk2->EditValue = ew_HtmlEncode($master_siswa->I_tk2->CurrentValue);

			// I_tk3
			$master_siswa->I_tk3->EditCustomAttributes = "";
			$master_siswa->I_tk3->EditValue = ew_HtmlEncode($master_siswa->I_tk3->CurrentValue);

			// I_dari1
			$master_siswa->I_dari1->EditCustomAttributes = "";
			$master_siswa->I_dari1->EditValue = ew_HtmlEncode($master_siswa->I_dari1->CurrentValue);

			// I_dari2
			$master_siswa->I_dari2->EditCustomAttributes = "";
			$master_siswa->I_dari2->EditValue = ew_HtmlEncode($master_siswa->I_dari2->CurrentValue);

			// I_dari3
			$master_siswa->I_dari3->EditCustomAttributes = "";
			$master_siswa->I_dari3->EditValue = ew_HtmlEncode($master_siswa->I_dari3->CurrentValue);

			// J_melanjutkan
			$master_siswa->J_melanjutkan->EditCustomAttributes = "";
			$master_siswa->J_melanjutkan->EditValue = ew_HtmlEncode($master_siswa->J_melanjutkan->CurrentValue);

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->EditCustomAttributes = "";
			$master_siswa->J_tanggal_bekerja->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_siswa->J_tanggal_bekerja->CurrentValue, 7));

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->EditCustomAttributes = "";
			$master_siswa->J_nama_perusahaan->EditValue = ew_HtmlEncode($master_siswa->J_nama_perusahaan->CurrentValue);

			// J_penghasilan
			$master_siswa->J_penghasilan->EditCustomAttributes = "";
			$master_siswa->J_penghasilan->EditValue = ew_HtmlEncode($master_siswa->J_penghasilan->CurrentValue);

			// kode_otomatis
			$master_siswa->kode_otomatis->EditCustomAttributes = "";

			// apakah_valid
			$master_siswa->apakah_valid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $master_siswa->apakah_valid->FldTagCaption(1) <> "" ? $master_siswa->apakah_valid->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $master_siswa->apakah_valid->FldTagCaption(2) <> "" ? $master_siswa->apakah_valid->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->apakah_valid->EditValue = $arwrk;

			// Edit refer script
			// no_absen

			$master_siswa->no_absen->HrefValue = "";

			// A_nis_nasional
			$master_siswa->A_nis_nasional->HrefValue = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->HrefValue = "";

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->HrefValue = "";

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->HrefValue = "";

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->HrefValue = "";

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->HrefValue = "";

			// A_agama
			$master_siswa->A_agama->HrefValue = "";

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->HrefValue = "";

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->HrefValue = "";

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->HrefValue = "";

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->HrefValue = "";

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->HrefValue = "";

			// A_status_yatim
			$master_siswa->A_status_yatim->HrefValue = "";

			// A_bahasa
			$master_siswa->A_bahasa->HrefValue = "";

			// B_alamat
			$master_siswa->B_alamat->HrefValue = "";

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->HrefValue = "";

			// B_tinggal
			$master_siswa->B_tinggal->HrefValue = "";

			// B_jarak
			$master_siswa->B_jarak->HrefValue = "";

			// B_hp
			$master_siswa->B_hp->HrefValue = "";

			// C_golongan_darah
			$master_siswa->C_golongan_darah->HrefValue = "";

			// C_penyakit
			$master_siswa->C_penyakit->HrefValue = "";

			// C_jasmani
			$master_siswa->C_jasmani->HrefValue = "";

			// C_tinggi
			$master_siswa->C_tinggi->HrefValue = "";

			// C_berat
			$master_siswa->C_berat->HrefValue = "";

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->HrefValue = "";

			// D_sttb
			$master_siswa->D_sttb->HrefValue = "";

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->HrefValue = "";

			// D_danum
			$master_siswa->D_danum->HrefValue = "";

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->HrefValue = "";

			// D_lama_belajar
			$master_siswa->D_lama_belajar->HrefValue = "";

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->HrefValue = "";

			// D_alasan
			$master_siswa->D_alasan->HrefValue = "";

			// D_kelas
			$master_siswa->D_kelas->HrefValue = "";

			// D_kelompok
			$master_siswa->D_kelompok->HrefValue = "";

			// D_tanggal
			$master_siswa->D_tanggal->HrefValue = "";

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->HrefValue = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->HrefValue = "";

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->HrefValue = "";

			// D_no_psb
			$master_siswa->D_no_psb->HrefValue = "";

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->HrefValue = "";

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->HrefValue = "";

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->HrefValue = "";

			// D_tahun_psb
			$master_siswa->D_tahun_psb->HrefValue = "";

			// D_diterima
			$master_siswa->D_diterima->HrefValue = "";

			// D_spp
			$master_siswa->D_spp->HrefValue = "";

			// D_spp_potongan
			$master_siswa->D_spp_potongan->HrefValue = "";

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->HrefValue = "";

			// E_nama_ayah
			$master_siswa->E_nama_ayah->HrefValue = "";

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->HrefValue = "";

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->HrefValue = "";

			// E_agama
			$master_siswa->E_agama->HrefValue = "";

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->HrefValue = "";

			// E_pendidikan
			$master_siswa->E_pendidikan->HrefValue = "";

			// E_pekerjaan
			$master_siswa->E_pekerjaan->HrefValue = "";

			// E_pengeluaran
			$master_siswa->E_pengeluaran->HrefValue = "";

			// E_alamat
			$master_siswa->E_alamat->HrefValue = "";

			// E_telepon
			$master_siswa->E_telepon->HrefValue = "";

			// E_hp
			$master_siswa->E_hp->HrefValue = "";

			// E_hidup
			$master_siswa->E_hidup->HrefValue = "";

			// F_nama_ibu
			$master_siswa->F_nama_ibu->HrefValue = "";

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->HrefValue = "";

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->HrefValue = "";

			// F_agama
			$master_siswa->F_agama->HrefValue = "";

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->HrefValue = "";

			// F_pendidikan
			$master_siswa->F_pendidikan->HrefValue = "";

			// F_pekerjaan
			$master_siswa->F_pekerjaan->HrefValue = "";

			// F_pengeluaran
			$master_siswa->F_pengeluaran->HrefValue = "";

			// F_alamat
			$master_siswa->F_alamat->HrefValue = "";

			// F_telepon
			$master_siswa->F_telepon->HrefValue = "";

			// F_hp
			$master_siswa->F_hp->HrefValue = "";

			// F_hidup
			$master_siswa->F_hidup->HrefValue = "";

			// G_nama_wali
			$master_siswa->G_nama_wali->HrefValue = "";

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->HrefValue = "";

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->HrefValue = "";

			// G_agama
			$master_siswa->G_agama->HrefValue = "";

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->HrefValue = "";

			// G_pendidikan
			$master_siswa->G_pendidikan->HrefValue = "";

			// G_pekerjaan
			$master_siswa->G_pekerjaan->HrefValue = "";

			// G_pengeluaran
			$master_siswa->G_pengeluaran->HrefValue = "";

			// G_alamat
			$master_siswa->G_alamat->HrefValue = "";

			// G_telepon
			$master_siswa->G_telepon->HrefValue = "";

			// G_hp
			$master_siswa->G_hp->HrefValue = "";

			// H_kesenian
			$master_siswa->H_kesenian->HrefValue = "";

			// H_olahraga
			$master_siswa->H_olahraga->HrefValue = "";

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->HrefValue = "";

			// H_lainlain
			$master_siswa->H_lainlain->HrefValue = "";

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->HrefValue = "";

			// I_alasan
			$master_siswa->I_alasan->HrefValue = "";

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->HrefValue = "";

			// I_sttb
			$master_siswa->I_sttb->HrefValue = "";

			// I_danum
			$master_siswa->I_danum->HrefValue = "";

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->HrefValue = "";

			// I_tahun1
			$master_siswa->I_tahun1->HrefValue = "";

			// I_tahun2
			$master_siswa->I_tahun2->HrefValue = "";

			// I_tahun3
			$master_siswa->I_tahun3->HrefValue = "";

			// I_tk1
			$master_siswa->I_tk1->HrefValue = "";

			// I_tk2
			$master_siswa->I_tk2->HrefValue = "";

			// I_tk3
			$master_siswa->I_tk3->HrefValue = "";

			// I_dari1
			$master_siswa->I_dari1->HrefValue = "";

			// I_dari2
			$master_siswa->I_dari2->HrefValue = "";

			// I_dari3
			$master_siswa->I_dari3->HrefValue = "";

			// J_melanjutkan
			$master_siswa->J_melanjutkan->HrefValue = "";

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->HrefValue = "";

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->HrefValue = "";

			// J_penghasilan
			$master_siswa->J_penghasilan->HrefValue = "";

			// kode_otomatis
			$master_siswa->kode_otomatis->HrefValue = "";

			// apakah_valid
			$master_siswa->apakah_valid->HrefValue = "";
		}
		if ($master_siswa->RowType == EW_ROWTYPE_ADD ||
			$master_siswa->RowType == EW_ROWTYPE_EDIT ||
			$master_siswa->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$master_siswa->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($master_siswa->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_siswa->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $master_siswa;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($master_siswa->no_absen->FormValue) && $master_siswa->no_absen->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->no_absen->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->no_absen->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->no_absen->FldErrMsg());
		}
		if (!is_null($master_siswa->A_nama_Lengkap->FormValue) && $master_siswa->A_nama_Lengkap->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_nama_Lengkap->FldCaption());
		}
		if (!is_null($master_siswa->A_nama_panggilan->FormValue) && $master_siswa->A_nama_panggilan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_nama_panggilan->FldCaption());
		}
		if (!is_null($master_siswa->A_jenis_kelamin->FormValue) && $master_siswa->A_jenis_kelamin->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_jenis_kelamin->FldCaption());
		}
		if (!is_null($master_siswa->A_tempat_lahir->FormValue) && $master_siswa->A_tempat_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_tempat_lahir->FldCaption());
		}
		if (!is_null($master_siswa->A_tanggal_lahir->FormValue) && $master_siswa->A_tanggal_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_tanggal_lahir->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->A_tanggal_lahir->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->A_tanggal_lahir->FldErrMsg());
		}
		if (!is_null($master_siswa->A_agama->FormValue) && $master_siswa->A_agama->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_agama->FldCaption());
		}
		if (!is_null($master_siswa->A_kewarganegaraan->FormValue) && $master_siswa->A_kewarganegaraan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_kewarganegaraan->FldCaption());
		}
		if (!is_null($master_siswa->A_anak_keberapa->FormValue) && $master_siswa->A_anak_keberapa->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_anak_keberapa->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->A_anak_keberapa->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->A_anak_keberapa->FldErrMsg());
		}
		if (!is_null($master_siswa->A_jumlah_saudara_kandung->FormValue) && $master_siswa->A_jumlah_saudara_kandung->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_jumlah_saudara_kandung->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_kandung->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->A_jumlah_saudara_kandung->FldErrMsg());
		}
		if (!is_null($master_siswa->A_jumlah_saudara_tiri->FormValue) && $master_siswa->A_jumlah_saudara_tiri->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_jumlah_saudara_tiri->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_tiri->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->A_jumlah_saudara_tiri->FldErrMsg());
		}
		if (!is_null($master_siswa->A_jumlah_saudara_angkat->FormValue) && $master_siswa->A_jumlah_saudara_angkat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_jumlah_saudara_angkat->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_angkat->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->A_jumlah_saudara_angkat->FldErrMsg());
		}
		if (!is_null($master_siswa->A_status_yatim->FormValue) && $master_siswa->A_status_yatim->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_status_yatim->FldCaption());
		}
		if (!is_null($master_siswa->A_bahasa->FormValue) && $master_siswa->A_bahasa->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->A_bahasa->FldCaption());
		}
		if (!is_null($master_siswa->B_alamat->FormValue) && $master_siswa->B_alamat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->B_alamat->FldCaption());
		}
		if (!is_null($master_siswa->B_telepon_rumah->FormValue) && $master_siswa->B_telepon_rumah->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->B_telepon_rumah->FldCaption());
		}
		if (!is_null($master_siswa->B_tinggal->FormValue) && $master_siswa->B_tinggal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->B_tinggal->FldCaption());
		}
		if (!is_null($master_siswa->B_jarak->FormValue) && $master_siswa->B_jarak->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->B_jarak->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->B_jarak->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->B_jarak->FldErrMsg());
		}
		if (!is_null($master_siswa->B_hp->FormValue) && $master_siswa->B_hp->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->B_hp->FldCaption());
		}
		if (!is_null($master_siswa->C_golongan_darah->FormValue) && $master_siswa->C_golongan_darah->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->C_golongan_darah->FldCaption());
		}
		if (!is_null($master_siswa->C_penyakit->FormValue) && $master_siswa->C_penyakit->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->C_penyakit->FldCaption());
		}
		if (!is_null($master_siswa->C_jasmani->FormValue) && $master_siswa->C_jasmani->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->C_jasmani->FldCaption());
		}
		if (!is_null($master_siswa->C_tinggi->FormValue) && $master_siswa->C_tinggi->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->C_tinggi->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->C_tinggi->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->C_tinggi->FldErrMsg());
		}
		if (!is_null($master_siswa->C_berat->FormValue) && $master_siswa->C_berat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->C_berat->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->C_berat->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->C_berat->FldErrMsg());
		}
		if (!is_null($master_siswa->D_tamatan_dari->FormValue) && $master_siswa->D_tamatan_dari->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_tamatan_dari->FldCaption());
		}
		if (!is_null($master_siswa->D_sttb->FormValue) && $master_siswa->D_sttb->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_sttb->FldCaption());
		}
		if (!is_null($master_siswa->D_tanggal_sttb->FormValue) && $master_siswa->D_tanggal_sttb->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_tanggal_sttb->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal_sttb->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_tanggal_sttb->FldErrMsg());
		}
		if (!is_null($master_siswa->D_danum->FormValue) && $master_siswa->D_danum->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_danum->FldCaption());
		}
		if (!is_null($master_siswa->D_tanggal_danum->FormValue) && $master_siswa->D_tanggal_danum->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_tanggal_danum->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal_danum->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_tanggal_danum->FldErrMsg());
		}
		if (!is_null($master_siswa->D_lama_belajar->FormValue) && $master_siswa->D_lama_belajar->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_lama_belajar->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->D_lama_belajar->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_lama_belajar->FldErrMsg());
		}
		if (!is_null($master_siswa->D_dari_sekolah->FormValue) && $master_siswa->D_dari_sekolah->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_dari_sekolah->FldCaption());
		}
		if (!is_null($master_siswa->D_alasan->FormValue) && $master_siswa->D_alasan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_alasan->FldCaption());
		}
		if (!is_null($master_siswa->D_kelas->FormValue) && $master_siswa->D_kelas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_kelas->FldCaption());
		}
		if (!is_null($master_siswa->D_kelompok->FormValue) && $master_siswa->D_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_kelompok->FldCaption());
		}
		if (!is_null($master_siswa->D_tanggal->FormValue) && $master_siswa->D_tanggal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_tanggal->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_tanggal->FldErrMsg());
		}
		if (!is_null($master_siswa->D_saat_ini_kelas->FormValue) && $master_siswa->D_saat_ini_kelas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_saat_ini_kelas->FldCaption());
		}
		if (!is_null($master_siswa->D_saat_ini_kelompok->FormValue) && $master_siswa->D_saat_ini_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_saat_ini_kelompok->FldCaption());
		}
		if (!is_null($master_siswa->D_no_psb->FormValue) && $master_siswa->D_no_psb->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_no_psb->FldCaption());
		}
		if (!is_null($master_siswa->D_nilai_danum_sd->FormValue) && $master_siswa->D_nilai_danum_sd->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_nilai_danum_sd->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->D_nilai_danum_sd->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_nilai_danum_sd->FldErrMsg());
		}
		if (!is_null($master_siswa->D_jumlah_pelajaran_danum->FormValue) && $master_siswa->D_jumlah_pelajaran_danum->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_jumlah_pelajaran_danum->FldCaption());
		}
		if (!ew_CheckInteger($master_siswa->D_jumlah_pelajaran_danum->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_jumlah_pelajaran_danum->FldErrMsg());
		}
		if (!is_null($master_siswa->D_nilai_ujian_psb->FormValue) && $master_siswa->D_nilai_ujian_psb->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_nilai_ujian_psb->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->D_nilai_ujian_psb->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_nilai_ujian_psb->FldErrMsg());
		}
		if (!is_null($master_siswa->D_tahun_psb->FormValue) && $master_siswa->D_tahun_psb->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_tahun_psb->FldCaption());
		}
		if (!is_null($master_siswa->D_diterima->FormValue) && $master_siswa->D_diterima->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_diterima->FldCaption());
		}
		if (!is_null($master_siswa->D_spp->FormValue) && $master_siswa->D_spp->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_spp->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->D_spp->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_spp->FldErrMsg());
		}
		if (!is_null($master_siswa->D_spp_potongan->FormValue) && $master_siswa->D_spp_potongan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_spp_potongan->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->D_spp_potongan->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->D_spp_potongan->FldErrMsg());
		}
		if (!is_null($master_siswa->D_status_lama_baru->FormValue) && $master_siswa->D_status_lama_baru->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->D_status_lama_baru->FldCaption());
		}
		if (!is_null($master_siswa->E_nama_ayah->FormValue) && $master_siswa->E_nama_ayah->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_nama_ayah->FldCaption());
		}
		if (!is_null($master_siswa->E_tempat_lahir->FormValue) && $master_siswa->E_tempat_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_tempat_lahir->FldCaption());
		}
		if (!is_null($master_siswa->E_tanggal_lahir->FormValue) && $master_siswa->E_tanggal_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_tanggal_lahir->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->E_tanggal_lahir->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->E_tanggal_lahir->FldErrMsg());
		}
		if (!is_null($master_siswa->E_agama->FormValue) && $master_siswa->E_agama->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_agama->FldCaption());
		}
		if (!is_null($master_siswa->E_kewarganegaraan->FormValue) && $master_siswa->E_kewarganegaraan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_kewarganegaraan->FldCaption());
		}
		if (!is_null($master_siswa->E_pendidikan->FormValue) && $master_siswa->E_pendidikan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_pendidikan->FldCaption());
		}
		if (!is_null($master_siswa->E_pekerjaan->FormValue) && $master_siswa->E_pekerjaan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_pekerjaan->FldCaption());
		}
		if (!is_null($master_siswa->E_pengeluaran->FormValue) && $master_siswa->E_pengeluaran->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_pengeluaran->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->E_pengeluaran->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->E_pengeluaran->FldErrMsg());
		}
		if (!is_null($master_siswa->E_alamat->FormValue) && $master_siswa->E_alamat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_alamat->FldCaption());
		}
		if (!is_null($master_siswa->E_telepon->FormValue) && $master_siswa->E_telepon->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_telepon->FldCaption());
		}
		if (!is_null($master_siswa->E_hp->FormValue) && $master_siswa->E_hp->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_hp->FldCaption());
		}
		if (!is_null($master_siswa->E_hidup->FormValue) && $master_siswa->E_hidup->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->E_hidup->FldCaption());
		}
		if (!is_null($master_siswa->F_nama_ibu->FormValue) && $master_siswa->F_nama_ibu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_nama_ibu->FldCaption());
		}
		if (!is_null($master_siswa->F_tempat_lahir->FormValue) && $master_siswa->F_tempat_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_tempat_lahir->FldCaption());
		}
		if (!is_null($master_siswa->F_tanggal_lahir->FormValue) && $master_siswa->F_tanggal_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_tanggal_lahir->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->F_tanggal_lahir->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->F_tanggal_lahir->FldErrMsg());
		}
		if (!is_null($master_siswa->F_agama->FormValue) && $master_siswa->F_agama->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_agama->FldCaption());
		}
		if (!is_null($master_siswa->F_kewarganegaraan->FormValue) && $master_siswa->F_kewarganegaraan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_kewarganegaraan->FldCaption());
		}
		if (!is_null($master_siswa->F_pendidikan->FormValue) && $master_siswa->F_pendidikan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_pendidikan->FldCaption());
		}
		if (!is_null($master_siswa->F_pekerjaan->FormValue) && $master_siswa->F_pekerjaan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_pekerjaan->FldCaption());
		}
		if (!is_null($master_siswa->F_pengeluaran->FormValue) && $master_siswa->F_pengeluaran->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_pengeluaran->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->F_pengeluaran->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->F_pengeluaran->FldErrMsg());
		}
		if (!is_null($master_siswa->F_alamat->FormValue) && $master_siswa->F_alamat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_alamat->FldCaption());
		}
		if (!is_null($master_siswa->F_telepon->FormValue) && $master_siswa->F_telepon->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_telepon->FldCaption());
		}
		if (!is_null($master_siswa->F_hp->FormValue) && $master_siswa->F_hp->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_hp->FldCaption());
		}
		if (!is_null($master_siswa->F_hidup->FormValue) && $master_siswa->F_hidup->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->F_hidup->FldCaption());
		}
		if (!is_null($master_siswa->G_nama_wali->FormValue) && $master_siswa->G_nama_wali->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_nama_wali->FldCaption());
		}
		if (!is_null($master_siswa->G_tempat_lahir->FormValue) && $master_siswa->G_tempat_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_tempat_lahir->FldCaption());
		}
		if (!is_null($master_siswa->G_tanggal_lahir->FormValue) && $master_siswa->G_tanggal_lahir->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_tanggal_lahir->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->G_tanggal_lahir->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->G_tanggal_lahir->FldErrMsg());
		}
		if (!is_null($master_siswa->G_agama->FormValue) && $master_siswa->G_agama->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_agama->FldCaption());
		}
		if (!is_null($master_siswa->G_kewarganegaraan->FormValue) && $master_siswa->G_kewarganegaraan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_kewarganegaraan->FldCaption());
		}
		if (!is_null($master_siswa->G_pendidikan->FormValue) && $master_siswa->G_pendidikan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_pendidikan->FldCaption());
		}
		if (!is_null($master_siswa->G_pekerjaan->FormValue) && $master_siswa->G_pekerjaan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_pekerjaan->FldCaption());
		}
		if (!is_null($master_siswa->G_pengeluaran->FormValue) && $master_siswa->G_pengeluaran->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_pengeluaran->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->G_pengeluaran->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->G_pengeluaran->FldErrMsg());
		}
		if (!is_null($master_siswa->G_alamat->FormValue) && $master_siswa->G_alamat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_alamat->FldCaption());
		}
		if (!is_null($master_siswa->G_telepon->FormValue) && $master_siswa->G_telepon->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_telepon->FldCaption());
		}
		if (!is_null($master_siswa->G_hp->FormValue) && $master_siswa->G_hp->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->G_hp->FldCaption());
		}
		if (!is_null($master_siswa->H_kesenian->FormValue) && $master_siswa->H_kesenian->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->H_kesenian->FldCaption());
		}
		if (!is_null($master_siswa->H_olahraga->FormValue) && $master_siswa->H_olahraga->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->H_olahraga->FldCaption());
		}
		if (!is_null($master_siswa->H_kemasyarakatan->FormValue) && $master_siswa->H_kemasyarakatan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->H_kemasyarakatan->FldCaption());
		}
		if (!is_null($master_siswa->H_lainlain->FormValue) && $master_siswa->H_lainlain->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->H_lainlain->FldCaption());
		}
		if (!is_null($master_siswa->I_tanggal_meninggalkan->FormValue) && $master_siswa->I_tanggal_meninggalkan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tanggal_meninggalkan->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->I_tanggal_meninggalkan->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->I_tanggal_meninggalkan->FldErrMsg());
		}
		if (!is_null($master_siswa->I_alasan->FormValue) && $master_siswa->I_alasan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_alasan->FldCaption());
		}
		if (!is_null($master_siswa->I_tanggal_lulus->FormValue) && $master_siswa->I_tanggal_lulus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tanggal_lulus->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->I_tanggal_lulus->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->I_tanggal_lulus->FldErrMsg());
		}
		if (!is_null($master_siswa->I_sttb->FormValue) && $master_siswa->I_sttb->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_sttb->FldCaption());
		}
		if (!is_null($master_siswa->I_danum->FormValue) && $master_siswa->I_danum->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_danum->FldCaption());
		}
		if (!is_null($master_siswa->I_nilai_danum_smp->FormValue) && $master_siswa->I_nilai_danum_smp->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_nilai_danum_smp->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->I_nilai_danum_smp->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->I_nilai_danum_smp->FldErrMsg());
		}
		if (!is_null($master_siswa->I_tahun1->FormValue) && $master_siswa->I_tahun1->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tahun1->FldCaption());
		}
		if (!is_null($master_siswa->I_tahun2->FormValue) && $master_siswa->I_tahun2->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tahun2->FldCaption());
		}
		if (!is_null($master_siswa->I_tahun3->FormValue) && $master_siswa->I_tahun3->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tahun3->FldCaption());
		}
		if (!is_null($master_siswa->I_tk1->FormValue) && $master_siswa->I_tk1->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tk1->FldCaption());
		}
		if (!is_null($master_siswa->I_tk2->FormValue) && $master_siswa->I_tk2->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tk2->FldCaption());
		}
		if (!is_null($master_siswa->I_tk3->FormValue) && $master_siswa->I_tk3->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_tk3->FldCaption());
		}
		if (!is_null($master_siswa->I_dari1->FormValue) && $master_siswa->I_dari1->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_dari1->FldCaption());
		}
		if (!is_null($master_siswa->I_dari2->FormValue) && $master_siswa->I_dari2->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_dari2->FldCaption());
		}
		if (!is_null($master_siswa->I_dari3->FormValue) && $master_siswa->I_dari3->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->I_dari3->FldCaption());
		}
		if (!is_null($master_siswa->J_melanjutkan->FormValue) && $master_siswa->J_melanjutkan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->J_melanjutkan->FldCaption());
		}
		if (!is_null($master_siswa->J_tanggal_bekerja->FormValue) && $master_siswa->J_tanggal_bekerja->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->J_tanggal_bekerja->FldCaption());
		}
		if (!ew_CheckEuroDate($master_siswa->J_tanggal_bekerja->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->J_tanggal_bekerja->FldErrMsg());
		}
		if (!is_null($master_siswa->J_nama_perusahaan->FormValue) && $master_siswa->J_nama_perusahaan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->J_nama_perusahaan->FldCaption());
		}
		if (!is_null($master_siswa->J_penghasilan->FormValue) && $master_siswa->J_penghasilan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->J_penghasilan->FldCaption());
		}
		if (!ew_CheckNumber($master_siswa->J_penghasilan->FormValue)) {
			ew_AddMessage($gsFormError, $master_siswa->J_penghasilan->FldErrMsg());
		}
		if (!is_null($master_siswa->apakah_valid->FormValue) && $master_siswa->apakah_valid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_siswa->apakah_valid->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $master_siswa;
		$sFilter = $master_siswa->KeyFilter();
			if ($master_siswa->A_nis_nasional->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`A_nis_nasional` = '" . ew_AdjustSql($master_siswa->A_nis_nasional->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$master_siswa->CurrentFilter = $sFilterChk;
			$sSqlChk = $master_siswa->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'A_nis_nasional', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $master_siswa->A_nis_nasional->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$master_siswa->CurrentFilter = $sFilter;
		$sSql = $master_siswa->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// no_absen
			$master_siswa->no_absen->SetDbValueDef($rsnew, $master_siswa->no_absen->CurrentValue, 0, $master_siswa->no_absen->ReadOnly);

			// A_nis_nasional
			$master_siswa->A_nis_nasional->SetDbValueDef($rsnew, $master_siswa->A_nis_nasional->CurrentValue, "", $master_siswa->A_nis_nasional->ReadOnly);

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->SetDbValueDef($rsnew, $master_siswa->A_nama_Lengkap->CurrentValue, "", $master_siswa->A_nama_Lengkap->ReadOnly);

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->SetDbValueDef($rsnew, $master_siswa->A_nama_panggilan->CurrentValue, "", $master_siswa->A_nama_panggilan->ReadOnly);

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->SetDbValueDef($rsnew, $master_siswa->A_jenis_kelamin->CurrentValue, "", $master_siswa->A_jenis_kelamin->ReadOnly);

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->SetDbValueDef($rsnew, $master_siswa->A_tempat_lahir->CurrentValue, "", $master_siswa->A_tempat_lahir->ReadOnly);

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->A_tanggal_lahir->CurrentValue, 7), ew_CurrentDate(), $master_siswa->A_tanggal_lahir->ReadOnly);

			// A_agama
			$master_siswa->A_agama->SetDbValueDef($rsnew, $master_siswa->A_agama->CurrentValue, "", $master_siswa->A_agama->ReadOnly);

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->SetDbValueDef($rsnew, $master_siswa->A_kewarganegaraan->CurrentValue, "", $master_siswa->A_kewarganegaraan->ReadOnly);

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->SetDbValueDef($rsnew, $master_siswa->A_anak_keberapa->CurrentValue, 0, $master_siswa->A_anak_keberapa->ReadOnly);

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->SetDbValueDef($rsnew, $master_siswa->A_jumlah_saudara_kandung->CurrentValue, 0, $master_siswa->A_jumlah_saudara_kandung->ReadOnly);

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->SetDbValueDef($rsnew, $master_siswa->A_jumlah_saudara_tiri->CurrentValue, 0, $master_siswa->A_jumlah_saudara_tiri->ReadOnly);

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->SetDbValueDef($rsnew, $master_siswa->A_jumlah_saudara_angkat->CurrentValue, 0, $master_siswa->A_jumlah_saudara_angkat->ReadOnly);

			// A_status_yatim
			$master_siswa->A_status_yatim->SetDbValueDef($rsnew, $master_siswa->A_status_yatim->CurrentValue, "", $master_siswa->A_status_yatim->ReadOnly);

			// A_bahasa
			$master_siswa->A_bahasa->SetDbValueDef($rsnew, $master_siswa->A_bahasa->CurrentValue, "", $master_siswa->A_bahasa->ReadOnly);

			// B_alamat
			$master_siswa->B_alamat->SetDbValueDef($rsnew, $master_siswa->B_alamat->CurrentValue, "", $master_siswa->B_alamat->ReadOnly);

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->SetDbValueDef($rsnew, $master_siswa->B_telepon_rumah->CurrentValue, "", $master_siswa->B_telepon_rumah->ReadOnly);

			// B_tinggal
			$master_siswa->B_tinggal->SetDbValueDef($rsnew, $master_siswa->B_tinggal->CurrentValue, "", $master_siswa->B_tinggal->ReadOnly);

			// B_jarak
			$master_siswa->B_jarak->SetDbValueDef($rsnew, $master_siswa->B_jarak->CurrentValue, 0, $master_siswa->B_jarak->ReadOnly);

			// B_hp
			$master_siswa->B_hp->SetDbValueDef($rsnew, $master_siswa->B_hp->CurrentValue, "", $master_siswa->B_hp->ReadOnly);

			// C_golongan_darah
			$master_siswa->C_golongan_darah->SetDbValueDef($rsnew, $master_siswa->C_golongan_darah->CurrentValue, "", $master_siswa->C_golongan_darah->ReadOnly);

			// C_penyakit
			$master_siswa->C_penyakit->SetDbValueDef($rsnew, $master_siswa->C_penyakit->CurrentValue, "", $master_siswa->C_penyakit->ReadOnly);

			// C_jasmani
			$master_siswa->C_jasmani->SetDbValueDef($rsnew, $master_siswa->C_jasmani->CurrentValue, "", $master_siswa->C_jasmani->ReadOnly);

			// C_tinggi
			$master_siswa->C_tinggi->SetDbValueDef($rsnew, $master_siswa->C_tinggi->CurrentValue, 0, $master_siswa->C_tinggi->ReadOnly);

			// C_berat
			$master_siswa->C_berat->SetDbValueDef($rsnew, $master_siswa->C_berat->CurrentValue, 0, $master_siswa->C_berat->ReadOnly);

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->SetDbValueDef($rsnew, $master_siswa->D_tamatan_dari->CurrentValue, "", $master_siswa->D_tamatan_dari->ReadOnly);

			// D_sttb
			$master_siswa->D_sttb->SetDbValueDef($rsnew, $master_siswa->D_sttb->CurrentValue, "", $master_siswa->D_sttb->ReadOnly);

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->D_tanggal_sttb->CurrentValue, 7), ew_CurrentDate(), $master_siswa->D_tanggal_sttb->ReadOnly);

			// D_danum
			$master_siswa->D_danum->SetDbValueDef($rsnew, $master_siswa->D_danum->CurrentValue, "", $master_siswa->D_danum->ReadOnly);

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->D_tanggal_danum->CurrentValue, 7), ew_CurrentDate(), $master_siswa->D_tanggal_danum->ReadOnly);

			// D_lama_belajar
			$master_siswa->D_lama_belajar->SetDbValueDef($rsnew, $master_siswa->D_lama_belajar->CurrentValue, 0, $master_siswa->D_lama_belajar->ReadOnly);

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->SetDbValueDef($rsnew, $master_siswa->D_dari_sekolah->CurrentValue, "", $master_siswa->D_dari_sekolah->ReadOnly);

			// D_alasan
			$master_siswa->D_alasan->SetDbValueDef($rsnew, $master_siswa->D_alasan->CurrentValue, "", $master_siswa->D_alasan->ReadOnly);

			// D_kelas
			$master_siswa->D_kelas->SetDbValueDef($rsnew, $master_siswa->D_kelas->CurrentValue, "", $master_siswa->D_kelas->ReadOnly);

			// D_kelompok
			$master_siswa->D_kelompok->SetDbValueDef($rsnew, $master_siswa->D_kelompok->CurrentValue, "", $master_siswa->D_kelompok->ReadOnly);

			// D_tanggal
			$master_siswa->D_tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->D_tanggal->CurrentValue, 7), ew_CurrentDate(), $master_siswa->D_tanggal->ReadOnly);

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->SetDbValueDef($rsnew, $master_siswa->D_saat_ini_tingkat->CurrentValue, "", $master_siswa->D_saat_ini_tingkat->ReadOnly);

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->SetDbValueDef($rsnew, $master_siswa->D_saat_ini_kelas->CurrentValue, "", $master_siswa->D_saat_ini_kelas->ReadOnly);

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->SetDbValueDef($rsnew, $master_siswa->D_saat_ini_kelompok->CurrentValue, "", $master_siswa->D_saat_ini_kelompok->ReadOnly);

			// D_no_psb
			$master_siswa->D_no_psb->SetDbValueDef($rsnew, $master_siswa->D_no_psb->CurrentValue, "", $master_siswa->D_no_psb->ReadOnly);

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->SetDbValueDef($rsnew, $master_siswa->D_nilai_danum_sd->CurrentValue, 0, $master_siswa->D_nilai_danum_sd->ReadOnly);

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->SetDbValueDef($rsnew, $master_siswa->D_jumlah_pelajaran_danum->CurrentValue, 0, $master_siswa->D_jumlah_pelajaran_danum->ReadOnly);

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->SetDbValueDef($rsnew, $master_siswa->D_nilai_ujian_psb->CurrentValue, 0, $master_siswa->D_nilai_ujian_psb->ReadOnly);

			// D_tahun_psb
			$master_siswa->D_tahun_psb->SetDbValueDef($rsnew, $master_siswa->D_tahun_psb->CurrentValue, "", $master_siswa->D_tahun_psb->ReadOnly);

			// D_diterima
			$master_siswa->D_diterima->SetDbValueDef($rsnew, $master_siswa->D_diterima->CurrentValue, "", $master_siswa->D_diterima->ReadOnly);

			// D_spp
			$master_siswa->D_spp->SetDbValueDef($rsnew, $master_siswa->D_spp->CurrentValue, 0, $master_siswa->D_spp->ReadOnly);

			// D_spp_potongan
			$master_siswa->D_spp_potongan->SetDbValueDef($rsnew, $master_siswa->D_spp_potongan->CurrentValue, 0, $master_siswa->D_spp_potongan->ReadOnly);

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->SetDbValueDef($rsnew, $master_siswa->D_status_lama_baru->CurrentValue, "", $master_siswa->D_status_lama_baru->ReadOnly);

			// E_nama_ayah
			$master_siswa->E_nama_ayah->SetDbValueDef($rsnew, $master_siswa->E_nama_ayah->CurrentValue, "", $master_siswa->E_nama_ayah->ReadOnly);

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->SetDbValueDef($rsnew, $master_siswa->E_tempat_lahir->CurrentValue, "", $master_siswa->E_tempat_lahir->ReadOnly);

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->E_tanggal_lahir->CurrentValue, 7), ew_CurrentDate(), $master_siswa->E_tanggal_lahir->ReadOnly);

			// E_agama
			$master_siswa->E_agama->SetDbValueDef($rsnew, $master_siswa->E_agama->CurrentValue, "", $master_siswa->E_agama->ReadOnly);

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->SetDbValueDef($rsnew, $master_siswa->E_kewarganegaraan->CurrentValue, "", $master_siswa->E_kewarganegaraan->ReadOnly);

			// E_pendidikan
			$master_siswa->E_pendidikan->SetDbValueDef($rsnew, $master_siswa->E_pendidikan->CurrentValue, "", $master_siswa->E_pendidikan->ReadOnly);

			// E_pekerjaan
			$master_siswa->E_pekerjaan->SetDbValueDef($rsnew, $master_siswa->E_pekerjaan->CurrentValue, "", $master_siswa->E_pekerjaan->ReadOnly);

			// E_pengeluaran
			$master_siswa->E_pengeluaran->SetDbValueDef($rsnew, $master_siswa->E_pengeluaran->CurrentValue, 0, $master_siswa->E_pengeluaran->ReadOnly);

			// E_alamat
			$master_siswa->E_alamat->SetDbValueDef($rsnew, $master_siswa->E_alamat->CurrentValue, "", $master_siswa->E_alamat->ReadOnly);

			// E_telepon
			$master_siswa->E_telepon->SetDbValueDef($rsnew, $master_siswa->E_telepon->CurrentValue, "", $master_siswa->E_telepon->ReadOnly);

			// E_hp
			$master_siswa->E_hp->SetDbValueDef($rsnew, $master_siswa->E_hp->CurrentValue, "", $master_siswa->E_hp->ReadOnly);

			// E_hidup
			$master_siswa->E_hidup->SetDbValueDef($rsnew, $master_siswa->E_hidup->CurrentValue, "", $master_siswa->E_hidup->ReadOnly);

			// F_nama_ibu
			$master_siswa->F_nama_ibu->SetDbValueDef($rsnew, $master_siswa->F_nama_ibu->CurrentValue, "", $master_siswa->F_nama_ibu->ReadOnly);

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->SetDbValueDef($rsnew, $master_siswa->F_tempat_lahir->CurrentValue, "", $master_siswa->F_tempat_lahir->ReadOnly);

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->F_tanggal_lahir->CurrentValue, 7), ew_CurrentDate(), $master_siswa->F_tanggal_lahir->ReadOnly);

			// F_agama
			$master_siswa->F_agama->SetDbValueDef($rsnew, $master_siswa->F_agama->CurrentValue, "", $master_siswa->F_agama->ReadOnly);

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->SetDbValueDef($rsnew, $master_siswa->F_kewarganegaraan->CurrentValue, "", $master_siswa->F_kewarganegaraan->ReadOnly);

			// F_pendidikan
			$master_siswa->F_pendidikan->SetDbValueDef($rsnew, $master_siswa->F_pendidikan->CurrentValue, "", $master_siswa->F_pendidikan->ReadOnly);

			// F_pekerjaan
			$master_siswa->F_pekerjaan->SetDbValueDef($rsnew, $master_siswa->F_pekerjaan->CurrentValue, "", $master_siswa->F_pekerjaan->ReadOnly);

			// F_pengeluaran
			$master_siswa->F_pengeluaran->SetDbValueDef($rsnew, $master_siswa->F_pengeluaran->CurrentValue, 0, $master_siswa->F_pengeluaran->ReadOnly);

			// F_alamat
			$master_siswa->F_alamat->SetDbValueDef($rsnew, $master_siswa->F_alamat->CurrentValue, "", $master_siswa->F_alamat->ReadOnly);

			// F_telepon
			$master_siswa->F_telepon->SetDbValueDef($rsnew, $master_siswa->F_telepon->CurrentValue, "", $master_siswa->F_telepon->ReadOnly);

			// F_hp
			$master_siswa->F_hp->SetDbValueDef($rsnew, $master_siswa->F_hp->CurrentValue, "", $master_siswa->F_hp->ReadOnly);

			// F_hidup
			$master_siswa->F_hidup->SetDbValueDef($rsnew, $master_siswa->F_hidup->CurrentValue, "", $master_siswa->F_hidup->ReadOnly);

			// G_nama_wali
			$master_siswa->G_nama_wali->SetDbValueDef($rsnew, $master_siswa->G_nama_wali->CurrentValue, "", $master_siswa->G_nama_wali->ReadOnly);

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->SetDbValueDef($rsnew, $master_siswa->G_tempat_lahir->CurrentValue, "", $master_siswa->G_tempat_lahir->ReadOnly);

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->G_tanggal_lahir->CurrentValue, 7), ew_CurrentDate(), $master_siswa->G_tanggal_lahir->ReadOnly);

			// G_agama
			$master_siswa->G_agama->SetDbValueDef($rsnew, $master_siswa->G_agama->CurrentValue, "", $master_siswa->G_agama->ReadOnly);

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->SetDbValueDef($rsnew, $master_siswa->G_kewarganegaraan->CurrentValue, "", $master_siswa->G_kewarganegaraan->ReadOnly);

			// G_pendidikan
			$master_siswa->G_pendidikan->SetDbValueDef($rsnew, $master_siswa->G_pendidikan->CurrentValue, "", $master_siswa->G_pendidikan->ReadOnly);

			// G_pekerjaan
			$master_siswa->G_pekerjaan->SetDbValueDef($rsnew, $master_siswa->G_pekerjaan->CurrentValue, "", $master_siswa->G_pekerjaan->ReadOnly);

			// G_pengeluaran
			$master_siswa->G_pengeluaran->SetDbValueDef($rsnew, $master_siswa->G_pengeluaran->CurrentValue, 0, $master_siswa->G_pengeluaran->ReadOnly);

			// G_alamat
			$master_siswa->G_alamat->SetDbValueDef($rsnew, $master_siswa->G_alamat->CurrentValue, "", $master_siswa->G_alamat->ReadOnly);

			// G_telepon
			$master_siswa->G_telepon->SetDbValueDef($rsnew, $master_siswa->G_telepon->CurrentValue, "", $master_siswa->G_telepon->ReadOnly);

			// G_hp
			$master_siswa->G_hp->SetDbValueDef($rsnew, $master_siswa->G_hp->CurrentValue, "", $master_siswa->G_hp->ReadOnly);

			// H_kesenian
			$master_siswa->H_kesenian->SetDbValueDef($rsnew, $master_siswa->H_kesenian->CurrentValue, "", $master_siswa->H_kesenian->ReadOnly);

			// H_olahraga
			$master_siswa->H_olahraga->SetDbValueDef($rsnew, $master_siswa->H_olahraga->CurrentValue, "", $master_siswa->H_olahraga->ReadOnly);

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->SetDbValueDef($rsnew, $master_siswa->H_kemasyarakatan->CurrentValue, "", $master_siswa->H_kemasyarakatan->ReadOnly);

			// H_lainlain
			$master_siswa->H_lainlain->SetDbValueDef($rsnew, $master_siswa->H_lainlain->CurrentValue, "", $master_siswa->H_lainlain->ReadOnly);

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->I_tanggal_meninggalkan->CurrentValue, 7), ew_CurrentDate(), $master_siswa->I_tanggal_meninggalkan->ReadOnly);

			// I_alasan
			$master_siswa->I_alasan->SetDbValueDef($rsnew, $master_siswa->I_alasan->CurrentValue, "", $master_siswa->I_alasan->ReadOnly);

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->I_tanggal_lulus->CurrentValue, 7), ew_CurrentDate(), $master_siswa->I_tanggal_lulus->ReadOnly);

			// I_sttb
			$master_siswa->I_sttb->SetDbValueDef($rsnew, $master_siswa->I_sttb->CurrentValue, "", $master_siswa->I_sttb->ReadOnly);

			// I_danum
			$master_siswa->I_danum->SetDbValueDef($rsnew, $master_siswa->I_danum->CurrentValue, "", $master_siswa->I_danum->ReadOnly);

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->SetDbValueDef($rsnew, $master_siswa->I_nilai_danum_smp->CurrentValue, 0, $master_siswa->I_nilai_danum_smp->ReadOnly);

			// I_tahun1
			$master_siswa->I_tahun1->SetDbValueDef($rsnew, $master_siswa->I_tahun1->CurrentValue, "", $master_siswa->I_tahun1->ReadOnly);

			// I_tahun2
			$master_siswa->I_tahun2->SetDbValueDef($rsnew, $master_siswa->I_tahun2->CurrentValue, "", $master_siswa->I_tahun2->ReadOnly);

			// I_tahun3
			$master_siswa->I_tahun3->SetDbValueDef($rsnew, $master_siswa->I_tahun3->CurrentValue, "", $master_siswa->I_tahun3->ReadOnly);

			// I_tk1
			$master_siswa->I_tk1->SetDbValueDef($rsnew, $master_siswa->I_tk1->CurrentValue, "", $master_siswa->I_tk1->ReadOnly);

			// I_tk2
			$master_siswa->I_tk2->SetDbValueDef($rsnew, $master_siswa->I_tk2->CurrentValue, "", $master_siswa->I_tk2->ReadOnly);

			// I_tk3
			$master_siswa->I_tk3->SetDbValueDef($rsnew, $master_siswa->I_tk3->CurrentValue, "", $master_siswa->I_tk3->ReadOnly);

			// I_dari1
			$master_siswa->I_dari1->SetDbValueDef($rsnew, $master_siswa->I_dari1->CurrentValue, "", $master_siswa->I_dari1->ReadOnly);

			// I_dari2
			$master_siswa->I_dari2->SetDbValueDef($rsnew, $master_siswa->I_dari2->CurrentValue, "", $master_siswa->I_dari2->ReadOnly);

			// I_dari3
			$master_siswa->I_dari3->SetDbValueDef($rsnew, $master_siswa->I_dari3->CurrentValue, "", $master_siswa->I_dari3->ReadOnly);

			// J_melanjutkan
			$master_siswa->J_melanjutkan->SetDbValueDef($rsnew, $master_siswa->J_melanjutkan->CurrentValue, "", $master_siswa->J_melanjutkan->ReadOnly);

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_siswa->J_tanggal_bekerja->CurrentValue, 7), ew_CurrentDate(), $master_siswa->J_tanggal_bekerja->ReadOnly);

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->SetDbValueDef($rsnew, $master_siswa->J_nama_perusahaan->CurrentValue, "", $master_siswa->J_nama_perusahaan->ReadOnly);

			// J_penghasilan
			$master_siswa->J_penghasilan->SetDbValueDef($rsnew, $master_siswa->J_penghasilan->CurrentValue, 0, $master_siswa->J_penghasilan->ReadOnly);

			// kode_otomatis
			// apakah_valid

			$master_siswa->apakah_valid->SetDbValueDef($rsnew, $master_siswa->apakah_valid->CurrentValue, "", $master_siswa->apakah_valid->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $master_siswa->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($master_siswa->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($master_siswa->CancelMessage <> "") {
					$this->setFailureMessage($master_siswa->CancelMessage);
					$master_siswa->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$master_siswa->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>

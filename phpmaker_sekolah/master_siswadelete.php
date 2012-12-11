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
$master_siswa_delete = new cmaster_siswa_delete();
$Page =& $master_siswa_delete;

// Page init
$master_siswa_delete->Page_Init();

// Page main
$master_siswa_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var master_siswa_delete = new ew_Page("master_siswa_delete");

// page properties
master_siswa_delete.PageID = "delete"; // page ID
master_siswa_delete.FormID = "fmaster_siswadelete"; // form ID
var EW_PAGE_ID = master_siswa_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
master_siswa_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
master_siswa_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
master_siswa_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_siswa_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($master_siswa_delete->Recordset = $master_siswa_delete->LoadRecordset())
	$master_siswa_deleteTotalRecs = $master_siswa_delete->Recordset->RecordCount(); // Get record count
if ($master_siswa_deleteTotalRecs <= 0) { // No record found, exit
	if ($master_siswa_delete->Recordset)
		$master_siswa_delete->Recordset->Close();
	$master_siswa_delete->Page_Terminate("master_siswalist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $master_siswa->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $master_siswa->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $master_siswa_delete->ShowPageHeader(); ?>
<?php
$master_siswa_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="master_siswa">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($master_siswa_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $master_siswa->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $master_siswa->no_absen->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_nis_nasional->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_nama_Lengkap->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_nama_panggilan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_jenis_kelamin->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_tempat_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_tanggal_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_agama->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_kewarganegaraan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_anak_keberapa->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_jumlah_saudara_kandung->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_jumlah_saudara_tiri->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_jumlah_saudara_angkat->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_status_yatim->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->A_bahasa->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->B_alamat->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->B_telepon_rumah->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->B_tinggal->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->B_jarak->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->B_hp->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->C_golongan_darah->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->C_penyakit->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->C_jasmani->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->C_tinggi->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->C_berat->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_tamatan_dari->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_sttb->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_tanggal_sttb->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_danum->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_tanggal_danum->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_lama_belajar->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_dari_sekolah->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_alasan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_kelas->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_kelompok->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_tanggal->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_saat_ini_tingkat->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_saat_ini_kelas->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_saat_ini_kelompok->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_no_psb->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_nilai_danum_sd->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_jumlah_pelajaran_danum->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_nilai_ujian_psb->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_tahun_psb->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_diterima->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_spp->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_spp_potongan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->D_status_lama_baru->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_nama_ayah->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_tempat_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_tanggal_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_agama->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_kewarganegaraan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_pendidikan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_pekerjaan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_pengeluaran->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_alamat->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_telepon->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_hp->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->E_hidup->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_nama_ibu->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_tempat_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_tanggal_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_agama->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_kewarganegaraan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_pendidikan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_pekerjaan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_pengeluaran->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_alamat->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_telepon->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_hp->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->F_hidup->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_nama_wali->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_tempat_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_tanggal_lahir->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_agama->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_kewarganegaraan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_pendidikan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_pekerjaan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_pengeluaran->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_alamat->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_telepon->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->G_hp->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->H_kesenian->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->H_olahraga->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->H_kemasyarakatan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->H_lainlain->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tanggal_meninggalkan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_alasan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tanggal_lulus->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_sttb->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_danum->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_nilai_danum_smp->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tahun1->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tahun2->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tahun3->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tk1->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tk2->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_tk3->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_dari1->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_dari2->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->I_dari3->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->J_melanjutkan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->J_tanggal_bekerja->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->J_nama_perusahaan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->J_penghasilan->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->kode_otomatis->FldCaption() ?></td>
		<td valign="top"><?php echo $master_siswa->apakah_valid->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$master_siswa_delete->RecCnt = 0;
$i = 0;
while (!$master_siswa_delete->Recordset->EOF) {
	$master_siswa_delete->RecCnt++;

	// Set row properties
	$master_siswa->ResetAttrs();
	$master_siswa->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$master_siswa_delete->LoadRowValues($master_siswa_delete->Recordset);

	// Render row
	$master_siswa_delete->RenderRow();
?>
	<tr<?php echo $master_siswa->RowAttributes() ?>>
		<td<?php echo $master_siswa->no_absen->CellAttributes() ?>>
<div<?php echo $master_siswa->no_absen->ViewAttributes() ?>><?php echo $master_siswa->no_absen->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_nis_nasional->CellAttributes() ?>>
<div<?php echo $master_siswa->A_nis_nasional->ViewAttributes() ?>><?php echo $master_siswa->A_nis_nasional->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_nama_Lengkap->CellAttributes() ?>>
<div<?php echo $master_siswa->A_nama_Lengkap->ViewAttributes() ?>><?php echo $master_siswa->A_nama_Lengkap->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_nama_panggilan->CellAttributes() ?>>
<div<?php echo $master_siswa->A_nama_panggilan->ViewAttributes() ?>><?php echo $master_siswa->A_nama_panggilan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_jenis_kelamin->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jenis_kelamin->ViewAttributes() ?>><?php echo $master_siswa->A_jenis_kelamin->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->A_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->A_tempat_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->A_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->A_tanggal_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->A_agama->ViewAttributes() ?>><?php echo $master_siswa->A_agama->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->A_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->A_kewarganegaraan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_anak_keberapa->CellAttributes() ?>>
<div<?php echo $master_siswa->A_anak_keberapa->ViewAttributes() ?>><?php echo $master_siswa->A_anak_keberapa->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_kandung->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jumlah_saudara_kandung->ViewAttributes() ?>><?php echo $master_siswa->A_jumlah_saudara_kandung->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_tiri->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jumlah_saudara_tiri->ViewAttributes() ?>><?php echo $master_siswa->A_jumlah_saudara_tiri->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_angkat->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jumlah_saudara_angkat->ViewAttributes() ?>><?php echo $master_siswa->A_jumlah_saudara_angkat->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_status_yatim->CellAttributes() ?>>
<div<?php echo $master_siswa->A_status_yatim->ViewAttributes() ?>><?php echo $master_siswa->A_status_yatim->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->A_bahasa->CellAttributes() ?>>
<div<?php echo $master_siswa->A_bahasa->ViewAttributes() ?>><?php echo $master_siswa->A_bahasa->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->B_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->B_alamat->ViewAttributes() ?>><?php echo $master_siswa->B_alamat->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->B_telepon_rumah->CellAttributes() ?>>
<div<?php echo $master_siswa->B_telepon_rumah->ViewAttributes() ?>><?php echo $master_siswa->B_telepon_rumah->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->B_tinggal->CellAttributes() ?>>
<div<?php echo $master_siswa->B_tinggal->ViewAttributes() ?>><?php echo $master_siswa->B_tinggal->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->B_jarak->CellAttributes() ?>>
<div<?php echo $master_siswa->B_jarak->ViewAttributes() ?>><?php echo $master_siswa->B_jarak->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->B_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->B_hp->ViewAttributes() ?>><?php echo $master_siswa->B_hp->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->C_golongan_darah->CellAttributes() ?>>
<div<?php echo $master_siswa->C_golongan_darah->ViewAttributes() ?>><?php echo $master_siswa->C_golongan_darah->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->C_penyakit->CellAttributes() ?>>
<div<?php echo $master_siswa->C_penyakit->ViewAttributes() ?>><?php echo $master_siswa->C_penyakit->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->C_jasmani->CellAttributes() ?>>
<div<?php echo $master_siswa->C_jasmani->ViewAttributes() ?>><?php echo $master_siswa->C_jasmani->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->C_tinggi->CellAttributes() ?>>
<div<?php echo $master_siswa->C_tinggi->ViewAttributes() ?>><?php echo $master_siswa->C_tinggi->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->C_berat->CellAttributes() ?>>
<div<?php echo $master_siswa->C_berat->ViewAttributes() ?>><?php echo $master_siswa->C_berat->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_tamatan_dari->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tamatan_dari->ViewAttributes() ?>><?php echo $master_siswa->D_tamatan_dari->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_sttb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_sttb->ViewAttributes() ?>><?php echo $master_siswa->D_sttb->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_tanggal_sttb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tanggal_sttb->ViewAttributes() ?>><?php echo $master_siswa->D_tanggal_sttb->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->D_danum->ViewAttributes() ?>><?php echo $master_siswa->D_danum->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_tanggal_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tanggal_danum->ViewAttributes() ?>><?php echo $master_siswa->D_tanggal_danum->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_lama_belajar->CellAttributes() ?>>
<div<?php echo $master_siswa->D_lama_belajar->ViewAttributes() ?>><?php echo $master_siswa->D_lama_belajar->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_dari_sekolah->CellAttributes() ?>>
<div<?php echo $master_siswa->D_dari_sekolah->ViewAttributes() ?>><?php echo $master_siswa->D_dari_sekolah->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_alasan->CellAttributes() ?>>
<div<?php echo $master_siswa->D_alasan->ViewAttributes() ?>><?php echo $master_siswa->D_alasan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_kelas->CellAttributes() ?>>
<div<?php echo $master_siswa->D_kelas->ViewAttributes() ?>><?php echo $master_siswa->D_kelas->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_kelompok->CellAttributes() ?>>
<div<?php echo $master_siswa->D_kelompok->ViewAttributes() ?>><?php echo $master_siswa->D_kelompok->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_tanggal->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tanggal->ViewAttributes() ?>><?php echo $master_siswa->D_tanggal->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_saat_ini_tingkat->CellAttributes() ?>>
<div<?php echo $master_siswa->D_saat_ini_tingkat->ViewAttributes() ?>><?php echo $master_siswa->D_saat_ini_tingkat->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_saat_ini_kelas->CellAttributes() ?>>
<div<?php echo $master_siswa->D_saat_ini_kelas->ViewAttributes() ?>><?php echo $master_siswa->D_saat_ini_kelas->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_saat_ini_kelompok->CellAttributes() ?>>
<div<?php echo $master_siswa->D_saat_ini_kelompok->ViewAttributes() ?>><?php echo $master_siswa->D_saat_ini_kelompok->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_no_psb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_no_psb->ViewAttributes() ?>><?php echo $master_siswa->D_no_psb->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_nilai_danum_sd->CellAttributes() ?>>
<div<?php echo $master_siswa->D_nilai_danum_sd->ViewAttributes() ?>><?php echo $master_siswa->D_nilai_danum_sd->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_jumlah_pelajaran_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->D_jumlah_pelajaran_danum->ViewAttributes() ?>><?php echo $master_siswa->D_jumlah_pelajaran_danum->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_nilai_ujian_psb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_nilai_ujian_psb->ViewAttributes() ?>><?php echo $master_siswa->D_nilai_ujian_psb->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_tahun_psb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tahun_psb->ViewAttributes() ?>><?php echo $master_siswa->D_tahun_psb->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_diterima->CellAttributes() ?>>
<div<?php echo $master_siswa->D_diterima->ViewAttributes() ?>><?php echo $master_siswa->D_diterima->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_spp->CellAttributes() ?>>
<div<?php echo $master_siswa->D_spp->ViewAttributes() ?>><?php echo $master_siswa->D_spp->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_spp_potongan->CellAttributes() ?>>
<div<?php echo $master_siswa->D_spp_potongan->ViewAttributes() ?>><?php echo $master_siswa->D_spp_potongan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->D_status_lama_baru->CellAttributes() ?>>
<div<?php echo $master_siswa->D_status_lama_baru->ViewAttributes() ?>><?php echo $master_siswa->D_status_lama_baru->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_nama_ayah->CellAttributes() ?>>
<div<?php echo $master_siswa->E_nama_ayah->ViewAttributes() ?>><?php echo $master_siswa->E_nama_ayah->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->E_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->E_tempat_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->E_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->E_tanggal_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->E_agama->ViewAttributes() ?>><?php echo $master_siswa->E_agama->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->E_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->E_kewarganegaraan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_pendidikan->CellAttributes() ?>>
<div<?php echo $master_siswa->E_pendidikan->ViewAttributes() ?>><?php echo $master_siswa->E_pendidikan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_pekerjaan->CellAttributes() ?>>
<div<?php echo $master_siswa->E_pekerjaan->ViewAttributes() ?>><?php echo $master_siswa->E_pekerjaan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_pengeluaran->CellAttributes() ?>>
<div<?php echo $master_siswa->E_pengeluaran->ViewAttributes() ?>><?php echo $master_siswa->E_pengeluaran->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->E_alamat->ViewAttributes() ?>><?php echo $master_siswa->E_alamat->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_telepon->CellAttributes() ?>>
<div<?php echo $master_siswa->E_telepon->ViewAttributes() ?>><?php echo $master_siswa->E_telepon->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->E_hp->ViewAttributes() ?>><?php echo $master_siswa->E_hp->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->E_hidup->CellAttributes() ?>>
<div<?php echo $master_siswa->E_hidup->ViewAttributes() ?>><?php echo $master_siswa->E_hidup->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_nama_ibu->CellAttributes() ?>>
<div<?php echo $master_siswa->F_nama_ibu->ViewAttributes() ?>><?php echo $master_siswa->F_nama_ibu->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->F_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->F_tempat_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->F_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->F_tanggal_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->F_agama->ViewAttributes() ?>><?php echo $master_siswa->F_agama->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->F_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->F_kewarganegaraan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_pendidikan->CellAttributes() ?>>
<div<?php echo $master_siswa->F_pendidikan->ViewAttributes() ?>><?php echo $master_siswa->F_pendidikan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_pekerjaan->CellAttributes() ?>>
<div<?php echo $master_siswa->F_pekerjaan->ViewAttributes() ?>><?php echo $master_siswa->F_pekerjaan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_pengeluaran->CellAttributes() ?>>
<div<?php echo $master_siswa->F_pengeluaran->ViewAttributes() ?>><?php echo $master_siswa->F_pengeluaran->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->F_alamat->ViewAttributes() ?>><?php echo $master_siswa->F_alamat->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_telepon->CellAttributes() ?>>
<div<?php echo $master_siswa->F_telepon->ViewAttributes() ?>><?php echo $master_siswa->F_telepon->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->F_hp->ViewAttributes() ?>><?php echo $master_siswa->F_hp->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->F_hidup->CellAttributes() ?>>
<div<?php echo $master_siswa->F_hidup->ViewAttributes() ?>><?php echo $master_siswa->F_hidup->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_nama_wali->CellAttributes() ?>>
<div<?php echo $master_siswa->G_nama_wali->ViewAttributes() ?>><?php echo $master_siswa->G_nama_wali->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->G_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->G_tempat_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->G_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->G_tanggal_lahir->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->G_agama->ViewAttributes() ?>><?php echo $master_siswa->G_agama->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->G_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->G_kewarganegaraan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_pendidikan->CellAttributes() ?>>
<div<?php echo $master_siswa->G_pendidikan->ViewAttributes() ?>><?php echo $master_siswa->G_pendidikan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_pekerjaan->CellAttributes() ?>>
<div<?php echo $master_siswa->G_pekerjaan->ViewAttributes() ?>><?php echo $master_siswa->G_pekerjaan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_pengeluaran->CellAttributes() ?>>
<div<?php echo $master_siswa->G_pengeluaran->ViewAttributes() ?>><?php echo $master_siswa->G_pengeluaran->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->G_alamat->ViewAttributes() ?>><?php echo $master_siswa->G_alamat->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_telepon->CellAttributes() ?>>
<div<?php echo $master_siswa->G_telepon->ViewAttributes() ?>><?php echo $master_siswa->G_telepon->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->G_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->G_hp->ViewAttributes() ?>><?php echo $master_siswa->G_hp->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->H_kesenian->CellAttributes() ?>>
<div<?php echo $master_siswa->H_kesenian->ViewAttributes() ?>><?php echo $master_siswa->H_kesenian->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->H_olahraga->CellAttributes() ?>>
<div<?php echo $master_siswa->H_olahraga->ViewAttributes() ?>><?php echo $master_siswa->H_olahraga->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->H_kemasyarakatan->CellAttributes() ?>>
<div<?php echo $master_siswa->H_kemasyarakatan->ViewAttributes() ?>><?php echo $master_siswa->H_kemasyarakatan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->H_lainlain->CellAttributes() ?>>
<div<?php echo $master_siswa->H_lainlain->ViewAttributes() ?>><?php echo $master_siswa->H_lainlain->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tanggal_meninggalkan->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tanggal_meninggalkan->ViewAttributes() ?>><?php echo $master_siswa->I_tanggal_meninggalkan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_alasan->CellAttributes() ?>>
<div<?php echo $master_siswa->I_alasan->ViewAttributes() ?>><?php echo $master_siswa->I_alasan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tanggal_lulus->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tanggal_lulus->ViewAttributes() ?>><?php echo $master_siswa->I_tanggal_lulus->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_sttb->CellAttributes() ?>>
<div<?php echo $master_siswa->I_sttb->ViewAttributes() ?>><?php echo $master_siswa->I_sttb->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->I_danum->ViewAttributes() ?>><?php echo $master_siswa->I_danum->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_nilai_danum_smp->CellAttributes() ?>>
<div<?php echo $master_siswa->I_nilai_danum_smp->ViewAttributes() ?>><?php echo $master_siswa->I_nilai_danum_smp->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tahun1->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tahun1->ViewAttributes() ?>><?php echo $master_siswa->I_tahun1->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tahun2->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tahun2->ViewAttributes() ?>><?php echo $master_siswa->I_tahun2->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tahun3->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tahun3->ViewAttributes() ?>><?php echo $master_siswa->I_tahun3->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tk1->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tk1->ViewAttributes() ?>><?php echo $master_siswa->I_tk1->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tk2->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tk2->ViewAttributes() ?>><?php echo $master_siswa->I_tk2->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_tk3->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tk3->ViewAttributes() ?>><?php echo $master_siswa->I_tk3->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_dari1->CellAttributes() ?>>
<div<?php echo $master_siswa->I_dari1->ViewAttributes() ?>><?php echo $master_siswa->I_dari1->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_dari2->CellAttributes() ?>>
<div<?php echo $master_siswa->I_dari2->ViewAttributes() ?>><?php echo $master_siswa->I_dari2->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->I_dari3->CellAttributes() ?>>
<div<?php echo $master_siswa->I_dari3->ViewAttributes() ?>><?php echo $master_siswa->I_dari3->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->J_melanjutkan->CellAttributes() ?>>
<div<?php echo $master_siswa->J_melanjutkan->ViewAttributes() ?>><?php echo $master_siswa->J_melanjutkan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->J_tanggal_bekerja->CellAttributes() ?>>
<div<?php echo $master_siswa->J_tanggal_bekerja->ViewAttributes() ?>><?php echo $master_siswa->J_tanggal_bekerja->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->J_nama_perusahaan->CellAttributes() ?>>
<div<?php echo $master_siswa->J_nama_perusahaan->ViewAttributes() ?>><?php echo $master_siswa->J_nama_perusahaan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->J_penghasilan->CellAttributes() ?>>
<div<?php echo $master_siswa->J_penghasilan->ViewAttributes() ?>><?php echo $master_siswa->J_penghasilan->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->kode_otomatis->CellAttributes() ?>>
<div<?php echo $master_siswa->kode_otomatis->ViewAttributes() ?>><?php echo $master_siswa->kode_otomatis->ListViewValue() ?></div></td>
		<td<?php echo $master_siswa->apakah_valid->CellAttributes() ?>>
<div<?php echo $master_siswa->apakah_valid->ViewAttributes() ?>><?php echo $master_siswa->apakah_valid->ListViewValue() ?></div></td>
	</tr>
<?php
	$master_siswa_delete->Recordset->MoveNext();
}
$master_siswa_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$master_siswa_delete->ShowPageFooter();
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
$master_siswa_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_siswa_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'master_siswa';

	// Page object name
	var $PageObjName = 'master_siswa_delete';

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
	function cmaster_siswa_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("master_siswalist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $master_siswa;

		// Load key parameters
		$this->RecKeys = $master_siswa->GetRecordKeys(); // Load record keys
		$sFilter = $master_siswa->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("master_siswalist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in master_siswa class, master_siswainfo.php

		$master_siswa->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$master_siswa->CurrentAction = $_POST["a_delete"];
		} else {
			$master_siswa->CurrentAction = "I"; // Display record
		}
		switch ($master_siswa->CurrentAction) {
			case "D": // Delete
				$master_siswa->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($master_siswa->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $master_siswa;

		// Call Recordset Selecting event
		$master_siswa->Recordset_Selecting($master_siswa->CurrentFilter);

		// Load List page SQL
		$sSql = $master_siswa->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$master_siswa->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($master_siswa->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_siswa->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $master_siswa;
		$DeleteRows = TRUE;
		$sSql = $master_siswa->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $master_siswa->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['kode_otomatis'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($master_siswa->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($master_siswa->CancelMessage <> "") {
				$this->setFailureMessage($master_siswa->CancelMessage);
				$master_siswa->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$master_siswa->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
}
?>

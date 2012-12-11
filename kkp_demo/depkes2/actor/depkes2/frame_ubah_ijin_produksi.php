<?
	require_once 'init.php';
	require_once 'auth.php';
	global $adodb;



print "
<head>
<link rel='stylesheet' href=".$path_theme."/style.css type='text/css'>
<style type='text/css'>
body {
	margin-top: 0px;
	margin-bottom: 0px;
	background-color: #eeeeff;
}
</style>
</head>
<body bgcolor=#eeeeff onLoad=\"\">
<table width=100% border=0 cellspacing=1 cellpadding=0 class=in_table >
<form name=theform method=post action=$PHP_SELF>
";
$no_surat_keputusan = $_GET['a'];
$sql = "SELECT
	surat_keputusan.no_surat_keputusan,
	surat_keputusan.no_surat_keputusan,
	pendaftar.nama_pabrik,
	pendaftar.alamat_pendaftar,
	pendaftar.notelp_1,
	pendaftar.nama_propinsi_1,
	pendaftar.npwp,
	pendaftar.nama_pabrik,
	pendaftar.alamat_pabrik,
	pendaftar.notelp_2,
	pendaftar.nama_propinsi_2,
	pendaftar.alamat_bengkel,
	pendaftar.notelp_3,
	pendaftar.alamatgudang,
	pendaftar.notelp_4,
	pendaftar.nama_direktur,
	pendaftar.namapenanggungjwb
	FROM
	surat_keputusan
	LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
	LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
	LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
	WHERE
	surat_keputusan.no_surat_keputusan='".$no_surat_keputusan."'
	ORDER BY
	surat_keputusan.no_surat_keputusan
";
$rs = $adodb->Execute($sql);
	$no_surat_keputusan = $rs->fields['no_surat_keputusan'];
	$alamat_pendaftar = $rs->fields['alamat_pendaftar'];
	$notelp_1 = $rs->fields['notelp_1'];
	$nama_propinsi_1 = $rs->fields['nama_propinsi_1'];
	$npwp = $rs->fields['npwp'];
	$nama_pabrik = $rs->fields['nama_pabrik'];
	$alamat_pabrik = $rs->fields['alamat_pabrik'];
	$notelp_2 = $rs->fields['notelp_2'];
	$nama_propinsi_2 = $rs->fields['nama_propinsi_2'];
	$alamat_bengkel = $rs->fields['alamat_bengkel'];
	$notelp_3 = $rs->fields['notelp_3'];
	$alamatgudang = $rs->fields['alamatgudang'];
	$notelp_4 = $rs->fields['notelp_4'];
	$nama_direktur = $rs->fields['nama_direktur'];
	$namapenanggungjwb = $rs->fields['namapenanggungjwb'];

print '
	<tr>
	<td width="300" align="right">
	<strong>Alamat Pemohon&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$alamat_pendaftar.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>No Telepon&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$notelp_1.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Propinsi&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$nama_propinsi_1.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>NPWP&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$npwp.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Nama Pabrik&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$nama_pabrik.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Alamat Pabrik&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$alamat_pabrik.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>No Telepon&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$notelp_2.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Propinsi&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$nama_propinsi_2.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Alamat Bengkel&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$alamat_bengkel.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>No Telepon&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$notelp_3.'&nbsp;&nbsp;	</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Alamat Gudang&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$alamatgudang.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>No Telepon&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$notelp_4.'&nbsp;&nbsp;	</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Nama Direktur/Pemilik&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$nama_direktur.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td width="300" align="right">
	<strong>Nama Penanggungjawab Teknis&nbsp; </strong></td>
	<td width="8">&nbsp;<strong>:</strong></td>
	<td width="627">&nbsp;'.$namapenanggungjwb.'&nbsp;&nbsp;</td>
	</tr>
';

print '
</form>
</table>
</body>';
?>

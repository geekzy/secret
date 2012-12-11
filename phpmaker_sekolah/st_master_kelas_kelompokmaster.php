<?php

// Call Row_Rendering event
$st_master_kelas_kelompok->Row_Rendering();

// tahun
// kelas
// nama_kelas_kelompok
// kode_otomatis
// apakah_valid
// kode_otomatis_tingkat
// Call Row_Rendered event

$st_master_kelas_kelompok->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->tahun->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kelas->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kode_otomatis->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->apakah_valid->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $st_master_kelas_kelompok->tahun->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->tahun->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->tahun->ListViewValue() ?></div></td>
			<td<?php echo $st_master_kelas_kelompok->kelas->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->kelas->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kelas->ListViewValue() ?></div></td>
			<td<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->ListViewValue() ?></div></td>
			<td<?php echo $st_master_kelas_kelompok->kode_otomatis->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->kode_otomatis->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kode_otomatis->ListViewValue() ?></div></td>
			<td<?php echo $st_master_kelas_kelompok->apakah_valid->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->apakah_valid->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->apakah_valid->ListViewValue() ?></div></td>
			<td<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>

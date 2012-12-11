<?php

// Call Row_Rendering event
$keu_laporan_keuangan->Row_Rendering();

// identitas
// A_nama_lengkap
// nama_biaya
// nilai_tanggungan_bruto
// tanggal_rencana_bayar
// diskon_sosial
// diskon_waktu
// diskon_prestasi
// diskon_internal
// diskon_lain_lain
// nilai_tanggungan_netto
// jum_cicilan
// kekurangan_pembayaran
// Call Row_Rendered event

$keu_laporan_keuangan->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->identitas->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->A_nama_lengkap->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->nama_biaya->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_sosial->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_waktu->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_prestasi->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_internal->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_lain_lain->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->jum_cicilan->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $keu_laporan_keuangan->identitas->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->identitas->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->identitas->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->A_nama_lengkap->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->A_nama_lengkap->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->A_nama_lengkap->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->nama_biaya->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nama_biaya->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nama_biaya->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->diskon_sosial->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_sosial->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_sosial->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->diskon_waktu->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_waktu->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_waktu->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->diskon_prestasi->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_prestasi->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_prestasi->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->diskon_internal->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_internal->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_internal->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->diskon_lain_lain->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_lain_lain->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_lain_lain->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->jum_cicilan->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->jum_cicilan->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->jum_cicilan->ListViewValue() ?></div></td>
			<td<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>

<?php

// Call Row_Rendering event
$master_transaksi2->Row_Rendering();

// penjelasan
// tanggal
// tipe_transaksi
// saldo_debet
// saldo_kredit
// Call Row_Rendered event

$master_transaksi2->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $master_transaksi2->penjelasan->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $master_transaksi2->tanggal->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $master_transaksi2->tipe_transaksi->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $master_transaksi2->saldo_debet->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $master_transaksi2->saldo_kredit->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $master_transaksi2->penjelasan->CellAttributes() ?>>
<div<?php echo $master_transaksi2->penjelasan->ViewAttributes() ?>><?php echo $master_transaksi2->penjelasan->ListViewValue() ?></div></td>
			<td<?php echo $master_transaksi2->tanggal->CellAttributes() ?>>
<div<?php echo $master_transaksi2->tanggal->ViewAttributes() ?>><?php echo $master_transaksi2->tanggal->ListViewValue() ?></div></td>
			<td<?php echo $master_transaksi2->tipe_transaksi->CellAttributes() ?>>
<div<?php echo $master_transaksi2->tipe_transaksi->ViewAttributes() ?>><?php echo $master_transaksi2->tipe_transaksi->ListViewValue() ?></div></td>
			<td<?php echo $master_transaksi2->saldo_debet->CellAttributes() ?>>
<div<?php echo $master_transaksi2->saldo_debet->ViewAttributes() ?>><?php echo $master_transaksi2->saldo_debet->ListViewValue() ?></div></td>
			<td<?php echo $master_transaksi2->saldo_kredit->CellAttributes() ?>>
<div<?php echo $master_transaksi2->saldo_kredit->ViewAttributes() ?>><?php echo $master_transaksi2->saldo_kredit->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>

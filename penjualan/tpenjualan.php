<?
session_start();
include ("ceklogin.inc.php");
include ("conn.inc.php");
include ("header.inc.php");

//kalo tombol dengan name btninput diklik
if(isset($_POST['btninput'])){
	//kalo ada variabel txtnojual yang dikirim
	if(isset($_POST['txtnojual'])){
		$globalnojual = $_POST['txtnojual'];
		$globalkdbrg = $_POST['cmbkdbrg'];
		//bmail dari detikjual
		$rs = mysql_query("select count(*) from detiljual where nourutjual='$globalnojual' and kodebarang='$globalkdbrg'");
		//barang yang diplih udah ada belum di detiljual
		$data = mysql_fetch_row($rs);
		if($data[0] > 0){
		    //kalo udah ada ya edit
			$rs = mysql_query("update detiljual set jumlahjual='".$_POST['txtjmljual']."' where nourutjual='$globalnojual' and kodebarang='$globalkdbrg'");
		} else {
		  
			//kalo belum ada ya insert
			$rs = mysql_query("insert into detiljual values('$globalnojual','$globalkdbrg','".$_POST['txtjmljual']."')");
		}
	} else {
	    //ini kalo baru buka form
		//masukin ke table penjualan
		$rs = mysql_query("insert into penjualan (tanggaljual,totaljual) values(now(),0)");
		//ambil no urut terakhir
		$rs = mysql_query("select max(nourutjual) from penjualan");
		$data= mysql_fetch_row($rs);
		$globalnojual = $data[0];
		//masukin data pertama ke detiljual
		$rs = mysql_query("insert into detiljual values('$globalnojual','".$_POST['cmbkdbrg']."','".$_POST['txtjmljual']."')");
	}
}

//ini kalo eidt atau delete
if(isset($_GET['act'])){
	$globalnojual = $_GET['nojual'];
	$globalkdbrg = $_GET['kdbrg'];
	switch($_GET['act']){
	    //edit dan berarti ambil datana dulu
		case 'e' : $rs = mysql_query("select kodebarang, jumlahjual from detiljual where nourutjual='$globalnojual' and kodebarang='$globalkdbrg'");
		$editdata = mysql_fetch_array($rs);
		break;
		//hapus
		case 'h' : $rs = mysql_query("delete from detiljual where nourutjual='$globalnojual' and kodebarang='$globalkdbrg'");
		break;
	}	
}
?>

<form method="post" action="tpenjualan.php">
<table border="0" width="100%" cellpadding="3" cellspacing="0" bgcolor="yellow">
	<tr>
		<td>
		<h2>Penjualan</h2>
		<? include ("menu.inc.php"); ?>
		</td>
	</tr>
<tr>
<td>
<table border="0" width="100%" bgcolor="lightgreen" cellpadding="2" cellspacing="0" class="tableborder">
<tr>
	<td width="50%">Nama Barang: <select name="cmbkdbrg">
	<?
	//bikin combobox untuk nama barang
	$rs = mysql_query("select kodebarang, namabarang from masterbarang order by namabarang");
	while($data = mysql_fetch_row($rs)){
		echo "<option value='$data[0]'";
		if(isset($editdata) && ($data[0]==$editdata[0])) echo " selected";
		echo ">$data[1]</option>";
	}
	?>
	</select>
	</td>
	<td>
		Jumlah Jual :
		<input type="text" name="txtjmljual" size="5" maxlength="5" value="<? if(isset($editdata)) echo $editdata[1] ?>">
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type="submit" name="btninput" value="Simpan">
	</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="garisputus">&nbsp;</td>
</tr>
<?

if(isset($globalnojual)){
?>
<tr>
	<td>
	<b>
	<?
	//ambil data penjualan
	$rs = mysql_query("select nourutjual, tanggaljual from penjualan where nourutjual='$globalnojual'");
	$dataHead = mysql_fetch_row($rs);
	?>
	No Jual <?=$dataHead[0] ?> <input type="hidden" name="txtnojual" value="<?=$dataHead[0]?>"><br>
	Tgl Jual <?=$dataHead[1]?><br>
	Kasir : <?=$_SESSION['snama']?>
	</b>
	<br><br><br><b><i>Detail Penjualan</i></b></td>
	<table border="0" width="100%" bgcolor="lightgreen" cellpadding="2" cellspacing="0">
	<tr>
	<td class="tableborder" align="center"><b>Kode Barang</b></td>
	<td class="tableborder" align="center"><b>Nama Barang</b></td>
	<td class="tableborder" align="center"><b>Jumlah Jual</b></td>
	<td class="tableborder" align="center"><b>Harga Jual</b></td>
	<td class="tableborder" align="center"><b>Total</b></td>
	<td class="tableborder" align="center" width="90">--perintah--</td>
</tr>
<?
//ambil data yang udah dibeli
$qryDtl = "select c.kodebarang, a.namabarang, c.jumlahjual,a.hargajualbarang, (c.jumlahjual * a.hargajualbarang) from masterbarang a, penjualan b, detiljual c WHERE a.kodebarang=c.kodebarang and b.nourutjual=c.nourutjual and b.nourutjual='$globalnojual'";

$rs = mysql_query($qryDtl);
$gtot = 0;
while($dataDtl=mysql_fetch_row($rs)){
?>
<tr>
<td class="tableborder"><?=$dataDtl[0]?></td>
<td class="tableborder"><?=$dataDtl[1]?></td>
<td class="tableborder" align="right"><?=$dataDtl[2]?></td>
<td class="tableborder" align="right"><?=$dataDtl[3]?></td>
<td class="tableborder" align="right"><?=$dataDtl[4]?></td>
<td class="tableborder" align="center">
<a href="tpenjualan.php?nojual=<?=$dataHead[0]?>&kdbrg=<?=$dataDtl[0]?>&act=e">Edit</a>
 | <a href="tpenjualan.php?nojual=<?=$dataHead[0]?>&kdbrg=<?=$dataDtl[0]?>&act=h">Hapus</a>

</td>
</tr>
<?
$gtot+=$dataDtl[4];
}
?>

<tr>
<td colspan="4" align="right"><font size="+2"><b>GRAND TOTAL : Rp.</b></font></td>
<td align="right"><font size="+2"><b><?=$gtot?></b></font></td>
</tr>
</table>
</td>
</tr>
<?
}
?>
</table>
</form>
<?
include("footer.inc.php");
?>
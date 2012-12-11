<?
//ini file input edit delete barang
session_start();
include ("ceklogin.inc.php");
include ("conn.inc.php");

//apakah tombol btninput udah diklik
if(isset($_POST['btninput'])){
	//jika value dari submit button adalah Simpan
	if($_POST['btninput']=="Simpan"){
		//cek dulu udah ada belum datanya
		$rs = mysql_query("select count(1) from masterbarang where kodebarang='".$_POST['txtkdbrg']."'");
		$data = mysql_fetch_row($rs);
		if($data[0]==0){
			//kalo belum ada berarti harus insert dulu donk
			$rs = mysql_query("insert into masterbarang values('".$_POST['txtkdbrg']."','".$_POST['txtnmbrg']."','".$_POST['txtstokbrg']."','".$_POST['txtsatbrg']."','".$_POST['txthrgjual']."')");
			$err = "Data sudah ditambahkan";
		} else {
		    //kalo udah ada berarti update ya
			$rs = mysql_query("update masterbarang set namabarang='".$_POST['txtnmbrg']."', stokbarang='".$_POST['txtstokbrg']."', setuanbarang='".$_POST['txtsatbrg']."',hargajualbarang='".$_POST['txthrgjual']."' where kodebarang='".$_POST['txtkdbrg']."'");
			$err = "Data sudah diupdate";
		}
	}
}

//ini kalo dpilih edit atau delete
//perhatikan kalo udah diklk edit atau delete, pada URL ada tambahan &act=(e/h)
if(isset($_GET['act'])){
	//ini act nya apa?
	switch($_GET['act']){
	    // e kalo edit
		//ambil dulu data barang yang akan diedit
		case "e" : 
			$rs = mysql_query("select * from masterbarang where kodebarang='".$_GET['id']."'");
			$getdata = mysql_fetch_row($rs);
			break;
		//d kalo delete
		case "h" : 
			$rs = mysql_query("delete from masterbarang where kodebarang='".$_GET['id']."'");
			$err = "masterbarang dengan kode '".$_GET['id']."' sudah dihapus !";
			break;
	}
}

include ("header.inc.php");
?>

<form method="post" action="mbarang.php">
<table border="0" width="100%" cellpadding="3" cellspacing="0" bgcolor="yellow">
	<tr>
		<td>
		<h2>Master Barang</h2>
		<? include ("menu.inc.php"); ?>
		<br />
		</td>
	</tr>
	
	<tr>
		<td>
		<b><i>Entry Data</i></b>
		<?
		//kalo udah ada variabel err
		if(isset($err)) echo "<div id='error'>$err</div><br>";
		?>
		<table border="0" width="100%" bgcolor="lightgreen">
		<tr>
			<td width="50%" align="right">Kode Barang : </td>
			<td>
			<input type="text" name="txtkdbrg" size="3" maxlength="2" <? if(isset($getdata)) echo "readonly" ?> value="<? //jika ada variabel $getdata (yg artinya edit) tampilkan datanya
			if(isset($getdata)) echo $getdata[0]?>" />
			</td>
		</tr>	
		<tr>
			<td align="right">Nama Barang : </td>
			<td>
				<input type="text" name="txtnmbrg" size="30" maxlength="50" value="<? if(isset($getdata)) echo $getdata[1] ?>" />
			</td>
		</tr>
		<tr>
			<td align="right">Stok Barang : </td>
			<td>
				<input type="text" name="txtstokbrg" size="5" maxlength="5" value="<? if(isset($getdata)) echo $getdata[2] ?>" />
			</td>
		</tr>
		<tr>
			<td align="right">Satuan Barang : </td>
			<td>
				<input type="text" name="txtsatbrg" size="10" maxlength="10" value="<? if(isset($getdata)) echo $getdata[3] ?>" />
			</td>
		</tr>
		<tr>
			<td align="right">Harga Jual: </td>
			<td>
				<input type="text" name="txthrgjual" size="8" maxlength="8" value="<? if(isset($getdata)) echo $getdata[4] ?>" />
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<input type="submit" name="btninput" value="Simpan" />&nbsp;&nbsp;
				<input type="submit" name="btninput" value="Batal" />
			</td>
		</tr>
		</table>
		
		</td>
	</tr>

	<tr>
		<td>
		<br><br><b><i>Daftar Lengkap</i></b>
		<table border="0" width="100%" bgcolor="lightgreen" cellpadding="2" cellspacing="0">
			<tr>
				<td class="tableborder" align="center"><b>Kode Barang</b></td>
				<td class="tableborder" align="center"><b>Nama Barang</b></td>
				<td class="tableborder" align="center"><b>Stok Barang</b></td>
				<td class="tableborder" align="center"><b>Satuan Barang</b></td>
				<td class="tableborder" align="center"><b>Harga Jual</b></td>
				<td class="tableborder" align="center" width="90"><b>==perintah==</td>
			</tr>
			
			<?
			//ambil data yang ada 
			$rs = mysql_query("select * from masterbarang order by namabarang");
			while($data=mysql_fetch_row($rs)){
				echo 
				"
				<tr>
				<td class='tableborder'>$data[0]</td>
				<td class='tableborder'>$data[1]</td>
				<td class='tableborder' align='right'>$data[2]</td>
				<td class='tableborder'>$data[3]</td>
				<td class='tableborder' align='right'>$data[4]</td>
				<td class='tableborder' align='center'><a href='mbarang.php?id=$data[0]&act=e'>Edit</a> |  <a href='mbarang.php?id=$data[0]&act=h'>Delete</a></td>
				</tr>
				";
			}
			?>
			
		</table>
		</td>	
	</tr>
</table>
</form>
<?
include ("footer.inc.php");
?>
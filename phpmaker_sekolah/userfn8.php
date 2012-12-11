<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}
include "Date.php"; 
global $pemakai,$sandi,$teratur;   
$pemakai="root";              
$sandi="";
$teratur="sekolah";
$_SESSION["tanggal"]=new Date();     

function isi_cicilan()   
{
				global $pemakai,$sandi,$teratur;       
				global $keu_cicilan; 
				$connection = mysqli_connect('localhost', $pemakai, $sandi, $teratur) 
					or die ("ERROR:11 Cannot connect $pemakai ");
				$sql = "SELECT  kekurangan_pembayaran FROM   keu_laporan_keuangan WHERE   
					kode_otomatis = '" . $keu_cicilan->kode_otomatis_tanggungan->getSessionValue() 
					 . "' ";
				$result =mysqli_query($connection, $sql) or die ("ERROR");
				$nilai=0;
				if (mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_row($result);
					$nilai=$row[0];
				}
				 else 
				{

					//echo "No records found!";
				}

				// close connection
				mysqli_close($connection);
				return $nilai;
}

function unik()
{                          
	$id = md5(uniqid(rand(), true));
	return $id;   
}            

function isi_nis()
{
	 global $conn;
	 $katasql="SELECT konter_siswa FROM identitas "   ;
	 $hasil=$conn->Execute($katasql);   
	 if ($hasil->RecordCount()>0 )
	 {               
		 $konter=$hasil->fields("konter_siswa");
	 }  
	 else
	 {
		 $konter=1;
	 }            
	 $sekarang=getdate();
	 $nis= $konter . "-" . $sekarang["year"];
	 $katasql="UPDATE identitas SET konter_siswa=konter_siswa +1 "   ;
	 $conn->Execute($katasql);
	 return $nis;
}
?>

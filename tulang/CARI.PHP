<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>Untitled Document</title>
</head>

<body>
<? include "kepala.php"; 
 include "includes/konek.php";
 ?>

<div align="center">
<table width="800" height="107" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF">
	<div align="center">
	
	  <table width="780" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="564" align="left" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="61" align="left" valign="top">
			  <div align="center">

<?
if($kategori=="gejala"){
	$jml=mysql_fetch_row(mysql_query("	
						select count(distinct(a.kode_penyakit)) 
						from penyakit a, gejalapenyakit b, gejala c 
						where a.kode_penyakit=b.kd_penyakit and c.kode_gejala=b.kd_gejala 
						and c.nama_gejala like'%$key%'"));
	$sql=mysql_query ("	SELECT distinct(a.kode_penyakit), a.nama_penyakit, a.definisi, a.keterangan 
						FROM penyakit a, gejalapenyakit b, gejala c 
						WHERE a.kode_penyakit=b.kd_penyakit and c.kode_gejala=b.kd_gejala 
						and c.nama_gejala like'%$key%' 
						order by a.nama_penyakit asc");
	echo $key;
}else{
	$jml=mysql_fetch_row(mysql_query("select count(kode_penyakit) from penyakit where nama_penyakit like'%$key%'"));
	$sql=mysql_query ("select * from penyakit where nama_penyakit like'%$key%' order by nama_penyakit asc");
}
?>
<table width="90%" border="1" bordercolor="#EEEEEE" align="center" cellspacing="0" cellpading="0">
  <tr><td>HASIL PENCARIAN</td></tr>
  <tr><td>Terdapat <? echo $jml[0]; ?> penyakit telah ditemukan</td></tr>
  <tr> 
    <td align="left" class="hasilcari">
        
  <? 
  	
    
    while ($row = mysql_fetch_row ($sql))
	{
		echo "<a href='detail.php?id=$row[0]'> >> $row[1]</a><br>";
		$string=explode(" ",$row[2]);
		$penggalan="";
		for($i=0;$i<5;$i++) $penggalan=$penggalan." ".$string[$i];
		if (!$string[$i]=="")
		$penggalan=$penggalan."....";
		echo "$penggalan<br>";
		$string2=explode(" ",$row[3]);
		$penggalan2="";
		for($i=0;$i<5;$i++) $penggalan2=$penggalan2." ".$string2[$i];
		if (!$string2[$i]=="")
		$penggalan2=$penggalan2."....";
		echo "$penggalan2<br>";
		echo "<hr width='400' color='#999999' size='1'>"; 
	}
?>

</td></tr>
</table>
</div>   
              
			  <p>&nbsp;</p>


</div>
				
				    </td>
            </tr>
          </table>            <h1>&nbsp;</h1>            </td>
          <td width="210" align="left" valign="top" bgcolor="#F7F7F2">
		  
		  
<? include"kanan.php"; ?>

	  </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top">
		  
		  	<div class="footer">
	
		Rudi Budi Dewanto 03018078

	</div>
	
		  </td>
          </tr>
      </table>
	  
	  

	  <br />
	  	</td>
  </tr>
</table>
</div>
</body>
</html>


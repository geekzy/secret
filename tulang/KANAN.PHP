<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>Untitled Document</title>
</head>

<body>

		  
		  <script language="JavaScript" type="text/JavaScript">
	function cek(){
	   if (document.frmCari.key.value == "")
	   {
	   		alert ("Masukkan kata kunci pencarian");
			document.frmCari.key.focus();
	      	return false;
	   }
	}
</script>

		  <div class="sidenav">

			<h2>Interaktif</h2>
			<ul>
				<li><a href="bukutamu.php">Buku Tamu </a></li>
				<li><a href="forum.php">Forum Diskusi </a></li>
			</ul>
			<br />
			
			<div align="center">
			<table width="90%" border="0" cellspacing="0" cellpadding="0">
             
              <tr>
                <td>
				<br />
						Pencarian
		<form action="cari.php" method="post" name="frmCari" onSubmit="return cek()">
	    <input name="key" type="text" size="20">
        <br>
	<select name="kategori" style="height:inherit;">
          <option value="nama">Nama Penyakit</option>
          <option value="gejala">Gejala Penyakit</option>
        </select>
        <br>
        
        <input type="submit" name="Submit2" value="Cari" class="tombol" >
      </form>				</td>
              </tr>
            </table>
			</div>
		</div>	
</body>
</html>

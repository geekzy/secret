<?php
include 'dashboard.php';
?>
<html>
<head>
	<title>User</title>
<!--Bootstrap-->
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../style/tampiluser.css">
</head>

<body>
	<br><br><br><br><br>
	<div class = "container">
		<div class = "row">
			<div class = "span12">
				<form class = "form-horizontal">
					<div class="alert alert-block">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  	<h2><em>&nbsp;&nbsp;&nbsp; Management User</h2></em>
					  		Tempat Dimana Admin Mengetahui Siapa User dan Admin itu Sendiri
					</div>
					
				</form>
				<form class = "form-stacked well" method = "">
					<table class = "table table-bordered">
						<tr><th>Nomor</th>
							<th>Username</th>
							<th>Nama Lengkap</th>
							<th>Email</th>
							<th>Level</th>
							<th align = "center">Aksi</th>
						</tr>
					<?php
				include '../config/koneksi.php';
				$tampil=mysql_query("select * from user order by username");
				$no=1;
				while ($r=mysql_fetch_array($tampil)) {
					# code...
					echo "	<tr><td>$no</td>
								<td>$r[username]</td>
								<td>$r[nama]</td>
								<td><a href=mailto:$r[email]>$r[email]</a></td>
								<td>$r[level]</td>
								<td><a href = edituser.php?id=$r[username]>Edit</a></td>
								<td><a href = deleteuser.php?id=$r[username]>Delete</a></td>
							</tr>";
							$no++;
									}
					echo "</table>";
				?>
				</form>	
				
				<form class = "form-horizontal" method = "POST" action = "">
					<div class = " nav nav pull-right">
                    	<ul>
							<a class="btn btn-info" href="tambahuser.php"><li class="icon-plus-sign"></li> Tambah User</a>
								<input class = "btn  btn-primary" type = "button" value = 'Cari'>
								<input class = "input-medium search-query" type = "text" name = "cari" placeholder = "Input Name . . .">
                        </ul> 
					</div>
				</form><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<div class="progress progress-striped active">
					  	<div class="bar" style="width: 100%;"></div>
					</div>
			</div>
		</div>
	</div>
</body>
</html>


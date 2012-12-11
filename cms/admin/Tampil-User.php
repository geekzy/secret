<?php
	session_start();
	require '../config/koneksi.php';
	include 'Admin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Users Management</title>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
	<script type="text/javascript" src="../style/bootstrap/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
			function confirmDelete(delUrl) {
		  if (confirm("Are you sure you want to delete")) {
		    document.location = delUrl;
		  }
		}
	</script>
</head>
<style type="text/css">
	body{background-image:url(../img/grid-18px-masked.png);
	background-repeat:repeat;}
</style>
<body>	
		<div class="container">
			<div class="row">
				<div class="span12">
					<form class="form-horizontal">
						<h3>Users Management</h3><hr>
					</form>
				</div>
				<div class="span7">
					<fieldset>
						<form class="form-stacked well" method="POST" action="">
								<input type="text" placeholder="Input ID or Your Name ..."> &nbsp;<a class="btn"><li class="icon-search "></li> Search</a>&nbsp;<a class="btn" href="AddUser.php"><li class="icon-plus-sign"></li> Add New user</a>
						</form>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<form class="form-vertical">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Username</th>
									<th>Nama Lengkap</th>
									<th>Email</th>
									<th>Keterangan</th>
								</tr>							
							</thead>
							<?php 
 								$tampil = mysql_query("SELECT * FROM user ORDER BY iduser");
								$data= 0;
								 while ( $hasil = mysql_fetch_array($tampil)) {
									echo "	<tbody>
												<tr>
													<td>$hasil[iduser]</td>
													<td>$hasil[username]</td>
													<td>$hasil[namalengkap]</td>
													<td><a href=mailto:$hasil[email]>$hasil[email]</a></td>
													<td>$hasil[level]</td>
													<td><a href=EditUser.php?iduser=$hasil[iduser]><i class='icon-edit'></i> Edit</a></td>
													<td><a href=../controller/delete.php?iduser=$hasil[iduser] onclick=confirmDelete()><i class='icon-remove'></i> Hapus</a></td>
												</tr>
											</tbody
										 ";	
										 $data++; 	
								 }
								?>
						</table>
					</form>
					
				</div>
			</div>
		</div>
</body>
</html>
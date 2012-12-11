<?php
	session_start();
	require '../config/koneksi.php';
	include 'Admin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>News Management</title>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
	<script type="text/javascript" src="../style/bootstrap/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>
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
							<h3>News Management</h3>
							<hr>
						</form>
					</div>
					<div class="span6">						
						<fieldset>
							<form class="form-horizontal well" method="POST" action="###">
									<input type="text" placeholder="Input Judul .."> &nbsp;<a class="btn"><li class="icon-search "></li> Search</a>&nbsp;<a class="btn" href="AddNews.php"><li class="icon-plus-sign"></li> Add News</a>
								
							</form>
						</fieldset>						
					</div>
					<div class="span12">
						<form class="form form-vertikal">
							<table class="table table-hover table-bordered - table-striped">
								<thead>
									<tr>
										<td>No</td>
										<td>Judul</td>
										<td>Author</td>
										<td>Content</td>
										
									</tr>
								</thead>							
							</table>
						</form>
					</div>
				</div>
			</div>
		
</body>
</html>
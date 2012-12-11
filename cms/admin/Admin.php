<?php
session_start();
	require '../config/koneksi.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/default.css"/>
	<style>
    body {
    padding-top: 60px; /* When using the navbar-top-fixed */
    }
	</style>
	<script type="text/javascript" src="../style/bootstrap/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>
	<script language="javascript">
        $(function() {
      // Setup drop down menu
      $('.dropdown-toggle').dropdown();
     
      // Fix input element click problem
      $('.dropdown input, .dropdown label').click(function(e) {
        e.stopPropagation();
      });
    });
</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="navbar navbar-inverse navbar-fixed-top">
				        <div class ="navbar-inner">
				            <div class="container-fluid">				            
				                <a class="brand" href="Admin.php"><?php echo "Selamat Datang ".$_SESSION['username'];?></a>
				                <div class="nav-collapse"> 
				                    <ul class="nav nav pull-right">
				           				<li class="active"><a href="Admin.php"><i class="icon-home icon-white"></i> Home</a></li>
				           				<li class=""><a href="Tampil-User.php"><i class="icon-user icon-white"></i> User Management</a></li>
				           				<li class=""><a href="Tampil-News.php"><i class="icon-th-list icon-white"></i> News Management</a></li>
				           				<li class="dropdown">
				           					<a href="Tampil-Mhs.php" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th-list icon-white"></i> College Management <strong class="caret"></strong></a>
				           					<ul class="dropdown-menu">
				           						<li><a href="">Daftar Nilai</a></li>
				           						<li><a href="">Daftar Mahasiswa</a></li>
				           						<li><a href="">Pengisian Nilai Mahasiswa</a></li>
				           					</ul>
				           				</li>
				           				<li class=""><a href="Tampil-Cln.php"><i class="icon-th-list icon-white"></i> New College Management</a></li>
				           				<li class="divider-vertical"></li>
				           				<li class="dropdown">
				           					<a href="###" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-fire icon-white"></i> Settings <strong class="caret"></strong></a>
				           					<ul class="dropdown-menu">
				           						<li><a href="###">My Profile</a></li>
				           						<li><a href="resume.php">Portofolio</a></li>
				           						<li><a href="logout.php">Logout</a></li>
				           					</ul>
				           				</li>
				                    </ul>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
	</div>
	
</body>
</html>
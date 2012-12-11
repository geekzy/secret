<?php
	session_start();
	error_reporting(0);
	include "timeout.php";
	if ($_SESSION[login]== 1) {
		if (!ceklogin()) {
			$_SESSION[login] = 0;
		}
	}


	if ($_SESSION[login] == 0) {
		header("location:index.php".mysql_error());
	}else{
		if (empty($_SESSION['username']) AND empty($_SESSION['password']) AND $_SESSION['login'] == 0) {
			echo "Anda tidak Berhak Mengakses Halaman Ini";
		}else{
	}
?>

<html>
<head>
	<title>Administrator Blog</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/default.css">


	<script type="text/javascript" src="style/bootstrap/js/jquery-1.8.2.min.js"></script>
	<script src="style/bootstrap/js/jquery-1.7.1.min.js"></script>
	<script src="style/bootstrap/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="style/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="style/bootstrap/js/bootstrap.min.js"></script>
	<script src="script.js"></script>

	
</head>
<body>
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" ></button>
						<a href="media.php?module=home" class="brand">&nbsp;&nbsp;Halaman <?php echo $_SESSION[level]; ?></a>					
					<div class="nav-collapse collapse">
						<ul class ="nav">
							<li class="active"><a href="media.php?module=home" class=""><i class="icon-home icon-white"></i> Home</a></li>
							<?php include "menu.php" ?>				
						</ul>
						<ul class="nav pull-right">
							<li class="divider-vertical"></li>
		           				<li class="dropdown">
		         					<a href="###" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-fire icon-white"></i> My Profile<strong class="caret"></strong>&nbsp;&nbsp;&nbsp;&nbsp;</a>
				  					<ul class="dropdown-menu">				           				
				           				<li><a href="resume.php">Portofolio</a></li>
				           				<li><a href="logout.php">Logout</a></li>
			    					</ul>
				       			</li>
						</ul>
					</div>
			</div>
		</div>
		<div class="container">
			<div class="content">
				<?php 	
						session_start(); 
						include "content.php"; 
				?>
			</div>
			<!-- <div class="footer">
				<div class="navbar navbar-inverse">
					<div class="navbar-inner">
						<div class="nav-collapse collapse">
						Copyright &copy; 2012 by Bayu Nugroho
						</div>
					</div>
				</div>
			</div> -->
		</div>
        
        <div class="">
</body>
</html>
<?php
}
?>
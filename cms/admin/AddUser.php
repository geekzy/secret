<?php
	session_start();
 	include 'Admin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Add User</title>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/default.css"/>
	
	<!--<script type="text/javascript" src="../style/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>-->
</head>
<body>
		<div class="container">
			<div class="row">
				<div class="span7 offset5 ">
					<form class="form-horizontal well" method="POST" action="../controller/insert.php" id="registerHere">
						<fieldset>
							<legend>Add User</legend>
							<div class="control-group">
								<label class="control-label" for="idusername">ID User</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-star"></strong></span>
										<input type="text" class="input-small" id="idusername" name="idusername" rel="popover" data-content="Enter Your User ID". data-original-title="ID User" placeholder="input your User ID..">
									</div>
								</div>								
							</div>

							<div class="control-group">
								<label class="control-label" for="username">Username</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-user"></strong></span>
										<input type="text" class="input-large" id="username" rel="popover" value="<?=@$_REQUEST['username']?>" name="username" data-content="Enter Your Username". data-original-title="Username" placeholder="input username..">
										<span id="validateUsername"><?php if ($error) { echo $error['msg']; } ?></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class=""></strong></span>
										<input type="password" class="input-large" id="password" rel="popover" name="password" data-content="Enter Your Password". data-original-title="passworrd" placeholder="input your password..">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="namalengkap">Nama Lengkap</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-star"></strong></span>
										<input type="text" class="input-large" id="namalengkap" name="namalengkap" rel="popover" data-content="Enter Your Nama Lengkap". data-original-title="Nama_Lengkap" placeholder="input your name..">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="email">Email</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-envelope"></strong></span>
										<input type="text" class="input-large" id="email" name="email" rel="popover" data-content="Enter Your Email Address". data-original-title="Email" placeholder="input your email addres..">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"></label>
								<div class="controls">
									<button type="submit" class="btn btn-success">Save</button> <button type="reset" class="btn btn-success" onclick="window.history.back()"> Cancel</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>

		<!-- Validate plugin -->
		<script  src="../style/bootstrap/js/jquery-1.8.2.min.js"></script>
		<script  src="../style/bootstrap/js/jquery.validate.min.js"></script>
		<script  src="script.js"></script>

    
		<!-- Scripts specific to this page -->
		
</body>
</html>
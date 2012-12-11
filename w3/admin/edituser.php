<?php
session_start();
include 'dashboard.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" name = "viewport"/>
<title>Edit User</title>
<!--BOOTSTRAP -->
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../style/tambahuser.css">
<link href="../style/style.css" = "stylesheet">

</head>


<body>
 <br />
    <br />
    <br />
    <br />
    <br />
    <br />
	<div class="container">
    	<div class="row">
            <div class="span12">
            	<?php
            	include '../config/koneksi.php';
            	$edit = mysql_query("select* from user where username = '$_GET[id]'");
				$r = mysql_fetch_array($edit);
				echo "<legend> Edit Form</legend>
            	<form class='form-horizontal well' action='update.php' method='POST' id = 'registhere'>
                    
                	<div class='control-group'>
                    	<label class='control-label' for='inputusername'>Username :</label>
                        <div class='controls'>
                        <input class='input-medium' type='text' id='inputusername' name = 'inputusername' placeholder='Your Username' />
                        </div>
                    </div>
                    <div class='control-group'>
                    	<label class='control-label' for='inputpassword'>Password : </label>
                        <div class='controls'>
                        <input class='input-medium' type='password' id='inputpassword' placeholder='Your Password' name = 'inputpassword' />
                        </div>
                    </div>
                    <div class='control-group'>
                    	<label class='control-label' for='inputnama'>Nama Lengkap : </label>
                        <div class='controls'>
                        <input class='input input-medium' type='text' id='inputnama' placeholder='Your Name' name = 'inputnama' />
                        </div>
                    </div>
                    <div class='control-group'>
                    	<label class='control-label' for='inputemail'>Email : </label>
                        <div class='controls'>
                        <input class='input input-medium' type='text' id='inputemail' placeholder='Your Email' name = 'inputemail' />
                        </div>
                    </div>
                    <div align = 'center'>
                         <button class = 'btn btn-inverse' type = 'submit'>Submit</button> <button class = 'btn btn-info' type = 'reset'>Reset</button>
                    </div>
            
                </form>"
                ;
            	?>
            
          	</div>
            </div>
        </div>
   </div>
   <!-- ==============================================
         JavaScript below!                                                          -->

<!-- jQuery via Google + local fallback, see h5bp.com -->
   <script src="../style/bootstrap/js/jquery-1.8.2.min.js"></script>
<!-- Validate plugin -->   
   <script src ="../style/bootstrap/js/jquery.validate.min.js"></script>
   <!-- Scripts specific to this page -->

   <script src ="../style/script.js"></script>
</body>
</html>
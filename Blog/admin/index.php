<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>..::: Login Administrator :::..</title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap-min.css">





	<script src="style/bootstrap/js/jquery-1.7.1.min.js"></script>
	<script src="style/bootstrap/js/jquery-validate.js"></script>
	<script src="script.js"></script>
</head>
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #323547;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"],
      .form-signin .input-prepend{
        /*font-size: 16px;
        height: auto;
        padding: 7px 9px;*/
        margin-bottom: 10px;
      }
      

    </style>
    
<body Onload="document.form-signin.username.focus();">
	<div class="container">
      <form class="form-signin" method="POST" action="ceklogin.php">
      	<fieldset>
	        <h1 class="form-signin-heading"><legend>Please sign in</legend></h1>
	        <div class="control-group">
	        	<div class="input-prepend">
	        		<div class="controls">
	        			<span class="add-on">@</span>
	        			<input type="text" placeholder ="Username" name="username" id="username" for="name">
	        		</div>
	        	</div>
	        	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="password" placeholder ="Password" name="password" id="password">
				</div>
				<label class="checkbox" >					
				    <input type="checkbox" >Remember me
				</label>
				<button class="btn btn-primary btn-block" data-loading-text="Loading...">Sign In</button>
	        </div>
      	</fieldset>
      </form>
    </div>
</body>
</html>
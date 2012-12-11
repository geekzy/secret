<?php
  session_start();
  include ("../config/koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../style/default.css"/>
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
<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">
    <!-- HEADER --> 
    <div class="container">
   		<div class="navbar navbar-inverse navbar-fixed-top">
        <div class ="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="index.php">Admin Login</a>
                <div class="nav-collapse collapse"> 
                    <ul class="nav pull-right tabs" data-tabs="tabs">
                      <!-- <li class="dropdown">
                        <a class="" href="##"><i class="icon-plus-sign icon-white"></i>&nbsp;Register
                        </a>  
                       </li> -->
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="##"><i class="icon-home icon-white"></i>&nbsp;Sign In
                                <strong class="caret"></strong>
                            </a>
                            <div class="dropdown-menu" style="padding:20px; padding-bottom:0px;">
                                <form action="session.php" method="POST" accept-charset="UTF-8">
                                    <div class="input-prepend">
                                        <span class="add-on"><strong class="icon-user"></strong></span>
                                         <input style="margin-bottom: 15px;" type="text" placeholder="Username" name="username" />
                                         
                                    </div>
                                    <div class="input-prepend">
                                        <span class="add-on"><strong class="icon-lock"></strong></span>
                                         <input style="margin-bottom: 15px;" type="password" placeholder="Passsword" name="password" />
                                    </div>

                                         <input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="user[remember_me]" value="1" />
                                         <label class="string optional" for="user_remember_me"> Remember me</label>
                                         <input class="btn btn-primary"  type="submit" name="commit" value="Sign In" />
                                </form>                                
                            </div>
                        </li>                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
    <!-- Wrap -->    

    <!-- Footer -->
</body>
</html>
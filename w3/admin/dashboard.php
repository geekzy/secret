<?php
    session_start();
    include '../config/koneksi.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Dashboard</title>
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../style/dashboard.css">

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
            <div class="navbar-inner">
            	<div class="container">
                	<button type="button" class="btn btn-navbar" data-toggle ="collapse" data-target = ".nav-collapse">
                    	<span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        	<div class="nav-collapse">
                            	<ul class="nav-pills nav pull-left">
                                	<li class=""><a href="dashboard.php"><i class="icon-home icon-white"></i> Home</a></li>
                                    <li class=""><a href="tampiluser.php"><i class="icon-user icon-white" style="padding-right:10px"></i>User Management</a></li>
                                    <li class=""><a href="tampilberita.php"><i class="icon-th-list icon-white" style="padding-right:10px"></i>Top News</a></li>
                                    <li class="divider-vertical"></li>
                                    <li class="dropdown" style=" padding-left:0px">
                                    	<a href="" class="dropdown-toggle" data-toggle = "dropdown">
                                            <i class="icon-arrow-down icon-white" style="padding-right:10px"></i>Setting<strong class="caret"></strong>
                                        </a>
                                        	<ul class="dropdown-menu">
                                            	<li><a href="">About Me</a></li>
                                                <li><a href="">Log Out</a></li>
                                            </ul>
                                    </li>
                                </ul>
                                <ul class="nav pull-right">
                                     <li ><a href="" class="brand">Dashboard</a></li>
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
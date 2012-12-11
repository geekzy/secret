<?php
    session_start();
    include '../config/koneksi.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Login</title>
<!--BOOTSTRAP -->
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../style/admin.css">
</head>
<body>
    <div class="lg-container">
        <h1>Admin Area</h1>
        <form action="session.php" id="lg-form" name="lg-form" method="post">
            
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="username"/>
            </div>
            
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="password" />
            </div>
            
            <div>               
                <button type="submit" id="login">Login</button>
            </div>
            
        </form>
        <div id="message"></div>
    </div>

</body>
</html>

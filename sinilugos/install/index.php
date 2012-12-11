<?php
session_start();
if (trim($_POST['continue']) != '') {
    $_SESSION['db_hostname'] = $_POST['db_hostname'];
    $_SESSION['db_username'] = $_POST['db_username'];
    $_SESSION['db_password'] = $_POST['db_password'];
    $_SESSION['db_name'] = $_POST['db_name'];
    header("location: kedua.php");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Installasi | Sinilugos&#174;</title>
        <link href="./data/css.css" rel="stylesheet" type="text/css" />
        <link type="image/x-icon" href="./data/favicon.ico" rel="Shortcut icon" />
    </head>
    <body>
        <div id="navigasi">
            <div class="breadcrumb">
                <ul>
                    <li class="home"><a href="index.php"><strong>Mulai Install</strong></a> </li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div id="judul">
                <strong>Mulai Install</strong>
            </div>
            <div class="isi">
                <h1>Selamat Datang</h1>
                <h3>Terima kasih telah menggunakan <b>sinilugos</b></h3>
                <p>
			Ini adalah halaman untuk menginstall applikasi sinilugos ke server anda. <br />
			Sebelum melanjutkan proses berikutnya, silahkan pastikan server anda telah memenuhi persyaratan, minimal seperti ini:
                </p>
                <table class="table-list" style="width:800px;">
                    <tr>
                        <th>Web Server</th>
                        <td>: Apache, Apache2, Nginx.</td>
                    </tr>
                    <tr>
                        <th>PHP Server</th>
                        <td>: PHP Versi 4.3.2, atau yang terbaru.</td>
                    </tr>
                    <tr>
                        <th>Database Client/Server</th>
                        <td>: MySQL Versi 5.0 (InnoDB Table), atau yang terbaru.</td>
                    </tr>
                    <tr>
                        <th>GD Library</th>
                        <td>: GD Library Versi 1.0, atau yang terbaru.</td>
                    </tr>
                    <tr>
                        <th>Atau Server Paketan</th>
                        <td>: Seperti (Xampp, Lampp, Wampp yang sudah include semua ke empat paket diatas.).</td>
                    </tr>
                    <tr>
                        <th>Sistem Operasi</th>
                        <td>: Linux, Mac, IBM, BSD, Solaris, Windows.</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <form method="get" action="pertama.php">
                                <input type="submit" value="Lanjutkan >>" />
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2011 Mahasiswa Universitas Pamulang. All rights reserved.</p>
        </div>
    </body>
</html>

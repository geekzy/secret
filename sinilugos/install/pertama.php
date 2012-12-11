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
                    <li><a href="#"><strong>Database</strong></a> </li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div id="judul">
                <strong>Step 1 - ke 3 : Konfigurasi Database</strong>
            </div>

            <div align="center" style="padding-top:10px">

                <h1>Step 1: Konfigurasi Database</h1>
                <br />
                <br />

                <?php
                if (trim($_POST['test']) != '') {
                    $hostname = $_POST['db_hostname'];
                    $username = $_POST['db_username'];
                    $password = $_POST['db_password'];
                    $name = $_POST['db_name'];
                    $connect = @mysql_connect($hostname, $username, $password);
                    if ($connect) {
                        $db_message = "Database konek, silahkan klik lanjutkan.";
                        $class = "petunjuk-area";
                    }
                    else {
                        $db_message = "Database nggak konek, mungkin passwordnya salah!";
                        $class = "notebox-warning";
                    }
                }
                else {
                    $hostname = 'localhost';
                    $username = 'root';
                    $password = '';
                    $name = 'sinilugos';
                }
                ?>
                <form method="post">
                    <table class="table-list" style="width:500px">
                        <tr>
                            <th>Alamat Host</th>
                            <td>:</td>
                            <td>
                                <input name="db_hostname" type="text" size="40" value="<?php echo $hostname ?>"></td>
                        </tr>
                        <tr>
                            <th>Username Mysql</th>
                            <td>:</td>
                            <td>
                                <input name="db_username" type="text" size="40" value="<?php echo $username?>"></td>
                        </tr>
                        <tr>
                            <th>Password Mysql</th>
                            <td>:</td>
                            <td>
                                <input name="db_password" type="password" size="40" value="<?php echo $password?>"></td>
                        </tr>
                        <tr>
                            <th>Nama Database</th>
                            <td>:</td>
                            <td>
                                <input name="db_name" type="text" size="40" value="<?php echo $name?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input name="test" type="submit" value="Tes Koneksi" />
                                <?php if ($connect) { ?>
                                <input name="continue" type="submit" value="Lanjutkan >>" />
                                    <?php } ?>
                            </td>
                        </tr>
                    </table>
                </form>

                <?php
                if (trim($_POST['test']) != '') {
                    ?>
                <div class="<?php echo $class ?>">
                    <h2><?php echo $db_message ?></h2>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2011 Mahasiswa Universitas Pamulang. All rights reserved.</p>
        </div>
    </body>
</html>

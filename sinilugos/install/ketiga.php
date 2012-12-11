<?php
session_start();
$hostname = $_SESSION['db_hostname'];
$username = $_SESSION['db_username'];
$password = $_SESSION['db_password'];
$connect = @mysql_connect($hostname, $username, $password);
if (!$connect) {
    header("location: index.php");
}
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

function is_really_writable($file) {
    if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE) {
        return is_writable($file);
    }

    if (is_dir($file)) {
        $file = rtrim($file, '/').'/'.md5(rand(1,100));

        if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE) {
            return FALSE;
        }

        fclose($fp);
        @chmod($file, DIR_WRITE_MODE);
        @unlink($file);
        return TRUE;
    }
    elseif (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE) {
        return FALSE;
    }

    fclose($fp);
    return TRUE;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Installasi | Sinilugos&#174;</title>
        <link href="./data/css.css" rel="stylesheet" type="text/css" />
        <link type="image/x-icon" href="./data/favicon.ico" rel="Shortcut icon" />
    </head>
    <body>
        <a name="top"></a>
        <div id="navigasi">
            <div class="breadcrumb">
                <ul>
                    <li class="home"><a href="index.php"><strong>Mulai Install</strong></a> </li>
                    <li><a href="pertama.php"><strong>Database</strong></a> </li>
                    <li><a href="kedua.php"><strong>Periksa Server</strong></a> </li>
                    <li><a href="#"><strong>Hak Akses</strong></a> </li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div id="judul">
                <strong>Step 3 - ke 3 : Meriksa hak akses folder & file</strong>
            </div>
            <div align="center">
                <br />
                <br />
                <?php
                $folders = array(
                        '/',
                        '/data',
                        '/application/cache'
                );
                $files = array(
                        '/index.php',
                        '/application/config/andi/config.php',
                        '/application/config/andi/database.php'
                );
                $checked = TRUE;
                ?>
                Step ini khusus sistem operasi unix & keluarganya.
                <h3>Hak akses folder</h3>
                <table class="table-list" style="width:600px">
                    <?php foreach($folders as $folder) { ?>
                    <tr>
                        <th><?php echo $folder ?></th>
                        <td>
                                <?php
                                @chmod("../".$folder,0755);
                                if (is_really_writable("../".$folder)) {
                                    echo "<font style='color:green'>Writeable</font>";
                                    echo "<img style='float:right' src='data/checked.png'>";
                                }
                                else {
                                    $checked = FALSE;
                                    echo "<font style='color:red'>Read Only</font>";
                                    echo "<img style='float:right' src='data/unchecked.png'>";
                                }
                                ?>
                        </td>
                    </tr>
                        <?php } ?>
                </table>
                <br>
                <h3>Hak akses file</h3>
                <table class="table-list" style="width:600px">
                    <?php foreach($files as $file) { ?>
                    <tr>
                        <th><?php echo $file ?></th>
                        <td>
                                <?php
                                @chmod("../".$file,0755);
                                if (is_really_writable("../".$file)) {
                                    echo "<font style='color:green'>Writeable</font>";
                                    echo "<img style='float:right' src='data/checked.png'>";
                                }
                                else {
                                    $checked = FALSE;
                                    echo "<font style='color:red'>Read Only</font>";
                                    echo "<img style='float:right' src='data/unchecked.png'>";
                                }
                                ?>
                        </td>
                    </tr>
                        <?php } ?>
                </table>
                <?php if ($checked == TRUE) { ?>
                <br />
                <div class="petunjuk-area">
                    <h2>Server anda sudah memenuhi semua kebutuhan instalasi, klik install untuk menginstall.</h2>
                </div>
                <form method="post" action="install.php">
                    <input type="submit" value="Install" />
                </form>
                    <?php }

                else { ?>
                <br />
                <div class="notebox-warning">
                    <h2>Pastikan semua folder dan file di atas dalam status <em>writeable</em> yahh!!</h2>
                </div>
                    <?php } ?>
            </div>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2011 Mahasiswa Universitas Pamulang. All rights reserved.</p>
        </div>
    </body>
</html>

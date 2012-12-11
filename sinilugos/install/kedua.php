<?php
session_start();
$hostname = $_SESSION['db_hostname'];
$username = $_SESSION['db_username'];
$password = $_SESSION['db_password'];
$connect = @mysql_connect($hostname, $username, $password);
if (!$connect) {
    header("location: index.php");
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
                    <li><a href="pertama.php"><strong>Database</strong></a> </li>
                    <li><a href="#"><strong>Periksa Server</strong></a> </li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div id="judul">
                <strong>Step 2 - ke 3 : Meriksa Persyaratan Server</strong>
            </div>
            <div align="center" style="padding-top:10px">
                <h1>Step 2: Meriksa Persyaratan Server</h1>
                <br />
                <br />
                <table class="table-list" style="width:600px">
                    <tr>
                        <th>Applikasi Server</th>
                        <td>
                            <?php
                            $checked = TRUE;
                            $php = preg_replace('/[^0-9\.]/','', phpversion());
                            if ($php>=4.32) {
                                if (function_exists('apache_get_version')) echo apache_get_version()."<img style='float:right' src='data/checked.png'>";
                                else echo "Versi PHP ".phpversion()."<img style='float:right' src='data/checked.png'>";
                            }
                            else {
                                if (function_exists('apache_get_version')) echo apache_get_version()."<img style='float:right' src='data/unchecked.png'>";
                                else echo "Versi PHP ".phpversion()."<img style='float:right' src='data/unchecked.png'>";
                                $checked = FALSE;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>MySQL Server</th>
                        <td>
                            <?php
                            if (function_exists('mysql_get_server_info')) {
                                $db = @mysql_connect($_SESSION['db_hostname'],$_SESSION['db_username'],$_SESSION['db_password']);
                                $mysql_server = preg_replace('/[^0-9\.]/','', @mysql_get_server_info($db));
                                if ($mysql_server>=5) {
                                    echo @mysql_get_server_info($db);
                                    echo "<img style='float:right' src='data/checked.png'>";
                                }
                                else {
                                    $checked = FALSE;
                                    echo @mysql_get_server_info($db);
                                    echo "<img style='float:right' src='data/unchecked.png'>";
                                }
                            }
                            else {
                                echo "<font style='color:red'><b>Tidak diketahui</b></font>";
                                echo "<img style='float:right' src='data/unchecked.png'>";
                                $checked = FALSE;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>MySQL Client</th>
                        <td>
                            <?php
                            if (function_exists('mysql_get_client_info')) {
                                $mysql_client = preg_replace('/[^0-9\.]/','', mysql_get_client_info());
                                if ($mysql_client>=5) {
                                    echo $mysql_client;
                                    echo "<img style='float:right' src='data/checked.png'>";
                                }
                                else {
                                    $checked = FALSE;
                                    echo $mysql_client;
                                    echo "<img style='float:right' src='data/unchecked.png'>";
                                }
                            }
                            else {
                                echo "<font style='color:red'><b>Tidak diketahui</b></font>";
                                echo "<img style='float:right' src='data/unchecked.png'>";
                                $checked = FALSE;
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <th>GD Library</th>
                        <td>
                            <?php
                            if (function_exists('gd_info')) {
                                $gd_info = gd_info();
                                $gd = preg_replace('/[^0-9\.]/','',$gd_info['GD Version']);
                                if ($gd>=1) {
                                    echo $gd;
                                    echo "<img style='float:right' src='data/checked.png'>";
                                }
                                else {
                                    $checked = FALSE;
                                    echo $gd;
                                    echo "<img style='float:right' src='data/unchecked.png'>";
                                }
                            }
                            else {
                                echo "<font style='color:red'><b>Tidak diketahui</b></font>";
                                echo "<img style='float:right' src='data/unchecked.png'>";
                                $checked = FALSE;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
                if ($checked) {
                    $_SESSION['check_requirements'] = TRUE;
                    ?>
                <br />
                <form method="post" action="ketiga.php">
                    <input type="submit" value="Lanjutkan >>" />
                </form>
                    <?php }

                else {
                    $_SESSION['check_requirements'] = FALSE;
                    ?>
                <br />
                <div class="notebox-warning">
                    <h2>Maaf, Server kamu belum memenuhi kebutuhan untuk applikasi sinilugos ini.</h2>
                </div>
                    <?php } ?>
            </div>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2011 Mahasiswa Universitas Pamulang. All rights reserved.</p>
        </div>
    </body>
</html>

<?php
session_start();
$hostname = $_SESSION['db_hostname'];
$username = $_SESSION['db_username'];
$password = $_SESSION['db_password'];
$db_name = $_SESSION['db_name'];
$connect = @mysql_connect($hostname, $username, $password);
if (!$connect) {
    header("location: index.php");
}

$db = mysql_connect($hostname, $username, $password);
mysql_query('CREATE DATABASE IF NOT EXISTS '.$db_name, $db);
mysql_select_db($db_name, $db);

if (!process_db($db)) {
    echo mysql_error($db);
    exit;
}

if (!process_index_file()) {
    echo "File index.php gagal diterapkan!";
    exit;
}

if (!process_config_file()) {
    echo "File config gagal diterapkan!";
    exit;
}

if (!process_db_file()) {
    echo "File database gagal diterapkan!";
    exit;
}

function process_db($db) {
    $schema 	= file_get_contents('data/sinilugos.sql');
    $queries 	= explode('-- andi split --', $schema);

    foreach($queries as $query) {
        $query = rtrim( trim($query), "\n;");
        @mysql_query($query, $db);
        if(mysql_errno($db) > 0) {
            return FALSE;
        }
    }
    return TRUE;
}

function process_index_file() {
    $uri = explode("/",$_SERVER['REQUEST_URI']);
    if (trim($uri[1])=='') $base_path = '/';
    else $base_path = '/'.$uri[1].'/';
    $base_url = "http://".$_SERVER['SERVER_NAME']."/".$uri[1]."/";

    $template2 = file_get_contents('data/index.php');

    $handle2 = @fopen('../index.php','w+');

    if($handle !== FALSE) {
        fwrite($handle1, $template1);
        fwrite($handle2, $template2);
        return TRUE;
    }

    return FALSE;
}

function process_config_file() {
    $uri = explode("/",$_SERVER['REQUEST_URI']);
    if (trim($uri[1])=='') $base_path = '/';
    else $base_path = '/'.$uri[1].'/';
    $base_url = "http://".$_SERVER['SERVER_NAME']."/".$uri[1]."/";

    $template = file_get_contents('data/config.php');

    $new_file = str_replace('__BASEURL__', $base_url, $template);
    $new_file = str_replace('__BASEPATH__', $base_path, $new_file);

    $handle = @fopen('../application/config/andi/config.php','w+');

    if($handle !== FALSE) {
        return fwrite($handle, $new_file);
    }

    return FALSE;
}


function process_db_file() {
    $template = file_get_contents('data/database.php');

    $new_file = str_replace('__HOSTNAME__', $_SESSION['db_hostname'], $template);
    $new_file = str_replace('__USERNAME__', $_SESSION['db_username'], $new_file);
    $new_file = str_replace('__PASSWORD__', $_SESSION['db_password'], $new_file);
    $new_file = str_replace('__DATABASE__', $_SESSION['db_name'], $new_file);

    $handle 	= @fopen('../application/config/andi/database.php','w+');

    if($handle !== FALSE) {
        return @fwrite($handle, $new_file);
    }
    return FALSE;
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
                    <li><a href="ketiga.php"><strong>Hak Akses</strong></a> </li>
                    <li><a href="#"><strong>Selesai</strong></a> </li>
                </ul>
            </div>

        </div>

        <div id="content">
            <div id="judul">
                <strong>Selesai</strong>
            </div>
            <div align="center" style="padding-top:10px">
                <div class="notebox-done" style="width:700px">
                    <h1>Proses instalasi sinilugos berhasil.</h1>
                    <h4><img src="data/unchecked.png" /> Silahkan hapus folder install, karena sudah tidak diperlukan.</h4>
                </div>
                <div class="petunjuk-area" style="width:400px">
                    <h2>Langsung akses ke tkp : </h2>
                    <?php
                    $uri = explode("/",$_SERVER['REQUEST_URI']);
                    $base_url = "http://localhost/".$uri[1]."/";
                    ?>
                    <a href="<?php echo $base_url ?>" target="_blank"><?php echo $base_url ?></a>
                </div>

                <br />
                <div class="petunjuk-area" style="width:400px">
                    <p>
                        <b>Login Sebagai Admin</b><br>
			Nim: admin <br>
			Password: password
                    </p>
                    <br>
                    <p>
                        <b>Login Sebagai Contoh Mahasiswa</b><br>
			Nim: 2007140025 <br>
			Password: password
                    </p>
                </div>
            </div>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2011 Mahasiswa Universitas Pamulang. All rights reserved.</p>
        </div>
    </body>
</html>

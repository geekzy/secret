<?
session_start();
//logout -> hapus semua session
session_destroy();
//balikin ke halaman index.php
echo "<script>document.location='index.php'</script>";
?>
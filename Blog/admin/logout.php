<?php
session_start();
session_destroy();

echo "<script>alert(' Anda Telah Keluar Dari Halaman Administrator'); window.location = 'index.php'</script>";
?>
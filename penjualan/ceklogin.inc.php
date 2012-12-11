<?php
//jika belum ada session suid balikin ke halaman depan (index.php)
if(!isset($_SESSION['suid'])) 
echo "<script>document.location='index.php'</script>";
?>
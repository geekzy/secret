<?php
$program=array("HTML","PHP","JQuery","Javascript");
print_r($program);
$cari="PHP";
if (in_array($cari,$program)) {
		echo "<br /> Kata $cari dalam array ditemukan";
		}
	else {
		echo "Kata $cari tidak ditemukan dalam array";
}
?>
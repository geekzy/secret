<?php
	$a = 1;
	while ( $a<= $angka = $_GET['angka']) {
		$b=1;
		while ($b<=$a) {
			echo("*");
			$b++;
		}
		echo "<br>";
		$a++;
	}
?>
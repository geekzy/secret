<?php
	$a = 0;
	while ( $a<= $angka = $_GET['angka']) {
		$b = $angka;
		while ( $b >= $a) {
			echo "&nbsp;";
			$b--;	
		}
		$c = 1;
		while ( $c <= $b) {
			echo "*";
			$c++;
		}
		echo "<br>";
		$a++;
	}
?>
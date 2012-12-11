<?php
if ($jenis == "ktn") {
	$jenis = "Katun";
	switch ($kualitas) {
		case '1':
			$kualitas ="Sangat Bagus";
			$harga = 100000;
			break;
		case '2':
			$kualitas = "Bagus";
			$harga = 90000;
			break;
		case '3':
			$kualitas = "Cukup";
			$harga = 80000;
			break;
		
		default:
			$kualitas = "Jelek";
			$harga = "1100";
			break;
	}
}else{
		$jenis = "Sutra"; 
	switch ($kualitas) {
		case '1':
			$kualitas = "Sangat Bagus";
			$harga = 100000;
			break;
		case '2':
			$kualitas = "Bagus";
			$harga = 90000;
			break;
		case '3':
			$kualitas = "Cukup";
			$harga = 80000;
			break;
		
		default:
			$kualitas = "Jelek";
			$harga = "1100";
			break;
	}
} 

$total = $jumlah * $harga;
if ($jumlah >= 15) {
	$dis = $total * 0.5;

}$tto = $total - $dis;



echo $nama."<br>".$jenis."<br>".$kualitas."<br>".$jumlah."<br>".$tto ;


?>




<?php
$data = array("galuh pratomo", "Lakilaki", "Budiluhur","Main Game",3.23);
	foreach ($data as $diri) {
		# code...
		echo $diri."<br>";
	}

	$data = array("galuh pratomo", "Lakilaki", "Budiluhur","Main Game",3.23);
	list($nama,$jeniskelamin,$kampus,$hobi,$point) = $data;
	echo"<br>";
	echo $nama."<br>";
	echo $jeniskelamin."<br>";
	echo $kampus."<br>";
	echo $hobi."<br>";
	echo $point."<br>";

	$passwordasli = "w4t3r53v3n";
	$passwordinput = "waterseven";
	$cocok = strcmp($passwordasli, $passwordinput);
	if ($cocok!=1) {
		# code...
			echo "<br>";
		echo "Password anda salah";
	}
	else
	{
		echo "Password anda benar.";
	}

$nilai = 90 ;
echo "<br>";
echo "$nilai" ;

?>




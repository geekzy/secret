<?php
$mahasiswa = array("Galuh PR","Jl Najih","LakiLaki","25/04/1990",2.93,"Budiluhur");

	for ($i=0; $i <=5 ; $i++) { 
		# code...
		echo "index array mahasiswa ke :".key($mahasiswa)." berisi ".current($mahasiswa)."<br>";
		next($mahasiswa);
	}
$maha = array("Galuh PR","Jl Najih","LakiLaki","25/04/1990",2.93,"Budiluhur");
	end($maha);
	for ($i=0; $i <=5 ; $i++) { 
		# code...
		echo "index array mahasiswa ke :".key($maha)." berisi ".current($maha)."<br>";
		prev($maha);

	}	
?>
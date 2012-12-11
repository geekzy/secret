<?php
	function newName($nama){
	//echo $nama."<br>";
	$total = 0;
	for ($i=0; $i<strlen($nama); $i++) {
		//$jml = ord($nama[$i]);
		$total = $total + ord($nama[$i]);
		//$total =
		
	} return $total;

}
echo newName("a");
?>
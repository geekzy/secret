<?php
$arr=array(1,2,3,4,5);
$cek=is_array($arr);
if ($cek==true)
	{ 
		$status=" ";
} else
	{
		$status="bukan";
}
echo "\$arr=(1,2,3,4,5);";
echo "<br />";
echo "Variabel \	$arr $status merupakan array";
?>
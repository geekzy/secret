<?php
// ini arraynya
echo "Anggota array yang awal adalah : <br />";
		$input=array("HTML","PHP","MySQL","Javascript");
		print_r($input);
	echo "<br /><br />";
// fungsi splice 2
echo "array_splice(\$input,2)=";
echo "<br />";
	$input=array("HTML","PHP","MySQL","Javascript");
	array_splice($input,2);
	print_r($input);
echo "<br /><br />";
// fungsi splice 1,-1
echo "Array_splice(\$input,1,-1)";
echo "<br />";
	$input=array("HTML","PHP","MySQL","Javascript");
	array_splice($input,1,-1);
	print_r($input);
echo "<br /><br />";
// fungsi splice lagi
echo "Array_splice(\$input,1,count(\$input),\"AJAX\")";
echo "<br />";
	$input=array("HTML","PHP","MySQL","Javascript");
	array_splice($input,1,count($input),"AJAX");
	print_r($input);
echo "<br /><br />";
// fungsi splice lagi lho
echo "Array_splice(\$input,-1,1,array(\"JQuery\",\"Framework\"))";
echo "<br />";
	$input=array("HTML","PHP","MySQL","Javascript");
	array_splice($input,-1,1,array("JQuery","Framework"));
	print_r($input);
echo("<br />");
?>
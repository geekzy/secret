<?php
$s = "This weekend, iam going  shopping for a pet chicken";
$a = 0;

for ($i=0, $j = strlen($s); $i < $j ; $i++) { 
	if (strstr('aeiuoAIUEO', $string[$i])) {

		$a++;
	}
	
}
?>
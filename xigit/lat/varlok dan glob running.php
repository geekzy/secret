<?php
function itung() {
    global $c;
    $a=100;
    $b=200;
    $c=$a+$b;
    return($c);
}
$a=100;
$b=itung();
echo "nilai a=$a <br />\n";
echo "nilai b=$b <br />\n";
echo "nilai c=$c <br />\n";
?>
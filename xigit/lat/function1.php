<?php

/**
 * @author firmansyah
 * @copyright 2010
 */
function nambah()
{
    $x = 5;
    $y = 3;
    $z = $x + $y;
    echo "$z <br />";
}
nambah();
echo "<br />";
function nambahlagi($x, $y)
{
    $za = $x + $y;
    echo "Hasil $x tambah $y = $za <br>";
}
nambahlagi(1, 1);
nambahlagi(30, 50);

?>
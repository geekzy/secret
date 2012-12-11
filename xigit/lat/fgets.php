<?php
if ($buka = fopen("nyoba.txt", "r"))
{
    while (!feof($buka))
    {
        $data = fgets($buka, 255);
        echo "$data";
    }
    fclose($buka);
} else
{
    echo "File gagal dibuka!";
}
?>
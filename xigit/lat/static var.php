<?php

// ini static biasa
function statis()
{
    $nilai = 0;
    echo "$nilai <br />";
    $nilai++;
}
statis();
statis();
statis();
statis();
statis();

echo "<br /><br /><hr><br /><br />";
// ini static lho
function statist()
{
    static $nilai = 0;
    echo "$nilai <br />";
    $nilai++;
}
statist();
statist();
statist();
statist();
statist();

?>
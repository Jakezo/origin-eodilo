<?php
$dir = "html";
$dir2 = "php";
$df = opendir($dir);

while( $ff = readdir($df) ) {
    if( $ff == "." || $ff == ".." ) continue;

    $new_ff = str_replace(".html",".blade.php",$ff);
    copy($dir."/".$ff, $dir2."/".$new_ff);
    echo $dir."/".$ff . " => " .  $dir2."/".$new_ff."\n";

}
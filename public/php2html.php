<?php
$dir = "php";
$dir2 = "html";
$df = opendir($dir);

while( $ff = readdir($df) ) {
    if( $ff == "." || $ff == ".." ) continue;

    $new_ff = str_replace(".blade.php",".html",$ff);
    copy($dir."/".$ff, $dir2."/".$new_ff);
    echo $dir."/".$ff . " => " .  $dir2."/".$new_ff."\n";

}
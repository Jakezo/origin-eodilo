<?php
//use Illuminate\Support\Facades\DB;

## 비디오아이디만 추출
function youtube_link2videoID( $link ){
    $rtn = "";

    if( strpos($link,"embed") !== false ) {
        $tmp = explode("/",$link);
        $rtn = $tmp[count($tmp)-1];
    } else {
        $tmp = explode("?",$link);
        $tmp = explode("&",$tmp[1]);

        foreach( $tmp as $tmp2 ) {

            list( $k , $v ) = explode( "=", $tmp2 );
            if( $k == "v" ) {
                $rtn = $v;
                break;
            }
        }
    }
    return $rtn;
}

## 비디오아이디로 섬네일
function youtube_videoID2ImgSrc( $videoID, $option = 0 ){

    if( $videoID ) {
        $rtn = "//img.youtube.com/vi/".$videoID."/".$option.".jpg";
    } else {
        $rtn = "";
    }

    return $rtn;
}

## Json Data 여부
function isJson($string) {
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
 }

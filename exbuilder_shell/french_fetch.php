<?php

print("\n\n\n************** 데이터베이스 업데이트 시작 *************\n\n\n");


$db_host = "localhost";
$db_user = "boss";
$db_password = "rhaxoddl91";
$db_name = "boss";

$source_db = "boss_enha";
$target_db = "";
$conn = mysqli_connect(
    $db_host,
    $db_user,
    $db_password,
    $db_name);

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

echo "\n";

for($i=1;$i<count($argv);$i++) {
    //echo $argv[$i]."\n";
    $_tmp = explode("=",$argv[$i]);
    //echo $_tmp[0]."\n";
    //echo $_tmp[1]."\n";
    ${$_tmp[0]} = $_tmp[1];
    //${$_tmp[0]} = $_tmp[1];
}

$filename = "db_fetch/ver_".$ver.".sql";
if( !file_exists($filename) ) {
    echo "패치파일이 존재하지 않습니다.(".$filename.")\n";
    print("\n\n\n************** 데이터베이스 업데이트 완료 *************\n\n\n");
    exit;
}
$fp = fopen($filename, "r") or die("파일열기에 실패하였습니다");
$fetch_sql = fread($fp, filesize($filename));
fclose($fp);

/************** 데이터베이스 업데이트 *************/

$sql = "SELECT p_no, p_id, p_name FROM partners order by p_no";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
    $partners[] = $row;
}

$di = 0;
for( $di = 0; $di <= count($partners)-1; $di++ ) {
    $row = $partners[$di];
    echo ($di+1) . ". ". $row['p_id'] . " ::: ". $row['p_name'];

    $target_db = "boss_" . trim($row['p_id']);
    $sql = "use $target_db";

    if( $result = mysqli_query($conn, $sql) ) {
        
        if( $conn1 = mysqli_connect( $db_host, $db_user, $db_password, $target_db) ) {

            if ( mysqli_query ($conn1,$fetch_sql) )
            {
                echo " - 완료\n";   
            } else {
                echo " - 패치가 실패하였습니다.\n";   
            }

        } else {
            echo " - 디비접속이 불가능합니다.\n";  
        }

        

        
        
        
        // if( mysqli_error($conn1) ) {
        //     echo " - 패치가 실패하였습니다.\n";  
        // } else {
        //     echo " - 완료\n";    
        // }


    } else {
        echo " - 디비가 존재하지 않습니다.\n";  
    }
      
}


print("\n\n\n************** 데이터베이스 업데이트 완료 *************\n\n\n");
?> 
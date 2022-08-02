<?php

print("\n\n\n************** 데이터베이스 업데이트 시작 *************\n\n\n");
$script_dir = dirname(__FILE__);

$db_host = "localhost";
$db_user = "bossdev";
$db_password = "rhaxoddl91";
$db_name = "boss";

$source_partner = "enha44";
$source_db = "boss_" . $source_partner;
$target_db = "";

if( isset($argv[2]) && $argv[2] != "" ) {
    $tmp = explode("=",$argv[2]);
    ${$tmp[0]} = $tmp[1];
} 

// 기본데이터베이스백업
echo "기본데이터베이스 추출\n";

if( $mode == "copy") {
    $command = "mysqldump -u $db_user -p$db_password  $source_db > $script_dir/db_source/tmp.sql";
} else {
    $command = "mysqldump -u $db_user -p$db_password  $source_db -d > $script_dir/db_source/tmp.sql";
}
exec($command);

if( $argv[1] ) {

    if( trim($argv[1]) != $source_partner ) {

        $target_db = "boss_".$argv[1];
        echo "타겟 가맹점 존재여부 확인";

        if( $conn = mysqli_connect( $db_host, $db_user, $db_password, $db_name) ) {
    
            mysqli_query($conn, "set session character_set_connection=utf8;");
            mysqli_query($conn, "set session character_set_results=utf8;");
            mysqli_query($conn, "set session character_set_client=utf8;");        
    
            echo " - 확인완료.\n";   
    
            $sql = "SELECT p_no, p_id, p_name, p_email, p_phone FROM partners where trim(p_id) = '".trim($argv[1])."'";
            if( $result = mysqli_query($conn, $sql) ) {

                if($partner_row = mysqli_fetch_array($result)) {
                    echo $partner_row['p_id']."::".$partner_row['p_name']." 가맹점 확인됨.\n";
        
                    if( $conn = mysqli_connect( $db_host, $db_user, $db_password, $target_db) ) {
                
                        $sql = "desc french_managers";
                        $result = @mysqli_query($conn, $sql);

                        if( !$result ) {
                            //if( !($row = @mysqli_fetch_array($result)) ) {
                                // 타겟데이터베이스에 백업
                                echo $target_db." 데이터베이스 백업\n";
                                $command = "mysqldump -u $db_user -p$db_password  $source_db > $script_dir/db_backup/backup_".$target_db."_".date("Ymd_His").".sql";
                                $res = exec($command);
                        
                                // 타겟데이터베이스에 적용
                                echo $target_db." 데이터베이스 업데이트\n";
                                $command = "mysql -u $db_user -p$db_password $target_db -f < $script_dir/db_source/tmp.sql";
                                $res = exec($command);
                                   

                                if( $mode == "copy") {
                                    $sql = "truncate table french_product_orders;";
                                    $result = mysqli_query($conn, $sql); 
                                    $sql = "truncate table french_reserv_seats;";
                                    $result = mysqli_query($conn, $sql); 
                                    $sql = "truncate table french_managers;";
                                    $result = mysqli_query($conn, $sql);  
                                }                              

                                $sql = "insert into french_managers (select * from $source_db.french_managers where mn_no = 1 )";
                                $result = mysqli_query($conn, $sql);                                   
                                $sql = "update french_managers set 
                                mn_id = '".$partner_row['p_id']."', 
                                mn_email = '".$partner_row['p_email']."', 
                                mn_phone = '".$partner_row['p_phone']."',
                                password ='\$2y\$10\$ulrbDweSDg9F0MBbz7ATg\.fXDwtMJDXpT\/oF\/TY4tqlnB\/8VEl5My', 
                                created_at=now(), 
                                updated_at=now() 
                                where mn_no = 1";
                                $result = mysqli_query($conn, $sql);

                            //} else {
                            //        echo $target_db." 데이터가 이미 존재합니다.\n";
                            //}
                        } else {
                            echo $target_db." 데이터가 이미 존재합니다.\n";  
                        }
    
                    } 
        
                } else {
                        echo $target_db." 해당 데이터베이스 존재하지 않습니다.\n";
                }     
        
            } else {

                echo "가맹점이 존재하지 않습니다.\n";
            }
     
        } else {
            echo " - 메인 데이터베이스 접속불가.\n"; 
            echo " - 확인불가.\n";  
        }
    } else {
        echo "변경할수 없는 가맹점입니다.\n";
   
    }

}

print("\n\n\n************** 데이터베이스 업데이트 완료 *************\n\n\n");
exit;

?> 
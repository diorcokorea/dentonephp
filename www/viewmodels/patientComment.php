<?
session_start();
include "../models/db/querys.php";

$comment = $_POST['comment'];
$service_key = $_POST['s_key'];
$g = $_POST['g'];
$ac_key = $_SESSION['member_code'];
//function comment_cu($cid, $sid, $tid, $cby, $comment)  코멘트 고유키(입력은 0, 수정시 수정 하는 고유키),서비스 고유키, 의사/기공소(1:의사, 2: 기공소), 의사/기공소 고유키, 코멘트  
$return_val = alarm_c($ac_key , $service_key, 2);
$result_code = comment_cu(0, $service_key, $g, $ac_key, $comment);

echo print_r($result_code);

?>
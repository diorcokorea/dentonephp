<?
include "../models/db/querys.php";


$service_id= $_POST['noti_id'];
//$alarmcodeid = $_POST['noti_code'];

$return_arrays = servicekey_r($service_id);
$return_val = alarm_d($service_id);
//print_r($return_arrays[0]);
echo json_encode($return_arrays[0]);
?>
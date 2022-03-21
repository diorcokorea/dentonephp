<?
//ini_set("display_errors", "1");
 include "../models/db/querys.php";
//include "../models/regexr.php";

$id_chk_value = $_POST['id_chk_value'];
$find_user_id = $_POST['find_user_id'];
$user_id = $_POST['user_id'];
$member_id = $_POST['member_id'];

if($user_id != null){

$result_array = id_regexr($user_id);
//echo $result_array[0];
if($result_array[0]==1){ echo "true";}else if($result_array[0]==0){ echo "false";}

}else if($member_id != null){

 $result_array = id_check($member_id);
//echo $result_array[0];
//  print_r($result_array);
//  exit;
if($result_array[0]==1){echo "false";}else if($result_array[0]==0){ echo "true";}

}else if($find_user_id != null){

$result_array = id_check($find_user_id);
//print_r($result_array);
if($result_array[0]==1){echo "true";}else if($result_array[0]==0){ echo "false";}

}






?>

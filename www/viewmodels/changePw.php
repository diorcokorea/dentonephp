<?
session_start();
//ini_set("display", "1");
 include "../models/db/querys.php";

if (isset($_POST['member_id'])) {
$member_id = $_POST['member_id'];
$member_pw = $_POST['member_pass'];

  $result = pw_change ($member_id, $member_pw);
if($result == 1) {  ?>

<form name="login_result_f" id="login_result_f" method="post" action="../views/findMemberPassword.php" >
<input type="hidden"  id="change_suces" name="change_suces"  value="true"> 
</form>
<script>document.getElementById('login_result_f').submit(); </script>

<? }}else if (isset($_POST['user_pw'])) {
$cheked_result = pw_check($_SESSION['member_id'],$_POST['user_pw']);
if($cheked_result == 1){
$change_result = pw_change($_SESSION['member_id'], $_POST['member_pass']);
    if ($change_result == 1) {
        echo "suc";
    }else{echo "change_false"; }

}else{echo "check_false";}

}




?>
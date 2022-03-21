<?
session_start();
 include "../models/db/querys.php";

/***********************************
		Email로 아이디 검색
***********************************/

$code = $_POST['code'];
if($_SESSION["VerificationCode"] == $code){
echo "true";
}else{
echo "false";
}

?>

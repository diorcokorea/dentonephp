<?

//Login ViewModel 
include '../models/db/querys.php';
include '../models/naverCaptchaAPI/verification.php';

$keep_login = $_POST['keep_login'];

$image_key = $_POST['image_key'];
$radio_key = $_POST['radio_key'];
$captcha_result = $_POST['captcha_result'];

if($image_key != null) {
	$result = chk_image_result($image_key, $captcha_result);

	if($result == "false") {
		echo  "
<form name='result_form' id='result_form' method='post' action='../views/login.php' >
<input type='hidden'  id='retry_count' name='retry_count'  value='5'/> 
</form>
<script>
alert('Please check the automatic input prevention character.'); 
document.getElementById('result_form').submit();
</script>";
	exit;
	}

	}
	/*else if($radio_key != null)  {
	$result = chk_radio_result($radio_key, $captcha_result);
	if($result == "false"){echo  "<script>alert('Please check the automatic input prevention character.');location.href = '../views/login.php';</script>";
	exit;
	}
	}*/




$member_id = $_POST['user_id'];
$member_pass =  $_POST['user_pass'];
/**********************************
	id,pw 빈값 아닐때 로그인 체크
**********************************/
if($member_id != null && $member_pass != null){
$result = "LOGIN";
$ipaddress = get_client_ip();
$login_info_array = login_Pro($member_id, $member_pass, $ipaddress, $result);

// print_r($login_info_array);
// exit;
//login_info_array code, id, name, 권한, msg
/**********************************
			결과 아이디 없음
**********************************/
if($login_info_array[4] == "No ID"){
?>
<form name="login_result_f" id="login_result_f" method="post" action="../views/login.php" >
<input type="hidden"  id="_failed_login" name="_failed_login"  value="false"> 
</form>
<script>document.getElementById('login_result_f').submit(); </script>

<?
/**********************************
			결과 로그인 성공
**********************************/	
} else if ($login_info_array[4] == "OK"){
session_start();
$_SESSION = array();
$_SESSION['member_id'] = $member_id;
$_SESSION['member_code'] = $login_info_array[0];
$_SESSION['member_name'] = $login_info_array[2];
//if($keep_login != null) {
	setcookie('member_id',$member_id, time()+(60*60*24*30),"/");
	setcookie('member_code',$login_info_array[0], time()+(60*60*24*30),"/");
	setcookie('member_name',$login_info_array[2], time()+(60*60*24*30),"/");
//}

echo "<script>location.href = '../views/index.php';</script>";

/**********************************
			결과 로그인 실패
**********************************/	
}else if($login_info_array[1] == $member_id){
?>
<form name="login_result_f" id="login_result_f" method="post" action="../views/login.php" >
<input type="hidden"  id="retry_count" name="retry_count"  value="<?echo $login_info_array[4] ?>"> 
</form>
<script>document.getElementById('login_result_f').submit(); </script>
<?
}
}



?>







<?
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>

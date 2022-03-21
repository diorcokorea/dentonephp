<?
include '../models/naverCaptchaAPI/verification.php';

$image_key = $_POST['image_key'];
$radio_key = $_POST['radio_key'];
$captcha_result = $_POST['captcha_result'];

if($image_key != null) {
	$result = chk_image_result($image_key, $captcha_result);
 echo $result;
	}else if($radio_key != null)  {
	$result = chk_radio_result($radio_key, $captcha_result);
echo  $result;
	}




?>
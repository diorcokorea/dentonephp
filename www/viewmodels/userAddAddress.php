<?
session_start();
include "../models/db/querys.php";
$user_code = $_SESSION['member_code'];
$result = "false";

if (isset($_POST['address_id']) && $_POST['address_id'] != null && $_POST['type'] == "delete") {
	
	$update_result = address_d($_POST['address_id']);

	if($update_result == 1) $result = "true";
	echo $result;
	exit;
}


if (isset($_POST['main_address_id']) && $_POST['main_address_id'] != null) {
	
	$update_result = main_address_u($user_code, $_POST['main_address_id']);
	if($update_result == 1) $result = "true";
	echo $result;
	exit;
}



$address_name = $_POST['address_name'];

$postcode = $_POST['postcode'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$address4 = $_POST['address4'];
$country = $_POST['country'];


$update_result = address_c($user_code, $country,$address_name, $address1,$address2,$address3,$address4,$postcode);

if($update_result == 1) $result = "true";
										//(로그인 고유키, 의사고유키, 주소고유키, 비번,  병원이름, 전화번호, 이메일, 라이센스번호, 주소, 상세 주소1,상세 주소2상세 주소3 상세 주소4, 우편번호)
echo $result;
?>
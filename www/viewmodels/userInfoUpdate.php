<?
session_start();
include "../models/db/querys.php";
$result = "false";
$user_code = $_SESSION['member_code'];

$add_id = $_POST['address_id'];

$member_hospital_name = $_POST['member_hospital_name'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$member_name = $first_name . "," . $last_name;
$_SESSION['member_name'] = $member_name;
$moblile_country_code = $_POST['moblile_country_code'];
$phone_number = $moblile_country_code . " " . trim($_POST['phone_number']);

$phone_country_code = $_POST['phone_country_code'];
$contact_number = $phone_country_code . " " . trim($_POST['contact_number']);

// @LUCAS 알림받기 On/Off 및 접수값 추가
$email_notification = $_POST['email_notification'] ?? "On";
$is_submit_checked = $_POST['is_submit_checked'] ?? 0;

$update_result = user_update(
    $user_code,
    $add_id,
    $member_hospital_name,
    $member_name,
    $contact_number,
    $phone_number,
    $email_notification,
    $is_submit_checked
);

if ($update_result == 1) $result = "true";
//(로그인 고유키, 의사고유키, 주소고유키, 비번,  병원이름, 전화번호, 이메일, 라이센스번호, 주소, 상세 주소1,상세 주소2상세 주소3 상세 주소4, 우편번호)
echo $result;

?>
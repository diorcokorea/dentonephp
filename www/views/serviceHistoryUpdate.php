<?
// @LUCAS 1.5차 처방전 회수
session_start();
include "../models/db/querys.php";
ini_set("display_errors", "1");

$sid = (int)$_POST['service_key'];
$status = (int)$_POST['status']; // [22]: "edit order", // 다랍다운에서는 제외 // 처방전 회수된 상태
$drId = $_POST['drId'];
$patientkey = $_POST['patientkey'];
$patientServiceKey = $sid;
$loginId = (int)$_SESSION['member_code']; // Doctor
//$loginId = (int)$_SESSION['lab_member_code']; // 기공소

$service_info_array = service_r($patientkey, $patientServiceKey);
$stype = (int)$service_info_array[4];

//[20]: "처방전 제출", // "order received", // 다랍다운에서는 제외
//[21]: "처방전 수정 제출", // "edited order received", // 다랍다운에서는 제외
if ((int)$service_info_array[6] != 20 && (int)$service_info_array[6] != 21) {
    echo json_encode(array(
        "result" => "fail",
        "message" => "This order's been already changed."
    ));
    return;
}

// TODO auto_save가 3 (03_patientinfo.php)로 보내자
$goToProgressNum = 3;
$serviceid = service_u($sid, $stype, $status, $goToProgressNum, null, null, null, null, 'U');
// updateAutoSaveOfService($sid, $goToProgressNum); // 이미 마지막 단계라서 변경할 필요 없다.
$service_history_id = sevicehistory_c(2, $loginId, $sid, $status);

echo json_encode(array(
    "result" => "success",
    "service_history_id" => $service_history_id,
    "serviceid" => $serviceid,
));

?>

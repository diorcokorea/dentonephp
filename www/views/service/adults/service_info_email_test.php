<?

session_start();

include '../../../models/modelsVariable_global.php';
include '../../../models/service_decode.php';
//var_dump("____ 1" . ($_SERVER["DOCUMENT_ROOT"] . '/models/phpMailerAPI/mail_service.php'));
include_once $_SERVER["DOCUMENT_ROOT"] . '/models/phpMailerAPI/mail_service.php';
//var_dump("____ 2");

$labCode = (int)$_SESSION['lab_code'];
$patientId = $_SESSION['patient_key'];

var_dump("|labCode => " . $labCode);

$labInfo = labinfo_r($labCode)[0];
if ($labInfo['email_notification'] !== "On" || !$labInfo['is_submit_checked']) {
    var_dump("|email_notification => " . $labInfo['email_notification']);
    var_dump("|is_submit_checked => " . $labInfo['is_submit_checked']);
    var_dump("no email");
    return;
}

$patient_info_array = patient_r($patientId); // DB의 patiend_id of tb_patient

$labName = $labInfo['name'];
$receiverName = $labInfo['name'];
$receiverEmail = $labInfo['email'];

$clinicName = $patient_info_array[8];
$patientFirstName = explode(",",$patient_info_array[1])[0];
$patientName = $patientFirstName;
$submissionDateTime = date("Y-m-d H:i:s",time());


var_dump("|email_notification => " . $labInfo['email_notification']);
var_dump("|is_submit_checked => " . $labInfo['is_submit_checked']);
var_dump("|labName => " . $labName);
var_dump("|clinicName => " . $clinicName);
var_dump("|receiverName => " . $receiverName);
var_dump("|receiverEmail => " . $receiverEmail);
var_dump("|patientName => " . $patientFirstName);
var_dump("|submissionDateTime => " . $submissionDateTime);
var_dump("|patient_key => " . $_SESSION['patient_key']);
var_dump("|patient_id => " . $_SESSION['patient_id']);

sendEmailWhenOrderSubmitted(
    $receiverName,
    $receiverEmail,
    $labName,
    $clinicName,
    $patientName,
    $submissionDateTime
);

//var_dump("____ 5");

$output = array(
    'result' => "success",
);

echo $output;

?>
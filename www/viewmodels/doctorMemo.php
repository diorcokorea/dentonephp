<?
session_start();
include "../models/db/querys.php";

$memo = $_POST['memo'];
$serviceKey = $_POST['serviceKey'];
$patientKey = $_POST['patientKey'];

$result_code = memo_u($serviceKey, $patientKey, $memo);

echo print_r($result_code);

?>
<?

include "../models/service_decode.php";
//include "../models/db/querys.php";
$patientkey = $_POST['patientkey'];

$patientServiceKey = $_POST['patientServiceKey'];
 
service_json($patientkey, $patientServiceKey);


$patient_info_array = patient_r($patientkey);









?>
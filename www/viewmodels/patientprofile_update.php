<?
session_start();
include "../models/db/querys.php";
$patient_key = $_POST['patient_key'];
$patient_id = $_POST['patient_id'];
$patient_name = $_POST['First_name'].",".$_POST['Last_name'];
$patient_date_yy = $_POST['patient_date_yy'];
$patient_date_mm = $_POST['patient_date_mm'];
$patient_date_dd = $_POST['patient_date_dd'];



$patient_date = $_POST['patient_date_yy']."-".$_POST['patient_date_mm']."-".$_POST['patient_date_dd'];
$patient_sex = $_POST['patient_sex'];
$ac_key = $_SESSION['lab_member_code'];
$service_key = $_POST['patientServiceKey'];
$return_val = alarm_c($ac_key , $service_key, 5);
$return_key = patient_cu($patient_id, $patient_name, $patient_sex,$patient_date ,1 ,(int)$patient_key,(int)$_SESSION['member_code']);
echo "<script>opener.parent.location.reload();window.close();</script>"
?>
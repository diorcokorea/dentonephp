<?
session_start();
include "../models/Reporting/drPrintReport.php";
//ini_set("display_errors","1");
$user_key = $_SESSION['member_code'];
if (isset($_SESSION['patient_key'])) {
    $p_key = $_SESSION['patient_key'];
    $service_key = $_SESSION['service_key'];
    
    
    //echo $user_key." , ".$p_key." , ".$service_key;
    
    
    prescription_print((int)$user_key, (int)$p_key, (int)$service_key);
    
}else if($_POST['patient_key'] != null){
    $p_key = $_POST['patient_key'];
    $service_key = $_POST['service_key'];
    prescription_print((int)$user_key, (int)$p_key, (int)$service_key);
}




?>
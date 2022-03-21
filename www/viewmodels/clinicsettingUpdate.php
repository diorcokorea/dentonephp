<?php
session_start();
include "../models/db/querys.php";
$result = "false";

$user_code = $_SESSION['member_code'];

$CLINICSETTING['numbering_option'] = $_POST['numbering_option'];
$CLINICSETTING['passive_aligner'] = $_POST['passive_aligner'];

$CLINICSETTING['maxillary_tooth_alignment'] = $_POST['maxillary_tooth_alignment'];
$CLINICSETTING['based_gingival'] = $_POST['based_gingival'];
$CLINICSETTING['ipr_option'] = $_POST['ipr_option'];

$CLINICSETTING['cutting_appliances'] = $_POST['cutting_appliances'];
$CLINICSETTING['overcorrection_chain'] = $_POST['overcorrection_chain'];

$CLINICSETTING['virtual_teeth'] = $_POST['virtual_teeth'];
$CLINICSETTING['extraction_cases'] = $_POST['extraction_cases'];
$CLINICSETTING['posterior_teeth'] = $_POST['posterior_teeth'];

$CLINICSETTING['arch_expansion'] = $_POST['arch_expansion'];

$CLINICSETTING['when_shipping'] = $_POST['when_shipping'];
$CLINICSETTING['special_instructions'] = $_POST['special_instructions'];

$CLINICSETTING['permanent_teeth'] = $_POST['permanent_teeth'];
$CLINICSETTING['primary_teeth'] = $_POST['primary_teeth'];

$CLINICSETTING['teeth_to_expand'] = $_POST['teeth_to_expand'];
$CLINICSETTING['arch_expansion_primary_teeth'] = $_POST['arch_expansion_primary_teeth'];




  $CLINICSETTING_JSON = json_encode($CLINICSETTING);

 $update_result = clinic_setting_u($user_code, $CLINICSETTING_JSON);
if($update_result == 1) $result = "true";
echo $result;
?>
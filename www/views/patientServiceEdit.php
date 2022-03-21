<?
session_start();
//ini_set("display_errors" , "1");
include "../models/service_decode.php";
//include "../models/db/querys.php";
$patientkey = $_POST['patientkey'];
$patientServiceKey = $_POST['patientServiceKey'];




// print_r($_SESSION['patient_st']);
// exit;
$member_id = $_SESSION['member_id'];
$member_code = $_SESSION['member_code'];
$member_name = $_SESSION['member_name'];
// 세션 초기화 후 세션 값 재등록
session_unset();
$_SESSION['member_id'] = $member_id;
$_SESSION['member_code'] = $member_code;
$_SESSION['member_name'] = $member_name;
$clinic_settings = json_decode(clinic_setting_r($_SESSION['member_code']), true);

   //$_SESSION['special_instruction'] =  $clinic_settings['special_instructions'] ;
   $_SESSION['clinic_settings'] =  $clinic_settings;

$_SESSION['patient_st'] = (int)$_POST['patient_st'];
$_SESSION['service_his_key'] = (int)$_POST['service_his_key'];
service_json($patientkey, $patientServiceKey);


$patient_info_array = patient_r($patientkey);
$service_info_array = service_r($patientkey,$patientServiceKey);

$_SESSION['progress_num'] = $service_info_array[8];

//01 treatment_option1
$_SESSION['treatment_option1'] = $treatment_option1;

$_SESSION['shipping_address'] = $shipping_address;
$_SESSION['billing_address'] = $billing_address;
//02 treatment_option2
$_SESSION['treatment_option2'] = $treatment_option2;

//03 patientinfo
$_SESSION['patient_key'] = (int)$patientkey;
$_SESSION['service_key'] = (int)$patientServiceKey;

$_SESSION['patient_id'] = $patient_info_array[0];
$p_name = explode(",",$patient_info_array[1]);
$_SESSION['first_name'] = $p_name[0];
$_SESSION['last_name']= $p_name[1];

$_SESSION['patient_ethinicity'] = $patient_info_array[6];

$_SESSION['patient_sex'] = $patient_info_array[2];
$date = explode("-",$patient_info_array[4]);
$_SESSION['patient_date_yy'] = $date[0];
$_SESSION['patient_date_mm'] = $date[1];
$_SESSION['patient_date_dd'] = $date[2];
$_SESSION['patient_age'] = $patient_info_array[12];
$_SESSION['dental_lab'] = $patient_info_array[10].",".$patient_info_array[11];

$_SESSION['lab_code'] = $patient_info_array[10];
$return_array = labaddress_r($patient_info_array[10]);
$_SESSION['dental_lab_addr']  = $return_array[1];
$_SESSION['dental_lab_zipcode'] = $return_array[2];
//04 classification
$_SESSION['classification'] = $classification;
foreach($_SESSION['classification'] as $key => $value){
	if($value =="on"){
							switch ($key) {
								case 'crowding':
									$_SESSION['crowding'] = $value; 
									break;
								case 'diastemata':
								$_SESSION['diastemata']	= $value;	
									break;
								case 'class1':
									$_SESSION['class1'] = $value;      
									break;
								case 'class2_div1':
									$_SESSION['class2_div1'] = $value;  
									break;
								case 'class2_div2':
									$_SESSION['class2_div2'] = $value;    
									break;

								case 'class3':
									$_SESSION['class3'] = $value;    
									break;
								case 'asymmetric':
									$_SESSION['asymmetric'] = $value; 
									break;
								case 'vertical_open_bite':
									$_SESSION['vertical_open_bite'] = $value; 
									break;
								case 'horizontal_open_bite':
									$_SESSION['horizontal_open_bite'] = $value; 
									break;
								case 'deep_bite':
									$_SESSION['deep_bite'] = $value;  
									break;

								case 'anterior_occlusion':
									$_SESSION['anterior_occlusion'] = $value; 
									break;
								case 'posterior_occlusion':
									$_SESSION['posterior_occlusion'] = $value; 
									break;
								case 'narrow_arch':
									$_SESSION['narrow_arch'] = $value;  
									break;
								case 'anterior_teeth':
									$_SESSION['anterior_teeth'] = $value; 
									break;
								case 'smile_line':
									$_SESSION['smile_line'] = $value;
									break;
								
								case 'inclined_occlusal_plane':
									$_SESSION['inclined_occlusal_plane'] = $value;
									break;
								case 'abnormal_teeth_shape':
									$_SESSION['abnormal_teeth_shape'] = $value;    
									break;
								case 'etc':
									$_SESSION['etc'] = $value; 
									break;
							}
					}
}         
$_SESSION['etc_value'] = $classification['etc_value'];              
$_SESSION['precaution'] = $classification['precaution'];       



//03
 $_SESSION['model_type'] = $model_type;
 if($_SESSION['model_type'] != "Impression"){
$_SESSION['model_send'] = "scan_file";
 }else{
 $_SESSION['model_send'] = "impression";
}
//echo   $_SESSION['model_send'];
//exit;
 if($model_mx != null) $_SESSION['maxilla_image'] = $model_mx;
 if($model_md != null) $_SESSION['mandible_image'] = $model_md;

 //04
 if($lateral_photo != null)  $_SESSION['lateral_photo'] = $lateral_photo;
 if($front_photo != null) $_SESSION['front_photo'] =  $front_photo;
 if($smile_photo != null) $_SESSION['smile_photo'] =  $smile_photo;
 if($intraoral_upper != null) $_SESSION['intraoral_upper'] = $intraoral_upper;
 if($intraoral_lower != null) $_SESSION['intraoral_lower'] = $intraoral_lower;
 if($intraoral_right != null) $_SESSION['intraoral_right'] = $intraoral_right;
 if($intraoral_fornt != null) $_SESSION['intraoral_fornt'] = $intraoral_fornt;
 if($intraoral_left != null) $_SESSION['intraoral_left'] = $intraoral_left;

 //05
 if($lateral_xray != null) $_SESSION['lateral_xray'] = $lateral_xray;
 if($panorama != null) $_SESSION['panorama'] = $panorama;

//  print_r($_SESSION['lateral_photo']);
//  exit;
 
 //08

		$_SESSION['arch'] = $arch;
       $_SESSION['tray_section_u'] = $tray_section_u;
       $_SESSION['tray_section_l'] = $tray_section_l;
 $_SESSION['diag_select_number'] = array();

for ($i=0; $i < count($diagnostics); $i++) { 
    
    $nums = explode(",",$diagnostics[$i]['tooth_number']);

    if($diagnostics[$i]['type'] == "Crown"){
        $type = "crown";
    }else if($diagnostics[$i]['type'] == "Implant"){
        $type = "implant";
    }else if($diagnostics[$i]['type'] == "Telesopic crown"){
        $type = "telescopic_crown";
    }else if($diagnostics[$i]['type'] == "Telesopic crown"){
        $type = "veneered_crown";
    }

    for ($j=0; $j < count($nums); $j++) { 
        $value = $nums[$j].",".$type;
        array_push($_SESSION['diag_select_number'], $value);
    }
    
  
}

  //09
$_SESSION['attchment_option'] = $attchment_option;
$_SESSION['ap_relation_upper'] = $ap_relation_upper;
$_SESSION['ap_relation_lower'] = $ap_relation_lower;
$_SESSION['ap_relation_canine'] = $ap_relation_canine;
$_SESSION['ap_relation_molar'] = $ap_relation_molar;

     $_SESSION['attchment_select_number'] =  $attchment_list[0];


  //10
	$_SESSION['overbite'] = 	$overbite;
   $_SESSION['overbite_value'] =      $overbite_value;
      $_SESSION['overjet'] =    $overjet;
     $_SESSION['overjet_value'] =    $overjet_value;

     $_SESSION['midline'] =     $midline;
	
     $_SESSION['midline_upper_right'] =    $midline_upper_right;
	 if($_SESSION['midline_upper_right'] != null) $_SESSION['midline_upper'] = "right";
      $_SESSION['midline_upper_right_value'] =   $midline_upper_right_value;

     $_SESSION['midline_lower_right'] =    $midline_lower_right;
	  if($_SESSION['midline_lower_right'] != null) $_SESSION['midline_lower'] = "right";
       $_SESSION['midline_lower_right_value'] =   $midline_lower_right_value;

      $_SESSION['midline_upper_left'] =   $midline_upper_left;
	   if($_SESSION['midline_upper_left'] != null) $_SESSION['midline_upper'] = "left";
     $_SESSION['midline_upper_left_value'] =    $midline_upper_left_value;

     $_SESSION['midline_lower_left'] =    $midline_lower_left;
	 if($_SESSION['midline_lower_left'] != null) $_SESSION['midline_lower'] = "left";
      $_SESSION['midline_lower_left_value'] =    $midline_lower_left_value;
		
		if($_SESSION['midline_upper'] == null) $_SESSION['midline_upper'] = "none";
		if($_SESSION['midline_lower'] == null) $_SESSION['midline_lower'] = "none";
        $_SESSION['ipr_option'] =   $ipr_option;


  //11


$_SESSION['ext_option'] = $ext_option;
$_SESSION['ext_toooth_list'] = $ext_toooth_list;
$_SESSION['e_select_number'] = explode(",",$ext_toooth_list[0]['tooth_number']);
if ($ext_option == "not_tooth_extraction") {
    $_SESSION['extraction'] = "none_tooth_e";
}else {
    $_SESSION['extraction'] = "tooth_e";
}

// 원래 코드
if ($occ_opening_device_lateral_incisor == "on") {
    $_SESSION['incisor_option'] = "lateral";
    $_SESSION['occ_opening_device_lateral_incisor'] = "lateral";
} else if ($occ_opening_device_central_incisor == "on") {

    $_SESSION['occ_opening_device_central_incisor'] = "central";
    $_SESSION['incisor_option'] = "central";
}

// 변경한 코드
if ($occ_opening_device_lateral_incisor == "on" || $occ_opening_device_lateral_incisor == "lateral") {
    $_SESSION['incisor_option'] = "lateral";
    $_SESSION['occ_opening_device_lateral_incisor'] = "lateral";
}

if ($occ_opening_device_central_incisor == "on" || $occ_opening_device_central_incisor == "central") {

    $_SESSION['occ_opening_device_central_incisor'] = "central";
    $_SESSION['incisor_option'] = "central";
}

    $_SESSION['occ_opening_device_option'] = $occ_opening_device_option;
	$_SESSION['occ_opening_device_type'] = $occ_opening_device_type;

 //11


$_SESSION['eruption_incisor_option']=$eruption_incisor_option ;
   $_SESSION['eruption_molar_option']=    $eruption_molar_option ;
    $_SESSION['special_instruction']=  $special_instruction ;
     $_SESSION['eruption_molar_value']=    $eruption_molar_value ;
 $_SESSION['incisor_select_number'] = $eruption_incisor_list[0];
$_SESSION['molar_select_number'] =   $eruption_molar_list[0];


//echo $_SESSION['progress_num'];

if($_SESSION['treatment_option1'] == "Adults"){
switch ($_SESSION['progress_num']) {
    case 3:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/03_patientinfo.php';</script>";
        break;
    case 4:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/04_classification.php';</script>";
        break;
    case 5:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/05_modeltype.php';</script>";
        break;
    case 6:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/06_photo.php';</script>";
        break;
    case 7:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/07_radiograph.php';</script>";
        break;
    case 8:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/08_setup1.php';</script>";
        break;
    case 9:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/09_setup2.php';</script>";
        break;
    case 10:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/10_setup3.php';</script>";
        break;
	case 11:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/11_setup4.php';</script>";
        break;
	case 12:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/12_setup5.php';</script>";
        break;
	case 13:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/13_summary.php';</script>";
        break;
    
    default:
        # code...
        break;
}
}else if($_SESSION['treatment_option1'] == "Child"){
switch ($_SESSION['progress_num']) {
    case 3:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/03_patientinfo.php';</script>";
        break;
    case 4:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/04_classification.php';</script>";
        break;
    case 5:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/05_modeltype.php';</script>";
        break;
    case 6:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/06_photo.php';</script>";
        break;
    case 7:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/07_radiograph.php';</script>";
        break;
    case 8:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/08_setup1.php';</script>";
        break;
    case 9:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/09_setup2.php';</script>";
        break;
    case 10:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/10_setup3.php';</script>";
        break;
	case 11:
        echo"<script>location.href = './service/".$_SESSION['treatment_option1']."/13_summary.php';</script>";
        break;
    
    default:
        # code...
        break;
}
}


?>
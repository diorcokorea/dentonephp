<?

// Include the main TCPDF library (search for installation path).
require_once('../models/dompdf/autoload.inc.php');
require_once('../views/inc/common.php');
include "../models/service_decode.php";
session_start();
use Dompdf\Dompdf;
use Dompdf\Options;
//ini_set("display_errors","1");
$pre = "2034";
$num = mb_strlen($pre, "UTF-8");
//print_r($num);
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$options->set('tempDir', $_SERVER['DOCUMENT_ROOT']);
$dompdf = new Dompdf($options);
$domPdfOptions = new Options();
$domPdfOptions->set("isPhpEnabled", true);

if ($_SESSION['patient_key'] != -1 && isset($_SESSION['patient_key']) &&  $_SESSION['service_key'] != -1 && isset($_SESSION['service_key'])) {
    $patientkey = $_SESSION['patient_key'] ;
    $patientServiceKey = $_SESSION['service_key'];
}else{
    $patientkey = $_POST['patientkey'];
    $patientServiceKey = $_POST['patientServiceKey'];
}

$service_info_array = service_r($patientkey,$patientServiceKey);
$service_info  = json_decode($service_info_array[12], true);
$patient_info_array = patient_r($patientkey);

$IMAGE = IMAGE;
$DOMAIN = DOMAIN;
$patient_id = $patient_info_array[0];

$patient_fname = explode(",",$patient_info_array[1])[0];
$patient_lname = explode(",",$patient_info_array[1])[1];
$patient_age = $patient_info_array[12];
$patient_lab = $patient_info_array[11];
$patient_race = $patient_info_array[6];
$patient_gender = ucfirst($patient_info_array[2]);
$patient_clinic_name = $patient_info_array[8];
$patient_date = $service_info_array[13];

$patient_birth_date_array = explode("-",$patient_info_array[4]);
$patient_birth_date = $patient_birth_date_array[2]."-".$patient_birth_date_array[1]."-".$patient_birth_date_array[0];
if ($service_info['treatment_option1'] == "Adults") {
    $treatment_option1 = "Adults including teenager";
}else{
    $treatment_option1 = "Child";
}
 
$treatment_option2 = $service_info['treatment_option2'];

$shipping_address = "[Zip code : ".$service_info['shipping_address']['zip_code']."] ".$service_info['shipping_address']['address1']." ".$service_info['shipping_address']['address2']." ".$service_info['shipping_address']['address3']." ".$service_info['shipping_address']['address4'];
$billing_address = "[Zip code : ".$service_info['billing_address']['zip_code']."] ".$service_info['billing_address']['address1']." ".$service_info['billing_address']['address2']." ".$service_info['billing_address']['address3']." ".$service_info['billing_address']['address4'];






if ($service_info['model_type'] != "Impression") {
        if ($service_info['model_mx'] != null && $service_info['model_md'] != null) {
        $model_file = "Maxilla, Mandible";
        }else if($service_info['model_mx'] != null && $service_info['model_md'] == null){
        $model_file = "Maxilla";
        }else if($service_info['model_mx'] == null && $service_info['model_md'] != null){
        $model_file = "Mandible"; 
        }
    $model_type = "Scan File / ".$model_file;
}else{
    $model_type = $service_info['model_type'];
}

$classification_array = Array();
foreach($service_info['classification'] as $key => $value){
if($value == "on"){
							switch ($key) {
								case 'crowding':
									$print_value = "Crowding";
									break;
								case 'diastemata':
									$print_value = "Diastemata";
									break;
								case 'class1':
									$print_value = "Class I";
									break;
								case 'class2_div1':
									$print_value = "Class II div1";
									break;
								case 'class2_div2':
									$print_value = "Class II div2";
									break;

								case 'class3':
									$print_value = "Class III";
									break;
								case 'asymmetric':
									$print_value = "Asymmetric";
									break;
								case 'vertical_open_bite':
									$print_value = "Vertical open bite";
									break;
								case 'horizontal_open_bite':
									$print_value = "Horizontal open bite (Overjet)";
									break;
								case 'deep_bite':
									$print_value = "Overbite";
									break;

								case 'anterior_occlusion':
									$print_value = "Anterior occlusion";
									break;
								case 'posterior_occlusion':
									$print_value = "Posterior occlusion";
									break;
								case 'narrow_arch':
									$print_value = "Narrow arch";
									break;
								case 'anterior_teeth':
									$print_value = "Prolapse of anterior teeth";
									break;
								case 'smile_line':
									$print_value = "Improve smile line";
									break;
								
								case 'inclined_occlusal_plane':
									$print_value = "Inclined occlusal plane";
									break;
								case 'abnormal_teeth_shape':
									$print_value = "Abnormal tooth shape";
									break;
								case 'etc':
									$print_value = "Etc";
									break;
							}
  array_push($classification_array, $print_value);
}
}

$classification = implode(", ", $classification_array);
$etc = $service_info['classification']['etc_value'];
$precaution = $service_info['classification']['precaution'];

$precaution =   str_replace(array("\r\n","\r","\n"),'',$service_info['classification']['precaution']); 

if(mb_strlen($precaution, "UTF-8") > 780){

$precaution_temp = mb_substr($precaution, 780, null, 'UTF-8'); 
//echo $str_temp;
//exit;
$precaution = mb_substr($precaution,0,780);
$precaution_page_add = "<div class='page_break'>
			<table style='width:100%' cellpadding='10px' cellspacing='0'>
				<tr>
					<td style='background-color:#000;color:#fff;font-size:14' class='bold'>Classification</td>
				</tr>
			</table>
			<div style='border:1px solid #707070;width:100%;padding:20px 40px 20px 40px'>
				<textarea wrap='virtual' maxlength='50' style='width:100%;padding:10px;border-radius:5px;overflow:hidden;height:500px'>".$precaution_temp."</textarea>
			</div>
			
		</div>";
}

if(isset($service_info['lateral_photo']) && $service_info['lateral_photo'] != ""){
    $lateral_photo =  $DOMAIN."/data/".$service_info['lateral_photo'];
}else{
    $lateral_photo = $IMAGE.'/print_photo1.jpg';
}

if(isset($service_info['front_photo']) && $service_info['front_photo'] != ""){
    $front_photo =  $DOMAIN."/data/".$service_info['front_photo'];
}else{
    $front_photo = $IMAGE.'/print_photo2.jpg';
}

if(isset($service_info['smile_photo']) && $service_info['smile_photo'] != ""){
    $smile_photo =  $DOMAIN."/data/".$service_info['smile_photo'];
}else{
    $smile_photo = $IMAGE.'/print_photo3.jpg';
}

if(isset($service_info['intraoral_upper']) && $service_info['intraoral_upper'] != ""){
    $intraoral_upper =  $DOMAIN."/data/".$service_info['intraoral_upper'];
}else{
    $intraoral_upper = $IMAGE.'/print_photo4.jpg';
}

if(isset($service_info['intraoral_lower']) && $service_info['intraoral_lower'] != ""){
    $intraoral_lower =  $DOMAIN."/data/".$service_info['intraoral_lower'];
}else{
    $intraoral_lower = $IMAGE.'/print_photo5.jpg';
}

if(isset($service_info['intraoral_right']) && $service_info['intraoral_right'] != ""){
    $intraoral_right =  $DOMAIN."/data/".$service_info['intraoral_right'];
}else{
    $intraoral_right = $IMAGE.'/print_photo6.jpg';
}

if(isset($service_info['intraoral_fornt']) && $service_info['intraoral_fornt'] != ""){
    $intraoral_fornt =  $DOMAIN."/data/".$service_info['intraoral_fornt'];
}else{
    $intraoral_fornt = $IMAGE.'/print_photo7.jpg';
}

if(isset($service_info['intraoral_left']) && $service_info['intraoral_left'] != ""){
    $intraoral_left =  $DOMAIN."/data/".$service_info['intraoral_left'];
}else{
    $intraoral_left = $IMAGE.'/print_photo8.jpg';
}

if(isset($service_info['lateral_xray']) && $service_info['lateral_xray'] != ""){
    $lateral_xray =  $DOMAIN."/data/".$service_info['lateral_xray'];
}else{
    $lateral_xray = $IMAGE.'/pritn_xray_1.jpg';
}

if(isset($service_info['panorama']) && $service_info['panorama'] != ""){
    $panorama =  $DOMAIN."/data/".$service_info['panorama'];
}else{
    $panorama = $IMAGE.'/pritn_xray_2.jpg';
}



for ($i=11; $i <= 100; $i++) { 
    $diagnostics[$i] = $i;
    $attachment[$i] = "bracket_num";
    $extraction[$i] = $i;
}



for ($i=13; $i <= 15; $i++) { 
    $compensation[$i] = "bracket_num";
}
for ($i=23; $i <= 25; $i++) { 
    $compensation[$i] = "bracket_num";
}
for ($i=33; $i <= 35; $i++) { 
    $compensation[$i] = "bracket_num";
}
for ($i=43; $i <= 45; $i++) { 
    $compensation[$i] = "bracket_num";
}

$molar[17] = "bracket_num";
$molar[27] = "bracket_num";
$molar[37] = "bracket_num";
$molar[47] = "bracket_num";



if (count($service_info['diagnostics']) > 0) {
for ($i=0; $i < count($service_info['diagnostics']); $i++) { 

    $tp_array = explode(',',$service_info['diagnostics'][$i]['tooth_number']);

    if($service_info['diagnostics'][$i]['type'] == "Crown"){
        for ($j=0; $j < count($tp_array); $j++) { 
            $diagnostics[$tp_array[$j]] = "<img class='diagnostics_img' src='".$IMAGE."/crown_icon.png'>";
        }
    }else if($service_info['diagnostics'][$i]['type'] == "Implant"){
        for ($j=0; $j < count($tp_array); $j++) { 
            $diagnostics[$tp_array[$j]] = "<img class='diagnostics_img' src='".$IMAGE."/implant_icon.png'>";
        }
    }else if($service_info['diagnostics'][$i]['type'] == "Telesopic crown"){
        for ($j=0; $j < count($tp_array); $j++) { 
            $diagnostics[$tp_array[$j]] = "<img class='diagnostics_img' src='".$IMAGE."/Telescopic_crown_icon.png'>";
        }
    }else if($service_info['diagnostics'][$i]['type'] == "Veneered crown"){
        for ($j=0; $j < count($tp_array); $j++) { 
             $diagnostics[$tp_array[$j]] = "<img class='diagnostics_img' src='".$IMAGE."/Veneered_crown_icon.png'>";
         }
        }
    }
}

$attachment_list = $service_info['attchment_list'][0];
if (count($attachment_list) > 0) {
    for ($i=0; $i < count($attachment_list); $i++) { 
        $attachment[$attachment_list[$i]] = "select";
    }
}

$ext_toooth_list = explode(',',$service_info['ext_toooth_list'][0]['tooth_number']);
if (count($ext_toooth_list) > 0) {
    for ($i=0; $i < count($ext_toooth_list); $i++) { 
        $extraction[$ext_toooth_list[$i]] = "<img class='diagnostics_img' src='".$IMAGE."/extraction_icon.png'>";
    }
}

$compensation_list = $service_info['eruption_incisor_list'][0];
if (count($compensation_list) > 0) {
    for ($i=0; $i < count($compensation_list); $i++) { 
        $compensation[$compensation_list[$i]] = "select";
    }
}
 
$molar_list = $service_info['eruption_molar_list'][0];
if (count($molar_list) > 0) {
    for ($i=0; $i < count($molar_list); $i++) { 
        $molar[$molar_list[$i]] = "select";
    }
}

switch ($service_info['arch']) {
    case 'both':
       $arch = "Both arches";
        break;

    case 'upper':
        $arch = "Upper";
        break;
    
    case 'lower':
      $arch = "Lower";
        break;
}

switch ($service_info['attchment_option']) {
    case 'select':
       $attchment_option = "Select teeth to apply attachments";
        break;

    case 'automatically':
        $attchment_option = "Automatically add attachments for necessary teeth movement";
        break;

}

switch ($service_info['ap_relation_upper']) {
    case 'expansion':
       $ap_relation_upper = "Protrusion";
        break;
    case 'retraction':
        $ap_relation_upper = "Retraction";
        break;
}

switch ($service_info['ap_relation_lower']) {
    case 'expansion':
       $ap_relation_lower = "Protrusion";
        break;
    case 'retraction':
        $ap_relation_lower = "Retraction";
        break;
}

switch ($service_info['ap_relation_canine']) {
    case 'maintain':
       $ap_relation_canine = "Maintain";
        break;
    case 'improve':
        $ap_relation_canine = "Improve";
        break;
}

switch ($service_info['ap_relation_molar']) {
    case 'maintain':
       $ap_relation_molar = "Maintain";
        break;
    case 'improve':
        $ap_relation_molar = "Improve";
        break;
}


switch ($service_info['occ_opening_device_option']) {
    case 'none':
       $occ_opening_device_option = "None";
        break;
    case 'bite_ramp':

		switch ($service_info['occ_opening_device_type']) {
				case 'incisor':
				$occ_opening_device_type = " / Incisor";
					if ( $service_info['occ_opening_device_central_incisor'] != null) {
						$occ_opening_device_central_incisor = " / Central incisor";
					}
					if ( $service_info['occ_opening_device_lateral_incisor'] != null) {
						$occ_opening_device_lateral_incisor = " / Lateral incisor";
					}
					
					break;
				case 'canine':
				$occ_opening_device_type = " / Canine";
					break;
			}
	
        $occ_opening_device_option = "Bite ramp on the lingual side of the maxilla";
        break;
}

$occ_opening_device_option = $occ_opening_device_option.$occ_opening_device_type.$occ_opening_device_central_incisor.$occ_opening_device_lateral_incisor;

switch ($service_info['ext_option']) {
    case 'tooth_extraction':
       $ext_option = "Extraction";
        break;
    case 'not_tooth_extraction':
        $ext_option = "Non Extraction";
        break;
}

switch ($service_info['eruption_incisor_option']) {
    case 'none':
       $eruption_incisor_option = "None";
        break;
    case 'provide':
        $eruption_incisor_option = "Select teeth for compensation";
        break;
}

switch ($service_info['eruption_molar_option']) {
    case 'none':
       $eruption_molar_option = "None";
        break;
    case 'provide':
        $eruption_molar_option = "Select teeth for compensation";
        break;
}

$eruption_molar_value = $service_info['eruption_molar_value'] ?: "--------";

$overbite = $service_info['overbite'];
$overbite_value = $service_info['overbite_value'];
if ($overbite != "Ideal") {
    $overbite = $overbite."(".$overbite_value."mm)";
}else{
    $overbite = $overbite."(2mm)";
}


$overjet = $service_info['overjet'];
$overjet_value = $service_info['overjet_value'];
if ($overjet != "Ideal") {
    $overjet = $overjet."(".$overjet_value."mm)";
}else{
    $overjet = $overjet."(2mm)";
}

$ipr_option = $service_info['ipr_option'];

$special_instruction = $service_info['special_instruction'];

$special_instruction =   str_replace(array("\r\n","\r","\n"),'',$service_info['special_instruction']); 

if ($treatment_option1 == "Child") {

if(mb_strlen($special_instruction, "UTF-8") > 2240){

$str_temp = mb_substr($special_instruction, 2240, null, 'UTF-8'); 
//echo $str_temp;
//exit;
$special_instruction = mb_substr($special_instruction,0,2240);
$text_page_add = "<div class='new_page_break'>
			<table style='width:100%' cellpadding='10px' cellspacing='0'>
				<tr>
					<td style='background-color:#000;color:#fff;font-size:14' class='bold'>Prescription3</td>
				</tr>
			</table>
			<div style='border:1px solid #707070;width:100%;padding:20px 40px 20px 40px'>
				<textarea wrap='virtual' maxlength='50' style='width:100%;padding:10px;border-radius:5px;overflow:hidden;height:500px'>".$str_temp."</textarea>
			</div>
			
		</div>";
}

}else{

if(mb_strlen($special_instruction, "UTF-8") > 2240){

$str_temp = mb_substr($special_instruction, 2240, null, 'UTF-8'); 
//echo $str_temp;
//exit;
$special_instruction = mb_substr($special_instruction,0,2240);
$text_page_add = "<div class='new_page_break'>
			<table style='width:100%' cellpadding='10px' cellspacing='0'>
				<tr>
					<td style='background-color:#000;color:#fff;font-size:14' class='bold'>Prescription5</td>
				</tr>
			</table>
			<div style='border:1px solid #707070;width:100%;padding:20px 40px 20px 40px'>
				<textarea wrap='virtual' maxlength='50' style='width:100%;padding:10px;border-radius:5px;overflow:hidden;height:500px'>".$str_temp."</textarea>
			</div>
			
		</div>";
}
}


// $diagnostics[18] = "18";
// $diagnostics[17] = "<img class='diagnostics_img' src='".$IMAGE."/implant_icon.png'>";


// $lateral_photo =  $service_info['lateral_photo'] ?: $IMAGE.'print_photo1.jpg';
// $front_photo = $service_info['front_photo'] ?: $IMAGE.'print_photo2.jpg';
// $smile_photo =  $service_info['smile_photo'] ?: 'print_photo3.jpg';
// $intraoral_upper = $service_info['intraoral_upper'] ?: 'print_photo4.jpg';
// $intraoral_lower = $service_info['intraoral_lower'] ?: 'print_photo5.jpg';
// $intraoral_right = $service_info['intraoral_right'] ?: 'print_photo6.jpg';
// $intraoral_fornt = $service_info['intraoral_fornt'] ?: 'print_photo7.jpg';
// $intraoral_left = $service_info['intraoral_left'] ?: 'print_photo8.jpg';
// $lateral_xray = $service_info['lateral_xray'] ?: 'pritn_xray_1.jpg';
// $panorama = $service_info['panorama'] ?: 'pritn_xray_2.jpg';


   // $pdf->setOptions(['isRemoteEnabled' => true]);
   // $pdf->getDomPDF()->setProtocol($_SERVER['DOCUMENT_ROOT']);
if ($treatment_option1 == "Child") {
$html = 
<<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<html>
<meta http-ｅquiv="Content-Type" content="text/html; charset=utf-8" />
  <head>
    <style>
      @page{
        margin-top: 400px; /* create space for header */
        margin-bottom: 30px; /* create space for footer */
      }
	  @font-face{
		  font-family:NanumGothic; 
		  src: url("$domain/models/dompdf/lib/fonts/NanumGothic.ttf");
      }
	  @font-face{
		  font-family:NanumGothicBold; 
		  src: url("$domain/models/dompdf/lib/fonts/NanumGothicBold.ttf");
      }

	  body {font-family:'NanumGothic';font-size:14px}
      header{
        position: fixed;
        left: 0px;
        right: 0px;
        margin-top: -335px;
	
      }
      footer{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 70px;
		bottom:0
        margin-bottom: -80px;
      }
	  .page:after { content: counter(page, decimal); }
	  h3 {font-family:'NanumGothicBold';font-weight:normal}
	  h4 {font-family:'NanumGothicBold';font-weight:normal}
	  .bold {font-family:'NanumGothicBold';}
		.new_page_break { page-break-before: always; }
		.page_break { page-break-after: always; }
		table td img {display:block;}
		.photo {overflow:hidden}
		.photo td img {max-height:170px}
		.xray {overflow:hidden}
		.xray td img {max-height:360px}
		.bracket {width:100%}
		.bracket td {padding:0 2px}
		.bracket td .bracket_num {border:1px solid #707070;width:28px; height:36px;background:url('$IMAGE/bracket_x.png') no-repeat;background-size:100% 100%;overflow:hidden;text-align:center;line-height:23px}
		.bracket td .bracket_num img {width:28px;height:36px}
		.bracket .top td {border-bottom:1px solid #707070;padding-bottom:5px}
		.bracket .bottom td {padding-top:5px}
		.select {width:28px; height:36px;background-color:#07a2e8;color:#fff;line-height:23px;text-align:center;border:1px solid #07a2e8}
    </style>
  </head>
  <body>
    <header>
      <table style="width:100%;margin-bottom:10px" cellspacing="0" cellpadding="5px 8px">
			<tr style="">
				<td style="width:20%;border-top:1px solid;border-left:1px solid;border-color:#707070;padding-bottom:0;">Design option</td>
				<td style="width:2%;border-top:1px solid;border-color:#707070;padding-bottom:0">:</td>
				<td style="width:40%;border-top:1px solid;border-right:1px solid;border-color:#707070;padding-bottom:0">$treatment_option1($treatment_option2)</td>
				<td rowspan="2" align="right"><img src="$IMAGE/page_logo.png"; width="140px">
			</tr>
			<tr>
				<td style="width:20%;border-bottom:1px solid;border-left:1px solid;border-color:#707070;padding-top:0">Clinic name</td>
				<td style="width:2%;border-bottom:1px solid;border-color:#707070;padding-top:0">:</td>
				<td style="width:40%;border-bottom:1px solid;border-right:1px solid;border-color:#707070;padding-top:0">$patient_clinic_name</td>
			</tr>
		</table>
		<div style="border:1px solid #707070;width:100%;margin-bottom:10px;padding:5px 8px">
			<table cellpadding="1px" cellspacing="0" style="width:100%;">
					<tr>
						<td style="width:15%">Patient ID</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_id</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Date of birth</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_birth_date</td>
					</tr>
					<tr>
						<td style="width:15%">First name</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_fname</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Age</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_age</td>
					</tr>
					<tr>
						<td style="width:15%">Last name</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_lname</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Lab</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_lab</td>
					</tr>
					<tr>
						<td style="width:15%">Gender</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_gender</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Race</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_race</td>
					</tr>
			</table>
			<table cellpadding="2px" style="width:100%;margin-top:5px">
				<tr>
					<td style="width:20%" valign="top">Delivery address</td>
					<td style="width:2%" valign="top">:</td>
					<td style="height:40px" valign="top">$shipping_address</td>
				</tr>
				<tr>
					<td style="width:20%" valign="top">Billing address</td>
					<td style="width:2%" valign="top">:</td>
					<td style="height:40px" valign="top">$billing_address</td>
				</tr>
			</table>
		</div>
		<table style="border:1px solid #707070;width:100%" cellspacing="8">
				<tr>
					<td style="width:20%">Model type</td>
					<td style="width:2%">:</td>
					<td style="width:78%">$model_type</td>
				</tr>
			</table>
    </header>

	<footer>
      <table style="border:1px solid #707070;width:100%" cellpadding="10" cellspacing="0">
			<tr>
				<td style="">Written in : $patient_date</td>
			</tr>
		</table>
    </footer>
	
    <main>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Classification</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:10px 0">
				<table cellpadding="10px" style="margin-bottom:10px">
					<tr>
						<td style="padding-left:60px;width:20%" valign="top">Status</td>
						<td style="width:4%" align="center" valign="top">:</td>
						<td style="padding-right:80px;width:76%;height:110px" valign="top">$classification</td>
					</tr>
					<tr>
						<td style="padding-left:60px;width:20%" valign="top">Etc</td>
						<td style="padding-right:60px;width:80%" valign="top" colspan="2"><textarea wrap="virtual" style="width:450px;height:100px;padding:10px;border-radius:5px">$etc</textarea></td>
					</tr>
					<tr>
						<td style="padding-left:60px">Note</td>
					</tr>
					<tr>
						<td style="padding:0 60px" colspan="3"><textarea wrap="virtual" style="width:550px;height:180px;padding:10px;border-radius:5px">$precaution</textarea></td>
					</tr>
				</table>
			</div>
		</div>
		$precaution_page_add
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Photo</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:23px 30px;text-align:center">
				<table class="photo" style="width:100%" cellspacing="10px" cellpadding="1px">
					<tr>
						<td style="border:1px solid #707070;height:155px;width:25%;" align="center" valign="middle"><img src="$lateral_photo" style="width:100%;"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$front_photo" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$smile_photo" width="100%"></td>
					</tr>
					<tr>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_upper" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle">This is a registerd photo.</td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_lower" width="100%"></td>
					</tr>
					<tr>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_right" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_fornt" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_left" width="100%"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">X-ray image</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:50px 30px;text-align:center">
				<table class="xray" style="height:auto;width:100%" cellspacing="20px" cellpadding="1px">
					<tr>
						<td style="border:1px solid #707070;height:420px;width:45%" align="center" valign="middle"><img src="$lateral_xray" style="width:100%;"></td>
						<td style="border:1px solid #707070;height:420px;width:45%" align="center" valign="middle"><img src="$panorama" width="100%"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription1</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:60px 40px 115px 40px">
				<table style="width:100%" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3 style="margin:0">1. Select a arch</h3></td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">$arch</td>
					</tr>
				</table>
				<div style="margin-top:50px">
					<h3 style="margin:0">2. Please select full diagnostics</h3>
					<h4 style="margin:5px 0 10px 0;">(Implant, Telescopic crown, Veneered crown)</h3>
				</div>
				<table class="bracket" cellpadding="0" cellspacing="0" style="margin-top:40px;width:80%">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="bracket_num">$diagnostics[16]</div></td>
						<td><div class="bracket_num">$diagnostics[15]</div></td>
						<td><div class="bracket_num">$diagnostics[14]</div></td>
						<td><div class="bracket_num">$diagnostics[13]</div></td>
						<td><div class="bracket_num">$diagnostics[12]</div></td>
						<td><div class="bracket_num">$diagnostics[11]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$diagnostics[21]</div></td>
						<td><div class="bracket_num">$diagnostics[22]</div></td>
						<td><div class="bracket_num">$diagnostics[23]</div></td>
						<td><div class="bracket_num">$diagnostics[24]</div></td>
						<td><div class="bracket_num">$diagnostics[25]</div></td>
						<td><div class="bracket_num">$diagnostics[26]</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="bracket_num">$diagnostics[46]</div></td>
						<td><div class="bracket_num">$diagnostics[45]</div></td>
						<td><div class="bracket_num">$diagnostics[44]</div></td>
						<td><div class="bracket_num">$diagnostics[43]</div></td>
						<td><div class="bracket_num">$diagnostics[42]</div></td>
						<td><div class="bracket_num">$diagnostics[41]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$diagnostics[31]</div></td>
						<td><div class="bracket_num">$diagnostics[32]</div></td>
						<td><div class="bracket_num">$diagnostics[33]</div></td>
						<td><div class="bracket_num">$diagnostics[34]</div></td>
						<td><div class="bracket_num">$diagnostics[35]</div></td>
						<td><div class="bracket_num">$diagnostics[36]</div></td>
					</tr>
				</table>
				<table class="bracket" cellpadding="0" cellspacing="0" style="margin-top:40px;width:70%">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="bracket_num">$diagnostics[55]</div></td>
						<td><div class="bracket_num">$diagnostics[54]</div></td>
						<td><div class="bracket_num">$diagnostics[53]</div></td>
						<td><div class="bracket_num">$diagnostics[52]</div></td>
						<td><div class="bracket_num">$diagnostics[51]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$diagnostics[61]</div></td>
						<td><div class="bracket_num">$diagnostics[62]</div></td>
						<td><div class="bracket_num">$diagnostics[63]</div></td>
						<td><div class="bracket_num">$diagnostics[64]</div></td>
						<td><div class="bracket_num">$diagnostics[65]</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="bracket_num">$diagnostics[85]</div></td>
						<td><div class="bracket_num">$diagnostics[84]</div></td>
						<td><div class="bracket_num">$diagnostics[83]</div></td>
						<td><div class="bracket_num">$diagnostics[82]</div></td>
						<td><div class="bracket_num">$diagnostics[81]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$diagnostics[71]</div></td>
						<td><div class="bracket_num">$diagnostics[72]</div></td>
						<td><div class="bracket_num">$diagnostics[73]</div></td>
						<td><div class="bracket_num">$diagnostics[74]</div></td>
						<td><div class="bracket_num">$diagnostics[75]</div></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%;" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription2</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:40px 40px 65px 40px">
				<table style="width:100%" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3>3. Attachment</h3></td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">$attchment_option</td>
					</tr>
				</table>
				<table class="bracket" cellpadding="0" cellspacing="0" style="width:80%;margin-top:30px">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="$attachment[16]">16</div></td>
						<td><div class="$attachment[15]">15</div></td>
						<td><div class="$attachment[14]">14</div></td>
						<td><div class="$attachment[13]">13</div></td>
						<td><div class="$attachment[12]">12</div></td>
						<td><div class="$attachment[11]">11</div></td>
						<td align="center"></td>
						<td><div class="$attachment[21]">21</div></td>
						<td><div class="$attachment[22]">22</div></td>
						<td><div class="$attachment[23]">23</div></td>
						<td><div class="$attachment[24]">24</div></td>
						<td><div class="$attachment[25]">25</div></td>
						<td><div class="$attachment[26]">26</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="$attachment[46]">46</div></td>
						<td><div class="$attachment[45]">45</div></td>
						<td><div class="$attachment[44]">44</div></td>
						<td><div class="$attachment[43]">43</div></td>
						<td><div class="$attachment[42]">42</div></td>
						<td><div class="$attachment[41]">41</div></td>
						<td align="center"></td>
						<td><div class="$attachment[31]">31</div></td>
						<td><div class="$attachment[32]">32</div></td>
						<td><div class="$attachment[33]">33</div></td>
						<td><div class="$attachment[34]">34</div></td>
						<td><div class="$attachment[35]">35</div></td>
						<td><div class="$attachment[36]">36</div></td>
					</tr>
				</table>
				<table class="bracket" cellpadding="0" cellspacing="0" style="margin-top:30px;width:70%">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="$attachment[55]">55</div></td>
						<td><div class="$attachment[54]">54</div></td>
						<td><div class="$attachment[53]">53</div></td>
						<td><div class="$attachment[52]">52</div></td>
						<td><div class="$attachment[51]">51</div></td>
						<td align="center"></td>
						<td><div class="$attachment[61]">61</div></td>
						<td><div class="$attachment[62]">62</div></td>
						<td><div class="$attachment[63]">63</div></td>
						<td><div class="$attachment[64]">64</div></td>
						<td><div class="$attachment[65]">65</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="$attachment[85]">85</div></td>
						<td><div class="$attachment[84]">84</div></td>
						<td><div class="$attachment[83]">83</div></td>
						<td><div class="$attachment[82]">82</div></td>
						<td><div class="$attachment[81]">81</div></td>
						<td align="center"></td>
						<td><div class="$attachment[71]">71</div></td>
						<td><div class="$attachment[72]">72</div></td>
						<td><div class="$attachment[73]">73</div></td>
						<td><div class="$attachment[74]">74</div></td>
						<td><div class="$attachment[75]">75</div></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:60px" cellspacing="0" cellpadding="5px 0">
					<tr>
						<td colspan="6"><h3 style="margin:0">4. A.P relation</h3></td>
					</tr>
					<tr>
						<td style="width:5%"></td>
						<td style="width:25%" class="bold">Upper</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_upper</td>
						<td style="width:25%;" class="bold">Lower</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_lower</td>
					</tr>
					<tr>
						<td style="width:5%"></td>
						<td style="width:25%" class="bold">Canine Relationship</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_canine</td>
						<td style="width:25%" class="bold">Molar Relationship</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_molar</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription3</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:60px 40px 180px 40px">
				<table style="width:100%" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3>5. Extraction</h3></td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">$ext_option</td>
					</tr>
				</table>
				<table class="bracket" style="margin-top:40px;width:80%;" cellpadding="0" cellspacing="0">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="bracket_num">$extraction[16]</div></td>
						<td><div class="bracket_num">$extraction[15]</div></td>
						<td><div class="bracket_num">$extraction[14]</div></td>
						<td><div class="bracket_num">$extraction[13]</div></td>
						<td><div class="bracket_num">$extraction[12]</div></td>
						<td><div class="bracket_num">$extraction[11]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$extraction[21]</div></td>
						<td><div class="bracket_num">$extraction[22]</div></td>
						<td><div class="bracket_num">$extraction[23]</div></td>
						<td><div class="bracket_num">$extraction[24]</div></td>
						<td><div class="bracket_num">$extraction[25]</div></td>
						<td><div class="bracket_num">$extraction[26]</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="bracket_num">$extraction[46]</div></td>
						<td><div class="bracket_num">$extraction[45]</div></td>
						<td><div class="bracket_num">$extraction[44]</div></td>
						<td><div class="bracket_num">$extraction[43]</div></td>
						<td><div class="bracket_num">$extraction[42]</div></td>
						<td><div class="bracket_num">$extraction[41]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$extraction[31]</div></td>
						<td><div class="bracket_num">$extraction[32]</div></td>
						<td><div class="bracket_num">$extraction[33]</div></td>
						<td><div class="bracket_num">$extraction[34]</div></td>
						<td><div class="bracket_num">$extraction[35]</div></td>
						<td><div class="bracket_num">$extraction[36]</div></td>
					</tr>
				</table>
				<table class="bracket" style="margin-top:40px;width:70%" cellpadding="0" cellspacing="0">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="bracket_num">$extraction[55]</div></td>
						<td><div class="bracket_num">$extraction[54]</div></td>
						<td><div class="bracket_num">$extraction[53]</div></td>
						<td><div class="bracket_num">$extraction[52]</div></td>
						<td><div class="bracket_num">$extraction[51]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$extraction[61]</div></td>
						<td><div class="bracket_num">$extraction[62]</div></td>
						<td><div class="bracket_num">$extraction[63]</div></td>
						<td><div class="bracket_num">$extraction[64]</div></td>
						<td><div class="bracket_num">$extraction[65]</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="bracket_num">$extraction[85]</div></td>
						<td><div class="bracket_num">$extraction[84]</div></td>
						<td><div class="bracket_num">$extraction[83]</div></td>
						<td><div class="bracket_num">$extraction[82]</div></td>
						<td><div class="bracket_num">$extraction[81]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$extraction[71]</div></td>
						<td><div class="bracket_num">$extraction[72]</div></td>
						<td><div class="bracket_num">$extraction[73]</div></td>
						<td><div class="bracket_num">$extraction[74]</div></td>
						<td><div class="bracket_num">$extraction[75]</div></td>
					</tr>
				</table>
			</div>
		</div>
		<div>
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription3</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:10px 40px;">
				<table style="width:100%;" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3 style="margin:0">5. Additional request</h3></td>
					</tr>
					<tr>
						<td style=""><textarea wrap="virtual" style="width:100%;height:470px;padding:10px;border-radius:5px">$special_instruction</textarea></td>
					</tr>
				</table>
			</div>
		</div>
		$text_page_add
    </main>
	
  </body>
</html>
EOF;
}else{
$html = 
<<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<html>
<meta http-ｅquiv="Content-Type" content="text/html; charset=utf-8" />
  <head>
   <style>
      @page{
        margin-top: 400px; /* create space for header */
        margin-bottom: 30px; /* create space for footer */
      }
	  @font-face{
		  font-family:NanumGothic; 
		  src: url("$domain/models/dompdf/lib/fonts/NanumGothic.ttf");
      }
	  @font-face{
		  font-family:NanumGothicBold; 
		  src: url("$domain/models/dompdf/lib/fonts/NanumGothicBold.ttf");
      }

	  body {font-family:'NanumGothic';font-size:14px}
      header{
        position: fixed;
        left: 0px;
        right: 0px;
        margin-top: -335px;
	
      }
      footer{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 70px;
		bottom:0
        margin-bottom: -80px;
      }
	  .page:after { content: counter(page, decimal); }
	  h3 {font-family:'NanumGothicBold';font-weight:normal}
	  h4 {font-family:'NanumGothicBold';font-weight:normal}
	  .bold {font-family:'NanumGothicBold';}
		.new_page_break { page-break-before: always; }
		.page_break { page-break-after: always; }
		table td img {display:block;}
		.photo {overflow:hidden}
		.photo td img {max-height:170px}
		.xray {overflow:hidden}
		.xray td img {max-height:360px}
		.bracket {width:100%}
		.bracket td {padding:0 2px}
		.bracket td .bracket_num {border:1px solid #707070;width:28px; height:36px;background:url('$IMAGE/bracket_x.png') no-repeat;background-size:100% 100%;overflow:hidden;text-align:center;line-height:23px}
		.bracket td .bracket_num img {width:28px;height:36px}
		.bracket .top td {border-bottom:1px solid #707070;padding-bottom:5px}
		.bracket .bottom td {padding-top:5px}
		.select {width:28px; height:36px;background-color:#07a2e8;color:#fff;line-height:23px;text-align:center;border:1px solid #07a2e8}
    </style>
  </head>
  <body>
  <script type="text/php">
    if (isset($pdf))
    {
        $x = 72;
        $y = 18;
        $text = "{PAGE_NUM} of {PAGE_COUNT}";
        $font = $fontMetrics->get_font("helvetica", "bold");
        $size = 6;
        $color = array(255,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
    <header>
      <table style="width:100%;margin-bottom:10px" cellspacing="0" cellpadding="5px 8px">
			<tr style="">
				<td style="width:20%;border-top:1px solid;border-left:1px solid;border-color:#707070;padding-bottom:0;">Design option</td>
				<td style="width:2%;border-top:1px solid;border-color:#707070;padding-bottom:0">:</td>
				<td style="width:40%;border-top:1px solid;border-right:1px solid;border-color:#707070;padding-bottom:0">$treatment_option1($treatment_option2)</td>
				<td rowspan="2" align="right"><img src="$IMAGE/page_logo.png"; width="140px">
			</tr>
			<tr>
				<td style="width:20%;border-bottom:1px solid;border-left:1px solid;border-color:#707070;padding-top:0">Clinic name</td>
				<td style="width:2%;border-bottom:1px solid;border-color:#707070;padding-top:0">:</td>
				<td style="width:40%;border-bottom:1px solid;border-right:1px solid;border-color:#707070;padding-top:0">$patient_clinic_name</td>
			</tr>
		</table>
		<div style="border:1px solid #707070;width:100%;margin-bottom:10px;padding:5px 8px">
			<table cellpadding="1px" cellspacing="0" style="width:100%;">
					<tr>
						<td style="width:15%">Patient ID</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_id</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Date of birth</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_birth_date</td>
					</tr>
					<tr>
						<td style="width:15%">First name</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_fname</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Age</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_age</td>
					</tr>
					<tr>
						<td style="width:15%">Last name</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_lname</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Lab</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_lab</td>
					</tr>
					<tr>
						<td style="width:15%">Gender</td>
						<td style="width:2%">:</td>
						<td style="width:30%">$patient_gender</td>
						<td style="width:15%;border-left:1px solid #707070;padding-left:30px">Race</td>
						<td style="width:2%">:</td>
						<td style="width:25%">$patient_race</td>
					</tr>
			</table>
			<table cellpadding="2px" style="width:100%;margin-top:5px">
				<tr>
					<td style="width:20%" valign="top">Delivery address</td>
					<td style="width:2%" valign="top">:</td>
					<td style="height:40px" valign="top">$shipping_address</td>
				</tr>
				<tr>
					<td style="width:20%" valign="top">Billing address</td>
					<td style="width:2%" valign="top">:</td>
					<td style="height:40px" valign="top">$billing_address</td>
				</tr>
			</table>
		</div>
		<table style="border:1px solid #707070;width:100%" cellspacing="8">
				<tr>
					<td style="width:20%">Model type</td>
					<td style="width:2%">:</td>
					<td style="width:78%">$model_type</td>
				</tr>
			</table>
    </header>

	<footer>
      <table style="border:1px solid #707070;width:100%" cellpadding="10" cellspacing="0">
			<tr>
				<td style="">Written in : $patient_date</td>
			</tr>
		</table>
    </footer>
	
    <main>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Classification</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:10px 0">
				<table cellpadding="10px" style="margin-bottom:10px">
					<tr>
						<td style="padding-left:60px;width:20%" valign="top">Status</td>
						<td style="width:4%" align="center" valign="top">:</td>
						<td style="padding-right:80px;width:76%;height:110px" valign="top">$classification</td>
					</tr>
					<tr>
						<td style="padding-left:60px;width:20%" valign="top">Etc</td>
						<td style="padding-right:60px;width:80%" valign="top" colspan="2"><textarea wrap="virtual" style="width:450px;height:100px;padding:10px;border-radius:5px">$etc</textarea></td>
					</tr>
					<tr>
						<td style="padding-left:60px">Note</td>
					</tr>
					<tr>
						<td style="padding:0 60px" colspan="3"><textarea wrap="virtual" style="width:550px;height:180px;padding:10px;border-radius:5px">$precaution</textarea></td>
					</tr>
				</table>
			</div>
		</div>
		$precaution_page_add
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Photo</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:23px 30px;text-align:center">
				<table class="photo" style="width:100%" cellspacing="10px" cellpadding="1px">
					<tr>
						<td style="border:1px solid #707070;height:155px;width:25%;" align="center" valign="middle"><img src="$lateral_photo" style="width:100%;"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$front_photo" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$smile_photo" width="100%"></td>
					</tr>
					<tr>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_upper" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle">This is a registerd photo.</td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_lower" width="100%"></td>
					</tr>
					<tr>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_right" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_fornt" width="100%"></td>
						<td style="border:1px solid #707070;height:155px;width:25%" align="center" valign="middle"><img src="$intraoral_left" width="100%"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">X-ray image</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:50px 30px;text-align:center">
				<table class="xray" style="height:auto;width:100%" cellspacing="20px" cellpadding="1px">
					<tr>
						<td style="border:1px solid #707070;height:420px;width:45%" align="center" valign="middle"><img src="$lateral_xray" style="width:100%;"></td>
						<td style="border:1px solid #707070;height:420px;width:45%" align="center" valign="middle"><img src="$panorama" width="100%"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription1</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:80px 40px 215px 40px">
				<table style="width:100%" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3 style="margin:0">1. Select a arch</h3></td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">$arch</td>
					</tr>
				</table>
				<div style="margin-top:80px">
					<h3 style="margin:0">2. Please select full diagnostics</h3>
					<h4 style="margin:5px 0 20px 0;">(Implant, Telescopic crown, Veneered crown)</h3>
				</div>
				<table class="bracket" cellpadding="0" cellspacing="0">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="bracket_num">$diagnostics[18]</div></td>
						<td><div class="bracket_num">$diagnostics[17]</div></td>
						<td><div class="bracket_num">$diagnostics[16]</div></td>
						<td><div class="bracket_num">$diagnostics[15]</div></td>
						<td><div class="bracket_num">$diagnostics[14]</div></td>
						<td><div class="bracket_num">$diagnostics[13]</div></td>
						<td><div class="bracket_num">$diagnostics[12]</div></td>
						<td><div class="bracket_num">$diagnostics[11]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$diagnostics[21]</div></td>
						<td><div class="bracket_num">$diagnostics[22]</div></td>
						<td><div class="bracket_num">$diagnostics[23]</div></td>
						<td><div class="bracket_num">$diagnostics[24]</div></td>
						<td><div class="bracket_num">$diagnostics[25]</div></td>
						<td><div class="bracket_num">$diagnostics[26]</div></td>
						<td><div class="bracket_num">$diagnostics[27]</div></td>
						<td><div class="bracket_num">$diagnostics[28]</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="bracket_num">$diagnostics[48]</div></td>
						<td><div class="bracket_num">$diagnostics[47]</div></td>
						<td><div class="bracket_num">$diagnostics[46]</div></td>
						<td><div class="bracket_num">$diagnostics[45]</div></td>
						<td><div class="bracket_num">$diagnostics[44]</div></td>
						<td><div class="bracket_num">$diagnostics[43]</div></td>
						<td><div class="bracket_num">$diagnostics[42]</div></td>
						<td><div class="bracket_num">$diagnostics[41]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$diagnostics[31]</div></td>
						<td><div class="bracket_num">$diagnostics[32]</div></td>
						<td><div class="bracket_num">$diagnostics[33]</div></td>
						<td><div class="bracket_num">$diagnostics[34]</div></td>
						<td><div class="bracket_num">$diagnostics[35]</div></td>
						<td><div class="bracket_num">$diagnostics[36]</div></td>
						<td><div class="bracket_num">$diagnostics[37]</div></td>
						<td><div class="bracket_num">$diagnostics[38]</div></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%;" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription2</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:80px 40px 155px 40px;">
				<table style="width:100%" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3>3. Attachment</h3></td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">Select teeth</td>
					</tr>
				</table>
				<table class="bracket" cellpadding="0" cellspacing="0" style="margin-top:10px">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="$attachment[18]">18</div></td>
						<td><div class="$attachment[17]">17</div></td>
						<td><div class="$attachment[16]">16</div></td>
						<td><div class="$attachment[15]">15</div></td>
						<td><div class="$attachment[14]">14</div></td>
						<td><div class="$attachment[13]">13</div></td>
						<td><div class="$attachment[12]">12</div></td>
						<td><div class="$attachment[11]">11</div></td>
						<td align="center"></td>
						<td><div class="$attachment[21]">21</div></td>
						<td><div class="$attachment[22]">22</div></td>
						<td><div class="$attachment[23]">23</div></td>
						<td><div class="$attachment[24]">24</div></td>
						<td><div class="$attachment[25]">25</div></td>
						<td><div class="$attachment[26]">26</div></td>
						<td><div class="$attachment[27]">27</div></td>
						<td><div class="$attachment[28]">28</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="$attachment[48]">48</div></td>
						<td><div class="$attachment[47]">47</div></td>
						<td><div class="$attachment[46]">46</div></td>
						<td><div class="$attachment[45]">45</div></td>
						<td><div class="$attachment[44]">44</div></td>
						<td><div class="$attachment[43]">43</div></td>
						<td><div class="$attachment[42]">42</div></td>
						<td><div class="$attachment[41]">41</div></td>
						<td align="center"></td>
						<td><div class="$attachment[31]">31</div></td>
						<td><div class="$attachment[32]">32</div></td>
						<td><div class="$attachment[33]">33</div></td>
						<td><div class="$attachment[34]">34</div></td>
						<td><div class="$attachment[35]">35</div></td>
						<td><div class="$attachment[36]">36</div></td>
						<td><div class="$attachment[37]">37</div></td>
						<td><div class="$attachment[38]">38</div></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:70px" cellspacing="0" cellpadding="5px 0">
					<tr>
						<td colspan="6"><h3 style="margin:0">4. A.P relation</h3></td>
					</tr>
					<tr>
						<td style="width:5%"></td>
						<td style="width:25%" class="bold">Upper</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_upper</td>
						<td style="width:25%;" class="bold">Lower</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_lower</td>
					</tr>
					<tr>
						<td style="width:5%"></td>
						<td style="width:25%" class="bold">Canine Relationship</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_canine</td>
						<td style="width:25%" class="bold">Molar Relationship</td>
						<td style="width:5%">:</td>
						<td style="width:20%">$ap_relation_molar</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription3</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:100px 40px 135px 40px;">
				<table style="width:100%" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:35%"><h3 style="margin:0">5. Overjet & Overbite</h3></td>
						<td style="width:5%">:</td>
						<td style="width:15%" style="text-align:left">Overjet</td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">$overjet</td>
					</tr>
					<tr>
						<td style="width:35%"></td>
						<td style="width:5%"></td>
						<td style="width:15%" style="text-align:left">Overbite</td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">$overbite</td>
					</tr>
				</table>
				<table style="width:100%;margin-top:80px" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:35%"><h3 style="margin:0">6. Midline</h3></td>
						<td style="width:5%">:</td>
						<td style="width:25%" style="text-align:left">Maintain the midline</td>
						<td align="left" style="text-align:left">Upper</td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">Custom(1mm)</td>
					</tr>
					<tr>
						<td style="width:35%"></td>
						<td style="width:5%"></td>
						<td style="width:25%" style="text-align:left"></td>
						<td align="left" style="text-align:left">Upper</td>
						<td style="width:5%">:</td>
						<td align="left" style="text-align:left">Custom(1mm)</td>
					</tr>
				</table>
				<table style="width:100%;margin-top:80px" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:35%"><h3 style="margin:0">7. IPR</h3></td>
						<td style="width:5%">:</td>
						<td style="width:15%" style="text-align:left">$ipr_option</td>
						<td style="width:5%"></td>
						<td align="left" style="text-align:left"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%;0" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription4</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:100px 40px 185px 40px;">
				<table style="width:100%;" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:35%" Valign="top"><h3 style="margin:0">8. Occlusal opening device</h3></td>
						<td style="width:5%" Valign="top">:</td>
						<td style="" style="text-align:left" Valign="top">$occ_opening_device_option</td>
					</tr>
				</table>
				<table style="width:100%;margin-top:80px" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:35%"><h3 style="margin:0">9. Extraction</h3></td>
						<td style="width:5%">:</td>
						<td style="" style="text-align:left">$ext_option</td>
					</tr>
				</table>
				<table class="bracket" style="margin-top:20px" cellpadding="0" cellspacing="0">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="bracket_num">$extraction[18]</div></td>
						<td><div class="bracket_num">$extraction[17]</div></td>
						<td><div class="bracket_num">$extraction[16]</div></td>
						<td><div class="bracket_num">$extraction[15]</div></td>
						<td><div class="bracket_num">$extraction[14]</div></td>
						<td><div class="bracket_num">$extraction[13]</div></td>
						<td><div class="bracket_num">$extraction[12]</div></td>
						<td><div class="bracket_num">$extraction[11]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$extraction[21]</div></td>
						<td><div class="bracket_num">$extraction[22]</div></td>
						<td><div class="bracket_num">$extraction[23]</div></td>
						<td><div class="bracket_num">$extraction[24]</div></td>
						<td><div class="bracket_num">$extraction[25]</div></td>
						<td><div class="bracket_num">$extraction[26]</div></td>
						<td><div class="bracket_num">$extraction[27]</div></td>
						<td><div class="bracket_num">$extraction[28]</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="bracket_num">$extraction[48]</div></td>
						<td><div class="bracket_num">$extraction[47]</div></td>
						<td><div class="bracket_num">$extraction[46]</div></td>
						<td><div class="bracket_num">$extraction[45]</div></td>
						<td><div class="bracket_num">$extraction[44]</div></td>
						<td><div class="bracket_num">$extraction[43]</div></td>
						<td><div class="bracket_num">$extraction[42]</div></td>
						<td><div class="bracket_num">$extraction[41]</div></td>
						<td align="center"></td>
						<td><div class="bracket_num">$extraction[31]</div></td>
						<td><div class="bracket_num">$extraction[32]</div></td>
						<td><div class="bracket_num">$extraction[33]</div></td>
						<td><div class="bracket_num">$extraction[34]</div></td>
						<td><div class="bracket_num">$extraction[35]</div></td>
						<td><div class="bracket_num">$extraction[36]</div></td>
						<td><div class="bracket_num">$extraction[37]</div></td>
						<td><div class="bracket_num">$extraction[38]</div></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="page_break">
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription5</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:80px 40px;">
				<table style="width:100%" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3 style="margin:0">10. Eruption compensation</h3></td>
					</tr>
					<tr>
						<td style="width:50%;padding-left:40px">Eruption compensation</td>
						<td style="width:5%">:</td>
						<td style="" style="text-align:left">$eruption_incisor_option</td>
					</tr>
				</table>
				<table class="bracket" style="width:40%;padding-left:340px;margin-top:10px" cellpadding="0" cellspacing="0">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="$compensation[15]">15</div></td>
						<td><div class="$compensation[14]">14</div></td>
						<td><div class="$compensation[13]">13</div></td>
						<td align="center"></td>
						<td><div class="$compensation[23]">23</div></td>
						<td><div class="$compensation[24]">24</div></td>
						<td><div class="$compensation[25]">25</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="$compensation[45]">45</div></td>
						<td><div class="$compensation[44]">44</div></td>
						<td><div class="$compensation[43]">43</div></td>
						<td align="center"></td>
						<td><div class="$compensation[33]">33</div></td>
						<td><div class="$compensation[34]">34</div></td>
						<td><div class="$compensation[35]">35</div></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:40px" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:50%;padding-left:40px">Provide space for eruption of 2nd</td>
						<td style="width:5%">:</td>
						<td style="" style="text-align:left">$eruption_molar_option</td>
					</tr>
				</table>
				<table class="bracket" style="width:40%;padding-left:340px;margin-top:10px" cellpadding="0" cellspacing="0">
					<tr class="top">
						<td rowspan="2" style="border:none;padding:0 5px 0 0"><div style="background-color:#dadada;padding:35px 8px">R</div></td>
						<td><div class="$molar[17]">17</div></td>
						<td align="center"></td>
						<td><div class="$molar[27]">27</div></td>
						<td rowspan="2" style="border:none;padding:0 0 0 5px"><div style="background-color:#dadada;padding:35px 8px">L</div></td>
					</tr>
					<tr class="bottom">
						<td><div class="$molar[47]">47</div></td>
						<td align="center"></td>
						<td><div class="$molar[37]">37</div></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:10px" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:43%;padding-left:40px"></td>
						<td style="width:25%" style="text-align:left">Step to start provide space<br>for eruption of 2nd molars</td>
						<td style="width:10%" style="text-align:left"><input type="text" value="$eruption_molar_value" style="height:24px;width:50px;vertical-align:middle;text-align:center;border-radius:5px"></td>
					</tr>
				</table>
			</div>
		</div>
		<div>
			<table style="width:100%" cellpadding="10px" cellspacing="0">
				<tr>
					<td style="background-color:#000;color:#fff;font-size:14" class="bold">Prescription5</td>
				</tr>
			</table>
			<div style="border:1px solid #707070;width:100%;padding:10px 40px;">
				<table style="width:100%;" cellpadding="5px 0" cellspacing="0">
					<tr>
						<td style="width:30%"><h3 style="margin:0">11. Additional request</h3></td>
					</tr>
					<tr>
						<td style=""><textarea wrap="virtual" style="width:100%;height:470px;padding:10px;border-radius:5px">$special_instruction</textarea></td>
					</tr>
				</table>
			</div>
		</div>
		$text_page_add
    </main>
	
  </body>
</html>
EOF;
}
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$font = $dompdf->getFontMetrics()->get_font("Verdana", "");
// Print page numbering string at pos (500,118) on page, using $font in size 10
$dompdf->getCanvas()->page_text(495, 775, "Page {PAGE_NUM} / {PAGE_COUNT}", $font, 11, array(0,0,0));
// $updirPath = "../data/".$_SESSION['member_code']."/".$_SESSION['patient_key']."/".$_SESSION['service_key']."/".$_SESSION['service_his_key']."/";
// $chOutFile = "DentOnePrint_".$_SESSION['service_key'].".pdf";

//         if(!is_dir($updirPath)){
//             mkdir($updirPath, 0777, true);
//           }

// $f = fopen($updirPath.$chOutFile,'w+'); //data 

//      fwrite($f, $dompdf->output( array("compress" => 0)));

//      fclose($f);


if ($_POST['type'] == "save") {

$updirPath = "../data/".$_SESSION['member_code']."/".$_SESSION['patient_key']."/".$_SESSION['service_key']."/".$_SESSION['service_his_key']."/Report/";
$chOutFile = "DentOnePrint_".$_SESSION['service_key'].".pdf";

        if(!is_dir($updirPath)){
            mkdir($updirPath, 0777, true);
          }

$f = fopen($updirPath.$chOutFile,'w+'); //data 

     fwrite($f, $dompdf->output( array("compress" => 0)));

     fclose($f);
}else{


$dompdf->stream("codexworld",array("Attachment"=>0));


}

?>
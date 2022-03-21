<?

/******************************
 서비스 정보 데이터 등록 페이지
******************************/
session_start();

include '../../../models/modelsVariable_global.php';
include '../../../models/service_decode.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/models/phpMailerAPI/mail_service.php';

$prevPage = $_SERVER["HTTP_REFERER"];

 $patient_st = $_SESSION['patient_st'];
 $patient_st = $patient_st ? $patient_st : 1;
 
//ini_set("display_errors", "1");
/******************************
	페이지 별 데이터 처리
******************************/
// 01 Treatment option1 
if(strpos($prevPage,'01_treatment_option1.php') !== false) {
	if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 1){$_SESSION['progress_num']=1;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 1;

   $_SESSION['treatment_option1'] = $_POST['treatment_option1'];


###################### JSON update #############################
if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
service_json($_SESSION['patient_key'], $_SESSION['service_key']);

$treatment_option1 = $_SESSION['treatment_option1'];

$return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
     $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
}
########################## end ################################

// 02 Treatment_option2
}else if(strpos($prevPage,'02_treatment_option2.php') !== false) {
	if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 2){$_SESSION['progress_num']=2;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 2;

   $_SESSION['treatment_option2'] = $_POST['treatment_option2'];

###################### JSON update #############################
if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
ini_set("display_errors", "1");
service_json($_SESSION['patient_key'], $_SESSION['service_key']);

$treatment_option2 = $_SESSION['treatment_option2'];

$return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);

     $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
}
########################## end ################################

// 03 환자 정보 입력
}else if(strpos($prevPage,'03_patientinfo.php') !== false){

	if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 3){$_SESSION['progress_num']=3;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 3;
if($_POST['patient_id'] != null) $_SESSION['patient_id'] = $_POST['patient_id'];
if($_POST['first_name'] != null) $_SESSION['first_name'] = $_POST['first_name'];
if($_POST['last_name'] != null) $_SESSION['last_name'] = $_POST['last_name'];
if($_POST['patient_date_yy'] != null) $_SESSION['patient_date_yy'] = $_POST['patient_date_yy'];
if($_POST['patient_date_mm'] != null) $_SESSION['patient_date_mm'] = $_POST['patient_date_mm'];
if($_POST['patient_date_dd'] != null) $_SESSION['patient_date_dd'] = $_POST['patient_date_dd'];
if($_POST['patient_age'] != null) $_SESSION['patient_age'] = $_POST['patient_age'];
if($_POST['patient_sex'] != null) $_SESSION['patient_sex'] = $_POST['patient_sex'];
if($_POST['patient_ethinicity'] != null) $_SESSION['patient_ethinicity'] = $_POST['patient_ethinicity'];
if($_POST['shipping_address'] != null) $_SESSION['shipping_address'] =  address_r($_POST['shipping_address'])[0];
if($_POST['billing_address'] != null) $_SESSION['billing_address'] = address_r($_POST['billing_address'])[0];

if($_POST['dental_lab'] != null){ $_SESSION['dental_lab'] = $_POST['dental_lab'];
$labcode = explode("," ,$_SESSION['dental_lab'],2);
$_SESSION['lab_code'] = $labcode[0];
$return_array = labaddress_r($labcode[0]);
$_SESSION['dental_lab_addr']  = $return_array[1];
$_SESSION['dental_lab_zipcode'] = $return_array[2];
}

if ($_SESSION['patient_ethinicity'] == "asian") {
    $ethinicity_code = 1;
}else if($_SESSION['patient_ethinicity'] == "caucasian"){
    $ethinicity_code = 2;
}else if($_SESSION['patient_ethinicity'] == "african"){
    $ethinicity_code = 3;
}

// 처음 등록시
if(!isset($_SESSION['patient_key'])){
    $_SESSION['patient_key'] = patient_cu($_SESSION['patient_id'], $_SESSION['first_name'].",".$_SESSION['last_name'],
		$_SESSION['patient_sex'],$_SESSION['patient_date_yy']."-".$_SESSION['patient_date_mm']."-".$_SESSION['patient_date_dd']  ,1,0, (int)$_SESSION['member_code']);
    //환자정보고유키, 서비스타입고유키, 상태고유키, 자동저장 페이지번호, 택배송장번호, 서비스정보(문진표)
    $_SESSION['service_key'] =  service_c((int)$_SESSION['patient_key'],2,1, 2,(int)$labcode[0], null, null,null);
}else{
    // 수정 시
    $_SESSION['patient_key'] = patient_cu($_SESSION['patient_id'], $_SESSION['first_name'].",".$_SESSION['last_name'], $_SESSION['patient_sex'],$_SESSION['patient_date_yy']."-".$_SESSION['patient_date_mm']."-".$_SESSION['patient_date_dd'] ,1 ,(int)$_SESSION['patient_key'],(int)$_SESSION['member_code']);
}



			###################### JSON update #############################
			if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
		//	ini_set("display_errors", "1");
			service_json($_SESSION['patient_key'], $_SESSION['service_key']);
			
			$treatment_option1 = $_SESSION['treatment_option1'];
			$treatment_option2 = $_SESSION['treatment_option2'];
             $shipping_address = $_SESSION['shipping_address'];
             $billing_address = $_SESSION['billing_address'];

			$return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);

				 $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
			}
			########################## end ################################



  //$return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
    // $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
	// print_r($return_array);
	 //echo $_SESSION['service_key'];


    // @LUCAS 1.5차 변경
    // 04 Classification
} else if (strpos($prevPage, '04_classification.php') !== false) {
    if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 4){$_SESSION['progress_num']=4;}}else if(!isset($_SESSION['progress_num'])){  $_SESSION['progress_num'] = 4;}

    if ($_POST['crowding'] != null) $_SESSION['crowding'] = $_POST['crowding']; else $_SESSION['crowding'] = "";
    if ($_POST['diastemata'] != null) $_SESSION['diastemata'] = $_POST['diastemata']; else $_SESSION['diastemata'] = "";

    if (isset($_POST['class'])) {
        $class = $_POST['class'];

        $_SESSION['class1'] = "";
        $_SESSION['class2_div1'] = "";
        $_SESSION['class2_div2'] = "";
        $_SESSION['class3'] = "";
        $_SESSION['class_na'] = "";

        if (!empty($class)) {
            $_SESSION[$class] = "on";
        }
    }

//    if ($_POST['class1'] != null) $_SESSION['class1'] = $_POST['class1']; else $_SESSION['class1'] = "";
//    if ($_POST['class2_div1'] != null) $_SESSION['class2_div1'] = $_POST['class2_div1']; else $_SESSION['class2_div1'] = "";
//    if ($_POST['class2_div2'] != null) $_SESSION['class2_div2'] = $_POST['class2_div2']; else $_SESSION['class2_div2'] = "";
//    if ($_POST['class3'] != null) $_SESSION['class3'] = $_POST['class3']; else $_SESSION['class3'] = "";

    if ($_POST['asymmetric'] != null) $_SESSION['asymmetric'] = $_POST['asymmetric']; else $_SESSION['asymmetric'] = "";
    if ($_POST['vertical_open_bite'] != null) $_SESSION['vertical_open_bite'] = $_POST['vertical_open_bite']; else $_SESSION['vertical_open_bite'] = "";
    if ($_POST['horizontal_open_bite'] != null) $_SESSION['horizontal_open_bite'] = $_POST['horizontal_open_bite']; else $_SESSION['horizontal_open_bite'] = "";

    if (isset($_POST['biteType'])) {
        $biteType = $_POST['biteType'];

        $_SESSION['deep_bite'] = "";
        $_SESSION['anterior_occlusion'] = "";
        $_SESSION['posterior_occlusion'] = "";
        $_SESSION['bite_type_na'] = "";

        if (!empty($biteType)) {
            $_SESSION[$biteType] = "on";
        }
    }

//    if ($_POST['deep_bite'] != null) $_SESSION['deep_bite'] = $_POST['deep_bite']; else $_SESSION['deep_bite'] = "";
//    if ($_POST['anterior_occlusion'] != null) $_SESSION['anterior_occlusion'] = $_POST['anterior_occlusion']; else $_SESSION['anterior_occlusion'] = "";
//    if ($_POST['posterior_occlusion'] != null) $_SESSION['posterior_occlusion'] = $_POST['posterior_occlusion']; else $_SESSION['posterior_occlusion'] = "";

    if ($_POST['narrow_arch'] != null) $_SESSION['narrow_arch'] = $_POST['narrow_arch']; else $_SESSION['narrow_arch'] = "";
    if ($_POST['anterior_teeth'] != null) $_SESSION['anterior_teeth'] = $_POST['anterior_teeth']; else $_SESSION['anterior_teeth'] = "";
    if ($_POST['smile_line'] != null) $_SESSION['smile_line'] = $_POST['smile_line']; else $_SESSION['smile_line'] = "";

    if ($_POST['inclined_occlusal_plane'] != null) $_SESSION['inclined_occlusal_plane'] = $_POST['inclined_occlusal_plane']; else $_SESSION['inclined_occlusal_plane'] = "";
    if ($_POST['abnormal_teeth_shape'] != null) $_SESSION['abnormal_teeth_shape'] = $_POST['abnormal_teeth_shape']; else $_SESSION['abnormal_teeth_shape'] = "";
    if ($_POST['etc'] != null) $_SESSION['etc'] = $_POST['etc']; else $_SESSION['etc'] = "";
    if ($_POST['etc_value'] != null) $_SESSION['etc_value'] = $_POST['etc_value']; else $_SESSION['etc_value'] = "";
    if ($_POST['precaution'] != null) $_SESSION['precaution'] = $_POST['precaution']; else $_SESSION['precaution'] = "";


    ###################### JSON update #############################
    if (isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1) {
        service_json($_SESSION['patient_key'], $_SESSION['service_key']);

        $classification = array(
            'crowding' => $_SESSION['crowding'],
            'diastemata' => $_SESSION['diastemata'],
            'class1' => $_SESSION['class1'],
            'class2_div1' => $_SESSION['class2_div1'],
            'class2_div2' => $_SESSION['class2_div2'],

            'class3' => $_SESSION['class3'],
            'asymmetric' => $_SESSION['asymmetric'],
            'vertical_open_bite' => $_SESSION['vertical_open_bite'],
            'horizontal_open_bite' => $_SESSION['horizontal_open_bite'],
            'deep_bite' => $_SESSION['deep_bite'],

            'anterior_occlusion' => $_SESSION['anterior_occlusion'],
            'posterior_occlusion' => $_SESSION['posterior_occlusion'],
            'narrow_arch' => $_SESSION['narrow_arch'],
            'anterior_teeth' => $_SESSION['anterior_teeth'],
            'smile_line' => $_SESSION['smile_line'],

            'inclined_occlusal_plane' => $_SESSION['inclined_occlusal_plane'],
            'abnormal_teeth_shape' => $_SESSION['abnormal_teeth_shape'],
            'etc' => $_SESSION['etc'],
            'etc_value' => $_SESSION['etc_value'],
            'precaution' => $_SESSION['precaution'],

        );
        $_SESSION['classification'] = $classification;


        $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'], (int)$_SESSION['member_code'], 2, $_SESSION['progress_num'], null, (int)$_SESSION['lab_code'], $patient_st, null), true);
        $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
    }
    ########################## end ################################

    // 05 model type
    }else if(strpos($prevPage,'05_modeltype.php') !== false){ 
    if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 5){$_SESSION['progress_num']=5;}}else if(!isset($_SESSION['progress_num'])){  $_SESSION['progress_num'] = 5;}
    if($_POST['model_send'] !== null){ $_SESSION['model_send'] = $_POST['model_send'];}




     if($_SESSION['model_send'] == "impression"){
         $_SESSION['model_type'] = "Impression";
     }else{
         $_SESSION['model_type'] = "ScanFile";
        $_SESSION['model_mx'] = $_SESSION['maxilla_image'];	
        $_SESSION['model_md']= $_SESSION['mandible_image'];
     }
     
   

  ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
		service_json($_SESSION['patient_key'], $_SESSION['service_key']);

     $model_type = $_SESSION['model_type'];
        $model_mx =  $_SESSION['maxilla_image'];	
        $model_md =  $_SESSION['mandible_image'];


    $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
     $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
    }
  ########################## end ################################
    // 06 사진등록 페이지 
    }else if(strpos($prevPage,'06_photo.php') !== false){ 
        if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 6){$_SESSION['progress_num']=6;}}else if(!isset($_SESSION['progress_num'])){  $_SESSION['progress_num'] = 6;}
    
    ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
		service_json($_SESSION['patient_key'], $_SESSION['service_key']);

    $lateral_photo = $_SESSION['lateral_photo'];
    $front_photo = $_SESSION['front_photo'];
    $smile_photo = $_SESSION['smile_photo'];
    $intraoral_upper = $_SESSION['intraoral_upper'];
    $intraoral_lower = $_SESSION['intraoral_lower'];
    $intraoral_right = $_SESSION['intraoral_right'];
    $intraoral_fornt = $_SESSION['intraoral_fornt'];
    $intraoral_left = $_SESSION['intraoral_left'];


    $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
    $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
  }
  ########################## end ################################
    // 07 방사선 사진등록 페이지 
    }else if(strpos($prevPage,'07_radiograph.php') !== false){ 
        if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 7){$_SESSION['progress_num']=7;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 7;

      ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
		service_json($_SESSION['patient_key'], $_SESSION['service_key']);

        $lateral_xray = $_SESSION['lateral_xray'];
        $panorama = $_SESSION['panorama'];

        $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
        $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
         }
  ########################## end ################################

// 08 셋업 1 페이지
    }else if(strpos($prevPage,'08_setup1.php') !== false){ 
	if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 8){$_SESSION['progress_num']=8;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 8;

				//삭제
				if(isset($_POST['brk_info_delete'])){    


						unset($_SESSION['attchment_option']); 
						unset($_SESSION['attchment_select_number']);
						unset($_SESSION['ap_relation_upper']);
						unset($_SESSION['ap_relation_lower']);
						unset($_SESSION['ap_relation_canine']);
						unset($_SESSION['ap_relation_molar']);
						unset($_SESSION['overbite']);
						unset($_SESSION['overbite_value']);
						unset($_SESSION['overjet']);
						unset($_SESSION['overjet_value']);
						unset($_SESSION['midline']);
						unset($_SESSION['midline_upper_right']);
						unset($_SESSION['midline_upper_right_value']);
						unset($_SESSION['midline_lower_right']);
						unset($_SESSION['midline_lower_right_value']);
						unset($_SESSION['midline_upper_left']);
						unset($_SESSION['midline_upper_left_value']);
						unset($_SESSION['midline_lower_left']);
						unset($_SESSION['midline_lower_left_value']);
						unset($_SESSION['ipr_option']);

						unset($_SESSION['extraction']);
						unset($_SESSION['e_select_number']);
						unset($_SESSION['occ_opening_device_option']);
						unset($_SESSION['occ_opening_device_type']);
						unset($_SESSION['occ_opening_device_central_incisor']);
						unset($_SESSION['occ_opening_device_lateral_incisor']);

						unset($_SESSION['eruption_incisor_option']);
						unset($_SESSION['eruption_molar_option']);
						unset($_SESSION['incisor_select_number']);
						unset($_SESSION['molar_select_number']);
						unset($_SESSION['eruption_molar_value']);
						unset($_SESSION['special_instruction']);


									###################### JSON update #############################
									if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
										service_json($_SESSION['patient_key'], $_SESSION['service_key']);
											

											$arch = '';
											$tray_section_u = '';
											$tray_section_l = '';


											$attchment_option = '';
											$attchment_list = array();

											$ap_relation_upper = '';
											$ap_relation_lower = '';
											$ap_relation_canine = '';
											$ap_relation_molar = '';


											$midline = '';
											$midline_upper_right = '';
											$midline_upper_right_value = '';

											$midline_lower_right = '';
											$midline_lower_right_value = '';
											$midline_upper_left = '';
											$midline_upper_left_value = '';
											$midline_lower_left = '';
											$midline_lower_left_value = '';

											$occ_opening_device_option = '';
											$occ_opening_device_type = '';
											$occ_opening_device_central_incisor = '';
											$occ_opening_device_lateral_incisor = '';

											$eruption_incisor_option = '';
											$eruption_incisor_list = array();
											$eruption_molar_list = array();
											$eruption_molar_option = '';
											
											$eruption_molar_value = '';
											$special_instruction = '';
											
											$ext_option = '';
											$ext_toooth_list = array();
											$diagnostics = array();
											$overbite = '';
											$overbite_value = '';
											$overjet = '';
											$overjet_value = '';

											$ipr_option = '';



										$return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
										$_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
									 }
									########################## end ################################



						$_SESSION['progress_num'] = 8;

					echo "true";
					exit;
			}


       $_SESSION['arch'] = $_POST['arch'];
       $_SESSION['tray_section_u'] = $_POST['tray_section_u'];
       $_SESSION['tray_section_l'] = $_POST['tray_section_l'];
        if($_POST['diag_select_number'] != null)$_SESSION['diag_select_number'] = $_POST['diag_select_number'];



     $tp_array0 = array();
        $tp_array1 = array();
        $tp_array2 = array();
        $tp_array3 = array();
        $tp_array4 = array();

        for ($i=0; $i < count($_SESSION['diag_select_number']); $i++) { 
            $number_values = explode( ',', $_SESSION['diag_select_number'][$i], 2);
            if($number_values[1] == "crown"){
                array_push($tp_array0, $number_values[0]);
            }else if($number_values[1] == "implant"){
                array_push($tp_array1, $number_values[0]);
            }else if($number_values[1] == "telescopic_crown"){
                array_push($tp_array2, $number_values[0]);
            }else if($number_values[1] == "veneered_crown"){
                array_push($tp_array3, $number_values[0]);
            }else if($number_values[1] == "check"){
                array_push($tp_array4, $number_values[0]);
            }

        }
        if (count($tp_array0) > 0) {
            array_push($diagnostics,
				['tooth_number' => implode(",", $tp_array0)
				, 'type' => 'Crown']);

        }
        if (count($tp_array1) > 0) {
        array_push($diagnostics,['tooth_number' => implode(",", $tp_array1)
                                    , 'type' => 'Implant']);
						//print_r($tp_array1);

        }
        if (count($tp_array2) > 0) {
        array_push($diagnostics,['tooth_number' => implode(",", $tp_array2)
                                    , 'type' => 'Telesopic crown']);
        }
        if (count($tp_array3) > 0) {
        array_push($diagnostics,['tooth_number' => implode(",", $tp_array3)
                                    , 'type' => 'Veneered crown']);
        }
        if (count($tp_array4) > 0) {
            array_push($diagnostics,['tooth_number' => implode(",", $tp_array4)
                                        , 'type' => 'Check']);
            }
	
        $_SESSION['diagnostics'] = $diagnostics;



      ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
        service_json($_SESSION['patient_key'], $_SESSION['service_key']);
   
		$diagnostics = $_SESSION['diagnostics'];
         $arch= $_SESSION['arch'];
       $tray_section_u = $_SESSION['tray_section_u'];
       $tray_section_l= $_SESSION['tray_section_l'];
//echo  gettype($diagnostics);
	//	print_r($diagnostics);

		//exit;
        $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
        $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];


                 }
  ########################## end ################################

 // 08 처방전[셋업2] 페이지 
}else if(strpos($prevPage,'09_setup2.php') !== false){ 
	if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 9){$_SESSION['progress_num']=9;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 9;

       $_SESSION['attchment_option'] = $_POST['attchment_option'];
       $_SESSION['attchment_select_number'] =  $_POST['attchment_select_number'];
       $_SESSION['ap_relation_upper'] = $_POST['ap_relation_upper'];
       $_SESSION['ap_relation_lower'] = $_POST['ap_relation_lower'];
       $_SESSION['ap_relation_canine'] = $_POST['ap_relation_canine'];
       $_SESSION['ap_relation_molar'] = $_POST['ap_relation_molar'];

//print_r($_SESSION['attchment_select_number']);
//exit;
         ###################### JSON update #############################
        if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
        service_json($_SESSION['patient_key'], $_SESSION['service_key']);

        $attchment_option = $_SESSION['attchment_option'];
        $attchment_list = array($_SESSION['attchment_select_number']);
        $ap_relation_upper = $_SESSION['ap_relation_upper'];
        $ap_relation_lower = $_SESSION['ap_relation_lower'];
        $ap_relation_canine = $_SESSION['ap_relation_canine'];
        $ap_relation_molar = $_SESSION['ap_relation_molar'];


        $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
        $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
                        }
        ########################## end ################################

 // 10 처방전[셋업3] 페이지 
}else if(strpos($prevPage,'10_setup3.php') !== false){ 
    if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 10){$_SESSION['progress_num']=10;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 10;
	if( strpos($_POST['targetUrl'],'13_summary.php') !== false){
		if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 11){$_SESSION['progress_num']=11;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 11;}
  $_SESSION['extraction'] = $_POST['extraction'];
	    $_SESSION['e_select_number'] = $_POST['e_select_number'];   

        $_SESSION['occ_opening_device_option'] = $_POST['occ_opening_device_option'];   
        $_SESSION['occ_opening_device_type'] = $_POST['occ_opening_device_type'];   
        
        $_SESSION['occ_opening_device_central_incisor'] = $_POST['occ_opening_device_central_incisor'];
		 $_SESSION['occ_opening_device_lateral_incisor'] = $_POST['occ_opening_device_lateral_incisor'];
		  $_SESSION['special_instruction'] = $_POST['special_instruction'];

		$tmp_list = [];

              array_push($tmp_list,['tooth_number' => implode(",", $_SESSION['e_select_number'])]);

        

  ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
        service_json($_SESSION['patient_key'], $_SESSION['service_key']);

        if ($_SESSION['extraction'] == "tooth_e") {
            $ext_option = "tooth_extraction";
			$ext_toooth_list = $tmp_list;
        }else {
            $ext_option = "not_tooth_extraction";
        }

        $occ_opening_device_option = $_SESSION['occ_opening_device_option'];
        $occ_opening_device_type = $_SESSION['occ_opening_device_type'];
            $occ_opening_device_central_incisor =$_SESSION['occ_opening_device_central_incisor'] ;
            $occ_opening_device_lateral_incisor = $_SESSION['occ_opening_device_lateral_incisor'];
			$special_instruction = $_SESSION['special_instruction'];


        $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
        $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];

             }
        ########################## end ################################
  
  /*      
        $_SESSION['overbite'] = $_POST['overbite'];
        $_SESSION['overbite_value'] = $_POST['overbite_value'];
        $_SESSION['overjet'] = $_POST['overjet'];
        $_SESSION['overjet_value'] = $_POST['overjet_value'];

        $_SESSION['midline'] = $_POST['midline'];

		$_SESSION['midline_upper'] = $_POST['midline_upper'];
		$_SESSION['midline_lower'] = $_POST['midline_lower'];
		
		if($_SESSION['midline_upper'] == "right"){
		 $_SESSION['midline_upper_right'] = "on";
         $_SESSION['midline_upper_right_value'] = $_POST['midline_upper_right_value'];
		}else if($_SESSION['midline_upper'] == "left"){
		 $_SESSION['midline_upper_left'] = "on";
         $_SESSION['midline_upper_left_value'] = $_POST['midline_upper_left_value'];
		}

		if($_SESSION['midline_lower'] == "right"){
		$_SESSION['midline_lower_right'] ="on";
		$_SESSION['midline_lower_right_value'] = $_POST['midline_lower_right_value'];
		}else if($_SESSION['midline_lower'] == "left"){
		$_SESSION['midline_lower_left'] = "on";
		$_SESSION['midline_lower_left_value'] = $_POST['midline_lower_left_value'];
		}

        $_SESSION['ipr_option'] = $_POST['ipr_option'];
        
    
	   ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
        service_json($_SESSION['patient_key'], $_SESSION['service_key']);

        $overbite = $_SESSION['overbite'];
        $overbite_value = $_SESSION['overbite_value'];
        $overjet = $_SESSION['overjet'];
        $overjet_value = $_SESSION['overjet_value'];

         $midline = $_SESSION['midline'];

        $midline_upper_right = $_SESSION['midline_upper_right'];
        $midline_upper_right_value = $_SESSION['midline_upper_right_value'];
        $midline_lower_right = $_SESSION['midline_lower_right'];
        $midline_lower_right_value = $_SESSION['midline_lower_right_value'];

        $midline_upper_left = $_SESSION['midline_upper_left'];
        $midline_upper_left_value = $_SESSION['midline_upper_left_value'];
        $midline_lower_left = $_SESSION['midline_lower_left'];
        $midline_lower_left_value = $_SESSION['midline_lower_left_value'];
        $ipr_option = $_SESSION['ipr_option'];

    $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
     $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
                            }
        ########################## end ################################
*/
// 11 처방전[셋업4] 페이지
}else if(strpos($prevPage,'11_setup4.php') !== false){ 
	if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 11){$_SESSION['progress_num']=11;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 11;
		$_SESSION['extraction'] = $_POST['extraction'];
	    $_SESSION['e_select_number'] = $_POST['e_select_number'];   

        $_SESSION['occ_opening_device_option'] = $_POST['occ_opening_device_option'];   
        $_SESSION['occ_opening_device_type'] = $_POST['occ_opening_device_type'];   
        
        $_SESSION['occ_opening_device_central_incisor'] = $_POST['occ_opening_device_central_incisor'];
		 $_SESSION['occ_opening_device_lateral_incisor'] = $_POST['occ_opening_device_lateral_incisor'];

		$tmp_list = [];

              array_push($tmp_list,['tooth_number' => implode(",", $_SESSION['e_select_number'])]);

        

  ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
        service_json($_SESSION['patient_key'], $_SESSION['service_key']);

        if ($_SESSION['extraction'] == "tooth_e") {
            $ext_option = "tooth_extraction";
			$ext_toooth_list = $tmp_list;
        }else {
            $ext_option = "not_tooth_extraction";
        }

        $occ_opening_device_option = $_SESSION['occ_opening_device_option'];
        $occ_opening_device_type = $_SESSION['occ_opening_device_type'];
            $occ_opening_device_central_incisor =$_SESSION['occ_opening_device_central_incisor'] ;
            $occ_opening_device_lateral_incisor = $_SESSION['occ_opening_device_lateral_incisor'];


        $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
        $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];

             }
        ########################## end ################################

 // 12 처방전[셋업5] 페이지 
}else if(strpos($prevPage,'12_setup5.php') !== false){ 
	if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 12){$_SESSION['progress_num']=12;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 12;
	if( strpos($_POST['targetUrl'],'13_summary.php') !== false){
		if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 13){$_SESSION['progress_num']=13;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 13;}
    $_SESSION['eruption_incisor_option'] = $_POST['eruption_incisor_option'];
    $_SESSION['eruption_molar_option'] = $_POST['eruption_molar_option'];

    $_SESSION['incisor_select_number'] = $_POST['incisor_select_number'];
    $_SESSION['molar_select_number'] = $_POST['molar_select_number'];
    

    $_SESSION['eruption_molar_value'] = $_POST['eruption_molar_value'];
        $_SESSION['special_instruction'] = $_POST['special_instruction'];
    


    ###################### JSON update #############################
    if(isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1){
        service_json($_SESSION['patient_key'], $_SESSION['service_key']);

        $eruption_incisor_option = $_SESSION['eruption_incisor_option'];
        $eruption_molar_option = $_SESSION['eruption_molar_option'];
        $special_instruction = $_SESSION['special_instruction'];
        $eruption_molar_value = $_SESSION['eruption_molar_value'];

        $eruption_incisor_list = array($_SESSION['incisor_select_number']);
        $eruption_molar_list = array($_SESSION['molar_select_number']);

     $return_array = json_decode(serviceinfo_encode((int)$_SESSION['service_key'],(int) $_SESSION['member_code'], 2, $_SESSION['progress_num'], null,(int)$_SESSION['lab_code'], $patient_st,null),true);
     $_SESSION['service_his_key'] = $return_array['returnKey'][0]['servicehistoryKey'];
     }
        ########################## end ################################


    // @LUCAS 1.5차 변경
    // 13 결과 페이지
} else if (strpos($prevPage, '13_summary.php') !== false) {
    $_SESSION['progress_num'] = 11; // FIXME Adult 13 과 다른 번호다!!!!
    $_SESSION['update_data'] = true;

    if (isset($_POST['input'])) {
        ###################### JSON update #############################
        if (isset($_SESSION['patient_key']) && $_SESSION['service_key'] != -1) {
            service_json($_SESSION['patient_key'], $_SESSION['service_key']);

            if ($patient_st != 1) {
                $st_value = 21;
            } else {
                $st_value = 20;
            }

            $patientServiceKey = (int)$_SESSION['service_key'];

            $return_json = serviceinfo_encode($patientServiceKey, (int)$_SESSION['member_code'], 2, (int)$_SESSION['progress_num'], null, (int)$_SESSION['lab_code'], $st_value, null);
            // $r = json_decode($return_json);
            // echo print_r($r);
            // echo $return_json;
            // print_r($return_json);

            if (true) {
                // @LUCAS 1.5차 이메일 발송
                $labCode = (int)$_SESSION['lab_code'];
                $patientId = $_SESSION['patient_key'];
                $labInfo = labinfo_r($labCode)[0];

                if ($labInfo['email_notification'] !== "On" || !$labInfo['is_submit_checked']) {
                    exit;
                }

                $patient_info_array = patient_r($patientId); // DB의 patiend_id of tb_patient

                $labName = $labInfo['name'];
                $receiverName = $labInfo['name'];
                $receiverEmail = $labInfo['email'];

                $clinicName = $patient_info_array[8];
                $patientFirstName = explode(",", $patient_info_array[1])[0];
                $patientName = $patientFirstName;
                $submissionDateTime = date("Y-m-d H:i:s", time());

                sendEmailWhenOrderSubmitted(
                    $receiverName,
                    $receiverEmail,
                    $labName,
                    $clinicName,
                    $patientName,
                    $submissionDateTime,
                    $patientId,
                    $patientServiceKey
                );
            }

            exit;
        }
        ########################## end ################################
    }
}



/*
if($_POST['userName'] != null) $_SESSION['userName'] = $_POST['userName'];
*/

//print_r($return_array);
//exit;
if($_POST['targetUrl'] != '01_treatment_option1.php' ){
echo "<script>location.href='".$_POST['targetUrl']."'</script>";

}else{
echo "<script>location.href='../".$_POST['targetUrl']."'</script>";
}
// $_POST['targetUrl']
// echo "true";

//등록된 변수 해제
//unset($_SESSION['value']);







function brk_color_list($table_number){
    
    while($table_number>10){
        $table_number -= 10;
    }
$color_key ="";
switch ($table_number) {
case 1:
    $color_key = "72,142,204";
    break;

case 2:
    $color_key = "225,86,70";
    break;

case 3:
    $color_key = "233,210,0";
    break;

case 4:
    $color_key = "0,149,20";
    break;

case 5:
    $color_key = "130,45,241";
    break;

case 6:
    $color_key = "255,162,0";
    break;

case 7:
    $color_key = "28,80,255";
    break;

case 8:
    $color_key = "255,114,255";
    break;

case 9:
    $color_key = "0,187,130";
    break;

case 10:
    $color_key = "152,101,0";
    break;
}


return $color_key;

}

?>
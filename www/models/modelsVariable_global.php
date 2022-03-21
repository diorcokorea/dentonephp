<?php
    #region Json 생성 변수



/*
{
	"treatment_option1" : "",
	"treatment_option2" : "",
	"classification" : {
		"crowding" : "",
		"diastemata" : "",
		"class1" : "",
		"class2_div1" : "",
		"class2_div2" : "",
		"class3" : "",
		"asymmetric" : "",
		"vertical_open_bite" : "",
		"horizontal_open_bite" : "",
		"deep_bite" : "",
		"anterior_crossbite" : "",
		"posterior_crossbite" : "",
		"narrow_arch" : "",
		"anterior_protrude" : "",
		"smile_line" : "",
		"right_incline_occ" : "",
		"left_incline_occ" : "",
		"abnormal_forms_of_teeth" : "",
		"etc" : "",
		"precaution" : ""
	},
	"model_type" : "",
	"model_mx" : "",
	"model_md" : "",

	"lateral_photo" : "",
	"front_photo" : "",
	"smile_photo" : "",
	"intraoral_upper" : "",
	"intraoral_lower" : "",
	"intraoral_right" : "",
	"intraoral_fornt" : "",
	"intraoral_left" : "",
	"lateral_xray" : "",
	"panorama" : "",

	"arch" : "",
	"tray_section_u" : "",
	"tray_section_l" : "",
	"diagnostics" : [{
		"tooth_number" :"",
		"type" : ""
	}],
	"attchment_option" : "",
	"attchment_list" : [{
		"tooth_number" : ""
	}],
	"ap_relation_upper" : "",
	"ap_relation_lower" : "",
	"ap_relation_canine" : "",
	"ap_relation_molar" : "",
    
	"overbite" : "",
	"overbite_value" : "",
	"overjet" : "",
	"overject_value" : "",

	"midline" : "",
	"midline_upper_right" : "",
	"midline_upper_right_value" : "",
	"midline_lower_right" : "",
	"midline_lower_right_value" : "",
	"midline_upper_left" : "",
	"midline_upper_left_value" : "",
	"midline_lower_left" : "",
	"midline_lower_left_value" : "",
	"ipr_option" : "",

	"occ_opening_device_option" : "",
	"occ_opening_device_type" : "",
	"occ_opening_device_central_incisor" : "",
	"occ_opening_device_lateral_incisor" : "",

	"ext_option" : "",
	"ext_toooth_list" : [{
		"tooth_number" : ""
	}],
	"eruption_incisor_option" : "",
	"eruption_molar_option" : "",
	"eruption_molar_value" : "",
	"special_instruction" : ""
}
 */
/**********************추가 변수*****************************/
 
    $treatment_option1 = '';
    $treatment_option2 = '';
    $classification  = array();

    $shipping_address = array();
    $billing_address = array(); 

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

/************************************************************/

    $model_type = '';

    $ext_option = '';
    $tooth_number ='';

    $ipr_option = '';

    $overbite = '';
    $overbite_value = '';
    $overjet = '';
    $overjet_value = '';

    $model_mx = '';
    $model_md = '';

    $lateral_photo = '';
    $front_photo = '';
    $smile_photo = '';
    $intraoral_upper = '';
    $intraoral_lower = '';
    $intraoral_right = '';
    $intraoral_fornt = '';
    $intraoral_left = '';
    $lateral_xray = '';
    $panorama = '';

    $prescription ='';

    $ext_toooth_list = array();

    $diagnostics = array();
    #endregion

    #region 서비스 관련 변수
    $serviceKey = 0;
    $servicehistoryKey = 0;
    $seviceStatus = '';

    #endregion
?>

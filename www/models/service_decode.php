<?php
include $_SERVER["DOCUMENT_ROOT"]."/models/serviceJson.php";

    function service_json($pid, $sid)
    {
        $Data = service_r($pid, $sid);

        $service_id = $Data[0];
        $service_history_id = $Data[1];
        $patient_id = $Data[2];
        $patientname = $Data[3];
        $service_type_id = $Data[4];
        $service_typename = $Data[5];
        $status_id = $Data[6];
        $statusname = $Data[7];
        $auto_save = $Data[8];
        $tracking_number = $Data[9];
        $typeid = $Data[10];
        $created_by = $Data[11];
        $info = $Data[12];

        $dejons = decode_json($info);

  $GLOBALS['treatment_option1'] = $dejons['treatment_option1'];
 $GLOBALS['treatment_option2'] = $dejons['treatment_option2'];
  $GLOBALS['classification'] = $dejons['classification'];

$GLOBALS['shipping_address'] = $dejons['shipping_address'];
  $GLOBALS['billing_address'] = $dejons['billing_address'];

  $GLOBALS['arch'] = $dejons['arch'];

  $GLOBALS['tray_section_u'] = $dejons['tray_section_u'];
  $GLOBALS['tray_section_l'] = $dejons['tray_section_l'];

  $GLOBALS['attchment_option'] = $dejons['attchment_option'];
  $GLOBALS['attchment_list'] = $dejons['attchment_list'];

  $GLOBALS['ap_relation_upper'] = $dejons['ap_relation_upper'];
  $GLOBALS['ap_relation_lower'] = $dejons['ap_relation_lower'];
  $GLOBALS['ap_relation_canine'] = $dejons['ap_relation_canine'];
  $GLOBALS['ap_relation_molar'] = $dejons['ap_relation_molar'];

  $GLOBALS['midline'] = $dejons['midline'];
  $GLOBALS['midline_upper_right'] = $dejons['midline_upper_right'];
  $GLOBALS['midline_upper_right_value'] = $dejons['midline_upper_right_value'];
  $GLOBALS['midline_lower_right'] = $dejons['midline_lower_right'];
  $GLOBALS['midline_lower_right_value'] = $dejons['midline_lower_right_value'];
  $GLOBALS['midline_upper_left'] = $dejons['midline_upper_left'];
  $GLOBALS['midline_upper_left_value'] = $dejons['midline_upper_left_value'];
  $GLOBALS['midline_lower_left'] = $dejons['midline_lower_left'];
  $GLOBALS['midline_lower_left_value'] = $dejons['midline_lower_left_value'];
  $GLOBALS['occ_opening_device_option'] = $dejons['occ_opening_device_option'];
  $GLOBALS['occ_opening_device_type'] = $dejons['occ_opening_device_type'];
  $GLOBALS['occ_opening_device_central_incisor'] = $dejons['occ_opening_device_central_incisor'];
  $GLOBALS['occ_opening_device_lateral_incisor'] = $dejons['occ_opening_device_lateral_incisor'];

  $GLOBALS['eruption_incisor_option'] = $dejons['eruption_incisor_option'];
  $GLOBALS['eruption_molar_option'] = $dejons['eruption_molar_option'];
  $GLOBALS['eruption_molar_value'] = $dejons['eruption_molar_value'];
  $GLOBALS['special_instruction'] = $dejons['special_instruction'];
   $GLOBALS['eruption_incisor_list'] = $dejons['eruption_incisor_list'];
    $GLOBALS['eruption_molar_list'] = $dejons['eruption_molar_list'];

        $GLOBALS['model_type'] = $dejons['model_type'];

        $GLOBALS['ext_option'] = $dejons['ext_option'];
        $GLOBALS['ext_toooth_list'] = $dejons['ext_toooth_list'];
        $GLOBALS['ipr_option'] = $dejons['ipr_option'];

        $GLOBALS['overbite'] = $dejons['overbite'];
        $GLOBALS['overbite_value'] = $dejons['overbite_value'];
        $GLOBALS['overjet'] = $dejons['overjet'];
        $GLOBALS['overjet_value'] = $dejons['overjet_value'];

        if($dejons['model_mx'] != '') {   $GLOBALS['model_mx'] = 'data/' . $dejons['model_mx']; }
     
        if($dejons['model_md'] != '')  {   $GLOBALS['model_md'] = 'data/'.$dejons['model_md'];  }
  

        if($dejons['lateral_photo'] != '') {  $GLOBALS['lateral_photo'] = 'data/'.$dejons['lateral_photo']; }
    

        if($dejons['front_photo'] != ''){ $GLOBALS['front_photo'] = 'data/'.$dejons['front_photo'];   }

        if($dejons['smile_photo'] != '')
        {
            $GLOBALS['smile_photo'] = 'data/'.$dejons['smile_photo'];
        }
      

        if($dejons['intraoral_upper'] != '')
        {
            $GLOBALS['intraoral_upper'] = 'data/'.$dejons['intraoral_upper'];
        }
  

        if($dejons['intraoral_lower'] != '')
        {
            $GLOBALS['intraoral_lower'] = 'data/'.$dejons['intraoral_lower'];
        }
      

        if($dejons['intraoral_right'] != '')
        {
            $GLOBALS['intraoral_right'] = 'data/'.$dejons['intraoral_right'];
        }
      

        if($dejons['intraoral_fornt'] != '')
        {
            $GLOBALS['intraoral_fornt'] = 'data/'.$dejons['intraoral_fornt'];
        }
  

        if($dejons['intraoral_left'] != '')
        {
            $GLOBALS['intraoral_left'] = 'data/'.$dejons['intraoral_left'];
        }
      

        if($dejons['lateral_xray'] != '')
        {
            $GLOBALS['lateral_xray'] = 'data/'.$dejons['lateral_xray'];
        }
   
        if($dejons['panorama'] != '')
        {
            $GLOBALS['panorama'] = 'data/'.$dejons['panorama'];
        }

        if($dejons['prescription'] != '')
        {
            $GLOBALS['prescription'] = 'data/'.$dejons['prescription'];
        }

        $GLOBALS['diagnostics'] = $dejons['diagnostics'];

        $GLOBALS['model_mx'] = str_replace('data/data/','data/',$GLOBALS['model_mx']);
        $GLOBALS['model_md'] = str_replace('data/data/','data/',$GLOBALS['model_md']);
        $GLOBALS['lateral_photo'] = str_replace('data/data/','data/',$GLOBALS['lateral_photo']);
        $GLOBALS['front_photo'] = str_replace('data/data/','data/',$GLOBALS['front_photo']);
        $GLOBALS['smile_photo'] = str_replace('data/data/','data/',$GLOBALS['smile_photo']);
        $GLOBALS['intraoral_upper'] = str_replace('data/data/','data/',$GLOBALS['intraoral_upper']);
        $GLOBALS['intraoral_lower'] = str_replace('data/data/','data/',$GLOBALS['intraoral_lower']);
        $GLOBALS['intraoral_right'] = str_replace('data/data/','data/',$GLOBALS['intraoral_right']);
        $GLOBALS['intraoral_fornt'] = str_replace('data/data/','data/',$GLOBALS['intraoral_fornt']);
        $GLOBALS['intraoral_left'] = str_replace('data/data/','data/',$GLOBALS['intraoral_left']);
        $GLOBALS['lateral_xray'] = str_replace('data/data/','data/',$GLOBALS['lateral_xray']);
        $GLOBALS['panorama'] = str_replace('data/data/','data/',$GLOBALS['panorama']);

//        $GLOBALS['tooth_list'] = $dejons['tooth_list'];
//        $GLOBALS['$bracket_info '] = $dejons['$bracket_info '];
//        $GLOBALS['ext_toooth_list'] = $dejons['ext_toooth_list'];
//        $GLOBALS['diagnostics'] = $dejons['diagnostics'];

        //echo $GLOBALS['ext_toooth_list'][0]["tooth_number"];
    }

?>

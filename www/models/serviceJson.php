<?php
    include $_SERVER["DOCUMENT_ROOT"]."/models/modelsVariable_global.php";
    include $_SERVER["DOCUMENT_ROOT"]."/models/Json/json_EncodeDecode.php";
    // @LUCAS 서비스 팝업을 페이지로 전환하면서 include 문제가 발생하여, include를 include_once로 변경함.
    include_once $_SERVER["DOCUMENT_ROOT"]."/models/db/querys.php";
    include $_SERVER["DOCUMENT_ROOT"]."/models/Reporting/drPrintReport.php";

    #region json Encode

    #region 서비스 선택
    function service_encode($drid, $pid, $stype, $autonum, $tnum )
    {
//        if($autonum == null)
//        {
//            $autonum = 1;
//        }
//
//        $status = 1;
//
//        $rcode =  service_c($pid, $stype, $status, $autonum, $tnum,'');
//
//        if($rcode != -1)
//        {
//            $type = 1;
//
//            $rcode2 = sevicehistory_c($type, $drid, $rcode, $status);
//
//            return $rcode2;
//        }
//        else
//        {
//            return $rcode;
//        }
    }
    #endregion

    #region 환자 정보
    function patient_encode($drid, $pid, $stype, $autonum, $tnum)
    {
        if($autonum == null)
        {
            $autonum = 2;
        }

        $GLOBALS['seviceStatus'] = 1;

        $rcode =  service_c($pid, $stype, $GLOBALS['seviceStatus'], $autonum, $tnum,'');
        $tmpArray = array();

        if($rcode > 0)
        {
            $GLOBALS['serviceKey'] = $rcode;
            $type = 1;

            $rcode2 = sevicehistory_c($type, $drid, $rcode, $GLOBALS['seviceStatus']);

            if($rcode2 > 0)
            {
                $GLOBALS['servicehistoryKey'] = $rcode2;
                $dataSe = array('setup' => ''
                , 'report' => '');
                $jsonstr = encode_json($dataSe);

                $sinfocode =serviceinfo_c($jsonstr);

                array_push($tmpArray,[
                    'serviceKey' => $rcode,
                    'servicehistoryKey' => $rcode2,
                    'serviceinfoKey' => $sinfocode
                   ]);
            $jdata = Array("returnKey" => $tmpArray);
            $jsonstr = json_encode($jdata);

            }
            else
            {
                array_push($tmpArray,[
                    'serviceKey' => $rcode,
                    'servicehistoryKey' => $rcode2,
                    'serviceinfoKey' => ''
                ]);
                $jdata = Array("returnKey" => $tmpArray);
                $jsonstr = json_encode($jdata);
            }
        }
        else
        {
            array_push($tmpArray,[
                'serviceKey' => $rcode,
                'servicehistoryKey' => '',
                'serviceinfoKey' => ''
            ]);
            $jdata = Array("returnKey" => $tmpArray);
            $jsonstr = json_encode($jdata);
        }
        return $jsonstr;
    }
    #endregion

    #region 모델 타입
    function modeltype_encode($sid, $sinfoid, $status, $autonum, $tnum, $scan, $gypsum)
    {
        if($autonum == null)
        {
            $autonum = 3;
        }

        $data = array('modeltype_Scan' => $scan
                     , 'modeltype_gypsum' => $gypsum);

        $jsonstr = encode_json($data);
        $rcode =  service_c($sid, $sinfoid, $status, $autonum, $tnum, $jsonstr);
        //echo $jsonstr;
        return $rcode;
    }
    #endregion

    #region 방사선 사진
    function radiography_encode($sid, $sinfoid, $status, $autonum, $tnum)
    {
        if($autonum == null)
        {
            $autonum = 5;
        }

        $rcode =  service_c($sid, $sinfoid, $status, $autonum, $tnum, '');
        //echo $jsonstr;
        return $rcode;
    }
    #endregion

    #region 서비스 Json
    function serviceinfo_encode($sid, $drid, $stype, $autonum,  $tnum, $labid, $statuid, $tid)
    {
  
        if($autonum == null)
        {
            $autonum = 9;
        }
        $GLOBALS['seviceStatus'] = $statuid;

        $prescription = '';
        if($statuid == 21 || $statuid == 20)
        {
            //$prescription = prescription_pdf($drid, $sid);
        }

        $data = array(
					 'treatment_option1' => $GLOBALS['treatment_option1']
					, 'treatment_option2' => $GLOBALS['treatment_option2']
					, 'classification' => $GLOBALS['classification']

                    , 'shipping_address' => $GLOBALS['shipping_address']
					, 'billing_address' => $GLOBALS['billing_address']

					, 'arch' => $GLOBALS['arch']
					, 'tray_section_u' => $GLOBALS['tray_section_u']
					, 'tray_section_l' => $GLOBALS['tray_section_l']

					, 'attchment_option' => $GLOBALS['attchment_option']
					, 'attchment_list' => $GLOBALS['attchment_list']

					, 'ap_relation_upper' => $GLOBALS['ap_relation_upper']
					, 'ap_relation_lower' => $GLOBALS['ap_relation_lower']
					, 'ap_relation_canine' => $GLOBALS['ap_relation_canine']
					, 'ap_relation_molar' => $GLOBALS['ap_relation_molar']

					, 'midline' => $GLOBALS['midline']
					, 'midline_upper_right' => $GLOBALS['midline_upper_right']
					, 'midline_upper_right_value' => $GLOBALS['midline_upper_right_value']
					, 'midline_lower_right' => $GLOBALS['midline_lower_right']
					, 'midline_lower_right_value' => $GLOBALS['midline_lower_right_value']
					, 'midline_upper_left' => $GLOBALS['midline_upper_left']
					, 'midline_upper_left_value' => $GLOBALS['midline_upper_left_value']
					, 'midline_lower_left' => $GLOBALS['midline_lower_left']
					, 'midline_lower_left_value' => $GLOBALS['midline_lower_left_value']

					, 'occ_opening_device_option' => $GLOBALS['occ_opening_device_option']
					, 'occ_opening_device_type' => $GLOBALS['occ_opening_device_type']
					, 'occ_opening_device_central_incisor' => $GLOBALS['occ_opening_device_central_incisor']
					, 'occ_opening_device_lateral_incisor' => $GLOBALS['occ_opening_device_lateral_incisor']
					
					, 'eruption_incisor_option' => $GLOBALS['eruption_incisor_option']
					, 'eruption_molar_option' => $GLOBALS['eruption_molar_option']
					, 'eruption_molar_value' => $GLOBALS['eruption_molar_value']
					, 'special_instruction' => $GLOBALS['special_instruction']
					, 'eruption_incisor_list' => $GLOBALS['eruption_incisor_list']
					, 'eruption_molar_list' => $GLOBALS['eruption_molar_list']

					, 'model_type' => $GLOBALS['model_type']

                    , 'ext_option' => $GLOBALS['ext_option']
                    , 'ext_toooth_list' => $GLOBALS['ext_toooth_list']
                    , 'ipr_option' => $GLOBALS['ipr_option']

                    , 'overbite' => $GLOBALS['overbite']
                    , 'overbite_value' => $GLOBALS['overbite_value']
                    , 'overjet' => $GLOBALS['overjet']
                    , 'overjet_value' => $GLOBALS['overjet_value']
                    , 'diagnostics' => $GLOBALS['diagnostics']

                    , 'model_mx' => $GLOBALS['model_mx']
                    , 'model_md' => $GLOBALS['model_md']

                    , 'lateral_photo' => $GLOBALS['lateral_photo']
                    , 'front_photo' => $GLOBALS['front_photo']
                    , 'smile_photo' => $GLOBALS['smile_photo']
                    , 'intraoral_upper' => $GLOBALS['intraoral_upper']
                    , 'intraoral_lower' => $GLOBALS['intraoral_lower']
                    , 'intraoral_right' => $GLOBALS['intraoral_right']
                    , 'intraoral_fornt' => $GLOBALS['intraoral_fornt']
                    , 'intraoral_left' => $GLOBALS['intraoral_left']
                    , 'lateral_xray' => $GLOBALS['lateral_xray']
                    , 'panorama' => $GLOBALS['panorama']

                    , 'prescription' => $prescription // pdf 경로
						);

        $data = str_replace('null','',$data);
        $data = str_replace('data/','',$data);
        $jsonstr = encode_json($data);
//        echo $jsonstr;
//        exit();

if($GLOBALS['front_photo'] != '')
{
  //  $fn = $GLOBALS['front_photo'];
    $rcode2 = filepath_cu($sid, $GLOBALS['front_photo']);
}

        if ($GLOBALS['seviceStatus'] == 1 || $GLOBALS['seviceStatus'] == 20 || $GLOBALS['seviceStatus'] == 21) {
            $rcode =  service_u($sid, $stype, $GLOBALS['seviceStatus'], $autonum, $labid, $tnum, $jsonstr, $tid, 'J');
            $rcode2 =  sevicehistory_c(1, $drid, $rcode, $GLOBALS['seviceStatus']);
        }else{
        $rcode =  service_u($sid, $stype, $GLOBALS['seviceStatus'], $autonum, $labid, $tnum, $jsonstr, $tid, 'J');
       // $rcode2 =  sevicehistory_c(1, $drid, $rcode, $GLOBALS['seviceStatus']);
        }
       
 
        $tmpArray = array();

        if($rcode > 0)
        {
            $GLOBALS['serviceKey'] = $rcode;
            $type = 1;

           // $rcode2 = sevicehistory_c(1, $drid, $rcode, $GLOBALS['seviceStatus']);

           // 작성중일때는 Notification 보내지 않는다. BSKIM
            // if($autonum == 2 || $autonum == 9 )
            // {
            //     alarm_c( $drid, $rcode, 1); 
            // }

            if(($autonum == 13 && ($GLOBALS['seviceStatus'] == 20 || $GLOBALS['seviceStatus'] == 21))
            ||($autonum == 9 && ($GLOBALS['seviceStatus'] == 20 || $GLOBALS['seviceStatus'] == 21)))
            {
                alarm_c( $drid, $rcode, 1); 
            }

            if($rcode2 > 0)
            {
                $GLOBALS['servicehistoryKey'] = $rcode2;
                $dataSe = array('setup' => ''
                , 'report' => '');
                $jsonstrinf = encode_json($dataSe);

                $sinfocode =serviceinfo_c($rcode, $rcode2, $jsonstrinf);

                array_push($tmpArray,[
                    'serviceKey' => $rcode,
                    'servicehistoryKey' => $rcode2,
                    'serviceinfoKey' => $sinfocode
                ]);
                $jdata = Array("returnKey" => $tmpArray);
                $jsonstr = json_encode($jdata);
            }
            else
            {
                array_push($tmpArray,[
                    'serviceKey' => $rcode,
                    'servicehistoryKey' => $rcode2,
                    'serviceinfoKey' => ''
                ]);
                $jdata = Array("returnKey" => $tmpArray);
                $jsonstr = json_encode($jdata);
            }
        }
        else
        {
            array_push($tmpArray,[
                'serviceKey' => $rcode,
                'servicehistoryKey' => '',
                'serviceinfoKey' => ''
            ]);
            $jdata = Array("returnKey" => $tmpArray);
            $jsonstr = json_encode($jdata);
        }

        return $jsonstr;
    }
    #endregion

    #endregion

?>
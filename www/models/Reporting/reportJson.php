<?php
    include $_SERVER["DOCUMENT_ROOT"]."/models/modelsVariable_global.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/models/Json/json_EncodeDecode.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/models/db/querys.php";

    function report_json($drid, $paid, $servid)
    {
        $braketLisat = '';
        $S_11 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/11.jpg';
        $S_12 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/12.jpg';
        $S_13 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/13.jpg';
        $S_14 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/14.jpg';
        $S_15 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/15.jpg';
        $S_16 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/16.jpg';
        $S_17 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/17.jpg';
        $S_18 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/18.jpg';

        $S_21 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/21.jpg';
        $S_22 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/22.jpg';
        $S_23 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/23.jpg';
        $S_24 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/24.jpg';
        $S_25 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/25.jpg';
        $S_26 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/26.jpg';
        $S_27 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/27.jpg';
        $S_28 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/28.jpg';

        $S_31 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/31.jpg';
        $S_32 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/32.jpg';
        $S_33 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/33.jpg';
        $S_34 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/34.jpg';
        $S_35 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/35.jpg';
        $S_36 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/36.jpg';
        $S_37 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/37.jpg';
        $S_38 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/38.jpg';

        $S_41 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/41.jpg';
        $S_42 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/42.jpg';
        $S_43 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/43.jpg';
        $S_44 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/44.jpg';
        $S_45 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/45.jpg';
        $S_46 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/46.jpg';
        $S_47 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/47.jpg';
        $S_48 = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/48.jpg';

        $SE1_11_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/11C.jpg';
        $SE1_12_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/12C.jpg';
        $SE1_13_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/13C.jpg';
        $SE1_14_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/14C.jpg';
        $SE1_15_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/15C.jpg';
        $SE1_16_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/16C.jpg';
        $SE1_17_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/17C.jpg';
        $SE1_18_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/18C.jpg';

        $SE1_21_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/21C.jpg';
        $SE1_22_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/22C.jpg';
        $SE1_23_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/23C.jpg';
        $SE1_24_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/24C.jpg';
        $SE1_25_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/25C.jpg';
        $SE1_26_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/26C.jpg';
        $SE1_27_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/27C.jpg';
        $SE1_28_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/28C.jpg';

        $SE1_31_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/31C.jpg';
        $SE1_32_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/32C.jpg';
        $SE1_33_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/33C.jpg';
        $SE1_34_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/34C.jpg';
        $SE1_35_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/35C.jpg';
        $SE1_36_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/36C.jpg';
        $SE1_37_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/37C.jpg';
        $SE1_38_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/38C.jpg';

        $SE1_41_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/41C.jpg';
        $SE1_42_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/42C.jpg';
        $SE1_43_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/43C.jpg';
        $SE1_44_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/44C.jpg';
        $SE1_45_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/45C.jpg';
        $SE1_46_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/46C.jpg';
        $SE1_47_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/47C.jpg';
        $SE1_48_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/48C.jpg';

        $SE2_11_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/11C.jpg';
        $SE2_12_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/12C.jpg';
        $SE2_13_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/13C.jpg';
        $SE2_14_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/14C.jpg';
        $SE2_15_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/15C.jpg';
        $SE2_16_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/16C.jpg';
        $SE2_17_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/17C.jpg';
        $SE2_18_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/18C.jpg';

        $SE2_21_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/21C.jpg';
        $SE2_22_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/22C.jpg';
        $SE2_23_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/23C.jpg';
        $SE2_24_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/24C.jpg';
        $SE2_25_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/25C.jpg';
        $SE2_26_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/26C.jpg';
        $SE2_27_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/27C.jpg';
        $SE2_28_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/28C.jpg';

        $SE2_31_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/31C.jpg';
        $SE2_32_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/32C.jpg';
        $SE2_33_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/33C.jpg';
        $SE2_34_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/34C.jpg';
        $SE2_35_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/35C.jpg';
        $SE2_36_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/36C.jpg';
        $SE2_37_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/37C.jpg';
        $SE2_38_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/38C.jpg';

        $SE2_41_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/41C.jpg';
        $SE2_42_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/42C.jpg';
        $SE2_43_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/43C.jpg';
        $SE2_44_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/44C.jpg';
        $SE2_45_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/45C.jpg';
        $SE2_46_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/46C.jpg';
        $SE2_47_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/47C.jpg';
        $SE2_48_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/48C.jpg';

        $LateralPhoto = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/lateral_photo_report.jpg';
        $FrontalPhoto =$_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/frontal_photo_report.jpg';
        $SmilePhoto = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/smile_photo_report.jpg';
        $UpperPhoto = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/intraoral_upper_report.jpg';
        $LowerPhoto = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/intraoral_lower_report.jpg';
        $RightPhoto = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/intraoral_right_report.jpg';
        $FrontPhoto = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/intraoral_front_report.jpg';
        $LeftPhoto = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/intraoral_left_report.jpg';
        $Lateral_Xray = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/lateral_xray_report.jpg';
        $Panorama_Xray = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/panorama_xray.jpg';

        $Data = REPORT_R($paid, $servid);
        $dejons = decode_json($Data['info']);
        $servicename = $Data['service_type'];
        $Doctor = $Data['DOCTORNAME'];
        $PatientID = $Data['patientid'];
        $PatientName = $Data['patientname'];
        $Gender = $Data['GENDER'];
        $Birthday = $Data['birthday'];
        $Age = $Data['AGE'];
        $ModelType = $dejons['model_type'];
        if( $dejons['lateral_photo'] != '')
        {
            $LateralPhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['lateral_photo'];
        }
        if($dejons['front_photo'] != '')
        {
            $FrontalPhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['front_photo'];
        }
        if($dejons['smile_photo'] != '')
        {
            $SmilePhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['smile_photo'];
        }
        if($dejons['intraoral_upper'] != '')
        {
            $UpperPhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['intraoral_upper'];
        }
        if($dejons['intraoral_lower'] != '')
        {
            $LowerPhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['intraoral_lower'];
        }
        if($dejons['intraoral_right'] != '')
        {
            $RightPhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['intraoral_right'];
        }
        if($dejons['intraoral_fornt'] != '')
        {
            $FrontPhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['intraoral_fornt'];
        }
        if($dejons['intraoral_left'] != '')
        {
            $LeftPhoto = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['intraoral_left'];
        }
        if($dejons['lateral_xray'] != '')
        {
            $Lateral_Xray = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['lateral_xray'];
        }
        if($dejons['panorama'] != '')
        {
            $Panorama_Xray = $_SERVER["DOCUMENT_ROOT"].'/data/'.$dejons['panorama'];
        }

        $IBT = $dejons['idb_try_option'];
        $TraysecUp = $dejons['idb_try_section_u'];
        $TraysecLow =$dejons['idb_try_section_l'];
        $IPRSetup =  $dejons['ipr_option'];
        $EthnicGroup = 'Caucasian';
        $Widen = $dejons['widen_u'].' / '.$dejons['widen_l'];
        $Constrict =$dejons['constrict_u'].' / '.$dejons['constrict_l'];
        $LowerOcclusalPlane = $dejons['lower_occ_plane'];
        if($dejons['overbite'] == 'Custom')
        {
            $Overbite = $dejons['overbite'].' / '.$dejons['overbite_value'];
        }
        else
        {
            $Overbite = $dejons['overbite'];
        }
        if($dejons['overjet'] == 'Custom')
        {
            $Overjet = $dejons['overjet'].' / '.$dejons['overject_value'];
        }
        else
        {
            $Overjet = $dejons['overjet'];
        }
        $CC = $dejons['cc'];

        $bcount = count($dejons['bracket_info']);
        $linep = "\n";
//        echo  $linep;
//        exit();
        for($i = 0; $i < $bcount; $i = $i + 1)
        {
            $toothcount = count($dejons['bracket_info'][$i]['tooth_list']);
            if($dejons['bracket_info'][$i]['company'] != '') {
                $braketLisat.=  'No  ' . $dejons['bracket_info'][$i]['list_index'] . '   :  ' . $dejons['bracket_info'][$i]['company'] . '  /  ' . $dejons['bracket_info'][$i]['brand'].$linep;
            }
            else
            {
                $braketLisat =  'No  ' . $dejons['bracket_info'][$i]['list_index'] . '   :  ' . $dejons['bracket_info'][$i]['user_add_company'] . '  /  ' . $dejons['bracket_info'][$i]['user_add_brand'].$linep;
               // $braketLisat =  $list2;
            }
            for($j = 0; $j < $toothcount; $j = $j + 1)
            {
                $braketLisat .= '          '.$dejons['bracket_info'][$i]['tooth_list'][$j]['bracket_number'].$linep;
//                $braketLisat = str_pad($braketLisat, 40, ' ', STR_PAD_RIGHT);
//                $braketLisat = str_pad($braketLisat, 0, ' ', STR_PAD_LEFT);
                //$braketLisat .=   $blst;
            }
        }
//        echo  $braketLisat;
//        exit();
        $extcount = count($dejons['ext_toooth_list']);

        for($t = 0; $t < $extcount; $t = $t + 1)
        {
            $toothNum = explode(",", $dejons['ext_toooth_list'][$t]['tooth_number']);
            $toothNumCnt = count($toothNum);
            for($th = 0; $th < $toothNumCnt; $th = $th + 1)
            {
                switch ($toothNum[$th])
                {
                    case "11":
                        $SE1_11_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "12":
                        $SE1_12_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "13":
                        $SE1_13_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "14":
                        $SE1_14_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "15":
                        $SE1_15_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "16":
                        $SE1_16_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "17":
                        $SE1_17_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "18":
                        $SE1_18_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "21":
                        $SE1_21_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "22":
                        $SE1_22_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "23":
                        $SE1_23_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "24":
                        $SE1_24_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "25":
                        $SE1_25_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "26":
                        $SE1_26_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "27":
                        $SE1_27_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "28":
                        $SE1_28_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "31":
                        $SE1_31_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "32":
                        $SE1_32_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "33":
                        $SE1_33_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "34":
                        $SE1_34_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "35":
                        $SE1_35_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "36":
                        $SE1_36_C= $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "37":
                        $SE1_37_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "38":
                        $SE1_38_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "41":
                        $SE1_41_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "42":
                        $SE1_42_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "43":
                        $SE1_43_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "44":
                        $SE1_44_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "45":
                        $SE1_45_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "46":
                        $SE1_46_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "47":
                        $SE1_47_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                    case "48":
                        $SE1_48_C = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/toothout.jpg';
                        break;
                }
            }

            $diacount = count($dejons['diagnostics']);

            for($t = 0; $t < $diacount; $t = $t + 1) {
                $ditoothNum = explode(",", $dejons['diagnostics'][$t]['tooth_number']);
                $ditoothNumcnt = count($ditoothNum);
                for ($th = 0; $th < $ditoothNumcnt; $th = $th + 1) {
                    switch ($ditoothNum[$th]) {
                        case "11":
                            $SE2_11_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "12":
                            $SE2_12_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "13":
                            $SE2_13_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "14":
                            $SE2_14_C= crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "15":
                            $SE2_15_C= crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "16":
                            $SE2_16_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "17":
                            $SE2_17_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "18":
                            $SE2_18_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "21":
                            $SE2_21_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "22":
                            $SE2_22_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "23":
                            $SE2_23_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "24":
                            $SE2_24_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "25":
                            $SE2_25_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "26":
                            $SE2_26_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "27":
                            $SE2_27_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "28":
                            $SE2_28_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "31":
                            $SE2_31_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "32":
                            $SE2_32_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "33":
                            $SE2_33_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "34":
                            $SE2_34_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "35":
                            $SE2_35_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "36":
                            $SE2_36_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "37":
                            $SE2_37_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "38":
                            $SE2_38_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "41":
                            $SE2_41_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "42":
                            $SE2_42_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "43":
                            $SE2_43_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "44":
                            $SE2_44_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "45":
                            $SE2_45_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "46":
                            $SE2_46_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "47":
                            $SE2_47_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                        case "48":
                            $SE2_48_C = crownSelect($dejons['diagnostics'][$t]['type']);
                            break;
                    }
                }
            }
        }


        $arrdata = array("service" => $servicename,
                            "Doctor" => $Doctor,
                            "PatientID" => $PatientID,
                            "PatientName" => $PatientName,
                            "Gender" => $Gender,
                            "Birthday" => $Birthday,
                            "Age" => $Age,
                            "ModelType" => $ModelType,
                            "IBT" => $IBT,
                            "TraysecUp" => $TraysecUp,
                            "TraysecLow" => $TraysecLow,
                            "BrackList" => $braketLisat,
                            "IPRSetup" => $IPRSetup,
                            "EthnicGroup" => $EthnicGroup,
                            "Widen" => $Widen,
                            "Constrict" => $Constrict,
                            "LowerOcclusalPlane" => $LowerOcclusalPlane,
                            "Overbite" => $Overbite,
                            "Overjet" => $Overjet,
                            "CC" => $CC,
                            "LateralPhoto" => $LateralPhoto,
                            "FrontalPhoto" => $FrontalPhoto,
                            "SmilePhoto" => $SmilePhoto,
                            "UpperPhoto" => $UpperPhoto,
                            "LowerPhoto" => $LowerPhoto,
                            "RightPhoto" => $RightPhoto,
                            "FrontPhoto" => $FrontPhoto,
                            "LeftPhoto" => $LeftPhoto,
                            "Lateral_Xray" => $Lateral_Xray,
                            "Panorama_Xray" => $Panorama_Xray,
                            "11" => $S_11,
                            "12" => $S_12,
                            "13" => $S_13,
                            "14" => $S_14,
                            "15" => $S_15,
                            "16" => $S_16,
                            "17" => $S_17,
                            "18" => $S_18,
                            "21" => $S_21,
                            "22" => $S_22,
                            "23" => $S_23,
                            "24" => $S_24,
                            "25" => $S_25,
                            "26" => $S_26,
                            "27" => $S_27,
                            "28" => $S_28,
                            "31" => $S_31,
                            "32" => $S_32,
                            "33" => $S_33,
                            "34" => $S_34,
                            "35" => $S_35,
                            "36" => $S_36,
                            "37" => $S_37,
                            "38" => $S_38,
                            "41" => $S_41,
                            "42" => $S_42,
                            "43" => $S_43,
                            "44" => $S_44,
                            "45" => $S_45,
                            "46" => $S_46,
                            "47" => $S_47,
                            "48" => $S_48,
                            "SE1_11_C" => $SE1_11_C,
                            "SE1_12_C" => $SE1_12_C,
                            "SE1_13_C" => $SE1_13_C,
                            "SE1_14_C" => $SE1_14_C,
                            "SE1_15_C" => $SE1_15_C,
                            "SE1_16_C" => $SE1_16_C,
                            "SE1_17_C" => $SE1_17_C,
                            "SE1_18_C" => $SE1_18_C,
                            "SE1_21_C" => $SE1_21_C,
                            "SE1_22_C" => $SE1_22_C,
                            "SE1_23_C" => $SE1_23_C,
                            "SE1_24_C" => $SE1_24_C,
                            "SE1_25_C" => $SE1_25_C,
                            "SE1_26_C" => $SE1_26_C,
                            "SE1_27_C" => $SE1_27_C,
                            "SE1_28_C" => $SE1_28_C,
                            "SE1_31_C" => $SE1_31_C,
                            "SE1_32_C" => $SE1_32_C,
                            "SE1_33_C" => $SE1_33_C,
                            "SE1_34_C" => $SE1_34_C,
                            "SE1_35_C" => $SE1_35_C,
                            "SE1_36_C" => $SE1_36_C,
                            "SE1_37_C" => $SE1_37_C,
                            "SE1_38_C" => $SE1_38_C,
                            "SE1_41_C" => $SE1_41_C,
                            "SE1_42_C" => $SE1_42_C,
                            "SE1_43_C" => $SE1_43_C,
                            "SE1_44_C" => $SE1_44_C,
                            "SE1_45_C" => $SE1_45_C,
                            "SE1_46_C" => $SE1_46_C,
                            "SE1_47_C" => $SE1_47_C,
                            "SE1_48_C" => $SE1_48_C,
                            "SE2_11_C" => $SE2_11_C,
                            "SE2_12_C" => $SE2_12_C,
                            "SE2_13_C" => $SE2_13_C,
                            "SE2_14_C" => $SE2_14_C,
                            "SE2_15_C" => $SE2_15_C,
                            "SE2_16_C" => $SE2_16_C,
                            "SE2_17_C" => $SE2_17_C,
                            "SE2_18_C" => $SE2_18_C,
                            "SE2_21_C" => $SE2_21_C,
                            "SE2_22_C" => $SE2_22_C,
                            "SE2_23_C" => $SE2_23_C,
                            "SE2_24_C" => $SE2_24_C,
                            "SE2_25_C" => $SE2_25_C,
                            "SE2_26_C" => $SE2_26_C,
                            "SE2_27_C" => $SE2_27_C,
                            "SE2_28_C" => $SE2_28_C,
                            "SE2_31_C" => $SE2_31_C,
                            "SE2_32_C" => $SE2_32_C,
                            "SE2_33_C" => $SE2_33_C,
                            "SE2_34_C" => $SE2_34_C,
                            "SE2_35_C" => $SE2_35_C,
                            "SE2_36_C" => $SE2_36_C,
                            "SE2_37_C" => $SE2_37_C,
                            "SE2_38_C" => $SE2_38_C,
                            "SE2_41_C" => $SE2_41_C,
                            "SE2_42_C" => $SE2_42_C,
                            "SE2_43_C" => $SE2_43_C,
                            "SE2_44_C" => $SE2_44_C,
                            "SE2_45_C" => $SE2_45_C,
                            "SE2_46_C" => $SE2_46_C,
                            "SE2_47_C" => $SE2_47_C,
                            "SE2_48_C" => $SE2_48_C );

        $data = array('contacts' => array ($arrdata));
        $jsonstr = encode_json($data);

        $myfile = fopen($_SERVER["DOCUMENT_ROOT"].'/models/Reporting/reportjsondata.json', "w");
        fwrite($myfile,  $jsonstr);
        fclose($myfile);
    }
        //diagnostics
        function crownSelect($stype)
        {
            switch ($stype)
            {
                case 'Crown':
                    return $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/crown.jpg';
                    break;
                case 'Implant':
                    return $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/implant.jpg';
                    break;
                case 'Telesopic crown':
                    return $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/telescopiccrown.jpg';
                    break;
                case 'Veneered crown':
                    return $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/Reportimage/veneeredcrown.jpg';
                    break;
            }
        }
?>

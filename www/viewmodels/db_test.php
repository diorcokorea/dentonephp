<?php
//    include "../models/db/querys.php";
//
//        $grades = [];
//        $grades['ACCDRID'] = 0;
//        $grades['LOGINID'] = 'test12';
//        $grades['LOGINPW'] = 'test1234!';
//        $grades['PARENTID'] = 0;
//        $grades['DOCTORID'] = 0;
//        $grades['DRNAME'] = '홍두깨';
//        $grades['H_NAME'] = '디지털치과';
//        $grades['PHONE'] = '07012348765';
//        $grades['MOBILE'] = '01012352356';
//        $grades['EMAIL'] = 'ttg@naver.com';
//        $grades['LICENSENUM'] = '234567891';
//        $grades['COUNTRYID'] = 1;
//        $grades['F_NAME'] = '';
//         $grades['SUBNAME'] = null;
//        $grades['STNAME'] = '';
//        $grades['ROLE'] = 'admin';
//        $grades['ADDRID'] = 0;
//        $grades['ADDNAME'] = '서울시 구로구 디지털로 34길';
//        $grades['ADD1'] = '123';
//        $grades['ADD2'] = null;
//        $grades['ADD3'] = null;
//        $grades['ADD4'] = null;
//        $grades['ZIPOCODE'] = '12345';
//        $grades['STAFFID'] = 0;
//        $grades['SETTING'] = null;
//        $grades['CLINICSETTING'] = null;
//        $grades['TOSYN'] = 'Y';
//        $grades['PERSONAL'] = 'Y';
//        $grades['MARKETING'] = 'Y';
//        $grades['THIRDPERSON'] = 'Y';
//
//        var_dump($grades);
//
//    $rData = sign_Up($grades);
//
//    echo $rData;
//include "reportPrintTest.php";
//
//report_execute();

//include "../models/db/querys.php";
//$rData = bracket_r(1,  'B');
//$prcount = count($rData);
////echo $prcount;
//for($i=0; $i< $prcount; $i =$i+1)
//{
//     echo $rData[$i]['COMPANY_ID'].';    '.$rData[$i]['bracket_id'].';   '.$rData[$i]['B_NAME']."<br />";
//}

//    include $_SERVER["DOCUMENT_ROOT"]."/models/db/querys.php";
//    $rData = bracketNO_r('001000100');
//    echo $rData;

//
//    include "../models/regexr.php";
//    $msg = 'ㄱㄴㄷ';
//    $rData = checkhangul($msg);
//    $dCnt = 0;
//    $tmsg = '';
//    if ($rData == 1)
//    {
//        $dCnt = mb_strlen($msg, 'UTF-8');
//        for($i = 0 ; $i < $dCnt; $i = $i + 1)
//        {
//            if($i == 0)
//            {
//                $tmsg = iconv_substr( $msg, $i, 1,'UTF-8');
//            }
//            else
//            {
//                $tmsg = $tmsg.'|'.iconv_substr( $msg, $i, 1, 'UTF-8');
//            }
//        }
//    }
//    //$tmsg = iconv('EUC-KR', 'UTF-8', $tmsg);
//    echo $tmsg;

//      include "../models/courierinquiry.php";
//      $returnData = Courier_inquiry("","로젠",96475366396);
//     // echo $returnData;//"보내시는분 : ".$returnData[0]." 보낸날자 : ". $returnData[1]."<br>받으시는분 : ".$returnData[2].' 배송상태:'.$returnData[4];
//     $cnt = count($returnData);
//     for($i = 0; $i < $cnt; $i=$i+1)
//     {
//         echo $returnData[$i]."<br />";
//     }

//include "../models/db/querys.php";
////$rData = user_update(5, 4, 2, '1qazXSW@',  '슈가폴 치과', '021231234', 'sugarpole@sugarpole.com'
////    , '231451234', '서울틀별시 구로구 디지털로 34길 43','코오롱사이언스 밸리 507','','','','12345');
//$rData =patient_r(66);
//
//echo $rData[8];

    //include "../models/db/querys.php";
//    $rData = patientlist_r(0,1,1,'D',2,'2021-01-01','2021-07-07','기러기');
//    $cnt = count($rData);
//     for($i = 0; $i < $cnt; $i=$i+1)
//     {
//         echo $rData[$i]['patientname'].'   '.$rData[$i]['patientid'].'   '.$rData[$i]['servicetype'].'   '.$rData[$i]['startDate'].'   '.$rData[$i]['lastEditDate'].'   '.$rData[$i]['Statusid']."<br />";
//     }

//    include $_SERVER["DOCUMENT_ROOT"]."/models/Reporting/reportData.php";
//    report_print(6);

//서비스 선택
//    include $_SERVER["DOCUMENT_ROOT"]."/models/serviceJson.php";
//    $rcode = serviceinfo_encode(1, 5,1, null,'');
//   // $rcode = patient_encode(5, 5, 1, null, '');
//    echo $rcode;


//Json Test
//    include $_SERVER["DOCUMENT_ROOT"]."/models/modelsVariable_global.php";
//    include $_SERVER["DOCUMENT_ROOT"]."/models/serviceJson.php";
//
//    $model_type = 'ScanFile';
//    $idb_try_option = 'Upper/Lower';
//    $idb_try_section_u = '1Piece';
//    $idb_try_section_l = '1Piece';
//    $ext_option = 'tooth_Out';
//
//    $ipr_option = 'Yes';
//    $maintain_asis_u = 'U3-3';
//    $maintain_asis_l = 'L3-3';
//    $widen_u = 'U3-3';
//    $widen_l = 'L3-3';
//    $constrict_u = 'U6-6';
//    $constrict_l = 'L6-6';
//    $lower_occ_plane = 'Flat';
//    $overbite = 'ideal(1mm)';
//    $overbite_value = null;
//    $overjet = 'Custom';
//    $overject_value = '1.0mm';
//
//    $cc = null;
//    $model_mx = 'Data\\5\\4\\1\\MX\\testmx.jpg';
//    $model_md = 'Data\\5\\4\\1\\MD\\testmd.jpg';
//    $lateral_photo = '\'Data\\5\\4\\1\\Pace\\lateral_8.jpg';
//    $front_photo = 'Data\\5\\4\\1\\Pace\\Frontal_8.jpg';
//    $smile_photo = 'Data\\5\\4\\1\\Pace\\Smile_8.jpg';
//    $intraoral_upper = 'Data\\5\\4\\1\\Pace\\IntraoralUpper_8.jpg';
//    $intraoral_lower = 'Data\\5\\4\\1\\Pace\\IntraoralLower_8.jpg';
//    $intraoral_right = 'Data\\5\\4\\1\\Pace\\IntraoralRigth_8.jpg';
//    $intraoral_fornt = 'Data\\5\\4\\1\\Pace\\IntraoralFront_8.jpg';
//    $intraoral_left = 'Data\\5\\4\\1\\Pace\\IntraoralLeft_8.jpg';
//    $lateral_xray = 'Data\\5\\4\\1\\xray\\lateral_xray_8.jpg';
//    $panorama = 'Data\\5\\4\\1\\xray\\panorama_xray_8.jpg';
//
////    for($i = 0; $i < 8; $i = $i + 1)
////    {
////        $image_list = array('modality' => 'Lateral'
////        , 'path' => 'Data\\Pace\\Lateral_8.jpg');
////    }
//
//    $tooth_list = array();
//
//    array_push($tooth_list,['tooth_number' => '11-15,21-25,31-35,41-45'
//                        , 'bracket_number' => '11-15,21-25,31-35,41-45']);
//    array_push($tooth_list,['tooth_number' => '16,17'
//                        , 'bracket_number' => '16,17']);
//
//    $bracket_info = array();
//
//    array_push($bracket_info,[
//          'company' => 'Tomy'
//        , 'brand' => 'Clippy C'
//        , 'list_index' => '1'
//        , 'color' => '255,255,255'
//        , 'user_add_company' => ''
//        , 'user_add_brand' => ''
//        , 'tooth_list' => array($tooth_list[0])]);
//    array_push($bracket_info,[
//        'company' => ''
//        , 'brand' => ''
//        , 'list_index' => '2'
//        , 'color' => '255,255,255'
//        , 'user_add_company' => 'testcom'
//        , 'user_add_brand' => 'testbrand'
//        , 'tooth_list' => array($tooth_list[1])]);
//
//    $ext_toooth_list = array();
//    array_push($ext_toooth_list,['tooth_number' => '17,18']);
//    array_push($ext_toooth_list,['tooth_number' => '21,22']);
//    $diagnostics = array();
//    array_push($diagnostics,['tooth_number' => '18,17'
//                                   , 'type' => 'Crown']);
//    array_push($diagnostics,['tooth_number' => '24'
//                                  , 'type' => 'Implant']);
//    array_push($diagnostics,['tooth_number' => '33'
//                                   , 'type' => 'Telesopic crown']);
//
//    $GLOBALS['seviceStatus'] = 1;
//$rdata = serviceinfo_encode(5,2, 1, 9, null, 16,20  );
//    echo $rdata;

//프린트 리포트
//    include $_SERVER["DOCUMENT_ROOT"]."/models/Reporting/drPrintReport.php";
//    prescription_print(2,95,31);

    include $_SERVER["DOCUMENT_ROOT"]."/models/service_decode.php";
service_json(22,21);

?>

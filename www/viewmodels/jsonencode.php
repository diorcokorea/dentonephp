<?php
   // include "../models/Json/json_EncodeDecode.php";
    include "../models/serviceJson.php";
//    $data2 = array(0,1,2,3,array('beskin'=>'31'));
//
//    $data = array(
//        'test'=>'test data',
//        'sample'=>'sample string',
//        'data2'=>$data2,
//        'bool'=>true,
//        'number_data'=>33282,
//        'pi'=>3.14
//    );

////브라켓 테스트
//    $tray = array(
//        'Upper' => 'Y',
//        'Lower' => 'Y');
//
//    $tUpper = array('1 Piece'=>'Y','Midline Split'=>'N','3 Piece'=>'N');
//    $tLower = array('1 Piece'=>'Y','Midline Split'=>'N','3 Piece'=>'N');
//
//    $sections = array('Upper'=>$tUpper,'Lower'=>$tLower);
//
//    $tjson = array();
//    array_push($tjson, array(
//            'Seq' => 1,
//            'company' => 'test',
//            'bracket' => 'testb',
//            'bracketno' => 11,
//            'brackcolor' => '255,255,255'));
//        array_push($tjson, array(
//            'Seq' => 2,
//            'company' => 'test',
//            'bracket' => 'testb',
//            'bracketno' => 21,
//            'brackcolor' => '255,255,255'));
//        array_push($tjson, array(
//            'Seq' => 3,
//            'company' => 'test',
//            'bracket' => 'testb',
//            'bracketno' => 33,
//            'brackcolor' => '255,255,255'));
//        array_push($tjson, array(
//            'Seq' => 4,
//            'company' => 'test',
//            'bracket' => 'testb',
//            'bracketno' => 45,
//            'brackcolor' => '255,255,255'));
//        array_push($tjson, array(
//            'Seq' => 5,
//            'company' => 'test',
//            'bracket' => 'testb',
//            'bracketno' => 48,
//            'brackcolor' => '255,255,255'));
//
//    $returndata = bracket_encode(6,1,1,null,null,$tray, $sections, $tjson);
  // echo $returndata[0].'<br/>'.$returndata[1];

////셋업1 테스트  array('Maintain Asls'=> 'N/A', 'Widen'=>'','Constrict'=>'');
//    $ttoothout = array('No_toothout'=>'Y', 'toothout' => 'N');
//    $tipryn = array('Yes' => 'Y', 'No' => 'N');
//    $tjson = array();
//
//    $Upperasls = array('N/A'=>'Y', 'U3-3' => 'N', 'U6-6' => 'N');
//    $Lowerasls = array('N/A'=>'Y', 'L3-3' => 'N', 'L6-6' => 'N');
//
//    $UpperWiden = array('U3-3' => 'N', 'U6-6' => 'N');
//    $LowerWiden = array('L3-3' => 'N', 'L6-6' => 'N');
//
//    $UpperConstrict = array('U3-3' => 'N', 'U6-6' => 'N');
//    $LowerConstrict = array('L3-3' => 'N', 'L6-6' => 'N');
//
//    $mMaintainAsls = array('Upper' => $Upperasls, 'Lower' => $Lowerasls);
//    $Widen = array('Upper' => $UpperWiden, 'Lower' => $LowerWiden);
//    $Constrict = array('Upper' => $UpperConstrict, 'Lower' => $LowerConstrict);
//    array_push($tjson, array(
//            'Maintain Asls' => $mMaintainAsls,
//            'Widen' => $Widen,
//            'Constrict' => $Constrict));
//    $returndata = setupOne_encode(6,1,1,null,null,$ttoothout,'17;26', $tipryn ,$tjson);
//
//    echo $returndata[0].'<br/>'.$returndata[1];

//셋업2 테스트  array('Maintain Asls'=> 'N/A', 'Widen'=>'','Constrict'=>'');
    $lop = array('N/A' =>'Y', 'Flat' => 'N', 'Maintain' => 'N', 'CurveOfSpee' => 'N');
    $Overbite = array('ldeal(1mm)' => 'Y', 'Custorm' => 'N', 'Custormtxt' => '');
    $Overjet = array('ldeal(1mm)' => 'Y', 'Custorm' => 'N', 'Custormtxt' => '');
    $bite = array('Overbite' => $Overbite, 'Overjet' => $Overjet);
    $pefd = array('Crown' => '', 'Implant' => '', 'Telescopic crown' => '', 'Veneered crown' => '');

    $returndata = setupTow_encode(6,1,1,null,null,$lop,$bite, $pefd,'테스트');

    echo $returndata[0].'<br/>'.$returndata[1];
?>

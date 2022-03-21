<?php
//    include "../models/Json/json_EncodeDecode.php";
//    $data = "{\"test\":\"test data\",\"sample\":\"sample string\",\"data2\":[0,1,2,3,{\"beskin\":\"31\"}],\"bool\":true,\"number_data\":33282,\"pi\":3.14}";
//    $jdata =  decode_json($data);
//    echo $jdata['data2'][4]['beskin'];
    include "../models/serviceJson.php";
//// 브라켓
//    $rdata = bracket_decode(6);
//
//    echo $rdata[0]['patientname'].'<br/>'. $rdata[1]['Indirect_Bonding_Tray_Upper'].'<br/>'.$rdata[2][0]['Seq'];

//// 셋업 1
//    $rdata = setupOne_decode(6, 7);
//
//    echo $rdata['patientname'].'<br/>'.$rdata['Maintain_Asls_Upper_NA'].'<br/>'.$rdata['ExtractionNo'];

// 셋업 2
    $rdata = setupTow_decode(6, 8);

    echo $rdata['patientname'].'<br/>'.$rdata['Lower_Occlusal_Plane_NA'].'<br/>'.$rdata['Overbite_Overjet_Overbite_ldeal'].'<br/>'.$rdata['Please_enter_full_diagnostics_Crown'].'<br/>'.$rdata['CC'];
?>

<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/models/db/querys.php";
    include_once $_SERVER["DOCUMENT_ROOT"]."/models/Json/json_EncodeDecode.php";

    function Courier_inquiry($serviceid, $patientid)
    {
        $rData = courier_id($serviceid, $patientid);

        $url = 'https://apis.tracker.delivery/carriers/'.$rData[0].'/tracks/'.$rData[2];
//        $url = $url.'?'.http_build_query($params, '', '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $jsonData = decode_json($response);

        $toName = "받는 사람: ".$jsonData['to']['name'];
        $company = "택배사: ".$rData[1].' ('.$jsonData['carrier']['tel'].')';
        $courierinNo = "송장번호: ".$rData[2];
        $fromName = "보낸 사람: ".$jsonData['from']['name'];
//        $fromDate = "보낸날자: ".date('Y-m-d',strtotime($jsonData['from']['time']));
//        $toDate = date('Y-m-d H:i:s',strtotime($jsonData['to']['time']));
//        $state = "배송상태: ".$jsonData['state']['text'];

        $prcount = count($jsonData['progresses']);
        $retuarr = array($toName,$company, $courierinNo,$fromName);
        for($i=0; $i< $prcount; $i =$i+1)
        {
            array_push($retuarr, "배송시간:".date('Y-m-d H:i',strtotime($jsonData['progresses'][$i]['time']))
                ." 현재위치:".$jsonData['progresses'][$i]['location']['name']
                ." 배송상태:".$jsonData['progresses'][$i]['status']['text'].' '.$jsonData['progresses'][$i]['description']);
        }

        return $retuarr;
    }

?>

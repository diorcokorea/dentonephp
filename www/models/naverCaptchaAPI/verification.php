<?php
	$client_id = "Gwc4Tb7QRJ9DfkF8XSGb"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "etHmMhXQ4V";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $code = "1";

function chk_radio_result($key, $value) {
	$client_id = "Gwc4Tb7QRJ9DfkF8XSGb"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "etHmMhXQ4V";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $code = "1";

  // 네이버 음성 캡차
  $url = "https://openapi.naver.com/v1/captcha/skey?code=".$code."&key=".$key."&value=".$value;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    $var  = json_decode($response,true);

 if($var["result"] === TRUE) {
	 $result = "true";
	 return $result;
	 } else {
		 $result = "false";
		 return $result;
		 }

  } else {
    //echo "Error 내용:".$response;
	return $response;
  }
}

function chk_image_result($key, $value) {
$client_id = "Gwc4Tb7QRJ9DfkF8XSGb"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "etHmMhXQ4V";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $code = "1";
  // 네이버 이미지 캡차
  $url = "https://openapi.naver.com/v1/captcha/nkey?code=".$code."&key=".$key."&value=".$value;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 // echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
   $var  = json_decode($response,true);

 if($var["result"] === TRUE) {
	 $result = "true";
	 return $result;
	 } else {
		 $result = "false";
		 return $result;
		 }

  } else {
    //echo "Error 내용:".$response;
	return $response;
  }
}

?>

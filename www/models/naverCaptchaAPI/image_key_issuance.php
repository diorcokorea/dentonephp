<?php
  // 네이버 이미지 캡차 Open API 예제 - 키 발급
  $client_id = "Gwc4Tb7QRJ9DfkF8XSGb"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "etHmMhXQ4V";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $code = "0";
  $url = "https://openapi.naver.com/v1/captcha/nkey?code=".$code;
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
  $response = curl_exec($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
	   //key 발급 성공 
	$key  = json_decode($response,true);
	
	//발급받은 key로 이미지 요청
	$url = "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=".$key['key'];
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
  $response = curl_exec($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."<br>";
  curl_close ($ch);

	// 이미지 발급 성공
  if($status_code == 200) {
    //echo $response;
    $fp = fopen("captcha.jpg", "w+");
    fwrite($fp, $response);
    fclose($fp);
	$image_key = $key['key'];

	} else { echo "Error 내용:".$response; }
  } else { echo "Error 내용:".$response; }
?>
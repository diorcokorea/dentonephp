<?php 
$image_key = $_POST['image_key'];
$radio_key = $_POST['radio_key'];

$client_id = $_POST['client_id'];
  $client_secret = $_POST['client_secret'];
$result = $_POST['result'];

		if ($image_key != null){ $image_key_result = true; }
		else { $image_key_result = false; }

		if ($radio_key != null){ $radio_key_result = true; }
		else { $radio_key_result = false; }

		?>

<!DOCTYPE html> 
<html lang="ko">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>sample page</title> 
<script type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" charset="utf-8">

function radio_form_submit() {
	 document.radio_form.action="./radio_key_issuance.php"
document.radio_form.submit();
}

function image_form_submit() {
	 document.image_form.action="./image_key_issuance.php"
document.image_form.submit();
}

    </script>

</head>

<body> 

<center> <h3> NAVER API TEST Page</h3> </center>

 
<?php
if($image_key_result){
  $url = "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=".$image_key;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    //echo $response;
    $fp = fopen("captcha.jpg", "w+");
    fwrite($fp, $response);
    fclose($fp);
    echo "<img  src='captcha.jpg'>";
?>
	<button value="새로고침" onClick="window.location.reload()">새로고침</button>
	<form name="radio_form" method="post" action="./radio_key_issuance.php">
<input type="button" onclick="radio_form_submit();" value="음성으로 듣기"> 
</form>

<form name="result" method="post" action="./verification.php">
<input type="hidden" name="key" id="key" value=<? echo  $image_key ?>> 
<input type="text" name="value" id="value" value="">
<input type="submit">
</form>


<?
  } else { echo "Error 내용:".$response;}

  } else if($radio_key_result){
  
 // 네이버 음성 캡차 Open API 예제 - 음성 다운로드
  $url = "https://openapi.naver.com/v1/captcha/scaptcha?key=".$radio_key;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    //echo $response;
    $fp = fopen("captcha.wav", "w+");
    fwrite($fp, $response);
    fclose($fp);
    echo "<audio src='captcha.wav' controls autoplay loop ></audio>";

?>
	<button value="새로고침" onClick="window.location.reload()">새로고침</button>
	<form name="image_form" method="post" action="./image_key_issuance.php">
<input type="button" onclick="image_form_submit();" value="이미지로 보기"> 
</form>

<form name="result" method="post" action="./verification.php">
<input type="hidden" name="key" id="key" value=<? echo  $image_key ?>> 
<input type="text" name="value" id="value" value="">
<input type="submit">
</form>


<?



  } else {
    echo "Error 내용:".$response;
  }
  }else{
  ?>
<form method="post" action="./image_key_issuance.php">
<input type="submit" value="테스트"> 
</form>
  <?
  }

  if($result =="true"){
  echo   "<script>alert('성공');</script>";
  }else if($result =="false"){
  echo   "<script>alert('실패');</script>";
  }
?>

</body>
</html>
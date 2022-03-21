<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;


require "./src/PHPMailer.php";

require "./src/SMTP.php";

require "./src/Exception.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/views/inc/head.sub.php";
$returnUrl = DOMAIN;

$mail = new PHPMailer(true);


try {


// 서버세팅


//디버깅 설정을 0 으로 하면 아무런 메시지가 출력되지 않습니다
// 2로 하면 로그 출력됨
    $mail->SMTPDebug = 0; // 디버깅 설정

    $mail->isSMTP(); // SMTP 사용 설정


// 지메일일 경우 smtp.gmail.com, 네이버일 경우 smtp.naver.com


    $mail->Host = "smtp.naver.com";               // 네이버의 smtp 서버

    $mail->SMTPAuth = true;                         // SMTP 인증을 사용함

    $mail->Username = "autolign";    // 메일 계정 (지메일일경우 지메일 계정)

    $mail->Password = "d20141111";                  // 메일 비밀번호

    $mail->SMTPSecure = "ssl";                       // SSL을 사용함

    $mail->Port = 465;                                  // email 보낼때 사용할 포트를 지정


    $mail->CharSet = "utf-8"; // 문자셋 인코딩


// 보내는 메일

    $mail->setFrom("autolign@naver.com", "DentOne");

    session_start();
    $user_name = $_POST['user_mail'];
    $user_mail = $_POST['user_mail'];
    $code = $_POST['code'];
    $type = $_POST['type'];
    $_SESSION["user_mail"] = $user_mail;
    $_SESSION["VerificationCode"] = $code;
// 받는 메일
    $mail->addAddress($user_mail, $user_name);
    if ($type == "find") {
        $returnUrl = DOMAIN . "views/findMemberPassword.php";
    } else {
        $returnUrl = DOMAIN . "views/signup.php";
        //$returnUrl = DOMAIN."viewmodels/verification.php";
    }

//$mail -> addAddress("test2@teacher21.com", "receive02");


// 첨부파일

//$mail -> addAttachment("./test1.zip");

//$mail -> addAttachment("./test2.jpg");


    function my_simple_crypt($string, $action = 'e')
    {
        $secret_key = 'email';
        $secret_iv = 'email';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }


    $encrypted = my_simple_crypt($user_mail, 'e');

// 메일 내용

    $mail->isHTML(true); // HTML 태그 사용 여부

    $mail->Subject = "Dentone Verification";  // 메일 제목

    $mail->Body = "
<div style='padding:30px;width:600px'>
	<div style='border-top:7px solid #07a2e8;border-bottom: 2px solid #d2d2d2;padding:50px 0 80px 0'>
		<img src='" . DOMAIN . "resource/images/page_logo.png' style='width:140px;margin-bottom:20px'>
		<a style='padding:10px 30px;border:1px solid #07a2e8;border-radius: 5px;display:block;font-size:18px;margin:40px auto 0 auto;width: 160px;color: #07a2e8;text-align: center;font-size: 28px;font-weight: 400;' href='" . $returnUrl . "?user=" . $encrypted . "&token=" . $code . "'>Verification</a>
		<p style='margin-top:80px; font-size:21px'>Thank you for joining us.<br>Your email has been verified.</p>
	</div>
</div>
";     // 메일 내용


// Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.

// CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지하여야 한다.

    $mail->SMTPOptions = array(

        "ssl" => array(

            "verify_peer" => false

        , "verify_peer_name" => false

        , "allow_self_signed" => true

        )

    );


// 메일 전송

    $result = $mail->send();

    echo $result;


} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error : ", $mail->ErrorInfo;

}

?>


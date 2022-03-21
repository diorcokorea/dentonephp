<?

// @LUCAS 1.5차 메일 서비스

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once $_SERVER["DOCUMENT_ROOT"] . "/views/inc/common.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/models/phpMailerAPI/src/PHPMailer.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/models/phpMailerAPI/src/SMTP.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/models/phpMailerAPI/src/Exception.php";

function getReturnUrlToLab()
{
    return "http://demolab.dentone.kr";
}

function initMail()
{
    $mail = new PHPMailer(true);

    // 서버세팅
    // 디버깅 설정을 0 으로 하면 아무런 메시지가 출력되지 않습니다
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

    // Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.
    // CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지하여야 한다.
    $mail->SMTPOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    );

    return $mail;
}

function sendEmailWhenOrderSubmitted(
    $receiverName,
    $receiverEmail,
    $labName,
    $clinicName,
    $patientName,
    $submissionDateTime,
    $patientkey,
    $patientServiceKey
)
{
    $returnUrl = DOMAIN;
    $mail = null;

    var_dump("___ mail 1");
    $returnUrlToLab = getReturnUrlToLab();
    var_dump("___ mail 2" . $returnUrlToLab);

    try {
        $mail = initMail();

        var_dump("___ mail 3");
        // 보내는 메일
        $mail->setFrom("autolign@naver.com", "DentOne");
        // 받는 메일
        $mail->addAddress($receiverEmail, $receiverName);
        $mail->isHTML(true); // HTML 태그 사용 여부
        $mail->Subject = "[$clinicName] $patientName has completed the submission of the prescription";  // 메일 제목

        var_dump("___ mail 4");
//         $mail->Body = <<<MAIL
// <div style="padding:30px;width:600px;background-color: white;">
//     <div style="border-top:7px solid #07a2e8;padding: 50px 0 0 0;">
//         <img src="$returnUrl/resource/images/page_logo.png" style="width:140px;margin-bottom:20px">
//         <div style="font-size: 40px;color: #07a2e8;">
//             Hello, $labName
//         </div>
//         <br />
//         <br />
//         <br />
//         <div style="line-height: 30px;">
//             <span style="font-size: 40px;color: #07a2e8;">[$clinicName]&nbsp;$patientName</span>
//             <span style="font-size: 40px;">&nbsp;has completed the submission of the prescription</span>
//         </div>
//         <br />
//         <br />
//         <br />
//         <p style="margin:0; padding-bottom: 40px;font-size:21px;border-bottom:  1px solid lightgrey;">
//             Submission date and time. $submissionDateTime
//             <br />
//             This is a summary submitted by [$clinicName]&nbsp;$patientName.
//         </p>
//         <a 
//             style="text-decoration: none;padding:10px 30px;background-color: #07a2e8;border-radius: 5px;display:block;font-size:18px;margin: 40px auto;width: 260px;color: white;text-align: center;font-size: 21px;font-weight: 400;" 
//             href="$returnUrlToLab/views/patientServiceInfoDelegate.php?patientkey=$patientkey&patientServiceKey=$patientServiceKey"
//         >
//             Prescription summary
//         </a>
        
//     </div>
// </div>        
// MAIL; // 메일 내용


        var_dump("___ mail 5");
        // 메일 전송
        $result = $mail->send();
        echo $result;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error : ", ($mail ? $mail->ErrorInfo : "Unknown Error");
    }
}


?>
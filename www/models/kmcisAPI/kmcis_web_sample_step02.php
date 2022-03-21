<?
// KMC 본인인증 범용서비스 샘플소스 STEP02
// 최종작성일 2013.12.03 
//---------------------------------------------------------------------------------------------------------

	// COM+ 객체 생성
	$enc = new COM("ICERTSecu.SEED") or die ("COM객체 로드 실패"); 
	$hash = new COM("ICERTSecu.SHA2") or die ("COM객체 로드 실패"); 

	//01. 폼의 입력값 변수로 받기
    $cpId       = $_REQUEST['cpId'];        // 회원사ID
    $urlCode    = $_REQUEST['urlCode'];     // URL 코드
    $certNum    = $_REQUEST['certNum'];     // 요청번호 (본인인증 요청시 중복되지 않게 생성해야함. (예-시퀀스번호))
    $date       = $_REQUEST['date'];        // 요청일시
    $certMet    = $_REQUEST['certMet'];     // 본인인증방법
    $name       = $_REQUEST['name'];        // 이용자 성명
    $phoneNo	= $_REQUEST['phoneNo'];		// 이용자 휴대폰번호
    $phoneCorp	= $_REQUEST['phoneCorp'];	// 이용자 이통사
	$birthDay	= $_REQUEST['birthDay'];	// 이용자 생년월일
	$gender		= $_REQUEST['gender'];		// 이용자 성별
    $nation     = $_REQUEST['nation'];      // 내외국인 구분
	$plusInfo   = $_REQUEST['plusInfo'];	// 추가DATA정보
	$tr_url     = $_REQUEST['tr_url'];      // 본인인증 결과수신 POPUP URL
	$extendVar  = "0000000000000000";       // 확장변수

    $name = str_replace(" ", "+", $name) ;  //성명에 space가 들어가는 경우 "+"로 치환하여 암호화 처리

	//03. tr_cert 데이터변수 조합 (서버로 전송할 데이터 "/"로 조합)
	$tr_cert	= $cpId . "/" . $urlCode . "/" . $certNum . "/" . $date . "/" . $certMet . "/" . $birthDay . "/" . $gender . "/" . $name . "/" . $phoneNo . "/" . $phoneCorp . "/" . $nation . "/" . $plusInfo . "/" . $extendVar;

	//04. 1차암호화
	$enc_tr_cert = $enc->IcertSeedEnc($tr_cert);

	//05. 변조검증값 생성
	$enc_tr_cert_hash = $hash->IcertSha256($enc_tr_cert);

	//06. 2차암호화
	$enc_tr_cert = $enc_tr_cert . "/" . $enc_tr_cert_hash . "/" . "0000000000000000";
	$enc_tr_cert = $enc->IcertSeedEnc($enc_tr_cert);
?>

<html>
<head>
<title>본인인증서비스 Sample 화면 (윈도우서버 COM+ 모듈 사용)</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style>
<!--
   body,p,ol,ul,td
   {
	 font-family: 굴림;
	 font-size: 12px;
   }

   a:link { size:9px;color:#000000;text-decoration: none; line-height: 12px}
   a:visited { size:9px;color:#555555;text-decoration: none; line-height: 12px}
   a:hover { color:#ff9900;text-decoration: none; line-height: 12px}

   .style1 {
		color: #6b902a;
		font-weight: bold;
	}
	.style2 {
	    color: #666666
	}
	.style3 {
		color: #3b5d00;
		font-weight: bold;
	}
-->
</style>

<script language=javascript>
<!--
  window.name = "kmcis_web_sample";
  
  var KMCIS_window;

  function openKMCISWindow(){    

    var UserAgent = navigator.userAgent;
  
    /* 모바일 접근 체크*/
    // 모바일일 경우 (변동사항 있을경우 추가 필요)
    if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null) {
      document.reqKMCISForm.target = '';
    } 
		
		// 모바일이 아닐 경우
		else {
      KMCIS_window = window.open('', 'KMCISWindow', 'width=425, height=550, resizable=0, scrollbars=no, status=0, titlebar=0, toolbar=0, left=435, top=250' );
     		
     	if(KMCIS_window == null){
    	  alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
      }
     		
      document.reqKMCISForm.target = 'KMCISWindow';
    }
    
    document.reqKMCISForm.action = 'https://www.kmcert.com/kmcis/web/kmcisReq.jsp';
    document.reqKMCISForm.submit();
  }

//-->
</script>

</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>

<center>
<br><br><br><br><br><br>
<span class="style1">본인인증서비스 요청화면 Sample입니다.</span><br>
<br><br>
<table cellpadding=1 cellspacing=1>
    <tr>
        <td align=center>회원사ID</td>
        <td align=left><? echo $cpId ?></td>
    </tr>
    <tr>
        <td align=center>URL코드</td>
        <td align=left><? echo $urlCode ?></td>
    </tr>
    <tr>
        <td align=center>요청번호</td>
        <td align=left><? echo $certNum ?></td>
    </tr>
    <tr>
        <td align=center>요청일시</td>
        <td align=left><? echo $date ?></td>
    </tr>
    <tr>
        <td align=center>본인인증방법</td>
        <td align=left><? echo $certMet ?></td>
        </td>
    </tr>
    <tr>
        <td align=center>이용자성명</td>
        <td align=left><? echo $name ?></td>
    </tr>
    <tr>
        <td align=center>휴대폰번호</td>
        <td align=left><? echo $phoneNo ?></td>
    </tr>
    <tr>
        <td align=center>이동통신사</td>
        <td align=left><? echo $phoneCorp ?></td>
    </tr>
    <tr>
        <td align=center>생년월일</td>
		<td align=left><? echo $birthDay ?></td>
    </tr>
	<tr>
        <td align=center>이용자성별</td>
        <td align=left><? echo $gender ?></td>
    </tr>
    <tr>
        <td align=center>내외국인</td>
        <td align=left><? echo $nation ?></td>
    </tr>
    <tr>
        <td align=center>추가DATA정보</td>
        <td align=left><? echo $plusInfo ?></td>
        </td>
    </tr>
    <tr>
        <td align=center>&nbsp</td>
        <td align=left>&nbsp</td>
    </tr>
    <tr width=100>
        <td align=center>요청정보(암호화)</td>
        <td align=left>
			<? echo substr($enc_tr_cert,0,50) ?>...
        </td>
    </tr>
    <tr>
        <td align=center>결과수신URL</td>
        <td align=left><? echo $tr_url ?></td>
    </tr>
</table>

<!-- 본인인증서비스 요청 form --------------------------->
<form name="reqKMCISForm" method="post" action="#">
    <input type="hidden" name="tr_cert"     value = "<? echo $enc_tr_cert ?>">
    <input type="hidden" name="tr_url"      value = "<? echo $tr_url ?>">
    <input type="submit" value="본인인증서비스 요청"  onclick= "javascript:openKMCISWindow();">
</form>
<BR>
<BR>
<!--End 본인인증서비스 요청 form ----------------------->

<br>
<br>
  이 Sample화면은 본인인증서비스 요청화면 개발시 참고가 되도록 제공하고 있는 화면입니다.<br>
<br>
</center>
</BODY>
</HTML>
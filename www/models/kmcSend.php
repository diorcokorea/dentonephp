<?php
   // include "./db/querys.php";

/********************************************************
    KMC 본인인증 요청 보내기전 항목 암호화 페이지
********************************************************/


       $enc = new COM("ICERTSecu.SEED") or die ("COM객체 로드 실패");
       $hash = new COM("ICERTSecu.SHA2") or die ("COM객체 로드 실패");
/******************
    요청번호 생성
******************/
        $CurTime = date('YmdHis');
        $RandNo = rand(100000, 999999);
        $reqNum = $CurTime . $RandNo;

        //$reData = comcode_read('KMC001', '', 'Y');
        //$rdataCount = count($reData);

/******************
    필수 값 처리
******************/

        $cpId = '';                // 회원사ID
		$certMet = '';               // 본인인증방법

        for ($i = 0; $i < $rdataCount; $i = $i + 1) {
            if ($reData[$i]['COMCODE'] == "CPID") {
                $cpId = $reData[$i]['TEMP1'];
            } elseif ($reData[$i]['COMCODE'] == "certMet") {
                $certMet = $reData[$i]['TEMP1'];
            }
        }
		$certNum = $reqNum;          // 요청번호 (본인인증 요청시 중복되지 않게 생성해야함. (예-시퀀스번호))
		$date = $CurTime;        // 요청일시
		$urlCode = $_POST['urlCode'];  //요청 URL 코드

/******************
    NULL 가능 값 처리
******************/

       $name;        // 이용자 성명
       $phoneNo;        // 이용자 휴대폰번호
	   $phoneCorp;    // 이용자 이통사
	   $birthDay;    // 이용자 생년월일
       $gender;        // 이용자 성별
       $nation;      // 내외국인 구분
        $plusInfo;// 추가DATA정보
        $extendVar = "0000000000000000";       // 확장변수

/******************
	본인인증 요청값 암호화 처리    
******************/

        $name = str_replace(" ", "+", $name);  //성명에 space가 들어가는 경우 "+"로 치환하여 암호화 처리
        $name = iconv("UTF-8", "EUC-KR", $name);

        //03. tr_cert 데이터변수 조합 (서버로 전송할 데이터 "/"로 조합)
        $tr_cert = $cpId . "/" . $urlCode . "/" . $certNum . "/" . $date . "/" . $certMet . "/" . $birthDay . "/" . $gender . "/" . $name . "/" . $phoneNo . "/" . $phoneCorp . "/" . $nation . "/" . $plusInfo . "/" . $extendVar;

        //04. 1차암호화
        $enc_tr_cert = $enc->IcertSeedEnc($tr_cert);

        //05. 변조검증값 생성
        $enc_tr_cert_hash = $hash->IcertSha256($enc_tr_cert);
        //06. 2차암호화
        $enc_tr_cert = $enc_tr_cert . "/" . $enc_tr_cert_hash . "/" . "0000000000000000";
        $enc_tr_cert = $enc->IcertSeedEnc($enc_tr_cert);

/******************
	html 리턴  
******************/

//$value = array('code'=>$enc_tr_cert, 'tr_url'=>$tr_url); // PHP 배열
echo $enc_tr_cert;

?>

<?php
    $dec = new COM("ICERTSecu.SEED") or die ("COM객체 로드 실패");
    $hash = new COM("ICERTSecu.SHA2") or die ("COM객체 로드 실패");

    // Parameter 수신
    $rec_cert       = $_REQUEST['rec_cert'];
    $cookieCertNum  = $_REQUEST['certNum']; // certNum값을 쿠키 또는 Session을 생성하지 않았을때 certNum 수신처리


    $iv = $cookieCertNum; // certNum값을 쿠키 또는 Session을 생성하지 않았을때 수신한 certNum을 세팅

    // 01.인증결과 1차 복호화
    //$rec_cert  = exec("$ICERTSecu SEED 2 0 $iv $rec_cert ");
    $rec_cert  = $dec->IcertSeedDec($rec_cert);

    // 02.복호화 데이터 Split (rec_cert 1차암호화데이터 / 위변조 검증값 / 암복화확장변수)
    $decStr_Split = explode("/", $rec_cert);

    $encPara  = $decStr_Split[0];		//rec_cert 1차 암호화데이터
    $encMsg   = $decStr_Split[1];		//위변조 검증값


    // 03.인증결과 2차 복호화
    //$rec_cert = $dec->IcertSeedDec($encPara, $iv);
    $rec_cert = $dec->IcertSeedDec($encPara);

    // 04. 복호화 된 결과자료 "/"로 Split 하기
    $decStr_Split = explode("/", $rec_cert);

    $certNum	= $decStr_Split[0];
    $date		= $decStr_Split[1];
    $CI     	= $decStr_Split[2];
    $phoneNo	= $decStr_Split[3];
    $phoneCorp	= $decStr_Split[4];
    $birthDay	= $decStr_Split[5];
    $gender		= $decStr_Split[6];
    $nation		= $decStr_Split[7];
    $name		= $decStr_Split[8];
    $result		= $decStr_Split[9];
    $certMet	= $decStr_Split[10];
    $ip			= $decStr_Split[11];
    $M_name		= $decStr_Split[12];
    $M_birthDay	= $decStr_Split[13];
    $M_Gender	= $decStr_Split[14];
    $M_nation	= $decStr_Split[15];
    $plusInfo	= $decStr_Split[16];
    $DI     	= $decStr_Split[17];
    $name = iconv("EUC-KR", "UTF-8", $name);

    echo $name.'    '.$phoneNo.'    '.$birthDay.'    '.$result;
?>
<?php
    include "../models/db/querys.php";
    $rec_cert = isset($_REQUEST['rec_cert']) ? $_REQUEST['rec_cert'] : '';
    $certNum = isset($_REQUEST['certNum']) ? $_REQUEST['certNum'] : '';
//if(!isset($_SERVER["HTTPS"])){ header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301); exit; }

    $dbData = comcode_read('KMC001', '', 'Y');
    $rdataCount = count($dbData);

    $resulturl = '';
    $relocurl = '';
    for ($i = 0; $i < $rdataCount; $i = $i + 1)
    {
       if ($dbData[$i]['COMCODE'] == "HOSTURL")
       {
           $relocurl = $dbData[$i]['TEMP1'];
       }
       elseif ($dbData[$i]['COMCODE'] == "RETURN02")
       {
           $tr_url = $dbData[$i]['TEMP1'];
       }
    }
    $resulturl = "http://sugarpole.iptime.org:1465/views/signup.php";

?>
<!--<html>-->
<!--<head>-->
<script type="text/javascript">
	var move_page_url = "../views/signup.php";
    // var move_page_url = "http://localhost/src/models/kmcresultreturn.php";

	function end() {
	    // 결과 페이지 경로 셋팅
	    document.kmcis_form.action = move_page_url;

   		var UserAgent = navigator.userAgent;
    	/* 모바일 접근 체크*/
    	// 모바일일 경우 (변동사항 있을경우 추가 필요)
    	if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null) {
		    document.kmcis_form.submit();
	  	}

	  	// 모바일이 아닐 경우
	  	else {
			document.kmcis_form.target = opener.window.name;
		  	//document.kmcis_form.submit();
           "<?php
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
            ?>";
			returnData('<?php echo $name ?>','<?php echo $phoneNo ?>','<?php echo $birthDay ?>','<?php echo $result ?>');
            self.close();
	  	}
	}
	function returnData(name,phoneNo,birthDay,result) {
	var form =	document.kmcis_form;
	document.getElementById("name").value = name;
	document.getElementById("phoneNo").value = phoneNo;
	document.getElementById("birthDay").value = birthDay;
	document.getElementById("result").value = result;
		form.submit();
	}


</script>

</head>
<body onload="javascript:end()">
<form id="kmcis_form" name="kmcis_form" method="post" >
<!-- <input type="hidden"	name="rec_cert"		id="rec_cert"	value="<?php //echo $rec_cert ?>"/>
<input type="hidden"	name="certNum"		id="certNum"	value="<?php //echo $certNum ?>"/>
 -->
<input type="hidden"	name="name"		id="name"	value=""/>
<input type="hidden"	name="phoneNo"		id="phoneNo"	value=""/>
<input type="hidden"	name="birthDay"		id="birthDay"	value=""/>
<input type="hidden"	name="result"		id="result"	value=""/>
</form>
</body>
</html>
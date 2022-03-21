﻿<?
// KMC 본인인증 범용서비스 샘플소스 STEP01
// 최종작성일 2013.12.03 
//---------------------------------------------------------------------------------------------------------

	/************************************************************************************/
	/* - 결과값 복호화를 위해 IV 값을 Random하게 생성함.(반드시 필요함!!)			    */
	/* - input박스 certNum의 value값을  echo $CurTime.$RandNo  형태로 지정				*/
 	/************************************************************************************/
    $CurTime = date('YmdHis');
	$RandNo = rand(100000, 999999);

	//요청 번호 생성
	$reqNum = $CurTime.$RandNo;




?>
<html>
    <head>
        <title>본인인증서비스  테스트  (윈도우서버 COM+ 모듈 사용)</title>
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
    </head>
    <body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>
        <center>
            <br><br><br>
            <span class="style1">본인인증서비스 테스트 (윈도우서버 COM+ 모듈 사용)</span><br>

            <form name="reqForm" method="post" action="http://sugarpole.iptime.org:1465/models/kmcisAPI/kmcis_web_sample_step02.php">
                <table cellpadding=1 cellspacing=1>
                    <tr>
                        <td align=center>회원사ID</td>
                        <td align=left><input type="text" name="cpId" size='41' maxlength ='10' value = "<? echo $cpId ?>"></td>
                    </tr>
                    <tr>
                        <td align=center>URL코드</td>
                        <td align=left><input type="text" name="urlCode" size='41' maxlength ='6' value="<? echo $urlCode ?>"></td> 
                    </tr>
                    <tr>
                        <td align=center>요청번호</td>
                        <td align=left><input type="text" name="certNum" size='41' maxlength ='40' value='<? echo $reqNum ?>'></td>
                    </tr>
                    <tr>
                        <td align=center>요청일시</td>
						<!-- 현재시각 세팅(YYYYMMDDHI24MISS) -->
                        <td align=left><input type="text" name="date" size="41" maxlength ='14' value="<? echo ($CurTime)  ?>"></td>
					</tr>
                    <tr>
                        <td align=center>본인인증방법</td>
                        <td align=left>
                            <select name="certMet" style="width:300">
                                <option value="A">인증방법선택 화면</option>
                                <option value="M">휴대폰인증 화면</option>
                                <option value="C">신용카드인증 화면</option>
                                <option value="P">공인인증서 화면</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align=center>이용자성명</td>
                        <td align=left><input type="text" name="name"  size="41" maxlength ='20' value=""></td>
                    </tr>
                    <tr>
                        <td align=center>휴대폰번호</td>
                        <td align=left>
						  <input type="text" name="phoneNo" id="textfield" style="width:160px;" class="hpinput" maxlength="11"/>
						</td>
                    </tr>
                    <tr>
                        <td align=center>이통사</td>
                        <td align=left><input type="radio" name="phoneCorp" id="radio" value="SKT"> SKT <input type="radio" name="phoneCorp" id="radio" value="KTF"> KT <input type="radio" name="phoneCorp" id="radio" value="LGT"> LG U+ <input type="radio" name="phoneCorp" id="radio" value="SKM"> SKTmvno</td>
                    </tr>
                    <tr>
                        <td align=center>생년월일</td>
                        <td align=left>
						  <input type="text" name="birthDay" id="textfield" style="width:160px;" class="hpinput" maxlength="8"/>
						</td>
                    </tr>
                    <tr>
                        <td align=center>이용자성별</td>
                        <td align=left><input type="radio" name="gender" id="radio" value="0"> 남 <input type="radio" name="gender" id="radio" value="1"> 여</td>
                    </tr>
                    <tr>
                        <td align=center>내외국인</td>
                        <td align=left>
						<select name="nation" id="select" style="width:160px;">
							<option value = "">-선택-</a>
							<option value = "0">내국인</a>
							<option value = "1">외국인</a>
						</select>
						</td>
                    </tr>
                    <tr>
                        <td align=center>추가DATA정보</td>
                        <td align=left><input type="text" name="plusInfo"  size="41" maxlength ='320' value=""></td>
                    </tr>
                    <tr>
                        <td align=center>결과수신URL</td>
                        <td align=left><input type="text" name="tr_url" size="41" value="http://sugarpole.iptime.org:1465/models/kmcisAPI/kmcis_web_sample_step03.php"></td>
                    </tr>
                </table>
                <br><br>
                <input type="submit" value="본인인증 테스트">
            </form>
            <br>
            <br>
            이 Sample화면은 본인인증서비스 테스트를 위해 제공하고 있는 화면입니다.<br>
            <br>
        </center>
    </body>
</html>
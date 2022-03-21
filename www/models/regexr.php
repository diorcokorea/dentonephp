<?php
    #region 아이 정규식 체크
    function id_regexr($data)
    {
        if (!preg_match("/^[a-z0-9-_]{5,20}$/",$data))
        {
            return array(0, "ID 는 5~20자의 영문 소문자, 숫자와 특수기호(_),(-)만 사용 가능합니다.");
        }
        else
        {
            return array(1,"OK");
        }
    }
    #endregion

    #region 비밀 번호 정규식 체크
    function pw_regexr($data)
    {
        $pw = $data;
        $num = preg_match('/[0-9]/u', $pw);
        $eng = preg_match('/[a-z]/u', $pw);
        $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u",$pw);

        if(strlen($pw) < 8 || strlen($pw) > 18)
        {
            return array(0,"비밀번호는 영문, 숫자, 특수문자를 혼합하여 최소 8자리 ~ 최대 18자리 이내로 입력해주세요.");
            exit;
        }

        if(preg_match("/\s/u", $pw) == true)
        {
            return array(0,"비밀번호는 공백없이 입력해주세요.");
            exit;
        }

        if( $num == 0 || $eng == 0 || $spe == 0)
        {
            return array(0,"비밀번호는 영문, 숫자, 특수문자를 혼합하여 입력해주세요.");
            exit;
        }
        return array(1,"OK");
    }
    #endregion

    #region 이메일 정규식 체크
    function email_regexr($data)
    {
        if (!preg_match("/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/", $data))
        {
            return array(0, "잘못된 E-Mail 형식 입니다.");
        }
        else
        {
            return array(1,"OK");
        }
    }
    #endregion

    #region 초성 검사
    function checkhangul($data)
    {
        if (!preg_match("/[^a-zA-Z0-9가-힣]/u",  $data))
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
    #endregion
?>
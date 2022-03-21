<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/models/db/maria_conn.php";
    include_once $_SERVER["DOCUMENT_ROOT"]."/models/regexr.php";
    include_once $_SERVER["DOCUMENT_ROOT"]."/models/modelsVariable_global.php";
    #region API 관련

#region 인증 정보 삭제
 function  verification_d($U_EMAIL,$U_TOKEN)
 {

     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_VERIFICATION_D(?,?)");
     $stmt->bind_param('ss',$U_EMAIL,$U_TOKEN);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     return $result;
 }
 #endregion

#region 인증 내역 확인
    function verification_r($U_EMAIL,$U_TOKEN)
    {
        try
        {

            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_VERIFICATION_R(?,?)");
            $stmt->bind_param('ss', $U_EMAIL,$U_TOKEN);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
       
            $grades = [];
            while($row = $result->fetch_assoc())
            {
                $grades['info'] = $row['info'];

            }
            return $grades;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

 #region 인증 확인 등록 및 인증 요청
 function  verification_cu($U_ID, $U_EMAIL,$U_TOKEN,$U_VALUE)
 {

     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_VERIFICATION_CU(?,?,?,?)");
     $stmt->bind_param('isss',$U_ID,$U_EMAIL,$U_TOKEN,$U_VALUE);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     return $result;
 }
 #endregion


 #region 탭별 환자 알림 카운트
  function patient_tab_count_r($seach, $loginid, $fromdata, $todate, $smsg)
  {
    try {
        $chkhan = '';
        if(checkhangul($smsg) == 1)
        {
            $dCnt = 0;
            $dCnt = mb_strlen($smsg, 'UTF-8');
            for($i = 0 ; $i < $dCnt; $i = $i + 1)
            {
                if($i == 0)
                {
                    $chkhan = iconv_substr( $smsg, $i, 1,'UTF-8');
                }
                else
                {
                    $chkhan = $chkhan.'|'.iconv_substr( $smsg, $i, 1, 'UTF-8');
                }
            }
        }
        else
        {
            $chkhan = $smsg;
        }
        if ($fromdata != null)
        {
            $fromdata = $fromdata.' 00:00:00';
            $todate = $todate.' 23:59:59';
        }
        $conns = initDB();
        $stmt = $conns->prepare("CALL SP_PTABCOUNT_R(?,?,?,?,?)");
        $stmt->bind_param('iisss', $seach, $loginid, $fromdata, $todate, $chkhan);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conns->close();

        while($row = $result->fetch_assoc())
            {
                $rcode = $row['count'];
            }

            return $rcode;

    }
    catch (Exception $e)
    {
        return $e;
    }
  }
  #endregion
  
 #region 주소 수정
 function  address_u($addresid, $COUNTRYID,$ADDNAME,$ADD1,$ADD2,$ADD3,$ADD4,$ZIPOCODE)
 {

     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_DOCTORADDRESS_U(?,?,?,?,?,?,?,?)");
     $stmt->bind_param('iissssss',$addresid,$COUNTRYID,$ADDNAME,$ADD1,$ADD2,$ADD3,$ADD4,$ZIPOCODE);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     return $result;
 }
 #endregion

 #region 주소 삭제 
 function  address_d( $ADDRESSID)
 {
     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_DOCTORADDRESS_D(?)");
     $stmt->bind_param('i',$ADDRESSID);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     return $result;
 }
 #endregion

 #region 메인주소 등록
 function  main_address_u($user_code, $ADDRESSID)
 {


     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_MAINADDRESS_U(?,?)");
     $stmt->bind_param('ii',$user_code,$ADDRESSID);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     return $result;
 }
 #endregion

 #region 주소 추가
 function  address_c($user_code, $COUNTRYID,$ADDNAME,$ADD1,$ADD2,$ADD3,$ADD4,$ZIPOCODE)
 {


     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_DOCTORADDRESS_C(?,?,?,?,?,?,?,?)");
     $stmt->bind_param('iissssss',$user_code,$COUNTRYID,$ADDNAME,$ADD1,$ADD2,$ADD3,$ADD4,$ZIPOCODE);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     return $result;
 }
 #endregion
  #region 주소 조회
 function address_r($address_id)
 {

     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_DOCTORADDRESS_R(?)");
     $stmt->bind_param('i',$address_id);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     $tmpArray = array();
      while($row = $result->fetch_array())
     {

          array_push($tmpArray,[
             'address_id' => $row['address_id'],
             'created_date' => $row['created_date'],
             'modified_date' => $row['modified_date'],
             'address_name' => $row['address_name'],
             'country_id' => $row['country_id'],
             'address1' => $row['address1'],
             'address2' => $row['address2'],
             'address3' => $row['address3'],
             'address4' => $row['address4'],
             'zip_code' => $row['zip_code'],
             'account_dr_id' => $row['account_dr_id']
         ]);

     }
     return $tmpArray;
 }
 #endregion

 #region 의사 주소리스트 조회
 function address_list_r($user_code, $page)
 {

     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_DOCTORADDRESSLIST_R(?,?)");
     $stmt->bind_param('ii',$user_code,$page);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     $tmpArray = array();
      while($row = $result->fetch_array())
     {

          array_push($tmpArray,[
             'address_id' => $row['address_id'],
             'created_date' => $row['created_date'],
             'modified_date' => $row['modified_date'],
             'address_name' => $row['address_name'],
             'country_id' => $row['country_id'],
             'address1' => $row['address1'],
             'address2' => $row['address2'],
             'address3' => $row['address3'],
             'address4' => $row['address4'],
             'zip_code' => $row['zip_code'],
             'account_dr_id' => $row['account_dr_id'],
             'main_address_id' => $row['main_address_id'],
             'total_row_count' => $row['total_row_count']
         ]);

     }
     return $tmpArray;
 }
 #endregion

 #region 임상환경설정 조회
 function clinic_setting_r($user_code)
 {


     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_CLINICSETTING_R(?)");
     $stmt->bind_param('i',$user_code);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     while($row = $result->fetch_array())
     {
           $tmpArray =  $row['clinic_setting'];
     }
     return $tmpArray;
 }
 #endregion

 
 #region 임상환경설정 업데이트
 function clinic_setting_u($user_code, $settings)
 {


     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_CLINICSETTING_U(?,?)");
     $stmt->bind_param('is',$user_code,$settings);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     return $result;
 }
 #endregion

  #region 국가목록 조회
 function countryList()
 {


     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_COUNTRY_R()");
     $stmt->bind_param();
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     $tmpArray = array();
     while($row = $result->fetch_array())
     {
         array_push($tmpArray,[
             'country_id' => $row['country_id'],
             'full_name' => $row['full_name'],
			 'sub_name' => $row['sub_name'],
             'code' => $row['code']
         ]);
     }
     return $tmpArray;
 }
 #endregion




     #region 택배 사 목록 조회
 function labInfoList()
 {


     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_LABINFOLIST_R()");
     $stmt->bind_param();
     $stmt->execute();
     $result = $stmt->get_result(); 
     $stmt->close();
     $conns->close();

     $tmpArray = array();
     while($row = $result->fetch_array())
     {
         array_push($tmpArray,[
             'name' => $row['name'],
             'phone' => $row['phone'],
             'country' => $row['country'],
             'address1' => $row['address1'],
             'address2' => $row['address2'],
             'address3' => $row['address3'],
             'address4' => $row['address4'],
             'zip_code' => $row['zip_code']
         ]);
     }
     return $tmpArray;
 }
 #endregion

  #region 변경제출 메시지 조회
  function submitChangeMessage($serkey, $serhiskey)
  {

      $conns = initDB();
      $stmt = $conns->prepare("CALL SP_SUBMITCHANGEMSG_R(?, ?)");
      $stmt->bind_param('ii', $serkey, $serhiskey);
      $stmt->execute();
      $result = $stmt->get_result();
      $stmt->close();
      $conns->close();

      while($row = $result->fetch_array())
      {
             $comment = $row['comment'];

      }
      return $comment;
  }
  #endregion

 #region 수정요청 메시지 조회
 function request_message($serkey, $serhiskey, $type)
 {

     $conns = initDB();
     $stmt = $conns->prepare("CALL SP_REVISION_REQUEST_R(?,?,?)");
     $stmt->bind_param('iii', $serkey,$serhiskey, $type);
     $stmt->execute();
     $result = $stmt->get_result();
     $stmt->close();
     $conns->close();

     $tmpArray = array();
     while($row = $result->fetch_array())
     {
         array_push($tmpArray,[
             'revision_request_id' => $row['revision_request_id'],
             'created_date' => $row['created_date'],
             'modified_date' =>  $row['modified_date'],
             'comment' => $row['comment'],
             'image_list' => $row['image_list'],
             'service_history_id' => $row['service_history_id'],
             'created_by' => $row['created_by']
         ]);
     }
     return $tmpArray;
 }
 #endregion


    #region 택배

    #region 택배 사 목록 조회
    function courier_list()
    {
        $serviceid = null;
        $patientid = null;
        $couCoun = 'kr';

        $conns = initDB();
        $stmt = $conns->prepare("CALL SP_COURIERLIST_R(?, ?, ?)");
        $stmt->bind_param('iis', $serviceid, $patientid,$couCoun);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conns->close();

        $tmpArray = array();
        while($row = $result->fetch_array())
        {
            array_push($tmpArray,[
                'SEQ' => $row['SEQ'],
                'COURIER_NAME' => $row['COURIER_NAME'],
                'COURIER_ID' =>  $row['COURIER_ID']
            ]);
        }
        return $tmpArray;
    }
    #endregion

    #region 배송 조회
    function courier_id($serviceid, $patientid)
    {
        try
        {
            $couCoun = 'kr';
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_COURIERLIST_R(?, ?, ?)");
            $stmt->bind_param('iis', $serviceid, $patientid, $couCoun);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            if($result->num_rows === 0)
            {
                return 0;
            }
            $tmpArray = array();
            while($row = $result->fetch_assoc())
            {
                
                $couid = $row['COURIER_ID'];
                $counumber = $row['tracking_number'];
                $urlAdress = "https://tracker.delivery/#/".$couid."/".$counumber;
                array_push($tmpArray,[
                    'urlAdress' => $urlAdress,
                    'COURIER_NAME' => $row['COURIER_NAME'],
                    'tracking_number' =>  $row['tracking_number']
                ]);
            }


   
     
            return $tmpArray;
            

            //return Array($couid, $counumber);


        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #region 휴대폰 본인 인증
    function comcode_read($gcode, $ccode, $useyn)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_COMMCODE_R(?, ?, ?)");
            $stmt->bind_param('sss', $gcode, $ccode, $useyn);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            if($result->num_rows === 0)
            {
                return 0;
            }

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                'GROUPCODE' => $row['GROUPCODE'],
                'GROUPNAME' => $row['GROUPNAME'],
                'COMCODE' =>  $row['COMCODE'],
                'CODENAME' =>  $row['CODENAME'],
                'TEMP1' => $row['TEMP1'],
                'TEMP2' => $row['TEMP2'],
                'TEMP3' => $row['TEMP3'],
                'TEMP4' => $row['TEMP4']
                ]);
            }
            return $tmpArray;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #region 의사 페이지
  #region 서비스 등록 작업자 목록 조회
  function serviceWorker_r( $serviceKey)
  {
      try
      {
        $conns = initDB();
        $stmt = $conns->prepare("CALL SP_SERVICEWORKER_R(?)");
        $stmt->bind_param('i', $serviceKey);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conns->close();

        $tmpArray = array();
        while($row = $result->fetch_array())
        {
            array_push($tmpArray,[
                'service_id' => $row['service_id'],
                'info' => $row['info'],
                'manager' =>  $row['manager'],
                'reviewer' => $row['reviewer']
            ]);
        }
          return $tmpArray;
      }
      catch (Exception $e)
      {
          return $e;
      }
  }
  #endregion

 #region 작업자 정보 조회
 function workerinfo_r($worker_key)
 {
     try
     {
       $conns = initDB();
       $stmt = $conns->prepare("CALL SP_WORKERINFO_R(?)");
       $stmt->bind_param('i', $worker_key);
       $stmt->execute();
       $result = $stmt->get_result();
       $stmt->close();
       $conns->close();

       $tmpArray = array();
       while($row = $result->fetch_array())
       {
           array_push($tmpArray,[
               'name' => $row['name'],
               'role' => $row['role'],
               'create_date' =>  $row['create_date'],
               'modified_date' => $row['modified_date'],
               'lab_id' => $row['lab_id']
           ]);
       }
         return $tmpArray;
     }
     catch (Exception $e)
     {
         return $e;
     }
 }
 #endregion

  #region 키값 조회
  function servicekey_r($serviceid)
  {
      try
      {
          $conns = initDB();
          $stmt = $conns->prepare("CALL SP_SERVICEKEY_R( ?)");
          $stmt->bind_param('i', $serviceid);
          $stmt->execute();
          $result = $stmt->get_result();
          $stmt->close();
          $conns->close();

          $tmpArray = array();
          while($row = $result->fetch_array())
          {
              array_push($tmpArray,[
                  'account_lab_id' => $row['account_lab_id'],
                  'patient_id' =>  $row['patient_id'],
                  'account_dr_id' => $row['account_dr_id'],
                  'doctorID' => $row['doctorID']
              ]);
          }
          return $tmpArray;
      }
      catch (Exception $e)
      {
          return $e;
      }
  }
  #endreguon

    #region 회원가입
    function sign_Up (array $params)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_DOCTORACCOUNT_C(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param('issiissssssississssssissssss'
                            , $params['ACCDRID']
                            ,$params['LOGINID']
                            ,$params['LOGINPW']
                            ,$params['PARENTID']
                            ,$params['DOCTORID']
                            ,$params['DRNAME']
                            ,$params['H_NAME']
                            ,$params['PHONE']
                            ,$params['MOBILE']
                            ,$params['EMAIL']
                            ,$params['LICENSENUM']
                            ,$params['COUNTRYID']
                            ,$params['STNAME']
                            ,$params['ROLE']
                            ,$params['ADDRID']
                            ,$params['ADDNAME']
                            ,$params['ADD1']
                            ,$params['ADD2']
                            ,$params['ADD3']
                            ,$params['ADD4']
                            ,$params['ZIPOCODE']
                            ,$params['STAFFID']
                            ,$params['SETTING']
                            ,$params['CLINICSETTING']
                            ,$params['TOSYN']
                            ,$params['PERSONAL']
                            ,$params['MARKETING']
                            ,$params['THIRDPERSON']);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $rcode = $row['rcode'];
            }
            return $rcode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }

    #endregion

    #region 로그인로그아웃

    function login_Pro($uid, $upw, $lip, $gubun)
    {
        try
        {
            $logintype = 1;
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_LOGINCHECK_R(?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssi', $uid, $upw, $lip, $gubun, $logintype);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            if($result->num_rows === 0)
            {
                return array('','','');
            }
            while($row = $result->fetch_assoc())
            {
                $raccdrid = $row['account_dr_id'];
                $rid = $row['login_id'];
                $rname = $row['user_name'];
                $rrol = $row['role'];
                $rtMsg = $row['rMsg'];
            }
            return [$raccdrid, $rid, $rname, $rrol, $rtMsg];
        }
        catch (Exception $e)
        {
            return $e;
        }
    }

    #endregion

    #region 회원 정보 수정
    // @LUCAS 알림받기 On/Off 및 접수값 추가
    // ALTER TABLE tb_doctor ADD COLUMN email_notification VARCHAR(255) DEFAULT 'On';
    // ALTER TABLE tb_doctor ADD COLUMN is_submit_checked INT DEFAULT 0;
    function user_update($user_code, $address_code, $hospital_name, $user_name, $tel_number, $mobile_number, $email_notification, $is_submit_checked)
    {
        try 
        {
            $conns = initDB();
            // @LUCAS SP_DOCTORACCOUNT_U 프로시져를 변경함. 2022-01-04
            $stmt = $conns->prepare("CALL SP_DOCTORACCOUNT_U(?,?,?,?,?,?,?,?)");

            $stmt->bind_param('iisssssi', $user_code, $address_code, $hospital_name,$user_name, $tel_number, $mobile_number, $email_notification, $is_submit_checked);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $rcode = $row['rcode'];
            }
            return $rcode;
    }
    catch (Exception $e)
    {
        return $e;
    }
}
#endregion

    #region 회원 정보 불러오기
    function user_info($uid)
    {
        try
        {

            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_MUMBERINFO_R(?)");
            $stmt->bind_param('s', $uid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
       
            $grades = [];
            while($row = $result->fetch_assoc())
            {
                $grades['name'] = $row['name'];
                $grades['hospital_name'] = $row['hospital_name'];
                $grades['ACCINDEX'] = $row['ACCINDEX'];
                $grades['login_id'] = $row['login_id'];
                $grades['zip_code'] = $row['zip_code'];
                $grades['address_name'] = $row['address_name'];
                $grades['address1'] = $row['address1'];
                $grades['address2'] = $row['address2'];
                $grades['address3'] = $row['address3'];
                $grades['address4'] = $row['address4'];
                $grades['LastChangDate'] = $row['LastChangDate'];
                $grades['email'] = $row['email'];
                $grades['phone'] = $row['phone'];
                $grades['mobile'] = $row['mobile'];
                $grades['license_number'] = $row['license_number'];
                $grades['address_id'] = $row['address_id'];
                $grades['index'] = $row['index'];
                $grades['email_notification'] = $row['email_notification'];
                $grades['is_submit_checked'] = $row['is_submit_checked'];
               // var_dump($grades);
            }
            return $grades;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 아이디 찾기
    function id_check($chid)
    {
        try
        {
            $logintyp = 1;
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_IDCHECK_R(?, ?)");
            $stmt->bind_param('si', $chid, $logintyp);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            if($result->num_rows === 0)
            {
                return array(0, "조회된 데이터가 없습니다.",'');
            }
            while($row = $result->fetch_assoc()) {
                $uid = $row['login_id'];
                $cdate = $row['created_date'];
                $chkmsg = $row['IDCHECKMSG'];
            }

            if($chkmsg == 1)
            {
                return array(1,$uid, $cdate);
            }
            else
            {
                return array(0,$uid,$cdate);
            }
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 비밀 번호 확인
    function pw_check($chid,$chpw)
    {
        try
        {
            $logintyp = 1;
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_PASSWORDCHECK_R(?, ?, ?)");
            $stmt->bind_param('ssi', $chid, $chpw, $logintyp);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            while($row = $result->fetch_assoc())
            {
                $chkmsg = $row['PWCHECKMSG'];
            }

            if($chkmsg == 1)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 비밀 번호 변경
    function pw_change ($id, $pw)
    {
        try
        {
            $logintyp = 1;
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_ACCOUNT_U(?, ?, ?)");

            $stmt->bind_param('ssi', $id,$pw, $logintyp);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc()) {
                $rcode = $row['rcode'];
            }
            return $rcode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion


    #region 카테고리별 환자 카운트
  function patient_count_r($seach, $loginid, $fromdata, $todate, $smsg)
  {
    try {
        $chkhan = '';
        if(checkhangul($smsg) == 1)
        {
            $dCnt = 0;
            $dCnt = mb_strlen($smsg, 'UTF-8');
            for($i = 0 ; $i < $dCnt; $i = $i + 1)
            {
                if($i == 0)
                {
                    $chkhan = iconv_substr( $smsg, $i, 1,'UTF-8');
                }
                else
                {
                    $chkhan = $chkhan.'|'.iconv_substr( $smsg, $i, 1, 'UTF-8');
                }
            }
        }
        else
        {
            $chkhan = $smsg;
        }
        if ($fromdata != null)
        {
            $fromdata = $fromdata.' 00:00:00';
            $todate = $todate.' 23:59:59';
        }
        $conns = initDB();
        $stmt = $conns->prepare("CALL SP_PCOUNT_R(?,?,?,?,?)");
        $stmt->bind_param('iisss', $seach, $loginid, $fromdata, $todate, $chkhan);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conns->close();

        //while($row = $result->fetch_assoc())
        if($result){
        while($row=mysqli_fetch_assoc( $result ))
            {
                $rcode = $row['count'];
            }
        }
            return $rcode;

    }
    catch (Exception $e)
    {
        return $e;
    }
  }
  #endregion

    #region 본인 인증
    function user_check($chname,$chmail,$chmobile,$chgubun)
    {
        try {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_USERINFOCHECK_R(?,?,?,?)");
            $stmt->bind_param('ssss', $chname, $chmail,$chmobile,$chgubun);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            while ($row = $result->fetch_assoc())
            {
                $chkmsg = $row['rcode'];
                $loginID = $row['login_id'];
                $createDate = $row['created_date'];
            }

            return array($chkmsg, $loginID, $createDate);
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 환자 정보

    #region 환자 정보 수정 저장
    function patient_cu($id, $name, $gender, $birthdy, $raceid, $pid, $loginid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_PATIENT_CU(?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssiii', $id, $name,$gender, $birthdy, $raceid, $pid,$loginid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $rcode = $row['rcode'];
            }

            return $rcode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion


  #region 카테고리별 환자 카운트
  function patient_count($id, $name, $gender, $birthdy, $raceid, $pid, $loginid)
  {
      try
      {
          $conns = initDB();
          $stmt = $conns->prepare("CALL SP_PATIENT_CU(?,?,?,?,?,?,?)");
          $stmt->bind_param('ssssiii', $id, $name,$gender, $birthdy, $raceid, $pid,$loginid);
          $stmt->execute();
          $result = $stmt->get_result();
          $stmt->close();
          $conns->close();
          while($row = $result->fetch_assoc())
          {
              $rcode = $row['rcode'];
          }

          return $rcode;
      }
      catch (Exception $e)
      {
          return $e;
      }
  }
  #endregion


    #region 환자 정보 조회
    function patient_r($id)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_PATIENT_R(?)");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            if($result->num_rows == 0)
            {
                return array('', '','','','','','','','',"");
            }

            while($row = $result->fetch_assoc())
            {
                $dbid = $row['id'];
                $dbname = $row['name'];
                $dbgender = $row['gender'];
                $dbgendername = $row['GENDERNAME'];
                $dbbirthday = $row['birthday'];
                $dbraceid = $row['race_id'];
                $dbracename = $row['RACENAME'];
                $dbaccdrid = $row['account_dr_id'];
                $hospital_name = $row['hospital_name'];
                $dbloginid = $row['LOGIN_ID'];
                $account_lab_id = $row['account_lab_id'];
                $LABNAME = $row['LABNAME'];
                $Age = $row['AGE'];
                $status_id = $row['status_id'];
                $memo = $row['memo'];
            }

            return array($dbid, $dbname, $dbgender, $dbgendername, $dbbirthday, $dbraceid, $dbracename, $dbaccdrid, $hospital_name, $dbloginid, $account_lab_id, $LABNAME,$Age, $status_id, $memo);
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 환자 목록 수량 및 페이지
    function  patientlist_count($loginid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_PATIENTCOUNT_R(?)");
            $stmt->bind_param('i', $loginid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'rgubun' => $row['rgubun'],
                    'rtotalCount' => $row['rtotalCount'],
                    'rpagecount' =>  $row['rpagecount']
                ]);
            }
            return $tmpArray;

        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 환자 목록 조회
    function patientlist_r($seach, $pageno, $sortcol, $descasc, $loginid, $fromdata, $todate, $smsg)
    {
        try {
            $chkhan = '';
            if(checkhangul($smsg) == 1)
            {
                $dCnt = 0;
                $dCnt = mb_strlen($smsg, 'UTF-8');
                for($i = 0 ; $i < $dCnt; $i = $i + 1)
                {
                    if($i == 0)
                    {
                        $chkhan = iconv_substr( $smsg, $i, 1,'UTF-8');
                    }
                    else
                    {
                        $chkhan = $chkhan.'|'.iconv_substr( $smsg, $i, 1, 'UTF-8');
                    }
                }
            }
            else
            {
                $chkhan = $smsg;
            }
            if ($fromdata != null)
            {
                $fromdata = $fromdata.' 00:00:00';
                $todate = $todate.' 23:59:59';
            }
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_PLIST_R(?,?,?,?,?,?,?,?)");
            $stmt->bind_param('iiisisss', $seach, $pageno,$sortcol,$descasc, $loginid, $fromdata, $todate, $chkhan);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
           if($result){
            while($row=mysqli_fetch_array( $result,MYSQLI_ASSOC))
            {
                if( $row['file_path'] == null){
                    
                    if ($row['gender'] == "male") {
                        $row['file_path'] = "resource/images/male_icon.png";
                    }else{
                        $row['file_path'] = "resource/images/female_icon.png";
                    }
                }
                array_push($tmpArray,[
                    'patientkey' => $row['patientkey'],
                    'patientname' => $row['patientname'],
                    'patientid' => $row['patientid'],
                    'servicetype' =>  $row['servicetype'],
                    'startDate' =>  $row['startDate'],
                    'lastEditDate' => $row['lastEditDate'],
                    'Statusid' => $row['Statusid'],
                    'service_id' => $row['service_id'],
					'serviceinfo' => $row['serviceinfo'],
                    // 'DSHCOUNT' => $row['DSHCOUNT'],
                     'service_history_id' => $row['service_history_id'],
                    // 'drindex' => $row['drindex'],
                    'account_dr_id' => $row['account_dr_id'],
                    'file_path' => $row['file_path']
                ]);
            }
        }
        else{
echo "search".$seach."pageno". $pageno."sortcol".$sortcol."desasc".$descasc."loginid". $loginid."fromdata". $fromdata."todate". $todate."chkhan". $chkhan."result is empty";
}
            return $tmpArray;

        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #region 환자 프로필 사진

    #region 프로필 사진 등록 수정
    function filepath_cu($sid, $fpath)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_FILEPATH_CU(?,?)");
            $stmt->bind_param('is', $sid, $fpath);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            while ($row = $result->fetch_assoc())
            {
                $rcode = $row['rcode'];
            }

            return $rcode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 프로필 사진 조회
    function filepath_r($pid, $sid)
    {
        try {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_FILEPATH_R(?,?)");
            $stmt->bind_param('ii', $pid, $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                $tmpArray = array('patient_id' => $row['patient_id'],
                                    'service_id' => $row['service_id'],
                                    'file_path' => $row['file_path']);
            }
            return $tmpArray;

        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #region 서비스

    #region 브라켓

    #region 브라켓 회사 제품 저장 수정
    function bracket_cu($P_BRACKETID, $P_CODE, $P_NAME, $P_PATH)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_BRACKET_CU(?, ?, ?, ?)");
            $stmt->bind_param('isss'
                            , $P_BRACKETID
                            , $P_CODE
                            , $P_NAME
                            , $P_PATH);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            while ($row = $result->fetch_assoc())
            {
                $rcode = $row['D_BARCKKEY'];
            }

            return $rcode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 회사 불러 오기
    function bracket_r()
    {
        $companykey = '';
        $gubun = 'C';
        $BUL = '';

        try {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_BRACKET_R(?,?,?)");
            $stmt->bind_param('sss', $companykey, $gubun, $BUL);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'bracket_id' => $row['bracket_id'],
                    'code' => $row['code'],
                    'B_NAME' =>  $row['B_NAME'],
                    'path' => $row['path']
                ]);
            }
            return $tmpArray;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 브라켓 제품 불러 오기
    function bracketJson_r($pcode, $uplow)
    {
        $gubun = 'B';
        try {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_BRACKET_R(?,?,?)");
            $stmt->bind_param('sss', $pcode, $gubun, $uplow);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'bracket_id' => $row['bracket_id'],
                    'code' => $row['code'],
                    'B_NAME' =>  $row['B_NAME'],
                    'path' => $row['path']
                ]);
            }
            $jdata = Array("Bracket" => $tmpArray);
            $jsonstr = json_encode($jdata);
            //echo $jsonstr;
            return $jsonstr;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 브라켓 번호 조회
    function bracketNO_r($bracket,$ulgubun)
    {
        try {
            $bracket = substr($bracket,0,7);
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_BRACKETNUMBER_R(?,?)");
            $stmt->bind_param('ss', $bracket, $ulgubun);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'bracketNo' => $row['bracketNo'],
                ]);
            }
            $jdata = Array("Bracket_Number" => $tmpArray);
            $jsonstr = json_encode($jdata);
            //echo $jsonstr;
            return $jsonstr;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #region 서비스 저장
    function service_c($pid, $stype, $status, $autonum, $labid, $tnum, $sinfo, $tid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_SERVICE_C(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('iiiiissi', $pid, $stype,$status, $autonum, $labid, $tnum, $sinfo, $tid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $serviceid = $row['D_SERVICEID'];
            }
            return $serviceid;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 서비스 수정
    function service_u($sid, $sinfoid, $status, $autonum, $labid, $tnum,  $sinfo, $tid, $gubun)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_SERVICE_U(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('iiiiissis', $sid, $sinfoid, $status, $autonum, $labid, $tnum, $sinfo, $tid, $gubun);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $serviceid = $row['SERVICEID'];
            }

            return $serviceid;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 서비스 조회
    function service_r($pid, $sid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_SERVICE_R(?,?)");
            $stmt->bind_param('ii', $pid, $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {

                $service_id = $row['service_id'];
                $service_history_id = $row['service_history_id'];
                $patient_id = $row['patient_id'];
                $patientname = $row['patientname'];
                $service_type_id = $row['service_type_id'];
                $service_typename = $row['service_typename'];
                $status_id = $row['status_id'];
                $statusname = $row['statusname'];
                $auto_save = $row['auto_save'];
                $tracking_number = $row['tracking_number'];
                $typeid = $row['type_id'];
                $created_by = $row['created_by'];
                $info = $row['info'];
                 $created_date = $row['created_date'];
            }

            return array($service_id, $service_history_id, $patient_id, $patientname, $service_type_id
            , $service_typename, $status_id, $statusname, $auto_save, $tracking_number, $typeid, $created_by, $info,$created_date);

        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 서비스 히스토리 저장
    function sevicehistory_c($type, $drkey, $serviceid, $status)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_SERVICEHISTORY_C(?,?,?,?)");
            $stmt->bind_param('iiii', $type, $drkey,$serviceid, $status);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $historycode = $row['D_SERVICEHISTORY'];
            }

            return $historycode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 서비스 히스토리 조회
    function sevicehistory_r($pid, $did, $sid)
    {
        try
        {
            $conns = initDB();
            // @LUCAS 1.5 SP_SERVICEHISTORY_R 에 is_manual 추가
            // @LUCAS 1.5 SP_SERVICEHISTORY_R 에 status_id 22 추가
            $stmt = $conns->prepare("CALL SP_SERVICEHISTORY_R(?,?,?)");
            $stmt->bind_param('iii', $pid, $did, $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            $tmpArray = array();

            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'service_history_id' => $row['service_history_id'],
                    'sdate' => $row['sdate'],
                    'type_id' => $row['type_id'],
                    'created_by' => $row['created_by'],
                    'service_id' => $row['service_id'],
                    'status_id' => $row['status_id'],
                    'name' => $row['name'],
                    'patient_id' => $row['patient_id'],
                    'full_name' => $row['full_name'],
                    'person' => $row['person'],
                    'account_lab_id' => $row['account_lab_id'],
                    'Adminname' => $row['Adminname'],
                    'parent_id' => $row['parent_id'],
                    'file_path' => $row['file_path'],
                    'is_manual' => $row['is_manual']
                ]);
            }
            return $tmpArray;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 서비스 정보 저장
    function serviceinfo_c($serkey, $serhKey, $sinfojson)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_SERVICEINFO_C(?,?,?)");
            $stmt->bind_param('iis', $serkey, $serhKey, $sinfojson);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $infocode = $row['SERVICEINFOID'];
            }

            return $infocode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 코멘트 저장 수정
    function comment_cu($cid, $sid, $tid, $cby, $comment)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_COMMENT_CU(?,?,?,?,?)");
            $stmt->bind_param('iiiis', $cid, $sid,$tid, $cby, $comment);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $returncode = $row['rcode'];
            }

            return Array($returncode);
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 코멘트 조회
    function comment_r($sid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_COMMENT_R(?)");
            $stmt->bind_param('i', $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'comment_id' => $row['comment_id'],
                    'commentDate' => $row['commentDate'],
                    'service_id' =>  $row['service_id'],
                    'type_id' =>  $row['type_id'],
                    'table_name' => $row['table_name'],
                    'created_by' => $row['created_by'],
                    'created_name' => $row['created_name'],
                    'content' => $row['content']
                ]);
            }
            return $tmpArray;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

   

      #region 알람 조회
      function alarm_r($reciverid)
      {
          try
          {
              $typeid = 1; // 의사 1
              $conns = initDB();

              // @LUCAS 2.5 알람에서 status_id가 필요해서 프로시져에 추가함.
              $stmt = $conns->prepare("CALL SP_ALARM_R(?, ?)");
              $stmt->bind_param('ii', $typeid, $reciverid);
              $stmt->execute();
              $result = $stmt->get_result();
              $stmt->close();
              $conns->close();
  
              $tmpArray = array();
              while($row = $result->fetch_array())
              {
                  array_push($tmpArray,[
                      'alarm_id' => $row['alarm_id'],
                      'service_id' =>  $row['service_id'],
                      'status_id' =>  $row['status_id'],
                      'TIME_STAMP' => $row['TIME_STAMP'],
                      'full_name' => $row['full_name'],
                      'patient_name' => $row['patient_name']
                  ]);
              }
              return $tmpArray;
          }
          catch (Exception $e)
          {
              return $e;
          }
      }
      #endreguon

    #region 알람 삭제
    function alarm_d($serviceid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_ALARM_D(?)");
            $stmt->bind_param('i', $serviceid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $returncode = $row['rcode'];
            }

            return $returncode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 알람 저장
    function alarm_c($sender, $serviceid, $status)
    {
        try
        {
            $islab = 0;
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_ARM_C( ?, ?, ?, ?)");
            $stmt->bind_param('iiii',  $sender, $serviceid, $status, $islab);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            

            return $result;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 메모 UPDate
    function memo_u($sid, $pid, $memo)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_MEMO_U(?, ?, ?)");
            $stmt->bind_param('iis',  $sid, $pid, $memo);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $rcode = $row['rcode'];
            }

            return Array($rcode);
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #region Report

    #region 리포트 용 조회
    function REPORT_R($pid, $sid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_REPORT_R(?,?)");
            $stmt->bind_param('ii', $pid,$sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
               $tmpArray = array('service_type' => $row['service_type'],
                    'DOCTORNAME' => $row['DOCTORNAME'],
                    'patientid' =>  $row['patientid'],
                    'patientname' =>  $row['patientname'],
                    'GENDER' => $row['GENDER'],
                    'birthday' => $row['birthday'],
                    'AGE' => $row['AGE'],
                    'ModelType' => $row['ModelType'],
                    'auto_save' => $row['auto_save'],
                    'info' => $row['info']);
            }
            //echo $tmpArray['info'];
            return $tmpArray;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #endregion

    #region 기공소

    #region 기공소 목록 불러오기
    function plabList_r()
    {
        try
        {
            $keyid = 0;
            $pgubun = 'L';
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_LAB_R(?,?)");
            $stmt->bind_param('is', $keyid, $pgubun);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            $tmpArray = array();
            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'account_lab_id' => $row['account_lab_id'],
                    'name' => $row['name'],
                    'index' =>  $row['index']
                ]);
            }
            return $tmpArray;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 기공소 정보 불러오기
    function labinfo_r($keyid)
    {
        try
        {
            $pgubun = 'A';
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_LAB_R(?,?)");
            $stmt->bind_param('is', $keyid, $pgubun);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            $tmpArray = array();

            while($row = $result->fetch_array())
            {
                array_push($tmpArray,[
                    'account_lab_id' => $row['account_lab_id'],
                    'login_id' => $row['login_id'],
                    'name' =>  $row['name'],
                    'email' =>  $row['email'],
                    'phone' =>  $row['phone'],
                    'zip_code' =>  $row['zip_code'],
                    'address1' =>  $row['address1'],
                    'address2' =>  $row['address2'],
                    'address3' =>  $row['address3'],
                    'address4' =>  $row['address4'],
                    'full_name' =>  $row['full_name'],
					'country' =>  $row['country'],
                    // @LUCAS 1.5차
					'email_notification' =>  $row['email_notification'],
					'is_submit_checked' =>  $row['is_submit_checked']
                ]);
            }
            return $tmpArray;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 기공소 주소
    function labaddress_r($acclabid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_LABADDRESS_R(?)");
            $stmt->bind_param('i', $acclabid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            if($result->num_rows == 0)
            {
                return array('', '','');
            }

            while($row = $result->fetch_assoc())
            {
                $fromname = $row['fromname'];
                $fromaddr = $row['fromaddr'];
                $zip_code = $row['zip_code'];
            }

            return array($fromname,$fromaddr, $zip_code);
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #region 공통

    #region 반려

    #region 반려 메시지 조회
    function returnservice_r($sid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_RETURNSERVICE_R(?)");
            $stmt->bind_param('i', $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();

            while($row = $result->fetch_array())
            {
                $comment = $row['comment'];
            }
            return $comment;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #region 반려 메시지 저장
    function returnservice_c($sid, $tid, $cbyid, $rcomment)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_RETURNSERVICE_C(?,?,?,?)");
            $stmt->bind_param('iiis', $sid,$tid, $cbyid, $rcomment);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $returncode = $row['rcode'];
            }

            return $returncode;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    #endregion

    #endregion

    #endregion

    function patientpid($sid)
    {
        try
        {
            $conns = initDB();
            $stmt = $conns->prepare("CALL SP_SERVICEPATIENTID_R(?)");
            $stmt->bind_param('i', $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conns->close();
            while($row = $result->fetch_assoc())
            {
                $pid = $row['patient_id'];
                $shid = $row['service_history_id'];
            }

            return array($pid, $shid);
        }
        catch (Exception $e)
        {
            return $e;
        }
    }

    # 첫번째 기공소 ID를 가져오는 기능
    # // @LUCAS 1.5차
    function getLabId()
    {
        $query = <<<SQL
                    SELECT account_lab_id 
                    from tb_account_lab
                    where parent_id = 0
                    order by account_lab_id
                    limit 1
SQL;

        try {
            $conn = initDB();
            $stmt = $conn->prepare($query);
    //            $stmt->bind_param();
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            while($row = $result->fetch_assoc())
            {
                $account_lab_id = $row['account_lab_id'];
            }

            return $account_lab_id;

        } catch (Exception $e) {
            return $e;
        } finally {
            $conn->close();
        }
    }


#region Update auto_save of tb_service
function updateAutoSaveOfService(int $serviceId, int $autoSaveInfo)
{
    $query = <<<SQL
UPDATE tb_service
    SET auto_save = ?
WHERE service_id = ? 
SQL;

    try {
        $conn = initDB();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $autoSaveInfo, $serviceId);
        $stmt->execute();
        $stmt->close();

    } catch (Exception $e) {
        return $e;
    } finally {
        $conn->close();
    }
}
?>

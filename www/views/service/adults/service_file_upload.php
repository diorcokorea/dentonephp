<?php
session_start();
include "../../models/db/querys.php";
//ini_set("display_errors", "1");
$prevPage = $_SERVER["HTTP_REFERER"];
$updirPath = $_SESSION['member_code']."/".$_SESSION['patient_key']."/".$_SESSION['service_key']."/".$_SESSION['service_his_key']."/";
$uploaddir = '../../data/'.$updirPath;// 파일 저장 dir 경로  의사ID/환자key/서비스key/ 저장
$uploadFileResults = [];
$uploadResult = "true";

//03 모델 타입선택 페이지
if(strpos($prevPage,'05_modeltype.php') !== false){ 
    if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 5){$_SESSION['progress_num']=5;}}else if(!isset($_SESSION['progress_num'])){  $_SESSION['progress_num'] = 5;}
 
    // 파일 있는지 확인
    if (isset($_FILES['maxilla_image_file'])) {

        //file error checked 
        if ($_FILES['maxilla_image_file']['size'] != 0 && $_FILES['maxilla_image_file']['error'] == 0)
        {   
    
            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."MX/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }

        
            $file = $_FILES['maxilla_image_file']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['maxilla_image_file']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                $_SESSION['maxilla_image'] = "data/".$updirPath."MX/".$_FILES['maxilla_image_file']['name'];
            }else{ array_push($uploadFileResults, "false");}
        }
        }
        // 파일 있는지 확인
        if (isset($_FILES['mandible_image_file'])) {

            //file error checked 
            if ($_FILES['mandible_image_file']['size'] != 0 && $_FILES['mandible_image_file']['error'] == 0)
            {





                //업로드 디렉토리 확인 없으면 생성
                $dirPath = $uploaddir."MD/";
                if(!is_dir($dirPath)){
                    mkdir($dirPath, 0777, true);
                  }

                $file = $_FILES['mandible_image_file']['tmp_name'];
                $filePath = $dirPath . basename($_FILES['mandible_image_file']['name']);
                if(move_uploaded_file($file, $filePath)){
                     array_push($uploadFileResults, "true");
                     $_SESSION['mandible_image'] ="data/".$updirPath."MD/".$_FILES['mandible_image_file']['name'];
                    }else{ array_push($uploadFileResults, "false");}
            }
        }
        
    // 04 사진등록 페이지 
    }else if(strpos($prevPage,'06_photo.php') !== false){ 
        if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 4){$_SESSION['progress_num']=4;}}else if(!isset($_SESSION['progress_num'])){  $_SESSION['progress_num'] = 4;}



    
         // 파일 있는지 확인
    if (isset($_FILES['lateral_image'])) {
      //file error checked 
      if ($_FILES['lateral_image']['size'] != 0 && $_FILES['lateral_image']['error'] == 0)
      {

                   /**********************  로테이트 적용   **************************/
             fileCheck($_FILES['lateral_image']['tmp_name'],$_FILES['lateral_image']['name'], $_POST['lateral_image_rot']);
                    /**********************  로테이트  끝   ***************************/
          //업로드 디렉토리 확인 없으면 생성
          $dirPath = $uploaddir."face/";
          if(!is_dir($dirPath)){
              mkdir($dirPath, 0777, true);
            }
            
            //     $source =  imagecreatefromjpeg($_FILES['lateral_image']['tmp_name']);
            //     $file =  imagerotate($source, $_POST['lateral_image_rot'], 0);
     
            
            $file = $_FILES['lateral_image']['tmp_name'];
          $filePath = $dirPath . basename($_FILES['lateral_image']['name']);
          if(move_uploaded_file($file, $filePath)){
               array_push($uploadFileResults, "true");
               $_SESSION['lateral_photo'] = "data/".$updirPath."face/".$_FILES['lateral_image']['name'];
              }else{ array_push($uploadFileResults, "false");}
      }
        }else if($_SESSION['lateral_photo'] != null && $_POST['lateral_image_rot'] != null){

          fileCheck("../../".$_SESSION['lateral_photo'],$_SESSION['lateral_photo'], $_POST['lateral_image_rot']);
  

        }


          // 파일 있는지 확인
    if (isset($_FILES['frontal_image'])) {
        //file error checked 
        if ($_FILES['frontal_image']['size'] != 0 && $_FILES['frontal_image']['error'] == 0)
        {

              /**********************  로테이트 적용   **************************/
              fileCheck($_FILES['frontal_image']['tmp_name'],$_FILES['frontal_image']['name'], $_POST['frontal_image_rot']);
              /**********************  로테이트  끝   ***************************/



            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."face/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['frontal_image']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['frontal_image']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['front_photo'] = "data/".$updirPath."face/".$_FILES['frontal_image']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if($_SESSION['front_photo'] != null && $_POST['frontal_image_rot'] != 0){

              fileCheck("../../".$_SESSION['front_photo'],$_SESSION['front_photo'], $_POST['frontal_image_rot']);

        }


            // 파일 있는지 확인
    if (isset($_FILES['smile_image'])) {
        //file error checked 
        if ($_FILES['smile_image']['size'] != 0 && $_FILES['smile_image']['error'] == 0)
        {

              /**********************  로테이트 적용   **************************/
              fileCheck($_FILES['smile_image']['tmp_name'],$_FILES['smile_image']['name'], $_POST['smile_image_rot']);
              /**********************  로테이트  끝   ***************************/


            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."face/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['smile_image']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['smile_image']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['smile_photo'] = "data/".$updirPath."face/".$_FILES['smile_image']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['smile_photo']) != null && $_POST['smile_image_rot'] != 0){

              fileCheck("../../".$_SESSION['smile_photo'],$_SESSION['smile_photo'], $_POST['smile_image_rot']);

        }

            // 파일 있는지 확인
    if (isset($_FILES['intraoral_up_image'])) {
        //file error checked 
        if ($_FILES['intraoral_up_image']['size'] != 0 && $_FILES['intraoral_up_image']['error'] == 0)
        {

             /**********************  로테이트 적용   **************************/
             fileCheck($_FILES['intraoral_up_image']['tmp_name'],$_FILES['intraoral_up_image']['name'], $_POST['intraoral_up_image_rot']);
             /**********************  로테이트  끝   ***************************/
     

            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."face/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['intraoral_up_image']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['intraoral_up_image']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['intraoral_upper'] = "data/".$updirPath."face/".$_FILES['intraoral_up_image']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['intraoral_upper']) != null && $_POST['intraoral_up_image_rot'] != 0){

              fileCheck("../../".$_SESSION['intraoral_upper'],$_SESSION['intraoral_upper'], $_POST['intraoral_up_image_rot']);

        }

            // 파일 있는지 확인
    if (isset($_FILES['intraoral_lo_image'])) {
        //file error checked 
        if ($_FILES['intraoral_lo_image']['size'] != 0 && $_FILES['intraoral_lo_image']['error'] == 0)
        {

              /**********************  로테이트 적용   **************************/
              fileCheck($_FILES['intraoral_lo_image']['tmp_name'],$_FILES['intraoral_lo_image']['name'], $_POST['intraoral_lo_image_rot']);
              /**********************  로테이트  끝   ***************************/


            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."face/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['intraoral_lo_image']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['intraoral_lo_image']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['intraoral_lower'] = "data/".$updirPath."face/".$_FILES['intraoral_lo_image']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['intraoral_lower']) != null && $_POST['intraoral_lo_image_rot'] != 0){

              fileCheck("../../".$_SESSION['intraoral_lower'],$_SESSION['intraoral_lower'], $_POST['intraoral_lo_image_rot']);

        }

            // 파일 있는지 확인
    if (isset($_FILES['intraoral_ri_image'])) {
        //file error checked 
        if ($_FILES['intraoral_ri_image']['size'] != 0 && $_FILES['intraoral_ri_image']['error'] == 0)
        {
                          /**********************  로테이트 적용   **************************/
                          fileCheck($_FILES['intraoral_ri_image']['tmp_name'],$_FILES['intraoral_ri_image']['name'], $_POST['intraoral_ri_image_rot']);
                          /**********************  로테이트  끝   ***************************/


            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."face/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['intraoral_ri_image']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['intraoral_ri_image']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['intraoral_right'] = "data/".$updirPath."face/".$_FILES['intraoral_ri_image']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['intraoral_right']) != null && $_POST['intraoral_ri_image_rot'] != 0){

              fileCheck("../../".$_SESSION['intraoral_right'],$_SESSION['intraoral_right'], $_POST['intraoral_ri_image_rot']);

        }

            // 파일 있는지 확인
    if (isset($_FILES['intraoral_le_image'])) {
        //file error checked 
        if ($_FILES['intraoral_le_image']['size'] != 0 && $_FILES['intraoral_le_image']['error'] == 0)
        {

             /**********************  로테이트 적용   **************************/
             fileCheck($_FILES['intraoral_le_image']['tmp_name'],$_FILES['intraoral_le_image']['name'], $_POST['intraoral_le_image_rot']);
             /**********************  로테이트  끝   ***************************/
 


            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."face/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }

            $file = $_FILES['intraoral_le_image']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['intraoral_le_image']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['intraoral_left'] = "data/".$updirPath."face/".$_FILES['intraoral_le_image']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['intraoral_left']) != null && $_POST['intraoral_le_image_rot'] != 0){

              fileCheck("../../".$_SESSION['intraoral_left'],$_SESSION['intraoral_left'], $_POST['intraoral_le_image_rot']);

        }

            // 파일 있는지 확인
    if (isset($_FILES['intraoral_fr_image'])) {
        //file error checked 
        if ($_FILES['intraoral_fr_image']['size'] != 0 && $_FILES['intraoral_fr_image']['error'] == 0)
        {

              /**********************  로테이트 적용   **************************/
              fileCheck($_FILES['intraoral_fr_image']['tmp_name'],$_FILES['intraoral_fr_image']['name'], $_POST['intraoral_fr_image_rot']);
              /**********************  로테이트  끝   ***************************/
 


            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."face/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['intraoral_fr_image']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['intraoral_fr_image']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['intraoral_fornt'] = "data/".$updirPath."face/".$_FILES['intraoral_fr_image']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['intraoral_fornt']) != null && $_POST['intraoral_fr_image_rot'] != 0){

              fileCheck("../../".$_SESSION['intraoral_fornt'],$_SESSION['intraoral_fornt'], $_POST['intraoral_fr_image_rot']);

        }
      






    // 05 방사선 사진등록 페이지 
    }else if(strpos($prevPage,'07_radiograph.php') !== false){ 
        //if(isset($_SESSION['progress_num'])){ if($_SESSION['progress_num']  <= 5){$_SESSION['progress_num']=5;}}else if(!isset($_SESSION['progress_num']))  $_SESSION['progress_num'] = 5;
    
             // 파일 있는지 확인
    if (isset($_FILES['lateral_xray'])) {
        //file error checked 
        if ($_FILES['lateral_xray']['size'] != 0 && $_FILES['lateral_xray']['error'] == 0)
        {

                          /**********************  로테이트 적용   **************************/
                          fileCheck($_FILES['lateral_xray']['tmp_name'],$_FILES['lateral_xray']['name'], $_POST['lateral_xray_rot']);
                          /**********************  로테이트  끝   ***************************/


            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."xray/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['lateral_xray']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['lateral_xray']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['lateral_xray'] = "data/".$updirPath."xray/".$_FILES['lateral_xray']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['lateral_xray']) != null && $_POST['lateral_xray_rot'] != 0){

              fileCheck("../../".$_SESSION['lateral_xray'],$_SESSION['lateral_xray'], $_POST['lateral_xray_rot']);

        }


                  // 파일 있는지 확인
    if (isset($_FILES['panorama'])) {
        //file error checked 
        if ($_FILES['panorama']['size'] != 0 && $_FILES['panorama']['error'] == 0)
        {   
            
             /**********************  로테이트 적용   **************************/
             fileCheck($_FILES['panorama']['tmp_name'],$_FILES['panorama']['name'], $_POST['panorama_rot']);
             /**********************  로테이트  끝   ***************************/

            //업로드 디렉토리 확인 없으면 생성
            $dirPath = $uploaddir."xray/";
            if(!is_dir($dirPath)){
                mkdir($dirPath, 0777, true);
              }
  
            $file = $_FILES['panorama']['tmp_name'];
            $filePath = $dirPath . basename($_FILES['panorama']['name']);
            if(move_uploaded_file($file, $filePath)){
                 array_push($uploadFileResults, "true");
                 $_SESSION['panorama'] = "data/".$updirPath."xray/".$_FILES['panorama']['name'];
                }else{ array_push($uploadFileResults, "false");}
        }
          }else if(isset($_SESSION['panorama']) != null && $_POST['panorama_rot'] != 0){

              fileCheck("../../".$_SESSION['panorama'],$_SESSION['panorama'], $_POST['panorama_rot']);

        }
      



    }



    function fileCheck($filetmpname,$filename, $d){
        $tmp = explode(".",$filename);
        $ext = $tmp[count($tmp)-1];
     $d = -$d;
        switch ($ext) {
            case 'jpg':
            $source = imagecreatefromjpeg($filetmpname);
            $rotate = imagerotate($source, $d, 0);
            imagejpeg($rotate,$filetmpname);
                break;
             case 'jpeg':
                $source =  imagecreatefromjpeg($filetmpname);
                $rotate = imagerotate($source, $d, 0);
                imagejpeg($rotate,$filetmpname);
                break;
             case 'png':
                $source =  imagecreatefrompng($filetmpname);
                $rotate = imagerotate($source, $d, 0);
                imagepng($rotate,$filetmpname); 
                break;
             case 'gif':
                $source =   imagecreatefromgif($filetmpname);
                $rotate = imagerotate($source, $d, 0);
                imagegif($rotate,$filetmpname); 
                break;
             case 'bmp':
                $source =   imagecreatefrombmp($filetmpname);
                $rotate = imagerotate($source, $d, 0);
                imagewbmp($rotate,$filetmpname); 
                break;
    
        }
        return $ext.$d;

    }






//exit;


for ($i=0; $i < count($uploadFileResults); $i++) { 
    if ($uploadFileResults[$i] != "true") {
        $uploadResult = "false";
    }
}
echo $_POST['lateral_image_rot'];

//echo $uploadResult;
//echo print_r( $_SESSION['maxilla_image']);
























?>



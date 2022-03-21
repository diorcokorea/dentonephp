<?php
   session_start();
 $request_uri = $_SERVER['REQUEST_URI'];
 if (isset($_COOKIE['lab_member_id']) || isset($_SESSION[ 'lab_member_id' ])) {
    setCookie('lab_member_id', '', time()-1000, '/');
	  setCookie('lab_member_code', '', time()-1000, '/');
	  setCookie('lab_member_name', '', time()-1000, '/');
    $_SESSION = array();
    if($request_uri == "/"){	echo "<script>location.href = './views/index.php'</script> "; }
 }
 if($request_uri == "/"){	echo "<script>location.href = './views/index.php'</script> "; }
// 쿠키 & 세션에 로그인값 체크
  if( isset($_COOKIE['member_id'])) {
	  $_SESSION['member_id'] = $_COOKIE['member_id'];
	  $_SESSION['member_code'] = $_COOKIE['member_code'];
	  $_SESSION['member_name'] = $_COOKIE['member_name'];
  }else if(!isset($_SESSION[ 'member_id' ] )){
	echo "<script> location.href = 'login.php'</script> ";
  }

  //echo "<script>alert('')</script> ";

$user_code = $_SESSION['member_code'];
$user_name = $_SESSION['member_name'];
$config['cf_title'] = "Dent One";

include_once('inc/head.php');

include_once('../viewmodels/indexList.php');

?>

<div class="modal_calendar">
    <div>
       <? include($_SERVER["DOCUMENT_ROOT"]."/viewmodels/calendar.php");  ?>
    </div>
</div>
<?
include_once('inc/tail.php');
?>


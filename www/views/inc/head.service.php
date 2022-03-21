<?php
// @LUCAS 서비스 페이지의 새로운 헤더
session_start();
$request_uri = $_SERVER['REQUEST_URI'];
if (isset($_COOKIE['lab_member_id']) || isset($_SESSION['lab_member_id'])) {
    setCookie('lab_member_id', '', time() - 1000, '/');
    setCookie('lab_member_code', '', time() - 1000, '/');
    setCookie('lab_member_name', '', time() - 1000, '/');
    $_SESSION = array();
    if ($request_uri == "/") {
        echo "<script>location.href = '../views/index.php'</script> ";
    }
}
if ($request_uri == "/") {
    echo "<script>location.href = '../views/index.php'</script> ";
}
// 쿠키 & 세션에 로그인값 체크
if (isset($_COOKIE['member_id'])) {
    $_SESSION['member_id'] = $_COOKIE['member_id'];
    $_SESSION['member_code'] = $_COOKIE['member_code'];
    $_SESSION['member_name'] = $_COOKIE['member_name'];
} else if (!isset($_SESSION['member_id'])) {
    echo "<script> location.href = 'login.php'</script> ";
}

//echo "<script>alert('')</script> ";
$user_code = $_SESSION['member_code'];
$user_name = $_SESSION['member_name'];
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.php');
?>

<div class="top_banner" style="margin:10px 0px 0px 0px; height:60px;">
    <a class="service_button hover240" href="/views/index.php" style="height:60px;">
        <p style="padding: 2px 30px 0px 30px;">Patient list</p>
        <span><img src="/resource/images/patient_list_icon.png" style="width:55px; padding-top:0px;"></span>
    </a>
</div>

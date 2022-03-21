<?
session_start();
$member_id = $_SESSION['member_id'];
$member_code = $_SESSION['member_code'];
$member_name = $_SESSION['member_name'];
$_SESSION = array();
$_SESSION['member_id'] = $member_id;
$_SESSION['member_code'] = $member_code;
$_SESSION['member_name'] = $member_name;
if($_SESSION['member_id'] != null) echo "true";
?>

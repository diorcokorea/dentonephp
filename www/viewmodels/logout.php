<?
 include_once '../models/db/querys.php';

//logout viewmodel
session_start();
  if(isset($_SESSION['member_id'])) {

$member_id = $_SESSION['member_id'];
$result = "LOGOUT";
$ipaddress = get_client_ip();
$login_info_array = login_Pro($member_id,"",$ipaddress, $result);

	  setCookie('member_id', '', time()-1000, '/');
	  setCookie('member_code', '', time()-1000, '/');
	  setCookie('member_name', '', time()-1000, '/');
      $_SESSION = array();
		session_destroy(); 
		echo "<script>location.href = '../views/login.php'</script>";
  }else{
    $_SESSION = array();
	if(!isset($_SESSION[ 'member_id' ] ))echo "<script>alert('세션값 없음'); location.href = '../views/login.php'</script> ";
  }







function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}



?>

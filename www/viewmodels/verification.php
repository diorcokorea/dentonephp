<?
//sleep(2);
include '../models/db/querys.php';
if(isset($_GET['user']) && $_GET['user'] != ""){
$email =  cs_crypt($_GET['user'],"d");
$code = $_GET['token'];
 verification_cu($code, $email,$_GET['user'],"Y");
 echo"<script>alert('Verification completed');window.close();</script>";
exit;
}


$token = cs_crypt($_POST['token'],"e");
if($_POST['type'] == "F"){
 verification_cu($_POST['code'], $_POST['email'],$token,"N");
		echo "N";
	 exit;
}else if($_POST['type'] == "S"){
	//echo verification_r($_POST['email'],$_POST['token'])['info'];
	if(verification_r($_POST['email'],$token)['info'] == "Y"){
		verification_d($_POST['email'],$token);
	echo "Y";
	}else{
	echo "N";
	}
	exit;
}



function cs_crypt( $string, $action = 'e' ) {
	$secret_key = 'email'; 
	$secret_iv = 'email';
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$key = hash( 'sha256', $secret_key );
	$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	if( $action == 'e' ) {
		$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		} else if( $action == 'd' ){ 
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
			} return $output;
			}
?>
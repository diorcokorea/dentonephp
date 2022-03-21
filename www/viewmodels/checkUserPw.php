<?
 include "../models/db/querys.php";
//include "../models/regexr.php";


$member_pw = $_POST['member_pass'];
$result_array = pw_regexr($member_pw);

foreach($result_array  as $key => $value) {
	if($key == 0 && $value == 1){ echo "true";}else if($key == 0 && $value == 0){ echo "false";}
	}



?>

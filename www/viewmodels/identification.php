<?
$name  = $_POST['name'];
$phoneNo  = $_POST['phoneNo'];
$birthDay  = $_POST['birthDay'];
$result  = $_POST['result'];
echo $name;
echo $phoneNo;
echo $birthDay;
echo $result;

if($name != null && $phoneNo != null && $birthDay != null && $result != null ){
	?>
	<form 
<form name="signup_result_f" id="signup_result_f" method="post" action="../views/signup.php" >
<input type="hidden"  id="user_name" name="user_name"  value="<?echo $name ?>"> 
<input type="hidden"  id="phoneNo" name="phoneNo"  value="<?echo $phoneNo ?>"> 
<input type="hidden"  id="birthDay" name="birthDay"  value="<?echo $birthDay ?>"> 
<input type="hidden"  id="result" name="result"  value="<?echo $result ?>"> 
</form>
<script>document.getElementById('signup_result_f').submit(); </script>
		<?
}
//회원가입 체크
//정보 없으면




//있으면



?>
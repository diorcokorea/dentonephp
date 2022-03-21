<?
$member_id = $_POST['member_id']; 
//$member_id = "test";
if($_POST['certification_suces'] == "true") $certification_suces = true;
if($_POST['change_suces'] ==  "true") $change_suces = true;
if($_POST['not_member'] != null) echo "<script>alert('가입 정보가 없습니다. \n 회원가입 때 인증한 전화번호로 인증 해주세요.');</script>";
if($_POST['failed_mail_send'] != null) $failed_mail_send = true;
//$certification_suces = true;
$config['cf_title'] = "Forgot your password?";
include_once('inc/pop_head.php');


function my_simple_crypt( $string, $action = 'e' ) {
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

            if(isset($_GET['user'])){
$user_mail  = $_GET['user'];
$user_mail = my_simple_crypt( $user_mail, 'd' );
}

if ($user_mail != null  && !$change_suces) {
   $type = 3;
}else if($member_id != null && !$certification_suces && !$change_suces){
    $type = 2;
}else if($member_id == null && !$certification_suces && !$change_suces){
    $type = 1;
}else if($change_suces){
    $type = 4;
}
if($failed_mail_send){
    $type = 5;
}

?>

<div class="content" style="background-color:#fff;height:775px;width:60%;margin:10px auto">
	<div class="find">
		<div class="logo">
				<a alt="<?php echo $config['cf_title']; ?>" href="login.php"><img src="../resource/images/page_logo.png"></a>
		</div>
		<!-- <div class="tab">
			<a href="findMemberId.php"   id=""  value="" onClick="">아이디 찾기</a>
			<a href="#" id="" class="select"  value="" onClick="">비밀번호 찾기</a>
		</div> -->
	<? if($type == 3){ ?> <!-- ################################################### 메일로 들어왔을때  ####################################################-->
		<div class="inner_join" style="padding:24px 80px 0px 80px">
		<div class="title">
			<h4>New Password</h4>
			<p style="margin-top:30px;font-size:16px">Email: <span style="color:#07a2e8"><? echo $user_mail?></span></p>
		</div>
			
		<div style="text-align:center;margin-top:10px;margin-bottom:20px">
		<p style="font-size:16px">Please enter a new password.</p>
		<form name="pw_ch_form" method="post" action="../viewmodels/changePw.php">
        <input  type="hidden" name="member_id" id="member_id" value="<? echo $user_mail?>"  >
			<div id="password_div" style="width:auto;float:left;width:100%;padding-top:10px;margin:0">
				<div class="email_text" style="padding-bottom:20px;float:left;margin:0;overflow:unset">
					<p class="input_title" style="width:160px;float:left">Password</p>
					<div id="member_pw_box" style="position:relative;float:right;height:60px;">
						<div class="form-group" style="width:400px;">
						<input class="form-control-sign_up" type="password" name="member_pass" id="member_pass" placeholder="Password" value=""  onkeyup="checkCapsLock(event)" class="password_input"   oninput="setCustomValidity('')">
						<div class="form-control-sign_up-border"></div>
						</div>
						<p class="pw_check" id="pw_ch_true" style="display:none;color:#07a2e8; font-size: 12px; padding-bottom:14px;">available
                            <p>
                            <p class="pw_check" id="pw_ch_false" style="display:none;color:red; font-size: 12px; padding-bottom:14px;">not available
                            <p>
						<input type="text"  id="check_pass" style="display:none;" value="비밀번호를 입력해주세요." > 
						<p id="pw_chk" style="position:absolute;font-size:11px;color:#07a2e8;bottom:-1px;width:400px;right:0px;">Use 8 or more characters with a mix od letters, numbers & symbols</p>
						<input type="hidden" id="pw_chk_value" name="pw_chk_value" value="">
						<p id="check_caps_lock" class="login_error_text" style="display:none;top:38px;left:70px;z-index:9"><img src="<?= IMAGE ?>/DentOne-Aligner-Caps Lock.png"></p>
					</div>
				</div>
				<div class="email_text" style="padding-bottom:20px;float:left;margin:0;overflow:unset">
					<p class="input_title" style="width:160px">Confirm password</p>
					<div style="position:relative;float:right;height:50px;">
					<div class="form-group" style="width:400px;">
					<input class="form-control-sign_up" type="password" name="member_pass_ch" id="member_pass_ch" placeholder="Confirm password" onkeyup="checkCapsLock1(event)" value=""  class="password_input">
					<div class="form-control-sign_up-border"></div>
					</div>
					<input type="text"  id="ch_check_pass" style="display:none;" value="비밀번호를 재확인 해주세요." oninput="setCustomValidity('')"> 
					<p  id="_pass_false" style="display:none;position:absolute;font-size:11px;color:red;bottom:-12px;width:400px;right:0px;" >Passwords must match.</p> 
					<p  id="_pass_true" style="display:none;position:absolute;font-size:11px;color:#07a2e8;bottom:-12px;width:400px;right:0px;" >Passwords matched.</p> 
					<input type="hidden" id="pw_chk_" name="pw_chk_" value="">
					<p id="check_caps_lock1" class="login_error_text" style="display:none;top: 38px;left:70px;z-index:9"><img src="<?= IMAGE ?>/DentOne-Aligner-Caps Lock.png"></p>
					</div>
				</div>
			</div>
			<div id="login_captcha" style="width:100%;float:left" class="login_captcha">
					<? include('../viewmodels/naverCaptcha.php');?>
					</div>
		</div>
		</div>
			
		
		</div>
<div class="find_next_join" style="position:unset;margin:15px auto 0 auto;transform:none;padding:7px 10px;">
				<input onclick="pw_change();" class="btn_blue hover200" type="button" value="Next">
			</div>
			</form>

	<?}else if($type == 2){ ?><!-- ################################################### 메일전송 후 ####################################################-->

		<div class="inner_join" style="height:494px">
		<div class="title">
			<h4>Forgot your password?</h4>
			<p style="margin:40px 0 30px 0"><img src="../resource/images/password_send.png"></p>
		</div>
		<div style="text-align:center;margin-bottom:50px">
		<h4 style="margin-top:30px">Email verification.</h4>
			<p style="margin-top:30px;font-size:16px">We have sent a verification email to <?=$member_id?>.<br>Please check your mailbox to verify the account.</p>
		</div>
	</div>
	</div>
	<div class="find_next">
	</div>

	 <? }else if($type == 1){ ?> <!-- ################################################### 메일전송전 기본 ####################################################-->

	<div class="inner_join" style="padding:80px 140px 150px 140px">
		<div class="title">
			<h3 style="font-size:21px">Forgot your password?</h3>
			<div style="text-align:left;margin-top:50px">
				<h4 style="font-size:18px">Email verification.</h4>
				<p style="font-size:15px;margin-top:10px">Please enter your email address.</p>
			</div>
		</div>
		<div style="text-align:center;margin-top:40px;margin-bottom:50px">
			<form name="find_pw_form_mail" method="post" onsubmit="return false;">		
			<p style="float:left;padding-top:13px">Email</p>
			<div class="form-group" style="width:400px; margin:0px; float:right;">
				<input class="form-control-sign_up" type="text" name="member_id" id="member_id"  value="" required oninvalid="this.setCustomValidity('Please enter Email.')" oninput="setCustomValidity('')"  >
				<div class="form-control-sign_up-border"></div>
			</div>
		</div>
	</div>
	</div>
	<div class="find_next" style="padding: 7px 10px;">
		<button type="button" class="btn_blue hover200" id="find_pw_id" value="" onClick="findPw();">Send</button>
		</form>
        <form name="falied_form"  method="post">
            <input type="hidden" name="failed_mail_send" value="true">
        </form>

	</div>

<? }else if($type == 4){ ?><!-- ################################################### 비밀번호 변경 완료 ####################################################-->

	<div class="inner_join">
	<div class="title">
			<h4>New Password</h4>
			<p style="margin:40px 0 30px 0"><img src="../resource/images/password_result.png"></p>
		</div>
<p style="color:#07a2e8;font-size:16px;margin:40px 0;text-align:center">Your new password has been registered.</p>
</div>
</div>
	<div class="find_next_join">
		<button type="button" onclick="location.href='login.php';" class="btn_blue hover200">Sign in</button>
		</form>
	</div>
<? }else if($type == 5){?><!-- ################################################### 메일 전송 실패 ####################################################-->
		<div class="inner_join" style="padding:80px 140px 95px 140px;height:494px">
		<div class="title" style="padding-bottom:0px">
			<h3 style="font-size:21px">Forgot your password?</h3>
			<div style="text-align:center;margin-top:50px;">
				<p style="margin:40px 0 30px 0"><img src="../resource/images/forgot_password.png"></p>
			</div>
		</div>
		<div style="margin-top:20px;text-align:center">
			<h4 style="font-size:18px;">Email verification failed.</h4>
			<p style="font-size:15px;margin-top:30px">The email address provided is not registered.</p>
		</div>
	</div>	
	</div>
	<div class="find_next" style="padding:7px 10px; margin:30px 10px 0 10px;">
		<button type="button" class="btn_black hover200" style="background-color:#4b4b4b" id="find_pw_id" value="" onClick="history.back()">Back</button>
	</div>
	




<? } ?>

</div>
</div>
	</div>
</div>

<script>
//비밀번호 정규식 체크
$(document).ready(function(){
 $('#member_pass').keyup(function(){
  $.ajax({
   url: '../viewmodels/checkUserPw.php',
   type: 'POST',
   data: {'member_pass':$('#member_pass').val()},
   dataType: 'html',
   success: function(data){
    if(data == "true"){
	$("#pw_chk_value").val('true');

	$("#pw_ch_true").css("display","");
	$("#pw_ch_false").css("display","none");
	}else if(data == "false"){ 
	$("#pw_ch_true").css("display","none");
	$("#pw_ch_false").css("display","");
	$("#pw_chk_value").val('');
	} 
	
   }
  });
  });
});


//비밀번호 재확인 체크
$(document).ready(function(){
 $('#member_pass_ch').keyup(function(){
var pass1 = $("#member_pass").val();
	  var pass2 = $("#member_pass_ch").val();
 if (pass1 == pass2) {
	  $("#_pass_false").css("display","none");
		  $("#_pass_true").css("display","");
		  $("#pw_chk_").val('true');
  }else{
	  $("#_pass_false").css("display","");
	   $("#_pass_true").css("display","none");
	     $("#pw_chk_").val('false');
  }

  });
});
//비밀번호 재확인 체크
$(document).ready(function(){
 $('#member_pass').keyup(function(){
var pass1 = $("#member_pass").val();
	  var pass2 = $("#member_pass_ch").val();
 if (pass1 == pass2) {
	  $("#_pass_false").css("display","none");
		  $("#_pass_true").css("display","");
		  $("#pw_chk_").val('true');
  }else{
	  $("#_pass_false").css("display","");
	   $("#_pass_true").css("display","none");
	     $("#pw_chk_").val('false');
  }

  });
});

</script>
<?php
include_once('inc/tail.php');
?>

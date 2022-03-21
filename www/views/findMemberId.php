<?php
$member_id = $_POST['member_id'];
$joined = $_POST['join_date'];
if($_POST['not_member'] != null) echo "<script>alert('가입정보가 없습니다.');</script>";
//$member_id ="test0101";
//$joined = "2021-05-18";
$config['cf_title'] = "아이디 / 비밀번호 찾기";
include_once('inc/pop_head.php');
?>

<div class="content" style="background-color:#fff;height:850px">
	<div class="find">
		<div class="logo">
				<a alt="<?php echo $config['cf_title']; ?>" href="login.php"><img src="../resource/images/page_logo.png"></a>
		</div>
		<div class="tab">
			<a href="#"  class="select" id=""  value="" onClick="">아이디 찾기</a>
			<a href="findMemberPassword.php" id=""  value="" onClick="">비밀번호 찾기</a>
		</div>

		<? if($member_id != null){ ?>
		<div class="inner_join">
			<div class="title">
				<h4>아이디 찾기</h4>
			</div>
			<div class="find_join">
				<p class="id"><? echo $member_id ?></p>
				<p class="date">가입: <? echo $joined ?></p>
			</div>
		</div>
		
		<?} else{?>
				<form name="email_veri_form" method="POST" onsubmit="return false;" action="../viewmodels/emailCheck.php">
		<div class="inner">
			<div>
				<label for="phone_verification">
					<input type="radio" name="chk_info" id="phone_verification" value="휴대전화 인증"  checked="checked" onclick="selectPhone();">회원정보에 등록한 휴대전화로 인증
				</label>
				<div id="phone_div">
					<span>회원정보에 등록한 휴대전화 번호와 입력한 휴대전화 번호가 같아야, 인증번호를 받을 수 있습니다.</span>
					<button id=""  value="" onClick="kmcis('http://<?echo $_SERVER["HTTP_HOST"];?>/viewmodels/findUserId.php');">휴대전화 인증</button>
				</div>
			</div>
					<div style="margin-top:20px">
						<label for="email_verification">
							<input type="radio" name="chk_info" id="email_verification" value="본인확인 이메일로 인증" onclick="selectEmail();">본인확인 이메일로 인증
						</label>
						<div id="email_div" style="display:none;">
							<span>본인확인 이메일 주소와 입력한 이메일 주소가 같아야, 인증번호를 받을 수 있습니다.</span>
							<div class="email_text">
								<p class="input_title">이름</p>
								<input class="email_input" type="text" name="find_name" id="find_name" >
							</div>
							<div class="email_text">
								<p class="input_title">이메일 주소</p>
								<input class="email_input" type="text" name="find_email" id="find_email">
								<input  type="hidden" name="email_code" id="email_code">
								<input  type="hidden" name="find_value" id="find_value" value="ID">
								<button class="email_certification_button" id=""  value="" onClick="checkEmail();" style="">인증번호 받기</button>
							</div>
							<div class="email_text">
								<p class="input_title"></p>
								<input class="email_input" type="text" name="number_verification" id="number_verification"   placeholder="인증번호 6자리 숫자 입력">
							</div>
							<div class="email_question">
								<a href="#"><p class="question_text">인증번호가 오지 않나요</p><p class="qusetion_email"></p></a>
								<div class="question_popup">
									<p>디오코가 발송한 메일이 스팸 메일로 분류된 것은 아닌지 확인해 주세요.</br>
									스팸 메일함에도 메일이 없다면, 다시 한번 '인증번호 받기'를 눌러주세요.
									</p>
								</div>
							</div>
						</div>
					</div>
					</form>
		</div>
		
		<? } ?>
	</div>

	<? if($member_id != null){ ?>
	<div class="find_next_join">
		<a href="login.php" class="find_login">로그인<a>
		<a href="findMemberPassword.php" class="find_password" id=""  value="" onClick="">비밀번호 찾기</a>
	</div>
	<?} else{?>
	<div class="find_next">
		<button id="btn_next" style="display: none;margin:0 auto"  value="" onClick="checkFindNull();">다음</button>
	</div>
	<? } ?>
</div>


<?php
include_once('inc/tail.php');
?>

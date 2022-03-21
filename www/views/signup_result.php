<?php
$config['cf_title'] = "Create your account";
include_once('inc/pop_head.php');
?>

<div class="content" style="background-color:#fff;height:850px;text-align:center">
	<div style="padding-bottom:60px;border-bottom:1px solid #d5d5d5;margin:0 20px">
		<p style="padding:80px 0;"><a href="login.php"><img src="/resource/images/page_logo.png"></a></p>
		<div style="border:1px solid #d5d5d5; padding:50px;width:1000px;margin:0 auto;">
			<div style="margin:0 auto;text-align:center">
				<p style="padding:40px 0;"><img src="/resource/images/signup_result.png"></p>
				<h3 style="margin-bottom:30px;font-size:24px;font-weight:500">Your account is successfully created.</h3>
				<p style="font-size:16px;font-weight:500">To sign-in please select the OK</p>
			</div>
			<div class="find_next" style="padding-bottom:0">
				<button class="btn_blue hover190" value="" style="background-color:#07a2e8;" onclick="location.href='./login.php'">OK</button>
			</div>
		</div>
	</div>
</div>


<?php
include_once('inc/tail.php');
?>

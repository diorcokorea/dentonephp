<?php
session_start();
unset($_SESSION["user_mail"]);
$config['cf_title'] = "Create your account";
include_once('inc/pop_head.php');
?>

<div class="content" style="background-color:#fff;height:795px">
    <div class="find" style="width:60%">
        <div class="logo" style="margin-bottom:30px">
            <a alt="<?php echo $config['cf_title']; ?>" href="login.php">
                <img src="../resource/images/page_logo.png">
            </a>
        </div>


        <div class="inner" style="position:relative;padding-bottom:120px">
            <label for="phone_verification" style="display:none">
                <input type="radio" name="chk_info" id="phone_verification" value="휴대전화 인증" checked="checked"
                       onclick="selectPhone();">회원정보에 등록한 휴대전화로 인증
            </label>
            <div style="text-align:center;border-bottom: 1px solid #d2d2d2">
                <div class="email_text" style="width:500px; margin:auto; padding-bottom: 20px; border-bottom: 1px solid #d2d2d2; font-size:30px; font-weight:700; color:#07a2e8;">
                    Email verification
                </div>
                <div class="email_text" style="height:280px">
                    <div id="email_check">
                        <p style="font-size:14px;margin:40px 0 70px 0;width:100%;text-align:center;"></p>
                        <!-- <p style="margin:10px 0px 0px 190px;float:left;">Email</p> -->
                        <div class="form-group" style="width:500px; margin:auto;">
                        <input class="form-control-sign_up" type="text" name="user_mail" id="user_mail" placeholder="Email">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                        <input class="email_input" type="hidden" name="mail" id="mail">
                    </div>
                    <div id="email_verification" style="display:none;text-align;center;width:100%">
                        <p style="padding-top:30px"><img src="../resource/images/email_send.png"></p>
                        <p style="font-size:16px;margin:40px auto 70px auto;width:70%;text-align:left;display:block">
                            We have sent a Verification email to <span style="color:#07a2e8;"id="user_mail_span"></span>
                            <br>Please check your mailbox to Verify the account.
                        </p>
                        <!--<input class="email_input" type="text" name="vcode" id="vcode">	-->

                        <form name="id_form" id="id_form" method="POST" action="signup.php">
                            <input type="hidden" id="user" name="user" value="" />
                        </form>

                    </div>
                </div>
            </div>
            <div id="phone_div" style="position: absolute; left: 50%; transform: translate(-50%); margin:10px 0 0 0">
                <!-- <p style="font-size:15px">본인 명의의 휴대폰으로 실명인증을 할 수 있습니다.</p> -->
                <button id="btn_send" class="btn_blue hover170" value=""
                        style="width:170px;background-color:#07a2e8;margin-top:20px;padding:10px 0px;"
                        onClick="checkEmail();"
                >
                    Send
                </button>
                <!--<button class="email_certification_button" id="btn_code_check"  value="" style="display:none;margin:20px 0 0 0" onClick="verification();" style="">Verification</button>-->
            </div>
        </div>
    </div>

    <div class="find_next">
    </div>
</div>


<?php
include_once('inc/tail.php');
?>

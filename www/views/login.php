<?php
include './inc/common.php';

session_start();
// 쿠키 & 세션에 로그인값 체크
if (isset($_COOKIE['member_id'])) {
    $_SESSION['member_id'] = $_COOKIE['member_id'];
    $_SESSION['member_code'] = $_COOKIE['member_code'];
    echo "<script>location.href = 'index.php'</script> ";
} else if (isset($_SESSION['member_id'])) {
    echo "<script>location.href = 'index.php'</script> ";
}


$retry_count = $_POST['retry_count'];
$login_failed = false;

//retry_count가 5이상이면 캡차
//$retry_count = 5;
if ($retry_count != null) {
    if ($retry_count >= 5) {
        $over_count = true;
    } else {
        $login_failed = true;
    }
}


if ($_POST['_failed_login'] != null) {
    $login_failed = true;
}

?>
<!DOCTYPE html>
<html lang="ko" style="width:100%;height:100%;margin:0;">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<head>
    <title>Dent One</title>
    <link rel="stylesheet" href="../resource/css/style.css">
    <link rel="stylesheet" href="../resource/css/style_added.css">
    <link rel="shortcut icon" href="<?= IMAGE ?>/favicon.ico" type="image/x-icon">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Neucha' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../resource/css/jquery.bxslider.css">
    <!-- jQuery Modal(모달) 플러그인 -->
    <link rel="stylesheet" href="<?= JS ?>/OmniWindow-1.0.1/jquery.omniwindow.css">

    <style>
        .login-policy-modal:not(.ow-closed) {
            position: fixed;
            z-index: 20;
            top: 50%;
            left: 50%;
            background: white;
            max-height: 70vh;
            height: 100%;
            width: 100%;
            max-width: 1000px;
            text-align: center;
            border: 1px solid #000000;
            transform: translate(-50%, -50%);
            margin: 0 !important;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
        }

        .login-policy-modal .modal-header {
            display: flex;
            flex-direction: row;
            padding: 24px;
            height: 70px;
            border-bottom: 3px solid #e5e5e5;
        }

        .login-policy-modal .modal-header .modal-title {
            color: #07a2e8;
            font-size: 24px;
        }

        .login-policy-modal .modal-header .close {
            padding: 1rem 1rem;
            margin: -1rem -1rem -1rem auto;
            background-color: transparent;
            border: 0;
            font-size: 24px;
            line-height: 24px;
            color: grey;
            font-weight: 700;
            transition: transform 300ms ease-in-out;
        }

        .login-policy-modal .modal-header .close:hover {
            padding: 1rem 1rem;
            margin: -1rem -1rem -1rem auto;
            background-color: transparent;
            border: 0;
            font-size: 24px;
            line-height: 24px;
            color: #000;
            text-decoration: none;
            transform: scale(1.1);
        }

        .login-policy-modal .modal-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 8px 24px;
        }

        .login-policy-modal .modal-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 24px;
            height: 70px;
            border-top: 1px solid #e5e5e5;
        }

        .login-policy-modal .modal-footer input[type=button] {
            margin: 0;
        }

        .link-container {
            color: white;
        }
    </style>

    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="../resource/js/jquery.bxslider.js"></script>
    <!-- jQuery Modal(모달) 플러그인 -->
    <!-- https://www.jqueryscript.net/demo/Lightweight-Simple-jQuery-Modal-Window-Plugin-OmniWindow/#ex1 -->
    <script type="text/javascript" src="<?= JS ?>/OmniWindow-1.0.1/jquery.omniwindow.js"></script>
    <script type="text/javascript" src="../resource/js/scripts.js"></script>

    <!-- @LUCAS 2.5 Terms and conditions 등 3개 링크 모달로 변경 -->
    <script>
        $(function () {

            const $modal = $('div.login-policy-modal').omniWindow({
                overlay: {
                    animations: {
                        hide: function (subjects, internalCallback) {
                            subjects.overlay.fadeOut(250, function () {
                                internalCallback(subjects); // call internal callback AFTER jQuery animations will stop
                            })
                        },
                        show: function (subjects, internalCallback) {
                            console.log('"show"', "show");
                            console.log('subjects', subjects);
                            subjects.overlay.fadeIn(250, function () {
                                internalCallback(subjects);
                            })
                        }
                    }
                }
            });

            $('#termsAndConditionsLink').on("click", function (e) {
                e.preventDefault();
                $modal.find(".modal-header .modal-title").text("Terms and Conditions");
                $modal.find(".modal-body").html($("#termsAndConditionsTemplate").html());
                $modal.trigger('show');
                return false;
            });

            $('#privacyPolicyLink').on("click", function (e) {
                e.preventDefault();
                $modal.find(".modal-header .modal-title").text("Privacy Policy");
                $modal.find(".modal-body").html($("#privacyPolicyTemplate").html());
                $modal.trigger('show');
                return false;
            });

            $('#marketingPolicyLink').on("click", function (e) {
                e.preventDefault();
                $modal.find(".modal-header .modal-title").text("Marketing Policy");
                $modal.find(".modal-body").html($("#marketingPolicyTemplate").html());
                $modal.trigger('show');
                return false;
            });

            $('.btn-close-modal').on("click", function (e) {
                e.preventDefault();
                $modal.trigger('hide');
                return false;
            });
        });

    </script>

</head>
<!-- 로그인 횟수는 DB에 카운트 네이버 참조 -->
<body style="width:100%;height:100%;overflow:hidden">
<div class="login">
    <div style="margin:180px auto 0 auto;text-align:center;width:70%">
      
        <img src="../resource/images/login_logo.png">
        <form name="member_info_form" method="post" onsubmit="return checkLoginInfoNull();"
              action="../viewmodels/login.php" style="margin-top:100px;position:relative">
            <!-- 로그인 5회 이상 실패 -->
            <div class="form-group">
                <input class="form-control" style="height:60px;" type="text" name="user_id" id="user_id" placeholder="Email" value="">
                <div class="form-control-border"></div>
            </div>
            <p id="check_id" class="login_error_text" style="display:none; top:60px;">Please enter your email.</p>
            <div class="register" style="text-align:right">
                <a href="findMemberPassword.php" value="아이디/비밀번호 찾기" class="find_id" style="padding:0 0 10px 0" >Forgot
                    your password?</a>
            </div>
            <br>
            <div class="form-group">
                <input class="form-control" style="height:60px; margin-top:-20px;" type="password" name="user_pass" id="user_pass" placeholder="Password"
                       value="" onkeyup="checkCapsLock(event)">
                <div class="form-control-border"></div>
            </div>
            <p id="check_caps_lock" class="login_error_text" style="display:none;top: 152px;left:70px;z-index:9"><img
                        src="../resource/images/DentOne-Aligner-Caps Lock.png"></p>
            <p id="check_pass" class="login_error_text" style="display:none;top:167px;">
                Please enter password.
            </p>

            <!-- 로그인 실패 -->
            <? if ($login_failed) echo "<p id='login_failed' class='login_error_text' style='top:170px'>Incorrect user ID or password</p>"; ?>
            <!-- It's an ID you didn't create your account for, or it's a wrong password. -->
            <!-- 로그인 5회 이상 실패 캡차 -->
                        

            <? if ($over_count) { ?>
                <div style="width:100%" class="login_captcha">
                    <? echo "<p class='check_text' style='padding:5px 0'>Please enter your ID, password and captcha.</p>";
                    include_once('../viewmodels/naverCaptcha.php'); ?>
                </div>
            <? } ?>

            <br>
            <input class="login_btn hover_signin" style="font-size:18px; margin:-10px 0 0 0; height:60px;" type="submit" value="Sign-In">
            <div class="login_check">
                <div style="width:50%;float:left">
                    <input type="checkbox" id="keep_login" name="keep_login" />
                    <label for="keep_login"><span>Remember me</span></label>
                </div>
                <div style="width:50%;display:inline-block;text-align:center;border-left:1px solid #6e6e6d;padding:5px 0">
                    <a href="identification.php" value="회원가입" class="register_button" style="border:none;color:#fff;">Create
                        your account</a>
                </div>
            </div>
        </form>
    </div>
        <div class="login_footer">
            <div class="con link-container" style="font-size:11px; text-align:center;">
                <a href="#"
                   id="termsAndConditionsLink"
                   style="border:none;">Terms and Conditions</a>
                <span style="font-size:16px;"> | </span>
                <a href="#"
                   id="privacyPolicyLink"
                   style="border:none;">Privacy Policy</a>
                <span style="font-size:16px;"> | </span>
                <a href="#"
                   id="marketingPolicyLink"
                   style="border:none;">Marketing Policy</a>
                <span style="font-size:16px;"> | </span>
                   Copyright © diorco. Co., Ltd. All right reserved
            </div>
            <!-- </br>
            <img src="../resource/images/login_footer_logo.png"
                 style=" padding:10px 0; margin-right:10px;display:inline-block;margin-bottom:15px">

            <p style="text-align:left;border-left:1px solid #fff; padding:5px 0 5px 15px;font-size:10px;color:#fff;display:inline-block">
                 diorco@diorco.co.kr  |  Tel. +82-70-5030-3037 <br>
              
            </p> -->
        </div>

</div>
<div class="login_image">
    <div class="slider" style="height:100%">
        <div><img src="../resource/images/main_image01.png" title="1"></div>
        <div><img src="../resource/images/main_image01.png" title="2"></div>
        <div><img src="../resource/images/main_image01.png" title="3"></div>
    </div>
</div>
<!-- @DBJ 중요!!! 이하 로그인에서도 동일하게 나오는 각종 Policy 를 Include 로 불러서 한 곳에서 작성할 수 있도록 한 것임.
나중에 각종 Policy 를 수정하고자 하는 경우에는 아래의 파일을 수정 해야 함. -->
<!-- Container for an overlay: -->
<?php include('various_policies_collection.php');?>
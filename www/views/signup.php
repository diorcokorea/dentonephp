<?php
session_start();
$config['cf_title'] = "Create your account";
include_once('inc/pop_head.php');
//$name  = $_POST['name'];
//$phoneNo  = $_POST['phoneNo'];
//$birthDay  = $_POST['birthDay'];
//$result  = $_POST['result'];
//if(!isset($_SESSION["user_mail"])) echo"<script>location.href = './identification.php';</script>";
function my_simple_crypt($string, $action = 'e')
{
    $secret_key = 'email';
    $secret_iv = 'email';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

$user_mail = my_simple_crypt($_GET['user'], "d");

if ($_SESSION["user_mail"] != $user_mail) {
    echo "<script>location.href = './identification.php';</script>";
}
/*
if(isset($_POST['user'])){
$user_mail  = $_POST['user'];
}else{
echo"<script>location.href = './identification.php';</script>";
}*/
include "../models/db/querys.php";
$country_list = countryList();
//$user_mail = $_SESSION["user_mail"];
//unset($_SESSION["user_mail"]);
//$name = "Diorco";
//$phoneNo ="01012345678";
?>

<!-- @DBJ 로그인처럼 모달 효과 표현하기 위하여 스크립트 & 스타일 지정 -->
<script type="text/javascript" src="<?= JS ?>/OmniWindow-1.0.1/jquery.omniwindow.js"></script>
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
<!-- @DBJ 모달 기본 사항 끝 -->

<style>
    .agreement--checked .agreement__label {
        color: #07a2e8;
    }

    .agreement__label label {
        cursor: pointer;
    }

    .accept-all__description {
        color: red;
        pointer-events: none;
        font-size: 16px;
    }

    .select_box__container {
        width: 28%;
        position: relative;
        display: inline-block;
    }
</style>

<div class="content" style="background-color:#fff;overflow:hidden;height:auto">
    <div class="doctor_register">
        <div class="logo">
            <a alt="<?php echo $config['cf_title']; ?>" href="login.php"><img
                        src="../resource/images/page_logo.png"></a>
        </div>
        <div class="patient_warning" style="border-bottom:1px solid #d2d2d2;width:100%;padding:0 0 10px 0;">
            <p class="patient_warning_icon"></p>
            <p class="patient_warning_text">Please enter all information to join us.</p>
        </div>
        <form name="signup_info_form" id="signup_info_form" method="post" onsubmit="return signup_agreement_check();"
              action="../viewmodels/signup.php" style="margin-top:20px">

            <div style="width:100%;overflow:hidden">
                <div class="registeritem item_left register_name">
                    <div style="overflow:hidden">
                        <p class="registeritem_title">First name</p>
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                        <input class="form-control-sign_up" tabindex="1" type="text" name="first_name" id="first_name" placeholder="First name"
                               value="<? echo $name ?>" style="" required
                               oninvalid="this.setCustomValidity('Please enter first name.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                    <div style="overflow:hidden;margin-top:24px">
                        <p class="registeritem_title">Last name</p>
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                        <input class="form-control-sign_up" tabindex="2" type="text" name="last_name" id="last_name" placeholder="Last name"
                               value="<? echo $name ?>" style="" required
                               oninvalid="this.setCustomValidity('Please enter last name.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                </div>

                <div class="registeritem item_right register_name2">
                    <p class="registeritem_title">Clinic name</p>
                    <div class="form-group" style="width:400px; margin:0px; float:right">
                    <input class="form-control-sign_up" tabindex="5" type="text" name="member_hospital_name" id="member_hospital_name"
                           placeholder="Clinic name" value="" style="" required
                           oninvalid="this.setCustomValidity('Please enter clinic name.')"
                           oninput="setCustomValidity('')">
                           <div class="form-control-sign_up-border"></div>
                        </div>
                </div>

                <div class="registeritem item_right register_address" style="float:right;margin-top:20px;">
                    <div style="width:100%; height: 50px">
                        <p class="registeritem_title">Country</p>
                        <div style="width:400px;float:right">
                            <select tabindex="6" id="countrySelect" name="country" required
                                    oninvalid="this.setCustomValidity('Please choose a country.')"
                                    oninput="setCustomValidity('')" style="width:100%"
                                    placeholder="Please choose a country." onchange="countrySelectChanged(this)">
                                <option value="0" selected>Please choose a country
                                </option>
                                <? foreach ($country_list as $value) { ?>
                                    <option value="<?= $value['code'] ?>"><?= $value['full_name'] ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <div style="width:100%; overflow:hidden;margin-top:10px">
                        <p class="registeritem_title">Address1</p>
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                        <input class="form-control-sign_up" tabindex="7" type="text" id="address1" name="address1" placeholder="Address1"
                               style="" required
                               oninvalid="this.setCustomValidity('Please enter address1.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                        <span id="guide" style="color:#999;display:none"></span>
                        <!-- <input type="text" id="jibunAddress" placeholder="지번주소">
                        <input type="text" id="sample4_extraAddress" placeholder="참고항목"> -->
                    </div>
                    <div style="width:100%; overflow:hidden;margin-top:10px">
                        <p class="registeritem_title">Address2</p>
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                        <input class="form-control-sign_up" tabindex="8" type="text" id="address2" name="address2" placeholder="Address2"
                               style="" required
                               oninvalid="this.setCustomValidity('Please enter address2.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                    <div style="width:100%; overflow:hidden;margin-top:10px">
                        <p class="registeritem_title">City</p>
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                        <input class="form-control-sign_up" tabindex="9" type="text" id="address3" name="address3" placeholder="City"
                               style="" required
                               oninvalid="this.setCustomValidity('Please enter city.')" oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                    <div style="width:100%; overflow:hidden;margin-top:10px">
                        <p class="registeritem_title" style="padding:0">State/Province<br>/Region</p>
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                        <input class="form-control-sign_up" tabindex="10" type="text" id="address4" name="address4"
                               placeholder="State/Province/Region" style="" required
                               oninvalid="this.setCustomValidity('Please enter state/province/region.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                    <div style="width:100%; overflow:hidden;margin-top:10px">
                        <p class="registeritem_title">Zip code</p>
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                        <input class="form-control-sign_up" tabindex="11" type="text" id="postcode" name="postcode" placeholder="Zip code"
                               style="" required
                               oninvalid="this.setCustomValidity('Please enter zip code.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                    <div style="position:absolute;font-size:12px;color:#07a2e8;margin-top:10px;">
                        <td><span style="color:red">*</span> Above address shall be used for delivery. Please enter the address correctly.</td>
                    </div>
                </div>

                
                <div class="registeritem register_email item_left" style="float:left;;margin-top:20px">
                    <p class="registeritem_title">Email</p>
                    <div style="width:400px;float:right">
                        <input type="text" name="" disabled id="" placeholder="" value="<?= $user_mail ?>"
                               style="width:400px;float:right">
                    </div>
                </div>

                <div class="registeritem register_password item_left" style="float:left;;margin-top:20px">
                    <div style="padding-bottom:20px;position:relative;width:100%;float:left">
                        <p class="registeritem_title">Password</p>
                        <div id="member_pw_box" style="position:relative;float:right">
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                            <input class="form-control-sign_up" tabindex="3" type="password" name="member_pass" id="member_pass"
                                   placeholder="Password" value="" onkeyup="checkCapsLock(event)"
                                   style="" required
                                   oninvalid="this.setCustomValidity('Please enter password.')"
                                   oninput="setCustomValidity('')">
                            <div class="form-control-sign_up-border"></div>
                            </div>
                            <p class="pw_check" id="pw_ch_true" style="display:none;color:#07a2e8; font-size: 12px;">available
                            <p>
                            <p class="pw_check" id="pw_ch_false" style="display:none;color:red; font-size: 12px;">not available
                            <p>
                                <input type="text" id="check_pass" style="display:none;" value="비밀번호를 입력해주세요.">
                            <p id="pw_chk" style="position:absolute;font-size:12px;color:#07a2e8;bottom:-17px">Use 8 or more characters with a mix od letters, numbers & symbols <br></p>
                            <input type="hidden" id="pw_chk_value" name="pw_chk_value" value="">
                            <p id="check_caps_lock" class="login_error_text"
                               style="display:none;top: 38px;left:70px;z-index:9"><img
                                        src="../resource/images/DentOne-Aligner-Caps Lock.png"></p>
                        </div>
                    </div>

                    <div>
                        <p class="registeritem_title">Confirm password</p>
                        <div style="position:relative;float:right">
                        <div class="form-group" style="width:400px; margin:0px; float:right">
                            <input class="form-control-sign_up" tabindex="4" type="password" name="member_pass_ch" id="member_pass_ch"
                                   onkeyup="checkCapsLock1(event)" required
                                   oninvalid="this.setCustomValidity('Please enter password.')"
                                   oninput="setCustomValidity('')" placeholder="Confirm password" value=""
                                   style="">
                            <div class="form-control-sign_up-border"></div>
                            </div>
                            <p id="_pass_false"
                               style="display:none;position:absolute;font-size:12px;color:red;bottom:-17px">Passwords
                                must match.</p>
                            <p id="_pass_true"
                               style="display:none;position:absolute;font-size:12px;color:#07a2e8;bottom:-17px">
                                Passwords matched.</p>
                            <input type="hidden" id="pw_chk_" name="pw_chk_" value="">
                            <p id="check_caps_lock1" class="login_error_text"
                               style="display:none;top: 38px;left:70px;z-index:9"><img
                                        src="../resource/images/DentOne-Aligner-Caps Lock.png"></p>
                        </div>
                    </div>
                </div>


            </div>

            <div style="width:100%;overflow:hidden;margin-bottom:20px">
                <div style="height:100%;width:51%;float:left">
                    <div class="registeritem register_id" style="width:100%;display:none">
                        <p class="registeritem_title">아이디</p>
                        <div style="float:right;width:400px;position:relative">
                            <div id="member_id_box" style="float:left;position:relative">
                                <input type="text" name="member_id" id="member_id" placeholder="아이디"
                                       value="<?= $user_mail ?>" style="width:275px" required
                                       oninvalid="this.setCustomValidity('아이디를 입력해주세요.')"
                                       oninput="setCustomValidity('')">
                                <p id="id_ch_true" class="password_check" style="display:none;color:#07a2e8">사용가능
                                <p>
                                <p id="id_ch_false" class="password_check" style="display:none;color:red">사용불가
                                <p>
                            </div>
                            <p id="check_id" style="display:none;">아이디를 입력해주세요.</p>
                            <input type="button" onclick="chk_id_();" class="button_black" value="중복확인"
                                   style="float:right">
                            <p id="id_chk" style="display:none;position:absolute;font-size:12px;color:red;bottom:-17px">
                                5~20자의 영문 소문자, 숫자와 특수기호(_),(-)만 사용 가능합니다.</p>
                            <input type="hidden" id="id_chk_value" name="id_chk_value" value="">
                        </div>
                    </div>
                </div>
            </div>

            <div style="width:100%; height: 140px;">
                <div class="registeritem item_left register_name">
                    <p class="registeritem_title">Mobile</p>
                    <div style="float:right;width:400px;position:relative">
                        <div class="select_box__container">
                            <select tabindex="12"
                                    id="countrySelect2"
                                    class="country_code_select"
                                    name="moblile_country_code"
                                    required
                            >
                            <option data-countryCode="0"
                                            data-selected-label="0"
                                            value="0">---</option>
                                <? foreach ($country_list as $value) { ?>
                                    <option 
                                            data-countryCode="<?= $value['sub_name'] ?>"
                                            data-selected-label="<?= $value['code'] ?>"
                                            value="<?= $value['code'] ?>"
                                    >
                                        <?= $value['full_name'] . " (" . $value['code'] . ")" ?>
                                    </option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="form-group" style="width:280px; margin:0px; float:right;">
                        <input class="form-control-sign_up" tabindex="13" type="int" id="phone_number" name="phone_number" min="5" max="15"
                               style="width:100%; height:46px;" required
                               oninvalid="this.setCustomValidity('Please enter mobile number.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                </div>
                <div class="registeritem item_right register_name2">
                    <p class="registeritem_title">Office</p>
                    <div style="float:right;width:400px;position:relative">
                        <div class="select_box__container">
                            <select tabindex="14"
                                    id="countrySelect3"
                                    class="country_code_select"
                                    name="phone_country_code"
                                    required
                            >
                            <option data-countryCode="0"
                                            data-selected-label="0"
                                            value="0">---</option>
                                <? foreach ($country_list as $value) { ?>
                                    <option
                                            data-countryCode="<?= $value['sub_name'] ?>"
                                            data-selected-label="<?= $value['code'] ?>"
                                            value="<?= $value['code'] ?>"
                                    >
                                        <?= $value['full_name'] . " (" . $value['code'] . ")" ?>
                                    </option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="form-group" style="width:280px; margin:0px; float:right;">
                        <input class="form-control-sign_up" tabindex="15" type="tel" id="contact_number" name="contact_number" min="9" max="15"
                               style="width:100%; height:46px;" required
                               oninvalid="this.setCustomValidity('Please enter your phone number.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="width:100%;margin-top:80px">
                <div class="register_agree">
                    <table class="agree_table">
                        <colgroup>
                            <col width="60px">
                            <col width="auto">
                            <col width="140px">
                        </colgroup>
                        <thead>
                        <tr style="height:61px">
                            <td align="center"><input tabindex="16" type="checkbox" name="agreement"
                                                      class="ch_box_agreement" id="all_selec"></td>
                            <td class="agreement__label">
                                <label for="all_selec">
                                    I have read and agree to all
                                    <!-- Accept all
                                    <span class="accept-all__description">*if you accept all, you also agree to the following Marking Policy (Optional)</span> -->
                                </label>
                            </td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody id="brk_list_tbody">
                        <tr class="cellcolor" style="height:61px">
                            <td align="center"><input tabindex="17" type="checkbox" name="agreement"
                                                      class="ch_box_agreement" id="agreement"
                                ></td>
                            <td class="agreement__label"><label for="agreement">Terms and conditions</label>
                            </td>
                            <td>
                                <!-- @DBJ 모달용 링크 (아래 주석 부분 2줄은 기존 팝업 형태임.) -->
                            <a href="#"
                                id="termsAndConditionsLink"
                                class="btn_black hover100" style="width:100px; height:35px;">View</a>
                            </td>
                            <!-- <td><a href="<?php echo $url . "/web/viewer.html?file=DentOne_Terms_and_Conditions.pdf"; ?>"
                                   class="btn_black hover100" style="width:100px; height:35px;" target="_blank">View</a></td> -->
                        </tr>
                        <tr class="cellcolor" style="height:61px">
                            <td align="center"><input tabindex="18" type="checkbox" name="agreement"
                                                      class="ch_box_agreement" id="privacy"></td>
                            <td class="agreement__label"><label for="privacy">Privacy policy</label></td>
                            <td>
                            <!-- @DBJ 모달용 링크 (아래 주석 부분 2줄은 기존 팝업 형태임.) -->
                            <a href="#"
                                id="privacyPolicyLink"
                                class="btn_black hover100" style="width:100px; height:35px;">View</a>
                            </td>
                            <!-- <td><a href="<?php echo $url . "/web/viewer.html?file=DentOne_Privacy_Policy.pdf"; ?>"
                                    class="btn_black hover100" style="width:100px; height:35px;" target="_blank">View</a></td> -->
                        </tr>
                        <tr class="cellcolor" style="height:61px">
                            <td align="center"><input tabindex="20" type="checkbox" name="marketing" value="Y"
                                                      class="ch_box_agreement" id="marketing"></td>
                            <td class="agreement__label"><label for="marketing">Marketing policy (Optional)</label></td>
                            
                            <!-- @DBJ 모달용 링크 (아래 주석 부분 2줄은 기존 팝업 형태임.) -->
                            <td>
                            <a href="#"
                                id="marketingPolicyLink"
                                class="btn_black hover100" style="width:100px; height:35px;" target="_blank">View</a>
                            </td>
                            <!-- <td><a href="<?php echo $url . "/web/viewer.html?file=Diorco_Marketing_Policy.pdf"; ?>"
                                    class="btn_black hover100" style="width:100px; height:35px;" target="_blank">View</a></td> -->
                        </tr>
                        <!-- <tr class="cellcolor" style="height:61px">
                            <td align="center"><input tabindex="19" type="checkbox" name="agreement"
                                                      class="ch_box_agreement" id="provision">
                            </td>
                            <td class="agreement__label">
                                <label for="privacy">
                                    Accept the provision of personal information to third parties
                                </label>
                            </td>
                            <td>
                                <a href="<?php echo $url . "/web/viewer.html?file=DentOne_Privacy_Policy.pdf"; ?>"
                                   class="agree_link" target="_blank">Read all</a></td>
                            </td>
                        </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="find_next" style="padding:10px 10px 55px 10px;">
        <a tabindex="22"
           onClick="signup_page_back('<?= DOMAIN ?>views/identification.php');"
           class="btn_black hover190"
           style="padding-top:10px;"
        >
            Back
        </a>
        <input type="button" onclick="fn();" id="btn_" value="Join" class="btn_blue hover190">
        <input type="submit" style="display:none;" id="btn_next">
    </div>
    </div>
    

    </form>
</div>
</div>
</div>
<!-- 국가코드 셀렉 -->
<?
echo "<script>
$(document).ready(function(){
";
echo "$('#moblile_country_code option[value=\"" . explode(" ", $user_info['mobile'])[0] . "\"]').attr('selected', true);";
echo "$('#phone_country_code option[value=\"" . explode(" ", $user_info['phone'])[0] . "\"]').attr('selected', true);";
echo "});</script>";
?>
<script>

    function fn() {
        setTimeout(function () {
            $('#btn_next').click();
            $("document").blur(); // TODO @LUCAS 대박 setCustomValidity
        }, 100);
    }

    function signup_agreement_check() {
        if (!$("#agreement").is(':checked')) {
            alert("Check to agree to the terms and conditions.");
            return false;
        } else if (!$("#privacy").is(':checked')) {
            alert("Check the consent to personal information collection.");
            return false;
        }
            //else if (!$("#provision").is(':checked'))
            // {
            // 	alert("Check the consent to the provision of personal information to third parties.");
            // 	return false;
        // }
        else return true;
    }

    $(document).ready(function () {

        $("#countrySelect").animatedDropdown({
            ulMinWidth: "250px",
            ulMaxHeight: "300px",
            ulOverflowY: "auto",
        }).on("change", function () {
            if ($(this).find("option:selected").val()) {
                this.setCustomValidity('');
            } else {
                this.setCustomValidity("Please choose a country.");
            }
        });

        $("#countrySelect2").animatedDropdown({
            ulMinWidth: "250px",
            ulMaxHeight: "300px",
            ulOverflowY: "auto",
        });

        $("#countrySelect3").animatedDropdown({
            ulMinWidth: "250px",
            ulMaxHeight: "300px",
            ulOverflowY: "auto",
        });

        //아이디 정규식 체크
        $('#member_id').keyup(function () {
            $.ajax({
                url: '../viewmodels/checkUserId.php',
                type: 'POST',
                data: {'user_id': $('#member_id').val()},
                dataType: 'html',
                success: function (data) {
                    if (data == "true") {
                        $("#id_chk").css("display", "none");
                        $("#id_chk_value").val('true');
                    } else {
                        $("#id_chk").css("display", "");
                        $("#id_ch_false").css("display", "none");
                        $("#id_ch_true").css("display", "none");
                        $("#id_chk_value").val('');
                    }

                }
            });
        });

//비밀번호 정규식 체크

        $('#member_pass').keyup(function () {
            $.ajax({
                url: '../viewmodels/checkUserPw.php',
                type: 'POST',
                data: {'member_pass': $('#member_pass').val()},
                dataType: 'html',
                success: function (data) {
                    if (data == "true") {

                        $("#pw_chk_value").val('true');

                        $("#pw_ch_true").css("display", "");
                        $("#pw_ch_false").css("display", "none");
                    } else if (data == "false") {


                        $("#pw_ch_true").css("display", "none");
                        $("#pw_ch_false").css("display", "");
                        $("#pw_chk_value").val('');
                    }

                }
            });

            var pass1 = $("#member_pass").val();
            var pass2 = $("#member_pass_ch").val();
            if (pass1 == pass2) {
                $("#_pass_false").css("display", "none");
                $("#_pass_true").css("display", "");
                $("#pw_chk_").val('true');
            } else {
                $("#_pass_false").css("display", "");
                $("#_pass_true").css("display", "none");
                $("#pw_chk_").val('false');
            }
        });

        $('#member_pass_ch').keyup(function () {
            var pass1 = $("#member_pass").val();
            var pass2 = $("#member_pass_ch").val();
            if (pass1 == pass2) {
                $("#_pass_false").css("display", "none");
                $("#_pass_true").css("display", "");
                $("#pw_chk_").val('true');
            } else {
                $("#_pass_false").css("display", "");
                $("#_pass_true").css("display", "none");
                $("#pw_chk_").val('false');
            }
        });

        // @LUCAS 1.5차 작업
        $('.ch_box_agreement').on("click", function () {
            const $checkbox = $(this);
            if ($(this).is(":checked")) {
                $checkbox.parent().parent().addClass("agreement--checked");
            } else {
                $checkbox.parent().parent().removeClass("agreement--checked");
            }
        });
    });


    $('.ch_box_agreement').click(function (e) {
//alert(e.target.id);
        if (e.target.id == "all_selec") {
            if ($('#' + e.target.id).is(':checked')) {
                $('.ch_box_agreement').prop("checked", true).parent().parent().addClass("agreement--checked");
            } else {
                $('.ch_box_agreement').prop("checked", false).parent().parent().removeClass("agreement--checked");
            }

        } else {
            $('#all_selec').prop("checked", false);
        }
    });

    function countrySelectChanged(e) {
        const selectedValue = $("#countrySelect").val();

        $("#countrySelect2").val(selectedValue).animatedDropdown({selectedValue});
        $("#countrySelect3").val(selectedValue).animatedDropdown({selectedValue});
    }

</script>

<?php
include_once('inc/tail.php');
?>

<!-- @DBJ 중요!!! 이하 로그인에서도 동일하게 나오는 각종 Policy 를 Include 로 불러서 한 곳에서 작성할 수 있도록 한 것임.
나중에 각종 Policy 를 수정하고자 하는 경우에는 아래의 파일을 수정 해야 함. -->
<!-- Container for an overlay: -->
<?php include('various_policies_collection.php');?>
<?php
session_start();
$config['cf_title'] = "My Profile";
//ini_set("display_errors", "1");
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/pop_head.php");

include "../../models/db/querys.php";

$country_list = countryList();
$user_id = $_SESSION['member_id'];
$user_info = user_info($user_id);
$_SESSION['address_id'] = $user_info['address_id'];
$_SESSION['d_code'] = $user_info['index'];
$_SESSION['acc_code'] = $user_info['ACCINDEX'];

$address_list = address_list_r($_SESSION['member_code'], null);
//print_r($user_info);
// $test = plabList_r();
//print_r($address_list);
?>
    <!-- @LUCAS 알람받기 on/off 추가로 스타일 변경 -->
    <div class="content" style="background-color:#fff;float:left;height:886px">
        <form name="signup_info_form" id="signup_info_form" method="post" onsubmit="return false;">
            <div class="doctor_register" style="margin-top:20px">

                <input type="hidden" id="fname" value="<?= explode(",", $user_info['name'])[0] ?>">
                <input type="hidden" id="lname" value="<?= explode(",", $user_info['name'])[1] ?>">
                <input type="hidden" id="hospital_name" value="<?= $user_info['hospital_name'] ?>">
                <input type="hidden" id="address_id" value="<?= $address_list[0]['main_address_id'] ?>">
                <input type="hidden" id="address_id2" value="<?= $address_list[0]['main_address_id'] ?>">
                <input type="hidden" id="mobile_c_code" value="<?= explode(" ", $user_info['mobile'])[0] ?>">
                <input type="hidden" id="mobile_num" value="<?= explode(" ", $user_info['mobile'])[1] ?>">
                <input type="hidden" id="phone_c_code" value="<?= explode(" ", $user_info['phone'])[0] ?>">
                <input type="hidden" id="phone_num" value="<?= explode(" ", $user_info['phone'])[1] ?>">

                <div style="width:100%;margin-bottom:20px;overflow:hidden">
                    <div class="registeritem item_left register_name">
                        <div style="overflow:hidden;height:50px;">
                            <p class="registeritem_title">First name</p>
                            <div class="form-group" style="width:400px; float:right;">
                                <input class="form-control-sign_up" value="<?= explode(",", $user_info['name'])[0] ?>" type="text" name="first_name"
                                required oninvalid="this.setCustomValidity('Please enter first name.')"
                                id="first_name" placeholder="First name">
                                <div class="form-control-sign_up-border"></div>
                            </div>
                            <input type="text" id="check_name" style="display:none;" value="이름을 입력해주세요.">
                        </div>
                        <div style="overflow:hidden;margin-top:24px;height:50px;">
                            <p class="registeritem_title">Last name</p>
                            <div class="form-group" style="width:400px; float:right;">
                                <input class="form-control-sign_up" type="text" name="last_name" id="last_name" placeholder="Last name"
                                value="<?= explode(",", $user_info['name'])[1] ?>" style="float:right" required
                                oninvalid="this.setCustomValidity('Please enter last name.')"
                                oninput="setCustomValidity('')">
                                <div class="form-control-sign_up-border"></div>
                            </div>
                        </div>
                    </div>

                    <div class="registeritem item_right register_name2">
                        <div style="overflow:hidden;height:50px;">
                            <p class="registeritem_title">Clinic name</p>
                            <div class="form-group" style="width:400px; float:right;">
                                <input class="form-control-sign_up" type="text" required oninvalid="this.setCustomValidity('Please enter clinic name.')"
                                oninput="setCustomValidity('')" name="member_hospital_name" id="member_hospital_name"
                                placeholder="Clinic name" value="<?= $user_info['hospital_name'] ?>" style="float:right">
                                <div class="form-control-sign_up-border"></div>
                            </div>
                            <input type="text" id="check_hospital_name" style="display:none;" value="병원 이름을 입력해주세요.">
                        </div>
                    </div>
                    <div class="registeritem item_right register_address"
                         style="float:right;margin-top:20px;padding:74px 30px">
                        <div style="width:100%; height: 47px ;margin-bottom:20px">
                            <p class="registeritem_title">Delivery address</p>
                            <div style="width:340px;float:right">
                                <select
                                        name="address_id"
                                        required
                                        oninput="setCustomValidity('')"
                                        style="width:100%"
                                        placeholder="Please choose a address."
                                        class="animated_dropdown"
                                >
                                    <? for ($i = 0; $i < count($address_list); $i++) {
                                        if ($address_list[0]['main_address_id'] == $address_list[$i]['address_id']) {
                                            echo "<option value='" . $address_list[$i]['address_id'] . "'  selected>" . $address_list[$i]['address_name'] . "</option>";
                                        } else {
                                            ?>
                                            <option value="<?= $address_list[$i]['address_id'] ?>"><?= $address_list[$i]['address_name'] ?></option>
                                        <? }
                                    } ?>

                                </select>
                            </div>
                        </div>
                        <div style="width:100%; height: 47px ;margin-bottom:20px">
                            <p class="registeritem_title">Billing address</p>
                            <div style="width:340px;float:right">
                                <select
                                        name="address_id2"
                                        required
                                        oninput="setCustomValidity('')"
                                        style="width:100%"
                                        placeholder="Please choose a address."
                                        class="animated_dropdown"
                                >
                                    <? for ($i = 0; $i < count($address_list); $i++) {
                                        if ($address_list[0]['main_address_id'] == $address_list[$i]['address_id']) {
                                            echo "<option value='" . $address_list[$i]['address_id'] . "'   selected>" . $address_list[$i]['address_name'] . "</option>";
                                        } else {
                                            ?>
                                            <option value="<?= $address_list[$i]['address_id'] ?>"><?= $address_list[$i]['address_name'] ?></option>
                                        <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <input class="btn_blue hover340" type="button" id="adresslist" value="Delivery Address List"
                               style="width:340px;float:right;margin:0px;">
                    </div>
                    <div style="height:100%;width:51%;float:left">
                        <div class="registeritem register_email" style="float:left;width:100%;margin-top:20px;">
                            <p class="registeritem_title">Email</p>
                            <input type="text" id="member_email" name="member_email_view" disabled required
                                   oninvalid="this.setCustomValidity('이메일을 입력해주세요.')" oninput="setCustomValidity('')"
                                   class="" placeholder="Email" style="width:400px;float:right"
                                   value="<?= $user_info['email'] ?>" readonly>
                            <input type="hidden" id="member_email" name="member_email" required
                                   oninvalid="this.setCustomValidity('이메일을 입력해주세요.')" oninput="setCustomValidity('')"
                                   class="" placeholder="Email" style="width:400px;float:right"
                                   value="<?= $user_info['email'] ?>" readonly>
                        </div>

                        <div class="registeritem register_id" style="width:100%;display:none">
                            <p class="registeritem_title">아이디</p>
                            <div style="float:right;width:400px;position:relative">
                                <div id="member_id_box" style="float:left;position:relative">
                                    <input type="text" name="member_id" id="member_id" placeholder="아이디"
                                           value="<?= $user_info['login_id'] ?>" disabled style="width:400px">
                                </div>
                            </div>
                        </div>
                        <div class="registeritem register_password"
                             style="float:left;width:100%;margin-top:20px;padding:10px 30px">
                            <div style="float:left">
                                <p class="registeritem_title" style="float:none;display:block">Password</p>
                                <p class="registeritem_title"
                                   style="float:none;display:block;color:#07a2e8"><?= $user_info['LastChangDate'] ?> </p>
                            </div>
                            <div style="float:right;padding-top:25px">
                                <input class="btn_blue hover100" type="button" id="btn_pw_chg" value="Change"
                                       style="width:100px">
                            </div>
                        </div>

                        
                    </div>
                </div>

                <!-- @LUCAS On/Off 추가를 위해 디자인 변경  -->
                <div style="width:100%;">
                    <div class="item_left register_name" style="display: flex; flex-direction: column">
                        <div class="registeritem register_name33">
                            <p class="registeritem_title">Mobile</p>
                            <div style="float:right;width:400px;height:50px; position:relative">
                                <div class="country_code_select_box animated_dropdown_container">
                                    <select
                                            id="moblile_country_code"
                                            class="country_code_select animated_dropdown animated_dropdown--up"
                                            name="moblile_country_code"
                                    >
                                        <!-- <option value="<?= explode(" ", $user_info['mobile'])[0] ?>" hidden selected><?= explode(" ", $user_info['mobile'])[0] ?></option> -->
                                        <? foreach ($country_list as $value) { ?>
                                            <option
                                                    data-countryCode="<?= $value['sub_name'] ?>"
                                                    data-selected-label="<?= $value['code'] ?>"
                                                    value="<?= $value['code'] ?>"><?= $value['full_name'] . " (" . $value['code'] . ")" ?>
                                            </option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="form-group" style="width:280px; float:right;">
                                    <input class="form-control-sign_up" type="int" id="phone_number" value="<?= explode(" ", $user_info['mobile'])[1] ?>"
                                    name="phone_number" placeholder="Please enter it except for '-'." min="5"
                                    max="15"
                                    style="width:280px;"
                                    oninvalid="this.setCustomValidity('Please enter mobile number.')"
                                    oninput="setCustomValidity('')" required>
                                    <div class="form-control-sign_up-border"></div>
			                    </div>
                            </div>
                        </div>
                        <div class="registeritem register_name233" style="margin-top: 20px;">
                            <p class="registeritem_title">Office</p>
                            <div style="float:right;width:400px;height:50px;position:relative">
                                <div class="country_code_select_box animated_dropdown_container">
                                    <select
                                            id="phone_country_code"
                                            class="country_code_select animated_dropdown animated_dropdown--up"
                                            name="phone_country_code"
                                    >
                                        <!--
                        <option value="<?= explode(" ", $user_info['phone'])[0] ?>"  selected><?= explode(" ", $user_info['phone'])[0] ?></option> -->
                                        <? foreach ($country_list as $value) { ?>
                                            <option
                                                    data-countryCode="<?= $value['sub_name'] ?>"
                                                    data-selected-label="<?= $value['code'] ?>"
                                                    value="<?= $value['code'] ?>"><?= $value['full_name'] . " (" . $value['code'] . ")" ?>
                                            </option>
                                        <? } ?>
                                    </select>
                                </div>
                                    <div class="form-group" style="width:280px; float:right;">
                                        <input class="form-control-sign_up" type="tel" id="contact_number"
                                        value="<?= explode(" ", $user_info['phone'])[1] ?>"
                                        name="contact_number" placeholder="Please enter it except for '-'." min="9"
                                        max="15"
                                        style="width:280px;"
                                        oninvalid="this.setCustomValidity('Please enter your phone number.')"
                                        oninput="setCustomValidity('')" required>
                                        <div class="form-control-sign_up-border"></div>
			                        </div>
                                </div>
                            </div>
                        </div>

                    <!-- @LUCAS On/Off 설정 추가  -->
                    <div class="registeritem item_right register_name2 email_notification" style="padding-top:46px; height:260px;">
                        <p class="registeritem_title">Alarm</p>
                        <div class="email_notification_container">
                            <div class="email_notification_input_container">
                                <input
                                        type="radio"
                                        name="email_notification"
                                        value="On"
                                        class="email_notification_radio"
                                        onclick=onOffBtnCheck(event)
                                    <?= $user_info['email_notification'] !== "Off" ? "checked" : "" ?>
                                /> On
                            <div>
                            <div class="email_notification_input_container" style="margin-left:35px;">
                                <input
                                        type="checkbox"
                                        id="is_submit_checked"
                                        name="is_submit_checked"
                                        value="1"
                                    <?= $user_info['is_submit_checked'] ? "checked" : "" ?>
                                />
                                <label for="is_submit_checked"><span>Order received</span></label>
                            </div>
                            <br>
                            <br>
                            <div class="email_notification_input_container" style="margin-top:20px;">
                                <input
                                        type="radio"
                                        name="email_notification"
                                        value="Off"
                                        class="email_notification_radio"
                                        onclick=onOffBtnCheck(event)
                                    <?= $user_info['email_notification'] === "Off" ? "checked" : "" ?>
                                /> Off
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function onOffBtnCheck(event) {
                    if(event.target.value === 'Off') {
                        $("input:checkbox[id='is_submit_checked']").prop("checked", false);
                        $("input:checkbox[id='is_submit_checked']").attr("disabled", true);
                    } else if (event.target.value === 'On') {
                        $("input:checkbox[id='is_submit_checked']").prop("checked", true);
                        $("input:checkbox[id='is_submit_checked']").attr("disabled", false);
                    }
                } 
            </script>    

            <div class="find_next_join" style="padding:0px;">
                <input type="button" class="btn_save hover200" value="Save">
                <input type="button" class="btn_close hover200" value="Close">
            </div>

            <input type="hidden" id="result" name="result" value="<? echo $result ?>">

        </form>
    </div>

    <!-- 비밀번호 변경 팝업 -->
    <div id="change_password"
         style="display:none;position:absolute;top: 50%;left: 50%;background-color:#fff;border:2px solid #d2d2d2;transform:translate(-50%,-50%);width:660px">
        <div style="background-color:#08a2e8;text-align:center;color:#fff;padding:10px 0">
            <h2>Change password</h2>
        </div>

        <div style="padding:40px 40px 20px 40px;overflow:hidden">
            <div style="padding-bottom:30px;width:100%;float:left">
                <p class="pw_text">Current password</p>
                <div style="position:relative;float:right">
                    <div class="form-group" style="width:380px;float:right">
                        <input class="form-control-sign_up" type="password" placeholder="Current password" id="user_pw" value=""
                           onkeyup="checkCapsLock(event)" >
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <input type="text" style="display:none;" value="비밀번호를 입력해주세요.">
                    <input type="hidden" id="pw_chk_value" name="pw_chk_value" value="">
                    <!--<p id="pw_chk" style="display:none;position:absolute;font-size:12px;color:red;bottom:-20px">Password must be at least 6 characters.<br></p>-->
                    <input type="hidden" id="pw_member" name="pw_chk_value" value="">
                    <p id="check_caps_lock" class="login_error_text" style="display:none;top: 38px;left:70px;z-index:9">
                        <img src="<?= IMAGE ?>/DentOne-Aligner-Caps Lock.png"></p>
                </div>
            </div>
            <div style="padding-bottom:30px;width:100%;float:left">
                <p class="pw_text">New password</p>
                <div id="member_pw_box" style="position:relative;float:right">
                    <div class="form-group" style="width:380px;float:right">
                        <input class="form-control-sign_up" type="password" name="member_pass" id="member_pass" placeholder="New password" value=""
                           onkeyup="checkCapsLock1(event)" style="width:380px;float:right">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <p class="pw_check" id="pw_ch_true" style="display:none;color:#07a2e8; padding-bottom: 22px; font-size: 12px;">available
                            <p>
                            <p class="pw_check" id="pw_ch_false" style="display:none;color:red; padding-bottom: 22px; font-size: 12px;">not available
                            <p>
                        <input type="text" id="check_pass" style="display:none;" value="비밀번호를 입력해주세요.">
                    <p id="pw_chk" style="position:absolute;font-size:12px;color:#07a2e8;bottom:0px">Use 8 or more characters with a mix od letters, numbers & symbols</p>
                    <input type="hidden" id="pw_member" name="pw_chk_value" value="">
                    <p id="check_caps_lock1" class="login_error_text"
                       style="display:none;top: 38px;left:70px;z-index:9"><img
                                src="<?= IMAGE ?>/DentOne-Aligner-Caps Lock.png"></p>
                </div>
            </div>
            <div style="width:100%;float:left">
                <p class="pw_text" style="width:180px">Confirm password</p>
                <div style="position:relative;float:right">
                    <div class="form-group" style="width:380px;float:right">
                        <input class="form-control-sign_up" type="password" name="member_pass_ch" id="member_pass_ch" placeholder="Confirm password"
                           onkeyup="checkCapsLock2(event)" value="" style="width:380px;float:right">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <input type="text" id="ch_check_pass" style="display:none;" value="비밀번호를 재확인 해주세요.">
                    <p id="_pass_false" style="display:none;position:absolute;font-size:12px;color:red;bottom:1px">
                        Passwords must match.</p>
                    <p id="_pass_true" style="display:none;position:absolute;font-size:12px;color:#07a2e8;bottom:1px">
                        Passwords matched.</p>
                    <input type="hidden" id="pw_chk_" name="pw_chk_" value="">
                    <p id="check_caps_lock2" class="login_error_text"
                       style="display:none;top: 38px;left:70px;z-index:9"><img
                                src="<?= IMAGE ?>/DentOne-Aligner-Caps Lock.png"></p>
                </div>
            </div>
            <div class="pw_button">
                <button type="button" class="btn_blue hover200" id="btn_pw_change">Save</button>
                <button type="button" class="btn_black hover200" id="btn_pwlayer_close">Cancel
                </button>
            </div>
        </div>
    </div>
    <!-- 비밀번호 변경 팝업 종료 -->
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
        // @pcw 기공소 정보 클릭 시 off에 체크되어 있을 경우 제출버튼 비활성화
        if($(".email_notification_radio").eq(1).is(':checked') === true) {
            $("input:checkbox[id='is_submit_checked']").prop("checked", false);
            $("input:checkbox[id='is_submit_checked']").attr("disabled", true);
        } else  {
            $("input:checkbox[id='is_submit_checked']").prop("checked", true);
            $("input:checkbox[id='is_submit_checked']").attr("disabled", false);
        }
        function profileClose() {
            var ch = 0;
            if ($("#fname").val() != $("input[name=first_name]").val()) {
                ch++;
            } else if ($("#lname").val() != $("input[name=last_name]").val()) {
                ch++;
            } else if ($("#hospital_name").val() != $("input[name=member_hospital_name]").val()) {
                ch++;
            } else if ($("#address_id").val() != $("select[name=address_id]").val()) {
                ch++;
            } else if ($("#address_id2").val() != $("select[name=address_id2]").val()) {
                ch++;
            } else if ($("#mobile_c_code").val() != $("select[name=moblile_country_code]").val()) {
                ch++;
            } else if ($("#mobile_num").val() != $("input[name=phone_number]").val()) {
                ch++;
            } else if ($("#phone_c_code").val() != $("select[name=phone_country_code]").val()) {
                ch++;
            } else if ($("#phone_num").val() != $("input[name=contact_number]").val()) {
                ch++;
            }
            if (ch > 0) {
                if (confirm("There is changed information. Do you want to end it?")) {
                    window.close();
                } else return false;
            } else {
                window.close();
            }
        }

        function updateInfo() {


            if ($('#member_hospital_name').val() == "") {
                alert('Please enter clinic name.');
                $('#member_hospital_name').focus();
                return;
            }

            if ($('#first_name').val() == "") {
                alert('Please enter first name.');
                $('#first_name').focus();
                return;
            }

            if ($('#last_name').val() == "") {
                alert('Please enter last name.');
                $('#last_name').focus();
                return;
            }

            if (!$("select[name=address_id]").val()) {
                alert('Please select delivery address.');
                $("select[name=address_id]").focus();
                return;
            }

            if (!$("select[name=address_id2]").val()) {
                alert('Please select billing address.');
                $("select[name=address_id2]").focus();
                return;
            }


            if ($('#phone_number').val() == "") {
                alert('Please enter Mobile number.');
                $('#phone_number').focus();
                return;
            }

            if ($('#contact_number').val() == "") {
                alert('Please enter Office number.');
                $('#contact_number').focus();
                return;
            }

            if ($('[name="email_notification"]:checked').val() === "On" && !$('#is_submit_checked').is(":checked")) {
                alert('Please check the checkbox.');
                $('#is_submit_checked').focus();
                return;
            }

            var formData = $("#signup_info_form").serialize();

            $.ajax({
                cache: false,
                url: "../../viewmodels/userInfoUpdate.php",
                type: 'POST',
                data: formData,
                dataType: 'html',
                success: function (data) {
                    // alert(data);
                    if (data == "true") {
                        alert("Save is complete.")
                        window.close();
                    } else {
                        alert('Error.');
                        window.close();
                    }
                }, // success
                error: function (xhr, status) {
                    alert(xhr + " : " + status);
                }
            });


        }

        $(document).ready(function () {

            // @LUCAS 저장/취소 버튼 이벤트 처리
            $("[type='button']").css("cursor", "pointer");

            $(".btn_save").on("click", function () {
                updateInfo();
            });

            $(".btn_close").on("click", function () {
                profileClose();
            });

            $('#btn_pw_change').click(function (e) {

                if ($('#user_pw').val() == "") {
                    alert('Please enter old password.');
                    $('#user_pw').focus();
                    return;
                }
                if ($('#member_pass').val() == "") {
                    alert('Please enter a new password.');
                    $('#member_pass').focus();
                    return;
                }
                if ($('#member_pass_ch').val() == "") {
                    alert('Please enter confirm new password.');
                    $('#member_pass_ch').focus();
                    return;
                }

                if ($('#pw_chk_').val() != "true") {
                    alert('Please check password.');
                    $('#member_pass').focus();
                    return;
                }

                $.ajax({
                    url: '../../viewmodels/changePw.php',
                    type: 'POST',
                    data: {
                        'user_pw': $('#user_pw').val(),
                        "member_pass": $("#member_pass").val()
                    },
                    dataType: 'html',
                    success: function (data) {
                        if (data == "check_false") {
                            alert('Please check password.');
                            $('#user_pw').focus();
                        } else if (data == "change_false") {
                            alert('Failed to change password.');
                            $('#user_pw').val('');
                            $('#member_pass').val('');
                            $('#member_pass_ch').val('');
                            $("#pw_ch_true").css("display", "none");
                            $("#pw_ch_false").css("display", "none");
                            $("#_pass_false").css("display", "none");
                            $("#_pass_true").css("display", "none");
                            $('#change_password').css("display", "none");
                        } else if (data == "suc") {
                            alert('Password has been changed.');
                            $('#user_pw').val('');
                            $('#member_pass').val('');
                            $('#member_pass_ch').val('');
                            $("#pw_ch_true").css("display", "none");
                            $("#pw_ch_false").css("display", "none");
                            $("#_pass_false").css("display", "none");
                            $("#_pass_true").css("display", "none");
                            $('#change_password').css("display", "none");
                            location.reload();
                        }

                    }

                });


            });


            $('#btn_pw_chg').click(function (e) {
                if ($('#change_password').css("display") === "block") {
                    $('#change_password').css("display", "none");
                } else {
                    $('#change_password').css("display", "block");
                }
            });

            $('#btn_pwlayer_close').click(function (e) {


                $('#user_pw').val('');
                $('#member_pass').val('');
                $('#member_pass_ch').val('');
                $("#pw_ch_true").css("display", "none");
                $("#pw_ch_false").css("display", "none");
                $("#_pass_true").css("display", "none");
                $("#_pass_false").css("display", "none");
                $('#change_password').css("display", "none");
            });

//비밀번호 정규식 체크
            $('#member_pass').keyup(function () {
                $.ajax({
                    url: '../../viewmodels/checkUserPw.php',
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


//비밀번호 재확인 체크
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


        });

        $('#adresslist').on("click", function (e) {
            window.open(
                '../../views/address.php',
                'Delivery Address List',
                'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
            );
        });


        $(function () {

            $("select[name=address_id]").animatedDropdown({
                ulMaxHeight: "120px",
            });

            $("select[name=address_id2]").animatedDropdown({
                ulMaxHeight: "120px",
            });

            $("#moblile_country_code").animatedDropdown({
                ulMaxHeight: "250px",
                ulMinWidth: '300px',
            });

            $("#phone_country_code").animatedDropdown({
                ulMaxHeight: "250px",
                ulMinWidth: '300px',
            });
        });

    </script>


<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/service_tail.php");
?>
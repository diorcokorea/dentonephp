<?php
session_start();
$config['cf_title'] = "Patient information";
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/pop_head.php");
include "../models/db/querys.php";

$patientkey = $_POST['patientkey'];

$patientServiceKey = $_POST['patientServiceKey'];

$patient_info_array = patient_r($patientkey);
$service_info_array = service_r($patientkey, $patientServiceKey);

//print_r(json_decode($service_info_array[12],true)['shipping_address']['address_id']);

$date = explode("-", $patient_info_array[4]);
$yy = $date[0];
$mm = $date[1];
$dd = $date[2];
$address_list = address_list_r($_SESSION['member_code'], null);
//$lab_list = plabList_r();[6] => 1 [7] => 처방전 작성 중

?>

<style>
    .animated_dropdown__patient_date_dd,
    .animated_dropdown__patient_date_mm,
    .animated_dropdown__patient_date_yy {
        width: 32%;
        display: inline-block;
    }

    .year-month-days {
        overflow: unset !important;
        display: flex;
        justify-content: space-between;
    }

    .year-month-days-container {
        width: 70%;
        float: right;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    /*.year-month-days-container > div {*/
    /*    margin: 0 2px;*/
    /*}*/

    .year-month-days-container .animated_dropdown select {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 50%;
        border: 0;
        display: unset !important;
    }

</style>

<div class="content" style="background-color:#fff; height:886px;">
    <form id="service_info_form" name="service_info_form" action="../viewmodels/patientprofile_update.php"
          onsubmit="return nullcheck()" method="POST">

        <input type="hidden" id="fname" value="<?= explode(",", $patient_info_array[1])[0] ?>">
        <input type="hidden" id="lname" value="<?= explode(",", $patient_info_array[1])[1] ?>">
        <input type="hidden" id="p_sex" value="<?= $patient_info_array[2] ?>">
        <input type="hidden" id="race" value="<?= $patient_info_array[6] ?>">

        <input type="hidden" id="yy" value="<?= $yy ?>">
        <input type="hidden" id="mm" value="<?= $mm ?>">
        <input type="hidden" id="dd" value="<?= $dd ?>">
        <input type="hidden" id="shipping"
               value="<?= json_decode($service_info_array[12], true)['shipping_address']['address_id'] ?>">
        <input type="hidden" id="billing"
               value="<?= json_decode($service_info_array[12], true)['billing_address']['address_id'] ?>">


        <div class="patient_inner">
            <div class="service_title" style="padding: 0; margin: 0; margin-bottom: 40px; padding-top: 40px;">
                <h2 style="margin-top:70px;">Patient information</h2>
            </div>
            <div style="float:left;width:50%;padding-right:60px;border-right: 1px solid #d2d2d2;">
                <div class="patient_text" style="margin-bottom:30px">
                    <p class="input_title">Patient ID</p>
                    <div class="form-group" style="width: 70%; float: right;">
                        <input class="form-control-sign_up" type="text" name="patient_id_text" id="patient_id"
                               value="<?= $patient_info_array[0] ?>" placeholder="Diorco" disabled>
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <input type="hidden" name="patient_id" value="<?= $patient_info_array[0] ?>" />
                    <input type="hidden" name="patient_key" value="<?= $patientkey ?>" />
                    <input type="hidden" name="patientServiceKey" value="<?= $patientServiceKey ?>" />

                </div>
                <div class="patient_text" style="margin-bottom:30px">
                    <p class="input_title">First name</p>
                    <div class="form-group" style="width: 70%; float: right;">
                        <input class="form-control-sign_up"
                               type="text" <? if ($service_info_array[6] == 18) echo "disabled"; ?> name="First_name"
                               id="First_name" value="<?= explode(",", $patient_info_array[1])[0] ?>"
                               placeholder="First name">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>
                <div class="patient_text" style="margin-bottom:30px">
                    <p class="input_title">Last name</p>
                    <div class="form-group" style="width: 70%; float: right;">
                        <input class="form-control-sign_up"
                               type="text" <? if ($service_info_array[6] == 18) echo "disabled"; ?> name="Last_name"
                               id="Last_name" value="<?= explode(",", $patient_info_array[1])[1] ?>"
                               placeholder="Last name">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>
                <div class="patient_text" style="margin-bottom:30px">
                    <p class="input_title">Gender</p>
                    <div style="padding-top:11px;width:70%;float:right">
                        <div style="float:left;margin-right:70px">
                            <input class="" type="radio"
                                   id="patient_male" <? if ($service_info_array[6] > 7 && $service_info_array[6] < 19) echo "disabled"; ?> <?php if ($patient_info_array[2] == "male") echo "checked='checked'"; ?>
                                   value="male" name="patient_sex">
                            <label for="patient_male" style="padding-left:10px">Male</label>
                        </div>
                        <div>
                            <input class="" type="radio"
                                   id="patient_female" <?php if ($patient_info_array[2] == "female") echo "checked='checked'"; ?>
                                   value="female" name="patient_sex">
                            <label for="patient_female" style="padding-left:10px">Female</label>
                        </div>
                    </div>
                </div>
                <div class="patient_text" style="margin-bottom:30px">
                    <p class="input_title">Race</p>
                    <div style="padding-top:11px;width:70%;float:right">
                        <div style="float:left;margin-right:30px">
                            <input class="" <? if ($service_info_array[6] > 7 && $service_info_array[6] < 19) echo "disabled"; ?>
                                   type="radio"
                                   id="patient_ethinicity_caucasian" <?php if ($patient_info_array[6] == "Caucasian") echo "checked='checked'"; ?>
                                   value="Caucasian" name="patient_ethinicity">
                            <label for="patient_ethinicity_caucasian" style="padding-left:10px">Caucasian</label>
                        </div>
                        <div style="float:left;margin-right:30px">
                            <input class="" <? if ($service_info_array[6] > 7 && $service_info_array[6] < 19) echo "disabled"; ?>
                                   type="radio"
                                   id="patient_ethinicity_asian" <?php if ($patient_info_array[6] == "Asian") echo "checked='checked'"; ?>
                                   value="Asian" name="patient_ethinicity">
                            <label for="patient_ethinicity_asian" style="padding-left:10px">Asian</label>
                        </div>
                        <div>
                            <input class="" <? if ($service_info_array[6] > 7 && $service_info_array[6] < 19) echo "disabled"; ?>
                                   type="radio"
                                   id="patient_ethinicity_african" <?php if ($patient_info_array[6] == "African") echo "checked='checked'"; ?>
                                   value="African" name="patient_ethinicity">
                            <label for="patient_ethinicity_african" style="padding-left:10px">African</label>
                        </div>
                    </div>
                </div>
            </div>
            <div style="float:right;width:50%;padding-left:40px">
                <div class="patient_text year-month-days" style="overflow:hidden;margin-bottom:40px;">
                    <p class="input_title">Date of birth</p>

                    <div class="year-month-days-container">
                        <select class="" required
                                oninvalid="this.setCustomValidity('Your year of birth as a 4-digit year.')" <? if ($service_info_array[6] > 7 && $service_info_array[6] < 19) echo "disabled"; ?>
                                type="text"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); setCustomValidity('');"
                                id="patient_date_yy" onchange="monthChanged();" name="patient_date_yy"
                                style="width:110px;">
                            <option value="" <?php if ($yy == null) echo "selected"; ?> disabled hidden data-is-placeholder="true">Year</option>
                            <?
                            for ($y = Date('Y'); $y >= 1900; $y--) {
                                if ($y == $yy) {
                                    echo "<option  selected value='" . $y . "'>" . $y . "</option>";
                                } else {
                                    echo "<option  value='" . $y . "'>" . $y . "</option>";
                                }
                            }
                            ?>
                        </select>



                        <select class="" type="text" style="width:97px" id="patient_date_mm" name="patient_date_mm">
                            <?
                            for ($m = 1; $m <= 12; $m++) {
                                if ($m < 10) {

                                    if ($mm == $m) {
                                        echo "<option  selected data-selected-label='0" . $m . "' value='" . $m . "'>0" . $m . "</option>";
                                    } else {
                                        echo "<option  value='" . $m . "'>0" . $m . "</option>";
                                    }
                                } else {

                                    if ($mm == $m) {
                                        echo "<option  selected value='" . $m . "'>" . $m . "</option>";
                                    } else {
                                        echo "<option  value='" . $m . "'>" . $m . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>

                        <select class="" required oninvalid="this.setCustomValidity('Please choose the day.')"
                                oninput="setCustomValidity('')"<? if ($service_info_array[6] > 7 && $service_info_array[6] < 19) echo "disabled"; ?>
                                placeholder="Day"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                id="patient_date_dd" name="patient_date_dd" disabled style="width:120px;margin:right">
                            <option value="" <?php if ($dd == null) echo "selected"; ?>  disabled hidden data-is-placeholder="true">Day</option>

                            <?
                            if ($dd != null) {
                                if ($dd < 10) {
                                    echo "<option  selected data-selected-label='0" . $dd . "' value='" . $dd . "' hidden>0" . $dd . "</option>";
                                } else {
                                    echo "<option  selected value='" . $dd . "' hidden>" . $dd . "</option>";
                                }
                            }
                            /*	if ($_SESSION['patient_date_dd'] != null) {
                                //	echo "<option  selected value='".$_SESSION['patient_date_dd']."'>".$_SESSION['patient_date_dd']."</option>";
                                //	}
                                for ($dd = 1; $dd <=31; $dd++) {
                                    if ($_SESSION['patient_date_dd']==$dd) {
                                    echo "<option  selected value='".$dd."'>".$dd."</option>";
                                    }else{
                                    echo "<option  value='".$dd."'>".$dd."</option>";
                                    }
                                }

                */
                            ?>


                        </select>
                    </div>
                </div>
                <div class="patient_text" style="overflow:hidden;margin-bottom:40px;">
                    <p class="input_title">Age</p>
                    <div class="form-group" style="width:70%; float:right;">
                        <input class="form-control-sign_up" type="text" id="patient_age" readonly disabled
                               value="<?= $patient_info_array[12] ?>" name="patient_age" placeholder="Age">
                    </div>
                </div>
                <div class="patient_text" style="overflow:hidden;margin-bottom:20px;">
                    <p class="input_title">Lab</p>
                    <div class="form-group" style="width:70%; float:right;">
                        <input class="form-control-sign_up" type="text" disabled readonly
                               value="<?= $patient_info_array[11] ?>" id="dental_lab" name="dental_lab">
                    </div>
                </div>
                <div style="width:100%; height:47px;margin-bottom:40px">
                    <p class="input_title">Delivery address</p>
                    <div class="year-month-days-container" style="cursor:default !important;">
                        <select class="shipping_address__select" required disabled
                                id="shipping_address"
                                name="shipping_address"
                                oninput="setCustomValidity('')" <? if ($service_info_array[6] == 18 || $service_info_array[6] == 19) echo "disabled"; ?>
                                style="width:100%; background:#e5e5e5 !important; cursor:default !important;"
                                placeholder="Please choose a shipping address.">
                            <? for ($i = 0; $i < count($address_list); $i++) {
                                if ($address_list[$i]['address_id'] == $address_list[$i]['main_address_id'] && json_decode($service_info_array[12], true)['shipping_address']['address_id'] == null) { ?>
                                    <option value="<?= $address_list[$i]['address_id'] ?>"
                                            selected><?= $address_list[$i]['address_name'] ?></option>
                                <? } else if (json_decode($service_info_array[12], true)['shipping_address']['address_id'] != null && json_decode($service_info_array[12], true)['shipping_address']['address_id'] == $address_list[$i]['address_id']) { ?>
                                    <option value="<?= $address_list[$i]['address_id'] ?>"
                                            selected><?= $address_list[$i]['address_name'] ?></option>
                                <? } else { ?>
                                    <option value="<?= $address_list[$i]['address_id'] ?>"><?= $address_list[$i]['address_name'] ?></option>
                                <? }
                            } ?>

                        </select>
                    </div>
                </div>

                <div style="width:100%; height:47px;">
                    <p class="input_title">Billing address</p>
                    <div class="year-month-days-container">
                        <select class="billing_address__select" required disabled
                                id="billing_address"
                                name="billing_address"
                                oninput="setCustomValidity('')" <? if ($service_info_array[6] == 18 || $service_info_array[6] == 19) echo "disabled"; ?>
                                style="width:100%; background:#e5e5e5 !important; cursor:default !important;"
                                placeholder="Please choose a billing address.">
                            <? for ($i = 0; $i < count($address_list); $i++) {
                                if ($address_list[$i]['address_id'] == $address_list[$i]['main_address_id'] && json_decode($service_info_array[12], true)['billing_address']['address_id'] == null) { ?>
                                    <option value="<?= $address_list[$i]['address_id'] ?>"
                                            selected><?= $address_list[$i]['address_name'] ?></option>
                                <? } else if (json_decode($service_info_array[12], true)['billing_address']['address_id'] != null && json_decode($service_info_array[12], true)['billing_address']['address_id'] == $address_list[$i]['address_id']) { ?>
                                    <option value="<?= $address_list[$i]['address_id'] ?>"
                                            selected><?= $address_list[$i]['address_name'] ?></option>
                                <? } else { ?>
                                    <option value="<?= $address_list[$i]['address_id'] ?>"><?= $address_list[$i]['address_name'] ?></option>
                                <? }
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--<div class="patient_warning">
                    <p class="patient_warning_icon"></p>
                    <p class="patient_warning_text">Please enter all patient information.</p>
            </div>-->

        </div>
        <div class="button_menu">
            <input type="submit" value="Save" class="btn_blue hover190">
            <a href="javascript:profileClose();" class="btn_black hover190">Close</a>
        </div>
    </form>
</div>

<script>
    function nullcheck() {

        if ($("#First_name").val() == "") {
            alert('Please enter a first name.');
            $("#First_name").focus();
            return false;
        } else if ($("#Last_name").val() == "") {
            alert('Please enter a last name.');
            $("#Last_name").focus();
            return false;
        } else {
            alert('Save is complete.');
            return true;
        }


    }


    function profileClose() {
        var ch = 0;
        if ($("#fname").val() != $("#First_name").val()) {
            ch++;
        } else if ($("#lname").val() != $("#Last_name").val()) {
            ch++;
        } else if ($("#p_sex").val() != $("input[name=patient_sex]").val()) {
            ch++;
        } else if ($("#race").val() != $("input[name=patient_ethinicity]").val()) {
            // alert($("#race").val());
            ch++;
        } else if ($("#yy").val() != $("select[name=patient_date_yy]").val()) {
            ch++;
        } else if ($("#mm").val() != $("select[name=patient_date_mm]").val()) {
            ch++;
        } else if ($("#dd").val() != $("select[name=patient_date_dd]").val()) {
            ch++;
        } else if ($("#shipping").val() != $("#shipping_address").val()) {
            ch++;
        } else if ($("#billing").val() != $("#billing_address").val()) {
            ch++;
        }

        // alert(ch);

        if (ch > 0) {
            if (confirm("There is changed information. Do you want to end it?")) {
                window.close();
            } else return false;
        } else {
            window.close();
        }
    }

    function generatePatientDateDD(day) {
        const $patient_date_dd = $('#patient_date_dd');

        for (let d = 1; d <= Number(day); d++) {
            if (d < 10) {
                var option = "<option data-selected-label='0" + d + "' value='" + d + "'>0" + d + "</option>";
                $patient_date_dd.append(option);
            } else {
                var option = "<option value='" + d + "'>" + d + "</option>";
                $patient_date_dd.append(option);
            }
        }
    }

    function monthChanged() {
        $('#patient_date_mm').prop("disabled", false).animatedDropdown({
            ulMaxHeight: "400px",
            wrapperClassName: "animated_dropdown__patient_date_mm"
        });

        if ($('#patient_date_yy').val() != null && $('#patient_date_mm').val() != null) {
            $('#patient_date_dd').prop("disabled", false);
            $('#patient_date_dd').empty();

            var day = new Date($('#patient_date_yy').val(), $('#patient_date_mm').val(), 0).getDate();
            generatePatientDateDD(day);

            $("#patient_date_dd").animatedDropdown({
                ulMaxHeight: "400px",
                wrapperClassName: "animated_dropdown__patient_date_dd"
            });
            $('#patient_date_dd').change();
        }

    }


    $(document).ready(function () {

        $(".shipping_address__select").animatedDropdown({
            ulMaxHeight: "300px",
        }).on("change", function () {
            if ($(this).find("option:selected").val()) {
                this.setCustomValidity('');
            } else {
                this.setCustomValidity("Please choose a shipping address.");
            }
        });

        $(".billing_address__select").animatedDropdown({
            ulMaxHeight: "260px",
        }).on("change", function () {
            if ($(this).find("option:selected").val()) {
                this.setCustomValidity('');
            } else {
                this.setCustomValidity("Please choose a billing address.");
            }
        });

        $("#patient_date_yy").animatedDropdown({
            ulMaxHeight: "400px",
            wrapperClassName: "animated_dropdown__patient_date_yy"
        });

        if ($('#patient_date_yy').val() != null && $('#patient_date_mm').val() != null) {
            $('#patient_date_mm').prop("disabled", false);
            $('#patient_date_dd').prop("disabled", false);
//$('#patient_date_dd').empty();

            var day = new Date($('#patient_date_yy').val(), $('#patient_date_mm').val(), 0).getDate();
            generatePatientDateDD(day);

            $("#patient_date_mm").animatedDropdown({
                ulMaxHeight: "400px",
                wrapperClassName: "animated_dropdown__patient_date_mm"
            });
            $("#patient_date_dd").animatedDropdown({
                ulMaxHeight: "400px",
                wrapperClassName: "animated_dropdown__patient_date_dd"
            });
        }


        $('#patient_date_dd').change(function () {
            const $patient_date_dd = $(this);
            if ($patient_date_dd.find("option:selected").val()) {
                $patient_date_dd.get(0).setCustomValidity('');
            }
            ageChange();
        });

        $("#patient_date_mm").change(function () {
            const $patient_date_mm = $(this);
            if ($patient_date_mm.find("option:selected").val()) {
                $patient_date_mm.get(0).setCustomValidity('');
            }
            ageChange();
        });

        $('#patient_date_yy').change(function () {
            const $patient_date_yy = $(this);
            if ($patient_date_yy.find("option:selected").val()) {
                $patient_date_yy.get(0).setCustomValidity('');
            }
            ageChange();
        });

        $('#adresslist').on("click", function (e) {

            window.open(
                '../../../views/address.php',
                'Delivery Address List ',
                'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
            );


        });

    });
</script>


<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/service_tail.php");
?>


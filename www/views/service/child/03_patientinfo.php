<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/head.service.php");
//ini_set("display_errors","1");
$service = 3;

$lab_list = plabList_r();
$address_list = address_list_r($_SESSION['member_code'], null);
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
            /*display: flex;*/
            /*flex-direction: row;*/
            /*justify-content: space-evenly;*/
            /*flex: auto;*/
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
    <div class="content" style="background-color:#fff; height:713px;">
        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/Child/service_tab.php");
        ?>
        <form id="service_info_form" name="service_info_form" action='service_info.php' method='post'>
            <input type="hidden" id="progress_num" name="progress_num" value="<? echo $progress_num; ?>" />
            <div class="patient_inner" style="overflow:hidden;height:600px;">
                <div class="service_title">
                    <h2>Patient information</h2>
                </div>
                <div style="float:left;width:50%;padding-right:60px">
                    <div class="patient_text" style="margin-bottom:20px; height:50px;">
                        <p class="input_title">Patient ID</p>
                        <div class="form-group" style="width:70%; float:right">
                            <input class="form-control-sign_up" maxlength="20" required
                                   oninvalid="this.setCustomValidity('Please enter a patient ID.')"
                                   oninput="setCustomValidity('')" type="text" name="patient_id" id="patient_id"
                                   title="Please enter a patient ID." value="<? echo $_SESSION['patient_id']; ?>"
                                   placeholder="Please enter a patient ID.">
                            <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>
                    <div class="patient_text" style="margin-bottom:20px; height:50px;">
                        <p class="input_title">First Name</p>
                        <div class="form-group" style="width:70%; float:right">
                            <input class="form-control-sign_up" maxlength="20" required
                                   oninvalid="this.setCustomValidity('Please enter a first name.')"
                                   oninput="setCustomValidity('')" type="text" name="first_name" id="first_name"
                                   value="<? echo $_SESSION['first_name']; ?>" placeholder="Please enter a first name.">
                            <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>

                    <div class="patient_text" style="margin-bottom:20px; height:50px;">
                        <p class="input_title">Last Name</p>
                        <div class="form-group" style="width:70%; float:right">
                            <input class="form-control-sign_up" maxlength="20" required
                                   oninvalid="this.setCustomValidity('Please enter a last name.')"
                                   oninput="setCustomValidity('')" type="text" name="last_name" id="last_name"
                                   value="<? echo $_SESSION['last_name']; ?>" placeholder="Please enter a last name.">
                            <div class="form-control-sign_up-border"></div>
                        </div>
                    </div>

                    <div class="patient_text" style="margin-bottom:20px">
                        <p class="input_title">Gender</p>
                        <div style="padding-top:11px;width:70%;float:right">
                            <div style="float:left;margin-right:70px">
                                <input class="" type="radio"
                                       id="patient_male" <?php if ($_SESSION['patient_sex'] == "male" || $_SESSION['patient_sex'] == null) echo "checked='checked'"; ?>
                                       value="male" name="patient_sex">
                                <label for="patient_male" style="padding-left:10px">Male</label>
                            </div>
                            <div>
                                <input class="" type="radio"
                                       id="patient_female" <?php if ($_SESSION['patient_sex'] == "female") echo "checked='checked'"; ?>
                                       value="female" name="patient_sex">
                                <label for="patient_female" style="padding-left:10px">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="patient_text" style="margin-bottom:20px">
                        <p class="input_title">Race</p>
                        <div style="padding-top:11px;width:70%;float:right">
                            <div style="float:left;margin-right:30px">
                                <input class="" type="radio"
                                       id="patient_ethinicity_caucasian" <?php if ($_SESSION['patient_ethinicity'] == "Caucasian" || $_SESSION['patient_ethinicity'] == null) echo "checked"; ?>
                                       value="caucasian" name="patient_ethinicity">
                                <label for="patient_ethinicity_caucasian" style="padding-left:10px">Caucasian</label>
                            </div>
                            <div style="float:left;margin-right:30px">
                                <input class="" type="radio"
                                       id="patient_ethinicity_asian" <?php if ($_SESSION['patient_ethinicity'] == "Asian") echo "checked"; ?>
                                       value="asian" name="patient_ethinicity">
                                <label for="patient_ethinicity_asian" style="padding-left:10px">Asian</label>
                            </div>
                            <div style="float:left;">
                                <input class="" type="radio"
                                       id="patient_ethinicity_african" <?php if ($_SESSION['patient_ethinicity'] == "African") echo "checked"; ?>
                                       value="african" name="patient_ethinicity">
                                <label for="patient_ethinicity_african" style="padding-left:10px">African</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div style="float:right;border-left: 1px solid #d2d2d2;padding-left:60px;width:50%">
                    <div class="patient_text year-month-days" style="overflow:hidden;margin-bottom:20px;">
                        <p class="input_title">Date of birth</p>

                        <div class="year-month-days-container">
                            <select class="" required
                                    oninvalid="this.setCustomValidity('Your year of birth as a 4-digit year.')"
                                    type="text"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); setCustomValidity('');"
                                    id="patient_date_yy" onchange="monthChanged();" name="patient_date_yy"
                                    style="width:32%;">
                                <option value="" <?php if ($_SESSION['patient_date_yy'] == null) echo "selected"; ?>
                                    disabled hidden data-is-placeholder="true">Year
                                </option>
                                <?
                                for ($yy = Date('Y'); $yy >= 1900; $yy--) {
                                    if ($_SESSION['patient_date_yy'] == $yy) {
                                        echo "<option  selected value='" . $yy . "'>" . $yy . "</option>";
                                    } else {
                                        echo "<option  value='" . $yy . "'>" . $yy . "</option>";
                                    }
                                }
                                ?>
                            </select>
                           
                            <select class="year-month-days__select" required
                                oninvalid="this.setCustomValidity('Please choose the month.')"
                                oninput="setCustomValidity('')" class="" type="text" style="width:32%; margin-bottom:4px;"
                                id="patient_date_mm" name="patient_date_mm" disabled onchange="monthChanged();">
                                <option value="" <?php if ($_SESSION['patient_date_mm'] == null) echo "selected"; ?>
                                        disabled hidden data-is-placeholder="true">Month
                                </option>
                                <?
                                for ($mm = 1; $mm <= 12; $mm++) {
                                    if ($mm < 10) {

                                        if ($_SESSION['patient_date_mm'] == $mm) {
                                            echo "<option  selected value='" . $mm . "'>0" . $mm . "</option>";
                                        } else {
                                            echo "<option  value='" . $mm . "'>0" . $mm . "</option>";
                                        }
                                    } else {

                                        if ($_SESSION['patient_date_mm'] == $mm) {
                                            echo "<option  selected value='" . $mm . "'>" . $mm . "</option>";
                                        } else {
                                            echo "<option  value='" . $mm . "'>" . $mm . "</option>";
                                        }


                                    }


                                }
                                ?>
                            </select>

                            <select class="year-month-days__select" required
                                oninvalid="this.setCustomValidity('Please choose the day.')"
                                oninput="setCustomValidity('')" placeholder="Day"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                id="patient_date_dd" name="patient_date_dd" disabled style="width:32%;float:right">
                            <option value="" <?php if ($_SESSION['patient_date_dd'] == null) echo "selected"; ?>
                                    disabled hidden data-is-placeholder="true">Day
                            </option>

                                <?
                                if ($_SESSION['patient_date_dd'] != null) {
                                    echo "<option  selected value='" . $_SESSION['patient_date_dd'] . "' hidden>" . $_SESSION['patient_date_dd'] . "</option>";
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
                    <div class="patient_text" style="overflow:hidden;margin-bottom:20px;">
                        <p class="input_title">Age</p>
                        <input class="form-control-sign_up" type="text" id="patient_age" readonly
                               value="<?= $_SESSION['patient_age']; ?>" name="patient_age"
                               style="background-color:#e5e5e5; width:70%; float:right;">
                    </div>
                    <div class="patient_text year-month-days" style="margin-bottom:20px;">
                        <p class="input_title">Lab</p>


                        <? if (count($lab_list) > 1) { ?>

                            <div class="year-month-days-container">
                                <select class="form-control-sign_up dental_lab__select" required
                                        oninvalid="this.setCustomValidity('Please select a lab.'); this.parentElement.focus()"
                                        oninput="this.setCustomValidity('')"
                                        style="width:70%;float:right"
                                        id="dental_lab"
                                        name="dental_lab"
                                        placeholder="Please select a lab."
                                >

                                    <? if (isset($_SESSION['dental_lab'])) {
                                        $dent_lab = explode(',', $_SESSION['dental_lab'], 2);
                                        echo "<option value='" . $_SESSION['dental_lab'] . "' selected hidden>" . $dent_lab[1] . "</option>";
                                    } else {
                                        echo "<option value='' selected disabled hidden data-is-placeholder='true'>Please select a lab.</option>";
                                    }

                                    foreach ($lab_list as $value_list) {
                                        echo "<option value='" . $value_list['account_lab_id'] . ", " . $value_list['name'] . "'>" . $value_list['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        <? } else { ?>

                            <input class="form-control-sign_up" value="<?= $lab_list[0]['name'] ?>"
                                   readonly
                                   disabled
                                   required
                                   oninvalid="this.setCustomValidity('Please select a lab.')"
                                   oninput="setCustomValidity('')" type="text" style="width:70%;float:right"
                                   id="dental_lab" name="dental_lab_text">

                            <input class="form-control-sign_up"
                                   value="<?= $lab_list[0]['account_lab_id'] ?>, <?= $lab_list[0]['name'] ?>"
                                   readonly
                                   required
                                   oninvalid="this.setCustomValidity('Please select a lab.')"
                                   oninput="setCustomValidity('')" type="hidden" style="width:70%;float:right"
                                   id="dental_lab" name="dental_lab">

                        <? } ?>

                    </div>
                    <div id="address_box" style="margin-bottom:30px">
                        <div style="width:100%; height:47px; margin-bottom:20px">
                            <p class="input_title">Delivery address</p>
                            <div class="year-month-days-container">
                                <select class="shipping_address__select" required
                                        name="shipping_address"
                                        oninput="setCustomValidity('')" style="width:100%"
                                        placeholder="Please choose a shipping address.">
                                    <? for ($i = 0; $i < count($address_list); $i++) {
                                        if ($address_list[$i]['address_id'] == $address_list[$i]['main_address_id'] && $_SESSION['shipping_address'] == null) { ?>
                                            <option value="<?= $address_list[$i]['address_id'] ?>"
                                                    selected><?= $address_list[$i]['address_name'] ?></option>
                                        <? } else if ($_SESSION['shipping_address'] != null && $_SESSION['shipping_address']['address_id'] == $address_list[$i]['address_id']) { ?>
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
                                <select class="billing_address__select" required
                                        name="billing_address" oninput="setCustomValidity('')" style="width:100%"
                                        placeholder="Please choose a billing address.">
                                    <? for ($i = 0; $i < count($address_list); $i++) {
                                        if ($address_list[$i]['address_id'] == $address_list[$i]['main_address_id'] && $_SESSION['billing_address'] == null) { ?>
                                            <option value="<?= $address_list[$i]['address_id'] ?>"
                                                    selected><?= $address_list[$i]['address_name'] ?></option>
                                        <? } else if ($_SESSION['billing_address'] != null && $_SESSION['billing_address']['address_id'] == $address_list[$i]['address_id']) { ?>
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
                    <input class="btn_blue hover395" type="button" id="adresslist" value="Delivery Address List"
                           style="margin-right:0px;width:70%;float:right;">
                </div>
                <div class="patient_warning" style="margin:0px; width:40%;">
                    <p class="patient_warning_icon"></p>
                    <p class="patient_warning_text">Please enter all patient information.</p>
                </div>
            </div>
            <div class="button_menu" style="padding:10px;">
                <input type="submit" id="btn_pre" value="Back" class="btn_black hover190">
                <input type="button" onclick="fn();" id="btn_" value="Next" class="btn_blue hover190">
                <input type="submit" style="display:none;" id="btn_next">
            </div>
        </form>
    </div>


    <script>

        function generatePatientDateDD(day) {
            const $patient_date_dd = $('#patient_date_dd');

            for (let d = 1; d <= Number(day); d++) {
                if (d < 10) {
                    var option = "<option value='" + d + "'>0" + d + "</option>";
                    $patient_date_dd.append(option);
                } else {
                    var option = "<option value='" + d + "'>" + d + "</option>";
                    $patient_date_dd.append(option);
                }
            }
        }

        function monthChanged() {
            $('#patient_date_mm').prop("disabled", false).animatedDropdown({
                ulMaxHeight: "350px",
                wrapperClassName: "animated_dropdown__patient_date_mm"
            });

            if ($('#patient_date_yy').val() != null && $('#patient_date_mm').val() != null) {
                $('#patient_date_dd').prop("disabled", false);
                $('#patient_date_dd').empty();
                var day = new Date($('#patient_date_yy').val(), $('#patient_date_mm').val(), 0).getDate();
                generatePatientDateDD(day);

                $("#patient_date_dd").animatedDropdown({
                    ulMaxHeight: "350px",
                    wrapperClassName: "animated_dropdown__patient_date_dd"
                });
                $('#patient_date_dd').change();
            }
        }

        function fn() {
            setTimeout(function () {
                $('#btn_next').click();
                $("document").blur(); // TODO @LUCAS 대박 이걸로 된다니... 6시간만에 쾌거...
            }, 200);
        }

        $(document).ready(function () {

            $(".dental_lab__select").animatedDropdown({
                ulMaxHeight: "350px",
            }).on("change", function () {
                if ($(this).find("option:selected").val()) {
                    this.setCustomValidity('');
                } else {
                    this.setCustomValidity('Please select a lab.');
                }
            });

            $(".shipping_address__select").animatedDropdown({
                ulMaxHeight: "120px",
            }).on("change", function () {
                if ($(this).find("option:selected").val()) {
                    this.setCustomValidity('');
                } else {
                    this.setCustomValidity("Please choose a shipping address.");
                }
            });

            $(".billing_address__select").animatedDropdown({
                ulMaxHeight: "120px",
            }).on("change", function () {
                if ($(this).find("option:selected").val()) {
                    this.setCustomValidity('');
                } else {
                    this.setCustomValidity("Please choose a billing address.");
                }
            });

            $("#patient_date_yy").animatedDropdown({
                ulMaxHeight: "350px",
                wrapperClassName: "animated_dropdown__patient_date_yy"
            });

            if ($('#patient_date_yy').val() != null && $('#patient_date_mm').val() != null) {
                $('#patient_date_mm').prop("disabled", false);
                $('#patient_date_dd').prop("disabled", false);
//$('#patient_date_dd').empty();
                var day = new Date($('#patient_date_yy').val(), $('#patient_date_mm').val(), 0).getDate();
                generatePatientDateDD(day);

                $("#patient_date_mm").animatedDropdown({
                    ulMaxHeight: "350px",
                    wrapperClassName: "animated_dropdown__patient_date_mm"
                });
                $("#patient_date_dd").animatedDropdown({
                    ulMaxHeight: "350px",
                    wrapperClassName: "animated_dropdown__patient_date_dd"
                });
            }

            $('#btn_pre').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='02_treatment_option2.php' />");
            });

            $('#btn_next').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='04_classification.php' />");
            });


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

        });

        $('#adresslist').on("click", function (e) {
            window.open(
                '/views/address.php',
                'Delivery Address List',
                'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
            );
        });

        function addressDivReload() {
            $("#address_box").load(location.href + " #address_box");
        }

    </script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>
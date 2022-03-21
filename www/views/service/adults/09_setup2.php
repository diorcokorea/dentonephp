<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
$service = 9;

include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/head.service.php");

if ($_SESSION['progress_num'] > $service) {
    $progress_num = $service;
}

$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'attchment_18' => 18,
            'attchment_17' => 17,
            'attchment_16' => 16,
            'attchment_15' => 15,
            'attchment_14' => 14,
            'attchment_13' => 13,
            'attchment_12' => 12,
            'attchment_11' => 11,

            'attchment_48' => 48,
            'attchment_47' => 47,
            'attchment_46' => 46,
            'attchment_45' => 45,
            'attchment_44' => 44,
            'attchment_43' => 43,
            'attchment_42' => 42,
            'attchment_41' => 41,

            'attchment_21' => 21,
            'attchment_22' => 22,
            'attchment_23' => 23,
            'attchment_24' => 24,
            'attchment_25' => 25,
            'attchment_26' => 26,
            'attchment_27' => 27,
            'attchment_28' => 28,

            'attchment_31' => 31,
            'attchment_32' => 32,
            'attchment_33' => 33,
            'attchment_34' => 34,
            'attchment_35' => 35,
            'attchment_36' => 36,
            'attchment_37' => 37,
            'attchment_38' => 38,

        );
        break;
    case 'palmer':
        $numberArray = array(
            'attchment_18' => 8,
            'attchment_17' => 7,
            'attchment_16' => 6,
            'attchment_15' => 5,
            'attchment_14' => 4,
            'attchment_13' => 3,
            'attchment_12' => 2,
            'attchment_11' => 1,

            'attchment_48' => 8,
            'attchment_47' => 7,
            'attchment_46' => 6,
            'attchment_45' => 5,
            'attchment_44' => 4,
            'attchment_43' => 3,
            'attchment_42' => 2,
            'attchment_41' => 1,

            'attchment_21' => 1,
            'attchment_22' => 2,
            'attchment_23' => 3,
            'attchment_24' => 4,
            'attchment_25' => 5,
            'attchment_26' => 6,
            'attchment_27' => 7,
            'attchment_28' => 8,

            'attchment_31' => 1,
            'attchment_32' => 2,
            'attchment_33' => 3,
            'attchment_34' => 4,
            'attchment_35' => 5,
            'attchment_36' => 6,
            'attchment_37' => 7,
            'attchment_38' => 8,

        );
        break;
    case 'universal':
        $numberArray = array(
            'attchment_18' => 1,
            'attchment_17' => 2,
            'attchment_16' => 3,
            'attchment_15' => 4,
            'attchment_14' => 5,
            'attchment_13' => 6,
            'attchment_12' => 7,
            'attchment_11' => 8,

            'attchment_48' => 32,
            'attchment_47' => 31,
            'attchment_46' => 30,
            'attchment_45' => 29,
            'attchment_44' => 28,
            'attchment_43' => 27,
            'attchment_42' => 26,
            'attchment_41' => 25,

            'attchment_21' => 9,
            'attchment_22' => 10,
            'attchment_23' => 11,
            'attchment_24' => 12,
            'attchment_25' => 13,
            'attchment_26' => 14,
            'attchment_27' => 15,
            'attchment_28' => 16,

            'attchment_31' => 24,
            'attchment_32' => 23,
            'attchment_33' => 22,
            'attchment_34' => 21,
            'attchment_35' => 20,
            'attchment_36' => 19,
            'attchment_37' => 18,
            'attchment_38' => 17,

        );
        break;
}

?>

    <div class="content" style="background-color:#fff; height:713px;">
        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
        ?>
        <form id="service_info_form" name="service_info_form" onsubmit='return nullChk09();' action='service_info.php'
              method='post'>

            <?
            echo "<input type='hidden' id='arch' value=" . $_SESSION['arch'] . ">";
            ?>

            <div class="bracket_inner">
                <div class="service_title" style="margin-bottom:0">
                    <h2 style="margin-top: -45px;">
                        <span style="color:#333;margin-right:10px"><?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></span>(<? if ($_SESSION['treatment_option1'] == "Adults") {
                            echo $_SESSION['treatment_option1'] . " including teenager,";
                        } else {
                            echo $_SESSION['treatment_option1'];
                        } ?> <?= $_SESSION['treatment_option2'] ?>)</h2>
                </div>
                <div class="used_brackets" style="overflow:hidden;">
                    <h2 style="text-align:left;margin-top:20px">3. Attachment<span style="color:red">*</span></h2>
                    <div style="margin:20px 0 0 30px;text-align:left">
                        <input type="radio"
                               id="AutomaticallyCheckBox" <? if ($_SESSION['attchment_option'] == "automatically" || $_SESSION['attchment_option'] == null) {
                            echo "checked";
                        } ?> name="attchment_option" value="automatically" style="margin-right:20px" onclick=""><label
                                for="AutomaticallyCheckBox" style="margin-right:60px">Automatically add attachments for
                            necessary teeth movement</label>
                        <input type="radio" id="SelectCheckBox" <? if ($_SESSION['attchment_option'] == "select") {
                            echo "checked";
                        } ?> name="attchment_option" value="select" style="margin-right:20px" onclick=""><label
                                for="SelectCheckBox">Select teeth to apply attachments</label>
                    </div>
                    <div style="overflow:hidden;margin:20px 0 0 30px;">
                        <p class="RL" style="margin-right:5px">R</p>
                        <div style="overflow:hidden;display:inline-block;float:left">
                            <? include("setup2_layer.php"); ?>
                            <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                <button type="button" disabled class="number" id="attchment_18"
                                        name="upperBrackets"><?= $numberArray['attchment_18'] ?></button>
                                <button type="button" disabled class="number" id="attchment_17"
                                        name="upperBrackets"><?= $numberArray['attchment_17'] ?></button>
                                <button type="button" disabled class="number" id="attchment_16"
                                        name="upperBrackets"><?= $numberArray['attchment_16'] ?></button>
                                <button type="button" disabled class="number" id="attchment_15"
                                        name="upperBrackets"><?= $numberArray['attchment_15'] ?></button>
                                <button type="button" disabled class="number" id="attchment_14"
                                        name="upperBrackets"><?= $numberArray['attchment_14'] ?></button>
                                <button type="button" disabled class="number" id="attchment_13"
                                        name="upperBrackets"><?= $numberArray['attchment_13'] ?></button>
                                <button type="button" disabled class="number" id="attchment_12"
                                        name="upperBrackets"><?= $numberArray['attchment_12'] ?></button>
                                <button type="button" disabled class="number" id="attchment_11" name="upperBrackets"
                                        style="margin:0"><?= $numberArray['attchment_11'] ?></button>
                            </div>
                            <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                <button type="button" disabled class="number" id="attchment_48"
                                        name="lowerBrackets"><?= $numberArray['attchment_48'] ?></button>
                                <button type="button" disabled class="number" id="attchment_47"
                                        name="lowerBrackets"><?= $numberArray['attchment_47'] ?></button>
                                <button type="button" disabled class="number" id="attchment_46"
                                        name="lowerBrackets"><?= $numberArray['attchment_46'] ?></button>
                                <button type="button" disabled class="number" id="attchment_45"
                                        name="lowerBrackets"><?= $numberArray['attchment_45'] ?></button>
                                <button type="button" disabled class="number" id="attchment_44"
                                        name="lowerBrackets"><?= $numberArray['attchment_44'] ?></button>
                                <button type="button" disabled class="number" id="attchment_43"
                                        name="lowerBrackets"><?= $numberArray['attchment_43'] ?></button>
                                <button type="button" disabled class="number" id="attchment_42"
                                        name="lowerBrackets"><?= $numberArray['attchment_42'] ?></button>
                                <button type="button" disabled class="number" id="attchment_41" name="lowerBrackets"
                                        style="margin:0"><?= $numberArray['attchment_41'] ?></button>

                            </div>
                        </div>
                        <div style="overflow:hidden;display:inline-block;float:left">
                            <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">

                                <button type="button" disabled class="number" id="attchment_21"
                                        name="upperBrackets"><?= $numberArray['attchment_21'] ?></button>
                                <button type="button" disabled class="number" id="attchment_22"
                                        name="upperBrackets"><?= $numberArray['attchment_22'] ?></button>
                                <button type="button" disabled class="number" id="attchment_23"
                                        name="upperBrackets"><?= $numberArray['attchment_23'] ?></button>
                                <button type="button" disabled class="number" id="attchment_24"
                                        name="upperBrackets"><?= $numberArray['attchment_24'] ?></button>
                                <button type="button" disabled class="number" id="attchment_25"
                                        name="upperBrackets"><?= $numberArray['attchment_25'] ?></button>
                                <button type="button" disabled class="number" id="attchment_26"
                                        name="upperBrackets"><?= $numberArray['attchment_26'] ?></button>
                                <button type="button" disabled class="number" id="attchment_27"
                                        name="upperBrackets"><?= $numberArray['attchment_27'] ?></button>
                                <button type="button" disabled class="number" id="attchment_28" name="upperBrackets"
                                        style="margin:0"><?= $numberArray['attchment_28'] ?></button>
                            </div>
                            <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                <button type="button" disabled class="number" id="attchment_31"
                                        name="lowerBrackets"><?= $numberArray['attchment_31'] ?></button>
                                <button type="button" disabled class="number" id="attchment_32"
                                        name="lowerBrackets"><?= $numberArray['attchment_32'] ?></button>
                                <button type="button" disabled class="number" id="attchment_33"
                                        name="lowerBrackets"><?= $numberArray['attchment_33'] ?></button>
                                <button type="button" disabled class="number" id="attchment_34"
                                        name="lowerBrackets"><?= $numberArray['attchment_34'] ?></button>
                                <button type="button" disabled class="number" id="attchment_35"
                                        name="lowerBrackets"><?= $numberArray['attchment_35'] ?></button>
                                <button type="button" disabled class="number" id="attchment_36"
                                        name="lowerBrackets"><?= $numberArray['attchment_36'] ?></button>
                                <button type="button" disabled class="number" id="attchment_37"
                                        name="lowerBrackets"><?= $numberArray['attchment_37'] ?></button>
                                <button type="button" disabled class="number" id="attchment_38" name="lowerBrackets"
                                        style="margin:0"><?= $numberArray['attchment_38'] ?></button>
                            </div>
                        </div>
                        <p class="RL" style="margin-left:5px">L</p>

                    </div>
                    <h2 style="text-align:left;margin-top:20px">4. A.P Relationship<span style="color:red">*</span></h2>
                    <div style="margin:20px 0 0 30px;text-align:left">
                        <div style="display:inline-block">
                            <p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Upper</p>
                            <div style="display:inline-block;margin-left:20px">
                                <div>
                                    <input type="radio"
                                           id="relation_upper_expansion" <? if ($_SESSION['ap_relation_upper'] == "expansion" || $_SESSION['ap_relation_upper'] == null) {
                                        echo "checked";
                                    } ?> disabled name="ap_relation_upper" value="expansion" style="margin-right:10px">
                                    <label for="relation_upper_expansion">Protrusion</label>
                                </div>
                                <div style="margin-top:10px">
                                    <input type="radio"
                                           id="relation_upper_retraction" <? if ($_SESSION['ap_relation_upper'] == "retraction") {
                                        echo "checked";
                                    } ?> disabled name="ap_relation_upper" value="retraction" style="margin-right:10px">
                                    <label for="relation_upper_retraction">Retraction</label>
                                </div>
                            </div>
                        </div>
                        <div style="display:inline-block;margin-left:60px">
                            <p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Lower</p>
                            <div style="display:inline-block;margin-left:20px">
                                <div>
                                    <input type="radio"
                                           id="relation_lower_expansion" <? if ($_SESSION['ap_relation_lower'] == "expansion" || $_SESSION['ap_relation_lower'] == null) {
                                        echo "checked";
                                    } ?> disabled name="ap_relation_lower" value="expansion" style="margin-right:10px">
                                    <label for="relation_lower_expansion">Protrusion</label>
                                </div>
                                <div style="margin-top:10px">
                                    <input type="radio"
                                           id="relation_lower_retraction" <? if ($_SESSION['ap_relation_lower'] == "retraction") {
                                        echo "checked";
                                    } ?> disabled name="ap_relation_lower" value="retraction" style="margin-right:10px">
                                    <label for="relation_lower_retraction">Retraction</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin:20px 0 0 30px;text-align:left">
                        <div style="display:inline-block">
                            <p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Canine
                                Relationship</p>
                            <div style="display:inline-block;margin-left:20px">
                                <div>
                                    <input type="radio" id="canine_maintain"
                                           name="ap_relation_canine" <? if ($_SESSION['ap_relation_canine'] == "maintain" || $_SESSION['ap_relation_canine'] == null) {
                                        echo "checked";
                                    } ?> value="maintain" style="margin-right:10px">
                                    <label for="canine_maintain">Maintain</label>
                                </div>
                                <div style="margin-top:10px">
                                    <input type="radio" id="canine_Improve"
                                           name="ap_relation_canine" <? if ($_SESSION['ap_relation_canine'] == "improve") {
                                        echo "checked";
                                    } ?> value="improve" style="margin-right:10px">
                                    <label for="canine_Improve">Improve</label>
                                </div>
                            </div>
                        </div>
                        <div style="display:inline-block;margin-left:60px">
                            <p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Molar
                                Relationship</p>
                            <div style="display:inline-block;margin-left:20px">
                                <div>
                                    <input type="radio" id="molar_maintain"
                                           name="ap_relation_molar" <? if ($_SESSION['ap_relation_molar'] == "maintain" || $_SESSION['ap_relation_molar'] == null) {
                                        echo "checked";
                                    } ?> value="maintain" style="margin-right:10px">
                                    <label for="molar_maintain">Maintain</label>
                                </div>
                                <div style="margin-top:10px">
                                    <input type="radio" id="molar_Improve"
                                           name="ap_relation_molar" <? if ($_SESSION['ap_relation_molar'] == "improve") {
                                        echo "checked";
                                    } ?> value="improve" style="margin-right:10px">
                                    <label for="molar_Improve">Improve</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="button_menu" style="padding:10px;">
                <input type="submit" id="btn_pre" value="Back" class="btn_black hover190">
                <input type="submit" id="btn_next" value="Next" class="btn_blue hover190">
            </div>
        </form>
    </div>
<?
if ($_SESSION['attchment_option'] == "select") {
    echo "<script>";
    for ($i = 0; $i < count($_SESSION['attchment_select_number']); $i++) {
        echo "$('#attchment_" . $_SESSION['attchment_select_number'][$i] . "').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#attchment_" . $_SESSION['attchment_select_number'][$i] . "').val(" . $_SESSION['attchment_select_number'][$i] . ");
	  $('#service_info_form').append(\"<input type='hidden'  name='attchment_select_number[]' id='" . $_SESSION['attchment_select_number'][$i] . "' value='" . $_SESSION['attchment_select_number'][$i] . "'>\");";
    }
    echo "</script>";
}
?>


    <script>
        $(document).ready(function () {

            $('#btn_pre').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='08_setup1.php' />");
            });

            $('#btn_next').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='10_setup3.php' />");
            });


            if ($('#arch').val() == "both" && $("#SelectCheckBox").prop("checked")) {
                $('button[name=upperBrackets]').prop('disabled', false);
                $('button[name=lowerBrackets]').prop('disabled', false);
            } else if ($('#arch').val() == "upper" && $("#SelectCheckBox").prop("checked")) {
                $('button[name=upperBrackets]').prop('disabled', false);
            } else if ($('#arch').val() == "lower" && $("#SelectCheckBox").prop("checked")) {
                $('button[name=lowerBrackets]').prop('disabled', false);
            }

            if ($('#arch').val() == "both") {
                $('input[name=ap_relation_upper]').prop('disabled', false);
                $('input[name=ap_relation_lower]').prop('disabled', false);
            } else if ($('#arch').val() == "upper") {
                $('input[name=ap_relation_upper]').prop('disabled', false);
            } else if ($('#arch').val() == "lower") {
                $('input[name=ap_relation_lower]').prop('disabled', false);
            }


            $("#AutomaticallyCheckBox").click(function () {
                $('button[name=upperBrackets]').prop('disabled', true);
                $('button[name=lowerBrackets]').prop('disabled', true);

                $('button[name=upperBrackets]').css({"background-color": "#4b4b4b"});
                $('button[name=lowerBrackets]').css({"background-color": "#4b4b4b"});
                $('button[name=upperBrackets]').val("");
                $('button[name=lowerBrackets]').val("");

            });


            $("#SelectCheckBox").click(function () {

                if ($('#arch').val() == "both" && $("#SelectCheckBox").prop("checked")) {
                    $('button[name=upperBrackets]').prop('disabled', false);
                    $('button[name=lowerBrackets]').prop('disabled', false);
                } else if ($('#arch').val() == "upper" && $("#SelectCheckBox").prop("checked")) {
                    $('button[name=upperBrackets]').prop('disabled', false);
                } else if ($('#arch').val() == "lower" && $("#SelectCheckBox").prop("checked")) {
                    $('button[name=lowerBrackets]').prop('disabled', false);
                }

            });

            $(".number").click(function (e) {
                if ($(this).val() == "") {
                    $(this).css({
                        "background-color": "#07a2e8",
                        'background-repeat': 'no-repeat',
                        'background-position': 'center'
                    });
                    $(this).val($(this).text());
                    $('#service_info_form').append("<input type='hidden' id='" + e.target.id.split("_")[1] + "' name='attchment_select_number[]' value='" + e.target.id.split("_")[1] + "'>");
                    //$(this).text('');
                } else {
                    $(this).css({"background-color": "#4b4b4b"});
                    //  $(this).text($(this).val());
                    $(this).val("");
                    $('#' + $(this).text()).remove();
                }

            });


        });

        $(document).on("keyup", "input[name^=overbite_custom_n]", function () {
            var val = $(this).val();

            if (val.replace(/[0.0-9.9]/g, "").length > 0) {
                alert("숫자만 입력해 주십시오.");
                $(this).val('');
            }

            if (val < 0.0 || val > 9.9) {
                alert("0.0~9.9mm까지 입력 가능합니다.");
                $(this).val('');
            }
        });

        $(document).on("keyup", "input[name^=overjet_custom_n]", function () {
            var val = $(this).val();

            if (val.replace(/[0.0-9.9]/g, "").length > 0) {
                alert("숫자를 입력해 주십시오.");
                $(this).val('');
            }

            if (val < 0.0 || val > 9.9) {
                alert("0.0~9.9mm까지 입력 가능합니다.");
                $(this).val('');
            }
        });


    </script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>
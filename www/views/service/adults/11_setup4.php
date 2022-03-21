<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
$service = 11;
$option_num = 9;
// if ($_SESSION['treatment_option2'] == "DentOne Regular AP" || $_SESSION['treatment_option2'] == "DentOne Regular") {
//     $option_num = 10;
// }else{
//     $option_num = 9;
// }


$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'extraction_18' => 18,
            'extraction_17' => 17,
            'extraction_16' => 16,
            'extraction_15' => 15,
            'extraction_14' => 14,
            'extraction_13' => 13,
            'extraction_12' => 12,
            'extraction_11' => 11,

            'extraction_48' => 48,
            'extraction_47' => 47,
            'extraction_46' => 46,
            'extraction_45' => 45,
            'extraction_44' => 44,
            'extraction_43' => 43,
            'extraction_42' => 42,
            'extraction_41' => 41,

            'extraction_21' => 21,
            'extraction_22' => 22,
            'extraction_23' => 23,
            'extraction_24' => 24,
            'extraction_25' => 25,
            'extraction_26' => 26,
            'extraction_27' => 27,
            'extraction_28' => 28,

            'extraction_31' => 31,
            'extraction_32' => 32,
            'extraction_33' => 33,
            'extraction_34' => 34,
            'extraction_35' => 35,
            'extraction_36' => 36,
            'extraction_37' => 37,
            'extraction_38' => 38,

        );
        break;
    case 'palmer':
        $numberArray = array(
            'extraction_18' => 8,
            'extraction_17' => 7,
            'extraction_16' => 6,
            'extraction_15' => 5,
            'extraction_14' => 4,
            'extraction_13' => 3,
            'extraction_12' => 2,
            'extraction_11' => 1,

            'extraction_48' => 8,
            'extraction_47' => 7,
            'extraction_46' => 6,
            'extraction_45' => 5,
            'extraction_44' => 4,
            'extraction_43' => 3,
            'extraction_42' => 2,
            'extraction_41' => 1,

            'extraction_21' => 1,
            'extraction_22' => 2,
            'extraction_23' => 3,
            'extraction_24' => 4,
            'extraction_25' => 5,
            'extraction_26' => 6,
            'extraction_27' => 7,
            'extraction_28' => 8,

            'extraction_31' => 1,
            'extraction_32' => 2,
            'extraction_33' => 3,
            'extraction_34' => 4,
            'extraction_35' => 5,
            'extraction_36' => 6,
            'extraction_37' => 7,
            'extraction_38' => 8,

        );
        break;
    case 'universal':
        $numberArray = array(
            'extraction_18' => 1,
            'extraction_17' => 2,
            'extraction_16' => 3,
            'extraction_15' => 4,
            'extraction_14' => 5,
            'extraction_13' => 6,
            'extraction_12' => 7,
            'extraction_11' => 8,

            'extraction_48' => 32,
            'extraction_47' => 31,
            'extraction_46' => 30,
            'extraction_45' => 29,
            'extraction_44' => 28,
            'extraction_43' => 27,
            'extraction_42' => 26,
            'extraction_41' => 25,

            'extraction_21' => 9,
            'extraction_22' => 10,
            'extraction_23' => 11,
            'extraction_24' => 12,
            'extraction_25' => 13,
            'extraction_26' => 14,
            'extraction_27' => 15,
            'extraction_28' => 16,

            'extraction_31' => 24,
            'extraction_32' => 23,
            'extraction_33' => 22,
            'extraction_34' => 21,
            'extraction_35' => 20,
            'extraction_36' => 19,
            'extraction_37' => 18,
            'extraction_38' => 17,

        );
        break;
}


?>

    <div class="content" style="background-color:#fff; height:713px;">

        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
        ?>
        <form id="service_info_form" onsubmit='return nullChk07();' name="service_info_form" action='service_info.php'
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
                <div class="used_brackets">
                    <h2 style="text-align:left;margin-top:20px">8. Occlusal opening device<span
                                style="color:red">*</span></h2>
                    <div style="margin:20px 0 0 30px;text-align:left">
                        <div>
                            <input type="radio" id="occlusal_none"
                                   name="occ_opening_device_option" <? if ($_SESSION['occ_opening_device_option'] == "none" || $_SESSION['occ_opening_device_option'] == null) {
                                echo "checked";
                            } ?> value="none" style="margin-right:20px">
                            <label for="occlusal_none" style="margin-right:60px">None</label>
                        </div>
                        <div style="margin-top:20px">
                            <div>
                                <input type="radio" id="occlusal_bite" name="occ_opening_device_option"
                                    <? if ($_SESSION['occ_opening_device_option'] == "bite_ramp") {
                                        echo "checked";
                                    } ?>
                                       value="bite_ramp" style="margin-right:20px">
                                <label for="occlusal_bite" style="margin-right:60px">Bite ramp on the lingual side of
                                    the maxilla</label>
                            </div>
                            <div style="margin:10px 0 0 30px;text-align:left">
                                <div>
                                    <input type="radio"
                                           id="Incisor" <? if ($_SESSION['occ_opening_device_type'] == "incisor") {
                                        echo "checked";
                                    } else if ($_SESSION['occ_opening_device_option'] != "bite_ramp") {
                                        echo "disabled";
                                    } ?> name="occ_opening_device_type" value="incisor" style="margin-right:20px">
                                    <label for="Incisor" style="margin-right:60px">Incisor</label>
                                    <input type="checkbox" id="Central_incisor"
                                           name="occ_opening_device_central_incisor" <? if ($_SESSION['occ_opening_device_central_incisor'] == "central" && $_SESSION['occ_opening_device_type'] == "incisor") {
                                        echo "checked";
                                    } else if ($_SESSION['occ_opening_device_option'] != "bite_ramp") {
                                        echo "disabled";
                                    } ?> value="central" style="margin-right:10px">
                                    <label for="Central_incisor" style="margin-right:40px">Central incisor</label>
                                    <input type="checkbox" id="Lateral_incisor"
                                           name="occ_opening_device_lateral_incisor" <? if ($_SESSION['occ_opening_device_lateral_incisor'] == "lateral" && $_SESSION['occ_opening_device_type'] == "incisor") {
                                        echo "checked";
                                    } else if ($_SESSION['occ_opening_device_option'] != "bite_ramp") {
                                        echo "disabled";
                                    } ?> value="lateral" style="margin-right:10px">
                                    <label for="Lateral_incisor" style="margin-right:60px">Lateral incisor</label>
                                </div>
                                <div style="margin-top:10px">
                                    <div>
                                        <input type="radio"
                                               id="Canine" <? if ($_SESSION['occ_opening_device_type'] == "canine") {
                                            echo "checked";
                                        } else if ($_SESSION['occ_opening_device_option'] != "bite_ramp") {
                                            echo "disabled";
                                        } ?> name="occ_opening_device_type" value="canine" style="margin-right:20px"
                                               onclick="">
                                        <label for="Canine" style="margin-right:60px">Canine</label>
                                    </div>
                                    <div style="margin:20px 0 0 30px;text-align:left">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? /*if ($_SESSION['treatment_option2'] == "DentOne Regular AP" || $_SESSION['treatment_option2'] == "DentOne Regular") { ?>
	<!-- Regular_option Start -->
			<h2 style="text-align:left;margin-top:30px">9. In case of posterior cross-occlusion<span style="color:red">*</span></h2>
			<div style="margin:20px 0 0 30px;text-align:left">
				<input type="radio" <?if($_SESSION['cross_occlusion'] == "align" || $_SESSION['cross_occlusion'] == null ){ echo "checked";}?> id="occlusion_align"   name="cross_occlusion" value="occlusion_align" style="margin-right:20px"><label for="occlusion_align" style="margin-right:60px">Align</label>
				<input type="radio" <?if($_SESSION['cross_occlusion'] == "not_align"){ echo "checked";}?> id="occlusion_not_align"  name="cross_occlusion" value="tooth_e" style="margin-right:20px"><label for="occlusion_not_align">Do not align</label>
			</div>
	<!-- Regular_option End -->		
<?}*/ ?>
                    <h2 style="text-align:left;margin-top:20px"><?= $option_num ?>. Extraction<span
                                style="color:red">*</span></h2>
                    <div style="margin:20px 0 0 30px;text-align:left">
                        <input type="radio" <? if ($_SESSION['extraction'] == "none_tooth_e" || $_SESSION['extraction'] == null) {
                            echo "checked";
                        } ?> id="none_tooth_extraction" name="extraction" value="none_tooth_e"
                               style="margin-right:20px"><label for="none_tooth_extraction" style="margin-right:60px">Non
                            Extraction</label>
                        <input type="radio" <? if ($_SESSION['extraction'] == "tooth_e") {
                            echo "checked";
                        } ?> id="tooth_extraction" name="extraction" value="tooth_e" style="margin-right:20px"><label
                                for="tooth_extraction">Extraction</label>
                    </div>
                    <div style="margin:20px 0 0 30px;text-align:left;overflow:hidden">
                        <p class="RL" style="margin-right:5px">R</p>
                        <div style="overflow:hidden;display:inline-block;float:left">
                            <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                <button type="button" class="number" id="extraction_18"
                                        name="upperBrackets"><?= $numberArray['extraction_18'] ?></button>
                                <button type="button" class="number" id="extraction_17"
                                        name="upperBrackets"><?= $numberArray['extraction_17'] ?></button>
                                <button type="button" class="number" id="extraction_16"
                                        name="upperBrackets"><?= $numberArray['extraction_16'] ?></button>
                                <button type="button" class="number" id="extraction_15"
                                        name="upperBrackets"><?= $numberArray['extraction_15'] ?></button>
                                <button type="button" class="number" id="extraction_14"
                                        name="upperBrackets"><?= $numberArray['extraction_14'] ?></button>
                                <button type="button" class="number" id="extraction_13"
                                        name="upperBrackets"><?= $numberArray['extraction_13'] ?></button>
                                <button type="button" class="number" id="extraction_12"
                                        name="upperBrackets"><?= $numberArray['extraction_12'] ?></button>
                                <button type="button" class="number" id="extraction_11" name="upperBrackets"
                                        style="margin:0"><?= $numberArray['extraction_11'] ?></button>
                            </div>
                            <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                <button type="button" class="number" id="extraction_48"
                                        name="lowerBrackets"><?= $numberArray['extraction_48'] ?></button>
                                <button type="button" class="number" id="extraction_47"
                                        name="lowerBrackets"><?= $numberArray['extraction_47'] ?></button>
                                <button type="button" class="number" id="extraction_46"
                                        name="lowerBrackets"><?= $numberArray['extraction_46'] ?></button>
                                <button type="button" class="number" id="extraction_45"
                                        name="lowerBrackets"><?= $numberArray['extraction_45'] ?></button>
                                <button type="button" class="number" id="extraction_44"
                                        name="lowerBrackets"><?= $numberArray['extraction_44'] ?></button>
                                <button type="button" class="number" id="extraction_43"
                                        name="lowerBrackets"><?= $numberArray['extraction_43'] ?></button>
                                <button type="button" class="number" id="extraction_42"
                                        name="lowerBrackets"><?= $numberArray['extraction_42'] ?></button>
                                <button type="button" class="number" id="extraction_41" name="lowerBrackets"
                                        style="margin:0"><?= $numberArray['extraction_41'] ?></button>

                            </div>
                        </div>
                        <div style="overflow:hidden;display:inline-block;float:left">
                            <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">

                                <button type="button" class="number" id="extraction_21"
                                        name="upperBrackets"><?= $numberArray['extraction_21'] ?></button>
                                <button type="button" class="number" id="extraction_22"
                                        name="upperBrackets"><?= $numberArray['extraction_22'] ?></button>
                                <button type="button" class="number" id="extraction_23"
                                        name="upperBrackets"><?= $numberArray['extraction_23'] ?></button>
                                <button type="button" class="number" id="extraction_24"
                                        name="upperBrackets"><?= $numberArray['extraction_24'] ?></button>
                                <button type="button" class="number" id="extraction_25"
                                        name="upperBrackets"><?= $numberArray['extraction_25'] ?></button>
                                <button type="button" class="number" id="extraction_26"
                                        name="upperBrackets"><?= $numberArray['extraction_26'] ?></button>
                                <button type="button" class="number" id="extraction_27"
                                        name="upperBrackets"><?= $numberArray['extraction_27'] ?></button>
                                <button type="button" class="number" id="extraction_28" name="upperBrackets"
                                        style="margin:0"><?= $numberArray['extraction_28'] ?></button>
                            </div>
                            <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                <button type="button" class="number" id="extraction_31"
                                        name="lowerBrackets"><?= $numberArray['extraction_31'] ?></button>
                                <button type="button" class="number" id="extraction_32"
                                        name="lowerBrackets"><?= $numberArray['extraction_32'] ?></button>
                                <button type="button" class="number" id="extraction_33"
                                        name="lowerBrackets"><?= $numberArray['extraction_33'] ?></button>
                                <button type="button" class="number" id="extraction_34"
                                        name="lowerBrackets"><?= $numberArray['extraction_34'] ?></button>
                                <button type="button" class="number" id="extraction_35"
                                        name="lowerBrackets"><?= $numberArray['extraction_35'] ?></button>
                                <button type="button" class="number" id="extraction_36"
                                        name="lowerBrackets"><?= $numberArray['extraction_36'] ?></button>
                                <button type="button" class="number" id="extraction_37"
                                        name="lowerBrackets"><?= $numberArray['extraction_37'] ?></button>
                                <button type="button" class="number" id="extraction_38" name="lowerBrackets"
                                        style="margin:0"><?= $numberArray['extraction_38'] ?></button>
                            </div>
                        </div>
                        <p class="RL" style="margin-left:5px">L</p>
                    </div>
                </div>

            </div>

            <div class="button_menu" style="padding:10px;">
<!--                <a href="javascript:servicePopupClose();" class="service_close">Close</a>-->
                <input type="submit" id="btn_pre" value="Back" class="btn_black hover190">
                <input type="submit" id="btn_next" value="Next" class="btn_blue hover190">
            </div>
        </form>
    </div>
<?
if ($_SESSION['extraction'] == "tooth_e") {
    echo "<script>";
    if (count($_SESSION['e_select_number']) > 0) {
        for ($i = 0; $i < count($_SESSION['e_select_number']); $i++) {
            echo "$('#extraction_" . $_SESSION['e_select_number'][$i] . "').css({'background':'url(../../../resource/images/extraction_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#extraction_" . $_SESSION['e_select_number'][$i] . "').val(" . $_SESSION['e_select_number'][$i] . ");
	  $('#service_info_form').append(\"<input type='hidden'  name='e_select_number[]' id='" . $_SESSION['e_select_number'][$i] . "' value='" . $_SESSION['e_select_number'][$i] . "'>\");
         $('#extraction_" . $_SESSION['e_select_number'][$i] . "').text('');";
        }
    }
    echo "</script>";
}

?>

    <script>
        $(document).ready(function () {

            $('#btn_pre').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='10_setup3.php' />");
            });

            $('#btn_next').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='12_setup5.php' />");
            });


            $('.number').prop('disabled', true);


            if ($('#arch').val() != "lower") {

                if ($(':input:radio[name=extraction]:checked').val() == "tooth_e") {
                    $('button[name=upperBrackets]').prop('disabled', false);
                }

            }


            if ($('#arch').val() != "upper") {

                if ($(':input:radio[name=extraction]:checked').val() == "tooth_e") {
                    $('button[name=lowerBrackets]').prop('disabled', false);
                }
            }


            $("input[name=occ_opening_device_option]").click(function (e) {
                if ($(this).val() != "none") {
                    if ($("#Central_incisor").is(":checked") || $("#Lateral_incisor").is(":checked")) {
                        return;
                    }

                    $("input[name=occ_opening_device_type]").prop("disabled", false);
                    $("#Incisor").prop("checked", true);
                    $("#Central_incisor").prop("disabled", false);
                    $("#Lateral_incisor").prop("disabled", false);

                    $("#Central_incisor").prop("checked", true);

                } else {

                    $("input[name=occ_opening_device_type]").prop("disabled", true);
                    $("input[name=occ_opening_device_type]").prop("checked", false);

                    $("#Central_incisor").prop("disabled", true);
                    $("#Lateral_incisor").prop("disabled", true);
                    $("#Central_incisor").prop("checked", false);
                    $("#Lateral_incisor").prop("checked", false);

                }

            });

            $("input[name=occ_opening_device_type]").click(function (e) {

                if ($(this).val() != "incisor") {
                    $("#Central_incisor").prop("disabled", true);
                    $("#Lateral_incisor").prop("disabled", true);

                    $("#Central_incisor").prop("checked", false);
                    $("#Lateral_incisor").prop("checked", false);

                } else {
                    if ($("#Central_incisor").is(":checked") || $("#Lateral_incisor").is(":checked")) {
                        return;
                    }
                    $("#Central_incisor").prop("disabled", false);
                    $("#Lateral_incisor").prop("disabled", false);
                    $("#Central_incisor").prop("checked", true);
                }


            });


            /*	$("input[name=incisor_option]").click(function(e) {
                        var id = this.id;
                        $("input[name=incisor_option]").each(function(e){
                            if (this.id != id)
                            {
                                $(this).prop("checked",false);
                            }
                        });
                });*/


            $("input[name=extraction]").click(function (e) {
                if ($(this).val() == "tooth_e" && $('#arch').val() == "both") {
                    $('button[name=upperBrackets]').prop('disabled', false);
                    $('button[name=lowerBrackets]').prop('disabled', false);
                } else if ($(this).val() == "tooth_e" && $('#arch').val() == "upper") {
                    $('button[name=upperBrackets]').prop('disabled', false);
                } else if ($(this).val() == "tooth_e" && $('#arch').val() == "lower") {
                    $('button[name=lowerBrackets]').prop('disabled', false);
                } else {
                    $('.number').prop('disabled', true);
                    $(".number").each(function (e) {
                        if ($(this).val() != "") {
                            $(this).css({"background": ""});
                            $(this).text($(this).val());
                            $(this).val("");
                            $('#' + $(this).text()).remove();
                        }
                    });
                }
            });

            $(".number").click(function (e) {
                if ($(this).val() == "") {
                    $(this).css({
                        "background": "url(../../../resource/images/extraction_icon.png)",
                        'background-repeat': 'no-repeat',
                        'background-position': 'center'
                    });
                    $(this).val($(this).text());
                    $('#service_info_form').append("<input type='hidden' id='" + e.target.id.split("_")[1] + "' name='e_select_number[]' value='" + e.target.id.split("_")[1] + "'>");
                    $(this).text('');
                } else {
                    $(this).css({"background": ""});
                    $(this).text($(this).val());
                    $(this).val("");
                    $('#' + e.target.id.split("_")[1]).remove();
                }

            });


        });

    </script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>
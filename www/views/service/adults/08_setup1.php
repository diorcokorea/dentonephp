<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
$service = 8;

include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/head.service.php");

if ($_SESSION['progress_num'] > $service) {
    $progress_num = $service;
}

//print_r($_SESSION['clinic_settings']['numbering_option']);
$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'diagnostics_18' => 18,
            'diagnostics_17' => 17,
            'diagnostics_16' => 16,
            'diagnostics_15' => 15,
            'diagnostics_14' => 14,
            'diagnostics_13' => 13,
            'diagnostics_12' => 12,
            'diagnostics_11' => 11,

            'diagnostics_48' => 48,
            'diagnostics_47' => 47,
            'diagnostics_46' => 46,
            'diagnostics_45' => 45,
            'diagnostics_44' => 44,
            'diagnostics_43' => 43,
            'diagnostics_42' => 42,
            'diagnostics_41' => 41,

            'diagnostics_21' => 21,
            'diagnostics_22' => 22,
            'diagnostics_23' => 23,
            'diagnostics_24' => 24,
            'diagnostics_25' => 25,
            'diagnostics_26' => 26,
            'diagnostics_27' => 27,
            'diagnostics_28' => 28,

            'diagnostics_31' => 31,
            'diagnostics_32' => 32,
            'diagnostics_33' => 33,
            'diagnostics_34' => 34,
            'diagnostics_35' => 35,
            'diagnostics_36' => 36,
            'diagnostics_37' => 37,
            'diagnostics_38' => 38,

        );
        break;
    case 'palmer':
        $numberArray = array(
            'diagnostics_18' => 8,
            'diagnostics_17' => 7,
            'diagnostics_16' => 6,
            'diagnostics_15' => 5,
            'diagnostics_14' => 4,
            'diagnostics_13' => 3,
            'diagnostics_12' => 2,
            'diagnostics_11' => 1,

            'diagnostics_48' => 8,
            'diagnostics_47' => 7,
            'diagnostics_46' => 6,
            'diagnostics_45' => 5,
            'diagnostics_44' => 4,
            'diagnostics_43' => 3,
            'diagnostics_42' => 2,
            'diagnostics_41' => 1,

            'diagnostics_21' => 1,
            'diagnostics_22' => 2,
            'diagnostics_23' => 3,
            'diagnostics_24' => 4,
            'diagnostics_25' => 5,
            'diagnostics_26' => 6,
            'diagnostics_27' => 7,
            'diagnostics_28' => 8,

            'diagnostics_31' => 1,
            'diagnostics_32' => 2,
            'diagnostics_33' => 3,
            'diagnostics_34' => 4,
            'diagnostics_35' => 5,
            'diagnostics_36' => 6,
            'diagnostics_37' => 7,
            'diagnostics_38' => 8,

        );
        break;
    case 'universal':
        $numberArray = array(
            'diagnostics_18' => 1,
            'diagnostics_17' => 2,
            'diagnostics_16' => 3,
            'diagnostics_15' => 4,
            'diagnostics_14' => 5,
            'diagnostics_13' => 6,
            'diagnostics_12' => 7,
            'diagnostics_11' => 8,

            'diagnostics_48' => 32,
            'diagnostics_47' => 31,
            'diagnostics_46' => 30,
            'diagnostics_45' => 29,
            'diagnostics_44' => 28,
            'diagnostics_43' => 27,
            'diagnostics_42' => 26,
            'diagnostics_41' => 25,

            'diagnostics_21' => 9,
            'diagnostics_22' => 10,
            'diagnostics_23' => 11,
            'diagnostics_24' => 12,
            'diagnostics_25' => 13,
            'diagnostics_26' => 14,
            'diagnostics_27' => 15,
            'diagnostics_28' => 16,

            'diagnostics_31' => 24,
            'diagnostics_32' => 23,
            'diagnostics_33' => 22,
            'diagnostics_34' => 21,
            'diagnostics_35' => 20,
            'diagnostics_36' => 19,
            'diagnostics_37' => 18,
            'diagnostics_38' => 17,

        );
        break;
}


?>

    <div class="content" style="background-color:#fff; height:713px;">
        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
        ?>

        <form id="service_info_form" name="service_info_form" action='service_info.php' method='post'>


            <div class="bracket_inner">
                <div class="service_title" style="margin-bottom:20px">
                    <h2 style="margin-top: -45px;">
                        <span style="color:#333;margin-right:10px"><?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></span>
                        (<? if ($_SESSION['treatment_option1'] == "Adults") {
                            echo $_SESSION['treatment_option1'] . " including teenager,";
                        } else {
                            echo $_SESSION['treatment_option1'];
                        } ?> <?= $_SESSION['treatment_option2'] ?>)</h2>
                </div>
                <div class="indirect_System">
                    <h2 style="text-align:left;margin-top:40px">1. Arch selection for treatment<span
                                style="color:red">*</span></h2>
                    <div style="margin:20px 0 0 30px">
                        <input type="radio" id="bothCheckBox"
                               name="arch" <? if ($_SESSION['arch'] == "both" || $_SESSION['arch'] == null) {
                            echo "checked";
                        } ?> value="both" style="margin-right:20px" onclick="">
                        <label for="bothCheckBox" style="margin-right:60px">Both arches</label>
                        <input type="radio" id="upperCheckBox" name="arch" <? if ($_SESSION['arch'] == "upper") {
                            echo "checked";
                        } ?> value="upper" style="margin-right:20px" onclick="">
                        <label for="upperCheckBox" style="margin-right:60px">Upper</label>
                        <input type="radio" id="lowerCheckBox" name="arch" <? if ($_SESSION['arch'] == "lower") {
                            echo "checked";
                        } ?> value="lower" style="margin-right:20px" onclick="">
                        <label for="lowerCheckBox">Lower</label>
                    </div>
                    <div style="display:none">
                        <h2 style="text-align:left;margin-top:40px">2. Tray Sections<span style="color:red">*</span>
                        </h2>
                        <div style="overflow:hidden;margin:20px 0 0 30px">
                            <div>
                                <p style="float:left;margin-right:60px">Upper</p>
                                <input type="radio"
                                       name="tray_section_u" <? if ($_SESSION['tray_section_u'] == "1 Piece" || $_SESSION['tray_section_u'] == null) {
                                    echo "checked";
                                } ?> id="u_ts_1p" value="1 Piece" style="margin-right:30px" disabled><label
                                        for="u_ts_1p" style="margin-right:60px">1 Piece</label>
                                <input type="radio"
                                       name="tray_section_u" <? if ($_SESSION['tray_section_u'] == "Midline Split") {
                                    echo "checked";
                                } ?> id="u_ts_ms" value="Midline Split" style="margin-right:30px" disabled><label
                                        for="u_ts_ms" style="margin-right:60px">Midline Split</label>
                                <input type="radio"
                                       name="tray_section_u" <? if ($_SESSION['tray_section_u'] == "3 Piece") {
                                    echo "checked";
                                } ?> id="u_ts_3p" value="3 Piece" style="margin-right:30px" disabled><label
                                        for="u_ts_3p" style="margin-right:60px">3 Piece</label>
                            </div>
                            <div style="margin-top:20px">
                                <p style="float:left;margin-right:60px">Lower</p>
                                <input type="radio"
                                       name="tray_section_l" <? if ($_SESSION['tray_section_l'] == "1 Piece" || $_SESSION['tray_section_l'] == null) {
                                    echo "checked";
                                } ?> id="l_ts_1p" value="1 Piece" style="margin-right:30px" disabled><label
                                        for="l_ts_1p" style="margin-right:60px">1 Piece</label>
                                <input type="radio"
                                       name="tray_section_l" <? if ($_SESSION['tray_section_l'] == "Midline Split") {
                                    echo "checked";
                                } ?> id="l_ts_ms" value="Midline Split" style="margin-right:30px" disabled><label
                                        for="l_ts_ms" style="margin-right:60px">Midline Split</label>
                                <input type="radio"
                                       name="tray_section_l" <? if ($_SESSION['tray_section_l'] == "3 Piece") {
                                    echo "checked";
                                } ?> id="l_ts_3p" value="3 Piece" style="margin-right:30px" disabled><label
                                        for="l_ts_3p" style="margin-right:60px">3 Piece</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="used_brackets" style="margin-top:40px;overflow:hidden;">
                    <h2>2. Please select full diagnostics<span style="color:red">*</span></h2>
                    <div style="text-align:center; width: 87%;margin-left:30px">
                        <div style="overflow:hidden;display:inline-block">
                            <p style="text-align:left;margin:20px 0">(Implant, Telescopic crown, Veneered crown)</p>
                            <p class="RL" style="margin-right:5px">R</p>
                            <div style="overflow:hidden;display:inline-block;float:left">
                                <? include("setup2_layer.php"); ?>
                                <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                    <button type="button" disabled class="number" id="diagnostics_18"
                                            name="upperBrackets"><?= $numberArray['diagnostics_18'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_17"
                                            name="upperBrackets"><?= $numberArray['diagnostics_17'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_16"
                                            name="upperBrackets"><?= $numberArray['diagnostics_16'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_15"
                                            name="upperBrackets"><?= $numberArray['diagnostics_15'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_14"
                                            name="upperBrackets"><?= $numberArray['diagnostics_14'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_13"
                                            name="upperBrackets"><?= $numberArray['diagnostics_13'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_12"
                                            name="upperBrackets"><?= $numberArray['diagnostics_12'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_11"
                                            name="upperBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_11'] ?></button>
                                </div>
                                <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                    <button type="button" disabled class="number" id="diagnostics_48"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_48'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_47"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_47'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_46"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_46'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_45"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_45'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_44"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_44'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_43"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_43'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_42"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_42'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_41"
                                            name="lowerBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_41'] ?></button>

                                </div>
                            </div>
                            <div style="overflow:hidden;display:inline-block;float:left">
                                <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">

                                    <button type="button" disabled class="number" id="diagnostics_21"
                                            name="upperBrackets"><?= $numberArray['diagnostics_21'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_22"
                                            name="upperBrackets"><?= $numberArray['diagnostics_22'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_23"
                                            name="upperBrackets"><?= $numberArray['diagnostics_23'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_24"
                                            name="upperBrackets"><?= $numberArray['diagnostics_24'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_25"
                                            name="upperBrackets"><?= $numberArray['diagnostics_25'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_26"
                                            name="upperBrackets"><?= $numberArray['diagnostics_26'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_27"
                                            name="upperBrackets"><?= $numberArray['diagnostics_27'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_28"
                                            name="upperBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_28'] ?></button>
                                </div>
                                <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                    <button type="button" disabled class="number" id="diagnostics_31"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_31'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_32"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_32'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_33"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_33'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_34"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_34'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_35"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_35'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_36"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_36'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_37"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_37'] ?></button>
                                    <button type="button" disabled class="number" id="diagnostics_38"
                                            name="lowerBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_38'] ?></button>
                                </div>
                            </div>
                            <p class="RL" style="margin-left:5px">L</p>

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
if (isset($_SESSION['diag_select_number'])) {
    echo "<script>";
    for ($i = 0; $i < count($_SESSION['diag_select_number']); $i++) {
        $number_values = explode(',', $_SESSION['diag_select_number'][$i], 2);
        if ($number_values[1] == "crown") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_" . $number_values[0] . "').val($('#diagnostics_" . $number_values[0] . "').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='" . $number_values[0] . "' value='" . $number_values[0] . ",crown'>\");
         $('#diagnostics_" . $number_values[0] . "').text('');";

        } else if ($number_values[1] == "implant") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/implant_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_" . $number_values[0] . "').val($('#diagnostics_" . $number_values[0] . "').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='" . $number_values[0] . "' value='" . $number_values[0] . ",implant'>\");
         $('#diagnostics_" . $number_values[0] . "').text('');";

        } else if ($number_values[1] == "telescopic_crown") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/Telescopic_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_" . $number_values[0] . "').val($('#diagnostics_" . $number_values[0] . "').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='" . $number_values[0] . "' value='" . $number_values[0] . ",telescopic_crown'>\");
         $('#diagnostics_" . $number_values[0] . "').text('');";

        } else if ($number_values[1] == "veneered_crown") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/Veneered_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_" . $number_values[0] . "').val($('#diagnostics_" . $number_values[0] . "').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='" . $number_values[0] . "' value='" . $number_values[0] . ",veneered_crown'>\");
         $('#diagnostics_" . $number_values[0] . "').text('');";

        }
    }
    echo "</script>";
}
?>


    <script>
        $(document).ready(function () {

            $('#btn_pre').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='07_radiograph.php' />");
            });

            $('#btn_next').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='09_setup2.php' />");
            });

            $('input[name=arch]').each(function (i) {
                if ($(this).is(":checked")) {
                    if ($(this).val() == "both") {
                        $('button[name=upperBrackets]').prop('disabled', false);
                        $('button[name=lowerBrackets]').prop('disabled', false);

                        $('input[name=tray_section_u]').prop('disabled', false);
                        $('input[name=tray_section_l]').prop('disabled', false);
                    } else if ($(this).val() == "upper") {
                        $('button[name=upperBrackets]').prop('disabled', false);
                        $('input[name=tray_section_u]').prop('disabled', false);
                    } else if ($(this).val() == "lower") {
                        $('button[name=lowerBrackets]').prop('disabled', false);
                        $('input[name=tray_section_l]').prop('disabled', false);
                    }
                }
            });

            $('input[name=arch]').on('click', function (i) {
                if ($(this).val() == "both") {
                    $('button[name=upperBrackets]').prop('disabled', false);
                    $('button[name=lowerBrackets]').prop('disabled', false);
                    $('input[name=tray_section_u]').prop('disabled', false);
                    $('input[name=tray_section_l]').prop('disabled', false);
                } else if ($(this).val() == "upper") {
                    $('button[name=upperBrackets]').prop('disabled', false);
                    $('input[name=tray_section_u]').prop('disabled', false);
                    $('button[name=lowerBrackets]').prop('disabled', true);
                    $('input[name=tray_section_l]').prop('disabled', true);


                    var num_list = ["31", "32", "33", "34", "35", "36", "37", "38", "41", "42", "43", "44", "45", "46", "47", "48"];
                    for (let index = 0; index < num_list.length; index++) {
                        $("#diagnostics_" + num_list[index]).css("background", "");
                        //  var  targetNum =  $("#diagnostics_"+ $('#selec_target').val()).val().split(",", 2);
                        if ($("#diagnostics_" + num_list[index]).text() == "") {
                            $("#diagnostics_" + num_list[index]).text($("#diagnostics_" + num_list[index]).val());
                        }
                        $("#diagnostics_" + num_list[index]).val('');
                        $('.brk_diagnostics_select').css('display', 'none');
                        $('#' + num_list[index]).remove();
                    }


                    $.ajax({
                        url: 'service_info.php',
                        type: 'POST',
                        data: {'brk_info_delete': 'true'},
                        dataType: 'html',
                        success: function (data) {
                            if (data == "true") {
                                //alert("삭제되었습니다.");
                            }
                        }
                    });


                } else if ($(this).val() == "lower") {
                    $('button[name=lowerBrackets]').prop('disabled', false);
                    $('input[name=tray_section_l]').prop('disabled', false);
                    $('button[name=upperBrackets]').prop('disabled', true);
                    $('input[name=tray_section_u]').prop('disabled', true);

                    var num_list = ["11", "12", "13", "14", "15", "16", "17", "18", "21", "22", "23", "24", "25", "26", "27", "28"];

                    for (let index = 0; index < num_list.length; index++) {
                        $("#diagnostics_" + num_list[index]).css("background", "");
                        //  var  targetNum =  $("#diagnostics_"+ $('#selec_target').val()).val().split(",", 2);
                        if ($("#diagnostics_" + num_list[index]).text() == "") {
                            $("#diagnostics_" + num_list[index]).text($("#diagnostics_" + num_list[index]).val());
                        }

                        $("#diagnostics_" + num_list[index]).val('');
                        $('.brk_diagnostics_select').css('display', 'none');
                        $('#' + num_list[index]).remove();
                    }


                    $.ajax({
                        url: 'service_info.php',
                        type: 'POST',
                        data: {'brk_info_delete': 'true', 'del_lower': 'true'},
                        dataType: 'html',
                        success: function (data) {
                            if (data == "true") {
                                //alert("삭제되었습니다.");
                            }
                        }
                    });


                }


            });


            if ($('#upperChecked').val() == "true") {
                $('button[name=upperBrackets]').prop('disabled', false);
            }
            if ($('#lowerChecked').val() == "true") {
                $('button[name=lowerBrackets]').prop('disabled', false);
            }


            $('.number').click(function (e) {
                var sWidth = $("#content").width();
                var sHeight = $("#content").height();

                var oWidth = $('.brk_diagnostics_select').width();
                var oHeight = $('.brk_diagnostics_select').height();

                // 레이어가 나타날 위치를 셋팅한다.
                var divLeft = e.pageX - 40;
                var divTop = e.pageY - 70;

                // 레이어가 화면 크기를 벗어나면 위치를 바꾸어 배치한다.
                if (divLeft + oWidth > sWidth)
                    divLeft -= oWidth;
                if (divTop + oHeight > sHeight)
                    divTop -= oHeight;

                // 레이어 위치를 바꾸었더니 상단기준점(0,0) 밖으로 벗어난다면 상단기준점(0,0)에 배치하자.
                if (divLeft < 0)
                    divLeft = 0;
                if (divTop < 0)
                    divTop = 0;
                $('.black_bg').css('display', 'block');
                $('.brk_diagnostics_select').css({
                    "top": divTop,
                    "left": divLeft,
                    "position": "absolute",
                    "z-index": "9999"
                }).show();

                if ($(e.target).text() == "") {
                    $("#diag_delete").prop('disabled', false);
                } else {
                    $("#diag_delete").prop('disabled', true);

                }
                $('#selec_target').val(e.target.id.split("_")[1]);

                // if ($(e.target).val() != "") {

                // }else{

                // }

            });


            $("#select_crown").click(function () {
                $('.black_bg').css('display', 'none');
                $('#' + $('#selec_target').val()).remove();
                $("#diagnostics_" + $('#selec_target').val()).css({
                    "background": "url(../../../resource/images/crown_icon.png)",
                    'background-repeat': 'no-repeat',
                    'background-position': 'center'
                });
                //$("#diagnostics_"+ $('#selec_target').val()).val("crown,"+$("#diagnostics_"+ $('#selec_target').val()).text());
                if ($("#diagnostics_" + $('#selec_target').val()).val() == "") {
                    $("#diagnostics_" + $('#selec_target').val()).val($("#diagnostics_" + $('#selec_target').val()).text());
                }
                $('#service_info_form').append("<input type='hidden' id='" + $('#selec_target').val() + "' name='diag_select_number[]' value='" + $('#selec_target').val() + ",crown'>");
                $("#diagnostics_" + $('#selec_target').val()).text('');
                $('.brk_diagnostics_select').css('display', 'none');

            });

            $("#select_implant").click(function () {
                $('.black_bg').css('display', 'none');
                $('#' + $('#selec_target').val()).remove();
                $("#diagnostics_" + $('#selec_target').val()).css({
                    "background": "url(../../../resource/images/implant_icon.png)",
                    'background-repeat': 'no-repeat',
                    'background-position': 'center'
                });
                //$("#diagnostics_"+ $('#selec_target').val()).val("implant,"+$("#diagnostics_"+ $('#selec_target').val()).text());
                if ($("#diagnostics_" + $('#selec_target').val()).val() == "") {
                    $("#diagnostics_" + $('#selec_target').val()).val($("#diagnostics_" + $('#selec_target').val()).text());
                }
                $('#service_info_form').append("<input type='hidden' id='" + $('#selec_target').val() + "' name='diag_select_number[]' value='" + $('#selec_target').val() + ",implant'>");
                $("#diagnostics_" + $('#selec_target').val()).text('');
                $('.brk_diagnostics_select').css('display', 'none');

            });

            $("#select_telescopic_crown").click(function () {
                $('.black_bg').css('display', 'none');
                $('#' + $('#selec_target').val()).remove();
                $("#diagnostics_" + $('#selec_target').val()).css({
                    "background": "url(../../../resource/images/Telescopic_crown_icon.png)",
                    'background-repeat': 'no-repeat',
                    'background-position': 'center'
                });
                //$("#diagnostics_"+ $('#selec_target').val()).val("telescopic_crown,"+$("#diagnostics_"+ $('#selec_target').val()).text());
                if ($("#diagnostics_" + $('#selec_target').val()).val() == "") {
                    $("#diagnostics_" + $('#selec_target').val()).val($("#diagnostics_" + $('#selec_target').val()).text());
                }
                $('#service_info_form').append("<input type='hidden' id='" + $('#selec_target').val() + "' name='diag_select_number[]' value='" + $('#selec_target').val() + ",telescopic_crown'>");
                $("#diagnostics_" + $('#selec_target').val()).text('');
                $('.brk_diagnostics_select').css('display', 'none');

            });

            $("#select_veneered_crown").click(function () {
                $('.black_bg').css('display', 'none');
                $('#' + $('#selec_target').val()).remove();
                $("#diagnostics_" + $('#selec_target').val()).css({
                    "background": "url(../../../resource/images/veneered_crown_icon.png)",
                    'background-repeat': 'no-repeat',
                    'background-position': 'center'
                });
                // $("#diagnostics_"+ $('#selec_target').val()).val("veneered_crown,"+$("#diagnostics_"+ $('#selec_target').val()).text());
                if ($("#diagnostics_" + $('#selec_target').val()).val() == "") {
                    $("#diagnostics_" + $('#selec_target').val()).val($("#diagnostics_" + $('#selec_target').val()).text());
                }
                $('#service_info_form').append("<input type='hidden' id='" + $('#selec_target').val() + "' name='diag_select_number[]' value='" + $('#selec_target').val() + ",veneered_crown'>");
                $("#diagnostics_" + $('#selec_target').val()).text('');
                $('.brk_diagnostics_select').css('display', 'none');

            });


            $("#diag_delete").click(function () {
                $('.black_bg').css('display', 'none');
                $("#diagnostics_" + $('#selec_target').val()).css("background", "");
                //  var  targetNum =  $("#diagnostics_"+ $('#selec_target').val()).val().split(",", 2);
                $("#diagnostics_" + $('#selec_target').val()).text($("#diagnostics_" + $('#selec_target').val()).val());
                $("#diagnostics_" + $('#selec_target').val()).val('');
                $('.brk_diagnostics_select').css('display', 'none');
                $('#' + $('#selec_target').val()).remove();
            });


            $('.black_bg').click(function () {
                $('.black_bg').css('display', 'none');
                $('.brk_diagnostics_select').css('display', 'none');
            });


        });


    </script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>
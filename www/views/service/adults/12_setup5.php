<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
$service = 12;
$option_num = 10;
// if ($_SESSION['treatment_option2'] == "DentOne Regular AP" || $_SESSION['treatment_option2'] == "DentOne Regular") {
//     $option_num = 11;
// }else{

// }

$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'incisor_18' => 18,
            'molar_17' => 17,
            'incisor_16' => 16,
            'incisor_15' => 15,
            'incisor_14' => 14,
            'incisor_13' => 13,
            'incisor_12' => 12,
            'incisor_11' => 11,

            'incisor_48' => 48,
            'molar_47' => 47,
            'incisor_46' => 46,
            'incisor_45' => 45,
            'incisor_44' => 44,
            'incisor_43' => 43,
            'incisor_42' => 42,
            'incisor_41' => 41,

            'incisor_21' => 21,
            'incisor_22' => 22,
            'incisor_23' => 23,
            'incisor_24' => 24,
            'incisor_25' => 25,
            'incisor_26' => 26,
            'molar_27' => 27,
            'incisor_28' => 28,

            'incisor_31' => 31,
            'incisor_32' => 32,
            'incisor_33' => 33,
            'incisor_34' => 34,
            'incisor_35' => 35,
            'incisor_36' => 36,
            'molar_37' => 37,
            'incisor_38' => 38,

        );
        break;
    case 'palmer':
        $numberArray = array(
            'incisor_18' => 8,
            'molar_17' => 7,
            'incisor_16' => 6,
            'incisor_15' => 5,
            'incisor_14' => 4,
            'incisor_13' => 3,
            'incisor_12' => 2,
            'incisor_11' => 1,

            'incisor_48' => 8,
            'molar_47' => 7,
            'incisor_46' => 6,
            'incisor_45' => 5,
            'incisor_44' => 4,
            'incisor_43' => 3,
            'incisor_42' => 2,
            'incisor_41' => 1,

            'incisor_21' => 1,
            'incisor_22' => 2,
            'incisor_23' => 3,
            'incisor_24' => 4,
            'incisor_25' => 5,
            'incisor_26' => 6,
            'molar_27' => 7,
            'incisor_28' => 8,

            'incisor_31' => 1,
            'incisor_32' => 2,
            'incisor_33' => 3,
            'incisor_34' => 4,
            'incisor_35' => 5,
            'incisor_36' => 6,
            'molar_37' => 7,
            'incisor_38' => 8,

        );
        break;
    case 'universal':
        $numberArray = array(
            'incisor_18' => 1,
            'molar_17' => 2,
            'incisor_16' => 3,
            'incisor_15' => 4,
            'incisor_14' => 5,
            'incisor_13' => 6,
            'incisor_12' => 7,
            'incisor_11' => 8,

            'incisor_48' => 32,
            'molar_47' => 31,
            'incisor_46' => 30,
            'incisor_45' => 29,
            'incisor_44' => 28,
            'incisor_43' => 27,
            'incisor_42' => 26,
            'incisor_41' => 25,

            'incisor_21' => 9,
            'incisor_22' => 10,
            'incisor_23' => 11,
            'incisor_24' => 12,
            'incisor_25' => 13,
            'incisor_26' => 14,
            'molar_27' => 15,
            'incisor_28' => 16,

            'incisor_31' => 24,
            'incisor_32' => 23,
            'incisor_33' => 22,
            'incisor_34' => 21,
            'incisor_35' => 20,
            'incisor_36' => 19,
            'molar_37' => 18,
            'incisor_38' => 17,

        );
        break;
}


?>

    <div class="content" style="background-color:#fff; height:713px;">

        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
        ?>
        <form id="service_info_form" onsubmit='return AdultNullChk12();' name="service_info_form"
              action='service_info.php' method='post'>
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
                    <h2 style="text-align:left;margin-top:15px"><?= $option_num ?>. Eruption compensation<span
                                style="color:red">*</span></h2>
                    <div style="margin:10px 0 0 30px;text-align:left;font-size:16px">
                        <p>If eruption compensation (EC) is requested, primary teeth (if any) are virtually extracted
                            and eruption compensation (EC) for<br>permanent teeth is granted from step 1. The baby teeth
                            must be extracted brfore the aligner is transferred.</p>
                        <div style="margin-top:20px">
                            <div style="text-align:left;display:inline-block;vertical-align:top">
                                <p>Eruption compensation</p>
                                <div style="text-align:left;margin:10px 0">
                                    <input type="radio"
                                           id="eruption_none" 
                                            <? echo ($_SESSION['eruption_incisor_option'] == "none" || $_SESSION['eruption_incisor_option'] == null) ?  "checked" : "" ;  ?>
                                            
                              
                                           name="eruption_incisor_option" value="none" style="margin-right:20px">
                                    <label for="eruption_none" style="margin-right:60px">None</label>
                                    <input type="radio"
                                           id="eruption_provide"
                                           <? echo ($_SESSION['eruption_incisor_option'] == "provide") ?  "checked" : "" ;  ?>
                                           name="eruption_incisor_option" value="provide" style="margin-right:20px">
                                    <label for="eruption_provide">Select teeth for compensation</label>
                                </div>
                                <div style="overflow:hidden;display:inline-block">
                                    <p class="RL" style="margin-right:5px">R</p>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                            <button type="button" class="number" id="incisor_15"
                                                    name="upperBrackets"><?= $numberArray['incisor_15'] ?></button>
                                            <button type="button" class="number" id="incisor_14"
                                                    name="upperBrackets"><?= $numberArray['incisor_14'] ?></button>
                                            <button type="button" class="number" id="incisor_13" name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['incisor_13'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                            <button type="button" class="number" id="incisor_45"
                                                    name="lowerBrackets"><?= $numberArray['incisor_45'] ?></button>
                                            <button type="button" class="number" id="incisor_44"
                                                    name="lowerBrackets"><?= $numberArray['incisor_44'] ?></button>
                                            <button type="button" class="number" id="incisor_43" name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['incisor_43'] ?></button>
                                        </div>
                                    </div>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                            <button type="button" class="number" id="incisor_23"
                                                    name="upperBrackets"><?= $numberArray['incisor_23'] ?></button>
                                            <button type="button" class="number" id="incisor_24"
                                                    name="upperBrackets"><?= $numberArray['incisor_24'] ?></button>
                                            <button type="button" class="number" id="incisor_25" name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['incisor_25'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                            <button type="button" class="number" id="incisor_33"
                                                    name="lowerBrackets"><?= $numberArray['incisor_33'] ?></button>
                                            <button type="button" class="number" id="incisor_34"
                                                    name="lowerBrackets"><?= $numberArray['incisor_34'] ?></button>
                                            <button type="button" class="number" id="incisor_35" name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['incisor_35'] ?></button>
                                        </div>
                                    </div>
                                    <p class="RL" style="margin-left:5px">L</p>
                                </div>
                            </div>
                            <div style="text-align:left;display:inline-block;margin-left:40px;vertical-align:top">
                                <p>Provide space for eruption of 2nd molars.</p>
                                <div style="text-align:left;margin:10px 0">
                                    <input type="radio"
                                           id="molar_provide_none" 
                                           <? echo ($_SESSION['eruption_molar_option'] == "none" || $_SESSION['eruption_molar_option'] == null) ?  "checked" : "" ;  ?>
                                           name="eruption_molar_option" value="none" style="margin-right:20px">
                                    <label for="molar_provide_none" style="margin-right:60px">None</label>
                                    <input type="radio"
                                           id="molar_provide_eruption" <? if ($_SESSION['eruption_molar_option'] == "provide") echo checked; else echo "";?>
                                           
                                           name="eruption_molar_option" value="provide" style="margin-right:20px">
                                    <label for="molar_provide_eruption">Select teeth for compensation</label>
                                </div>
                                <div style="overflow:hidden;">
                                    <p class="RL" style="margin-right:5px">R</p>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                            <button type="button" class="number" id="molar_17" name="upperBrackets1"
                                                    style="margin:0"><?= $numberArray['molar_17'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                            <button type="button" class="number" id="molar_47" name="lowerBrackets1"
                                                    style="margin:0"><?= $numberArray['molar_47'] ?></button>
                                        </div>
                                    </div>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                            <button type="button" class="number" id="molar_27" name="upperBrackets1"
                                                    style="margin:0"><?= $numberArray['molar_27'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                            <button type="button" class="number" id="molar_37" name="lowerBrackets1"
                                                    style="margin:0"><?= $numberArray['molar_37'] ?></button>
                                        </div>
                                    </div>
                                    <p class="RL" style="margin-left:5px">L</p>
                                </div>
                                <div style="margin-top:10px">
                                    <p style="display:inline-block">Step to start provide space<br>for eruption of 2nd
                                        molars</p>
                                    <input id="eruption_molar_value" type="text"
                                           value="<?= $_SESSION['eruption_molar_value'] ?>" name="eruption_molar_value"
                                           disabled required
                                           oninvalid="this.setCustomValidity('Please enter a step to start provide space for eruption of 2nd molars.')"
                                           oninput="setCustomValidity('')" placeholder="-----" maxlength="3"
                                           style="margin-left:5px;width:60px;height:25px;padding:5px;display:inline-block;vertical-align:top">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 style="text-align:left;"><?= $option_num + 1 ?>. Additional request<span
                                style="color:red">*</span></h2>
                    <div style="margin:10px 0 0 30px;text-align:left;font-size:16px">
                        <p style="">Please describe in details for an accurate diagnosis</p>
                        <div class="form-group mt-1">
					        <textarea class="form-control-sign_up" style="height:75px; font-size:14px;" name="special_instruction"><?=$_SESSION['special_instruction']?></textarea>
                            <div class="form-control-sign_up-border"></div>
                        </div>	
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

echo "<script>";
if ($_SESSION['eruption_incisor_option'] == "provide") {
    for ($i = 0; $i < count($_SESSION['incisor_select_number']); $i++) {
        echo "$('#incisor_" . $_SESSION['incisor_select_number'][$i] . "').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
		  $('#incisor_" . $_SESSION['incisor_select_number'][$i] . "').val(" . $_SESSION['incisor_select_number'][$i] . ");
		  $('#service_info_form').append(\"<input type='hidden'  name='incisor_select_number[]' id='incisor_num_" . $_SESSION['incisor_select_number'][$i] . "' value='" . $_SESSION['incisor_select_number'][$i] . "'>\");";
    }
}

if ($_SESSION['eruption_molar_option'] == "provide") {
    for ($i = 0; $i < count($_SESSION['molar_select_number']); $i++) {
        echo "$('#molar_" . $_SESSION['molar_select_number'][$i] . "').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
		  $('#molar_" . $_SESSION['molar_select_number'][$i] . "').val(" . $_SESSION['molar_select_number'][$i] . ");
		  $('#service_info_form').append(\"<input type='hidden'  name='molar_select_number[]' id='molar_num_" . $_SESSION['molar_select_number'][$i] . "' value='" . $_SESSION['molar_select_number'][$i] . "'>\");";
    }
}


echo "</script>";
?>


    <script>
        $(document).ready(function () {

            $('#btn_pre').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='11_setup4.php' />");
            });

            $('#btn_next').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='13_summary.php' />");
            });


            $('.number').prop('disabled', true);

            //Eruption
            if ($('#arch').val() == "both" && $("#eruption_provide").prop("checked")) {
                $('button[name=upperBrackets]').prop('disabled', false);
                $('button[name=lowerBrackets]').prop('disabled', false);
            } else if ($('#arch').val() == "upper" && $("#eruption_provide").prop("checked")) {
                $('button[name=upperBrackets]').prop('disabled', false);
            } else if ($('#arch').val() == "lower" && $("#eruption_provide").prop("checked")) {
                $('button[name=lowerBrackets]').prop('disabled', false);
            }

            //Molars
            if ($('#arch').val() == "both" && $("#molar_provide_eruption").prop("checked")) {

                $('#eruption_molar_value').prop('disabled', false);
                $('button[name=upperBrackets1]').prop('disabled', false);
                $('button[name=lowerBrackets1]').prop('disabled', false);
            } else if ($('#arch').val() == "upper" && $("#molar_provide_eruption").prop("checked")) {
                $('button[name=upperBrackets1]').prop('disabled', false);
                $('#eruption_molar_value').prop('disabled', false);
            } else if ($('#arch').val() == "lower" && $("#molar_provide_eruption").prop("checked")) {
                $('button[name=lowerBrackets1]').prop('disabled', false);
                $('#eruption_molar_value').prop('disabled', false);
            }


            $("#eruption_provide").click(function () {
                if ($('#arch').val() == "both" && $("#eruption_provide").prop("checked")) {
                    $('button[name=upperBrackets]').prop('disabled', false);
                    $('button[name=lowerBrackets]').prop('disabled', false);
                } else if ($('#arch').val() == "upper" && $("#eruption_provide").prop("checked")) {
                    $('button[name=upperBrackets]').prop('disabled', false);
                } else if ($('#arch').val() == "lower" && $("#eruption_provide").prop("checked")) {
                    $('button[name=lowerBrackets]').prop('disabled', false);
                }
            });

            $("#molar_provide_eruption").click(function () {
                if ($('#arch').val() == "both" && $("#molar_provide_eruption").prop("checked")) {
                    $('button[name=upperBrackets1]').prop('disabled', false);
                    $('button[name=lowerBrackets1]').prop('disabled', false);
                    $('#eruption_molar_value').prop('disabled', false);
                } else if ($('#arch').val() == "upper" && $("#molar_provide_eruption").prop("checked")) {
                    $('button[name=upperBrackets1]').prop('disabled', false);
                    $('#eruption_molar_value').prop('disabled', false);
                } else if ($('#arch').val() == "lower" && $("#molar_provide_eruption").prop("checked")) {
                    $('button[name=lowerBrackets1]').prop('disabled', false);
                    $('#eruption_molar_value').prop('disabled', false);
                }
            });


            $("#eruption_none").click(function () {
                $('button[name=upperBrackets]').prop('disabled', true);
                $('button[name=lowerBrackets]').prop('disabled', true);

                $('button[name=upperBrackets]').css({"background-color": "#4b4b4b"});
                $('button[name=lowerBrackets]').css({"background-color": "#4b4b4b"});
                $('button[name=upperBrackets]').val("");
                $('button[name=lowerBrackets]').val("");
            });

            $("#molar_provide_none").click(function () {

                $('#eruption_molar_value').prop('disabled', true);
                $('#eruption_molar_value').val('');

                $('button[name=upperBrackets1]').prop('disabled', true);
                $('button[name=lowerBrackets1]').prop('disabled', true);

                $('button[name=upperBrackets1]').css({"background-color": "#4b4b4b"});
                $('button[name=lowerBrackets1]').css({"background-color": "#4b4b4b"});
                $('button[name=upperBrackets1]').val("");
                $('button[name=lowerBrackets1]').val("");
            });


            $(".number").click(function (e) {
                //alert(this.name);
                if (this.name == "upperBrackets1" || this.name == "lowerBrackets1") {
                    if ($(this).val() == "") {
                        $(this).css({
                            "background-color": "#07a2e8",
                            'background-repeat': 'no-repeat',
                            'background-position': 'center'
                        });
                        $(this).val($(this).text());
                        $('#service_info_form').append("<input type='hidden' id='molar_num_" + e.target.id.split("_")[1] + "' name='molar_select_number[]' value='" + e.target.id.split("_")[1] + "'>");
                        //$(this).text('');
                    } else {
                        $(this).css({"background-color": "#4b4b4b"});
                        //  $(this).text($(this).val());
                        $(this).val("");
                        $('#molar_num_' + $(this).text()).remove();
                    }

                } else {
                    if ($(this).val() == "") {
                        $(this).css({
                            "background-color": "#07a2e8",
                            'background-repeat': 'no-repeat',
                            'background-position': 'center'
                        });
                        $(this).val($(this).text());
                        $('#service_info_form').append("<input type='hidden' id='incisor_num_" + e.target.id.split("_")[1] + "' name='incisor_select_number[]' value='" + e.target.id.split("_")[1] + "'>");
                        //$(this).text('');
                    } else {
                        $(this).css({"background-color": "#4b4b4b"});
                        //  $(this).text($(this).val());
                        $(this).val("");
                        $('#incisor_num_' + e.target.id.split("_")[1]).remove();
                    }
                }
            });


        });
    </script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>
<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
$service =8;
if($_SESSION['progress_num'] > $service ){$progress_num = $service; }

$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'diagnostics_16' => 16 ,
            'diagnostics_15' => 15 ,
            'diagnostics_14' => 14 ,
            'diagnostics_13' => 13 ,
            'diagnostics_12' => 12 ,
            'diagnostics_11' => 11 ,
            
            'diagnostics_46' => 46 ,
            'diagnostics_45' => 45 ,
            'diagnostics_44' => 44 ,
            'diagnostics_43' => 43 ,
            'diagnostics_42' => 42 ,
            'diagnostics_41' => 41 ,

            'diagnostics_21' => 21 ,
            'diagnostics_22' => 22 ,
            'diagnostics_23' => 23 ,
            'diagnostics_24' => 24 ,
            'diagnostics_25' => 25 ,
            'diagnostics_26' => 26 ,

            'diagnostics_31' => 31 ,
            'diagnostics_32' => 32 ,
            'diagnostics_33' => 33 ,
            'diagnostics_34' => 34 ,
            'diagnostics_35' => 35 ,
            'diagnostics_36' => 36 ,


            'diagnostics_51' => 51 ,
            'diagnostics_52' => 52 ,
            'diagnostics_53' => 53 ,
            'diagnostics_54' => 54 ,
            'diagnostics_55' => 55 ,

            'diagnostics_61' => 61 ,
            'diagnostics_62' => 62 ,
            'diagnostics_63' => 63 ,
            'diagnostics_64' => 64 ,
            'diagnostics_65' => 65 ,

            'diagnostics_71' => 71 ,
            'diagnostics_72' => 72 ,
            'diagnostics_73' => 73 ,
            'diagnostics_74' => 74 ,
            'diagnostics_75' => 75 ,

            'diagnostics_81' => 81 ,
            'diagnostics_82' => 82 ,
            'diagnostics_83' => 83 ,
            'diagnostics_84' => 84 ,
            'diagnostics_85' => 85 ,
        );
        break;
    case 'palmer':
        $numberArray = array(
            'diagnostics_16' => 6 ,
            'diagnostics_15' => 5 ,
            'diagnostics_14' => 4 ,
            'diagnostics_13' => 3 ,
            'diagnostics_12' => 2 ,
            'diagnostics_11' => 1 ,
            
            'diagnostics_46' => 6 ,
            'diagnostics_45' => 5 ,
            'diagnostics_44' => 4 ,
            'diagnostics_43' => 3 ,
            'diagnostics_42' => 2 ,
            'diagnostics_41' => 1 ,

            'diagnostics_21' => 1 ,
            'diagnostics_22' => 2 ,
            'diagnostics_23' => 3 ,
            'diagnostics_24' => 4 ,
            'diagnostics_25' => 5 ,
            'diagnostics_26' => 6 ,

            'diagnostics_31' => 1 ,
            'diagnostics_32' => 2 ,
            'diagnostics_33' => 3 ,
            'diagnostics_34' => 4 ,
            'diagnostics_35' => 5 ,
            'diagnostics_36' => 6 ,

            

            'diagnostics_51' => "A" ,
            'diagnostics_52' => "B" ,
            'diagnostics_53' => "C" ,
            'diagnostics_54' => "D" ,
            'diagnostics_55' => "E" ,

            'diagnostics_61' => "A" ,
            'diagnostics_62' => "B" ,
            'diagnostics_63' => "C" ,
            'diagnostics_64' => "D" ,
            'diagnostics_65' => "E" ,

            'diagnostics_71' => "A" ,
            'diagnostics_72' => "B" ,
            'diagnostics_73' => "C" ,
            'diagnostics_74' => "D" ,
            'diagnostics_75' => "E" ,

            'diagnostics_81' => "A" ,
            'diagnostics_82' => "B" ,
            'diagnostics_83' => "C" ,
            'diagnostics_84' => "D" ,
            'diagnostics_85' => "E" ,
            
        );
        break;
    case 'universal':
        $numberArray = array(
            'diagnostics_16' => 1 ,
            'diagnostics_15' => 2 ,
            'diagnostics_14' => 3 ,
            'diagnostics_13' => 4 ,
            'diagnostics_12' => 5 ,
            'diagnostics_11' => 6 ,
            
            'diagnostics_46' => 24 ,
            'diagnostics_45' => 23 ,
            'diagnostics_44' => 22 ,
            'diagnostics_43' => 21 ,
            'diagnostics_42' => 20 ,
            'diagnostics_41' => 19 ,

            'diagnostics_21' => 7 ,
            'diagnostics_22' => 8 ,
            'diagnostics_23' => 9 ,
            'diagnostics_24' => 10 ,
            'diagnostics_25' => 11 ,
            'diagnostics_26' => 12 ,

            'diagnostics_31' => 18 ,
            'diagnostics_32' => 17 ,
            'diagnostics_33' => 16 ,
            'diagnostics_34' => 15 ,
            'diagnostics_35' => 14 ,
            'diagnostics_36' => 13 ,


            'diagnostics_51' => "E" ,
            'diagnostics_52' => "D" ,
            'diagnostics_53' => "C" ,
            'diagnostics_54' => "B" ,
            'diagnostics_55' => "A" ,

            'diagnostics_61' => "F" ,
            'diagnostics_62' => "G" ,
            'diagnostics_63' => "H" ,
            'diagnostics_64' => "I" ,
            'diagnostics_65' => "J" ,

            'diagnostics_71' => "O" ,
            'diagnostics_72' => "N" ,
            'diagnostics_73' => "M" ,
            'diagnostics_74' => "L" ,
            'diagnostics_75' => "K" ,

            'diagnostics_81' => "P" ,
            'diagnostics_82' => "Q" ,
            'diagnostics_83' => "R" ,
            'diagnostics_84' => "S" ,
            'diagnostics_85' => "T" ,
            
        );
        break;    
}
?>

<div class="content" style="background-color:#fff;height:713px;">
    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/views/service/child/service_tab.php");
    ?>
    <form id="service_info_form" name="service_info_form" action='service_info.php' method='post'>

        <div class="bracket_inner">
            <div class="service_title" style="margin-bottom:20px">
                <h2 style="margin-top: -45px;">
                    <span style="color:#333;margin-right:10px"><?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></span>(<? if ($_SESSION['treatment_option1'] == "Adults") {
                        echo $_SESSION['treatment_option1'] . " including teenager,";
                    } else {
                        echo $_SESSION['treatment_option1'] . ",";
                    } ?> <?= $_SESSION['treatment_option2'] ?>)</h2>
            </div>
            <div class="indirect_System">
                <h2 style="text-align:left;margin-top:10px">1. Arch selection for treatment<span
                            style="color:red">*</span></h2>
                <div style="margin:10px 0 0 30px">
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
                    <h2 style="text-align:left;margin-top:10px">2. Tray Sections<span style="color:red">*</span></h2>
                    <div style="overflow:hidden;margin:10px 0 0 30px">
                        <div>
                            <p style="float:left;margin-right:60px">Upper</p>
                            <input type="radio"
                                   name="tray_section_u" <? if ($_SESSION['tray_section_u'] == "1 Piece" || $_SESSION['tray_section_u'] == null) {
                                echo "checked";
                            } ?> id="u_ts_1p" value="1 Piece" style="margin-right:30px" disabled><label for="u_ts_1p"
                                                                                                        style="margin-right:60px">1
                                Piece</label>
                            <input type="radio"
                                   name="tray_section_u" <? if ($_SESSION['tray_section_u'] == "Midline Split") {
                                echo "checked";
                            } ?> id="u_ts_ms" value="Midline Split" style="margin-right:30px" disabled><label
                                    for="u_ts_ms" style="margin-right:60px">Midline Split</label>
                            <input type="radio" name="tray_section_u" <? if ($_SESSION['tray_section_u'] == "3 Piece") {
                                echo "checked";
                            } ?> id="u_ts_3p" value="3 Piece" style="margin-right:30px" disabled><label for="u_ts_3p"
                                                                                                        style="margin-right:60px">3
                                Piece</label>
                        </div>
                        <div style="margin-top:20px">
                            <p style="float:left;margin-right:60px">Lower</p>
                            <input type="radio"
                                   name="tray_section_l" <? if ($_SESSION['tray_section_l'] == "1 Piece" || $_SESSION['tray_section_l'] == null) {
                                echo "checked";
                            } ?> id="l_ts_1p" value="1 Piece" style="margin-right:30px" disabled><label for="l_ts_1p"
                                                                                                        style="margin-right:60px">1
                                Piece</label>
                            <input type="radio"
                                   name="tray_section_l" <? if ($_SESSION['tray_section_l'] == "Midline Split") {
                                echo "checked";
                            } ?> id="l_ts_ms" value="Midline Split" style="margin-right:30px" disabled><label
                                    for="l_ts_ms" style="margin-right:60px">Midline Split</label>
                            <input type="radio" name="tray_section_l" <? if ($_SESSION['tray_section_l'] == "3 Piece") {
                                echo "checked";
                            } ?> id="l_ts_3p" value="3 Piece" style="margin-right:30px" disabled><label for="l_ts_3p"
                                                                                                        style="margin-right:60px">3
                                Piece</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="used_brackets" style="margin-top:25px;overflow:hidden;">
                <h2>2. Please select full diagnostics<span style="color:red">*</span></h2>
                <div style="text-align:left; width: 87%;margin-left:30px">
                    <div style="overflow:hidden;display:inline-block">
                        <p style="text-align:left;margin-bottom:10px">(Implant, Telescopic crown, Veneered crown)</p>
                        <p style="text-align:left;margin:10px 0">Please tick if the patients is a Permanent teeth</p>
                        <p class="RL" style="margin-right:5px">R</p>
                        <div style="overflow:hidden;display:inline-block;float:left">
                            <? include("setup2_layer.php"); ?>
                            <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
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
                                <button type="button" disabled class="number" id="diagnostics_11" name="upperBrackets"
                                        style="margin:0"><?= $numberArray['diagnostics_11'] ?></button>
                            </div>
                            <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
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
                                <button type="button" disabled class="number" id="diagnostics_41" name="lowerBrackets"
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
                            </div>
                        </div>
                        <p class="RL" style="margin-left:5px">L</p>
                        <div style="display:inline-block">
                            <p style="text-align:left;margin:10px 0">Please tick if the patient is a child</p>
                            <p class="RL" style="margin-right:5px">R</p>
                            <div style="overflow:hidden;display:inline-block;float:left">
                                <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                    <button type="button" disabled class="select_check" id="diagnostics_55"
                                            name="upperBrackets"><?= $numberArray['diagnostics_55'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_54"
                                            name="upperBrackets"><?= $numberArray['diagnostics_54'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_53"
                                            name="upperBrackets"><?= $numberArray['diagnostics_53'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_52"
                                            name="upperBrackets"><?= $numberArray['diagnostics_52'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_51"
                                            name="upperBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_51'] ?></button>
                                </div>
                                <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                    <button type="button" disabled class="select_check" id="diagnostics_85"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_85'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_84"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_84'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_83"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_83'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_82"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_82'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_81"
                                            name="lowerBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_81'] ?></button>
                                </div>
                            </div>
                            <div style="overflow:hidden;display:inline-block;float:left">
                                <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                    <button type="button" disabled class="select_check" id="diagnostics_61"
                                            name="upperBrackets"><?= $numberArray['diagnostics_61'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_62"
                                            name="upperBrackets"><?= $numberArray['diagnostics_62'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_63"
                                            name="upperBrackets"><?= $numberArray['diagnostics_63'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_64"
                                            name="upperBrackets"><?= $numberArray['diagnostics_64'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_65"
                                            name="upperBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_65'] ?></button>
                                </div>
                                <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                    <button type="button" disabled class="select_check" id="diagnostics_71"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_71'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_72"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_72'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_73"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_73'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_74"
                                            name="lowerBrackets"><?= $numberArray['diagnostics_74'] ?></button>
                                    <button type="button" disabled class="select_check" id="diagnostics_75"
                                            name="lowerBrackets"
                                            style="margin:0"><?= $numberArray['diagnostics_75'] ?></button>
                                </div>
                            </div>
                            <p class="RL" style="margin-left:5px">L</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button_menu" style="padding:10px;">
<!--            <a href="javascript:servicePopupClose();" class="service_close">Close</a>-->
            <input type="submit" id="btn_pre" value="Back" class="btn_black hover190">  
            <input type="submit" id="btn_next" value="Next" class="btn_blue hover190">
        </div>
    </form>
</div>

<?
if (isset($_SESSION['diag_select_number'])) {
echo "<script>";

for ($i=0; $i < count($_SESSION['diag_select_number']); $i++) { 
    $number_values = explode( ',', $_SESSION['diag_select_number'][$i], 2);
    if($number_values[1] == "crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_".$number_values[0]."').val($('#diagnostics_".$number_values[0]."').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='".$number_values[0]."' value='".$number_values[0].",crown'>\");
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "implant"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/implant_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_".$number_values[0]."').val($('#diagnostics_".$number_values[0]."').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='".$number_values[0]."' value='".$number_values[0].",implant'>\");
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "telescopic_crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/Telescopic_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_".$number_values[0]."').val($('#diagnostics_".$number_values[0]."').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='".$number_values[0]."' value='".$number_values[0].",telescopic_crown'>\");
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "veneered_crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/Veneered_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_".$number_values[0]."').val($('#diagnostics_".$number_values[0]."').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='".$number_values[0]."' value='".$number_values[0].",veneered_crown'>\");
         $('#diagnostics_".$number_values[0]."').text('');";

    }
    else if($number_values[1] == "check"){
        echo "$('#diagnostics_".$number_values[0]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#diagnostics_".$number_values[0]."').val($('#diagnostics_".$number_values[0]."').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='diag_select_number[]' id='".$number_values[0]."' value='".$number_values[0].",check'>\");";

    }
}
    
echo "</script>";
}
?>


<script>
$(document).ready(function(){


    $('#btn_pre').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='07_radiograph.php' />");
    });
    
    $('#btn_next').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='09_setup2.php' />");
    });

	
$('input[name=arch]').each(function (i) {
if($(this).is(":checked")){
	if($(this).val() == "both" ){
			$('button[name=upperBrackets]').prop('disabled',false);
			$('button[name=lowerBrackets]').prop('disabled',false);
			
			$('input[name=tray_section_u]').prop('disabled',false);
			$('input[name=tray_section_l]').prop('disabled',false);
		}else if ($(this).val() == "upper")
		{
			$('button[name=upperBrackets]').prop('disabled',false);
			$('input[name=tray_section_u]').prop('disabled',false);
		}else if ($(this).val() == "lower"){
			$('button[name=lowerBrackets]').prop('disabled',false);
			$('input[name=tray_section_l]').prop('disabled',false);
		}
}
});

$('input[name=arch]').on('click',function (i) {
	if($(this).val() == "both" ){
			$('button[name=upperBrackets]').prop('disabled',false);
			$('button[name=lowerBrackets]').prop('disabled',false);
			$('input[name=tray_section_u]').prop('disabled',false);
			$('input[name=tray_section_l]').prop('disabled',false);
		}else if ($(this).val() == "upper")
		{
			$('button[name=upperBrackets]').prop('disabled',false);
			$('input[name=tray_section_u]').prop('disabled',false);
			$('button[name=lowerBrackets]').prop('disabled',true);	
			$('input[name=tray_section_l]').prop('disabled',true);



			 var num_list = ["31","32","33","34","35","36","37","38","41","42","43","44","45","46","47","48"];
					for (let index = 0; index < num_list.length; index++) {
							$("#diagnostics_"+ num_list[index]).css("background","");
						  //  var  targetNum =  $("#diagnostics_"+ $('#selec_target').val()).val().split(",", 2);
							 if ($("#diagnostics_"+ num_list[index]).text() == "")
						  {
								$("#diagnostics_"+ num_list[index]).text($("#diagnostics_"+ num_list[index]).val());
						  }
							$("#diagnostics_"+ num_list[index]).val('');
							$('.brk_diagnostics_select').css('display', 'none');
							$('#'+num_list[index]).remove();                    
                   }


								$.ajax({
									url: 'service_info.php',
									type: 'POST',
									data: {'brk_info_delete': 'true'},
									dataType: 'html',
									success: function (data) {
											if (data =="true") {
												//alert("삭제되었습니다.");
											}
									}
								});

			
		
		}else if ($(this).val() == "lower"){
			$('button[name=lowerBrackets]').prop('disabled',false);
			$('input[name=tray_section_l]').prop('disabled',false);
			$('button[name=upperBrackets]').prop('disabled',true);
			$('input[name=tray_section_u]').prop('disabled',true);

				 var num_list = ["11","12","13","14","15","16","17","18","21","22","23","24","25","26","27","28"];

			for (let index = 0; index < num_list.length; index++) {
							$("#diagnostics_"+ num_list[index]).css("background","");
						  //  var  targetNum =  $("#diagnostics_"+ $('#selec_target').val()).val().split(",", 2);
							 if ($("#diagnostics_"+ num_list[index]).text() == "")
						  {
								$("#diagnostics_"+ num_list[index]).text($("#diagnostics_"+ num_list[index]).val());
						  }
							$("#diagnostics_"+ num_list[index]).val('');
							$('.brk_diagnostics_select').css('display', 'none');
							$('#'+num_list[index]).remove();                    
                   }


											$.ajax({
												url: 'service_info.php',
												type: 'POST',
												data: {'brk_info_delete': 'true', 'del_lower' : 'true'},
												dataType: 'html',
												success: function (data) {
														if (data =="true") {
															//alert("삭제되었습니다.");
														}
												}
											});




		}

			

	


});






	if($('#upperChecked').val() == "true" ){
		$('button[name=upperBrackets]').prop('disabled',false);
	}
	if($('#lowerChecked').val() == "true"){ 
		$('button[name=lowerBrackets]').prop('disabled',false);
	}

	

    $(".select_check").click(function(e) {
        $('#selec_target').val(e.target.id.split("_")[1]);
        if ($(this).val() == "") {
            $(this).css({"background-color":"#07a2e8", 'background-repeat' : 'no-repeat', 'background-position':'center'});
            $(this).val($(this).text());
        $('#service_info_form').append("<input type='hidden' id='"+$('#selec_target').val()+"' name='diag_select_number[]' value='"+$('#selec_target').val()+",check'>");
        }else{
            $(this).css({"background-color":"#4b4b4b"});
          //  $(this).text($(this).val());
            // $(this).val("");	
			// $('#'+$(this).text()).remove();
            $("#diagnostics_"+ $('#selec_target').val()).text($("#diagnostics_"+ $('#selec_target').val()).val());
			$("#diagnostics_"+ $('#selec_target').val()).val('');
			$('#'+$('#selec_target').val()).remove();
        }
			
		});

        
        
	$('.number').click(function (e) {
        var sWidth = $("#content").width();
        var sHeight = $("#content").height();

        var oWidth = $('.brk_diagnostics_select').width();
        var oHeight = $('.brk_diagnostics_select').height();

        // 레이어가 나타날 위치를 셋팅한다.
        var divLeft = e.pageX-40;
        var divTop = e.pageY-70;

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
        $('.brk_diagnostics_select').css({"top": divTop, "left": divLeft, "position": "absolute","z-index": "9999"}).show();

        if ($(e.target).text() == "") {
            $("#diag_delete").prop('disabled', false);
        }else{
            $("#diag_delete").prop('disabled', true);

        }
         $('#selec_target').val(e.target.id.split("_")[1]);

    });


        $("#select_crown").click(function() {
             $('.black_bg').css('display', 'none');  
              $('#'+$('#selec_target').val()).remove();
        $("#diagnostics_"+ $('#selec_target').val()).css({"background":"url(../../../resource/images/crown_icon.png)", 'background-repeat' : 'no-repeat', 'background-position':'center'});
        //$("#diagnostics_"+ $('#selec_target').val()).val("crown,"+$("#diagnostics_"+ $('#selec_target').val()).text());
        if ($("#diagnostics_"+ $('#selec_target').val()).val() == "") {
             $("#diagnostics_"+ $('#selec_target').val()).val($("#diagnostics_"+ $('#selec_target').val()).text());
        }
        $('#service_info_form').append("<input type='hidden' id='"+$('#selec_target').val()+"' name='diag_select_number[]' value='"+$('#selec_target').val()+",crown'>");
        $("#diagnostics_"+ $('#selec_target').val()).text('');
        $('.brk_diagnostics_select').css('display', 'none');
          
		});

        $("#select_implant").click(function() {
			$('.black_bg').css('display', 'none');  
            $('#'+$('#selec_target').val()).remove();
        $("#diagnostics_"+ $('#selec_target').val()).css({"background":"url(../../../resource/images/implant_icon.png)", 'background-repeat' : 'no-repeat', 'background-position':'center'});
        //$("#diagnostics_"+ $('#selec_target').val()).val("implant,"+$("#diagnostics_"+ $('#selec_target').val()).text());
       if ($("#diagnostics_"+ $('#selec_target').val()).val() == "") {
             $("#diagnostics_"+ $('#selec_target').val()).val($("#diagnostics_"+ $('#selec_target').val()).text());
        }
        $('#service_info_form').append("<input type='hidden' id='"+$('#selec_target').val()+"' name='diag_select_number[]' value='"+$('#selec_target').val()+",implant'>");
        $("#diagnostics_"+ $('#selec_target').val()).text('');
        $('.brk_diagnostics_select').css('display', 'none');
         
		});

        $("#select_telescopic_crown").click(function() {
			$('.black_bg').css('display', 'none');  
            $('#'+$('#selec_target').val()).remove();
        $("#diagnostics_"+ $('#selec_target').val()).css({"background":"url(../../../resource/images/Telescopic_crown_icon.png)", 'background-repeat' : 'no-repeat', 'background-position':'center'});
        //$("#diagnostics_"+ $('#selec_target').val()).val("telescopic_crown,"+$("#diagnostics_"+ $('#selec_target').val()).text());
        if ($("#diagnostics_"+ $('#selec_target').val()).val() == "") {
             $("#diagnostics_"+ $('#selec_target').val()).val($("#diagnostics_"+ $('#selec_target').val()).text());
        }
        $('#service_info_form').append("<input type='hidden' id='"+$('#selec_target').val()+"' name='diag_select_number[]' value='"+$('#selec_target').val()+",telescopic_crown'>");
        $("#diagnostics_"+ $('#selec_target').val()).text('');
        $('.brk_diagnostics_select').css('display', 'none');
        
		});

        $("#select_veneered_crown").click(function() {
			$('.black_bg').css('display', 'none');  
             $('#'+$('#selec_target').val()).remove();
        $("#diagnostics_"+ $('#selec_target').val()).css({"background":"url(../../../resource/images/veneered_crown_icon.png)", 'background-repeat' : 'no-repeat', 'background-position':'center'});
       // $("#diagnostics_"+ $('#selec_target').val()).val("veneered_crown,"+$("#diagnostics_"+ $('#selec_target').val()).text());
       if ($("#diagnostics_"+ $('#selec_target').val()).val() == "") {
             $("#diagnostics_"+ $('#selec_target').val()).val($("#diagnostics_"+ $('#selec_target').val()).text());
        }
        $('#service_info_form').append("<input type='hidden' id='"+$('#selec_target').val()+"' name='diag_select_number[]' value='"+$('#selec_target').val()+",veneered_crown'>");
        $("#diagnostics_"+ $('#selec_target').val()).text('');
        $('.brk_diagnostics_select').css('display', 'none');
        
		});
        
        
        $("#select_check").click(function() {
			$('.black_bg').css('display', 'none');  
            $('#'+$('#selec_target').val()).remove();
        $("#diagnostics_"+ $('#selec_target').val()).css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
       // $("#diagnostics_"+ $('#selec_target').val()).val("veneered_crown,"+$("#diagnostics_"+ $('#selec_target').val()).text());
        if ($("#diagnostics_"+ $('#selec_target').val()).val() == "") {
            $("#diagnostics_"+ $('#selec_target').val()).val($("#diagnostics_"+ $('#selec_target').val()).text());
        }
        $('#service_info_form').append("<input type='hidden' id='"+$('#selec_target').val()+"' name='diag_select_number[]' value='"+$('#selec_target').val()+",check'>");
        $("#diagnostics_"+ $('#selec_target').val()).text('');
        $('.brk_diagnostics_select').css('display', 'none');
        
		});
        


        $("#diag_delete").click(function() {
			$('.black_bg').css('display', 'none');  
			$("#diagnostics_"+ $('#selec_target').val()).css("background","");
		  //  var  targetNum =  $("#diagnostics_"+ $('#selec_target').val()).val().split(",", 2);
			$("#diagnostics_"+ $('#selec_target').val()).text($("#diagnostics_"+ $('#selec_target').val()).val());
			$("#diagnostics_"+ $('#selec_target').val()).val('');
			$('.brk_diagnostics_select').css('display', 'none');
			$('#'+$('#selec_target').val()).remove();
		});


$('.black_bg').click(function() {
$('.black_bg').css('display', 'none');  
  $('.brk_diagnostics_select').css('display', 'none');  
});


});


</script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>

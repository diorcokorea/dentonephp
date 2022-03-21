<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
$service =10;

$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'extraction_16' => 16 ,
            'extraction_15' => 15 ,
            'extraction_14' => 14 ,
            'extraction_13' => 13 ,
            'extraction_12' => 12 ,
            'extraction_11' => 11 ,
            
            'extraction_46' => 46 ,
            'extraction_45' => 45 ,
            'extraction_44' => 44 ,
            'extraction_43' => 43 ,
            'extraction_42' => 42 ,
            'extraction_41' => 41 ,

            'extraction_21' => 21 ,
            'extraction_22' => 22 ,
            'extraction_23' => 23 ,
            'extraction_24' => 24 ,
            'extraction_25' => 25 ,
            'extraction_26' => 26 ,

            'extraction_31' => 31 ,
            'extraction_32' => 32 ,
            'extraction_33' => 33 ,
            'extraction_34' => 34 ,
            'extraction_35' => 35 ,
            'extraction_36' => 36 ,


            'extraction_51' => 51 ,
            'extraction_52' => 52 ,
            'extraction_53' => 53 ,
            'extraction_54' => 54 ,
            'extraction_55' => 55 ,

            'extraction_61' => 61 ,
            'extraction_62' => 62 ,
            'extraction_63' => 63 ,
            'extraction_64' => 64 ,
            'extraction_65' => 65 ,

            'extraction_71' => 71 ,
            'extraction_72' => 72 ,
            'extraction_73' => 73 ,
            'extraction_74' => 74 ,
            'extraction_75' => 75 ,

            'extraction_81' => 81 ,
            'extraction_82' => 82 ,
            'extraction_83' => 83 ,
            'extraction_84' => 84 ,
            'extraction_85' => 85 ,
        );
        break;
    case 'palmer':
        $numberArray = array(
            'extraction_16' => 6 ,
            'extraction_15' => 5 ,
            'extraction_14' => 4 ,
            'extraction_13' => 3 ,
            'extraction_12' => 2 ,
            'extraction_11' => 1 ,
            
            'extraction_46' => 6 ,
            'extraction_45' => 5 ,
            'extraction_44' => 4 ,
            'extraction_43' => 3 ,
            'extraction_42' => 2 ,
            'extraction_41' => 1 ,

            'extraction_21' => 1 ,
            'extraction_22' => 2 ,
            'extraction_23' => 3 ,
            'extraction_24' => 4 ,
            'extraction_25' => 5 ,
            'extraction_26' => 6 ,

            'extraction_31' => 1 ,
            'extraction_32' => 2 ,
            'extraction_33' => 3 ,
            'extraction_34' => 4 ,
            'extraction_35' => 5 ,
            'extraction_36' => 6 ,

            

            'extraction_51' => "A" ,
            'extraction_52' => "B" ,
            'extraction_53' => "C" ,
            'extraction_54' => "D" ,
            'extraction_55' => "E" ,

            'extraction_61' => "A" ,
            'extraction_62' => "B" ,
            'extraction_63' => "C" ,
            'extraction_64' => "D" ,
            'extraction_65' => "E" ,

            'extraction_71' => "A" ,
            'extraction_72' => "B" ,
            'extraction_73' => "C" ,
            'extraction_74' => "D" ,
            'extraction_75' => "E" ,

            'extraction_81' => "A" ,
            'extraction_82' => "B" ,
            'extraction_83' => "C" ,
            'extraction_84' => "D" ,
            'extraction_85' => "E" ,
            
        );
        break;
    case 'universal':
        $numberArray = array(
            'extraction_16' => 1 ,
            'extraction_15' => 2 ,
            'extraction_14' => 3 ,
            'extraction_13' => 4 ,
            'extraction_12' => 5 ,
            'extraction_11' => 6 ,
            
            'extraction_46' => 24 ,
            'extraction_45' => 23 ,
            'extraction_44' => 22 ,
            'extraction_43' => 21 ,
            'extraction_42' => 20 ,
            'extraction_41' => 19 ,

            'extraction_21' => 7 ,
            'extraction_22' => 8 ,
            'extraction_23' => 9 ,
            'extraction_24' => 10 ,
            'extraction_25' => 11 ,
            'extraction_26' => 12 ,

            'extraction_31' => 18 ,
            'extraction_32' => 17 ,
            'extraction_33' => 16 ,
            'extraction_34' => 15 ,
            'extraction_35' => 14 ,
            'extraction_36' => 13 ,


            'extraction_51' => "E" ,
            'extraction_52' => "D" ,
            'extraction_53' => "C" ,
            'extraction_54' => "B" ,
            'extraction_55' => "A" ,

            'extraction_61' => "F" ,
            'extraction_62' => "G" ,
            'extraction_63' => "H" ,
            'extraction_64' => "I" ,
            'extraction_65' => "J" ,

            'extraction_71' => "O" ,
            'extraction_72' => "N" ,
            'extraction_73' => "M" ,
            'extraction_74' => "L" ,
            'extraction_75' => "K" ,

            'extraction_81' => "P" ,
            'extraction_82' => "Q" ,
            'extraction_83' => "R" ,
            'extraction_84' => "S" ,
            'extraction_85' => "T" ,
            
        );
        break;    
}

?>

<div class="content" style="background-color:#fff;height:820px;margin-bottom:55px;">

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/views/service/child/service_tab.php");
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
                        echo $_SESSION['treatment_option1'] . ",";
                    } ?> <?= $_SESSION['treatment_option2'] ?>)</h2>
            </div>
            <div class="used_brackets">
                <h2 style="text-align:left;margin-top:10px">5. Extraction<span style="color:red">*</span></h2>
                <div style="margin:10px 0 0 30px;text-align:left">
                    <input type="radio" <? if ($_SESSION['extraction'] == "none_tooth_e") {
                        echo "checked";
                    } else if ($_SESSION['extraction'] == null) {
                        echo "checked";
                    } ?> id="none_tooth_extraction" name="extraction" value="none_tooth_e"
                           style="margin-right:20px"><label for="none_tooth_extraction" style="margin-right:60px">Non
                        Extraction</label>
                    <input type="radio" <? if ($_SESSION['extraction'] == "tooth_e") {
                        echo "checked";
                    } ?> id="tooth_extraction" name="extraction" value="tooth_e" style="margin-right:20px"><label
                            for="tooth_extraction">Extraction</label>
                </div>
                <div style="overflow:hidden;margin:0 0 0 30px;text-align:left">
                    <p style="text-align:left;margin:10px 0">Please tick if the patients is a Permanent teeth</p>
                    <p class="RL" style="margin-right:5px">R</p>
                    <div style="overflow:hidden;display:inline-block;float:left">
                        <? include("setup2_layer.php"); ?>
                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
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
                        </div>
                    </div>
                    <p class="RL" style="margin-left:5px">L</p>
                    <div style="display:inline-block">
                        <p style="text-align:left;margin:10px 0">Please tick if the patient is a child</p>
                        <p class="RL" style="margin-right:5px">R</p>
                        <div style="overflow:hidden;display:inline-block;float:left">
                            <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                <button type="button" disabled class="number" id="extraction_55"
                                        name="upperBrackets"><?= $numberArray['extraction_55'] ?></button>
                                <button type="button" disabled class="number" id="extraction_54"
                                        name="upperBrackets"><?= $numberArray['extraction_54'] ?></button>
                                <button type="button" disabled class="number" id="extraction_53"
                                        name="upperBrackets"><?= $numberArray['extraction_53'] ?></button>
                                <button type="button" disabled class="number" id="extraction_52"
                                        name="upperBrackets"><?= $numberArray['extraction_52'] ?></button>
                                <button type="button" disabled class="number" id="extraction_51" name="upperBrackets"
                                        style="margin:0"><?= $numberArray['extraction_51'] ?></button>
                            </div>
                            <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                <button type="button" disabled class="number" id="extraction_85"
                                        name="lowerBrackets"><?= $numberArray['extraction_85'] ?></button>
                                <button type="button" disabled class="number" id="extraction_84"
                                        name="lowerBrackets"><?= $numberArray['extraction_84'] ?></button>
                                <button type="button" disabled class="number" id="extraction_83"
                                        name="lowerBrackets"><?= $numberArray['extraction_83'] ?></button>
                                <button type="button" disabled class="number" id="extraction_82"
                                        name="lowerBrackets"><?= $numberArray['extraction_82'] ?></button>
                                <button type="button" disabled class="number" id="extraction_81" name="lowerBrackets"
                                        style="margin:0"><?= $numberArray['extraction_81'] ?></button>
                            </div>
                        </div>
                        <div style="overflow:hidden;display:inline-block;float:left">
                            <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                <button type="button" disabled class="number" id="extraction_61"
                                        name="upperBrackets"><?= $numberArray['extraction_61'] ?></button>
                                <button type="button" disabled class="number" id="extraction_62"
                                        name="upperBrackets"><?= $numberArray['extraction_62'] ?></button>
                                <button type="button" disabled class="number" id="extraction_63"
                                        name="upperBrackets"><?= $numberArray['extraction_63'] ?></button>
                                <button type="button" disabled class="number" id="extraction_64"
                                        name="upperBrackets"><?= $numberArray['extraction_64'] ?></button>
                                <button type="button" disabled class="number" id="extraction_65" name="upperBrackets"
                                        style="margin:0"><?= $numberArray['extraction_65'] ?></button>
                            </div>
                            <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                <button type="button" disabled class="number" id="extraction_71"
                                        name="lowerBrackets"><?= $numberArray['extraction_71'] ?></button>
                                <button type="button" disabled class="number" id="extraction_72"
                                        name="lowerBrackets"><?= $numberArray['extraction_72'] ?></button>
                                <button type="button" disabled class="number" id="extraction_73"
                                        name="lowerBrackets"><?= $numberArray['extraction_73'] ?></button>
                                <button type="button" disabled class="number" id="extraction_74"
                                        name="lowerBrackets"><?= $numberArray['extraction_74'] ?></button>
                                <button type="button" disabled class="number" id="extraction_75" name="lowerBrackets"
                                        style="margin:0"><?= $numberArray['extraction_75'] ?></button>
                            </div>
                        </div>
                        <p class="RL" style="margin-left:5px">L</p>
                    </div>
                </div>
                <h2 style="text-align:left;margin-top:20px">6. Additional request<span style="color:red">*</span></h2>
                <div style="margin:10px 0 0 30px;text-align:left;font-size:16px">
                    <p style="margin-bottom:10px">Please describe in details for an accurate diagnosis</p>
                        <div class="form-group mt-1">
                                <textarea class="form-control-sign_up" style="height:100px; font-size:14px;" name="special_instruction"><?=$_SESSION['special_instruction']?></textarea>
                                <div class="form-control-sign_up-border"></div>
                        </div>	
                </div>
            </div>

            <div class="button_menu" style="padding:10px;">
                <!--		<a href="javascript:servicePopupClose();" class="service_close">Close</a>-->
                <input type="submit" id="btn_pre" value="Back" class="btn_black hover190">
                <input type="submit" id="btn_next" value="Next" class="btn_blue hover190">
            </div>
    </form>
</div>
<?
if ($_SESSION['extraction'] == "tooth_e") {
echo "<script>";
if(count($_SESSION['e_select_number']) > 0){
for ($i=0; $i < count($_SESSION['e_select_number']); $i++) { 
	echo "$('#extraction_".$_SESSION['e_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#extraction_".$_SESSION['e_select_number'][$i]."').val(".$_SESSION['e_select_number'][$i].");
	  $('#service_info_form').append(\"<input type='hidden'  name='e_select_number[]' id='".$_SESSION['e_select_number'][$i]."' value='".$_SESSION['e_select_number'][$i]."'>\");
         ";
}
}
echo "</script>";
}
	
?>

<script>
$(document).ready(function(){

    $('#btn_pre').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='09_setup2.php' />");
    });
    
    $('#btn_next').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='13_summary.php' />");
    });



    $('.number').prop('disabled', true);


    if($('#arch').val() != "lower" ){

        if ($(':input:radio[name=extraction]:checked').val() == "tooth_e") {
            $('button[name=upperBrackets]').prop('disabled', false);
        }

		}


    if($('#arch').val() != "upper" ){ 
        
        if($(':input:radio[name=extraction]:checked').val() == "tooth_e"){
            $('button[name=lowerBrackets]').prop('disabled', false);
        }
	}

	
		$("input[name=occ_opening_device_option]").click(function(e) {
				if ($(this).val() != "none")
				{
					if ($("#Central_incisor").is(":checked") || $("#Lateral_incisor").is(":checked"))
						{
							return;
						}

					$("input[name=occ_opening_device_type]").prop("disabled",false);
					$("#Incisor").prop("checked",true);
					$("#Central_incisor").prop("disabled",false);
					$("#Lateral_incisor").prop("disabled",false);

					$("#Central_incisor").prop("checked",true);
						
				}else{
					
					$("input[name=occ_opening_device_type]").prop("disabled",true);
					$("input[name=occ_opening_device_type]").prop("checked",false);

					$("#Central_incisor").prop("disabled",true);
					$("#Lateral_incisor").prop("disabled",true);
					$("#Central_incisor").prop("checked",false);
					$("#Lateral_incisor").prop("checked",false);

				}
	
			});
		
		$("input[name=occ_opening_device_type]").click(function(e) {
		
			if ($(this).val() != "incisor")
			{
				$("#Central_incisor").prop("disabled",true);
				$("#Lateral_incisor").prop("disabled",true);
				
				$("#Central_incisor").prop("checked",false);
					$("#Lateral_incisor").prop("checked",false);
				
			}else{
				if ($("#Central_incisor").is(":checked") || $("#Lateral_incisor").is(":checked"))
				{
					return;
				}
				$("#Central_incisor").prop("disabled",false);
				$("#Lateral_incisor").prop("disabled",false);
				$("#Central_incisor").prop("checked",true);
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
		

		$("input[name=extraction]").click(function(e) {
			if ($(this).val() == "tooth_e" && $('#arch').val() == "both")
			{
				$('button[name=upperBrackets]').prop('disabled', false);
				$('button[name=lowerBrackets]').prop('disabled', false);
			}else if ($(this).val() == "tooth_e" && $('#arch').val() == "upper" )
			{
				$('button[name=upperBrackets]').prop('disabled', false);
			}else if ($(this).val() == "tooth_e" && $('#arch').val() == "lower" )
			{
				$('button[name=lowerBrackets]').prop('disabled', false);
			}else{
				 $('.number').prop('disabled', true);
					$(".number").each(function (e){
						 if ($(this).val() != "") {
								$(this).css({"background":""});
								$(this).text($(this).val());
								$(this).val("");	
								$('#'+$(this).text()).remove();
							}
					});
			}
	});

    $(".number").click(function(e) {
        if ($(this).val() == "") {
            $(this).css({"background-color":"#07a2e8", 'background-repeat' : 'no-repeat', 'background-position':'center'});
            $(this).val($(this).text());
			$('#service_info_form').append("<input type='hidden' id='"+e.target.id.split("_")[1]+"' name='e_select_number[]' value='"+e.target.id.split("_")[1]+"'>");
            //$(this).text('');
        }else{
            $(this).css({"background":""});
            $(this).text($(this).val());
            $(this).val("");	
			$('#'+e.target.id.split("_")[1]).remove();
        }
			
		});

		

});

</script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>

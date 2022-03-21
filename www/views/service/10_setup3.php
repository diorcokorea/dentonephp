<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service =10;


?>

<div class="content" style="background-color:#fff;">
	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
   // ini_set("display_errors", "1");
	?>
		<form id="service_info_form" name="service_info_form" action='service_info.php' method='post'>

			<?
    echo "<input type='hidden' id='arch' value=".$_SESSION['arch'].">";
    ?>

	<div class="bracket_inner">
		<div class="used_brackets" style="overflow:hidden;">
		<div class="service_title" style="margin-bottom:0">
		<h2><span style="color:#333;margin-right:10px"><?=$_SESSION['first_name']." ".$_SESSION['last_name']?></span>(<? if($_SESSION['treatment_option1'] == "Adults"){ echo $_SESSION['treatment_option1']." including teenager,";}else{echo $_SESSION['treatment_option1'];} ?> <?=$_SESSION['treatment_option2']?>)</h2>
		</div>
			<div class="used_brackets" style="overflow:hidden;">
				<h2 style="text-align:left;margin-top:40px">5. Overjet & Overbite<span style="color:red">*</span></h2>
				<div style="margin:20px 0 0 30px;text-align:left">
					<p style="float:left; width:100px">Overjet</p>
					<input type="radio" id="overjet_ideal"  onclick="overjetSelect();" <?if($_SESSION['overjet'] == "Ideal" || !isset($_SESSION['overjet'])){ echo "checked";}?> name="overjet" value="Ideal" style="margin-right:20px">
					<label for="overjet_ideal" style="margin-right:60px">Ideal(2mm)</label>
					<div style="display:inline-block">
						<input type="radio" onclick="overjetSelect();" <?if($_SESSION['overjet'] == "custom"){ echo "checked";}?> id="overjet_custom" name="overjet" value="custom" style="margin-right:20px">
						<label for="overjet_custom">Custom</label>
						<input id="overjet_custom_n" name="overjet_value"  required oninvalid="this.setCustomValidity('Please enter a number.')" oninput="setCustomValidity('')" value="<?=$_SESSION['overjet_value']?>" <?if($_SESSION['overjet'] != "custom"){ echo "disabled";}?> type="text" placeholder="-----" maxlength="3" style="margin-left:20px;width:80px;height:25px;padding:5px"><span style="margin-left:5px">mm</span>
					</div>
				</div>
				<div style="margin:20px 0 0 30px;text-align:left">
					<p style="float:left;width:100px">Overbite</p>
					<input type="radio" id="overbite_ideal" onclick="overbiteSelect();"  <?if($_SESSION['overbite'] == "Ideal" || !isset($_SESSION['overbite'])){ echo "checked";}?> name="overbite" value="Ideal" style="margin-right:20px">
					<label for="overbite_ideal" style="margin-right:60px">Ideal(2mm)</label>
					<div style="display:inline-block">
						<input type="radio" onclick="overbiteSelect();"  <?if($_SESSION['overbite'] == "custom"){ echo "checked";}?>  id="overbite_custom"  name="overbite" value="custom"  style="margin-right:20px">
						<label for="overbite_custom">Custom</label>
						<input id="overbite_custom_n" type="text" name="overbite_value"  required oninvalid="this.setCustomValidity('Please enter a number.')" oninput="setCustomValidity('')" value="<?=$_SESSION['overbite_value']?>" <?if($_SESSION['overbite'] != "custom"){ echo "disabled";}?>   placeholder="-----" maxlength="3" style="margin-left:20px;width:80px;height:25px;padding:5px"><span style="margin-left:5px">mm</span>
					</div>
				</div>
			</div>
			<div class="used_brackets" style="overflow:hidden;">
				<h2 style="text-align:left;margin-top:40px">6. Midline<span style="color:red">*</span></h2>
				<div style="margin:20px 0 0 30px;text-align:left">
					<input type="radio" id="midline_maintain" name="midline" <?if($_SESSION['midline'] == "maintain_the_midline" || $_SESSION['midline'] == null ){ echo "checked";}?> value="maintain_the_midline" style="margin-right:20px">
					<label for="midline_maintain" style="margin-right:60px">Maintain midline</label>
				</div>
				<div style="margin:20px 0 0 30px;text-align:left">
					<input type="radio" id="midline_improvment" name="midline" <?if($_SESSION['midline'] == "improvement"){ echo "checked";}?> value="improvement"   style="margin-right:20px">
					<label for="midline_improvment" style="margin-right:60px">Improve midline</label>
					<div style="margin:20px 0 0 30px;text-align:left">
						<p style="float:left;width:100px">Upper</p>
						<div style="display:inline-block">

							<input type="radio" <?if($_SESSION['midline'] != "improvement" || $_SESSION['arch'] == "lower"){ echo "disabled";}else if($_SESSION['midline_upper'] == "right") { echo "checked";}?> id="midline_upper_right"  name="midline_upper" value="right" style="margin-right:20px">
							<label for="midline_upper_right">Right</label>
							<input id="midline_upper_right_value" type="text" name="midline_upper_right_value"  required oninvalid="this.setCustomValidity('Please enter a number.')" oninput="setCustomValidity('')" value="<?=$_SESSION['midline_upper_right_value']?>" <?if($_SESSION['midline_upper'] != "right"){ echo "disabled";}?>   placeholder="-----" maxlength="3" style="margin-left:20px;width:80px;height:25px;padding:5px">
							<span>mm</span>
						</div>
						<div style="display:inline-block;margin-left:40px">

							<input type="radio" <?if($_SESSION['midline'] != "improvement" || $_SESSION['arch'] == "lower"){ echo "disabled";}else if($_SESSION['midline_upper'] == "left") { echo "checked";}?> id="midline_upper_left"  name="midline_upper" value="left" style="margin-right:18px">
							<label for="midline_upper_left">Left</label>
							<input id="midline_upper_left_value" type="text" name="midline_upper_left_value"  required oninvalid="this.setCustomValidity('Please enter a number.')" oninput="setCustomValidity('')" value="<?=$_SESSION['midline_upper_left_value']?>" <?if($_SESSION['midline_upper'] != "left"){ echo "disabled";}?>   placeholder="-----" maxlength="3" style="margin-left:20px;width:80px;height:25px;padding:5px">
							<span>mm</span>
						</div>
						<div style="display:inline-block;margin-left:38px">
							<input type="radio" <?if($_SESSION['midline'] != "improvement" || $_SESSION['arch'] == "lower"){ echo "disabled";}else if($_SESSION['midline_upper'] == "none") { echo "checked";}?> id="midline_upper_none"  name="midline_upper" value="none" style="margin-right:20px">
							<label for="midline_upper_none">Not required</label>
						</div>
					</div>
					<div style="margin:20px 0 0 30px;text-align:left">
						<p style="float:left;width:100px">Lower</p>
						<div style="display:inline-block">
							<input type="radio" <?if($_SESSION['midline'] != "improvement"  || $_SESSION['arch'] == "upper"){ echo "disabled";}else if($_SESSION['midline_lower'] == "right") { echo "checked";}?> id="midline_lower_right"  name="midline_lower" value="right" style="margin-right:20px">
							<label for="midline_lower_right">Right</label>
							<input id="midline_lower_right_value" type="text" name="midline_lower_right_value"  required oninvalid="this.setCustomValidity('Please enter a number.')" oninput="setCustomValidity('')" value="<?= $_SESSION['midline_lower_right_value']?>" <?if($_SESSION['midline_lower'] != "right"){ echo "disabled";}?>   placeholder="-----" maxlength="3" style="margin-left:20px;width:80px;height:25px;padding:5px"><span style="margin-left:5px">mm</span>
						</div>
						<div style="display:inline-block;margin-left:40px">
							<input type="radio" <?if($_SESSION['midline'] != "improvement" || $_SESSION['arch'] == "upper"){ echo "disabled";}else if($_SESSION['midline_lower'] == "left") { echo "checked";}?> id="midline_lower_left"  name="midline_lower" value="left"  style="margin-right:20px">
							<label for="midline_lower_left">Left</label>
							<input id="midline_lower_left_value" type="text" name="midline_lower_left_value"  required oninvalid="this.setCustomValidity('Please enter a number.')" oninput="setCustomValidity('')" value="<?=$_SESSION['midline_lower_left_value']?>" <?if($_SESSION['midline_lower'] != "left"){ echo "disabled";}?>   placeholder="-----" maxlength="3" style="margin-left:20px;width:80px;height:25px;padding:5px"><span style="margin-left:5px">mm</span>
						</div>
						<div style="display:inline-block;margin-left:40px">
							<input type="radio" <?if($_SESSION['midline'] != "improvement" || $_SESSION['arch'] == "lower"){ echo "disabled";}else if($_SESSION['midline_lower'] == "none") { echo "checked";}?> id="midline_lower_none"  name="midline_lower" value="none" style="margin-right:20px">
							<label for="midline_lower_none">Not required</label>
						</div>
					</div>
				</div>
				<h2 style="text-align:left;margin-top:40px">7. IPR<span style="color:red">*</span></h2>
				<div style="margin:20px 0 0 30px;text-align:left">
					<input type="radio"<?if($_SESSION['ipr_option'] == "Proceed" || $_SESSION['ipr_option'] == null) echo "checked";?> id="ipr_option_proceed" name="ipr_option" value="Proceed" style="margin-right:20px" ><label for="ipr_option_proceed" style="margin-right:60px">Proceed</label>
					<input type="radio"<?if($_SESSION['ipr_option'] == "Proceed if necessary") echo "checked";?> id="ipr_option_necessary" name="ipr_option" value="Proceed if necessary" style="margin-right:20px" ><label for="ipr_option_necessary" style="margin-right:60px">Proceed if necessary</label>
					<input type="radio"<?if($_SESSION['ipr_option'] == "Not required") echo "checked";?> id="ipr_option_required" name="ipr_option" value="Not required" style="margin-right:20px" ><label for="ipr_option_required" >Not required</label>
				</div>
			</div>
		</div>

		
	</div>
	
	
	<div class="button_menu" style="padding:10px;">
		<a href="javascript:servicePopupClose();"  class="service_close">Close</a>
        <input type="submit" id="btn_pre" value="Back" class="service_close" style="margin:0">
		<input type="submit" id="btn_next"  value="Next" class="service_next"> 
	</div>
	</form></div></div>
</div>


<script>
$(document).ready(function(){

    $('#btn_pre').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='09_setup2.php' />");
    });
    
    $('#btn_next').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='11_setup4.php' />");
    });



	
$('input[name=midline]').click(function(e){
	
		if ($(this).val() == "maintain_the_midline")
		{
			$("input[name=midline_upper]").prop("disabled",true);
			$("input[name=midline_upper]").prop("checked",false);
			$("#midline_upper_right_value").prop("disabled",true);
			$("#midline_upper_right_value").val("");
			$("#midline_upper_left_value").prop("disabled",true);
			$("#midline_upper_left_value").val("");
			

			$("input[name=midline_lower]").prop("disabled",true);
			$("input[name=midline_lower]").prop("checked",false);
			$("#midline_lower_right_value").prop("disabled",true);
			$("#midline_lower_right_value").val("");
			$("#midline_lower_left_value").prop("disabled",true);
			$("#midline_lower_left_value").val("");


		}else if ($(this).val() == "improvement")
		{
			if ($("#arch").val() == "both")
			{
					$("#midline_upper_none").prop("checked", true);
					$("#midline_lower_none").prop("checked", true);
				$("input[name=midline_upper]").prop("disabled",false);
				$("input[name=midline_lower]").prop("disabled",false);
			}else if ($("#arch").val() == "upper")
			{
				$("#midline_upper_none").prop("checked", true);
				$("input[name=midline_upper]").prop("disabled",false);
			}else if ($("#arch").val() == "lower")
			{
				$("#midline_lower_none").prop("checked", true);
				$("input[name=midline_lower]").prop("disabled",false);
			}
			
			

		}

			
});



	$('input[name=midline_upper').click(function(e){
		if ($(this).val() == "right")
		{
			$('#midline_upper_right_value').prop("disabled",false);
			$('#midline_upper_left_value').prop("disabled",true);
		}else if ($(this).val() == "left")
		{
			$('#midline_upper_right_value').prop("disabled",true);
			$('#midline_upper_left_value').prop("disabled",false);
		}else{
			$('#midline_upper_right_value').prop("disabled",true);
			$('#midline_upper_left_value').prop("disabled",true);
		}

	});


	$('input[name=midline_lower').click(function(e){
		if ($(this).val() == "right")
		{
			$('#midline_lower_right_value').prop("disabled",false);
			$('#midline_lower_left_value').prop("disabled",true);
		}else if ($(this).val() == "left")
		{
			$('#midline_lower_right_value').prop("disabled",true);
			$('#midline_lower_left_value').prop("disabled",false);
		}else{
			$('#midline_lower_right_value').prop("disabled",true);
			$('#midline_lower_left_value').prop("disabled",true);
		}

	});








});

$(document).on("keyup", "input[name^=overbite_custom_n]", function() {
    var val= $(this).val();

    if(val.replace(/[0.0-9.9]/g, "").length > 0) {
        alert("숫자만 입력해 주십시오.");
        $(this).val('');
    }

    if(val < 0.0 || val > 9.9) {
        alert("0.0~9.9mm까지 입력 가능합니다.");
        $(this).val('');
    }
});

$(document).on("keyup", "input[name^=overjet_custom_n]", function() {
    var val= $(this).val();

    if(val.replace(/[0.0-9.9]/g, "").length > 0) {
        alert("숫자를 입력해 주십시오.");
        $(this).val('');
    }

    if(val < 0.0 || val > 9.9) {
        alert("0.0~9.9mm까지 입력 가능합니다.");
        $(this).val('');
    }
});



</script>

<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>
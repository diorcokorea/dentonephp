<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
$service =12;


?>

<div class="content" style="background-color:#fff;">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>
    <form id="service_info_form" onsubmit='return nullChk07();' name="service_info_form" action='service_info.php'  method='post'>
  <?
    echo "<input type='hidden' id='arch' value=".$_SESSION['arch'].">";
    ?>
    
	<div class="bracket_inner">
		<div class="service_title" style="margin-bottom:0">
			<h2><span style="color:#333;margin-right:10px"><?=$_SESSION['first_name']." ".$_SESSION['last_name']?></span>(<? if($_SESSION['treatment_option1'] == "Adults"){ echo $_SESSION['treatment_option1']." including teenager,";}else{echo $_SESSION['treatment_option1'];} ?> <?=$_SESSION['treatment_option2']?>)</h2>
		</div>
		<div class="used_brackets">
			<h2 style="text-align:left;margin-top:40px">10. Eruption compensation<span style="color:red">*</span></h2>
			<div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
			<p>If eruption compensation (EC) is requested, primary teeth (if any) are virtually extracted and eruption compensation (EC) for<br>permanent teeth is granted from step 1. The baby teeth must be extracted brfore the aligner is transferred.</p>
			<div style="margin-top:20px">
				<div style="text-align:left;display:inline-block;vertical-align:top">
					<p>Eruption compensation</p>
					<div style="text-align:left;margin:10px 0">
						<input type="radio" id="eruption_none" <?if($_SESSION['eruption_incisor_option'] == "none" || $_SESSION['eruption_incisor_option'] == null) echo checked; ?>  name="eruption_incisor_option" value="none" style="margin-right:20px">
						<label for="eruption_none" style="margin-right:60px">None</label>
						<input type="radio" id="eruption_provide" <?if($_SESSION['eruption_incisor_option'] == "provide" ) echo checked; ?> name="eruption_incisor_option" value="provide" style="margin-right:20px">
						<label for="eruption_provide">Select teeth for compensation</label>
					</div>
					<div style="overflow:hidden;display:inline-block">
						<p  class="RL" style="margin-right:5px">R</p>
						<div style="overflow:hidden;display:inline-block;float:left">
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
								<button type="button" class="number" id="incisor_15" name="upperBrackets" >15</button>
								<button type="button" class="number" id="incisor_14" name="upperBrackets" >14</button>
								<button type="button" class="number" id="incisor_13" name="upperBrackets"  style="margin:0">13</button>
							</div>
							<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
								<button type="button" class="number" id="incisor_45" name="lowerBrackets" >45</button>
								<button type="button" class="number" id="incisor_44" name="lowerBrackets" >44</button>
								<button type="button" class="number" id="incisor_43" name="lowerBrackets" style="margin:0">43</button>
							</div>
						</div>
						<div style="overflow:hidden;display:inline-block;float:left">
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
								<button type="button" class="number" id="incisor_23" name="upperBrackets" >23</button>
								<button type="button" class="number" id="incisor_24" name="upperBrackets" >24</button>
								<button type="button" class="number" id="incisor_25" name="upperBrackets" style="margin:0">25</button>
							</div>
							<div style="padding-top:5px;overflow:hidden;padding-left:5px">
								<button type="button" class="number" id="incisor_33" name="lowerBrackets" >33</button>
								<button type="button" class="number" id="incisor_34" name="lowerBrackets" >34</button>
								<button type="button" class="number" id="incisor_35" name="lowerBrackets" style="margin:0">35</button>
							</div>
						</div>
						<p class="RL" style="margin-left:5px">L</p>
					</div>
				</div>
				<div style="text-align:left;display:inline-block;margin-left:40px;vertical-align:top">
					<p>Provide space for eruption of 2nd molars.</p>
					<div style="text-align:left;margin:10px 0">
						<input type="radio" id="molar_provide_none" <?if($_SESSION['eruption_molar_option'] == "none" || $_SESSION['eruption_molar_option'] == null) echo checked; ?>  name="eruption_molar_option" value="none" style="margin-right:20px">
						<label for="molar_provide_none" style="margin-right:60px">None</label>
						<input type="radio" id="molar_provide_eruption" <?if($_SESSION['eruption_molar_option'] == "provide") echo checked; ?> name="eruption_molar_option" value="provide" style="margin-right:20px">
						<label for="molar_provide_eruption">Select teeth for compensation</label>
					</div>
					<div style="overflow:hidden;">
						<p  class="RL" style="margin-right:5px">R</p>
						<div style="overflow:hidden;display:inline-block;float:left">
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
								<button type="button" class="number" id="molar_17" name="upperBrackets1" style="margin:0">17</button>
							</div>
							<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
								<button type="button" class="number" id="molar_47" name="lowerBrackets1" style="margin:0">47</button>
							</div>
						</div>
						<div style="overflow:hidden;display:inline-block;float:left">
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
								<button type="button" class="number" id="molar_27" name="upperBrackets1" style="margin:0">27</button>
							</div>
							<div style="padding-top:5px;overflow:hidden;padding-left:5px">
								<button type="button" class="number" id="molar_37" name="lowerBrackets1" style="margin:0">37</button>
							</div>
						</div>
						<p class="RL" style="margin-left:5px">L</p>
					</div>
					<div style="margin-top:10px">
						<p style="display:inline-block">Step to start provide space<br>for eruption of 2nd molars</p>
						<input id="eruption_molar_value" type="text" value="<?=$_SESSION['eruption_molar_value']?>" name="eruption_molar_value" disabled  required oninvalid="this.setCustomValidity('Please enter a number.')" oninput="setCustomValidity('')"  placeholder="-----" maxlength="3" style="margin-left:5px;width:60px;height:25px;padding:5px;display:inline-block;vertical-align:top">
					</div>
				</div>
				</div>
			</div>
			<h2 style="text-align:left;">11. Additional request<span style="color:red">*</span></h2>
				<div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
					<p style="margin-bottom:10px">Please describe in details for an accurate diagnosis</p>
					<textarea style="width:100%;height:100px" name="special_instruction" maxlength="4000"><?=$_SESSION['special_instruction']?></textarea>
				</div>
		</div>
	</div>
	
	<div class="button_menu" style="padding:10px;">
<!--		<a href="javascript:servicePopupClose();" class="service_close">Close</a>-->
        <input type="submit" id="btn_pre" value="Back" class="service_close" style="margin:0">
		<input type="submit" id="btn_next"  value="Next" class="service_next"> 
	</div>
    </form>
</div>


<?

echo "<script>";
if ($_SESSION['eruption_incisor_option'] == "provide") {
	for ($i=0; $i < count($_SESSION['incisor_select_number']); $i++) { 
		echo "$('#incisor_".$_SESSION['incisor_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
		  $('#incisor_".$_SESSION['incisor_select_number'][$i]."').val(".$_SESSION['incisor_select_number'][$i].");
		  $('#service_info_form').append(\"<input type='hidden'  name='incisor_select_number[]' id='incisor_num_".$_SESSION['incisor_select_number'][$i]."' value='".$_SESSION['incisor_select_number'][$i]."'>\");";
	}
}

if ($_SESSION['eruption_molar_option'] == "provide") {
	for ($i=0; $i < count($_SESSION['molar_select_number']); $i++) { 
		echo "$('#molar_".$_SESSION['molar_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
		  $('#molar_".$_SESSION['molar_select_number'][$i]."').val(".$_SESSION['molar_select_number'][$i].");
		  $('#service_info_form').append(\"<input type='hidden'  name='molar_select_number[]' id='molar_num_".$_SESSION['molar_select_number'][$i]."' value='".$_SESSION['molar_select_number'][$i]."'>\");";
	}
}


echo "</script>";
?>


<script>
$(document).ready(function(){

    $('#btn_pre').on('click', function(event){
        nullChk07();
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='11_setup4.php' />");
    });
    
    $('#btn_next').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='13_summary.php' />");
    });


    $('.number').prop('disabled', true);

	//Eruption 
	if($('#arch').val() == "both" && $("#eruption_provide").prop("checked")){
		$('button[name=upperBrackets]').prop('disabled',false);
		$('button[name=lowerBrackets]').prop('disabled',false);
	}else if ($('#arch').val() == "upper" && $("#eruption_provide").prop("checked") )
	{
		$('button[name=upperBrackets]').prop('disabled',false);
	}else if ($('#arch').val() == "lower" && $("#eruption_provide").prop("checked"))
	{
		$('button[name=lowerBrackets]').prop('disabled',false);
	}

	//Molars
	if($('#arch').val() == "both" && $("#molar_provide_eruption").prop("checked")){
	
		$('#eruption_molar_value').prop('disabled',false);
		$('button[name=upperBrackets1]').prop('disabled',false);
		$('button[name=lowerBrackets1]').prop('disabled',false);
	}else if ($('#arch').val() == "upper" && $("#molar_provide_eruption").prop("checked") )
	{
		$('button[name=upperBrackets1]').prop('disabled',false);
		$('#eruption_molar_value').prop('disabled',false);
	}else if ($('#arch').val() == "lower" && $("#molar_provide_eruption").prop("checked"))
	{
		$('button[name=lowerBrackets1]').prop('disabled',false);
		$('#eruption_molar_value').prop('disabled',false);
	}



	
	$("#eruption_provide").click(function() {
		if($('#arch').val() == "both" && $("#eruption_provide").prop("checked")){
			$('button[name=upperBrackets]').prop('disabled',false);
			$('button[name=lowerBrackets]').prop('disabled',false);
		}else if ($('#arch').val() == "upper" && $("#eruption_provide").prop("checked") )
		{
			$('button[name=upperBrackets]').prop('disabled',false);
		}else if ($('#arch').val() == "lower" && $("#eruption_provide").prop("checked"))
		{
			$('button[name=lowerBrackets]').prop('disabled',false);
		}
	});

	$("#molar_provide_eruption").click(function() {
		if($('#arch').val() == "both" && $("#molar_provide_eruption").prop("checked")){
			$('button[name=upperBrackets1]').prop('disabled',false);
			$('button[name=lowerBrackets1]').prop('disabled',false);
			$('#eruption_molar_value').prop('disabled',false);
		}else if ($('#arch').val() == "upper" && $("#molar_provide_eruption").prop("checked") )
		{
			$('button[name=upperBrackets1]').prop('disabled',false);
			$('#eruption_molar_value').prop('disabled',false);
		}else if ($('#arch').val() == "lower" && $("#molar_provide_eruption").prop("checked"))
		{
			$('button[name=lowerBrackets1]').prop('disabled',false);
			$('#eruption_molar_value').prop('disabled',false);
		}
	});


		$("#eruption_none").click(function() {
			$('button[name=upperBrackets]').prop('disabled',true);
			$('button[name=lowerBrackets]').prop('disabled',true);

			$('button[name=upperBrackets]').css({"background-color":"#4b4b4b"});
			$('button[name=lowerBrackets]').css({"background-color":"#4b4b4b"});
			$('button[name=upperBrackets]').val("");	
			$('button[name=lowerBrackets]').val("");	
		});

		$("#molar_provide_none").click(function() {
			
			$('#eruption_molar_value').prop('disabled',true);
			$('#eruption_molar_value').val('');

			$('button[name=upperBrackets1]').prop('disabled',true);
			$('button[name=lowerBrackets1]').prop('disabled',true);

			$('button[name=upperBrackets1]').css({"background-color":"#4b4b4b"});
			$('button[name=lowerBrackets1]').css({"background-color":"#4b4b4b"});
			$('button[name=upperBrackets1]').val("");	
			$('button[name=lowerBrackets1]').val("");	
	});


    $(".number").click(function() {
		//alert(this.name);
		if (this.name == "upperBrackets1" || this.name == "lowerBrackets1")
		{
			if ($(this).val() == "") {
				$(this).css({"background-color":"#07a2e8", 'background-repeat' : 'no-repeat', 'background-position':'center'});
			   $(this).val($(this).text());
				$('#service_info_form').append("<input type='hidden' id='molar_num_"+$(this).text()+"' name='molar_select_number[]' value='"+$(this).text()+"'>");
				//$(this).text('');
			}else{
				$(this).css({"background-color":"#4b4b4b"});
			  //  $(this).text($(this).val());
				$(this).val("");	
				$('#molar_num_'+$(this).text()).remove();
			}
	
		}else{
			if ($(this).val() == "") {
				$(this).css({"background-color":"#07a2e8", 'background-repeat' : 'no-repeat', 'background-position':'center'});
			   $(this).val($(this).text());
				$('#service_info_form').append("<input type='hidden' id='incisor_num_"+$(this).text()+"' name='incisor_select_number[]' value='"+$(this).text()+"'>");
				//$(this).text('');
			}else{
				$(this).css({"background-color":"#4b4b4b"});
			  //  $(this).text($(this).val());
				$(this).val("");	
				$('#incisor_num_'+$(this).text()).remove();
			}
		}
		});

		

});
</script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>

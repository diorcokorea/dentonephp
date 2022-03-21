<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service =9;
if($_SESSION['progress_num'] > $service ){$progress_num = $service; }
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
		<div class="service_title" style="margin-bottom:0">
		<h2><span style="color:#333;margin-right:10px"><?=$_SESSION['first_name']." ".$_SESSION['last_name']?></span>(<? if($_SESSION['treatment_option1'] == "Adults"){ echo $_SESSION['treatment_option1']." including teenager,";}else{echo $_SESSION['treatment_option1'];} ?> <?=$_SESSION['treatment_option2']?>)</h2>
		</div>
		<div class="used_brackets" style="overflow:hidden;">
			<h2 style="text-align:left;margin-top:40px">3. Attachment<span style="color:red">*</span></h2>
				<div style="margin:20px 0 0 30px;text-align:left">
					<input type="radio" id="AutomaticallyCheckBox"   <?if($_SESSION['attchment_option'] == "automatically" || $_SESSION['attchment_option'] == null){ echo "checked";}?>  name="attchment_option" value="automatically" style="margin-right:20px" onclick=""><label for="AutomaticallyCheckBox" style="margin-right:60px">Automatically add attachments for necessary teeth movement</label>
					<input type="radio" id="SelectCheckBox" <?if($_SESSION['attchment_option'] == "select"){ echo "checked";}?> name="attchment_option" value="select" style="margin-right:20px" onclick=""><label for="SelectCheckBox" >Select teeth to apply attachments</label>
				</div>
				<div style="overflow:hidden;margin:20px 0 0 30px;">
					<p class="RL" style="margin-right:5px">R</p>
					<div style="overflow:hidden;display:inline-block;float:left">
                    <? include("setup2_layer.php");  ?>
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
							<button type="button" disabled class="number" id="attchment_18" name="upperBrackets" >18</button>
							<button type="button" disabled class="number" id="attchment_17" name="upperBrackets" >17</button>
							<button type="button" disabled class="number" id="attchment_16" name="upperBrackets" >16</button>
							<button type="button" disabled class="number" id="attchment_15" name="upperBrackets" >15</button>
							<button type="button" disabled class="number" id="attchment_14" name="upperBrackets" >14</button>
							<button type="button" disabled class="number" id="attchment_13" name="upperBrackets" >13</button>
							<button type="button" disabled class="number" id="attchment_12" name="upperBrackets" >12</button>
							<button type="button" disabled class="number" id="attchment_11" name="upperBrackets"  style="margin:0">11</button>
						</div>
						<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                            <button type="button" disabled class="number" id="attchment_48"  name="lowerBrackets">48</button>
							<button type="button" disabled class="number" id="attchment_47" name="lowerBrackets" >47</button>
							<button type="button" disabled class="number" id="attchment_46" name="lowerBrackets" >46</button>
							<button type="button" disabled class="number" id="attchment_45" name="lowerBrackets" >45</button>
							<button type="button" disabled class="number" id="attchment_44" name="lowerBrackets" >44</button>
							<button type="button" disabled class="number" id="attchment_43" name="lowerBrackets" >43</button>
							<button type="button" disabled class="number" id="attchment_42" name="lowerBrackets" >42</button>
							<button type="button" disabled class="number" id="attchment_41" name="lowerBrackets"  style="margin:0">41</button>

						</div>
					</div>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">

                            <button type="button" disabled class="number" id="attchment_21" name="upperBrackets" >21</button>
							<button type="button" disabled class="number" id="attchment_22" name="upperBrackets" >22</button>
							<button type="button" disabled class="number" id="attchment_23" name="upperBrackets" >23</button>
							<button type="button" disabled class="number" id="attchment_24" name="upperBrackets" >24</button>
							<button type="button" disabled class="number" id="attchment_25" name="upperBrackets" >25</button>
							<button type="button" disabled class="number" id="attchment_26" name="upperBrackets" >26</button>
							<button type="button" disabled class="number" id="attchment_27" name="upperBrackets" >27</button>
							<button type="button" disabled class="number" id="attchment_28" name="upperBrackets"  style="margin:0">28</button>
						</div>
						<div style="padding-top:5px;overflow:hidden;padding-left:5px">
							<button type="button" disabled class="number" id="attchment_31" name="lowerBrackets" >31</button>
							<button type="button" disabled class="number" id="attchment_32" name="lowerBrackets" >32</button>
							<button type="button" disabled class="number" id="attchment_33" name="lowerBrackets" >33</button>
							<button type="button" disabled class="number" id="attchment_34" name="lowerBrackets" >34</button>
							<button type="button" disabled class="number" id="attchment_35" name="lowerBrackets" >35</button>
							<button type="button" disabled class="number" id="attchment_36" name="lowerBrackets" >36</button>
							<button type="button" disabled class="number" id="attchment_37" name="lowerBrackets" >37</button>
							<button type="button" disabled class="number" id="attchment_38" name="lowerBrackets"  style="margin:0">38</button>
						</div>
					</div>
					<p class="RL" style="margin-left:5px">L</p>
					
				</div>
				<h2 style="text-align:left;margin-top:40px">4. A.P Relationship<span style="color:red">*</span></h2>
				<div style="margin:20px 0 0 30px;text-align:left">
					<div style="display:inline-block">
						<p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Upper</p>
						<div style="display:inline-block;margin-left:20px">
							<div>
								<input type="radio" id="relation_upper_expansion" <?if($_SESSION['ap_relation_upper'] == "expansion" || $_SESSION['ap_relation_upper'] == null){ echo "checked";}?> disabled name="ap_relation_upper" value="expansion" style="margin-right:10px">
								<label for="relation_upper_expansion">Protrusion</label>
							</div>
							<div style="margin-top:10px">
								<input type="radio" id="relation_upper_retraction" <?if($_SESSION['ap_relation_upper'] == "retraction" ){ echo "checked";}?> disabled name="ap_relation_upper" value="retraction" style="margin-right:10px">
								<label for="relation_upper_retraction" >Retraction</label>
							</div>
						</div>
					</div>
					<div style="display:inline-block;margin-left:60px">
						<p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Lower</p>
						<div style="display:inline-block;margin-left:20px">
							<div>
								<input type="radio" id="relation_lower_expansion" <?if($_SESSION['ap_relation_lower'] == "expansion" || $_SESSION['ap_relation_lower'] == null){ echo "checked";}?> disabled name="ap_relation_lower" value="expansion" style="margin-right:10px">
								<label for="relation_lower_expansion">Protrusion</label>
							</div>
							<div style="margin-top:10px">
								<input type="radio" id="relation_lower_retraction" <?if($_SESSION['ap_relation_lower'] == "retraction" ){ echo "checked";}?> disabled name="ap_relation_lower" value="retraction" style="margin-right:10px">
								<label for="relation_lower_retraction" >Retraction</label>
							</div>
						</div>
					</div>
				</div>
				<div style="margin:40px 0 0 30px;text-align:left">
					<div style="display:inline-block">
						<p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Canine Relationship</p>
						<div style="display:inline-block;margin-left:20px">
							<div>
								<input type="radio" id="canine_maintain" name="ap_relation_canine" <?if($_SESSION['ap_relation_canine'] == "maintain" || $_SESSION['ap_relation_canine'] == null){ echo "checked";}?> value="maintain" style="margin-right:10px">
								<label for="canine_maintain">Maintain</label>
							</div>
							<div style="margin-top:10px">
								<input type="radio" id="canine_Improve" name="ap_relation_canine" <?if($_SESSION['ap_relation_canine'] == "improve" ){ echo "checked";}?> value="improve" style="margin-right:10px">
								<label for="canine_Improve" >Improve</label>
							</div>
						</div>
					</div>
					<div style="display:inline-block;margin-left:60px">
						<p style="display:inline-block;vertical-align:top;width:180px;font-weight:bold">Molar Relationship</p>
						<div style="display:inline-block;margin-left:20px">
							<div>
								<input type="radio" id="molar_maintain" name="ap_relation_molar" <?if($_SESSION['ap_relation_molar'] == "maintain" || $_SESSION['ap_relation_molar'] == null){ echo "checked";}?> value="maintain" style="margin-right:10px">
								<label for="molar_maintain">Maintain</label>
							</div>
							<div style="margin-top:10px">
								<input type="radio" id="molar_Improve" name="ap_relation_molar" <?if($_SESSION['ap_relation_molar'] == "improve" ){ echo "checked";}?> value="improve" style="margin-right:10px">
								<label for="molar_Improve" >Improve</label>
							</div>
						</div>
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
<?
if ($_SESSION['attchment_option'] == "select") {
echo "<script>";
for ($i=0; $i < count($_SESSION['attchment_select_number']); $i++) { 
	echo "$('#attchment_".$_SESSION['attchment_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#attchment_".$_SESSION['attchment_select_number'][$i]."').val($('#attchment_".$_SESSION['attchment_select_number'][$i]."').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='attchment_select_number[]' id='".$_SESSION['attchment_select_number'][$i]."' value='".$_SESSION['attchment_select_number'][$i]."'>\");";
}
echo "</script>";
}
?>



<script>
$(document).ready(function(){

    $('#btn_pre').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='08_setup1.php' />");
    });
    
    $('#btn_next').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='10_setup3.php' />");
    });



	if($('#arch').val() == "both" && $("#SelectCheckBox").prop("checked")){
		$('button[name=upperBrackets]').prop('disabled',false);
		$('button[name=lowerBrackets]').prop('disabled',false);
	}else if ($('#arch').val() == "upper" && $("#SelectCheckBox").prop("checked") )
	{
		$('button[name=upperBrackets]').prop('disabled',false);
	}else if ($('#arch').val() == "lower" && $("#SelectCheckBox").prop("checked"))
	{
		$('button[name=lowerBrackets]').prop('disabled',false);
	}
	
	if($('#arch').val() == "both" ){
		$('input[name=ap_relation_upper]').prop('disabled',false);
		$('input[name=ap_relation_lower]').prop('disabled',false);
	}else if ($('#arch').val() == "upper" ){
		$('input[name=ap_relation_upper]').prop('disabled',false);
	}else if ($('#arch').val() == "lower" ){
		$('input[name=ap_relation_lower]').prop('disabled',false);
	}
	





	$("#AutomaticallyCheckBox").click(function() {
		$('button[name=upperBrackets]').prop('disabled',true);
		$('button[name=lowerBrackets]').prop('disabled',true);

		$('button[name=upperBrackets]').css({"background-color":"#4b4b4b"});
		$('button[name=lowerBrackets]').css({"background-color":"#4b4b4b"});
		$('button[name=upperBrackets]').val("");	
		$('button[name=lowerBrackets]').val("");	
		
	});


	$("#SelectCheckBox").click(function() {
	
	if($('#arch').val() == "both" && $("#SelectCheckBox").prop("checked")){
		$('button[name=upperBrackets]').prop('disabled',false);
		$('button[name=lowerBrackets]').prop('disabled',false);
	}else if ($('#arch').val() == "upper" && $("#SelectCheckBox").prop("checked") )
	{
		$('button[name=upperBrackets]').prop('disabled',false);
	}else if ($('#arch').val() == "lower" && $("#SelectCheckBox").prop("checked"))
	{
		$('button[name=lowerBrackets]').prop('disabled',false);
	}
	
	});
	
   $(".number").click(function() {
        if ($(this).val() == "") {
            $(this).css({"background-color":"#07a2e8", 'background-repeat' : 'no-repeat', 'background-position':'center'});
           $(this).val($(this).text());
			$('#service_info_form').append("<input type='hidden' id='"+$(this).text()+"' name='attchment_select_number[]' value='"+$(this).text()+"'>");
            //$(this).text('');
        }else{
            $(this).css({"background-color":"#4b4b4b"});
          //  $(this).text($(this).val());
            $(this).val("");	
			$('#'+$(this).text()).remove();
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
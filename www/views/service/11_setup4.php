<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service =11;


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
			<h2 style="text-align:left;margin-top:40px">8. Occlusal opening device<span style="color:red">*</span></h2>
				<div style="margin:20px 0 0 30px;text-align:left">
					<div>
						<input type="radio" id="occlusal_none"  name="occ_opening_device_option" <?if($_SESSION['occ_opening_device_option'] == "none" || $_SESSION['occ_opening_device_option'] == null){ echo "checked";}?> value="none" style="margin-right:20px">
						<label for="occlusal_none" style="margin-right:60px">None</label>
					</div>
					<div style="margin-top:20px">
						<div>
							<input type="radio" id="occlusal_bite" name="occ_opening_device_option" 
							<?if($_SESSION['occ_opening_device_option'] == "bite_ramp"){ echo "checked";}?>
							value="bite_ramp"  style="margin-right:20px">
							<label for="occlusal_bite" style="margin-right:60px">Bite ramp on the lingual side of the maxilla</label>
						</div>
						<div style="margin:10px 0 0 30px;text-align:left">
							<div>
							<input type="radio" id="Incisor" <?if($_SESSION['occ_opening_device_type'] == "incisor" ){ echo "checked";}else if($_SESSION['occ_opening_device_option']  != "bite_ramp"){echo "disabled";}?> name="occ_opening_device_type"  value="incisor" style="margin-right:20px">
							<label for="Incisor" style="margin-right:60px">Incisor</label>
									<input type="checkbox" id="Central_incisor" name="occ_opening_device_central_incisor" <?if($_SESSION['occ_opening_device_central_incisor'] == "central" && $_SESSION['occ_opening_device_type'] == "incisor"){ echo "checked";}else if($_SESSION['occ_opening_device_option']  != "bite_ramp"){echo "disabled";}?> value="central"  style="margin-right:10px">
									<label for="Central_incisor" style="margin-right:40px">Central incisor</label>
									<input type="checkbox" id="Lateral_incisor" name="occ_opening_device_lateral_incisor" <?if($_SESSION['occ_opening_device_lateral_incisor'] == "lateral" && $_SESSION['occ_opening_device_type'] == "incisor"){ echo "checked";}else if($_SESSION['occ_opening_device_option']  != "bite_ramp"){echo "disabled";}?> value="lateral"  style="margin-right:10px">
									<label for="Lateral_incisor" style="margin-right:60px">Lateral incisor</label>
							</div>
							<div style="margin-top:10px">
								<div>
									<input type="radio" id="Canine" <?if($_SESSION['occ_opening_device_type'] == "canine"){ echo "checked";}else if($_SESSION['occ_opening_device_option']  != "bite_ramp"){echo "disabled";}?> name="occ_opening_device_type" value="canine" style="margin-right:20px" onclick="">
									<label for="Canine" style="margin-right:60px">Canine</label>
								</div>
							<div style="margin:20px 0 0 30px;text-align:left">
							</div>
					</div>
						</div>
					</div>
				</div>
			<h2 style="text-align:left;margin-top:40px">9. Extraction<span style="color:red">*</span></h2>
			<div style="margin:20px 0 0 30px;text-align:left">
				<input type="radio" <?if($_SESSION['extraction'] == "none_tooth_e"){ echo "checked";}else if($_SESSION['extraction'] == null){echo "checked";}?> id="none_tooth_extraction"   name="extraction" value="none_tooth_e" style="margin-right:20px"><label for="none_tooth_extraction" style="margin-right:60px">Non Extraction</label>
				<input type="radio" <?if($_SESSION['extraction'] == "tooth_e"){ echo "checked";}?> id="tooth_extraction"  name="extraction" value="tooth_e" style="margin-right:20px"><label for="tooth_extraction">Extraction</label>
			</div>
            <div style="margin:20px 0 0 30px;text-align:left;overflow:hidden">
					<p  class="RL" style="margin-right:5px">R</p>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
							<button type="button" class="number" id="extraction_18" name="upperBrackets" >18</button>
							<button type="button" class="number" id="extraction_17" name="upperBrackets" >17</button>
							<button type="button" class="number" id="extraction_16" name="upperBrackets" >16</button>
							<button type="button" class="number" id="extraction_15" name="upperBrackets" >15</button>
							<button type="button" class="number" id="extraction_14" name="upperBrackets" >14</button>
							<button type="button" class="number" id="extraction_13" name="upperBrackets" >13</button>
							<button type="button" class="number" id="extraction_12" name="upperBrackets" >12</button>
							<button type="button" class="number" id="extraction_11" name="upperBrackets"  style="margin:0">11</button>
						</div>
						<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                            <button type="button" class="number" id="extraction_48"  name="lowerBrackets">48</button>
							<button type="button" class="number" id="extraction_47" name="lowerBrackets" >47</button>
							<button type="button" class="number" id="extraction_46" name="lowerBrackets" >46</button>
							<button type="button" class="number" id="extraction_45" name="lowerBrackets" >45</button>
							<button type="button" class="number" id="extraction_44" name="lowerBrackets" >44</button>
							<button type="button" class="number" id="extraction_43" name="lowerBrackets" >43</button>
							<button type="button" class="number" id="extraction_42" name="lowerBrackets" >42</button>
							<button type="button" class="number" id="extraction_41" name="lowerBrackets"  style="margin:0">41</button>

						</div>
					</div>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">

                            <button type="button" class="number" id="extraction_21" name="upperBrackets" >21</button>
							<button type="button" class="number" id="extraction_22" name="upperBrackets" >22</button>
							<button type="button" class="number" id="extraction_23" name="upperBrackets" >23</button>
							<button type="button" class="number" id="extraction_24" name="upperBrackets" >24</button>
							<button type="button" class="number" id="extraction_25" name="upperBrackets" >25</button>
							<button type="button" class="number" id="extraction_26" name="upperBrackets" >26</button>
							<button type="button" class="number" id="extraction_27" name="upperBrackets" >27</button>
							<button type="button" class="number" id="extraction_28" name="upperBrackets"  style="margin:0">28</button>
						</div>
						<div style="padding-top:5px;overflow:hidden;padding-left:5px">
							<button type="button" class="number" id="extraction_31" name="lowerBrackets" >31</button>
							<button type="button" class="number" id="extraction_32" name="lowerBrackets" >32</button>
							<button type="button" class="number" id="extraction_33" name="lowerBrackets" >33</button>
							<button type="button" class="number" id="extraction_34" name="lowerBrackets" >34</button>
							<button type="button" class="number" id="extraction_35" name="lowerBrackets" >35</button>
							<button type="button" class="number" id="extraction_36" name="lowerBrackets" >36</button>
							<button type="button" class="number" id="extraction_37" name="lowerBrackets" >37</button>
							<button type="button" class="number" id="extraction_38" name="lowerBrackets"  style="margin:0">38</button>
						</div>
					</div>
					<p class="RL" style="margin-left:5px">L</p>
				</div>
			</div>

	</div>
	
	<div class="button_menu" style="padding:10px;">
		<a href="javascript:servicePopupClose();" class="service_close">Close</a>
        <input type="submit" id="btn_pre" value="Back" class="service_close" style="margin:0">
		<input type="submit" id="btn_next"  value="Next" class="service_next"> 
	</div>
    </form>
</div>
<?
if ($_SESSION['extraction'] == "tooth_e") {
echo "<script>";
if(count($_SESSION['e_select_number']) > 0){
for ($i=0; $i < count($_SESSION['e_select_number']); $i++) { 
	echo "$('#extraction_".$_SESSION['e_select_number'][$i]."').css({'background':'url(../../resource/images/extraction_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
      $('#extraction_".$_SESSION['e_select_number'][$i]."').val($('#extraction_".$_SESSION['e_select_number'][$i]."').text());
	  $('#service_info_form').append(\"<input type='hidden'  name='e_select_number[]' id='".$_SESSION['e_select_number'][$i]."' value='".$_SESSION['e_select_number'][$i]."'>\");
         $('#extraction_".$_SESSION['e_select_number'][$i]."').text('');";
}
}
echo "</script>";
}
	
?>

<script>
$(document).ready(function(){

    $('#btn_pre').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='10_setup3.php' />");
    });
    
    $('#btn_next').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='12_setup5.php' />");
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

    $(".number").click(function() {
        if ($(this).val() == "") {
            $(this).css({"background":"url(../../resource/images/extraction_icon.png)", 'background-repeat' : 'no-repeat', 'background-position':'center'});
            $(this).val($(this).text());
			$('#service_info_form').append("<input type='hidden' id='"+$(this).text()+"' name='e_select_number[]' value='"+$(this).text()+"'>");
            $(this).text('');
        }else{
            $(this).css({"background":""});
            $(this).text($(this).val());
            $(this).val("");	
			$('#'+$(this).text()).remove();
        }
			
		});

		

});

</script>

<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>
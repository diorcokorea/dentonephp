<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service=4;
?>

<div class="content" style="background-color:#fff;">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>

	<form id='service_info_form' name="service_info_form" action='service_info.php' method='post' >
	<div class="classification_inner">
		<div class="service_title">
			<h2>Classification</h2>
		</div>
		<div class="classification">
			<div style="display:inline-block;margin-right:60px">
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Crowding" <?if($_SESSION['crowding'] == "on") echo checked; ?> name="crowding"/>
					<label for="Crowding">Crowding</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Diastemata" <?if($_SESSION['diastemata'] == "on") echo checked; ?> name="diastemata"/>
					<label for="Diastemata">Diastemata</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Class_I" <?if($_SESSION['class1'] == "on") echo checked; ?> name="class1"/>
					<label for="Class_I">Class I</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Class_II_div1" <?if($_SESSION['class2_div1'] == "on") echo checked; ?> name="class2_div1"/>
					<label for="Class_II_div1">Class II div1</label>
				</div>
				<div>
					<input type="checkbox" id="Class_II_div2" <?if($_SESSION['class2_div2'] == "on") echo checked; ?> name="class2_div2"/>
					<label for="Class_II_div2">Class II div2</label>
				</div>
			</div>
			<div style="display:inline-block;margin-right:50px">
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Class_III" <?if($_SESSION['class3'] == "on") echo checked; ?> name="class3"/>
					<label for="Class_III">Class III</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Asymmetric" <?if($_SESSION['asymmetric'] == "on") echo checked; ?> name="asymmetric"/>
					<label for="Asymmetric">Asymmetric</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Vertical_open_bite" <?if($_SESSION['vertical_open_bite'] == "on") echo checked; ?> name="vertical_open_bite"/>
					<label for="Vertical_open_bite">Vertical open bite</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Horizontal_open_bite" <?if($_SESSION['horizontal_open_bite'] == "on") echo checked; ?> name="horizontal_open_bite"/>
					<label for="Horizontal_open_bite">Horizontal open bite (Overjet)</label>
				</div>
				<div>
					<input type="checkbox" id="Overbite" <?if($_SESSION['deep_bite'] == "on") echo checked; ?> name="deep_bite"/>
					<label for="Overbite">Overbite</label>
				</div>
			</div>
			<div style="display:inline-block;margin-right:40px">
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Anterior_occlusion" <?if($_SESSION['anterior_occlusion'] == "on") echo checked; ?> name="anterior_occlusion"/>
					<label for="Anterior_occlusion">Anterior occlusion</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Posterior_occlusion" <?if($_SESSION['posterior_occlusion'] == "on") echo checked; ?> name="posterior_occlusion"/>
					<label for="Posterior_occlusion">Posterior occlusion</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Narrow_arch" <?if($_SESSION['narrow_arch'] == "on") echo checked; ?> name="narrow_arch"/>
					<label for="Narrow_arch">Narrow arch</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Prolapse_of_anterior_teeth" <?if($_SESSION['anterior_teeth'] == "on") echo checked; ?> name="anterior_teeth"/>
					<label for="Prolapse_of_anterior_teeth">Prolapse of anterior teeth</label>
				</div>
				<div>
					<input type="checkbox" id="Improve_smile_line" <?if($_SESSION['smile_line'] == "on") echo checked; ?> name="smile_line"/>
					<label for="Improve_smile_line">Improve smile line</label>
				</div>
			</div>
			<div style="float:right;vertical-align:top;">
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Inclined_occlusal_plane" <?if($_SESSION['inclined_occlusal_plane'] == "on") echo checked; ?> name="inclined_occlusal_plane"/>
					<label for="Inclined_occlusal_plane">Inclined occlusal plane</label>
				</div>
				<div style="margin-bottom:30px">
					<input type="checkbox" id="Abnormal_tooth_shape" <?if($_SESSION['abnormal_teeth_shape'] == "on") echo checked; ?> name="abnormal_teeth_shape"/>
					<label for="Abnormal_tooth_shape">Abnormal tooth shape</label>
				</div>
				<div>
					<div>
						<input type="checkbox" id="Etc" <?if($_SESSION['etc'] == "on") echo checked; ?> name="etc"/>
						<label for="Etc">Etc</label>
					</div>
					<textarea <?if($_SESSION['etc'] != "on")  echo disabled; ?> name="etc_value" id="etc_value" placeholder="Enter extra comments." style="margin-top:10px;height:100px"><?=$_SESSION['etc_value'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="Precautions_box">
		<h2>Note</h2>
		<textarea class="precaution_textarea" name="precaution" ><?=$_SESSION['precaution'] ?></textarea>
		</div>
		<span class="ap_regular_text" style="margin:0"><span class="ap_icon"><img src="/resource/images/ap_text_icon.png"/></span><span class="ap_text" style="margin-left:10px">The prescribed plan and note shall be used for reference and statistical purpose ONLY, and are NOT considered as a treatment
plan instruction.</span></span>

	</div>
	
	<div class="button_menu" style="padding:10px;">
		<a href="javascript:servicePopupClose();" class="service_close">Close</a>
		<input type="submit" id="btn_pre" value="Back" class="service_close" style="margin:0">
		<input type="submit" id="btn_next"  value="Next" class="service_next"> 
	</div>
</div>
</form>

<script>

$(document).ready(function(){

	

		 $('#Etc').on('click', function(event){
			
				if ($('#etc_value').prop("disabled"))
				{
						$('#etc_value').prop("disabled",false);
				}else{
						$('#etc_value').val("");
						$('#etc_value').prop("disabled",true);
				}
	});

    $('#btn_pre').on('click', function(event){
	$("#service_info_form").append("<input type='hidden' name='targetUrl' value='03_patientinfo.php' />");
	});

    $('#btn_next').on('click', function(event){
	$("#service_info_form").append("<input type='hidden' name='targetUrl' value='05_modeltype.php' />");
	});

});
</script>

<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>
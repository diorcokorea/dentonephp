<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"]."/models/db/querys.php");
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service = 3;

?>

<div class="content" style="background-color:#fff;">
	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>
	<form id="service_info_form" name="service_info_form" action='service_info.php' method='post' >
	<input type="hidden" id="progress_num" name="progress_num" value="<? echo $progress_num; ?>" />
	<div class="patient_inner" style="overflow:hidden">
		<div class="service_title">
			<h2>Patient information</h2>
		</div>
		<div style="float:left;width:50%;padding-right:60px">
			<div class="patient_text" style="margin-bottom:30px">
				<p class="input_title">Patient ID</p>
				<input class="patient_input" maxlength="12" required oninvalid="this.setCustomValidity('Please enter a patient ID.')" oninput="setCustomValidity('')" type="text" name="patient_id" id="patient_id" title="Please enter a patient ID." value="<?echo $_SESSION['patient_id'];?>" placeholder="Patient ID">
			</div>
			<div class="patient_text" style="margin-bottom:30px">
				<p class="input_title">First Name</p>
				<input class="patient_input" maxlength="20" required oninvalid="this.setCustomValidity('Please enter a first name.')" oninput="setCustomValidity('')"  type="text" name="first_name" id="first_name" value="<?echo $_SESSION['first_name'];?>"  placeholder="First name">
			</div>

			<div class="patient_text" style="margin-bottom:30px">
				<p class="input_title">Last Name</p>
				<input class="patient_input" maxlength="20" required oninvalid="this.setCustomValidity('Please enter a last name.')" oninput="setCustomValidity('')"  type="text" name="last_name" id="last_name" value="<?echo $_SESSION['last_name'];?>"  placeholder="Last name">
			</div>

			<div class="patient_text" style="margin-bottom:30px">
				<p class="input_title">Gender</p>
				<div style="padding-top:11px;width:70%;float:right">
					<div style="float:left;margin-right:70px">
						<input class="" type="radio" id="patient_male"  <?php if ($_SESSION['patient_sex']=="male" || $_SESSION['patient_sex'] == null) echo "checked='checked'"; ?> value="male" name="patient_sex">
						<label for="patient_male" style="padding-left:10px">Male</label>
					</div>
					<div>
						<input class="" type="radio" id="patient_female" <?php if ($_SESSION['patient_sex']=="female") echo "checked='checked'"; ?> value="female" name="patient_sex">
						<label for="patient_female"style="padding-left:10px">Female</label>
					</div>
				</div>
			</div>
			<div class="patient_text" style="margin-bottom:30px">
				<p class="input_title">Ethinicity</p>
				<div style="padding-top:11px;width:70%;float:right">
					<div style="float:left;margin-right:30px">
						<input class="" type="radio" id="patient_male"  <?php if ($_SESSION['patient_ethinicity']=="Caucasian" || $_SESSION['patient_ethinicity'] == null) echo "checked='checked'"; ?> value="caucasian" name="patient_ethinicity">
						<label for="patient_male" style="padding-left:10px">Caucasian</label>
					</div>
					<div style="float:left;margin-right:30px">
						<input class="" type="radio" id="patient_female" <?php if ($_SESSION['patient_ethinicity']=="Asian") echo "checked='checked'"; ?> value="asian" name="patient_ethinicity">
						<label for="patient_female"style="padding-left:10px">Asian</label>
					</div>
					<div style="float:left;">
						<input class="" type="radio" id="patient_female" <?php if ($_SESSION['patient_ethinicity']=="African") echo "checked='checked'"; ?> value="african" name="patient_ethinicity">
						<label for="patient_female"style="padding-left:10px">African</label>
					</div>
				</div>
			</div>
			
		</div>
		<div style="float:right;border-left: 1px solid #d2d2d2;padding-left:60px;width:50%">
			<div class="patient_text" style="overflow:hidden;margin-bottom:30px;">
				<p class="input_title">Date of birth</p>
				<div style="width:70%;float:right">
					<select class="" required oninvalid="this.setCustomValidity('Your year of birth as a 4-digit year.')"  type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); setCustomValidity('');"  id="patient_date_yy" onchange="monthChanged();" name="patient_date_yy" style="width:32%;">
						<option value="" <?php if ($_SESSION['patient_date_yy']==null) echo "selected"; ?>   disabled hidden data-is-placeholder="true">Year</option>
							<?
							for ($yy = 1900; $yy <= Date('Y'); $yy++) {
								if ($_SESSION['patient_date_yy']==$yy) {
									echo "<option  selected value='".$yy."'>".$yy."</option>";
									}else{
									echo "<option  value='".$yy."'>".$yy."</option>";
									}
								}
							?>
					</select>
					<select  required oninvalid="this.setCustomValidity('Please choose the month.')"  oninput="setCustomValidity('')"  class="" type="text" style="width:32%;" id="patient_date_mm" name="patient_date_mm" disabled onchange="monthChanged();">
					<option value="" <?php if ($_SESSION['patient_date_mm']==null) echo "selected"; ?>   disabled hidden>Month</option>
					<?
					for ($mm = 1; $mm <= 12; $mm++) {
					if($mm < 10){
			
					if ($_SESSION['patient_date_mm']==$mm) {
					echo "<option  selected value='".$mm."'>0".$mm."</option>";
					}else{
					echo "<option  value='".$mm."'>0".$mm."</option>";
					}
								}else{
								
								if ($_SESSION['patient_date_mm']==$mm) {
					echo "<option  selected value='".$mm."'>".$mm."</option>";
					}else{
					echo "<option  value='".$mm."'>".$mm."</option>";
					}
								
								
								}



				}
				?>


				</select>

				<select class="" required oninvalid="this.setCustomValidity('Please choose the day.')" oninput="setCustomValidity('')"  placeholder="Day"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  id="patient_date_dd"  name="patient_date_dd" disabled style="width:32%;float:right">
				<option value="" <?php if ($_SESSION['patient_date_dd']==null) echo "selected"; ?>   disabled hidden>Day</option>

				<?
				if ($_SESSION['patient_date_dd']!=null){
				echo "<option  selected value='".$_SESSION['patient_date_dd']."' hidden>".$_SESSION['patient_date_dd']."</option>";
				}
			/*	if ($_SESSION['patient_date_dd'] != null) {
				//	echo "<option  selected value='".$_SESSION['patient_date_dd']."'>".$_SESSION['patient_date_dd']."</option>";
				//	}
				for ($dd = 1; $dd <=31; $dd++) {
					if ($_SESSION['patient_date_dd']==$dd) {
					echo "<option  selected value='".$dd."'>".$dd."</option>";
					}else{
					echo "<option  value='".$dd."'>".$dd."</option>";
					}
				}

*/
				?>


				</select>
			</div>
			</div>
			<div class="patient_text" style="overflow:hidden;margin-bottom:30px;">
				<p class="input_title">Age</p>
				<input class="patient_input" type="text" id="patient_age" readonly value="<?= $_SESSION['patient_age'];?>" name="patient_age" style="background-color:#e5e5e5;">
			</div>
			<div class="patient_text" style="overflow:hidden;margin-bottom:30px;">
				<p class="input_title">Lab</p>


				<?	if(count($lab_list) > 1){?>

						<select class="" required oninvalid="this.setCustomValidity('Please select a lab.')" oninput="setCustomValidity('')" style="width:70%;float:right" id="dental_lab" name="dental_lab">

					<?	if (isset($_SESSION['dental_lab'])) {
					$dent_lab = explode( ',', $_SESSION['dental_lab'], 2);
					echo "<option value='".$_SESSION['dental_lab']."' selected hidden>".$dent_lab[1]."</option>";
				}else{ echo "<option value='' selected disabled hidden  data-is-placeholder='true'>Please select a lab.</option>";}
				
				foreach ($lab_list as  $value_list) {
						echo "<option value='".$value_list['account_lab_id'].", ".$value_list['name']."'>".$value_list['name']."</option>";
				}
				?>
				</select>
			<?	}else{ ?>
				
				<input value="<?=$lab_list[0]['name']?>" readonly disabled class="" required oninvalid="this.setCustomValidity('Please select a lab.')" oninput="setCustomValidity('')" type="text"  style="width:70%;float:right" id="dental_lab" name="dental_lab_text">

				<input value="<?=$lab_list[0]['account_lab_id']?>, <?=$lab_list[0]['name']?>" readonly class="" required oninvalid="this.setCustomValidity('Please select a lab.')" oninput="setCustomValidity('')" type="hidden"  style="width:70%;float:right" id="dental_lab" name="dental_lab">
				
			<?	} ?>

			</div>
			<div style="width:100%; overflow:hidden;margin-bottom:30px">
				<p class="input_title">Delivery address</p>
				<div style="width:70%;float:right">
					<select name="country" required oninput="setCustomValidity('')"   style="width:100%" placeholder="Please choose a country.">
						<option value="<?=$user_info['address4']?>"  style="display:none;"  selected><?=$user_info['address4']?></option>
					</select>
				</div>
			</div>
			<div style="width:100%; overflow:hidden;">
				<p class="input_title">Billing address</p>
				<div style="width:70%;float:right;margin-bottom:30px">
					<select name="country" required oninput="setCustomValidity('')"   style="width:100%" placeholder="Please choose a country.">
						<option value="<?=$user_info['address4']?>"  style="display:none;"  selected><?=$user_info['address4']?></option>
					</select>
				</div>
				<input type="button" id="adresslist" value="Delivery Address List" style="background-color:#07a2e8;color:#fff;border:none;width:70%;float:right;padding:13px 0;border-radius:5px">
			</div>
		</div>
		<div class="patient_warning">
				<p class="patient_warning_icon"></p>
				<p class="patient_warning_text">Please enter all patient information.</p>
		</div>
	</div>
	<div class="button_menu" style="padding:10px;">
		<a href="javascript:servicePopupClose();"  class="service_close">Close</a>
		<input type="submit" id="btn_pre"  value="Back" class="service_close">
		<input type="submit" id="btn_next"  value="Next" class="service_next"> 
        <!-- onclick="serviceSubmit('03_modeltype.php');" -->
	</div>
	</form>
</div>

<script>

function monthChanged(){
	$('#patient_date_mm').prop("disabled",false);
	if( $('#patient_date_yy').val() != null && $('#patient_date_mm').val() != null){
$('#patient_date_dd').prop("disabled",false);
$('#patient_date_dd').empty();
var day = new Date($('#patient_date_yy').val(),$('#patient_date_mm').val(),0).getDate();

	for (let d= 1; d <=Number(day); d++)
	{

		if(d < 10){
		var option = "<option value='"+d+"'>0"+d+"</option>";
		 $('#patient_date_dd').append(option);
		}else{
		var option = "<option value='"+d+"'>"+d+"</option>";
		 $('#patient_date_dd').append(option);
		 }


	}

}
}

$(document).ready(function(){

if( $('#patient_date_yy').val() != null && $('#patient_date_mm').val() != null){
	$('#patient_date_mm').prop("disabled",false);
$('#patient_date_dd').prop("disabled",false);
//$('#patient_date_dd').empty();
var day = new Date($('#patient_date_yy').val(),$('#patient_date_mm').val(),0).getDate();

	for (let d= 1; d <=Number(day); d++)
	{
		if(d < 10){
		var option = "<option value='"+d+"'>0"+d+"</option>";
		 $('#patient_date_dd').append(option);
		}else{
		var option = "<option value='"+d+"'>"+d+"</option>";
		 $('#patient_date_dd').append(option);
		 }
	}

}





    $('#btn_pre').on('click', function(event){
$("#service_info_form").append("<input type='hidden' name='targetUrl' value='02_treatment_option2.php' />");
});
    
    $('#btn_next').on('click', function(event){
$("#service_info_form").append("<input type='hidden' name='targetUrl' value='04_classification.php' />");
});

    

 $('#patient_date_dd').change(function(){
		ageChange();
  });

$("#patient_date_mm").change( function() {
        ageChange();
});

$('#patient_date_yy').change(function(){
		ageChange();
  });

});

</script>


<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>


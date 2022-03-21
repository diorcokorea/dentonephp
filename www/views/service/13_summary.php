<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service = 13;
//ini_set("display_errors","1");
?>

<div class="content" style="background-color:#fff;height:100%">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>
    <form id="service_info_form" name="service_info_form" action="service_info.php" method="POST">
	<div class="result_inner">
	<!-- Treatment option1 Start -->
		<div id="result_modeltype" class="result_box">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Adult/Child</p>
				<a href="/views/service/01_treatment_option1.php">Edit</a>
			</div>
			<div class="result_content" style="padding:40px 80px">
				<div>
					<div class="patient">
						<p>Option: </p>
						<p><?=$_SESSION['treatment_option1']?> </p>
					</div>
				</div>
			</div>
		</div>
	<!-- Treatment option1 End -->

	<!-- Treatment option2 Start -->
		<div id="result_modeltype" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Aligner step</p>
				<a href="/views/service/02_treatment_option2.php">Edit</a>
			</div>
			<div class="result_content" style="padding:40px 80px">
				<div>
					<div class="patient">
						<p>Option: </p>
						<p><?=$_SESSION['treatment_option2'] ?> </p>
					</div>
				</div>
			</div>
		</div>
	<!-- Treatment option2 End -->

	<!-- Patient Info Start -->
		<div id="result_patient" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Patient information</p>
				<a href="/views/service/03_patientinfo.php">Edit</a>
			</div>
			<div class="result_content" style="padding:60px 0;">
				<div style="width:70%;margin:0 auto">
					<div class="patient_left" style="float:left;">
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Patient ID</p>
							<span>:</span>
							<p style="white-space: pre-wrap; width: 150px; vertical-align: middle;"><?echo $_SESSION['patient_id']?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">First name</p>
							<span>:</span>
							<p class="result_patient_content" style="white-space: pre-wrap; width: 150px; vertical-align: middle;"><?echo $_SESSION['first_name']?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Last name</p>
							<span>:</span>
							<p class="result_patient_content" style="white-space: pre-wrap; width: 150px; vertical-align: middle;"><?echo $_SESSION['last_name']?></p>
						</div>
						<div class="patient">
							<p class="result_patient_title">Gender</p>
							<span>:</span>
							<p class="result_patient_content"><?if ($_SESSION['patient_sex']=="male"){echo "Male"; }else{echo "Female";}?></p>
						</div>
					</div>
					<div class="patient_right" style="float: right;">
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Birthday</p>
							<span>:</span>
							<p class="result_patient_content"><?echo $_SESSION['patient_date_yy']."-".$_SESSION['patient_date_mm']."-".$_SESSION['patient_date_dd']?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Age</p>
							<span>:</span>
							<p class="result_patient_content"><?echo $_SESSION['patient_age']?></p>
						</div>
						<div class="patient">
							<p class="result_patient_title">Lab</p>
							<span>:</span>
							<p class="result_patient_content"><? $lab_explode = explode( ',', $_SESSION['dental_lab'], 2 ); echo $lab_explode[1]; ?></p>
                            <p><?=$_SESSION['shipping_address']['address_name'].$_SESSION['shipping_address']['address1']?></p>
                            <p><?=$_SESSION['billing_address']['address_name'].$_SESSION['billing_address']['address1']?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Patient Info End -->

	<!-- Classification Start -->
		<div id="result_modeltype" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Classification</p>
				<a href="/views/service/04_classification.php">Edit</a>
			</div>
			<div class="result_content" style="padding:40px 100px">
					<div class="classification_result">
						<p class="classification_result_title">Status:</p>
						<p class="classification_result_content">
						<? 
						foreach($_SESSION['classification'] as $key => $value){
						if($value =="on"){ 
							$print_value = "";
							switch ($key) {
								case 'crowding':
									$print_value = "Crowding";
									break;
								case 'diastemata':
									$print_value = "Diastemata";
									break;
								case 'class1':
									$print_value = "Class I";
									break;
								case 'class2_div1':
									$print_value = "Class II div1";
									break;
								case 'class2_div2':
									$print_value = "Class II div2";
									break;

								case 'class3':
									$print_value = "Class III";
									break;
								case 'asymmetric':
									$print_value = "Asymmetric";
									break;
								case 'vertical_open_bite':
									$print_value = "Vertical open bite";
									break;
								case 'horizontal_open_bite':
									$print_value = "Horizontal open bite (Overjet)";
									break;
								case 'deep_bite':
									$print_value = "Overbite";
									break;

								case 'anterior_occlusion':
									$print_value = "Anterior occlusion";
									break;
								case 'posterior_occlusion':
									$print_value = "Posterior occlusion";
									break;
								case 'narrow_arch':
									$print_value = "Narrow arch";
									break;
								case 'anterior_teeth':
									$print_value = "Prolapse of anterior teeth";
									break;
								case 'smile_line':
									$print_value = "Improve smile line";
									break;
								
								case 'inclined_occlusal_plane':
									$print_value = "Inclined occlusal plane";
									break;
								case 'abnormal_teeth_shape':
									$print_value = "Abnormal tooth shape";
									break;
								case 'etc':
									$print_value = "Etc";
									break;
							}
							echo $print_value.", ";
							}
						}?>
						</p>
					</div>
					<div class="classification_result" style="margin-top:30px">
						<p class="classification_result_etc">Etc</p>
						<textarea  disabled class="classification_result_etc_box"><?if($_SESSION['classification']['etc_value'] == ""){echo "There is no content."; }else{echo $_SESSION['classification']['etc_value']; }?></textarea>
					</div>
					<div class="classification_result" style="margin-top:30px">
						<p class="classification_result_precautions">Note</p>
						<textarea disabled class="classification_result_precautions_box">
						<?if($_SESSION['classification']['precaution'] == ""){echo "There is no content."; }else{echo $_SESSION['classification']['precaution']; }?></textarea>
					</div>
			</div>
		</div>
	<!-- Classification End -->

	<!-- Model Type Start -->
		<div id="result_modeltype" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Model Type</p>
				<a href="/views/service/05_modeltype.php">Edit</a>
			</div>
			<div class="result_content" style="padding:40px 200px">
				<div>
					<div class="patient">
						<p class="result_patient_title">Model Type</p>
						<span style="margin-right:80px">:</span>
						<p><?=$_SESSION['model_type']?></p>
					</div>
				</div>
			</div>
		</div>
	<!-- Model Type End -->

	<!-- Picture Start -->
		<div id="result_picture" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Photo</p>
				<a href="/views/service/06_photo.php">Edit</a>
			</div>
			<div class="result_content" style="padding:30px 0;width:100%;">
				<div style="width:60%;margin:0 auto">
					<div style="text-align:center;width:100%;overflow:hidden;margin-bottom:20px">
						<div style="display:inline-block;" class="filebox">
							<input type="file" disabled id="Lateral" href="#" disabled style="">
							<label for="Lateral" class="lateral">
							 <? if(isset($_SESSION['lateral_photo'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['lateral_photo']?>"> 
								<?}?>
								<p class="file_text">Lateral Photo</p>
							</label>
						</div>
						<div class="filebox" style="display:inline-block;margin:0 10px">
							<input type="file" disabled id="Frontal" href="#" style="">
							<label for="Frontal" class="frontal">
							 <? if(isset($_SESSION['front_photo'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['front_photo']?>"> 
								<?}?>
								<p class="file_text">Frontal Photo</p>
							</label>
						</div>
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Smaile" href="#" style="">
							<label for="Smaile" class="smile">
							 <? if(isset($_SESSION['smile_photo'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['smile_photo']?>"> 
								<?}?>
								<p class="file_text">Smile Photo</p>
							</label>
						</div>
					</div>
					<div style="text-align:center;width:100%;overflow:hidden;margin-bottom:20px">
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Lateral" href="#" style="">
							<label for="Lateral" class="intraoral_upper">
							 <? if(isset($_SESSION['intraoral_upper'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['intraoral_upper']?>"> 
								<?}?>
								<p class="file_text">Intraoral Upper</p>
							</label>
						</div>
						<div class="filebox" style="display:inline-block;vertical-align:bottom;margin:0 10px">
							<div class="picture" style="padding:0">
							<p class="picture_text" style="text-align:center;padding:70px 0 0 0">This is a registered photo.</p>
							</div>
						</div>
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Smaile" href="#" style="">
							<label for="Smaile" class="intraoral_lower">
							 <? if(isset($_SESSION['intraoral_lower'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['intraoral_lower']?>"> 
								<?}?>
								<p class="file_text">Intraoral Lower</p>
							</label>
						</div>
					</div>
					<div style="text-align:center;width:100%;overflow:hidden">
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Lateral" href="#" style="">
							<label for="Lateral" class="intraoral_right">
							 <? if(isset($_SESSION['intraoral_right'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['intraoral_right']?>"> 
								<?}?>
								<p class="file_text">Intraoral Right</p>
							</label>
						</div>
						<div class="filebox" style="display:inline-block;margin:0 10px">
							<input type="file" disabled id="Frontal" href="#">
							<label for="Frontal" class="intraoral_front">
						 	 <? if(isset($_SESSION['intraoral_fornt'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['intraoral_fornt']?>"> 
								<?}?>
								<p class="file_text">Intraoral Front</p>
							</label>
						</div>
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Smaile" href="#" style="">
							<label for="Smaile" class="intraoral_left">
							 <? if(isset($_SESSION['intraoral_left'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['intraoral_left']?>"> 
								<?}?>
								<p class="file_text">Intraoral Left</p>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Picture End -->

	<!-- Radiograph Start -->
		<div id="result_radiograph" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">X-ray image</p>
				<a href="/views/service/07_radiograph.php">Edit</a>
			</div>
			<div class="result_content" style="padding:30px 0;width:100%;">
				<div class="radiograph_inner" style="padding:0;width:60%;margin:0 auto">
					<div class="scanfile" style="padding:0">
						<div style="float:left;position:relative">
							<input type="file" disabled id="lateral_xray" href="#" style="">
							<label for="lateral_xray" class="lateral_xray">
						 	 <? if(isset($_SESSION['lateral_xray'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['lateral_xray']?>"> 
								<?}?>
								<p class="file_text">Lateral</p>
							</label>
						</div>
						<div style="float:right;position:relative">
						<input type="file" disabled id="panorama" href="#" style="">
					<!-- 	<input type="file" disabled id="image" accept="image/*" onchange="setThumbnail(event);"/> -->
							<label for="panorama" class="panorama">
							 <? if(isset($_SESSION['panorama'])){?>
									<img class="thumb_img" src="<?= "/".$_SESSION['panorama']?>"> 
								<?}?>
								<p class="file_text">Panorama</p>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Radiograph End -->

	<!-- Prescription1 Start -->
		<div id="result_bracket" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription1</p>
				<a href="/views/service/08_setup1.php">Edit</a>
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="indirect_System">
					<div>
						<h2 style="text-align:left;width:240px;float:left;display:inline-block">1. Select a arch<span style="float:right;margin-right:30px">:</span></h2>
						<p style="display:inline-block"><? 
						switch ($_SESSION['arch']) {
								case 'both':
									echo "Both arches";
									break;
								case 'upper':
									echo "Upper";
									break;
								case 'lower':
									echo "Lower";
									break;
									}
						?></p>
					</div>
					<div class="tray_sections" style="margin-top:40px;display:none">
						<h2 style="text-align:left;width:240px;float:left;display:inline-block">2. Tray sections<span style="float:right;margin-right:30px">:</span></h2>
						<div style="overflow:hidden">
                                <?
								switch ($_SESSION['arch']) {
								case 'both':
										echo "<div style='overflow:hidden'><p style='float:left;'>";
										echo "Upper / ".$_SESSION['tray_section_u'];
										echo "</p></div>";

										echo "<div style='margin-top:20px'> <p style='float:left;'>";
										echo "Lower / ".$_SESSION['tray_section_l'];
										echo "</p></div>";
									break;
								case 'upper':
										echo "<div style='overflow:hidden'><p style='float:left;'>";
										echo "Upper / ".$_SESSION['tray_section_u'];
										echo "</p></div>";
									break;
								case 'lower':
										echo "<div style='margin-top:20px'> <p style='float:left;'>";
										echo "Lower / ".$_SESSION['tray_section_l'];
										echo "</p></div>";
									break;
									}
                                ?>
						</div>
					</div>
				</div>
				<div class="used_brackets" style="margin-top:40px;overflow:hidden;">
					<h2>2. Please select full diagnostics</h2>
					<div style="overflow:hidden;display:inline-block;margin:0 0 0 20px">
						<p style="text-align:left;margin:20px 0">(Implant, Telescopic crown, Veneered crown)</p>
						<p class="RL" style="margin-right:5px">R</p>
						<div style="overflow:hidden;display:inline-block;float:left">
						<? include("setup2_layer.php");  ?>
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
								<button type="button" disabled class="number" id="diagnostics_18" name="upperBrackets" >18</button>
								<button type="button" disabled class="number" id="diagnostics_17" name="upperBrackets" >17</button>
								<button type="button" disabled class="number" id="diagnostics_16" name="upperBrackets" >16</button>
								<button type="button" disabled class="number" id="diagnostics_15" name="upperBrackets" >15</button>
								<button type="button" disabled class="number" id="diagnostics_14" name="upperBrackets" >14</button>
								<button type="button" disabled class="number" id="diagnostics_13" name="upperBrackets" >13</button>
								<button type="button" disabled class="number" id="diagnostics_12" name="upperBrackets" >12</button>
								<button type="button" disabled class="number" id="diagnostics_11" name="upperBrackets"  style="margin:0">11</button>
							</div>
							<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
								<button type="button" disabled class="number" id="diagnostics_48"  name="lowerBrackets">48</button>
								<button type="button" disabled class="number" id="diagnostics_47" name="lowerBrackets" >47</button>
								<button type="button" disabled class="number" id="diagnostics_46" name="lowerBrackets" >46</button>
								<button type="button" disabled class="number" id="diagnostics_45" name="lowerBrackets" >45</button>
								<button type="button" disabled class="number" id="diagnostics_44" name="lowerBrackets" >44</button>
								<button type="button" disabled class="number" id="diagnostics_43" name="lowerBrackets" >43</button>
								<button type="button" disabled class="number" id="diagnostics_42" name="lowerBrackets" >42</button>
								<button type="button" disabled class="number" id="diagnostics_41" name="lowerBrackets"  style="margin:0">41</button>
							</div>
						</div>
						<div style="overflow:hidden;display:inline-block;float:left">
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
								<button type="button" disabled class="number" id="diagnostics_21" name="upperBrackets" >21</button>
								<button type="button" disabled class="number" id="diagnostics_22" name="upperBrackets" >22</button>
								<button type="button" disabled class="number" id="diagnostics_23" name="upperBrackets" >23</button>
								<button type="button" disabled class="number" id="diagnostics_24" name="upperBrackets" >24</button>
								<button type="button" disabled class="number" id="diagnostics_25" name="upperBrackets" >25</button>
								<button type="button" disabled class="number" id="diagnostics_26" name="upperBrackets" >26</button>
								<button type="button" disabled class="number" id="diagnostics_27" name="upperBrackets" >27</button>
								<button type="button" disabled class="number" id="diagnostics_28" name="upperBrackets"  style="margin:0">28</button>
							</div>
							<div style="padding-top:5px;overflow:hidden;padding-left:5px">
								<button type="button" disabled class="number" id="diagnostics_31" name="lowerBrackets" >31</button>
								<button type="button" disabled class="number" id="diagnostics_32" name="lowerBrackets" >32</button>
								<button type="button" disabled class="number" id="diagnostics_33" name="lowerBrackets" >33</button>
								<button type="button" disabled class="number" id="diagnostics_34" name="lowerBrackets" >34</button>
								<button type="button" disabled class="number" id="diagnostics_35" name="lowerBrackets" >35</button>
								<button type="button" disabled class="number" id="diagnostics_36" name="lowerBrackets" >36</button>
								<button type="button" disabled class="number" id="diagnostics_37" name="lowerBrackets" >37</button>
								<button type="button" disabled class="number" id="diagnostics_38" name="lowerBrackets"  style="margin:0">38</button>
							</div>
						</div>
						<p class="RL" style="margin-left:5px">L</p>
					</div>
				</div>
			</div>
		</div>
	<!-- Prescription1 End -->

	<!-- Prescription2 Start -->
		<div id="result_setup1" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription2</p>
				<a href="/views/service/09_setup2.php">Edit</a>
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="used_brackets" style="overflow:hidden;">
					<div>
						<h2 style="text-align:left;width:160px;float:left;display:inline-block">3. Attachment<span style="float:right;margin-right:10px">:</span></h2>
						<p style="display:inline-block"><?
							switch ($_SESSION['attchment_option']) {
								case 'automatically':
									echo "Automatically add attachments for necessary teeth movement";
									break;
								case 'select':
									echo "Select teeth";
									break;
									}
						?></p>
					</div>
					<div style="overflow:hidden;display:inline-block;margin:20px 0 0 20px">
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
				</div>
				<div class="used_brackets">
					<h2 style="text-align:left;margin-top:40px">4. A.P relation</h2>
					<div style="margin:20px 0 0 30px;text-align:left">
						<div style="display:inline-block">
							<p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">Upper<span style="float:right">:</span></p>
							<div style="display:inline-block;margin-left:20px">
								<p><?
								switch ($_SESSION['ap_relation_upper']) {
								case 'expansion':
									echo "Protrusion";
									break;
								case 'retraction':
									echo "Retraction";
									break;
								default:
									echo "none";
									break;
									}
									?></p>
							</div>
						</div>
						<div style="display:inline-block;margin-left:60px">
							<p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">Lower<span style="float:right">:</span></p>
							<div style="display:inline-block;margin-left:20px">
								<p><?
								switch ($_SESSION['ap_relation_lower']) {
								case 'expansion':
									echo "Protrusion";
									break;
								case 'retraction':
									echo "Retraction";
									break;
								default:
									echo "none";
									break;
									}
									?></p>
							</div>
						</div>
					</div>
					<div style="margin:20px 0 0 30px;text-align:left">
						<div style="display:inline-block">
							<p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">Canine Relationship<span style="float:right">:</span></p>
							<div style="display:inline-block;margin-left:20px">
								<p><?
								switch ($_SESSION['ap_relation_canine']) {
								case 'maintain':
									echo "Maintain";
									break;
								case 'improve':
									echo "Improve";
									break;
								default:
									echo "none";
									break;
									}
									?></p>
							</div>
						</div>
						<div style="display:inline-block;margin-left:60px">
							<p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">Molar Relationship<span style="float:right">:</span></p>
							<div style="display:inline-block;margin-left:20px">
								<p><?
								switch ($_SESSION['ap_relation_molar']) {
								case 'maintain':
									echo "Maintain";
									break;
								case 'improve':
									echo "Improve";
									break;
								default:
									echo "none";
									break;
									}
									?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Prescription2 End -->
	<!-- Prescription3 Start -->
		<div id="result_setup3" class="result_box" style="margin-top:40px;">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription3</p>
				<a href="/views/service/10_setup3.php">Edit</a>
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="used_brackets">
					<h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px">5. Overjet & Overbite<span style="float:right;margin-right:10px">:</span></h2>
					<div style="text-align:left;display:inline-block">
						<div style="overflow:hidden;">
							<p style="float:left;width:160px">Overjet<span style="float:right">:</span></p>
							<div style="overflow:hidden;padding-left:10px">
								<div style="overflow:hidden">
									<p style="float:left;">
                                    <?if($_SESSION['overjet'] == "Ideal"){ echo "Ideal(2mm)";}
                                    else if ($_SESSION['overjet'] == "custom") {echo "Custom(".$_SESSION['overjet_value']."mm)" ;}
                                    ?>
                                    </p>
								</div>
							</div>
						</div>
						<div style="overflow:hidden;margin-top:20px">
							<p style="float:left;width:160px">Overbite<span style="float:right">:</span></p>
							<div style="overflow:hidden;padding-left:10px">
								<div style="overflow:hidden">
									<p style="float:left;">
                                    <?if($_SESSION['overbite'] == "Ideal"){ echo "Ideal(2mm)";}
                                    else if ($_SESSION['overbite'] == "custom") {echo "Custom(".$_SESSION['overbite_value']."mm)" ;}
                                    ?></p>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="used_brackets" style="margin-top:30px">
					<h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px">6. Midline<span style="float:right;margin-right:10px">:</span></h2>
					<div style="text-align:left;display:inline-block;vertical-align:top;">
						<p>
						<?
								switch ($_SESSION['midline']) {
								case 'maintain_the_midline':
									echo "Maintain the midline";
									break;
								case 'improvement':
									echo "Midline improvement";
									break;
									}
									?>
						</p>
					</div>
						<?if($_SESSION['midline'] == "improvement"){ ?>
							<div style="text-align:left;display:inline-block;margin-left:20px">
									<?if($_SESSION['arch'] != "lower"){?>
									<div style="overflow:hidden">
										<p style="float:left;width:60px">Upper<span style="float:right">:</span></p>
										<div style="overflow:hidden;padding-left:10px">
											<div style="overflow:hidden">
												<p style="float:left;">
												<?
												if($_SESSION['midline_upper'] == "right"){ ?>
												<span>Right move <?=$_SESSION['midline_upper_right_value']?>mm</span>
											<?	}else if($_SESSION['midline_upper'] == "left"){?>
												<span>Left move <?=$_SESSION['midline_upper_left_value']?>mm</span>
											<?	}else{ ?>
												<span>Not required</span>
											<?	}
												?>
												
												</p>
											</div>
										</div>
									</div>
									<?}
									if($_SESSION['arch'] != "upper"){?>
									<div style="overflow:hidden;margin-top:20px">
										<p style="float:left;width:60px">Lower<span style="float:right">:</span></p>
										<div style="overflow:hidden;padding-left:10px">
											<div style="overflow:hidden">
												<p style="float:left;">
														<?
												if($_SESSION['midline_lower'] == "right"){ ?>
													<span>Right move <?=$_SESSION['midline_lower_right_value']?>mm</span>
												<?	}else if($_SESSION['midline_lower'] == "left"){?>
													<span>Left move <?=$_SESSION['midline_lower_left_value']?>mm</span>
												<?	}else{ ?>
													<span>Not required</span>
												<?	}
													?>
												</p>
											</div>
										</div>
									</div>
									<?}?>

							</div>
							<?}?>
				</div>					
				<div class="used_brackets" style="margin-top:40px">
					<div>
						<h2 style="text-align:left;width:160px;float:left;display:inline-block">7. IPR<span style="float:right;margin-right:10px">:</span></h2>
						<p style="display:inline-block"><?=$_SESSION['ipr_option']?></p>
					</div>
				</div>
			</div>
		</div>
	<!-- Prescription3 End -->
	<!-- Prescription4 Start -->
		<div id="result_setup4" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription4</p>
				<a href="/views/service/11_setup4.php">Edit</a>
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="used_brackets">
					<div style="margin-bottom:30px">
						<h2 style="text-align:left;width:320px;display:inline-block">8. Occlusal opening device<span style="float:right;margin-right:30px">:</span></h2>
						<p style="display:inline-block">
						<?if($_SESSION['occ_opening_device_option'] != "bite_ramp"){?>
								None
						<?}else{?>
						Bite ramp on the lingual side of the maxilla / <?if($_SESSION['occ_opening_device_type'] == "incisor"){
							$Incisor_value = "";if($_SESSION['incisor_option'] == "central"){$Incisor_value = "Central incisor";}else {$Incisor_value = "Lateral incisor";}
							echo "Incisor  / ".$Incisor_value; }else{echo "Canine";}?>
						<?}?>
						</p>
					</div>
					<h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px">9. Extraction<span style="float:right;margin-right:10px">:</span></h2>
					<div style="text-align:left;display:inline-block;vertical-align:top;margin-left:20px">
						<p>
							<?
							if($_SESSION['extraction'] == "none_tooth_e"){ echo "None extraction";}else{echo "Extraction";}
							?>
						</p>
					</div>
					<div style="overflow:hidden;display:inline-block;margin:20px 0 0 20px">
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
		</div>
	<!-- Prescription4 End -->
	<!-- Prescription5 Start -->
		<div id="result_setup5" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription5</p>
				<a href="/views/service/12_setup5.php">Edit</a>
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="used_brackets">
				<h2 style="text-align:left;">10. Eruption compensation</h2>
				<div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
					<div style="margin-top:20px">
						<div style="text-align:left;display:inline-block;vertical-align:top">
							<div style="margin-bottom:20px">
								<p style="display:inline-block;">Eruption compensation<span style="margin-left:10px">:</span></p>
								<div style="text-align:left;display:inline-block">
									<p>
									<?if($_SESSION['eruption_incisor_option'] =="none"){
									 echo "None";
									}else{
									 echo "Select teeth for compensation";
									}?>
									</p>

								</div>
							</div>
							<div style="overflow:hidden;display:inline-block">
								<p class="RL" style="margin-right:5px">R</p>
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
							<div>
								<p style="display:inline-block;vertical-align:top;margin-bottom:20px">Provide space for eruption of 2nd molars.<span style="margin-left:10px">:</span></p>
								<div style="text-align:left;display:inline-block">
									<p>
									<?if($_SESSION['eruption_molar_option'] =="none"){
									 echo "None";
									}else{
									 echo "Select teeth for compensation";
									}?>
									</p>
								</div>
							</div>
							<div style="overflow:hidden;">
								<p  class="RL" style="margin-right:5px">R</p>
								<div style="overflow:hidden;display:inline-block;float:left">
									<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
										<button type="button" class="number" id="molar_17" name="upperBrackets" style="margin:0">17</button>
									</div>
									<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
										<button type="button" class="number" id="molar_47" name="lowerBrackets" style="margin:0">47</button>
									</div>
								</div>
								<div style="overflow:hidden;display:inline-block;float:left">
									<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
										<button type="button" class="number" id="molar_27" name="upperBrackets" style="margin:0">27</button>
									</div>
									<div style="padding-top:5px;overflow:hidden;padding-left:5px">
										<button type="button" class="number" id="molar_37" name="lowerBrackets" style="margin:0">37</button>
									</div>
								</div>
								<p class="RL" style="margin-left:5px">L</p>
							</div>
							<div style="margin-top:10px">
								<p style="display:inline-block">Step to start provide space<br>for eruption of 2nd molars</p>
								<input disabled id="overbite_custom_n" type="text" name="overbite_custom_n" value="<?=$_SESSION['eruption_molar_value']?>"  required oninvalid="this.setCustomValidity('숫자를 입력해주세요.')" oninput="setCustomValidity('')"  placeholder="-----" maxlength="3" style="margin-left:5px;width:60px;height:25px;padding:5px;display:inline-block;vertical-align:top">
							</div>
						</div>
					</div>
				</div>
				<h2 style="text-align:left;">11. Additional request</h2>
				<div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
					<textarea disabled style="width:100%;height:100px"><?=$_SESSION['special_instruction']?></textarea>
				</div>
			</div>
		</div>
	<!-- Prescription5 End -->
	</div>
<!-- result 끝 -->

<?
//print_r($_SESSION['incisor_select_number']);
if ($_SESSION['attchment_option'] == "select") {
echo "<script>";
for ($i=0; $i < count($_SESSION['attchment_select_number']); $i++) { 
	echo "$('#attchment_".$_SESSION['attchment_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
}
echo "</script>";
}
?>


<?

echo "<script>";
if ($_SESSION['eruption_incisor_option'] == "provide") {
	for ($i=0; $i < count($_SESSION['incisor_select_number']); $i++) { 
		echo "$('#incisor_".$_SESSION['incisor_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
	}
}

if ($_SESSION['eruption_molar_option'] == "provide") {
	for ($i=0; $i < count($_SESSION['molar_select_number']); $i++) { 
		echo "$('#molar_".$_SESSION['molar_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
	}
}


echo "</script>";
?>


<?
if (isset($_SESSION['brk_list_index'])) {
echo "<script>";
for ($i=0; $i < count($_SESSION['brk_list_index']); $i++) { 

?>
				var table_number = Number('<?echo $_SESSION['brk_list_index'][$i];?>');
				var brk_nums = '<?echo $_SESSION['brk_list_brk_numbers'][$i];?>';
                var color_key = brk_color_list(table_number);

 								var tr = " <tr class=cellcolor> \
                                    <td>" +table_number + "</td> \
                                    <td><?echo $_SESSION['brk_list_company_name'][$i];?></td> \
                                    <td><?echo $_SESSION['brk_list_product_name'][$i];?></td> \
                                    <td><? 
                                    if(!strpos($_SESSION['brk_list_brk_numbers'][$i],'#')){ echo $_SESSION['brk_list_brk_numbers'][$i];}
                                        else{
                                             $brk_numbers = explode("(",$_SESSION['brk_list_brk_numbers'][$i],2);
                                        echo $brk_numbers[0]."<span style='color:red'>(".$brk_numbers[1]."</span>";
                                        }?></td> \
                                    <td><div style='display:inline-block;width: 20px;height: 20px;background-color:"+color_key + "'></div></td> \
                                </tr>";
            $('#brk_list_tbody').append(tr);
            brk_color_append(table_number,brk_nums);
<?
	//echo "$('#brk_".$_SESSION['e_select_number'][$i]."').css({'background':'url(../../resource/images/faq_up.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
}
echo "</script>";
}
?>


<?
if ($_SESSION['extraction'] == "tooth_e") {
echo "<script>";
for ($i=0; $i < count($_SESSION['e_select_number']); $i++) { 
	echo "$('#extraction_".$_SESSION['e_select_number'][$i]."').css({'background':'url(../../resource/images/extraction_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
    $('#extraction_".$_SESSION['e_select_number'][$i]."').text('');";
}
echo "</script>";
}
?>

</form>
	</div>
	
	<div class="button_menu" style="margin:40px auto 0 auto; padding:10px; position:unset;transform:none">
		<a href="javascript:servicePopupClose();" class="service_close">Close</a>
		<a href="12_setup5.php" class="service_close" style="margin:0 10px 0 0">Back</a>
	<!--	<a href="javascript:void(0);"  class="service_close" style="margin-left:10px">Print</a>
         window.open('../../viewmodels/servicePrint.php','printPopup','height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes');" -->
		<input type="button" onclick="javascript:resultSubmit();" value="Submit" class="service_next" style="margin:0">
	</div>
</div>
<?
if (isset($_SESSION['diag_select_number'])) {
echo "<script>";
for ($i=0; $i < count($_SESSION['diag_select_number']); $i++) { 
    $number_values = explode( ',', $_SESSION['diag_select_number'][$i], 2);
    if($number_values[1] == "crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../resource/images/crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "implant"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../resource/images/implant_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "telescopic_crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../resource/images/Telescopic_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "veneered_crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../resource/images/Veneered_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }
}
echo "</script>";
}
?>



<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>
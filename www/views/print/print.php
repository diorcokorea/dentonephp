<html style="width:100%;height:auto">
	<body style="width:1200px;margin:0 auto">
		

<div class="content" style="background-color:#fff;height:auto">
    <form id="service_info_form" name="service_info_form" action="service_info.php" method="POST">
	<div class="result_inner" style=";background-color:#999">
	<!-- Treatment option1 Start -->
		<div id="result_modeltype" class="result_box">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Adult/Child</p>
			</div>
			<div class="result_content" style="padding:40px 80px">
				<div>
					<div class="patient">
						<p>Option: </p>
						<p><?=$treatment_option1?>  </p>
					</div>
				</div>
			</div>
		</div>
	<!-- Treatment option1 End -->

	<!-- Treatment option2 Start -->
		<div id="result_modeltype" class="result_box" style="margin-top:40px;background-color:#bbb">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Aligner step</p>
			</div>
			<div class="result_content" style="padding:40px 80px">
				<div>
					<div class="patient">
						<p>Option: </p>
						<p><?=$treatment_option2?>  </p>
					</div>
				</div>
			</div>
		</div>
	<!-- Treatment option2 End -->

	<!-- Patient Info Start -->
		<div id="result_patient" class="result_box" style="margin-top:40px;background-color:blue">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Patient information</p>
			</div>
			<div class="result_content" style="padding:60px 0;">
				<div style="width:70%;margin:0 auto">
					<div class="patient_left" style="float:left;">
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Patient ID</p>
							<span>:</span>
							<p style="white-space: pre-wrap; width: 150px; vertical-align: middle;"><?=$patient_info_array[0]?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">First name</p>
							<span>:</span>
							<p class="result_patient_content" style="white-space: pre-wrap; width: 150px; vertical-align: middle;"><?=explode( ',', $patient_info_array[1] )[0]?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Last name</p>
							<span>:</span>
							<p class="result_patient_content" style="white-space: pre-wrap; width: 150px; vertical-align: middle;"><?=explode( ',', $patient_info_array[1] )[1]?></p>
						</div>
						<div class="patient">
							<p class="result_patient_title">Gender</p>
							<span>:</span>
							<p class="result_patient_content"><?if ($patient_info_array[2]=="male"){echo "Male"; }else{echo "Female";}?></p>
						</div>
					</div>
					<div class="patient_right" style="float: right;">
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Birthday</p>
							<span>:</span>
							<p class="result_patient_content"><?=$patient_info_array[4]?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Age</p>
							<span>:</span>
							<p class="result_patient_content"><?=$patient_info_array[12]?></p>
						</div>
						<div class="patient">
							<p class="result_patient_title">Lab</p>
							<span>:</span>
							<p class="result_patient_content"><?=$patient_info_array[11]?></p>
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
			</div>
			<div class="result_content" style="padding:40px 100px">
					<div class="classification_result">
						<p class="classification_result_title">Status:</p>
						<p class="classification_result_content">
                      <? 
						foreach($classification as $key => $value){
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
						<textarea disabled class="classification_result_etc_box"><?= $classification['etc_value']?></textarea>
					</div>
					<div class="classification_result" style="margin-top:30px">
						<p class="classification_result_precautions">Note</p>
						<textarea disabled class="classification_result_precautions_box"><?= $classification['precaution']?></textarea>
					</div>
			</div>
		</div>
	<!-- Classification End -->

	<!-- Model Type Start -->
		<div id="result_modeltype" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Model Type</p>
			</div>
			<div class="result_content" style="padding:40px 200px">
				<div>
					<div class="patient">
						<p class="result_patient_title">Model type</p>
						<span style="margin-right:80px">:</span>
						<p><?=  $model_type ?></p>
					</div>
				</div>
			</div>
		</div>
	<!-- Model Type End -->

	<!-- Picture Start -->
		<div id="result_picture" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Photo</p>
			</div>
			<div class="result_content" style="padding:30px 0;width:100%;">
				<div style="width:60%;margin:0 auto">
					<div style="text-align:center;width:100%;overflow:hidden;margin-bottom:20px">
						<div style="display:inline-block;" class="filebox">
							<input type="file" disabled id="Lateral" href="#" disabled style="">
							<label for="Lateral" class="lateral">
							 <? if($lateral_photo != null){?>
									<img class="thumb_img" src="<?= "/".$lateral_photo ?>"> 
								<?}?>
								<p class="file_text">Lateral Photo</p>
							</label>
						</div>
						<div class="filebox" style="display:inline-block;margin:0 10px">
							<input type="file" disabled id="Frontal" href="#" style="">
							<label for="Frontal" class="frontal">
							 <? if($front_photo != null){?>
									<img class="thumb_img" src="<?= "/".$front_photo?>"> 
								<?}?>
								<p class="file_text">Frontal Photo</p>
							</label>
						</div>
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Smaile" href="#" style="">
							<label for="Smaile" class="smile">
							 <? if($smile_photo != null){?>
									<img class="thumb_img" src="<?= "/".$smile_photo?>"> 
								<?}?>
								<p class="file_text">Smile Photo</p>
							</label>
						</div>
					</div>
					<div style="text-align:center;width:100%;overflow:hidden;margin-bottom:20px">
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Lateral" href="#" style="">
							<label for="Lateral" class="intraoral_upper">
							 <? if($intraoral_upper != null){?>
									<img class="thumb_img" src="<?= "/".$intraoral_upper?>"> 
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
							 <? if($intraoral_lower != null){?>
									<img class="thumb_img" src="<?= "/".$intraoral_lower?>"> 
								<?}?>
								<p class="file_text">Intraoral Lower</p>
							</label>
						</div>
					</div>
					<div style="text-align:center;width:100%;overflow:hidden">
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Lateral" href="#" style="">
							<label for="Lateral" class="intraoral_right">
							 <? if($intraoral_right != null){?>
									<img class="thumb_img" src="<?= "/".$intraoral_right?>"> 
								<?}?>
								<p class="file_text">Intraoral Right</p>
							</label>
						</div>
						<div class="filebox" style="display:inline-block;margin:0 10px">
							<input type="file" disabled id="Frontal" href="#">
							<label for="Frontal" class="intraoral_front">
						 	 <? if($intraoral_fornt != null){?>
									<img class="thumb_img" src="<?= "/".$intraoral_fornt?>"> 
								<?}?>
								<p class="file_text">Intraoral Front</p>
							</label>
						</div>
						<div style="display:inline-block" class="filebox">
							<input type="file" disabled id="Smaile" href="#" style="">
							<label for="Smaile" class="intraoral_left">
							 <? if($intraoral_left != null){?>
									<img class="thumb_img" src="<?= "/".$intraoral_left?>"> 
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
		<div id="result_radiograph" class="result_box" style="margin-top:40px;background-color:red">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">X-ray image</p>
			</div>
			<div class="result_content" style="padding:30px 0;width:100%;">
				<div class="radiograph_inner" style="padding:0;width:60%;margin:0 auto">
					<div class="scanfile" style="padding:0">
						<div style="float:left;position:relative">
							<input type="file" disabled id="lateral_xray" href="#" style="">
							<label for="lateral_xray" class="lateral_xray">
						 	 <? if($lateral_xray != null){?>
									<img class="thumb_img" src="<?= "/".$lateral_xray?>"> 
								<?}?>
								<p class="file_text">Lateral</p>
							</label>
						</div>
						<div style="float:right;position:relative">
						<input type="file" disabled id="panorama" href="#" style="">
					<!-- 	<input type="file" disabled id="image" accept="image/*" onchange="setThumbnail(event);"/> -->
							<label for="panorama" class="panorama">
							 <? if($panorama != null){?>
									<img class="thumb_img" src="<?= "/".$panorama?>"> 
								<?}?>
								<p class="file_text">Panorama</p>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Radiograph End -->
<!-- Adults Result Start -->
	<!-- Prescription1 Start -->
		<div id="result_bracket" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription1</p>
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="indirect_System">
					<div>
						<h2 style="text-align:left;width:240px;float:left;display:inline-block">1. Select a arch<span style="float:right;margin-right:30px">:</span></h2>
						<p style="display:inline-block"><? 
						switch ($arch) {
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
								switch ($arch) {
								case 'both':
										echo "<div style='overflow:hidden'><p style='float:left;'>";
										echo "Upper / ".$tray_section_u;
										echo "</p></div>";

										echo "<div style='margin-top:20px'> <p style='float:left;'>";
										echo "Lower / ".$tray_section_l;
										echo "</p></div>";
									break;
								case 'upper':
										echo "<div style='overflow:hidden'><p style='float:left;'>";
										echo "Upper / ".$tray_section_u;
										echo "</p></div>";
									break;
								case 'lower':
										echo "<div style='margin-top:20px'> <p style='float:left;'>";
										echo "Lower / ".$tray_section_l;
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
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="used_brackets" style="overflow:hidden;">
					<div>
						<h2 style="text-align:left;width:160px;float:left;display:inline-block">3. Attachment<span style="float:right;margin-right:10px">:</span></h2>
						<p style="display:inline-block"><?
							switch ($attchment_option) {
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
								switch ($ap_relation_upper) {
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
								switch ($ap_relation_canine) {
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
								switch ($ap_relation_molar) {
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
                                    <?if($overjet == "Ideal"){ echo "Ideal(2mm)";}
                                    else if ($overjet == "custom") {echo "Custom(".$overjet_value."mm)" ;}
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
                                    <?if($overbite == "Ideal"){ echo "Ideal(2mm)";}
                                    else if ($overbite == "custom") {echo "Custom(".$overbite_value."mm)" ;}
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
								switch ($midline) {
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
						<?if($midline == "improvement"){ ?>
							<div style="text-align:left;display:inline-block;margin-left:20px">
									<?if($arch != "lower"){?>
									<div style="overflow:hidden">
										<p style="float:left;width:60px">Upper<span style="float:right">:</span></p>
										<div style="overflow:hidden;padding-left:10px">
											<div style="overflow:hidden">
												<p style="float:left;">
												
												<?
												if($midline_upper_right_value != null){ ?>
													<span>Right move <?=$midline_upper_right_value?>mm</span>
												<?	}else if($midline_upper_left_value != null){?>
													<span>Left move <?=$midline_upper_left_value?>mm</span>
												<?	}else{ ?>
													<span>Not required</span>
												<?	}
													?>
												</p>
											</div>
										</div>
									</div>
									<?}
									if($arch != "upper"){?>
									<div style="overflow:hidden;margin-top:20px">
										<p style="float:left;width:60px">Lower<span style="float:right">:</span></p>
										<div style="overflow:hidden;padding-left:10px">
											<div style="overflow:hidden">
												<p style="float:left;">

												<?
												if($midline_lower_right_value != null){ ?>
													<span>Right move <?=$midline_lower_right_value?>mm</span>
												<?	}else if($midline_lower_left_value != null){?>
													<span>Left move <?=$midline_lower_left_value?>mm</span>
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
						<p style="display:inline-block"><?=$ipr_option?></p>
					</div>
				</div>
			</div>
		</div>
	<!-- Prescription3 End -->
	<!-- Prescription4 Start -->
		<div id="result_setup4" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription4</p>
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="used_brackets">
					<div style="margin-bottom:30px">
						<h2 style="text-align:left;width:320px;display:inline-block">8. Occlusal opening device<span style="float:right;margin-right:30px">:</span></h2>
						<p style="display:inline-block">
						<?if($occ_opening_device_option != "bite_ramp"){?>
								None
						<?}else{?>
						Bite ramp on the lingual side of the maxilla / <?if($occ_opening_device_type == "incisor"){
							$Incisor_value = "";if($incisor_option == "central"){$Incisor_value = "Central incisor";}else {$Incisor_value = "Lateral incisor";}
							echo "Incisor  / ".$Incisor_value; }else{echo "Canine";}?>
						<?}?>
						</p>
					</div>
					<h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px">9. Extraction<span style="float:right;margin-right:10px">:</span></h2>
					<div style="text-align:left;display:inline-block;vertical-align:top;margin-left:20px">
						<p>
							<?
							if($extraction == "none_tooth_e"){ echo "None extraction";}else{echo "Extraction";}
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
									<?if($eruption_incisor_option =="none"){
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
									<?if($eruption_molar_option =="none"){
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
								<input disabled id="overbite_custom_n" type="text" name="overbite_custom_n" value="<?=$eruption_molar_value?>"  required oninvalid="this.setCustomValidity('숫자를 입력해주세요.')" oninput="setCustomValidity('')"  placeholder="-----" maxlength="3" style="margin-left:5px;width:60px;height:25px;padding:5px;display:inline-block;vertical-align:top">
							</div>
						</div>
					</div>
				</div>
				<h2 style="text-align:left;">11. Additional request</h2>
				<div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
					<textarea disabled style="width:100%;height:100px"><?=$special_instruction?></textarea>
				</div>
			</div>
		</div>
	<!-- Prescription5 End -->
<!-- Adults result 끝 -->
<!-- Child result 시작 -->



</form>
	</div>
</div>
<div class="button_menu" style="position: unset; transform: none; margin: 40px auto 0 auto;">
	<!--<form action="../../viewmodels/servicePrint.php" method="post" style="display:inline-block">
		<input type="submit" class="service_close" value="프린터" style="margin-left:10px">
        <input type="hidden" name="patient_key" value="<?=$patientkey?>">
        <input type="hidden" name="service_key" value="<?=$patientServiceKey?>">
        </form>-->
		<a href="javascript:createPdf();" class="service_close">Close</a>
        
	</div>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.7.2/bluebird.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://unpkg.com/html2canvas@1.0.0-rc.5/dist/html2canvas.js"></script>
<script>
var renderedImg = new Array;

var contWidth = 200, // 너비(mm) (a4에 맞춤)
		padding = 5; //상하좌우 여백(mm)


function createPdf() { //이미지를 pdf로 만들기
	//document.getElementById("loader").style.display = "block"; //로딩 시작

	var lists = document.querySelectorAll("body"),
			deferreds = [],
			doc = new jsPDF("p", "mm", "a4"),
			listsLeng = lists.length;

	for (var i = 0; i < listsLeng; i++) { // li 개수만큼 이미지 생성
		var deferred = $.Deferred();
		deferreds.push(deferred.promise());
		generateCanvas(i, doc, deferred, lists[i]);
	}

	$.when.apply($, deferreds).then(function () { // 이미지 렌더링이 끝난 후
		var sorted = renderedImg.sort(function(a,b){return a.num < b.num ? -1 : 1;}), // 순서대로 정렬
				curHeight = padding, //위 여백 (이미지가 들어가기 시작할 y축)
				sortedLeng = sorted.length;
	
		for (var i = 0; i < sortedLeng; i++) {
			var sortedHeight = sorted[i].height, //이미지 높이
					sortedImage = sorted[i].image; //이미지

			if( curHeight + sortedHeight > 297 - padding * 2 ){ // a4 높이에 맞게 남은 공간이 이미지높이보다 작을 경우 페이지 추가
				doc.addPage(); // 페이지를 추가함
		curHeight = padding; // 이미지가 들어갈 y축을 초기 여백값으로 초기화
				doc.addImage(sortedImage, 'jpeg', padding , curHeight, contWidth, sortedHeight); //이미지 넣기
				curHeight += sortedHeight; // y축 = 여백 + 새로 들어간 이미지 높이
			} else { // 페이지에 남은 공간보다 이미지가 작으면 페이지 추가하지 않음
				doc.addImage(sortedImage, 'jpeg', padding , curHeight, contWidth, sortedHeight); //이미지 넣기
				curHeight += sortedHeight; // y축 = 기존y축 + 새로들어간 이미지 높이
			}
		}
		doc.save('pdf_test.pdf'); //pdf 저장

		//document.getElementById("loader").style.display = "none"; //로딩 끝
		curHeight = padding; //y축 초기화
		renderedImg = new Array; //이미지 배열 초기화
	});
}

function generateCanvas(i, doc, deferred, curList){ //페이지를 이미지로 만들기
	var pdfWidth = $(curList).outerWidth() * 0.2645, //px -> mm로 변환
			pdfHeight = $(curList).outerHeight() * 0.2645,
			heightCalc = contWidth * pdfHeight / pdfWidth; //비율에 맞게 높이 조절
	html2canvas( curList ).then(
		function (canvas) {
			var img = canvas.toDataURL('image/jpeg', 1.0); //이미지 형식 지정
			renderedImg.push({num:i, image:img, height:heightCalc}); //renderedImg 배열에 이미지 데이터 저장(뒤죽박죽 방지)     
			deferred.resolve(); //결과 보내기
			}
	);
}
</script>
</html>
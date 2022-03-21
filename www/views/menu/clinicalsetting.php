<?php
session_start();
$config['cf_title'] = "Clinical Setting";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
include "../../models/db/querys.php";
$clinic_settings = clinic_setting_r($_SESSION['member_code']);

// $settings['numbering_option'] = "fdi";
// $settings['passive_aligner'] = "Y";

// $settings['maxillary_tooth_alignment'] = "based_gingival";
// $settings['based_gingival'] = "arrange_the_lateral";
// $settings['ipr_option'] = "apply";

// $settings['cutting_appliances'] = "cut_aligner";
// $settings['overcorrection_chain'] = "not_apply";

// $settings['virtual_teeth'] = "full_size";
// $settings['arch_expansion'] = "canine";

// $settings['when_shipping'] = "5_appliances";
// $settings['special_instructions'] = "";

// $settings['permanent_teeth'] = "apply";
// $settings['primary_teeth'] = "not_apply";

// $settings['teeth_to_expand'] = "expansion_permanent_teeth";
// $settings['arch_expansion_primary_teeth'] = "primary_teeth_3";



  $clinic_settings = json_decode($clinic_settings, true);
 //print_r($clinic_settings);
?>
<style>
       
    </style>

<div class="content" style="background-color:#fff;height:auto;position:relative">
	<form name="clinic_setting_form" id="clinic_setting_form" method="post"    onsubmit="return false;"   style="margin-top:20px">
	<div class="clinical_inner">
		<div class="top" style="overflow:hidden">
			<div class="patient_warning" style="padding:0;width:100%;">
				<p class="patient_warning_icon"></p>
				<p class="patient_warning_text">The clinical preferences shown below apply to all treatments by default. Fill in the prescription when you want to change clinical preferences for a specific patient.</p>
			</div>
			<div class="patient_warning" style="padding-top:20px;width:100%;">
				<p class="patient_warning_icon"></p>
				<p class="patient_warning_text"><span style="color:#07a2e8">Blue</span> letters in clinical preferances represents defualt settings</p>
			</div>
		</div>
		<div class="setting_box">
			<div class="leftbox">
				<div style="width:100%;float:left;">
					<h3 class="title">Tooth numbering system<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_1"></p>
					<div id="clinical_1_text" class="clinical_popup">You may select from 3 tooth numbering systems on DentOne.</div>
				</div>
				<div style="width:100%">
					<div style="">
						<input class="" type="radio" id="universal" <? if($clinic_settings['numbering_option'] == "universal") echo "checked"?> value="universal" name="numbering_option">
						<label for="universal" style="padding-left:20px">UNIVERSAL(#1~#32)</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="palmer" <? if($clinic_settings['numbering_option'] == "palmer") echo "checked"?> value="palmer" name="numbering_option">
						<label for="palmer" style="padding-left:20px">PALMER(UR8~LR8)</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="fdi"  <? if($clinic_settings['numbering_option'] == "fdi" || $clinic_settings['numbering_option'] == null) echo "checked"?> value="fdi" name="numbering_option">
						<label for="fdi" class="clinical_basic" style="padding-left:20px">FDI(1.8~4.8)</label>
					</div>
				</div>
			</div>
			<div class="rightbox" style="height:221px">
				<div style="width:100%;float:left;">
					<h3 class="title">Passive aligner<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_2"></p>
					<div id="clinical_2_text" class="clinical_popup">
						If one arch has more steps, you may request to use a<br>
						manual aligner. Manual aligner is only available for<br> 
						arches with fewer steps in the treatment of both jaws,<br>
						and can be applied until the treatment of the opposing<br> 
						arch is finished. The manual aligner also provides a<br>
						Class II or Class III anchorage source treated with the<br>
						DentOne through the button and elastic band.<br>
						The default setting is “Use a manual aligner to sync the<br> 
						treatment duration with the arch opposite to the<br>
						treatment”.
					</div>
				</div>
				<div style="width:100%">
					<div>
						<input class="" type="radio" id="passive"  <? if($clinic_settings['passive_aligner'] == "Y" || $clinic_settings['passive_aligner'] == null) echo "checked"?> value="Y" name="passive_aligner">
						<label for="passive" class="clinical_basic" style="padding-left:20px">Yes, use a passive aligner to align the<br>treatment period with the contralateral arch.</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="passive_not"  <? if($clinic_settings['passive_aligner'] == "N" ) echo "checked"?> value="N" name="passive_aligner">
						<label for="passive_not" style="padding-left:20px">Not applicable</label>
					</div>
				</div>
			</div>
		</div>
		<div class="setting_box">
			<div class="leftbox">
				<div style="width:100%;float:left">
					<h3 class="title" style="padding:0">Maxillary tooth alignment<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_3"></p>
					<div id="clinical_3_text" class="clinical_popup">
						You can prescribe how to level the maxillary<br> 
						4 incisors. Choose between leveling by incisal<br> 
						plane or by gingival margin.<br> 
						The default setting is “arrange the lateral incisors<br> 
						0.5mm gingivally from the central incisors”.
					</div>
					<h3 class="title">(this clinical preference applies for permanent teeth only.)</h3>
				</div>
				<div style="width:100%">
					<div>
						<div>
							<input class="" type="radio" id="based_gingival" <? if($clinic_settings['maxillary_tooth_alignment'] == "based_gingival" || $clinic_settings['maxillary_tooth_alignment'] == null) echo "checked"?> value="based_gingival"  name="maxillary_tooth_alignment">
							<label for="based_gingival" style="padding-left:20px">Based on gingival</label>
						</div>
						<div style="margin-left:60px;margin-top:20px">
							<div>
								<input class="" type="radio" id="Based_on_lateral" <?if($clinic_settings['maxillary_tooth_alignment'] != "based_gingival") echo "disabled";else if($clinic_settings['based_gingival'] == "Based_on_lateral" ) echo "checked"; else if($clinic_settings['maxillary_tooth_alignment'] != "based_gingival") echo "disabled";?> value="Based_on_lateral" name="based_gingival">
								<label for="Based_on_lateral" style="padding-left:20px">Based on lateral incisors according to central incisors</label>
							</div>
							<div style="margin-top:20px">
								<input class="" type="radio" id="Arrange_the_lateral" <?if($clinic_settings['maxillary_tooth_alignment'] != "based_gingival") echo "disabled";else if($clinic_settings['based_gingival'] == "arrange_the_lateral" || $clinic_settings['based_gingival'] == null) echo "checked"?> value="arrange_the_lateral" name="based_gingival" style="margin-top:3px;vertical-align:top">
								<label for="Arrange_the_lateral" class="clinical_basic" style="padding-left:20px;display:inline-block">Arrange the lateral incisors 0.5 mm gingivally from the<br>central incisors</label>
							</div>
						</div>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="based_gingival_margin" <? if($clinic_settings['maxillary_tooth_alignment'] == "based_gingival_margin" ) echo "checked"?>  value="based_gingival_margin" name="maxillary_tooth_alignment">
						<label for="based_gingival_margin" style="padding-left:20px">Based on the gingival margin</label>
					</div>
				</div>
			</div>
			<div class="rightbox" style="height:316px">
				<div style="width:100%;float:left">
					<h3 class="title">Apply IPR in your treatment plan<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_4"></p>
					<div id="clinical_4_text" class="clinical_popup">
						In your first DentOne treatment plan,<br>
						you can set it to “Apply” when you want<br>
						IPR to be administered.<br>
						Alternatively, selecting “Do not apply”<br> 
						will disable the option for IPR on the<br> 
						prescription and no IPR will be applied<br>
						on the first DentOne treatment plan.<br>
						The default setting is “Apply”.
					</div>
				</div>
				<div style="width:100%">
					<div>
						<input class="" type="radio" id="apply" <? if($clinic_settings['ipr_option'] == "apply" || $clinic_settings['ipr_option'] == null) echo "checked"?> value="apply" name="ipr_option">
						<label for="apply" class="clinical_basic" style="padding-left:20px">Apply</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="not_apply" <? if($clinic_settings['ipr_option'] == "not_apply" ) echo "checked"?> value="not_apply" name="ipr_option">
						<label for="not_apply" style="padding-left:20px">Do not apply</label>
					</div>
				</div>
			</div>
		</div>
		<div class="setting_box">
			<div class="leftbox">
				<div style="width:100%;float:left;">
					<h3 class="title" style="padding:0">Cutting of aligners<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_5"></p>
					<div id="clinical_5_text" class="clinical_popup">
						Clinical Preferances allows you select how<br>
						to cut aligners with gingial recession<br> 
						or severe undercuts.<br>
						The default setting is<br> 
						“Cut to CEJ (cement to enamel junction) line”.
					</div>
					<h3 class="title">(when there is gingival recession or severe undercuts)</h3>
				</div>
				<div style="width:100%">
					<div>
						<input class="" type="radio" id="cut_aligner" <? if($clinic_settings['cutting_appliances'] == "cut_aligner" || $clinic_settings['cutting_appliances'] == null) echo "checked"?> value="cut_aligner" name="cutting_appliances">
						<label for="cut_aligner" class="clinical_basic" style="padding-left:20px">Cut the aligner to cover half between the gingival margin<br>and the CEJ</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="cutting_aligner" <? if($clinic_settings['cutting_appliances'] == "cutting_aligner") echo "checked"?> value="cutting_aligner" name="cutting_appliances">
						<label for="cutting_aligner" style="padding-left:20px">Cutting the aligner up to the CEJ line</label>
					</div>
				</div>
			</div>
			<div class="rightbox" style="height:228px">
				<div style="width:100%;float:left;">
					<h3 class="title" style="padding:0">Overcorrection chain applied when the interdental<br></h3>
					<h3 class="title">space is closed<span style="color:red">*</span> (for overcorrection when the space is closed.)</h3>
					<p class="question_icon" id="clinical_6"></p>
					<div id="clinical_6_text" class="clinical_popup">
						You can also request an overcorrection aligner<br>
						that closes the space using an overcorrection<br>
						chain. Overcorrection simulation with rubber<br> 
						Band The default setting is<br> 
						“Overcorrection chain is not applied”.
					</div>
				</div>
				<div style="width:100%">
					<div>
						<input class="" type="radio" id="overcorrection_apply" <? if($clinic_settings['overcorrection_chain'] == "apply" ) echo "checked"?>  value="apply" name="overcorrection_chain">
						<label for="overcorrection_apply" style="padding-left:20px">Apply</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="overcorrection_not_apply" <? if($clinic_settings['overcorrection_chain'] == "not_apply" || $clinic_settings['overcorrection_chain'] == null) echo "checked"?> value="not_apply" name="overcorrection_chain">
						<label for="overcorrection_not_apply" class="clinical_basic" style="padding-left:20px">Do not apply</label>
					</div>
				</div>
			</div>
		</div>
		<div class="setting_box">
			<div class="leftbox">
				<div style="width:100%;float:left;">
					<h3 class="title">Virtual teeth for space between teeth(pontic)<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_7"></p>
					<div id="clinical_7_text" class="clinical_popup">
						"The full size pontic is applied spontaneously to the<br> 
						anterior/posterior space greater than 4mm.<br>
						A half size pontic is given when an adjacent tooth moves,<br> 
						such as for tooth extraction, and the size of the pontic<br> 
						changes as the space size changes."
					</div>
				</div>
				<div style="width:100%">
					<div>
						<input class="" type="radio" id="full_size" <? if($clinic_settings['virtual_teeth'] == "full_size" || $clinic_settings['virtual_teeth'] == null) echo "checked"?> value="full_size" name="virtual_teeth">
						<label for="full_size" class="clinical_basic" style="padding-left:20px;">The full size pontic is applied spontaneously to the<br>anteroir/posterior space greater than 4mm.<br>A half size pontic is given when an adjacent tooth<br>moves, such as for tooth extraction, and the size of<br>the pontic changes as the space size changes.</label>
					</div>
					<div style="margin-top:20px">
						<div>
							<input class="" type="radio" id="choose_one" <? if($clinic_settings['virtual_teeth'] == "choose_one" ) echo "checked"?>  value="choose_one" name="virtual_teeth">
							<label for="choose_one" style="padding-left:20px">Or, choose one or both of the following</label>
						</div>
						<div style="margin-left:60px;margin-top:20px">
							<div>
								<input class="" type="checkbox" id="extraction_cases" <? if($clinic_settings['virtual_teeth'] != "choose_one" ) echo "disabled"; else if($clinic_settings['extraction_cases'] == "on") echo "checked" ?>   name="extraction_cases">
								<label for="extraction_cases" style="padding-left:20px">No pontic use in tooth extraction cases</label>
							</div>
							<div style="margin-top:20px">
								<input class="" type="checkbox" id="posterior_teeth" <? if($clinic_settings['virtual_teeth'] != "choose_one" ) echo "disabled"; else if($clinic_settings['posterior_teeth'] == "on") echo "checked"?> name="posterior_teeth">
								<label for="posterior_teeth" style="padding-left:20px">No pontic are used for the posterior teeth</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="rightbox" style="height:361px">
				<div style="width:100%;float:left;">
					<h3 class="title">Arch expansion<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_8"></p>
					<div id="clinical_8_text" class="clinical_popup">
						You can prescribe a arch extension by selecting the tooth<br> 
						to be extended from the options. The default setting is<br>
						“Expand the arch between canines, premolars and molars”.
					</div>
				</div>
				<div style="width:100%">
					<div>
						<input class="" type="radio" id="canine" <? if($clinic_settings['arch_expansion'] == "canine" || $clinic_settings['arch_expansion'] == null) echo "checked"?> value="canine" name="arch_expansion">
						<label for="canine" class="clinical_basic" style="padding-left:20px">Canine, premolar and molar arch expansion</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="canine_and_premolar" <? if($clinic_settings['arch_expansion'] == "canine_and_premolar" ) echo "checked"?> value="canine_and_premolar" name="arch_expansion">
						<label for="canine_and_premolar" style="padding-left:20px">Canine and premolar arch expansion</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="premolar_and_molar" <? if($clinic_settings['arch_expansion'] == "premolar_and_molar" ) echo "checked"?>  value="premolar_and_molar" name="arch_expansion">
						<label for="premolar_and_molar" style="padding-left:20px">Premolar and molar arch expansion</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="maintain" <? if($clinic_settings['arch_expansion'] == "maintain" ) echo "checked"?>  value="maintain" name="arch_expansion">
						<label for="maintain" style="padding-left:20px">Maintain the current arch</label>
					</div>
				</div>
			</div>
		</div>
		<div class="setting_box">
			<div class="leftbox" style="height:236px">
				<div style="width:100%;float:left;">
					<h3 class="title">Number of aligners when delivering<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_9"></p>
					<div id="clinical_9_text" class="clinical_popup">
						Choose the number of aligners when shipping.<br>
						Default shipping setting is set in units of 5.<br>
						You may choose to get all aligners at once in "Special Request".<br>
						If it is 5 steps or less with DentOne10 & 20, all aligners will be shipped at once.
					</div>
				</div>
				<div style="width:100%">
					<div>
						<input class="" type="radio" id="5_appliances" <? if($clinic_settings['when_shipping'] == "5_appliances" || $clinic_settings['when_shipping'] == null) echo "checked"?> value="5_appliances" name="when_shipping">
						<label for="5_appliances" class="clinical_basic" style="padding-left:20px">5 aligners each arch</label>
					</div>
					<div style="margin-top:20px">
						<input class="" type="radio" id="all_appliances" <? if($clinic_settings['when_shipping'] == "all_appliances" ) echo "checked"?> value="all_appliances" name="when_shipping">
						<label for="all_appliances" style="padding-left:20px"> All aligners</label>
					</div>
				</div>
			</div>
			<div class="rightbox" style="padding:21px 35px;">
				<div style="width:100%;float:left;">
					<h3 class="title" style="padding:0">Additional request<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_10"></p>
					<div id="clinical_10_text" class="clinical_popup">
						By entering additional instructions in this<br>
						section, items not covered in other items of<br>
						Clinical Preferences can be applied to all<br>
						treatments.
					</div>
				</div>
				<div style="width:100%">
					<p style="font-size:18px;margin:10px 0">Please describe in details for an accurate diagnosis.</p>
					<div class="form-group" style="width:100%;">
						<textarea class="form-control-sign_up" name="special_instructions" style="width:100%;height:110px"><?=$clinic_settings['special_instructions']?></textarea>
						<div class="form-control-sign_up-border"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="setting_box">
			<div style="width:100%; border-bottom:1px solid #d2d2d2;padding-bottom:10px;margin:30px 0">
			<h2 style="font-size:28px"><span style="color:#07a2e8">DentOne c & cAP</span> Clinical preference for the treatment</h2>
			</div>
			<div class="leftbox" style="height:274px">
				<div style="width:100%;float:left;">
					<h3 class="title">IPR<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_11"></p>
					<div id="clinical_11_text" class="clinical_popup">
						<strong>Permanent teeth</strong><br>
						This clinical setting can be used to prescribe permanent tooth IPR in the initial DentOne treatment plan.<br>
						Default is "Apply IPR on permanent teeth"<br><br>

						<strong>Primary teeth</strong><br>
						This clinical setting can be used to prescribe primary tooth IPR in the initial DentOne treatment plan.<br>
						Default is "Apply IPR on primary teeth"
					</div>
				</div>
				<div style="width:100%">
					<div>
						<p class="sub_title">Permanent teeth</p>
						<div class="horizontal_input">
							<input class="" type="radio" id="permanent_apply"  <? if($clinic_settings['permanent_teeth'] == "apply" || $clinic_settings['permanent_teeth'] == null) echo "checked"?> value="apply" name="permanent_teeth">
							<label for="permanent_apply" class="clinical_basic" style="padding-left:20px;width:120px">Apply</label>
						</div>
						<div class="horizontal_input">
							<input class="" type="radio" id="permanent_not_apply" <? if($clinic_settings['permanent_teeth'] == "not_apply") echo "checked"?> value="not_apply" name="permanent_teeth">
							<label for="permanent_not_apply" style="padding-left:20px">Do not apply</label>
						</div>
					</div>
					<div style="margin-top:20px">
						<p class="sub_title">Primary teeth</p>
						<div class="horizontal_input">
							<input class="" type="radio" id="primary_apply" <? if($clinic_settings['primary_teeth'] == "apply" ) echo "checked"?> value="apply" name="primary_teeth">
							<label for="primary_apply" style="padding-left:20px;width:120px">Apply</label>
						</div>
						<div class="horizontal_input">
							<input class="" type="radio" id="primary_not_apply" <? if($clinic_settings['primary_teeth'] == "not_apply" || $clinic_settings['primary_teeth'] == null) echo "checked"?>  value="not_apply" name="primary_teeth">
							<label for="primary_not_apply" class="clinical_basic" style="padding-left:20px">Do not apply</label>
						</div>
					</div>
				</div>
			</div>
			<div class="rightbox">
				<div style="width:100%;float:left;">
					<h3 class="title">Arch expansion<span style="color:red">*</span></h3>
					<p class="question_icon" id="clinical_12"></p>
					<div id="clinical_12_text" class="clinical_popup">
						<strong>Expansion</strong><br>
						The clinical preferances can be used to prescribe an arch expansion with options<br>
						Default is expansion of both permanent and primary teeth<br><br>

						<strong>Amount of Expansion</strong><br>
						Display amount of expansion set in your clinical preferances<br>
						Default is 4mm~6mm expansion per arch
					</div>
				</div>
				<div style="width:100%">
					<div>
						<p class="sub_title">Teeth to expand</p>
						<div class="horizontal_input">
							<div>
								<input class="" type="radio" id="expansion_permanent_teeth"  <? if($clinic_settings['teeth_to_expand'] == "expansion_permanent_teeth" || $clinic_settings['teeth_to_expand'] == null) echo "checked"?> value="expansion_permanent_teeth" name="teeth_to_expand">
								<label for="expansion_permanent_teeth" class="clinical_basic" style="padding-left:20px">Expansion of permanent teeth</label>
							</div>
							<div style="margin-top:20px">
								<input class="" type="radio" id="expansion_primary_teeth" <? if($clinic_settings['teeth_to_expand'] == "expansion_primary_teeth" ) echo "checked"?> value="expansion_primary_teeth" name="teeth_to_expand">
								<label for="expansion_primary_teeth" style="padding-left:20px">Expansion of both permanent and primary teeth</label>
							</div>
						</div>
					</div>
					<div style="margin-top:20px">
						<p class="sub_title">Primary teeth</p>
						<div class="horizontal_input">
							<div class="horizontal_input">
								<input class="" type="radio" id="primary_teeth_1" <? if($clinic_settings['arch_expansion_primary_teeth'] == "primary_teeth_1" ) echo "checked"?>  value="primary_teeth_1" name="arch_expansion_primary_teeth">
								<label for="primary_teeth_1" style="padding-left:20px;width:100px">＜2mm</label>
							</div>
							<div class="horizontal_input">
								<input class="" type="radio" id="primary_teeth_2" <? if($clinic_settings['arch_expansion_primary_teeth'] == "primary_teeth_2" ) echo "checked"?> value="primary_teeth_2" name="arch_expansion_primary_teeth">
								<label for="primary_teeth_2" style="padding-left:20px;width:100px">2~4mm</label>
							</div>
							<div class="horizontal_input">
								<input class="" type="radio" id="primary_teeth_3" <? if($clinic_settings['arch_expansion_primary_teeth'] == "primary_teeth_3" || $clinic_settings['arch_expansion_primary_teeth'] == null) echo "checked"?> value="primary_teeth_3" name="arch_expansion_primary_teeth">
								<label for="primary_teeth_3" class="clinical_basic" style="padding-left:20px;width:100px">4~6mm</label>
							</div>
							<div style="margin-top:20px">
								<input class="" type="radio" id="primary_teeth_4" <? if($clinic_settings['arch_expansion_primary_teeth'] == "primary_teeth_4" ) echo "checked"?>  value="primary_teeth_4" name="arch_expansion_primary_teeth">
								<label for="primary_teeth_4" style="padding-left:20px;width:100px">6~8mm</label>
								<input class="" type="radio" id="primary_teeth_5" <? if($clinic_settings['arch_expansion_primary_teeth'] == "primary_teeth_5" ) echo "checked"?> value="primary_teeth_5" name="arch_expansion_primary_teeth">
								<label for="primary_teeth_5" style="padding-left:20px;width:100px">＞8mm</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="button_menu" style="position:unset;transform:none;margin:0 auto;">
		<a href="javascript:updateInfo();" class="btn_blue hover190">Save</a>
		<a href="javascript:closeCheck();" class="btn_black hover190">Close</a>
	</div>
    </form>
</div>
<div id="click_close_popup" style="width:100%;height:100%;position:fixed;top:0;left:0;display:none">
</div>
<script>
$(document).ready(function(){

 $('input[name=virtual_teeth]').click(function(e){
     if ($(this).is(':checked') && this.id == "choose_one") {
         
          $('#extraction_cases').prop("disabled",false);
          $('#posterior_teeth').prop("disabled",false);
         
     }else{
         $('#extraction_cases').prop("disabled",true);
          $('#posterior_teeth').prop("disabled",true);
           $('#extraction_cases').prop("checked",false);
          $('#posterior_teeth').prop("checked",false);
          
     }
      });


       $('input[name=maxillary_tooth_alignment]').click(function(e){
     if (this.id == "based_gingival") {
         
          $('input[name=based_gingival]').prop("disabled",false);
             $('#Arrange_the_lateral').prop("checked",true);
         // $('#posterior_teeth').prop("disabled",false);
         
     }else{
        $('input[name=based_gingival]').prop("disabled",true);
         $('input[name=based_gingival]').prop("checked",false);
          
     }
      });



    });

function updateInfo(){
    
    var formData = $("#clinic_setting_form").serialize();
    $.ajax({
        cache: false,
        url: "../../viewmodels/clinicSettingUpdate.php",
        type: 'POST',
        data: formData,
        dataType: 'html',
        success: function (data) {
            //alert(data);
            if (data == "true") {
                alert("Save is complete.")
                window.close();
            } else {
                alert('false');
                window.close();
            }
        }, // success
        error: function (xhr, status) {
            alert(xhr + " : " + status);
        }
    });


}

function closeCheck(){
    
    var formData = $("#clinic_setting_form").serialize();
    $.ajax({
        cache: false,
        url: "../../viewmodels/clinicSettingClose.php",
        type: 'POST',
        data: formData,
        dataType: 'html',
        success: function (data) {
            //alert(data);
            if (data == "true") {
                window.close();
            } else {
                if (confirm("There is changed information. Do you want to end it?")) {
                      window.close();
                }
            }
        }, // success
        error: function (xhr, status) {
            alert(xhr + " : " + status);
        }
    });


}

$('#clinical_1').click(function () {
        $('#clinical_1_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_2').click(function () {
        $('#clinical_2_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_3').click(function () {
        $('#clinical_3_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_4').click(function () {
        $('#clinical_4_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_5').click(function () {
        $('#clinical_5_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_6').click(function () {
        $('#clinical_6_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_7').click(function () {
        $('#clinical_7_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_8').click(function () {
        $('#clinical_8_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_9').click(function () {
        $('#clinical_9_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_10').click(function () {
        $('#clinical_10_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_11').click(function () {
        $('#clinical_11_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#clinical_12').click(function () {
        $('#clinical_12_text').css("display",'block');
		$('#click_close_popup').css("display",'block');
        });
$('#click_close_popup').click(function () {
        $('.clinical_popup').css("display",'none');
		$('#click_close_popup').css("display",'none');
        });

</script>
<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>
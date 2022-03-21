<? 
$update_data = $_SESSION['update_data']; 
$progress_num = $_SESSION['progress_num'];
if(!isset($_SESSION['update_data'])){
	/*
	//  <ul>
	// 		<li <?php if ($service==1) echo " id=\"tab_select\""; ?> ><a id="01_select"  name="service_tab"  <? if (1<=$progress_num) {echo "href='javascript:serviceSubmit(\"01_select.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?> >서비스 선택</a></li>
	// 		<li <?php if ($service==2) echo " id=\"tab_select\""; ?> ><a id="02_patientinfo"  name="service_tab"  <? if (2<=$progress_num) {echo "href='javascript:serviceSubmit(\"02_patientinfo.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?>>환자 정보 입력</a></li>
	// 		<li <?php if ($service==3) echo " id=\"tab_select\""; ?> ><a id="03_modeltype"  name="service_tab"  <? if (3<=$progress_num) {echo "href='javascript:serviceSubmit(\"03_modeltype.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?> >모델 타입</a></li>
	// 		<li <?php if ($service==4) echo " id=\"tab_select\""; ?> ><a id="04_picture"  name="service_tab"  <? if (4<=$progress_num) {echo "href='javascript:serviceSubmit(\"04_picture.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?> >사진</a></li>
	// 		<li <?php if ($service==5) echo " id=\"tab_select\""; ?> ><a id="05_radiograph"  name="service_tab"  <? if (5<=$progress_num) {echo "href='javascript:serviceSubmit(\"05_radiograph.php\");'"; }else{echo "href='javascript:void(0);'"; } ?> >방사선 사진</a></li>
	// 		<li <?php if ($service==6) echo " id=\"tab_select\""; ?> ><a id="06_bracket"  name="service_tab"  <? if (6<=$progress_num) {echo "href='javascript:serviceSubmit(\"06_bracket.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?> >처방전[브라켓]</a></li>
	// 		<li <?php if ($service==7) echo " id=\"tab_select\""; ?> ><a id="07_setup1"  name="service_tab"  <? if (7<=$progress_num) {echo "href='javascript:serviceSubmit(\"07_setup1.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?> >처방전[셋업1]</a></li>
	// 		<li <?php if ($service==8) echo " id=\"tab_select\""; ?> ><a id="08_setup2"  name="service_tab"  <? if (8<=$progress_num) {echo "href='javascript:serviceSubmit(\"08_setup2.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?> >처방전[셋업2]</a></li>
	// 		<li <?php if ($service==9) echo " id=\"tab_select\""; ?> ><a id="09_result"  name="service_tab"  <? if (9<=$progress_num) {echo "href='javascript:serviceSubmit(\"09_result.php\");'"; }else{echo "href='javascript:void(0);' disabled"; } ?> >서비스 신청 요약</a></li>
	// 	</ul>*/ 
?>
<div class="service_tab">
		<ul>
			<li <?php if ($service==1) echo " id=\"tab_select\""; ?> ><a id="01_treatment_option1"  name="service_tab" href='javascript:void(0);' <? if (1<=$progress_num){echo " class=\"tab_on hover170\"";}else{echo "disabled"; } ?> style="width:170px;">Adult/Child</a></li>
			<li <?php if ($service==2) echo " id=\"tab_select\""; ?> ><a id="02_treatment_option2"  name="service_tab" href='javascript:void(0);' <? if (2<=$progress_num){echo " class=\"tab_on hover180\"";}else{echo "disabled"; } ?> style="width:180px;">Aligner step</a></li>
			<li <?php if ($service==3) echo " id=\"tab_select\""; ?> ><a id="03_patientinfo"  name="service_tab" href='javascript:void(0);' <? if (3<=$progress_num){echo " class=\"tab_on hover180\"";}else{echo "disabled"; } ?> style="width:180px;">Patient information</a></li>
			<li <?php if ($service==4) echo " id=\"tab_select\""; ?> ><a id="04_classification"  name="service_tab" href='javascript:void(0);' <? if (4<=$progress_num){echo " class=\"tab_on hover130\"";}else{echo "disabled"; } ?> style="width:130px;">Classification</a></li>
			<li <?php if ($service==5) echo " id=\"tab_select\""; ?> ><a id="05_modeltype"  name="service_tab" href='javascript:void(0);' <? if (5<=$progress_num){echo " class=\"tab_on hover130\"";}else{echo "disabled"; } ?> style="width:130px;">Model type</a></li>
			<li <?php if ($service==6) echo " id=\"tab_select\""; ?> ><a id="06_photo"  name="service_tab" href='javascript:void(0);' <? if (6<=$progress_num){echo " class=\"tab_on hover130\"";}else{echo "disabled"; } ?> style="width:130px;">Photo</a></li>
			<li <?php if ($service==7) echo " id=\"tab_select\""; ?> ><a id="07_radiograph" name="service_tab" href='javascript:void(0);' <? if (7<=$progress_num){echo " class=\"tab_on hover170\"";}else{echo "disabled"; } ?> style="width:170px;">X-ray image</a></li>
			<li <?php if ($service==8) echo " id=\"tab_select\""; ?> ><a id="08_setup1"  name="service_tab" href='javascript:void(0);' <? if (8<=$progress_num){echo " class=\"tab_on hover40\"";}else{echo "disabled"; } ?> style="width:40px;">1</a></li>
			<li <?php if ($service==9) echo " id=\"tab_select\""; ?> ><a id="09_setup2"  name="service_tab" href='javascript:void(0);' <? if (9<=$progress_num){echo " class=\"tab_on hover40\"";}else{echo "disabled"; } ?> style="width:40px;">2</a></li>
			<li <?php if ($service==10) echo " id=\"tab_select\""; ?> ><a id="10_setup3"  name="service_tab" href='javascript:void(0);' <? if (10<=$progress_num){echo " class=\"tab_on hover40\"";}else{echo "disabled"; } ?> style="width:40px;">3</a></li>
			<li <?php if ($service==11) echo " id=\"tab_select\""; ?> ><a id="11_setup4"  name="service_tab" href='javascript:void(0);' <? if (11<=$progress_num){echo " class=\"tab_on hover40\"";}else{echo "disabled"; } ?> style="width:40px;">4</a></li>
			<li <?php if ($service==12) echo " id=\"tab_select\""; ?> ><a id="12_setup5"  name="service_tab" href='javascript:void(0);' <? if (12<=$progress_num){echo " class=\"tab_on hover40\"";}else{echo "disabled"; } ?> style="width:40px;">5</a></li>
			<li <?php if ($service==13) echo " id=\"tab_select\""; ?> ><a id="13_summary"  name="service_tab" href='javascript:void(0);' <? if (13<=$progress_num){echo " class=\"tab_on hover140\"";}else{echo "disabled"; } ?> style="width:140px;">Summary</a></li>
		</ul>
		
		
	</div>
	<script>
		$(document).ready(function(){
			$('a[name=service_tab]').click(function(e){
				if(!$(e.target).is("[disabled]")){
                    var thisUrl = window.location.href;
                    if (thisUrl.indexOf("03_modeltype.php") != -1) {
                        modelUploadFiles();
                    }else if (thisUrl.indexOf("04_picture.php") != -1) {
                        picUploadFiles();
                    }else if (thisUrl.indexOf("05_radiograph.php") != -1) {
                        xrayUploadFiles();
                    }
					$("#service_info_form").append("<input type='hidden' name='targetUrl' value='"+e.target.id+".php' />");
					$("#service_info_form").append("<input type='submit' id='tab_click' style='display:none;' />");
					$("#tab_click").click();
				}
			});
			
		});
	</script>
	<? }else{ ?>

<div class="service_tab">
		<ul>
			<li <?php if ($service==1) echo " id=\"tab_select\""; ?> ><a id="01_treatment_option1"  name="service_tab" href='javascript:void(0);' class="tab_on hover170" style="width:170px;">Adult/Child</a></li>
			<li <?php if ($service==2) echo " id=\"tab_select\""; ?> ><a id="02_treatment_option2"  name="service_tab" href='javascript:void(0);' class="tab_on hover180" style="width:180px;">Aligner step</a></li>
			<li <?php if ($service==3) echo " id=\"tab_select\""; ?> ><a id="03_patientinfo"  name="service_tab" href='javascript:void(0);' class="tab_on hover180" style="width:180px;">Patient information</a></li>
			<li <?php if ($service==4) echo " id=\"tab_select\""; ?> ><a id="04_classification"  name="service_tab" href='javascript:void(0);' class="tab_on hover130" style="width:130px;">Classification</a></li>
			<li <?php if ($service==5) echo " id=\"tab_select\""; ?> ><a id="05_modeltype"  name="service_tab" href='javascript:void(0);' class="tab_on hover130" style="width:130px;">Model type</a></li>
			<li <?php if ($service==6) echo " id=\"tab_select\""; ?> ><a id="06_photo"  name="service_tab" href='javascript:void(0);' class="tab_on hover130" style="width:130px;">Photo</a></li>
			<li <?php if ($service==7) echo " id=\"tab_select\""; ?> ><a id="07_radiograph"  name="service_tab"  href='javascript:void(0);' class="tab_on hover170" style="width:170px;">X-ray image</a></li>
			<li <?php if ($service==8) echo " id=\"tab_select\""; ?> ><a id="08_setup1"  name="service_tab" href='javascript:void(0);' class="tab_on hover40" style="width:40px;">1</a></li>
			<li <?php if ($service==9) echo " id=\"tab_select\""; ?> ><a id="09_setup2"  name="service_tab" href='javascript:void(0);' class="tab_on hover40" style="width:40px;">2</a></li>
			<li <?php if ($service==10) echo " id=\"tab_select\""; ?> ><a id="10_setup3"  name="service_tab" href='javascript:void(0);' class="tab_on hover40" style="width:40px;">3</a></li>
			<li <?php if ($service==11) echo " id=\"tab_select\""; ?> ><a id="11_setup4"  name="service_tab" href='javascript:void(0);' class="tab_on hover40" style="width:40px;">4</a></li>
			<li <?php if ($service==12) echo " id=\"tab_select\""; ?> ><a id="12_setup5"  name="service_tab" href='javascript:void(0);' class="tab_on hover40" style="width:40px;">5</a></li>
			<li <?php if ($service==13) echo " id=\"tab_select\""; ?> ><a id="13_summary"  name="service_tab" href='javascript:void(0);' class="tab_on hover140" style="width:140px;">Summary</a></li>
		</ul>
	</div>
	<script>
	$(document).ready(function(){
			$('a[name=service_tab]').click(function(e){
					if(!$(e.target).is("[disabled]")){
                    var thisUrl = window.location.href;
                    if (thisUrl.indexOf("03_modeltype.php") != -1) {
                        modelUploadFiles();
                    }else if (thisUrl.indexOf("04_picture.php") != -1) {
                        picUploadFiles();
                    }else if (thisUrl.indexOf("05_radiograph.php") != -1) {
                        xrayUploadFiles();
                    }
					$("#service_info_form").append("<input type='hidden' name='targetUrl' value='"+e.target.id+".php' />");
					$("#service_info_form").append("<input type='submit' id='tab_click' style='display:none;' />");
					$("#tab_click").click();
				}
			});
			
		});
	</script>


	<? }?>
<? 
$update_data = $_SESSION['update_data']; 
$progress_num = $_SESSION['progress_num'];

?>
<div class="service_tab">


		<ul>
			<li <?php if ($service==1) echo " id=\"tab_select\""; ?> >
				<a id="01_treatment_option1"  name="service_tab" href='javascript:void(0);'
				<? if ($service==1&&$progress_num>1){
					echo "class=\"tab_on\"";
					}elseif(1<=$progress_num){
						echo "class=\"tab_on hover170\"";
					}
					else{echo "disabled"; } ?>
					style="width:170px;"> Adult/Child</a>
			</li>
			<li <?php if ($service==2) echo " id=\"tab_select\""; ?> >
				<a id="02_treatment_option2"  name="service_tab" href='javascript:void(0);'
				<? if ($service==2&&$progress_num>2){
					echo "class=\"tab_on\"";
					}elseif(2<=$progress_num){
						echo "class=\"tab_on hover170\"";
					}
					else{echo "disabled"; } ?>
					style="width:170px;"> Aligner step</a>
			</li>
			<li <?php if ($service==3) echo " id=\"tab_select\""; ?> >
				<a id="03_patientinfo"  name="service_tab" href='javascript:void(0);'
				<? if ($service==3&&$progress_num>=3){
					echo "class=\"tab_on\"";
					}elseif(3<=$progress_num){
						echo "class=\"tab_on hover180\"";
					}
					else{echo "disabled"; } ?>
					style="width:180px;"> Patient information</a>
			</li>
			<li <?php if ($service==4) echo " id=\"tab_select\""; ?> >
				<a id="04_classification"  name="service_tab" href='javascript:void(0);'
				<? if ($service==4&&$progress_num>=4){
					echo "class=\"tab_on\"";
					}elseif(4<=$progress_num){
						echo "class=\"tab_on hover130\"";
					}
					else{echo "disabled"; } ?>
					style="width:130px;"> Classification</a>
			</li>
			<li <?php if ($service==5) echo " id=\"tab_select\""; ?> >
				<a id="05_modeltype"  name="service_tab" href='javascript:void(0);'
				<? if ($service==5&&$progress_num>=5){
					echo "class=\"tab_on\"";
					}elseif(5<=$progress_num){
						echo "class=\"tab_on hover130\"";
					}
					else{echo "disabled"; } ?>
					style="width:130px;"> Model type</a>
			</li>
			<li <?php if ($service==6) echo " id=\"tab_select\""; ?> >
				<a id="06_photo"  name="service_tab" href='javascript:void(0);'
				<? if ($service==6&&$progress_num>=6){
					echo "class=\"tab_on\"";
					}elseif(6<=$progress_num){
						echo "class=\"tab_on hover130\"";
					}
					else{echo "disabled"; } ?>
					style="width:130px;"> Photo</a>
			</li>
			<li <?php if ($service==7) echo " id=\"tab_select\""; ?> >
				<a id="07_radiograph"  name="service_tab" href='javascript:void(0);'
				<? if ($service==7&&$progress_num>=7){
					echo "class=\"tab_on\"";
					}elseif(7<=$progress_num){
						echo "class=\"tab_on hover170\"";
					}
					else{echo "disabled"; } ?>
					style="width:170px;"> X-ray image</a>
			</li>
			<li <?php if ($service==8) echo " id=\"tab_select\""; ?> >
				<a id="08_setup1"  name="service_tab" href='javascript:void(0);'
				<? if ($service==8&&$progress_num>=8){
					echo "class=\"tab_on\"";
					}elseif(8<=$progress_num){
						echo "class=\"tab_on hover40\"";
					}
					else{echo "disabled"; } ?>
					style="width:40px;"> 1</a>
			</li>
			<li <?php if ($service==9) echo " id=\"tab_select\""; ?> >
				<a id="09_setup2"  name="service_tab" href='javascript:void(0);'
				<? if ($service==9&&$progress_num>=9){
					echo "class=\"tab_on\"";
					}elseif(9<=$progress_num){
						echo "class=\"tab_on hover40\"";
					}
					else{echo "disabled"; } ?>
					style="width:40px;"> 2</a>
			</li>
			<li <?php if ($service==10) echo " id=\"tab_select\""; ?> >
				<a id="10_setup3"  name="service_tab" href='javascript:void(0);'
				<? if ($service==10&&$progress_num>=10){
					echo "class=\"tab_on\"";
					}elseif(10<=$progress_num){
						echo "class=\"tab_on hover40\"";
					}
					else{echo "disabled"; } ?>
					style="width:40px;"> 3</a>
			</li>
			<li <?php if ($service==11) echo " id=\"tab_select\""; ?> >
				<a id="13_summary"  name="service_tab" href='javascript:void(0);'
				<? if ($service==11&&$progress_num>=11){
					echo "class=\"tab_on\"";
					}elseif(11<=$progress_num){
						echo "class=\"tab_on hover140\"";
					}
					else{echo "disabled"; } ?>
					style="width:140px;"> Summary</a>
			</li>

			
		
		
	</div>
	<script>
		$(document).ready(function(){
			$('a[name=service_tab]').click(function(e){
				if(!$(e.target).is("[disabled]")){
                    var thisUrl = window.location.href;
                    if (thisUrl.indexOf("05_modeltype.php") != -1) {
                        modelUploadFiles();
                    }else if (thisUrl.indexOf("06_photo.php") != -1) {
                        picUploadFiles();
                    }else if (thisUrl.indexOf("07_radiograph.php") != -1) {
                        xrayUploadFiles();
                    }
					$("#service_info_form").append("<input type='hidden' name='targetUrl' value='"+e.target.id+".php' />");
					$("#service_info_form").append("<input type='submit' id='tab_click' style='display:none;' />");
					$("#tab_click").click();
				}
			});
			
		});
	</script>
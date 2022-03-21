<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
include '../../../models/modelsVariable_global.php';
include '../../../models/service_decode.php';
$service = 11;
//ini_set("display_errors","1");

service_json($_SESSION['patient_key'], $_SESSION['service_key']);

            if ($patient_st != 1) {
                $st_value =  21;
            }else{
                $st_value =  20;
            }

$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'diagnostics_16' => 16 ,
            'diagnostics_15' => 15 ,
            'diagnostics_14' => 14 ,
            'diagnostics_13' => 13 ,
            'diagnostics_12' => 12 ,
            'diagnostics_11' => 11 ,
            
            'diagnostics_46' => 46 ,
            'diagnostics_45' => 45 ,
            'diagnostics_44' => 44 ,
            'diagnostics_43' => 43 ,
            'diagnostics_42' => 42 ,
            'diagnostics_41' => 41 ,

            'diagnostics_21' => 21 ,
            'diagnostics_22' => 22 ,
            'diagnostics_23' => 23 ,
            'diagnostics_24' => 24 ,
            'diagnostics_25' => 25 ,
            'diagnostics_26' => 26 ,

            'diagnostics_31' => 31 ,
            'diagnostics_32' => 32 ,
            'diagnostics_33' => 33 ,
            'diagnostics_34' => 34 ,
            'diagnostics_35' => 35 ,
            'diagnostics_36' => 36 ,


            'diagnostics_51' => 51 ,
            'diagnostics_52' => 52 ,
            'diagnostics_53' => 53 ,
            'diagnostics_54' => 54 ,
            'diagnostics_55' => 55 ,

            'diagnostics_61' => 61 ,
            'diagnostics_62' => 62 ,
            'diagnostics_63' => 63 ,
            'diagnostics_64' => 64 ,
            'diagnostics_65' => 65 ,

            'diagnostics_71' => 71 ,
            'diagnostics_72' => 72 ,
            'diagnostics_73' => 73 ,
            'diagnostics_74' => 74 ,
            'diagnostics_75' => 75 ,

            'diagnostics_81' => 81 ,
            'diagnostics_82' => 82 ,
            'diagnostics_83' => 83 ,
            'diagnostics_84' => 84 ,
            'diagnostics_85' => 85 ,


            'attchment_16' => 16 ,
            'attchment_15' => 15 ,
            'attchment_14' => 14 ,
            'attchment_13' => 13 ,
            'attchment_12' => 12 ,
            'attchment_11' => 11 ,
            
            'attchment_46' => 46 ,
            'attchment_45' => 45 ,
            'attchment_44' => 44 ,
            'attchment_43' => 43 ,
            'attchment_42' => 42 ,
            'attchment_41' => 41 ,

            'attchment_21' => 21 ,
            'attchment_22' => 22 ,
            'attchment_23' => 23 ,
            'attchment_24' => 24 ,
            'attchment_25' => 25 ,
            'attchment_26' => 26 ,

            'attchment_31' => 31 ,
            'attchment_32' => 32 ,
            'attchment_33' => 33 ,
            'attchment_34' => 34 ,
            'attchment_35' => 35 ,
            'attchment_36' => 36 ,


            'attchment_51' => 51 ,
            'attchment_52' => 52 ,
            'attchment_53' => 53 ,
            'attchment_54' => 54 ,
            'attchment_55' => 55 ,

            'attchment_61' => 61 ,
            'attchment_62' => 62 ,
            'attchment_63' => 63 ,
            'attchment_64' => 64 ,
            'attchment_65' => 65 ,

            'attchment_71' => 71 ,
            'attchment_72' => 72 ,
            'attchment_73' => 73 ,
            'attchment_74' => 74 ,
            'attchment_75' => 75 ,

            'attchment_81' => 81 ,
            'attchment_82' => 82 ,
            'attchment_83' => 83 ,
            'attchment_84' => 84 ,
            'attchment_85' => 85 ,



            'extraction_16' => 16 ,
            'extraction_15' => 15 ,
            'extraction_14' => 14 ,
            'extraction_13' => 13 ,
            'extraction_12' => 12 ,
            'extraction_11' => 11 ,
            
            'extraction_46' => 46 ,
            'extraction_45' => 45 ,
            'extraction_44' => 44 ,
            'extraction_43' => 43 ,
            'extraction_42' => 42 ,
            'extraction_41' => 41 ,

            'extraction_21' => 21 ,
            'extraction_22' => 22 ,
            'extraction_23' => 23 ,
            'extraction_24' => 24 ,
            'extraction_25' => 25 ,
            'extraction_26' => 26 ,

            'extraction_31' => 31 ,
            'extraction_32' => 32 ,
            'extraction_33' => 33 ,
            'extraction_34' => 34 ,
            'extraction_35' => 35 ,
            'extraction_36' => 36 ,


            'extraction_51' => 51 ,
            'extraction_52' => 52 ,
            'extraction_53' => 53 ,
            'extraction_54' => 54 ,
            'extraction_55' => 55 ,

            'extraction_61' => 61 ,
            'extraction_62' => 62 ,
            'extraction_63' => 63 ,
            'extraction_64' => 64 ,
            'extraction_65' => 65 ,

            'extraction_71' => 71 ,
            'extraction_72' => 72 ,
            'extraction_73' => 73 ,
            'extraction_74' => 74 ,
            'extraction_75' => 75 ,

            'extraction_81' => 81 ,
            'extraction_82' => 82 ,
            'extraction_83' => 83 ,
            'extraction_84' => 84 ,
            'extraction_85' => 85 ,
            
        );
        break;
    case 'palmer':
        $numberArray = array(
            'diagnostics_16' => 6 ,
            'diagnostics_15' => 5 ,
            'diagnostics_14' => 4 ,
            'diagnostics_13' => 3 ,
            'diagnostics_12' => 2 ,
            'diagnostics_11' => 1 ,
            
            'diagnostics_46' => 6 ,
            'diagnostics_45' => 5 ,
            'diagnostics_44' => 4 ,
            'diagnostics_43' => 3 ,
            'diagnostics_42' => 2 ,
            'diagnostics_41' => 1 ,

            'diagnostics_21' => 1 ,
            'diagnostics_22' => 2 ,
            'diagnostics_23' => 3 ,
            'diagnostics_24' => 4 ,
            'diagnostics_25' => 5 ,
            'diagnostics_26' => 6 ,

            'diagnostics_31' => 1 ,
            'diagnostics_32' => 2 ,
            'diagnostics_33' => 3 ,
            'diagnostics_34' => 4 ,
            'diagnostics_35' => 5 ,
            'diagnostics_36' => 6 ,

            

            'diagnostics_51' => "A" ,
            'diagnostics_52' => "B" ,
            'diagnostics_53' => "C" ,
            'diagnostics_54' => "D" ,
            'diagnostics_55' => "E" ,

            'diagnostics_61' => "A" ,
            'diagnostics_62' => "B" ,
            'diagnostics_63' => "C" ,
            'diagnostics_64' => "D" ,
            'diagnostics_65' => "E" ,

            'diagnostics_71' => "A" ,
            'diagnostics_72' => "B" ,
            'diagnostics_73' => "C" ,
            'diagnostics_74' => "D" ,
            'diagnostics_75' => "E" ,

            'diagnostics_81' => "A" ,
            'diagnostics_82' => "B" ,
            'diagnostics_83' => "C" ,
            'diagnostics_84' => "D" ,
            'diagnostics_85' => "E" ,

            'attchment_16' => 6 ,
            'attchment_15' => 5 ,
            'attchment_14' => 4 ,
            'attchment_13' => 3 ,
            'attchment_12' => 2 ,
            'attchment_11' => 1 ,
            
            'attchment_46' => 6 ,
            'attchment_45' => 5 ,
            'attchment_44' => 4 ,
            'attchment_43' => 3 ,
            'attchment_42' => 2 ,
            'attchment_41' => 1 ,

            'attchment_21' => 1 ,
            'attchment_22' => 2 ,
            'attchment_23' => 3 ,
            'attchment_24' => 4 ,
            'attchment_25' => 5 ,
            'attchment_26' => 6 ,

            'attchment_31' => 1 ,
            'attchment_32' => 2 ,
            'attchment_33' => 3 ,
            'attchment_34' => 4 ,
            'attchment_35' => 5 ,
            'attchment_36' => 6 ,

            

            'attchment_51' => "A" ,
            'attchment_52' => "B" ,
            'attchment_53' => "C" ,
            'attchment_54' => "D" ,
            'attchment_55' => "E" ,

            'attchment_61' => "A" ,
            'attchment_62' => "B" ,
            'attchment_63' => "C" ,
            'attchment_64' => "D" ,
            'attchment_65' => "E" ,

            'attchment_71' => "A" ,
            'attchment_72' => "B" ,
            'attchment_73' => "C" ,
            'attchment_74' => "D" ,
            'attchment_75' => "E" ,

            'attchment_81' => "A" ,
            'attchment_82' => "B" ,
            'attchment_83' => "C" ,
            'attchment_84' => "D" ,
            'attchment_85' => "E" ,


            'extraction_16' => 6 ,
            'extraction_15' => 5 ,
            'extraction_14' => 4 ,
            'extraction_13' => 3 ,
            'extraction_12' => 2 ,
            'extraction_11' => 1 ,
            
            'extraction_46' => 6 ,
            'extraction_45' => 5 ,
            'extraction_44' => 4 ,
            'extraction_43' => 3 ,
            'extraction_42' => 2 ,
            'extraction_41' => 1 ,

            'extraction_21' => 1 ,
            'extraction_22' => 2 ,
            'extraction_23' => 3 ,
            'extraction_24' => 4 ,
            'extraction_25' => 5 ,
            'extraction_26' => 6 ,

            'extraction_31' => 1 ,
            'extraction_32' => 2 ,
            'extraction_33' => 3 ,
            'extraction_34' => 4 ,
            'extraction_35' => 5 ,
            'extraction_36' => 6 ,

            

            'extraction_51' => "A" ,
            'extraction_52' => "B" ,
            'extraction_53' => "C" ,
            'extraction_54' => "D" ,
            'extraction_55' => "E" ,

            'extraction_61' => "A" ,
            'extraction_62' => "B" ,
            'extraction_63' => "C" ,
            'extraction_64' => "D" ,
            'extraction_65' => "E" ,

            'extraction_71' => "A" ,
            'extraction_72' => "B" ,
            'extraction_73' => "C" ,
            'extraction_74' => "D" ,
            'extraction_75' => "E" ,

            'extraction_81' => "A" ,
            'extraction_82' => "B" ,
            'extraction_83' => "C" ,
            'extraction_84' => "D" ,
            'extraction_85' => "E" ,
            
        );
        break;
    case 'universal':
        $numberArray = array(
            'diagnostics_16' => 1 ,
            'diagnostics_15' => 2 ,
            'diagnostics_14' => 3 ,
            'diagnostics_13' => 4 ,
            'diagnostics_12' => 5 ,
            'diagnostics_11' => 6 ,
            
            'diagnostics_46' => 24 ,
            'diagnostics_45' => 23 ,
            'diagnostics_44' => 22 ,
            'diagnostics_43' => 21 ,
            'diagnostics_42' => 20 ,
            'diagnostics_41' => 19 ,

            'diagnostics_21' => 7 ,
            'diagnostics_22' => 8 ,
            'diagnostics_23' => 9 ,
            'diagnostics_24' => 10 ,
            'diagnostics_25' => 11 ,
            'diagnostics_26' => 12 ,

            'diagnostics_31' => 18 ,
            'diagnostics_32' => 17 ,
            'diagnostics_33' => 16 ,
            'diagnostics_34' => 15 ,
            'diagnostics_35' => 14 ,
            'diagnostics_36' => 13 ,


            'diagnostics_51' => "E" ,
            'diagnostics_52' => "D" ,
            'diagnostics_53' => "C" ,
            'diagnostics_54' => "B" ,
            'diagnostics_55' => "A" ,

            'diagnostics_61' => "F" ,
            'diagnostics_62' => "G" ,
            'diagnostics_63' => "H" ,
            'diagnostics_64' => "I" ,
            'diagnostics_65' => "J" ,

            'diagnostics_71' => "O" ,
            'diagnostics_72' => "N" ,
            'diagnostics_73' => "M" ,
            'diagnostics_74' => "L" ,
            'diagnostics_75' => "K" ,

            'diagnostics_81' => "P" ,
            'diagnostics_82' => "Q" ,
            'diagnostics_83' => "R" ,
            'diagnostics_84' => "S" ,
            'diagnostics_85' => "T" ,

            'attchment_16' => 1 ,
            'attchment_15' => 2 ,
            'attchment_14' => 3 ,
            'attchment_13' => 4 ,
            'attchment_12' => 5 ,
            'attchment_11' => 6 ,
            
            'attchment_46' => 24 ,
            'attchment_45' => 23 ,
            'attchment_44' => 22 ,
            'attchment_43' => 21 ,
            'attchment_42' => 20 ,
            'attchment_41' => 19 ,

            'attchment_21' => 7 ,
            'attchment_22' => 8 ,
            'attchment_23' => 9 ,
            'attchment_24' => 10 ,
            'attchment_25' => 11 ,
            'attchment_26' => 12 ,

            'attchment_31' => 18 ,
            'attchment_32' => 17 ,
            'attchment_33' => 16 ,
            'attchment_34' => 15 ,
            'attchment_35' => 14 ,
            'attchment_36' => 13 ,


            'attchment_51' => "E" ,
            'attchment_52' => "D" ,
            'attchment_53' => "C" ,
            'attchment_54' => "B" ,
            'attchment_55' => "A" ,

            'attchment_61' => "F" ,
            'attchment_62' => "G" ,
            'attchment_63' => "H" ,
            'attchment_64' => "I" ,
            'attchment_65' => "J" ,

            'attchment_71' => "O" ,
            'attchment_72' => "N" ,
            'attchment_73' => "M" ,
            'attchment_74' => "L" ,
            'attchment_75' => "K" ,

            'attchment_81' => "P" ,
            'attchment_82' => "Q" ,
            'attchment_83' => "R" ,
            'attchment_84' => "S" ,
            'attchment_85' => "T" ,


            'extraction_16' => 1 ,
            'extraction_15' => 2 ,
            'extraction_14' => 3 ,
            'extraction_13' => 4 ,
            'extraction_12' => 5 ,
            'extraction_11' => 6 ,
            
            'extraction_46' => 24 ,
            'extraction_45' => 23 ,
            'extraction_44' => 22 ,
            'extraction_43' => 21 ,
            'extraction_42' => 20 ,
            'extraction_41' => 19 ,

            'extraction_21' => 7 ,
            'extraction_22' => 8 ,
            'extraction_23' => 9 ,
            'extraction_24' => 10 ,
            'extraction_25' => 11 ,
            'extraction_26' => 12 ,

            'extraction_31' => 18 ,
            'extraction_32' => 17 ,
            'extraction_33' => 16 ,
            'extraction_34' => 15 ,
            'extraction_35' => 14 ,
            'extraction_36' => 13 ,


            'extraction_51' => "E" ,
            'extraction_52' => "D" ,
            'extraction_53' => "C" ,
            'extraction_54' => "B" ,
            'extraction_55' => "A" ,

            'extraction_61' => "F" ,
            'extraction_62' => "G" ,
            'extraction_63' => "H" ,
            'extraction_64' => "I" ,
            'extraction_65' => "J" ,

            'extraction_71' => "O" ,
            'extraction_72' => "N" ,
            'extraction_73' => "M" ,
            'extraction_74' => "L" ,
            'extraction_75' => "K" ,

            'extraction_81' => "P" ,
            'extraction_82' => "Q" ,
            'extraction_83' => "R" ,
            'extraction_84' => "S" ,
            'extraction_85' => "T" ,



            
        );
        break;    
}

?>

<div class="content" style="background-color:#fff;height:100%;margin-bottom:55px;">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/child/service_tab.php");
	?>
    <form id="service_info_form" name="service_info_form" action="service_info.php" method="POST">
	<div class="result_inner">
	<!-- Treatment option1 Start -->
		<div id="result_modeltype" class="result_box">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Adult/Child</p>
				<!-- <a href="/views/service/01_treatment_option1.php">Edit</a> -->
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
				<!-- <a href="/views/service/child/02_treatment_option2.php">Edit</a> -->
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
				<!-- <a href="/views/service/child/03_patientinfo.php">Edit</a> -->
			</div>
			<div class="result_content" style="padding:60px 0;">
				<div style="width:80%;margin:0 auto">
					<div class="patient_left" style="float:left;border:none">
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Patient ID</p>
							<span>:</span>
							<p style="white-space: pre-wrap; width: 220px; vertical-align: middle;"><?echo $_SESSION['patient_id']?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">First name</p>
							<span>:</span>
							<p class="result_patient_content" style="white-space: pre-wrap; width: 220px; vertical-align: middle;"><?echo $_SESSION['first_name']?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Last name</p>
							<span>:</span>
							<p class="result_patient_content" style="white-space: pre-wrap; width: 220px; vertical-align: middle;"><?echo $_SESSION['last_name']?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Gender</p>
							<span>:</span>
							<p class="result_patient_content"><?if ($_SESSION['patient_sex']=="male"){echo "Male"; }else{echo "Female";}?></p>
						</div>
						<div class="patient">
							<p class="result_patient_title">Race</p>
							<span>:</span>
							<p class="result_patient_content"><?echo ucfirst($_SESSION['patient_ethinicity']); ?></p>
						</div>
					</div>
					<div class="patient_right" style="float: right;border-left:1px solid #d2d2d2">
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
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Lab</p>
							<span>:</span>
							<p class="result_patient_content"><? $lab_explode = explode( ',', $_SESSION['dental_lab'], 2 ); echo $lab_explode[1]; ?></p>
						</div>
						<div class="patient" style="margin-bottom:70px">
							<p class="result_patient_title">Delivery address</p>
							<span>:</span>
                            <p style="color:#07a2e8"><?=$_SESSION['shipping_address']['address_name']?></p>
							<p style="margin-left:187px;margin-top:10px">
							<?=$_SESSION['shipping_address']['address1'].", "
							.$_SESSION['shipping_address']['address2'].", "
							.$_SESSION['shipping_address']['address3'].", "
							.$_SESSION['shipping_address']['address4'].", "
							.$_SESSION['shipping_address']['zip_code']?>
							</p>
						</div>
						<div class="patient">
							<p class="result_patient_title">Billing address</p>
							<span>:</span>
                            <p style="color:#07a2e8"><?=$_SESSION['billing_address']['address_name']?></p>
							<p style="margin-left:187px;margin-top:10px">
							<?=$_SESSION['billing_address']['address1'].", "
							.$_SESSION['billing_address']['address2'].", "
							.$_SESSION['billing_address']['address3'].", "
							.$_SESSION['billing_address']['address4'].", "
							.$_SESSION['billing_address']['zip_code']?>
							</p>
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
				<!-- <a href="/views/service/child/04_classification.php">Edit</a> -->
			</div>
			<div class="result_content" style="padding:40px 100px">
					<div class="classification_result">
						<p class="classification_result_title">Status:</p>
						<p class="classification_result_content">
                            <?
                            // @LUCAS 1.5차
                            foreach ($_SESSION['classification'] as $key => $value) {
                                if (in_array($key, ["bite_type_na", "class_na"])) {
                                    continue;
                                }
                                if ($value == "on") {
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
                                    echo $print_value . ", ";
                                }
                            } ?>
						</p>
					</div>
					<div class="classification_result" style="margin-top:30px">
						<p class="classification_result_etc">Etc</p>
						<textarea  disabled class="classification_result_etc_box"><?if($_SESSION['classification']['etc_value'] == ""){echo "There is no content."; }else{echo $_SESSION['classification']['etc_value']; }?></textarea>
					</div>
					<div class="classification_result" style="margin-top:30px">
						<p class="classification_result_precautions">Note</p>
						<textarea disabled class="classification_result_precautions_box"><?if($_SESSION['classification']['precaution'] == ""){echo "There is no content."; }else{echo $_SESSION['classification']['precaution']; }?></textarea>
					</div>
			</div>
		</div>
	<!-- Classification End -->

	<!-- Model Type Start -->
		<div id="result_modeltype" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Model Type</p>
				<!-- <a href="/views/service/child/05_modeltype.php">Edit</a> -->
			</div>
			<div class="result_content" style="padding:40px 200px">
				<div>
					<div class="patient">
						<p class="result_patient_title">Model Type</p>
						<span style="margin-right:80px">:</span>
						<p><?if($_SESSION['model_type'] == "ScanFile"){
							$md = "ScanFile";
							if($_SESSION['maxilla_image'] != null && $_SESSION['mandible_image'] != null){
								$md = $md." : "."Maxilla, Mandible";
							}else if($_SESSION['maxilla_image'] != null){
								$md = $md." : "."Maxilla";
							}else if($_SESSION['mandible_image'] != null){
								$md = $md." : "."Mandible";
							}
							echo $md;
						}else{
						echo $_SESSION['model_type'];
						}?></p>
					</div>
				</div>
			</div>
		</div>
	<!-- Model Type End -->

	<!-- Picture Start -->
		<div id="result_picture" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Photo</p>
				<!-- <a href="/views/service/child/06_photo.php">Edit</a> -->
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
				<!-- <a href="/views/service/child/07_radiograph.php">Edit</a> -->
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
				<!-- <a href="/views/service/child/08_setup1.php">Edit</a> -->
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
					<h2>2. Please select full diagnostics<span style="color:red">*</span></h2>
					<div style="text-align:left; width: 87%;margin-left:30px">
						<div style="overflow:hidden;display:inline-block">
							<p style="text-align:left;margin-bottom:20px">(Implant, Telescopic crown, Veneered crown)</p>
							<p style="text-align:left;margin:10px 0">Please tick if the patients is a Permanent teeth</p>
							<p class="RL" style="margin-right:5px">R</p>
							<div style="overflow:hidden;display:inline-block;float:left">
							<? include("setup2_layer.php");  ?>
								<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
									<button type="button" disabled class="number" id="diagnostics_16" name="upperBrackets" ><?=$numberArray['diagnostics_16']?></button>
								<button type="button" disabled class="number" id="diagnostics_15" name="upperBrackets" ><?=$numberArray['diagnostics_15']?></button>
								<button type="button" disabled class="number" id="diagnostics_14" name="upperBrackets" ><?=$numberArray['diagnostics_14']?></button>
								<button type="button" disabled class="number" id="diagnostics_13" name="upperBrackets" ><?=$numberArray['diagnostics_13']?></button>
								<button type="button" disabled class="number" id="diagnostics_12" name="upperBrackets" ><?=$numberArray['diagnostics_12']?></button>
								<button type="button" disabled class="number" id="diagnostics_11" name="upperBrackets"  style="margin:0"><?=$numberArray['diagnostics_11']?></button>
								</div>
								<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
									<button type="button" disabled class="number" id="diagnostics_46" name="lowerBrackets" ><?=$numberArray['diagnostics_46']?></button>
								<button type="button" disabled class="number" id="diagnostics_45" name="lowerBrackets" ><?=$numberArray['diagnostics_45']?></button>
								<button type="button" disabled class="number" id="diagnostics_44" name="lowerBrackets" ><?=$numberArray['diagnostics_44']?></button>
								<button type="button" disabled class="number" id="diagnostics_43" name="lowerBrackets" ><?=$numberArray['diagnostics_43']?></button>
								<button type="button" disabled class="number" id="diagnostics_42" name="lowerBrackets" ><?=$numberArray['diagnostics_42']?></button>
								<button type="button" disabled class="number" id="diagnostics_41" name="lowerBrackets"  style="margin:0"><?=$numberArray['diagnostics_41']?></button>
								</div>
							</div>
							<div style="overflow:hidden;display:inline-block;float:left">
								<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
									<button type="button" disabled class="number" id="diagnostics_21" name="upperBrackets" ><?=$numberArray['diagnostics_21']?></button>
								<button type="button" disabled class="number" id="diagnostics_22" name="upperBrackets" ><?=$numberArray['diagnostics_22']?></button>
								<button type="button" disabled class="number" id="diagnostics_23" name="upperBrackets" ><?=$numberArray['diagnostics_23']?></button>
								<button type="button" disabled class="number" id="diagnostics_24" name="upperBrackets" ><?=$numberArray['diagnostics_24']?></button>
								<button type="button" disabled class="number" id="diagnostics_25" name="upperBrackets" ><?=$numberArray['diagnostics_25']?></button>
								<button type="button" disabled class="number" id="diagnostics_26" name="upperBrackets" ><?=$numberArray['diagnostics_26']?></button>
								</div>
								<div style="padding-top:5px;overflow:hidden;padding-left:5px">
									<button type="button" disabled class="number" id="diagnostics_31" name="lowerBrackets" ><?=$numberArray['diagnostics_31']?></button>
								<button type="button" disabled class="number" id="diagnostics_32" name="lowerBrackets" ><?=$numberArray['diagnostics_32']?></button>
								<button type="button" disabled class="number" id="diagnostics_33" name="lowerBrackets" ><?=$numberArray['diagnostics_33']?></button>
								<button type="button" disabled class="number" id="diagnostics_34" name="lowerBrackets" ><?=$numberArray['diagnostics_34']?></button>
								<button type="button" disabled class="number" id="diagnostics_35" name="lowerBrackets" ><?=$numberArray['diagnostics_35']?></button>
								<button type="button" disabled class="number" id="diagnostics_36" name="lowerBrackets" ><?=$numberArray['diagnostics_36']?></button>
								</div>
							</div>
							<p class="RL" style="margin-left:5px">L</p>
							<div style="padding-top:20px;display:inline-block">
							<p style="text-align:left;margin:10px 0">Please tick if the patient is a child</p>
							<p class="RL" style="margin-right:5px">R</p>
							<div style="overflow:hidden;display:inline-block;float:left">
								<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
							<button type="button" disabled class="number" id="diagnostics_55" name="upperBrackets" ><?=$numberArray['diagnostics_55']?></button>
							<button type="button" disabled class="number" id="diagnostics_54" name="upperBrackets" ><?=$numberArray['diagnostics_54']?></button>
							<button type="button" disabled class="number" id="diagnostics_53" name="upperBrackets" ><?=$numberArray['diagnostics_53']?></button>
							<button type="button" disabled class="number" id="diagnostics_52" name="upperBrackets" ><?=$numberArray['diagnostics_52']?></button>
							<button type="button" disabled class="number" id="diagnostics_51" name="upperBrackets"  style="margin:0"><?=$numberArray['diagnostics_51']?></button>
								</div>
								<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
									<button type="button" disabled class="number" id="diagnostics_85" name="lowerBrackets" ><?=$numberArray['diagnostics_85']?></button>
							<button type="button" disabled class="number" id="diagnostics_84" name="lowerBrackets" ><?=$numberArray['diagnostics_84']?></button>
							<button type="button" disabled class="number" id="diagnostics_83" name="lowerBrackets" ><?=$numberArray['diagnostics_83']?></button>
							<button type="button" disabled class="number" id="diagnostics_82" name="lowerBrackets" ><?=$numberArray['diagnostics_82']?></button>
							<button type="button" disabled class="number" id="diagnostics_81" name="lowerBrackets" style="margin:0"><?=$numberArray['diagnostics_81']?></button>
								</div>
							</div>
							<div style="overflow:hidden;display:inline-block;float:left">
								<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
									<button type="button" disabled class="number" id="diagnostics_61" name="upperBrackets" ><?=$numberArray['diagnostics_61']?></button>
							<button type="button" disabled class="number" id="diagnostics_62" name="upperBrackets" ><?=$numberArray['diagnostics_62']?></button>
							<button type="button" disabled class="number" id="diagnostics_63" name="upperBrackets" ><?=$numberArray['diagnostics_63']?></button>
							<button type="button" disabled class="number" id="diagnostics_64" name="upperBrackets" ><?=$numberArray['diagnostics_64']?></button>
							<button type="button" disabled class="number" id="diagnostics_65" name="upperBrackets" style="margin:0"><?=$numberArray['diagnostics_65']?></button>
								</div>
								<div style="padding-top:5px;overflow:hidden;padding-left:5px">
									<button type="button" disabled class="number" id="diagnostics_71" name="lowerBrackets" ><?=$numberArray['diagnostics_71']?></button>
							<button type="button" disabled class="number" id="diagnostics_72" name="lowerBrackets" ><?=$numberArray['diagnostics_72']?></button>
							<button type="button" disabled class="number" id="diagnostics_73" name="lowerBrackets" ><?=$numberArray['diagnostics_73']?></button>
							<button type="button" disabled class="number" id="diagnostics_74" name="lowerBrackets" ><?=$numberArray['diagnostics_74']?></button>
							<button type="button" disabled class="number" id="diagnostics_75" name="lowerBrackets" style="margin:0"><?=$numberArray['diagnostics_75']?></button>
								</div>
							</div>
							<p class="RL" style="margin-left:5px">L</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Prescription1 End -->

	<!-- Prescription2 Start -->
		<div id="result_setup1" class="result_box" style="margin-top:40px">
			<div class="title" style="overflow:hidden;">
				<p style="font-size:20px">Prescription2</p>
				<!-- <a href="/views/service/child/09_setup2.php">Edit</a> -->
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
					<div style="overflow:hidden;margin:0 0 0 30px;text-align:left;display:inline-block">
					<p style="text-align:left;margin:10px 0">Please tick if the patients is a Permanent teeth</p>
					<p class="RL" style="margin-right:5px">R</p>
					<div style="overflow:hidden;display:inline-block;float:left">
                    <? include("setup2_layer.php");  ?>
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
							<button type="button" disabled class="number" id="attchment_16" name="upperBrackets" ><?=$numberArray['attchment_16']?></button>
								<button type="button" disabled class="number" id="attchment_15" name="upperBrackets" ><?=$numberArray['attchment_15']?></button>
								<button type="button" disabled class="number" id="attchment_14" name="upperBrackets" ><?=$numberArray['attchment_14']?></button>
								<button type="button" disabled class="number" id="attchment_13" name="upperBrackets" ><?=$numberArray['attchment_13']?></button>
								<button type="button" disabled class="number" id="attchment_12" name="upperBrackets" ><?=$numberArray['attchment_12']?></button>
								<button type="button" disabled class="number" id="attchment_11" name="upperBrackets"  style="margin:0"><?=$numberArray['attchment_11']?></button>
						</div>
						<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
							<button type="button" disabled class="number" id="attchment_46" name="lowerBrackets" ><?=$numberArray['attchment_46']?></button>
								<button type="button" disabled class="number" id="attchment_45" name="lowerBrackets" ><?=$numberArray['attchment_45']?></button>
								<button type="button" disabled class="number" id="attchment_44" name="lowerBrackets" ><?=$numberArray['attchment_44']?></button>
								<button type="button" disabled class="number" id="attchment_43" name="lowerBrackets" ><?=$numberArray['attchment_43']?></button>
								<button type="button" disabled class="number" id="attchment_42" name="lowerBrackets" ><?=$numberArray['attchment_42']?></button>
								<button type="button" disabled class="number" id="attchment_41" name="lowerBrackets"  style="margin:0"><?=$numberArray['attchment_41']?></button>
						</div>
					</div>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                           <button type="button" disabled class="number" id="attchment_21" name="upperBrackets" ><?=$numberArray['attchment_21']?></button>
								<button type="button" disabled class="number" id="attchment_22" name="upperBrackets" ><?=$numberArray['attchment_22']?></button>
								<button type="button" disabled class="number" id="attchment_23" name="upperBrackets" ><?=$numberArray['attchment_23']?></button>
								<button type="button" disabled class="number" id="attchment_24" name="upperBrackets" ><?=$numberArray['attchment_24']?></button>
								<button type="button" disabled class="number" id="attchment_25" name="upperBrackets" ><?=$numberArray['attchment_25']?></button>
								<button type="button" disabled class="number" id="attchment_26" name="upperBrackets" ><?=$numberArray['attchment_26']?></button>
						</div>
						<div style="padding-top:5px;overflow:hidden;padding-left:5px">
							<button type="button" disabled class="number" id="attchment_31" name="lowerBrackets" ><?=$numberArray['attchment_31']?></button>
								<button type="button" disabled class="number" id="attchment_32" name="lowerBrackets" ><?=$numberArray['attchment_32']?></button>
								<button type="button" disabled class="number" id="attchment_33" name="lowerBrackets" ><?=$numberArray['attchment_33']?></button>
								<button type="button" disabled class="number" id="attchment_34" name="lowerBrackets" ><?=$numberArray['attchment_34']?></button>
								<button type="button" disabled class="number" id="attchment_35" name="lowerBrackets" ><?=$numberArray['attchment_35']?></button>
								<button type="button" disabled class="number" id="attchment_36" name="lowerBrackets" ><?=$numberArray['attchment_36']?></button>
						</div>
					</div>
					<p class="RL" style="margin-left:5px">L</p>
					<div style="display:inline-block">
					<p style="text-align:left;margin:10px 0">Please tick if the patient is a child</p>
					<p class="RL" style="margin-right:5px">R</p>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
							<button type="button" disabled class="number" id="attchment_55" name="upperBrackets" ><?=$numberArray['attchment_55']?></button>
							<button type="button" disabled class="number" id="attchment_54" name="upperBrackets" ><?=$numberArray['attchment_54']?></button>
							<button type="button" disabled class="number" id="attchment_53" name="upperBrackets" ><?=$numberArray['attchment_53']?></button>
							<button type="button" disabled class="number" id="attchment_52" name="upperBrackets" ><?=$numberArray['attchment_52']?></button>
							<button type="button" disabled class="number" id="attchment_51" name="upperBrackets"  style="margin:0"><?=$numberArray['attchment_51']?></button>
						</div>
						<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
							<button type="button" disabled class="number" id="attchment_85" name="lowerBrackets" ><?=$numberArray['attchment_85']?></button>
							<button type="button" disabled class="number" id="attchment_84" name="lowerBrackets" ><?=$numberArray['attchment_84']?></button>
							<button type="button" disabled class="number" id="attchment_83" name="lowerBrackets" ><?=$numberArray['attchment_83']?></button>
							<button type="button" disabled class="number" id="attchment_82" name="lowerBrackets" ><?=$numberArray['attchment_82']?></button>
							<button type="button" disabled class="number" id="attchment_81" name="lowerBrackets" style="margin:0"><?=$numberArray['attchment_81']?></button>
						</div>
					</div>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                            <button type="button" disabled class="number" id="attchment_61" name="upperBrackets" ><?=$numberArray['attchment_61']?></button>
							<button type="button" disabled class="number" id="attchment_62" name="upperBrackets" ><?=$numberArray['attchment_62']?></button>
							<button type="button" disabled class="number" id="attchment_63" name="upperBrackets" ><?=$numberArray['attchment_63']?></button>
							<button type="button" disabled class="number" id="attchment_64" name="upperBrackets" ><?=$numberArray['attchment_64']?></button>
							<button type="button" disabled class="number" id="attchment_65" name="upperBrackets" style="margin:0"><?=$numberArray['attchment_65']?></button>
						</div>
						<div style="padding-top:5px;overflow:hidden;padding-left:5px">
							<button type="button" disabled class="number" id="attchment_71" name="lowerBrackets" ><?=$numberArray['attchment_71']?></button>
							<button type="button" disabled class="number" id="attchment_72" name="lowerBrackets" ><?=$numberArray['attchment_72']?></button>
							<button type="button" disabled class="number" id="attchment_73" name="lowerBrackets" ><?=$numberArray['attchment_73']?></button>
							<button type="button" disabled class="number" id="attchment_74" name="lowerBrackets" ><?=$numberArray['attchment_74']?></button>
							<button type="button" disabled class="number" id="attchment_75" name="lowerBrackets" style="margin:0"><?=$numberArray['attchment_75']?></button>
						</div>
					</div>
					<p class="RL" style="margin-left:5px">L</p>
					</div>
					
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
				<!-- <a href="/views/service/child/10_setup3.php">Edit</a> -->
			</div>
			<div class="result_content" style="padding:50px 95px">
				<div class="used_brackets">
					<h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px">5. Extraction<span style="float:right;margin-right:10px">:</span></h2>
					<div style="text-align:left;display:inline-block;vertical-align:top;margin-left:20px">
						<p>
							<?
							if($_SESSION['extraction'] == "none_tooth_e"){ echo "None extraction";}else{echo "Extraction";}
							?>
						</p>
					</div>
					<div style="overflow:hidden;margin:0 0 0 30px;text-align:left">
						<p style="text-align:left;margin:10px 0">Please tick if the patients is a Permanent teeth</p>
						<p class="RL" style="margin-right:5px">R</p>
						<div style="overflow:hidden;display:inline-block;float:left">
							<? include("setup2_layer.php");  ?>
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
								<button type="button" class="number" id="extraction_16" name="upperBrackets" ><?=$numberArray['extraction_16']?></button>
							<button type="button" class="number" id="extraction_15" name="upperBrackets" ><?=$numberArray['extraction_15']?></button>
							<button type="button" class="number" id="extraction_14" name="upperBrackets" ><?=$numberArray['extraction_14']?></button>
							<button type="button" class="number" id="extraction_13" name="upperBrackets" ><?=$numberArray['extraction_13']?></button>
							<button type="button" class="number" id="extraction_12" name="upperBrackets" ><?=$numberArray['extraction_12']?></button>
							<button type="button" class="number" id="extraction_11" name="upperBrackets"  style="margin:0"><?=$numberArray['extraction_11']?></button>
							</div>
							<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
								<button type="button" class="number" id="extraction_46" name="lowerBrackets" ><?=$numberArray['extraction_46']?></button>
							<button type="button" class="number" id="extraction_45" name="lowerBrackets" ><?=$numberArray['extraction_45']?></button>
							<button type="button" class="number" id="extraction_44" name="lowerBrackets" ><?=$numberArray['extraction_44']?></button>
							<button type="button" class="number" id="extraction_43" name="lowerBrackets" ><?=$numberArray['extraction_43']?></button>
							<button type="button" class="number" id="extraction_42" name="lowerBrackets" ><?=$numberArray['extraction_42']?></button>
							<button type="button" class="number" id="extraction_41" name="lowerBrackets"  style="margin:0"><?=$numberArray['extraction_41']?></button>
							</div>
						</div>
						<div style="overflow:hidden;display:inline-block;float:left">
							<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
								<button type="button" class="number" id="extraction_21" name="upperBrackets" ><?=$numberArray['extraction_21']?></button>
							<button type="button" class="number" id="extraction_22" name="upperBrackets" ><?=$numberArray['extraction_22']?></button>
							<button type="button" class="number" id="extraction_23" name="upperBrackets" ><?=$numberArray['extraction_23']?></button>
							<button type="button" class="number" id="extraction_24" name="upperBrackets" ><?=$numberArray['extraction_24']?></button>
							<button type="button" class="number" id="extraction_25" name="upperBrackets" ><?=$numberArray['extraction_25']?></button>
							<button type="button" class="number" id="extraction_26" name="upperBrackets" ><?=$numberArray['extraction_26']?></button>
							</div>
							<div style="padding-top:5px;overflow:hidden;padding-left:5px">
								<button type="button" class="number" id="extraction_31" name="lowerBrackets" ><?=$numberArray['extraction_31']?></button>
							<button type="button" class="number" id="extraction_32" name="lowerBrackets" ><?=$numberArray['extraction_32']?></button>
							<button type="button" class="number" id="extraction_33" name="lowerBrackets" ><?=$numberArray['extraction_33']?></button>
							<button type="button" class="number" id="extraction_34" name="lowerBrackets" ><?=$numberArray['extraction_34']?></button>
							<button type="button" class="number" id="extraction_35" name="lowerBrackets" ><?=$numberArray['extraction_35']?></button>
							<button type="button" class="number" id="extraction_36" name="lowerBrackets" ><?=$numberArray['extraction_36']?></button>
							</div>
						</div>
						<p class="RL" style="margin-left:5px">L</p>
						<div style="display:inline-block">
							<p style="text-align:left;margin:10px 0">Please tick if the patient is a child</p>
							<p class="RL" style="margin-right:5px">R</p>
							<div style="overflow:hidden;display:inline-block;float:left">
								<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
									<button type="button" disabled class="number" id="extraction_55" name="upperBrackets" ><?=$numberArray['extraction_55']?></button>
							<button type="button" disabled class="number" id="extraction_54" name="upperBrackets" ><?=$numberArray['extraction_54']?></button>
							<button type="button" disabled class="number" id="extraction_53" name="upperBrackets" ><?=$numberArray['extraction_53']?></button>
							<button type="button" disabled class="number" id="extraction_52" name="upperBrackets" ><?=$numberArray['extraction_52']?></button>
							<button type="button" disabled class="number" id="extraction_51" name="upperBrackets"  style="margin:0"><?=$numberArray['extraction_51']?></button>
								</div>
								<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
									<button type="button" disabled class="number" id="extraction_85" name="lowerBrackets" ><?=$numberArray['extraction_85']?></button>
							<button type="button" disabled class="number" id="extraction_84" name="lowerBrackets" ><?=$numberArray['extraction_84']?></button>
							<button type="button" disabled class="number" id="extraction_83" name="lowerBrackets" ><?=$numberArray['extraction_83']?></button>
							<button type="button" disabled class="number" id="extraction_82" name="lowerBrackets" ><?=$numberArray['extraction_82']?></button>
							<button type="button" disabled class="number" id="extraction_81" name="lowerBrackets" style="margin:0"><?=$numberArray['extraction_81']?></button>
								</div>
							</div>
							<div style="overflow:hidden;display:inline-block;float:left">
								<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
									<button type="button" disabled class="number" id="extraction_61" name="upperBrackets" ><?=$numberArray['extraction_61']?></button>
							<button type="button" disabled class="number" id="extraction_62" name="upperBrackets" ><?=$numberArray['extraction_62']?></button>
							<button type="button" disabled class="number" id="extraction_63" name="upperBrackets" ><?=$numberArray['extraction_63']?></button>
							<button type="button" disabled class="number" id="extraction_64" name="upperBrackets" ><?=$numberArray['extraction_64']?></button>
							<button type="button" disabled class="number" id="extraction_65" name="upperBrackets" style="margin:0"><?=$numberArray['extraction_65']?></button>
								</div>
								<div style="padding-top:5px;overflow:hidden;padding-left:5px">
									<button type="button" disabled class="number" id="extraction_71" name="lowerBrackets" ><?=$numberArray['extraction_71']?></button>
							<button type="button" disabled class="number" id="extraction_72" name="lowerBrackets" ><?=$numberArray['extraction_72']?></button>
							<button type="button" disabled class="number" id="extraction_73" name="lowerBrackets" ><?=$numberArray['extraction_73']?></button>
							<button type="button" disabled class="number" id="extraction_74" name="lowerBrackets" ><?=$numberArray['extraction_74']?></button>
							<button type="button" disabled class="number" id="extraction_75" name="lowerBrackets" style="margin:0"><?=$numberArray['extraction_75']?></button>
								</div>
							</div>
							<p class="RL" style="margin-left:5px">L</p>
						</div>
					</div>
					<h2 style="text-align:left;margin-top:30px">6. Additional request</h2>
					<div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
						<textarea disabled style="width:100%;height:100px"><?=$_SESSION['special_instruction']?></textarea>
					</div>
				</div>
			</div>
		</div>
	<!-- Prescription3 End -->
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
	echo "$('#extraction_".$_SESSION['e_select_number'][$i]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});
    $('#extraction_".$_SESSION['e_select_number'][$i]."').val(".$_SESSION['e_select_number'][$i].");";
}
echo "</script>";
}
?>

</form>
	
	
	<div class="button_menu" style="margin:40px auto 0 auto; padding:10px; position:unset;transform:none">
<!--		<a href="javascript:servicePopupClose();" class="service_close">Close</a>-->
		<a href="10_setup3.php" class="btn_black hover190">Back</a>
	<!--	<a href="javascript:void(0);"  class="service_close" style="margin-left:10px">Print</a>
         window.open('../../viewmodels/servicePrint.php','printPopup','height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes');" -->
         <a href="javascript:window.open('../../../viewmodels/print.php','printPopup','height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes');"  class="btn_black hover190">Print</a>
		<input type="button" value="Submit" class="btn_blue hover190 submit_summary">
	</div>
</div>
</div>
<?
if (isset($_SESSION['diag_select_number'])) {
echo "<script>";

for ($i=0; $i < count($_SESSION['diag_select_number']); $i++) { 
    $number_values = explode( ',', $_SESSION['diag_select_number'][$i], 2);
    if($number_values[1] == "crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "implant"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/implant_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "telescopic_crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/Telescopic_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "veneered_crown"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background':'url(../../../resource/images/Veneered_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_".$number_values[0]."').text('');";

    }else if($number_values[1] == "check"){

        echo "$('#diagnostics_".$number_values[0]."').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});";

    }
}
echo "</script>";
}
?>


<?php
// @LUCAS 프로그래스바 모듈 추가
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/progressbar.php");
?>

<script>

    $(function(){
        $(".submit_summary").on("click", async function () {
            // @LUCAS 프로그래스바를 보여주고 상태를 업데이트 한다.
            const startProgressbar = () => {
                const [reset, update] = createProgressbar({hideWhen100Percent: false});
                reset();
                let percent = 0;
                let interval = null;

                // @LUCAS 서머리를 서버에 저장하는 경우는 파일 업로드와 다르게
                // 얼마나 올라갔는지 알 수 없기 때문에
                // setInterval 로 처리 한다.
                function updateProgressbar() {
                    percent += 10;
                    update(percent);
                    if (percent >= 100) {
                        clearInterval(interval);
                    }
                }

                interval = setInterval(updateProgressbar, 1000);
            }
            await resultSubmit(<?=$st_value?>, startProgressbar);
        });
    });

</script>



<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>

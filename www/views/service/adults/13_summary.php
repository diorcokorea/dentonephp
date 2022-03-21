<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
$service = 13;

include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/head.service.php");

include '../../../models/modelsVariable_global.php';
include '../../../models/service_decode.php';
//ini_set("display_errors","1");
$option_num = 9;
// if ($_SESSION['treatment_option2'] == "DentOne Regular AP" || $_SESSION['treatment_option2'] == "DentOne Regular") {
//     $option_num = 10;
// }else{
//     $option_num = 9;
// }

service_json($_SESSION['patient_key'], $_SESSION['service_key']);

if ($patient_st != 1) {
    $st_value = 21;
} else {
    $st_value = 20;
}


$numberArray = array();
switch ($_SESSION['clinic_settings']['numbering_option']) {
    case 'fdi':
        $numberArray = array(
            'diagnostics_18' => 18,
            'diagnostics_17' => 17,
            'diagnostics_16' => 16,
            'diagnostics_15' => 15,
            'diagnostics_14' => 14,
            'diagnostics_13' => 13,
            'diagnostics_12' => 12,
            'diagnostics_11' => 11,

            'diagnostics_48' => 48,
            'diagnostics_47' => 47,
            'diagnostics_46' => 46,
            'diagnostics_45' => 45,
            'diagnostics_44' => 44,
            'diagnostics_43' => 43,
            'diagnostics_42' => 42,
            'diagnostics_41' => 41,

            'diagnostics_21' => 21,
            'diagnostics_22' => 22,
            'diagnostics_23' => 23,
            'diagnostics_24' => 24,
            'diagnostics_25' => 25,
            'diagnostics_26' => 26,
            'diagnostics_27' => 27,
            'diagnostics_28' => 28,

            'diagnostics_31' => 31,
            'diagnostics_32' => 32,
            'diagnostics_33' => 33,
            'diagnostics_34' => 34,
            'diagnostics_35' => 35,
            'diagnostics_36' => 36,
            'diagnostics_37' => 37,
            'diagnostics_38' => 38,

            'attchment_18' => 18,
            'attchment_17' => 17,
            'attchment_16' => 16,
            'attchment_15' => 15,
            'attchment_14' => 14,
            'attchment_13' => 13,
            'attchment_12' => 12,
            'attchment_11' => 11,

            'attchment_48' => 48,
            'attchment_47' => 47,
            'attchment_46' => 46,
            'attchment_45' => 45,
            'attchment_44' => 44,
            'attchment_43' => 43,
            'attchment_42' => 42,
            'attchment_41' => 41,

            'attchment_21' => 21,
            'attchment_22' => 22,
            'attchment_23' => 23,
            'attchment_24' => 24,
            'attchment_25' => 25,
            'attchment_26' => 26,
            'attchment_27' => 27,
            'attchment_28' => 28,

            'attchment_31' => 31,
            'attchment_32' => 32,
            'attchment_33' => 33,
            'attchment_34' => 34,
            'attchment_35' => 35,
            'attchment_36' => 36,
            'attchment_37' => 37,
            'attchment_38' => 38,

            'extraction_18' => 18,
            'extraction_17' => 17,
            'extraction_16' => 16,
            'extraction_15' => 15,
            'extraction_14' => 14,
            'extraction_13' => 13,
            'extraction_12' => 12,
            'extraction_11' => 11,

            'extraction_48' => 48,
            'extraction_47' => 47,
            'extraction_46' => 46,
            'extraction_45' => 45,
            'extraction_44' => 44,
            'extraction_43' => 43,
            'extraction_42' => 42,
            'extraction_41' => 41,

            'extraction_21' => 21,
            'extraction_22' => 22,
            'extraction_23' => 23,
            'extraction_24' => 24,
            'extraction_25' => 25,
            'extraction_26' => 26,
            'extraction_27' => 27,
            'extraction_28' => 28,

            'extraction_31' => 31,
            'extraction_32' => 32,
            'extraction_33' => 33,
            'extraction_34' => 34,
            'extraction_35' => 35,
            'extraction_36' => 36,
            'extraction_37' => 37,
            'extraction_38' => 38,

            'incisor_18' => 18,
            'molar_17' => 17,
            'incisor_16' => 16,
            'incisor_15' => 15,
            'incisor_14' => 14,
            'incisor_13' => 13,
            'incisor_12' => 12,
            'incisor_11' => 11,

            'incisor_48' => 48,
            'molar_47' => 47,
            'incisor_46' => 46,
            'incisor_45' => 45,
            'incisor_44' => 44,
            'incisor_43' => 43,
            'incisor_42' => 42,
            'incisor_41' => 41,

            'incisor_21' => 21,
            'incisor_22' => 22,
            'incisor_23' => 23,
            'incisor_24' => 24,
            'incisor_25' => 25,
            'incisor_26' => 26,
            'molar_27' => 27,
            'incisor_28' => 28,

            'incisor_31' => 31,
            'incisor_32' => 32,
            'incisor_33' => 33,
            'incisor_34' => 34,
            'incisor_35' => 35,
            'incisor_36' => 36,
            'molar_37' => 37,
            'incisor_38' => 38,

        );
        break;
    case 'palmer':
        $numberArray = array(
            'diagnostics_18' => 8,
            'diagnostics_17' => 7,
            'diagnostics_16' => 6,
            'diagnostics_15' => 5,
            'diagnostics_14' => 4,
            'diagnostics_13' => 3,
            'diagnostics_12' => 2,
            'diagnostics_11' => 1,

            'diagnostics_48' => 8,
            'diagnostics_47' => 7,
            'diagnostics_46' => 6,
            'diagnostics_45' => 5,
            'diagnostics_44' => 4,
            'diagnostics_43' => 3,
            'diagnostics_42' => 2,
            'diagnostics_41' => 1,

            'diagnostics_21' => 1,
            'diagnostics_22' => 2,
            'diagnostics_23' => 3,
            'diagnostics_24' => 4,
            'diagnostics_25' => 5,
            'diagnostics_26' => 6,
            'diagnostics_27' => 7,
            'diagnostics_28' => 8,

            'diagnostics_31' => 1,
            'diagnostics_32' => 2,
            'diagnostics_33' => 3,
            'diagnostics_34' => 4,
            'diagnostics_35' => 5,
            'diagnostics_36' => 6,
            'diagnostics_37' => 7,
            'diagnostics_38' => 8,

            'attchment_18' => 8,
            'attchment_17' => 7,
            'attchment_16' => 6,
            'attchment_15' => 5,
            'attchment_14' => 4,
            'attchment_13' => 3,
            'attchment_12' => 2,
            'attchment_11' => 1,

            'attchment_48' => 8,
            'attchment_47' => 7,
            'attchment_46' => 6,
            'attchment_45' => 5,
            'attchment_44' => 4,
            'attchment_43' => 3,
            'attchment_42' => 2,
            'attchment_41' => 1,

            'attchment_21' => 1,
            'attchment_22' => 2,
            'attchment_23' => 3,
            'attchment_24' => 4,
            'attchment_25' => 5,
            'attchment_26' => 6,
            'attchment_27' => 7,
            'attchment_28' => 8,

            'attchment_31' => 1,
            'attchment_32' => 2,
            'attchment_33' => 3,
            'attchment_34' => 4,
            'attchment_35' => 5,
            'attchment_36' => 6,
            'attchment_37' => 7,
            'attchment_38' => 8,


            'extraction_18' => 8,
            'extraction_17' => 7,
            'extraction_16' => 6,
            'extraction_15' => 5,
            'extraction_14' => 4,
            'extraction_13' => 3,
            'extraction_12' => 2,
            'extraction_11' => 1,

            'extraction_48' => 8,
            'extraction_47' => 7,
            'extraction_46' => 6,
            'extraction_45' => 5,
            'extraction_44' => 4,
            'extraction_43' => 3,
            'extraction_42' => 2,
            'extraction_41' => 1,

            'extraction_21' => 1,
            'extraction_22' => 2,
            'extraction_23' => 3,
            'extraction_24' => 4,
            'extraction_25' => 5,
            'extraction_26' => 6,
            'extraction_27' => 7,
            'extraction_28' => 8,

            'extraction_31' => 1,
            'extraction_32' => 2,
            'extraction_33' => 3,
            'extraction_34' => 4,
            'extraction_35' => 5,
            'extraction_36' => 6,
            'extraction_37' => 7,
            'extraction_38' => 8,


            'incisor_18' => 8,
            'molar_17' => 7,
            'incisor_16' => 6,
            'incisor_15' => 5,
            'incisor_14' => 4,
            'incisor_13' => 3,
            'incisor_12' => 2,
            'incisor_11' => 1,

            'incisor_48' => 8,
            'molar_47' => 7,
            'incisor_46' => 6,
            'incisor_45' => 5,
            'incisor_44' => 4,
            'incisor_43' => 3,
            'incisor_42' => 2,
            'incisor_41' => 1,

            'incisor_21' => 1,
            'incisor_22' => 2,
            'incisor_23' => 3,
            'incisor_24' => 4,
            'incisor_25' => 5,
            'incisor_26' => 6,
            'molar_27' => 7,
            'incisor_28' => 8,

            'incisor_31' => 1,
            'incisor_32' => 2,
            'incisor_33' => 3,
            'incisor_34' => 4,
            'incisor_35' => 5,
            'incisor_36' => 6,
            'molar_37' => 7,
            'incisor_38' => 8,
        );
        break;
    case 'universal':
        $numberArray = array(
            'diagnostics_18' => 1,
            'diagnostics_17' => 2,
            'diagnostics_16' => 3,
            'diagnostics_15' => 4,
            'diagnostics_14' => 5,
            'diagnostics_13' => 6,
            'diagnostics_12' => 7,
            'diagnostics_11' => 8,

            'diagnostics_48' => 32,
            'diagnostics_47' => 31,
            'diagnostics_46' => 30,
            'diagnostics_45' => 29,
            'diagnostics_44' => 28,
            'diagnostics_43' => 27,
            'diagnostics_42' => 26,
            'diagnostics_41' => 25,

            'diagnostics_21' => 9,
            'diagnostics_22' => 10,
            'diagnostics_23' => 11,
            'diagnostics_24' => 12,
            'diagnostics_25' => 13,
            'diagnostics_26' => 14,
            'diagnostics_27' => 15,
            'diagnostics_28' => 16,

            'diagnostics_31' => 24,
            'diagnostics_32' => 23,
            'diagnostics_33' => 22,
            'diagnostics_34' => 21,
            'diagnostics_35' => 20,
            'diagnostics_36' => 19,
            'diagnostics_37' => 18,
            'diagnostics_38' => 17,


            'attchment_18' => 1,
            'attchment_17' => 2,
            'attchment_16' => 3,
            'attchment_15' => 4,
            'attchment_14' => 5,
            'attchment_13' => 6,
            'attchment_12' => 7,
            'attchment_11' => 8,

            'attchment_48' => 32,
            'attchment_47' => 31,
            'attchment_46' => 30,
            'attchment_45' => 29,
            'attchment_44' => 28,
            'attchment_43' => 27,
            'attchment_42' => 26,
            'attchment_41' => 25,

            'attchment_21' => 9,
            'attchment_22' => 10,
            'attchment_23' => 11,
            'attchment_24' => 12,
            'attchment_25' => 13,
            'attchment_26' => 14,
            'attchment_27' => 15,
            'attchment_28' => 16,

            'attchment_31' => 24,
            'attchment_32' => 23,
            'attchment_33' => 22,
            'attchment_34' => 21,
            'attchment_35' => 20,
            'attchment_36' => 19,
            'attchment_37' => 18,
            'attchment_38' => 17,

            'extraction_18' => 1,
            'extraction_17' => 2,
            'extraction_16' => 3,
            'extraction_15' => 4,
            'extraction_14' => 5,
            'extraction_13' => 6,
            'extraction_12' => 7,
            'extraction_11' => 8,

            'extraction_48' => 32,
            'extraction_47' => 31,
            'extraction_46' => 30,
            'extraction_45' => 29,
            'extraction_44' => 28,
            'extraction_43' => 27,
            'extraction_42' => 26,
            'extraction_41' => 25,

            'extraction_21' => 9,
            'extraction_22' => 10,
            'extraction_23' => 11,
            'extraction_24' => 12,
            'extraction_25' => 13,
            'extraction_26' => 14,
            'extraction_27' => 15,
            'extraction_28' => 16,

            'extraction_31' => 24,
            'extraction_32' => 23,
            'extraction_33' => 22,
            'extraction_34' => 21,
            'extraction_35' => 20,
            'extraction_36' => 19,
            'extraction_37' => 18,
            'extraction_38' => 17,

            'incisor_18' => 1,
            'molar_17' => 2,
            'incisor_16' => 3,
            'incisor_15' => 4,
            'incisor_14' => 5,
            'incisor_13' => 6,
            'incisor_12' => 7,
            'incisor_11' => 8,

            'incisor_48' => 32,
            'molar_47' => 31,
            'incisor_46' => 30,
            'incisor_45' => 29,
            'incisor_44' => 28,
            'incisor_43' => 27,
            'incisor_42' => 26,
            'incisor_41' => 25,

            'incisor_21' => 9,
            'incisor_22' => 10,
            'incisor_23' => 11,
            'incisor_24' => 12,
            'incisor_25' => 13,
            'incisor_26' => 14,
            'molar_27' => 15,
            'incisor_28' => 16,

            'incisor_31' => 24,
            'incisor_32' => 23,
            'incisor_33' => 22,
            'incisor_34' => 21,
            'incisor_35' => 20,
            'incisor_36' => 19,
            'molar_37' => 18,
            'incisor_38' => 17,
        );
        break;
}

?>
    <div class="serviceContainer">
        <div class="content" id="content" style="background-color:#fff;height:100%">

            <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
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
                                    <p><?= $_SESSION['treatment_option1'] ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Treatment option1 End -->

                    <!-- Treatment option2 Start -->
                    <div id="result_modeltype" class="result_box" style="margin-top:40px">
                        <div class="title" style="overflow:hidden;">
                            <p style="font-size:20px">Aligner step</p>
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/02_treatment_option2.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:40px 80px">
                            <div>
                                <div class="patient">
                                    <p>Option: </p>
                                    <p><?= $_SESSION['treatment_option2'] ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Treatment option2 End -->

                    <!-- Patient Info Start -->
                    <div id="result_patient" class="result_box" style="margin-top:40px">
                        <div class="title" style="overflow:hidden;">
                            <p style="font-size:20px">Patient information</p>
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/03_patientinfo.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:60px 0;">
                            <div style="width:80%;margin:0 auto">
                                <div class="patient_left" style="float:left;border:none">
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">Patient ID</p>
                                        <span>:</span>
                                        <p style="white-space: pre-wrap; width: 220px; vertical-align: middle;"><? echo $_SESSION['patient_id'] ?></p>
                                    </div>
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">First name</p>
                                        <span>:</span>
                                        <p class="result_patient_content"
                                           style="white-space: pre-wrap; width: 220px; vertical-align: middle;"><? echo $_SESSION['first_name'] ?></p>
                                    </div>
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">Last name</p>
                                        <span>:</span>
                                        <p class="result_patient_content"
                                           style="white-space: pre-wrap; width: 220px; vertical-align: middle;"><? echo $_SESSION['last_name'] ?></p>
                                    </div>
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">Gender</p>
                                        <span>:</span>
                                        <p class="result_patient_content"><? if ($_SESSION['patient_sex'] == "male") {
                                                echo "Male";
                                            } else {
                                                echo "Female";
                                            } ?></p>
                                    </div>
                                    <div class="patient">
                                        <p class="result_patient_title">Race</p>
                                        <span>:</span>
                                        <p class="result_patient_content"><? echo ucfirst($_SESSION['patient_ethinicity']); ?></p>
                                    </div>
                                </div>
                                <div class="patient_right" style="float: right;border-left:1px solid #d2d2d2">
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">Birthday</p>
                                        <span>:</span>
                                        <p class="result_patient_content"><? echo $_SESSION['patient_date_yy'] . "-" . $_SESSION['patient_date_mm'] . "-" . $_SESSION['patient_date_dd'] ?></p>
                                    </div>
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">Age</p>
                                        <span>:</span>
                                        <p class="result_patient_content"><? echo $_SESSION['patient_age'] ?></p>
                                    </div>
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">Lab</p>
                                        <span>:</span>
                                        <p class="result_patient_content"><? $lab_explode = explode(',', $_SESSION['dental_lab'], 2);
                                            echo $lab_explode[1]; ?></p>
                                    </div>
                                    <div class="patient" style="margin-bottom:70px">
                                        <p class="result_patient_title">Delivery address</p>
                                        <span>:</span>
                                        <p style="color:#07a2e8"><?= $_SESSION['shipping_address']['address_name'] ?></p>
                                        <p style="margin-left:187px;margin-top:10px">
                                            <?= $_SESSION['shipping_address']['address1'] . ", "
                                            . $_SESSION['shipping_address']['address2'] . ", "
                                            . $_SESSION['shipping_address']['address3'] . ", "
                                            . $_SESSION['shipping_address']['address4'] . ", "
                                            . $_SESSION['shipping_address']['zip_code'] ?>
                                        </p>
                                    </div>
                                    <div class="patient">
                                        <p class="result_patient_title">Billing address</p>
                                        <span>:</span>
                                        <p style="color:#07a2e8"><?= $_SESSION['billing_address']['address_name'] ?></p>
                                        <p style="margin-left:187px;margin-top:10px">
                                            <?= $_SESSION['billing_address']['address1'] . ", "
                                            . $_SESSION['billing_address']['address2'] . ", "
                                            . $_SESSION['billing_address']['address3'] . ", "
                                            . $_SESSION['billing_address']['address4'] . ", "
                                            . $_SESSION['billing_address']['zip_code'] ?>
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
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/04_classification.php">Edit</a> -->
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
                                <textarea disabled
                                          class="classification_result_etc_box"><? if ($_SESSION['classification']['etc_value'] == "") {
                                        echo "There is no content.";
                                    } else {
                                        echo $_SESSION['classification']['etc_value'];
                                    } ?></textarea>
                            </div>
                            <div class="classification_result" style="margin-top:30px">
                                <p class="classification_result_precautions">Note</p>
                                <textarea disabled
                                          class="classification_result_precautions_box"><? if ($_SESSION['classification']['precaution'] == "") {
                                        echo "There is no content.";
                                    } else {
                                        echo $_SESSION['classification']['precaution'];
                                    } ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Classification End -->

                    <!-- Model Type Start -->
                    <div id="result_modeltype" class="result_box" style="margin-top:40px">
                        <div class="title" style="overflow:hidden;">
                            <p style="font-size:20px">Model Type</p>
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/05_modeltype.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:40px 200px">
                            <div>
                                <div class="patient">
                                    <p class="result_patient_title">Model Type</p>
                                    <span style="margin-right:80px">:</span>
                                    <p><? if ($_SESSION['model_type'] == "ScanFile") {
                                            $md = "ScanFile";
                                            if ($_SESSION['maxilla_image'] != null && $_SESSION['mandible_image'] != null) {
                                                $md = $md . " : " . "Maxilla, Mandible";
                                            } else if ($_SESSION['maxilla_image'] != null) {
                                                $md = $md . " : " . "Maxilla";
                                            } else if ($_SESSION['mandible_image'] != null) {
                                                $md = $md . " : " . "Mandible";
                                            }
                                            echo $md;
                                        } else {
                                            echo $_SESSION['model_type'];
                                        } ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Model Type End -->

                    <!-- Picture Start -->
                    <div id="result_picture" class="result_box" style="margin-top:40px">
                        <div class="title" style="overflow:hidden;">
                            <p style="font-size:20px">Photo</p>
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/06_photo.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:30px 0;width:100%;">
                            <div style="width:60%;margin:0 auto">
                                <div style="text-align:center;width:100%;overflow:hidden;margin-bottom:20px">
                                    <div style="display:inline-block;" class="filebox">
                                        <input type="file" disabled id="Lateral" href="#" disabled style="">
                                        <label for="Lateral" class="lateral">
                                            <? if (isset($_SESSION['lateral_photo'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['lateral_photo'] ?>">
                                            <? } ?>
                                            <p class="file_text">Lateral Photo</p>
                                        </label>
                                    </div>
                                    <div class="filebox" style="display:inline-block;margin:0 10px">
                                        <input type="file" disabled id="Frontal" href="#" style="">
                                        <label for="Frontal" class="frontal">
                                            <? if (isset($_SESSION['front_photo'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['front_photo'] ?>">
                                            <? } ?>
                                            <p class="file_text">Frontal Photo</p>
                                        </label>
                                    </div>
                                    <div style="display:inline-block" class="filebox">
                                        <input type="file" disabled id="Smaile" href="#" style="">
                                        <label for="Smaile" class="smile">
                                            <? if (isset($_SESSION['smile_photo'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['smile_photo'] ?>">
                                            <? } ?>
                                            <p class="file_text">Smile Photo</p>
                                        </label>
                                    </div>
                                </div>
                                <div style="text-align:center;width:100%;overflow:hidden;margin-bottom:20px">
                                    <div style="display:inline-block" class="filebox">
                                        <input type="file" disabled id="Lateral" href="#" style="">
                                        <label for="Lateral" class="intraoral_upper">
                                            <? if (isset($_SESSION['intraoral_upper'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['intraoral_upper'] ?>">
                                            <? } ?>
                                            <p class="file_text">Intraoral Upper</p>
                                        </label>
                                    </div>
                                    <div class="filebox"
                                         style="display:inline-block;vertical-align:bottom;margin:0 10px">
                                        <div class="picture" style="padding:0">
                                            <p class="picture_text" style="text-align:center;padding:70px 0 0 0">This is
                                                a registered photo.</p>
                                        </div>
                                    </div>
                                    <div style="display:inline-block" class="filebox">
                                        <input type="file" disabled id="Smaile" href="#" style="">
                                        <label for="Smaile" class="intraoral_lower">
                                            <? if (isset($_SESSION['intraoral_lower'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['intraoral_lower'] ?>">
                                            <? } ?>
                                            <p class="file_text">Intraoral Lower</p>
                                        </label>
                                    </div>
                                </div>
                                <div style="text-align:center;width:100%;overflow:hidden">
                                    <div style="display:inline-block" class="filebox">
                                        <input type="file" disabled id="Lateral" href="#" style="">
                                        <label for="Lateral" class="intraoral_right">
                                            <? if (isset($_SESSION['intraoral_right'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['intraoral_right'] ?>">
                                            <? } ?>
                                            <p class="file_text">Intraoral Right</p>
                                        </label>
                                    </div>
                                    <div class="filebox" style="display:inline-block;margin:0 10px">
                                        <input type="file" disabled id="Frontal" href="#">
                                        <label for="Frontal" class="intraoral_front">
                                            <? if (isset($_SESSION['intraoral_fornt'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['intraoral_fornt'] ?>">
                                            <? } ?>
                                            <p class="file_text">Intraoral Front</p>
                                        </label>
                                    </div>
                                    <div style="display:inline-block" class="filebox">
                                        <input type="file" disabled id="Smaile" href="#" style="">
                                        <label for="Smaile" class="intraoral_left">
                                            <? if (isset($_SESSION['intraoral_left'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['intraoral_left'] ?>">
                                            <? } ?>
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
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/07_radiograph.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:30px 0;width:100%;">
                            <div class="radiograph_inner" style="padding:0;width:60%;margin:0 auto">
                                <div class="scanfile" style="padding:0">
                                    <div style="float:left;position:relative">
                                        <input type="file" disabled id="lateral_xray" href="#" style="">
                                        <label for="lateral_xray" class="lateral_xray">
                                            <? if (isset($_SESSION['lateral_xray'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['lateral_xray'] ?>">
                                            <? } ?>
                                            <p class="file_text">Lateral</p>
                                        </label>
                                    </div>
                                    <div style="float:right;position:relative">
                                        <input type="file" disabled id="panorama" href="#" style="">
                                        <!-- 	<input type="file" disabled id="image" accept="image/*" onchange="setThumbnail(event);"/> -->
                                        <label for="panorama" class="panorama">
                                            <? if (isset($_SESSION['panorama'])) { ?>
                                                <img class="thumb_img" src="<?= "/" . $_SESSION['panorama'] ?>">
                                            <? } ?>
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
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/08_setup1.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:50px 95px">
                            <div class="indirect_System">
                                <div>
                                    <h2 style="text-align:left;width:240px;float:left;display:inline-block">1. Select a
                                        arch<span style="float:right;margin-right:30px">:</span></h2>
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
                                    <h2 style="text-align:left;width:240px;float:left;display:inline-block">2. Tray
                                        sections<span style="float:right;margin-right:30px">:</span></h2>
                                    <div style="overflow:hidden">
                                        <?
                                        switch ($_SESSION['arch']) {
                                            case 'both':
                                                echo "<div style='overflow:hidden'><p style='float:left;'>";
                                                echo "Upper / " . $_SESSION['tray_section_u'];
                                                echo "</p></div>";

                                                echo "<div style='margin-top:20px'> <p style='float:left;'>";
                                                echo "Lower / " . $_SESSION['tray_section_l'];
                                                echo "</p></div>";
                                                break;
                                            case 'upper':
                                                echo "<div style='overflow:hidden'><p style='float:left;'>";
                                                echo "Upper / " . $_SESSION['tray_section_u'];
                                                echo "</p></div>";
                                                break;
                                            case 'lower':
                                                echo "<div style='margin-top:20px'> <p style='float:left;'>";
                                                echo "Lower / " . $_SESSION['tray_section_l'];
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
                                    <p style="text-align:left;margin:20px 0">(Implant, Telescopic crown, Veneered
                                        crown)</p>
                                    <p class="RL" style="margin-right:5px">R</p>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <? include("setup2_layer.php"); ?>
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                            <button type="button" disabled class="number" id="diagnostics_18"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_18'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_17"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_17'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_16"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_16'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_15"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_15'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_14"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_14'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_13"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_13'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_12"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_12'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_11"
                                                    name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['diagnostics_11'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                            <button type="button" disabled class="number" id="diagnostics_48"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_48'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_47"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_47'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_46"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_46'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_45"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_45'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_44"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_44'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_43"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_43'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_42"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_42'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_41"
                                                    name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['diagnostics_41'] ?></button>
                                        </div>
                                    </div>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                            <button type="button" disabled class="number" id="diagnostics_21"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_21'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_22"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_22'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_23"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_23'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_24"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_24'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_25"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_25'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_26"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_26'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_27"
                                                    name="upperBrackets"><?= $numberArray['diagnostics_27'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_28"
                                                    name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['diagnostics_28'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                            <button type="button" disabled class="number" id="diagnostics_31"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_31'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_32"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_32'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_33"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_33'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_34"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_34'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_35"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_35'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_36"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_36'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_37"
                                                    name="lowerBrackets"><?= $numberArray['diagnostics_37'] ?></button>
                                            <button type="button" disabled class="number" id="diagnostics_38"
                                                    name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['diagnostics_37'] ?></button>
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
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/09_setup2.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:50px 95px">
                            <div class="used_brackets" style="overflow:hidden;">
                                <div>
                                    <h2 style="text-align:left;width:160px;float:left;display:inline-block">3.
                                        Attachment<span style="float:right;margin-right:10px">:</span></h2>
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
                                        <? include("setup2_layer.php"); ?>
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                            <button type="button" disabled class="number" id="attchment_18"
                                                    name="upperBrackets"><?= $numberArray['attchment_18'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_17"
                                                    name="upperBrackets"><?= $numberArray['attchment_17'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_16"
                                                    name="upperBrackets"><?= $numberArray['attchment_16'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_15"
                                                    name="upperBrackets"><?= $numberArray['attchment_15'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_14"
                                                    name="upperBrackets"><?= $numberArray['attchment_14'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_13"
                                                    name="upperBrackets"><?= $numberArray['attchment_13'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_12"
                                                    name="upperBrackets"><?= $numberArray['attchment_12'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_11"
                                                    name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['attchment_11'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                            <button type="button" disabled class="number" id="attchment_48"
                                                    name="lowerBrackets"><?= $numberArray['attchment_48'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_47"
                                                    name="lowerBrackets"><?= $numberArray['attchment_47'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_46"
                                                    name="lowerBrackets"><?= $numberArray['attchment_46'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_45"
                                                    name="lowerBrackets"><?= $numberArray['attchment_45'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_44"
                                                    name="lowerBrackets"><?= $numberArray['attchment_44'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_43"
                                                    name="lowerBrackets"><?= $numberArray['attchment_43'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_42"
                                                    name="lowerBrackets"><?= $numberArray['attchment_42'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_41"
                                                    name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['attchment_41'] ?></button>
                                        </div>
                                    </div>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                            <button type="button" disabled class="number" id="attchment_21"
                                                    name="upperBrackets"><?= $numberArray['attchment_21'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_22"
                                                    name="upperBrackets"><?= $numberArray['attchment_22'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_23"
                                                    name="upperBrackets"><?= $numberArray['attchment_23'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_24"
                                                    name="upperBrackets"><?= $numberArray['attchment_24'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_25"
                                                    name="upperBrackets"><?= $numberArray['attchment_25'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_26"
                                                    name="upperBrackets"><?= $numberArray['attchment_26'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_27"
                                                    name="upperBrackets"><?= $numberArray['attchment_27'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_28"
                                                    name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['attchment_28'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                            <button type="button" disabled class="number" id="attchment_31"
                                                    name="lowerBrackets"><?= $numberArray['attchment_31'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_32"
                                                    name="lowerBrackets"><?= $numberArray['attchment_32'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_33"
                                                    name="lowerBrackets"><?= $numberArray['attchment_33'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_34"
                                                    name="lowerBrackets"><?= $numberArray['attchment_34'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_35"
                                                    name="lowerBrackets"><?= $numberArray['attchment_35'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_36"
                                                    name="lowerBrackets"><?= $numberArray['attchment_36'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_37"
                                                    name="lowerBrackets"><?= $numberArray['attchment_37'] ?></button>
                                            <button type="button" disabled class="number" id="attchment_38"
                                                    name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['attchment_38'] ?></button>
                                        </div>
                                    </div>
                                    <p class="RL" style="margin-left:5px">L</p>
                                </div>
                            </div>
                            <div class="used_brackets">
                                <h2 style="text-align:left;margin-top:40px">4. A.P relation</h2>
                                <div style="margin:20px 0 0 30px;text-align:left">
                                    <div style="display:inline-block">
                                        <p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">
                                            Upper<span style="float:right">:</span></p>
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
                                        <p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">
                                            Lower<span style="float:right">:</span></p>
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
                                        <p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">
                                            Canine Relationship<span style="float:right">:</span></p>
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
                                        <p style="display:inline-block;vertical-align:top;width:220px;font-weight:bold">
                                            Molar Relationship<span style="float:right">:</span></p>
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
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/10_setup3.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:50px 95px">
                            <div class="used_brackets">
                                <h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px">5.
                                    Overjet & Overbite<span style="float:right;margin-right:10px">:</span></h2>
                                <div style="text-align:left;display:inline-block">
                                    <div style="overflow:hidden;">
                                        <p style="float:left;width:160px">Overjet<span style="float:right">:</span></p>
                                        <div style="overflow:hidden;padding-left:10px">
                                            <div style="overflow:hidden">
                                                <p style="float:left;">
                                                    <? if ($_SESSION['overjet'] == "Ideal") {
                                                        echo "Ideal(2mm)";
                                                    } else if ($_SESSION['overjet'] == "custom") {
                                                        echo "Custom(" . $_SESSION['overjet_value'] . "mm)";
                                                    }
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
                                                    <? if ($_SESSION['overbite'] == "Ideal") {
                                                        echo "Ideal(2mm)";
                                                    } else if ($_SESSION['overbite'] == "custom") {
                                                        echo "Custom(" . $_SESSION['overbite_value'] . "mm)";
                                                    }
                                                    ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="used_brackets" style="margin-top:30px">
                                <h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px">6.
                                    Midline<span style="float:right;margin-right:10px">:</span></h2>
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
                                <? if ($_SESSION['midline'] == "improvement") { ?>
                                    <div style="text-align:left;display:inline-block;margin-left:20px">
                                        <? if ($_SESSION['arch'] != "lower") { ?>
                                            <div style="overflow:hidden">
                                                <p style="float:left;width:60px">Upper<span style="float:right">:</span>
                                                </p>
                                                <div style="overflow:hidden;padding-left:10px">
                                                    <div style="overflow:hidden">
                                                        <p style="float:left;">
                                                            <?
                                                            if ($_SESSION['midline_upper'] == "right") { ?>
                                                                <span>Right move <?= $_SESSION['midline_upper_right_value'] ?>mm</span>
                                                            <? } else if ($_SESSION['midline_upper'] == "left") { ?>
                                                                <span>Left move <?= $_SESSION['midline_upper_left_value'] ?>mm</span>
                                                            <? } else { ?>
                                                                <span>Not required</span>
                                                            <? }
                                                            ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?
                                        }
                                        if ($_SESSION['arch'] != "upper") {
                                            ?>
                                            <div style="overflow:hidden;margin-top:20px">
                                                <p style="float:left;width:60px">Lower<span style="float:right">:</span>
                                                </p>
                                                <div style="overflow:hidden;padding-left:10px">
                                                    <div style="overflow:hidden">
                                                        <p style="float:left;">
                                                            <?
                                                            if ($_SESSION['midline_lower'] == "right") { ?>
                                                                <span>Right move <?= $_SESSION['midline_lower_right_value'] ?>mm</span>
                                                            <? } else if ($_SESSION['midline_lower'] == "left") { ?>
                                                                <span>Left move <?= $_SESSION['midline_lower_left_value'] ?>mm</span>
                                                            <? } else { ?>
                                                                <span>Not required</span>
                                                            <? }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        <? } ?>

                                    </div>
                                <? } ?>
                            </div>
                            <div class="used_brackets" style="margin-top:40px">
                                <div>
                                    <h2 style="text-align:left;width:160px;float:left;display:inline-block">7. IPR<span
                                                style="float:right;margin-right:10px">:</span></h2>
                                    <p style="display:inline-block"><?= $_SESSION['ipr_option'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Prescription3 End -->
                    <!-- Prescription4 Start -->
                    <div id="result_setup4" class="result_box" style="margin-top:40px">
                        <div class="title" style="overflow:hidden;">
                            <p style="font-size:20px">Prescription4</p>
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/11_setup4.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:50px 95px">
                            <div class="used_brackets">
                                <div style="margin-bottom:30px">
                                    <h2 style="text-align:left;width:320px;display:inline-block">8. Occlusal opening
                                        device<span style="float:right;margin-right:30px">:</span></h2>
                                    <p style="display:inline-block">
                                        <? if ($_SESSION['occ_opening_device_option'] != "bite_ramp") { ?>
                                            None
                                        <? } else { ?>
                                            Bite ramp on the lingual side of the maxilla / <? if ($_SESSION['occ_opening_device_type'] == "incisor") {
                                                $Incisor_value = "";
                                                if ($_SESSION['incisor_option'] == "central") {
                                                    $Incisor_value = "Central incisor";
                                                } else {
                                                    $Incisor_value = "Lateral incisor";
                                                }
                                                echo "Incisor  / " . $Incisor_value;
                                            } else {
                                                echo "Canine";
                                            } ?>
                                        <? } ?>
                                    </p>
                                </div>
                                <h2 style="text-align:left;display:inline-block;vertical-align:top;width:300px"><?= $option_num ?>
                                    . Extraction<span style="float:right;margin-right:10px">:</span></h2>
                                <div style="text-align:left;display:inline-block;vertical-align:top;margin-left:20px">
                                    <p>
                                        <?
                                        if ($_SESSION['extraction'] == "none_tooth_e") {
                                            echo "None extraction";
                                        } else {
                                            echo "Extraction";
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div style="overflow:hidden;display:inline-block;margin:20px 0 0 20px">
                                    <p class="RL" style="margin-right:5px">R</p>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                            <button type="button" class="number" id="extraction_18"
                                                    name="upperBrackets"><?= $numberArray['extraction_18'] ?></button>
                                            <button type="button" class="number" id="extraction_17"
                                                    name="upperBrackets"><?= $numberArray['extraction_17'] ?></button>
                                            <button type="button" class="number" id="extraction_16"
                                                    name="upperBrackets"><?= $numberArray['extraction_16'] ?></button>
                                            <button type="button" class="number" id="extraction_15"
                                                    name="upperBrackets"><?= $numberArray['extraction_15'] ?></button>
                                            <button type="button" class="number" id="extraction_14"
                                                    name="upperBrackets"><?= $numberArray['extraction_14'] ?></button>
                                            <button type="button" class="number" id="extraction_13"
                                                    name="upperBrackets"><?= $numberArray['extraction_13'] ?></button>
                                            <button type="button" class="number" id="extraction_12"
                                                    name="upperBrackets"><?= $numberArray['extraction_12'] ?></button>
                                            <button type="button" class="number" id="extraction_11" name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['extraction_11'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                            <button type="button" class="number" id="extraction_48"
                                                    name="lowerBrackets"><?= $numberArray['extraction_48'] ?></button>
                                            <button type="button" class="number" id="extraction_47"
                                                    name="lowerBrackets"><?= $numberArray['extraction_47'] ?></button>
                                            <button type="button" class="number" id="extraction_46"
                                                    name="lowerBrackets"><?= $numberArray['extraction_46'] ?></button>
                                            <button type="button" class="number" id="extraction_45"
                                                    name="lowerBrackets"><?= $numberArray['extraction_45'] ?></button>
                                            <button type="button" class="number" id="extraction_44"
                                                    name="lowerBrackets"><?= $numberArray['extraction_44'] ?></button>
                                            <button type="button" class="number" id="extraction_43"
                                                    name="lowerBrackets"><?= $numberArray['extraction_43'] ?></button>
                                            <button type="button" class="number" id="extraction_42"
                                                    name="lowerBrackets"><?= $numberArray['extraction_42'] ?></button>
                                            <button type="button" class="number" id="extraction_41" name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['extraction_41'] ?></button>
                                        </div>
                                    </div>
                                    <div style="overflow:hidden;display:inline-block;float:left">
                                        <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                            <button type="button" class="number" id="extraction_21"
                                                    name="upperBrackets"><?= $numberArray['extraction_21'] ?></button>
                                            <button type="button" class="number" id="extraction_22"
                                                    name="upperBrackets"><?= $numberArray['extraction_22'] ?></button>
                                            <button type="button" class="number" id="extraction_23"
                                                    name="upperBrackets"><?= $numberArray['extraction_23'] ?></button>
                                            <button type="button" class="number" id="extraction_24"
                                                    name="upperBrackets"><?= $numberArray['extraction_24'] ?></button>
                                            <button type="button" class="number" id="extraction_25"
                                                    name="upperBrackets"><?= $numberArray['extraction_25'] ?></button>
                                            <button type="button" class="number" id="extraction_26"
                                                    name="upperBrackets"><?= $numberArray['extraction_26'] ?></button>
                                            <button type="button" class="number" id="extraction_27"
                                                    name="upperBrackets"><?= $numberArray['extraction_27'] ?></button>
                                            <button type="button" class="number" id="extraction_28" name="upperBrackets"
                                                    style="margin:0"><?= $numberArray['extraction_28'] ?></button>
                                        </div>
                                        <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                            <button type="button" class="number" id="extraction_31"
                                                    name="lowerBrackets"><?= $numberArray['extraction_31'] ?></button>
                                            <button type="button" class="number" id="extraction_32"
                                                    name="lowerBrackets"><?= $numberArray['extraction_32'] ?></button>
                                            <button type="button" class="number" id="extraction_33"
                                                    name="lowerBrackets"><?= $numberArray['extraction_33'] ?></button>
                                            <button type="button" class="number" id="extraction_34"
                                                    name="lowerBrackets"><?= $numberArray['extraction_34'] ?></button>
                                            <button type="button" class="number" id="extraction_35"
                                                    name="lowerBrackets"><?= $numberArray['extraction_35'] ?></button>
                                            <button type="button" class="number" id="extraction_36"
                                                    name="lowerBrackets"><?= $numberArray['extraction_36'] ?></button>
                                            <button type="button" class="number" id="extraction_37"
                                                    name="lowerBrackets"><?= $numberArray['extraction_37'] ?></button>
                                            <button type="button" class="number" id="extraction_38" name="lowerBrackets"
                                                    style="margin:0"><?= $numberArray['extraction_38'] ?></button>
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
                            <!-- <a href="/views/service/<?= $_SESSION['treatment_option1'] ?>/12_setup5.php">Edit</a> -->
                        </div>
                        <div class="result_content" style="padding:50px 95px">
                            <div class="used_brackets">
                                <h2 style="text-align:left;"><?= $option_num + 1 ?>. Eruption compensation</h2>
                                <div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
                                    <div style="margin-top:20px">
                                        <div style="text-align:left;display:inline-block;vertical-align:top">
                                            <div style="margin-bottom:20px">
                                                <p style="display:inline-block;">Eruption compensation<span
                                                            style="margin-left:10px">:</span></p>
                                                <div style="text-align:left;display:inline-block">
                                                    <p>
                                                        <? if ($_SESSION['eruption_incisor_option'] == "none") {
                                                            echo "None";
                                                        } else {
                                                            echo "Select teeth for compensation";
                                                        } ?>
                                                    </p>

                                                </div>
                                            </div>
                                            <div style="overflow:hidden;display:inline-block">
                                                <p class="RL" style="margin-right:5px">R</p>
                                                <div style="overflow:hidden;display:inline-block;float:left">
                                                    <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                                        <button type="button" class="number" id="incisor_15"
                                                                name="upperBrackets"><?= $numberArray['incisor_15'] ?></button>
                                                        <button type="button" class="number" id="incisor_14"
                                                                name="upperBrackets"><?= $numberArray['incisor_14'] ?></button>
                                                        <button type="button" class="number" id="incisor_13"
                                                                name="upperBrackets"
                                                                style="margin:0"><?= $numberArray['incisor_13'] ?></button>
                                                    </div>
                                                    <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                                        <button type="button" class="number" id="incisor_45"
                                                                name="lowerBrackets"><?= $numberArray['incisor_45'] ?></button>
                                                        <button type="button" class="number" id="incisor_44"
                                                                name="lowerBrackets"><?= $numberArray['incisor_44'] ?></button>
                                                        <button type="button" class="number" id="incisor_43"
                                                                name="lowerBrackets"
                                                                style="margin:0"><?= $numberArray['incisor_43'] ?></button>
                                                    </div>
                                                </div>
                                                <div style="overflow:hidden;display:inline-block;float:left">
                                                    <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                                        <button type="button" class="number" id="incisor_23"
                                                                name="upperBrackets"><?= $numberArray['incisor_23'] ?></button>
                                                        <button type="button" class="number" id="incisor_24"
                                                                name="upperBrackets"><?= $numberArray['incisor_24'] ?></button>
                                                        <button type="button" class="number" id="incisor_25"
                                                                name="upperBrackets"
                                                                style="margin:0"><?= $numberArray['incisor_25'] ?></button>
                                                    </div>
                                                    <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                                        <button type="button" class="number" id="incisor_33"
                                                                name="lowerBrackets"><?= $numberArray['incisor_33'] ?></button>
                                                        <button type="button" class="number" id="incisor_34"
                                                                name="lowerBrackets"><?= $numberArray['incisor_34'] ?></button>
                                                        <button type="button" class="number" id="incisor_35"
                                                                name="lowerBrackets"
                                                                style="margin:0"><?= $numberArray['incisor_35'] ?></button>
                                                    </div>
                                                </div>
                                                <p class="RL" style="margin-left:5px">L</p>
                                            </div>
                                        </div>
                                        <div style="text-align:left;display:inline-block;margin-left:40px;vertical-align:top">
                                            <div>
                                                <p style="display:inline-block;vertical-align:top;margin-bottom:20px">
                                                    Provide space for eruption of 2nd molars.<span
                                                            style="margin-left:10px">:</span></p>
                                                <div style="text-align:left;display:inline-block">
                                                    <p>
                                                        <? if ($_SESSION['eruption_molar_option'] == "none") {
                                                            echo "None";
                                                        } else {
                                                            echo "Select teeth for compensation";
                                                        } ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div style="overflow:hidden;">
                                                <p class="RL" style="margin-right:5px">R</p>
                                                <div style="overflow:hidden;display:inline-block;float:left">
                                                    <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
                                                        <button type="button" class="number" id="molar_17"
                                                                name="upperBrackets"
                                                                style="margin:0"><?= $numberArray['molar_17'] ?></button>
                                                    </div>
                                                    <div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                                                        <button type="button" class="number" id="molar_47"
                                                                name="lowerBrackets"
                                                                style="margin:0"><?= $numberArray['molar_47'] ?></button>
                                                    </div>
                                                </div>
                                                <div style="overflow:hidden;display:inline-block;float:left">
                                                    <div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">
                                                        <button type="button" class="number" id="molar_27"
                                                                name="upperBrackets"
                                                                style="margin:0"><?= $numberArray['molar_27'] ?></button>
                                                    </div>
                                                    <div style="padding-top:5px;overflow:hidden;padding-left:5px">
                                                        <button type="button" class="number" id="molar_37"
                                                                name="lowerBrackets"
                                                                style="margin:0"><?= $numberArray['molar_37'] ?></button>
                                                    </div>
                                                </div>
                                                <p class="RL" style="margin-left:5px">L</p>
                                            </div>
                                            <div style="margin-top:10px">
                                                <p style="display:inline-block">Step to start provide space<br>for
                                                    eruption of 2nd molars</p>
                                                <input disabled id="overbite_custom_n" type="text"
                                                       name="overbite_custom_n"
                                                       value="<?= $_SESSION['eruption_molar_value'] ?>" required
                                                       oninvalid="this.setCustomValidity('숫자를 입력해주세요.')"
                                                       oninput="setCustomValidity('')" placeholder="-----" maxlength="3"
                                                       style="margin-left:5px;width:60px;height:25px;padding:5px;display:inline-block;vertical-align:top">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 style="text-align:left;"><?= $option_num + 2 ?>. Additional request</h2>
                                <div style="margin:20px 0 0 30px;text-align:left;font-size:16px">
                                    <textarea disabled
                                              style="width:100%;height:100px"><?= $_SESSION['special_instruction'] ?></textarea>
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
                        for ($i = 0; $i < count($_SESSION['attchment_select_number']); $i++) {
                            echo "$('#attchment_" . $_SESSION['attchment_select_number'][$i] . "').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
                        }
                        echo "</script>";
                    }
                    ?>


                    <?

                    echo "<script>";
                    if ($_SESSION['eruption_incisor_option'] == "provide") {
                        for ($i = 0; $i < count($_SESSION['incisor_select_number']); $i++) {
                            echo "$('#incisor_" . $_SESSION['incisor_select_number'][$i] . "').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
                        }
                    }

                    if ($_SESSION['eruption_molar_option'] == "provide") {
                        for ($i = 0; $i < count($_SESSION['molar_select_number']); $i++) {
                            echo "$('#molar_" . $_SESSION['molar_select_number'][$i] . "').css({'background-color':'#07a2e8', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
                        }
                    }


                    echo "</script>";
                    ?>


                    <?
                    if (isset($_SESSION['brk_list_index'])) {
                        echo "<script>";
                        for ($i = 0; $i < count($_SESSION['brk_list_index']); $i++) {

                            ?>
                            var table_number = Number('<? echo $_SESSION['brk_list_index'][$i]; ?>');
                            var brk_nums = '<? echo $_SESSION['brk_list_brk_numbers'][$i]; ?>';
                            var color_key = brk_color_list(table_number);

                            var tr = "
                            <tr class=cellcolor> \
                                <td>" +table_number + "</td> \
                                <td><? echo $_SESSION['brk_list_company_name'][$i]; ?></td> \
                                <td><? echo $_SESSION['brk_list_product_name'][$i]; ?></td> \
                                <td><?
                                    if (!strpos($_SESSION['brk_list_brk_numbers'][$i], '#')) {
                                        echo $_SESSION['brk_list_brk_numbers'][$i];
                                    } else {
                                        $brk_numbers = explode("(", $_SESSION['brk_list_brk_numbers'][$i], 2);
                                        echo $brk_numbers[0] . "<span style='color:red'>(" . $brk_numbers[1] . "</span>";
                                    } ?></td> \
                                <td>
                                    <div style='display:inline-block;width: 20px;height: 20px;background-color:"+color_key + "'></div>
                                </td> \
                            </tr>";
                            $('#brk_list_tbody').append(tr);
                            brk_color_append(table_number,brk_nums);
                            <?
                            //echo "$('#brk_".$_SESSION['e_select_number'][$i]."').css({'background':'url(../../../resource/images/faq_up.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
                        }
                        echo "</script>";
                    }
                    ?>


                    <?


                    if ($_SESSION['extraction'] == "tooth_e") {
                        echo "<script>";
                        for ($i = 0; $i < count($_SESSION['e_select_number']); $i++) {
                            echo "$('#extraction_" . $_SESSION['e_select_number'][$i] . "').css({'background':'url(../../../resource/images/extraction_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
    $('#extraction_" . $_SESSION['e_select_number'][$i] . "').text('');";
                        }
                        echo "</script>";
                    }
                    ?>

            </form>
        </div>

        <div class="button_menu" style="margin:40px auto 0 auto; padding:10px; position:unset;transform:none">
            <!-- <button id="testbtn" type="button" onclick="createPdf();">createPdf</button> -->

            <!--		<a href="javascript:servicePopupClose();" class="service_close">Close</a>-->
            <a href="12_setup5.php" class="btn_black hover190">Back</a>
            <a href="javascript:window.open('../../../viewmodels/print.php','printPopup','height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes');"
               class="btn_black hover190">Print</a>

            <input type="button" value="Submit" class="btn_blue hover190 submit_summary">
        </div>

    </div>
</div><!-- close Container -->

<?
if (isset($_SESSION['diag_select_number'])) {
    echo "<script>";
    for ($i = 0; $i < count($_SESSION['diag_select_number']); $i++) {
        $number_values = explode(',', $_SESSION['diag_select_number'][$i], 2);
        if ($number_values[1] == "crown") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_" . $number_values[0] . "').text('');";

        } else if ($number_values[1] == "implant") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/implant_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_" . $number_values[0] . "').text('');";

        } else if ($number_values[1] == "telescopic_crown") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/Telescopic_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_" . $number_values[0] . "').text('');";

        } else if ($number_values[1] == "veneered_crown") {

            echo "$('#diagnostics_" . $number_values[0] . "').css({'background':'url(../../../resource/images/Veneered_crown_icon.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});
         $('#diagnostics_" . $number_values[0] . "').text('');";

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

        $(function () {
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
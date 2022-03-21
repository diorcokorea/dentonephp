<?php
session_start();
$config['cf_title'] = "Order Information";
//include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/pop_head.php");
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
//include "../models/db/querys.php";
//ini_set("display_errors", "1");
$user_code = $_SESSION['member_code'];
$patientkey = $_POST['patientkey'];
$patientServiceKey = $_POST['patientServiceKey'];
$drId = $_POST['drId'];

$patient_info_array = patient_r($patientkey);
$comment_array = comment_r($patientServiceKey);
$delivery = courier_id($patientServiceKey, $patientkey);
//print_r($delivery);
$service_info_array = service_r($patientkey, $patientServiceKey);
//환자코드, 유저코드, 서비스 코드
$service_history = sevicehistory_r((int)$patientkey, (int)$user_code, $patientServiceKey);
$patient_st = $patient_info_array[13];

$returnvals = serviceWorker_r($patientServiceKey);//skey
$json_val = json_decode($returnvals[0]['info'], true);
$mana_info = workerinfo_r($json_val['담당자']);
//print_r(json_decode($service_info_array[12],true));
//print_r($service_info_array);
//print_r($patient_st);
//  print_r($patientkey);
//   echo "<br>";
//  print_r($user_code);
//   echo "<br>";
// print_r($patient_info_array);
//  echo "<br>";
//  print_r( $service_history);

//var_dump($service_info_array);
//var_dump("SERVICE_SERVICE:" . $service_info_array[6]);
//var_dump("<br />_____service_history_____");
//print_r($service_history);
//print_r(json_decode($service_info_array[12], true)['classification']);
//echo "<script>console.log(" . json_decode($service_info_array[12], true) . ")</script>";
$classification = array();
foreach (json_decode($service_info_array[12], true)['classification'] as $key => $value) {

    if ($key == "etc_value") {
        $etc_value = $value;
    }

    if ($value == "on") {

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

        array_push($classification, $print_value);
    }
}

//print_r($classification);

?>
    <div class="serviceContainer">
        <form name="key_form" id="key_form" method="POST">
            <input type="hidden" id="patientkey" name="patientkey" value="<?= $patientkey ?>" />
            <input type="hidden" id="patientServiceKey" name="patientServiceKey" value="<?= $patientServiceKey ?>" />
            <input type="hidden" id="patient_st" name="patient_st" value="<?= $patient_st ?>" />
            <input type="hidden" id="service_his_key" name="service_his_key"
                   value="<?= $service_history[0]['service_history_id'] ?>" />
        </form>
        <script src="../resource/js/jquery.bxslider.js"></script>

        <div class="test">
            <div class="patientprofile_content">
                <div class="patient_info">
                    <p class="patient_photo"><img src="/<?
                        if ($service_history[0]['file_path'] != null) {
                            echo $service_history[0]['file_path'];
                        } else {
                            if ($patient_info_array[2] == "male") {
                                echo "resource/images/male_icon.png";
                            } else {
                                echo "resource/images/female_icon.png";
                            }
                        }
                        ?>">
                    </p>
                    <div class="patient_text">
                        <div style="overflow:hidden">
                            <h2><?= str_replace(",", " ", $patient_info_array[1]) ?></h2>
                            <a class="btn_black hover90" style="width:90px; height:50px; line-height:45px; margin:0px;"
                               id="patient_info_edit" href="javascript:void(0);">Edit</a>
                        </div>
                        <div style="border-bottom:1px solid #d5d5d5;padding-bottom:10px">
                            <div class="info">
                                <p class="subject">Patient ID<span>:</span></p>
                                <p class="info_content"><?= $patient_info_array[0] ?></p>
                            </div>
                            <div class="info">
                                <p class="subject">Date of birth<span>:</span></p>
                                <p class="info_content"><?= $patient_info_array[4] ?></p>
                            </div>
                            <div class="info">
                                <p class="subject">Clinic name<span>:</span></p>
                                <p class="info_content"><?= $patient_info_array[8] ?></p>
                            </div>
                        </div>
                        <div>
                            <div class="patient_option">
                                <p class="option_title">Design option<span>:</span></p>
                                <p class="option_content"><? echo json_decode($service_info_array[12], true)['treatment_option1']; ?>
                                    , <? echo json_decode($service_info_array[12], true)['treatment_option2']; ?></p>
                            </div>
                            <div class="patient_option">
                                <p class="option_title">End date<span>:</span></p>
                                <p class="option_content">
                                    <?
                                    // @LUCAS 1.5차
                                    if ($service_history[0]['status_id'] === 19) {
                                        echo explode(" ", $service_history[0]['sdate'])[0];
                                    } else {
                                        echo "TBD";
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="patient_option">
                                <p class="option_title">Classification<span>:</span></p>
                                <p class="option_content" style="width:420px;">
                                    <? for ($ci = 0; $ci < count($classification); $ci++) {

                                        if ($classification[$ci] == "Etc") {
                                            $classification[$ci] = $classification[$ci] . "(" . $etc_value . ")";
                                        }

                                        if ($ci == (count($classification) - 1)) {
                                            echo $classification[$ci];
                                        } else {
                                            echo $classification[$ci] . ", ";
                                        }
                                    } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="memobox" style="width:650px;">
                    <p>Memo</p>
                    <div class="form-group" style="position:relative; float:left; ">
                        <textarea class="form-control-sign_up" style="width:550px; height:120px; margin-right:0px;" id="memo"
                                  disabled><?= $patient_info_array[14] ?></textarea>
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <a class="btn_black hover170" style="width:90px; height:50px; line-height:20px; margin:0px;"
                       id="btn_memo_update" href="javascript:void(0);">Edit</a>
                </div>
                <div class="commentbox">
                    <p style="">Comment</p>
                    <div class="form-group" style="position:relative; float:left;">
                        <textarea class="form-control-sign_up" id="comment_area"
                                  style="width:1403px; height:120px;"></textarea>
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <a class="btn_black hover90"
                       style="width:90px; margin:0px; padding:0px; line-height:45px; float:right;"
                       href="javascript:insertCommet(1);">Send</a>
                </div>
                <div class="comment">

                    <?
                    //print_r($comment_array);
                    for ($i = 0; $i < count($comment_array); $i++) {
                        ?>

                        <div class="view_comment">
                            <div class="comment_name">
                                <p><? if ($comment_array[$i]['type_id'] == 1) {
                                        echo "Doctor Comment";
                                    } else {
                                        echo "Lab Comment";
                                    } ?>
                                </p>
                                <p class="date"><?= $comment_array[$i]['commentDate'] ?></p>
                            </div>
                            <div class="message">
                                <? if ($comment_array[$i]['type_id'] == 1) { ?>
                                    <p class="dmessage" style="max-width:1196px; white-space:unset;"><?= $comment_array[$i]['content'] ?></p>
                                <? } else if ($comment_array[$i]['type_id'] == 2) { ?>
                                    <p class="lmessage" style="max-width:1196px; white-space:unset;"><?= $comment_array[$i]['content'] ?></p>
                                <? } ?>

                            </div>
                        </div>

                        <?
                    }
                    ?>

                </div>
            </div>


            <div class="content" style="background-color:#fff;padding:10px;height:auto">
                <table class="profile_table">
                    <colgroup>
                        <col width="35%">
                        <col width="35%">
                        <col width="30%">
                    </colgroup>
                    <thead>
                    <tr>
                        <td class="textleft">Design option : <?= $service_history[0]['full_name'] ?>
                            Service(<?= explode(" ", $service_history[0]['sdate'])[0] ?>)
                        </td>
                        <td>Designer : <? if ($json_val['담당자'] != null) {
                                echo str_replace(",", " ", $mana_info[0]['name']);
                            } else {
                                echo "-----";
                            } ?></td>
                        <td class="textright"><!--<a id="patientbutton" class="patient_button_minus"
                                             href="javascript:doDisplay();"></a>--></td>
                    </tr>
                    </thead>
                </table>
                <div class="profile_table" style="width:100%">
                    <div id="myDIV">

                        <?

                        //히스토리별 카운트 확인
                        $modi_submit_count = 0;
                        for ($t = 0; $t < count($service_history); $t++) {

                            if ($service_history[$t]['status_id'] == 21) {
                                $modi_submit_count = $t;
                                break;
                            }
                        }

                        //                        print_r($service_history);
                        $displayRowIndex = 0;
                        for ($i = 0; $i < count($service_history); $i++) {

                            if ($service_history[$i]['status_id'] == 1 && $patient_st != 1) {

                            } else {
                                $displayRowIndex++;
                                ?>
                                <div class="cellcolor">
                                    <div style="display:inline-block; width:25%; padding: 30px 0 30px 60px;"
                                         class="textleft"><?= $service_history[$i]['sdate'] ?></div>
                                    <div style="display:inline-block"><?= str_replace(",", " ", $service_history[$i]['name']) ?></div>
                                    <div style="float:right;padding:17px 60px 17px 0">
                                        <?
                                        // @LUCAS 1.5 의사가 처방전을 회수하는 기능
                                        // tb_status 테이블에 22 처방전 회수를 만듬
                                        // print_r($service_history[$i]['status_id']);
                                        if (
                                            $displayRowIndex == 1
                                            &&
                                            (
                                                /** This will become [22]처방전 수정중 edit order **/
                                                $service_history[$i]['status_id'] == 20 /** 처방전 제출/order received(order submitted) **/
                                                ||
                                                $service_history[$i]['status_id'] == 21/** 처방전 수정 제출/edited order received  */
                                            )
                                        ) {
                                            ?>
                                            <button class='btn_black hover200' id='btnPrescriptionRetrieve'>
                                                Prescription retrieve
                                            </button>
                                            <?
                                        }
                                        ?>

                                        <?
                                        switch ($service_history[$i]['status_id']) {
                                            case 1:
                                                //처방전 작성 중
                                                if ($patient_st == 1) {
                                                    echo "<button class='btn_black hover100 setupreport' style='width:90px;'>Continue</button>";
                                                } else {
                                                    echo "";
                                                }

                                                break;
                                            case 22:
                                                if ($displayRowIndex == 1) {
                                                    //처방전 회수 후 수정
                                                    echo "<button class='btn_black hover190 setupreport' style='width:160px;'>Edit prescription</button>";
                                                }
                                                break;

                                            case 2:
                                                //처방전 접수
                                                if ($patient_st == 2) {
                                                    // 현재상태
                                                } else {
                                                    echo "";
                                                }
                                                break;

                                        case 3:
                                            //접수 반려 /menu 없음

                                        if ($patient_st == 3 && $i == 0) {
                                            echo "<button class='btn_black hover190 setupreport' style='width:190px;'>Edit prescription</button>
                                              <button class='btn_black hover100' style='width:90px;' id='messege_view_" . $service_history[$i]['service_history_id'] . "'>Message</button>";
                                            ?>
                                            <!-- 접수 반려 팝업 보기 -->
                                            <div id="reject_message_view_<?= $service_history[$i]['service_history_id'] ?>"
                                                 class="reject_message_view dis_none">
                                                <div class="popup_title">
                                                    <h2>Message</h2>
                                                </div>
                                                <div class="popup_content">
                                                <textarea placeholder="Message."
                                                          style="width:600px;height:240px;resize:none"
                                                          disabled><?= returnservice_r($service_history[$i]['service_history_id']) ?></textarea>
                                                </div>
                                                <div class="popup_button">
                                                    <button class="btn_black hover190" id="btn_message_view_close">Close
                                                    </button>
                                                </div>
                                            </div>


                                            <script>
                                                $(document).ready(function () {

                                                    // 접수반려 메시지 보기 닫기
                                                    $('#messege_view_<?=$service_history[$i]["service_history_id"]?>').click(function () {
                                                        $('#reject_message_view_<?=$service_history[$i]["service_history_id"]?>').css("display", 'block');
                                                    });

                                                    $('#btn_message_view_close_<?=$service_history[$i]["service_history_id"]?>').click(function () {
                                                        $('#reject_message_view_<?=$service_history[$i]["service_history_id"]?>').css("display", 'none');
                                                    });

                                                });
                                            </script>


                                        <?
                                        }else {
                                        echo "<button class='btn_black hover150' id='messege_view_" . $service_history[$i]['service_history_id'] . "'>Message</button>";
                                        ?>
                                            <!-- 접수 반려 팝업 보기 -->
                                            <div id="reject_message_view_<?= $service_history[$i]['service_history_id'] ?>"
                                                 class="reject_message_view dis_none">
                                                <div class="popup_title">
                                                    <h2>Message</h2>
                                                </div>
                                                <div class="popup_content">
                                                <textarea placeholder="Message."
                                                          style="width:600px;height:240px;resize:none"
                                                          disabled><?= returnservice_r($service_history[$i]['service_history_id']) ?></textarea>
                                                </div>
                                                <div class="popup_button">
                                                    <button class="btn_black hover190"
                                                            id="btn_message_view_close_<?= $service_history[$i]['service_history_id'] ?>">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>


                                            <script>
                                                $(document).ready(function () {

                                                    // 접수반려 메시지 보기 닫기
                                                    $('#messege_view_<?=$service_history[$i]["service_history_id"]?>').click(function () {
                                                        $('#reject_message_view_<?=$service_history[$i]["service_history_id"]?>').css("display", 'block');
                                                    });

                                                    $('#btn_message_view_close_<?=$service_history[$i]["service_history_id"]?>').click(function () {
                                                        $('#reject_message_view_<?=$service_history[$i]["service_history_id"]?>').css("display", 'none');
                                                    });

                                                });
                                            </script>


                                        <?
                                        }
                                        break;

                                        case 4:
                                            //처방전 접수 완료 /menu 없음
                                            if ($patient_st == 4) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 5:
                                            //석고 보내는 중
                                            if ($patient_st == 5) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 6:
                                            //석고 수령 완료

                                            if ($patient_st == 6) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 7:
                                            //셋업 진행 중

                                            if ($patient_st == 7) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 8:
                                            //셋업 내부 검토 요청 /menu 없음
                                            if ($patient_st == 8) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 9:
                                            //셋업 내부 검토 완료 /menu 없음
                                            if ($patient_st == 9) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 10:
                                            //내부 수정 요청 /menu 없음
                                            if ($patient_st == 10) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 11:
                                            //내부 변경 제출 /menu 없음
                                            if ($patient_st == 11) {
                                                // 현재상태
                                            } else {
                                                echo "";
                                            }
                                            break;

                                        case 12:
                                            //셋업 검토 요청

                                            echo "<a href='onecheck://open?DrAccountID=$drId&ServiceID=$patientServiceKey&ServiceHistoryID=" . $service_history[$i]['service_history_id'] . "&LoginAccountID=$user_code&Type=0&ServiceType=2&DNS=" . $_SERVER['HTTP_HOST'] . "' class='btn_black hover90' style='width:90px; line-height: 45px;' onclick='return confirm(\"Do you want to run the app?\");'>VIEWER</a>";

                                            break;

                                        case 13:
                                        //수정 요청

                                        ?>

                                            <!-- 수정 요청 코멘트 팝업 -->
                                            <div class="inner_edit dis_none" id="modi_msg_<?= $i ?>">
                                                <div class="popup_title">
                                                    <h2>Message</h2>
                                                </div>
                                                <div class="popup_content">
                                                    <div>
                                                        <p style="font-size:18px;">Message:</p>
                                                        <textarea
                                                                style="width:600px;height:240px;resize:none;margin-top:10px"
                                                                disabled><? $request_array = request_message($patientServiceKey, $service_history[$i]['service_history_id'], 1);
                                                            echo $request_array[0]['comment'];
                                                            ?></textarea>
                                                    </div>
                                                    <div>
                                                        <p style="font-size:18px;margin:10px 0">Capture list</p>
                                                        <div class="capture_list">
                                                            <?
                                                            $image_list = json_decode(str_replace("\\", "/", $request_array[0]['image_list']), true);
                                                            for ($p = 0; $p < count($image_list); $p++) {
                                                                ?>
                                                                <p>
                                                                    <img id="edit_image_<?= $service_history[$i]['service_history_id'] . "_" . $p ?>"
                                                                         name="edit_image_<?= $service_history[$i]['service_history_id'] ?>"
                                                                         src="<?= '../data/' . $image_list[$p]['path'] ?>">
                                                                </p>
                                                                <?
                                                            } ?>
                                                        </div>
                                                        <p style="text-align:center;font-size:16px;margin-top:10px"><span
                                                                    id="edit_image_count_<?= $i ?>">1</span>/<span><?= count($image_list) ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="popup_button">
                                                    <button class="btn_black hover190"
                                                            id="btn_modi_msg_close_<?= $i ?>">Close
                                                    </button>
                                                </div>
                                            </div>


                                            <!-- 이미지 확대 팝업 -->
                                            <div class="image_view dis_none" id="inner_edit_img_box_<?= $i ?>"
                                                 style="width:800px;background-color:#fff;overflow:hidden">
                                                <div class="popup_title">
                                                    <h2>Capture images</h2>
                                                </div>
                                                <div class="popup_button" style="margin:40px 0;padding:0 50px">
                                                    <a class="basiccolor" id="btn_save_img_<?= $i ?>" download
                                                       href="">Save</a>
                                                </div>
                                                <div class="popup_content"
                                                     id="<?= $service_history[$i]['service_history_id'] ?>"
                                                     style="width:100%; overflow:hidden;padding:0 50px 20px 50px;position:relative;text-align:center">
                                                    <div class="slider" id="img_slider_<?= $i ?>">
                                                        <?
                                                        $image_list = json_decode(str_replace("\\", "/", $request_array[0]['image_list']), true);
                                                        for ($j = 0; $j < count($image_list); $j++) {
                                                            ?>
                                                            <div class="div_img_slider picture_image" style="width:auto"
                                                                 name="div_inner_img_slider_<?= $service_history[$i]['service_history_id'] ?>"
                                                                 id="div_rqmg_slider_<?= $j + 1 ?>">
                                                                <img name="edit_image"
                                                                     id="<?= $service_history[$i]['service_history_id'] ?>_<?= $j + 1 ?>"
                                                                     src="<?= '../data/' . $image_list[$j]['path'] ?>">
                                                            </div>
                                                            <?
                                                        } ?>
                                                    </div>
                                                    <p style="text-align:center;font-size:16px;position:absolute;bottom:38px;transform: translateX(-50%); left: 50%;">
                                                        <span id="img_select_num_<?= $service_history[$i]['service_history_id'] ?>">1</span>/<span
                                                                id="img_slider_count_<?= $i ?>"><?= count($image_list) ?></span>
                                                    </p>
                                                </div>

                                                <div class="popup_button">
                                                    <button class="btn_black hover190"
                                                            id="inner_edit_img_box_close_<?= $i ?>">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>


                                            <script>
                                                $(document).ready(function () {

                                                    var temp1234_<?=$i?> = $('#img_slider_<?=$i?>').bxSlider({
                                                        auto: false,
                                                        pager: false,
                                                        touchEnabled: false,
                                                        startSlide: 0,
                                                        speed: 0,
                                                        randomStart: false
                                                    });


                                                    //외부 수정요청 메시지 및 이미지 보기
                                                    $('#btn_modi_message_<?=$i?>').click(function () {

                                                        $('#modi_msg_<?=$i?>').css("display", 'block');
                                                    });

                                                    $('#btn_modi_msg_close_<?=$i?>').click(function () {
                                                        $('#modi_msg_<?=$i?>').css("display", 'none');
                                                    });

                                                    // 이미지 박스 팝업 열기
                                                    $('img[name=edit_image_<?=$service_history[$i]['service_history_id']?>]').click(function (e) {

                                                        var select_id_arry = $(this).attr('id').split('_');
                                                        var select_id = (Number(select_id_arry[3]) + 1);
                                                        $('#inner_edit_img_box_<?=$i?>').css("display", "block");
                                                        if ((select_id - 1) == 0) {
                                                            temp1234_<?=$i?>.goToSlide(1);
                                                            temp1234_<?=$i?>.goToSlide(0);
                                                        } else {
                                                            temp1234_<?=$i?>.goToSlide(select_id - 1);
                                                        }
                                                        //alert(select_id-1);

                                                        $("#img_select_num_<?=$service_history[$i]['service_history_id']?>").text(select_id);
                                                        /*
                                                        $("div[name=div_inner_img_slider_<?=$service_history[$i]['service_history_id']?>]").each(function(ev) {
								//alert($(this).attr('id').split('_')[3]);
								//alert(select_id);

								if ($(this).attr('id').split('_')[3] == select_id) {
                                     $(this).attr('aria-hidden','false');
                                  }else{
								     $(this).attr('aria-hidden', 'true');
								  }

                               });
							   */

                                                    });

                                                    $('#inner_edit_img_box_close_<?=$i?>').click(function (e) {
                                                        $('#inner_edit_img_box_<?=$i?>').css("display", "none");

                                                    });


                                                    $('#btn_save_img_<?=$i?>').click(function (e) {
                                                        $("div[name=div_inner_img_slider_<?=$service_history[$i]['service_history_id']?>]").each(function (ev) {
                                                            if ($(this).attr('aria-hidden') == "false") {
                                                                $('#btn_save_img_<?=$i?>').attr("href", $(this).children('img').attr('src'));
                                                            }
                                                        });
                                                    });


                                                });
                                            </script>

                                            <?

                                            echo "<button class='btn_black hover190' id='btn_modi_message_" . $i . "'>Message</button>";

                                            break;

                                            case 14:
                                                //변경 제출
                                                if ($patient_st == 14) {
                                                } else {
                                                    $submitHisId = $service_history[$i]['service_history_id'];
                                                    echo "<button class='btn_black hover100'  id='change_message_view'>Message</button><a href='onecheck://open?DrAccountID=$drId&ServiceID=$patientServiceKey&ServiceHistoryID=" . $service_history[$i]['service_history_id'] . "&LoginAccountID=$user_code&Type=0&ServiceType=2&DNS=" . $_SERVER['HTTP_HOST'] . "' class='btn_black hover90' style='width:90px; line-height: 45px;' onclick='return confirm(\"Do you want to run the app?\");'>VIEWER</a>";
                                                }
                                                break;

                                            case 15:
                                                //검토 완료
                                                break;

                                            case 16:
                                                //장치 제작 중
                                                if ($patient_st == 16) {
                                                    // 현재상태
                                                } else {
                                                    echo "";
                                                }
                                                break;

                                            case 17:
                                                ///장치 제작 완료

                                                if ($patient_st == 17) {
                                                    // 현재상태
                                                } else {
                                                    echo "";
                                                }
                                                break;

                                            case 18:
                                                //장치 배송 중
                                                if ($patient_st == 18) {
                                                    echo "<a class='btn_black hover150' style='width:150px; line-height: 45px;' href='" . $delivery[0]['urlAdress'] . "' onclick='window.open(this.href, \"_blank\", \"width=800, height=600\"); return false;'>Delivery status</a>";

                                                } else {

                                                }
                                                break;

                                            case 19:
                                                // 서비스 완료

                                                if ($patient_st == 19) {
                                                    echo "<a class='btn_black hover150' style='width:150px; line-height: 45px;' href='" . $delivery[0]['urlAdress'] . "' onclick='window.open(this.href, \"_blank\", \"width=800, height=600\"); return false;'>Delivery status</a>";
                                                } else {
                                                    echo "<a class='btn_black hover150' style='width:150px; line-height: 45px;' href='" . $delivery[0]['urlAdress'] . "' onclick='window.open(this.href, \"_blank\", \"width=800, height=600\"); return false;'>Delivery status</a>";
                                                }

                                                break;

                                            case 20:
                                                //처방전 제출
                                                $summary = true;

                                                for ($j = 0; $j < count($service_history); $j++) {
                                                    if ($service_history[$j]['status_id'] == 21) {
                                                        $summary = false;
                                                        break;
                                                    }
                                                }

                                                if ($summary) {
                                                    // echo "<button class='profile_button' id='btn_service_info'>Order Summary</button>";
                                                    echo "<button class='btn_black hover150' style='width:150px;' id='btn_service_info'>Order Summary</button>";
                                                }
                                                // if ($patient_st == 20) {

                                                //  }else {

                                                // }
                                                break;

                                            case 21:
                                                ///continue with your prescription 제출
                                                if ($modi_submit_count == $i) {
                                                    // echo "<button class='profile_button' id='btn_service_info'>Order Summary</button>";
                                                    echo "<button class='btn_black hover150' style='width:150px;' id='btn_service_info'>Order Summary</button>";
                                                }
                                                // if ($patient_st == 21) {
                                                //     // 현재상태
                                                //     echo "<button class='profile_button'>처방전 수정 요청 메시지 보기</button><button class='profile_button'>처방전 수정</button>";
                                                // }else {
                                                //     echo "<button class='profile_button'>처방전 수정 요청 메시지 보기</button>";
                                                // }
                                                break;

                                            case 22:
                                                // doing nothing for 22 in doctor
                                                break;
                                            //                    case 22:
                                            ///처방전 수정 제출
//                         echo "<button class='profile_button' id='btn_service_info'>Order Summary</button>";
//                         if ($patient_st == 22) {
//                             // 현재상태
//                         }else {
//                             echo "";
//                      }
//                       break;
                                            default:
                                                echo "";
                                                break;
                                        }
                                        ?>
                                    </div>
                                </div>

                                <?
                            }
                        }
                        ?>

                    </div>
                </div>
                <!-- <button id="testbtn" type="button" onclick="createPdf();">createPdf</button> -->
            </div>
        </div>
    </div>
<?php //include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/service_tail.php"); ?>


    <script>
        function closeWindow() {
            opener.location.reload();
            window.close();
        }

        $(document).ready(function () {

            $("#btnPrescriptionRetrieve").on("click", function () {

                if (!confirm("Do you want to return the order back?")) {
                    return;
                }

                $.ajax({
                    url: 'serviceHistoryUpdate.php',
                    type: 'POST',
                    data: {
                        'patientkey': $('#patientkey').val(),
                        'service_key': $('#patientServiceKey').val(),
                        "drId": '<?= $drId ?>',
                        'status': 22,
                    },
                    dataType: 'json',
                    success: function (data) {
                        // console.log('data', data);

                        if (data && data.result === "fail") {
                            alert(data.message || data.result);
                            location.reload();
                        }

                        if (data && data.result === "success") {
                            location.reload();
                        }
                    }
                });
            });


            //숫자 변경
            $('.bx-prev').click(function (e) {

                var id = $(this).parent('div').parent('div').parent('div').parent('div').attr('id');

                $("div[name=div_inner_img_slider_" + id + "]").each(function (ev) {

                    if ($(this).attr('aria-hidden') == "false") {
                        var idarray = this.id.split("_");
                        $("#img_select_num_" + id).text(idarray[idarray.length - 1]);

                    }
                });


            });

            $('.bx-next').click(function (e) {
                var id = $(this).parent('div').parent('div').parent('div').parent('div').attr('id');
                $("div[name=div_inner_img_slider_" + id + "]").each(function (ev) {

                    if ($(this).attr('aria-hidden') == "false") {
                        var idarray = this.id.split("_");
                        $("#img_select_num_" + id).text(idarray[idarray.length - 1]);

                    }
                });
            });

            var commentHeight = $('.comment');
            $('.comment').scrollTop(commentHeight[0].scrollHeight);

            /*************** 이어서 작성 ****************/
            $('.setupreport').click(function () {

                // window.open(
                //     "patientServiceEdit.php",
                //     'patientServiceEditPopup',
                //     'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
                // );
                var form = document.getElementById("key_form");
                //alert(form.)
                form.action = "patientServiceEdit.php";
                form.method = "post";
                // form.target = "patientServiceEditPopup";
                form.submit();

            });

            /*************** 서비스 요약 ****************/
            $('#btn_service_info').click(function (e) {

                // window.open(
                //     "patientServiceInfo.php",
                //     'patientServiceInfoPopup',
                //     'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
                // );
                var form = document.getElementById("key_form");
                //alert(form.)
                form.action = "patientServiceInfo.php";
                form.method = "post";
                // form.target = "patientServiceInfoPopup";
                form.submit();

            });

            /*************** 환자 정보 수정 ****************/
            $('#patient_info_edit').click(function (e) {

                window.open(
                    "patientprofile_edit.php",
                    'patientServiceInfoPopup',
                    'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
                );
                var form = document.getElementById("key_form");
                //alert(form.)
                form.action = "patientprofile_edit.php";
                form.method = "post";
                form.target = "patientServiceInfoPopup";
                form.submit();

            });

            /*************** 메모 수정 ****************/
            $('#btn_memo_update').click(function (e) {


                if ($('#btn_memo_update').text().trim() == "Edit") {
                    $('#btn_memo_update').text('Input');
                    $('#memo').prop('disabled', false);
                } else if ($('#btn_memo_update').text().trim() == "Input") {
                    insertMemo();
                }


            });

            //Prescription summary 요청 메시지 보기
            $('#messege_view').click(function () {
                $('.reject_message_view').css("display", 'block');
            });

            $('#btn_message_view_close').click(function () {
                $('.reject_message_view').css("display", 'none');
            });


            //변경제출 메시지 보기
            $('#change_message_view').click(function () {
                $('.change_message_view').css("display", 'block');
            });

            $('#change_message_view_close').click(function () {
                $('.change_message_view').css("display", 'none');
            });


            //수정 요청 메시지 및 이미지 보기 여기여기
            $('#btn_modi_message').click(function () {
                $('.edit_request_message').css("display", 'block');
            });

            $('#btn_modi_message_close').click(function () {
                $('.edit_request_message').css("display", 'none');
            });


        });//ready


        function insertMemo() {
            $.ajax({
                cache: false,
                url: "../viewmodels/doctorMemo.php",
                type: 'POST',
                data: {
                    'serviceKey': $('#patientServiceKey').val(),
                    'patientKey': $('#patientkey').val(),
                    'memo': $('#memo').val()
                },
                dataType: 'html',
                success: function (data) {
                    //alert(data);
                    location.reload();
                }, // success
                error: function (xhr, status) {
                    alert(xhr + " : " + status);
                }
            });
        }

        function doDisplay() {
            var con = document.getElementById("myDIV");
            if (con.style.display == 'none') {
                con.style.display = 'block';
            } else {
                con.style.display = 'none';
            }
            var con = document.getElementById("patientbutton");
            if (con.className == 'patient_button_plus') {
                con.className = 'patient_button_minus';
            } else {
                con.className = 'patient_button_plus';
            }
        }
    </script>

<? include("patientprofile_layer.php"); ?>


<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>
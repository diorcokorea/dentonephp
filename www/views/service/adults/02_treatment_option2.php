<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/head.service.php");
$service = 2;
?>

    <div class="content" style="background-color:#fff; height:713px;">

        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
        ?>

        <form id='service_info_form' name="service_info_form" action='service_info.php' method='post'>
            <div class="treatment_option2_inner">
                <div class="service_title">
                    <h2>Aligner step</h2>
                </div>
                <label class="treatment_option2_background" for="DentOne10" id="label_DentOne10">
                    <div class="treatment2_title">
                        <input type="radio" id="DentOne10"
                               name="treatment_option2" 
                               <? echo ($_SESSION['treatment_option2'] == "DentOne10" || $_SESSION['treatment_option2'] == "") ?  "checked" : "" ;  ?>
                               value="DentOne10" class="treatment_option1" />
                        <p>DentOne10</p>
                        <span>Up to 10 steps</span>
                    </div>
                </label>
                <label class="treatment_option2_background" for="DentOne20" id="label_DentOne20">
                    <div class="treatment2_title">
                        <input type="radio" id="DentOne20"
                               name="treatment_option2" 
                               <? echo ($_SESSION['treatment_option2'] == "DentOne20") ?  "checked" : "" ;  ?>
                               value="DentOne20" class="treatment_option1" />
                        <p>DentOne20</p>
                        <span>Up to 20 steps</span>
                    </div>
                </label>
                <label class="treatment_option2_background" for="DentOne_Regular" id="label_DentOne_Regular">
                    <div class="treatment2_title">
                        <input type="radio" id="DentOne_Regular"
                               name="treatment_option2" 
                               <? echo ($_SESSION['treatment_option2'] == "DentOne Regular") ?  "checked" : "" ;  ?>
                               value="DentOne Regular" class="treatment_option1" />
                        <p>DentOne Regular</p>
                        <span>Unlimited steps</span>
                    </div>
                </label>
                <label class="treatment_option2_background" for="DentOne_Regular_AP" id="label_DentOne_Regular_AP">
                    <div class="treatment2_title">
                        <input type="radio" id="DentOne_Regular_AP"
                               name="treatment_option2" 
                               <? echo ($_SESSION['treatment_option2'] == "DentOne Regular AP") ?  "checked" : "" ;  ?>
                               value="DentOne Regular AP" class="treatment_option1" />
                        <p>DentOne Regular AP</p>
                        <span>Unlimited steps</span>
                        <span class="ap_regular_text"><span class="ap_icon"><img
                                        src="/resource/images/ap_text_icon_red.png" /></span><span class="ap_text"
                                                                                                   style="font-size:14px;color:red">Re-scan is required for next stage.</span></span>
                    </div>
                </label>
            </div>

            <div class="button_menu" style="padding:10px;">
<!--                <a href="javascript:servicePopupClose();" class="service_close">Close</a>-->
                <input type="submit" id="btn_pre" value="Back" class="btn_black hover190">
                <input type="submit" id="btn_next" value="Next" class="btn_blue hover190">
            </div>
        </form>
    </div>

    <script>

        $(document).ready(function () {

            $('input[name=treatment_option2]').each(function (e) {
                if ($(this).prop('checked')) {
                    var id = this.id;
                    $(".treatment_option2_background").each(function (ev) {
                        if ($(this).attr("for") != id) {
                            $(this).css('border', '2px solid #d2d2d2');
                        } else {
                            $(this).css('border', '2px solid #07a2e8');
                        }
                    });
                }
            });


            $('input[name=treatment_option2]').on('click', function (e) {
                $("#" + "label_" + this.id).css('border', '2px solid #07a2e8');
                var id = this.id;
                $(".treatment_option2_background").each(function (ev) {

                    if ($(this).attr("for") != id) {
                        $(this).css('border', '2px solid #d2d2d2');
                    }
                });
            });

            $('#btn_pre').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='01_treatment_option1.php' />");
            });

            $('#btn_next').on('click', function (event) {
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='03_patientinfo.php' />");
            });

        });
    </script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>
<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.service.php');
$service = 1;
?>

<div class="content" style="background-color:#fff; height:713px;">

    <?php
    if ($_SESSION['treatment_option1'] == "Child") {
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/Child/service_tab.php");
    } else {
        include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
    }
    ?>

    <form id='service_info_form' name="service_info_form" action='service_info.php' method='post'>
        <div class="treatment_option1_inner">
            <div class="service_title">
                <h2>Adult/Child</h2>
            </div>
            <label class="treatment_option1_background" id="label_Adult" for="Adult" style="float:left">
                <div class="treatment_title">
                    <input type="radio" id="Adult"
                           name="treatment_option1" 
                           <? echo ($_SESSION['treatment_option1'] == "Adults" || $_SESSION['treatment_option1'] == "") ?  "checked" : "" ;  ?>
                           
                           value="Adults" class="treatment_option1" />
                    <p>Adult</br>(including teenager)</p>
                    <span class="testst">Adult with permanent dentition<br> and teenager with mature mixed dentition</span>
                </div>
            </label>
            <label class="treatment_option1_background" id="label_Child" for="Child" style="float:right">
                <div class="treatment_title">
                    <input type="radio" id="Child"
                           name="treatment_option1" 
                           <? echo ($_SESSION['treatment_option1'] == "Child") ?  "checked" : "" ;  ?>
                           
                           value="Child" class="treatment_option1" />
                    <p>Child</br>&nbsp;</p>
                    <span>Child with primary dentition<br>and early mixed dentition</span>
                </div>
            </label>
        </div>
        <div class="button_menu" style="padding:10px;">
            <!-- <a class="btn_black hover190" href="/views/index.php">
                Close
            </a> -->
            <input type="submit" id="btn_next" value="Next" class="btn_blue hover190">
        </div>
    </form>
</div>

<script>

    $(document).ready(function () {

        $('input[name=treatment_option1]').each(function (e) {
            if ($(this).prop('checked')) {
                var id = this.id;
                $(".treatment_option1_background").each(function (ev) {
                    if ($(this).attr("for") != id) {
                        $(this).css('border', '2px solid #d2d2d2');
                    } else {
                        $(this).css('border', '2px solid #07a2e8');
                    }
                });
            }
        });

        $('input[name=treatment_option1]').on('click', function (e) {
            var id = this.id;
            $(".treatment_option1_background").each(function (ev) {
                if ($(this).attr("for") != id) {
                    $(this).css('border', '2px solid #d2d2d2');
                } else {
                    $(this).css('border', '2px solid #07a2e8');
                }
            });
            $.ajax({
                url: 'service_info_delete.php',
                type: 'POST',
                data: {
                    'option': id,
                    'value': $(this).val()
                },
                dataType: 'html',
                success: function (data) {
                    //alert(data);
                    location.reload();
                }

            });

        });

        $('#btn_next').on('click', function (event) {
            $("#service_info_form").append("<input type='hidden' name='targetUrl' value='02_treatment_option2.php' />");
        });

    });
</script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>

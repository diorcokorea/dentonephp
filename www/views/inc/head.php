<?php
// @LUCAS 서비스 팝업을 페이지로 전환하면서 경로를 모두 절대 경로로 변경함.
//ini_set("display_errors", "1");
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . '/views/inc/head.sub.php');
include_once($_SERVER["DOCUMENT_ROOT"] . "/models/db/querys.php");

// @LUCAS PHP 에서 알람 카운트와 알람 리스트를 조회 하던 부분을 제거함
// 밑에쪽에서 Ajax로 모두 통합하여 표시함.
//$alarm_array = alarm_r($_SESSION['member_code']);
//$alarm_array_count = count($alarm_array);
//print_r($alarm_array);
?>

<style>
    .dropdown-content__list {
        border-bottom: 3px solid #07a2e8;
        height: auto;
        display: flex;
        flex-direction: column;
        background-color: #393735;
    }

    #myDropdown.dropdown-content {
        display: block;
        position: absolute;
        background-color: #393735;
        min-width: 220px;
        box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);
        z-index: 1002;
        top: 65px;
        font-size: 18px;
        text-align: center;
        border-radius: 5px;
        will-change: auto;
        overflow: hidden;
        transition: height 200ms linear 0s;
        height: 0;
    }

    /* .notification_items:hover{
        background-color: #f1f1f1;
        color: #07a2e8;
    } */
</style>
<script>
    // @LUCAS 2.5차 상단 에니메이션 메뉴
    $(function () {
        var profileDropdown = $(".dropdown").dropdownMenu({
            anchorClassName: ".dropdown__anchor",
            dropdownContentClassName: ".dropdown-content",
            dropdownContentListContainerClassName: ".dropdown-content__list",
        });
        $('#myDropdown').on('click', function() {
            profileDropdown._close();    
        })
    });

    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function dropdown_noti() {
        document.getElementById("dropdown_noti").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    function notiUpdate(service_id, noti_code) {

        if (service_id != null) {

            $.ajax({
                cache: false,
                url: "/viewmodels/notiUpdate.php" /* @LUCAS 기존 링크가 제대로 작동하지 않음 */,
                type: 'POST',
                data: {'noti_id': service_id, 'noti_code': noti_code},
                dataType: 'json',
                success: function (data) {
                    // alert(data.account_lab_id);

                    var form = document.createElement("form");
                    form.setAttribute("method", "post");
                    form.setAttribute("action", "/views/patientprofile.php");
                    // form.setAttribute("target", "patientPopup");


                    var patientkey = document.createElement("input");
                    patientkey.setAttribute("type", "hidden");
                    patientkey.setAttribute("name", "patientkey");
                    patientkey.setAttribute("value", data.patient_id);
                    form.appendChild(patientkey);

                    var patientServiceKey = document.createElement("input");
                    patientServiceKey.setAttribute("type", "hidden");
                    patientServiceKey.setAttribute("name", "patientServiceKey");
                    patientServiceKey.setAttribute("value", service_id);
                    form.appendChild(patientServiceKey);

                    var drId = document.createElement("input");
                    drId.setAttribute("type", "hidden");
                    drId.setAttribute("name", "drId");
                    drId.setAttribute("value", data.account_dr_id);
                    form.appendChild(drId);

                    var doctorId = document.createElement("input");
                    doctorId.setAttribute("type", "hidden");
                    doctorId.setAttribute("name", "doctorId");
                    doctorId.setAttribute("value", data.doctorID);
                    form.appendChild(doctorId);

                    document.body.appendChild(form);
                    // window.open(
                    //     "patientprofile.php",
                    //     'patientPopup',
                    //     'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
                    // );
                    form.submit();
                    //location.reload();

                }, // success
                error: function (xhr, status) {
                    //alert(xhr + " : " + status);
                }
            });
        }
    }

    $(function () {
        // @LUCAS =======================================
        // Ajax로 주기적으로 Notification 수를 가져와서 보여준다.
        const $notificationAnchor = $(".notification .notification_anchor"); // @DBJ Notification 에 숫자로 보여주기 위함
        const $headAlarmPlaceholder = $(".notification .head-alarm-placeholder");
        const $notificationItems = $(".notification .notification_items");

        // @LUCAS 2.5 환자 목록에 알람 카운트 처리
        const addRedDotIndicator = ($alarmPlaceholder) => {
            $alarmPlaceholder.addClass("red_dot_indicator");
        }

        const removeRedDotIndicator = ($alarmPlaceholder) => {
            $alarmPlaceholder.removeClass("red_dot_indicator");
        }

        const getAlarmStatus = async () => {
            try {
                const response = await fetch("/viewmodels/alarm/alarm_status.php", {
                    method: "GET",
                    headers: {
                        'Content-type': 'application/json; charset=UTF-8'
                    }
                });

                const result = await response.json();

                $notificationItems.empty();
                removeRedDotIndicator($headAlarmPlaceholder);
                $(".noti_number").remove(); //@DBJ 이 부분도 추가해 줘야 리프레시처럼 작동함.

                if (result && Array.isArray(result.alarm_array)) {
                    if (result.alarm_array_count) {
                        addRedDotIndicator($headAlarmPlaceholder);

                        // @DBJ 아래 부분도 추가해 줘야 카운드 시작함.
                        $(`<p class='noti_number'>${result.alarm_array_count}</p>`).insertBefore($notificationAnchor.find(".to-right-underline"));

                    }

                    result.alarm_array.forEach(item => {
                        $notificationItems.append($(`
                            <li>
                                <a href="javascript:notiUpdate(${item.service_id}, ${item.alarm_id});">
                                    <p class="noti_icon" style="float:left;"></p>
                                    <p class="noti_text" style="float:right; width:484px;">
                                        ${item.TIME_STAMP} ${item.full_name.replace("[]", item.patient_name.replace(",", " "))}
                                    </p>
                                </a>
                            </li>
                        `));
                    });

                    const alarmCountByStatusIdMap = result.alarm_array.reduce((preValue, curValue) => {
                        preValue[curValue.status_id] = true;
                        return preValue;
                    }, {0: result.alarm_array_count});

                    const alarmCountByServiceIdMap = result.alarm_array.reduce((preValue, curValue) => {
                        preValue[curValue.service_id] = true;
                        return preValue;
                    }, {0: result.alarm_array_count});

                    // alarm for tab
                    $(".tab-alarm-placeholder").each((index, item) => {
                        const $alarmPlaceholder = $(item);
                        removeRedDotIndicator($alarmPlaceholder);
                        const statusIds = $alarmPlaceholder.data("statusIds");

                        if (Array.isArray(statusIds)) {
                            statusIds.some(statusId => {
                                if (alarmCountByStatusIdMap[statusId]) {
                                    addRedDotIndicator($alarmPlaceholder);
                                    return true;
                                }
                            });
                        }
                    });

                    // alarm for table body
                    $(".data-row-alarm-placeholder").each((index, item) => {
                        const $alarmPlaceholder = $(item);
                        removeRedDotIndicator($alarmPlaceholder);
                        const serviceId = $alarmPlaceholder.data("serviceId");

                        if (alarmCountByServiceIdMap[serviceId]) {
                            addRedDotIndicator($alarmPlaceholder);
                        }
                    });

                }

            } catch (error) {
                console.log(error);
            }
        };

        setInterval(getAlarmStatus, 10000); // 10초
        getAlarmStatus();
    });
</script>

<header>
    <div id="container">
        <div id="menu">
            <div class="logo">
                <a alt="<?php echo $config['cf_title']; ?>" href="#"><img src="/resource/images/main_logo.png"></a>
            </div>

            <div class="right_menu">
                <a class="download_button hover190" href="http://aligner.dentone.co.kr/data/onecheck/Setup.exe" download
                   style=""><p class="download_icon"></p>DentOne-VIEWER</a>

                <div class="list notification" style="width:180px;">
                    <!-- @DBJ 점을 업애려고 본 줄 삭제하고 아래 추가 <a href="javascript:dropdown_noti()" class="dropbtn notification-link-container"> -->
                        <a href="javascript:dropdown_noti()" class="dropbtn notification_anchor">
                        
                    <!-- @DBJ 숫자가 들어오면서 불필요한 점을 없애려고 아래 부분도 주석처리함. -->    
                        <!-- <p class="head-alarm-placeholder" style="left: 0;"></p> -->
                        <span class="to-right-underline">Notification</span>
                    </a>
                    <div id="dropdown_noti" class="dropdown-content" style="margin-top:-7px;">
                        <div style="overflow:hidden;border-bottom:1px solid #7d7d7d;padding-bottom:15px">
                            <p style="font-size:18px; color:#f1f1f1;">Notifications</p>
                            <!-- @pcw Notifications 닫기 시 새로고침안됨 -->
                            <a class="noti_close" style="margin-right:10px;" onclick="javascript:self.close();"></a>
                        </div>
                        <ul class="notification_items" style="overflow-y: auto; max-height: 360px;">
                        </ul>
                    </div>
                </div>
 
                <!-- @LUCAS 2.5차 -->
                <div class="dropdown">
                    <a href="javascript:return false" class="dropbtn">
                        <span class="list dropdown__anchor">
                            <span class="member_icon"></span>
                            <!-- @LUCAS 2.5 상단에 이메일 표시 -->
                            <div class="tooltip" style="display: inline-block;">
                            <span class="member_name"><?= $_SESSION['member_id'] ?></span>
                            <?php $length_count = strlen($_SESSION['member_id']); 
                                    if ($length_count>13) {?>
                            <span class="tooltiptext tooltip-bottom" style="z-index:9999; top:115%; left:-17%"><?= $_SESSION['member_id'] ?></span>
                            <?}?>

                            </div>
                            <span class="dropdown_icon"></span>
                        </span>
                    </a>
                    <div id="myDropdown" class="dropdown-content" style="margin-top:-2px;">
                        <div class="dropdown-content__list">
                            <a href="javascript:menuPopupOpen('/views/menu/profile.php');">Dentist profile</a>
                            <a href="javascript:menuPopupOpen('/views/menu/service.php');">Support</a>
                            <a href="javascript:menuPopupOpen('/views/menu/faq.php');">FAQ</a>
                            <a href="javascript:menuPopupOpen('/views/menu/clinicalsetting.php');">
                                Clinical setting
                            </a>
                            <a href="/viewmodels/logout.php">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="container"><!-- Contaier Start -->


<?php
$config['cf_title'] = "Support";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
include "../../models/db/querys.php";
?>

<script type="text/javascript" src="<?= JS ?>/OmniWindow-1.0.1/jquery.omniwindow.js"></script>
<link rel="stylesheet" href="<?= JS ?>/OmniWindow-1.0.1/jquery.omniwindow.css">
<style>
        .login-policy-modal:not(.ow-closed) {
            position: fixed;
            z-index: 20;
            top: 50%;
            left: 50%;
            background: white;
            max-height: 70vh;
            height: 100%;
            width: 100%;
            max-width: 1000px;
            text-align: center;
            border: 1px solid #000000;
            transform: translate(-50%, -50%);
            margin: 0 !important;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
        }

        .login-policy-modal .modal-header {
            display: flex;
            flex-direction: row;
            padding: 24px;
            height: 70px;
            border-bottom: 3px solid #e5e5e5;
        }

        .login-policy-modal .modal-header .modal-title {
            color: #07a2e8;
            font-size: 24px;
        }

        .login-policy-modal .modal-header .close {
            padding: 1rem 1rem;
            margin: -1rem -1rem -1rem auto;
            background-color: transparent;
            border: 0;
            font-size: 24px;
            line-height: 24px;
            color: grey;
            font-weight: 700;
            transition: transform 300ms ease-in-out;
        }

        .login-policy-modal .modal-header .close:hover {
            padding: 1rem 1rem;
            margin: -1rem -1rem -1rem auto;
            background-color: transparent;
            border: 0;
            font-size: 24px;
            line-height: 24px;
            color: #000;
            text-decoration: none;
            transform: scale(1.1);
        }

        .login-policy-modal .modal-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 8px 24px;
        }

        .login-policy-modal .modal-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 24px;
            height: 70px;
            border-top: 1px solid #e5e5e5;
            font-size:18px;
        }

        .login-policy-modal .modal-footer input[type=button] {
            margin: 0;
        }

        .link-container {
            color: white;
        }
    </style>

<script>
        $(function () {

            const $modal = $('div.login-policy-modal').omniWindow({
                overlay: {
                    animations: {
                        hide: function (subjects, internalCallback) {
                            subjects.overlay.fadeOut(250, function () {
                                internalCallback(subjects); // call internal callback AFTER jQuery animations will stop
                            })
                        },
                        show: function (subjects, internalCallback) {
                            console.log('"show"', "show");
                            console.log('subjects', subjects);
                            subjects.overlay.fadeIn(250, function () {
                                internalCallback(subjects);
                            })
                        }
                    }
                }
            });

            $('#termsAndConditionsLink').on("click", function (e) {
                e.preventDefault();
                $modal.find(".modal-header .modal-title").text("Terms and Conditions");
                $modal.find(".modal-body").html($("#termsAndConditionsTemplate").html());
                $modal.trigger('show');
                return false;
            });

            $('#privacyPolicyLink').on("click", function (e) {
                e.preventDefault();
                $modal.find(".modal-header .modal-title").text("Privacy Policy");
                $modal.find(".modal-body").html($("#privacyPolicyTemplate").html());
                $modal.trigger('show');
                return false;
            });

            $('#marketingPolicyLink').on("click", function (e) {
                e.preventDefault();
                $modal.find(".modal-header .modal-title").text("Marketing Policy");
                $modal.find(".modal-body").html($("#marketingPolicyTemplate").html());
                $modal.trigger('show');
                return false;
            });

            $('.btn-close-modal').on("click", function (e) {
                e.preventDefault();
                $modal.trigger('hide');
                return false;
            });
        });

    </script>

<div class="content" style="background-color:#fff;height:600px">
	<div class="service_inner" style="padding: 150px 50px 120px 50px;">
		<div class="top" style="overflow:hidden">
			<div class="link">
				<h2 class="title">Terms and Conditions, Policy</h2>
				<div class="con">
					<ul>
						<li>- <a href="#" id="termsAndConditionsLink" style="border:none;">Terms and Conditions</a></li>
						<li>- <a href="#" id="privacyPolicyLink" style="border:none;">Privacy Policy</a></li>
						<li>- <a href="#" id="marketingPolicyLink" style="border:none;">Marketing Policy</a></li>
					</ul>
				</div>
			</div>
			<!-- <div class="software">
				<h2 class="title">Software Download</h2>
				<div style="text-align:center">
					<a href="<?php echo $url."/data/onecheck/OneCheck.exe"; ?>" download >OneCheck</a>
				</div>
			</div> -->
			<div class="customer" style="float: right;">
				<h2 class="title">Customer Support</h2>
				<div class="con">
					<ul>
						<li><span class="subject">Office</span><span>+82-70-5030-3606</span></li>
						<li><span class="subject">Fax</span><span>+82-31-205-0942</span></li>
						<li><span class="subject">Email</span><span>diorco@diorco.co.kr</span></li>
					</ul>
				</div>
			</div>
		</div>
			
		
			<!-- <div class="info">
				<h2 class="title">Lab Profile</h2>
				<div class="con">
					<ul>
						<li> 
                        <?$labList = labInfoList();
                        if (count($labList) > 1) {?>
                           <select id="labName" onchange="changeNumber();"> 
                        <?for ($i=0; $i < count($labList); $i++) { ?>
                        <option  value="<?=$labList[$i]['phone']?>"><?=$labList[$i]['name']?></option>
                         
                        <?} ?>
                        </select> 
                       <? }else if(count($labList) == 1){?>
                       <span class="subject">Lab</span><span id="labPhoneNum"><?=$labList[0]['name']?></span>
                        <?} ?>
						</li>
						<li><span class="subject">Address</span><span id="labPhoneNum"><?=$labList[0]['address2']." ".$labList[0]['address1']." ".$labList[0]['address3']." ".$labList[0]['address4']." ".$labList[0]['zip_code']?></span></li>
						<li><span class="subject">Office</span><span id="labPhoneNum"><?=$labList[0]['phone']?></span></li>
					</ul>
				</div>
			</div> -->
		</div>
		<div class="button_menu">
		<input type="button" onclick="window.close();" value="Close" class="btn_black hover200"></div>
	</div>
	</div>

</div>
<script>

function changeNumber(){
$("#labPhoneNum").text($("#labName option:selected").val());

}

</script>
<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>

<!-- @DBJ 중요!!! 이하 로그인에서도 동일하게 나오는 각종 Policy 를 Include 로 불러서 한 곳에서 작성할 수 있도록 한 것임.
나중에 각종 Policy 를 수정하고자 하는 경우에는 아래의 파일을 수정 해야 함. -->
<!-- Container for an overlay: -->
<?php include('../various_policies_collection.php');?>
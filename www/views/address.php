<?php
session_start();
$config['cf_title'] = "Delivery Address List";
//ini_set("display_errors", "1");
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/pop_head.php");

include "../models/db/querys.php";

$user_id = $_SESSION['member_id'];
$user_info = user_info($user_id);
$_SESSION['address_id'] = $user_info['address_id'];
$_SESSION['d_code'] = $user_info['index'];
$_SESSION['acc_code'] = $user_info['ACCINDEX'];
$country_list = countryList();

$page = $_GET['page'];
$page = $page ? $page : 1;
//print_r($page);
$address_list = address_list_r($_SESSION['member_code'], $page);


$result_list_count = count($address_list);


$row_count = $address_list[0]['total_row_count'];
$LIST_SIZE = 5;
//print_r($address_list[0]['total_row_count']);

$page_count = ceil($row_count / 5);

$start_page = 1;
$block_count = 10;
$page_block = ceil($page_count / 10);

$block_num = ceil($page / $block_count);
$start_page = (($block_num - 1) * $block_count) + 1; // 블록의 시작번호
$block_end = $block_start + $block_count - 1; //블록 마지막 번호


$end_page = $start_page + 9;
if ($end_page > $page_count) {
    $end_page = $page_count;
}
$prev_page = $page - 1;
$next_page = $page + 1;

$rows = $total_row_cnt;
//print_r($address_list);
?>


<style>
	.list_table2 {
		width: 100%;
		background-color: #fff;
		padding: 10px;
		height: 685px;
		position: relative;
	}
	.list_table2 table {
		border-spacing: 0;
	}
	.list_table2 th {
		background-color: #e6e6e6;
		font-weight: normal;
		height: 60px;
		border-bottom: 1px solid #d2d2d2;
		position: relative;
	}
	
	.list_table2 table td {
		height: 95px;
        border-bottom: 1px solid #d2d2d2;
        background: #ffffff;
	}
	.list_table2 .main_table_name {
		padding: 0 20px;
	}
	.list_table2 .main_table_name .main_table_name_image {
		width: 52px;
		height: 60px;
		background-color: #fff;
		position: relative;
		float: left;
	}
	.list_table2 .main_table_name .main_table_name_image img {
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		bottom: 0;
		overflow: hidden;
		width: 100%;
		height: 100%;
	}
	.list_table2 .main_table_name .main_table_name_text {
		float: left;
		padding-top: 5px;
		margin-left: 10px;
	}
	.list_table2 .main_table_name .main_table_name_text p {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		max-width: 220px;
	}
	</style>


    <div class="content" style="overflow:hidden;height:886px">
        <div class="top_banner">
            <a class="btn_blue hover250" href="javascript:void(0);" id="btn_add_address"
               style="width:250px; height:60px; float:right;">
                <p style="font-size: 20px;float: left;padding: 10px 10px 0px 15px;margin-top: 4px;">Add new address</p>
                <span><img src="/resource/images/add_address.png" style="float:right;padding:8px 20px 0px 0px; width:60px;"></span>
            </a>
        </div>
        <div style="overflow:hidden;background-color:#fff;height:100%">
            <div class="list_table2">
                <table class="table" style="width:100%;font-size:18px;">
                    <colgroup>
                        <col width="220px">
                        <col width="220px">
                        <col width="300px">
                        <col width="auto">
                    </colgroup>
                    <thead>
                    <th>Primary address</th>
                    <th>Action1</th>
                    <th>Clinic name</th>
                    <th>Address</th>
                    </thead>
                    <tbody>
                    <input type="hidden" id="user_main_address_id" value="<?= $address_list[0]['main_address_id'] ?>">
                    <? for ($i = 0; $i < count($address_list); $i++) { ?>
                        <tr class="cellcolor" id="address_<?= $address_list[$i]['address_id'] ?>">

                            <form id="address_form_<?= $address_list[$i]['address_id'] ?>">
                                <input type="hidden" name="address_id" value="<?= $address_list[$i]['address_id'] ?>">
                                <input type="hidden" name="address_name"
                                       value="<?= $address_list[$i]['address_name'] ?>">
                                <input type="hidden" name="country_id" value="<?= $address_list[$i]['country_id'] ?>">
                                <input type="hidden" name="address1" value="<?= $address_list[$i]['address1'] ?>">
                                <input type="hidden" name="address2" value="<?= $address_list[$i]['address2'] ?>">
                                <input type="hidden" name="address3" value="<?= $address_list[$i]['address3'] ?>">
                                <input type="hidden" name="address4" value="<?= $address_list[$i]['address4'] ?>">
                                <input type="hidden" name="zip_code" value="<?= $address_list[$i]['zip_code'] ?>">
                            </form>

                            <td style="text-align:center">
                                <input type="radio" name="main_address_id"
                                       value="<?= $address_list[$i]['address_id'] ?>" <? if ($address_list[$i]['address_id'] == $address_list[$i]['main_address_id']) echo 'checked'; ?>>
                            </td>
                            <td align="center">
                                <div style="display:inline-block; padding:17px 0; text-align:center">
                                    <button class="btn_black hover95"
                                            id="btn_delete_address_<?= $address_list[$i]['address_id'] ?>"
                                            name="btn_delete_address"
                                            style="width:90px; height:50px; margin-bottom:0px;">Delete
                                    </button>
                                </div>
                                <div style="display:inline-block;padding:17px 0; text-align:center">
                                    <button class="btn_black hover95"
                                            id="btn_modi_address_<?= $address_list[$i]['address_id'] ?>"
                                            name="btn_modi_address" style="width:90px; height:50px; margin-bottom:0px;">
                                        Edit
                                    </button>
                                </div>
                            </td>
                            <td align="center" class="address_content"><?= $address_list[$i]['address_name'] ?></td>
                            <td align="center"
                                class="address_content"><?= $address_list[$i]['address2'] . " " . $address_list[$i]['address1'] . " " . $address_list[$i]['address3'] . " " . $address_list[$i]['address4'] . " " . $address_list[$i]['zip_code'] ?></td>
                        </tr>

                    <? } ?>
                    </tbody>
                </table>

                <? if ($result_list_count <= 0) { ?>
                <? } else { ?>
                    <div class='paging_area' style="font-size:15px">
                        <p style="text-align:center">Page <span><?= $page ?>/<?= $page_count ?></span></p>

                        <?php if ($page <= 1): ?>
                            <a class="page_text left disabled" href="#" style="text-align:right;cursor:default;">First</a>
                            <a class='move_btn left disabled'></a>
                            <!-- <a class='pagenum' href="<?= "$PHP_SELP?page=1" ?>">1</a> ... -->
                        <?php else: ?>
                            <a class="page_text left" href="<?= "$PHP_SELP?page=1" ?>">First</a>
                            <a class='move_btn left ' href="<?= "$PHP_SELP?page=$prev_page" ?>"></a>
                        <?php endif ?>

                        <?php for ($p = $start_page; $p <= $end_page; $p++): ?>
                            <a class='pagenum <?= ($p == $page) ? "current" : "" ?>' href="<?= "$PHP_SELP?page=$p" ?>">
                                <?= $p ?>
                            </a>
                        <?php endfor ?>

                        <?php if ($end_page > $page): ?>
                            <a class='move_btn right' href="<?= "$PHP_SELP?page=$next_page" ?>"></a>
                            <a class="page_text right" href="<?= "$PHP_SELP?page=$page_count" ?>">Last</a>
                        <?php else: ?>
                            <span class='move_btn right disabled'></span>
                            <a class="page_text right disabled" style="cursor:default;" href="<?= "$PHP_SELP?page=$page_count" ?>">Last</a>
                        <?php endif ?>
                    </div>
                <? } ?>


            </div>
        </div>
        <div class="find_next_join">
            <input type="button" onclick="MainAddressInsert();" value="Save" class="btn_blue hover200">
            <input type="button" onclick="closePage();" value="Close" class="btn_black hover200">

        </div>

    </div>

    </div>

    </div>
    <!-- 주소 등록 팝업 -->
    <!-- 주소 등록 팝업 -->
    <div class="input_address" id="input_address_div" style="display:none;">
        <form id="add_new_address_form">
            <div class="popup_title">
                <h2>Add a new address</h2>
            </div>
            <div class="popup_content">
                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Address name</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" id="address_name" value="" name="address_name"
                               placeholder="Address name" required
                               oninvalid="this.setCustomValidity('Please enter address1.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <span id="guide" style="color:#999;display:none"></span>
                </div>
                <div style="width:100%; height:60px;">
                    <p class="registeritem_title">Country</p>
                    <div style="width:400px;float:right">
                        <select name="country" id='country'
                                oninvalid="this.setCustomValidity('Please choose a country.')"
                                oninput="setCustomValidity('')" style="width:100%"
                                placeholder="Please choose a country.">
                            <option value="" disabled style="display:none;" selected data-is-placeholder="true">Please choose a country</option>
                            <? foreach ($country_list as $value) { ?>
                                <option value="<?= $value['country_id'] ?>"><?= $value['full_name'] ?></option>
                            <? } ?>

                        </select>
                    </div>
                </div>
                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Address1</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="address1" value="" name="address1"
                               placeholder="Address1" required
                               oninvalid="this.setCustomValidity('Please enter address1.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <span id="guide" style="color:#999;display:none"></span>
                </div>

                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Address2</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="address2" value="" name="address2"
                               placeholder="Address2" required
                               oninvalid="this.setCustomValidity('Please enter address2.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>
                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">City</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="address3" value="" name="address3"
                               placeholder="City" required oninvalid="this.setCustomValidity('Please enter city.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>
                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title" style="padding:0">State/Province<br>/Region</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="address4" value="" name="address4"
                               placeholder="State/Province/Region" required
                               oninvalid="this.setCustomValidity('Please enter state/province/region.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>
                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Zip code</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="postcode" value="" name="postcode"
                               placeholder="Zip code" required
                               oninvalid="this.setCustomValidity('Please enter zip code.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>
            </div>
            <div class="popup_button">
                <button type="button" id="btn_add_address_input" class="btn_blue hover200" style="padding:0px;">Ok
                </button>
                <button type="button" id="btn_add_address_cancel" class="btn_black hover200" style="padding:0px;">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <!-- 주소 수정 팝업 -->
    <div class="input_address" id="modity_address_div" style="display:none;">
        <form id="add_modi_address_form">
            <div class="popup_title">
                <h2>Edit address</h2>
            </div>
            <div class="popup_content">
                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Address name</p>
                    <input type="hidden" id="modity_address_id" name="address_id" value="">
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" id="modity_address_name" value="" name="address_name"
                               placeholder="Address name" required
                               oninvalid="this.setCustomValidity('Please enter address1.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <span id="guide" style="color:#999;display:none"></span>
                </div>
                <div style="width:100%; height:60px;">
                    <p class="registeritem_title">Country</p>
                    <div style="width:400px;float:right">
                        <select name="country" id='modity_country'
                                oninvalid="this.setCustomValidity('Please choose a country.')"
                                oninput="setCustomValidity('')" style="width:100%"
                                placeholder="Please choose a country.">

                            <? foreach ($country_list as $value) { ?>
                                <option value="<?= $value['country_id'] ?>"><?= $value['full_name'] ?></option>
                            <? } ?>

                        </select>
                    </div>
                </div>
                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Address1</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="modity_address1" value="" name="address1"
                               placeholder="Address1" required
                               oninvalid="this.setCustomValidity('Please enter address1.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                    <span id="guide" style="color:#999;display:none"></span>
                </div>

                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Address2</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="modity_address2" value="" name="address2"
                               placeholder="Address2" required
                               oninvalid="this.setCustomValidity('Please enter address2.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>

                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">City</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="modity_address3" value="" name="address3"
                               placeholder="City" required oninvalid="this.setCustomValidity('Please enter city.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>

                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title" style="padding:0">State/Province<br>/Region</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="modity_address4" value="" name="address4"
                               placeholder="State/Province/Region" required
                               oninvalid="this.setCustomValidity('Please enter state/province/region.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>

                <div style="width:100%; height:60px; overflow:hidden;">
                    <p class="registeritem_title">Zip code</p>
                    <div class="form-group" style="width:400px; float:right">
                        <input class="form-control-sign_up" type="text" id="modity_postcode" value="" name="postcode"
                               placeholder="Zip code" required
                               oninvalid="this.setCustomValidity('Please enter zip code.')"
                               oninput="setCustomValidity('')">
                        <div class="form-control-sign_up-border"></div>
                    </div>
                </div>
            </div>
            <div class="popup_button">
                <button type="button" id="btn_modi_address_input" class="btn_blue hover200" style="padding:0px;">Ok
                </button>
                <button type="button" id="btn_modi_address_cancel" class="btn_black hover200" style="padding:0px;">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <script>
        function closePage() {

            if ($("#user_main_address_id").val() != $('input[name=main_address_id]:checked').val()) {
                if (confirm("There is changed information. Do you want to end it?")) {
                    window.close();
                }

            } else {
                window.close();
            }

        }

        function MainAddressInsert() {

            var mainAddressId = "";

            $("input[name=main_address_id]").each(function (e) {
                if ($(this).is(":checked")) {
                    mainAddressId = $(this).val();
                }
            });

            $.ajax({
                cache: false,
                url: "../viewmodels/userAddAddress.php",
                type: 'POST',
                data: {"main_address_id": mainAddressId},
                dataType: 'html',
                success: function (data) {
                    alert("Save is complete.");
                    window.close();
                }, // success
                error: function (xhr, status) {
                    alert(xhr + " : " + status);
                }
            });
        }


        $(document).ready(function () {

            $("#country").animatedDropdown({
                ulMinWidth: "250px",
                ulMaxHeight: "400px",
                ulOverflowY: "auto",
            });

            $("#modity_country").animatedDropdown({
                ulMinWidth: "250px",
                ulMaxHeight: "400px",
                ulOverflowY: "auto",
            });

            $('#btn_add_address').click(function (e) {
                $('#input_address_div').css("display", "block");
            });

            $('#btn_add_address_input').click(function (e) {
                if ($('#address_name').val() == "") {
                    alert('Please enter your Clinic name.');
                    $('#address_name').focus();
                    return false;
                }
                console.log($('#country').val());

                if (!$('#country').val()) {
                    alert('Please Select your Country.');
                    $('#country').focus();
                    return false;
                }
                if ($('#address1').val() == "") {
                    alert('Please enter your Address 1.');
                    $('#address1').focus();
                    return false;
                }
                if ($('#address2').val() == "") {
                    alert('Please enter your Address 2.');
                    $('#address2').focus();
                    return false;
                }
                if ($('#address3').val() == "") {
                    alert('Please enter your City.');
                    $('#address3').focus();
                    return false;
                }
                if ($('#address4').val() == "") {
                    alert('Please enter your State/Province/Region.');
                    $('#address4').focus();
                    return false;
                }
                if ($('#postcode').val() == "") {
                    alert('Please enter your Zip code.');
                    $('#postcode').focus();
                    return false;
                }


                var formData = $("#add_new_address_form").serialize();
                $.ajax({
                    cache: false,
                    url: "../viewmodels/userAddAddress.php",
                    type: 'POST',
                    data: formData,
                    dataType: 'html',
                    success: function (data) {
                        // alert(data);
                        location.reload();
                    }, // success
                    error: function (xhr, status) {
                        alert(xhr + " : " + status);
                    }
                });
            });

            $('#btn_add_address_cancel').click(function (e) {
                $('#input_address_div').css("display", "none");
                $('#address1').val("");
                $('#address2').val("");
                $('#address3').val("");
                $('#address4').val("");
                $('#postcode').val("");
                $('#address_name').val("");
            });


            $('#btn_modi_address_input').click(function (e) {

                if ($('#modity_address_name').val() == "") {
                    alert('Please enter your Clinic name.');
                    $('#modity_address_name').focus();
                    return false;
                }
                if (!$('#modity_country').val()) {
                    alert('Please Select your Country.');
                    $('#modity_country').focus();
                    return false;
                }
                if ($('#modity_address1').val() == "") {
                    alert('Please enter your Address 1.');
                    $('#modity_address1').focus();
                    return false;
                }
                if ($('#modity_address2').val() == "") {
                    alert('Please enter your Address 2.');
                    $('#modity_address2').focus();
                    return false;
                }
                if ($('#modity_address3').val() == "") {
                    alert('Please enter your City.');
                    $('#modity_address3').focus();
                    return false;
                }
                if ($('#modity_address4').val() == "") {
                    alert('Please enter your State/Province/Region.');
                    $('#modity_address4').focus();
                    return false;
                }
                if ($('#modity_postcode').val() == "") {
                    alert('Please enter your Zip code');
                    $('#modity_postcode').focus();
                    return false;
                }

                var formData = $("#add_modi_address_form").serialize();
                $.ajax({
                    cache: false,
                    url: "../viewmodels/userModityAddress.php",
                    type: 'POST',
                    data: formData,
                    dataType: 'html',
                    success: function (data) {
                        alert("Address has been corrected.");
                        location.reload();
                    }, // success
                    error: function (xhr, status) {
                        alert(xhr + " : " + status);
                    }
                });
            });

            $('button[name=btn_modi_address]').click(function (e) {
                $('#modity_address_div').css("display", "block");

                var adId = this.id.split("_");
                adId = adId[adId.length - 1];
                $.each($('#address_form_' + adId).serializeArray(), function (key, val) {

                    switch (val["name"]) {
                        case "address_id":
                            $("#modity_address_id").val(val['value']);
                            break;
                        case "address_name":
                            $("#modity_address_name").val(val['value']);
                            break;
                        case "country_id":
                            $('#modity_country').val(val['value']).prop("selected", true);
                            //$("#modity_country").val(val['value']);

                            $("#modity_country").animatedDropdown({
                                selectedValue: val['value']
                            });
                            break;
                        case "address1":
                            $("#modity_address1").val(val['value']);
                            break;
                        case "address2":
                            $("#modity_address2").val(val['value']);
                            break;
                        case "address3":
                            $("#modity_address3").val(val['value']);
                            break;
                        case "address4":
                            $("#modity_address4").val(val['value']);
                            break;
                        case "zip_code":
                            $("#modity_postcode").val(val['value']);
                            break;


                        default:
                            break;
                    }
                });

            });

            $('button[name=btn_delete_address]').click(function (e) {
                var adId = this.id.split("_");
                adId = adId[adId.length - 1];
                if ($("#user_main_address_id").val() != adId) {
                    if (confirm("Do you want to delete the address?")) {


                        $.ajax({
                            cache: false,
                            url: "../viewmodels/userAddAddress.php",
                            type: 'POST',
                            data: {"address_id": adId, "type": "delete"},
                            dataType: 'html',
                            success: function (data) {
                                alert("Address has been deleted.");
                                location.reload();
                            }, // success
                            error: function (xhr, status) {
                                alert(xhr + " : " + status);
                            }
                        });
                    } else return;

                } else {
                    alert("Default address cannot be deleted.");
                    return false;

                }

            });


            $('#btn_modi_address_cancel').click(function (e) {
                $('#modity_address_div').css("display", "none");
            });


        });


    </script>
<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/service_tail.php");
?>
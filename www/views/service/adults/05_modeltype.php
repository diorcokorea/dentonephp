<?php
// @LUCAS 서비스를 팝업이 아닌 일반 페이지로 전환
session_start();
$config['cf_title'] = "Order form";
$service = 5;

include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/head.service.php");

$dent_lab = explode(',', $_SESSION['dental_lab'], 2);
?>

<div class="content" style="background-color:#fff; height:713px;">

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/views/service/service_tab.php");
    ?>
    <style>

    </style>
    <div class="model_inner" style="overflow:hidden;padding-top:0">
        <div class="service_title" style="margin-bottom:20px">
            <h2>Model type</h2>
        </div>
        <!-- @pcw add scan files 체크 안되어있을경우 알림창 발생 -->
        <form id="service_info_form" name="service_info_form" action='service_info.php' method='post'
            onsubmit="return modelFileCheck();" enctype="multipart/form-data">
            <input type="hidden" id="progress_num" name="progress_num" value="<? echo $progress_num; ?>" />
            <div class="model_select">
                <div style="display:inline-block;margin-right:80px">
                    <input class="" type="radio" id="scan_file"
                           name="model_send" <? if (!isset($_SESSION['model_send']) || $_SESSION['model_send'] == "scan_file") {
                        echo "checked";
                    } ?> onclick="selectModelType();" value="scan_file">
                    <label for="scan_file" style="padding-left:20px">Add scan files</label>
                </div>
                <div style="display:inline-block;">
                    <input class="" type="radio" id="impression"
                           name="model_send" <? if ($_SESSION['model_send'] == "impression") {
                        echo "checked";
                    } ?> onclick="selectModelType();" value="impression">
                    <label for="impression" style="padding-left:20px">Send plaster models</label>
                </div>
            </div>
            <div class="scanfile" id="scan_file_div">
                <div style="position:relative; display:inline-block;margin-right:20px">
                    <div id="maxilla_image" class="maxilla">
                        <p class="modeltype_text"></p>
                        <div id="maxilla_thumbnail">

                            <? if (isset($_SESSION['maxilla_image'])) { ?>
                                <div class="thumb">
                                    <div class="close"></div>
                                    <div class="file_name">
                                        <? $filename = explode("/", $_SESSION['maxilla_image']);
                                        echo $filename[count($filename) - 1]; ?>
                                    </div>
                                    <img id="img_maxilla" src="/resource/images/maxilla_preview.jpg" />
                                </div>
                            <? } ?>

                        </div>
                    </div>
                    <input type='file' id="maxilla_img_file" name="maxilla_img_file" accept=".stl,.obj,.ply"
                           onChange="ajaxMaxillaFileChange();" style="display:none;" />
                </div>

                <div style="position:relative; display:inline-block;margin-left:20px">
                    <div id="mandible_image" class="mandible">

                        <p class="modeltype_text"></p>
                        <div id="mandible_thumbnail">
                            <? if (isset($_SESSION['mandible_image'])) { ?>

                                <div class="thumb">
                                    <div class="close"></div>
                                    <div class="file_name">
                                        <? $filename = explode("/", $_SESSION['mandible_image']);
                                        echo $filename[count($filename) - 1]; ?>
                                    </div>
                                    <img id="img_mandible" src="/resource/images/mandible_preview.jpg" />
                                </div>

                            <? } ?>
                        </div>
                    </div>
                    <input type='file' id="mandible_img_file" name="mandible_img_file" accept=".stl,.obj,.ply"
                           onChange="ajaxMandibleFileChange();" style="display:none;" />
                </div>
                <div class="scanfile_warning">
                    <p class="scanfile_warning_icon"></p>
                    <p class="scanfile_warning_text">Click Maxilla & Mandible box, or click and drag/drop, to upload
                        scan files.</p>
                </div>
            </div>

            <div class="impression" id="impression_div" style="display:none">
                <div style="padding:100px 80px;border:2px solid #d2d2d2;text-align:left;border-radius:5px">

                    <p>
                        <strong>
                            <span style="width:220px;display:inline-block">Lab</span>:
                        </strong>
                        <span style="padding-left:10px"><?= $dent_lab[1] ?></span>
                    </p>

                    <p style="margin-top:40px;"><strong style="display:inline-block"><span
                                    style="width:220px;display:inline-block">Delivery address</span>:</strong>
                        <span style="padding-left:10px;display: inline-block; width: 77%; vertical-align: top;">
			[ Zip code : <?= $_SESSION['dental_lab_zipcode'] ?> ]
			<?= $_SESSION['dental_lab_addr'] ?></span></p>

                    <p style="margin-top:40px;"><strong style="display:inline-block"><span
                                    style="width:220px;display:inline-block">Office</span>:</strong>
                        <span style="padding-left:10px;display: inline-block; width: 77%; vertical-align: top;">
                            <?= labinfo_r($dent_lab[0])[0]['phone'] ?>
                        </span>
                    </p>
                </div>
                <div class="precautions" style="padding-top:40px">

                    <!-- <p class="precautions_title">※ Note</p>
                    <p class="precautions_content">Please send the printed order with plaster models.</p> -->

                </div>

            </div>

    </div>

    <div class="button_menu" style="padding:10px;">
        <input type="submit" id="btn_pre" value="Back" class="btn_black hover190">
        <input type="submit" id="btn_next" value="Next" class="btn_blue hover190">
    </div>

    </form>


    <?php
    // @LUCAS 프로그래스바 모듈 추가
    include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/progressbar.php");
    ?>


    <script>


        var maxilla_image_file;
        var mandible_image_file;

        var maxilla_image_rot = 0;
        var mandible_image_rot = 0;

        $(document).ready(function () {
            selectModelType();

            // @LUCAS 프로그래스바를 보여주고 상태를 업데이트 한다.
            const uploadFiles = async function () {
                if (maxilla_image_file != null || mandible_image_file != null) {
                    const [reset, update] = createProgressbar({hideWhen100Percent: false});
                    reset();
                    await modelUploadFiles(update);
                }
                $("#service_info_form").submit();
            }

            $('#btn_pre').on('click', async function (event) {
                event.preventDefault();
                event.stopPropagation();
                $("#service_info_form").append("<input type='hidden' name='targetUrl' value='04_classification.php' formnovalidate/>");
                await uploadFiles();
            });

            $('#btn_next').on('click', async function (event) {
                event.preventDefault();
                event.stopPropagation();
                if (modelFileCheck() !== false) {
                    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='06_photo.php' />");
                    await uploadFiles();
                }
            });


            /*************************************************************
             이미지 드래그 앤 드롭
             *************************************************************/
            /****************        maxilla         **********************/
            $("#maxilla_image").on("dragenter", function (e) { //드래그 요소가 들어왔을떄
                $(this).addClass('drag-over');
            }).on("dragleave", function (e) { //드래그 요소가 나갔을때
                $(this).removeClass('drag-over');
            }).on("dragover", function (e) {
                e.stopPropagation();
                e.preventDefault();
            }).on('drop', function (e) { //드래그한 항목을 떨어뜨렸을때
                e.preventDefault();
                $(this).removeClass('drag-over');

                //alert('이미지 업로드 주의사항');

                var files = e.originalEvent.dataTransfer.files; //드래그&드랍 항목
                if (document.getElementById('img_maxilla')) {
                    alert('Only one scan file can be registered for each part.');
                    return;
                }
                if (files.length > 1 || maxilla_image_file != null) {
                    alert('Only one scan file can be registered for each part.');
                    return;
                }
//if (!files[0].type.match(/image./)) {alert('이미지가 아닙니다.'); return; }

                var file = files[0];
                maxilla_image_file = file;//파일 추가
                preview(file, 0, "maxilla"); //미리보기 만들기

            });

            /****************        mandible         **********************/
            $("#mandible_image").on("dragenter", function (e) { //드래그 요소가 들어왔을떄
                $(this).addClass('drag-over');
            }).on("dragleave", function (e) { //드래그 요소가 나갔을때
                $(this).removeClass('drag-over');
            }).on("dragover", function (e) {
                e.stopPropagation();
                e.preventDefault();
            }).on('drop', function (e) { //드래그한 항목을 떨어뜨렸을때
                e.preventDefault();
                $(this).removeClass('drag-over');

                //alert('이미지 업로드 주의사항');

                var files = e.originalEvent.dataTransfer.files; //드래그&드랍 항목
                if (document.getElementById('img_mandible')) {
                    alert('Only one scan file can be registered for each part.');
                    return;
                }
                if (files.length > 1 || mandible_image_file != null) {
                    alert('Only one scan file can be registered for each part.');
                    return;
                }
//if (!files[0].type.match(/image./)) {alert('이미지가 아닙니다.'); return; }

                var file = files[0];
                mandible_image_file = file;//파일 추가
                preview1(file, 0, "mandible"); //미리보기 만들기

            });


            /*************************************************************
             개별 선택 이벤트
             *************************************************************/
            $('#maxilla_image').click(function (e) {
                if (document.getElementById('img_maxilla')) {
                    alert('Only one scan file can be registered for each part.');
                }
                if (maxilla_image_file != null) {
                    alert('Only one scan file can be registered for each part.');
                    return;
                }

                $('.upload_caution').css("display", 'block');
                $('#target_id').val('maxilla_img_file');

                e.preventDefault();


            });

            $('.pointcolor').click(function (e) {
                $('.upload_caution').css("display", 'none');
                $('#' + $('#target_id').val()).click();
            });


            /****************        mandible         **********************/
            $('#mandible_image').click(function (e) {
                if (document.getElementById('img_mandible')) {
                    alert('Only one scan file can be registered for each part.');
                }
                if (mandible_image_file != null) {
                    alert('Only one scan file can be registered for each part.');
                    return;
                }
                $('.upload_caution').css("display", 'block');
                $('#target_id').val('mandible_img_file');
//alert('이미지 업로드 주의사항');
                e.preventDefault();
            });


            /*************************************************************
             삭제 버튼 이벤트
             *************************************************************/
            $("#maxilla_thumbnail").on("click", ".close", function (e) {
                e.stopPropagation();
                var $target = $(e.target);
//파일 정보 삭제
                maxilla_image_file = null;
                $("#maxilla_img_file").val('');
                maxilla_image_rot = 0
                deleteFile('maxilla_image');
                $target.parent().remove(); //프리뷰 삭제
            });
            /****************        mandible         **********************/
            $("#mandible_thumbnail").on("click", ".close", function (e) {
                e.stopPropagation();
                var $target = $(e.target);
//파일 정보 삭제
                mandible_image_file = null;
                $("#mandible_img_file").val('');
                mandible_image_rot = 0
                deleteFile('mandible_image');
                $target.parent().remove(); //프리뷰 삭제
            });
            /*************************************************************
             회전 버튼 이벤트
             *************************************************************/
            $("#maxilla_thumbnail").on("click", ".rotate", function (e) {
                e.stopPropagation();
                var $target = $(e.target);

                maxilla_image_rot += 90;
                if (maxilla_image_rot >= 360) {
                    maxilla_image_rot = 0;
                }
                $('#img_maxilla_thumbnail').css({'transform': `rotate(${maxilla_image_rot}deg) translate(-50%, -50%)`});
            });
            /****************        mandible         **********************/
            $("#mandible_thumbnail").on("click", ".rotate", function (e) {
                e.stopPropagation();
                var $target = $(e.target);

                mandible_image_rot += 90;
                if (mandible_image_rot >= 360) {
                    mandible_image_rot = 0;
                }
                $('#img_mandible_thumbnail').css({'transform': `rotate(${mandible_image_rot}deg) translate(-50%, -50%)`});
            });

        });//ready


        /*************************************************************
         공통 미리보기 생성 함수
         *************************************************************/

        function preview(file, idx, thumbnail_target) {
            var reader = new FileReader();
            reader.onload = (function (f, idx) {
                return function (e) {
                    var fhum_target = thumbnail_target + "_thumbnail";
                    var div = '<div class="thumb" > \
<div class="close" data-idx="' + idx + '"></div> \
<div class="file_name" data-idx="' + idx + '">' + escape(f.name) + '</div> \
//<div class="rotate" data-idx="' + idx + '" ></div> \
<img id="img_' + fhum_target + '" src="/resource/images/maxilla_preview.jpg" title="' + escape(f.name) + '"/> \
</div>';
                    $('#' + fhum_target).append(div);
                };
            })(file, idx);
            reader.readAsDataURL(file);
        }

        function preview1(file, idx, thumbnail_target) {
            var reader = new FileReader();
            reader.onload = (function (f, idx) {
                return function (e) {
                    var fhum_target = thumbnail_target + "_thumbnail";
                    var div = '<div class="thumb" > \
<div class="close" data-idx="' + idx + '"></div> \
<div class="file_name" data-idx="' + idx + '">' + escape(f.name) + '</div> \
//<div class="rotate" data-idx="' + idx + '" ></div> \
<img id="img_' + fhum_target + '" src="/resource/images/mandible_preview.jpg" title="' + escape(f.name) + '"/> \
</div>';
                    $('#' + fhum_target).append(div);
                };
            })(file, idx);
            reader.readAsDataURL(file);
        }

        function deleteFile(type) {
            $.ajax({
                cache: false,
                url: "service_file_delete.php",
                type: 'POST',
                data: {'type': type},
                dataType: 'text',
                success: function (data) {
                    // alert(data);

                }, // success
                error: function (xhr, status) {
                    // alert(xhr + " : " + status);
                }
            });

        }


        /*************************************************************
         개별 선택 이벤트 후 처리
         *************************************************************/
        function ajaxMaxillaFileChange() {
            if (maxilla_image_file != null) {
                alert('Only one scan file can be registered for each part.');
                return;
            }
            var file = jQuery("#maxilla_img_file")[0].files[0];
//if (!file.type.match(/image./)) {alert('이미지가 아닙니다.'); return; }
            maxilla_image_file = file; //업로드 추가
            preview(maxilla_image_file, 0, "maxilla"); //미리보기 만들기
        }

        /****************        mandible         **********************/
        function ajaxMandibleFileChange() {
            if (mandible_image_file != null) {
                alert('Only one scan file can be registered for each part.');
                return;
            }
            var file = jQuery("#mandible_img_file")[0].files[0];
//if (!file.type.match(/image./)) {alert('이미지가 아닙니다.'); return; }
            mandible_image_file = file; //업로드 추가
            preview1(mandible_image_file, 0, "mandible"); //미리보기 만들기
        }

        /*************************************************************
         개별 선택 이벤트 후 처리
         *************************************************************/
        $(document).ready(function () {

            // feat image ratio size
            $('.featImage > img').each(function (index, item) {
                if ($(this).height() / $(this).width() < 0.567) {
                    $(this).addClass('landscape').removeClass('portrait');
                } else {
                    $(this).addClass('portrait').removeClass('landscape');
                }
            });
            $('#programModalSummary').on('shown.bs.modal', function (e) {
                $('#programModalSummary .featImage > img').each(function (index, item) {
                    if ($(this).height() / $(this).width() < 0.567) {
                        $(this).addClass('landscape').removeClass('portrait');
                    } else {
                        $(this).addClass('portrait').removeClass('landscape');
                    }
                });
            })

        });

    </script>


</div>
<? include("upload_layer.php"); ?>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/views/inc/tail.php");
?>




<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service =7;
?>

<div class="content" style="background-color:#fff;">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>
<form id="service_info_form" name="service_info_form" action='service_info.php'  method='post' enctype="multipart/form-data">
	<div class="radiograph_inner" style="overflow:hidden">
	<div class="service_title" style="margin-bottom:20px">
			<h2>X-ray image</h2>
		</div>
		<div class="scanfile" style="padding:0; width:100%">
			<div style="display:inline-block;position:relative;margin-right:10px" id="div_lateral_xray">
				<input type="file" id="lateral_xray" onchange="ajaxLateralFileChange()">
				<label  class="lateral_xray" id="lateral_xray_label">
				<? if(isset($_SESSION['lateral_xray'])){?>

                    <div class="thumb_image"> 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['lateral_xray']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_lateral_xray_label" src="<?= '/'.$_SESSION['lateral_xray']?>" /> 
                    </div>

					<?}?>
					<p class="file_text">Lateral</p>
				</label>
			</div>
			<div style="display:inline-block;position:relative;margin-left:10px" id="div_panorama">
			<input type="file" id="panorama" onchange="ajaxPanoramaFileChange();" style="">
		<!-- 	<input type="file" id="image" accept="image/*" onchange="setThumbnail(event);"/> -->
				<label  class="panorama" id="panorama_label">
				<? if(isset($_SESSION['panorama'])){?>

                    <div class="thumb_image"> 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['panorama']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_panorama_label" src="<?= '/'.$_SESSION['panorama']?>" /> 
                    </div>

					<?}?>
					<p class="file_text">Panorama</p>
				</label>
			</div>
			<div class="scanfile_warning">
                <p class="scanfile_warning_icon"></p> 
			    <p class="scanfile_warning_text">Click & drag/drop to upload files.</p>
            </div>
		</div>
		<div class="patient_warning" style="padding-top:20px;border-top:1px solid #d2d2d2;margin-top:30px">
				<p class="patient_warning_icon"></p>
				<p class="patient_warning_text">You can apply with uploading above images.</p>
		</div>
	</div>
	<div class="button_menu" style="padding:10px;">
		<a href="javascript:servicePopupClose();"  class="service_close">Close</a>
        <input type="submit" id="btn_pre" value="Back" class="service_close" style="margin:0">
		<input type="submit" id="btn_next"  value="Next" class="service_next"> 

	</div>

</form>
</div>

<script>

    
var lateral_xray;
var lateral_xray_rot = 0;

var panorama;
var panorama_rot = 0;


    $(document).ready(function(){
        
    $('#btn_pre').on('click', function(event){
       xrayUploadFiles();
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='06_photo.php' />");
    });
    
    $('#btn_next').on('click', function(event){
        xrayUploadFiles();
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='08_setup1.php' />");
    });

    /****************        div_lateral_xray         **********************/
	$("#div_lateral_xray").on("dragenter", function(e) { //드래그 요소가 들어왔을떄
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //드래그 요소가 나갔을때
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //드래그한 항목을 떨어뜨렸을때
				e.preventDefault();
				$(this).removeClass('drag-over');

            var files = e.originalEvent.dataTransfer.files; //드래그&드랍 항목
            if(document.getElementById('img_lateral_xray_label')){ 
    alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
        return;
}
            if (files.length > 1 ||  lateral_xray != null) {
                    alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
                    return;
                }
            if (!files[0].type.match(/image./)) {alert('이미지가 아닙니다.'); return; }

            var file = files[0];
            lateral_xray =  file;//파일 추가
            preview(file, 0,"lateral_xray"); //미리보기 만들기

            });


            /****************        div_panorama         **********************/
	        $("#div_panorama").on("dragenter", function(e) { //드래그 요소가 들어왔을떄
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //드래그 요소가 나갔을때
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //드래그한 항목을 떨어뜨렸을때
				e.preventDefault();
				$(this).removeClass('drag-over');

            var files = e.originalEvent.dataTransfer.files; //드래그&드랍 항목
            if(document.getElementById('img_panorama_label')){ 
    alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
        return;
}
            if (files.length > 1 ||  panorama != null) {
                    alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
                    return;
                }
            if (!files[0].type.match(/image./)) {alert('이미지가 아닙니다.'); return; }

            var file = files[0];
            panorama =  file;//파일 추가
            preview(file, 0,"panorama"); //미리보기 만들기

            });













    });//ready
/*************************************************************
					공통 미리보기 생성 함수
*************************************************************/

function preview(file, idx, thumbnail_target) {
var reader = new FileReader();
reader.onload = (function(f, idx) {
return function(e) {
	var fhum_target = thumbnail_target+"_label";
var div = '<div class="thumb_image" > \
<div class="close" data-idx="' + idx + '"></div> \
<div class="file_name" data-idx="' + idx + '">' + escape(f.name) + '</div> \
<img id="img_'+fhum_target+'" src="' + e.target.result + '" title="' + escape(f.name) + '"/> \
<div class="rotate" data-idx="' + idx + '" ></div> \
</div>';
$('#'+fhum_target).append(div);
};
})(file, idx);
reader.readAsDataURL(file);
}



</script>


<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>












<script>


/*************************************************************
					개별 선택 이벤트  
*************************************************************/

/****************        mandible         **********************/
$('#lateral_xray_label').click(function(e){
    if(document.getElementById('img_lateral_xray_label')){ 
    alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
        return;
}
if (lateral_xray != null) {
	   alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
	   return;
   }

e.preventDefault();
$('#lateral_xray').click();
});


$('#panorama_label').click(function(e){
    if(document.getElementById('img_panorama_label')){ 
    alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
        return;
}
if (panorama != null) {
	   alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
	   return;
   }

//alert('이미지 업로드 주의사항');
e.preventDefault();
$('#panorama').click();
});


/*************************************************************
						삭제 버튼 이벤트
*************************************************************/
$("#lateral_xray_label").on("click", ".close", function(e) {
	 e.stopPropagation();
	var $target = $(e.target);
//파일 정보 삭제
lateral_xray = null;
	$("#lateral_xray").val('');
	lateral_xray_rot = 0
deleteFile('lateral_xray');
$target.parent().remove(); //프리뷰 삭제
});

$("#panorama_label").on("click", ".close", function(e) {
	 e.stopPropagation();
	var $target = $(e.target);
//파일 정보 삭제
panorama = null;
	$("#panorama").val('');
	panorama_rot = 0
deleteFile('panorama');
$target.parent().remove(); //프리뷰 삭제
});






/*************************************************************
						회전 버튼 이벤트
*************************************************************/
$("#lateral_xray_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

lateral_xray_rot += 90;
if (lateral_xray_rot >= 360) { lateral_xray_rot =0; }
$('#img_lateral_xray_label').css({'transform': `rotate(${lateral_xray_rot}deg) translate(-50%, -50%)`});
});

$("#panorama_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

panorama_rot += 90;
if (panorama_rot >= 360) { panorama_rot =0; }
$('#img_panorama_label').css({'transform': `rotate(${panorama_rot}deg)  translate(-50%, -50%)`});
});




/*************************************************************
					개별 선택 이벤트 후 처리
*************************************************************/
function ajaxLateralFileChange(){
	if (lateral_xray != null) {
        alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
        return;
    }
var file = jQuery("#lateral_xray")[0].files[0];
if (!file.type.match(/image./)) {alert('이미지가 아닙니다.'); return; }
lateral_xray = file; //업로드 추가
preview(lateral_xray, 0,"lateral_xray"); //미리보기 만들기
}

function ajaxPanoramaFileChange(){
	if (panorama != null) {
        alert('방사선 사진은 부위별 한개만 등록가능 합니다.');
        return;
    }
var file = jQuery("#panorama")[0].files[0];
if (!file.type.match(/image./)) {alert('이미지가 아닙니다.'); return; }
panorama = file; //업로드 추가
preview(panorama, 0, "panorama"); //미리보기 만들기
}

 function deleteFile(type){
     $.ajax({
        cache: false,
        url: "service_file_delete.php",
        type: 'POST',
        data: {'type':type},
        dataType: 'text',
        success: function (data) {
           // alert(data);
          
        }, // success
        error: function (xhr, status) {
           // alert(xhr + " : " + status);
        }
    });

  }


</script>
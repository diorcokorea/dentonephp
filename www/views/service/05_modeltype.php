<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service = 5;
?>

<div class="content" style="background-color:#fff;">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>
	<style>

	</style>
	<div class="model_inner" style="overflow:hidden;padding-top:0">
	<div class="service_title" style="margin-bottom:20px">
			<h2>Model type</h2>
		</div>
<form id="service_info_form" name="service_info_form"  action='service_info.php' method='post' onsubmit="return filesUploadChecked();" enctype="multipart/form-data" >
<input type="hidden" id="progress_num" name="progress_num" value="<? echo $progress_num; ?>" />
		<div class="model_select">
			<div style="display:inline-block;margin-right:80px">
				<input class="" type="radio" id="scan_file" name="model_send" <? if(!isset($_SESSION['model_send']) || $_SESSION['model_send'] == "scan_file"){ echo "checked"; } ?> onclick="selectModelType();" value="scan_file">
				<label for="scan_file" style="padding-left:20px">Add scan files?</label>
			</div>
			<div style="display:inline-block;">
				<input class="" type="radio" id="impression" name="model_send" <? if($_SESSION['model_send'] == "impression"){ echo "checked"; } ?> onclick="selectModelType();"  value="impression">
				<label for="impression"style="padding-left:20px">Send plaster models</label>
			</div>
		</div>
		<div class="scanfile" id="scan_file_div">
			<div style="position:relative; display:inline-block;margin-right:20px">
				<div id="maxilla_image" class="maxilla" >
					<p class="modeltype_text">Maxilla</p>
					<div id="maxilla_thumbnail">

						<?if(isset($_SESSION['maxilla_image'])){?>
                            <div class="thumb" > 
                            <div class="close"></div> 
                            <div class="file_name" >
                            <? $filename = explode("/",$_SESSION['maxilla_image']); 
                            echo $filename[count($filename)-1]; ?>
                            </div> 
                            <img id="img_maxilla"  src="/resource/images/maxilla_preview.jpg" /> 
                            </div>
                        <?}?>

					</div>
				</div>
                <input type='file' id="maxilla_img_file" name="maxilla_img_file" accept=".stl,.obj,.ply"  onChange="ajaxMaxillaFileChange();" style="display:none;" />
			</div> 

			<div style="position:relative; display:inline-block;margin-left:20px">
				<div id="mandible_image" class="mandible" >
                
					<p class="modeltype_text">Mandible</p>
					<div id="mandible_thumbnail">
						<?if(isset($_SESSION['mandible_image'])){?>

                            <div class="thumb" > 
                            <div class="close"></div> 
                            <div class="file_name" >
                            <? $filename = explode("/",$_SESSION['mandible_image']); 
                            echo $filename[count($filename)-1]; ?>
                            </div> 
                            <img id="img_mandible"  src="/resource/images/mandible_preview.jpg" /> 
                            </div>

						<?}?>
					</div>
				</div>
                <input type='file' id="mandible_img_file" name="mandible_img_file" accept=".stl,.obj,.ply"  onChange="ajaxMandibleFileChange();" style="display:none;" />
			</div>
            <div class="scanfile_warning">
                <p class="scanfile_warning_icon"></p> 
			    <p class="scanfile_warning_text">Click Maxilla & Mandible box, or click and drag/drop, to upload scan files.</p>
            </div>
        </div>

		<div class="impression" id="impression_div" style="display:none">
			<div style="padding:100px 80px;border:2px solid #d2d2d2;text-align:left;border-radius:5px">
			<p><strong><span style="width:220px;display:inline-block">Lab</span>:</strong><span style="padding-left:10px"><?
             $dent_lab = explode( ',', $_SESSION['dental_lab'], 2);
            echo $dent_lab[1];
            ?></span></p>
			<p style="margin-top:40px;"><strong style="display:inline-block"><span style="width:220px;display:inline-block">Delivery address</span>:</strong>
			<span style="padding-left:10px;display: inline-block; width: 77%; vertical-align: top;">
			[ Zip code : <?=$_SESSION['dental_lab_zipcode']?> ]
			<?= $_SESSION['dental_lab_addr']?></span></p>

				<p style="margin-top:40px;"><strong style="display:inline-block"><span style="width:220px;display:inline-block">Office</span>:</strong>
			<span style="padding-left:10px;display: inline-block; width: 77%; vertical-align: top;">+82 070-5030-3037</span></p>

			</div>
			<div class="precautions" style="padding-top:40px">
	
				<p class="precautions_title">??? Note</p>
				<p class="precautions_content">Please send the printed order with plaster models.</p>
		
			</div>
			
		</div>
		
	</div>
	

	<div class="button_menu" style="padding:10px;">
		<a href="javascript:servicePopupClose();"  class="service_close">Close</a>
		<input type="submit" id="btn_pre" value="Back" class="service_close" style="margin:0">
		<input type="submit" id="btn_next"  value="Next" class="service_next"> 
	</div>
    </form>
<script>

var maxilla_image_file;
var mandible_image_file;

var maxilla_image_rot = 0;
var mandible_image_rot = 0;

$(document).ready(function(){
	selectModelType();

    $('#btn_pre').on('click', function(event){
        modelUploadFiles();
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='04_classification.php' formnovalidate/>");
    });
    
    $('#btn_next').on('click', function(event){
        modelUploadFiles();
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='06_photo.php' />");
    });

function filesUploadChecked() {
    if ($('input[name=model_send]:checked').val() != "impression") {
                //?????? ????????????
                if (document.getElementById('img_maxilla') || document.getElementById('img_mandible') || document.getElementById('img_maxilla_thumbnail') || document.getElementById('img_mandible_thumbnail')) {
                    return true;
                } else {
                    alert('Please add scan files.')
                    return false;
                }
            }     
        }
\




/*************************************************************
					????????? ????????? ??? ?????? 
*************************************************************/
/****************        maxilla         **********************/
	$("#maxilla_image").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

 //alert('????????? ????????? ????????????');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_maxilla')){ 
    alert('Only one scan file can be registered for each part.');
        return;
}
 if (files.length > 1 ||  maxilla_image_file != null) {
        alert('Only one scan file can be registered for each part.');
        return;
    }
//if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
maxilla_image_file =  file;//?????? ??????
preview(file, 0,"maxilla"); //???????????? ?????????

});

/****************        mandible         **********************/
$("#mandible_image").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

 //alert('????????? ????????? ????????????');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_mandible')){ 
    alert('Only one scan file can be registered for each part.');
        return;
}
 if (files.length > 1 ||  mandible_image_file != null) {
        alert('Only one scan file can be registered for each part.');
        return;
    }
//if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
mandible_image_file =  file;//?????? ??????
preview1(file, 0,"mandible"); //???????????? ?????????

});


/*************************************************************
					?????? ?????? ?????????  
*************************************************************/
$('#maxilla_image').click(function(e){
    if(document.getElementById('img_maxilla')){ 
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

$('.pointcolor').click(function(e){
    $('.upload_caution').css("display", 'none');
    $('#'+$('#target_id').val()).click();
});


/****************        mandible         **********************/
$('#mandible_image').click(function(e){
    if(document.getElementById('img_mandible')){ 
    alert('Only one scan file can be registered for each part.');
    }
if (mandible_image_file != null) {
	   alert('Only one scan file can be registered for each part.');
	   return;
   }
   $('.upload_caution').css("display", 'block');
   $('#target_id').val('mandible_img_file');
//alert('????????? ????????? ????????????');
e.preventDefault();
});



/*************************************************************
						?????? ?????? ?????????
*************************************************************/
$("#maxilla_thumbnail").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
maxilla_image_file = null;
$("#maxilla_img_file").val('');
maxilla_image_rot = 0
deleteFile('maxilla_image');
$target.parent().remove(); //????????? ??????
});
/****************        mandible         **********************/
$("#mandible_thumbnail").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
mandible_image_file = null;
$("#mandible_img_file").val('');
mandible_image_rot = 0
deleteFile('mandible_image');
$target.parent().remove(); //????????? ??????
});
/*************************************************************
						?????? ?????? ?????????
*************************************************************/
$("#maxilla_thumbnail").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

maxilla_image_rot += 90;
if (maxilla_image_rot >= 360) { maxilla_image_rot =0; }
$('#img_maxilla_thumbnail').css({'transform': `rotate(${maxilla_image_rot}deg) translate(-50%, -50%)`});
});
/****************        mandible         **********************/
$("#mandible_thumbnail").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

mandible_image_rot += 90;
if (mandible_image_rot >= 360) { mandible_image_rot =0; }
$('#img_mandible_thumbnail').css({'transform': `rotate(${mandible_image_rot}deg) translate(-50%, -50%)`});
});

});//ready


/*************************************************************
					?????? ???????????? ?????? ??????
*************************************************************/

function preview(file, idx, thumbnail_target) {
var reader = new FileReader();
reader.onload = (function(f, idx) {
return function(e) {
	var fhum_target = thumbnail_target+"_thumbnail";
var div = '<div class="thumb" > \
<div class="close" data-idx="' + idx + '"></div> \
<div class="file_name" data-idx="' + idx + '">' + escape(f.name) + '</div> \
//<div class="rotate" data-idx="' + idx + '" ></div> \
<img id="img_'+fhum_target+'" src="/resource/images/maxilla_preview.jpg" title="' + escape(f.name) + '"/> \
</div>';
$('#'+fhum_target).append(div);
};
})(file, idx);
reader.readAsDataURL(file);
}

function preview1(file, idx, thumbnail_target) {
var reader = new FileReader();
reader.onload = (function(f, idx) {
return function(e) {
	var fhum_target = thumbnail_target+"_thumbnail";
var div = '<div class="thumb" > \
<div class="close" data-idx="' + idx + '"></div> \
<div class="file_name" data-idx="' + idx + '">' + escape(f.name) + '</div> \
//<div class="rotate" data-idx="' + idx + '" ></div> \
<img id="img_'+fhum_target+'" src="/resource/images/mandible_preview.jpg" title="' + escape(f.name) + '"/> \
</div>';
$('#'+fhum_target).append(div);
};
})(file, idx);
reader.readAsDataURL(file);
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


/*************************************************************
					?????? ?????? ????????? ??? ??????
*************************************************************/
function ajaxMaxillaFileChange(){
	if (maxilla_image_file != null) {
        alert('Only one scan file can be registered for each part.');
        return;
    }
var file = jQuery("#maxilla_img_file")[0].files[0];
//if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
 maxilla_image_file = file; //????????? ??????
preview(maxilla_image_file, 0, "maxilla"); //???????????? ?????????
}

/****************        mandible         **********************/
function ajaxMandibleFileChange(){
	if (mandible_image_file != null) {
        alert('Only one scan file can be registered for each part.');
        return;
    }
var file = jQuery("#mandible_img_file")[0].files[0];
//if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
mandible_image_file = file; //????????? ??????
preview1(mandible_image_file, 0, "mandible"); //???????????? ?????????
}
/*************************************************************
					?????? ?????? ????????? ??? ??????
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
<? include("upload_layer.php");  ?>

<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>




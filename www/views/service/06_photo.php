<?php
  session_start();
$config['cf_title'] = "Order form";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service = 6;

//  echo $_SESSION['lateral_photo']."<br>";
//     echo       $_SESSION['test'] ;
          
?>


<div class="content" style="background-color:#fff;">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>

	<form id="service_info_form" name="service_info_form"  action='service_info.php' method='post' enctype="multipart/form-data" >
	<div class="picture_inner" style="overflow:hidden">
		<div class="service_title" style="margin-bottom:20px">
			<h2>Photo</h2>
		</div>
		<div style="text-align:center;width:100%;overflow:hidden;margin-bottom:10px">
        
			<div style="display:inline-block;margin-right:5px" class="filebox" id="lateral_image_box">
				<input type="file" id="Lateral_file" accept="image/*" onChange="ajaxLateralfileChange();" style="">
				<label for="Lateral" class="lateral photo_label" id="lateral_label">
                <? if(isset($_SESSION['lateral_photo'])){?>
               
                <div class="thumb_image" id="lateral_label_thumb" > 
                <div class="close"></div> 
                <div class="file_name" >
                <? $filename = explode("/",$_SESSION['lateral_photo']); 
                echo $filename[count($filename)-1]; ?>
                </div> 
                <div class="rotate" ></div> 
                <img id="img_lateral_label" src="<?= '/'.$_SESSION['lateral_photo']?>" /> 
                </div>

                        <?}?>
					<p class="file_text">Lateral Photo</p>
				</label>
                
			</div>

			<div class="filebox" style="display:inline-block;margin-right:5px" id="frontal_image_box">
				<input type="file" id="Frontal_file" accept="image/*" onChange="ajaxFrontalfileChange();" style="">
				<label for="Frontal" class="frontal photo_label" id="frontal_label">
                <? if(isset($_SESSION['front_photo'])){?>

                    <div class="thumb_image" id="front_label_thumb" > 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['front_photo']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_frontal_label" src="<?= '/'.$_SESSION['front_photo']?>" /> 
                    </div>

                        <?}?>
					<p class="file_text">Frontal Photo</p>
				</label>
			</div>
			<div style="display:inline-block" class="filebox"  id="smile_image_box">
				<input type="file" id="Smile_file" accept="image/*" onChange="ajaxSmailefileChange();" style="">
				<label for="Smaile" class="smile photo_label" id="smile_label">
                <? if(isset($_SESSION['smile_photo'])){?>


                    <div class="thumb_image" id="smile_label_thumb" > 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['smile_photo']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_smile_label" src="<?= '/'.$_SESSION['smile_photo']?>" /> 
                    </div>

                        <?}?>
					<p class="file_text">Smile Photo</p>
				</label>
			</div>
		</div>

		<div style="text-align:center;width:100%;overflow:hidden;margin-bottom:10px">
			<div style="display:inline-block;margin-right:5px" class="filebox"  id="int_upper_image_box">
				<input type="file" id="Int_upper_file" accept="image/*" onChange="ajaxIntupperfileChange();" style="">
				<label for="Lateral" class="intraoral_upper photo_label" id="int_upper_label">
                <? if(isset($_SESSION['intraoral_upper'])){?>


                    <div class="thumb_image" id="int_upper_label_thumb" > 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['intraoral_upper']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_int_upper_label" src="<?= '/'.$_SESSION['intraoral_upper']?>" /> 
                    </div>

                        <?}?>
					<p class="file_text">Intraoral Upper</p>
				</label>
			</div>
			<div class="filebox"  id="" style="display:inline-block;vertical-align:middle;margin-right:5px">
				<div class="picture"><p class="scanfile_warning_icon" style="float:left"></p><p class="picture_text">>Click &<br>drag/drop<br>to upload files</p></div>
			</div>
			<div style="display:inline-block" class="filebox"  id="int_lower_image_box">
				<input type="file" id="Int_lower_file" accept="image/*" onChange="ajaxIntlowerfileChange();" style="">
				<label for="Smaile" class="intraoral_lower photo_label" id="int_lower_label">
                <? if(isset($_SESSION['intraoral_lower'])){?>

                    <div class="thumb_image" id="int_lower_label_thumb" > 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['intraoral_lower']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_int_lower_label" src="<?= '/'.$_SESSION['intraoral_lower']?>" /> 
                    </div>

                        <?}?>
					<p class="file_text">Intraoral Lower</p>
				</label>
			</div>
		</div>
		<div style="text-align:center;width:100%;overflow:hidden">
			<div style="display:inline-block;margin-right:5px" class="filebox"  id="int_right_image_box">
				<input type="file" id="Int_right_file" accept="image/*" onChange="ajaxIntrightfileChange();" style="">
				<label for="Lateral" class="intraoral_right photo_label" id="int_right_label">
                <? if(isset($_SESSION['intraoral_right'])){?>


                    <div class="thumb_image" id="int_right_label_thumb" > 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['intraoral_right']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_int_right_label" src="<?= '/'.$_SESSION['intraoral_right']?>" /> 
                    </div>


                        <?}?>
					<p class="file_text">Intraoral Right</p>
				</label>
			</div>
			<div class="filebox"  id="int_frontal_image_box" style="display:inline-block;margin-right:5px">
				<input type="file" id="Int_front_file" accept="image/*" onChange="ajaxIntfrontfileChange();" style="">
				<label for="Frontal" class="intraoral_front photo_label" id="int_front_label">
                 <? if(isset($_SESSION['intraoral_fornt'])){?>

                    <div class="thumb_image" id="int_front_label_thumb" > 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['intraoral_fornt']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_int_front_label" src="<?= '/'.$_SESSION['intraoral_fornt']?>" /> 
                    </div>

						
                        <?}?>
					<p class="file_text">Intraoral Front</p>
				</label>
			</div>
			<div style="display:inline-block" class="filebox"  id="int_left_image_box">
				<input type="file" id="Int_left_file" accept="image/*" onChange="ajaxIntleftfileChange();" style="">
				<label for="Smaile" class="intraoral_left photo_label" id="int_left_label">
                <? if(isset($_SESSION['intraoral_left'])){?>

                    <div class="thumb_image" id="int_left_label_thumb" > 
                    <div class="close"></div> 
                    <div class="file_name" >
                    <? $filename = explode("/",$_SESSION['intraoral_left']); 
                    echo $filename[count($filename)-1]; ?>
                    </div> 
                    <div class="rotate" ></div> 
                    <img id="img_int_left_label" src="<?= '/'.$_SESSION['intraoral_left']?>" /> 
                    </div>

                        <?}?>
					<p class="file_text">Intraoral Left</p>
				</label>
			</div>
		</div>
		<div class="patient_warning" style="padding-top:20px">
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

var lateral_image;
var lateral_image_rot = 0;

var frontal_image;
var frontal_image_rot = 0;

var smile_image;
var smile_image_rot = 0;

var intraoral_up_image;
var intraoral_up_image_rot = 0;

var intraoral_lo_image;
var intraoral_lo_image_rot = 0;

var intraoral_ri_image;
var intraoral_ri_image_rot = 0;

var intraoral_le_image;
var intraoral_le_image_rot = 0;

var intraoral_fr_image;
var intraoral_fr_image_rot = 0;




    $(document).ready(function(){
        
    $('#btn_pre').on('click', function(event){
        picUploadFiles();
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='05_modeltype.php' />");
    });
    
    $('#btn_next').on('click', function(event){
        picUploadFiles();
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='07_radiograph.php' />");
    });





    
/*************************************************************
					????????? ????????? ??? ?????? 
*************************************************************/
/****************        lateral_image_box         **********************/
	$("#lateral_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_lateral_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (files.length > 1 ||  lateral_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
lateral_image =  file;//?????? ??????
preview(file, 0,"lateral"); //???????????? ?????????

});

/****************        frontal_image_box         **********************/
$("#frontal_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????

if(document.getElementById('img_frontal_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}

 if (files.length > 1 ||  frontal_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
frontal_image =  file;//?????? ??????
preview(file, 0,"frontal"); //???????????? ?????????

});


/****************        smile_image         **********************/
$("#smile_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_smile_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (files.length > 1 ||  smile_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
smile_image =  file;//?????? ??????
preview(file, 0,"smile"); //???????????? ?????????

});

/****************        intraoral_u_image         **********************/
$("#int_upper_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');
                
var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_int_upper_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (files.length > 1 ||  intraoral_up_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
intraoral_up_image =  file;//?????? ??????
preview(file, 0,"int_upper"); //???????????? ?????????

});
/****************        intraoral_l_image         **********************/
	$("#int_lower_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_int_lower_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (files.length > 1 ||  intraoral_lo_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
intraoral_lo_image =  file;//?????? ??????
preview(file, 0,"int_lower"); //???????????? ?????????

});

/****************        intraoral_r_image         **********************/
$("#int_right_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_int_right_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (files.length > 1 ||  intraoral_ri_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
intraoral_ri_image =  file;//?????? ??????
preview(file, 0,"int_right"); //???????????? ?????????

});
/****************        lateral_front_box         **********************/
$("#int_frontal_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_int_front_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (files.length > 1 ||  intraoral_fr_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
intraoral_fr_image =  file;//?????? ??????
preview(file, 0,"int_front"); //???????????? ?????????

});

/****************        lateral_left_box         **********************/
$("#int_left_image_box").on("dragenter", function(e) { //????????? ????????? ???????????????
			$(this).addClass('drag-over');
			}).on("dragleave", function(e) { //????????? ????????? ????????????
			$(this).removeClass('drag-over');
			}).on("dragover", function(e) {
				e.stopPropagation();
				e.preventDefault();
			}).on('drop', function(e) { //???????????? ????????? ??????????????????
				e.preventDefault();
				$(this).removeClass('drag-over');

var files = e.originalEvent.dataTransfer.files; //?????????&?????? ??????
if(document.getElementById('img_int_left_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (files.length > 1 ||  intraoral_le_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
if (!files[0].type.match(/image./)) {alert('???????????? ????????????.'); return; }

var file = files[0];
intraoral_le_image =  file;//?????? ??????
preview(file, 0,"int_left"); //???????????? ?????????

});




/*************************************************************
					?????? ?????? ?????????  
*************************************************************/
/****************        lateral_label         **********************/
$('#lateral_label').click(function(e){
    if(document.getElementById('img_lateral_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
 if (lateral_image != null) {
        alert('????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
 e.preventDefault();
 $('#Lateral_file').click();

});

/****************        frontal_label         **********************/
$('#frontal_label').click(function(e){
    if(document.getElementById('img_frontal_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
if (frontal_image != null) {
       alert('????????? ????????? ????????? ???????????? ?????????.');
       return;
   }
e.preventDefault();
$('#Frontal_file').click();

});

/****************        smile_label         **********************/
$('#smile_label').click(function(e){
    if(document.getElementById('img_smile_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
if (smile_image != null) {
       alert('????????? ????????? ????????? ???????????? ?????????.');
       return;
   }
e.preventDefault();
$('#Smile_file').click();

});

/****************        int_upper_label         **********************/
$('#int_upper_label').click(function(e){
    if(document.getElementById('img_int_upper_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
if (intraoral_up_image != null) {
       alert('????????? ????????? ????????? ???????????? ?????????.');
       return;
   }
e.preventDefault();
$('#Int_upper_file').click();

});

/****************        int_lower_label         **********************/
$('#int_lower_label').click(function(e){
    if(document.getElementById('img_int_lower_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
if (intraoral_lo_image != null) {
       alert('????????? ????????? ????????? ???????????? ?????????.');
       return;
   }
e.preventDefault();
$('#Int_lower_file').click();

});

/****************        int_right_label         **********************/
$('#int_right_label').click(function(e){
    if(document.getElementById('img_int_right_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
if (intraoral_ri_image != null) {
       alert('????????? ????????? ????????? ???????????? ?????????.');
       return;
   }
e.preventDefault();
$('#Int_right_file').click();

});

/****************        int_left_label         **********************/
$('#int_left_label').click(function(e){
    if(document.getElementById('img_int_left_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
if (intraoral_le_image != null) {
       alert('????????? ????????? ????????? ???????????? ?????????.');
       return;
   }
e.preventDefault();
$('#Int_left_file').click();

});

/****************        int_front_label         **********************/
$('#int_front_label').click(function(e){
    if(document.getElementById('img_int_front_label')){ 
    alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
}
if (intraoral_fr_image != null) {
       alert('????????? ????????? ????????? ???????????? ?????????.');
       return;
   }
e.preventDefault();
$('#Int_front_file').click();

});



/*************************************************************
						?????? ?????? ?????????
*************************************************************/
$("#lateral_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
lateral_image = null;
$("#Lateral_file").val('');
lateral_image_rot = 0;
deleteFile('lateral_photo');
$target.parent().remove(); //????????? ??????
});

/****************        frontal_label         **********************/
$("#frontal_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
frontal_image = null;
$("#Frontal_file").val('');
frontal_image_rot = 0;
deleteFile('front_photo');
$target.parent().remove(); //????????? ??????
});


/****************        smile_label         **********************/
$("#smile_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
smile_image = null;
$("#Smile_file").val('');
smile_image_rot = 0;
deleteFile('smile_photo');
$target.parent().remove(); //????????? ??????
});


/****************        int_upper_label         **********************/
$("#int_upper_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
intraoral_up_image = null;
$("#Int_upper_file").val('');
intraoral_up_image_rot = 0;
deleteFile('intraoral_upper');
$target.parent().remove(); //????????? ??????
});



/****************        int_lower_label         **********************/
$("#int_lower_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
intraoral_lo_image = null;
$("#Int_lower_file").val('');
intraoral_lo_image_rot = 0;
deleteFile('intraoral_lower');
$target.parent().remove(); //????????? ??????
});



/****************        int_right_label         **********************/
$("#int_right_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
intraoral_ri_image = null;
$("#Int_right_file").val('');
intraoral_ri_image_rot = 0;
deleteFile('intraoral_right');
$target.parent().remove(); //????????? ??????
});



/****************        int_left_label         **********************/
$("#int_left_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
intraoral_le_image = null;
$("#Int_left_file").val('');
intraoral_le_image_rot = 0;
deleteFile('intraoral_left');
$target.parent().remove(); //????????? ??????
});


/****************        int_front_label         **********************/
$("#int_front_label").on("click", ".close", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//?????? ?????? ??????
intraoral_fr_image = null;
$("#Int_front_file").val('');
intraoral_fr_image_rot = 0;
deleteFile('intraoral_fornt');
$target.parent().remove(); //????????? ??????
});




/*************************************************************
						?????? ?????? ?????????
*************************************************************/
$("#lateral_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);
//alert(lateral_image_rot);
lateral_image_rot += 90;
if (lateral_image_rot >= 360) { lateral_image_rot =0; }
$('#img_lateral_label').css({'transform': `rotate(${lateral_image_rot}deg) translate(-50%, -50%)`});
});

$("#frontal_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

frontal_image_rot += 90;
if (frontal_image_rot >= 360) { frontal_image_rot =0; }
$('#img_frontal_label').css({'transform': `rotate(${frontal_image_rot}deg) translate(-50%, -50%)`});
});

$("#smile_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

smile_image_rot += 90;
if (smile_image_rot >= 360) { smile_image_rot =0; }
$('#img_smile_label').css({'transform': `rotate(${smile_image_rot}deg) translate(-50%, -50%)`});
});

$("#int_upper_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

intraoral_up_image_rot += 90;
if (intraoral_up_image_rot >= 360) { intraoral_up_image_rot =0; }
$('#img_int_upper_label').css({'transform': `rotate(${intraoral_up_image_rot}deg) translate(-50%, -50%)`});
});

$("#int_lower_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

intraoral_lo_image_rot += 90;
if (intraoral_lo_image_rot >= 360) { intraoral_lo_image_rot =0; }
$('#img_int_lower_label').css({'transform': `rotate(${intraoral_lo_image_rot}deg) translate(-50%, -50%)`});
});

$("#int_right_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

intraoral_ri_image_rot += 90;
if (intraoral_ri_image_rot >= 360) { intraoral_ri_image_rot =0; }
$('#img_int_right_label').css({'transform': `rotate(${intraoral_ri_image_rot}deg) translate(-50%, -50%)`});
});


$("#int_left_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

intraoral_le_image_rot += 90;
if (intraoral_le_image_rot >= 360) { intraoral_le_image_rot =0; }
$('#img_int_left_label').css({'transform': `rotate(${intraoral_le_image_rot}deg) translate(-50%, -50%)`});
});


$("#int_front_label").on("click", ".rotate", function(e) {
	 e.stopPropagation();
var $target = $(e.target);

intraoral_fr_image_rot += 90;
if (intraoral_fr_image_rot >= 360) { intraoral_fr_image_rot =0; }
$('#img_int_front_label').css({'transform': `rotate(${intraoral_fr_image_rot}deg) translate(-50%, -50%)`});
});


    });//ready


/*************************************************************
					?????? ???????????? ?????? ??????
*************************************************************/

function preview(file, idx, thumbnail_target) {
var reader = new FileReader();
reader.onload = (function(f, idx) {
return function(e) {
	var fhum_target = thumbnail_target+"_label";
var div = '<div class="thumb_image" id="'+fhum_target+'_thumb" > \
<div class="close" data-idx="' + idx + '"></div> \
<div class="file_name" data-idx="' + idx + '">' + escape(f.name) + '</div> \
<div class="rotate" data-idx="' + idx + '" ></div> \
<img id="img_'+fhum_target+'" src="' + e.target.result + '" title="' + escape(f.name) + '"/> \
</div>';
$('#'+fhum_target).append(div);
};
})(file, idx);
reader.readAsDataURL(file);
}



/*************************************************************
					?????? ?????? ???????????? ??????
*************************************************************/
function ajaxLateralfileChange(){
	if (lateral_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Lateral_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
lateral_image = file; //????????? ??????
preview(lateral_image, 0, "lateral"); //???????????? ?????????
}


/****************        int_front_label         **********************/
function ajaxFrontalfileChange(){
	if (frontal_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Frontal_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
frontal_image = file; //????????? ??????
preview(frontal_image, 0, "frontal"); //???????????? ?????????
}

/****************        int_front_label         **********************/
function ajaxSmailefileChange(){
	if (smile_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Smile_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
smile_image = file; //????????? ??????
preview(smile_image, 0, "smile"); //???????????? ?????????
}

/****************        int_front_label         **********************/
function ajaxIntupperfileChange(){
	if (intraoral_up_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Int_upper_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
intraoral_up_image = file; //????????? ??????
preview(intraoral_up_image, 0, "int_upper"); //???????????? ?????????
}


/****************        int_front_label         **********************/
function ajaxIntlowerfileChange(){
	if (intraoral_lo_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Int_lower_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
intraoral_lo_image = file; //????????? ??????
preview(intraoral_lo_image, 0, "int_lower"); //???????????? ?????????
}


/****************        int_front_label         **********************/
function ajaxIntrightfileChange(){
	if (intraoral_ri_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Int_right_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
intraoral_ri_image = file; //????????? ??????
preview(intraoral_ri_image, 0, "int_right"); //???????????? ?????????
}


/****************        int_front_label         **********************/
function ajaxIntfrontfileChange(){
	if (intraoral_fr_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Int_front_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
intraoral_fr_image = file; //????????? ??????
preview(intraoral_fr_image, 0, "int_front"); //???????????? ?????????
}


/****************        int_front_label         **********************/
function ajaxIntleftfileChange(){
	if (intraoral_le_image != null) {
        alert('?????? ????????? ????????? ????????? ???????????? ?????????.');
        return;
    }
var file = jQuery("#Int_left_file")[0].files[0];
if (!file.type.match(/image./)) {alert('???????????? ????????????.'); return; }
intraoral_le_image = file; //????????? ??????
preview(intraoral_le_image, 0, "int_left"); //???????????? ?????????
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




<?php

$config['cf_title'] = "????????? ??????";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>
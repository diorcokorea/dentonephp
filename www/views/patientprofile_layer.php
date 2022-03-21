<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../resource/js/jquery.bxslider.js"></script>

<!-- 접수 반려 팝업 -->
<div class="reject_message dis_none">
	<div class="popup_title">
		<h2>Message</h2>
	</div>
	<div class="popup_content">
	<div class="form-group">
	<textarea class="form-control-sign_up" placeholder="Message." style="width:600px;height:240px;resize:none"></textarea>
	<div class="form-control-sign_up-border"></div>
	</div>
	</div>
	<div class="popup_button">
		<button class="btn_blue hover190" style="padding:0px;">Send</button>
		<button class="btn_black hover190" style="padding:0px;">Close</button>
	</div>
</div>
<!-- 접수 반려 팝업 보기 -->
<!-- <div class="reject_message_view dis_none">
	<div class="popup_title">
		<h2>Message</h2>
	</div>
	<div class="popup_content">
		<textarea placeholder="Message." style="width:600px;height:240px;resize:none" disabled><?=returnservice_r($patientServiceKey)?></textarea>
	</div>
	<div class="popup_button">
		<button class="btn_black hover190" style="padding:0px;" id="btn_message_view_close">Close</button>
	</div>
</div> -->
<!-- 배송 정보 입력 팝업 -->
<div class="input_delivery dis_none">
	<div class="popup_title">
		<h2>배송 정보 입력</h2>
	</div>
	<div class="popup_content">
		<select style="width:160px;float:left">
			<option>택배사</option>
		</select>
		<div class="form-group">
		<input class="form-control-sign_up" type="text" placeholder="운송장 번호 -없이 입력" style="width:400px;margin-left:10px">
		<div class="form-control-sign_up-border"></div>
	</div>
	</div>
	<div class="popup_button">
		<button class="btn_blue hover190" style="padding:0px;">등록</button>
		<button class="btn_black hover190" style="padding:0px;">닫기</button>
	</div>
</div>
<!-- 배송 정보 조회 팝업 -->
<div class="input_delivery_view dis_none">
	<div class="popup_title">
		<h2>배송 정보 조회</h2>
	</div>
	<div class="popup_content">
		<div>
		<p style="width:100%;height:200px;border:2px solid #d4d4d4; border-radius:5px; margin-top:10px; overflow-y:auto"></p>
		</div>
	</div>
	<div class="popup_button">
		<button class="btn_black hover190" style="padding:0px;">닫기</button>
	</div>
</div>
<!-- 석고 Data 등록 팝업 -->
<div class="input_data dis_none">
	<div class="popup_title">
		<h2>석고 Data 등록</h2>
	</div>
	<div class="popup_content">
		<div class="scanfile" id="scan_file_div" style="width:480px;padding:0"> 
			<div style="float:left;position:relative">
				<div id="maxilla_image" class="maxilla" style="width: 220px; height: 220px; background-size: 80%;">
                    <!-- <img src="./files/test/1.jpg"> -->
					<p class="modeltype_text" style="font-size:20px;bottom:20px">Maxilla</p>
					<div id="maxilla_thumbnail"></div>
				</div>
                <input type="file" id="maxilla_img_file" name="maxilla_img_file" onchange="ajaxMaxillaFileChange();" style="display:none;">
			</div> 

			<div style="float:right;position:relative">
				<div id="mandible_image" class="mandible" style="width: 220px; height: 220px; background-size: 80%;">
					<p class="modeltype_text" style="font-size:20px;bottom:20px">Mandible</p>
					<div id="mandible_thumbnail"></div>
				</div>
                <input type="file" id="mandible_img_file" name="mandible_img_file" onchange="ajaxMandibleFileChange();" style="display:none;">
			</div>
            <div class="scanfile_warning" style="text-align:center">
			    <p class="scanfile_warning_text">마우스 드래그로도 등록 가능합니다.</p>
            </div>
        </div>
	</div>
	<div class="popup_button">
		<button class="btn_blue hover190" style="padding:0px;">확인</button>
		<button class="btn_black hover190" style="padding:0px;">닫기</button>
	</div>
</div>
<!-- 셋업 리포트 팝업 -->
<div class="setup_report dis_none">
	<div class="popup_title">
		<h2>셋업 리포트</h2>
	</div>
	<div class="popup_content">
		<input type="text" style="width:400px">
		<button class="pointcolor upload_button">업로드</button>
	</div>
	<div class="popup_button">
		<button class="btn_blue hover190" style="padding:0px;">등록</button>
		<button class="btn_black hover190" style="padding:0px;">삭제</button>
	</div>
</div>
<!-- 수동 디자인 등록 팝업 -->
<div class="input_design dis_none">
	<div class="popup_title">
		<h2>수동 디자인 등록</h2>
	</div>
	<div class="popup_content">
		<input type="text" style="width:400px">
		<button class="pointcolor upload_button">업로드</button>
	</div>
	<div class="popup_button">
		<button class="btn_blue hover190" style="padding:0px;">등록</button>
		<button class="btn_black hover190" style="padding:0px;">삭제</button>
	</div>
</div>
<!-- 수정 요청 코멘트 팝업 -->
<div class="edit_request_message dis_none">
	<div class="popup_title">
		<h2>Message</h2>
	</div>
	<div class="popup_content">
		<div>
			<p style="font-size:18px;">Message:</p>
			<div class="form-group">
			<textarea class="form-control-sign_up" style="width:600px;height:240px;resize:none;margin-top:10px" disabled> <? $request_array1 = request_message($patientServiceKey,$sa,1);
            echo $request_array1[0]['comment'];
            ?></textarea>
			<div class="form-control-sign_up-border"></div>
	    </div>
		</div>
		<div>
			<p style="font-size:18px;margin:10px 0">Capture list</p>
			<div class="capture_list">
            <?
                    $image_list = json_decode(str_replace("\\","/",$request_array1[0]['image_list']),true);
                  //  print_r($request_array1[0]['image_list']);
                    for ($i=0; $i < count($image_list); $i++) { 
                ?>
				<p><img name="request_img_list" src="<?='../data/'.$image_list[$i]['path'] ?>"></p>
                <?}?>
			</div>
		</div>
	</div>
	<div class="popup_button">
		<button class="btn_black hover190" style="padding:0px;" id="btn_modi_message_close">Close</button>
	</div>
</div>

<!-- 변경 제출 메세지 팝업 보기 -->
<div class="change_message_view dis_none" id=>
	<div class="popup_title">
		<h2>Message</h2>
	</div>
	<div class="popup_content">
	<div class="form-group">
		<textarea class="form-control-sign_up" placeholder="" style="width:600px;height:240px;resize:none" disabled><?=submitChangeMessage($patientServiceKey,$submitHisId)?></textarea>
		<div class="form-control-sign_up-border"></div>
	    </div>
	</div>
	<div class="popup_button">
		<button class="btn_black hover190" style="padding:0px;" id="change_message_view_close">Close</button>
	</div>
</div>

<!-- 이미지 확대 팝업 -->
<div class="image_view2 dis_none" id="edit_inside_request_message_cu" style="width:800px;background-color:#fff;overflow:hidden">
	<div class="popup_title">
		<h2>Capture images</h2>
	</div>
	<div class="popup_button" style="margin:40px 0;padding:0 50px">
	<a class="btn_black hover190" style="padding:0px;" id="btn_2d" download href="">Save</a>
	</div>
	<div class="popup_content" style="width:100%; overflow:hidden;padding:0 50px 20px 50px;position:relative;text-align:center">
		<div class="slider" id="img_slider">
			 <?
                    $image_list = json_decode(str_replace("\\","/",$request_array1[0]['image_list']),true);
                    for ($i=0; $i < count($image_list); $i++) { 
                ?>
					<div class="div_img_slider picture_image" style="width:auto" id="div_rqmg_slider_<?=$i+1?>">
						<img id="rq_image_slider_<?=$i+1?>" name="edit_image" onclick="" src="<?='../data/'.$image_list[$i]['path'] ?>">
					</div>
                <?}?>
		 </div>
		  <p style="text-align:center;font-size:16px;position:absolute;bottom:38px;transform: translateX(-50%);
    left: 50%;"><span id="img_select_num">1</span>/<span id="img_slider_count">1</span></p>
	</div>
   
	<div class="popup_button">
		<button class="btn_black hover190" style="padding:0px;" id="image_rq_view1_close">Close</button>
	</div>
</div>



<script>
$(document).ready(function(){
    // $('.slider').bxSlider({
	// 	auto:false,
	// 	pager:false
	// });

    // $('img[name=request_img_list]').click(function(e){
    // $('.image_view2').css("display","block");
    // });

    // $('#image_rq_view1_close').click(function(e){
    // $('.image_view2').css("display","none");
    // });

    // $('#btn_2d').click(function(e){
	// 	 $(".picture_image").each(function(ev) {
    //         if ($(this).attr('aria-hidden') == "false") {
    //            $('#btn_2d').attr("href",$(this).children('img').attr('src'));
    //         }
    //      });
	//    });
    
	// 	$('#img_slider_count').text($('.div_img_slider').length-2);

		// $('.bx-prev').click(function(e){
		// 	$(".div_img_slider").each(function(ev) {
		// 		if ($(this).attr('aria-hidden') == "false") {
		// 			var idarray = this.id.split("_");
		// 			$("#img_select_num").text(idarray[idarray.length - 1]);

		// 		}
		// 	 });
		// });

		// $('.bx-next').click(function(e){
		// 	$(".div_img_slider").each(function(ev) {
		// 		if ($(this).attr('aria-hidden') == "false") {
		// 			  var idarray = this.id.split("_");
		// 			  $("#img_select_num").text(idarray[idarray.length - 1]);
		// 		}
		// 	});
		// });
});
</script>
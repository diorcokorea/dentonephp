<?php
  session_start();
  include_once('../../models/db/querys.php');
$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
$service =6;
?>


<div class="content" style="background-color:#fff;">

	<?php
	include($_SERVER["DOCUMENT_ROOT"]."/views/service/service_tab.php");
	?>
    <form id="service_info_form"  name="service_info_form" onsubmit="return brkListAppend();" action='service_info.php' method='post'>

	<div class="bracket_inner">
		<div class="indirect_System">
			<h2 style="text-align:left">Indirect Bonding System</h2>
			<div style="margin-top:20px">
				<p style="float:left;width:250px">Indirect Bonding Tray(s) : </p>
				<div>
					<input type="checkbox"<?if($_SESSION['upperCheckBox'] == "true") echo "checked";?> id="upperCheckBox" name="upperCheckBox" value="upper" style="margin-right:20px" onclick="upperChecked();"><label for="upperCheckBox" style="margin-right:60px">상악</label>
					<input type="checkbox"<?if($_SESSION['lowerCheckBox'] == "true") echo "checked";?> id="lowerCheckBox" name="lowerCheckBox" value="lower" style="margin-right:20px" onclick="lowerChecked();"><label for="lowerCheckBox" >하악</label>
				</div>
			</div>
			<div class="tray_sections" style="margin-top:20px">
				<p style="float:left;width:250px">Tray Sections : </p>
				<div style="overflow:hidden">
					<div>
						<p style="float:left;margin-right:60px">상악</p>
						<input type="radio" name="upperTraySelectMenu" <?if($_SESSION['upperTraySelectMenu'] == "u_ts_1p"){ echo "checked";}else if($_SESSION['upperTraySelectMenu'] == null){echo "checked";}?> id="u_ts_1p" value="u_ts_1p" style="margin-right:30px" disabled ><label for="u_ts_1p" style="margin-right:60px">1 Piece</label>
						<input type="radio" name="upperTraySelectMenu" <?if($_SESSION['upperTraySelectMenu'] == "u_ts_ms"){ echo "checked";}?> id="u_ts_ms" value="u_ts_ms" style="margin-right:30px" disabled><label for="u_ts_ms" style="margin-right:60px">Midline Split</label>
						<input type="radio" name="upperTraySelectMenu" <?if($_SESSION['upperTraySelectMenu'] == "u_ts_3p"){ echo "checked";}?> id="u_ts_3p" value="u_ts_3p" style="margin-right:30px" disabled><label for="u_ts_3p" style="margin-right:60px">3 Piece</label>
					</div>
					<div style="margin-top:20px">
						<p style="float:left;margin-right:60px">하악</p>
						<input type="radio" name="lowerTraySelectMenu" <?if($_SESSION['lowerTraySelectMenu'] == "l_ts_1p"){ echo "checked";}else if($_SESSION['lowerTraySelectMenu'] == null){echo "checked";}?> id="l_ts_1p" value="l_ts_1p"  style="margin-right:30px" disabled ><label for="l_ts_1p"  style="margin-right:60px">1 Piece</label>
						<input type="radio" name="lowerTraySelectMenu" <?if($_SESSION['lowerTraySelectMenu'] == "l_ts_ms"){ echo "checked";}?> id="l_ts_ms" value="l_ts_ms" style="margin-right:30px" disabled><label for="l_ts_ms"  style="margin-right:60px">Midline Split</label>
						<input type="radio" name="lowerTraySelectMenu" <?if($_SESSION['lowerTraySelectMenu'] == "l_ts_3p"){ echo "checked";}?> id="l_ts_3p" value="l_ts_3p" style="margin-right:30px" disabled><label for="l_ts_3p" style="margin-right:60px">3 Piece</label>
					</div>
				</div>
			</div>
		</div>
		<div class="used_brackets" style="margin-top:30px">
			<h2>Used brackets & placements</h2>
			<div id="brks_n_placements" style="text-align:center; width: 87%; margin: 0 auto;">
				<div>
					<button type="button" id="btn_brk_info_delete" onclick="brkInfoDelete();" disabled style="float:right;width:160px;padding:13px 0;font-size:18px; color:#fff;border:none;background-color:#3c3c3c;border-radius:5px;margin:10px 0">전체 삭제</button>
					<div style="overflow:hidden;width:100%;text-align:left;margin-bottom:20px">
						<div style="display:inline-block;float:left">
							<p style="float:left; padding:13px 0;margin-right:30px">회사 선택</p>
							<select class="" disabled type="text" style="width:250px" id="brk_dental_lab" name="brk_dental_lab" onchange="brk_selectedDentalLab();">
								<option value="" selected disabled hidden>선택 해주세요.</option>
                                <? 
                                $bkr_lab_array = bracket_r();
                                foreach ($bkr_lab_array as $list_index => $value_list) {
                                    foreach ($value_list as $key => $value) {
                                        //echo $key." = ".$value;
                                                if ($key == "code") {
                                                    echo "<option value=".$value;
                                                }else if ($key == "B_NAME") {
                                                    echo ">".$value."</option>";
                                                }
                                    }
                                }
                                
                                ?>



                                <option value="brk_custom_dental_lab" >사용자 지정</option>
                                
							</select>
						</div>
						<div style="display:inline-block;float:right">
							<p style="float:left; padding:13px 0;margin-right:30px">제품 선택</p>
							<select class="" type="text" style="width:480px" id="brk_product" name="brk_product" disabled onchange="brk_selectedProduct();">
								<option value="" selected disabled hidden>선택 해주세요.</option>
                                <option value="brk_custom_product" >사용자 지정</option>
							</select>
						</div>
					</div>
				</div>
                <? include("brk_layer.php");  ?>
                        
				<div style="overflow:hidden;display:inline-block">
					<p  class="RL" style="margin-right:5px">R</p>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-bottom:5px;border-right:1px solid #3c3c3c;padding-right:5px">
							<button type="button" class="number" id="brk_18" name="upperBrackets" >18</button>
							<button type="button" class="number" id="brk_17" name="upperBrackets" >17</button>
							<button type="button" class="number" id="brk_16" name="upperBrackets" >16</button>
							<button type="button" class="number" id="brk_15" name="upperBrackets" >15</button>
							<button type="button" class="number" id="brk_14" name="upperBrackets" >14</button>
							<button type="button" class="number" id="brk_13" name="upperBrackets" >13</button>
							<button type="button" class="number" id="brk_12" name="upperBrackets" >12</button>
							<button type="button" class="number" id="brk_11" name="upperBrackets"  style="margin:0">11</button>
						</div>
						<div style="padding-top:5px;border-right:1px solid #3c3c3c;padding-right:5px;overflow:hidden">
                            <button type="button" class="number" id="brk_48" name="lowerBrackets" >48</button>
							<button type="button" class="number" id="brk_47" name="lowerBrackets" >47</button>
							<button type="button" class="number" id="brk_46" name="lowerBrackets" >46</button>
							<button type="button" class="number" id="brk_45" name="lowerBrackets" >45</button>
							<button type="button" class="number" id="brk_44" name="lowerBrackets" >44</button>
							<button type="button" class="number" id="brk_43" name="lowerBrackets" >43</button>
							<button type="button" class="number" id="brk_42" name="lowerBrackets" >42</button>
							<button type="button" class="number" id="brk_41" name="lowerBrackets"  style="margin:0">41</button>

						</div>
					</div>
					<div style="overflow:hidden;display:inline-block;float:left">
						<div style="border-bottom:1px solid #3c3c3c;overflow:hidden;padding-left:5px;padding-bottom:5px">

                            <button type="button" class="number" id="brk_21" name="upperBrackets" >21</button>
							<button type="button" class="number" id="brk_22" name="upperBrackets" >22</button>
							<button type="button" class="number" id="brk_23" name="upperBrackets" >23</button>
							<button type="button" class="number" id="brk_24" name="upperBrackets" >24</button>
							<button type="button" class="number" id="brk_25" name="upperBrackets" >25</button>
							<button type="button" class="number" id="brk_26" name="upperBrackets" >26</button>
							<button type="button" class="number" id="brk_27" name="upperBrackets" >27</button>
							<button type="button" class="number" id="brk_28" name="upperBrackets"  style="margin:0">28</button>
						</div>
						<div style="padding-top:5px;overflow:hidden;padding-left:5px">
							<button type="button" class="number" id="brk_31" name="lowerBrackets" >31</button>
							<button type="button" class="number" id="brk_32" name="lowerBrackets" >32</button>
							<button type="button" class="number" id="brk_33" name="lowerBrackets" >33</button>
							<button type="button" class="number" id="brk_34" name="lowerBrackets" >34</button>
							<button type="button" class="number" id="brk_35" name="lowerBrackets" >35</button>
							<button type="button" class="number" id="brk_36" name="lowerBrackets" >36</button>
							<button type="button" class="number" id="brk_37" name="lowerBrackets" >37</button>
							<button type="button" class="number" id="brk_38" name="lowerBrackets"  style="margin:0">38</button>
						</div>
					</div>
					<p class="RL" style="margin-left:5px">L</p>
				</div>
				<p style="text-align:left;margin:10px 0"><span style="color:#ff0000;margin-right:10px">*</span>개별 추가 및 수정 시 치아 번호를 선택하여 등록해주세요.</p>
				<div style="height: 160px; overflow-y: scroll; overflow-x: hidden;">
					<table class="bracket_table" id="bracket_table">
						<thead>
							<td>No</td>
							<td>회사명</td>
							<td>제품명</td>
							<td>브라켓 번호</td>
							<td>색</td>
						</thead>
						<tbody id="brk_list_tbody">
						<tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

   
	
	
	<div class="button_menu">
		<a href="javascript:servicePopupClose();"  class="service_close">닫기</a>
        <input type="submit" id="btn_pre" value="뒤로가기" class="service_close" style="margin:0">
		<input type="submit" id="btn_next"  value="다음" class="service_next"> 

	</div>
    </form>
</div>
<div class="black_bg"></div>

<div class="modal_wrap">
    <div>
       <? include($_SERVER["DOCUMENT_ROOT"]."/views/service/brk_custom_lab.php");  ?>
    </div>
</div>

<div class="modal_wrap_product">
	<div>
       <? include($_SERVER["DOCUMENT_ROOT"]."/views/service/brk_custom_product.php");  ?> 
     </div>
</div>


<?
if (isset($_SESSION['brk_list_index'])) {
echo "<script>";
for ($i=0; $i < count($_SESSION['brk_list_index']); $i++) { 

?>
				var table_number = Number('<?echo $_SESSION['brk_list_index'][$i];?>');
				var brk_nums = '<?echo $_SESSION['brk_list_brk_numbers'][$i];?>'; 
                var color_key = brk_color_list(table_number);
				
 								var tr = " <tr class=cellcolor> \
                                    <td>" +table_number + "</td> \
                                    <td><?echo $_SESSION['brk_list_company_name'][$i];?></td> \
                                    <td><?echo $_SESSION['brk_list_product_name'][$i];?></td> \
                                    <td><? 
                                    if(!strpos($_SESSION['brk_list_brk_numbers'][$i],'#')){ echo $_SESSION['brk_list_brk_numbers'][$i];}
                                        else{
                                             $brk_numbers = explode("(",$_SESSION['brk_list_brk_numbers'][$i],2);
                                        echo $brk_numbers[0]."<span style='color:red'>(".$brk_numbers[1]."</span>";
                                        }?></td> \
                                    <td><div style='display:inline-block;width: 20px;height: 20px;background-color:"+color_key + "'></div></td> \
                                </tr>";
            $('#brk_list_tbody').append(tr);
             brk_color_append(table_number,brk_nums);
			
	$('#btn_brk_info_delete').prop('disabled', false);
<?
	//echo "$('#brk_".$_SESSION['e_select_number'][$i]."').css({'background':'url(../../resource/images/faq_up.png)', 'background-repeat' : 'no-repeat', 'background-position':'center'});";
}
echo "</script>";
}
?>

<script>
$(document).ready(function () {

    $('#btn_pre').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='05_radiograph.php' />");
    });
    
    $('#btn_next').on('click', function(event){
    $("#service_info_form").append("<input type='hidden' name='targetUrl' value='07_setup1.php' />");
    });

    $('#brk_dental_lab').on('click', function(event){
        if ( $('#bracket_table tbody tr').length >  9) {
            alert("브라켓 제품은 최대 10개까지 등록 가능합니다.");
            return false;
        }
    });

    $('#brk_product').on('click', function(event){
            if ( $('#bracket_table tbody tr').length >  9) {
                alert("브라켓 제품은 최대 10개까지 등록 가능합니다.");
                return false;
            }
    });


	$('.number').prop('disabled', true);
	if ($("#upperCheckBox").is(":checked") && !$("#lowerCheckBox").is(":checked")) {
		
		 //Tray Sections 활성화
		 $("input[name=upperTraySelectMenu]").each(function (i) {
            $(this).prop('disabled', false);
        });
        //11 ~ 28 버튼 활성화
        $('button[name=upperBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

        //11 ~ 28 버튼 활성화
        $('input[name=upperBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });
        //11 ~ 28 버튼 활성화
        $('input[name=cp_upperBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

        //회사선택 활성화
        $('#brk_dental_lab').prop('disabled', false);
	}else if($("#lowerCheckBox").is(":checked") && !$("#upperCheckBox").is(":checked")){
		  //Tray Sections 활성화
		  $("input[name=lowerTraySelectMenu]").each(function (i) {
            $(this).prop('disabled', false);
        });

        //31 ~ 48 버튼 활성화
        $('button[name=lowerBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

        //31 ~ 48 버튼 활성화
        $('input[name=lowerBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

        //31 ~ 48 버튼 활성화
        $('input[name=cp_lowerBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });


        //회사선택 활성화
        $('#brk_dental_lab').prop('disabled', false);
		
	}else if($("#upperCheckBox").is(":checked") && $("#lowerCheckBox").is(":checked")){

		
		 //Tray Sections 활성화
		 $("input[name=upperTraySelectMenu]").each(function (i) {
            $(this).prop('disabled', false);
        });
        //11 ~ 28 버튼 활성화
        $('button[name=upperBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

        //11 ~ 28 버튼 활성화
        $('input[name=upperBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

         //11 ~ 28 버튼 활성화
         $('input[name=cp_upperBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

		  //Tray Sections 활성화
		  $("input[name=lowerTraySelectMenu]").each(function (i) {
            $(this).prop('disabled', false);
        });

        //31 ~ 48 버튼 활성화
        $('button[name=lowerBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

        //31 ~ 48 버튼 활성화
        $('input[name=lowerBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });

        //31 ~ 48 버튼 활성화
        $('input[name=cp_lowerBrackets]').each(function (i) {
            $(this).prop('disabled', false);
        });


		//회사선택 활성화
        $('#brk_dental_lab').prop('disabled', false);



		$('.number').prop('disabled', false);



		
	}

    $('.number').click(function (e) {
        // 등록안된 브라켓 눌렀을 때 개별선택
        if ($(e.target).val() != "true") {
            if ( $('#bracket_table tbody tr').length >  9) {
            alert("브라켓 제품은 최대 10개까지 등록 가능합니다.");
            return false;
        }

        var sWidth = $("#content").width();
        var sHeight = $("#content").height();

        var oWidth = $('.brk_indi_select').width();
        var oHeight = $('.brk_indi_select').height();

        // 레이어가 나타날 위치를 셋팅한다.
        var divLeft = e.pageX-40;
        var divTop = e.pageY;

        // 레이어가 화면 크기를 벗어나면 위치를 바꾸어 배치한다.
        if (divLeft + oWidth > sWidth) 
            divLeft -= oWidth;
        if (divTop + oHeight > sHeight) 
            divTop -= oHeight;
        
        // 레이어 위치를 바꾸었더니 상단기준점(0,0) 밖으로 벗어난다면 상단기준점(0,0)에 배치하자.
        if (divLeft < 0) 
            divLeft = 0;
        if (divTop < 0) 
            divTop = 0;
        $('.black_bg').css('display', 'block');   
        $('.brk_indi_select').css({"top": divTop, "left": divLeft, "position": "absolute","z-index": "9999"}).show();
        $('#brk_indi_select_target').val($(e.target).text());
        $('#brk_target_status').val("indi");
        
        brk_ind_selec_num();

        // 등록된브라켓 눌렀을 때 레이어 팝업
    }else{

       var sWidth = $("#content").width();
        var sHeight = $("#content").height();

        var oWidth = $('.brk_selected_select').width();
        var oHeight = $('.brk_selected_select').height();

        // 레이어가 나타날 위치를 셋팅한다.
        var divLeft = e.pageX-170;
        var divTop = e.pageY;

        // 레이어가 화면 크기를 벗어나면 위치를 바꾸어 배치한다.
        if (divLeft + oWidth > sWidth) 
            divLeft -= oWidth;
        if (divTop + oHeight > sHeight) 
            divTop -= oHeight;
        
        // 레이어 위치를 바꾸었더니 상단기준점(0,0) 밖으로 벗어난다면 상단기준점(0,0)에 배치하자.
        if (divLeft < 0) 
            divLeft = 0;
        if (divTop < 0) 
            divTop = 0;
        $('.black_bg').css('display', 'block');   
        $('.brk_selected_select').css({"top": divTop, "left": divLeft, "position": "absolute","z-index": "9999"}).show();
        $('#brk_selected_select').val($(e.target).text());
        
        $('#brk_target_status').val("update");
       // $('.brk_indi_dental_lab option').prop('selected',false);

        brk_ind_selec_num();

    }
    
    });

    $("#brk_indi_select_ok").click(function (e) {
        if ($('#brk_indi_product option:checked').val() == "") {
            alert('제품을 선택해 주세요.');
            return;
        }

if ( $('#brk_target_status').val() == "update") {
    

      var brk_info_list = $('.cellcolor');
        brk_info_list.each(function(i) {
        var tr = brk_info_list.eq(i);
        var td = tr.children();
        var brk_numbers = td.eq(3).text();

    //  - , 전부있는경우
    if (brk_numbers.indexOf("-") != -1 && brk_numbers.indexOf(",") != -1) {
        var list_size = brk_numbers.split(',');

        var number_list = [];

        for (let index = 0; index < list_size.length; index++) {
            if (list_size[index].indexOf("-") != -1) {
                var list_iner_numbers = list_size[index].split('-');
                var start_num = list_iner_numbers[0];
                var end_num = list_iner_numbers[1];

                for (let j = start_num; j <= end_num; j++) {
                    number_list.push(j);
                }
            }else{
                number_list.push(list_size[index]);
            }
        }

        number_list.sort();
        
        for (let f = 0; f < number_list.length; f++) {
            if (number_list[f] == $('#brk_indi_select_target').val()) {
                 number_list.splice(f,1);
                 td.eq(3).text(numberSorting(number_list));
                 break;
            }
        }
        


    // - 만 포함인경우 ex) 11 - 13 구분없음
    } else if (brk_numbers.indexOf("-") != -1 && brk_numbers.indexOf(",") == -1) {
        var nums = brk_numbers.split('-');

        var number_list = [];

        var start_num = nums[0];
        var end_num = nums[1];

        for (let j = start_num; j <= end_num; j++) {
                    number_list.push(j);
                }
        number_list.sort();

        for (let f = 0; f < number_list.length; f++) {
            if (number_list[f] == $('#brk_indi_select_target').val()) {
                 number_list.splice(f,1);
                 td.eq(3).text(numberSorting(number_list));
                 break;
            }
        }
        // var sortingList = numberSorting(number_list);
        // td.eq(3).text(sortingList);
  
    // , 만 포함인경우 ex) 11,15,21 구분없음
    } else if (brk_numbers.indexOf(",") != -1 && brk_numbers.indexOf("-") == -1) {
        var nums = brk_numbers.split(',');

        var number_list = [];

        for (let j = 0; j < nums.length; j++) {
            number_list.push(nums[j]);
        }

        number_list.sort();

        for (let f = 0; f < number_list.length; f++) {
            if (number_list[f] == $('#brk_indi_select_target').val()) {
                 number_list.splice(f,1);
                 td.eq(3).text(numberSorting(number_list));
                 break;
            }
        }
        
        // var sortingList = numberSorting(number_list);
        // td.eq(3).text(sortingList);

        //교체
    }else if(brk_numbers.indexOf("#") != -1){

        //alert('브라켓 직접선택 테이블 번호 ERRROROORER!!!!!!!!!!!!!!!!!!!!!!!!!!!');
        var num = brk_numbers.split('(',2);
        if (num[0] ==  $('#brk_indi_select_target').val()) {
        brk_info_list.eq(i).remove();
    }



  // 단일인 경우 ex) 15 단일인경우 단일비교 후 처리
    }else{
        if (brk_numbers == $('#brk_indi_select_target').val()) {
            brk_info_list.eq(i).remove();

        }
        //alert("단일");
    }
        });
    }

        var brk_info_list_tp = $('.cellcolor');

      
        brk_info_list_tp.each(function(i) {

        var tr = brk_info_list_tp.eq(i);
        var td = tr.children();
        var str_brk_numbers = td.eq(3).text();
        var color_key = brk_color_list(i+1);

        brk_color_append(i+1,str_brk_numbers);
        td.eq(0).text(i+1);
        td.eq(4).remove();
        tr.append("<td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td>");

        });
                         
                         
                        var table_number = (1 + $('#bracket_table tbody tr').length);
                        var color_key = brk_color_list(table_number);
                        var tr ="";
                        if ($('#brk_indi_select_target').val() != $('#brk_indi_num').val()) {
                            tr = " <tr class=cellcolor> \
                                    <td>" +table_number + "</td> \
                                    <td>" + $('#brk_indi_dental_lab option:checked').text() + "</td> \
                                    <td>" + $('#brk_indi_product option:checked').text() + "</td> \
                                    <td>" +$('#brk_indi_select_target').val() + "<span style='color:red'>(#"+$('#brk_indi_num').val()+")</span></td> \
                                    <td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td> \
                                </tr>";
                        }else{
                            tr = " <tr class=cellcolor> \
                                    <td>" +table_number + "</td> \
                                    <td>" + $('#brk_indi_dental_lab option:checked').text() + "</td> \
                                    <td>" + $('#brk_indi_product option:checked').text() + "</td> \
                                    <td>" +$('#brk_indi_select_target').val() + "</td> \
                                    <td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td> \
                                </tr>";
                        }
                           

                                $('#brk_' + $('#brk_indi_select_target').val()).css('background-color', color_key);
                                $('#brk_' + $('#brk_indi_select_target').val()).val('true');
                                $('#brk_list_tbody').append(tr);
                                $(".brk_indi_select").css('display', 'none');
                                $('.black_bg').css('display', 'none');   


    });

    $('#btn_update').click(function (e) {

        if ( $('#bracket_table tbody tr').length >  9) {
            alert("브라켓 제품은 최대 10개까지 등록 가능합니다.");
            return false;
        }

        var sWidth = $("#content").width();
        var sHeight = $("#content").height();

        var oWidth = $('.brk_indi_select').width();
        var oHeight = $('.brk_indi_select').height();

        // 레이어가 나타날 위치를 셋팅한다.
        var divLeft = e.pageX-40;
        var divTop = e.pageY;

        // 레이어가 화면 크기를 벗어나면 위치를 바꾸어 배치한다.
        if (divLeft + oWidth > sWidth) 
            divLeft -= oWidth;
        if (divTop + oHeight > sHeight) 
            divTop -= oHeight;
        
        // 레이어 위치를 바꾸었더니 상단기준점(0,0) 밖으로 벗어난다면 상단기준점(0,0)에 배치하자.
        if (divLeft < 0) 
            divLeft = 0;
        if (divTop < 0) 
            divTop = 0;
         $('.brk_indi_select').css({"top": divTop, "left": divLeft, "position": "absolute","z-index": "9999"}).show();
        $('.brk_selected_select').css('display', 'none');
        $('#brk_indi_select_target').val($('#brk_selected_select').val());
        brk_ind_selec_num();

    });


    $('#btn_delete').click(function (e) {
        $('.brk_selected_select').css('display', 'none');
        $('.black_bg').css('display', 'none');   
        var tp = [];
        tp.push($('#brk_selected_select').val());
        deduplication(tp);
        $("#brk_"+$('#brk_selected_select').val()).css({"background": ""});
        $("#brk_"+$('#brk_selected_select').val()).val('');

                    var brk_info_list_tp = $('.cellcolor');

                    brk_info_list_tp.each(function(i) {

                    var tr = brk_info_list_tp.eq(i);
                    var td = tr.children();
                    var str_brk_numbers = td.eq(3).text();
                    var color_key = brk_color_list(i+1);

                    brk_color_append(i+1,str_brk_numbers);
                    td.eq(0).text(i+1);
                    td.eq(4).remove();
                    tr.append("<td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td>");

                    });

    });

   $('.black_bg').mouseup(function (e) {
    var LayerPopup = $(".popupLayer");
    if (LayerPopup.has(e.target).length === 0) {
        $(".brk_indi_select").css('display', 'none');
        $(".brk_selected_select").css('display', 'none');
        $('.black_bg').css('display', 'none');   
    }
    });

    $('#brk_indi_select_close').mouseup(function (e) {
        $(".brk_indi_select").css('display', 'none');
        $(".brk_selected_select").css('display', 'none');
        $('.black_bg').css('display', 'none');   
    });
});//ready

function closeLayer(obj) {
    $(obj)
        .parent()
        .parent()
        .hide();
}


</script>


<?php

$config['cf_title'] = "서비스 신청";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>
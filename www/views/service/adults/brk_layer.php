<div class="brk_indi_select" >
	<div style="background-color:#08a2e8;text-align:center;color:#fff;padding:10px 0">
		<h2 style="text-align:center">브라켓 선택</h2>
	</div>
    <div class="indi_select" style="float:left">
        <div class="indi_select_item">
        <input type="hidden" id="brk_indi_select_target"/>
        <input type="hidden" id="brk_target_status"/>
            <p>회사 선택</p>
            <select class="" type="text" style="width:350px" id="brk_indi_dental_lab" name="brk_indi_dental_lab" onchange="brk_indi_selectDentalLab();">
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
            </select>
        </div>
        <div class="indi_select_item">
            <p>제품 선택</p>
           <select class="" type="text" style="width:350px" id="brk_indi_product" name="brk_indi_product" disabled onchange="brk_indi_selectedProduct();">
				<option value="" selected disabled hidden>선택 해주세요.</option>
			</select>
        </div>
        <div class="indi_select_item">
            <p>번호 선택</p>
            <select class="" type="text" style="width:350px" id="brk_indi_num" name="brk_indi_num" disabled >
			</select>
        </div>   
        <button type="button" id="brk_indi_select_ok" style="right:190px" >확인</button>
		<button type="button" id="brk_indi_select_close" style="background-color:#3c3c3c" >취소</button>
    </div>             
</div>

<div class="brk_selected_select" >
    <div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
        <input type="hidden" id="brk_selected_select"/>
        <button type="button" id="btn_update" >수정</button>
        <button type="button" id="btn_delete" >삭제</button>
    </div>             
</div>

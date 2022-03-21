<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/head.sub.php");
?>
<div style="background-color:#08a2e8;text-align:center;color:#fff;padding:10px 0">
	<h2 style="text-align:center">브라켓 사용자 지정</h2>
</div>
<div style="padding:40px">
	<div>
		<p style="color:red">브라켓 사용자 지정이란?</p>
		<p>브라켓 회사명 / 제품명을 입력해 주시면 저희가 직접<br>
		브라켓을 제작하여 U-IDB 서비스안에 추가해 드립니다.<br>
		제작 소요시간은 ?일이며, 문의하신 브라켓 제작완료 시<br>
		U-IDB 서비스를 진행합니다.</p>
	</div>
	<div style="overflow:hidden;margin-top:20px">
		<div style="width:100%;overflow:hidden">
			<p style="float:left;vertical-align:middle;padding:13px 0">회사 선택</p>
			<input style="float:right;width:520px;" type="text" id="brk_selected_custom_lab" placeholder="회사명을 입력해 주세요.">
		</div>
		<div style="width:100%;overflow:hidden;margin-top:20px">
			<p style="float:left;vertical-align:middle;padding:13px 0">제품 선택</p>
			<input style="float:right;width:520px;" type="text" id="brk_selected_cl_product" placeholder="제품명을 입력해 주세요.">
		</div>
	</div>
	<div>
		<div style="width:100%;overflow:hidden">
			<p style="float:left;padding-top:60px">번호 선택</p>
			<div style="float:right;width:520px;text-align:center;padding-top:20px" class="brk_checkbox">
				<p style="float:left;padding: 40px 0">R</p>
				<div style="overflow:hidden;display:inline-block;">
				<div style="font-size:0;" class="brk_upper">
					<div style="display: inline-block;text-align:center;;overflow:hidden;padding-bottom:10px;border-bottom:1px solid #3c3c3c;font-size:18px">
						<div style="display: inline-block;text-align:center">
							<label for="brk18" style="display: block;">18</label>
							<input type="checkbox" disabled  name="upperBrackets" value="18" id="brk18">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk17" style="display: block;">17</label>
							<input type="checkbox" disabled name="upperBrackets"  value="17" id="brk17">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk16" style="display: block;">16</label>
							<input type="checkbox" disabled name="upperBrackets" value="16" id="brk16">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk15" style="display: block;">15</label>
							<input type="checkbox" disabled name="upperBrackets" value="15" id="brk15">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk14" style="display: block;">14</label>
							<input type="checkbox" disabled name="upperBrackets" value="14" id="brk14">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk13" style="display: block;">13</label>
							<input type="checkbox" disabled name="upperBrackets" value="13" id="brk13">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk12" style="display: block;">12</label>
							<input type="checkbox" disabled name="upperBrackets" value="12" id="brk12">
						</div>
						<div style="display: inline-block;text-align:center;padding-right:10px">
							<label for="brk11" style="display: block;">11</label>
							<input type="checkbox" disabled name="upperBrackets" value="11" id="brk11">
						</div>
					</div>
					<div style="display: inline-block;text-align:center;overflow:hidden;border-left:1px solid #3c3c3c;padding-bottom:10px;border-bottom:1px solid #3c3c3c;font-size:18px">
						<div style="display: inline-block;text-align:center;padding-left:10px">
							<label for="brk21" style="display: block;">21</label>
							<input type="checkbox" disabled name="upperBrackets" value="21" id="brk21">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk22" style="display: block;">22</label>
							<input type="checkbox" disabled name="upperBrackets" value="22" id="brk22">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk23" style="display: block;">23</label>
							<input type="checkbox" disabled name="upperBrackets" value="23" id="brk23">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk24" style="display: block;">24</label>
							<input type="checkbox" disabled name="upperBrackets" value="24" id="brk24">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk25" style="display: block;">25</label>
							<input type="checkbox" disabled name="upperBrackets" value="25" id="brk25">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk26" style="display: block;">26</label>
							<input type="checkbox" disabled name="upperBrackets" value="26" id="brk26">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk27" style="display: block;">27</label>
							<input type="checkbox" disabled name="upperBrackets" value="27" id="brk27">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk28" style="display: block;">28</label>
							<input type="checkbox" disabled name="upperBrackets" value="28" id="brk28">
						</div>
					</div>
				</div>
				<div style="font-size:0;" class="brk_lower">
					<div style="display: inline-block;text-align:center;;overflow:hidden;font-size:18px">
						<div style="display: inline-block;text-align:center">
							<label for="brk48" style="display: block;">48</label>
							<input type="checkbox" disabled name="lowerBrackets" value="48" id="brk48">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk47" style="display: block;">47</label>
							<input type="checkbox" disabled name="lowerBrackets" value="47" id="brk47">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk46" style="display: block;">46</label>
							<input type="checkbox" disabled name="lowerBrackets" value="46" id="brk46">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk45" style="display: block;">45</label>
							<input type="checkbox" disabled name="lowerBrackets" value="45" id="brk45">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk44" style="display: block;">44</label>
							<input type="checkbox" disabled name="lowerBrackets" value="44" id="brk44">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk43" style="display: block;">43</label>
							<input type="checkbox" disabled name="lowerBrackets" value="43" id="brk43">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk42" style="display: block;">42</label>
							<input type="checkbox" disabled name="lowerBrackets" value="42" id="brk42">
						</div>
						<div style="display: inline-block;text-align:center;padding-right:10px">
							<label for="brk41" style="display: block;">41</label>
							<input type="checkbox" disabled name="lowerBrackets" value="41" id="brk41">
						</div>
					</div>
					<div style="display: inline-block;text-align:center;overflow:hidden;border-left:1px solid #3c3c3c;font-size:18px">
						<div style="display: inline-block;text-align:center;padding-left:10px">
							<label for="brk31" style="display: block;">31</label>
							<input type="checkbox" disabled name="lowerBrackets" value="31" id="brk31">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk32" style="display: block;">32</label>
							<input type="checkbox" disabled name="lowerBrackets" value="32" id="brk32">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk33" style="display: block;">33</label>
							<input type="checkbox" disabled name="lowerBrackets" value="33" id="brk33">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk34" style="display: block;">34</label>
							<input type="checkbox" disabled name="lowerBrackets" value="34" id="brk34">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk35" style="display: block;">35</label>
							<input type="checkbox" disabled name="lowerBrackets" value="35" id="brk35">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk36" style="display: block;">36</label>
							<input type="checkbox" disabled name="lowerBrackets" value="36" id="brk36">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk37" style="display: block;">37</label>
							<input type="checkbox" disabled name="lowerBrackets" value="37" id="brk37">
						</div>
						<div style="display: inline-block;text-align:center">
							<label for="brk38" style="display: block;">38</label>
							<input type="checkbox" disabled name="lowerBrackets" value="38" id="brk38">
						</div>
					</div>
				</div>
			</div>
			<p style="float:right;padding: 40px 0">L</p>
		</div>
	</div>
		
	<div style="position:absolute;bottom:20px;right:40px;">
		<input type="button" value="확인" style="width:190px;padding:13px 0;border:none;border-radius:5px;background-color:#07a2e8;color:#fff" onclick="brk_c_dl_confirm();"/>
		<input type="button" value="취소" style="width:190px;padding:13px 0;border:none;border-radius:5px;background-color:#3c3c3c;color:#fff"  onClick="brk_c_dl_close();"/>
	</div>
</div>
</div>


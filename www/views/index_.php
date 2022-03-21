<?php
include_once('../inc/_common.php');
include_once('inc/head.php');
?>

<div id="container">
	<div class="content" style="overflow:hidden;">
		<div class="top_banner">
			<a class="service_button" href="#">
				<p>서비스 신청</p>
				<span><img src="/resource/images/service_button.png"></span>
			</a>
			<a class="ad_banner" href="#"><img src="/resource/images/advertise.png"></a>
			<div style="float:right;position:absolute;bottom:0;right:0">
			<input class="search_input" type="text" placeholder="검색" value="">
			<a class="calender"><img src="/resource/images/calender.png"></a>
			</div>
		</div>
		<div class="tab" style="font-size:18px">
		<a class="tab_list tab_select" href=""><p>전체</p><span>10</span></a>
		<a class="tab_list" href=""><p>작성 중</p><span>1</span></a>
		<a class="tab_list" href=""><p>제출</p><span>2</span></a>
		<a class="tab_list" href=""><p>접수</p><span>3</span></a>
		<a class="tab_list" href=""><p>디자인</p><span>4</span></a>
		<a class="tab_list" href=""><p>검토</p><span>5</span></a>
		<a class="tab_list" href=""><p>승인</p><span>6</span></a>
		<a class="tab_list" href=""><p>제작 중</p><span>7</span></a>
		<a class="tab_list" href=""><p>배송</p><span>8</span></a>
		<a class="tab_list" href=""><p>종료</p><span>111</span></a>
		</div>
		<div class="list_table">
			<table class="table" style="width:100%;font-size:18px">
				<thead>
					<th>환자</th>
					<th>서비스 정보</th>
					<th>시작일</th>
					<th>마지막 수정일</th>
					<th></th>
					<th>상태</th>
					<th>View</th>
				</thead>
				<tr>
					<td>
						<div style="padding:0 20px">
							<p style="width:60px;height:60px;background-color:#fff;position:relative;float:left">
								<img src="/resource/images/male_icon.png" style="position:absolute;left:50%; transform:translateX(-50%);bottom:0">
							</p>
							<div style="float:left;padding-top:5px;margin-left:10px">
							<p>Name Name</p>
							<p>(test id id)</p>
							</div>
						</div>
					</td>
					<td align="center">IDB 서비스</td>
					<td align="center">01/05/2021</td>
					<td align="center">10/05/2021</td>
					<td align="center"><p class="table_noti"></p></td>
					<td align="center">처방전 접수</td>
					<td align="center">
						<div>
							<a class="table_view_button">App</a>
							<a class="table_view_button">Web</a>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding:0 20px">
							<p style="width:60px;height:60px;background-color:#fff;position:relative;float:left">
								<img src="/resource/images/male_icon.png" style="position:absolute;left:50%; transform:translateX(-50%);bottom:0">
							</p>
							<div style="float:left;padding-top:5px;margin-left:10px">
							<p>Name Name</p>
							<p>(test id id)</p>
							</div>
						</div>
					</td>
					<td align="center">IDB 서비스</td>
					<td align="center">01/05/2021</td>
					<td align="center">10/05/2021</td>
					<td align="center"><p class="table_noti"></p></td>
					<td align="center">처방전 접수</td>
					<td align="center">
						<div>
							<a class="table_view_button">App</a>
							<a class="table_view_button">Web</a>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding:0 20px">
							<p style="width:60px;height:60px;background-color:#fff;position:relative;float:left">
								<img src="/resource/images/male_icon.png" style="position:absolute;left:50%; transform:translateX(-50%);bottom:0">
							</p>
							<div style="float:left;padding-top:5px;margin-left:10px">
							<p>Name Name</p>
							<p>(test id id)</p>
							</div>
						</div>
					</td>
					<td align="center">IDB 서비스</td>
					<td align="center">01/05/2021</td>
					<td align="center">10/05/2021</td>
					<td align="center"><p class="table_noti"></p></td>
					<td align="center">처방전 접수</td>
					<td align="center">
						<div>
							<a class="table_view_button">App</a>
							<a class="table_view_button">Web</a>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding:0 20px">
							<p style="width:60px;height:60px;background-color:#fff;position:relative;float:left">
								<img src="/resource/images/male_icon.png" style="position:absolute;left:50%; transform:translateX(-50%);bottom:0">
							</p>
							<div style="float:left;padding-top:5px;margin-left:10px">
							<p>Name Name</p>
							<p>(test id id)</p>
							</div>
						</div>
					</td>
					<td align="center">IDB 서비스</td>
					<td align="center">01/05/2021</td>
					<td align="center">10/05/2021</td>
					<td align="center"><p class="table_noti"></p></td>
					<td align="center">처방전 접수</td>
					<td align="center">
						<div>
							<a class="table_view_button">App</a>
							<a class="table_view_button">Web</a>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding:0 20px">
							<p style="width:60px;height:60px;background-color:#fff;position:relative;float:left">
								<img src="/resource/images/male_icon.png" style="position:absolute;left:50%; transform:translateX(-50%);bottom:0">
							</p>
							<div style="float:left;padding-top:5px;margin-left:10px">
							<p>Name Name</p>
							<p>(test id id)</p>
							</div>
						</div>
					</td>
					<td align="center">IDB 서비스</td>
					<td align="center">01/05/2021</td>
					<td align="center">10/05/2021</td>
					<td align="center"><p class="table_noti"></p></td>
					<td align="center">처방전 접수</td>
					<td align="center">
						<div>
							<a class="table_view_button">App</a>
							<a class="table_view_button">Web</a>
						</div>
					</td>
				</tr>
			</table>
			<div style="text-align:center;font-size:15px;margin:15px 0">
				<p style="margin:15px 0">Page 1/2</p>
				<div>
					<a style="display:inline-block" href="#">맨 처음으로</a>
					<div style="display:inline-block">
					<a class="pagination_left" style="" href="#"></a>
					<a class="pagination_number select">1</a>
					<a class="pagination_number">2</a>
					<a class="pagination_number">3</a>
					<a class="pagination_right" style="" href="#"></a>
						
					</div>
					<a style="display:inline-block" href="#">맨 마지막으로</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
include_once('inc/tail.php');
?>
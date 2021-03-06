<?

/******************************************
 * 환자 리스트 페이지 viewmodel
 ******************************************/
//ini_set("display_errors", "1");

// $user_code = $_SESSION['member_code'];
// $user_name = $_SESSION['member_name'];

$tab_number = $_GET['cate'];
$page_number = $_GET['page'];
$sort_standard = $_GET['standard'];
$sort_result = $_GET['result'];
if (isset($_GET['fdate']) && $_GET['fdate'] != "") {
    $f_date = $_GET['fdate'];
} else {
    $f_date = null;
}
if (isset($_GET['tdate']) && $_GET['tdate'] != "") {
    $t_date = $_GET['tdate'];
} else {
    $t_date = null;
}


if (isset($_GET['fdate'])) {
    $s_date = "&fdate=" . $f_date;
    $e_date = "&tdate=" . $t_date;
}


$smsg = $_GET['q'];
$total_page_cnt;
$total_row_cnt;
$qmsg;
// 리스트 상태별로 전체 카운트 받아오기 (전체 ~ 종료)
// $list_count = patientlist_count($user_code);

// // 상태별 구분, 탭번호 없으면  0  == 전체
// if($tab_number == null) {
// 	$tab_number = 0;
// 	for($i = 0; $i < count($list_count);$i++){
// 				if($list_count[$i]['rgubun'] == 0){
// 				$total_page_cnt = $list_count[$i]['rpagecount'];
// 				$total_row_cnt =  $list_count[$i]['rtotalCount'];
// 				}
// 			}
// 	}
// //있으면 전체 카운트리스트 에서 구분값 비교후  전체 페이지, 데이터 카운트 대입
// 	else{
// 		for($i = 0; $i < count($list_count);$i++){
// 				if($tab_number == $list_count[$i]['rgubun']){
// 				$total_page_cnt = $list_count[$i]['rpagecount'];
// 				$total_row_cnt =  $list_count[$i]['rtotalCount'];
// 				}
// 			}
// 		}
//print_r($total_page_cnt);

$tab_number = $tab_number ? $tab_number : 0;
//$total_page_cnt;
//$total_row_cnt;


// 현재 페이지	 넘버 없으면 1
$page_number = $page_number ? $page_number : 1;
// 정렬 기준	 1:환자, 2:서비스 정보, 3:시작일, 4:마지막수정일, 5:상태
$sort_standard = $sort_standard ? $sort_standard : 3; // @LUCAS 2.5 기본 정렬을 `시작일` 로 바꾼다.
// 정렬 방법 D:DESC(내림차순), A:ASC(오름차순)
$sort_result = $sort_result ? $sort_result : 'D';
//echo $page_number;

// 검색 결과 List
if (!isset($_GET['q']) || $_GET['q'] == "") {

// if (!isset($_GET['fdate']) || $_GET['fdate'] =="") {
    $result_list = patientlist_r($tab_number, $page_number, $sort_standard, $sort_result, (int)$user_code, $f_date, $t_date, "");
    $row_count = patient_count_r($tab_number, $user_code, $f_date, $t_date, "");
    // $page_count = $total_page_cnt;
// }else{
//     $result_list = patientlist_r($tab_number, $page_number, $sort_standard, $sort_result, (int)$user_code,  $f_date, $t_date, "");
//     $row_count = patient_count_r($tab_number, $user_code, $f_date , $t_date, "");
//    // $page_count = $result_list[0]['DSHCOUNT'];
// }

} else {
    $result_list = patientlist_r($tab_number, $page_number, $sort_standard, $sort_result, (int)$user_code, $f_date, $t_date, $smsg);
    $qmsg = "&q=" . $smsg;
    $row_count = patient_count_r($tab_number, $user_code, $f_date, $t_date, $smsg);
    // $page_count = $result_list[0]['DSHCOUNT'];
}


$result_list_count = count($result_list);

$resultPage = "&page=" . $page_number;


$LIST_SIZE = 5;

$page = $page_number;

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


//print_r(patient_count_r(0, $user_code, null, null, ''));
//print_r($result_list[0]);

$next_sort_result;
if ($sort_result == 'A') {
    $next_sort_result = 'D';
} else {
    $next_sort_result = 'A';
}

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
        border-left: 1px solid #fff;
        border-right: 1px solid #fff;
	}
	.list_table2 th {
		background-color: #e6e6e6;
		font-weight: normal;
		height: 60px;
		border-bottom: 1px solid #d2d2d2;
		position: relative;
	}
	
	.list_table2 table td {
		height: 80px;
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




<div class="content" style="overflow:hidden;height:783px">
    <div class="top_banner"style="height:60px;">
        <a class="service_button hover240" href="javascript:servicePopup(); " style="height:60px;">
            <p>Create order</p>
            <span><img src="/resource/images/service_button.png"></span>
        </a>


        <div class="main_search" style="display: flex;">
            <!-- @LUCAS 1.5 All search -->
            <button
                    class="btn_black hover100 btn_all_search"
                    style="width:100px; float:left; border:0px; margin-right: 10px; font-size:16px;"
            >
                All search
            </button>
            <form id="s_box" onsubmit="return listSearch()" autocomplete="off">
                <!-- @LUCAS Live Search Bar 라이브 서치바 추가 -->
                <div class="dropdown" style="height:50px;">
                    <div class="form-group" style="float:left;">
                        <input
                                autocomplete="off"
                                type="text"
                                name="q"
                                class="form-control-sign_up live-search-bar"
                                placeholder="Search"
                                id="search_q"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                value="<?= $smsg ?>"
                                style="width:330px; height:50px; border:0px; border-radius:7px;"
                        />
                        <div class="form-control-sign_up-border"></div>
                    </div>

                    <button style="position:fixed; margin-left:-50px;"type="submit" class="search_button" id="btn_search" value=""></button>
                    <span id="live_search_result"></span>
                </div>

                <a href="#" class="calendar" id="modal_btn"><img src="/resource/images/calender.png"></a>
            </form>
        </div>
    </div>

    <!-- @LUCAS 2.5 환자리스트 텝 애니메이션 시작 -->
    <div class="tab" style="font-size:18px; display:flex;">
        <?
        $tabMenus = array(
            array("name" => "All", "tab_number" => 0, "status_ids" => [0]),
            array("name" => "Draft", "tab_number" => 1, "status_ids" => [1]),
            array("name" => "Order", "tab_number" => 2, "status_ids" => [20, 21]),
            array("name" => "Accepted", "tab_number" => 3, "status_ids" => [2, 3, 14, 22]),
            array("name" => "Design", "tab_number" => 4, "status_ids" => [7, 8, 9, 10, 11]),
            array("name" => "Review", "tab_number" => 5, "status_ids" => [12, 13]),
            array("name" => "Approve", "tab_number" => 6, "status_ids" => [15]),
            array("name" => "Production", "tab_number" => 7, "status_ids" => [16, 17]),
            array("name" => "Delivery", "tab_number" => 8, "status_ids" => [5, 6, 18]),
            array("name" => "Archive", "tab_number" => 9, "status_ids" => [19])
        );

        foreach ($tabMenus as $tabMenu) {
            if ($tabMenu['skip']) continue;
            ?>
            <div style="margin-right:10px;">
                <p class="tab_count">
                    <span class="tab-alarm-placeholder" data-status-ids="<?= json_encode($tabMenu['status_ids']) ?>" />
                </p>
                <button type="button"
                        class="tablinks <? if ((int)$tab_number == $tabMenu['tab_number']) echo "active"; ?>"
                        onclick="location.href='<?= $_SERVER['PHP_SELF'] . '?cate=' . $tabMenu['tab_number'] . $s_date . $e_date . $qmsg; ?>'">
                    <p data-title="<?= $tabMenu['name'] ?>" class="tab_text"><?= $tabMenu['name'] ?></p>
                </button>
            </div>
            <?
        } // foreach
        ?>
    </div>



    <? if($result_list_count <= 0){ ?>
				<div class="list_table2 member_table">
					<table class="table" style="width:100%;font-size:18px;">
						<thead>
							<th style="width:20%">Patient</th>
							<th style="width:20%">Treatment option</th>
							<th style="width:20%">Start date</th>
							<th style="width:20%">Edited date</th>
                            <th style="width:0%;"></th>
                            <th style="width:20%">Status</th>
						</thead>
						<tbody>
				
						<tr><td colspan='6' style='text-align:center'><h3>No data available</h3></td></tr>
						
					</tbody>
				</table>
			</div>
		<?}?>
<?php if($result_list_count > 0){?>
    <div class="list_table sortable-table" style="height:670px;">
        <table class="table" style="width:100%;font-size:18px;">
            <colgroup>
                <col width="30%">
                <col width="20%">
                <col width="15%">
                <col width="15%">
                <col width="0%">
                <col width="20%">
            </colgroup>


            <!-- @LUCAS 2.5 전체 테이블 정렬 기능 개선 -->
            <thead>
            <?
            $tableHeaders = array(
                array("name" => "Patient", "standard" => 1, "sortable" => true),
                array("name" => "Treatment option", "standard" => 2, "sortable" => true),
                array("name" => "Start date", "standard" => 3, "sortable" => true),
                array("name" => "Edited date", "standard" => 4, "sortable" => true),
                array("name" => "", "standard" => 999, "sortable" => false),
                array("name" => "Status", "standard" => 5, "sortable" => false),
            );

            foreach ($tableHeaders as $tableHeader) {
                if ($tableHeader['skip']) continue;
                ?>
                <th>
                    <a
                            id="<?= $tableHeader['name'] . "_" . $tableHeader['standard'] ?>"
                            class="table-header <?= $tableHeader['sortable'] ? 'table-header--sortable' : '' ?> <?= $sort_standard == $tableHeader['standard'] ? ($sort_result == 'D' ? 'table-header--sortable-up' : 'table-header--sortable-down') : '' ?>"
                        <?= $tableHeader['sortable']
                            ? 'href="' . $_SERVER['PHP_SELF'] . '?cate=' . $tab_number . '&standard=' . $tableHeader['standard'] . '&result=' . $next_sort_result . $resultPage . $s_date . $e_date . $qmsg . '"'
                            : ''
                        ?>
                    >
                        <?= $tableHeader['name'] ?>
                    </a>
                </th>
                <?
            } // foreach
            ?>
            </thead>


            <tbody>
            <? if ($result_list_count <= 0) {
                echo "<tr><td colspan='5' style='text-align:center'><h3>No data available</h3></td></tr>";
            } else {
                for ($i = 0; $i < count($result_list); $i++) {
                    ?>
                    <tr class="cellcolor" id="<?= $result_list[$i]['patientkey'] ?>">
                        <td>
                            <form name="patientForm" id="patientForm<?= $result_list[$i]['patientkey'] ?>">
                                <input type="hidden" name="patientkey" value="<?= $result_list[$i]['patientkey'] ?>">
                                <input type="hidden" name="patientSt" value="<?= $result_list[$i]['Statusid'] ?>">
                                <input type="hidden" name="patientServiceKey"
                                       value="<?= $result_list[$i]['service_id'] ?>">
                                <input type="hidden" name="drId" value="<?= $result_list[$i]['account_dr_id'] ?>">
                                <input type="hidden" name="drIndex" value="<?= $result_list[$i]['drindex'] ?>">
                                <input type="hidden" name="shId" value="<?= $result_list[$i]['service_history_id'] ?>">


                            </form>
                            <div class="main_table_name">
                                <p class="main_table_name_image">
                                    <img src="/<?= $result_list[$i]['file_path'] ?>">
                                </p>
                                <div class="main_table_name_text tooltip">
                                    <p><? echo str_replace(",", " ", $result_list[$i]['patientname']); ?> (<? echo $result_list[$i]['patientid']; ?>)</p>
                                    <?php $length_count = strlen($result_list[$i]['patientname']) + strlen($result_list[$i]['patientid']); 
                                    if ($length_count>39) {?>
                                    <span class="tooltiptext tooltip-bottom"><? echo str_replace(",", " ", $result_list[$i]['patientname']); ?> (<? echo $result_list[$i]['patientid']; ?>)</span>
                                    <?}?>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center">
                            <p><? echo json_decode($result_list[$i]['serviceinfo'], true)['treatment_option1']; ?> (<? echo json_decode($result_list[$i]['serviceinfo'], true)['treatment_option2']; ?>)</p>
                        </td>
                        <td style="text-align: center">
                        <div class="tooltip">
                            <p><? $date = explode(" ", $result_list[$i]['startDate'], 2);
                                echo $date[0]; ?></p>
                            <!-- <p>(<? echo $date[1]; ?>)</p> -->
                            <span class="tooltiptext tooltip-bottom"><p><? $date = explode(" ", $result_list[$i]['startDate'], 2);
                                echo $date[0]; ?> (<? echo $date[1]; ?>)</p> </span>
                        </div>
                        </td>
                        <td style="text-align: center">
                        <div class="tooltip">
                            <? if ($result_list[$i]['lastEditDate'] != "") { ?>
                                <p><? $date = explode(" ", $result_list[$i]['lastEditDate'], 2);
                                    echo $date[0]; ?></p>
                                <!-- <p>(<? echo $date[1]; ?>)</p> -->
                                <?
                            } ?>
                             <span class="tooltiptext tooltip-bottom"><p><? $date = explode(" ", $result_list[$i]['lastEditDate'], 2);
                                    echo $date[0]; ?> (<? echo $date[1]; ?>)</p> </span>
                        </div>
                        </td>
                        <td style="text-align: right">
                            <!-- <p class="data-row-alarm-placeholder"
                               data-service-id="<?= $result_list[$i]['service_id'] ?>" /> -->
                        </td>
                        <td style="text-align: center">
                            <p class="data-row-alarm-placeholder"
                               data-service-id="<?= $result_list[$i]['service_id'] ?>"
                               style="margin:10px 0px 0px -20px; position:absolute;" ></p><?
                            switch ($result_list[$i]['Statusid']) {
                                case 1:
                                    echo "Order drafting"; // "처방전 작성 중";
                                    break;

                                case 2:
                                    echo "Order accepted"; // "처방전 접수";
                                    break;

                                case 3:
                                    echo "Order edit required"; // "처방전 수정 요청";
                                    break;

                                case 4:
                                    echo "Order completed(X)"; // "처방전 접수 완료";
                                    break;

                                case 5:
                                    echo "Plaster model delivering"; // "석고 보내는 중";
                                    break;

                                case 6:
                                    echo "Plaster model arrived"; // "석고 수령 완료";
                                    break;

                                case 7:
                                    echo "Designing"; // "셋업 진행 중";
                                    break;

                                case 8:
                                    echo "Designing"; // "셋업 진행 중";
                                    break;

                                case 9:
                                    echo "Designing"; // "셋업 진행 중";
                                    break;

                                case 10:
                                    echo "Designing"; // "셋업 진행 중";
                                    break;

                                case 11:
                                    echo "Designing"; // "셋업 진행 중";
                                    break;

                                case 12:
                                    echo "Design review required"; // "셋업 검토 요청";
                                    break;

                                case 13:
                                    echo "Design edit requested"; // "수정 요청";
                                    break;

                                case 14:
                                    echo "Design changed"; // "변경 제출";
                                    break;

                                case 15:
                                    echo "Design review completed"; // "검토 완료";
                                    break;

                                case 16:
                                    echo "Producing"; // "장치 제작 중";
                                    break;

                                case 17:
                                    echo "Production completed"; // "장치 제작 완료";
                                    break;

                                case 18:
                                    echo "Delivering"; // "장치 배송 중";
                                    break;

                                case 19:
                                    echo "Order completed"; // "서비스 완료";
                                    break;
                                case 20:
                                    echo "Order submitted"; // "처방전 제출";
                                    break;
                                case 21:
                                    echo "Edited order submitted"; //"처방전 수정 제출";
                                    break;
                                case 22:
                                    echo "Prescription retrieve"; // "처방전 작성 중";
                                    break;

                                default:
                                    echo "Error";
                                    break;
                            }
                            ?>

                        </td>
                        <!-- <td style="text-align: center">
                            <div>
                                <? if ($result_list[$i]['Statusid'] == 22 || $result_list[$i]['Statusid'] == 20 || $result_list[$i]['Statusid'] == 21 || $result_list[$i]['Statusid'] == 5 || $result_list[$i]['Statusid'] == 6 || $result_list[$i]['Statusid'] == 1 || $result_list[$i]['Statusid'] == 0 || $result_list[$i]['Statusid'] == 3 || $result_list[$i]['Statusid'] == 4 || $result_list[$i]['Statusid'] == 2 || $result_list[$i]['Statusid'] == 7 || $result_list[$i]['Statusid'] == 8 || $result_list[$i]['Statusid'] == 9 || $result_list[$i]['Statusid'] == 10) { ?>
                                    <a href="javascript:void(0);" class="table_view_button" style="color:#808080;">App</a>
                                <? } else {
                            ?>
                                    <a href="onecheck://open?DrAccountID=<?= $result_list[$i]['account_dr_id'] ?>&ServiceID=<?= $result_list[$i]['service_id'] ?>&ServiceHistoryID=<?= $result_list[$i]['service_history_id'] ?>&LoginAccountID=<?= $user_code ?>&type=0&ServiceType=2&DNS=<?= $_SERVER['HTTP_HOST'] ?>" class="table_view_button" onclick="return confirm('Do you want to run the app?');">App</a>
                                    <a class="table_view_button">Web</a>
                                <?
                        } ?>
                            </div>
                        </td> -->
                    </tr>
                <? }
            } ?>

            </tbody>
        </table>
        <? if ($result_list_count <= 0) { ?>
        <? } else { ?>
            <div class='paging_area' style="font-size:15px">
                <p style="text-align:center">Page <span><?= $page ?>/<?= $page_count ?></span></p>

                <?php if ($page <= 1): ?>
                    <a class="page_text left disabled" style="text-align:right">First</a>
                    <a class='move_btn left disabled'></a>
                    <!-- <a class='pagenum' href="<?= "$PHP_SELP?cate=$tab_number&standard=$sort_standard&result=$sort_result&page=1$s_date$e_date$qmsg" ?>">1</a> ... -->
                <?php else: ?>
                    <a class="page_text"
                       href="<?= "$PHP_SELP?cate=$tab_number&standard=$sort_standard&result=$sort_result&page=1$s_date$e_date$qmsg" ?>">First</a>
                    <a class='move_btn left '
                       href="<?= "$PHP_SELP?cate=$tab_number&standard=$sort_standard&result=$sort_result&page=$prev_page$s_date$e_date$qmsg" ?>"></a>
                <?php endif ?>

                <?php for ($p = $start_page; $p <= $end_page; $p++): ?>
                    <a class='pagenum <?= ($p == $page) ? "current" : "" ?>'
                       href="<?= "$PHP_SELP?cate=$tab_number&standard=$sort_standard&result=$sort_result&page=$p$s_date$e_date$qmsg" ?>">
                        <?= $p ?>
                    </a>
                <?php endfor ?>

                <?php if ($page == $page_count): ?>
                    <a class='move_btn right disabled'></a>
                    <a class="page_text right disabled">Last</a>
                <?php else: ?>
                    <a class='move_btn right'
                       href="<?= "$PHP_SELP?cate=$tab_number&standard=$sort_standard&result=$sort_result&page=$next_page$s_date$e_date$qmsg" ?>"></a>
                    <a class="page_text"
                       href="<?= "$PHP_SELP?cate=$tab_number&standard=$sort_standard&result=$sort_result&page=$page_count$s_date$e_date$qmsg" ?>">Last</a>
                <?php endif ?>
            </div>
        <? } ?>
    </div>
<?}?>
</div>

<script>
    $(document).ready(function () {


        // @LUCAS 1.5 All search 기능 추가
        $(".btn_all_search").on("click", function () {
            $("#search_q").val("");
            $("#s_box").submit();
        });

        // @LUCAS 검색 Input 에 Live Search Bar 라이브 검색을 위한 이벤트 추가
        $("#search_q").on({
            "keyup": function (event) {
                if (event.key !== "Enter") {
                    load_data($(this).val());
                }
            },
            "focus": function () {
                load_search_history();
            },
        });

        // Live Search Bar
        function delete_search_history(id) {
            fetch("/viewmodels/search/patient_process_data.php", {
                method: "POST",
                body: JSON.stringify({
                    action: 'delete',
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }

            }).then(function (response) {
                return response.json();

            }).then(function (responseData) {
                load_search_history();
            });
        }

        function setClickEventToLiveSearchItems() {
            $(".list-group-item").on("click", function () {
                get_text(this);
            })

            $(".delete-search-history").on("click", function (event) {
                event.preventDefault();
                event.stopPropagation();

                const searchId = $(this).data("searchId");
                delete_search_history(searchId);
                $(this).parent().remove();
            })
        }

        function load_search_history() {
            var search_query = document.getElementById('search_q').value;

            if (search_query == '') {
                fetch("/viewmodels/search/patient_process_data.php", {
                    method: "POST",
                    body: JSON.stringify({
                        action: 'fetch'
                    }),
                    headers: {
                        'Content-type': 'application/json; charset=UTF-8'
                    }
                }).then(function (response) {
                    return response.json();
                }).then(function (responseData) {
                    if (responseData.length > 0) {
                        var html = '<ul class="list-group">';

                        for (var count = 0; count < responseData.length; count++) {
                            html += '<li class="list-group-item text-muted" style="cursor:pointer"><i class="fas fa-history mr-3"></i><span>' + responseData[count].search_query + '</span> <i class="delete-search-history" data-search-id="' + responseData[count].id + '"></i></li>';
                        }
                        html += '</ul>';
                        document.getElementById('live_search_result').innerHTML = html;

                        setClickEventToLiveSearchItems();
                    }
                });
            }
        }

        function get_text(event) {
            const value = event.textContent;

            //fetch api
            fetch('/viewmodels/search/patient_process_data.php', {
                method: "POST",
                body: JSON.stringify({
                    search_query: value
                }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }
            }).then(function (response) {
                return response.json();
            }).then(function (responseData) {
                $("#search_q").val(value.split(",")[1]); // FIXME 해외
                // $("#search_q").val(value); // FIXME 국내
                $("#live_search_result").html('');
                $("#btn_search").click();
            });
        }

        function load_data(query) {
            if (query.length >= 2) {
                var form_data = new FormData();

                form_data.append('query', query);
                form_data.append('fdate', "<?= $f_date ?>");
                form_data.append('tdate', "<?= $t_date ?>");

                var ajax_request = new XMLHttpRequest();

                ajax_request.open('POST', '/viewmodels/search/patient_process_data.php');

                ajax_request.send(form_data);

                ajax_request.onreadystatechange = function () {
                    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                        var response = JSON.parse(ajax_request.responseText);

                        var html = '<div class="list-group">';

                        if (response.length > 0) {
                            for (var count = 0; count < response.length; count++) {
                                html += '<a href="#" class="list-group-item list-group-item-action">' + response[count].search_result + '</a>';
                            }
                        } else {
                            html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
                        }

                        html += '</div>';

                        document.getElementById('live_search_result').innerHTML = html;

                        setClickEventToLiveSearchItems();
                    }
                }
            } else {
                document.getElementById('live_search_result').innerHTML = '';
            }
        }

        $('.table_view_button').on("click", function (e) {
            e.stopPropagation();
        });

        $('a[name=appUrl]').on("click", function (e) {
            //alert("awdawdawdaw");

        });

        $('.cellcolor').on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            var serviceKey = $("#patientForm" + this.id + " [name='patientServiceKey']").val();
            notiUpdate(serviceKey, 0);
            //if (e.target !== e.currentTarget) return;
            // window.open(
            //     "patientprofile.php",
            //     'patientPopup',
            //     'height=' + screen.height + ',width=' + screen.width + ',fullscreen=yes'
            // );
            var form = document.getElementById("patientForm" + this.id);
            //alert(form.)
            form.action = "/views/patientprofile.php";
            // form.action = "patientprofile.php";
            form.method = "post";
            // form.target = "patientPopup";
            form.submit();
        });


    });


    window.onload = function () {

        function onClick() {
            document.querySelector('.modal_calendar').style.display = 'block';

        }

        function offClick() {
            document.querySelector('.modal_calendar').style.display = 'none';

        }

        document.getElementById('modal_btn').addEventListener('click', onClick);
        document.querySelector('.calendar_close').addEventListener('click', offClick);

    };
</script>


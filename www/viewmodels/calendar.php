
		<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/> -->
		<link rel="stylesheet" href="../resource/css/calendar.css"/>
		

		<style>	
			.clearfix{margin-top:20px;}
			.calendar_from {position:relative;width:49%;float:left}
			.calendar_to {position:relative;width:49%;float:right}
			.clearfix p {position:absolute;font-size:18px;top:50%;transform:translateY(-50%);left:20px}

			/* Search */
			.searchBox{width:604px;margin:0 auto;overflow:hidden;border:2px solid #d2d2d2;}
			.calendar_title {background-color:#08a2e8;text-align:center;color:#fff;padding:10px 0}
			.claendar_content {padding:20px 20px 0px 20px;text-align:center;overflow:hidden; height: 370px; background-color: white;}
			.calendar_select {}
			.searchDate{overflow:hidden;display:inline-block}
			.searchDate li{position:relative;float:left;margin:0 10px 0 0}
			.searchDate li .chkbox2{display:block;text-align:center}
			.searchDate li .chkbox2 input{position:absolute;z-index:-1}
			.searchDate li .chkbox2 label{display:block;width:132px;height:50px;font-size:18px;color:#fff;text-align:center;line-height:50px;text-decoration:none;cursor:pointer;background:#4b4b4b;border-radius:5px}
			.searchDate li .chkbox2 label{display:block;width:132px;height:50px;font-size:18px;color:#fff;text-align:center;line-height:50px;text-decoration:none;cursor:pointer;background:#4b4b4b;border-radius:5px;
							transition: all 0.9s, color 0.3s;
							cursor: pointer;
							display: inline-block;
							vertical-align: middle;}
			.searchDate li .chkbox2.on label{background:#07A2E8}		
			.demi{display:inline-block;margin:0 1px;vertical-align:middle}
			.inpType{height:50px;line-height:50px;border:1px solid #dbdbdb;width:100%;text-align:right}
			.btncalendar{display:inline-block;width:22px;height:22px;background:url(images/btn_calendar.gif) center center no-repeat;text-indent:-999em}
			.calendar_button {float:right;margin-top:80px}
			.calendar_ok {font-size:18px;width:190px;padding:11px 0;border:none;background-color:#08a2e8;color:#fff;float:left;border-radius:5px;margin-right:10px;  text-align: center;
							transition: all 0.9s, color 0.3s;
							cursor: pointer;
							display: inline-block;
							vertical-align: middle;}
			.calendar_close {font-size:18px;width:190px;padding:11px 0;border:none;background-color:#4c4c4c;color:#fff;float:left;border-radius:5px; text-align: center;
							transition: all 0.9s, color 0.3s;
							cursor: pointer;
							display: inline-block;
							vertical-align: middle;}}
			#ui-datepicker-div {width:273px}
		</style>

		<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
		<script type="text/javascript" src="../resource/js/calendar.js"></script>
		<!-- datepicker ???????????? -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/datepicker-ko.js"></script> -->
	
		<script>				

		$(document).ready(function() {

			//datepicker ???????????? ???????????? ?????? ????????????
			//$.datepicker.setDefaults($.datepicker.regional['ko']); 	
            setSearchDate('1m');

			// Datepicker			
			$(".datepicker").datepicker({
                
				showButtonPanel: true,
				dateFormat: "yy-mm-dd",
				onClose : function ( selectedDate ) {
				
					var eleId = $(this).attr("id");
					var optionName = "";

					if(eleId.indexOf("StartDate") > 0) {
						eleId = eleId.replace("StartDate", "EndDate");
						optionName = "minDate";
					} else {
						eleId = eleId.replace("EndDate", "StartDate");
						optionName = "maxDate";
					}

					$("#"+eleId).datepicker( "option", optionName, selectedDate );		
					$(".searchDate").find(".chkbox2").removeClass("on"); 
				}
			});

            // ???????????? ????????? ?????? ?????? ???????????? ???????????? ????????????
            $("#searchStartDate").datepicker( "option", "maxDate", new Date());

			//?????????.
			/*$('#searchStartDate').datepicker("option","onClose", function( selectedDate ) {	
				// ????????? datepicker??? ?????????
				// ???????????? ?????????????????? ?????? ??????(minDate)??? ????????? ???????????? ??????
				$("#searchEndDate").datepicker( "option", "minDate", selectedDate );
				$(".searchDate").find(".chkbox2").removeClass("on");
			});
			*/

			//?????????.
			/*$('#searchEndDate').datepicker("option","onClose", function( selectedDate ) {	
				// ????????? datepicker??? ?????????
				// ???????????? ?????????????????? ?????? ??????(maxDate)??? ????????? ???????????? ?????? 
				$("#searchStartDate").datepicker( "option", "maxDate", selectedDate );
				$(".searchDate").find(".chkbox2").removeClass("on");
			});
			*/

			$(".dateclick").dateclick();	// DateClick
			$(".searchDate").schDate();		// searchDate
			
		});

		// Search Date
		jQuery.fn.schDate = function(){
			var $obj = $(this);
			var $chk = $obj.find("input[type=radio]");
			$chk.click(function(){				
				$('input:not(:checked)').parent(".chkbox2").removeClass("on");
				$('input:checked').parent(".chkbox2").addClass("on");					
			});
		};

		// DateClick
		jQuery.fn.dateclick = function(){
			var $obj = $(this);
			$obj.click(function(){
				$(this).parent().find("input").focus();
			});
		}	

		
		function setSearchDate(start){

			var num = start.substring(0,1);
			var str = start.substring(1,2);

			var today = new Date();

			//var year = today.getFullYear();
			//var month = today.getMonth() + 1;
			//var day = today.getDate();
			
			var endDate = $.datepicker.formatDate('yy-mm-dd', today);
			$('#searchEndDate').val(endDate);
			
			if(str == 'd'){
				today.setDate(today.getDate() - num);
			}else if (str == 'w'){
				today.setDate(today.getDate() - (num*7));
			}else if (str == 'm'){
				today.setMonth(today.getMonth() - num);
				today.setDate(today.getDate() + 1);
			}

			var startDate = $.datepicker.formatDate('yy-mm-dd', today);
			$('#searchStartDate').val(startDate);
					
			// ???????????? ????????? ?????? ?????? ???????????? ???????????? ????????????
			$("#searchEndDate").datepicker( "option", "minDate", startDate );

		}

        function dateNullCheck(){
			if ($('#searchStartDate').val() == ""&& $('#searchEndDate').val() == "") {
				location.reload();
			}else if($('#searchEndDate').val() == "" && $('#searchStartDate').val() != ""){
				$('#searchEndDate').val("9999-12-31");
			}else if($('#searchStartDate').val() == "" && $('#searchEndDate').val() != ""){
				$('#searchStartDate').val("1900-01-01");
			}else{
				location.reload();
				document.querySelector('.modal_calendar').style.display ='none';
			}

        }
			
		</script>

		<!-- search -->
			<div class="searchBox">
				<div class="calendar_title">
					<h2>Calendar</h2>
				</div>
				<div class="claendar_content">
					<div class="calendar_select"> 
						<ul class="searchDate">
							<li>
								<span class="chkbox2 on">
									<input type="radio" name="dateType" id="dateType5" onclick="setSearchDate('1m')"/>
									<label for="dateType5">1 Month</label>
								</span>
							</li>
							<li>
								<span class="chkbox2">
									<input type="radio" name="dateType" id="dateType6" onclick="setSearchDate('2m')"/>
									<label class="hover130" for="dateType6">2 Month</label>
								</span>
							</li>
							<li>
								<span class="chkbox2">
									<input type="radio" name="dateType" id="dateType7" onclick="setSearchDate('3m')"/>
									<label class="hover130" for="dateType7">3 Month</label>
								</span>
							</li>
							<li style="margin:0">
								<span class="chkbox2">
									<input type="radio" name="dateType" id="dateType8" onclick="setSearchDate('6m')"/>
									<label class="hover130" for="dateType8">6 Month</label>
								</span>
							</li>
						</ul>
					</div>
                    <form onsubmit="dateNullCheck();">				
                    	<div class="clearfix">
						<!-- ????????? -->
						<div class="calendar_from">
							<input type="text" class="datepicker inpType" name="fdate" id="searchStartDate" style="padding-right:20px;">
							<p style="position:absolute">From</p>
						</div>
						<!-- ????????? -->
						<div class="calendar_to">
							<input type="text" class="datepicker inpType" name="tdate" id="searchEndDate" style="padding-right:20px;">
							<p style="position:absolute">To</p>
						</div>
				    	</div>
					<div class="patient_warning" style="padding-top:50px; width:358px;">
						<p class="patient_warning_icon"></p>
						<p class="patient_warning_text">For manual input, type in YYYY-MM-DD format.</p>
					</div>
					<div class="calendar_button">
						<input type="submit" value="OK" class="calendar_ok hover190">
						<a href="#" class="calendar_close hover190">Close</a>
					</div>
                    </form>

				</div>
			</div></div>
	
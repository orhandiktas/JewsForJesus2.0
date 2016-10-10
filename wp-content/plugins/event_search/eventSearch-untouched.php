<?php


//yokida 5/31/2016 sample code to make an API call to BBEC
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(isset($_POST))
	{


		require_once("infinity.php");

	$depTypeDefaultText = $_POST["DepType"];//"All programs";
	$keywords = $_POST["keywords"];
	$speakerDefaultText = $_POST["SpeakerName"];
	//$speakerDefaultText = "Aaron Abramson";
	$countryDefaultText = $_POST["country"];
	$stateDefaultText = "All states";
	$cityDefaultText = "All cities";
	$defaultStartDate = $_POST["startDate"];
	$defaultEndDate = $_POST["endDate"];
	$defaultRadius = $_POST["radius"];
	$defaultPostCode = $_POST["postCode"];

	$filterCount = 0;
	$filterValues=array();

	$filterValues[$filterCount] = getStringFilter('KEYWORDS', $keywords);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('DEPUTATIONTYPE', $depTypeDefaultText);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('HOSTNAME', "");
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('SPEAKERLOOKUPID', "");
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('SPEAKERNAME', $speakerDefaultText);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('MEETINGCITY', $cityDefaultText);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('MEETINGCOUNTRY', $countryDefaultText);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('MEETINGSTATE', $stateDefaultText);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('MEETINGPOSTCODE', $defaultPostCode);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('SDATE', $defaultStartDate);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('EDATE', $defaultEndDate);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('RADIUS', $defaultRadius);
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('PAGEINDEX', "1");
	$filterCount++;
	$filterValues[$filterCount] = getStringFilter('GLOBALCHANGENAME', "");

	//var_dump($filterValues);
	//echo "<br> hello world <br>";

	$soapClient = new infinitySOAP();

	$searchResult = getDataListValues($soapClient, '0ab9f302-557e-4f32-bef1-fa7c692fe36a', $filterValues);

	echo json_encode($searchResult);

}

}

else{

	?>


	<!doctype html>
	<html lang="us">
	<head>
		<meta charset="utf-8">
		<title>Danny for Jesus Events</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.1.1/fullcalendar.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.1.1/fullcalendar.js"></script>
		<script type="text/javascript">

			$( document ).ready(function() {
				$("#calendar").hide();
			});
			
			var deputationType = "";
			var speakerName = "";
			var keywords = "";
			var startDate = "";
			var endDate = "";
			var country = "All countries";
			var radius = "25";
			var postCode = "";
			
			var _events = [];
			
			function Search() {
				$.ajax({
					type: "POST",
					url: "http://dev01.jewsforjesus.org/wp-content/plugins/event_search/eventSearch.php",
					dataType: 'json',
					data: 	{
						DepType : deputationType,
						SpeakerName : speakerName,
						keywords : keywords,
						startDate: startDate,
						endDate: endDate,
						country: country,
						radius: radius,
						postCode: postCode
					},
					success: function (data) {
                    //display search result on a div or any html control.
						$("#resultDisplay").empty();
						$("#resultDisplay").append("Search result: </br>");

						$.each(data, function (index) {
							/*console.log("{ title: " + data[index].Values.v[3] + ", start: " + getJsonMeetingTimes(data[index].Values.v[19])[0] + ", end: " + getJsonMeetingTimes(data[index].Values.v[19])[1] + ", allDay: false },");*/
							var meetingTimes = "";
							
							getMeetingTimes(data[index].Values.v[19], data[index].Values.v[3]);
							
							meetingLocation = data[index].Values.v[12] + data[index].Values.v[13] + data[index].Values.v[14] + data[index].Values.v[16];
							$("#resultDisplay").append(data[index].Values.v[3] + "<br>" + data[index].Values.v[9] + "<br>" + meetingTimes + "<a href=\"" + data[index].Values.v[7] + "\">" + data[index].Values.v[6] + "</a><br>" + data[index].Values.v[12] + "<br>" + " " + data[index].Values.v[13] + ", " + data[index].Values.v[14] + " " + data[index].Values.v[16] + "<br>" + data[index].Values.v[18] + "<br>" + "<a href=\"http://maps.google.com/maps?q= " + meetingLocation + "\">Maps/Directions</a>" + "<br><br>");
						});

						console.log(_events);
						makeCalendar();
					},
					error: function (xhr, status, error) {
						var err = eval("(" + xhr.responseText + ")");
						alert("ERROR: " + err.Message);

					}
				});
			}

			function shortcodeSearch(searchType, resource_name) {

				var eventArray = [];
				$.ajax({
					type: "POST",
					url: "http://dev01.jewsforjesus.org/wp-content/plugins/event_search/eventSearch.php",
					dataType: 'json',
					data: 	{
						DepType : deputationType,
						SpeakerName : speakerName,
						keywords : keywords,
						startDate: startDate,
						endDate: endDate,
						country: country,
						radius: radius,
						postCode: postCode
					},
					success: function (data) {
						var eventArray = [];

						$.each(data, function (index) {
							var meetingTimes = "";
							
							getMeetingTimes(data[index].Values.v[19], data[index].Values.v[3]);
							
							meetingLocation = data[index].Values.v[12] + data[index].Values.v[13] + data[index].Values.v[14] + data[index].Values.v[16];
							eventArray.push([data[index].Values.v[3], data[index].Values.v[9], meetingTimes, data[index].Values.v[7], data[index].Values.v[6], data[index].Values.v[12], data[index].Values.v[13], data[index].Values.v[14], data[index].Values.v[16], data[index].Values.v[18], meetingLocation]);
						});
					},
					error: function (xhr, status, error) {
						var err = eval("(" + xhr.responseText + ")");
						alert("ERROR: " + err.Message);

					}
				});
				return eventArray;
			}

			function prePopulateDropdowns() {

				var deputationType = "All programs";
				var speakerName = "All speakers";
				var country = "All countries";
				var radius = "25";
				var postCode = "";

				$.ajax({
					type: "POST",
					url: "http://dev01.jewsforjesus.org/wp-content/plugins/event_search/eventSearch.php",
					dataType: 'json',
					data: 	{
						DepType : deputationType,
						SpeakerName : speakerName,
						country : country,
						radius: radius,
						postCode: postCode
					},
					success: function (data) {
                	//This is where the actual names and programs get put into the dropdown menus.
						fillSpeakers(data[0].Values.v[27]);
						fillPrograms(data[0].Values.v[28]);
					},
					error: function (xhr, status, error) {
						var err = eval("(" + xhr.responseText + ")");
						alert("ERROR: " + err.Message);

					}
				});
			}
			
			function getMeetingTimes(mt, meetingTitle){

				$(mt).find("MEETINGTIME").each(function (index) {
					var dtStr = $(this).find('STARTTIME').text();
					var dtArr = [];
					dtArr = convertToDateTime(dtStr);
					
					_events.push({
						title: meetingTitle,
                		start: new Date(parseInt(dtArr[0]), parseInt(dtArr[1])-1, parseInt(dtArr[2]), parseInt(dtArr[3]), parseInt(dtArr[4]), 0, 0) //year, month, day, hours, minutes, seconds, milliseconds
                    });

				});
				
				
				//console.log(_events);

			}


			function convertToDateTime(meetimgTime){

				var dt = meetimgTime.substring(0, meetimgTime.indexOf('T'));
				dt = dt.split('-');

				var tm = meetimgTime.substring(meetimgTime.indexOf('T')+1, meetimgTime.length);
				tm = tm.split(':');

				var dtArr = [dt[0], dt[1], dt[2], tm[0], tm[1], tm[2]];

				return dtArr;
			}

			function getJsonMeetingTimes(meetingTimes) {

				var beginTime = "";
				var finishTime = "";
				$(meetingTimes).find("MEETINGTIME").each(function (index) {
					var startMonth = $(this).find('STARTTIME').text().slice(5, 7);
					var startDay = $(this).find('STARTTIME').text().slice(8, 10);
					var startYear = $(this).find('STARTTIME').text().slice(0, 4);
					var startTime = $(this).find('STARTTIME').text().slice(11, 16);
					var endMonth = $(this).find('ENDTIME').text().slice(5, 7);
					var endDay = $(this).find('ENDTIME').text().slice(8, 10);
					var endYear = $(this).find('ENDTIME').text().slice(0, 4);
					var endTime = $(this).find('ENDTIME').text().slice(11, 16);
					beginTime = new Date(startYear, startMonth, startDay, startTime[0,1], startTime[3,4]);
					finishTime = new Date(endYear, endMonth, endDay, endTime[0,1], endTime[3,4]);
				});

				return [beginTime, finishTime];
			}

			function getAmPm(time) {
				if(Number(time.slice(0, 2)) > 12 ) {
					return (Number(time.slice(0, 2)) - 12).toString() + time.slice(2, 5) + " PM";
				} else {
					if (time[0] === "0") {
						return time.slice(1, 5) + " AM"; 
					} else {
						return time + " AM";
					}
				}
			}
			
			function fillPrograms(program) {
				
				$(program).find("VALUE").each(function (index) {
					var programName = $(this).text();
					var optionText = $('<option></option>').val(programName).html(programName);
					$("#ddlPrograms").append(optionText);
					
				});
				
			}

			function fillSpeakers(program) {
				
				$(program).find("VALUE").each(function (index) {
					var programName = $(this).text();
					var optionText = $('<option></option>').val(programName).html(programName);
					$("#mishDdlPrograms").append(optionText);
					
				});
				
			}

			function makeCalendar() {

				$('#calendar').fullCalendar({
					    defaultView: 'month', //Possible Values: month, basicWeek, basicDay, agendaWeek, agendaDay
					    header: { 
					    	left:   'title',
					    	center: '',
					      right:  'today prevYear,prev,next,nextYear', //Possible Values: month, basicWeek, basicDay, agendaWeek, agendaDay, today prevYear,prev,next,nextYear
					  },
					  buttonIcons :{
					  	prev: 'left-single-arrow',
					  	next: 'right-single-arrow',
					  	prevYear: 'left-double-arrow',
					  	nextYear: 'right-double-arrow'
					  },
					  editable: true,
					  weekMode: 'liquid',
					  url: '#',
					  events: _events
					});
			}

			$(document).ready(function () {

				prePopulateDropdowns();

				$('#btnSearch, #mishBtnSearch, #keywordsBtnSearch, #dateBtnSearch, #countryBtnSearch, #radiusBtnSearch').click(function(){ 
					deputationType = $("#ddlPrograms").val();
					speakerName = $("#mishDdlPrograms").val();
					keywords = $("#keywordsDdlPrograms").val();
					startDate = $("#startDdlPrograms").val();
					endDate = $("#endDdlPrograms").val();
					country = $("#countryDdlPrograms").val();
					radius = $("#radiusDdlPrograms").val();
					postCode = $("#postCodeDdlPrograms").val();
					
					Search();	
				});

				//makeCalendar();
				
			});
			
			function makeSearchFriendly(inputParams) {
				return inputParams.replace("+"," ");
			}

		</script>

	</head>

	<body>
		<div id="calendar"></div>
		<div id="resultDisplay"></div>
		<?php
		if(!empty($_GET['showcalendar']) && $_GET['showcalendar'] == 'true' ) {
			echo '<script type="text/javascript">
			$( document ).ready(function() {
				$("#calendar").show();
			});
			</script>';
		}
		if(!empty($_GET['speakername'])) {
			echo '<script type="text/javascript">
				speakerName = makeSearchFriendly("' . $_GET["speakername"] . '");
				deputationType = "All programs";
				keywords = "";
				startDate = "";
				endDate = "";
				country = "All countries";
				radius = "25";
				postCode = "";
				Search();
			      </script>';
		}
		if(!empty($_GET['postcode'])) {
			echo '<script type="text/javascript">
				speakerName = "All speakers";
				deputationType = "All programs";
				keywords = "";
				startDate = "";
				endDate = "";
				country = "All countries";
				radius = "25";
				postCode = makeSearchFriendly("' . $_GET["postcode"]. '");
				Search();
			      </script>';
		}  
		if(!empty($_GET['country'])) {
			echo '<script type="text/javascript">
				speakerName = "All speakers";
				deputationType = "All programs";
				keywords = "";
				startDate = "";
				endDate = "";
				country = makeSearchFriendly("' . $_GET["country"]. '");
				radius = "25";
				postCode = "";
				Search();
			      </script>';
		}
		if(!empty($_GET['program'])) {
			echo '<script type="text/javascript">
				speakerName = "All speakers";
				deputationType = makeSearchFriendly("' . $_GET["program"]. '");
				keywords = "";
				startDate = "";
				endDate = "";
				country = "All countries";
				radius = "25";
				postCode = "";
				Search();
			      </script>';
		}
		?>

	</br>
	
	<form id="frmEventSearch" action="" method="post">
		
		<select id="ddlPrograms" style="width: 220px;">
			<option value="All programs">All programs</option>
			
			<input id="btnSearch" type="button" class="btn btn-success" value="Program Search" />
			
		</form>
		<form id="countryEventSearch" action="" method="post">

			<select id="countryDdlPrograms" style="width: 220px;">
				<option value="All countries">All countries</option>
				<option value="United States">United States</option>
				<option value="Canada">Canada</option>
				<option value="United Kingdom">United Kingdom</option>
				<option value="Mexico">Mexico</option>
				<option value="Ireland">Ireland</option>

				<input id="countryBtnSearch" type="button" class="btn btn-success" value="Country Search" />

			</form>
			<form id="mishFrmEventSearch" action="" method="post">

				<select id="mishDdlPrograms" style="width: 220px;">
					<option value="All speakers">All speakers</option>

					<input id="mishBtnSearch" type="button" class="btn btn-success" value="Speaker Search" />

				</form>
				<form id="keywordsFrmEventSearch" action="" method="post">

					<input type="text" id="keywordsDdlPrograms" style="width: 220px;">

					<input id="keywordsBtnSearch" type="button" class="btn btn-success" value="Keyword Search" />

				</form>
				<form id="dateEventSearch" action="" method="post">

					<label for="startDdlPrograms">Start Date MM/DD/YYYY</label>
					<input type="text" id="startDdlPrograms" style="width: 110px;">
					<br>
					<label for="endDdlPrograms">End Date MM/DD/YYYY</label>
					<input type="text" id="endDdlPrograms" style="width: 110px;">

					<input id="dateBtnSearch" type="button" class="btn btn-success" value="Date Search" />

				</form>
				<form id="radiusEventSearch" action="" method="post">

					<label for="radiusDdlPrograms">Radius</label>
					<input type="text" value="25" id="radiusDdlPrograms" style="width: 110px;">
					<br>
					<label for="postCodeDdlPrograms">Post Code</label>
					<input type="text" id="postCodeDdlPrograms" style="width: 110px;">

					<input id="radiusBtnSearch" type="button" class="btn btn-success" value="Postcode Search" />

				</form>

			</body>

			</html>
			<?php }?>
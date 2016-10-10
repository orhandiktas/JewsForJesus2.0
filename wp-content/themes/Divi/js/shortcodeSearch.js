			
function shortcodeSearch(searchType, resource_name, distance = '25') {
	var deputationType = "All programs";
	var speakerName = "All speakers";
	var keywords = "";
	var startDate = "";
	var venue = "";
	var endDate = "";
	var country = "All countries";
	var radius = "25";
	var postCode = "";

	var _events = [];
	var eventArray = [];
				if(searchType == "speaker") {
					speakerName = resource_name;
				} else if (searchType == "venue") {
					venue = resource_name;
				} else if (searchType == "region") {
					postCode = resource_name;
				} else if (searchType == "country") {
					country = resource_name;
				}
				return $.ajax({
					type: "POST",
					url: "http://dev01.jewsforjesus.org/wp-content/plugins/event_search/apiCall.php",
					dataType: 'json',
					data: 	{
						DepType : deputationType,
						speakerName : speakerName,
						keywords : keywords,
						startDate: startDate,
						endDate: endDate,
						country: country,
						radius: radius,
						postCode: postCode,
						venue: venue
					},
					success: function (data) {
						$.each(data, function (index) {
							var meetingTimes = [];
							
							meetingTimes.push(getMeetingTimes(data[index].Values.v[19], data[index].Values.v[3]));

							meetingLocation = data[index].Values.v[12] + " " + data[index].Values.v[13] + " " + data[index].Values.v[14] + " " + data[index].Values.v[16];

							var columnArray = [];
							columnArray.push(data[index].Values.v[3]);
							columnArray.push(data[index].Values.v[9]);
							columnArray.push(meetingTimes);
							columnArray.push(data[index].Values.v[7]);
							columnArray.push(data[index].Values.v[6]);
							columnArray.push(data[index].Values.v[12]);
							columnArray.push(data[index].Values.v[13]);
							columnArray.push(data[index].Values.v[14]);
							columnArray.push(data[index].Values.v[16]);
							columnArray.push(data[index].Values.v[18]);
							columnArray.push(meetingLocation);
							
							eventArray.push(columnArray);
							
							console.log(columnArray[2 ]);
							//console.log("eventArray.length:" + eventArray.length);
							//console.log("eventArray[0][1]:" + eventArray[0][1]);
							//console.log("eventArray[0][2][0]:" + eventArray[0][2][0]);
						});
						
						//console.log(eventArray[0][0]);
						
					},
					error: function (xhr, status, error) {
						//var err = eval("(" + xhr.responseText + ")");
						//alert("ERROR: " + err.Message);
						

					}
				});

			}
			
			

			
			function getMeetingTimes(mt, meetingTitle){
				var meetTimes = [];
				$(mt).find("MEETINGTIME").each(function (index) {
					var dtStr = $(this).find('STARTTIME').text();
					var dtArr = [];
					dtArr = convertToDateTime(dtStr);
					
					meetTimes.push(new Date(parseInt(dtArr[0]), parseInt(dtArr[1])-1, parseInt(dtArr[2]), parseInt(dtArr[3]), parseInt(dtArr[4]), 0, 0)); //year, month, day, hours, minutes, seconds, milliseconds
				});
				return meetTimes;
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
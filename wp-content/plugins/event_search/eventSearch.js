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
			postCode: postCode,
			category: category,
		},
		success: function (data) {
                    //display search result on a div or any html control.
                    $("#resultDisplay").empty();

                    $.each(data, function (index) {
                    	// console.log(data);
                		var bio = "";
                		var eventName = "";
                    	var meetingTimes = "";
                    	var wordpressName = getWordPressName(data[index].Values.v[8]);
                    	var meetingLocation = data[index].Values.v[12] + " " + data[index].Values.v[13] + " " + data[index].Values.v[14] + " " + data[index].Values.v[16];
                    	getMeetingTimes(data[index].Values.v[19], data[index].Values.v[3]);
                    	
                    	// Image url
                    	if(data[index].Values.v[32] == "EVENT") {
                    		var imageUrl = "<img src=\"http://dev01.jewsforjesus.org/wp-content/uploads/2016/08/jstarj-logo.png\"";
                    	} else { 
                    		// this is the deputation and needs the person's face
                			var splitName = data[index].Values.v[9].split(" ");
							var first = splitName[0].toLowerCase();
							var last = splitName[splitName.length - 1].toLowerCase();
                    		var imageUrl = "<img style=\"width: 90px !important;height: 90px !important;margin: 10px;border-radius: 50%;background-repeat: no-repeat;background-position: center;background-size: cover;top: 2em;\" src=\"http://dev01.jewsforjesus.org/wp-content/uploads/" + first  + "-" + last + ".jpg\"";
                    	}

                    	// Event type
                    	if(data[index].Values.v[32] == "EVENT") {
                    		var eventType = "Jews for Jesus Event";
                    	} else {
                    		var eventType = "Meeting";
                    	}

                    	// BBEC Name Check

                    	// Name
                    	if(data[index].Values.v[32] == "EVENT") {
                    		var name = "<span style=\"color: #337AB7\">" + data[index].Values.v[9] + "<span>";
                    	} else {
                    		var name = "<span style=\"color: #337AB7\" class=\"" + data[index].Values.v[0] + "\">" + data[index].Values.v[9] + "</span>";

                    	}

                    	// Meeting location
                		if(meetingLocation == "   ") {
                			meetingLocation = "";
                		} else {
                			meetingLocation =  "<br>" + data[index].Values.v[12] + "<br>" + " " + data[index].Values.v[13] + ", " + data[index].Values.v[14] + " " + data[index].Values.v[16] + "<br>" + "<a target=\"_blank\"  href=\"http://maps.google.com/maps?q= " + meetingLocation + "\">Maps/Directions</a>" + "<br>";
                		}

                		// Meeting location name
                		var meetingLocationName = "<a target=\"_blank\"  href=\"" + data[index].Values.v[7] + "\">" + data[index].Values.v[6] + "</a>";

                		//Event description
                		if((data[index].Values.v[3] == "Christ in the Passover") || (data[index].Values.v[3] == "Christ in the Feast of Tabernacles") || (data[index].Values.v[3] == "Hanukkah Message") || (data[index].Values.v[3] == "Gospel in the Feasts of Israel") || (data[index].Values.v[3] == "How to Witness") || (data[index].Values.v[3] == "The Jewish Roots of Pentacost") || (data[index].Values.v[3] == "Jesus in the Old Testament") || (data[index].Values.v[3] == "Multitides")) {
                			eventName = getEventDescription(data[index].Values.v[3], data[index].Values.v[0]);
                		} else {
                			eventName = data[index].Values.v[3];
                		}

                    	// Bio
                    	if(data[index].Values.v[32] == "EVENT") {
                    		$("#resultDisplay").append(imageUrl + "<br>" + "<br>" + eventType + "<br>" + eventName + "<br>" + name + "<br>" + bio + meetingTimes + meetingLocationName + meetingLocation);
	                    	appendTimes();
                    	} else {
                    		$.get('http://dev01.jewsforjesus.org/wp-content/plugins/event_search/PersonCard.php?firstname=' + first + '&lastname=' + last + ' #bio', {}, function (successdata) {
								var bioText = $(successdata).find('#bio').html();
	                    		bio = "<span style=\"display:none;\" class=\"" + data[index].Values.v[0] + "bio\"><br>" + bioText + "</span><br>";
	                    		$("#resultDisplay").append(imageUrl + "<br>" + "<br>" + eventType + "<br>" + eventName + "<br>" + name + bio + meetingTimes + meetingLocationName + meetingLocation);
	                    		$('.' + data[index].Values.v[0]).click(function() {
									$("." + data[index].Values.v[0] + "bio").toggle();
								});
								$('.' + data[index].Values.v[0] + 'name').click(function() {
									$("." + data[index].Values.v[0] + "description").toggle();
								})
		                    	appendTimes();
							});
                    	}
                    	// data[index].Values.v[32] is the event type
                    	// data[index].Values.v[3] is the event name
                    	// data[index].Values.v[8] is the bbec id
                    	// data[index].Values.v[9] is the speaker name
                    });
                    // makeCalendar();
                },
                error: function (xhr, status, error) {
                	var err = eval("(" + xhr.responseText + ")");
                	alert("ERROR: " + err.Message);

                }
            });
}

function appendTimes() {
	for (var i=0; i<_events.length; i++) {
		$("#resultDisplay").append(getAmPm(_events[i]['start'].toString()) + "<br><br>");
	}
}

function getMeetingTimes(mt, meetingTitle){

	$(mt).find("MEETINGTIME").each(function (index) {
		var dtStr = $(this).find('STARTTIME').text();
		var dtArr = [];
		dtArr = convertToDateTime(dtStr);
		_events = [];
		_events.push({
			title: meetingTitle,
                		start: new Date(parseInt(dtArr[0]), parseInt(dtArr[1])-1, parseInt(dtArr[2]), parseInt(dtArr[3]), parseInt(dtArr[4]), 0, 0) //year, month, day, hours, minutes, seconds, milliseconds
                	});

	});

}

function convertToDateTime(meetingTime){
	var dt = meetingTime.substring(0, meetingTime.indexOf('T'));
	dt = dt.split('-');

	var tm = meetingTime.substring(meetingTime.indexOf('T')+1, meetingTime.length);
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
	if(Number(time.slice(16,18)) > 12) {
		return time.slice(4,15) + " " + (Number(time.slice(16, 18)) - 12).toString() + time.slice(18,21) + " PM";
	} else {
		if ((Number(time[16]) === 0) && (Number(time[17]) === 0)) {
			return time.slice(4,15);
		} else if(Number(time[16]) === 0) {
			return time.slice(4,15) + " " + time.slice(17, 21) + " AM"; 
		} else {
			return time.slice(4,15) + " " + time.slice(16, 21) + " AM";
		}	
	}
}

function makeSearchFriendly(inputParams) {
	return inputParams.replace("+"," ");
}

function getWordPressName(bbecid) {
	var parsed = "";
	$.ajax({
        url: 'http://dev01.jewsforjesus.org/wp-content/plugins/event_search/PersonCard.php?bbecid=' + bbecid,
        success: function(data) {
        	parsed = $($.parseHTML(data)).filter("#name")['prevObject'][6]['innerText'];
			// console.log(parsed);
        },
    });
	return parsed;
}

function getEventDescription(eventName, eventId) {
	var description = "";
	if(eventName == "Christ in the Passovver") {
		description = "This sermonic demonstration uses visual aids to paint a picture of how Jesus fulfilled the Festival of Sukkot (also known as the Feast of Booths or Tabernacles). Our missionary will explain the traditional and Christological significance of this holiday. Jesus\' claims to be the Light of the World and the Living Water are brought into perspective as the meaning of this holiday unfolds.";
	} else if (eventName == "Christ in the Feast of Tabernacles") {
		description = "This sermonic demonstration uses visual aids to paint a picture of how Jesus fulfilled the Festival of Sukkot (also known as the Feast of Booths or Tabernacles). Our missionary will explain the traditional and Christological significance of this holiday. Jesus\' claims to be the Light of the World and the Living Water are brought into perspective as the meaning of this holiday unfolds.";
	} else if (eventName == "Hanukkah Message") {
		description = "Birthed out of the tumultuous Inter-Testamental Period, Hanukkah is a key celebration in the Jewish tradition. For many Christians, this near-Christmas, Jewish holiday carries a darkness of ignorance. Allow Jews for Jesus the opportunity to shed some light on the Festival of Lights. Discover the roots of Hanukkah, its current significance to the Jewish people, and what believers can learn from it today. More than a simple historical lesson, this message is also a call to purity and stresses the importance of \'letting your light shine before men\' (Matthew 5:16).";	
	} else if (eventName == "Gospel in the Feasts of Israel") {
		description = "The \'Gospel in the Feasts of Israel\' message focuses on the seven chief Old Testament holidays or feasts. Our missionaries explain the purpose of these celebrations both then and now. They then show how the coming of Jesus fulfilled those feasts and gave them a larger meaning. This is an excellent teaching on the relationship of the Old and New Testaments. It also reveals the opportunities for Jewish evangelism throughout the year.";	
	} else if (eventName == "How to Witness") {
		description = "We\'ve found that if you can witness to a Jewish person you can witness to just about anybody! By hosting a \'How to Witness\' program, your people can glean valuable tips on presenting the gospel to Jewish friends and \'not so Jewish\' friends alike. These seminars provide insight into various objections to the gospel as well as conversation techniques, understanding Jewish sensitivities and more. Seminars are usually set up for a Saturday morning or for adult Bible classes, and are often given as a series.";	
	} else if (eventName == "The Jewish Roots of Pentacost") {
		description = "Although part of the historical church calendar, most believers know little of the significance of Pentecost (also called the Feast of Weeks, or Shavuot). Allow Jews for Jesus to take your people through a Biblically based message on the historical importance of this Jewish celebration and its relevance to believers today. As the second of the three harvest feasts, Christians today will be strongly encouraged in this message focusing on the inclusion of both Jew and Gentile as part of God\'s people.";	
	} else if (eventName == "Jesus in the Old Testament") {
		description = "From Genesis to Malachi, explore how Jesus fulfilled Old Testament prophecy and look at what some of the first-century rabbis said about Messiah and his coming. More than an Old Testament lesson, the missionary will also share their first-hand experience of speaking about Messianic prophecy with Jewish people today. This message poses that if Jesus is the Messiah of the Old Testament, everyone should believe in Him including the Jewish people.";	
	} else if (eventName == "Multitudes") {
		description = "Multitudes presents a pictorial journey through the Messiah’s life and ministry featuring a collection of specially-commissioned paintings of scenes from the gospel of Matthew. Twenty-seven times in this most-Jewish of the gospels, we read of our Savior’s great compassion for the multitudes that followed Him, \"weary, scattered like sheep having no shepherd\" (Matthew 9:36). These were the multitudes that Jesus taught and healed, and for whom He would suffer and die. This sermonic presentation gives snapshots from Jesus\'s life and ministry, following His pilgrimage from Bethlehem to the empty tomb.";	
	}
	return "<span class=\"" + eventId + "name\" style=\"color:#337AB7;\">" + eventName + "</span><span style=\"display:none\" class=\"" + eventId + "description\"><br>" + description + "</span>";
}

$(document).ready(function () {

	prePopulateDropdowns();

	$("#calendar").hide();

	deputationType = $("#programs").val();
	speakerName = $("#mish").val();
	keywords = $("#keywords").val();
	startDate = $("#start").val();
	endDate = $("#end").val();
	country = $("#country").val();
	radius = $("#radius").val();
	postCode = $("#postCode").val();
	category = $("#category").val();
		
	Search();

	$('#search').click(function(){ 
		deputationType = $("#programs").val();
		speakerName = $("#mish").val();
		keywords = $("#keywords").val();
		startDate = $("#start").val();
		endDate = $("#end").val();
		country = $("#country").val();
		radius = $("#radius").val();
		postCode = $("#postCode").val();
		category = $("#category").val();
		
		Search();	
	});
	//makeCalendar();
	
});
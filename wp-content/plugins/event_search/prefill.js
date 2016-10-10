function prePopulateDropdowns() {

	var deputationType = "All programs";
	var speakerName = "All speakers";
	var country = "All countries";
	var radius = "25";
	var postCode = "";
	var category = "";

	$.ajax({
		type: "POST",
		url: "http://dev01.jewsforjesus.org/wp-content/plugins/event_search/eventSearch.php",
		dataType: 'json',
		data: 	{
			DepType : deputationType,
			SpeakerName : speakerName,
			country : country,
			radius: radius,
			postCode: postCode,
			category: category,
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

function fillPrograms(program) {
	
	$(program).find("VALUE").each(function (index) {
		var programName = $(this).text();
		var optionText = $('<option></option>').val(programName).html(programName);
		$("#programs").append(optionText);
		
	});
	
}

function fillSpeakers(program) {
	
	$(program).find("VALUE").each(function (index) {
		var programName = $(this).text();
		var optionText = $('<option></option>').val(programName).html(programName);
		$("#mish").append(optionText);
		
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
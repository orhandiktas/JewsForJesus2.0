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
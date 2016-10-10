<?php

echo '-----Loading Inifinity-----<br />';

require_once("infinity.php");

//get URL variables
$deputationID = $_GET['ref'];

$filterValues=array();

/*
CIFT - 505355 , 509880 , 509922
CIP - 501377 , 503044 , 501108
Jewish Evangelism Seminar - 509524 , 509167
Model Seder - 509417 , 509341 , 509081
Seder - 508720 , 507677 , 509331
BYG Message - 507935 , 508177
*/

$filterValues[0] = getStringFilter('LOOKUPID', $deputationID);

$soapClient = new infinitySOAP();

$result = getDeputationCompleteDetails($soapClient,'709bcd2f-09ba-4b95-b838-4ac01af60d9c', $filterValues); 

$deputationDetails = array($result[0]->Values->v);

echo $deputationDetails[0][2].'<br />';

$meetingTime = simplexml_load_string($deputationDetails[0][11]);

for($ctr = 0; $ctr < count($meetingTime->ITEM); $ctr++){
	echo date("l, F jS", strtotime($meetingTime->ITEM[$ctr]->STARTTIME))." at ".date("g:i A", strtotime($meetingTime->ITEM[$ctr]->STARTTIME));
	echo '<br />';
}

echo $deputationDetails[0][7].'<br />';
echo $deputationDetails[0][8].'<br />';
echo $deputationDetails[0][6].'<br />';

echo '-----Inifity Loaded-----<br/>';

//list all fields
foreach($result[0]->Values as $item)
{
	$ctr = count($item);
	for($x = 0; $x < $ctr; $x++){
		echo "<strong>".$x."</strong> - ".$item[$x]."<br />";
	}
}

//Dump variable information
/*var_dump($deputationDetails);*/
?>
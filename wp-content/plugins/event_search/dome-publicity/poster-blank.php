<?php
require('fpdf/WriteTag.php');
require_once("infinity.php");

//get URL variables
$deputationID = $_GET['ref'];
$colorOption = $_GET['opt'];

$filterValues=array();

$filterValues[0] = getStringFilter('LOOKUPID', $deputationID);

$soapClient = new infinitySOAP();

$result = getDeputationCompleteDetails($soapClient,'709bcd2f-09ba-4b95-b838-4ac01af60d9c', $filterValues); 

$deputationDetails = array($result[0]->Values->v);

$poster = array();
$poster = preparePoster($deputationDetails, $colorOption);

$pdf = new PDF_WriteTag('P','mm',$poster[pagesize]);
$pdf->SetStyle('nl', $poster[font], $poster[fontstyle], $poster[nlfontsize], '0,0,0', 0);
$pdf->SetStyle('sub', $poster[font], $poster[fontstyle], $poster[subfontsize], '0,0,0');
$pdf->SetStyle('fine', $poster[font], $poster[fontstyle], $poster[finefontsize], '0,0,0');
$pdf->AddPage();
$pdf->SetFont($poster[font], '', $poster[nlfontsize]);
$pdf->Image($poster[image],0,0,$poster[imagewidth], $poster[imageheight]);
$pdf->SetXY($poster[xaxis],$poster[yaxis]);
$pdf->WriteTag(0,$poster[lineheight],$poster[information],0,$poster[align],0,0);
/*if($poster[image] == 'images/poster-presents.jpg' || $poster[image] == 'images/bw-poster-presents.jpg'){
	$pdf->SetX(15);
	$pdf->MultiCell(185, 15, $deputationDetails[0][10], 0, 'C');
}*/
$pdf->Output('JFJ '.$deputationDetails[0][2].' Poster','I');

function preparePoster($deputation, $color){
	
	$posterDetails = array();
	
	switch($deputation[0][2]){
		case 'Christ in the Passover':
			$posterDetails['pagesize'] = 'Letter';
			if($color == 'color'){
				$posterDetails['image'] = 'images/poster-cip.jpg';
			}else{
				$posterDetails['image'] = 'images/bw-poster-cip.jpg';
			}
			$posterDetails['imagewidth'] = 215.9;
			$posterDetails['imageheight'] = 279.4;
			$posterDetails['xaxis'] = 13;
			$posterDetails['yaxis'] = 190;
			/*$posterDetails['information'] = '<nl>'.$deputation[0][5].'</nl><nl>'.getSchedule(simplexml_load_string($deputation[0][11])).'</nl><nl>'.preg_replace("/\r\n|\r|\n/","</nl><nl>",$deputation[0][7]).'</nl><nl>'.$deputation[0][8].'</nl><nl>'.$deputation[0][6].'</nl><nl><fine>Changes in itinerary may occur. Please call ahead for any schedule changes.</nl></fine>';
			$posterDetails['align'] = 'L';
			$posterDetails['fontstyle'] = 'N';
			$posterDetails['font'] = 'Arial';
			$posterDetails['nlfontsize'] = 20;
			$posterDetails['subfontsize'] = 16;
			$posterDetails['finefontsize'] = 8;
			$posterDetails['lineheight'] = 5;*/
			break;
		case 'Seder':
			$posterDetails['pagesize'] = 'Letter';
			if($color == 'color'){
				$posterDetails['image'] = 'images/poster-passover.jpg';
			}else{
				$posterDetails['image'] = 'images/bw-poster-passover.jpg';
			}
			$posterDetails['imagewidth'] = 215.9;
			$posterDetails['imageheight'] = 279.4;
			$posterDetails['xaxis'] = 15;
			$posterDetails['yaxis'] = 170;
			/*$posterDetails['information'] = '<nl>'.$deputation[0][2].'</nl><nl>Hosted by</nl><nl>'.$deputation[0][5].'</nl><nl>'.getSchedule(simplexml_load_string($deputation[0][11])).'</nl><nl>'.preg_replace("/\r\n|\r|\n/","</nl><nl>",$deputation[0][7]).'</nl><nl>'.$deputation[0][8].'</nl><nl>'.$deputation[0][6].'</nl><nl><fine>Changes in itinerary may occur. Please call ahead for any schedule changes.</nl></fine>';
			$posterDetails['align'] = 'L';
			$posterDetails['fontstyle'] = 'N';
			$posterDetails['font'] = 'Arial';
			$posterDetails['nlfontsize'] = 20;
			$posterDetails['subfontsize'] = 16;
			$posterDetails['finefontsize'] = 8;
			$posterDetails['lineheight'] = 5;*/
			break;
		case 'Model Seder':
			$posterDetails['pagesize'] = 'Letter';
			if($color == 'color'){
				$posterDetails['image'] = 'images/poster-passover.jpg';
			}else{
				$posterDetails['image'] = 'images/bw-poster-passover.jpg';
			}
			$posterDetails['imagewidth'] = 215.9;
			$posterDetails['imageheight'] = 279.4;
			$posterDetails['xaxis'] = 15;
			$posterDetails['yaxis'] = 170;
			/*$posterDetails['information'] = '<nl>'.$deputation[0][2].'</nl><nl>Hosted by</nl><nl>'.$deputation[0][5].'</nl><nl>'.getSchedule(simplexml_load_string($deputation[0][11])).'</nl><nl>'.preg_replace("/\r\n|\r|\n/","</nl><nl>",$deputation[0][7]).'</nl><nl>'.$deputation[0][8].'</nl><nl>'.$deputation[0][6].'</nl><nl><fine>Changes in itinerary may occur. Please call ahead for any schedule changes.</nl></fine>';
			$posterDetails['align'] = 'L';
			$posterDetails['fontstyle'] = 'N';
			$posterDetails['font'] = 'Arial';
			$posterDetails['nlfontsize'] = 20;
			$posterDetails['subfontsize'] = 16;
			$posterDetails['finefontsize'] = 8;
			$posterDetails['lineheight'] = 5;*/
			break;
		case 'Christ in the Feast of Tabernacles':
			$posterDetails['pagesize'] = 'Letter';
			if($color == 'color'){
				$posterDetails['image'] = 'images/poster-cift.jpg';
			}else{
				$posterDetails['image'] = 'images/bw-poster-cift.jpg';
			}
			$posterDetails['imagewidth'] = 215.9;
			$posterDetails['imageheight'] = 279.4;
			$posterDetails['xaxis'] = 15;
			$posterDetails['yaxis'] = 160;
			/*$posterDetails['information'] = '<nl><sub>With</sub> '.$deputation[0][15].'</nl><nl>'.getSchedule(simplexml_load_string($deputation[0][11])).'</nl><nl>'.$deputation[0][5].'</nl><nl>'.preg_replace("/\r\n|\r|\n/","</nl><nl>",$deputation[0][7]).'</nl><nl>'.$deputation[0][8].'</nl><nl>'.$deputation[0][6].'</nl><nl><fine>Changes in itinerary may occur. Please call ahead for any schedule changes.</nl></fine>';
			$posterDetails['align'] = 'C';
			$posterDetails['fontstyle'] = 'B';
			$posterDetails['font'] = 'Times';
			$posterDetails['nlfontsize'] = 24;
			$posterDetails['subfontsize'] = 16;
			$posterDetails['finefontsize'] = 8;
			$posterDetails['lineheight'] = 7;*/
			break;
		default:
			$posterDetails['pagesize'] = 'Letter';
			if($color == 'color'){
				$posterDetails['image'] = 'images/poster-presents.jpg';
			}else{
				$posterDetails['image'] = 'images/bw-poster-presents.jpg';
			}
			$posterDetails['imagewidth'] = 215.9;
			$posterDetails['imageheight'] = 279.4;
			$posterDetails['xaxis'] = 15;
			$posterDetails['yaxis'] = 75;
			/*$posterDetails['information'] = '<nl>'.$deputation[0][2].'</nl><nl><sub>with</sub></nl><nl>'.$deputation[0][15].'</nl><nl>'.getSchedule(simplexml_load_string($deputation[0][11])).'</nl><nl>'.$deputation[0][5].'</nl><nl>'.preg_replace("/\r\n|\r|\n/","</nl><nl>",$deputation[0][7]).'</nl><nl>'.$deputation[0][8].'</nl><nl>'.$deputation[0][6].'</nl>';
			$posterDetails['align'] = 'C';
			$posterDetails['fontstyle'] = '';
			$posterDetails['font'] = 'Arial';
			$posterDetails['nlfontsize'] = 28;
			$posterDetails['subfontsize'] = 20;
			$posterDetails['finefontsize'] = 8;
			$posterDetails['lineheight'] = 10;*/
			break;
	}
	
	return $posterDetails;
	
}

/*function getSchedule($meetingTime){
	
	$deputationSchedule = '';	
	
	if(count($meetingTime->ITEM) > 1){
		//multiple schedules
		$meetingDay = array();
		$meetingHour = array();
		$dayIndex = 0;
		$timeIndex = 0;
		
		for($x = 0; $x < count($meetingTime->ITEM); $x++){	
			if($x == 0){
				//initialize
				$meetingDay[$dayIndex] = date("l, F jS", strtotime($meetingTime->ITEM[0]->STARTTIME));
				$meetingHour[$dayIndex][$timeIndex] = date("g:i A", strtotime($meetingTime->ITEM[0]->STARTTIME));
				$timeIndex += 1;
			}else{
				//compare current day with previous
				if($meetingDay[$dayIndex] == date("l, F jS", strtotime($meetingTime->ITEM[$x]->STARTTIME))){
					//same day meeting add time to array
					$meetingHour[$dayIndex][$timeIndex] = date("g:i A", strtotime($meetingTime->ITEM[$x]->STARTTIME));
				}else{
					//different day meeting add dayIndex
					$dayIndex += 1;
					//new day, initialize timeIndex
					$timeIndex = 0;
					$meetingDay[$dayIndex] = date("l, F jS", strtotime($meetingTime->ITEM[$x]->STARTTIME));
					$meetingHour[$dayIndex][$timeIndex] = date("g:i A", strtotime($meetingTime->ITEM[$x]->STARTTIME));
				}
				$timeIndex += 1;
			}
		}
		
		//count number of scheduled meeting for each day
		$meetingCount = array();
		$ctr = 0;
		foreach($meetingHour as $meetings){
				$meetingCount[$ctr] = count($meetings);
				$ctr += 1;
		}
		
		//create schedule text
		for($y = 0; $y < count($meetingDay); $y++){
			$deputationSchedule .= $meetingDay[$y].' at ';
			if($meetingCount[$y] > 1){
				//there's multiple scheduled meeting for the day
				for($z = 0; $z < $meetingCount[$y]; $z++){
					if($z == ($meetingCount[$y] - 1)){
						//this is the last meeting for the day
						$deputationSchedule .= ' & '.$meetingHour[$y][$z];
					}elseif($z != 0){
						//there's still other meeting after this
						$deputationSchedule .= ', '.$meetingHour[$y][$z];
					}else{
						$deputationSchedule .= '</nl><nl>'.$meetingHour[$y][$z];
					}
				}
			}else{
				//there's only one scheduled meeting
				$deputationSchedule .= $meetingHour[$y][0];
			}
			
			//check if this is the last day of the meeting
			if($y < count($meetingDay)-1){
				$deputationSchedule .= '</nl><nl>';
			}
		}
		
	}else{
		//single schedule
		$deputationSchedule = date("l, F jS", strtotime($meetingTime->ITEM[0]->STARTTIME)).' at '.date("g:i A", strtotime($meetingTime->ITEM[0]->STARTTIME));
	}
	
	return $deputationSchedule;
}*/
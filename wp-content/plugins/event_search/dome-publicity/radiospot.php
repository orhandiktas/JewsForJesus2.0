<?php
require('fpdf/fpdf.php');
require_once("infinity.php");

//get URL variables
$deputationID = $_GET['ref'];

$filterValues=array();

$filterValues[0] = getStringFilter('LOOKUPID', $deputationID);

$soapClient = new infinitySOAP();

$result = getDeputationCompleteDetails($soapClient,'709bcd2f-09ba-4b95-b838-4ac01af60d9c', $filterValues); 

$deputationDetails = array($result[0]->Values->v);

//parse the xml schedule to an array
$meetingTime = simplexml_load_string($deputationDetails[0][11]);

//create radio spot text for schedule
$scheduleText = getSchedule($meetingTime);

$speakerGender = $deputationDetails[0][22];
	if($speakerGender == '1'){
		$speakerGender = 'he';
	}else if($speakerGender == '2'){
		$speakerGender = 'she';
	}else{
		$speakerGender = '(HE/SHE)';
	}

$contactText = getContactText($deputationDetails[0][6], $deputationDetails[0][10]);

$cip = 'What do the Jewish Passover and Jesus\' last supper have in common? '.$deputationDetails[0][15].', with Jews for Jesus, will answer that question as '.$speakerGender.', presents "Christ in the Passover" at the '.$deputationDetails[0][5].' located at '.preg_replace("/\r\n|\r|\n/"," ",$deputationDetails[0][7]).' in '.$deputationDetails[0][8].' on '.$scheduleText.'. You\'ll gain wonderful insights on how the pieces of God\'s plan of salvation fit together, and you\'ll remember this visual display of the Passover pageantry for years to come. Join us for Christ in the Passover from Egypt to Calvary to what it means for us today. '.$contactText.' There will be no admission charge.';

//create the pdf
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(15,30,15);
$pdf->SetFont('Times','B',24);
$pdf->Cell(0,30,"RADIO SPOT",0,2,C);
$pdf->SetFont('Times','',20);
$pdf->Cell(0,0,$deputationDetails[0][2],0,2,C);
$pdf->SetXY(15,60);
$pdf->SetFont('Times','',14);
$pdf->MultiCell(0, 14, $cip, 0, 'J');
$pdf->Output('JFJ '.$deputationDetails[0][2].' Radio Spot','I');

function getSchedule($meetingTime){
	
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
					if($z == ($meetingCount[$y]) - 1){
						//this is the last meeting for the day
						$deputationSchedule .= ' & '.$meetingHour[$y][$z];
					}elseif($z != 0){
						//there's still other meeting after this
						$deputationSchedule .= ', '.$meetingHour[$y][$z];
					}else{
						$deputationSchedule .= $meetingHour[$y][$z];
					}
				}
			}else{
				//there's only one scheduled meeting
				$deputationSchedule .= $meetingHour[$y][0];
			}
			
			//check if this is the last day of the meeting
			if($y < count($meetingDay)-1){
				$deputationSchedule .= ' and ';
			}
		}
		
	}else{
		//single schedule
		$deputationSchedule = date("l, F jS", strtotime($meetingTime->ITEM[0]->STARTTIME)).' at '.date("g:i A", strtotime($meetingTime->ITEM[0]->STARTTIME));
	}
	
	return $deputationSchedule;
}

function getContactText($hostPhone, $hostWeb){
	//generate the contact text
	$deputationHostContact = '';
	if($hostWeb != ''){
		$deputationHostContact = 'Call '.$hostPhone.' or visit '.$hostWeb.' for more information.';
	}else{
		$deputationHostContact = 'Call '.$hostPhone.' for more information.';
	}
	
	return $deputationHostContact;
}


?>
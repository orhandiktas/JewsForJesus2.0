<?php
require('fpdf/WriteTag.php');
require_once("infinity.php");

//get URL variables
$deputationID = $_GET['ref'];

$filterValues=array();

$filterValues[0] = getStringFilter('LOOKUPID', $deputationID);

$soapClient = new infinitySOAP();

$result = getDeputationCompleteDetails($soapClient,'709bcd2f-09ba-4b95-b838-4ac01af60d9c', $filterValues); 

$deputationDetails = array($result[0]->Values->v);

//create the pdf
$pdf = new PDF_WriteTag('P','mm','A4');
$pdf->SetMargins(10,30,10);
$pdf->SetStyle('em', 'Times', 'I', 0, '0,0,0');
$pdf->SetStyle('p', 'Times', 'N', 12, '0,0,0', 0);
$pdf->AddPage();
$pdf->SetXY(10,15);
$pdf->SetFont('Times','B',14);
$pdf->MultiCell(0,7,getTittle($deputationDetails[0][2]),0,C);
$pdf->SetXY(10,25);
$pdf->SetFont('Times','B',14);
$pdf->MultiCell(0,7,getSubTittle($deputationDetails[0][2]),0,C);
$pdf->SetXY(10,40);
$pdf->SetFont('Times','',12);
$pdf->WriteTag(0, 7, getBodyText($deputationDetails), 0, 'J', 0, 0);
$pdf->Output('JFJ '.$deputationDetails[0][2].' Press Release','I');


function getTittle($deputationType){
	$tittle = '';
	if($deputationType == 'Christ in the Feast of Tabernacles'){
		$tittle =  'PRESS RELEASE';
	}elseif($deputationType == 'Christ in the Passover'){
		$tittle =  'PRESS RELEASE';
	}else{
		$tittle =  'SAMPLE PRESS RELEASE';
	}
	
	return $tittle;
}

function getSubTittle($deputationType){
	$subTittle = '';
	if($deputationType == 'Christ in the Feast of Tabernacles'){
		$subTittle =  'JEWS FOR JESUS TO PRESENT "CHRIST IN THE FEAST OF TABERNACLES"';
	}elseif($deputationType == 'Christ in the Passover'){
		$subTittle =  'CHRIST IN THE PASSOVER';	
	}else{
		$subTittle =  'JEWS FOR JESUS TO SPEAK';
	}
	
	return $subTittle;
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

function getBodyText($deputationInfo){
	//body text
	//Generic Press Release
	$scheduleText = getSchedule(simplexml_load_string($deputationInfo[0][11]));
	
	$contactText = getContactText($deputationInfo[0][6], $deputationInfo[0][10]);
	
	$speakerGender = $deputationInfo[0][22];
	if($speakerGender == '1'){
		$speakerGender = 'he';
	}else if($speakerGender == '2'){
		$speakerGender = 'she';
	}else{
		$speakerGender = '(HE/SHE)';
	}
	
	$generic = '<p>'.$deputationInfo[0][5].' invites all to hear a presentation given by Jews for Jesus on '.$scheduleText.'. The topic will be '.$deputationInfo[0][2].'.</p>
<p>Jews for Jesus is an agency that proclaims that Jesus is the Messiah of Israel and Savior of the world. The late Moishe Rosen, a Jew who has believed in Jesus for over 35 years, founded the organization. However, Dr. Rosen was quick to point out that he did not "start" Jews for Jesus. "Jews for Jesus began about 2,000 years ago, around 32 C.E., give or take a year. Jesus\' first disciples were Jewish, and there have been some Jewish people who have believed in him ever since."</p>
<p>The organization has permanent branches in eight North American cities (San Francisco, Los Angeles, Boston, Chicago, Toronto, New York City, Washington D.C. and Fort Lauderdale) as well as over 127 volunteer chapters spanning some 41 states and five countries. The group\'s international branches are headquartered in Johannesburg, London, Paris, Odessa, Moscow, Essen, Rio de Janeiro, Kharkov, Dnepopretrovsk, and Tel Aviv.</p>
<p>To the Jews for Jesus, believing in Jesus makes sense in light of the Jewish Bible and in light of their experiences as "believers." For those who argue that Christianity contradicts the meaning of Judaism, the Jews for Jesus say there are answers, which their representative will be happy to discuss after the presentation. '.$contactText.' There will be no admission charge.</p>';

	//Christ in the Passover
	$cip = '<p>Jesus\' Last Supper was actually a Jewish Passover. '.$deputationInfo[0][15].' of Jews for Jesus will re-create the traditional Passover service and explain how it foreshadowed Jesus\' death and resurrection in a presentation called "Christ in the Passover" at '.$deputationInfo[0][5].' on '.$scheduleText.'.</p>
<p>'.$deputationInfo[0][15].' will set a table with items traditionally used at the Passover meal and detail their spiritual significance. '.ucfirst($speakerGender).' will also explain the connection between the events of the first Passover in Egypt and the redemption that Jesus accomplished, as well as the deep bond between the ancient Passover feast and the Christian communion celebration today.</p>
<p>Jews for Jesus has presented "Christ in the Passover" at over 38,000 churches. It has been enthusiastically received by Christians who appreciate learning more about the Jewish backgrounds of their faith. Moishe Rosen, who founded Jews for Jesus in 1973, has also co-written the book, <em>Christ in the Passover</em>, with his wife, Ceil. This seminal work includes a look at Passover in ancient times and how it is practiced today. It will be available after the presentation. Also available will be a DVD of the Christ in the Passover presentation with David Brickner, the executive director of Jews for Jesus, officiating.</p>
<p>Brickner, a fifth-generation Jewish believer in Jesus, succeeded Rosen as Executive Director in 1996. Brickner has kept Jews for Jesus on the cutting edge as the ministry has expanded and established branches in eleven countries, including the United States, Brazil, Israel, Russia, France, and South Africa. "We exist to make the Messiahship of Jesus an unavoidable issue to our Jewish people worldwide," Brickner states. "There are still a few that haven\'t heard of us!"</p>
<p>'.$deputationInfo[0][15].' will be happy to answer questions after the presentation. '.$contactText.' There is no admission charge.</p>';

	//Christ in the Feast of Tabernacles
	$cift = '<p>Is '.$deputationInfo[0][5].' undergoing a building renovation by Jews for Jesus? Not exactly, but the church will allow Jews for Jesus to come and construct a temporary booth or <em>sukkah</em> on '.$scheduleText.' to explain the significance of the Feast of Booths or Tabernacles.</p>
<p>Why come to church to hear about ancient Jewish rituals? "Maybe," says '.$deputationInfo[0][15].', "because those rituals served as a backdrop for the gospel accounts of the life story of Jesus, and because this holiday points to Jesus as the Messiah -- for Israel and for everyone else. That\'s why we call the presentation Christ in the Feast of Tabernacles."</p>
<p>'.$deputationInfo[0][15].' will explain how the Feast of Tabernacles, or <em>Sukkot</em>, is a vibrant part of Jewish life today and how the holiday offers a wealth of meaning for Christians who value their Old Testament heritage. '.ucfirst($speakerGender).' will also demonstrate how <em>Sukkot</em> plays into God\'s worldwide plans for tomorrow.</p>
<p>This sermonic demonstration uses a variety of visual aids to show the rich history of the feast and its attendant traditions. '.$deputationInfo[0][15].' sets up an actual <em>sukkah</em> or ceremonial booth, inviting congregants to help adorn the booth with harvest fruits and foliage as part of the demonstration. (SHE/HE) transports you to Jerusalem in Jesus\' day and sets the stage for his claims to be the Light of the World and the Living Water. "This presentation is a glimpse into the Jewish life that Jesus lived on this earth," '.$deputationInfo[0][15].' says. "Anyone who loves Jesus will feel they know him even more intimately as they learn more about the rituals he and his disciples observed. Seekers or skeptics who wonder about the Jewishness of Jesus are also very welcome."</p>
<p>Those who attend will see ceremonies such as the ancient water pouring, the waving of the <em>lulav</em> and the hanging of fruit in the temporary shelter. Adults are encouraged to bring their children ages seven and older.</p>
<p>David Brickner, Executive Director of Jews for Jesus, says, "Christians should not miss out on this dramatic experience. Jesus not only celebrated the Feast of Tabernacles, he used it as the occasion to reveal something about his nature and his mission." Brickner has authored the seminal book about this festival, entitled <em>Christ in the Feast of Tabernacles</em>, which will be available, along with other materials, after the presentation.</p>
<p>'.$deputationInfo[0][15].' will be happy to answer questions after the presentation. '.$contactText.' There is no admission charge.</p>';
	
	$bodyText = '';
	
	
	if($deputationInfo[0][2] == 'Christ in the Feast of Tabernacles'){
		$bodyText = $cift;
	}elseif($deputationInfo[0][2] == 'Christ in the Passover'){
		$bodyText = $cip;
	}else{
		$bodyText = $generic;
	}
	
	return $bodyText;
}

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
					if($z == ($meetingCount[$y] - 1)){
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

?>
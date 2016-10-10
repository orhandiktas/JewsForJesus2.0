<?
require_once("infinity.php");

//get deputation information from BBEC
//get URL variables
$deputationID = $_GET['ref'];

$filterValues=array();

$filterValues[0] = getStringFilter('LOOKUPID', $deputationID);

$soapClient = new infinitySOAP();

$result = getDeputationCompleteDetails($soapClient,'709bcd2f-09ba-4b95-b838-4ac01af60d9c', $filterValues); 

$deputationDetails = array($result[0]->Values->v);

//get speker bio from Community Builder
//$sql = "SELECT avatar, cb_advancebio FROM #__comprofiler WHERE CONCAT(firstname, ' ', lastname) = '".$deputationDetails[0][15]."'";
$sql = "SELECT avatar, cb_advancebio, firstname, lastname FROM #__comprofiler WHERE approved = 1 AND cb_bbeclookupid = '".$deputationDetails[0][23]."'";
//$sql = "SELECT avatar, cb_advancebio FROM #__comprofiler WHERE approved = 1 AND CONCAT(firstname, REPLACE(COALESCE(CONCAT(' ',middlename,' '), ' '), '  ', ' '), lastname) = '".$deputationDetails[0][15]."'";
//$database = JFactory::getDBO();
//$database->setQuery($sql, 0, 1);
//$speakerInfo = $database->loadAssoc();
$speakerBio = '';
$speakerProfile = '';
$speakerAvatar = '';
if(strlen($speakerInfo[cb_advancebio]) > 600){
	$wrappedBio = wordwrap($speakerInfo[cb_advancebio],600,'[biobreak]');
}else{
	$wrappedBio = $speakerInfo[cb_advancebio] . '[biobreak]';
}

$speakerBioIntro = substr($wrappedBio, 0, strpos($wrappedBio, '[biobreak]'));

$replacestring = array(".","'");
//check for speaker bio
if($speakerInfo[cb_advancebio] != ''){
	//bio found, create profile link
	$speakerProfile = '<a href="http://dev01.jewsforjesus.org/'. $speakerInfo[firstname] .'-'. $speakerInfo[lastname] .'-2/">'. $deputationDetails[0][15] .'</a>';
	echo "<h1>hashtag yolo swag</h1>";
	echo $speakerProfile;
	// $speakerProfile = '<a href="/'.strtolower(str_replace($replacestring, "",(str_replace(" ", "-", $speakerInfo[firstname].'-'.$speakerInfo[lastname])))).'" title="'.$deputationDetails[0][15].' Profile">'.$deputationDetails[0][15].'</a>';
	//$speakerProfile = '<a href="/'.strtolower(str_replace(".", "",(str_replace(" ", "-", $deputationDetails[0][15])))).'" title="'.$deputationDetails[0][15].' Profile">'.$deputationDetails[0][15].'</a>';
	
	//check for speaker avatar
	if($speakerInfo[avatar] != ''){
		//avatar found, create thumbnail image
		$speakerAvatar = '<a href="/'.strtolower(str_replace($replacestring, "",(str_replace(" ", "-",  $speakerInfo[firstname].'-'.$speakerInfo[lastname])))).'" title="'.$deputationDetails[0][15].' Profile"><img src="http://www.jewsforjesus.org/images/comprofiler/'.$speakerInfo[avatar].'" style="float:left; padding-top:15px; padding-right:10px; padding-bottom:5px; max-width:100px;" alt="'.$deputationDetails[0][15].'" /></a>';
		//$speakerAvatar = '<a href="/'.strtolower(str_replace(" ", "-", $deputationDetails[0][15])).'" title="'.$deputationDetails[0][15].' Profile"><img src="http://www.jewsforjesus.org/images/comprofiler/'.$speakerInfo[avatar].'" style="float:left; padding-top:15px; padding-right:10px; padding-bottom:5px; max-width:100px;" alt="'.$deputationDetails[0][15].'" /></a>';
		$speakerBio = $speakerBioIntro.'...&nbsp;&nbsp;<a href="/'.strtolower(str_replace($replacestring, "",(str_replace(" ", "-",  $speakerInfo[firstname].'-'.$speakerInfo[lastname])))).'" title="'.$deputationDetails[0][15].' Profile">[Read More]</a>';
		//$speakerBio = $speakerBioIntro.'...&nbsp;&nbsp;<a href="/'.strtolower(str_replace(" ", "-", $deputationDetails[0][15])).'" title="'.$deputationDetails[0][15].' Profile">[Read More]</a>';
	}else{
		//no avatar, skip thumbnail image
		$speakerBio = $speakerBioIntro.'...&nbsp;&nbsp;<a href="/'.strtolower(str_replace($replacestring, "",(str_replace(" ", "-",  $speakerInfo[firstname].'-'.$speakerInfo[lastname])))).'" title="'.$deputationDetails[0][15].' Profile">[Read More]</a>';
		//$speakerBio = $speakerBioIntro.'...&nbsp;&nbsp;<a href="/'.strtolower(str_replace(" ", "-", $deputationDetails[0][15])).'" title="'.$deputationDetails[0][15].' Profile">[Read More]</a>';
	}
}else{
	$speakerProfile = $deputationDetails[0][15];	
}

?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php $splitName = explode(" ", $speakerProfile); echo '<script type="text/javascript"> 
        $( document ).ready(function() {
        	$("#biography-incoming").load("http://dev01.jewsforjesus.org/wp-content/plugins/getUserInfo.php?firstname=' . $splitName[0] . '&lastname=' . $splitName[1] . ' #biography"); 
        });
    	</script>';
        ?>
<h2>
  <a href="http://dev01.jewsforjesus.org/confirmation-checklist/?ref=<?php echo $deputationID; ?>" target="_blank" style="color:#F00">Click here to review and sign the Confirmation Checklist
  </a>
</h2>
<?php
if($deputationDetails[0][5] == ''){
?>
<h3>Deputation not found!</h3>
<?php
}else{?>
<h2>
  <?php echo $deputationDetails[0][2];
if($deputationDetails[0][2] == 'Message from the Word' and $deputationDetails[0][33] != ''){
	echo ' - <em>'.$deputationDetails[0][33].'</em>';
}
?>
</h2>
<div class="table-responsive">
  <table class="table">
    <tr valign="top">
      <td>
        <strong>Hosting Organization:</strong>
      </td>
      <td>
        <?php echo $deputationDetails[0][5];?>
      </td>
    </tr>
    <tr valign="top">
      <td>
        <strong>Meeting Schedule:</strong>
      </td>
      <td>
        <?php 
		$meetingTime = simplexml_load_string($deputationDetails[0][11]);
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
				$meetingDay[$dayIndex] = date("l, F j, Y", strtotime($meetingTime->ITEM[0]->STARTTIME));
				$meetingHour[$dayIndex][$timeIndex] = date("g:i A", strtotime($meetingTime->ITEM[0]->STARTTIME));
				$timeIndex += 1;
			}else{
				//compare current day with previous
				if($meetingDay[$dayIndex] == date("l, F j, Y", strtotime($meetingTime->ITEM[$x]->STARTTIME))){
					//same day meeting add time to array
					$meetingHour[$dayIndex][$timeIndex] = date("g:i A", strtotime($meetingTime->ITEM[$x]->STARTTIME));
				}else{
					//different day meeting add dayIndex
					$dayIndex += 1;
					//new day, initialize timeIndex
					$timeIndex = 0;
					$meetingDay[$dayIndex] = date("l, F j, Y", strtotime($meetingTime->ITEM[$x]->STARTTIME));
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
				$deputationSchedule .= '<br/>';
			}
		}
		
	}else{
		//single schedule
		$deputationSchedule = date("l, F j, Y", strtotime($meetingTime->ITEM[0]->STARTTIME)).' at '.date("g:i A", strtotime($meetingTime->ITEM[0]->STARTTIME));
	}

	echo $deputationSchedule;?>
      </td>
    </tr>
    <tr valign="top">
      <td>
        <strong>Meeting Location:</strong>
      </td>
      <td>
        <?php echo preg_replace("/\r\n|\r|\n/","<br/>",$deputationDetails[0][7]).'<br/>'.$deputationDetails[0][8];?>
      </td>
    </tr>
    <tr>
      <td>
        <strong>Speaker:</strong>
      </td>
      <td>
        <?php $splitName = explode(" ", $speakerProfile); echo $splitName[0] . ' ' . $splitName[1];?>
      </td>
    </tr>
    <tr>
    	<td>
    	    <?php $splitName = explode(" ", $speakerProfile); echo '<img style="height: 300px" src="http://dev01.jewsforjesus.org/wp-content/uploads/'. strtolower($splitName[0]) .'-'. strtolower($splitName[1]) .'.jpg">';?>
    	</td>
    	<td>
	        <span id="biography-incoming"></span>
    	</td>
    </tr>
    <?php if($speakerBio != ''){?>
    <tr valign="top">
      <td></td>
      <td align="left" valign="top">
        <?php echo $speakerAvatar.$speakerBio;?>
      </td>
    </tr>
    <?php }?>
    <tr valign="top">
      <td>
        <strong>Church Relations<br>Scheduling Agent:</strong>
      </td>
      <td>
        <a href="mailto:<?php echo $deputationDetails[0][14];?>?subject=<?php echo $deputationDetails[0][2].' - '.$deputationID;?>"><?php echo 'Click here to email '.$deputationDetails[0][13];?>
        </a> or call <?php echo $deputationDetails[0][21];?>
      </td>
    </tr>
    <?php
		$blankcposter = '';
		$blankbwposter = '';
    	switch($deputationDetails[0][2]){
		case 'Christ in the Passover':
			$blankcposter = 'images/poster-cip.jpg';
			$blankbwposter = 'images/bw-poster-cip.jpg';
			break;
		case 'Seder':
			$blankcposter = 'images/poster-passover.jpg';
			$blankbwposter = 'images/bw-poster-passover.jpg';
			break;
		case 'Model Seder':
			$blankcposter = 'images/poster-passover.jpg';
			$blankbwposter = 'images/bw-poster-passover.jpg';
			break;
		case 'Christ in the Feast of Tabernacles':
			$blankcposter = 'images/poster-cift.jpg';
			$blankbwposter = 'images/bw-poster-cift.jpg';
			break;
		default:
			$blankcposter = 'images/poster-presents.jpg';
			$blankbwposter = 'images/bw-poster-presents.jpg';
			break;
		}
	?>
    <tr valign="top">
      <td>
        <strong>Poster:</strong>
      </td>
      <td>
        <em>Color:</em> <a href="http://www.jewsforjesus.org/files/dome-publicity/poster.php?ref=<?php echo $deputationID;?>&opt=color" target="_blank">detailed
        </a> | <a href="http://www.jewsforjesus.org/files/dome-publicity/<?php echo $blankcposter;?>" target="_blank">blank
        </a> &nbsp;&nbsp; <em>Black &amp; White:</em>   <a href="http://www.jewsforjesus.org/files/dome-publicity/poster.php?ref=<?php echo $deputationID;?>&opt=bw" target="_blank">detailed
        </a> |<a href="http://www.jewsforjesus.org/files/dome-publicity/<?php echo $blankbwposter;?>" target="_blank">blank
        </a>
      </td>
      <?php if($deputationDetails[0][2] == 'Christ in the Passover'){
		echo '<tr valign="top">
    	<td><strong>Bulletin Cover or Insert:</strong></td>
		<td><a href="http://www.jewsforjesus.org/files/dome-publicity/cip-bulletin-flyer.pdf" target="_blank">blank</a></td>';
	}?>
    </tr>
    <?php if($deputationDetails[0][2] != 'Christ in the Feast of Tabernacles'){?>
    <tr valign="top">
      <td>
        <strong>Press Release:</strong>
      </td>
      <td>
        <a href="http://www.jewsforjesus.org/files/dome-publicity/pressrelease.php?ref=<?php echo $deputationID;?>" target="_blank">PDF
        </a> | <a href="http://dev01.jewsforjesus.org/wp-content/plugins/event_search/dome-publicity/pressrelease.php?ref=<?php echo $deputationID;?>" target="_blank">HTML
        </a>
      </td>
    </tr>
    <?php }?>
    <?php if($deputationDetails[0][2] == 'Christ in the Passover'){?>
    <tr valign="top">
      <td>
        <strong>Radio Spot:</strong>
      </td>
      <td>
        <a href="http://www.jewsforjesus.org/files/dome-publicity/radiospot.php?ref=<?php echo $deputationID;?>" target="_blank">PDF
        </a> | <a href="http://dev01.jewsforjesus.org/wp-content/plugins/event_search/dome-publicity/radiospot.php?ref=<?php echo $deputationID;?>" target="_blank">HTML
        </a>
      </td>
    </tr>
    <?php }?>
    <?php if($deputationDetails[0][2] == 'Christ in the Passover' || $deputationDetails[0][2] == 'Christ in the Feast of Tabernacles' || $deputationDetails[0][2] == 'Model Seder' || $deputationDetails[0][2] == 'Seder' ){?>
    <tr valign="top">
      <td>
        <strong>Preparation List:</strong>
      </td>
      <td>
        <a href="<?php 
		$prepListURL = 'preplist/';
			switch($deputationDetails[0][2]){
				case 'Christ in the Feast of Tabernacles':
					$prepListURL .= 'cift-prep-list.pdf';
					break;	
				case 'Model Seder':
					$prepListURL .= 'model-seder-prep-list.pdf';
					break;	
				case 'Seder':
					$prepListURL .= 'seder-prep-list.pdf';
					break;	
				default:
					$prepListURL .= 'cip-prep-list.pdf';
					break;	
			}
			
			echo $prepListURL;
		?>" target="_blank">Click here to download the preparation list for <?php echo $deputationDetails[0][2];?>
        </a>
      </td>
    </tr>
    <?php }?>
    <?php if($deputationDetails[0][2] == 'Christ in the Passover'){?>
    <tr valign="top">
      <td>
        <strong>Preparation Video:</strong>
      </td>
      <td>
        <a href="https://www.youtube.com/watch?v=8GI6guAh7i0" target="_blank">Click here to watch "How To: The Table for a Christ in the Passover Presentation"</a>
      </td>
    </tr>
    <?php }?>
    <tr>
      <td>
        <strong>
          Official Jews for Jesus <br>
    	  Logos &amp; 
      Style Guide:</strong>
      </td>
      <td>
        Click on the link below to download a packaged .zip file including instructions. <br>
          <a href="others/Jews-for-Jesus-PowerPoint.zip" target="_blank">Powerpoint (1.7MB)</a> | <a href="others/Jews-for-Jesus-for-Print.zip" target="_blank">Print (7MB)</a> | <a href="others/Jews-for-Jesus-for-Web.zip" target="_blank">Web (1.5MB)</a><br>
            <font size="-2">Jews for Jesus is a registered trademark. Use by permission only.</font>
      </td>
    </tr>
  </table>
</div>
<?php
}
?>
<p>&nbsp;</p>
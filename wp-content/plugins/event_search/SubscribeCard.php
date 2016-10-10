<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="http://dev01.jewsforjesus.org/wp-content/plugins/event_search/card.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php

if(isset($_GET['ref'])) {
	echo '<div class="row">
			<div style="max-width:1280px;margin:auto;">
				<div class="jfj-card jfj-person-card col-xs-12">
					<div class="col-xs-3">
						<a href="http://dev01.jewsforjesus.org"><div class="jfj-person-card-image" style="background-image:url(\'http://dev01.jewsforjesus.org/wp-content/uploads/star.jpg\');">
						</div></a>
					</div>
					<div class="jfj-person-card-info col-xs-9">
						<h2 class="jfj-person-card-name">Subscribe to RealTime</h2>
						<p class="jfj-person-card-bio">
						This is the description! 
						<form action="" method="post">
					      <input name="delivery" type="radio" id="mail" />
					      <label for="mail">Print (Snail-Mail)</label>
					      <input name="delivery" type="radio" id="digital" />
					      <label for="digital">Digital (E-Mail)</label>
						<input type="text" id="firstname" name="firstname" placeholder="First Name" value="">
						<input type="text" id="lastname" placeholder="Last Name" name="lastname" value="">
						<input type="text" id="email" name="email" placeholder="Email Address" value="">
						<input type="text" id="alt_email" placeholder="Email Address" name="alt_email" value="">
 						<input class="btn waves-effect waves-light" type="submit" value="Subscribe">
						</form>
						</p>
					</div>
				</div>
			</div>
		</div>';

	foreach ($_POST as $key => $value) {
		if($key == "alt_email" && $value == ""){
			// this is where the call to the form actually goes
			echo "it worked";
		    echo '<p><strong>' . $key.':</strong> '.$value.'</p>';
		}
	}

	echo '<script type="text/javascript">
		$(document).ready(function() {
		});
	</script>';
}
?>
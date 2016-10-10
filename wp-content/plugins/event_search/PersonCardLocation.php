<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="http://dev01.jewsforjesus.org/wp-content/plugins/event_search/card.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
global $wpdb;

if(isset($_GET['firstname']) && isset($_GET['lastname'])) {
	$sql_query = "SELECT id FROM wp_users WHERE display_name = \"" . $_GET['firstname'] . " " . $_GET['lastname'] . "\";" ;
	$sql = $wpdb->get_results($sql_query);
	$parsed_sql = json_decode(json_encode($sql), True);
	$user_id = $parsed_sql[0]['id'];

	$user_meta_data = get_user_meta($user_id);

	$branch_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id =" . $user_id . " AND field_id = 4";
	$donation_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id =" . $user_id . " AND field_id = 2";
	$branch = $wpdb->get_results($branch_sql);
	$donation = $wpdb->get_results($donation_sql);
	$parsed_branch = json_decode(json_encode($branch), True);
	$parsed_donation = json_decode(json_encode($donation), True);
	echo '<div class="row">
	<div style="max-width:1280px;margin:auto;">
		<div class="jfj-card jfj-person-card col-xs-12">
			<div class="col-xs-3">
				<a href="http://dev01.jewsforjesus.org/about-jews-for-jesus/staff/' . strtolower($user_meta_data[first_name][0])  . '-' . strtolower($user_meta_data[last_name][0]) . '/ "><div class="jfj-person-card-image" style=\'background-image:url("http://dev01.jewsforjesus.org/wp-content/uploads/' . strtolower($user_meta_data[first_name][0])  . '-' . strtolower($user_meta_data[last_name][0]) . '.jpg");\'>
				</div></a>
			</div>
			<div class="jfj-person-card-info col-xs-9">';
				echo '<a class="jfj-person-card-name" href="http://dev01.jewsforjesus.org/about-jews-for-jesus/staff/' . strtolower($user_meta_data[first_name][0])  . '-' . strtolower($user_meta_data[last_name][0]) . '/ "><h2>' . $user_meta_data[first_name][0] . ' ' . $user_meta_data[last_name][0] . '</a> | <a class="jfj-person-card-name" href="http://dev01.jewsforjesus.org/connect/branches/' . str_replace(" ", "-", strtolower($parsed_branch[0]['value'])) . '">' . $parsed_branch[0]['value'] . '</a></h2>';
				echo '<p class="jfj-person-card-bio">' . $user_meta_data[description][0] . '</p>'; 
				echo '<a class="jfj-person-card-articles col-xs-4 col-sm-2" href="http://dev01.jewsforjesus.org/why-jesus/articles/?authors=' . $user_meta_data[first_name][0] . '+' . $user_meta_data[last_name][0] . '"><img src="https://placekitten.com/55/55"></a>
				<a class="jfj-person-card-donate col-xs-4 col-sm-2" href="http://' . $parsed_donation[0][value] . '"><img src="https://placekitten.com/55/55"></a>';
				if ($user_meta_data[facebook][0] != "") {
					echo '<a class="jfj-person-card-twitter col-xs-4 col-sm-2" href="' . $user_meta_data[facebook][0] . '"><img src="http://dev01.jewsforjesus.org/wp-content/themes/jews-for-jesus/images/social_facebook-white.svg"></a>';
				}
				if ($user_meta_data[twitter][0] != "") {
					echo '<a class="jfj-person-card-twitter col-xs-4 col-sm-2" href="http://twitter.com/' . $user_meta_data[twitter][0] . '"><img src="http://dev01.jewsforjesus.org/wp-content/themes/jews-for-jesus/images/social_twitter-white.svg"></a>';
				}
				echo '<a class="jfj-person-card-email col-xs-4 col-sm-2" href="http://dev01.jewsforjesus.org/contact-staff/?ref=' . $user_meta_data[first_name][0] . $user_meta_data[last_name][0] . '"><img src="http://dev01.jewsforjesus.org/wp-content/themes/jews-for-jesus/images/contact-envelope.svg"></a>
			</div>
		</div>
	</div>
</div>
';
	// echo '<h3>Branch</h3>';
	// $branch_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id =" . $user_id . " AND field_id = 4";
	// $branch = $wpdb->get_results($branch_sql);
	// $parsed_branch = json_decode(json_encode($branch), True);
	// echo '<span id="branch">' . $parsed_branch[0]['value'] . '</span>'; 
	// echo '<br>';

	// echo '<h3>Donation Url</h3>';
	// $donation_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id = " . $user_id . " AND field_id = 2";
	// $donation_url = $wpdb->get_results($donation_sql);
	// $parsed_donation = json_decode(json_encode($donation_url), True);
	// echo '<span id="donation">' . $parsed_donation[0]['value'] . '</span>'; 
	// echo '<br>';

	// echo '<h3>Profile Picture</h3>';
	// echo '<img src="http://dev01.jewsforjesus.org/wp-content/uploads/'. strtolower($user_meta_data[first_name][0])  . '-' . strtolower($user_meta_data[last_name][0]) .'.jpg" />';
}
?>
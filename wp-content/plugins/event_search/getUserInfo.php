<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
global $wpdb;

if(isset($_GET['id'])) {

	$user_meta_data = get_user_meta($_GET['id']);
	echo '<h3>First Name</h3>';
	echo '<span id="first_name">' . $user_meta_data[first_name][0] . '</span>'; 
	echo '<br>';
	echo '<h3>Last Name</h3>';
	echo '<span id="last_name">' . $user_meta_data[last_name][0] . '</span>'; 
	echo '<br>';
	echo '<h3>Biography</h3>';
	echo '<span id="biography">' . $user_meta_data[description][0] . '</span>'; 

	echo '<h3>Branch</h3>';
	$branch_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id =" . $_GET['id'] . " AND field_id = 4";
	$branch = $wpdb->get_results($branch_sql);
	$parsed_branch = json_decode(json_encode($branch), True);
	echo '<span id="branch">' . $parsed_branch[0]['value'] . '</span>'; 
	echo '<br>';

	echo '<h3>Donation Url</h3>';
	$donation_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id = " . $_GET['id'] . " AND field_id = 2";
	$donation_url = $wpdb->get_results($donation_sql);
	$parsed_donation = json_decode(json_encode($donation_url), True);
	echo '<span id="donation">' . $parsed_donation[0]['value'] . '</span>'; 
	echo '<br>';

	echo '<h3>Profile Picture</h3>';
	echo '<img src="http://dev01.jewsforjesus.org/wp-content/uploads/'. strtolower($user_meta_data[first_name][0])  . '-' . strtolower($user_meta_data[last_name][0]) .'.jpg" />';
}

if(isset($_GET['firstname']) && isset($_GET['lastname'])) {
	$sql_query = "SELECT id FROM wp_users WHERE display_name = \"" . $_GET['firstname'] . " " . $_GET['lastname'] . "\";" ;
	$sql = $wpdb->get_results($sql_query);
	$parsed_sql = json_decode(json_encode($sql), True);
	$user_id = $parsed_sql[0]['id'];

	$user_meta_data = get_user_meta($user_id);
	echo '<h3>First Name</h3>';
	echo '<span id="first_name">' . $user_meta_data[first_name][0] . '</span>'; 
	echo '<br>';
	echo '<h3>Last Name</h3>';
	echo '<span id="last_name">' . $user_meta_data[last_name][0] . '</span>'; 
	echo '<br>';
	echo '<h3>Biography</h3>';
	echo '<span id="biography">' . $user_meta_data[description][0] . '</span>'; 

	echo '<h3>Branch</h3>';
	$branch_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id =" . $user_id . " AND field_id = 4";
	$branch = $wpdb->get_results($branch_sql);
	$parsed_branch = json_decode(json_encode($branch), True);
	echo '<span id="branch">' . $parsed_branch[0]['value'] . '</span>'; 
	echo '<br>';

	echo '<h3>Donation Url</h3>';
	$donation_sql = "SELECT value FROM wp_cimy_uef_data WHERE user_id = " . $user_id . " AND field_id = 2";
	$donation_url = $wpdb->get_results($donation_sql);
	$parsed_donation = json_decode(json_encode($donation_url), True);
	echo '<span id="donation">' . $parsed_donation[0]['value'] . '</span>'; 
	echo '<br>';

	echo '<h3>Profile Picture</h3>';
	echo '<img src="http://dev01.jewsforjesus.org/wp-content/uploads/'. strtolower($user_meta_data[first_name][0])  . '-' . strtolower($user_meta_data[last_name][0]) .'.jpg" />';
}
?>
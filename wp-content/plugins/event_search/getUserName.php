<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
global $wpdb;

if(isset($_GET['bbecid'])) {
	echo "FUCK ME";
	// $sqlquery = "SELECT display_name FROM wp_users WHERE id = (SELECT USER_ID FROM  `wp_cimy_uef_data` WHERE FIELD_ID =\"9\" AND VALUE = \"33760505\" )";
	// $sql = $wpdb->get_results($sql_query);
	// $parsed_sql = json_decode(json_encode($sql), True);
	// echo "<h1>" + $parsed_sql + "</h1>";
}
?>


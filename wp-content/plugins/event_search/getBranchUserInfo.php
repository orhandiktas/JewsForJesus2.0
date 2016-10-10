<?php
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>';
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
global $wpdb;

if(isset($_GET['branch'])) {
	$sql_query = "SELECT display_name FROM wp_users WHERE id IN (SELECT user_id FROM wp_cimy_uef_data WHERE value = \"" . $_GET['branch'] . "\");";
	$sql = $wpdb->get_results($sql_query);
	$parsed_sql = json_decode(json_encode($sql), True);
	echo '<span id="staffList">';
	foreach ($parsed_sql as $staffer) {
		$name = explode(" ", $staffer['display_name']);
		echo '<span id="' . $name[0] . $name[1] . 'card"></span><br>';
	}
	echo '<script type="text/javascript"> 
	        $( document ).ready(function() {';
	foreach ($parsed_sql as $staffer) {
		$name = explode(" ", $staffer['display_name']);
		        echo '
        		$("#' . $name[0] . $name[1] . 'card").load("http://dev01.jewsforjesus.org/wp-content/plugins/event_search/PersonCard.php?firstname=' . $name[0] . '&lastname=' . $name[1] . '#card");';
	}
			echo '});
		</script>
	</span>';
}
?>
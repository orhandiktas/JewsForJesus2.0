<?php
/**
 * Plugin Name: WP Table Lookup
 * Plugin URI: http://www.chiranjitmakur.in/table-lookup
 * Description: Using this plugin you can see database table structure, table fields with values and can run custom sql from admin panel of your wordpress site.
 * Version: 1.0.0
 * Author: Chiranjit Makur
 * Author URI: http://www.chiranjitmakur.in
 * Tags: Table Lookup,Database Lookup,table structure plugin,wordpress show table structure plugin
 * License: GPL2
 */


define('WPTABLE_LOOKUP_PLUGIN_URL', plugin_dir_url(__FILE__));
/* Runs when plugin is activated */
register_activation_hook(__FILE__, 'my_plugin_plugin_install');

/* Runs on plugin deactivation */
register_deactivation_hook(__FILE__, 'my_plugin_plugin_remove');

add_action('admin_menu', 'register_my_plugin_custom_menu_page');

if ( !defined( 'DS' ) ) {
	if ( strtoupper( substr( PHP_OS, 0, 3 ) ) == 'WIN' ) {
		define( 'DS', '\\' );
	}
	else {
		define( 'DS', '/' );
	}
}

function load_wp_table_lookup_admin_style() {
	wp_register_style( 'wp_table_lookup_admin_css', WPTABLE_LOOKUP_PLUGIN_URL.'css/style.css', false, '1.0.0' );
	wp_enqueue_style( 'wp_table_lookup_admin_css' );
	wp_enqueue_script('load_wp_table_lookup_script', WPTABLE_LOOKUP_PLUGIN_URL . '/js/wp_table_lookup.js', array('jquery'), "1.2.0", TRUE);
}
add_action( 'admin_enqueue_scripts', 'load_wp_table_lookup_admin_style' );

function register_my_plugin_custom_menu_page() {
    add_menu_page('Table', 'Tables Lookup', 'administrator', 'table_lookup', 'my_plugin_custom_menu_page', WPTABLE_LOOKUP_PLUGIN_URL . 'images/ticon.jpg');
    add_submenu_page('table_lookup', 'Table Structure', 'Table Structure', 'administrator', 'show_table_structure', 'my_plugin_table_structure');
    add_submenu_page('table_lookup', 'Run Custom Query', 'Run Custom Query', 'administrator', 'run_query', 'my_plugin_run_query');
    add_submenu_page('table_lookup', 'Export Database', 'Export Database', 'administrator', 'export_database', 'my_plugin_export_database');
}

function my_plugin_custom_menu_page() {
    if (isset($_POST['get_table'])) {
        global $wpdb;
        $table_name = $wpdb->escape($_POST['dbtable']);
        include_once 'show_tables.php';
        $sql_get_table_data = "SELECT * FROM $table_name";
        $sql_get_table_column_names = "SHOW COLUMNS FROM $table_name";
        $res_table_column_name = $wpdb->get_results($sql_get_table_column_names);
        $res_table = $wpdb->get_results($sql_get_table_data);
        echo "<table border='1'><tr>";
        foreach ($res_table_column_name as $column) {
            echo "<td>" . $column->Field . "</td>";
        }
        echo "</tr>";
        foreach ($res_table as $tab_element => $element) {
            echo "<tr>";
            foreach ($element as $val => $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        include_once 'show_tables.php';
    }
}

function my_plugin_run_query() {
    if (isset($_POST['run_query'])) {
        global $wpdb;
        $my_plugin_query = $wpdb->escape($_POST['my_plugin_query']);
        include_once 'run_query.php';
        $res = $wpdb->query($my_plugin_query);
        if ($res) {
            echo "Query executed successfully";
        } else {
            echo "Query execution failed";
        }
    } else {
        include_once 'run_query.php';
    }
}

function my_plugin_table_structure() {
    if (isset($_POST['get_table_structure'])) {
        global $wpdb;
        $table_name = $wpdb->escape($_POST['dbtable']);
        include_once 'show_tables_structure.php';
        $sql_get_table_structure = "DESCRIBE $table_name";
        $tab_struc = $wpdb->get_results($sql_get_table_structure);
        ?>
        <table border="1"><tr><td>Field</td><td>Type</td><td>Null</td><td>Key</td><td>Default</td><td>Extra</td></tr>
            <?php
            foreach ($tab_struc as $tab) {
                ?>
                <tr><td><?php echo $tab->Field; ?></td><td><?php echo $tab->Type; ?></td><td><?php echo $tab->Null; ?></td><td><?php echo $tab->Key; ?></td><td><?php echo $tab->Default; ?></td><td><?php echo $tab->Extra; ?></td></tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        include_once 'show_tables_structure.php';
    }
}

function get_current_path() {
	$current_path = dirname( __FILE__ );
	$current_path = str_replace( DS . 'wp-table-lookup', '', $current_path );
	$current_path = realpath( $current_path . '/../..' );
	
	if ( get_bloginfo( 'url' ) != get_bloginfo( 'wpurl' ) ) {
		$wp_dir = str_replace( get_bloginfo( 'url' ), '', get_bloginfo( 'wpurl' ) );
		$wp_dir = str_replace( '/', DS, $wp_dir );
		$current_path = str_replace( $wp_dir, '', $current_path );
	}
	
	return $current_path;
}

function my_plugin_export_database() {
	$username = DB_USER;
	$password = DB_PASSWORD;
	$hostname = DB_HOST;
	$dbname   = DB_NAME;
	
	
	$current_url = get_bloginfo( 'url' );
	?>
	<div>
		<div><h2>Database Details</h2></div>
		<div>
			<ul>
				<li style="margin: 5px">
					<span style="margin: 5px"><strong>Database Name:</strong><?php echo $dbname;?></span>
					<span style="margin: 5px"><strong>Database Username:</strong><?php echo $username;?></span>
				</li>
				<li style="margin: 5px">
					<span style="margin: 5px"><strong>Database Password:</strong><?php echo $password;?></span>
					<span style="margin: 5px"><strong>Database Host:</strong><?php echo $hostname;?></span>
				</li>
			</ul>
		</div>
		<div>
			<form name="fromdbexport" id="fromdbexport" action="" method="post">
				<ul>
					<li style="margin: 5px">
						<span style="margin: 5px"><strong>Current Url : </strong><?php echo $current_url;?></span>
					</li>
					<li style="margin: 5px">
						<span style="margin: 5px"><strong>Current Path : </strong><?php echo get_current_path();?></span>
					</li>
				</ul>
				<ul class="urlReplace">
					<li style="margin: 5px">
						<span style="margin: 5px">Replace Url and Path<input type="checkbox" name="changeUrl" class="chkChangeUrl"/></span>
					</li>
					<li style="margin: 5px">
						<span style="margin: 5px"><strong>New Url : </strong><input type="text" name="new_url" id="new_url" class="newUrl"></span>
					</li>
					<li style="margin: 5px">
						<span style="margin: 5px"><strong>New Path : </strong><input type="text" name="new_path" id="new_path" class="newPath"></span>
					</li>
					<li>
						<input type="submit" name="export_database" value="Export Database" class="button">
					</li>
				</ul>
			</form>
		</div>
	</div>
	<?php
	if(isset($_POST['export_database']) && $_POST['export_database']=='Export Database') {
		$changeUrl	= $_POST['changeUrl'];
		$new_url	= $_POST['new_url'];
		$new_path	= $_POST['new_path'];
		$backup_response = backup_Database($hostname, $username, $password, $dbname, $changeUrl, $new_url, $new_path);
		if($backup_response) {
			echo 'Database Backup Successfully Created!';
		}
		else {
			echo 'Errors in Database Backup Creating!';
		}
	}
}

/**
 * @param unknown_type $hostName
 * @param unknown_type $userName
 * @param unknown_type $password
 * @param unknown_type $DbName
 * @param unknown_type $tables
 * @return boolean
 */
function backup_Database($hostName, $userName, $password, $DbName, $changeUrl='', $new_url, $new_path, $tables = '*') {
	
	$con = mysql_connect($hostName,$userName,$password) or die(mysql_error());
	mysql_select_db($DbName,$con) or die(mysql_error());
	
	if($tables == '*') {
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	} else {
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}

	$return = 'SET FOREIGN_KEY_CHECKS=0;' . "\r\n";
	$return.= 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";' . "\r\n";
	$return.= 'SET AUTOCOMMIT=0;' . "\r\n";
	$return.= 'START TRANSACTION;' . "\r\n";

	$data = '';
	foreach($tables as $table) {
		$result = mysql_query('SELECT * FROM '.$table) or die(mysql_error());
		$num_fields = mysql_num_fields($result) or die(mysql_error());

		$data.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$data.= "\n\n".$row2[1].";\n\n";

		for ($i = 0; $i<$num_fields; $i++) {
			while($row = mysql_fetch_row($result)) {
				$data.= 'INSERT INTO '.$table.' VALUES(';
				for($x=0; $x<$num_fields; $x++) {
					$row[$x] = addslashes($row[$x]);
						$row[$x] = clean($row[$x]);
						if (isset($row[$x])) {
							$data.= '"'.$row[$x].'"' ;
						} else {
							$data.= '""';
						}
			
						if ($x<($num_fields-1)) {
						$data.= ',';
						}
					}
				$data.= ");\n";
				}
			}

			$data.="\n\n\n";
		}

		$return .= 'SET FOREIGN_KEY_CHECKS=1;' . "\r\n";
			$return.= 'COMMIT;';
			
			
			if($changeUrl && $changeUrl!='') {
				$current_path			= get_current_path();
				$current_url			= get_bloginfo( 'url' );
				$current_path_serialize	= serialize(get_current_path());
				$current_url_serialize	= serialize(get_bloginfo( 'url' ));
				
				$search = array( $current_path, $current_url, $current_path_serialize, $current_url_serialize );
				$replace = array( $new_path, $new_url, serialize($new_path), serialize($new_url));
				$data = str_ireplace( $search, $replace, $data, $count );
			
			}
			$filename = $DbName."-Database-Backup-".date('Y-m-d-h-i-s').".sql";
			$handle = fopen($filename,'w');
			fwrite($handle,$data);
            header( "Content-Type: application/octet-stream");
            header( "Content-Length: " . filesize( $filename ) );
            header( 'Content-Disposition: download; filename='.$filename);
            ob_clean();
            echo $data;
			 
			if($data)
				return true;
			else
				return false;
}

function clean($str) {
	if(@isset($str)){
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	} else {
		return 'NULL';
	}
}
<?php
global $wpdb;
$dbname = $wpdb->dbname;
$tab = "Tables_in_" . $dbname;
$sql_show_all_tab = "SHOW TABLES";
$res_tables = $wpdb->get_results($sql_show_all_tab);
?>
<form name="fromdbtable" id="fromdbtable" action="" method="post">
    <select id="dbtable" name="dbtable">
        <?php
        foreach ($res_tables as $table) {
            ?>
            <option name="dbtable" value="<?php echo $table->$tab; ?>" <?php
            if (isset($table_name) && $table_name == ($table->$tab)) {
                echo "selected";
            }
            ?>><?php echo $table->$tab; ?></option>
                <?php }
                ?>
    </select>
    <input type="submit" name="get_table_structure" value="submit" class="button">
</form>
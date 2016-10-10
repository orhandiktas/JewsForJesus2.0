<h1>Run Manual SQL Query</h1>
<h2 style="color: #CC0000">Only Do this if you are familiar with SQL Queries.Any wrong query may damage your whole database.</h2>
<h2>Only INSERT,UPDATE,DELETE queries.</h2>
<form name="fromdbtablequery" id="fromdbtablequery" action="" method="post">
    <textarea name="my_plugin_query" rows="5" cols="100"><?php
        if (isset($my_plugin_query)) {
            echo $my_plugin_query;
        }
        ?></textarea><br/>
    <input type="submit" name="run_query" value="Run Query" class="button">
</form>
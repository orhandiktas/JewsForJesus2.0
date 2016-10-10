<?php

$actual_uri = "$_SERVER[REQUEST_URI]";

echo '<body style="margin:0"><iframe style="width:100vw;height:100vh;border:none;padding:none" src="http://dev01.jewsforjesus.org/connect/articles/?_sft_post_tag='. substr($actual_uri, 5, -1) .'"></iframe></body>';

?>
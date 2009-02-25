<?php

require_once('../core/Image.php');
if (!$_GET["id"])
	$_GET["id"] = 1;
$im = new Image($_GET);
$im->render();

?>
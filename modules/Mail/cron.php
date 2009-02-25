<?php
include ('../../include/Site.php');
include ('Mail.php');

$_REQUEST['module'] = 'Mail';

$module = Module::factory('Mail');
$module->cron();

?>
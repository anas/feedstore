<?php
include('include/Site.php');
$opts = Config::getModuleOptions('Content');
$opts['restrictedpages'] = 'true';
Config::setModuleOptions('Content', $opts);
?>
<?php

/**
 * Smarty plugin to replace \n with <br> in strings 
 * @file function.helpitem.php
 * @package Smarty
 * @subpackage plugins
 */

/* 
 * 
 * @package Smarty
 * @subpackage plugins
 */
function smarty_function_nl2br($params) {
	return nl2br($params['st']);
}

?> 
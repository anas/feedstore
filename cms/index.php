<?php
/**
 * Admin Initialization
 * 
 * @todo fix .htaccess file so that trim() hack isn't required
 * 
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @subpackage Core
 * @version 2.0
 */
include_once '../include/Debugger.php';
error_reporting(E_ALL);
$debugger = Debugger::instance();
$oldErrorHandler = set_error_handler(array (&$debugger, 'errorHandler'), E_ALL);
$debugger->debug("first call");

/**
 * Require the site initialization file
 */

require_once (dirname(__FILE__) . "/../include/Site.php");
$auth_container = new CMSAuthContainer();
$auth = new Auth($auth_container, null, 'authHTML');
$auth->start();

if ($auth->checkAuth()) {
	if ($_SESSION["authenticated_user"]->getAuthGroup() != 1){
		header('location: /user/');
		exit;
	}
	// set templates dir to the admin templates location
	$smarty->template_dir = SITE_ROOT . '/cms/templates';
	// set a custom compile id to ensure Smarty doesent accidentally overwrite duplicate compiled files.
	$smarty->compile_id = 'admin';
	
	// This is currently a hack since my url-rewriting syntax keeps a trailing slash on the module name
	$requestedModule = trim(@$_GET['module'], '/');
	
	// assign the requested module
	$smarty->assign('module', $requestedModule);
	
	// render the admin page
	require_once 'HTML/AJAX/Helper.php';
	$ajaxHelper = new HTML_AJAX_Helper ( );
	
	if ( $ajaxHelper->isAJAX () ){
		echo Module::factory($requestedModule, $smarty)->getAdminInterface();
		die();
	} else {
		if (!isset($_REQUEST['module'])) {
			$requestedModule = 'Dashboard';
			$smarty->assign ( 'module', $requestedModule );
			$smarty->assign ( 'module_title', 'Dashboard' );
		} else {
			$smarty->content[$requestedModule] = Module::factory($requestedModule, $smarty)->getAdminInterface();
			$smarty->assign ( 'module', $requestedModule );
			
			$sql = 'select display_name from modules where module="' . e($requestedModule) . '"';
			$r = Database::singleton()->query_fetch($sql);
			$smarty->assign ( 'module_title', $r['display_name'] );
		}
		
		
		$smarty->addCSS('/css/facebox.css');
		$smarty->addJS('/js/facebox.js');
		
		$smarty->addJS('/js/help.js');
		
		$smarty->addJS('/js/admin.js');
		$smarty->render('admin.tpl');
	}
}

?>
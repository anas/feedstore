<?php
/**
 * Analytics Module
 * @author Adam Thurlow <adam@norex.ca>
 * @package Modules
 */

/**
 * !!!!!!!!READ ME!!!!!!!!!
 * Analytics
 * 
 * This is an interface for adding Google Analytics JS to each page.
 * Schema is provided, includes table drops.
 * Schema also includes line to add to the Admin Menu
 * 
 * Usage: in site.tpl, add line {module class="Analytics"} in the head.
 * 
 * @package Modules
 * @subpackage Skeleton
 */
class Module_Analytics extends Module {

	function getAdminInterface() {
		switch (@$_REQUEST['section']) {
			case 'addedit':
				$script = new Analytics(@$_REQUEST['analytics_id']);
				$form = $script->getAddEditForm();
				
				if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['analytics_submit'])) {
					return $this->topLevelAdmin();
				} else {
					return $script->getAddEditForm()->display();
				}
				break;
			case 'delete':
				$script = new Analytics(@$_REQUEST['analytics_id']);
				$script->delete();
				return $this->topLevelAdmin();
				break;
			default:
				return $this->topLevelAdmin();
		}
	}
	
	function getUserInterface($params) {
		include_once ('include/Analytics.php');
		$s = Analytics::getAllAnalyticss('active');
		
		$this->smarty->assign('scripts', $s);
		return $this->smarty->fetch('analy.tpl');
	}
	
	function topLevelAdmin() {
		$s = Analytics::getAllAnalyticss();
		$this->smarty->assign('scripts', $s);
		
		return $this->smarty->fetch( 'admin/adminanaly.tpl' );
	}

}

?>
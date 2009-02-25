<?php
/**
 * Skeleton Module
 * @author Christopher Troup <chris@norex.ca>
 * @package Modules
 * @version 2.0
 */

/**
 * Training module.
 * 
 * This is essentially an example to learn how to write modules for the new CMS
 * system. It contains the bare minumum code to qualify for inclusion. This is a
 * good place to copy structure from when creating a new custom module.
 * @package Modules
 * @subpackage Skeleton
 */
class Module_Templater extends Module {
	
	/**
	 * Build and return admin interface
	 * 
	 * Any module providing an admin interface is required to have this function, which
	 * returns a string containing the (x)html of it's admin interface.
	 * @return string
	 */
	function getAdminInterface() {
		$this->addCSS('/modules/Templater/css/templates.css');
		$templates = Template::getAllTemplates();
		
		if (!isset($_REQUEST['template_id'])) {
			$template_data = htmlspecialchars($templates[0]->getData());
			$this->smarty->assign('template_data', $template_data);
			$this->smarty->assign('curtemplate', $templates[0]);
		} else {
			if (isset($_REQUEST['save'])) {
				$t = new Template($_REQUEST['template_id']);
				$t->setData(u($_REQUEST['editor']));
				$t->setTimestamp(date('Y-m-d H:i:s'));
				$t->setId(null);
				$t->save();
				$template_data = htmlspecialchars($t->getData());
				$this->smarty->assign('template_data', $template_data);
				$this->smarty->assign('curtemplate', $t);
				$templates = Template::getAllTemplates();
			} else if (isset($_REQUEST['switch_template'])) {
				$this->smarty->clear_assign('curtemplate');
				$myTemplate = new Template($_REQUEST['template']);
				$template_data = htmlspecialchars($myTemplate->getData());
				$this->smarty->assign('template_data', $template_data);
				$this->smarty->assign('curtemplate', $myTemplate);
			} else if (isset($_REQUEST['switch_revision'])) {
				$this->smarty->clear_assign('curtemplate');
				$myTemplate = new Template($_REQUEST['revision']);
				$template_data = htmlspecialchars($myTemplate->getData());
				$this->smarty->assign('template_data', $template_data);
				$this->smarty->assign('curtemplate', $myTemplate);
			} else {
				$myTemplate = new Template($_REQUEST['template_id']);
				$template_data = htmlspecialchars($myTemplate->getData());
				$this->smarty->assign('curtemplate', $myTemplate);
				$this->smarty->assign('template_data', $template_data);
			}
		}
		
		$this->smarty->assign('templates', $templates);
		return $this->smarty->fetch( 'admin/templates.tpl' );
	}

}

?>
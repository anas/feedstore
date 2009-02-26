<?php
/**
 * Form builder
 * @package CMS
 * @author Christopher Troup <chris@norex.ca>
 * @version 2.0
 */

require_once ('HTML/QuickForm.php');
require_once ('HTML/QuickForm/element.php');
require_once (dirname(__FILE__) . '/PEAR/HTML/QuickForm/advmultiselect.php');
require_once ('HTML/QuickForm/Renderer/ArraySmarty.php');
require_once 'HTML/QuickForm/Renderer/Tableless.php';

// Register the fckeditor form element type with the QuickForm object.
HTML_Quickform::registerElementType('fckeditor', 'HTML_Quickform_fckeditor.php', 'HTML_Quickform_fckeditor');
HTML_Quickform::registerElementType('tinymce', 'HTML_Quickform_tinymce.php', 'HTML_Quickform_tinymce');
HTML_Quickform::registerElementType('swfchart', 'HTML_Quickform_swfchart.php', 'HTML_Quickform_swfchart');
HTML_Quickform::registerElementType('dbimage', 'HTML_Quickform_dbimage.php', 'HTML_Quickform_dbimage');

/**
 * Create object oriented Forms
 * 
 * This is just a wrapper for the PEAR Quickform package. It simplifies syntax as well as registers custom form element
 * types, such as FCKeditor.
 *
 * @package CMS
 * @subpackage Core
 */
class Form extends HTML_QuickForm {
	
	private $processed = false;
	function setProcessed() {$this->processed = true;}
	function isProcessed() {return $this->processed;}
	
	public function display() {
		$renderer =& new HTML_QuickForm_Renderer_Tableless();
		$this->accept($renderer);
		$this->removeAttribute('name');
		
		return $renderer->toHtml();
	}
	
	public static function statusArray() {
		return array(1 => 'Active', 0 => 'Inactive');
	}
	
	public static function booleanArray() {
		return array(1 => 'Yes', 0 => 'No');
	}
	
	public static function getStatesArray($onlyOneCountry = "") {
		//If the parameter $onlyOneCountry is set, that means that we want to have all the states/provinces that belong to this particular country
		//Otherwise, return all the states/provinces in the table
		$sql = 'select states.id, states.name from states';
		if ($onlyOneCountry)
			$sql .= " left join countries on states.country=countries.id where countries.name like '$onlyOneCountry'";
		$r = Database::singleton()->query_fetch_all($sql);
		
		$array = array();
		foreach ($r as &$state) {
			$array[$state['id']] = $state['name'];
		}
		return $array;
	}
	
	public static function getCountryArray(){
		$sql = 'select id, name, codetwo, codethree, currency from countries';
		$r = Database::singleton()->query_fetch_all($sql);
		
		$array = array();
		foreach ($r as &$country) {
			$array[$country['id']] = $country['name'];
		}
		return $array;
	}
	
}

?>
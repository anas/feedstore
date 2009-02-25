<?php
/**
 * SiteConfig
 * @author David Wolfe <wolfe@norex.ca>
 * @package CMS
 * @version 1.0
 */

/** 
 * Stores configuration options for a client.
 * 
 * SiteConfig options can be accessed by name (if unique) or by module/name pair.  Each option 
 * can optionally be configurable be the site administrator(s).  If an admin configurable option
 * is multi-valued (a list) then the list should be comma separated for consistency.  
 * @package CMS
 * @subpackage Core
 */

/* SEE ../SiteConfig.php FOR MODULE USAGE INFORMATION */

// var_log ($_SESSION);

require_once "SiteConfigType.php";
class SiteConfig {
	/* Columns from db */
	protected $id = null;
	protected $module = null;
	protected $name = null;
	protected $description = null;
	protected $type = null;
	protected $value = null;
	protected $sort = null;
	protected $editable = null;

	public function __construct( $id = null ) {
		if (!is_null($id)) {
			if (is_array ($id)) {
				$result = $id;
			} else {
				$sql = 'select * from config_options where id=' . $id;
				if (!$result = Database::singleton()->query_fetch($sql)) {
					return false;
				}
			}
			$this->setId($result['id']);
			$this->setModule($result['module']);
			$this->setName($result['name']);
			$this->setDescription($result['description']);
			$this->setType($result['type']);
			$this->setValue($result['value']);
			$this->setSort($result['sort']);
			$this->setEditable($result['editable']);
		} else {
			$this->setModule(NULL);
			$this->setName('');
			$this->setDescription('');
			$this->setType('string');
			$this->setValue('');
			$this->setSort(NULL);
			$this->setEditable(0);
		}
	}
	
	public function getType() {
		return SiteConfigType::getType($this);
	}

	/**
	 * The raw type name, without the specification in the case of enum.
	 */
	
	public function getTypeName() {
		preg_match('/^[a-z]+/', $this->getRawType(), $matches);
		return $matches[0];
	}
	
	public function displayString() {
		return SiteConfigType::getDisplayString($this);		
	}
	
	public function getValue() {
		return SiteConfigType::getValue($this);
	}
	
	private static function locate($name) {
		if (preg_match ('/(.*)::(.*)/', $name, $matches)) {
			$module = $matches[1];
			$name = $matches[2];
			$m = 'module="' . $module . '"';
		} else {
			$m = 'module is NULL';
			$module = NULL;
		}
		$sql = 'select `id` from config_options where name="' . $name . '" and ' . $m;
		$id = Database::singleton()->query_fetch($sql);
		$id = $id['id'];
		if ($id == NULL) {
			$m = is_null($module) ? "" : $module . '::';
			error_log ('SiteConfig failed to locate name "' . $m . $name . '"');
			return null;
		}
		return $id;
	}
	
	public static function get($name) {
		$id = SiteConfig::locate ($name);
		$siteConfig = new SiteConfig ($id);
		return $siteConfig->getValue();
	}

	public static function set($name, $value) {
		$id = SiteConfig::locate ($name);
		$siteConfig = new SiteConfig ($id);
		SiteConfigType::setValue($siteConfig, $value);
		$siteConfig->save();
	}

	public function getId() {return $this->id;}
	public function getModule() {return $this->module;}

	public function getName($qualified = false) {
		if ($qualified && $this->module)
			return $this->module . '::' . $this->name;
			else return $this->name;
	}
	
	public function getDescription() {return $this->description;}
	public function getRawType() {
		return $this->type;
	}

	public function getRawValue() {
		return $this->value;
	}

	public function getSort() {return $this->sort;}
	public function getEditable() {return $this->editable;}
	public function setId( $id ) {$this->id = $id;}

	public function setModule( $module ) {
		if (!$module) $module = NULL;
		$this->module = $module;
	}

	public function setName( $name ) {$this->name = $name;}
	public function setDescription( $description ) {$this->description = $description;}
	public function setType( $type ) {$this->type = $type;}
	public function setValue( $value ) {$this->value = $value;}
	public function setSort( $sort ) {$this->sort = $sort;}
	public function setEditable( $editable ) {$this->editable = $editable;}

	private function sql ($column, $value) {
		return is_null ($value) ? '' : '`' . $column . '`="' . e($value) . '", ';
	}
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update config_options set ';
		} else {
			$sql = 'insert into config_options set ';
		}
		$m = $this->getModule();
		$sql .= '`module`=' . ($m ? '"' . e($m) . '"' : 'NULL') . ', ';
		$sql .= $this->sql('name', $this->getName());
		$sql .= $this->sql('description', $this->getDescription());
		$sql .= $this->sql('type', $this->getRawType());
		$sql .= $this->sql('value', $this->getRawValue());
		$sql .= $this->sql('sort', $this->getSort());
		$sql .= $this->sql('editable', $this->getEditable());
		$sql = trim($sql, ', ');
		if (!is_null($this->getId())) {
			$sql .= ' where id="' . e($this->getId()) . '"';
		}
		Database::singleton()->query($sql);
		if (is_null($this->getId())) {
			$this->setId(Database::singleton()->lastInsertedID());
			self::__construct($this->getId());
		}
	}

	public function delete() {
		$sql = 'delete from config_options where id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	public function getAddEditForm($target = '/admin/SiteConfig') {
		$form = new Form('SiteConfig_addedit', 'post', $target);
		
		$form->setConstants( array ( 'action' => 'addedit', 'NOREX' => NOREX  ) );
		$form->addElement( 'hidden', 'action' );
		if (NOREX) {$form->addElement('hidden', 'NOREX');}
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'siteconfig_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'siteconfig_id' );
			// $defaultValues ['siteconfig_value'] = $this->getRawValue();
			// $form->setDefaults( $defaultValues );
		} else {
			if (!NOREX) {
				error_log ("Attempt was made to create a new config option.");
				die();
			}
		}
		if (!NOREX) {
			$form->addElement('html', 'siteconfig_description', 'Description')->setValue($this->getDescription());
			SiteConfigType::setFormField($form, $this);
		} else {
			$form->addElement('html', 'Types are: ' . SiteConfigType::getTypeList() . '.<br/>An example of enum is "enum(yes, no, maybe)".'		);
			$form->addElement('text', 'siteconfig_module', 'Module')->setValue($this->getModule());
			$form->addElement('text', 'siteconfig_name', 'Name')->setValue($this->getName());
			$form->addElement('text', 'siteconfig_description', 'Description')->setValue($this->getDescription());
			$form->addElement('text', 'siteconfig_type', 'Type')->setValue($this->getRawType());
			$form->addElement('text', 'siteconfig_sort', 'Sort')->setValue($this->getSort());
			SiteConfigType::setFormField($form, $this);
		}
		$form->getElement('siteconfig_value')->setValue(SiteConfigType::getDisplayString($this));
		$form->addElement('submit', 'siteconfig_submit', 'Submit');
		if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['siteconfig_submit'])) {
			if (NOREX) {
				$this->setModule($form->exportValue('siteconfig_module'));
				$this->setName($form->exportValue('siteconfig_name'));
				$this->setDescription($form->exportValue('siteconfig_description'));
				$this->setType($form->exportValue('siteconfig_type'));
				$this->setSort($form->exportValue('siteconfig_sort'));
			}
			$this->setValue($form->exportValue('siteconfig_value'));
			$this->save();
		}
		return $form;
		
	}
	
	/** 
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllSiteConfigs() {
		$sql = 'select * from config_options ' . (NOREX ? '' : 'where editable="1" ') . 'order by module, sort, name';
		$results = Database::singleton()->query_fetch_all($sql);
		foreach ($results as &$result) {
			$result = new SiteConfig($result);
		}
		return $results; 
	}
}
?>

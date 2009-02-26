<?
/* NOTE:  Class must be initialized by calling the static init() method. */

/*
 * TODO:
 * cache results of all loads
 * allow for default values for types
 */

/* DANGER: SPECIAL FUNCTIONS LIKE __serialize ARE INTERCEPTED BY __call. */
define ('DUMMY_INIT_ROW', -1);

function underscore2uccamel($text) { // 'menu_item' => 'MenuItem'
	return implode (array_map ('ucfirst', explode ('_', $text)));
}

abstract class DBRow {
	protected static $tables = array();
	private $values = array();
	function createTable($table, $class, $customColumns = array()) {
		$cols = $customColumns;
		$columns = array();
		$done = array();
		foreach ($cols as $col) {
			$done[$col->name()] = true;
		}
		foreach ($columns as $col) {
			$name = $col->get('name');
			if (isset($done[$name])) {
				 error_log ("Warning: column $name is specified twice; check both in $class.php and in dbtable");
			} else {
				$cols[] = DBColumn::make ($col->get('type'), $name, $col->get('label'),
										  null, $col->get('modifier'));
				$done[$name] = true;
			}
		}
		$result = new DBTable($table, $class, $cols);
		return $result;
	}
	static function init($class) {
		if (!isset (self::$tables[$class])) {
			$dummy = new $class(DUMMY_INIT_ROW);
			self::$tables[$class] = $dummy->createTable();
		}
	}
	function table() {return self::$tables[get_class($this)];}
	function column($name) {return $this->table()->column($name);} 
	function columns() {return $this->table()->columns();}
	function quickformPrefix() {return call_user_func(array(get_class($this), 'getQuickFormPrefix'));}
	static function getQuickFormPrefix(){return "";}
	
	static function make($class, $id) {
		if ($id === null || $id === DUMMY_INIT_ROW) return new $class($id);
		$table = self::$tables[$class]; 
		$result = $table->getCache($id);
		if ($result) return $result;
		$result = new $class ($id);
		$table->setCache($id, $result);
		return $result;
	}
	
	function __construct($id = null) {
		if ($id === DUMMY_INIT_ROW) {return;}
		if (is_array ($id)) {
			$result = $id;
		} else if (is_null($id)) {
			$result = array();
		} else {
			$result = &$this->table()->fetchRow($id);
		}
		if ($result) {
			foreach ($result as $key => $value) {
				$column = @$this->column($key);
				if (!$column) {
					error_log ("Ignoring column ". $key);
					continue;
				}
				$this->set($key, $column->fromDB($value));
 			}
		}
		foreach ($this->columns() as $column) {
			$key = $column->name();
			if (!isset($this->values[$key])) $this->values[$key] = null; // TODO: SET TO DEFAULT VALUE
		}
	}
	
	function __call($name, $args) {
		$getset = $this->camel2getset ($name);
		switch ($getset[0]) {
			case 'get': return $this->get($getset[1]);
			case 'set': return $this->set($getset[1], $args[0]);
			default:
				$trace = debug_backtrace();
 				trigger_error(
					'Undefined property via __get(): ' . $name .
					' in ' . $trace[0]['file'] .
					' on line ' . $trace[0]['line'],
					E_USER_NOTICE);
				return null;
		}
	}
	function get($name) {
		$result = $this->values[$name];
		$column = @$this->column($name);
		if (is_null($result) && $column && $column->delayLoad() && $this->values['id']) {
			$result = $column->load($this->values['id']);
			$this->values[$name] = $result;
		}
		return $result;
	}
	function &set($name, $value) {
		if (isset($this->values[$name.'_id'])) { // Setting blah_id and blah
			$this->values[$name] = $value;
			$this->values[$name.'_id'] = $value->getId();
		} else if (substr($name, -3) === '_id') { // Setting blah_id and blah
			$column = $this->column ($name);
			$class = $column->type();
			$obj = new $class($value);
			$this->values[$name] = $value;
			$this->values[substr($name, 0, strlen($name)-3)] = $obj;
		} else {
			$this->values[$name] = $value;
		}
		return $this;
	}

	function &delete() {
		if (!$this->get('id')) return $this;
		$this->table()->deleteRow($this->get('id'));
		return $this;
	}
	
	public function &toggle() {
		if ($this->get('status') == 1) {
			$this->set('status', 0)->save();
		} else {
			$this->set('status', 1)->save();
		}
		return $this;
	}

	function &save() {
		// This version creates the query on a per-call basis.
		// This is useful if some entries of an object to "update" haven't been loaded.
		// TODO:  Implement a version that caches the prepared statement in other cases.
		$update = false;
		$sql = "";
		$types = '';
		$params = array();
		/* Build up sql prepared statement and type string in parallel */
		foreach ($this->columns() as $column) {
			$name = $column->name();
			$value = &$this->values[$name];
			if ($value === null) continue;
			if ($column->ignored()) continue;
			if ($name == 'id') {
				$update = $value ? $value : false;
			} else {
				$params[] = &$column->toDB($value);
				$sql .= " `$name`=?,";
				$types .= $column->prepareCode();
			}
		}
		$sql = trim ($sql, ',');
		$table = $this->table()->name();
		if (!$sql && $update !== false) {trigger_error ("NO DATA IN DBRow update, table=$table,", E_USER_NOTICE); return;}
		if ($sql) $sql = "set $sql";
		else $sql = "() values()";
		if ($update === false) {
			$sql = "insert into `$table` $sql";
			$query = new Query ($sql, $types);
			$id = $query->insert($params);
			$this->values['id'] = $id;
			return $id;
		} else {
			$sql = "update `$table` $sql where id=?";
			$params[] = $update;
			$types .= 'i';
			$query = new Query ($sql, $types);
			$query->query($params);
		}
		return $this;
	}

	function getAddEditFormHook($form) {}
	
	protected function getAddEditFormSaveHook($form) {}
	
	function getAddEditForm($target = null) {
		if (!$target){
			$target = '/admin/' . get_class($this);
		}
		$formName = get_class($this) . '_addedit';
		$els = array();
		
		$form = new Form($formName, 'post', $target);
		$form->setConstants (array ('action' => @$_REQUEST['action'], 'section' => @$_REQUEST['section']));
		$form->addElement ('hidden', 'action');
		$form->addElement ('hidden', 'section');
		
		foreach ($this->columns() as $column) {
			if ($column->noForm()) continue;
			$name = $column->name();
			$value = &$this->get($name);
			$id = $this->quickformPrefix() . $name;
			$formValue = $column->toForm($value);
			if ($column->hidden()) {
				$el = $form->addElement("hidden", $id);
				$el->setValue ($formValue);
			} else {
				$el = $column->addElementTo(array(
						'form' => $form,
						'id' => $id,
						'value' => $formValue));
			}
			if ($column->required()) {
				$form->addRule($id, "Please enter the " . $column->label(), 'required', null, 'client');
			}
			$els[$name] = $el;
		}
		$this->getAddEditFormHook($form);
		$form->addElement('submit', $this->quickformPrefix() . 'submit', 'Submit');
		if ($form->isSubmitted() && isset($_REQUEST[$this->quickformPrefix() . 'submit']) && $form->validate()) {
			$this->getAddEditFormSaveHook($form);
			foreach ($this->columns() as $column) {
				if ($column->noForm()) continue;
				$name = $column->name();
				$value = $form->exportValue($this->quickformPrefix() . $name);
				$this->set($name, $column->fromForm($value));
			}
			$this->save();
			$form->setProcessed();
		}
		return $form;
	}
	private static function camel2getset($text) {
		// camel2getset('getThisVar') => array('get', this_var);
		$initial = substr ($text, 0, 3);
		switch ($initial) {
			case "get":
			case "set":
				$text = substr ($text, 3);
				$text = ucfirst(preg_replace('/([a-z])([A-Z])/', '\1 \2', $text));
				return array ($initial, implode ('_', array_map ('strtolower', explode (' ', $text))));
			default: return null;
		}
	}
}

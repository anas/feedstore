<?php
/*
 * Suggested naming convention for new types:
 * lowerCaseCamel is a raw type, while UpperCaseCamel is a reference to an object.
 * So 'image' is a blob, while 'Image' is an id which references the Image table.
 */

class DBColumnText extends DBColumn {
	function type() {return "text";}
	function addElementTo ($args) {
		parent::addElementTo($args);
	}
}

class DBColumnTextarea extends DBColumnText {
	function type() {return "textarea";}
	function addElementTo($args) {
		$value = null;
		extract ($args);
		$label = $this->label();
		$el = $form->addElement ('textarea', $id, $label, $this->options());
		$el->setValue($value);
		return $el;
	}
	function suggestedMysql() {return "text";}
}

class DBColumnsLongText extends DBColumn {
	function type() {return 'longtext';}
	function prepareCode() {return 's';} // TODO: NOT SURE YET "b" or "s" ??
	function delayLoad() {return true;}
	function suggestedMysql() {return "longtext";}
}

class DBColumnInteger extends DBColumn {
	function type() {return 'integer';}
	function prepareCode() {return 'i';}
	function addElementTo ($args) {
		$value = 0;
		$label = $this->label();
		extract ($args);
		$el = $form->addElement ('text', $id, $label);
		$el->setValue($value);
		$form->addRule($id, 'Integer required', 'integer', null, 'client');
		return $el;
	}
	function suggestedMysql() {return "int(11)";}
}

class DBColumnFloat extends DBColumnText {
	function type() {return 'float';}
	function prepareCode() {return 'd';}
	function addElementTo ($args) {
		$value = 0;
		$label = $this->label();
		extract ($args);
		$el = $form->addElement ('text', $id, $label);
		$value = round($value,2);
		$value = number_format($value, 2);
		$el->setValue($value);
		$form->addRule($id, 'Number required', 'numeric', null, 'client');
		return $el;
	}
	function suggestedMysql() {return "float(11,2)";}
}

class DBColumnEmail extends DBColumnText {
	function type() {return "email";}
	function addElementTo ($args) {
		parent::addElementTo($args);
		extract($args);
		$form->addRule($id, 'Please enter a valid e-mail address', 'email', null, 'client');
	}
	function suggestedMysql() {return "tinytext";}
}

class DBColumnStatus extends DBColumnText {
	function type() {return "status";}
	function addElementTo ($args) {
		$value = 0;
		$label = $this->label();
		extract($args);
		$el = $form->addElement ('checkbox', $id, $label);
		$el->setValue($value);
		return $el;
	}
	function suggestedMysql() {return "tinytext";}
	
	public function __toString($item, $key) {
		$html = '<form action="/admin/' . $_REQUEST['module'] . '" method="post" onsubmit="return !formSubmit(this);" style="float: left;">
					<input type="hidden" name="section" value="' . get_class($item) . '" />
					<input type="hidden" name="action" value="toggle" />
					<input type="hidden" name="' . $item->quickformPrefix() . 'id" value="' . $item->get('id') . '" />';
		if (isset($_REQUEST['pageID'])) $html .= '<input type="hidden" name="pageID" value="' . $_REQUEST['pageID'] . '" />';
		if ($item->get($key)) {
			$html .= '<input type="image" src="/images/admin/tick.png" />';
		} else {
			$html .= '<input type="image" src="/images/admin/cross.png" />';
		}
		$html .=  '</form>';
		return $html;
	}
}

class DBColumnCheckbox extends DBColumnInteger {
	function type() {return "checkbox";}
	function addElementTo ($args) {
		$value = 0;
		$label = $this->label();
		extract($args);
		$el = $form->addElement ('checkbox', $id, $label);
		$el->setValue($value);
		return $el;
	}
	function toDB($obj) {return $obj ? 1 : 0;}
	function fromDB($obj) {return !!$obj;}
	
	function toForm($obj) {return $obj ? 1 : 0;}
	// checkboxes appear to return '1' (checked) or true (not checked) !!
	function fromForm($obj) {return '1' === $obj;}
	function suggestedMysql() {return "tinyint(1)";}
}

class DBColumnId extends DBColumnInteger {
	function type() {return "id";}
	function addElementTo($args) {
		$value = null;
		extract ($args);
		$el = $form->addElement ('hidden', $id);
		$el->setValue($value);
		return $el;
	}
	function suggestedMysql() {return "int(10) unsigned";}
}

class DBColumnTinyMCE extends DBColumnsLongText {
	function type() {return "tinymce";}
	function addElementTo($args) {
		$value = null;
		extract ($args);
		$label = $this->label();
		$el = $form->addElement ('tinymce', $id, $label);
		$el->setValue($value);
		return $el;
	}
	function suggestedMysql() {return "text";}
}

class DBColumnSelect extends DBColumnText {
	function type() {return "select";}
	
	function addElementTo($args) {
		$value = null;
		$label = $this->label();
		extract ($args);

		$el = $form->addElement ('select', $id, $label, $this->options());
		$el->setValue($value);
		return $el;
	}
	function suggestedMysql() {return "tinytext";}
}

class DBColumnTimestamp extends DBColumnText {
	function type() {return "timestamp";}
	function toDB($obj) {$date = $obj ? $obj : new NDate(); return $date->get(MYSQL_TIMESTAMP);}
	function fromDB($obj) {return new NDate($obj);}
	function toForm($obj) {return $this->toDB($obj);}
	function fromForm($obj) {return $this->fromDB($obj);}
	function addElementTo ($args) {
		$value = null;
		extract ($args);
		$el = $form->addElement ('hidden', $id);
		$el->setValue($value);
		return $el;
	}
	function suggestedMysql() {return "timestamp";}
}
/*
class DBColumnEnum extends DBColumnSelect {
	function __construct($name, $label, $modifier, $options) {
		parent::__construct ($name, $label, $modifier, array_combine ($options, $options));
	}
	function type() {return "enum";}
	function suggestedMysql() {return "enum('" . implode("','", $this->options()) . "')";}
}
*/
class DBColumnHTML extends DBColumnText {
	function type() {return "html";}
	function ignored() {return true;}
	function addElementTo ($args) {
		$value = null;
		extract ($args);
		return $form->addElement ('html', $value);
	}
	function suggestedMysql() {return "";}
}

class DBColumnLatLon extends DBColumnText {
function type() {return "latlon";}
public function __toString($item,$key) {
		return '<a href="http://maps.google.ca/maps?f=q&hl=en&geocode=&q=' . urlencode($item->get($key)) . '">' . $item->get($key) . '</a>';
	}
}

class DBColumnCancel extends DBColumn {
	function type() {return "cancel";}	
	function ignored() {return true;}
	function addElementTo($args) {
		extract ($args);
		return $form->addElement('button','cancel','Cancel',array("onClick"=> "window.location.href='Monthly.php'"));
	}
}

class DBColumnURL extends DBColumnText {
	function type() {return 'url';}
	function addElementTo ($args) {
		$label = $this->label();
		extract($args);
		if (!@$value) $value = "http://";
		$el = $form->addElement ('text', $id, $label);
		$el->setValue($value);
		$chars = "a-z0-9_"; // Legal chars in the url
		$form->addRule($id, 'URL required, e.g., http://www.norex.ca', 'regex', "!http(s)?://[$chars]+!", 'client');
		return $el;
	}
}



/* ----------------------------- PUT NEW CLASSES ABOVE THIS LINE! ---------------------- */
DBColumn::registerClasses();
/* ------------------------------------------------------------------------------------- */


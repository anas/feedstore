<?php
include_once "../include/db-config.php";

class Query {
	protected $stmt;
	private $obj, $types, $params = array(null, null), $args = null;
	private $preparedStmt;
	private $link;
	private static $thelink;
	
	/*
	 * Sample usage:
	 * $query  = new Query("select * from table where a=? and b=?", "si");
	 * $row = $query->fetch("this", 5); // OR
	 * $row = $query->fetch(array("this", 5));
	 * 
	 * $query->fetch() returns the first matching row
	 * $query->fetchAll() returns all matching rows
	 * $query->query() is used for deletes or updates
	 * $query->insert() returns the last inserted id 
	 */
	
	
	function __construct($preparedStmt) {
		if (!self::$thelink) {
		    self::$thelink = Database::singleton()->link;
		}
		$this->preparedStmt = $preparedStmt;
		if (func_num_args() == 1) $this->types = ''; else $this->types = func_get_arg(1);
		// OLD CONSTRUCTOR USED TO ACCEPT A SECOND ARUGUMENT WHICH IS AN OBJECT TO POPULATE.
		// if (func_num_args() == 2) $this->obj = new stdClass; else $this->obj = func_get_arg(2);
	}
	
	private function init($args = null) {
		if ((count($args) == 1) && is_array ($args[0])) {
			$args = $args[0];
		}
		if (count ($args) > 0) {
			for ($i = 0; $i < count($args); $i++) {
				$this->params[$i+2] = $args[$i];
			}
		}
		if (!$this->stmt) {
			$this->link = self::$thelink;
			$this->stmt = $this->link->prepare($this->preparedStmt);
			$this->checkError ($this->link, "Initializing stmt");
		}
		$this->bindParams(); // TODO: SHOULD BE ABLE TO DO THIS ONCE ONLY, RATHER THAN FOR EACH REQUEST?!
	}
	
	private function checkError ($mysqli, $message) {
		$error = $mysqli->error;
		$pstmt = $this->preparedStmt;
		if ($error) error_log ("(Query.php $pstmt) $message: $error");
	}

	

	function query() {
		$this->init(func_get_args());
		$this->_query();
		$this->stmt->free_result();
	}

	function fetch () {
		$this->init(func_get_args());
		$this->_query();
		$result = $this->_fetch();
		$this->stmt->free_result();
		
		return $result;	
	}

	function fetchAll() {
		$this->init(func_get_args());
		$this->_query();
		$results = $this->_fetch_all();
		$this->stmt->free_result();
		return $results;
	}

	function insert() {
		$this->init(func_get_args());
		$this->_query();
		return $this->link->insert_id;
	}

	private function bindResultArray () {
		$data = $this->stmt->result_metadata();
		$fields = array();
		$this->result = array();
		
		$fields = array(&$this->stmt);

		if ($data) {
			while($field = mysqli_fetch_field($data)) {
				$fields[] = &$this->result[$field->name];
			}
			$data->close();
		}
		if (count($fields) == 1) return; // NO RESULT -- PROBABLY A DELETE
		call_user_func_array('mysqli_stmt_bind_result', $fields);
	}

	private function bindParams() {
		$this->params[0] = $this->stmt;
		$this->params[1] = $this->types;
		call_user_func_array('mysqli_stmt_bind_param', $this->params);
		$this->checkError ($this->stmt, "Binding params");
	}
	
	private function _query() {
		$this->stmt->execute();
		$error = $this->stmt->error;
		$this->checkError ($this->stmt, "Executing stmt");
		$this->bindResultArray();
	}

	private function _fetch() {
		if (!$this->stmt->fetch()) return false;
		$result = array();
		foreach ($this->result as $key => &$value) {
			$result[$key] = $value;
		}
		return $result;
	}

	private function _fetch_all() {
		$results = array();
		while ($result = $this->_fetch()) {
			$results[] = $result;
		}
		
		return $results;
	}
	/*
	function __destruct() {
		if ($this->stmt) {
			$this->stmt->close();
		}
	}
	*/
}
?>

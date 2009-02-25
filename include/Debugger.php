<?php
/**
 * Debugger
 * @author Anas Trabulsi <anas@norex.ca>
 * @version 2.0
 */

/**
 * DETAILED CLASS TITLE
 * The debugger class
 * 
 * DETAILED DESCRIPTION OF THE CLASS
 * This class allows the developer to track an error by giving him/her the history of methods' calls
 * when an error happens.
 * Also, the developer can include messages as well to be displayed in the log file
 */

/**
 * To do list:
 * 1. Write a method to send the log file to the user via email
 * 2. Catch the fatal errors, compile errors, and the syntax errors
 *
 */

	define("DEBUG_INSERT_SQL",3);
	define("DEBUG_UPDATE_SQL",3);
	define("DEBUG_DELETE_SQL",3);
	define("DEBUG_SELECT_SQL",4);
	define("DEBUG_CALL_METHOD",5);
	define("DEBUG_USER_DEBUG",2);
	define("DEBUG_STORE_IN_FILE",1);
	define("DEBUG_FILE_APPEND_WRITE",'w');
	define("DEBUG_DISPLAY_ERROR",0);
	define("DEBUG_SEND_EMAIL",0);
	define("DEBUG_ERROR_LOG", getenv("DOCUMENT_ROOT") . "/templates_c/log.html");
	class Debugger{
		private $messages;
		private $level;
		private $seperator;
		private static $staticObj;

		public static function instance(){
			if (!isset(self::$staticObj)){
				$className = __CLASS__;
				self::$staticObj = new $className;
			}
			return self::$staticObj;
		}

		private function __construct(){
			$fp = fopen(DEBUG_ERROR_LOG, DEBUG_FILE_APPEND_WRITE);
			fclose($fp);
			$this->messages = null;
			$this->level = null;
			$this->seperator = "<br/>";
		}

		public function debug($msg, $level = DEBUG_USER_DEBUG){
			$count = count($this->messages);
			$this->messages[$count] = $msg;
			$this->level[$count] = $level;
		}
		
		function getMessages($level = -1){
			$result = "";
			for ($i = 0; $i < count($this->messages); $i++)
				if (($level == -1) || ($level >= $this->level[$i]))
					$result .= $this->level[$i] . ": " . $this->messages[$i] . $this->seperator;
			return $result;
		}

		function showDebug(){
			//var_dump(debug_backtrace());
			$debugVar = debug_backtrace();
			$traceVar = '';
			$traceVar .= "<div class=\"errRow\">";
			$traceVar .= "<span class=\"errNB\"><b>#</b></span>";
			$traceVar .= "<span class=\"errFile\"><b>File</b></span>";
			$traceVar .= "<span class=\"errLine\"><b>Line</b></span>";
			$traceVar .= "<span class=\"errFunc\"><b>Function</b></span>";
			$traceVar .= "</div>";
			for ($i = 0; $i < count($debugVar); $i++){
				$oddEven = ($i % 2 == 0 ? "debugEven":"debugOdd");
				$traceVar .= "<div class=\"errRow $oddEven\">";
				$traceVar .= "<span class=\"errNB\">&nbsp;" . (count($debugVar) - $i) . "</span>";
				$traceVar .= "<span class=\"errFile\">&nbsp;" . @$debugVar[$i]["file"] . "</span>";
				$traceVar .= "<span class=\"errLine\">&nbsp;" . @$debugVar[$i]["line"] . "</span>";
				$traceVar .= "<span class=\"errFunc\">&nbsp;" . $debugVar[$i]["function"] . "</span>";
				$traceVar .= "</div>";
			}
			return $traceVar;
		}
		
		function getHTTPRequest(){
			global $REQUEST_URI, $HTTP_GET_VARS, $HTTP_POST_VARS, $SERVER_ADDR, $SERVER_NAME;
			global $SERVER_SOFTWARE, $SERVER_PROTOCOL;

			$requestURL  = $_SERVER['REQUEST_URI'] . "<br>";
			$requestURL .= "Server: " . $_SERVER['SERVER_ADDR'];
			$requestURL .= ", " . $_SERVER['SERVER_NAME'];
			$requestURL .= ", " . $_SERVER['SERVER_PROTOCOL'] . "<br/>";
			$requestURL .= $_SERVER['SERVER_SOFTWARE'] . "<br>";
			$requestURL .= "<br>";
			$i = 0;
			while (list($key, $value) = @each($HTTP_GET_VARS)){
				$oddEven = ($i % 2 == 0 ? "debugEven":"debugOdd");
				$requestURL .= "<div class=\"HTTPRow $oddEven\">";
				$requestURL .= "<span class=\"HTTPVar\">$key</span>";
				$requestURL .= "<span class=\"HTTPVar\">$value</span>";
				$requestURL .= "</div>";
				$i++;
			}
			while (list($key, $value) = @each($HTTP_POST_VARS)){
				$oddEven = ($i % 2 == 0 ? "debugEven":"debugOdd");
				$requestURL .= "<div class=\"HTTPRow $oddEven\">";
				$requestURL .= "<span class=\"HTTPVar\">$key</span>";
				$requestURL .= "<span class=\"HTTPVar\">$value</span>";
				$requestURL .= "</div>";
				$i++;
			}
			return $requestURL;

		}

		function getSession(){
			global $_SESSION;
			if (!is_array($_SESSION))
				return "";
			$mySession = "";
			//Get the values from PHP's session
			$i = 9;
			while (list($key, $value) = each($_SESSION)){
				$oddEven = ($i % 2 == 0 ? "debugEven":"debugOdd");
				$mySession .= "<div class=\"HTTPRow $oddEven\">";
				$mySession .= "<span class=\"HTTPVar\">$key</span>";
				$mySession .= "<span class=\"HTTPVar\">$value</span>";
				$mySession .= "</div>";
				$i++;
			}
			return $mySession;
		}

		function errorHandler($errno, $errmsg, $filename, $linenum, $vars){
			$errortype = array (
				E_ERROR				=> 'Error',
				E_WARNING			=> 'Warning',
				E_PARSE				=> 'Parsing Error',
				E_NOTICE			=> 'Notice',
				E_CORE_ERROR		=> 'Core Error',
				E_CORE_WARNING		=> 'Core Warning',
				E_COMPILE_ERROR		=> 'Compile Error',
				E_COMPILE_WARNING	=> 'Compile Warning',
				E_USER_ERROR		=> 'User Error',
				E_USER_WARNING		=> 'User Warning',
				E_USER_NOTICE		=> 'User Notice',
				E_STRICT			=> 'Runtime Notice',
				E_RECOVERABLE_ERROR	=> 'Catchable Fatal Error'
			);
			$err = "";
			$err .= '<link href="/css/debug.css" rel="stylesheet" />';
			$err .= "<h1>" . $errortype[$errno] . " ($errno), " . date("Y-m-d H:i:s (T)") . "<br>" . $errmsg . "\n<br/>$filename (Line: $linenum)</h1><hr>";
			$err .= "<h3>Debug:</h3>" . $this->showDebug() . "<hr>";
			$err .= "<h3>Requests:</h3>" . $this->getHTTPRequest() . "<hr>";
			$err .= "<h3>Messages:</h3>" . $this->getMessages() . "<hr>";
			$err .= "<h3>Session:</h3>" . $this->getSession() . "<hr>";
			$err .= "<br><br>";
			
			if (DEBUG_STORE_IN_FILE){//Store the error message in the log file
				$fp = fopen(DEBUG_ERROR_LOG, "a");
				fwrite($fp, $err);
				fclose($fp);
			}
			
			if (DEBUG_DISPLAY_ERROR)//Display the error message
				echo $err;
			
			if (DEBUG_SEND_EMAIL){//Send the error message by email
				//Send me an email when an error happens
				//if ($errno == E_USER_ERROR)
				//	mail("phpdev@example.com", "Critical User Error", $err);
			}
			//exit;
			return false;
		}
	}
?>
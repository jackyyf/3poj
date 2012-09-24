<?php

class ErrorLog {
	private function __construct(){
	}

	private static $debug = 0;
	// If debug is set to 1, the program will output all error message to the page.
	// If debug is set to 0, the program will not generate error message.
	private static $lastError = array();
	private static $filehandle = NULL;
	private static $tid = 0;

	const DEBUG = 1;
	const NOTICE = 2;
	const WARNING = 4;
	const ERROR = 8;

	public static function setDebug($debug){
		self::$debug = $debug ? 1 : 0;
	}

	public static function lastError(){
		if(empty(self::$lastError)){
			return array(
				"errno" => 0,
				"errstr" => "No Error Found."
			);
		}
		return self::$lastError;
	}

	public static function log($errstr, $level){
		global $settings;
		if(!self::$filehandle){
			self::$filehandle = fopen($settings['errlog'], 'ab');
			self::$tid = crc32(microtime());
			fwrite(self::$filehandle, "[DEBUG]{self::$tid} | Thread {self::$tid} started.\n");
		}
		$lev = $level == self::DEBUG ? "DEBUG" : $level == self::NOTICE ? "NOTICE" : $level == self::WARNING ? "WARNING" : "ERROR";
		if(self::$debug){
			echo "<br /><b>Debug Info:</b>Message: {$errstr}, Level: {$lev}<br />";
		}
		fwrite(self::$filehandle, "[{$lev}]{self::$tid} | {$errstr}\n");
	}
}
?>

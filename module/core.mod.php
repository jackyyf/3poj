<?php

// PJudge Core, main process.

if(!defined("_IN_3POJ"))die();

class Core {
	
	public static $args;
	
	private function __construct(){
	}
	
	public static function init(){
		// Process Request URI
		$uri = $_SERVER['REQUEST_URI'];
		self::$args = explode("/", $uri);
		unset(self::$args[0]);
	}
	
	public static function run(){
		global $settings;
		if(self::$args[1] != ""){
			$action = self::$args[1];
		} else {
			$action = "index" ;
		}
	}
}

?>

<?php

if(!defined("_IN_3POJ")) die();

class Session {
	
	private static $prefix;
	private static $timeout;
	
	private function __construct() {	
	}
	
	public static function init(){
		global $settings;
		self::$timeout = $settings['session']["expire"];
		self::$prefix = $settings['session']["prefix"];
		if(isset($_COOKIE[self::$prefix . "sid"]))session_id($_COOKIE[self::$prefix . "sid"]);
		session_cache_expire(self::$timeout);
		session_start();
		setcookie(self::$prefix . "sid", session_id(), time() + self::$timeout * 60, "/");
		return true;
	}
	
	public static function get($arg){
		if(!isset($_SESSION[self::$prefix . $arg]))return NULL;
		return $_SESSION[self::$prefix . $arg];
	}
	
	public static function set($arg, $val){
		$_SESSION[self::$prefix . $arg] = $val;
		return true;
	}
}
?>
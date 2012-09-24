<?php

if(!defined("_IN_3POJ")) die();

class Event {
	
	private static $event;
	
	private function __construct(){
		
	}
	
	public static function init(){
		$event = array();
	}
	
	public static function addEvent($eventName){
		if(isset(self::$event[$eventName]))return false;
		self::$event[$eventName] = array();
		return true;
	}
	
	public static function addHook($eventName, $func){
		if(!isset(self::$event[$eventName]))return false;
		self::$event[$eventName][] = $func;
		return $func;
	}
	
	public static function triggerEvent($arg){
		if(!isset(self::$event[$arg]))return false;
		foreach(self::$event[$arg] as $call){
			$call();
		}
		return;
	}
}

?>
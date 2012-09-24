<?php

if(!defined("_IN_3POJ")) die();

function exsafe_check(){
	global $settings;
	if(!isset($_COOKIE['exsafe_hash'])){
		header("HTTP/1.1 302 Found");
		header("Location: /");
		die();
	}
	if(Session::get('exsafe_hash') != $_COOKIE['exsafe_hash']){ // Attack Found
		header("HTTP/1.1 403 Forbidden");
		die();
	}
	$hash = md5(microtime());
	setcookie('exsafe_hash', $hash, time() + $settings -> session["expire"] * 60, "/", $_SERVER['HTTP_HOST'], false ,true);
	Session::set('exsafe_hash', $hash);
}

Event::addHook("onlogin", "exsafe_check");
Event::addHook("onsubmit", "exsafe_check");
Event::addHook("onregister", "exsafe_check");

?>
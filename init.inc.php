<?php

require_once("./conf.inc.php");
if(!defined("_IN_3POJ"))die();

// System Initializing

define ("SNARTY_DIR", $settings['template_dir']."/");

require_once($settings['misc_dir'] . "/misc.func.php");
require_once($settings['misc_dir'] . "/hash.func.php");
require_once($settings['module_dir'] . "/errorlog.mod.php");
require_once($settings['class_dir'] . "/mysql.class.php");
require_once($settings['module_dir'] . "/user.mod.php");
require_once($settings['module_dir'] . "/judge.mod.php");
require_once($settings['module_dir'] . "/problem.mod.php");
require_once($settings['module_dir'] . "/event.mod.php");
//require_once($settings['module_dir'] . "/core.mod.php");
require_once($settings['module_dir'] . "/session.mod.php");
require_once($settings['template_dir'] . "/Smarty.class.php"); // Smarty Template Engine, LGPL

$smarty = new Smarty();
$smarty -> template_dir = $settings['resource_dir'] . "/tpl/";
$smarty -> compile_dir = $settings['cache_dir'] . "/compiled/";
$smarty -> config_dir = $settings['root_dir'] . "/config/";
$smarty -> cache_dir = $settings['cache_dir'] . "/cached";

if(!$settings['debug']){
	error_reporting(0); // No Error Output When Not In Debug Mode
}

ErrorLog::setDebug($settings['debug']);
Event::init();
Problem::init();
Judge::init();
User::init();
//Core::init();

Event::addEvent("onload");
Event::addEvent("onlogin");
Event::addEvent("onsubmit");
Event::addEvent("onregister");
Event::addEvent("onloginform");
Event::addEvent("onsubmitform");
Event::addEvent("onregisterform");
Event::addEvent("htmlhead");
Event::addEvent("htmlbodyheader");
Event::addEvent("htmlbodyfooter");


// Load Extensions
// Only File with .ext.php file extension will be loaded.

$extensions = glob($settings['extension_dir'] . "/*.ext.php");
foreach($extensions as $extension){
	require_once($extension);
}

//Trigger Event Onload

Event::triggerEvent("onload");

//User::addUser("test", "meiyoumima", "root@jackyyf.cn", "CDQZ", "I'm not ADMIN!");
User::modifyUser(1, "meiyoumima", "meiyoumima", NULL, NULL, NULL);
 
?>

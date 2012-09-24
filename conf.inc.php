<?php

define ("_IN_3POJ", 1); // All Script Must Contain This Script.
define ("PROJECT_NAME", "3P Online Judge");
define ("PROJECT_VERSION", "0.1.0 Alpha1 Build0910");
define ("PROJECT_VERSION_SHORT", "0.1.0 Alpha");

// Constance Class
 
$settings = array();

// Config Settings

$settings['page_start_time'] = microtime();
$settings['debug'] = 1; //Debug Mode: 0 = Disable, 1 = Enable
$settings['mysql'] = 
	array(
		"host" => "localhost",
		"user" => "root",
		"pass" => "meiyoumima",
		"db" => "pjudge",
		"prefix" => "pj_",
		"characterset" => "utf8"
	);// MySQL Settings
$settings['session'] = 
	array(
		"expire" => 1440, // 24 Hour
		"prefix" => "pj_",
	); // Session Settings ( & Cookie)
$settings['root_dir'] = dirname(__FILE__); // System Root Directory
$settings['cache_dir'] = $settings['root_dir'] . "/cache";
$settings['resource_dir'] =  $settings['root_dir']. "/static"; // Static Resource (image, js, css, template, etc) Directory
$settings['extension_dir'] = $settings['root_dir']. "/extension"; // Extensions Directory
$settings['module_dir'] = $settings['root_dir']. "/module"; // Modules Directory
$settings['class_dir'] = $settings['root_dir']. "/class"; // Classes Directory
$settings['data_dir'] = $settings['root_dir']. "/data"; // Data Directory
$settings['misc_dir'] = $settings['root_dir']."/misc"; // Misc Directory
$settings['template_dir'] = $settings['root_dir'] . "/template"; //Template Engine Directory. Currently using Smarty 3.1.11
$settings['errlog'] = $settings['root_dir']. "/error.log"; //Error log
$settings['site_name'] = "3POJ Beta"; //Judge Name
$settings['status_code'] = // Modify also in judge.module 
	array(
		-2147483648 => "Contact Staff",
		-2 => "Pending",
		-1 => "Compile Error",
		0 => "Accepted",
		1 => "Wrong Answer",
		2 => "Runtime Error",
		3 => "CPU Limit Exceeded",
		4 => "Memory Limit Exceeded",
		5 => "Idleness Limit Exceeded",
		6 => "Multi-Error",
	);
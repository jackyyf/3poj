<?php
	require_once("./init.inc.php");
	$smarty -> assign("settings", $settings);
	$smarty -> assign("page", "home");
	$smarty -> display($settings['resource_dir'] . "/tpl/public.tpl");
?>
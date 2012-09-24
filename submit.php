<?php
	require_once("./init.inc.php");
	function problemCss(){
?>
		<link href="/static/css/submit.css" rel="stylesheet" type="text/css" />
<?php
	}
	Event::addHook("htmlhead", "problemCss");
	$id = isset($_GET['id']) && intval($_GET['id']) > 0 ? $_GET['id'] : "";
	$result = Problem::getTopProblem($count, $start);
	$smarty -> assign("id", $id);
	$smarty -> assign("settings", $settings);
	$smarty -> assign("page", "submit");
	$smarty -> display($settings['resource_dir'] . "/tpl/public.tpl");
?>
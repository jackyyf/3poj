<?php
	require_once("./init.inc.php");
	function problemCss(){
?>
		<link href="/static/css/problemset.css" rel="stylesheet" type="text/css" />
<?php
	}
	Event::addHook("htmlhead", "problemCss");
	$start = isset($_GET['start']) ? $_GET['start'] : 0;
	$count = isset($_GET['count']) ? $_GET['count'] : 30;
	$result = Problem::getTopProblem($count, $start);
	$smarty -> assign("result", $result);
	$smarty -> assign("settings", $settings);
	$smarty -> assign("page", "problem");
	$smarty -> display($settings['resource_dir'] . "/tpl/public.tpl");
?>
<?php
	require_once("./init.inc.php");
	function problemCss(){
?>
		<link href="/static/css/ranklist.css" rel="stylesheet" type="text/css" />
<?php
	}
	Event::addHook("htmlhead", "problemCss");
	$start = isset($_GET['start']) ? $_GET['start'] : 0;
	$count = isset($_GET['count']) ? $_GET['count'] : 30;
	$result = User::getTopUser($count, $start);
	$smarty -> assign("result", $result);
	$smarty -> assign("rank", $start);
	$smarty -> assign("settings", $settings);
	$smarty -> assign("page", "ranklist");
	$smarty -> display($settings['resource_dir'] . "/tpl/public.tpl");
?>
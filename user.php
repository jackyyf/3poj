<?php
	require_once("./init.inc.php");
	function problemCss(){
?>
		<link href="/static/css/userdata.css" rel="stylesheet" type="text/css" />
<?php
	}
	Event::addHook("htmlhead", "problemCss");
	if(!isset($_GET['id'])){
		header("HTTP/1.1 302 Found");
		header("Location: /");
	}
	$result = User::getUser($_GET['id']);
	if(!$result){
?>
<script language="JavaScript" type="text/javascript">
	window.alert("No such user!");
	window.location = '<?php echo $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "/" ?>';
</script>
<?php
	}
	$result['acceptid'] = explode('|', $result['acceptid']);
	$smarty -> assign("result", $result);
	$smarty -> assign("settings", $settings);
	$smarty -> assign("id", $_GET['id']);
	$smarty -> assign("page", "user");
	$smarty -> display($settings['resource_dir'] . "/tpl/public.tpl");
?>
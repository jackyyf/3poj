<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>{$settings.site_name} - Powered By 3POJ</title>
<link href="/static/css/base.css" rel="stylesheet" type="text/css" />
<link href="/static/css/{$page}.css" rel="stylesheet" type="text/css" />

{Event::triggerEvent("htmlhead")}

</head>

<body>
<div id="wrap">
<div id="topbar">
{if Session::get("login")}
<a href="/user/{Session::get("uid")}">{Session::get("uname")}</a>
<a href="/action.php?act=logout">Log out</a>
{else}
<a href="/login.php">Log in</a>|<a href="/register.php">Register</a>
{/if}
</div>
<div id="ribbon">

<h1 id="sitename">{$settings.site_name}</h1>
</div>
<div id="header">
<div id="topnav">
<ul>
<li><a href="/">Home</a></li>
<li><a href="/problem.php">Problemset</a></li>
<li><a href="/ranklist.php">Ranklist</a></li>
<!--<li><a href="/contest/">Contest</a></li>-->
<li><a href="/status.php">Status</a></li>
<li><a href="/about.php">About</a></li>
{Event::triggerEvent("htmlbodyheader")}
</ul>
</div>
</div>

{include file="$page.tpl"}

<div class="clear"></div>

</div>

<div id="footer">
<p>
<a href="#">Put</a> | <a href="#">Some</a> | <a href="#">Links</a> | <a href="#">Here</a>
{Event::triggerEvent("htmlbodyfooter")}
</p>
<p id="credits">
Powered by <a href="http://judge.cdqzoi.com/">3POJ</a>, Version {$smarty.const.PROJECT_VERSION} 
<a href="http://ramblingsoul.com" rel="external nofollow" title="Download High Quality CSS Layouts">CSS Theme</a>
</p>
</div></div>
</body>
</html>

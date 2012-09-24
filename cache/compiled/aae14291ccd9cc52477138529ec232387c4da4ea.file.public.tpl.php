<?php /* Smarty version Smarty-3.1.11, created on 2012-09-16 21:27:45
         compiled from "/home/www/static/tpl/public.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1969906125505048e416d9c7-59342364%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aae14291ccd9cc52477138529ec232387c4da4ea' => 
    array (
      0 => '/home/www/static/tpl/public.tpl',
      1 => 1347687938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1969906125505048e416d9c7-59342364',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_505048e42f8788_01259390',
  'variables' => 
  array (
    'settings' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_505048e42f8788_01259390')) {function content_505048e42f8788_01259390($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $_smarty_tpl->tpl_vars['settings']->value['site_name'];?>
 - Powered By 3POJ</title>
<link href="/static/css/base.css" rel="stylesheet" type="text/css" />
<link href="/static/css/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
.css" rel="stylesheet" type="text/css" />

<?php echo Event::triggerEvent("htmlhead");?>


</head>

<body>
<div id="wrap">
<div id="topbar">
<?php if (Session::get("login")){?>
<a href="/user/<?php echo Session::get("uid");?>
"><?php echo Session::get("uname");?>
</a>
<a href="/action.php?act=logout">Log out</a>
<?php }else{ ?>
<a href="/login.php">Log in</a>|<a href="/register.php">Register</a>
<?php }?>
</div>
<div id="ribbon">

<h1 id="sitename"><?php echo $_smarty_tpl->tpl_vars['settings']->value['site_name'];?>
</h1>
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
<?php echo Event::triggerEvent("htmlbodyheader");?>

</ul>
</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['page']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="clear"></div>

</div>

<div id="footer">
<p>
<a href="#">Put</a> | <a href="#">Some</a> | <a href="#">Links</a> | <a href="#">Here</a>
<?php echo Event::triggerEvent("htmlbodyfooter");?>

</p>
<p id="credits">
Powered by <a href="http://judge.cdqzoi.com/">3POJ</a>, Version <?php echo @PROJECT_VERSION;?>
 
<a href="http://ramblingsoul.com" rel="external nofollow" title="Download High Quality CSS Layouts">CSS Theme</a>
</p>
</div></div>
</body>
</html>
<?php }} ?>
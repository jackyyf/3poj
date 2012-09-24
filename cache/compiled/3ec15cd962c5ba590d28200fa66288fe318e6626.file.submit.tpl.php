<?php /* Smarty version Smarty-3.1.11, created on 2012-09-13 20:36:01
         compiled from "/home/www/static/tpl/submit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:773662465505185c4290c54-00646493%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ec15cd962c5ba590d28200fa66288fe318e6626' => 
    array (
      0 => '/home/www/static/tpl/submit.tpl',
      1 => 1347521359,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '773662465505185c4290c54-00646493',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_505185c42a8935_43143737',
  'variables' => 
  array (
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_505185c42a8935_43143737')) {function content_505185c42a8935_43143737($_smarty_tpl) {?><div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      	<h2>Submit</h2>
 		<form class="submitform" id="form1" method="post" action="action.php?act=submit">
        	<label for="id">Problem ID</label>
 		  	<input id="id" name="id" type="text" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" /> 	
            <br/> <br/>
 		    <label for="lang">Language</label>
 		    <select name="lang" id="lang">
 		    	<option value="C++">C++</option>
 		    	<option value="PAS">Pascal</option>
 		    	<option value="C">C</option>
 		    </select>
 		    <br/> <br/>
 		    <label for="code">Source Code</label> <br />
 		    <textarea name="code" id="source_code" cols="45" rows="5"></textarea>
            <br/><br/>
            <input type="submit" value="Submit" />
            
 		  </form>
    </div>
  <div class="clear"></div>

</div>
</div>
</div>

<div class="clear"></div>

</div><?php }} ?>
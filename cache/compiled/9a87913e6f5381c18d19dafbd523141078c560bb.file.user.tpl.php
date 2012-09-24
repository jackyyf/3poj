<?php /* Smarty version Smarty-3.1.11, created on 2012-09-17 15:35:21
         compiled from "/home/www/static/tpl/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:383426305505288c0d7df19-15998194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a87913e6f5381c18d19dafbd523141078c560bb' => 
    array (
      0 => '/home/www/static/tpl/user.tpl',
      1 => 1347687938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '383426305505288c0d7df19-15998194',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_505288c0df3876_56936913',
  'variables' => 
  array (
    'result' => 0,
    'pid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_505288c0df3876_56936913')) {function content_505288c0df3876_56936913($_smarty_tpl) {?><div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      	<h2><?php echo $_smarty_tpl->tpl_vars['result']->value['name'];?>
's INFO</h2>
        <p id="currentrank">Rank: <?php echo $_smarty_tpl->tpl_vars['result']->value['rank'];?>
</p>
        <div id="leftprofile">
        <p>School: <?php echo $_smarty_tpl->tpl_vars['result']->value['school'];?>
</p>
        <p>Email: <?php echo $_smarty_tpl->tpl_vars['result']->value['email'];?>
</p>
        <p>Motto: <?php echo $_smarty_tpl->tpl_vars['result']->value['motd'];?>
</p>
        </div>
        <div id="rightresults">
        <p>Problems solved: <b><?php echo $_smarty_tpl->tpl_vars['result']->value['accept'];?>
</b></p>
        <p>Total submissions: <?php echo $_smarty_tpl->tpl_vars['result']->value['submit'];?>
</p>
<!--
        <table id="summarytable">
        <tr class="ac">
        	<th>Accepted</th>
            <td></td>
        </tr>
        <tr class="wa">
        	<th>Wrong Answer</th>
            <td></td>
        </tr>
        <tr class="tle">
        	<th>Time Limit Exceed</th>
            <td></td>
        </tr>
        <tr class="mle">
        	<th>Memory Limit Exceed</th>
            <td></td>
        </tr>
        <tr class="re">
        	<th>Runtime Error</th>
            <td></td>
        </tr>
        <tr class="ce">
        	<th>Compile Error</th>
            <td></td>
        </tr>
        </table>
        </div>
-->
        <div id="solvedlist">
        <h3>List of solved problems:</h3>
        <?php  $_smarty_tpl->tpl_vars['pid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pid']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value['acceptid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['pid']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['pid']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['pid']->key => $_smarty_tpl->tpl_vars['pid']->value){
$_smarty_tpl->tpl_vars['pid']->_loop = true;
 $_smarty_tpl->tpl_vars['pid']->iteration++;
 $_smarty_tpl->tpl_vars['pid']->last = $_smarty_tpl->tpl_vars['pid']->iteration === $_smarty_tpl->tpl_vars['pid']->total;
?>
        	<?php if ($_smarty_tpl->tpl_vars['pid']->value===''){?><?php continue 1?><?php }?>
        	<a href="/problemdisplay.php?id=<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
</a>
        	<?php if (!$_smarty_tpl->tpl_vars['pid']->last){?>
        		<?php if (!($_smarty_tpl->tpl_vars['pid']->iteration % 10)){?>
	        		<br />
    	    	<?php }else{ ?>
        			|
        		<?php }?>
        	<?php }?>
        <?php } ?>
        </div>
    </div>
  <div class="clear"></div>

</div>
</div>
</div>

<div class="clear"></div>

</div><?php }} ?>
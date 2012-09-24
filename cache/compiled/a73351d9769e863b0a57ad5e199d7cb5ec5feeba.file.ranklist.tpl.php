<?php /* Smarty version Smarty-3.1.11, created on 2012-09-16 21:28:01
         compiled from "/home/www/static/tpl/ranklist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173946420250527e26960cc0-61411765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a73351d9769e863b0a57ad5e199d7cb5ec5feeba' => 
    array (
      0 => '/home/www/static/tpl/ranklist.tpl',
      1 => 1347687938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173946420250527e26960cc0-61411765',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50527e26abdd91_77457114',
  'variables' => 
  array (
    'result' => 0,
    'rank' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50527e26abdd91_77457114')) {function content_50527e26abdd91_77457114($_smarty_tpl) {?><div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      <h2>Ranklist</h2>
 	<div class="ranklist">
    	<table>
        	<tr>
            	<th>Rank</th>
            	<th>User</th>
                <th>Solved</th>
                <th>Submition</th>
        	</tr>
        	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
            <tr>
            	<?php $_smarty_tpl->tpl_vars['rank'] = new Smarty_variable($_smarty_tpl->tpl_vars['rank']->value+1, null, 0);?>
            	<td class="rank"><?php echo $_smarty_tpl->tpl_vars['rank']->value;?>
</td>
				<td class="userid"><a href="/user.php?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</a></td>
                <td class="usersolved"><?php echo $_smarty_tpl->tpl_vars['row']->value['accept'];?>
</td>
                <td class="usersolved"><?php echo $_smarty_tpl->tpl_vars['row']->value['submit'];?>
</td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>
  <div class="clear"></div>

</div>
</div>
</div>

<div class="clear"></div>

</div>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.11, created on 2012-09-16 21:27:53
         compiled from "/home/www/static/tpl/problem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1473596377505170758ec231-94562988%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76b19ae20cd9741e9d1bcdb450520caccd0e0057' => 
    array (
      0 => '/home/www/static/tpl/problem.tpl',
      1 => 1347687938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1473596377505170758ec231-94562988',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5051707593a3e4_65450408',
  'variables' => 
  array (
    'result' => 0,
    'cnt' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5051707593a3e4_65450408')) {function content_5051707593a3e4_65450408($_smarty_tpl) {?><div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      <h2>Problemset</h2>
 	<div class="problemlist">
    	<table>
        	<tr>
            	<th>ID</th>
                <th>Title</th>
                <th>Submit</th>
                <th>Accepted</th>
        	</tr>
        	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_smarty_tpl->tpl_vars['cnt'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['cnt']->value = $_smarty_tpl->tpl_vars['row']->key;
?>
            <tr class="alt<?php echo $_smarty_tpl->tpl_vars['cnt']->value%2+1;?>
">
            	<td class="probid"><?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
</td>
                <td><a href="/problemdisplay.php?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></td>
                <td class="usersolved"><?php echo $_smarty_tpl->tpl_vars['row']->value['submit'];?>
</td>
                <td class="usersolved"><?php echo $_smarty_tpl->tpl_vars['row']->value['accept'];?>
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
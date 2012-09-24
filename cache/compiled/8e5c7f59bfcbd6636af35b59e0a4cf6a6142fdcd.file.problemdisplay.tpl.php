<?php /* Smarty version Smarty-3.1.11, created on 2012-09-13 15:06:39
         compiled from "/home/www/static/tpl/problemdisplay.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165211597250518108538511-17184124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e5c7f59bfcbd6636af35b59e0a4cf6a6142fdcd' => 
    array (
      0 => '/home/www/static/tpl/problemdisplay.tpl',
      1 => 1347519989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165211597250518108538511-17184124',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5051810866d6b6_44609609',
  'variables' => 
  array (
    'result' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5051810866d6b6_44609609')) {function content_5051810866d6b6_44609609($_smarty_tpl) {?><div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      	<h2><?php echo $_smarty_tpl->tpl_vars['result']->value['title'];?>
</h2>
      	<div class="limit">
      		<span>Time limit: <?php echo $_smarty_tpl->tpl_vars['result']->value['cpulimit'];?>
 ms</span><br/>
      		<span>Memory Limit: <?php echo $_smarty_tpl->tpl_vars['result']->value['memlimit'];?>
 kb</span>
      	</div>
 	<div class="problem_description">
    	<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['result']->value['content'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

    </div>
    
    <div class="input_format">
    <h3>Input</h3>
  	<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['result']->value['input'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

    </div>
    <div class="output_format">
    <h3>Output</h3>
    <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['result']->value['output'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

    </div>
    <div class="note">
    <h3>Hint</h3>
    <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['result']->value['hint'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

    </div>
    
    </div>
  	<div class="clear"></div>

	<div class="sample">
    <table>
    <tr>
    	<th>Sample Input</th>
        <th>Sample Output</th>
    </tr>
    <tr>
    	<td><pre><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['result']->value['samplein'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</pre></td>
        <td><pre><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['result']->value['sampleout'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</pre></td>
    </tr>
    </table> <br/>
    </div>
</div>
</div>
</div>
<div id="sidebar">
<div class="container">

<h2 id="submit"><a href="/submit.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">Submit!</a></h2>

<h2>Problem Info</h2>
<div class="latestposts">
<ul class="shadow">
<li>Submissions: <?php echo $_smarty_tpl->tpl_vars['result']->value['submit'];?>
</li>
<li>user solved: <?php echo $_smarty_tpl->tpl_vars['result']->value['accept'];?>
</li>
</ul>
</div>

</div>
</div>

<div class="clear"></div>

</div><?php }} ?>
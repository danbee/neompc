<?php /* Smarty version 2.6.26, created on 2010-01-10 12:08:37
         compiled from default/playlist.html */ ?>
			<?php if ($this->_tpl_vars['playlist']): ?>
			<div id="buttons"><a href="<?php echo $this->_tpl_vars['playlist_clear_link']; ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/delall.gif" /></a></div>

			<ul class="list">
				<?php $_from = $this->_tpl_vars['playlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['playlist_item']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/playlist_item.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<?php else: ?>
			<p>(Empty playlist)</p>
			<?php endif; ?>

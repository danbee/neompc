<?php /* Smarty version 2.6.26, created on 2010-01-13 11:36:16
         compiled from default/menu.html */ ?>
		<div id="menu">
			<ul>
				<li><a <?php if ($this->_tpl_vars['page'] == 'browse'): ?>class="selected" <?php endif; ?>href="<?php echo $this->_tpl_vars['browse_link']; ?>
">Browse</a></li>
				<li><a <?php if ($this->_tpl_vars['page'] == 'playlist'): ?>class="selected" <?php endif; ?>href="<?php echo $this->_tpl_vars['playlist_link']; ?>
">Playlist</a></li>
				<li><a <?php if ($this->_tpl_vars['page'] == 'control'): ?>class="selected" <?php endif; ?>href="<?php echo $this->_tpl_vars['control_link']; ?>
">Control</a></li>
			</ul>
		</div>

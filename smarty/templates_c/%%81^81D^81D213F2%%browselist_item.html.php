<?php /* Smarty version 2.6.26, created on 2010-01-24 11:30:41
         compiled from default/browselist_item.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'default/browselist_item.html', 5, false),)), $this); ?>

			<?php if ($this->_tpl_vars['browselist_item']['directory']): ?>

				<li class="dir">
					<a class="browse" href="index.php?browse=<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['directory'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['directory_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
				</li>

			<?php elseif ($this->_tpl_vars['browselist_item']['metaArtist']): ?>

				<li class="artist">
					<a class="browse" href="index.php?browse=<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['metaArtist'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
				</li>

			<?php elseif ($this->_tpl_vars['browselist_item']['metaAlbum']): ?>

				<li class="album">
					<a class="browse" href="index.php?browse=<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['metaAlbum'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
				</li>

			<?php elseif ($this->_tpl_vars['browselist_item']['Title']): ?>

				<?php if ($this->_tpl_vars['browselist_item']['in_playlist']): ?>
				<li class="track playing">
					<a class="add"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/add_disabled.png" alt="Add" class="button" /></a>
				<?php else: ?>
				<li class="track">
					<a class="add" href="<?php echo $this->_tpl_vars['browselist_add_link']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['file'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/add.png" alt="Add" class="button" /></a>
				<?php endif; ?>
					<a class="play" href="<?php echo $this->_tpl_vars['browselist_play_link']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['file'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/play.png" alt="Play" class="button" /></a>
					<a class="browse">
				<?php if (((is_array($_tmp=$this->_tpl_vars['browselist_item']['Title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
					<span class="title"><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['Title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
					<?php if ($this->_tpl_vars['browselist_item']['Artist'] && $this->_tpl_vars['show_extra_track_info']): ?><br /><span class="artist"><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['Artist'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span> <?php if ($this->_tpl_vars['browselist_item']['Album']): ?><span class="album">(<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['Album'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
)</span><?php endif; ?><?php endif; ?><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['file_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?>
					</a>
				</li>

			<?php elseif ($this->_tpl_vars['browselist_item']['file']): ?>

				<?php if ($this->_tpl_vars['browselist_item']['in_playlist']): ?>
				<li class="playing">
				<?php else: ?>
				<li>
				<?php endif; ?>
					<a href="<?php echo $this->_tpl_vars['browselist_add_link']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['file'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/add.png" alt="Add" class="button" /></a><a href="<?php echo $this->_tpl_vars['browselist_play_link']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['file'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/play.png" alt="Play" class="button" /></a><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/note.gif" class="icon" /> <?php if (((is_array($_tmp=$this->_tpl_vars['browselist_item']['Title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?><span class="title"><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['Title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span><?php if ($this->_tpl_vars['browselist_item']['Artist'] && $this->_tpl_vars['show_extra_track_info']): ?><br /><span class="artist"><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['Artist'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span> <?php if ($this->_tpl_vars['browselist_item']['Album']): ?><span class="album">(<?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['Album'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
)</span><?php endif; ?><?php endif; ?><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['browselist_item']['file_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?></li>

				<?php endif; ?>
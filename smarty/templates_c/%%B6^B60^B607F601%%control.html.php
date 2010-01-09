<?php /* Smarty version 2.6.9, created on 2010-01-09 14:59:56
         compiled from default/control.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'default/control.html', 3, false),array('modifier', 'string_format', 'default/control.html', 11, false),)), $this); ?>
		<div id="song_display">
	
			<div id="cover_image"><?php if ($this->_tpl_vars['coverimage']): ?><img id="cover" title="<?php echo $this->_tpl_vars['current_album']; ?>
" src="lib/image.php?file=<?php echo ((is_array($_tmp=$this->_tpl_vars['coverimage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&size=<?php echo $this->_tpl_vars['coversize']; ?>
" /><?php else: ?><img id="cover" title="<?php echo $this->_tpl_vars['current_album']; ?>
" src="templates/default/images/default_cover.png" /><?php endif; ?></div>
			
			<div id="album_info"><p class="artist"><?php echo $this->_tpl_vars['current_artist']; ?>
</p><?php if ($this->_tpl_vars['current_album']): ?><p class="album"><?php echo $this->_tpl_vars['current_album']; ?>
</p><?php endif; ?></div>
		<?php if ($this->_tpl_vars['mpd_state'] == 'play' || $this->_tpl_vars['mpd_state'] == 'pause'): ?><div id="tracktime"><span id="min"><?php echo $this->_tpl_vars['initialmin']; ?>
</span>:<span id="sec"><?php echo $this->_tpl_vars['initialsec']; ?>
</span> <span id="total">(<?php echo $this->_tpl_vars['totalmin']; ?>
:<?php echo $this->_tpl_vars['totalsec']; ?>
)</span></div><?php endif; ?>

		<?php if ($this->_tpl_vars['mpd_state'] == 'play' || $this->_tpl_vars['mpd_state'] == 'pause'): ?><div id="progress"><div id="progressbar" style="margin-right: <?php echo $this->_tpl_vars['initialprogress']; ?>
px;">&nbsp;</div></div><?php else: ?><div id="progress"></div><?php endif; ?>

			<div id="song_info">
				<?php if ($this->_tpl_vars['current_title']): ?><span class="pos"><?php echo ((is_array($_tmp=$this->_tpl_vars['current_track_no']+1)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%02d") : smarty_modifier_string_format($_tmp, "%02d")); ?>
.</span> <span class="title"><?php echo $this->_tpl_vars['current_title']; ?>
</span><br /><br /><?php elseif ($this->_tpl_vars['current_filename']):  echo $this->_tpl_vars['current_filename'];  else: ?>[Nothing playing]<?php endif; ?>
			
			</div>
			
		</div>

		<div id="controls">
			<a href="index.php?action=prev"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/prev_button.png" Alt="Previous" width="50" height="50" /></a><a href="index.php?action=play"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/play_button.png" Alt="Play" width="50" height="50" /></a><a href="index.php?action=pause"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/pause_button.png" Alt="Pause" width="50" height="50" /></a><a href="index.php?action=stop"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/stop_button.png" Alt="Stop" width="50" height="50" /></a><a href="index.php?action=next"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/next_button.png" Alt="Next" width="50" height="50" /></a>
		</div>
		

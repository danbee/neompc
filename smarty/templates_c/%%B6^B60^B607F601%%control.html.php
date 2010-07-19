<?php /* Smarty version 2.6.26, created on 2010-01-13 20:02:03
         compiled from default/control.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'default/control.html', 3, false),array('modifier', 'string_format', 'default/control.html', 12, false),)), $this); ?>
		<div id="song_display">
	
			<!--<div id="cover_image"><?php if ($this->_tpl_vars['coverimage']): ?><img id="cover" title="<?php echo $this->_tpl_vars['current_album']; ?>
" src="lib/image.php?file=<?php echo ((is_array($_tmp=$this->_tpl_vars['coverimage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&size=<?php echo $this->_tpl_vars['coversize']; ?>
" /><?php else: ?><img id="cover" title="<?php echo $this->_tpl_vars['current_album']; ?>
" src="templates/default/images/default_cover.png" /><?php endif; ?></div>
			
			<div id="album_info"><p id="artist"><?php echo $this->_tpl_vars['current_artist']; ?>
</p><?php if ($this->_tpl_vars['current_album']): ?><p id="album"><?php echo $this->_tpl_vars['current_album']; ?>
</p><?php endif; ?></div>
	
			<?php if ($this->_tpl_vars['mpd_state'] == 'play' || $this->_tpl_vars['mpd_state'] == 'pause'): ?><div id="tracktime"><span id="min"><?php echo $this->_tpl_vars['initialmin']; ?>
</span>:<span id="sec"><?php echo $this->_tpl_vars['initialsec']; ?>
</span> <span id="total">(<?php echo $this->_tpl_vars['totalmin']; ?>
:<?php echo $this->_tpl_vars['totalsec']; ?>
)</span></div><?php endif; ?>
	
			<?php if ($this->_tpl_vars['mpd_state'] == 'play' || $this->_tpl_vars['mpd_state'] == 'pause'): ?><div id="progress"><div id="progressbar" style="margin-right: <?php echo $this->_tpl_vars['initialprogress']; ?>
px;">&nbsp;</div></div><?php else: ?><div id="progress"></div><?php endif; ?>
	
			<div id="song_info">
				<?php if ($this->_tpl_vars['current_title']): ?><span id="pos"><?php echo ((is_array($_tmp=$this->_tpl_vars['current_track_no']+1)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%02d") : smarty_modifier_string_format($_tmp, "%02d")); ?>
.</span> <span id="title"><?php echo $this->_tpl_vars['current_title']; ?>
</span><br /><br /><?php elseif ($this->_tpl_vars['current_filename']): ?><?php echo $this->_tpl_vars['current_filename']; ?>
<?php else: ?>[Nothing playing]<?php endif; ?>
			
			</div>-->
			
			<div id="cover_image"><img id="cover" title="<?php echo $this->_tpl_vars['current_album']; ?>
" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/default_cover.png" /></div>
			
			<div id="album_info"><p id="artist"></p><p id="album"></p></div>
	
			<div id="tracktime"><span id="current">--:--</span><span id="volume_display"></span></div>
	
			<div id="progress"><div id="progressbar" style="margin-right: 100%;">&nbsp;</div></div>
	
			<div id="song_info">
				<span id="pos"></span> <span id="title"></span>			
			</div>
			
		</div>

		<div id="controls">
			<div class="container">
				<ul id="main_controls">
					<li><a rel="prev" id="prev_button" class="control_button" href="index.php?action=prev"></a></li>
					<li><a rel="playpause" id="playpause_button" class="control_button" href="index.php?action=playpause"></a></li>
					<li><a rel="stop" id="stop_button" class="control_button" href="index.php?action=stop"></a></li>
					<li><a rel="next" id="next_button" class="control_button" href="index.php?action=next"></a></li>
				</ul>
				<div id="volume_repeat">
					<div id="volume_container">
						<div id="slider_container">
							<a id="volume_slider"></a>
						</div>
						<a id="volume_hide" href="index.php?action=hide_volume"></a>
					</div>
					<a rel="volume" id="volume_button" href="index.php?action=show_volume"></a>
					<a rel="repeat" id="repeat_button" class="control_button" href="index.php?action=repeat"></a>
				</div>
			</div>
		</div>
		

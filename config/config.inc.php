<?php

	/**************************************
	** NeoMPC Config File
	**************************************/

	/* Config relating to the display of CD covers */
	/* music_directory must match you MPD music_directory config */
	$_CONFIG['music_directory'] = '/home/media/data/audio';
	$_CONFIG['album_cover_name'] = 'folder.jpg';
	$_CONFIG['album_cover_size'] = 130;

	/* Template to use for displaying the pages */
	$_CONFIG['template'] = 'default';

	/* Browse mode can be 'filesystem' or 'metadata' */
	$_CONFIG['browse_mode'] = 'metadata';

	$_CONFIG['sort_by_tracknumber'] = true;

	$_CONFIG['browse_extra_track_info'] = false;

	$_CONFIG['playlist_extra_track_info'] = true;

?>

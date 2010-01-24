<?php

	/**************************************
	** NeoMPC Config File
	**************************************/

	/* Server details */
	$_CONFIG['server'] = 'localhost';
	$_CONFIG['password'] = '';
	$_CONFIG['port'] = '6600';

	/* Config relating to the display of CD covers */
	/* music_directory must match you MPD music_directory config */
	$_CONFIG['music_directory'] = '/var/lib/mpd/music';
	$_CONFIG['album_cover_name'] = '{Artist} - {Album}.jpg';

	/* Template to use for displaying the pages */
	$_CONFIG['template'] = 'default';

	/* Browse mode can be 'filesystem' or 'metadata' */
	//$_CONFIG['browse_mode'] = 'metadata';
	$_CONFIG['browse_mode'] = 'filesystem';

	$_CONFIG['sort_by_tracknumber'] = true;

	$_CONFIG['browse_extra_track_info'] = false;

	$_CONFIG['playlist_extra_track_info'] = true;

?>

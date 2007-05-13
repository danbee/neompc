<?php

	/**************************************
	** NeoMPC Config File
	**************************************/

	/* Config relating to the display of CD covers */
	/******** THIS IS NOT YET IMPLEMENTED! *********/
	$_CONFIG['music_directory'] = '/var/lib/mpd/music';
	$_CONFIG['album_cover_name'] = 'folder.jpg';
	/***********************************************/

	/* Template to use for displaying the pages */
	$_CONFIG['template'] = 'default';

	/* Browse mode can be 'filesystem' or 'metadata' */
	$_CONFIG['browse_mode'] = 'filesystem';

	$_CONFIG['sort_by_tracknumber'] = true;

	$_CONFIG['browse_extra_track_info'] = false;

	$_CONFIG['playlist_extra_track_info'] = true;

?>

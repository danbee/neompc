<?php

	require_once('lib/global.php');
	
	$action = $_GET['action'];
	
	switch ($action) {
		case 'stop':
			$mympd->Stop();
			break;
		case 'play':
			$mympd->Play();
			break;
		case 'pause':
			$mympd->Pause();
			break;
		case 'playpause':
			if ($mympd->state == MPD_STATE_PLAYING) {
				$mympd->Pause();
			}
			else {
				$mympd->Play();
			}
			break;
		case 'prev':
			$mympd->Previous();
			break;
		case 'next':
			$mympd->Next();
			break;
		case 'repeat':
			// toggle repeat
			$repeat = ($mympd->repeat == 0 ? 1 : 0);
			$mympd->SetRepeat($repeat);
			break;
		case 'volume':
			$volume = $_GET['value'];
			$mympd->SetVolume($volume);
			die();
			break;
	}

	echo mpd_info();
	
function mpd_info() {
	global $mympd, $_CONFIG;
	// we will create an array of info detailing the current state of MPD
	// and return it as JSON.
	$info = array();
	$info['state'] = $mympd->state;
	
	$current_track = $mympd->playlist[$mympd->current_track_id];

	$cover_link = $_CONFIG['music_directory'] . '/'
					. substr($current_track['file'], 0, strrpos($current_track['file'], '/') + 1) 
					. var_filter($current_track, $_CONFIG['album_cover_name']);
			
	if (file_exists($cover_link)) {
		$info['coverimage'] = 'lib/image.php?file=' . $cover_link . '&size=' . $_CONFIG['album_cover_size'];
	}
	
	$info['title'] = $current_track['Title'];
	$info['album'] = $current_track['Album'];
	$info['artist'] = $current_track['Artist'];
	$info['file'] = $current_track['file'];
	$info['filename'] = substr($current_track['file'], strrpos($current_track['file'], '/') + 1);
	$info['length'] = $mympd->current_track_length;
	$info['position'] = $mympd->current_track_position;
	$info['volume'] = $mympd->volume;
	$info['repeat'] = $mympd->repeat;
	$info['random'] = $mympd->random;
	
	return json_encode($info);
}

?>

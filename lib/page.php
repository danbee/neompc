<?php

	$progressbar_width = $_CONFIG['progress_bar_width'];
	$smarty->assign('progressbar_width', $progressbar_width);
	$smarty->assign('volume_orientation', $_CONFIG['volume_orientation']);
	$smarty->assign('volume_min', $_CONFIG['volume_min']);
	$smarty->assign('volume_max', $_CONFIG['volume_max']);
	$smarty->assign('page', $page);

	/* print_r($mympd->playlist); */

	switch ($page) {
		case "playlist":
			/*
			echo '<pre>';
			print_r($mympd->playlist);
			echo '</pre>';
			//*/

			$smarty->assign('show_extra_track_info', $_CONFIG['playlist_extra_track_info']);

			$playlist = $mympd->playlist;
			foreach ($playlist as $key => $playlist_item) {
				$playlist[$key]['file_name'] = substr($playlist_item['file'], strrpos($playlist_item['file'], '/') + 1);
			}

			$smarty->assign('playlist', $playlist);
			$smarty->assign('playing', $mympd->current_track_id);
			break;
		case "control":
			/* get the currently playing track */
			$current_track = $mympd->playlist[$mympd->current_track_id];
			$smarty->assign('current_track_no', $mympd->current_track_id);
			$smarty->assign('current_title', $current_track['Title']);
			$smarty->assign('current_album', $current_track['Album']);
			$smarty->assign('current_artist', $current_track['Artist']);
			$smarty->assign('current_file', $current_track['file']);
			$smarty->assign('current_filename', substr($current_track['file'], strrpos($current_track['file'], '/') + 1));
			$smarty->assign('song_length', $mympd->current_track_length);
			$smarty->assign('song_position', $mympd->current_track_position);
			$smarty->assign('mpd_state', $mympd->state);
			
			$cover_path = $_CONFIG['music_directory'] . '/'
						. substr($current_track['file'], 0, strrpos($current_track['file'], '/') + 1);
			$cover_file = $_CONFIG['album_cover_name'];
			
			if (file_exists($cover_link)) {
				$smarty->assign('coverpath', $cover_link);
				$smarty->assign('coverfile', $cover_file);
				$smarty->assign('coversize', $_CONFIG['album_cover_size']);
			}
			
			$time_left = (($mympd->current_track_length - $mympd->current_track_position) + 1) * 1000;
			
			$initialprogress = round($progressbar_width - (($mympd->current_track_position / $mympd->current_track_length) * $progressbar_width));
			
			$smarty->assign('initialprogress', $initialprogress);
			$smarty->assign('initialmin', date('i', $mympd->current_track_position));
			$smarty->assign('initialsec', date('s', $mympd->current_track_position));
			$smarty->assign('totalmin', date('i', $mympd->current_track_length));
			$smarty->assign('totalsec', date('s', $mympd->current_track_length));
			
			//echo $time_left / 1000;
			
			if ($mympd->state == MPD_STATE_PLAYING) {
				$smarty->assign('refresh',
				"<script>setTimeout('window.location.replace(unescape(window.location.pathname));', "
				. $time_left . ");</script>");
			}
			
			break;
		case "browse":

			$smarty->assign('show_extra_track_info', $_CONFIG['show_extra_track_info']);

			switch ($_CONFIG['browse_mode']) {

				case 'metadata': /* metadata based browsing.  this will list artists->albums->tracks */
				
					$home_link = 'index.php?browse=|';

					/* split the browse get var if present */
					if ($_GET['browse']) {
						setcookie('browse', $_GET['browse']);
						if ($_GET['browse'] == '|') {
							$meta_level = 'artists';
						}
						else {
							$browse_bits = explode('|', $_GET['browse']);
							if ($browse_bits[0]) {
								$artist = $browse_bits[0];
								$meta_level = 'albums';
							}
							if ($browse_bits[1]) {
								$album = $browse_bits[1];
								$meta_level = 'tracks';
							}
						}
					}
					elseif ($_COOKIE['browse']) {
						if ($_COOKIE['browse'] == '|') {
							$meta_level = 'artists';
						}
						else {
							$browse_bits = explode('|', $_COOKIE['md_browse']);
							if ($browse_bits[0]) {
								$artist = $browse_bits[0];
								$meta_level = 'albums';
							}
							if ($browse_bits[1]) {
								$album = $browse_bits[1];
								$meta_level = 'tracks';
							}
						}

					}
					else {
						$meta_level = 'artists';
					}

					//print_r($browse_bits);

					switch ($meta_level) { /* we need to get the information differently for different meta levels */

						case 'artists':
							$artists = $mympd->GetArtists();

							foreach ($artists as $the_artist) {
								$browselist[] = array('metaArtist' => $the_artist, 'path' => $the_artist);
							}

							break;

						case 'albums':
							$albums = $mympd->GetAlbums($artist);

							foreach ($albums as $the_album) {
								$browselist[] = array('metaAlbum' => $the_album, 'path' => $artist . '|' . $the_album);
							}
							
							$dir_list = array(array('name' => stripslashes($artist), 'path' => urlencode($artist)));

							break;

						case 'tracks':

							$tracks = $mympd->Find(MPD_SEARCH_ALBUM, $album);

							/*
							echo '<pre>';
							print_r($tracks);
							echo '</pre>';
							//*/

							/* foreach ($albums as $album) {
								$browselist[]['metaAlbum'] = $album;
							} */

							$browselist = $tracks;

							if ($_CONFIG['sort_by_tracknumber']) {
								usort($browselist, "track_sort");
							}

							$dir_list = array(array('name' => $artist, 'path' => urlencode($artist)), array('name' => $album, 'path' => urlencode($artist . '|' . $album)));

							break;
					}

					$smarty->assign('dir_list', $dir_list);
					$smarty->assign('browselist', $browselist);
					$smarty->assign('home_link', $home_link);

					break;

				case 'filesystem': /* filesystem based browsing.  this will follow the filesystem tree */

					$home_link = 'index.php?browse=/';

					/* get the browse position from the cookie or from get */
					if ($_GET['browse']) {
						$browse = $_GET['browse'];
						setcookie('browse', $browse);
					}
					else {
						$browse = $_COOKIE['browse'];
					}

					//$browse = $browse;
					// ^ wtf?!?

					/* make the path array */

					if ($browse == '/') {
						$browse = '';
						$browse_list = array('/');
					}
					else {
						$browse_list = array_merge(array('/'), explode('/', $browse));
					}

					//print_r($browse_list);

					foreach ($browse_list as $key => $browse_item) {
						$path .= $browse_item . '/';
						$dir_list[] =	array(
											'path' => ($path == '//' ? '/' : urlencode(trim($path, '/'))),
											'name' => $browse_item
										);
					}
					
					$smarty->assign('browse_header', $browse_item);
					$parent_key = $key - 1;
					$smarty->assign('browse_parent_link', $dir_list[$parent_key]['path']);

					$smarty->assign('dir_list', $dir_list);

					if (!$browselist) {
						$browselist = $mympd->GetDir($browse);
					}

					if ($_CONFIG['sort_by_tracknumber']) {
						usort($browselist, "track_sort");
					}

					/*
					echo '<pre>';
					print_r($browselist);
					echo '</pre>';
					//*/

					foreach ($browselist as $key => $browselist_item) {
						
						if ($browselist_item['directory']) {
							$lastpos = strrpos($browselist_item['directory'], '/');
							if ($lastpos !== false) {
								$browselist[$key]['directory_name'] = substr($browselist_item['directory'], $lastpos + 1);
							}
							else {
								$browselist[$key]['directory_name'] = $browselist_item['directory'];
							}
						}


						/* add a token for files currently on the playlist */
						foreach($mympd->playlist as $playlist_item) {
							$lastpos = strrpos($browselist_item['file'], '/');
							$browselist[$key]['file_name'] = substr($browselist_item['file'], $lastpos + 1);
							
							if ($browselist_item['file'] == $playlist_item['file']) {
							
								$browselist[$key]['in_playlist'] = "1";
							}
						}
					}

					//print_r($browselist);

					$smarty->assign('browselist', $browselist);
					$smarty->assign('home_link', $home_link);

					break;
			}

			//echo '<pre style="text-align: left;">';
			//print_r($mympd->GetDir($browse));
			//echo '</pre>';

			break;
	}
?>

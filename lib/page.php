<?php

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

			$smarty->assign('playlist', $mympd->playlist);
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
			
			$cover_link = $_CONFIG['music_directory'] . '/'
						. substr($current_track['file'], 0, strrpos($current_track['file'], '/') + 1) 
						. $_CONFIG['album_cover_name'];
			
			if (file_exists($cover_link)) {
				$smarty->assign('coverimage', $cover_link);
				$smarty->assign('coversize', $_CONFIG['album_cover_size']);
			}
			
			break;
		case "browse":

			$smarty->assign('show_extra_track_info', $_CONFIG['show_extra_track_info']);

			switch ($_CONFIG['browse_mode']) {

				case 'metadata': /* metadata based browsing.  this will list artists->albums->tracks */

					/* split the browse get var if present */
					if ($_GET['browse']) {
						setcookie('browse', $_GET['browse']);
						if ($_GET['browse'] == '/') {
							$meta_level = 'artists';
						}
						else {
							$browse_bits = split('/', $_GET['browse']);
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
						if ($_COOKIE['browse'] == '/') {
							$meta_level = 'artists';
						}
						else {
							$browse_bits = split('/', $_COOKIE['browse']);
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
								$browselist[] = array('metaAlbum' => $the_album, 'path' => $artist . '/' . $the_album);
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

							$dir_list = array(array('name' => $artist, 'path' => urlencode($artist)), array('name' => $album, 'path' => urlencode($artist . '/' . $album)));

							break;
					}

					$smarty->assign('dir_list', $dir_list);
					$smarty->assign('browselist', $browselist);

					break;

				case 'filesystem': /* filesystem based browsing.  this will follow the filesystem tree */

					/* get the browse position from the cookie or from get */
					if ($_GET['browse']) {
						$browse = $_GET['browse'];
						setcookie('browse', $browse);
					}
					else {
						$browse = $_COOKIE['browse'];
					}

					$browse = $browse;

					/* make the path array */

					if ($browse == '/') {
						$browse = '';
					}

					$browse_list = explode('/', $browse);

					//print_r($browse);

					if ($browse) {

						foreach ($browse_list as $browse_item) {
							$path .= $browse_item . '/';
							$dir_list[] = array('path' => urlencode(trim($path, '/')), 'name' => $browse_item);
						}

					}

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
							if ($browselist_item['file'] == $playlist_item['file']) {
								$browselist[$key]['in_playlist'] = "1";
							}
						}
					}

					//print_r($browselist);

					$smarty->assign('browselist', $browselist);

					break;
			}

			//echo '<pre style="text-align: left;">';
			//print_r($mympd->GetDir($browse));
			//echo '</pre>';

			break;
	}
?>

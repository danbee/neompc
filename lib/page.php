<?php

	$smarty->assign('page', $page);
	
	/* print_r($mympd->playlist); */

	switch ($page) {
		case "playlist":
			$smarty->assign('playlist', $mympd->playlist);
			break;
		case "control":
			/* get the currently playing track */
			$current_track = $mympd->playlist[$mympd->current_track_id];
			$smarty->assign('current_track_no', $current_track['Track']);
			$smarty->assign('current_title', $current_track['Title']);
			$smarty->assign('current_album', $current_track['Album']);
			$smarty->assign('current_artist', $current_track['Artist']);
			$smarty->assign('current_file', $current_track['file']);
			break;
		case "browse":
		
			switch ($_CONFIG['browse_mode']) {
			
				case 'metadata': /* metadata based browsing.  this will list artists->albums->tracks */
				
					/* split the browse get var if present */
					if ($_GET['browse']) {
						if ($_GET['browse'] == '/') {
							$browse_bits[0] = 'artists';
						}
						else {
							$browse_bits = split('::', $_GET['browse']);
						}						
					}
					
					//print_r($browse_bits);
			
					/* set the meta_level */				
					if ($browse_bits[0]) {
						$meta_level = $browse_bits[0];
					}
					elseif ($_COOKIE['meta_level']) {
						$meta_level = $_COOKIE['meta_level'];
					}
					else {
						$meta_level = 'artists';
					}
					
					switch ($meta_level) { /* we need to get the information differently for different meta levels */
						
						case 'artists':
							$artists = $mympd->GetArtists();
							
							foreach ($artists as $artist) {
								$browselist[]['metaArtist'] = $artist;
							}
							
							break;
							
						case 'albums':
							$albums = $mympd->GetAlbums($browse_bits[1]);
							
							foreach ($albums as $album) {
								$browselist[]['metaAlbum'] = $album;
							}
							
							break;
						
						case 'tracks':
						
							$tracks = $mympd->Find(MPD_SEARCH_ALBUM, $browse_bits[1]);
							
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
									
							break;
					}
					
					$smarty->assign('browselist', $browselist);
				
					break;
			
				case 'filesystem': /* filesystem based browsing.  this will follow the filesystem tree */
			
					/* get the browse position from the cookie or from get */
					if ($_GET['browse']) {
						$browse = $_GET['browse'];
						setcookie('browse', stripslashes($browse));
					}
					else {
						$browse = $_COOKIE['browse'];
					}
					
					$browse = stripslashes($browse);

					/* make the path array */
					
					if ($browse == '/') {
						$browse = '';
					}
					
					$browse_list = explode('/', $browse);
					
					//print_r($browse);
					
					if ($browse) {
					
						foreach ($browse_list as $browse_item) {
							$path .= $browse_item . '/';
							$dir_list[] = array('path' => trim($path, '/'), 'name' => $browse_item);
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

					
					$smarty->assign('browselist', $browselist);
					
					break;
			}
			
			//echo '<pre style="text-align: left;">';			
			//print_r($mympd->GetDir($browse));			
			//echo '</pre>';
			
			break;
	}
?>

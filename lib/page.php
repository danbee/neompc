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
			
			//echo '<pre style="text-align: left;">';			
			//print_r($mympd->GetDir($browse));			
			//echo '</pre>';
			
			break;
	}
?>

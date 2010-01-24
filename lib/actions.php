<?php
	/* handle the actions for mpd */

	if ($_GET['skipto']) {
		$mympd->SkipTo($_GET['skipto']);
	}

	switch($_GET['action']) {
		case "shuffle":
			$mympd->PLShuffle();
			break;

		case "clear":
			$mympd->PLClear();
			break;

		case "remove":
			$mympd->PLRemove($_GET['id']);
			break;

		case "fileadd":
			$mympd->PLAdd($_GET['file']);
			break;

		case "addall":
			addall($_COOKIE['browse']);
			$page = 'playlist';
			setcookie('page', $page);
			header("Location: index.php");
			break;

		case "playall":
			$mympd->PLClear();

			addall($_COOKIE['browse']);

			$page = 'control';
			setcookie('page', $page);
			$mympd->Play();
			header("Location: index.php");
			break;

		case "fileplay":
			$mympd->PLClear();
			$mympd->PLAdd($_GET['file']);
			$page = 'control';
			setcookie('page', $page);
			$mympd->Play();
			header("Location: index.php");
			break;

		case "stop":
			$mympd->Stop();
			header("Location: index.php");
			break;

		case "play":
			$mympd->Play();
			header("Location: index.php");
			break;

		case "pause":
			$mympd->Pause();
			header("Location: index.php");
			break;

		case 'playpause':
			if ($mympd->state == 'play') {
				$mympd->Pause();
			}
			else {
				$mympd->Play();
			}
			header("Location: index.php");
			break;

		case "prev":
			$mympd->Previous();
			header("Location: index.php");
			break;

		case "next":
			$mympd->Next();
			header("Location: index.php");
			break;
	}

	function addall($browse) {

		global $_CONFIG, $mympd;

		if ($browse == $_CONFIG['separator']) {
			$browse = '';
		}

		switch ($_CONFIG['browse_mode']) {

			case 'filesystem':

				function get_browselist($path) {

					global $mympd;

					$browselist = $mympd->GetDir($path);

					foreach ($browselist as $browseitem) {
						if ($browseitem['directory']) {
							//echo $browseitem.directory;
							$browselist = array_merge($browselist, get_browselist($browseitem['directory']));
						}
					}

					return $browselist;

				}

				/* create the array of files for the playlist add */
				$browselist = get_browselist($browse);

				break;

			case 'metadata':

				$browse_bits = explode($_CONFIG['separator'], $browse);
				
				if (is_array($browse_bits)) {

					if ($browse_bits[1]) {
						$album = $browse_bits[1];
						$browselist = $mympd->Find(MPD_SEARCH_ALBUM, $album);
					}
					elseif ($browse_bits[0]) {
						$artist = $browse_bits[0];
						$browselist = $mympd->Find(MPD_SEARCH_ARTIST, $artist);
					}

				}
				else {
					//$browselist = $mympd->Search(MPD_SEARCH_TITLE, '');
				}

				break;
		}

		if (is_array($browselist)) {

			foreach($browselist as $browselist_item) {
				if ($browselist_item['file']) {
					$addlist[] = $browselist_item['file'];
				}
			}

			$mympd->PLAddBulk($addlist);
		}

	}
?>

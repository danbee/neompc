<?php
	/* handle the actions for mpd */
	
	if ($_GET['skipto']) {
		$mympd->SkipTo($_GET['skipto']);
	}
	
	switch($_GET['action']) {
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
			/* create the array of files for the playlist add */
			if ($browse == '/') {
				$browse = '';
			}
			
			$browselist = $mympd->GetDir($browse);
			
			foreach($browselist as $browselist_item) {
				if ($browselist_item['file']) {
					$addlist[] = $browselist_item['file'];
				}
			}
			
			$mympd->PLAddBulk($addlist);
			$page = 'playlist';
			setcookie('page', $page);
			header("Location: index.php");
			break;
			
		case "playall":
			$mympd->PLClear();
			/* create the array of files for the playlist add */
			if ($browse == '/') {
				$browse = '';
			}
			
			$browselist = $mympd->GetDir($browse);
			
			foreach($browselist as $browselist_item) {
				if ($browselist_item['file']) {
					$addlist[] = $browselist_item['file'];
				}
			}
			
			$mympd->PLAddBulk($addlist);
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
			
		case "play":
			$mympd->Play();
			header("Location: index.php");
			break;
			
		case "stop":
			$mympd->Stop();
			header("Location: index.php");
			break;
			
		case "pause":
			$mympd->Pause();
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
?>
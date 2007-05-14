<?php
	/* Smarty stuff */

	$version = 0.5;
	
	if (get_magic_quotes_gpc()) {
		/* Deal with Magic quotes. We can safely strip these off as we're not using a database. */
		$_REQUEST = array_map('stripslashes', $_REQUEST);
		$_GET = array_map('stripslashes', $_GET);
		$_POST = array_map('stripslashes', $_POST);
		$_COOKIE = array_map('stripslashes', $_COOKIE);
	}

	require('config/config.inc.php');

	define('SMARTY_DIR', 'lib/smarty/libs/');
	require(SMARTY_DIR . 'Smarty.class.php');
	$smarty = new Smarty;
	$smarty->template_dir = 'templates/';
	$smarty->compile_dir = 'smarty/templates_c/';
	$smarty->config_dir = 'smarty/configs/';
	$smarty->cache_dir = 'smarty/cache/';

	$smarty->assign('version', $version);

	include('lib/mpd.class.php');
	$mympd = new mpd('localhost',6600);

	if (!$mympd->connected) {
		echo "<p>Problem connecting to MPD!</p>";
		exit;
	}

	/* track number sorting function */

	function track_sort($a, $b) {
		if ($a['directory'] && $b['directory']) {
			if ($a['directory'] < $b['directory']) {
				return -1;
			}
			elseif ($a['directory'] > $b['directory']) {
				return 1;
			}
			else {
				return 0;
			}
		}
		elseif ($a['directory'] && !$b['directory']) {
			return 1;
		}
		elseif (!$a['directory'] && $b['directory']) {
			return -1;
		}
		else {
			return $a['Track'] - $b['Track'];
		}
	}

	/* setup some global vars */
	$smarty->assign('browse_link', 'index.php?page=browse');
	$smarty->assign('playlist_link', 'index.php?page=playlist');
	$smarty->assign('browselist_play_link', 'index.php?action=fileplay&file=');
	$smarty->assign('browselist_add_link', 'index.php?action=fileadd&file=');
	$smarty->assign('playlist_remove_link', 'index.php?action=remove&id=');
	$smarty->assign('control_link', 'index.php?page=control');
	$smarty->assign('playlist_play_link', 'index.php?page=control&action=play&skipto=');
	$smarty->assign('playlist_clear_link', 'index.php?action=clear');

	/* first check for a page cookie, and default to displaying the playlist */
	if ($_GET['page']) {
		$page = $_GET['page'];
		setcookie('page', $page);
	}
	else {
		$page = $_COOKIE['page'];
	}

	if (!$page) {
		$page = 'playlist';
	}
	
	//echo $mympd->current_track_length, ' - ', $mympd->current_track_position;

	$smarty->assign('page', $page);

?>

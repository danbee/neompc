<?php
	/* Smarty stuff */

	define('SMARTY_DIR', 'lib/smarty/libs/');
	require(SMARTY_DIR . 'Smarty.class.php');
	$smarty = new Smarty;
	$smarty->template_dir = 'templates/';
	$smarty->compile_dir = 'smarty/templates_c/';
	$smarty->config_dir = 'smarty/configs/';
	$smarty->cache_dir = 'smarty/cache/';
	
	include('lib/mpd.class.php');
	$mympd = new mpd('localhost',6600);
	
	if (!$mympd->connected) {
		echo "<p>Problem connecting to MPD!</p>";
		exit;
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
	
	/* do the same with the current browse position */
	if ($_GET['browse']) {
		$browse = $_GET['browse'];
		setcookie('browse', $browse);
	}
	else {
		$browse = $_COOKIE['browse'];
	}

?>
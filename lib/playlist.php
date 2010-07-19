<?php

	require_once('global.php');
	
	$action = $_GET['action'];
	
	$playlist = $mympd->playlist;
	
	echo json_encode($playlist);
	
?>
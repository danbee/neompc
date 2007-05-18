<?php
	// The file
	$filename = stripslashes($_GET['file']);

	// Set a maximum height and width
	$width = $_GET['size'];
	$height = $_GET['size'];

	// Content type
	//header('Content-type: image/jpeg');

	$script_root = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos(substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], '/')), '/'));

	$cache_file_name = "$script_root/imagecache/" . md5($filename . $width) . ".jpg";

	if (!file_exists($cache_file_name)) {

		// Get new dimensions
		list($width_orig, $height_orig) = getimagesize($filename);

		$ratio_orig = $width_orig/$height_orig;

		if ($width/$height > $ratio_orig) {
		   $width = $height*$ratio_orig;
		} else {
		   $height = $width/$ratio_orig;
		}

		// Resample
		$image_p = imagecreatetruecolor($width, $height);
		$image = imagecreatefromjpeg($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

		// Output
		imagejpeg($image_p, $cache_file_name, 95);

	}

	echo file_get_contents($cache_file_name);
?>

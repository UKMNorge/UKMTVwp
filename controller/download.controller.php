<?php
require_once('class/download.class.php');

$download = new download_controller();

if ($_GET['video_url']) {
	$obj = $download->fetch($_GET['video_url']);
	if ($obj) {
		
	}
}

echo $download->render();
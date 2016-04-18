<?php
## Side for å slette video fra UKM-tv
require_once('class/delete.class.php');	

$delete = new delete_controller();

if ($_GET['video_url']) {
	$delete->delete($_GET['video_url']);

}	

echo $delete->render();

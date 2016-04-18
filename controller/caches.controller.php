<?php
require_once('class/caches.controller.php');
$controller = new controller_caches();
if( isset( $_GET['activate'] ) ) {
	$controller->activateCache( $_GET['activate'] );
}
if( isset( $_GET['deactivate'] ) ) {
	$controller->deactivateCache( $_GET['deactivate'] );
}

$controller->loadCaches();

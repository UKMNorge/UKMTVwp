<?php
require_once('class/home.controller.php');
$controller = new controller_home();

if( isset($_GET['bandwidth'] ) ) {
	$controller->setBandwidthMode( $_GET['bandwidth'] );
}
<?php  
/* 
Plugin Name: UKM-TV Wordpressadmin
Plugin URI: http://www.ukm-norge.no
Description: Brukes for å håndtere UKM-TV
Author: UKM Norge / M Mandal
Version: 0.1
Author URI: http://www.ukm-norge.no
*/

add_action('network_admin_menu', 'UKMTVwp_menu_network');

function UKMTVwp_menu_network() {
	$page = add_menu_page('UKM-TV', 'UKM-TV', 'administrator', 'UKMTVwp_network','UKMTVwp_network', 'http://ico.ukm.no/UKM-TVsmall.png', 500);
	add_action( 'admin_print_styles-' . $page, 'UKMTVwp_scripts_and_styles' );
	$subpage1 = add_submenu_page('UKMTVwp_network', 'Caches', 'Caches', 'administrator', 'UKMTVwp_network_caches', 'UKMTVwp_network_caches');
	add_action( 'admin_print_styles-' . $subpage1, 'UKMTVwp_scripts_and_styles' );
	$subpage2 = add_submenu_page('UKMTVwp_network', 'Konverteringskø', 'Konverteringskø', 'administrator', 'UKMTVwp_network_queue', 'UKMTVwp_network_queue');
	add_action( 'admin_print_styles-' . $subpage2, 'UKMTVwp_scripts_and_styles' );

} 


function UKMTVwp_network_caches() {
	require_once('UKM/inc/twig-admin.inc.php');
	require_once('controller/caches.controller.php');
	echo $controller->render();
}

function UKMTVwp_network_queue() {
	require_once('UKM/inc/twig-admin.inc.php');
	require_once('controller/queue.controller.php');
	echo TWIG('queue.html.twig', $TWIGdata, dirname(__FILE__), true);
}


function UKMTVwp_network() {
	require_once('UKM/inc/twig-admin.inc.php');
	require_once('controller/home.controller.php');
	echo $controller->render();
}

function UKMTVwp_scripts_and_styles() {
	wp_enqueue_script('WPbootstrap3_js');
	wp_enqueue_style('WPbootstrap3_css');
}
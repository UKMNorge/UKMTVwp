<?php
$TWIGdata = array();

require_once('UKMconfig.inc.php');
require_once('UKM/curl.class.php');

$curl = new UKMCurl();
$url = 'https://videoconverter.'.UKM_HOSTNAME.'/api/queue.php';
if (UKM_HOSTNAME == 'ukm.dev' ) {
	$curl->timeout(5); // 5s timeout in dev seems plenty in testing
}
$list = (array) $curl->request($url);

foreach( $list as $group => $jobs ) {
	foreach( $jobs as $job ) {
		$job->link = new stdClass();
		$job->link->delete 		= videoconv_action_link('delete', $job );
		$job->link->store 		= videoconv_action_link('store', $job );
		$job->link->registered 	= videoconv_action_link('registered', $job );
		$job->link->converting 	= videoconv_action_link('converting', $job );
		$job->link->log 		= 'https://videoconverter.ukm.no/api/log.php?id='. $job->id 
								. '&hash='. md5( 'log' . $job->file_name . UKM_VIDEOSTORAGE_UPLOAD_KEY . $job->id)
								;

	}
}

UKMTV_wpadmin::addViewData('list', $list);

function videoconv_action_link( $action, $job ) {
	return	'https://videoconverter.ukm.no/api/change_status.php?'
		.	'action='. $action
		.	'&id='. $job->id 
		.	'&hash='. md5( $action . $job->file_name . UKM_VIDEOSTORAGE_UPLOAD_KEY . $job->id)
		;
}
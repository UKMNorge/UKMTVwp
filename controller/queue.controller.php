<?php
$TWIGdata = array();

require_once('UKM/curl.class.php');

$curl = new UKMCurl();
$list = (array) $curl->request('http://videoconverter.ukm.no/api/queue.php');

foreach( $list as $group => $jobs ) {
	foreach( $jobs as $job ) {
		$job->link = new stdClass();
		$job->link->delete = 'http://videoconverter.ukm.dev/api/change_status.php?action=delete&id='. $job->id 
							.'&hash='. md5('delete'. $job->file_name . UKM_VIDEOSTORAGE_UPLOAD_KEY . $job->id );
	}
}
$TWIGdata['list'] = $list;
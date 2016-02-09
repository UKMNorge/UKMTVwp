<?php

require_once('_class.controller.php');
require_once('UKM/sql.class.php');
require_once('UKM/tv.class.php');

class download_controller extends UKMController {
	public function __construct() {
		$this->template('download');
	}

	public function fetch($url) {
		// Find ID from URL
		$url = explode ('/', $url);
		$url = $url[count($url)-2];
		$url = explode ('-', $url);
		$id = $url[0];

		if (!is_numeric($id)) {
			$this->data['flash'] = array("danger", "Klarte ikke lese ID: " . $id .".");
			return false;
		}

		$tv = new TV($id);
		#var_dump($tv);
		
		$this->data['video'] = $tv;
		$this->data['video_url'] = $tv->storageurl . $tv->file;
		#var_dump($this->data);
		return false;
		// Build query
		$sql = "SELECT * FROM `ukm_tv_files` WHERE `tv_id` = '#tv_id'";
		$qry = new SQL($sql, array('tv_id' => $id));

		echo $qry->debug();
		$res = $qry->run('array');
		var_dump($res);
		if (is_array($res)) {
			$this->data['video'] = $res;
			return true;
		}	
		return false;
	}
}
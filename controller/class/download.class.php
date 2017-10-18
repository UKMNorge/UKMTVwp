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
		$url = rtrim($url, '/').'/';
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
		if (!$tv->id) {
			$this->data['deleted'] = true;
			return;
		}
		
		$tv->videofile();
		#var_dump($tv);

		// Sjekk om vi kun har 720p
        if(substr($tv->file, -8, 4) == '720p') {
            $this->data['HDonly'] = true;
        }
		$this->data['video'] = $tv;
		$this->data['video_url'] = $tv->storageurl . $tv->file;
		$this->data['file_path'] = $this->findFilePath($tv->cron_id);
		#var_dump($this->data);
		return;
	}

	public function findFilePath($id) {
		$url = 'https://api.ukm.no/video:info/'.$id;
		$curl = new UKMCURL();
		$res = $curl->request($url);
		#var_dump($res);
		return $res->path->dir;
	}
}
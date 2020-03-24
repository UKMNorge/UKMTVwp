<?php

use UKMNorge\Database\SQL\Update;

require_once('_class.controller.php');
require_once('UKM/Autoloader.php');

class delete_controller extends UKMController {

	public function __construct() {
		$this->template('delete');
	}

	public function delete($url) {

		// Find ID from URL
		$url = rtrim($url, '/').'/';
		$url = explode ('/', $url);
		$url = $url[count($url)-2];
		$url = explode ('-', $url);
		$id = $url[0];

		/*$this->data['flash'] = array("danger", "Test");
		return;*/

		if (!is_numeric($id)) {
			$this->data['flash'] = array("danger", "Klarte ikke lese ID: " . $id .".");
			return;
		}
		// Build query
		$qry = new Update('ukm_tv_files', array('tv_id' => $id));
		$qry->add('tv_deleted', 'true');
		#echo $qry->debug();
		$res = $qry->run();
		if ($res == 0) {
			$this->data['flash'] = array("warning" , "Ingen rader i databasen ble endret! Er videoen slettet fra før? \nSQL-query: " . $qry->debug() ."\nResultat: " . $res);
			return;
		}

		$this->data['flash'] = array("success", "Filmen med id " . $id . " ble slettet.");
		return;
	}
}
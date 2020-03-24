<?php

use UKMNorge\Database\SQL\Query;
use UKMNorge\Database\SQL\Update;

require_once('_class.controller.php');
require_once('UKM/Autoloader.php');

class controller_caches extends UKMcontroller {

	public function __construct(){
		$this->template('caches');		
	}	

	public function loadCaches() {
		require_once('UKMconfig.inc.php');
		
		$this->data['caches'] = array();
		
		$caches_query = new Query("SELECT * FROM `ukm_tv_caches_caches`");
		$res = $caches_query->run( $caches_query );
		while( $r = Query::fetch( $res ) ) {
			$this->data['caches'][] = $r;
		}
	}


	public function activateCache( $cache ) {
		$SQL = new Update('ukm_tv_caches_caches', array('id' => $cache ) );
		$SQL->add('deactivated', 0);
		$SQL->run();
	}
	public function deactivateCache( $cache ) {
		$SQL = new Update('ukm_tv_caches_caches', array('id' => $cache ) );
		$SQL->add('deactivated', 1);
		$SQL->run();		
	}
}
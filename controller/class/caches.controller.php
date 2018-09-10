<?php
require_once('_class.controller.php');

class controller_caches extends UKMcontroller {

	public function __construct(){
		$this->template('caches');		
	}	

	public function loadCaches() {
		require_once('UKMconfig.inc.php');
		require_once('UKM/sql.class.php');
		
		$this->data['caches'] = array();
		
		$caches_query = new SQL("SELECT * FROM `ukm_tv_caches_caches`");
		$res = $caches_query->run( $caches_query );
		while( $r = SQL::fetch( $res ) ) {
			$this->data['caches'][] = $r;
		}
	}


	public function activateCache( $cache ) {
		$SQL = new SQLins('ukm_tv_caches_caches', array('id' => $cache ) );
		$SQL->add('deactivated', 0);
		$SQL->run();
	}
	public function deactivateCache( $cache ) {
		$SQL = new SQLins('ukm_tv_caches_caches', array('id' => $cache ) );
		$SQL->add('deactivated', 1);
		$SQL->run();		
	}
}
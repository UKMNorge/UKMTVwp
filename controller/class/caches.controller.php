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
		
		$caches_query = new SQL("SELECT `id`, `ip`, `status`, `last_heartbeat` FROM `ukm_tv_caches_caches`");
		$res = $caches_query->run( $caches_query );
		while( $r = mysql_fetch_assoc( $res ) ) {
			$this->data['caches'][] = $r;
		}
	}

}
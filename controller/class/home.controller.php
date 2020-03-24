<?php

use UKMNorge\Database\SQL\Insert;
use UKMNorge\Database\SQL\Query;
use UKMNorge\Database\SQL\Update;

require_once('_class.controller.php');
require_once('UKM/Autoloader.php');

class controller_home extends UKMcontroller {

	public function __construct(){
		$this->template('home');
		
		$this->getBandwidthMode();
	}
	
	public function getBandwidthMode() {
		$SQL = new Query("SELECT `conf_value`
						FROM `ukm_tv_config`
						WHERE `conf_name` = 'bandwidth_mode'");
		$mode = $SQL->run('field','conf_value');
		$this->_setBandwidthMode( $mode );
	}
	
	public function setBandwidthMode( $mode ) {
		$this->_setBandwidthMode( $mode );
				
		$SQL = new Update('ukm_tv_config', array('conf_name' => 'bandwidth_mode'));
		$SQL->add('conf_value', $this->data['mode']);
		$SQL->run();
		
		$SQL = new Insert('ukm_tv_config');
		$SQL->add('conf_name', 'bandwidth_mode');
		$SQL->add('conf_value', $this->data['mode']);
		$SQL->run();
	}
	
	private function _setBandwidthMode( $mode ) {
		if( $mode == 'low' ) {
			$this->data['mode'] = 'low';
		} else {
			$this->data['mode'] = 'HD';
		}

	}
}
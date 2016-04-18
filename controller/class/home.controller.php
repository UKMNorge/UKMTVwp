<?php
require_once('_class.controller.php');
require_once('UKM/sql.class.php');

class controller_home extends UKMcontroller {

	public function __construct(){
		$this->template('home');
		
		$this->getBandwidthMode();
	}
	
	public function getBandwidthMode() {
		$SQL = new SQL("SELECT `conf_value`
						FROM `ukm_tv_config`
						WHERE `conf_name` = 'bandwidth_mode'");
		$mode = $SQL->run('field','conf_value');
		$this->_setBandwidthMode( $mode );
	}
	
	public function setBandwidthMode( $mode ) {
		$this->_setBandwidthMode( $mode );
				
		$SQL = new SQLins('ukm_tv_config', array('conf_name' => 'bandwidth_mode'));
		$SQL->add('conf_value', $this->data['mode']);
		$SQL->run();
		
		$SQL = new SQLins('ukm_tv_config');
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
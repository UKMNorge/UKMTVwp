<?php
require_once('_class.controller.php');

class controller_home extends UKMcontroller {

	public function __construct(){
		$this->template('home');		
	}
}
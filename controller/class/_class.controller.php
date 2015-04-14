<?php

class UKMcontroller {
	var $template;
	var $data;
	
	public function __construct() {
		$this->data = array();
	}
	
	public function template( $templatename ) {
		$this->template = $templatename .'.twig.html';
		$this->data['templatename'] = $templatename;
	}
	
	public function render() {
		return TWIG($this->template, $this->data, dirname(dirname(dirname(__FILE__))));
	}
}
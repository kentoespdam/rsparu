<?php

class DasboardController extends CI_Controller {
	public function index(){
		$arr_data=array();
		
		$view=array(
			"title"=>"Dasboard",
			"content"=>"content"
		);
		
		$this->parser->parse("template/template",$view);
	}
}
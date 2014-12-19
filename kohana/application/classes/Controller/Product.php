<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Product extends Controller_Base {
	
	public function action_index() {
		$this->view = View::factory('home/product');
	}
	
	
	
}

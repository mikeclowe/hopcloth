<?php defined('SYSPATH') OR die('No direct script access');

class Controller_Cart extends controller_base {
	
	public function action_index() {
		$this->view = View::factory('home/cart');
	}

}

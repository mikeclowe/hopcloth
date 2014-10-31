<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Base {

	public function action_index(){
	  $p = DB_ORM::select('Product')->where('featured', '=', 1)->query();

		$this->view = View::factory("home/index");
		$this->view->set('products', $p);
	}
	
	public function action_product(){
  	$slug = $this->request->param('id');
  	
  	$p = DB_ORM::select('default')->from('Product')->where('slug', '=', $slug)->query();
  	
  	$this->view->set('product', $p);
	}

} // End Welcome

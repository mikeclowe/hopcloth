<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Base {

	public function action_index(){
	   $p = DB_ORM::select('Product')->where('featured', '=', 1)->where('active', '=', 1)->query();

		$this->view = View::factory("home/index");
		$this->view->set('products', $p);
	}
	
	public function action_product(){
  		$slug = $this->request->param('id');
  	
  		$p = DB_ORM::select('Product')->where('slug', '=', $slug)->query()->fetch(0);	
  	
		$this->view = View::factory("home/product");
  		$this->view->set('product', $p);
	}
	
	public function action_cart() {
		$session_id = Session::instance()->id();
		$cart_model = new Cart($session_id);
		
		$p = $cart_model->get("");
		
		$this->view = View::factory("home/cart");
		$this->view->set('p', $p);	
	}

} // End Welcome

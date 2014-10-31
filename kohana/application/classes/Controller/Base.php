<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller {
	protected $view;
	protected $auto_render = TRUE;

	public function after(){
	  
	  if($this->auto_render){
  		$template = View::factory('template');
  		$template->set("body", $this->view->render());
  
  		$this->response->body($template->render());  	  
	  }
	}

} // End Welcome

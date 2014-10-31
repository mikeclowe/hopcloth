<?php defined('SYSPATH') or die('No direct script access.');

/*
This behaves as the core Cart Object and deals with pricing, coupons, discounts
//RTODO::Pricing needs to be sorted out here.

To do
Max uses of coupon , global and per account
Max uses of promotion, global and per account
Apply item promos
Take vacation

*/
Abstract Class Kohana_Cart extends Library_Base{


  static $instance=array();

  private $data=array();

  private $key_id;

  private $added=0;


  public function __construct($session_id = NULL){
    $this->model = DB_ORM::model('Cart');

    $this->config = Kohana::$config->load("cart");

    //load any existng data, merge any items from other carts (session) or account_id if necessary

    if($session_id == NULL){
      $session_id = Session::instance()->get("last_session_id",Session::instance()->id());
    }

    if($session_id){
      $data_sess_model =DB_ORM::select("Cart")
        ->where("key_id", DB_SQL_Operator::_EQUAL_TO_, $session_id)
        ->limit(1)
        ->query()
        ->fetch();

    }

    if($data_sess_model instanceof Model_Leap_Cart){
      $this->data = $data_sess_model->as_array();
    }
  }

  static public function instance($account_id=""){
    $key_id="";

    $key_id = Session::instance()->id();

    if(!empty($account_id)){
      $key_id = $account_id;
    } else if(User::instance()->logged_in()){
      $key_id = User::instance()->account_id;
    }

    if(!is_object($instance[$key_id])){
      $instance[$key_id]=new Cart($key_id);
    }

    return $instance[$key_id];
    
    $this->remove_old_carts();
  }

  /*Removes old carts*/
  public function remove_old_carts(){
    $builder = DB_SQL::delete('default')->from("Billing.Cart");
    $builder->where('dtime','<',date("Y-m-d",time() - (86400*$this->config['remove_cart_after']) ));//remove carts older than x days
    $builder->execute();
  }
  
  //removes the instance of the shopping cart
  public function remove_cart(){
    $this->model->key_id = $this->key_id;
    $this->model->delete();
    $this->key_id="";
    
    Cache::instance()->set('CART'.md5(Session::instance()->id()), NULL);
  }

  public function add($product_id,$item){

    $service= Service::instance($service_id);
    
    $add = $this->default_cart_item();
    $add->service_id = $service_id;
    $add->domain = $item->domain;
    $add->qty=(int) ($item->qty  ? $item->qty : 1);
    $add->meta = $item->meta;

    $add->description =$item->description ? $item->description : $service->description;
    $add->price = (float) $item->prices[0];
  
  

    $key = md5($add->domain.$add->service_id);
    $add->key =$key; //setup a key for ref later

    $add=$this->validate($add);
    $this->data['items'][$key] =$add;
    
    $this->added++;
  }

  private function default_cart_item(){
    $add = new stdClass;

    $add->description = "";
    $add->price = NULL;
    $add->base_price = NULL;
    $add->account_price = NULL;
    $add->promotion = [];
    $add->promotion_price = NULL;
    $add->coupon = [];
    $add->override_price = NULL;
    $add->coupon_price = NULL;
    $add->key="";
    $add->price_key = NULL;
    $add->subtotal = 0;
    $add->discount = 0;
    $add->meta = [];

    return $add;
  }

  public function update($key,$item){
    if(array_key_exists($key,$this->data['items'])){

      $item_source = $this->data['items'][$key];
      $new_item = (object) array_merge((array) $item_source, (array) $item);

      //remove the item and re-add (best for recalculating )
      unset($this->data['items'][$key]);
      $this->add($new_item->service_id,$new_item);
      return TRUE;
    }
    return FALSE;
  }

  public function remove($key){

    unset($this->data['items'][$key]);

    $this->reload_cache();
  }
  
  public function item($key){
  
     if($key AND array_key_exists($key,$this->data['items'])){
      return $this->data['items'][$key];
    }
    
    return FALSE;
    
  }

  /*Get a single item by key or whole cart object*/
  public function get($key=""){

    if($key AND array_key_exists($key,$this->data)){
      return $this->data[$key];
    }
    //return the whole data object;
    return $this->data;
  }
  
  public function total(){
    //if an item has been added then when total is called, do a recalcuation of the cart
    if($this->added>0){
      $this->recalculate();
    }

    return number_format($this->data['total'],2);
  }

  public function count(){
    return count($this->data['items']);
  }

  public function clear(){
    $this->data=array();
  }
  
  public function __destruct(){
    $this->total();  
    $this->save();
  }

  public function save(){
    $this->total();
    
    if($this->key_id){ //if we don't have a key id, we prob removed the cart
      $this->model->key_id=$this->key_id;
      $this->model->data=serialize($this->data);
      $this->model->dtime=date("Y-m-d h:i:s");
      $this->model->account_cart =  ($account_id ? 1 : 0); //RTODO:$account_id is not valid here
      $this->model->save();
    }

  }

}
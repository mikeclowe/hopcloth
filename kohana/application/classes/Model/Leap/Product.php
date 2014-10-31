<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Leap_Product extends DB_ORM_Model {

	/**
	 * This constructor instantiates this class.
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct();

		$this->fields = array(
			'product_id' => new DB_ORM_Field_Integer($this, array(
				'max_length' => 11,
				'nullable' => FALSE,
				'unsigned' => TRUE,
			)),	
			'price' => new DB_ORM_Field_Decimal($this, array(
        'nullable' => FALSE,
        'scale' => 2,
        'precision' => 2,
      )),
			'title' => new DB_ORM_Field_String($this, array(
				'max_length' => 300,
				'nullable' => FALSE,
			)),
			'description' => new DB_ORM_Field_Text($this, array(
				'nullable' => FALSE,
			)),			
			'slug' => new DB_ORM_Field_String($this, array(
				'max_length' => 300,
				'nullable' => FALSE,
			)),			
			'image' => new DB_ORM_Field_String($this, array(
				'max_length' => 300,
				'nullable' => FALSE,
			)),
      'featured' => new DB_ORM_Field_Integer($this, array(
				'max_length' => 1,
				'nullable' => FALSE,
				'unsigned' => TRUE,
			)),
      'active' => new DB_ORM_Field_Integer($this, array(
				'max_length' => 1,
				'nullable' => FALSE,
				'unsigned' => TRUE,
			)),			
		);

		$this->relations = array();
	}

	/**
	 * This function returns the data source name.
	 *
	 * @access public
	 * @override
	 * @static
	 * @param integer $instance                     the data source instance to be used (e.g.
	 *                                              0 = master, 1 = slave, 2 = slave, etc.)
	 * @return string                               the data source name
	 */
	public static function data_source($instance = 0) {
		return 'default';	
	}

	/**
	 * This function returns the primary key for the database table.
	 *
	 * @access public
	 * @override
	 * @static
	 * @return array                                the primary key
	 */
	public static function primary_key() {
		return array('product_id');	
	}

	/**
	 * This function returns the database table's name.
	 *
	 * @access public
	 * @override
	 * @static
	 * @return string                               the database table's name
	 */
	public static function table() {
		return 'products';	
	}

}
<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Leap_Cart extends DB_ORM_Model {
	
	public function __construct() {
		parent::__construct();

		$this->fields = array(
			'ID' => DB_ORM_Field_Integer($this, array()),
			//need to know the data structure to finish
		);
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
		return ($instance > DB_DataSource::MASTER_INSTANCE) ? 'slave' : 'master';
	}

	/**
	 * This function returns the primary key for the database table.
	 *
	 * @access public
	 * @override
	 * @static
	 * @return array                                the primary key
	 */
	public static function table() {
		return 'Cart';
	}

	/**
	 * This function returns the database table's name.
	 *
	 * @access public
	 * @override
	 * @static
	 * @return string                               the database table's name
	 */
	public static function primary_key() {
		return array('CartID');
	}
}

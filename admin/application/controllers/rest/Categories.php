<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Categories extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
	   // echo "here";
	   // $this->load->model('Category');
		parent::__construct( "Category" );
	}

	/**
	 * Default Query for API
	 * @return [type] [description]
	 */
	function default_conds()
	{
		$conds = array();

		if ( $this->is_get ) {
		// if is get record using GET method

			// get default setting for GET_ALL_MANUFACTURERS
			$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_CATEGORIES ));
            // print_r($setting);
			$conds['order_by'] = 1;
			$conds['order_by_field'] = $setting->order_by_field;
			$conds['order_by_type'] = $setting->order_by_type;
		}
		$conds['status'] = 'Active';

		return $conds;
	}

	/**
	 * Convert Object
	 */
// 	function convert_object( &$obj )
// 	{

// 		// call parent convert object
// 		parent::convert_object( $obj );

// 		// convert customize item object
// 		$this->ps_adapter->convert_manufacturer( $obj );
// 	}

}
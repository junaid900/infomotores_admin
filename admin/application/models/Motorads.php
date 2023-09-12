<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for backend config table
 */
class Motorads extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{ 
		parent::__construct( 'motorad', 'id', 'ad' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// id condition
// 		if ( isset( $conds['id'] )) {
// 			$this->db->where( 'id', $conds['id'] );
// 		}
	}
}
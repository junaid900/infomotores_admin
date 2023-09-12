<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Items extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
	   // echo "here";
		parent::__construct( 'Item' );
		$this->load->library( 'PS_Image' );
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

			// get default setting for GET_ALL_CATEGORIES
			//$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_CATEGORIES ));

			$conds['order_by'] = 1;
			$conds['order_by_field'] = $setting->order_by_field;
			$conds['order_by_type'] = $setting->order_by_type;
		}

		if ( $this->is_search ) {

			//$setting = $this->Api->get_one_by( array( 'api_constant' => SEARCH_WALLPAPERS ));

			if($this->post('searchterm') != "") {
				$conds['searchterm']   = $this->post('searchterm');
			}
			
			if($this->post('category_id') != "") {
				$conds['category_id']   = $this->post('category_id');
			}
			if($this->post('sell_type') != "") {
			 //   echo $this->post('sell_type');
				$conds['sell_type']   = $this->post('sell_type');
			}

			if($this->post('manufacturer_id') != "") {
				$conds['manufacturer_id']   = $this->post('manufacturer_id');
			}

			if($this->post('model_id') != "") {
				$conds['model_id']   = $this->post('model_id');
			}

			if($this->post('item_type_id') != "") {
				$conds['item_type_id']   = $this->post('item_type_id');
			}

			if($this->post('item_currency_id') != "") {
				$conds['item_currency_id']   = $this->post('item_currency_id');
			}
			if($this->post('item_location_id') != "") {
				$conds['item_location_id']   = $this->post('item_location_id');
			}
			
			if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_id') != "") {
				$conds['item_location_id']   = $this->post('item_location_id');
			} if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_id') == "") {
				$conds['item_location_id']   ="";
			} else {
				if($this->post('item_location_id') != "") {
					$conds['item_location_id']   = $this->post('item_location_id');
				}
			}

			if($this->post('condition_of_item_id') != "") {
				$conds['condition_of_item_id']   = $this->post('condition_of_item_id');
			}

			if($this->post('color_id') != "") {
				$conds['color_id']   = $this->post('color_id');
			}

			if($this->post('fuel_type_id') != "") {
				$conds['fuel_type_id']   = $this->post('fuel_type_id');
			}

			if($this->post('build_type_id') != "") {
				$conds['build_type_id']   = $this->post('build_type_id');
			}

			if($this->post('seller_type_id') != "") {
				$conds['seller_type_id']   = $this->post('seller_type_id');
			}

			if($this->post('transmission_id') != "") {
				$conds['transmission_id']   = $this->post('transmission_id');
			}

			if($this->post('min_price') != "") {
				$conds['min_price']   = $this->post('min_price');
			}

			if($this->post('max_price') != "") {
				$conds['max_price']   = $this->post('max_price');
			}

			if($this->post('brand') != "") {
				$conds['brand']   = $this->post('brand');
			}

			if($this->post('lat') != "") {
				$conds['lat']   = $this->post('lat');
			}

			if($this->post('lng') != "") {
				$conds['lng']   = $this->post('lng');
			}

			if($this->post('miles') != "") {
				$conds['miles']   = $this->post('miles');
			}
			if($this->post('item_type') != "") {
				$conds['item_type']   = $this->post('item_type');
			}

			if($this->post('added_user_id') != "") {
				$conds['added_user_id']   = $this->post('added_user_id');
			}
			if($this->post('item_type') != "") {
			 //   if($this->post('item_type') == "Rent" || $this->post('item_type') == "Sell"){
				    $conds['item_type']   = $this->post('item_type');
			 //   }
			}

			if($this->post('is_paid') != "") {
				$conds['is_paid']   = $this->post('is_paid');
			}
			if($this->post('year') != "") {
				$conds['year']   = $this->post('year');
			}
			if($this->post('color_id') != "") {
				$conds['color_id']   = $this->post('color_id');
			}
// 			echo $this->post('mileage');
			if($this->post('mileage') != "") {
			 //   echo "here";
				$conds['mileage']   = $this->post('mileage');
			}
			if($this->post('max_mileage') != "") {
			 //   echo "here";
				$conds['max_mileage']   = $this->post('max_mileage');
			}
			
			if($this->post('min_year') != "") {
				$conds['min_year']   = $this->post('min_year');
			}
			if($this->post('max_year') != "") {
				$conds['max_year']   = $this->post('max_year');
			}

	        if($this->post('service_area') != "") {
				$conds['service_area']   = $this->post('service_area');
			}

			if($this->post('status') != "") {
				$conds['status']   = $this->post('status');
			} else {
				$conds['status']   = 1;
			}

			$conds['item_search'] = 1;
			$conds['order_by'] = 1;
			$conds['order_by_field']    = $this->post('order_by');
			$conds['order_by_type']     = $this->post('order_type');
				
		}
// 		print_r($conds);

		return $conds;
	}

	function add_post() {
		$approval_enable = $this->App_setting->get_one('app1')->is_approval_enabled;
		if ($approval_enable == 1) {
			$status = 0;
		} else {
			$status = 1;
		}
		
		$catId = $this->post('category_id');
		if($catId == 15){//id for services
		    $rules = array(      
	         array(
        	'field' => 'title',
        	'rules' => 'required'
	        ),
			array(
	        	'field' => 'description',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'phone_number',
	        	'rules' => 'required'
	        ),
	       
	        array(
	        	'field' => 'service_area',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'item_location_id',
	        	'rules' => 'required'
	        ),
	        );
		}else{
		    // validation rules for user register
		$rules = array(
			array(
	        	'field' => 'manufacturer_id',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'category_id',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'item_location_id',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'price',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'year',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'phone_number',
	        	'rules' => 'required'
	        ),
	       // array(
	       // 	'field' => 'transmission_id',
	       // 	'rules' => 'required'
	       // ),
	       // array(
	       // 	'field' => 'title',
	       // 	'rules' => 'required'
	       // ),
	       //  array(
	       // 	'field' => 'lat',
	       // 	'rules' => 'required'
	       // ),
	       // array(
	       // 	'field' => 'lng',
	       // 	'rules' => 'required'
	       // )

        );
		}
		$lat = $this->post('lat');
		$lng = $this->post('lng');
        // $location = location_check($lat,$lng);

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

		$item_data = array(
		    "service_area" => $this->post('service_area'), 
        	"manufacturer_id" => $this->post('manufacturer_id'), 
        	"category_id" => $this->post('category_id'), 
        // 	"category_id" => $this->post('category_id'), 
        	"sell_type" => $this->post('sell_type'), 
        	"model_id" => $this->post('model_id'),
        	"item_type_id" => $this->post('item_type_id'),
        	"item_price_type_id" => $this->post('item_price_type_id'),
        	"item_currency_id" => $this->post('item_currency_id'), 
        	"condition_of_item_id" => $this->post('condition_of_item_id'),
        	"item_location_id" => $this->post('item_location_id'),
        	"color_id" => $this->post('color_id'),
        	"fuel_type_id" => $this->post('fuel_type_id'),
        	"build_type_id" => $this->post('build_type_id'),
        	"seller_type_id" => $this->post('seller_type_id'),
        	"transmission_id" => $this->post('transmission_id'),
        	"plate_number" => $this->post('plate_number'),
        	"description" => $this->post('description'),
        	"highlight_info" => $this->post('highlight_info'),
        	"price" => $this->post('price'),
        	"business_mode" => $this->post('business_mode'),
        	"is_sold_out" => $this->post('is_sold_out'),
        	"engine_power" => $this->post('engine_power'),
        	"steering_position" => $this->post('steering_position'),
        	"no_of_owner" => $this->post('no_of_owner'),
        	"trim_name" => $this->post('trim_name'),
        	"vehicle_id" => $this->post('vehicle_id'),
        	"price_unit" => $this->post('price_unit'),
        	"year" => $this->post('year'),
        	"licence_status" => $this->post('licence_status'),
        	"max_passengers" => $this->post('max_passengers'),
        	"no_of_doors" => $this->post('no_of_doors'),
        	"item_type" => $this->post('item_type'),
        	"mileage" => $this->post('mileage'),
        	"license_expiration_date" => $this->post('license_expiration_date'),
        	"title" => $this->post('title'),
        	"address" => $this->post('address'),
        	"lat" => $this->post('lat'),
        	"lng" => $this->post('lng'),
        	"status" => $status,
        	"id" => $this->post('id'),
        	"added_user_id" => $this->post('added_user_id'),
        	"added_date" =>  date("Y-m-d H:i:s"),
        	"slip_url" => $this->post('slip_url'),
        	"package_detail" => $this->post('package_detail'),
        	"phone_number" => $this->post('phone_number'),
        	"email" => $this->post('email'),
        	"manufacturer_name" => $this->post('manufacturer_name'),
        	"model_name" => $this->post('model_name'),
        	"second_phone_number" => $this->post('second_phone_number'),
        	"negotiable" => $this->post('negotiable'),
        	"hours" => $this->post('hours'),
        );

		
		$id = $item_data['id'];
		
		if($id != ""){
		 	$status = $this->Item->get_one($id)->status;
			$item_data['status'] = $status;
		 	$this->Item->save($item_data,$id);

			///start deep link update item tb by MN
			$description = $item_data['description'];
			$title = $item_data['title'];
			$conds_img = array( 'img_type' => 'item', 'img_parent_id' => $id );
	        $images = $this->Image->get_all_by( $conds_img )->result();
			$img = $this->ps_image->upload_url . $images[0]->img_path;
			$deep_link = deep_linking_shorten_url($description,$title,$img,$id);
			$itm_data = array(
				'dynamic_link' => $deep_link
			);
			$this->Item->save($itm_data,$id);
			///End

		} else{
		  //  print_r($item_data);
		  //  exit;

		 	$this->Item->save($item_data);

		 	$id = $item_data['id'];
		 	// echo $id;
		 	///start deep link update item tb by MN
			$description = $item_data['description'];
			$title = $item_data['title'];
			$conds_img = array( 'img_type' => 'item', 'img_parent_id' => $id );
	        $images = $this->Image->get_all_by( $conds_img )->result();
			$img = $this->ps_image->upload_url . $images[0]->img_path;
			$deep_link = deep_linking_shorten_url($description,$title,$img,$id);
			$itm_data = array(
				'dynamic_link' => $deep_link
			);
			$this->Item->save($itm_data,$id);
			///End

		}
		 
		$obj = $this->Item->get_one( $id );
		
		$this->ps_adapter->convert_item( $obj );
		$this->custom_response( $obj );

	}


	/**
	* Trigger to delete item related data when item is deleted
	* delete item related data
	*/

	function item_delete_post( ) {

		// validation rules for item register
		$rules = array(
			array(
	        	'field' => 'item_id',
	        	'rules' => 'required'
	        )
	    );   
	    
	    // exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $id = $this->post('item_id');

        $conds['id'] = $id;

        // check user id

        $item_data = $this->Item->get_one_by($conds);

        //print_r($item_data);die;


        if ( $item_data->id == "" || $item_data->status == "-1" ) {

        	$this->error_response( get_msg( 'invalid_item_id' ));

        } else {

        	// delete Item -just updated status - modified by PP @18Dec2020
        	$itm_data['status'] = -1 ;
			if ( !$this->Item->save( $itm_data,$id )) {

				return false;
			}

        	// $conds_id['id'] = $id;
         	// $conds_item['item_id'] = $id;
        	// $conds_img['img_parent_id'] = $id;

			// // delete Item
			// if ( !$this->Item->delete_by( $conds_id )) {

			// 	return false;
			// }

			
			// // delete chat history
			// if ( !$this->Chat->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete favourite
			// if ( !$this->Favourite->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete item reports
			// if ( !$this->Itemreport->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete touches
			// if ( !$this->Touch->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete images
			// if ( !$this->Image->delete_by( $conds_img )) {

			// 	return false;
			// }

			// // delete paid item
			// if ( !$this->Paid_item->delete_by( $conds_item )) {

			// 	return false;
			// }
			
			$this->success_response( get_msg( 'success_delete' ));

        }


	}

	/**
	 * Update Price 
	 */
	function sold_out_from_itemdetails_post()
	{
		// validation rules for chat history
		$rules = array(
			array(
	        	'field' => 'item_id',
	        	'rules' => 'required'
	        )
        );


		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;
        $id = $this->post('item_id');
        $item_sold_out = array(

        	"is_sold_out" => 1, 

        );

        $this->Item->save($item_sold_out,$id);
        $conds['id'] = $id;
        
        $obj = $this->Item->get_one_by($conds);

        $this->ps_adapter->convert_item( $obj );
        $this->custom_response($obj);
    }


	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{

		// call parent convert object
		parent::convert_object( $obj );

		// convert customize item object
		$this->ps_adapter->convert_item( $obj );
	}

}
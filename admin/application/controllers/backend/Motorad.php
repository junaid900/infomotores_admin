<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Likes Controller
 */

class Motorad extends BE_Controller {
		/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'Motor Ads' );
// 		echo "here";
		///start allow module check 
		$conds_mod['module_name'] = $this->router->fetch_class();
		$module_id = $this->Module->get_one_by($conds_mod)->module_id;
		
		$logged_in_user = $this->ps_auth->get_user_info();

		$user_id = $logged_in_user->user_id;
		if(empty($this->User->has_permission( $module_id,$user_id )) && $logged_in_user->user_is_sys_admin!=1){
			return redirect( site_url('/admin/') );
		}
	
		///end check
	}

	/**
	 * Load About Entry Form
	 */

	function index(  ) {
		
	    if ( $this->is_POST()) {
		// if the method is post

			// server side validation
			if ( $this->is_valid_input()) {
                
                    	$this->save(  );
                // }
			
			}
		}
        // echo "here";
		$this->data['motorad'] = $this->Motorads->get_all();
		
		
		$this->load_form($this->data);

	}
	function deleteItem($id){
	    $this->db->delete('motorad',array('id'=>$id));
	 	redirect( site_url('/admin/motorad') );   
	}

	/**
	 * Update the existing one
	 */
	function edit( $id = "be1") {
        if ( $this->is_POST()) {
	       // $this->save( $id );
	        if ( $this->is_valid_input()) {
                $id = $this->get_data('id');
                if(!empty($id)){
                    	$this->save( $id );
                }
			
			}
        }
		// load user
// 		echo "here";
	    $this->data['motorad'] = $this->Motorads->get_all();
		$this->data['edit_motorad'] = $this->Motorads->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	/**
	 * Saving Logic
	 * 1) save about data
	 * 2) check transaction status
	 *
	 * @param      boolean  $id  The about identifier
	 */
	function save( $id = false ) {
        // echo "here";
        // exit;
		// start the transaction
		$this->db->trans_start();
		
		// prepare data for save
		$data = array();
// 		$id = date('Ymdhis').rand(100).rand(100);
//         $data['id'] = $id;
		// sender_name
		if ( $this->has_data( 'name' )) {
			$data['name'] = $this->get_data( 'name' );
		}

// 		// sender_email
		if ( $this->has_data( 'description' )) {
			$data['description'] = $this->get_data( 'description' );
		}
			if ( $this->has_data( 'url' )) {
			$data['url'] = $this->get_data( 'url' );
		}

        // $result = $this->db->insert("motorad",$data);
        
		if ( ! $this->Motorads->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// rollback the transaction
			$this->db->trans_rollback();

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}
		
// 		echo $/this->db->last_query();
// 		exit;
		/** 
		 * Upload Image Records 
		 */
		 $isEdit = false;
		 if(!$id){
		   $id = $this->db->insert_id();
		 }else{
            $isEdit = true;
		   if(!empty($_FILES)){
		      // print_r($_FILES);
		      // exit;
		       if(!empty($_FILES['image']['name'])){
		            $this->Image->delete_image_by_parent('motorad',$id);   
		       }
		   }
		 }
		 
		 
		if ( $id ) {
			if ( ! $this->insert_images( $_FILES, 'motorad', $id)) {
				// if error in saving image

					// commit the transaction
					if(!$isEdit){
    					$this->db->trans_rollback();
    					
    					return;
					}
				}
			}


		// commit the transaction
		if ( ! $this->check_trans()) {
        	
			// set flash error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {

			if ( $id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_motor_ad' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_motor_ad' ));
			}
		}

		
		redirect( site_url('/admin/motorad') );

	}

	 /**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) {
 		return true;
	}
}
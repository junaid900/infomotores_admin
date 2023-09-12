<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for api table
 */
class App extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_app', 'app_id', 'app' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// api_id condition
		if ( isset( $conds['app_id'] )) {
			
			$this->db->where( 'api_id', $conds['api_id'] );
		}

	}
	function send_email($to,$sub,$message )
      {
        $this->load->library('email');
    
        $to_email = $to;
        $subject = $sub;
        $message = $message;
    
        $config = array(
          'protocol' => 'smtp',
          'smtp_host' => 'infomotores.com',
          'smtp_port' => 587,
          'smtp_user' => 'admin@infomotores.com',
          'smtp_pass' => 'Infomotores1122',
          'mailtype' => 'html',
          'charset' => 'utf-8'
        );
    
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from('no-reply@infomotores.com', 'Info Motores');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        // var_dump($this->email->send());
        if($this->email->send())
        {
            return true;
        //   echo 'Email has been sent successfully';
        }
        else
        {
            return false;
        //   echo 'Email could not be sent';
        }
      }
}
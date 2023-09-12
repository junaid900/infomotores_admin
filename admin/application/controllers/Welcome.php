<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    echo "here";
		$this->load->view('welcome_message');
	}
	public function email_template($param1='',$param2='',$param3='',$param4=''){
	    $data = [];
	    if($param1 == 'new_item'){
	        $data = json_decode($parame2);
	    }
	   // $res = $this->App->send_email('junaidaliansaree@gmail.com','info motores confirmation',$this->load->view('email_templates/item_template',[],TRUE));
	    $this->load->view('email_templates/item_template');
	    
	}
	public function send_email($to,$sub,$message )
      {
        $this->load->library('email');
    
        $to_email = 'junaidaliansaree@gmail.com';
        $subject = 'Subject of the email';
        $message = 'The body of the email message';
    
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

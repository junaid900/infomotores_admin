<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Items Controller
// * @property  Category
 */
class Apis extends CI_Controller {
      
    function __construct() {
       	parent::__construct();
       	 header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, *');     
        $this->output->set_header('Content-Type : application/json; charset=UTF-8');
        $this->load->library( 'PS_Adapter' );
    }
    public function index(){
        echo "here";
    }
    public function get_categories(){
        $this->db->order_by("order_by_field","ASC");
        $categories = $this->db->get_where("bs_category",["status"=>"Active"])->result();
        // print_r($categories);
        if($categories){
        $this->response(1,"success",$categories);
        }else{
            $this->response(1,"not categories found");
        }
         
    }
    public function get_products_count($id = ''){
        $where = 'Where i.status = 1';
        if(!empty($id)){
            $where .= " And c.category_id = $id";
        }
        $res = $this->db->query("SELECT COUNT(*) as count FROM bs_items i LEFT JOIN bs_manufacturers m on i.manufacturer_id = m.id left join bs_category c on m.category_id = c.category_id $where")->first_row();
        $this->response(1,"Success",$res);
    }
    public function uploadSlip(){
        // echo "<pre>";
        // print_r($_POST);
        if(!isset($_POST['image'])){
            $this->response(0,"not image found");
        }
        $img = $_POST['image'];
        
        $fileUrl = $this->uploadDirBase64Image($img, '/slips');
        if($fileUrl){
            $this->response(1,"success",['url'=>$fileUrl]);
        } else {
            $this->response(0,"cannot upload image");
        }
    }
    
    public function uploadDirBase64Image($img,$dir){
        // $img = $_REQUEST['img'];
        // echo $img;
        $data = base64_decode($img);
        $file = "uploads/$dir/" . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        if($success)
        return $file;
        else
        return NULL;
    }
    
    public function response($status = 0 , $message = "" , $res = []){
        echo json_encode(["status"=>$status,"message"=>$message,"response"=>$res]);
        exit();
    }
    public function sendNewItemMail($type, $param1='',$param2 = '',$param3=''){
        $id = $param1;
        $item = $this->Item->get_one($id);
        $item->title = get_item_name($id);
        $user = $this->User->get_one($item->added_user_id);
        $title = 'Solicitação de item bem-sucedida';
        $message = "Sua solicitação de item foi enviada com sucesso, suas informações de anúncio mencionadas abaixo.";
        $data['items'][] = $item;
        $data['user'] = $user;
        $data['title'] = $title;
        $data['message'] = $message;
        $email1 = $item->email;
        $email2 = $user->user_email;
        // echo "<pre>";
        // var_dump($data);
        $result = false;
        if(!empty($email1)){
            $res = $this->App->send_email($email1,$title,
            $result = $this->load->view('email_templates/item_template',$data,TRUE));
            if($email1 == $email2){
                return true;
            }
        }
        if(!empty($email2)){
            $res = $this->App->send_email($email2,$title,
            $result = $this->load->view('email_templates/item_template',$data,TRUE));
        }
        return $result;
    }
    public function send_mail($type, $param1='',$param2 = '',$param3=''){
        if($type == 'new_item'){
            if(empty($param1)){
                return $this->response(0,"cannot send email no item found");
            }
            $result = $this->sendNewItemMail($type,$param1,$param2,$param3);
            if($result) $this->response(1,"success");
            else $this->response(0,"error while sending mail");
        }
    }
    function getAds(){
	    $data = $this->db->get("motorad")->result_array();
	    $arr = [];
	    foreach($data as $d){
	        $conds = array( 'img_type' => 'motorad', 'img_parent_id' => $d['id'] );
            $images = $this->Image->get_all_by( $conds )->row();
            // $images->mId = $conds;
            // print_r($images);
            $d['image'] = $images;
            $arr[] = $d;
	    }
	    return $this->response(1,"success",$arr);
	    
	}
}
<?php
class Login extends CI_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('user/login_model');
       }
       public function index()
       {
           $this->load->model('admin/product_model');
           $data['msg'] = $this->session->flashdata('msg');
            $data['title'] = 'Login';
            $data['page'] = 'user/login';
            if($this->input->post())
            {
                 $auth = $this->login_model->UserAuth($this->input->post());
                 if(isset($auth->fld_id))
                 {
                     if(isset($auth->fld_status) && $auth->fld_status==1)
                     {
                         $this->session->set_userdata();
//                         $this->session->set_userdata('total_frame',$qty->temp);
//                         $this->session->set_userdata('total_frame',$qty->temp);
//                         $this->session->set_userdata('total_frame',$qty->temp);
//                         $this->session->set_userdata('total_cart_items',($qty->temp+$qty->accessories));
                         $this->session->set_userdata('userId',$auth->fld_id);
                         $this->session->set_userdata('username',$auth->fld_username);
                         $this->session->set_userdata('first_name',$auth->fld_first_name);
                         $this->session->set_userdata('last_name',$auth->fld_last_name);
//                         echo $this->session->userdata('userId');
//                         echo $this->session->userdata('fld_id');
//                         exit;
//                         $this->insert_to_tbl();
//                         exit;
                         redirect(base_url().'user/login/logged_in');
                     }
                     else
                     {
                         $data['error_message'] = 'You have not activated your account yet.Please check your email.';	
                     }
                 } 
                 else
                 {	
                     if($this->input->post('link_login'))
                     {
                         $data['title'] = '. : : Login unknown : : .';
                         $data['page'] = 'user/login_unknown';
                     }			
                     $data['error_message'] = 'Invalid Login.';	
                 }
             }
             $data['page']='user/login';
             $this->load->view('user/container',$data);
	}
        function ActivateAccount()
        {
           $id = $_GET['id'];     
           $confirmKey = $_GET['confirmKey'];
           
           //check if the key belongs to the specified user 
           $keyChecked = $this->login_model->CheckKey($id,$confirmKey);
           if(isset($keyChecked) && $keyChecked->fld_id>0)
           {
                $data = array(
                                'fld_status' =>1,
                                'fld_key'    =>"",
                         );
                $this->login_model->EditToActivateAccount($id,$data);
                $this->session->set_flashdata('message','Congratulation.Your account has been activated.');
                redirect(base_url().'user/login');
           }    
           else
           {
               $this->session->set_flashdata('message','You are seeing this message because your account has already been activated and you are tyring to reactivate it.If you have forgotten your password then click on the forgot password link and reset new password.');
               redirect(base_url().'user/login');
           }
           
        }
        function LoginUnknown($event="")
        {
            $data['title'] = '. : : Login unknown : : .';
            $data['page'] = 'user/login_unknown';
            $data['event'] = $event;
            $this->load->view('user/container', $data);
	}
        function CreateSocialAccount()
        {
            if($this->input->post('social_username'))
            {			
                    $this->load->model('user/login/onsite_model');
                    $id = $this->onsite_model->SocialUserRegister($this->input->post('social_username'));				
                    if(isset($id) && $id>0)
                    {
                        $this->session->set_userdata('userId', $id);
                        redirect('/user/dashboard');	
                    }
                    else
                    {				
                            $data['social_error_message'] = 'User already exists.';	
                    }					
            }			
            $data['page'] = 'login_unknown';
            $this->load->view('container', $data);
        }
        function logout()
        {
            $this->session->sess_destroy();
            redirect(base_url().'user/login');
        }
        function insert_to_tbl(){
            $this->load->model('admin/product_model');
            foreach($this->cart->contents() as $items){
                $data_product = array(
                    'fld_product'=>$items['id'],
                    'fld_lens_type'=>$items['options']['lens_type_id'],
                    'fld_color'=>$items['options']['product_color_id'],
                    'fld_lens_package'=>$items['options']['lens_package_id'],
                    'fld_lens_upgrade'=>$items['options']['lens_upgrade_id']."_".$items['options']['lens_upgrade_attr_id']."_".$items['options']['lens_upgrade_value_id'],
                    'fld_user'=>$this->session->userdata('userId')
                );
                $this->product_model->insert_product_info($data_product);
            }
        }
        
        function check_cart_item(){
            $this->load->model('admin/product_model');
            return $this->product_model->get_product_qty();
        }
        function logged_in(){
            $qty = $this->check_cart_item();
            if($qty->temp>0){
                $this->product_model->change_user_id('tbl_temp','fld_user');
             }
             if($qty->accessories>0){
                 $this->product_model->change_user_id('tbl_temp_accessories','fld_user_id');
             }
           if($qty->contact_lenses>0){
               $this->product_model->change_user_id('tbl_temp_contact_lenses','fld_user_id');
           }
             if($this->input->post('link_login'))
             {
                 $this->load->model('user/login/fblogin_model');
                 $this->fblogin_model->ConnectSignature();	
             }
             $url =  explode('=',$_SERVER['HTTP_REFERER']);
             $return_url = $this->session->userdata('return_url');
                if(isset($url[1])){
                    $return_url = $url[1];
                    redirect(base_url().$return_url);
                }
                else if($return_url!="" || $return_url!=null){
                    redirect(base_url().$return_url);
                }
                else redirect(base_url().'user/control_panel');
        }
       
}

<?php
class Social_registration extends CI_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('user/registration/social_registration_model');
            // Your own constructor code
       }
//       function CreateSocialAccount()
//       {
//           if($this->input->post('fld_social_username'))
//           {			
//               $id = $this->social_registration_model->SocialUserRegistration($this->input->post('fld_social_username'));	
//               if(isset($id) && $id>0)
//               {
//                   $this->session->set_userdata('userId', $id);
//                   redirect(base_url().'user/control_panel');	
//               }
//               else
//               {				
//                   $data['social_error_message'] = 'User already exists.';	
//               }					
//           }
//           $data['error_message'] = 'Invalid Username.';
//           $data['page'] = 'user/registration/fb_register';
//           $this->load->view('user/container', $data);
//       }
}
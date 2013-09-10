<?php
class Forgot_password extends CI_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('user/forgot_password_model');
       }
       function Index()
       {
           if($this->input->post())
           {
               if($this->input->post('fld_email'))
               {
                   $userData = $this->forgot_password_model->CheckEmail($this->input->post('fld_email'));
                   if(isset($userData->fld_email) && $userData->fld_email!="")        
                   {
                       //reset token is generated and stored in tbl_user_login of respectible user
                       $currentDate = date('Y-m-d \ h:i:s');
                       $data['fld_reset_token'] = random_string('alnum', 15);
                       $data['fld_token_exp'] = date('y-m-d \ h:i:s ',strtotime($currentDate.'+1 day'));
                       
                       $this->load->model('user/login_model');
                       $this->login_model->EditToActivateAccount($userData->fld_id,$data);
                       
                       //sending the newly generated reset token to mail the user
                       //userData is the collection of data that is send via email to user
                       //so the newly generated reset token is added to variable userData
                       $userData->reset_token = $data['fld_reset_token'];     
                       $userData->purpose = 'forgot_password';
                       $this->load->helper('email');
                       SendEmail($userData);
                       redirect(base_url().'user/login');
                   }
                   else
                   {
                       $data['error_message'] = 'Sorry, no associated account found.';
                   }
               }
               else
               {
                   $data['error_message'] = 'Invalid Email';
               }
           }
           $data['title'] = 'Forgot Password';
           $data['page'] = 'user/forgot_password';
           $this->load->view('user/container',$data);
       }
       function ResetPassword()
       {
           if($this->input->post())
           {
               if($this->input->post('fld_username'))
               {
                   if($this->input->post('fld_new_password') && ($this->input->post('fld_new_password') == $this->input->post('fld_confirm_new_password')))
                   {
                       
                       //store the new password by editing the tbl_user_login  of respectible user
                       //and also deleting the reset token of particular process of reseting environment
                       $data = array(
                                        'fld_password'=>md5($this->input->post('fld_new_password')),
                                        'fld_reset_token'=>""
                                    );
                       
                       $this->load->model('user/login_model');
                       $this->login_model->EditToActivateAccount($this->input->post('hd_id'),$data);
                            
                       $this->session->set_flashdata('message', 'Congratulation.You have sucessfully changed your password.');
                       redirect(base_url().'user/login');     
                       
                   }
                   else
                   {
                       $data['error_message'] = 'Passwords did not match.';
                   }
               }
               else
               {
                   $data['error_message'] = 'Invalid Data';
               }
               $data['id'] = $this->input->post('hd_id');
               $data['username'] = $this->input->post('fld_username');
               
           }
           else
           {
                $userId = $_GET['id'];
                $resetToken = $_GET['reset_token'];
                //check if the token belongs to the user
                $tokenChecked = $this->forgot_password_model->CheckToken($userId,$resetToken);
                                                       
                if(isset($tokenChecked) && $tokenChecked->fld_id>0)        
                {
                    //check if the token is expired
                    //print_r(new DateTime("now"));
                    $todaysDate = date('Y-m-d \ h:i:s');
                    $today = strtotime($todaysDate);
                    $expirationDate = strtotime($tokenChecked->fld_token_exp);
                    if($today>$expirationDate) 
                    {
                        $data['error_message'] = 'The token has expired.Please request for another reset token';
                        $data['title'] = 'Forgot Password | I am Gallarian';
                        $data['page'] = 'user/forgot_password';
                        $this->load->view('user/container',$data);
                    }
                    $data['id'] = $tokenChecked->fld_id;
                    $data['username'] = $tokenChecked->fld_username;
                }
                else
                {
                    $data['error_message'] = 'This token does not belong to you.Please request for another reset token.';
                }
           }
           $data['title'] = 'Reset Password | I am Gallarian';
           $data['page'] = 'user/reset_password';
           $this->load->view('user/container',$data);
       }
}
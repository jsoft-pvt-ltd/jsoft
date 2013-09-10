<?php
class Fblogin extends CI_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('user/social_model');
       }
       public function index()
       {
            parse_str($_SERVER['QUERY_STRING'], $_REQUEST);

            $config['appId'] = '135651193298682';
            $config['secret'] = 'e69a0e4f4b8cf995a76da22412391e2d';
            $this->load->library('facebook', $config);
            $loginUrl = $this->facebook->getLoginUrl(array(
                                                            'scope' => 'email,publish_stream,user_photos,friends_photos',
                                                            'domain' => 'http://www.eyegizmo.com',
                                                            'redirect_uri' => base_url() . "user/fblogin/login",
                                                            'display' => 'popup',
                                                            'cookie' => true
                                                            ));
            redirect($loginUrl);
       }
       function login()        
       {
            parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
            $config['appId'] = '135651193298682';
            $config['secret'] = 'e69a0e4f4b8cf995a76da22412391e2d';
            $config['cookie'] = 'true';

            $this->load->library('facebook', $config);

            try
            {
                    $userSocialId = $this->facebook->getUser();
                    $me = $this->facebook->api('/me');
                    $me['profile_image_url'] = "http://graph.facebook.com/".$me['username']."/picture";
                    $this->session->set_userdata('me',$me);
                    $this->session->set_userdata('service','facebook');
                    $this->session->set_userdata('userSocialId',$userSocialId);
                    echo "<script>window.close();</script>";

            }
            catch (FacebookApiException $e)
            {
                print_r($e);
                exit;
            }
       }
       function FCheckLoginIn()
       {
           header("Cache-Control: no-cache, must-revalidate"); 
           $this->load->helper("login_helper");
           echo IsLoggedIn_();
       }
       function Manage()
       {
           $service = "facebook";
           $auth = $this->social_model->CheckSocialLogin($this->session->userdata('userSocialId'),$service);
           if(isset($auth->fld_user_id))
           {
               $userInfo = $this->social_model->SelectUserInfo($auth->fld_user_id);
               if(isset($userInfo->fld_id))
               {
                   $this->session->set_userdata('userId',$userInfo->fld_id);
                   redirect(base_url().'user/control_panel');
               }
           }
           else
           {				
               $data['page']  = 'user/fb_login_unknown';
               $data['title'] = 'Social Login | Optical Store Online';
               $this->load->view('user/container',$data);
           }
       }
       function Link()
       {
           if($this->input->post('fld_username') && $this->input->post('fld_password'))
           {
               $this->load->model('user/login_model');
               $auth = $this->login_model->UserAuth($this->input->post());
               
               if(isset($auth->fld_id))
               {
                   $this->session->set_userdata('userId',$auth->fld_id);
                   $me = $this->session->userdata('me');
                   $data = array(
                                    'fld_user_id' => $auth->fld_id,
                                    'fld_signature' => $me[id],
                                    'fld_service' => 'facebook',
                                    'fld_profile_url' => $me['link']
                                );
                   $this->social_model->ConnectSignature($data);
                   redirect(base_url().'user/control_panel');
               }
           }
           $data['error_message'] = "Invalid Login."; 
           $data['page']  = 'user/fb_login_unknown';
           $data['title'] = 'Social Login | I am Gallarian';
           $this->load->view('user/container',$data);
       }
       function Register()
       {
           $data['social_error_message'] = 'Invalid Username.';
           if($this->input->post('fld_social_username'))
           {			
               $id = $this->social_model->Register_($this->input->post('fld_social_username'));
               if(isset($id) && $id>0)
               {
                   $this->session->set_userdata('userId', $id);
                   redirect(base_url().'user/control_panel');	
               }
               else if($id==="email")
               {
                   $data['social_error_message'] = 'Sorry,there is already an account with your fb email id.Please use it to reset your password or try with other email account.';
               }
               else
               {				
                   $data['social_error_message'] = 'User already exists.';	
               }					
           }
           $data['title'] = 'Login Unknown | Optical Store Online';
           $data['page'] = 'user/fb_login_unknown';
           $this->load->view('user/container', $data);
       }

} 
?>

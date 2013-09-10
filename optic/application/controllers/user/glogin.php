<?php
//include google api files
require_once getcwd().'/google/src/Google_Client.php';
require_once getcwd().'/google/src/contrib/Google_Oauth2Service.php';
class Glogin extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user/social_model');
    }
    function Index()
    {
        ########## Google Settings.. Client ID, Client Secret #############
        $google_client_id 	= '368561884066.apps.googleusercontent.com';
        $google_client_secret 	= 'g2-vEoP1WlNZif8Er1QZguHD';
        $google_redirect_url 	= base_url().'user/glogin/index';         
        $google_developer_key 	= 'AIzaSyATS7_bVYyxQbod9uqOeDZqvUR0-BetMZw';
        
        $gClient = new Google_Client();
        $gClient->setApplicationName('Optic');
        $gClient->setClientId($google_client_id);
        $gClient->setClientSecret($google_client_secret);
        $gClient->setRedirectUri($google_redirect_url);
        $gClient->setDeveloperKey($google_developer_key);

        $google_oauthV2 = new Google_Oauth2Service($gClient);

        //If user wish to log out, we just unset Session variable
        if (isset($_REQUEST['reset'])) 
        {
//          echo 'u';exit;
            unset($_SESSION['token']);
            $gClient->revokeToken();
            header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
        }

        //Redirect user to google authentication page for code, if code is empty.
        //Code is required to aquire Access Token from google
        //Once we have access token, assign token to session variable
        //and we can redirect user back to page and login.
        if (isset($_GET['code'])) 
        { 
            //(2)
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
//            header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
//            return;
        }
        if (isset($_SESSION['token'])) 
        { 
            //(3)
            $gClient->setAccessToken($_SESSION['token']);
        }
        if ($gClient->getAccessToken()) 
        {
            //(4)
            //Get user details if user is logged in
            $user                                       = $google_oauthV2->userinfo->get();
            
            $me['user_id']                              = $user['id'];
            $me['name']                                 = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            list($me['first_name'], $me['last_name'])   = explode(" ", $me['name'],2);
            $email                                      = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
            $me['email']                                = $email;                        
            $me['link']                                 = filter_var($user['link'], FILTER_VALIDATE_URL);
            $profile_image_url                          = filter_var($user['picture'], FILTER_VALIDATE_URL);
            $me['profile_image_url']                    = $profile_image_url;
            $me['personMarkup']                         = "$email<div><img src='$profile_image_url?sz=50'></div>";
            $_SESSION['token']                          = $gClient->getAccessToken();
           
            try{
                $this->session->set_userdata('userSocialId',$me['user_id']);
                $this->session->set_userdata('me',$me);
                $this->session->set_userdata('service','google');
                echo "<script>window.close();</script>";
            }
            catch(Exception $e){
                print_r($e);exit;
            }
   
        }
        else 
        {           
            //(1)get google login url
            $authUrl = $gClient->createAuthUrl();
//            print_r($authUrl);exit;
            redirect($authUrl);
        }
        
    }
    public function GCheckLoginIn()
    {
        header("Cache-Control: no-cache, must-revalidate"); 
        $this->load->helper("login_helper");
        echo IsLoggedIn_();
    }
    public function Manage()
    {
        $service = "google";
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
                $data['page']  = 'user/glogin_unknown';
                $data['title'] = 'Social Login | Optic Store Online';
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
                                'fld_signature' => $me[user_id],
                                'fld_service' => 'google',
                                'fld_profile_url' => $me['link']
                            );
               $this->social_model->ConnectSignature($data);
               redirect(base_url().'user/control_panel');
           }
        }
        $data['error_message'] = "Invalid Login."; 
        $data['page']  = 'user/glogin_unknown';
        $data['title'] = 'Social Login | Optic Store Online';
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
                $data['social_error_message'] = 'Sorry,there is already an account with your gmail id.Please use it to reset your password or try with other email account.';
            }
            else
            {				
                $data['social_error_message'] = 'User already exists.';	
            }					
        }
        $data['title'] = 'Login Unknown | Optical Store Online';
        $data['page'] = 'user/glogin_unknown';
        $this->load->view('user/container', $data);
    }
}
?>

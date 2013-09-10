<?php
class Register extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/register_model');
    }
    function index()
    {
        if($this->input->post())
        {
            $data['user_post'] = $this->input->post();
            if($this->input->post('fld_username'))
            {
                if($this->input->post('fld_email'))
                {
                    $emailFlag = $this->register_model->CheckForEmail($this->input->post('fld_email'));
                    if(empty($emailFlag))
                    {
                        if($this->input->post('fld_password'))
                        {
                            if($this->input->post('fld_password') == $this->input->post('fld_confirm_password'))
                            {
                                $data = array(
                                        'fld_username'   =>$this->input->post('fld_username'),
                                        'fld_password'   =>md5($this->input->post('fld_password')),
                                        'fld_first_name' =>$this->input->post('fld_first_name'),
                                        'fld_last_name'  =>$this->input->post('fld_last_name'),
                                        'fld_email'      =>$this->input->post('fld_email'),
                                        'fld_country'    =>$this->input->post('fld_country'),
                                        'fld_state'      =>$this->input->post('fld_state'),
                                        'fld_city'       =>$this->input->post('fld_city'),
                                        'fld_contact_no' =>$this->input->post('fld_contact_no'),
                                        'fld_myself'     =>$this->input->post('fld_myself'),
                                        'fld_key'        =>random_string('alnum', 15),
                                        'fld_date_registered'=>date("Y/m/d H:i:s")
                                    ); 
                                $id = $this->register_model->UserRegister($data);
                                if(isset($id) && $id>0)
                                {
                                    $user['fld_user']=$id;
                                    $user['fld_date']=date("Y/m/d H:i:s");
                                    //to give notice to admin that a new user has registered.
                                    //inserts the user id into tbl_acc_notice;
                                    $this->load->model('user/login_model');
                                    $this->login_model->acc_notice($user);
                                    
                                    $userData = $this->register_model->GetUserData($id);
                                    $userData->purpose = 'send_confirmation_email';
                                     //call to an email helper
                                    $this->load->helper('email');
                                    SendEmail($userData);
                                    redirect(base_url().'/user/login');
                                }
                                else
                                {
                                    $data['user_post'] = $this->input->post();
                                    $data['error_message'] = 'User already exists. Please try with different username and email.';	
                                }
                            }
                            else
                            {
                                $data['error_message'] = 'Password mismatches';
                            }
                        }
                        else
                        {
                            $data['error_message'] = 'Password is required.';
                        }
                    }
                    else
                    {				
                        $data['error_message'] = 'Sorry ! The email address is already associated with another account.Please try another email account.';
                    }
                }
                else
                {
                    $data['error_message'] = 'Invalid email.';
                }
            }
            else
            {
                $data['error_message'] = 'Invalid Username.';
            }
        }
        $data['title'] = 'Register';
        $this->load->view('user/register',$data);
    }
//    public function dashboard()
//    {
//         if(IsLoggedIn()==0)
//            redirect(base_url().'user/login/onsite');
//         
//         $userdata = $this->onsite_model->getUserData($this->session->userdata('userId'));
//         $username = $userdata->fld_username;		
//         $data['username'] = $username;
//         $data['firstname'] = $this->session->userdata('firstname');
//         $data['lastname'] = $this->session->userdata('lastname');
//         $data['thumb_url'] = $this->session->userdata('thumb_url');
//         $data['link'] = $this->session->userdata('link');		
//         $data['service'] = $this->session->userdata('service');
//         $data['timezone'] = $this->session->userdata('timezone');
//         $data['locale'] = $this->session->userdata('locale');
//         $data['page'] = 'user/dashboard';
//         $this->load->view('user/container', $data);
//     }
}
?>

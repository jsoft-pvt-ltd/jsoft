<?php class Change_password extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user/change_password_model');
    }
    function Index()
    {
        if($this->input->post())
        {
            if($this->input->post('fld_current_password'))
            {
                $result = $this->change_password_model->CheckForPassword($this->input->post('fld_current_password'));
                if(isset($result->fld_id))
                {
                    if($this->input->post('fld_new_password'))
                    {
                        if($this->input->post('fld_confirm_new_password'))
                        {
                            if($this->input->post('fld_new_password') == $this->input->post('fld_confirm_new_password'))
                            {
                                $data = array(
                                                'fld_password'=>md5($this->input->post('fld_new_password'))
                                        );
                                $this->load->model('user/login/onsite_model');
                                $this->onsite_model->EditToActivateAccount($this->session->userdata('userId'),$data);
                                $data['success_message'] = "Your password has been successfully changed.";
//                                $this->output->enable_profiler(TRUE);
                            }
                            else
                            {
                                $data['error_message']="Passwords did not match.";
                            }
                        }
                        else
                        {
                            $data['error_message']="Confirm password is required.";
                        }
                    }
                    else
                    {
                        $data['error_message'] = "New password is required. ";
                    }
                }
                else
                {
                    $data['error_message'] = "Your current password did not match.";
                }
            }
            else
            {
                $data['error_message'] = "Current password is required.";
            }
            
        }
        $data['username'] = $this->session->userdata('username');
        $data['title'] = 'Change Password';
        $data['page'] = 'user/change_password';
        $this->load->view('user/container',$data);
    }
}
?>
<?php class Login extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/login_model');
    }
    function Index()
    {
        if($this->input->post())
        {
            if($this->input->post('fld_username') || $this->input->post('fld_password'))
            {
                $auth = $this->login_model->CheckLogin($this->input->post());
                if(isset($auth->fld_id))
                {
                    $this->session->set_userdata('admin_logged_in',true);
                    $this->session->set_userdata('admin_id',$auth->fld_id);
                    $this->session->set_userdata('admin_name',$auth->fld_name);
                    $this->session->set_userdata('admin_username',$auth->fld_username);
                    $this->session->set_userdata('admin_email',$auth->fld_email);
                    $this->session->set_userdata('admin_role_id',$auth->fld_role_id);
                    redirect(base_url().'admin/control_panel');
                }
                else
                {
                    $data['error_message'] = "Invalid Login.";
                }
                
            }
            else
            {
                $data['error_message'] = "Invalid Username";
                
            }
            $data['input'] = $this->input->post();
            
        }
        $data['title'] = 'Admin | login';
        $data['page']  = 'admin/login';
        $this->load->view('admin/login',$data);
    }
    function end()
    {
        $this->session->sess_destroy();
        redirect(base_url().'admin/login/index');
    }
}

?>

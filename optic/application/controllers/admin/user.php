<?php class User extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/role_model');
        $this->load->model('admin/user_model');
    }
    function index()
    {
        $this->load->helper('login_helper');admin_log();
        $data['title'] = "User";
        $data['page'] = "admin/view_user";
        $data['users'] = $this->user_model->select_user();
        $this->load->view('admin/container',$data);
    }
    function insert()
    {
        $this->load->helper('login_helper');admin_log();
        $data['title'] = "Add User";
        $data['page'] = "admin/add_user";
        $data['roles'] = $this->role_model->select_role();
        $this->load->view('admin/container',$data);
    }
    function post()
    {
        $this->load->helper('login_helper');admin_log();
        $data = array(
                        'fld_name' => $this->input->post('name'),
                        'fld_username' => $this->input->post('username'),
                        'fld_password' => $this->input->post('password'),
                        'fld_email' => $this->input->post('email'),
                        'fld_role_id'=>$this->input->post('role')
            
        ); 
        return $data;
    }
    function create()
    {
        $this->load->helper('login_helper');admin_log();
        $data = $this->post();
        $this->user_model->create_user($data);
        $this->session->set_flashdata('msg','The user is successfully created.');
        redirect( base_url().'admin/user');
    }
    function edit($user_id)
    {
        $this->load->helper('login_helper');admin_log();
        $data['title'] = "Edit User";
        $data['page'] = "admin/edit_user";
        $data['user'] = $this->user_model->select_user($user_id);
        $data['roles'] = $this->role_model->select_role();
        $this->load->view('admin/container',$data);
    }
    function update($user_id)
    {
        $this->load->helper('login_helper');admin_log();
        $data = $this->post();
        $this->user_model->update_user($user_id,$data);
        $this->session->set_flashdata('msg','The user is successfully updated.');
        redirect( base_url().'admin/user');
    }
    function delete($user_id)
    {
        $this->load->helper('login_helper');admin_log();
        $this->user_model->delete_user($user_id);
        $this->session->set_flashdata('msg','The user is successfully deleted.');
        redirect( base_url().'admin/user');
    }
}

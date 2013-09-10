<?php class Control_panel extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/login_model');
    }
    function index()
    {
        $this->load->helper('login_helper');admin_log();
        $data['title']="Dashboard";
        $data['page']="admin/dashboard";
        $this->load->view('admin/container',$data);
    }
}
?>
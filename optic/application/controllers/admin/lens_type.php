<?php
class Lens_type extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('admin/lens_model');
        //$this->load->model('lens_attr_model');
    }
    
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['msg'] = $this->session->flashdata('msg');
        $data['title']='Lens';
        $data['lens_type'] = $this->lens_model->get_all_lens_type();
        $data['packages_id'] = $this->lens_model->get_all_lens_type_package_value();
        $this->load->model('admin/package_model');
        $data['packages'] = $this->package_model->get_all_package();
        $this->load->model('admin/upgrade_model');
        $this->load->view('admin/header',$data);
        $this->load->view('admin/lens');
        $this->load->view('admin/footer');
    }
    public function insert_lens($id=0){ //no id used until now
        $this->load->helper('login_helper');admin_log();
        $data['fld_name'] = $_POST['name'];
        $this->db->trans_start();
        $last_id = $this->lens_model->insert_lens_type($data);
        $data_package['fld_lens_type_id'] = $last_id;
        foreach(array_keys($_POST['packages']) as $key=>$value) {
            if(!empty($_POST['packages'][$key])){
                $data_package['fld_lens_package_id'] = $_POST['packages'][$key];
                $this->lens_model->insert_lens_type_package_value($data_package);
            }
        }
        $data_upgrades['fld_lens_type_id'] = $last_id;
        foreach(array_keys($_POST['upgrades']) as $key=>$value) {
            if(!empty($_POST['upgrades'][$key])){
                $data_upgrades['fld_lens_upgrade_id'] = $_POST['upgrades'][$key];
                $this->lens_model->insert_lens_type_upgrade($data_upgrades);
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Lens type successfully inserted");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function lens_type_info($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/upgrade_model');
        $data['lens_type'] = $this->lens_model->get_lens_type_by_fld_id($id);
        $data['upgrades'] = $this->upgrade_model->get_all_lens_type_upgrades_by_lens_type($id)->result();
        $data['packages'] = $this->upgrade_model->get_all_lens_packages_by_lens_type($id)->result();
        echo json_encode($data);
    }
    function edit_lens_type($id){
//        foreach(array_keys($_POST['edit_packages']) as $key) {
//            echo $_POST['edit_packages'][$key].'---'.$_POST['edit_rank'][$key].'<br/>';
//        }
//        exit;
        $this->load->helper('login_helper');admin_log();
        $data['fld_name'] = $_POST['edit_name'];
        $this->db->trans_start();
        $this->lens_model->edit_lens_type($data,$id);
        $data_package['fld_lens_type_id'] = $id;
        $this->lens_model->delete_lens_type_packages_value($id);
        foreach(array_keys($_POST['edit_packages']) as $key=>$value) {
            $data_package['fld_lens_package_id'] = $_POST['edit_packages'][$key];
            $data_package['fld_rank']=$_POST['edit_rank'][$key];
            $this->lens_model->insert_lens_type_package_value($data_package);
        }
        $data_upgrades['fld_lens_type_id'] = $id;
        $this->lens_model->delete_lens_type_upgrade($id);
        foreach(array_keys($_POST['edit_upgrades']) as $key=>$value) {
            $data_upgrades['fld_lens_upgrade_id'] = $_POST['edit_upgrades'][$key];
            $this->lens_model->insert_lens_type_upgrade($data_upgrades);
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Lens type successfully inserted");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function delete_lens_type($id){
        $this->load->helper('login_helper');admin_log();
        $this->lens_model->delete_lens_type_packages_value($id);
        $this->lens_model->delete_lens_type_upgrade($id);
        $this->lens_model->delete_lens_type($id);
    }
}

?>

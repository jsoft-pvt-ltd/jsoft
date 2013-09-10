<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of package_value_controller
 *
 * @author user
 */
class package_attributes_controller extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('admin/package_attributes_model');
    }
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $data['title']="Lens Packages Attributes";
        $data['attributes'] = $this->package_attributes_model->get_all_package_attributes();
        $this->load->view('admin/header',$data);
        $this->load->view('admin/package_attributes');
        $this->load->view('admin/footer');
    }
    function insert_package_attributes(){
        $this->load->helper('login_helper');admin_log();
        $this->db->trans_start();
        foreach(array_keys($_POST['name']) as $key){
            if($_POST['name']!=""){
                $data= array(
                    'fld_name' => $_POST['name'][$key]
                    //'fld_price' => $_POST['price'][$key]
                );
                $this->package_attributes_model->insert_package_attributes($data);
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg',"<script>alert('Lens Package Attributes are successfully inserted.');</script>");
        redirect($_SERVER['HTTP_REFERER']);
    }
}

?>

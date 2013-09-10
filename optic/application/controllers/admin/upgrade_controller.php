<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upgrade_controller
 *
 * @author user
 */
class upgrade_controller extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['msg'] = $this->session->flashdata('msg');
        $data['title']="Lens Upgrade";
        $this->load->model('admin/upgrade_model');
        $data['upgrades'] = $this->upgrade_model->get_all_upgrades();
        $data['upgrades_attrs'] = $this->upgrade_model->get_all_upgrades_attr();
        $data['upgrades_attr_values'] = $this->upgrade_model->get_all_upgrades_attr_values();
        $this->load->view('admin/header',$data);
        $this->load->view('admin/upgrade');
        $this->load->view('admin/footer');
    }
    function insert_upgrade(){
        $this->load->helper('login_helper');admin_log();
        foreach(array_keys($_POST['name']) as $key) {
            if(!empty($_POST['name'][$key])){
                $data['fld_name'] = $_POST['name'][$key];
                $data['fld_price'] = $_POST['price'][$key];
                $this->load->model('admin/upgrade_model');
                $this->upgrade_model->insert_upgrade($data);
            }
        }
        $this->session->set_flashdata('msg','<script>alert("Upgrade Successfully Inserted");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function insert_upgrade_attr(){
        $this->load->helper('login_helper');admin_log();
        $data['fld_name'] = $_POST['name'];
        $data['fld_upgrade_id'] = $_POST['upgrade_id'];
        $this->load->model('admin/upgrade_model');
        $this->db->trans_start();
        $last_id = $this->upgrade_model->insert_upgrade_attribute($data);
        $data_val['fld_upgrade_attribute_id'] = $last_id;
        foreach(array_keys($_POST['value']) as $key) {
            if($_POST['value'][$key]!=""){
                $data_val['fld_name'] = $_POST['value'][$key];
                $data_val['fld_extra'] = $_POST['extra'][$key];
                $this->upgrade_model->insert_upgrade_attr_value($data_val);
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Upgrade Attribute and its values Successfully Inserted");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function edit_upgrades($id){
        $this->load->helper('login_helper');admin_log();
        $data['fld_name'] = $_POST['edit_upg_name'];
        $data['fld_price'] = $_POST['edit_upg_price'];
        $this->load->model('admin/upgrade_model');
        $this->upgrade_model->edit_upgrades($data, $id);
        $this->session->set_flashdata('msg','<script>alert("Upgrade Successfully Inserted");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function delete_upgrades($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/upgrade_model');
        $this->upgrade_model->delete_upgrades($id);
    }
    function edit_upgrade_attr($id){
        $this->load->helper('login_helper');admin_log();
        $data['fld_name'] = $_POST['edit_attr_name'];
//        $data['fld_upgrade_id'] = $_POST['upgrade_id'];
        $this->load->model('admin/upgrade_model');
        $this->db->trans_start();
        $this->upgrade_model->edit_upgrade_attribute($data, $id);
        $data_val['fld_upgrade_attribute_id'] = $id;
        $this->upgrade_model->delete_upgrade_attribute_value($id,'fld_upgrade_attribute_id');
        foreach(array_keys($_POST['value']) as $key) {
            if($_POST['value'][$key]!=""){
                $data_val['fld_name'] = $_POST['value'][$key];
                $data_val['fld_extra'] = $_POST['extra'][$key];
                $this->upgrade_model->insert_upgrade_attr_value($data_val);
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Upgrade Attribute and its values Successfully Inserted");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function upgrade_attr_info($id){
        $this->load->model('admin/upgrade_model');
        $data['attr'] = $this->upgrade_model->upgrade_attr_info($id);
        $data['values'] = $this->upgrade_model->upgrade_attr_value_info($data['attr']->fld_id);
        echo json_encode($data);
    }
    
    function delete_upg_attr($id){
        $this->load->model('admin/upgrade_model');
        $this->upgrade_model->delete_upgrade_attr($id,'fld_id');
    }
}

?>

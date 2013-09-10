<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of php_attributes
 *
 * @author user
 */
class package_attributes extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('admin/package_attributes_model');
    }
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['attributes'] = $this->package_attributes_model->get_all_package_attributes();
        $data['title'] = 'Package Attributes';
        $data['page']='admin/view_package_attr';
        $this->load->view('admin/container', $data);
    }
    function add_package_attr($id=0){
        if($id!=0){
            /*
             * If id is not 0 then it works as editing the package attributes
             */
            $data['attribute'] = $this->package_attributes_model->get_package_attribute_by_id($id);
            $data['title'] = 'Edit '.$data['attribute']->fld_name;
        }
        else{
            $data['title'] = 'Add Package Attribute';
        }
        $data['page'] = 'admin/add_package_attr';
        $this->load->view('admin/container',$data);
    }
    function insert_package_attr(){
        $data['fld_name'] = $this->input->post('package_attr');
        $this->package_attributes_model->insert_package_attr($data);
        redirect(base_url().'admin/package_attributes');
    }
    function update_package_attr($id){
        $data['fld_name'] = $this->input->post('package_attr');
        $this->package_attributes_model->update_package_attr($data,$id);
        redirect(base_url().'admin/package_attributes');
    }
    function delete_package_attr($id){
        $this->package_attributes_model->delete_package_attr($id);
        redirect(base_url().'admin/package_attributes');
    }
}
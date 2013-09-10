<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of products
 *
 * @author user
 */
class Product_type extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/product_type_model');
    }
    public function index()
    {
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $data['product_types']=$this->product_type_model->get_all_product_types();
        $data['title']="Add Product Type";
        $data['page']="admin/add_product_type";
        $this->load->view('admin/container',$data);
    }
    public function insert_product_type($id=0){ //Optional parameter for editing the product type $id->product type id;
        $this->load->helper('login_helper');admin_log();
        $data['fld_name']=$this->input->post('name');
        if($id==0){
            $this->product_type_model->insert_product_type($data);
            $this->session->set_flashdata('msg','<script>alert("Product Type Successfully Inserted");</script>');
        }
        else{
            $this->product_type_model->edit_product_type($data,$id);
            $this->session->set_flashdata('msg','<script>alert("Product Type Successfully Updated");</script>');
        }
            redirect(base_url().'admin/product_type');
    }
    public function delete_product_type($id){
        $this->load->helper('login_helper');admin_log();
        $this->product_type_model->delete_product_type($id);
    }
    public function edit_product_type($id){
        $this->load->helper('login_helper');admin_log();
        $data['product_type']=$this->product_type_model->get_product_type_by_id($id);
        $data['product_types']=$this->product_type_model->get_all_product_types();
        $data['title']="Edit Product Type";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/add_product_type');
        $this->load->view('admin/footer');
        //$this->product_type_model->edit_product_type();
    }
}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attribute_types
 *
 * @author user
 */
class attribute_values extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('attribute_values_model');
        header("Cache-Control: no-cache, must-revalidate");
    }

    public function insert_attribute_values($id=0){
        $this->load->helper('login_helper');admin_log();
        $data = array(
            'fld_value'=>$this->input->post('value'),
            'fld_attribute_id'=>$_POST['attribute'],
            'fld_price'=>$_POST['price'],
            'fld_parent_id'=>$_POST['parent_id']
        );
        if($id==0){
            $this->attribute_values_model->insert_attribute_values($data);
            $this->session->set_flashdata('msg','<script>alert("Attribute Successfully Inserted");</script>');
        }
        else{
            $this->attribute_values_model->edit_attribute_value($data,$id);
            $this->session->set_flashdata('msg','<script>alert("Attribute Successfully Updated");</script>');
        }
            redirect(base_url().'admin/attribute_values');
    }
    function delete_attribute_value($id){
        $this->load->helper('login_helper');admin_log();
        $this->attribute_values_model->delete_attribute_value($id);
    }
    function edit_attribute_value($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('attributes_model');
        $data['attributes']=$this->attributes_model->get_all_attributes();
        $data['attribute_value']=$this->attribute_values_model->get_attribute_value_by_id($id);
        $data['attribute_values']=$this->attribute_values_model->get_all_attribute_values();
        $data['title']="Edit Attribute Value";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/attribute_values');
        $this->load->view('admin/footer');
    }
    function get_attribute_values_by_id($id){
        $this->load->helper('login_helper');admin_log();
        $data['parent']=$this->attribute_values_model->get_attribute_value_by_id($id);//parent attribute_value
        $data['child']=$this->attribute_values_model->get_attribute_values_by_id($id);
        echo json_encode($data);
    }
}
?>

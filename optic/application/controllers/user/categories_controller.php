<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categories_controller
 *
 * @author user
 */
class categories_controller extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->model('sub_categories_model');
    }
    
    
    function index(){
        $data['msg']=$this->session->flashdata('msg');
        
        $data['categories']=$this->categories_model->get_all_categories();
        if($data['categories']->num_rows()!=0){
            $data['sub_categories']=$this->sub_categories_model->get_all_sub_categories();
        }
        $data['title']="Categories";
        //$this->load->view('user/header',$data);
        $this->load->view('user/categories',$data);
        //$this->load->view('admin/footer');
    }
    
    
}

?>

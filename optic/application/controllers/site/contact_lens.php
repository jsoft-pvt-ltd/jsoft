<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categories
 *
 * @author user
 */
class Contact_lens extends CI_Controller{
//    public $count=0;
    function __construct() {
        parent::__construct();
    }
    
    function index($per_page=0)
    {
        $this->load->model('site/contact_lens_model');
        $this->load->model('admin/product_model');
        $data['best_sellers'] = $this->product_model->select_best_seller_product(2,1);//num and offset for getting only two
        $this->load->library('pagination');
        $config['base_url'] = base_url().'contact_lens/'.$per_page;
        $config['total_rows'] = $this->contact_lens_model->count_contact_lenses();
        $config['uri_segment'] = 3;
        $config['per_page'] = 9;
        $this->pagination->initialize($config);
        $data['contact_lens'] = $this->contact_lens_model->get_contact_lenses($config['per_page'],$this->uri->segment(3));
        $data['pagination'] = $this->pagination->create_links();
        $data['title']='Contact Lens';
        $data['total_rows'] = $config['total_rows'];
        $data['per_page'] = 9;
        $this->load->view('site/header',$data);
        $this->load->view('site/contact_lens_view',$data);
        $this->load->view('site/footer');
    }
    function selected_contact_lens($id){
        $this->load->model('site/contact_lens_model');
        $this->load->model('admin/product_model');
        $data['best_sellers'] = $this->product_model->select_best_seller_product(2,0);//num and offset for getting only two
        $data['contact_lens'] = $this->contact_lens_model->get_contact_lens($id);
        $data['contact_lens_attr'] = $this->contact_lens_model->get_contact_lens_attr($id);
        $data['featured_products'] = $this->product_model->select_featured_product(2,0);//num and offset for getting only two
        $data['title']=$data['contact_lens']->fld_name;
        $this->load->view('site/header',$data);
        $this->load->view('site/selected_contact_lens');
        $this->load->view('site/footer');
    }
    function cart(){
        $this->load->helper('login_helper');
        if(IsLoggedIn()){
            $user_id = $this->session->userdata('userId');
        }else $user_id = 'sess_'.$this->session->userdata('fld_id');
        $data=array();
        $data = $_POST;
        $data['fld_qty']=1;
        $data['fld_user_id']=$user_id;
        $this->load->model('site/contact_lens_model');
        $this->contact_lens_model->insert_contact_lens($data);
        redirect(base_url().'contact_lens/9');
    }
    function lens_set_sort_by($sort_by, $display_items){
        $this->session->set_userdata('sort_by',$sort_by);
        redirect(base_url().'contact_lens/'.$display_items);
    }
}
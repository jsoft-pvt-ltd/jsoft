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
class Categories extends CI_Controller{
//    public $count=0;
    function __construct() {
        parent::__construct();
    }
    function index($cat_id=0,$per_page=0){
        $this->load->model('site/categories_model');
        $this->load->model('admin/product_model');
        $data['category_info'] = $this->categories_model->get_categories_by_id($cat_id);
        $catname = $this->categories_model->get_categories_by_id($cat_id);
        $this->load->library('pagination');
        $config['base_url'] = base_url().url_title(strtolower($catname->fld_name)).'-'.$cat_id.'/'.$per_page;
        $config['total_rows'] = $this->product_model->count_product_by_cat_id($cat_id);
        $config['uri_segment'] = 3;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['per_page']=$per_page;
        $data['total_items']= $config['total_rows'];
        $data['products'] = $this->product_model->get_products_by_cat_id($config['per_page'],$this->uri->segment(3),$cat_id);
        $data['best_sellers'] = $this->product_model->select_best_seller_product(2,0);//num and offset for getting only two
        $data['featured_products'] = $this->product_model->select_featured_product(2,0);//num and offset for getting only two
        $data['pagination'] = $this->pagination->create_links();
        $data['title']=$data['category_info']->fld_name;
        $this->load->view('site/header',$data);
        $this->load->view('site/categories');
        $this->load->view('site/footer');
    }
    function sub_categories($sub_cat_id=0,$per_page=0){
        $this->load->model('site/categories_model');
        $this->load->model('site/sub_categories_model');
        $this->load->model('admin/product_model');
        $data['category_info'] = $this->sub_categories_model->get_sub_categories_by_id($sub_cat_id);
        $subcat_name = $this->sub_categories_model->get_sub_categories_by_id($sub_cat_id);
        $catname = $this->categories_model->get_categories_by_id($subcat_name->fld_category_id);
        $data['cat_name'] = $catname;
        $this->load->library('pagination');
        $config['base_url'] = base_url().url_title(strtolower($catname->fld_name)).'/'.url_title(strtolower($subcat_name->fld_name)).'-'.$sub_cat_id.'/'.$per_page;
        $config['total_rows'] = $this->product_model->count_product_by_subcat_id($sub_cat_id);
        $config['uri_segment'] = 4;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['sub_cat']=TRUE;
        $data['per_page']=$per_page;
        $data['total_items']= $config['total_rows'];
        $data['products'] = $this->product_model->get_products_by_sub_cat_id($config['per_page'],$this->uri->segment(4),$sub_cat_id);
        $data['best_sellers'] = $this->product_model->select_best_seller_product(2,0);//num and offset for getting only two
        $data['featured_products'] = $this->product_model->select_featured_product(2,0);//num and offset for getting only two
        $data['pagination'] = $this->pagination->create_links();
        $data['title']=$data['category_info']->fld_name;
        $this->load->view('site/header',$data);
        $this->load->view('site/categories');
        $this->load->view('site/footer');
    }
    function featured_products()
    {
        $this->load->model('site/categories_model');
        $this->load->model('admin/product_model');
        $data['best_sellers'] = $this->product_model->select_best_seller_product(2,0);//num and offset for getting only two
        $this->load->library('pagination');
        $config['base_url'] = base_url().'site/accessories/index/';
        $config['total_rows'] = $this->product_model->count_featured_product();
        $config['uri_segment'] = 4;
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $data['per_page']=9;
        $data['featred_prod'] = $this->product_model->select_featured_product($config['per_page'],$this->uri->segment(4));
        $data['pagination'] = $this->pagination->create_links();
        $data['title']='Featured Glasses';
        //print_r($data);exit;
        $this->load->view('site/header',$data);
        $this->load->view('site/featured_view',$data);
        $this->load->view('site/footer');
    }
    
    function set_sort_by($cat_id, $display_items, $sort_by){
        $this->session->set_userdata('sort_by',$sort_by);
        redirect(base_url().'site/categories/index/'.$cat_id.'/'.$display_items);
    }
    
     function subcat_set_sort_by($subcat_id, $display_items, $sort_by){
        $exp = explode('_', $subcat_id);
        $this->session->set_userdata('sort_by',$sort_by);
        redirect(base_url().$exp[0].'/'.$exp[1].'-'.$exp[2].'/'.$display_items);
    }
}
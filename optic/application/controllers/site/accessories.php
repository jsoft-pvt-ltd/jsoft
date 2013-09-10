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
class Accessories extends CI_Controller{
//    public $count=0;
    function __construct() {
        parent::__construct();
        $this->load->model('site/accessories_model');
        $this->load->helper('login_helper');
    }
    
    function index($per_page=0)
    {
        $this->load->model('site/accessories_model');
        $this->load->model('admin/product_model');
        $data['best_sellers'] = $this->product_model->select_best_seller_product(2,1);//num and offset for getting only two
        $this->load->library('pagination');
        $config['base_url'] = base_url().'accessories/'.$per_page;
        $config['total_rows'] = $this->accessories_model->count_accessories();
        $config['uri_segment'] = 4;
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $data['accessories'] = $this->accessories_model->get_accessories($config['per_page'],$this->uri->segment(4));
        $data['pagination'] = $this->pagination->create_links();
        $data['title']='Accessories';
        //print_r($data);exit;
        $this->load->view('site/header',$data);
        $this->load->view('site/accessories_view',$data);
        $this->load->view('site/footer');
    }
    function selected_accessory($id,$edit_id){ //Here $edit_id is the fld_id of tbl_temp_accessories;
        $this->load->model('admin/product_model');
        $data['best_sellers'] = $this->product_model->select_best_seller_product(2,0);//num and offset for getting only two
        $data['accessory'] = $this->accessories_model->get_accessory($id);
        $data['accessory_attr'] = $this->accessories_model->get_accessory_attr($id);
        $data['featured_products'] = $this->product_model->select_featured_product(2,0);//num and offset for getting only two
        $data['title']=$data['accessory']->fld_name;
        if($edit_id>0)
        {
            $data['action'] = base_url().'site/accessories/edit_cart/';
            if(IsLoggedIn())$user_id = $this->session->userdata('userId');
            else $user_id = 'sess_'.$this->session->userdata('fld_id');
            $data['temp'] = $this->accessories_model->get_temp_accessories($edit_id,$user_id);
        }
        $this->load->view('site/header',$data);
        $this->load->view('site/selected_accessory');
        $this->load->view('site/footer');
    }
    function cart(){
        $this->post_data();
        $check_point = explode('/',$_SERVER['HTTP_REFERER']);
        if($check_point[6] == 'step_four' || $check_point[5] == 'step_four'){
            redirect($_SERVER['HTTP_REFERER']);    
        }else
            redirect(base_url().'site/accessories');
    }

    function post_data(){
        $this->db->trans_start();
        if(IsLoggedIn()){
            $user_id = $this->session->userdata('userId');
        }
        else{
            $user_id = $this->accessories_model->get_session_fld_id($this->session->userdata('session_id'));
            $user_id = 'sess_'.$user_id;
            $this->session->userdata('sess_id',$user_id);
        }
        $attrs = $this->accessories_model->get_attributes($_POST['id'],$_POST['color']);
        $data = array(
            'fld_accessory_id'=>$_POST['id'],
            'fld_qty'=>$_POST['qty'],
            'fld_price'=>$_POST['price'],
            'fld_name'=>$_POST['item_code'],
            'fld_color'=>$_POST['color'],
            'fld_user_id'=>$user_id,
            'fld_location'=>$attrs->fld_location,
            'fld_image'=>$attrs->fld_image
        );
        $total_acces = $this->accessories_model->insert_accessory($data);
        $this->db->trans_complete();
        $this->session->set_userdata('total_cart_item',$total_acces);
        $this->session->set_flashdata('msg1','The product is added to cart');
    }
    
    
}
?>

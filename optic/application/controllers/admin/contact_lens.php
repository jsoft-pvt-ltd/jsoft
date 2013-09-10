<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contact_lens
 *
 * @author user
 */
class Contact_lens extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('admin/contact_lens_model');
    }
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['msg1'] = $this->session->flashdata('msg');
        //msg1 is for those message those are not needed to be alert  
        $config['base_url'] = base_url().'admin/contact_lens/index';
        $config['total_rows'] = $this->contact_lens_model->count();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $this->load->library('pagination');
        $this->pagination->initialize($config); 
        $data['contact_lenses'] = $this->contact_lens_model->get_contact_lenses($config['per_page'],$this->uri->segment(4));
        $data['pagination'] = $this->pagination->create_links();
        $data['title']='Contact Lens';
        $this->load->view('admin/header',$data);
        $this->load->view('admin/view_contact_lens');
        $this->load->view('admin/footer');
    }
    //========================= LENSES ==============================
    function add_lenses($id=0){
        $this->load->helper('login_helper');admin_log();
        if($id!=0){
            $data['edit_lens'] = $this->contact_lens_model->get_lens($id);
            $data['title']='Edit '.$data['edit_lens']->fld_name;
        }else{
            $data['title']='Add Contact Lens';
        }
        $data['msg1'] = $this->session->flashdata('msg');
        $data['brands'] = $this->contact_lens_model->get_brands('fld_id,fld_name');
        if($data['brands']->num_rows()==0){
            $this->session->set_flashdata('msg','<b>No any brands available please insert some:</b>');
            redirect(base_url().'admin/contact_lens/add_brands');
        }
        $data['action'] = base_url('admin/contact_lens/insert_lens');
        $this->load->view('admin/header',$data);
        $this->load->view('admin/add_contact_lens',$data);
        $this->load->view('admin/footer');
    }
    
    function insert_lens()
    {
        $CI = &get_instance();
        $CI->load->library('folders');
        $destination='images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $destination);
        $destination = $destination.'/'. date('d');
        $img = $CI->folders->uploadFiles($_FILES, $destination);
        $data_lens = array(
            'fld_name'=>$_POST['name'],
            'fld_description'=>$_POST['desc'],
            'fld_brand'=>$_POST['brand'],
            'fld_lpb'=>$_POST['lpb'],
            'fld_cp'=>$_POST['cp'],
            'fld_sp'=>$_POST['sp'],
            'fld_discount'=>$_POST['dis'],
            'fld_discount_price'=>$_POST['dis_price'],
            'fld_quantity'=>$_POST['qty'],
            'fld_location'=>$destination,
            'fld_image'=>$img[0] //for single image
        );
        $lens_id = $this->contact_lens_model->insert_lens($data_lens);
        redirect(base_url().'admin/contact_lens/add_attributes/'.$lens_id);
    }
    
    function update_lens($id)
    {
        if(isset($_FILES['image']) && strlen($_FILES['image']['name']) > 0){
            $CI = &get_instance();
            $CI->load->library('folders');
            $destination='images/'.date("Y").'/'.date("m");
            $CI->folders->makeDirectory(date('d'), $destination);
            $destination = $destination.'/'. date('d');
            $img = $CI->folders->uploadFiles($_FILES, $destination);
            $data_lens = array(
            'fld_name'=>$_POST['name'],
            'fld_description'=>$_POST['desc'],
            'fld_brand'=>$_POST['brand'],
            'fld_lpb'=>$_POST['lpb'],
            'fld_cp'=>$_POST['cp'],
            'fld_sp'=>$_POST['sp'],
            'fld_discount'=>$_POST['dis'],
            'fld_discount_price'=>$_POST['dis_price'],
            'fld_quantity'=>$_POST['qty'],
            'fld_location'=>$destination,
            'fld_image'=>$img[0]
        );
            $flag = true;
        }else{
            $flag = false;
            $data_lens = array(
                'fld_name'=>$_POST['name'],
                'fld_description'=>$_POST['desc'],
                'fld_brand'=>$_POST['brand'],
                'fld_lpb'=>$_POST['lpb'],
                'fld_cp'=>$_POST['cp'],
                'fld_sp'=>$_POST['sp'],
                'fld_discount'=>$_POST['dis'],
                'fld_discount_price'=>$_POST['dis_price'],
                'fld_quantity'=>$_POST['qty'],
            );
        }
        
        $lens_id = $this->contact_lens_model->update_lens($data_lens,$id,$flag);
        $this->session->set_flashdata('msg','Contact Lens <b>'.$data_lens['fld_name'].'</b> successfully updated');
        redirect(base_url().'admin/contact_lens');
    }
    
    function delete_lenses($id)
    {
        $this->contact_lens_model->delete_lens($id);
        $this->session->set_flashdata('msg','Contact Lens successfully deleted');
    }
    
    ////////////////LENS ATTRIBUTES///////////////////////////////////////////
    
    function add_attributes($lens_id)
    {
        $this->load->helper('login_helper');admin_log();
        $data['title']='Add lens Attributes';
        $data['lens_id'] = $lens_id;
        $data['action'] = base_url('admin/contact_lens/insert_attributes/'.$lens_id);
        $this->load->view('admin/header',$data);
        $this->load->view('admin/add_contact_lens_attributes');
        $this->load->view('admin/footer');
    }
    
    function power($lens_id,$id=0)
    {
        if($_POST)
        {
            if($_POST['power'] < 0)
                $fld_type = 'power_minus';
            else
                $fld_type = 'power_plus';
            $data = array(
                'fld_value'=>$_POST['power'],
                'fld_type'=>$fld_type,
                'fld_contact_lens_id'=>$lens_id
            );
            if($id == 0)
                $this->contact_lens_model->insert_lens_attribute($data);  
            else
                $this->contact_lens_model->update_attr($data,$lens_id,$id);
        }
        $data['lens_name'] = $this->contact_lens_model->get_lens_name($lens_id);
        $data['power'] = $this->contact_lens_model->get_power($lens_id);
        $this->load->view('admin/power',$data);
    }
    
    function axis($lens_id,$id=0)
    {
        if($_POST)
        {
            $data = array(
                'fld_type' => 'axis',
                'fld_value'=>$_POST['axis'],
                'fld_contact_lens_id'=>$lens_id
            );
            if($id == 0)
                $this->contact_lens_model->insert_lens_attribute($data);
            else
                $this->contact_lens_model->update_attr($data,$lens_id,$id);
        }
        $data['lens_name'] = $this->contact_lens_model->get_lens_name($lens_id);
        $data['axes'] = $this->contact_lens_model->get_axes($lens_id);
        $this->load->view('admin/axis',$data);
    }
    
    function cyl($lens_id,$id=0)
    {
        if($_POST)
        {
            $data = array(
                'fld_type' => 'cylinder',
                'fld_value'=>$_POST['cylinder'],
                'fld_contact_lens_id'=>$lens_id
            );
            if($id == 0)
                $this->contact_lens_model->insert_lens_attribute($data);
            else
                $this->contact_lens_model->update_attr($data,$lens_id,$id);
        }
        $data['lens_name'] = $this->contact_lens_model->get_lens_name($lens_id);
        $data['cylinder'] = $this->contact_lens_model->get_cylinder($lens_id);
        $this->load->view('admin/cylinder',$data);
    }
    
    function diameter($lens_id,$id=0)
    {
        if($_POST)
        {
            $data = array(
                'fld_type' => 'diameter',
                'fld_value'=>$_POST['diameter'],
                'fld_contact_lens_id'=>$lens_id
            );
            if($id == 0)
                $this->contact_lens_model->insert_lens_attribute($data);
            else
                $this->contact_lens_model->update_attr($data,$lens_id,$id);
        }
        $data['lens_name'] = $this->contact_lens_model->get_lens_name($lens_id);
        $data['diameter'] = $this->contact_lens_model->get_diameter($lens_id);
        $this->load->view('admin/diameter',$data);
    }
    
    function base_curve($lens_id,$id=0)
    {
        if($_POST)
        {
            $data = array(
                'fld_type' => 'base_curve',
                'fld_value'=>$_POST['base_curve'],
                'fld_contact_lens_id'=>$lens_id
            );
            if($id == 0)
                $this->contact_lens_model->insert_lens_attribute($data);
            else
                $this->contact_lens_model->update_attr($data,$lens_id,$id);
        }
        $data['lens_name'] = $this->contact_lens_model->get_lens_name($lens_id);
        $data['base_curve'] = $this->contact_lens_model->get_base_curve($lens_id);
        $this->load->view('admin/base_curve',$data);
    }
    
    function sph($lens_id,$id=0)
    {
        if($_POST)
        {
            $data = array(
                'fld_type' => 'spherical',
                'fld_value'=>$_POST['sph'],
                'fld_contact_lens_id'=>$lens_id
            );
            if($id == 0)
                $this->contact_lens_model->insert_lens_attribute($data);
            else
                $this->contact_lens_model->update_attr($data,$lens_id,$id);
        }
        $data['lens_name'] = $this->contact_lens_model->get_lens_name($lens_id);
        $data['sph'] = $this->contact_lens_model->get_sph($lens_id);
        $this->load->view('admin/sph',$data);
    }
    
    function delete_attr($id)
    {
        $this->contact_lens_model->delete_attr($id);
        $this->session->set_flashdata('msg','Contact Lens Attribute successfully deleted');
    }
    //========================= BRANDS ==============================
    function add_brands($id=0){
        $this->load->helper('login_helper');admin_log();
        $data['msg1'] = $this->session->flashdata('msg');
        if($id!=0){
            $data['brand'] = $this->contact_lens_model->get_brand($id);
            $data['title']='Edit '.$data['brand']->fld_name;
        }else{
            $data['title']='Add Brands';
        }
        $this->load->view('admin/header',$data);
        $this->load->view('admin/add_brands');
        $this->load->view('admin/footer');
    }
    function insert_brands(){
        $this->load->helper('login_helper');admin_log();
        $CI = &get_instance();
        $CI->load->library('folders');
        $destination='images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $destination);
        $destination = $destination.'/'. date('d');
        $img = $CI->folders->uploadFiles($_FILES, $destination);
        $data = array(
            'fld_name'=>$this->input->post('name'),
            'fld_description'=>$this->input->post('desc'),
            'fld_location'=>$destination,
            'fld_image'=>$img[0] //for single image
        );
        $this->contact_lens_model->insert_brands($data);
        $this->session->set_flashdata('msg','Brand <b>'.$data['fld_name'].'</b> successfully inserted');
        redirect(base_url().'admin/contact_lens/view_brands');
    }
    function view_brands(){
        $data['title']  = 'Brands';
        $data['msg1']   = $this->session->flashdata('msg');
        $data['brands'] = $this->contact_lens_model->get_brands();
        if($data['brands']->num_rows()==0){
            $this->session->set_flashdata('msg','<b>No any brands available please insert some:</b>');
            redirect(base_url().'admin/contact_lens/add_brands');
        }
        $this->load->view('admin/header',$data);
        $this->load->view('admin/view_brands');
        $this->load->view('admin/footer');
    }
    function update_brands($id){
        $this->load->helper('login_helper');admin_log();
        $flag=false;
        $data = array(
            'fld_name'=>$this->input->post('name'),
            'fld_description'=>$this->input->post('desc')
        );
        if(!empty($_FILES['image']['name'])){
            $CI = &get_instance();
            $CI->load->library('folders');
            $destination='images/'.date("Y").'/'.date("m");
            $CI->folders->makeDirectory(date('d'), $destination);
            $destination = $destination.'/'. date('d');
            $img = $CI->folders->uploadFiles($_FILES, $destination);
            $data['fld_location']=$destination;
            $data['fld_image']=$img[0]; //for single image
            $flag=true;
        }
        $this->contact_lens_model->update_brands($data,$id,$flag);
        $this->session->set_flashdata('msg','Brand <b>'.$data['fld_name'].'</b> successfully updated');
        redirect(base_url().'admin/contact_lens/view_brands');
    }
    function delete_brands($id){
        $this->contact_lens_model->delete_brands($id);
    }
}
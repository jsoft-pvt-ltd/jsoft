<?php class Promocode extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/promocode_model');
        $this->load->library('pagination');
    }
    function index()
    {
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $config['base_url'] = base_url().'admin/promocode/index';
        $config['total_rows'] = $this->promocode_model->count_promocodes();
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['promocodes'] = $this->promocode_model->promocodes($config['per_page'],$this->uri->segment(4));
        $data['title']="Promocodes | Optic Store Online";
        $data['page']="admin/view_promocode";
        $this->load->view('admin/container',$data);
    }
    //=======================================Promocode type===============================================================
    function promocode_type()
    {
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $config['base_url'] = base_url().'admin/promocode/promocode_type';
        $config['total_rows'] = $this->promocode_model->count_promocode_types();
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['promocode_types'] = $this->promocode_model->promocode_types($config['per_page'],$this->uri->segment(4));
        $data['title']="Promocode Types | Optic Store Online";
        $data['page']="admin/view_promocode_type";
        $this->load->view('admin/container',$data);
    }
    function post_promocode_type()
    {
        $data = array(
                        'fld_promocode_type'=>$this->input->post('promocode_type')
                    );
        return $data;
    }
    function add_promocode_type()
    {
        $this->load->helper('login_helper');admin_log();
        if($this->input->post())
        {
            $data = $this->post_promocode_type();
            $this->promocode_model->insert_promocode_type($data);
            $this->session->set_flashdata('msg','The promocode type is successfully added');
            redirect(base_url().'admin/promocode/promocode_type');
        }
        $data['msg']=$this->session->flashdata('msg');
        $data['title']="Add Promocode Type | Optic Store Online";
        $data['page']="admin/add_promocode_type";
        $this->load->view('admin/container',$data);
    }
    function edit_promocode_type($promocode_type)
    {
        
        if($this->input->post())
        {
            $data = $this->post_promocode_type();
            $this->promocode_model->update_promocode_type($promocode_type,$data);
            $this->session->set_flashdata('msg','The promocode type is successfully edited');
            redirect(base_url().'admin/promocode/promocode_type');
        }
        $data['promocode_type'] = $this->promocode_model->promocode_type($promocode_type);
        $data['msg']=$this->session->flashdata('msg');
        $data['title']="Edit Promocode Type | Optic Store Online";
        $data['page']="admin/edit_promocode_type";
        $this->load->view('admin/container',$data);
        
    }
    function delete_promocode_type($promocode_type)
    {
        $this->load->helper('login_helper');admin_log();
        $data['promocode_type'] = $this->promocode_model->delete_promocode_type($promocode_type);
        $this->session->set_flashdata('msg','The promocode type is successfully deleted');
        redirect(base_url().'admin/promocode/promocode_type');
    }
    //=======================================Promocodes===============================================================
    function add_promocode($promocode_type)
    {
        $this->load->helper('login_helper');admin_log();
        if($this->input->post())
        {
            switch($promocode_type){
                case 1:
                    $data['fld_category'] = $this->input->post('category');
                    break;
                case 2:
                    $data['fld_category'] = $this->input->post('category');
                    break;
                case 3:
                    $data['fld_category'] = $this->input->post('category');
                    break;
                case 4:
                    $data['fld_amt_above'] = $this->input->post('above'); 
                    break;
                case 5:
                    $data['fld_percentage'] = $this->input->post('percentage'); 
                    break;
                case 6:
                    $data['fld_start_date'] = $this->input->post('start_date');
                    $data['fld_end_date']   = $this->input->post('end_date');
                    $data['fld_percentage'] = $this->input->post('percentage');
                    break;
                case 7:
                    $data['fld_amt_above'] = $this->input->post('above');
                    $data['fld_percentage'] = $this->input->post('percentage');
                    break;
                case 8:
                    $data['fld_off_amt']        = $this->input->post('off');
                    $from = $this->input->post('from');
                    $to = $this->input->post('to');
                    $data['fld_range']      = $from."-".$to;
                    break;
                case 9:
                    $data['fld_percentage'] = $this->input->post('percentage');
                    $categories = $this->input->post('category');
                    $data['fld_category']="";
                    for($i=0;$i<sizeof($categories);$i++)
                    {
                        $data['fld_category'] = $data['fld_category'].$categories[$i]."-";
                    }
                    $data['fld_category'] = substr($data['fld_category'], 0, -1);
                    break;
                case 10:
                    $data['fld_percentage'] = $this->input->post('percentage');
                    $categories = $this->input->post('category');
                    $data['fld_category']="";
                    for($i=0;$i<sizeof($categories);$i++)
                    {
                        $data['fld_category'] = $data['fld_category'].$categories[$i]."-";
                    }
                    $data['fld_category'] = substr($data['fld_category'], 0, -1);
                    break;
                case 11:
                    $data['fld_upgrade'] = $this->input->post('upgrade');
                    $data['fld_percentage'] = $this->input->post('percentage');
                    break;
                    
                default:
                    break;
                    
                    
            }
            $data['fld_promocode_type'] = $promocode_type;
            $data['fld_promocode'] = $this->input->post('promocode');
            $this->promocode_model->insert_promocode($data);
            $this->session->set_flashdata('msg','The promocode is successfully inserted');
            redirect(base_url().'admin/promocode');
            
        }
        else
        {
            switch($promocode_type){
                case 1:
                    $data['page']="admin/promocode/view1";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 2:
                    $data['page']="admin/promocode/view1";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 3:
                    $data['page']="admin/promocode/view1";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 4:
                    $data['page']="admin/promocode/view4";
                    break;
                case 5:
                    $data['page']="admin/promocode/view5";
                    break;
                case 6:
                    $data['page']="admin/promocode/view6";
                    break;
                case 7:
                    $data['page']="admin/promocode/view7";
                    break;
                case 8:
                    $data['page']="admin/promocode/view8";
                    break;
                case 9:
                    $data['page']="admin/promocode/view9";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 10:
                    $data['page']="admin/promocode/view10";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 11:
                    $data['page']="admin/promocode/view11";
                    $this->load->model('admin/upgrade_model');
                    $data['upgrades'] = $this->upgrade_model->get_all_upgrades();
                    //$data['upgrades_attrs'] = $this->upgrade_model->get_all_upgrades_attr();
                    //$data['upgrades_attr_values'] = $this->upgrade_model->get_all_upgrades_attr_values();
                    break;
                default:
                    break;
                    
            }
            $data['promocode_type'] = $this->promocode_model->promocode_type($promocode_type);
            $data['title']="Add Promocode | Optic Store Online";
            $this->load->view('admin/container',$data);
        }
    }
    function edit_promocode($promocode_type,$promocode)
    {
        $this->load->helper('login_helper');admin_log();
        if($this->input->post())
        {
            switch($promocode_type){
                case 1:
                    $data['fld_category'] = $this->input->post('category');
                    break;
                case 2:
                    $data['fld_category'] = $this->input->post('category');
                    break;
                case 3:
                    $data['fld_category'] = $this->input->post('category');
                    break;
                case 4:
                    $data['fld_amt_above'] = $this->input->post('above');
                    break;
                case 5:
                    $data['fld_percentage'] = $this->input->post('percentage'); 
                    break;
                case 6:
                    $data['fld_start_date'] = $this->input->post('start_date');
                    $data['fld_end_date']   = $this->input->post('end_date');
                    $data['fld_percentage'] = $this->input->post('percentage');
                    break;
                case 7:
                    $data['fld_amt_above'] = $this->input->post('above');
                    $data['fld_percentage'] = $this->input->post('percentage');
                    break;
                case 8:
                    $data['fld_off_amt']        = $this->input->post('off');
                    $from = $this->input->post('from');
                    $to = $this->input->post('to');
                    $data['fld_range']      = $from."-".$to;
                    break;
                case 9:
                    $data['fld_percentage'] = $this->input->post('percentage');
                    $categories = $this->input->post('category');
                    $data['fld_category']="";
                    for($i=0;$i<sizeof($categories);$i++)
                    {
                        $data['fld_category'] = $data['fld_category'].$categories[$i]."-";
                    }
                    $data['fld_category'] = substr($data['fld_category'], 0, -1);
                    break;
                case 10:
                    $data['fld_percentage'] = $this->input->post('percentage');
                    $categories = $this->input->post('category');
                    $data['fld_category']="";
                    for($i=0;$i<sizeof($categories);$i++)
                    {
                        $data['fld_category'] = $data['fld_category'].$categories[$i]."-";
                    }
                    $data['fld_category'] = substr($data['fld_category'], 0, -1);
                    break;
                default:
                    break;
                    
            }
            $data['fld_promocode'] = $this->input->post('promocode');
            $this->promocode_model->update_promocode($promocode,$data);
            $this->session->set_flashdata('msg','The promocode is successfully updated');
            redirect(base_url().'admin/promocode');
            
        }
        else
        {
            switch($promocode_type){
                case 1:
                    $data['page']="admin/promocode/view1";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 2:
                    $data['page']="admin/promocode/view1";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 3:
                    $data['page']="admin/promocode/view1";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 4:
                    $data['page']="admin/promocode/view4";
                    break;
                case 5:
                    $data['page']="admin/promocode/view5"; 
                    break;
                case 6:
                    $data['page']="admin/promocode/view6"; 
                    break;
                case 7:
                    $data['page']="admin/promocode/view7"; 
                    break;
                case 8:
                    $data['page']="admin/promocode/view8";
                    break;
                case 9:
                    $data['page']="admin/promocode/view9";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 10:
                    $data['page']="admin/promocode/view10";
                    $this->load->model('categories_model');
                    $data['categories'] = $this->categories_model->get_all_categories();
                    break;
                case 11:
                    $data['page']="admin/promocode/view11";
                    $this->load->model('admin/upgrade_model');
                    $data['upgrades'] = $this->upgrade_model->get_all_upgrades();
                    break;
                default:
                    
                    break;
                    
            }
            $data['promocode_type'] = $this->promocode_model->promocode_type($promocode_type);
            $data['promocode'] = $this->promocode_model->promocode($promocode);
            $data['title']="Add Promocode | Optic Store Online";
            $this->load->view('admin/container',$data);
        }
    }
    function delete_promocode($promocode)
    {
        $this->load->helper('login_helper');admin_log();
        $this->promocode_model->delete_promocode($promocode);
        $this->session->set_flashdata('msg','The promocode is sucessfully deleted.');
        redirect(base_url().'admin/promocode');
    }
    function activate_promocode($promocode)
    {
        $data = array(
                        'fld_status'=>1
        );
        $this->promocode_model->update_promocode($promocode,$data);
        $this->session->set_flashdata('msg','The promocode is successfully activated.');
        redirect( base_url().'admin/promocode');
        
    }
    function deactivate_promocode($promocode)
    {
        $data = array(
                        'fld_status'=>0
        );
        $this->promocode_model->update_promocode($promocode,$data);
        $this->session->set_flashdata('msg','The promocode is successfully deactivated.');
        redirect( base_url().'admin/promocode');
        
    }
}
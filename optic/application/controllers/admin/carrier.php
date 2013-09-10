<?php class Carrier extends CI_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->library('pagination');
         $this->load->model('admin/carrier_model');
     }
     function index()
     {
         $this->load->helper('login_helper');admin_log();
         $config['base_url'] = base_url().'admin/carrier/index';
         $config['total_rows'] = $this->carrier_model->count_carrier();
         $config['uri_segment'] = 4;
         $config['per_page'] = 15;
         $this->pagination->initialize($config);
         $data['carriers'] = $this->carrier_model->carriers($config['per_page'],$this->uri->segment(4));
         $data['title']="Carrier Manager | Optical Store Onlne";
         $data['page']="admin/view_carrier";
         $this->load->view('admin/container',$data);
     }
     function insert()
     {
         $this->load->helper('login_helper');admin_log();
         if($this->input->post())
         {
             $data = $this->post();
             $this->carrier_model->save_carrier($data);
             $this->session->set_flashdata('msg','The insertion is done successfully.');
             redirect(base_url().'admin/carrier/index');
         }
         else
         {
            $data['countries'] = $this->carrier_model->country();
            $data['title']="Add Carrier";
            $data['page']="admin/add_carrier";
            $this->load->view('admin/container',$data);
         }
     }
     function edit($carrier_id)
     {
         $this->load->helper('login_helper');admin_log();
         
         if($this->input->post())
         {
             $data = $this->post();
             $this->carrier_model->edit_carrier($carrier_id,$data);
             $this->session->set_flashdata('msg','The updation is done successfully.');
             redirect(base_url().'admin/carrier/index');
         }
         else
         {
             $data['countries'] = $this->carrier_model->country();
             $data['carrier']=$this->carrier_model->select_carrier($carrier_id);
             $data['title']="Edit Carrier";
             $data['page']="admin/edit_carrier";
             $this->load->view('admin/container',$data);
         }
     }
     function post()
     {
         $this->load->helper('login_helper');admin_log();
         $data = array(
                 'fld_country'=>$this->input->post('country'),
                 'fld_carrier'=>$this->input->post('carrier'),
                 'fld_shipping_cost'=>$this->input->post('shipping_cost'),
                 'fld_additional_cost'=>$this->input->post('additional_cost'),
                 'fld_insurance_cost'=>$this->input->post('insurance_cost'),
                 'fld_additional_insurance_cost'=>$this->input->post('additional_insurance_cost')
             );
         return $data;
     }
     function delete($id)
     {
         $this->load->helper('login_helper');admin_log();
         $this->carrier_model->delete_carrier($id);
         $this->session->set_flashdata('msg','The carrier is successfully deleted.');
         redirect(base_url().'admin/carrier/index');
     }
}
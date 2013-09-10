<?php class Vendor extends CI_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->library('pagination');
         $this->load->model('admin/vendor_model');
         $this->load->model('admin/product_type_model');
     }
     function index()
     {
         $this->load->helper('login_helper');admin_log();
         $config['base_url'] = base_url().'admin/vendor/index';
         $config['total_rows'] = $this->vendor_model->count_vendor();
         $config['uri_segment'] = 4;
         $config['per_page'] = 15;
         $this->pagination->initialize($config);
         $data['vendors'] = $this->vendor_model->vendors($config['per_page'],$this->uri->segment(4));
         $data['title']="Vendor Manager | Optical Store Onlne";
         $data['page']="admin/view_vendor";
         $this->load->view('admin/container',$data);
     }
     function insert()
     {
         $this->load->helper('login_helper');admin_log();
         if($this->input->post())
         {
             $data = $this->post();
             $this->vendor_model->save_vendor($data);
             $this->session->set_flashdata('msg','The vendor is successfully added.');
             redirect(base_url().'admin/vendor/index');
         }
         else
         {
            $data['product_types']=$this->product_type_model->get_all_product_types(); 
            $data['title']="Add Vendor";
            $data['page']="admin/add_vendor";
            $this->load->view('admin/container',$data);
         }
     }
     function edit($vendor_id)
     {
         $this->load->helper('login_helper');admin_log();
         if($this->input->post())
         {
             $data = $this->post();
             $this->vendor_model->edit_vendor($vendor_id,$data);
             $this->session->set_flashdata('msg','The vendor is successfully updated.');
             redirect(base_url().'admin/vendor/index');
         }
         else
         {
             $data['product_types']=$this->product_type_model->get_all_product_types(); 
             $data['vendor']=$this->vendor_model->select_vendor($vendor_id);
             $data['title']="Edit Carrier";
             $data['page']="admin/edit_vendor";
             $this->load->view('admin/container',$data);
         }
     }
     function post()
     {
         $this->load->helper('login_helper');admin_log();
         $data = array(
                 'fld_product_type'=>$this->input->post('vendorfor'),
                 'fld_name'=>$this->input->post('name'),
                 'fld_address'=>$this->input->post('address'),
                 'fld_telephone'=>$this->input->post('telephone'),
                 'fld_mobile'=>$this->input->post('mobile'),
                 'fld_email'=>$this->input->post('email'),
                 'fld_website'=>$this->input->post('website')
             );
         return $data;
     }
     function delete($id)
     {
         $this->load->helper('login_helper');admin_log();
         $this->vendor_model->delete_vendor($id);
         $this->session->set_flashdata('msg','The vendor is successfully deleted.');
         redirect(base_url().'admin/vendor/index');
     }
}
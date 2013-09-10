<?php class Enduser extends CI_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->model('admin/enduser_model');
         $this->load->library('pagination');
     }
     function index()
     {
         $this->load->helper('login_helper');admin_log();
         if($this->session->userdata('ac_flag')==1)
         {
             if($this->session->userdata('noticed_endusers'))
             {
                $noticed_endusers = $this->session->userdata('noticed_endusers');
                for($i=0;$i<sizeof($noticed_endusers);$i++)
                {
                   $this->enduser_model->empty_tbl_acc_notice($noticed_endusers[$i]);
                }
                
             }
         }
         $new_endusers = $this->enduser_model->new_endusers();
         if($new_endusers->num_rows()!=0)
         {
             $count=0;
             foreach($new_endusers->result() as $row)
             {
                 $end[$count] = $row->fld_user;
                 $count++;
             }
             $this->session->set_userdata('noticed_endusers',$end);
             
         }else{
             $this->session->unset_userdata('noticed_endusers');
         }
         
         $this->session->set_userdata('ac_flag',1);
         $config['base_url'] = base_url().'admin/enduser/index';
         $config['total_rows'] = $this->enduser_model->count();
         $config['per_page'] = 15;
         $config['uri_segment'] = 4;
         $this->pagination->initialize($config);
         $data['endusers'] = $this->enduser_model->select($config['per_page'],$this->uri->segment(4));
         $data['title']="End User Manager | Optical Store Online";
         $data['page']='admin/view_enduser';
         $this->load->view('admin/container',$data);
     }
}
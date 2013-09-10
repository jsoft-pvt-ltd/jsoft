<?php
class Meta extends CI_Controller{
    
        public function  _construct(){
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('admin/meta_model');
        
    }
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $this->load->model('admin/meta_model');
        $config['base_url'] = base_url().'admin/meta/index';
        $config['total_rows'] = $this->meta_model->count();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();
        $data['alldata']=$this->meta_model->view_meta($config['per_page'],$this->uri->segment(4));
        $data['title']="Meta | Optical Store Online";
        $data['page']="admin/meta/viewmeta";
        $this->load->view('admin/container',$data);
    }

    function add_meta(){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/meta_model');
        $data['pages']=$this->meta_model->show_all();
        $data['cats']=$this->meta_model->show_cats();
        $data['products']=$this->meta_model->show_prod();
        $data['title']="Add Meta | Optical Store Online";
        $data['page']="admin/meta/addmeta";
        $this->load->view('admin/container',$data);
    }

    function insert(){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/meta_model');
        $pname=$_POST['title'];
        $metas=$_POST['meta'];
        $meta=ltrim(rtrim($metas));
        $keys=$_POST['keys'];
        $mypage=$_POST['page'];
        $duplicate=$this->meta_model->view_metas();
        foreach ($duplicate as $dup){
            echo '<br>DB page='.$dup->fld_page;
            echo '<br>inserted page='.$mypage;
            if($dup->fld_page==$mypage)
            {
            $this->session->set_flashdata('msg','<script>alert("Oops! Meta for this page already exists! You can always edit.");</script>');
            redirect(base_url().'admin/meta');
            }
        }
        $arr=array(
            'fld_title'=> $pname,
            'fld_meta'=>$meta,
            'fld_keywords'=>$keys,
            'fld_page'=>$mypage
                );
        $this->meta_model->insert_meta($arr);
        $this->session->set_flashdata('msg','<script>alert("Meta for a page Successfully Inserted");</script>');
        redirect(base_url().'admin/meta');
    }

    function view_meta(){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/meta_model');
        $data['alldata']=$this->meta_model->view_meta();
        $this->load->view('admin/meta/viewmeta',$data);
    }
    function delete_meta($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/meta_model');
        $this->meta_model->delete_meta($id);
        $this->session->set_flashdata('msg','<script>alert("Meta for a page Successfully Deleted.");</script>');
        redirect(base_url().'admin/meta');
    }
    function update_meta($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/meta_model');
        $data['allmeta']=$this->meta_model->select_meta($id);
        $data['title']="Update Meta | Optical Store Online";
        $data['page']="admin/meta/updatemeta";
        $this->load->view('admin/container',$data);
    }
    function update_thismeta($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/meta_model');
        $pname=$_POST['title'];
        $meta=$_POST['meta'];
        $keys=$_POST['keys'];
        
        $arr=array(
            'fld_title'=> $pname,
            'fld_meta'=>$meta,
            'fld_keywords'=>$keys,
                );
        $this->meta_model->update_meta($id,$arr);
        $this->session->set_flashdata('msg','<script>alert("Meta for a page Successfully Updated.");</script>');
        redirect(base_url().'admin/meta');
    }
}
?>

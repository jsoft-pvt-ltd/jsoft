<?php class Dynamic extends CI_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->model('admin/page_model');
         $this->load->library('pagination');
     }
     function index()
     {
         $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $config['base_url'] = base_url().'admin/dynamic/index';
        $config['total_rows'] = $this->page_model->count();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config); 
        $data['pages']=$this->page_model->show($config['per_page'],$this->uri->segment(4));//($config['per_page'],$this->uri->segment(4));
        $data['pagination'] = $this->pagination->create_links();
        $data['title']="Pages | Optical Store Online";
        $data['page']="admin/meta/viewpages";
        $this->load->view('admin/container',$data);
         
     }
     function add(){
         $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $data['title']="Add Pages | Optical Store Online";
        $data['page']="admin/meta/addpage";
        $this->load->view('admin/container',$data);
    } 
    function addlink(){
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $data['title']="Add Links | Optical Store Online";
        $data['page']="admin/meta/addlinks";
        $this->load->view('admin/container',$data);
    }
    function insert_page(){
        $this->load->helper('login_helper');admin_log();
        
        $pname=$_POST['page'];
        $content=$_POST['content'];
        $duplicate=$this->page_model->show_all();
        foreach ($duplicate as $dup){
            if(strtoupper($dup->fld_page)==strtoupper($pname))
            {
            $this->session->set_flashdata('msg','<script>alert("Oops! Page with same name already exists! Try different name.");</script>');
            redirect(base_url().'admin/dynamic/add');
            }
        }
        $arr=array(
            'fld_page'=> $pname,
            'fld_content'=>$content,
            'fld_type'=>"1"
                );
        $this->page_model->insert($arr);
        $this->load->model('admin/rank_model');
        $this->load->model('admin/menu_model');
        $rank=$this->rank_model->get_max_rank();
        $rank1=$this->menu_model->get_max_frank();
        $arr1=array(
            'fld_page'=> $pname,
            'fld_rank'=>$rank+1,
            'fld_frank'=>$rank1+1,
            'fld_option'=>0,
            'fld_foption'=>0,
            'fld_type_id'=>1
                );
        $this->rank_model->insert($arr1);
        $this->session->set_flashdata('msg','<script>alert("Page Successfully Inserted");</script>');
        redirect(base_url().'admin/dynamic');
    }
    function insert_link(){
        $this->load->helper('login_helper');admin_log();
        
        $pname=$_POST['title'];
        $url=$_POST['url'];
        $alt=$_POST['alt'];
        $target=$_POST['target'];
        $arr=array(
            'fld_page'=> $pname,
            'fld_url'=>$url,
            'fld_alt'=>$alt,
            'fld_target'=>$target,
            'fld_type'=>"2"
                );
        $this->page_model->insert($arr);
        $this->load->model('admin/rank_model');
        $this->load->model('admin/menu_model');
        $rank=$this->rank_model->get_max_rank();
        $rank1=$this->menu_model->get_max_frank();
        $arr1=array(
            'fld_page'=> $pname,
            'fld_rank'=>$rank+1,
            'fld_frank'=>$rank1+1,
            'fld_option'=>0,
            'fld_foption'=>0,
            'fld_type_id'=>2
                );
        $this->rank_model->insert($arr1);
        $this->session->set_flashdata('msg','<script>alert("Link Successfully Inserted");</script>');
        redirect(base_url().'admin/dynamic');
    }
     function delete_page($id){
         $this->load->helper('login_helper');admin_log();
        $page=$this->page_model->get_name_from_page_id($id);
        $this->page_model->delete_page($id);
        $this->page_model->delete_meta_for_page($page);
        $this->page_model->delete_rank_for_page($page);
        $this->session->set_flashdata('msg','<script>alert("Page Successfully Deleted");</script>');
        redirect(base_url().'admin/dynamic');
    }
    function delete_link($id){
        $this->load->helper('login_helper');admin_log();
        $page=$this->page_model->get_name_from_page_id($id);
        $this->page_model->delete_page($id);
        $this->page_model->delete_rank_for_page($page);
        $this->session->set_flashdata('msg','<script>alert("Link Successfully Deleted");</script>');
        redirect(base_url().'admin/dynamic');
    }
    function update_page($id){
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $data['pages']=$this->page_model->select_page($id);
        $data['title']="Pages | Optical Store Online";
        $data['page']="admin/meta/updatepage";
        $this->load->view('admin/container',$data);
    }
    function update_link($id){
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $data['pages']=$this->page_model->select_page($id);
        $data['title']="Pages | Optical Store Online";
        $data['page']="admin/meta/updatelink";
        $this->load->view('admin/container',$data);
    }
    function update_eachpage($id){
        $this->load->helper('login_helper');admin_log();
        $page=$this->page_model->get_name_from_page_id($id);
        $pname=$_POST['page'];
        $content=$_POST['content'];
        $duplicate=$this->page_model->show_all();
        foreach ($duplicate as $dup){
            if(strtoupper($dup->fld_page)==strtoupper($pname))
            {
            $this->session->set_flashdata('msg','<script>alert("Oops! Page with same name already exists! Try different name.");</script>');
            redirect(base_url().'admin/dynamic/update_page/'.$id);
            }
        }
        $arr=array(
            'fld_page'=> $pname,
            'fld_content'=>$content,
              );
        $arr1=array(
            'fld_page'=> $pname
            );
        $this->page_model->update_page($id,$arr);
        $this->page_model->update_meta_page($page,$arr1);
        $this->page_model->update_rank_page($page,$arr1);
        $this->session->set_flashdata('msg','<script>alert("Page Successfully Updated");</script>');
        redirect(base_url().'admin/dynamic');
    }
    
    function edit_link($id){
        $this->load->helper('login_helper');admin_log();
        $page=$this->page_model->get_name_from_page_id($id);
        $pname=$_POST['title'];
        $url=$_POST['url'];
        $alt=$_POST['alt'];
        $target=$_POST['target'];
        $arr=array(
            'fld_page'=> $pname,
            'fld_url'=>$url,
            'fld_alt'=>$alt,
            'fld_target'=>$target,
                );
        $arr1=array(
            'fld_page'=> $pname
            );
        $this->page_model->update_page($id,$arr);
        $this->page_model->update_rank_page($page,$arr1);
        $this->session->set_flashdata('msg','<script>alert("Link Successfully Updated");</script>');
        redirect(base_url().'admin/dynamic');
    }
}
?>
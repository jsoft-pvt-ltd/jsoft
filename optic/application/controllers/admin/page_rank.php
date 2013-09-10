<?php
class Page_rank extends CI_Controller{
    
        public function  _construct(){
        parent::__construct();
        $this->load->library('pagination');
        
    }
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['title']="Menage Page Ranks | Optical Store Online";
        //$data['page']="admin/viewrank";
        //$data['page']="admin/newrank";
        //$data['page']="admin/jsonrank";
        $data['page']="admin/rank_options";
        $this->load->view('admin/container',$data);
    }
    function test(){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $data['title']="Rank Test | Optical Store Online";
        $data['headers']=$this->menu_model->show();
        $data['footers']=$this->menu_model->fshow();
        $data['page']="admin/test";
        $this->load->view('admin/container',$data);
    }
    function manage_header(){
        $this->load->helper('login_helper');admin_log();
        $data['title']="Menage Page Ranks | Optical Store Online";
        $this->load->model('admin/menu_model');
        $data['msg']=$this->session->flashdata('msg');
        $data['max']=$this->menu_model->get_max_rank();
        $data['alldata']=$this->menu_model->show_rank();
        $data['page']="admin/view_rank";
        $this->load->view('admin/container',$data);
    }
    function manage_footer(){
        $this->load->helper('login_helper');admin_log();
        $data['title']="Menage Page Ranks | Optical Store Online";
        $this->load->model('admin/menu_model');
        $data['msg']=$this->session->flashdata('msg');
        $data['max']=$this->menu_model->get_max_frank();
        $data['alldata']=$this->menu_model->fshow_rank();
        $data['page']="admin/view_frank";
        $this->load->view('admin/container',$data);
    }
    function move_up($pos){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        if($pos==1)
        {
            $this->session->set_flashdata('msg','<script>alert("Minimum Level Reached, Cannot Move Up.");</script>');
            redirect(base_url().'admin/page_rank');
        }
        $id=$this->menu_model->get_id_by_rank($pos);
        $this->menu_model->up($pos,$id);
       $this->session->set_flashdata('msg','<script>alert("Successfully Changed Position.");</script>');
        redirect(base_url().'admin/page_rank');
    }
    function move_down($pos){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $max=$this->menu_model->get_max_rank();
        if($pos==$max)
        {
            $this->session->set_flashdata('msg','<script>alert("Maximum Level Reached, Cannot Move Down.");</script>');
            redirect(base_url().'admin/page_rank');
        }
        $id=$this->menu_model->get_id_by_rank($pos);
        $this->menu_model->down($pos,$id);
        $this->session->set_flashdata('msg','<script>alert("Successfully Changed Position.");</script>');
        redirect(base_url().'admin/page_rank');
    }
    function delete_page($name){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $max_rank = $this->menu_model->get_max_rank();
        $rank = $this->menu_model->get_rank_by_name($name);
        $cat_id=array();
        for($i=$rank+1;$i<=$max_rank;$i++){
        $cat_id[] = $this->menu_model->get_id_by_rank($i);
        }
        //print_r($cat_id);
        foreach($cat_id as $key=>$val) {
            //echo '<br>val='.$val;
            $rank = $this->menu_model->get_rank_by_id($val);
            $data=$rank-1;
            $this->menu_model->up($rank,$data);
        }
    }
    
    function get_max_rank(){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        echo $this->menu_model->get_max_rank();
    }
    function get_max_frank(){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        echo $this->menu_model->get_max_frank();
    }
    function move_ups($pos){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->get_id_by_rank($pos);
        $this->menu_model->up($pos,$id);
        $alldata=$this->menu_model->show_rank();
        echo json_encode($alldata);
    }
    function move_downs($pos){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->get_id_by_rank($pos);
        $this->menu_model->down($pos,$id);
        $alldata=$this->menu_model->show_rank();
        echo json_encode($alldata);
    }
    function move_fdowns($pos){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->get_id_by_frank($pos);
        $this->menu_model->fdown($pos,$id);
        $alldata=$this->menu_model->fshow_rank();
        echo json_encode($alldata);
    }
    function move_fups($pos){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->get_id_by_frank($pos);
        $this->menu_model->fup($pos,$id);
        $alldata=$this->menu_model->fshow_rank();
        echo json_encode($alldata);
    }
    function show($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->show_menu($id);
        $alldata=$this->menu_model->show_rank();
        echo json_encode($alldata);
    }
    function hide($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->hide_menu($id);
        $alldata=$this->menu_model->show_rank();
        echo json_encode($alldata);
    }
    function showf($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->show_fmenu($id);
        $alldata=$this->menu_model->fshow_rank();
        echo json_encode($alldata);
    }
    function hidef($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/menu_model');
        $id=$this->menu_model->hide_fmenu($id);
        $alldata=$this->menu_model->fshow_rank();
        echo json_encode($alldata);
    }
    function each_page($id){
        $this->load->helper('login_helper');admin_log();
        $this->load->model('admin/page_model');
        $name=$this->page_model->get_name_from_page_id($id);
        $data['title']=$name.'| Optic Store Online';
        $data['content']=$this->page_model->select_page_by_name($name);
        $data['page']="admin/eachtest_page";
        $this->load->view('admin/container',$data);
    }
}
?>

<?php
class Faq extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/faq_model');
        $this->load->library('pagination');
    }
    public function index(){
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $config['base_url'] = base_url().'admin/faq/index';
        $config['total_rows'] = $this->faq_model->count_faqs();
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['faqs'] = $this->faq_model->faqs($config['per_page'],$this->uri->segment(4));
        $data['title']="FAQ | Optic Store Online";
        $data['page']="admin/view_faq";
        $this->load->view('admin/container',$data);
    }
    public function addFAQ(){
        $this->load->helper('login_helper');admin_log();
        $data['title']="Add FAQ's";
        $data['page']="admin/add_faq";
        $data['faqtypes']=$this->faq_model->select_all_faqtype(); 
        $this->load->view('admin/container',$data);
    }
    public function Insert(){
        
        $this->load->helper('login_helper');admin_log();
        
        $data['fld_faqtype']    = $this->input->post('faqtype');
        $data['fld_question']   = $this->input->post('question');
        $data['fld_description']= $this->input->post('ans');
        $this->faq_model->InsertIAF($data);
        $this->session->set_flashdata('msg', 'The faq data is successfully inserted.');
        redirect(base_url().'admin/faq');
    }
    
    function DeleteIAF($id){
        $this->load->helper('login_helper');admin_log();
        $this->faq_model->deleteIAF($id);
        $this->session->set_flashdata('msg', 'The faq data is successfully deleted.');
        redirect(base_url().'admin/faq');
    }
    
    function update($id){
        $this->load->helper('login_helper');admin_log();
        $data['faq'] = $this->faq_model->GetIAFInfoById($id);
        $data['faqtypes']=$this->faq_model->select_all_faqtype();
        $data['title']="Edit FAQ | Optic Store Online";
        $data['page']="admin/edit_faq";
        $this->load->view('admin/container',$data);
    }
    function edit($id)
    {
        $this->load->helper('login_helper');admin_log();
        $data=array (
            'fld_faqtype'    => $_POST['faqtype'],
            'fld_question'   => $_POST['question'],
            'fld_description'=> $_POST['ans']
        );
        $this->faq_model->UpdateIAF($id,$data);
        $this->session->set_flashdata('msg', 'The faq data is successfully updated.');
        redirect(base_url().'admin/faq');
    }
    function faqtype()
    {
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $config['base_url'] = base_url().'admin/faq/faqtype';
        $config['total_rows'] = $this->faq_model->count_faqtype();
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['faqtypes'] = $this->faq_model->faqtype($config['per_page'],$this->uri->segment(4));
        $data['title']="FAQ type | Optic Store Online";
        $data['page']="admin/view_faqtype";
        $this->load->view('admin/container',$data);
    }
    function add_faqtype()
    {
        $this->load->helper('login_helper');admin_log();
        $data = array(
                        'fld_faqtype'=>$this->input->post('faqtype')
                );
        $this->faq_model->insert_faqtype($data);
        $this->session->set_flashdata('msg', 'The faq type is successfully inserted.');
        redirect(base_url().'admin/faq/faqtype');
        
    }
    function edit_faqtype($faqtype_id)
    {
        $this->load->helper('login_helper');admin_log();
        $data = array(
                        'fld_faqtype'=>$this->input->post('faqtype')
                );
        $this->faq_model->update_faqtype($faqtype_id,$data);
        echo $this->input->post('faqtype');
    }
    function delete_faqtype($faqtype_id)
    {
        $this->load->helper('login_helper');admin_log();
        $this->faq_model->delete_faqtype($faqtype_id);
        echo "true";
    }
    function qna_of_section($section_id)
    {
        $data['qnas'] = $this->faq_model->select_qna_of_section($section_id);
        echo $this->load->view('site/qna',$data);
    }
}
?>

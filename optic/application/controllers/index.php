<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index()
	{
        $data['msg'] = $this->session->flashdata('msg');
        $data['meta_description']='This is home page of opticstoreonline and must be dyanmic';
        $data['title']='Home';
        $this->load->model('admin/product_model');
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/index';
        $config['total_rows'] = $this->product_model->count();
        $config['per_page'] = 50;
        $this->pagination->initialize($config);
        $data['products'] = $this->product_model->select_best_seller_product($config['per_page'],$this->uri->segment(3));
		$this->load->view('site/header',$data);
        $this->load->view('site/index');
        $this->load->view('site/footer');
	}
    function help()
    {
        $this->load->model('admin/faq_model');
        $data['sections'] = $this->faq_model->sections();
        $data['title']='Help | Optic Store Online';
        $this->load->view('site/header',$data);
        $this->load->view('site/help');
        $this->load->view('site/footer');
    }
}
?>
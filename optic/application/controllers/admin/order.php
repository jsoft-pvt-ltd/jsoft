<?php class Order extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('admin/order_model');
    }
    function index()
    {
        $this->load->helper('login_helper');admin_log();
        $config['base_url'] = base_url().'admin/order/index/';
        $config['total_rows'] = $this->order_model->count_orders();
        $config['per_page'] = 15;
        $config['uri_segment']=4;
        $this->pagination->initialize($config);
        $data['orders']=$this->order_model->orders($config['per_page'],$this->uri->segment(4));
        $data['title']="Orders | Optical Store Onlne";
        $data['page']="admin/view_order";
        $this->load->view('admin/container',$data);
                
    }
    function search()
    {
        $this->load->helper('login_helper');admin_log();
        $url = parse_url($_SERVER['REQUEST_URI']);
        parse_str($url['query'],$params);
//      print_r($params);exit;
        $flag = 0;
        $sql = 'select * from tbl_order';
        if($params['orderby']!="")
        {
            $data['orderby'] = $params['orderby'];
            $sql = $sql.' where ( fld_first_name like "%'.$params['orderby'].'%" )';
            $flag=1;
        }
        if($params['invoice']!="")
        {
            $data['invoice'] = $params['invoice'];
            if($flag==0)
            {
                $sql = $sql.' where ( fld_invoice = "'.$params['invoice'].'" )';
                $flag=1;
            }else{
                $sql = $sql.' and ( fld_invoice = "'.$params['invoice'].'" )';
            }
            
        }
        if($params['status']!="")
        {
            $data['status'] = $params['status'];
            if($flag==0)
            {
                $sql = $sql.' where ( fld_status like "%'.$params['status'].'" )';
                $flag=1;
            }else{
                $sql = $sql.' and ( fld_status like "%'.$params['status'].'" )';
            }
        }
        if($params['txtCheckin']!="" && $params['txtCheckout']!="")
        {
            $data['txtCheckin'] = $params['txtCheckin'];
            $data['txtCheckout'] = $params['txtCheckout'];
            if($flag==0)
            {
                $sql = $sql.' where ( fld_date between "'.$params['txtCheckin'].'" and "'.$params['txtCheckout'].'" )';
                $flag=1;
            }else{
                $sql = $sql.' and ( fld_date between "'.$params['txtCheckin'].'" and "'.$params['txtCheckout'].'" )';
            }
            
        }
        if(isset($params['per_page']))
        {
            $current_page = $params['per_page'];
        }
        else
        {
            $current_page = 0;
        }
        $config['base_url'] = base_url().'admin/order/search/?orderby='.$params['orderby'].'&invoice='.$params['invoice'].'&status='.$params['status'].'&txtCheckin='.$params['txtCheckin'].'&txtCheckout='.$params['txtCheckout'];
        $config['total_rows'] = $this->order_model->count_search_orders($sql);
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['orders'] = $this->order_model->search_orders($config['per_page'],$current_page,$sql);
        $data['title']="Orders | Optical Store Onlne";
        $data['page']="admin/view_order";
        $this->load->view('admin/container',$data);
       
    }
    function delete($order_id)
    {
        $this->load->helper('login_helper');admin_log();
        $this->order_model->delete_order($order_id);
        $this->session->set_flashdata('msg','The order is successfully deleted.');
        redirect(base_url().'admin/order/index');
    }
    function detail($order_id)
    {
        $this->load->helper('login_helper');admin_log();
        $data['order']  = $this->order_model->order_info($order_id);
        $data['order_items'] = $this->order_model->order_items($order_id);
        $data['title']="Order Detail | Optical Store Onlne";
        $data['page']="admin/view_order_detail";
        $this->load->view('admin/container',$data);
    }
    function get_prescription_info($id){ //this id is the prescription id for tbl_presc_entry
        if($this->session->userdata('admin_logged_in')==true || $this->session->userdata('userId')!=""){
            $this->load->helper('login_helper');
            echo json_encode($this->order_model->get_prescription_info($id));
        }
        else redirect(base_url().'admin/login');
    }
}
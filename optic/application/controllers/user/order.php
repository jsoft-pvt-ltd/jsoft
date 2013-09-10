<?php class Order extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        
        
    }
    function history()
    {
        $this->load->helper('login_helper');
        if(IsLoggedIn()!=1)
        {
            redirect(base_url().'user/login');
        }
        $this->load->model('user/order_model');
        $config['base_url'] = base_url().'user/order/history/';
        $config['total_rows'] = $this->order_model->count_orders($this->session->userdata('userId'));
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['orders'] = $this->order_model->orders($config['per_page'],$this->uri->segment(4),$this->session->userdata('userId'));
        $data['title'] = 'Order History';
        $data['page'] = 'user/order';
        $this->load->view('user/container',$data);
    }
    function search()
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        parse_str($url['query'],$params);
        $flag = 0;
        $sql = 'select * from tbl_order';
        if($params['orderby']!="")
        {
            $data['orderby'] = $params['orderby'];
            $sql = $sql.' where ( fld_user = "'.$params['orderby'].'" )';
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
        $this->load->model('admin/order_model');
        $config['base_url'] = base_url().'user/order/search/?orderby='.$params['orderby'].'&invoice='.$params['invoice'].'&status='.$params['status'].'&txtCheckin='.$params['txtCheckin'].'&txtCheckout='.$params['txtCheckout'];
        $config['total_rows'] = $this->order_model->count_search_orders($sql);
        $config['per_page'] = 5;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['orders'] = $this->order_model->search_orders($config['per_page'],$current_page,$sql);
        $data['title']="My Orders | Optical Store Onlne";
        $data['page']="user/order";
        $this->load->view('user/container',$data);
       
    }
    function delete($order_id)
    {
        $this->load->model('admin/order_model');
        $this->order_model->delete_order($order_id);
        $this->session->set_flashdata('msg','The order is successfully deleted.');
        redirect(base_url().'user/order/index');
    }
    function detail($order_id)
    {
        $this->load->helper('login_helper');
        if(IsLoggedIn()!=1)
        {
            redirect(base_url().'user/login');
        }
        $this->load->model('admin/order_model');
        $data['order']  = $this->order_model->order_info($order_id);
        $data['order_items'] = $this->order_model->order_items($order_id);
        $data['title']="Order Detail | Optical Store Onlne";
        $data['page']="user/order_detail";
        $this->load->view('user/container',$data);
    }
}
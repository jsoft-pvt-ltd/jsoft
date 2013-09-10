<?php class Promocode extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('site/promocode_model');
    }
    function check()
    {
        $promo_code = $_GET['data'];
        $promocode="";
        $promo_code = explode(" ",$promo_code);
        for($i=0;$i<sizeof($promo_code);$i++){
            $promocode = $promocode.$promo_code[$i]."_";
        }
        $promocode = substr($promocode, 0,-1);
        $promocode = strtolower($promocode);
        $checked_promocode = $this->promocode_model->check_promocode($promocode);
        if($checked_promocode=="nomatch")
        {
            $checked_promocode = array(
                                        'fld_promocode_type'=>"nomatch"
            );
            echo json_encode($checked_promocode);
        }
        else
        {
            if($checked_promocode->fld_status==1)
            {
                if($checked_promocode->fld_start_date!="0000-00-00" || $checked_promocode->fld_end_date!="0000-00-00")
                {
                    if(date("Y-m-d")>$checked_promocode->fld_start_date){
                        //echo date("Y-m-d").'='.$checked_promocode->fld_end_date;
                        if(date("Y-m-d")>$checked_promocode->fld_end_date){
                            $checked_promocode = array(
                                        'fld_promocode_type'=>"exp"
                            );
                            echo json_encode($checked_promocode);
                            
                        }else{
                            echo json_encode($checked_promocode);
                        }
                    }else{
                        $checked_promocode = array(
                                        'fld_promocode_type'=>"date"
                        );
                        echo json_encode($checked_promocode);
                        
                    }
                }
                else if($checked_promocode->fld_start_date=="0000-00-00" || $checked_promocode->fld_end_date=="0000-00-00"){
                    echo json_encode($checked_promocode);
                }
            }else{
                $checked_promocode = array(
                                        'fld_promocode_type'=>"inactive"
                );
                echo json_encode($checked_promocode);
            }
                
        }

    }
    function category($catid){
        echo json_encode($this->promocode_model->select_category($catid));
        
    }
    function cart_item()
    {
        $this->load->library('cart');
        echo $this->cart->total_items();
    }
    function total()
    {
        $this->load->library('cart');
        echo $this->cart->total();
    }
    function set_promocode_true($category){
        $this->session->set_userdata('promocode',true);
        $this->session->set_userdata('free_category',$category);
    }
    function get_total_cart_items(){
        echo json_encode($this->promocode_model->get_total_cart_items());
    }
}
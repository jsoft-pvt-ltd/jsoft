<?php class Search extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('site/search_model');
    }
    function index()
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        parse_str($url['query'], $params);
//        print_r($params);exit;
                
        
        $sql = "";
        $sql = 'select tbl_product.* from tbl_product inner join tbl_product_attribute on tbl_product.fld_id = tbl_product_attribute.fld_product';
        $flag = 0;
        $caturl = "";$suburl = "";$atturl = "";
        if(isset($params['cat']))
        {
            $sql = $sql." where ";
            $catfield = " ( fld_category = ";
            $categories = $params['cat'];
           
            for($i=0;$i<sizeof($categories);$i++)
            {
                $data['ucat'][$i]=$categories[$i];
                if($i==0)
                {
                    $caturl = $caturl."cat[]=".$categories[$i];
                    $catparam = $catfield.$categories[$i];
                    $catparam = $catparam." ) ";
                }
                else if($i>0)
                {
                    $caturl = $caturl."&cat[]=".$categories[$i];
                    $catparam = $catparam." or ";
                    $catparam = $catparam.$catfield.$categories[$i];
                    $catparam = $catparam." ) ";
                }
            }
            $sql = $sql.$catparam;
            $flag = 1;
        }
        if(isset($params['sub']))
        {
            if($flag==1)
            {
                $sql = $sql ." and ";
                $suburl = $suburl."&";
            }
            $subfield = " ( fld_subcategory = ";
            $subcategories = $params['sub'];
            
            for($i=0;$i<sizeof($subcategories);$i++)
            {
                $data['usub'][$i] = $subcategories[$i];
//                $suburl = $suburl."sub[]=".$subcategories[$i];
                if($i==0)
                {
                    $suburl = $suburl."sub[]=".$subcategories[$i];
                    $subparam = $subfield.$subcategories[$i];
                    $subparam = $subparam." ) ";
                }
                else if($i>0)
                {
                    $suburl = $suburl."&sub[]=".$subcategories[$i];
                    $subparam = $subparam." or ";
                    $subparam = $subparam.$subfield.$subcategories[$i];
                    $subparam = $subparam." ) ";
                }
            }
            $sql = $sql .$subparam;
        }
        
        if(isset($params['attr']))
        {
            if($flag==1)
            {
                $sql = $sql ." and ";
                $atturl = $atturl."&";
            }
            else if($flag==0)
            {
                $sql = $sql. " where ";
            }
            $attrfield = " ( tbl_product_attribute.fld_value = ";
            //here in this case $attributes means attribute values 
            $attributes = $params['attr'];
            
            for($i=0;$i<sizeof($attributes);$i++)
            {
               
                if($i==0)
                {
                    $atturl = $atturl."attr[]=".$attributes[$i];
                    $attribute = explode("_",$attributes[$i]);
                    $attrparam = $attrfield.$attribute[1];
                    $data['uattr'][$i]=$attribute[1];
                    $attrparam = $attrparam." ) ";
                }
                else if($i>0)
                {
                    $atturl = $atturl."&attr[]=".$attributes[$i];
                    $attrparam = $attrparam." or ";
                    $attribute = explode("_",$attributes[$i]);
                    $attrparam = $attrparam.$attrfield.$attribute[1];
                    $data['uattr'][$i]=$attribute[1];
                    $attrparam = $attrparam." ) ";
                }
            }
            $sql = $sql .$attrparam;
            
                
        }
        $sql = $sql.' group by tbl_product.fld_id';
        if(isset($params['per_page']))
        {
            $current_page = $params['per_page'];
        }
        else
        {
            $current_page=0;
        }
        $config['base_url'] = base_url() . 'site/search/index/?'.$caturl.$suburl.$atturl;
        $config['per_page'] = 12;
        $config['page_query_string'] = TRUE;
        $config['num_links'] = 10;
        $config['total_rows'] = $this->search_model->count_search_product($sql);
        $data['products']=$this->search_model->search_product($config['per_page'],$current_page,$sql);
        $this->pagination->initialize($config);
        $data['title'] = "Search | Optical Store Online";
        $this->load->view('site/header',$data);
        $this->load->view('site/search');
        $this->load->view('site/footer');
    }
}
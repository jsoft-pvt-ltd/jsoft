<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cart_steps
 *
 * @author user
 */
class Cart_steps extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('login_helper');
    }
    function index($id){
        $this->load->model('admin/lens_model');
        $this->load->model('admin/product_model');
        $data['product'] = $this->product_model->get_product_by_id($id);
        $data['colors'] = $this->product_model->get_attr_color_by_id($id);//product_id
        $data['compatibility']=$this->lens_model->get_all_lens_type();
        $data['product_info'] = $this->product_model->get_product_by_id($id); //gets row
        $data['lens_types'] = $this->lens_model->get_lens_type_by_id($id);
        $data['title']=$data['product_info']->fld_name;
        $this->load->view('site/header',$data);
        $this->load->view('site/selected_product');
        $this->load->view('site/footer');
    }
    
    /* steps
    * if id is null then it works for insertion else for editing;
    * the id provided here is the tbl_temp's fld_id;
    */
    function steps($id=0){ //from tbl temp
        $this->load->helper('login_helper');
//        if(IsLoggedIn()){
            if($_POST){
                $data_post['fld_product']=$_POST['product_id'];
                $data_post['fld_color']=$_POST['color'];
                $data_post['fld_lens_type']=$_POST['lens_type'];
                $data_post['fld_category_id']=$_POST['cat_id'];
                $this->session->set_userdata($data_post);
                redirect(base_url().'site/cart_steps/view_steps');//coz session is set
            }
            else if($id!=0){
                $this->load->model('user/my_prescription_model');
                $this->load->model('admin/product_model');
                $temp = $this->product_model->get_product_from_tbl_temp_by_id($id);
                $data_post['fld_product']=$temp->fld_product;
                $data_post['fld_color']=$temp->fld_color;
                $data_post['fld_lens_type']=$temp->fld_lens_type;
                $data_post['fld_category_id']=$temp->fld_category;
                $this->session_unset();
                $this->session->set_userdata($data_post);
                if($temp->fld_prescription==1)
                {
                    $this->session->set_userdata('edit',true);
                    $temp_presc = $this->my_prescription_model->get_prescription_by_temp_id($id);
                    $this->set_prescription($id, $temp_presc);
                }
                
                redirect(base_url().'site/cart_steps/view_steps');
            }
            else redirect(base_url().'site/cart_steps/view_steps');//coz session is set
//        }
//        else {
//            if($_POST){
//                $data_post['fld_product']=$_POST['product_id'];
//                $data_post['fld_color']=$_POST['color'];
//                $data_post['fld_lens_type']=$_POST['lens_type'];
//                $data_post['fld_category_id']=$_POST['cat_id'];
//                $this->session->set_userdata($data_post);
//                $lens_type_id = $this->session->userdata('fld_lens_type');
//            }
//            $this->session->set_userdata('return_url','site/cart_steps/steps');
//            redirect(base_url().'user/login/?redirect=site/cart_steps/steps');
//        }
    }
    function view_steps(){
        
        
                
//        if(!IsLoggedIn())redirect(base_url().'user/login');
        $this->load->model('user/my_prescription_model');
        $this->load->model('admin/upgrade_model');
        $this->load->model('admin/package_model');
        $this->load->model('admin/product_model');
        $data['my_prescs'] = $this->my_prescription_model->get_my_prescription_by_user();
        $lens_type_id = $this->session->userdata('fld_lens_type');
        $data['product_info_tbl_temp'] = $this->product_model->get_product_from_tbl_temp_by_user();
        $data['carriers_country'] = $this->product_model->carriers_countries();
        $data['all_lens_upgrades']= $this->upgrade_model->get_all_upgrades();
        $data['selected_lens_upgrades'] = $this->upgrade_model->get_upgrades_by_lens_type_id($lens_type_id);
        $data['all_upgrade_attributes'] = $this->upgrade_model->get_all_upgrades_attr_values();
        $data['title']='Cart Steps';
        $data['lens_packages']=$this->package_model->get_all_package();
        $data['product_info_temp'] = $this->session->all_userdata();
        $data['title'] = 'Cart Steps';
        $this->load->view('site/header',$data);
        $this->load->view('site/cart_steps');
        $this->load->view('site/footer');
    }
    function lens_upgrade($id=0){
        $this->load->model('admin/product_model');
        if($_POST){
            $data['fld_lens_package']=$_POST['lens_package'];//lens package id;
                $this->session->set_userdata($data);
        }
    }
    function set_prescription($id, $temp_presc){ //this is the tbl_temp's fld_id
        $this->session->set_userdata('power_od', $temp_presc->fld_power_od);
        $this->session->set_userdata('power_os', $temp_presc->fld_power_os);
        $this->session->set_userdata('sph_od', $temp_presc->fld_sph_od);
        $this->session->set_userdata('cyl_od', $temp_presc->fld_cyl_od);
        $this->session->set_userdata('add_od', $temp_presc->fld_add_od);
        $this->session->set_userdata('axis_od', $temp_presc->fld_axis_od);
        $this->session->set_userdata('sph_os', $temp_presc->fld_sph_os);
        $this->session->set_userdata('cyl_os', $temp_presc->fld_cyl_os);
        $this->session->set_userdata('add_os', $temp_presc->fld_add_os);
        $this->session->set_userdata('axis_os', $temp_presc->fld_axis_os);
        $this->session->set_userdata('pd', $temp_presc->fld_pd);
        $this->session->set_userdata('pd_left', $temp_presc->fld_pd_left);
        $this->session->set_userdata('pd_right', $temp_presc->fld_pd_right);
        $this->session->set_userdata('patient_name', $temp_presc->fld_patient_name);
        $this->session->set_userdata('remarks', $temp_presc->fld_remarks);
    }
    function accessories($id=0){
        $this->load->model('admin/product_model');
        if($_POST){
            if($_POST['fld_lens_upgrade']=="" || $_POST['fld_lens_upgrade']=="_" || $_POST['fld_lens_upgrade']=="__"){
                $data['fld_lens_upgrade']="";//lens package id;
            }
            else $data['fld_lens_upgrade']=$_POST['fld_lens_upgrade'];//lens package id;
            if(IsLoggedIn()){
                $this->product_model->update_temp($data, $id);
            }
            else{
                $this->session->set_userdata($data);
            }
        }
    }
    function lens_upgrade_info($id){
        $this->load->model('admin/package_upgrade_model');
        echo json_encode($this->package_upgrade_model->lens_upgrades_by_id($id));
    }
    function lens_upgrade_attr_info($id){
        $this->load->model('admin/package_upgrade_model');
        echo json_encode($this->package_upgrade_model->lens_upgrades_by_attr_id($id));
    }
    function lens_upgrade_value_info($id){
        $this->load->model('admin/package_upgrade_model');
        echo json_encode($this->package_upgrade_model->lens_upgrades_by_value_id($id));
    }
    function lens_package_info($id){
        $this->load->model('site/cart_steps_model');
        echo json_encode($this->cart_steps_model->lens_package_info_by_id($id));
    }
    
    function get_upgrades($id=0){ //multiple id of upgrade , upgrade_attr, upgrade_attr_value
        if($id!=0){
            $this->load->model('site/cart_steps_model');
            echo json_encode($this->cart_steps_model->get_upgrades($id));
        }
    }
    function insert_to_cart(){
        $total_price = $_POST['product_price'] + $_POST['lens_package_price'] + $_POST['lens_upgrade_price'];
        $this->load->helper('admin/image_helper');
        $primary_img = select_primary_image($_POST['product_id']);
        $cart_data = array(
            'id'      => $_POST['product_id'],
            'qty'     => 1,
            'price'   => $total_price,
            'name'    => $_POST['product_name'],
            'options' => array(
                'product_image'=>base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name,
                'product_price'=> $_POST['product_price'],
                'product_color' => $_POST['product_color'],
                'item_code'=>$_POST['item_code'],
                'lens_type'=> $_POST['lens_type'],
                'lens_package'=> $_POST['lens_package'],
                'lens_package_price'=> $_POST['lens_package_price'],
                'lens_upgrade'=> $_POST['lens_upgrade'],
                'lens_upgrade_color'=> $_POST['lens_upgrade_color'],
                'lens_upgrade_price'=> $_POST['lens_upgrade_price'],
                'product_color_id' => $_POST['product_color_id'],
                'lens_type_id'=> $_POST['lens_type_id'],
                'lens_package_id'=> $_POST['lens_package_id'],
                'lens_upgrade_id'=> $_POST['lens_upgrade_id'],
                'lens_upgrade_value_id'=> $_POST['lens_upgrade_value_id'],
                'lens_upgrade_attr_id'=> $_POST['lens_upgrade_attr_id'],
                'prescription'=>$_POST['prescription'],
                'user_presc_entry'=>$this->session->userdata('presc_id')
            )
         );
        
        $flag = true;
        if($this->cart->total_items()>0){
            $flag = $this->check_cart_for_duplicate($cart_data);
        }
        if($flag==true){
            $this->cart->insert($cart_data);
            $this->insert_to_tbl($cart_data);
        }
        
//        $url =  base_url() . 'site/cart_steps/view_cart'; 
//        $crl = curl_init();
//        $timeout = 5;
//        curl_setopt ($crl, CURLOPT_URL,$url);
//        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
//        $ret = curl_exec($crl);
//        curl_close($crl);
//        
//        $data = $flag.':^:'.$ret;
        echo $flag;
    }
    function check_cart_for_duplicate($data){
        foreach($this->cart->contents() as $items){
            $items_test = $items['id'].'_'.$items['options']['lens_type_id'].'_'.$items['options']['product_color_id'].'_'.$items['options']['lens_package_id'].'_'.$items['options']['lens_upgrade_id']."_".$items['options']['lens_upgrade_attr_id']."_".$items['options']['lens_upgrade_value_id'];
            
            $data_test = $data['id'].'_'.$data['options']['lens_type_id'].'_'.$data['options']['product_color_id'].'_'.$data['options']['lens_package_id'].'_'.$data['options']['lens_upgrade_id']."_".$data['options']['lens_upgrade_attr_id']."_".$data['options']['lens_upgrade_value_id'];
            if($items_test==$data_test){
                return false;
            }
        }
        return true;
    }
    function cart_item(){
        $this->load->model('admin/product_model');
        if(IsLoggedIn()){
            $product_info = $this->product_model->get_product_from_tbl_temp_by_user();
            $this->insert_to_tbl_from_cart();
            redirect(base_url().'site/cart_steps/view_cart');
        }
    }
    function view_cart(){
        $this->load->model('admin/product_model');
        $data['title']='My Cart';
        $data['carriers_country'] = $this->product_model->carriers_countries();
        if(IsLoggedIn()){
            $cart_items = $this->product_model->get_cart_items_info($this->session->userdata('userId'));
            $frames = $cart_items->frames->result();
            $data['product_info_temp']=array();
            foreach($frames as $frame){
                $data['product_info_temp'][] = get_object_vars($frame);
            }
            
            $accessories = $cart_items->accessories->result();
            $data['accessories']=array();
            foreach($accessories as $accessory){
                $data['accessories'][] = get_object_vars($accessory);
            }
            $contact_lenses = $cart_items->contact_lenses->result();
            $data['contact_lenses']=array();
            foreach($contact_lenses as $contact_lens){
                $data['contact_lenses'][] = get_object_vars($contact_lens);
            }
//            if(count($data['product_info_temp'])==0){
//                $this->session->set_flashdata('msg','<script>alert("Sorry no items in you cart.\nYou can shop some items from here.")</script>');
//                redirect(base_url());
//            }
        }
        else{
            $cart_items = $this->product_model->get_cart_items_info('sess_'.$this->session->userdata('fld_id'));
            $frames = $cart_items->frames->result();
            $data['product_info_temp']=array();
            foreach($frames as $frame){
                $data['product_info_temp'][] = get_object_vars($frame);
            }
            
            $accessories = $cart_items->accessories->result();
            $data['accessories']=array();
            foreach($accessories as $accessory){
                $data['accessories'][] = get_object_vars($accessory);
            }
            $contact_lenses = $cart_items->contact_lenses->result();
            $data['contact_lenses']=array();
            foreach($contact_lenses as $contact_lens){
                $data['contact_lenses'][] = get_object_vars($contact_lens);
            }
        }
        
        $this->load->view('site/header',$data);
        $this->load->view('site/view_cart');
        $this->load->view('site/footer');
        
    }
    function insert_to_tbl($items){
        $this->load->model('admin/product_model');
        if(IsLoggedIn()){
            $user_id = $this->session->userdata('userId');
        }else $user_id = 'sess_'.$this->session->userdata('fld_id');
        $data_product = array(
            'fld_product'=>$items['id'],
            'fld_qty'=>1,
            'fld_lens_type'=>$items['options']['lens_type_id'],
            'fld_color'=>$items['options']['product_color_id'],
            'fld_lens_package'=>$items['options']['lens_package_id'],
            'fld_lens_upgrade'=>$items['options']['lens_upgrade_id']."_".$items['options']['lens_upgrade_attr_id']."_".$items['options']['lens_upgrade_value_id'],
            'fld_product_price'=>$items['options']['product_price'],
            'fld_lens_package_price'=>$items['options']['lens_package_price'],
            'fld_lens_upgrade_price'=>$items['options']['lens_upgrade_price'],
            'fld_user'=>$user_id,
            'fld_prescription'=>$items['options']['prescription'],
            'fld_user_presc_entry'=>$items['options']['user_presc_entry']
        );
        if($this->session->userdata('promocode')==1 && $this->session->userdata('fld_category_id')==$this->session->userdata('free_category')){
            $data_product['fld_promo_flag']=true;
        }
        $last_id = $this->product_model->insert_product_info($data_product);
        $data_temp_presc='';
        switch($this->session->userdata('type')){
            case 'enter':
                $data_temp_presc = array(
                    'fld_sph_od' => $this->session->userdata('sph_od'),
                    'fld_sph_os' => $this->session->userdata('sph_os'),
                    'fld_cyl_od' => $this->session->userdata('cyl_od'),
                    'fld_cyl_os' => $this->session->userdata('cyl_os'),
                    'fld_axis_od' => $this->session->userdata('axis_od'),
                    'fld_axis_os' => $this->session->userdata('axis_os'),
                    'fld_add_od' => $this->session->userdata('add_od'),
                    'fld_add_os' => $this->session->userdata('add_os'),
                    'fld_power_od' => $this->session->userdata('power_od'),
                    'fld_power_os' => $this->session->userdata('power_os'),
                    'fld_patient_name' => $this->session->userdata('patient_name'),
                    'fld_pd' => $this->session->userdata('pd'),
                    'fld_pd_right' => $this->session->userdata('pd_right'),
                    'fld_pd_left' => $this->session->userdata('pd_left'),
                    'fld_remarks' => $this->session->userdata('remarks'),
                    'fld_prescription_path'=>$this->session->userdata('prescription'),
                    'fld_user'=>$user_id,
                    'fld_temp'=>$last_id
                );
                break;
            case 'upload':
                $data_temp_presc = array(
                    'fld_prescription_path' => $this->session->userdata('prescription'),
                    'fld_temp'=>$last_id
                );
                break;
            case 'reuse'://///////////////////////////START FROM HERE
                $this->session_unset();
                return false;
                break;
        }
        $this->product_model->insert_temp_presc($data_temp_presc);
        $this->session_unset();
        return false;
    }
    function insert_to_tbl_from_cart(){
        $total_item = $this->cart->total_items();
        print_r($this->cart->contents());
//        foreach($this->cart->contents() as $items){
//            $data_product = array(
//                'fld_product'=>$items['id'],
//                'fld_lens_type'=>$items['options']['lens_type_id'],
//                'fld_color'=>$items['options']['product_color_id'],
//                'fld_lens_package'=>$items['options']['lens_package_id'],
//                'fld_lens_upgrade'=>$items['options']['lens_upgrade_id']."_".$items['options']['lens_upgrade_attr_id']."_".$items['options']['lens_upgrade_value_id'],
//                'fld_user'=>$this->session->userdata('userId')
//            );
//            if($this->product_model->insert_product_info($data_product)){
//                return false;
//            }
//        }
        return true;
    }

    function purchased($carrier){ //$carrier is the carrier id
        $this->load->model('site/cart_steps_model');
        $this->load->model('admin/product_model');
        
        //Now the product has been purchase it should be saved in tbl_order
        //In tbl_order the user who has purchased is saved.Therefore
        $user_info = $this->product_model->extract_user_info($this->session->userdata('userId'));
        $this->load->helper('admin/country_helper');
        $carrier_country = get_country_name_by_carrier($carrier);
        $carrier_info = get_carrier_info($carrier);
        $order = array(
            'fld_first_name'=>$user_info->fld_first_name,
            'fld_last_name' =>$user_info->fld_last_name,
            'fld_email'     =>$user_info->fld_email,
            'fld_country'   =>$user_info->fld_country,
            'fld_state'     =>$user_info->fld_state,
            'fld_city'      =>$user_info->fld_city,
            'fld_contact_no'=>$user_info->fld_contact_no,
            'fld_invoice'   =>random_string('alnum', 7),
            'fld_date'      =>date('Y-m-d'),
            'fld_status'    =>'New Order',
            'fld_payment_status'=>'Paid',
            'fld_user'      =>$this->session->userdata('userId'),
            'fld_carrier_country'=>$carrier_country,
            'fld_carrier'=>$carrier_info->fld_carrier,
            'fld_shipping_cost'=>$carrier_info->fld_shipping_cost,
            'fld_insurance_cost'=>$carrier_info->fld_insurance_cost
         );
        $last_order_id = $this->cart_steps_model->insert_to_tbl_order($order);
        
        //After inserting into tbl_order
        //Order Item should also be insert into tbl_order_item
        $product_info_from_tbl_temp = $this->product_model->get_product_from_tbl_temp_by_user();
        foreach($product_info_from_tbl_temp->result() as $info){
            $this->load->helper('product_info_helper');
            $product_info = get_product_info($info->fld_product);
            $lens_type_info = get_lens_type_info($info->fld_lens_type);
            $color = get_product_color($info->fld_color);
            $lens_package = get_lens_package_info($info->fld_lens_package);
            $upgrades = get_upgrades($info->fld_lens_upgrade);
            $order_item = array(
                                'fld_order'             =>$last_order_id,
                                'fld_product_id'        =>$product_info->fld_id,
                                'fld_product_qty'       =>1,
                                'fld_product'           =>$product_info->fld_name,
                                'fld_product_price'     =>$product_info->fld_price,
                                'fld_lens_type'         =>$lens_type_info->fld_name,
                                'fld_lens_package'      =>$lens_package->fld_name,
                                'fld_lens_package_price'=>$lens_package->fld_price,
                                'fld_lens_upgrade'      =>$upgrades['upgrade'],
                                'fld_lens_upgrade_price'=>$upgrades['price'],
                                'fld_order'             =>$last_order_id,
                                'fld_prescription'      =>$info->fld_prescription
                            );
            $last_order_item_id = $this->cart_steps_model->insert_to_tbl_order_item($order_item);
            //After inserting into tbl_order_item
            //Order Item's attributes should also be insert into tbl_order_attributes
            $attr_info = $this->product_model->select_attr_info($info->fld_color);
            $order_attribute = array(
                'fld_order'          =>$last_order_id,
                'fld_order_item'     =>$last_order_item_id,
                'fld_attribute'      =>$attr_info->fld_name,
                'fld_attribute_value'=>$color
            );
            $this->cart_steps_model->insert_to_tbl_order_attibutes($order_attribute);
            
            //After inserting into tbl_order_attributes
            //Order Item's lens package's attributes should also be insert into tbl_order_lens_package_attributes
            $lens_pkg_attrs = $this->product_model->select_lens_pkg_attributes($info->fld_lens_package);
            foreach($lens_pkg_attrs->result() as $lens_pkg_attr)
            {
                $order_lens_package_attributes = array(
                    'fld_order'         =>$last_order_id,
                    'fld_order_item'    =>$last_order_item_id,
                    'fld_lens_attribute'=>$lens_pkg_attr->fld_name
                );
                $this->cart_steps_model->insert_to_tbl_order_lens_package_attributes($order_lens_package_attributes);
            }
            
            //After inserting into tbl_order_lens_package_attributes
            //Order Item's lens upgrades should also be insert into tbl_order_lens_upgrade_attributes
            $order_lens_upgrade_attributes = array(
                'fld_order'                  =>$last_order_id,
                'fld_order_item'             =>$last_order_item_id,
                'fld_upgrade_attribute'      =>$upgrades['upgrade_attr'],
                'fld_upgrade_attribute_value'=>$upgrades['upgrade_attr_value']   
            );
            $this->cart_steps_model->insert_to_tbl_order_lens_upgrade_attributes($order_lens_upgrade_attributes);
            
            //Uploading Prescription
            $this->load->helper('my_prescription_helper');
            $presc_info = presc_from_temp_by_temp_id($info->fld_id);
            if($info->fld_prescription==1 && $info->fld_user_presc_entry==0){
                $data_presc=array(
                    'fld_sph_od' => $presc_info->fld_sph_od,
                    'fld_sph_os' => $presc_info->fld_sph_os,
                    'fld_cyl_od' => $presc_info->fld_cyl_od,
                    'fld_cyl_os' => $presc_info->fld_cyl_os,
                    'fld_axis_od' => $presc_info->fld_axis_od,
                    'fld_axis_os' => $presc_info->fld_axis_os,
                    'fld_add_od' => $presc_info->fld_add_od,
                    'fld_add_os' => $presc_info->fld_add_os,
                    'fld_power_od' => $presc_info->fld_power_od,
                    'fld_power_os' => $presc_info->fld_power_os,
                    'fld_patient_name' => $presc_info->fld_patient_name,
                    'fld_pd' => $presc_info->fld_pd,
                    'fld_pd_right' => $presc_info->fld_pd_right,
                    'fld_pd_left' => $presc_info->fld_pd_left,
                    'fld_remarks' => $presc_info->fld_remarks,
                    'fld_prescription_path'=>$presc_info->fld_prescription_path,
                    'fld_order_item'=>$last_order_item_id
                );
                $this->cart_steps_model->insert_presc($data_presc);
            }
            else if($info->fld_prescription==2 && $info->fld_user_presc_entry==0){
                $data_presc=array(
                    'fld_prescription_path'=>$presc_info->fld_prescription_path,
                    'fld_order_item'=>$last_order_item_id
                );
                $this->cart_steps_model->insert_presc($data_presc);
            }
            //uploading prescription from user's existing prescription
            else if($info->fld_user_presc_entry!=0){
                $this->load->helper('my_prescription_helper');
                $presc_info = presc_by_user_presc_entry_id($info->fld_user_presc_entry);
                $data_presc=array(
                    'fld_sph_od' => $presc_info->fld_sph_od,
                    'fld_sph_os' => $presc_info->fld_sph_os,
                    'fld_cyl_od' => $presc_info->fld_cyl_od,
                    'fld_cyl_os' => $presc_info->fld_cyl_os,
                    'fld_axis_od' => $presc_info->fld_axis_od,
                    'fld_axis_os' => $presc_info->fld_axis_os,
                    'fld_add_od' => $presc_info->fld_add_od,
                    'fld_add_os' => $presc_info->fld_add_os,
                    'fld_power_od' => $presc_info->fld_power_od,
                    'fld_power_os' => $presc_info->fld_power_os,
                    'fld_patient_name' => $presc_info->fld_patient_name,
                    'fld_pd' => $presc_info->fld_pd,
                    'fld_pd_right' => $presc_info->fld_pd_right,
                    'fld_pd_left' => $presc_info->fld_pd_left,
                    'fld_remarks' => $presc_info->fld_remarks,
                    'fld_prescription_path'=>$presc_info->fld_prescription_path,
                    'fld_order_item'=>$last_order_item_id
                );
                $this->cart_steps_model->insert_presc($data_presc);
            }
//            if($info->fld_)
            $this->cart_steps_model->delete_bought($info->fld_id);
        }
        $this->cart->destroy();
    }
    
    
    
    
    function purchased_paypal(){ //$carrier is the carrier id
        session_start();
        if((round($_SESSION['total_amt'],2)-round($this->session->userdata('our_total'),2))==0){
            $this->load->model('site/cart_steps_model');
            $this->load->model('admin/product_model');

            //Now the product has been purchase it should be saved in tbl_order
            //In tbl_order the user who has purchased is saved.Therefore
            $user_info = $this->product_model->extract_user_info($this->session->userdata('userId'));
            $this->load->helper('admin/country_helper');
            $carrier_country = get_country_name_by_carrier($this->session->userdata('carrier'));
            $carrier_info = get_carrier_info($this->session->userdata('carrier'));
            $order = array(
                'fld_first_name'=>$user_info->fld_first_name,
                'fld_last_name' =>$user_info->fld_last_name,
                'fld_email'     =>$user_info->fld_email,
                'fld_country'   =>$user_info->fld_country,
                'fld_state'     =>$user_info->fld_state,
                'fld_city'      =>$user_info->fld_city,
                'fld_contact_no'=>$user_info->fld_contact_no,
                'fld_invoice'   =>random_string('alnum', 7),
                'fld_date'      =>date('Y-m-d'),
                'fld_status'    =>'New Order',
                'fld_payment_status'=>$_SESSION['payment_status'],
                'fld_user'      =>$this->session->userdata('userId'),
                'fld_txn_id'    =>$_SESSION['txn_id'],
                'fld_carrier_country'=>$carrier_country,
                'fld_carrier'=>$carrier_info->fld_carrier,
                'fld_shipping_cost'=>$carrier_info->fld_shipping_cost,
                'fld_insurance_cost'=>$carrier_info->fld_insurance_cost
             );
            $last_order_id = $this->cart_steps_model->insert_to_tbl_order($order);

            //After inserting into tbl_order
            //Order Item should also be insert into tbl_order_item
            $product_info_from_tbl_temp = $this->product_model->get_product_from_tbl_temp_by_user();
            foreach($product_info_from_tbl_temp->result() as $info){
                $this->load->helper('product_info_helper');
                $product_info = get_product_info($info->fld_product);
                $lens_type_info = get_lens_type_info($info->fld_lens_type);
                $color = get_product_color($info->fld_color);
                $lens_package = get_lens_package_info($info->fld_lens_package);
                $upgrades = get_upgrades($info->fld_lens_upgrade);
                $order_item = array(
                    'fld_order'             =>$last_order_id,
                    'fld_product_id'        =>$product_info->fld_id,
                    'fld_product_qty'       =>1,
                    'fld_product'           =>$product_info->fld_name,
                    'fld_product_price'     =>$info->fld_product_price,
                    'fld_lens_type'         =>$lens_type_info->fld_name,
                    'fld_lens_package'      =>$lens_package->fld_name,
                    'fld_lens_package_price'=>$info->fld_lens_package_price,
                    'fld_lens_upgrade'      =>$upgrades['upgrade'],
                    'fld_lens_upgrade_price'=>$info->fld_lens_upgrade_price,
                    'fld_order'             =>$last_order_id,
                    'fld_prescription'      =>$info->fld_prescription
                );
                if($info->fld_promo_flag==1){
                    $order_item['fld_product_price'] = 0;
                    $order_item['fld_lens_package_price'] = 0;
                    $order_item['fld_lens_upgrade_price'] = 0;
                }
                $last_order_item_id = $this->cart_steps_model->insert_to_tbl_order_item($order_item);
                //After inserting into tbl_order_item
                //Order Item's attributes should also be insert into tbl_order_attributes
                $attr_info = $this->product_model->select_attr_info($info->fld_color);
                $order_attribute = array(
                    'fld_order'          =>$last_order_id,
                    'fld_order_item'     =>$last_order_item_id,
                    'fld_attribute'      =>$attr_info->fld_name,
                    'fld_attribute_value'=>$color
                );
                $this->cart_steps_model->insert_to_tbl_order_attibutes($order_attribute);

                //After inserting into tbl_order_attributes
                //Order Item's lens package's attributes should also be insert into tbl_order_lens_package_attributes
                $lens_pkg_attrs = $this->product_model->select_lens_pkg_attributes($info->fld_lens_package);
                foreach($lens_pkg_attrs->result() as $lens_pkg_attr)
                {
                    $order_lens_package_attributes = array(
                        'fld_order'         =>$last_order_id,
                        'fld_order_item'    =>$last_order_item_id,
                        'fld_lens_attribute'=>$lens_pkg_attr->fld_name
                    );
                    $this->cart_steps_model->insert_to_tbl_order_lens_package_attributes($order_lens_package_attributes);
                }

                //After inserting into tbl_order_lens_package_attributes
                //Order Item's lens upgrades should also be insert into tbl_order_lens_upgrade_attributes
                $order_lens_upgrade_attributes = array(
                    'fld_order'                  =>$last_order_id,
                    'fld_order_item'             =>$last_order_item_id,
                    'fld_upgrade_attribute'      =>$upgrades['upgrade_attr'],
                    'fld_upgrade_attribute_value'=>$upgrades['upgrade_attr_value']   
                );
                $this->cart_steps_model->insert_to_tbl_order_lens_upgrade_attributes($order_lens_upgrade_attributes);

                //Uploading Prescription
                $this->load->helper('my_prescription_helper');
                $presc_info = presc_from_temp_by_temp_id($info->fld_id);
                if($info->fld_prescription==1 && $info->fld_user_presc_entry==0){
                    $data_presc=array(
                        'fld_sph_od' => $presc_info->fld_sph_od,
                        'fld_sph_os' => $presc_info->fld_sph_os,
                        'fld_cyl_od' => $presc_info->fld_cyl_od,
                        'fld_cyl_os' => $presc_info->fld_cyl_os,
                        'fld_axis_od' => $presc_info->fld_axis_od,
                        'fld_axis_os' => $presc_info->fld_axis_os,
                        'fld_add_od' => $presc_info->fld_add_od,
                        'fld_add_os' => $presc_info->fld_add_os,
                        'fld_power_od' => $presc_info->fld_power_od,
                        'fld_power_os' => $presc_info->fld_power_os,
                        'fld_patient_name' => $presc_info->fld_patient_name,
                        'fld_pd' => $presc_info->fld_pd,
                        'fld_pd_right' => $presc_info->fld_pd_right,
                        'fld_pd_left' => $presc_info->fld_pd_left,
                        'fld_remarks' => $presc_info->fld_remarks,
                        'fld_prescription_path'=>$presc_info->fld_prescription_path,
                        'fld_order_item'=>$last_order_item_id
                    );
                    $this->cart_steps_model->insert_presc($data_presc);
                }
                else if($info->fld_prescription==2 && $info->fld_user_presc_entry==0){
                    $data_presc=array(
                        'fld_prescription_path'=>$presc_info->fld_prescription_path,
                        'fld_order_item'=>$last_order_item_id
                    );
                    $this->cart_steps_model->insert_presc($data_presc);
                }
                //uploading prescription from user's existing prescription
                else if($info->fld_user_presc_entry!=0){
                    $this->load->helper('my_prescription_helper');
                    $presc_info = presc_by_user_presc_entry_id($info->fld_user_presc_entry);
                    $data_presc=array(
                        'fld_sph_od' => $presc_info->fld_sph_od,
                        'fld_sph_os' => $presc_info->fld_sph_os,
                        'fld_cyl_od' => $presc_info->fld_cyl_od,
                        'fld_cyl_os' => $presc_info->fld_cyl_os,
                        'fld_axis_od' => $presc_info->fld_axis_od,
                        'fld_axis_os' => $presc_info->fld_axis_os,
                        'fld_add_od' => $presc_info->fld_add_od,
                        'fld_add_os' => $presc_info->fld_add_os,
                        'fld_power_od' => $presc_info->fld_power_od,
                        'fld_power_os' => $presc_info->fld_power_os,
                        'fld_patient_name' => $presc_info->fld_patient_name,
                        'fld_pd' => $presc_info->fld_pd,
                        'fld_pd_right' => $presc_info->fld_pd_right,
                        'fld_pd_left' => $presc_info->fld_pd_left,
                        'fld_remarks' => $presc_info->fld_remarks,
                        'fld_prescription_path'=>$presc_info->fld_prescription_path,
                        'fld_order_item'=>$last_order_item_id
                    );
                    $this->cart_steps_model->insert_presc($data_presc);
                }
                $this->cart_steps_model->delete_bought($info->fld_id);
            }
            $this->cart->destroy();
            $this->unset_session_except_user();
            session_destroy();
            redirect(base_url().'user/order/detail/'.$last_order_id);
        }
        else echo 'im out';
    }
  
    function file_uploader(){
        $data='';
        if($_FILES && $_FILES['prescription_upload']['error']==0){
//            print_r($_FILES);exit;
            $allowedTypes=array('application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword', 'application/pdf','image/jpeg', 'image/gif', 'image/bmp', 'image/png');
        $maximum=5*1024*1024;
            if(in_array($_FILES['prescription_upload']['type'], $allowedTypes) && ($_FILES['prescription_upload']['size'])<$maximum){
                $this->load->library('folders');
                $this->folders->makeDirectory(date('d'),'prescriptions/'.date('Y').'/'.date('m'));
                $data['presc_name'] = $this->folders->upload_files($_FILES, 'prescriptions/'.date('Y').'/'.date('m').'/'.date('d'));
            }
            else {
                $data['msg'] = 'The file you have uploaded is either not of valid format or it exceeds than 5MB.<br/>Please check your file and upload again.';
            }
        }
        $this->load->view('site/file_uploader',$data);
    }
    function check_presc_upload(){
        $prescription = $this->session->userdata('prescription');
        if($prescription=='' || $prescription==NULL){
            echo false;
        }
        else echo true;
    }
    function set_on_session($id){// this is prescription id reused by the user from tbl_user_presc_entry
        $flag = $this->check_file($id);
        if($flag == true){ //if the flag is true than it has file else it has entry
            $this->session->set_userdata('prescription',$this->presc);
        }
        $this->session->set_userdata('presc_id',$id);
    }
    function check_file($id){
        $this->load->model('user/my_prescription_model');
        $this->presc = $this->my_prescription_model->get_my_prescription_by_id($id);
        if($this->presc!="" || $this->presc != NULL){
            return TRUE;
        }
        else return FALSE;
    }
    function set_presc_type($value){
        switch ($value){
            case 1:
                $value = 'enter';
                break;
            case 2:
                $value = 'upload';
                break;
            case 3:
                $value = 'reuse';
                break;
            default :
                break;
        }
        echo $value;
        $this->session->set_userdata('type',$value);
    }
    function set_session_values(){
        $this->session->set_userdata('power_od', $_POST['power_od']);
        $this->session->set_userdata('power_os', $_POST['power_os']);
        $this->session->set_userdata('sph_od', $_POST['sph_od']);
        $this->session->set_userdata('cyl_od', $_POST['cyl_od']);
        $this->session->set_userdata('add_od', $_POST['add_od']);
        $this->session->set_userdata('axis_od', $_POST['axis_od']);
        $this->session->set_userdata('sph_os', $_POST['sph_os']);
        $this->session->set_userdata('cyl_os', $_POST['cyl_os']);
        $this->session->set_userdata('add_os', $_POST['add_os']);
        $this->session->set_userdata('axis_os', $_POST['axis_os']);
        $this->session->set_userdata('pd', $_POST['pd']);
        $this->session->set_userdata('pd_left', $_POST['pd_left']);
        $this->session->set_userdata('pd_right', $_POST['pd_right']);
        $this->session->set_userdata('patient_name', $_POST['patient_name']);
        $this->session->set_userdata('remarks', $_POST['remarks']);
    }
    function session_unset(){
        $this->session->unset_userdata('sph_od');
        $this->session->unset_userdata('sph_os');
        $this->session->unset_userdata('cyl_od');
        $this->session->unset_userdata('cyl_os');
        $this->session->unset_userdata('axis_od');
        $this->session->unset_userdata('axis_os');
        $this->session->unset_userdata('add_od');
        $this->session->unset_userdata('add_os');
        $this->session->unset_userdata('power_od');
        $this->session->unset_userdata('power_os');
        $this->session->unset_userdata('patient_name');
        $this->session->unset_userdata('pd');
        $this->session->unset_userdata('pd_right');
        $this->session->unset_userdata('pd_left');
        $this->session->unset_userdata('remarks');
        $this->session->unset_userdata('prescription');
        $this->session->unset_userdata('presc_id');
        $this->session->unset_userdata('type');
        $this->session->unset_userdata('our_total');
        $this->session->unset_userdata('edit');
    }
    function unset_session_except_user(){
        $this->session_unset();
        $this->session->unset_userdata('fld_product');
        $this->session->unset_userdata('fld_color');
        $this->session->unset_userdata('fld_lens_type');
        $this->session->unset_userdata('fld_category_id');
        $this->session->unset_userdata('promocode');
        $this->session->unset_userdata('free_category');
        $this->session->unset_userdata('fld_lens_package');
        $this->session->unset_userdata('carrier');
    }
    
    function set_carrier($value){
        $this->session->set_userdata('carrier',$value);
        $total = $this->get_total_price();
        $this->session->set_userdata('our_total',$total);
    }
    
    function get_total_price(){
        $this->load->helper('admin/country_helper');
        $carrier_info = get_carrier_info($this->session->userdata('carrier'));
        $carrier_cost = $carrier_info->fld_shipping_cost+$carrier_info->fld_insurance_cost;
        $this->load->model('admin/product_model');
        $tbl_temp = $this->product_model->get_product_from_tbl_temp_by_user();
        $total=$carrier_cost;
        foreach($tbl_temp->result() as $temp){
            $total = $total + $temp->fld_product_price + $temp->fld_lens_package_price + $temp->fld_lens_upgrade_price;
        }
        return $total;
    }
    
    function delete_item($id){
        $this->load->model('admin/product_model');
        $this->product_model->delete_item($id);
    }
    function glasses_view($id,$product_id){
        $this->load->model('site/product_image_model');
        echo json_encode($this->product_image_model->get_images_by_color_id($id,$product_id));
    }
    function descriptions($id,$type){
        $data['type'] = $type;
        if($type=='package'){
            $this->load->model('admin/package_model');
            $data['descriptions']=$this->package_model->get_package_by_id($id);
        }else if($type=='upgrade'){
            $this->load->model('admin/package_upgrade_model');
            $data['descriptions']=$this->package_upgrade_model->get_upgrade_by_id($id);
        }
        $this->load->view('site/descriptions',$data);
    }
    
/*-------------------------------------------------------for accessories step four-------------------------------------------------------------------------*/
    
    function step_four()
    {$this->load->library('pagination');
        $this->load->model('site/cart_steps_model');
        
        

        $config['base_url'] = base_url().'site/cart_steps/step_four';
        $config['total_rows'] = $this->cart_steps_model->count_accessories();
//        echo $config['total_rows'];exit;
        $config['uri_segment'] = 4;
        $config['per_page'] = 1;
        $this->pagination->initialize($config); 
        $accessories = $this->cart_steps_model->get_Accessories($config['per_page'],$this->uri->segment(4));
        $accessories_attrs = $this->cart_steps_model->get_Accessories_attr();
        $attr_array = array();
        foreach($accessories->result() as $key=>$value):
            $array=array();
            foreach($accessories_attrs->result() as $attr):
                if($value->fld_id == $attr->fld_accessory_id):
                    $array[$attr->fld_color] =array(
                        'fld_location'=>$attr->fld_location,
                        'fld_image'=>$attr->fld_image,
                        'fld_qty'=>$attr->fld_qty
                    ); 
                endif;
            endforeach;
                
            $attr_array[$key] = array(
                'fld_id'=>$value->fld_id,
                'fld_name'=>$value->fld_name,
                'fld_item_code'=>$value->fld_item_code,
                'fld_cp'=>$value->fld_cp,
                'fld_discount'=>$value->fld_discount,
                'fld_sp'=>$value->fld_sp,
                'fld_status'=>$value->fld_status,
                'fld_shelf_location'=>$value->fld_shelf_location,
                'fld_description'=>$value->fld_description,
                'fld_location'=>$value->fld_location,
                'fld_image'=>$value->fld_image,
                'attr'=>$array
            );
        endforeach;
        $data['accessories'] = $attr_array;
        
        $this->load->view('site/step_four_acc',$data);
    }
}

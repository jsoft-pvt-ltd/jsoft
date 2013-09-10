<?php
function get_packages_by_lens_type($id){//lens type id
    $CI = & get_instance();
    $CI->db->select('fld_lens_package_id');
    $CI->db->where('fld_lens_type_id',$id);
    return $CI->db->get('tbl_lens_type_package_value');
}
function get_attributes_of_package($id){ //package_id;
    $CI = & get_instance();
    $CI->db->select('fld_lens_package_attribute_id,fld_display');
    $CI->db->where('fld_package_id',$id);
    return $CI->db->get('tbl_lens_package_attribute_value');
}
function get_all_package_attr(){
    $CI = & get_instance();
    return $CI->db->get('tbl_lens_package_attribute');
}
function get_selected_upgrade_attributes_by_upgrade_id($id){
    $CI = & get_instance();
    $CI->db->where('fld_upgrade_id',$id);
    return $CI->db->get('tbl_lens_upgrade_attribute')->row();
}
function get_product_info($id){//$product id;
    $CI = & get_instance();
    $CI->db->where('fld_id',$id);
    return $CI->db->get('tbl_product')->row();
}
function get_lens_type_info($id){//lens_type_id
    $CI = & get_instance();
    $CI->db->where('fld_id',$id);
    return $CI->db->get('tbl_lens_type')->row();
}
function get_lens_package_info($id){ //lens package id
    $CI = & get_instance();
    $CI->db->where('fld_id',$id);
    return $CI->db->get('tbl_lens_package')->row();
}
function get_package_info($id){ //package_id
    $CI = & get_instance();
    $CI->db->where('fld_id',$id);
    return $CI->db->get('tbl_lens_package')->row();
}
function get_product_color($id){//colors attribute value id
    $CI = & get_instance();
    $CI->db->select('fld_value');
    $CI->db->where('fld_parent_id',$id);
    return $CI->db->get('tbl_attribute_values')->row()->fld_value;
}
function get_upgrades($id){
    
    if($id=="_"||$id=="__"){
        $upgrades['upgrade'] = 'N/A';
        $upgrades['price'] = 'N/A';
        $upgrades['upgrade_attr'] = 'N/A';
        $upgrades['upgrade_attr_value'] = 'N/A';
        return $upgrades;
    }
    $ids = explode('_', $id);
    $upgrades = array();
    foreach(array_keys($ids) as $key){
        if($ids[$key]!='' || $ids[$key]!=NULL){
            switch ($key){
                case 0:
                    $upgrades['upgrade'] = get_upgrade_name($ids[$key]);
                    $upgrades['price'] = get_upgrade_price($ids[$key]);
                    break;
                case 1:
                    $upgrades['upgrade_attr'] = get_upgrade_attr($ids[$key]);
                    break;
                case 2:
                    $upgrades['upgrade_attr_value'] = get_upgrade_attr_value($ids[$key]);
                    break;    
            }
        }
    }
    return($upgrades);
}
function get_upgrade_name($id){//upgrade id;
    $CI = & get_instance();
    $CI->db->select('fld_name');
    $CI->db->where('fld_id',$id);
    $result = $CI->db->get('tbl_lens_upgrade')->row()->fld_name;
    if($result=="" || $result==NULL){
        return 'N/A';
    }
    else return $result;
}
function get_upgrade_price($id){//upgrade id
    $CI = & get_instance();
    $CI->db->select('fld_price');
    $CI->db->where('fld_id',$id);
    $result = $CI->db->get('tbl_lens_upgrade')->row()->fld_price;
    if($result=="" || $result==NULL){
        return 'N/A';
    }
    else return $result;
}
function get_upgrade_attr($id){//upgrade id;
    $CI = & get_instance();
    $CI->db->select('fld_name');
    $CI->db->where('fld_id',$id);
    if($CI->db->get('tbl_lens_upgrade_attribute')->row()->fld_name=="" || $CI->db->get('tbl_lens_upgrade_attribute')->row()->fld_name==NULL){
        return 'N/A';
    }
    else return $CI->db->get('tbl_lens_upgrade_attribute')->row()->fld_name;
}
function get_upgrade_attr_value($id){//upgrade id;
    $CI = & get_instance();
    $CI->db->select('fld_name');
    $CI->db->where('fld_id',$id);
    $result = $CI->db->get('tbl_lens_upgrade_attribute_value')->row()->fld_name;
    if($result=="" || $result==NULL){
        return 'N/A';
    }
    else return $result;
}
function get_temp_table($id){//tbl_temp's flf_id
    $CI = & get_instance();
    $CI->db->where('fld_id',$id);
    return $CI->db->get('tbl_temp')->row();
}
function get_temp_table_by_user($id){
    $CI = & get_instance();
    $CI->db->where('fld_user',$id);
    return $CI->db->get('tbl_temp')->result();
}
function get_total_cart_qty($id){
    $CI = & get_instance();
    $CI->db->trans_start();
    $CI->db->select('fld_qty,fld_product_price,fld_lens_upgrade_price,fld_lens_package_price');
    $CI->db->where('fld_user',$id);
    $result = $CI->db->get('tbl_temp');
    $qty=new stdClass();
    $qty->contact_lenses=0;
    $qty->accessories=0;
    $qty->contact_lenses_price=0;
    $qty->temp_price =0;
    $qty->accessories_price =0;
    $qty->contact_lenses_boxes=0;
    if($result->num_rows()>0){
        foreach($result->result() as $row){
            $qty->temp+= $row->fld_qty;
            $qty->temp_price+=(($row->fld_product_price+$row->fld_lens_upgrade_price+$row->fld_lens_package_price)*$row->fld_qty);
        }
    }else $qty->temp = 0;
    $CI->db->select('fld_qty,fld_price');
    $CI->db->where('fld_user_id',$id);
    $result = $CI->db->get('tbl_temp_accessories');
    if($result->num_rows()>0){
        foreach($result->result() as $row){
            $qty->accessories+= $row->fld_qty;
            $qty->accessories_price+= ($row->fld_price*$row->fld_qty);
        }
    }else $qty->accessories = 0;

        $CI->db->select('fld_qty,fld_price,fld_boxes_left,fld_boxes_right');
        $CI->db->where('fld_user_id',$id);
        $result = $CI->db->get('tbl_temp_contact_lenses');
        if($result->num_rows()>0){
            foreach($result->result() as $row){
                $qty->contact_lenses+= $row->fld_qty;
                $qty->contact_lenses_price+= $row->fld_price*($row->fld_boxes_left+$row->fld_boxes_right);
                $qty->contact_lenses_boxes+= $row->fld_boxes_left+$row->fld_boxes_right;
            }
        }else $qty->contact_lenses = 0;
    $CI->db->trans_complete();
    return $qty;
}
function get_product_type_name($product_type_id)
{
    $CI = & get_instance();
    $CI->db->select('fld_name');
    $CI->db->where('fld_id',$product_type_id);
    return $CI->db->get('tbl_product_type')->row();
}
function get_random_cat_image($id){
//    $CI = & get_instance();
//    $CI->db->select('fld_name');
//    $CI->db->where('fld_id',$product_type_id);
//    return $CI->db->get('tbl_product_type')->row();
}
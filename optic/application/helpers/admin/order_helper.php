<?php
function frame_color($order_item_id)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('tbl_order_attributes',array('fld_order_item'=>$order_item_id));
    return $query->row();
    
}
function lens_up_attr($order_item_id)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('tbl_order_lens_upgrade_attributes',array('fld_order_item'=>$order_item_id));
    return $query->row();
    
}
function lens_pkg_attrs($order_item_id)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('tbl_order_lens_package_attributes',array('fld_order_item'=>$order_item_id));
    return $query;
}
function prescription($id){ //order_item_id;
    $CI =& get_instance();
    $CI->db->where('fld_order_item',$id);
    return $CI->db->get('tbl_presc_entry')->row();
}
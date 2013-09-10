<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function select_primary_image($pid,$color=0) 
    {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tbl_product_image');
        $CI->db->where('fld_product',$pid);
        $CI->db->where('fld_primary',0);
        if($color!=0)$CI->db->where('fld_color',$color);
        $query = $CI->db->get();
        return $query->row();
    }
    function select_images($pid){
        $CI = & get_instance();
        $CI->db->where('fld_product',$pid);
        $CI->db->limit(5,0);
        return $CI->db->get('tbl_product_image');
    }
    function get_color_name($id){
        $CI = & get_instance();
        $CI->db->select('fld_value');
        $CI->db->where('fld_parent_id',$id);
        return $CI->db->get('tbl_attribute_values')->row()->fld_value;
    }
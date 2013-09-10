<?php
    if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function get_product_image($pid, $color_id) 
    {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->where('fld_product',$pid);
        $CI->db->where('fld_color',$color_id);
        $query = $CI->db->get('tbl_product_image');
        return $query->result();
    }
    
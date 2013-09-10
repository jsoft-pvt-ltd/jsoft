<?php
    if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function get_vendor_of_product($vendor) 
    {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tbl_vendor');
        $CI->db->where('fld_id',$vendor);
        $query = $CI->db->get();
        return $query->row();
    }
    
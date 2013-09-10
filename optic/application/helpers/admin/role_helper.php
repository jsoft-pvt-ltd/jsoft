<?php
    if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function select_role($role_id) 
    {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tbl_role');
        $CI->db->where('fld_id',$role_id);
        $query = $CI->db->get();
        return $query->row();
    }
    
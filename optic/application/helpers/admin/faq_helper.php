<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function which_faqtype($faqtype_id) 
    {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tbl_faqtype');
        $CI->db->where('fld_id',$faqtype_id);
        $query = $CI->db->get();
        return $query->row();
    }
    function help_qnas($section)
    {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tbl_faq');
        $CI->db->where('fld_faqtype',$section);
        $query = $CI->db->get();
        return $query;
    }
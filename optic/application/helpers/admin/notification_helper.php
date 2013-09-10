<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function select_new_user() 
    {
        $CI = & get_instance();
        $query = $CI->db->get('tbl_acc_notice');
        return $query;
    }
        
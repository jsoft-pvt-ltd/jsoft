<?php
    if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function select($role_id) 
    {
        $CI = & get_instance();
        $sql = 'select tbl_modules.* from tbl_modules inner join tbl_privileges on tbl_privileges.fld_module_id = tbl_modules.fld_id where tbl_privileges.fld_role_id = '.$role_id.' group by tbl_privileges.fld_module_id';
        $query = $CI->db->query($sql);
        return $query;
    }
    function select_privilege($role_id,$privilige_module_id)
    {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tbl_privileges');
        $CI->db->where('fld_role_id',$role_id);
        $CI->db->where('fld_module_id',$privilige_module_id);
        $query = $CI->db->get();
        return $query->row();
    }
    
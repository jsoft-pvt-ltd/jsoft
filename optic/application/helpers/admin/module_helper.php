<?php
    if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    function select_modules($admin_role_id) 
    {
        $CI = & get_instance();
        $sql = 'select tbl_modules.* from tbl_modules inner join tbl_privileges on tbl_privileges.fld_module_id = tbl_modules.fld_id where tbl_privileges.fld_role_id = '.$admin_role_id.' group by tbl_privileges.fld_module_id order by fld_name asc';
        
        $query = $CI->db->query($sql);
        return $query;
    }
    
    
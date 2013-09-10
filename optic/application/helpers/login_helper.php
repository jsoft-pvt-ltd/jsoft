<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); 

    function IsLoggedIn() 
    {
        $CI = & get_instance();
        $userId = $CI->session->userdata('userId');
        if($CI->session->userdata('userId'))
        {
            $query = $CI->db->get_where('tbl_user_login', array('fld_id' => $userId));
            if($query->num_rows()>0)
            {
                return TRUE;
            }
        }	
        else if(!$CI->session->userdata('userId'))
        {
            return FALSE;
        }	
    }
    function IsLoggedIn_()
    {
        $CI = & get_instance();
        if($CI->session->userdata('userSocialId'))
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function CheckProfilePicture()
    {
        $CI = & get_instance();
        $CI->db->select('fld_id,fld_profile_pic,fld_profile_pic_url');
        $CI->db->from('tbl_user_login');
        $CI->db->where('fld_id',$CI->session->userdata('userId'));
        $query = $CI->db->get();
        return $query->row();
    }
    function admin_log()
    {
        
        $CI = &get_instance();
        if($CI->session->userdata('admin_logged_in')!=true){
            redirect(base_url().'admin/login');
        }
                
    }
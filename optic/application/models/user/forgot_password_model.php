<?php

class Forgot_password_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function CheckEmail($email)
    {
        $query = $this->db->get_where('tbl_user_login', array('fld_email' => $email));
        return $query->row();
    }
    function CheckToken($id,$resetToken)
    {
        $this->db->select('*');
        $this->db->from('tbl_user_login');
        $this->db->where('fld_id',$id);
//        $this->db->or_where('fld_reset_token',$resetToken);
        $this->db->where('fld_reset_token',$resetToken);
        $query = $this->db->get();
        return $query->row();
   
    }
//    function CheckTokenExp($id,$resetToken)
//    {
//        $this->db->select('*');
//        $this->db->from('tbl_user_login');
//        $this->db->where('fld_id',$id);
//        $this->db->where('fld_key',$resetToken);
//        $this->db->where('fld_token_exp >',date('y-m-d \ h:i:s'));
//        $query = $this->db->get();
//        if($query->num_rows()>0)
//        {
//            $res = 'true';
//        }
//        else
//        {
//            $res = 'false';
//        }
//        return $res;
//    }
}
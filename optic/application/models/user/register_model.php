<?php

class Register_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function UserRegister($data)
    {
        $this->db->insert('tbl_user_login', $data);
        return $this->db->insert_id();
    }
    function GetUserData($id)
    {
        $query = $this->db->get_where('tbl_user_login', array('fld_id' => $id));
        return $query->row();
    }
    function CheckUsername($username)
    {
        $query = $this->db->get_where('tbl_user_login', array('fld_username' =>$username));
        return $query->row();
    }
    function CheckForEmail($email)
    {
        $query = $this->db->get_where('tbl_user_login', array('fld_email'=>$email));
        return $query->row();
    }
    
}
?>

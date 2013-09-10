<?php

class Control_panel_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function ExtractUserInfo($id)
    {
        $query = $this->db->get_where('tbl_user_login',array('fld_id'=>$id));
        return $query->row();
    }
    public function EditBasicInfo_($userId,$data)
    {
        $this->db->where('fld_id',$userId);
        $this->db->update('tbl_user_login',$data);
    }
    function ProfilePicEdit_($updateId,$data)
    {
        $this->db->where('fld_id', $updateId);
        $this->db->update('tbl_user_gallery', $data); 
    }
    function CheckForPassword($current_password)
    {
        $query = $this->db->get_where('tbl_user_login',array('fld_password'=>md5($current_password),'fld_id'=>$this->session->userdata('userId')));
        return $query->row();
    }
}
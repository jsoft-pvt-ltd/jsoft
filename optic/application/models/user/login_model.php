<?php
class Login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function UserAuth($data)
    {
        $query = $this->db->get_where('tbl_user_login', array('fld_username' => $data['fld_username'], 'fld_password' =>  md5($data['fld_password'])));
        return $query->row();
    }
    function EditToActivateAccount($id,$data)
    {
        $this->db->where('fld_id', $id);
        $this->db->update('tbl_user_login', $data); 
    }
    function CheckKey($id,$confirmKey)
    {
        $this->db->select('*');
        $this->db->from('tbl_user_login');
        $this->db->where('fld_id',$id);
        $this->db->where('fld_key',$confirmKey);
        $query = $this->db->get();
        return $query->row();
    }
    function acc_notice($user)
    {
        $this->db->insert('tbl_acc_notice',$user);
    }
    
}
?>

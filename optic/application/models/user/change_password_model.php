<?php class Change_password_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function CheckForPassword($current_password)
    {
        $query = $this->db->get_where('tbl_user_login',array('fld_password'=>md5($current_password),'fld_id'=>$this->session->userdata('userId')));
        return $query->row();
    }
}

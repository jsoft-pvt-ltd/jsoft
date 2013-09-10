<?php class Login_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function CheckLogin($data)
    {
        $query = $this->db->get_where('tbl_admin', array('fld_username' => $data['fld_username'],'fld_password'=>$data['fld_password']));
        if($query->num_rows()>1)
        {
            return false;
        }
        else
        {
            return $query->row();
        }
    }
}

?>

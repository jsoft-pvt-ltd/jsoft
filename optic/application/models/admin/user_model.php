<?php class User_model extends CI_Model{
     public function __construct() {
         parent::__construct();
     }
     function select_user($user_id=0)
     {
         if($user_id==0)
         {
             $query = $this->db->get('tbl_admin');
             return $query;
         }
         else
         {
             $this->db->select('*');
             $this->db->from('tbl_admin');
             $this->db->where('fld_id',$user_id);
             $query = $this->db->get();
             return $query->row();
         }
     }
     function create_user($data)
     {
         $this->db->insert('tbl_admin',$data);
     }
     function update_user($user_id,$data)
     {
        $this->db->where('fld_id',$user_id);
        $this->db->update('tbl_admin', $data); 
     }
     function update_user_role($role_id)
     {
        $data['fld_role_id']="";
        $this->db->where('fld_role_id',$role_id);
        $this->db->update('tbl_user', $data); 
     }
     function delete_user($user_id)
     {
        $this->db->where('fld_id', $user_id);
        $this->db->delete('tbl_admin'); 
     }
}
?>
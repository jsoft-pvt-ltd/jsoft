<?php class Role_model extends CI_Model{
     public function __construct() {
         parent::__construct();
     }
     function select_role($role_id=0)
     {
         if($role_id==0)
         {
             $query = $this->db->get('tbl_role');
             return $query;
         }
         else
         {
             $this->db->select('*');
             $this->db->from('tbl_role');
             $this->db->where('fld_id',$role_id);
             $query = $this->db->get();
             return $query->row();
         }
     }
     function insert_role($role)
     {
         $data = array(
                        'fld_role'=>$role
         );
         $this->db->insert('tbl_role',$data);
         return $this->db->insert_id();
     }
     function update_role($role_id,$role)
     {
         $data = array(
                        'fld_role'=>$role
         );
         $this->db->where('fld_id', $role_id);
         $this->db->update('tbl_role', $data); 
     }
     function delete_role($role_id)
     {
         $this->db->where('fld_id',$role_id);
         $this->db->delete('tbl_role');
     }
}
?>

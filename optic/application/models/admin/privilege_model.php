<?php class Privilege_model extends CI_Model{
     public function __construct() {
         parent::__construct();
     }
     function select_modules()
     {
         $query = $this->db->get('tbl_modules');
         return $query;
     }
     function insert_privilege($data)
     {
         $this->db->insert('tbl_privileges',$data);
     }
     function update_privilege($privilege_id,$data)
     {
         $this->db->where('fld_id', $privilege_id);
         $this->db->update('tbl_privileges', $data); 
     }
     function delete_privilege($role_id)
     {
         $this->db->where('fld_role_id',$role_id);
         $this->db->delete('tbl_privileges');
     }
}
?>

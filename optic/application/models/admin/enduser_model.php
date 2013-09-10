<?php class Enduser_model extends CI_Model{
     public function __construct() {
         parent::__construct();
     }
     function count()
     {
         $query = $this->db->get('tbl_user_login');
         return $query->num_rows();
     }
     function select($num,$offset)
     {
         $this->db->select('*');
         $this->db->from('tbl_user_login');
         $this->db->order_by('fld_id','desc');
         $this->db->limit($num,$offset);
         $query = $this->db->get();
         return $query;
     }
     function empty_tbl_acc_notice($enduser_id)
     {
         $this->db->where('fld_user', $enduser_id);
         $this->db->delete('tbl_acc_notice');
     }
     function new_endusers()
     {
         $query = $this->db->get('tbl_acc_notice');
         return $query;
     }
}
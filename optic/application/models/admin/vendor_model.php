<?php class Vendor_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function count_vendor()
    {
        $query = $this->db->get('tbl_vendor');
        return $query->num_rows();
    }
    function vendors($num,$offset)
    {
        $this->db->select('*');
        $this->db->from('tbl_vendor');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query;
    }
    function save_vendor($data)
    {
        $this->db->insert('tbl_vendor',$data);
    }
    function select_vendor($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_vendor');
        $this->db->where('fld_id',$id);
        $query = $this->db->get();
        return $query->row();
    }
    function edit_vendor($id,$data)
    {
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_vendor',$data);
    }
    function delete_vendor($id)
    {
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_vendor');
    }
}
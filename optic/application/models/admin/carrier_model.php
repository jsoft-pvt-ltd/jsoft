<?php class Carrier_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function count_carrier()
    {
        $query = $this->db->get('tbl_carrier');
        return $query->num_rows();
    }
    function carriers($num,$offset)
    {
        $this->db->select('*');
        $this->db->from('tbl_carrier');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query;
    }
    function country()
    {
        $query = $this->db->get('tbl_country');
        return $query;
    }
    function save_carrier($data)
    {
        $this->db->insert('tbl_carrier',$data);
    }
    function select_carrier($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_carrier');
        $this->db->where('fld_id',$id);
        $query = $this->db->get();
        return $query->row();
    }
    function edit_carrier($id,$data)
    {
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_carrier',$data);
    }
    function delete_carrier($id)
    {
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_carrier');
    }
}
<?php class Promocode_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    //=============================================Promocode Type==========================================================
    function count_promocode_types(){
        $query = $this->db->get('tbl_promocode_type');
        return $query->num_rows();
    }
    function promocode_types($num,$offset){
        $this->db->select('*');
        $this->db->from('tbl_promocode_type');
        $this->db->order_by('fld_id','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query;
    }
    function insert_promocode_type($data)
    {
        $this->db->insert('tbl_promocode_type',$data);
    }
    function promocode_type($promocode_type)
    {
        $query = $this->db->get_where('tbl_promocode_type',array('fld_id'=>$promocode_type));
        return $query->row();
    }
    function update_promocode_type($promocode_type,$data)
    {
        $this->db->where('fld_id',$promocode_type);
        $this->db->update('tbl_promocode_type',$data);
    }
    function delete_promocode_type($promocode_type)
    {
        $this->db->where('fld_id',$promocode_type);
        $this->db->delete('tbl_promocode_type');
    }
    //=======================================Promocode=====================================================================
    function count_promocodes(){
        $query = $this->db->get('tbl_promocode');
        return $query->num_rows();
    }
    function promocodes($num,$offset){
        $this->db->select('*');
        $this->db->from('tbl_promocode');
        $this->db->order_by('fld_id','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query;
    }
    function insert_promocode($data)
    {
        $this->db->insert('tbl_promocode',$data);
    }
    function promocode($promocode)
    {
        $query = $this->db->get_where('tbl_promocode',array('fld_id'=>$promocode));
        return $query->row();
    }
    function update_promocode($promocode,$data)
    {
        $this->db->where('fld_id',$promocode);
        $this->db->update('tbl_promocode',$data);
    }
    function delete_promocode($promocode)
    {
        $this->db->where('fld_id',$promocode);
        $this->db->delete('tbl_promocode');
    }
}

?>

<?php
class Product_type_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function insert_product_type($data){
        $this->db->insert('tbl_product_type',$data);
    }
    function get_all_product_types(){
        $this->db->order_by('fld_id',"desc");
        return $this->db->get('tbl_product_type');
    }
    function delete_product_type($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_product_type');
    }
    function get_product_type_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_product_type')->row();
    }
    function edit_product_type($data,$id){
        $this->db->where('fld_id',$id);
        return $this->db->update('tbl_product_type',$data);
    }
}

?>

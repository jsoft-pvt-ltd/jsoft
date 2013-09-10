<?php
class lens_model extends CI_Model{
    function get_all_lens_type(){
        $this->db->order_by('fld_id', 'desc');
        return $this->db->get('tbl_lens_type');
    }
    function insert_lens_type($data){
        $this->db->insert('tbl_lens_type',$data);
        return $this->db->insert_id();
    }
    function insert_lens_type_package_value($data){
        $this->db->insert('tbl_lens_type_package_value',$data);
    }
    function get_all_lens_type_package_value(){
        return $this->db->get('tbl_lens_type_package_value');
    }
    function insert_lens_type_upgrade($data){
        $this->db->insert('tbl_lens_type_upgrade',$data);
    }
    function get_lens_type_by_id($id){//product_id
        $this->db->select('fld_lens_type');
        $this->db->where('fld_product',$id);
        return $this->db->get('tbl_product_lens_compatibility');       
    }
}

?>

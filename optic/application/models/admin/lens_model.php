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
    function get_lens_type_by_fld_id($id){//product_id
        $this->db->select('fld_name');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_type')->row();
    }
    function edit_lens_type($data,$id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_lens_type',$data);
    }
    function delete_lens_type_packages_value($id){
        $this->db->where('fld_lens_type_id',$id);
        $this->db->delete('tbl_lens_type_package_value');
    }
    function delete_lens_type_upgrade($id){
        $this->db->where('fld_lens_type_id',$id);
        $this->db->delete('tbl_lens_type_upgrade');
    }
    function delete_lens_type($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_lens_type');
    }
}

?>

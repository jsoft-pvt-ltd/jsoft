<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of package_model
 *
 * @author user
 */
class package_model extends CI_Model{
    //put your code here
    function get_all_package(){
        $this->db->order_by('fld_title','asc');
        return $this->db->get('tbl_lens_package');
    }
    function get_package_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_package')->row();
    }
    function insert_package($data){
        $this->db->insert('tbl_lens_package',$data);
        return $this->db->insert_id();
    }
    function insert_package_attribute_value($data){
        $this->db->insert('tbl_lens_package_attribute_value',$data);
    }
    function get_all_package_attributes_value_id(){
        return $this->db->get('tbl_lens_package_attribute_value');
    }
    function update_package($data, $id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_lens_package',$data);
    }
    function update_package_attribute_value($data, $id){
        $this->db->where('fld_package_id',$id);
        $this->db->update('tbl_lens_package_attribute_value',$data);
    }
    function delete_package_attribute_value($id){
        $this->db->where('fld_package_id',$id);
        $this->db->delete('tbl_lens_package_attribute_value');
    }
    function delete_package($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_lens_package');
    }
    function get_package_infos_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_package')->row();
    }
    function get_package_attrs_by_id($id){
        $this->db->where('fld_package_id',$id);
        return $this->db->get(' tbl_lens_package_attribute_value')->result();
    }
}

?>

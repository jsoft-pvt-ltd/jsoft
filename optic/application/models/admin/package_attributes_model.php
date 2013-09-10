<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of package_attribute
 *
 * @author user
 */
class package_attributes_model extends CI_Controller{
    //put your code here
    function get_all_package_attributes(){
        $this->db->order_by('fld_id','desc');
        return $this->db->get('tbl_lens_package_attribute');
    }
    function insert_package_attr($data){
        $this->db->insert('tbl_lens_package_attribute',$data);
    }
    function get_package_attribute_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_package_attribute')->row();
    }
    function update_package_attr($data, $id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_lens_package_attribute',$data);
    }
    function delete_package_attr($id){
        $this->db->where('fld_id',$id);
        return $this->db->delete('tbl_lens_package_attribute');
    }
}

?>

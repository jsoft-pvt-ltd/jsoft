<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product_attributes_model
 *
 * @author user
 */
class attributes_model extends CI_Model{
    function get_all_attributes(){
        $this->db->order_by('fld_id',"desc");
        return $this->db->get('tbl_attributes');
    }
    function get_attribute_by_id($id){ //used
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_attributes')->row();
    }
    function insert_attributes($data){
        $this->db->insert('tbl_attributes',$data);
        return $this->db->insert_id();
    }
    function delete_attributes($id){ //not used
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_attributes');
    }
    function get_attributes_by_product_type($id){  //used
        $this->db->where('fld_product_type_id',$id);
        return $this->db->get('tbl_attributes');
    }
    function edit_attributes($data,$id){  //used
        $this->db->where('fld_id',$id);
        return $this->db->update('tbl_attributes',$data);
    }
}

?>

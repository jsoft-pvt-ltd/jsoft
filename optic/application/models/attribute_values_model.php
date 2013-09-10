<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attribute_values_model
 *
 * @author user
 */
class attribute_values_model extends CI_Model{
    //put your code here
    function get_all_attribute_values(){
        $this->db->order_by('fld_parent_id',"asc");
        $this->db->order_by('fld_id',"asc");
        return $this->db->get('tbl_attribute_values');
    }
    function insert_attribute_values($data){
        $this->db->insert('tbl_attribute_values',$data);
        return $this->db->insert_id();
    }
    function edit_attribute_value($data,$id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_attribute_values',$data);
    }
    function delete_attribute_value($id){
        $this->db->where('fld_id',$id);
        return $this->db->delete('tbl_attribute_values');
    }
    function get_attribute_value_by_id($id){ //attribute value id
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_attribute_values')->row(); 
    }
    function get_attribute_values_by_id($id){ //parent id
        $this->db->where('fld_parent_id',$id);
        return $this->db->get('tbl_attribute_values')->result();
    }
    function get_all_attribute_values_by_attr_ids($attributes){ ///used
        if(is_array($attributes->result()) && $attributes->num_rows()!=0){
            $where='(';
            foreach($attributes->result() as $attribute){
                $where = $where . "fld_attribute_id='".$attribute->fld_id."' OR ";
            }
            $where = substr($where, 0, -4).')';
            $this->db->where($where);
            return $this->db->get('tbl_attribute_values');
        }
    }
}

?>

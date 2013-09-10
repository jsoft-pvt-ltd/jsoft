<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upgrade_model
 *
 * @author user
 */
class upgrade_model extends CI_Model{
    //put your code here
    function insert_upgrade($data){
        $this->db->insert('tbl_lens_upgrade',$data);
    }
    function get_all_upgrades(){
        $this->db->order_by('fld_id','desc');
        return $this->db->get('tbl_lens_upgrade');
    }
    function get_all_upgrades_attr(){
        return $this->db->get('tbl_lens_upgrade_attribute');
    }
    function get_all_upgrades_attr_values(){
        return $this->db->get('tbl_lens_upgrade_attribute_value');
    }
    function insert_upgrade_attribute($data){
        $this->db->insert('tbl_lens_upgrade_attribute',$data);
        return $this->db->insert_id();
    }
    function insert_upgrade_attr_value($data){
        $this->db->insert('tbl_lens_upgrade_attribute_value',$data);
    }
    function get_upgrades_by_lens_type_id($id){//lens type id;
        $this->db->select('fld_lens_upgrade_id');
        $this->db->where('fld_lens_type_id',$id);
        return $this->db->get(' tbl_lens_type_upgrade');
    }
}

?>

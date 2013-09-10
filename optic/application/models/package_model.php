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
        $this->db->order_by('fld_id','desc');
        return $this->db->get('tbl_lens_package');
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
}

?>

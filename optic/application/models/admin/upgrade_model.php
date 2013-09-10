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
        return $this->db->get('tbl_lens_type_upgrade');
    }
    function get_all_lens_type_upgrades(){
        $query =    "SELECT tbl_lens_upgrade.*, tbl_lens_type_upgrade.fld_lens_type_id
                    FROM tbl_lens_upgrade LEFT JOIN tbl_lens_type_upgrade
                    ON tbl_lens_upgrade.fld_id = tbl_lens_type_upgrade.fld_lens_upgrade_id";
        return $this->db->query($query);
    }
    function get_all_lens_type_upgrades_by_lens_type($id){
        $query =    "SELECT tbl_lens_upgrade.*, tbl_lens_type_upgrade.fld_lens_type_id
                    FROM tbl_lens_upgrade LEFT JOIN tbl_lens_type_upgrade
                    ON tbl_lens_upgrade.fld_id = tbl_lens_type_upgrade.fld_lens_upgrade_id
                    WHERE tbl_lens_type_upgrade.fld_lens_type_id = ".$id;
        return $this->db->query($query);
    }
    function get_all_lens_packages_by_lens_type($id){
        $query =    "SELECT tbl_lens_package.*,tbl_lens_type_package_value.fld_lens_type_id
                    FROM tbl_lens_package LEFT JOIN tbl_lens_type_package_value
                    ON tbl_lens_package.fld_id = tbl_lens_type_package_value.fld_lens_package_id
                    WHERE tbl_lens_type_package_value.fld_lens_type_id = ".$id;
        return $this->db->query($query);
    }
    function edit_upgrades($data, $id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_lens_upgrade',$data);
    }
    function delete_upgrades($id){
        $this->delete_upgrade_attr($id, 'fld_upgrade_id');
        
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_lens_upgrade');
    }
    
    function delete_upgrade_attr($id, $fld){
        $this->db->trans_start();
            $this->db->select('fld_id');
            $this->db->where($fld,$id);
            $attribute_id = $this->db->get('tbl_lens_upgrade_attribute');
            
            foreach($attribute_id->result() as $att_id){
                $this->delete_upgrade_attribute_value($att_id->fld_id, 'fld_upgrade_attribute_id');
            }
            
            $this->db->where($fld,$id);
            $this->db->delete('tbl_lens_upgrade_attribute');
        $this->db->trans_complete();
    }
    
    function upgrade_attr_info($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_upgrade_attribute')->row();
    }
    
    function upgrade_attr_value_info($id){
        $this->db->where('fld_upgrade_attribute_id',$id);
        return $this->db->get('tbl_lens_upgrade_attribute_value')->result();
    }
    function edit_upgrade_attribute($data,$id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_lens_upgrade_attribute',$data);
    }
    function delete_upgrade_attribute_value($id, $fld){
        $this->db->where($fld,$id);
        $this->db->delete('tbl_lens_upgrade_attribute_value');
    }
}

?>

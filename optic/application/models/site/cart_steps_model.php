<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cart_steps
 *
 * @author user
 */
class Cart_steps_model extends CI_Model{
    
    function lens_package_info_by_id($id){
        if($id!=0){
            $this->db->where('fld_id',$id);
            return $this->db->get('tbl_lens_package')->row();
        }
        else {
            $query = "SELECT tbl_lens_package.fld_id,tbl_lens_package.fld_min,tbl_lens_package.fld_max, tbl_lens_package.fld_cyl_range
                FROM tbl_lens_package 
                INNER JOIN tbl_lens_type_package_value 
                ON tbl_lens_package.fld_id = tbl_lens_type_package_value.fld_lens_package_id 
                WHERE tbl_lens_type_package_value.fld_lens_type_id =".$this->session->userdata('fld_lens_type')." ORDER BY fld_price asc";
            return $this->db->query($query)->result();
        }
    }
    
    function get_upgrades($id){
    $ids = explode('_', $id);
    $upgrades = array();
    foreach(array_keys($ids) as $key){
        switch ($key){
            case 0:
                $upgrades['upgrade'] = $this->get_upgrade_name($ids[$key]);
                $upgrades['price'] = $this->get_upgrade_price($ids[$key]);
                break;
            case 1:
                $upgrades['upgrade_attr'] = $this->get_upgrade_attr($ids[$key]);
                break;
            case 2:
                $upgrades['upgrade_attr_value'] = $this->get_upgrade_attr_value($ids[$key]);
                break;    
        }
    }
    return($upgrades);
}
    function get_upgrade_price($id){
        $this->db->select('fld_name,fld_price');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_upgrade')->row()->fld_price;
    }
    function get_upgrade_name($id){//upgrade id;
        $this->db->select('fld_name');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_upgrade')->row()->fld_name;
    }
    function get_upgrade_attr($id){//upgrade id;
        $this->db->select('fld_name');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_upgrade_attribute')->row()->fld_name;
    }
    function get_upgrade_attr_value($id){//upgrade id;
        
        $this->db->select('fld_name');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_upgrade_attribute_value')->row()->fld_name;
    }
    function insert_to_tbl_order($data){
        $this->db->insert('tbl_order',$data);
        return $this->db->insert_id();
    }
    function insert_to_tbl_order_item($data){
        $this->db->insert('tbl_order_item',$data);
        return $this->db->insert_id();
    }
    function delete_bought($id){
        $this->db->trans_start();
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_temp');
    //---------------------------------------
        $this->db->where('fld_temp',$id);
        $this->db->delete('tbl_temp_presc_entry');
        $this->db->trans_complete();
    }
    function insert_to_tbl_order_attibutes($data)
    {
        $this->db->insert('tbl_order_attributes',$data);
    }
    function insert_to_tbl_order_lens_package_attributes($data)
    {
        $this->db->insert('tbl_order_lens_package_attributes',$data);
    }
    function insert_to_tbl_order_lens_upgrade_attributes($data)
    {
        $this->db->insert('tbl_order_lens_upgrade_attributes',$data);
    }
    function insert_presc($data){
        $this->db->insert('tbl_presc_entry',$data);
    }
    
    function get_Accessories($num,$offset){
        if($offset=="")$offset=0;
        $query = 'SELECT tbl_accessories.*,tbl_accessories_attributes.fld_location,tbl_accessories_attributes.fld_image FROM tbl_accessories inner join tbl_accessories_attributes on tbl_accessories.fld_id=tbl_accessories_attributes.fld_accessory_id group by tbl_accessories.fld_id LIMIT '.$offset.','.$num;
        return($this->db->query($query));
    }
    
    function get_Accessories_attr(){
        $query = 'SELECT * FROM tbl_accessories_attributes';
        return($this->db->query($query));
    }
    
    function count_accessories()
    {
        return $this->db->get('tbl_accessories')->num_rows();
    }
}

?>

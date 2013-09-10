<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of my_prescription_model
 *
 * @author user
 */
class my_prescription_model extends CI_Model{
    //put your code here
    function insert_presc($data){
        $this->db->insert('tbl_user_presc_entry',$data);
    }
    function get_my_prescription_by_user(){
        $this->db->where('fld_user',$this->session->userdata('userId'));
        $result = $this->db->get('tbl_user_presc_entry');
        return $result;
    }
    function get_my_prescription_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_user_presc_entry')->row()->fld_prescription_path;
    }
    function get_prescription_by_temp_id($id){
        $this->db->where('fld_temp',$id);
        return $this->db->get('tbl_temp_presc_entry')->row();
    }
}

?>

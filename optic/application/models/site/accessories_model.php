<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categories_model
 *
 * @author user
 */
class Accessories_model extends CI_Model{

    function count_accessories(){
        $this->db->where('fld_status',1);
        return $this->db->get('tbl_accessories')->num_rows();
    }
    
    function get_Accessories($num=0,$offset=0){
        $sort_by = $this->session->userdata('sort_by');
        if($offset == 0 || $offset == NULL || $offset==''){
            $offset = 0;
        }
        $query = 'SELECT * FROM tbl_accessories as a INNER JOIN tbl_accessories_attributes as b ON a.fld_id = b.fld_accessory_id WHERE a.fld_status=1 group by a.fld_id';
        if(isset($sort_by) && $sort_by!=''){
            $query = $query .$this->get_sorting_query($sort_by);
        }
        $query = $query. " LIMIT ".$offset.','.$num;
        return($this->db->query($query));
    }
    function get_accessory($id){
        $query = "SELECT * FROM tbl_accessories as a INNER JOIN tbl_accessories_attributes as b ON a.fld_id = b.fld_accessory_id WHERE a.fld_status=1 AND a.fld_id = ".$id." group by a.fld_id";
        return $this->db->query($query)->row();
    }
    function get_accessory_attr($id){
        $this->db->select('*');
        $this->db->where('fld_accessory_id',$id);
        return $this->db->get('tbl_accessories_attributes');
    }
    function get_session_fld_id($session_id){
        $this->db->select('fld_id');
        $this->db->where('session_id',$session_id);
        return $this->db->get('ci_sessions')->row()->fld_id;
    }
    
    function insert_accessory($data){
        $this->db->trans_start();
        $this->db->insert('tbl_temp_accessories',$data);
        $this->db->where('fld_user_id',$data['fld_user_id']);
        return $this->db->get('tbl_temp_accessories')->num_rows();
        $this->db->trans_complete();
    }
    function get_attributes($id, $color){  //from table temp accessories
        $this->db->select('fld_location,fld_image');
        $this->db->where('fld_accessory_id',$id);
        $this->db->where('fld_color',$color);
        return $this->db->get('tbl_accessories_attributes')->row();
    }
    function get_temp_accessories($id, $user_id){
        $this->db->select('fld_qty,fld_color,fld_location,fld_image');
        $this->db->where('fld_user_id',$user_id);
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_temp_accessories')->row();
    }
    
    function get_sorting_query($sort_by){
        $query = '';
        switch($sort_by){
            case 'random':
                $query = " ORDER BY RAND() ";
                break;
            case 'asc_price':
                $query = " ORDER BY a.fld_sp asc ";
                break;
            case 'desc_price':
                $query = " ORDER BY a.fld_sp desc ";
                break;
            case 'latest':
                $query = " ORDER BY a.fld_id desc ";
                break;
        }
        return $query;
    }
}

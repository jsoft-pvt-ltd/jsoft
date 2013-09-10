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
class Contact_lens_model extends CI_Model{

    function count_contact_lenses(){
        return $this->db->get('tbl_contact_lens')->num_rows();
    }
    function get_contact_lenses($num=0,$offset=0){
        $sort_by = $this->session->userdata('sort_by');
        if($offset == 0 || $offset == NULL || $offset==''){
            $offset = 0;
        }
        $query = 'SELECT a.*,b.fld_value,b.fld_id as attr_id,b.fld_type FROM tbl_contact_lens as a INNER JOIN tbl_contact_lens_attributes as b ON a.fld_id = b.fld_contact_lens_id group by a.fld_id';
        if(isset($sort_by) && $sort_by!=''){
            $query = $query .$this->get_sorting_query($sort_by);
        }
        $query = $query. " LIMIT ".$offset.','.$num;
        return($this->db->query($query));
    }
    
    function get_contact_lens($id){
        $query = "SELECT a.*,b.fld_value,b.fld_id as attr_id,b.fld_type FROM tbl_contact_lens as a INNER JOIN tbl_contact_lens_attributes as b ON a.fld_id = b.fld_contact_lens_id WHERE a.fld_id = ".$id." group by a.fld_id";
        return $this->db->query($query)->row();
    }
    
    function get_contact_lens_attr($id){
        $this->db->select('*');
        $this->db->where('fld_contact_lens_id',$id);
        $this->db->order_by('fld_value','asc');
        $result = $this->db->get('tbl_contact_lens_attributes');
        $array = array();
        foreach($result->result() as $keys=>$row){
            $array[$row->fld_type][] = array(
                'fld_id'=>$row->fld_id,
                'fld_value'=>$row->fld_value,
                'fld_contact_lens_id'=>$row->fld_contact_lens_id
            );
        }
        return ($array);
    }
    function insert_contact_lens($data){
        $this->db->insert('tbl_temp_contact_lenses',$data);
    }
    function get_sorting_query($sort_by){
        $query = '';
        switch($sort_by){
            case 'random':
                $query = " ORDER BY RAND() ";
                break;
            case 'asc_price':
                $query = " ORDER BY a.fld_discount_price asc ";
                break;
            case 'desc_price':
                $query = " ORDER BY a.fld_discount_price desc ";
                break;
            case 'latest':
                $query = " ORDER BY a.fld_id desc ";
                break;
        }
        return $query;
    }
}
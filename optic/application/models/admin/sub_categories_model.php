<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sub_categories_model
 *
 * @author user
 */
class sub_categories_model extends CI_Model{
    //put your code here
    function get_all_sub_categories(){
        $this->db->order_by('fld_rank','desc');
        return $this->db->get('tbl_sub_categories');
    }
    function insert_sub_category_values($data){
        $this->db->insert('tbl_sub_categories',$data);
    }
    function get_max_rank_by_cat_id($id){
        $this->db->select_max('fld_rank');
        $this->db->where('fld_category_id',$id);
        $max_rank = $this->db->get('tbl_sub_categories')->row()->fld_rank;
        if($max_rank==""){
            return 0;
        }else
            return $max_rank;
    }
    function get_sub_categories_by_cat_id($id){   ///this is category id
        $this->db->where('fld_category_id',$id);
        return $this->db->get('tbl_sub_categories')->result(); //for json encoding
    }
    function edit_sub_categories($data, $id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_sub_categories',$data);
    }
    function delete_sub_category($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_sub_categories');
    }
    function interchange_rank($rank,$pos,$id){
        $this->db->trans_start();
        $max_rank = $this->get_max_rank_by_cat_id($id);
        
        if($pos=='up'){
            if($rank==$max_rank){
                return;
            }
            $temp=$rank+1;
        }
        else{
            if($rank==1){
                return;
            }
            $temp=$rank-1;
        }
        
        //select the upper/lower ranked category id
        $next_id = $this->get_id_by_rank_n_cat_id($temp, $id);//temp is rank value here and $id is the category id

        //change the rank of current id
        $data['fld_rank'] = $temp;
        $this->db->where('fld_rank',$rank);
        $this->db->where('fld_category_id',$id);
        $this->db->update('tbl_sub_categories',$data);

        //change the rank of the upper/lower ones
        $data['fld_rank']=$rank;
        $this->db->where('fld_id',$next_id);
        $this->db->where('fld_category_id',$id);
        $this->db->update('tbl_sub_categories',$data);
        
        $this->db->trans_complete();
    }
    function get_id_by_rank_n_cat_id($rank, $id){ //cat id
        $this->db->select('fld_id');
        $this->db->where('fld_rank',$rank);
        $this->db->where('fld_category_id',$id);
        return $this->db->get('tbl_sub_categories')->row()->fld_id;
    }
}

?>

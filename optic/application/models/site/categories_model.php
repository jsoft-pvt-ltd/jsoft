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
class Categories_model extends CI_Model{
    //put your code here
    function get_all_categories(){
        $this->db->order_by('fld_rank','desc');
        return $this->db->get('tbl_categories');
    }
    function insert_category($data){ //used
        $this->db->insert('tbl_categories',$data);
        return $this->db->insert_id();
    }
    function get_max_rank($id=0){ //this id is for category id
        
        $this->db->select_max('fld_rank');
        if($id==0){
            $max_rank = $this->db->get('tbl_categories')->row()->fld_rank;
        }
        else{
            $this->db->where('fld_category_id',$id);
            $max_rank = $this->db->get('tbl_sub_categories')->row()->fld_rank;
        }
        if($max_rank==""){
            return 0;
        }else
            return $max_rank;
    }
    function get_min_rank($id=0){
        $this->db->select_min('fld_rank');
        if($id==0){
            $min_rank = $this->db->get('tbl_categories')->row()->fld_rank;
        }
        else{
            $this->db->where('fld_category_id',$id);
            $min_rank = $this->db->get('tbl_sub_categories')->row()->fld_rank;
        }
        if($min_rank==""){
            return 0;
        }else
            return $min_rank;
    }
    function get_rank_by_id($id){//fld_id
        $this->db->select('fld_rank');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_categories')->row()->fld_rank;
    }
    function interchange_rank($rank,$next_rank,$pos){
        $this->db->trans_start();
//        if($id!=0){
//            $max_rank = $this->get_max_rank();
//        }
//        
//        
//        if($pos=='up'){
//            if($rank==$max_rank){
//                return;
//            }
//            $temp=$rank+1;
//        }
//        else{
//            if($rank==1){
//                return;
//            }
//            $temp=$rank-1;
//        }
        
        //select the upper/lower ranked category id
        $next_id = $this->get_id_by_rank($next_rank);//temp is rank value here;

        //change the rank of current id
        $data['fld_rank'] = $next_rank;
        $this->db->where('fld_rank',$rank);
        $this->db->update('tbl_categories',$data);

        //change the rank of the upper/lower ones
        $data['fld_rank']=$rank;
        $this->db->where('fld_id',$next_id);
        $this->db->update('tbl_categories',$data);
        
        $this->db->trans_complete();
    }
    function get_id_by_rank($rank){
        $this->db->select('fld_id');
        $this->db->where('fld_rank',$rank);
        return $this->db->get('tbl_categories')->row()->fld_id;
    }
    
    function get_categories_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_categories')->row(); //for json encoding
    }
    function edit_categories($data, $id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_categories',$data);
    }
    function delete_category($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_categories');
        $this->delete_sub_category_by_cat($id);
    }
    
    function delete_sub_category_by_cat($id){
        $this->db->select('fld_location,fld_image,fld_id');
        $this->db->where('fld_category_id',$id);
        $img_info = $this->db->get('tbl_sub_categories');
        
        foreach($img_info->result() as $img){
            unlink(getcwd().'/'.$img->fld_location.$img->fld_image);
            unlink(getcwd().'/'.$img->fld_location."thumbs/".$img->fld_image);
        }
        
        $this->db->where('fld_category_id',$id);
        $this->db->delete('tbl_sub_categories');
    }
    
//    function unlink_image($id, $tbl){ //for removing a single image
//        $this->db->select('fld_location,fld_image');
//        $this->db->where('fld_id',$id);
//        $img = $this->db->get($tbl)->row();
//        unlink(getcwd().'/'.$img->fld_location.$img->fld_image);
//        unlink(getcwd().'/'.$img->fld_location."thumbs/".$img->fld_image);
//    }
    
    function update_rank($id,$data){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_categories',$data);
    }
    function get_image_by_id($id)
    {
        $this->db->select('fld_image,fld_location');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_categories')->row();
    }
}

?>

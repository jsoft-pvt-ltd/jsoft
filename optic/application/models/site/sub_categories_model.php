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
        //print_r($data);exit;
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
    function interchange_rank($rank,$next_rank,$pos,$id, $sub_cid){
        $this->db->trans_off();
//        $this->db->trans_start();
        $next_id = $this->get_id_by_rank_n_cat_id($next_rank, $id);//temp is rank value here and $id is the category id
        echo "[ next_id:".$next_id." ][ rank: ".$rank." ]--[ sub_cid:".$sub_cid." ][ new_rank: ".$next_rank." ]";
        $this->change_rank($next_rank,$sub_cid);
        $this->change_rank($rank,$next_id);
//        $data = array(
//            array(
//               'fld_rank' => $next_rank,
//               'fld_id' => $sub_cid
//            )
//            ,
//            array(
//               'fld_rank' => $rank,
//               'fld_id' => $next_id
//            )
//         );
//        $this->db->update_batch('tbl_sub_categories', $data, 'fld_id');
    }
    function change_rank($rnk,$id){
        $query  = "UPDATE tbl_sub_categories SET fld_rank = '".$rnk."' WHERE fld_id ='".$id."'";
        $this->db->query($query);
    }
    function get_up_rank($rank,$id){
        $query = "SELECT fld_rank FROM tbl_sub_categories WHERE fld_category_id = ".$id." AND fld_rank > ".$rank." ORDER BY fld_rank ASC LIMIT 0,1";
        $result = $this->db->query($query);
        if($result->row()->fld_rank >0)return $result->row()->fld_rank;
        else return $rank;
    }
    function get_down_rank($rank, $id){
        $query = "SELECT fld_rank FROM tbl_sub_categories WHERE fld_category_id = ".$id." AND fld_rank < ".$rank." ORDER BY fld_rank DESC LIMIT 0,1";
        $result = $this->db->query($query);
        if($result->row()->fld_rank >0)return $result->row()->fld_rank;
        else return $rank;
    }
    function get_id_by_rank_n_cat_id($rank, $id){ //cat id
        $this->db->select('fld_id');
        $this->db->where('fld_rank',$rank);
        $this->db->where('fld_category_id',$id);
        return $this->db->get('tbl_sub_categories')->row()->fld_id;
    }
    function get_sub_categories_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_sub_categories')->row(); //for json encoding
    }
    function get_image_by_id($id)
    {
        $this->db->select('fld_image,fld_location');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_sub_categories')->row();
    }
}

?>

<?php
    function get_all_categories(){
        $CI=& get_instance();
        $CI->db->order_by('fld_rank','desc');
        return $CI->db->get('tbl_categories');
    }
    function get_all_sub_categories(){
        $CI=& get_instance();
        $CI->db->order_by('fld_rank','desc');
        return $CI->db->get('tbl_sub_categories');
    }
    function has_child($id){
        $CI=& get_instance();
        $CI->db->where('fld_category_id',$id);
        $rows = $CI->db->get('tbl_sub_categories')->num_rows();
        if($rows>0){
            return true;
        }
        else return false;
    }
?>

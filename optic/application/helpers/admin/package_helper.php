<?php
    function get_package_attribute_by_id($id){
        $CI = & get_instance();
        $CI->db->where('fld_id',$id);
        return $CI->db->get('tbl_lens_package_attribute')->row();
    }
    function get_upgrade_by_id($id){
        $CI = & get_instance();
        $CI->db->where('fld_id',$id);
        return $CI->db->get('tbl_lens_upgrade')->row();
    }
    function get_package_name_by_id($id){
        $CI = & get_instance();
        $CI->db->where('fld_id',$id);
        return $CI->db->get('tbl_lens_package')->row();
    }
?>

<?php
    function presc_by_user_presc_entry_id($id){
        $CI = & get_instance();
        $CI->db->where('fld_id',$id);
        return $CI->db->get('tbl_user_presc_entry')->row();
    }
    function presc_from_temp_by_temp_id($id){
        $CI = & get_instance();
        $CI->db->where('fld_temp',$id);
        return $CI->db->get('tbl_temp_presc_entry')->row();
    }
?>

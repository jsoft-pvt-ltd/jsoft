<?php
function get_footer_menu(){
    $CI = & get_instance();
    $sql="SELECT tbl_page.*, tbl_rank.fld_frank from tbl_page inner join tbl_rank on tbl_page.fld_type=tbl_rank.fld_type_id where tbl_rank.fld_foption=1 and tbl_rank.fld_page=tbl_page.fld_page order by fld_frank asc";
    return $CI->db->query($sql)->result();
}
function get_header_menu(){
    $CI = & get_instance();
    $sql="SELECT tbl_page.*, tbl_rank.fld_rank from tbl_page inner join tbl_rank on tbl_page.fld_type=tbl_rank.fld_type_id where tbl_rank.fld_option=1 and tbl_rank.fld_page=tbl_page.fld_page order by fld_rank asc";
    return $CI->db->query($sql)->result();
}
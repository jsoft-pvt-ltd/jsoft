<?php
function get_country_name($country_id){
    $CI =& get_instance();
    $query = $CI->db->get_where('tbl_country',array('fld_id'=>$country_id));
    return $query->row();
}
function carriers($country_id)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('tbl_carrier',array('fld_country'=>$country_id));
    return $query;
}
function get_country_name_by_carrier($carrier){
    $CI =& get_instance();
    $CI->db->trans_start();
    $CI->db->select('fld_country');
    $country = $CI->db->get_where('tbl_carrier',array('fld_id'=>$carrier))->row()->fld_country;
    $CI->db->select('fld_name');
    $country = $CI->db->get_where('tbl_country',array('fld_id'=>$country))->row()->fld_name;
    $CI->db->trans_complete();
    return $country;
}
function get_carrier_info($carrier){
    $CI =& get_instance();
    return $CI->db->get_where('tbl_carrier',array('fld_id'=>$carrier))->row();
}
<?php if( ! defined('BASEPATH')) exit('NO direct script access allowed');
function Count_() 
{
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('tbl_user_gallery');
    $CI->db->where('fld_user_id',$CI->session->userdata('userId'));
    $CI->db->where('fld_primary',0);
    $query = $CI->db->get();
    return $query->num_rows();
}
function GetImages($id)
{
    parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
    $config['appId'] = '217105315042604';
    $config['secret'] = 'ec54028e564b101c35577c243e00f43d';
    $config['cookie'] = 'true';

    $CI = & get_instance();
    $CI->load->library('facebook', $config);

    $pics = $CI->facebook->api('/' . $id . '/photos?fields=source,picture');
    return $pics;
//    $output = '';
//
//    foreach ($pics['data'] as $image) {
//        print_r($image);
//        $output .= '<image src="' . $image['source'] . '"/> <br />';
//    }
//
//    return $output;
}
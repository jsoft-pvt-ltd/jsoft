<?php
class Rank_model extends CI_Model{
    
function get_max_rank(){
        $this->db->select_max('fld_rank');
        $max_rank = $this->db->get('tbl_rank')->row()->fld_rank;
        if($max_rank==""){
            return 0;
        }else
            return $max_rank;
    }
function get_rank_by_name($name){
    $this->db->select('fld_rank');
        $this->db->where('fld_page',$name);
        return $this->db->get('tbl_rank')->row()->fld_rank;
} 
function get_rank_by_id($id){
    $this->db->select('fld_rank');
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_rank')->row()->fld_rank;
}
function get_id_by_rank($rank){
        $this->db->select('fld_id');
        $this->db->where('fld_rank',$rank);
        return $this->db->get('tbl_rank')->row()->fld_id;
    }
    function insert($arr){
    $this->db->insert('tbl_rank',$arr);
}
function  show(){
        $this->db->select('*');
        $this->db->from('tbl_rank');
        $this->db->order_by('fld_rank','asc'); 
        $query = $this->db->get();
        return $query->result();
}
function up($rank,$id){
    $sql = "SELECT fld_rank,fld_id FROM `tbl_rank` WHERE fld_rank < " . $rank ." and fld_id !=" .$id ." order by fld_rank desc limit 1";
    $rank_new =  $this->db->query($sql)->row()->fld_rank;
    $data = array('fld_rank'=> $rank);
    $this->db->where('fld_rank',$rank_new);
    $this->db->update('tbl_rank', $data);
    $data1 = array ('fld_rank'=> $rank_new);
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data1);    
}
function down($rank,$id){
    $sql = "SELECT fld_rank,fld_id FROM `tbl_rank` WHERE fld_rank > " . $rank ." and fld_id !=" .$id ." order by fld_rank asc limit 1";
    $rank_new =  $this->db->query($sql)->row()->fld_rank;
    $data = array('fld_rank'=> $rank);
    $this->db->where('fld_rank',$rank_new);
    $this->db->update('tbl_rank', $data);
    $data1 = array ('fld_rank'=> $rank_new);
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data1);    
}
}
?>

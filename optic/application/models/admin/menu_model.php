<?php
class Menu_model extends CI_Model{
    
function get_max_rank(){
        $this->db->select_max('fld_rank');
        $max_rank = $this->db->get('tbl_rank')->row()->fld_rank;
        if($max_rank==""){
            return 0;
        }else
            return $max_rank;
    }
function get_max_frank(){
        $this->db->select_max('fld_frank');
        $max_rank = $this->db->get('tbl_rank')->row()->fld_frank;
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
function show_menu($id){
    $data = array('fld_option'=>"1" );
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data);
}
function hide_menu($id){
    $data = array('fld_option'=>"0" );
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data);
}
function show_fmenu($id){
    $data = array('fld_foption'=>"1" );
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data);
}
function hide_fmenu($id){
    $data = array('fld_foption'=>"0" );
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data);
}
function get_id_by_rank($rank){
        $this->db->select('fld_id');
        $this->db->where('fld_rank',$rank);
        return $this->db->get('tbl_rank')->row()->fld_id;
    }
function get_id_by_frank($rank){
        $this->db->select('fld_id');
        $this->db->where('fld_frank',$rank);
        return $this->db->get('tbl_rank')->row()->fld_id;
    }
    function insert($arr){
    $this->db->insert('tbl_rank',$arr);
}
function  show(){
    $sql="SELECT tbl_page.*, tbl_rank.fld_rank from tbl_page inner join tbl_rank on tbl_page.fld_type=tbl_rank.fld_type_id where tbl_rank.fld_option=1 and tbl_rank.fld_page=tbl_page.fld_page order by fld_rank asc";
    return $this->db->query($sql)->result();

}
function  fshow(){
        $sql="SELECT tbl_page.*, tbl_rank.fld_frank from tbl_page inner join tbl_rank on tbl_page.fld_type=tbl_rank.fld_type_id where tbl_rank.fld_foption=1 and tbl_rank.fld_page=tbl_page.fld_page order by fld_frank asc";
    return $this->db->query($sql)->result();
}

////This is for backup only------------------------------------------------>
//function links(){
//    $sql="SELECT tbl_page.*, tbl_rank.fld_rank from tbl_page inner join tbl_rank on tbl_page.fld_type=tbl_rank.fld_type_id where tbl_rank.fld_type_id=2 and tbl_rank.fld_option=1 and tbl_rank.fld_page=tbl_page.fld_page order by fld_rank asc";
//    return $this->db->query($sql)->result();
//}
//function flinks(){
//   $sql= "SELECT tbl_page.*, tbl_rank.fld_frank from tbl_page inner join tbl_rank on tbl_page.fld_type=tbl_rank.fld_type_id where tbl_rank.fld_type_id=2 and tbl_rank.fld_option=1 and tbl_rank.fld_page=tbl_page.fld_page order by fld_frank asc";
//    return $this->db->query($sql)->result();
//}
////----------------------------------------------------------------------->

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
function fup($rank,$id){
    $sql = "SELECT fld_frank,fld_id FROM `tbl_rank` WHERE fld_frank < " . $rank ." and fld_id !=" .$id ." order by fld_frank desc limit 1";
    $rank_new =  $this->db->query($sql)->row()->fld_frank;
    $data = array('fld_frank'=> $rank);
    $this->db->where('fld_frank',$rank_new);
    $this->db->update('tbl_rank', $data);
    $data1 = array ('fld_frank'=> $rank_new);
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data1);    
}
function fdown($rank,$id){
    $sql = "SELECT fld_frank,fld_id FROM `tbl_rank` WHERE fld_frank > " . $rank ." and fld_id !=" .$id ." order by fld_frank asc limit 1";
    $rank_new =  $this->db->query($sql)->row()->fld_frank;
    $data = array('fld_frank'=> $rank);
    $this->db->where('fld_frank',$rank_new);
    $this->db->update('tbl_rank', $data);
    $data1 = array ('fld_frank'=> $rank_new);
    $this->db->where('fld_id',$id);
    $this->db->update('tbl_rank', $data1);    
}
function  show_rank(){
        $this->db->select('*');
        $this->db->from('tbl_rank');
        //$this->db->where('fld_type_id','1');
        $this->db->order_by('fld_rank','asc'); 
        $query = $this->db->get();
        return $query->result();
}
function  fshow_rank(){
        $this->db->select('*');
        $this->db->from('tbl_rank');
        //$this->db->where('fld_type_id','1');
        $this->db->order_by('fld_frank','asc'); 
        $query = $this->db->get();
        return $query->result();
}
}
?>

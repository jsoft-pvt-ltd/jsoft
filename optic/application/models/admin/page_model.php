<?php
class Page_model extends CI_Model{
    function count()
    {
        $query = $this->db->get('tbl_page');
        return $query->num_rows();
    }
    function insert($arr){
        $this->db->insert('tbl_page',$arr);
    }
    function show_all(){
        $this->db->select('fld_page,fld_id');
        $this->db->from('tbl_page');
        $query=$this->db->get();
        return $query->result();
    }
    function delete_meta_for_page($page){
        $this->db->where('fld_page',$page);
        $this->db->delete('tbl_meta');
    }
    function delete_rank_for_page($page){
        $this->db->where('fld_page',$page);
        $this->db->delete('tbl_rank');
    }
    function update_meta_page($page,$arr1){
        $this->db->where('fld_page', $page);
        $this->db->update('tbl_meta', $arr1); 
    }
    function update_rank_page($page,$arr1){
        $this->db->where('fld_page', $page);
        $this->db->update('tbl_rank', $arr1); 
    }
    function show($num,$offset){
        $this->db->select('*');
        $this->db->from('tbl_page');
        $this->db->where('fld_type >','0');
        $this->db->limit($num,$offset);
        $query=$this->db->get();
        return $query;
    }
    function delete_page($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_page');
    }
    function update_page($id,$arr){
        $this->db->where('fld_id', $id);
        $this->db->update('tbl_page', $arr); 
    }
    function select_page($id){
        $this->db->select('*');
        $this->db->from('tbl_page');
        $this->db->where('fld_id',$id);
        
        $query=$this->db->get();
        return $query->row();
    }
    function select_page_by_name($name){
        $this->db->select('*');
        $this->db->from('tbl_page');
        $this->db->where('fld_page',$name);
        
        $query=$this->db->get();
        return $query->row();
    }
    function get_name_from_id($id){
        $this->db->select('fld_page');
        $this->db->from('tbl_rank');
        $this->db->where('fld_id',$id);
        $query=$this->db->get();
        return $query->row()->fld_page;
    }
    function get_name_from_page_id($id){
        $this->db->select('fld_page');
        $this->db->from('tbl_page');
        $this->db->where('fld_id',$id);
        $query=$this->db->get();
        return $query->row()->fld_page;
    }
}
?>

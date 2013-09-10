<?php
class Meta_model extends CI_Model{
    function count()
    {
        $query = $this->db->get('tbl_meta');
        return $query->num_rows();
    }
     function insert_meta($arr){
        $this->db->insert('tbl_meta',$arr);
    }
        function show_all(){
        $this->db->select('fld_page,fld_id');
        $this->db->from('tbl_page');
        $this->db->where('fld_type <','2');
        $query=$this->db->get();
        return $query->result();
    }
    function select_meta($id){
        $this->db->select('*');
        $this->db->from('tbl_meta');
        $this->db->where('fld_id',$id);
        $query=$this->db->get();
        return $query->row();
    }
    function show_cats(){
        $this->db->select('fld_name,fld_id');
        $this->db->from('tbl_categories');
        $query=$this->db->get();
        return $query->result();
    }
    function show_prod(){
        $this->db->select('fld_name,fld_id');
        $this->db->from('tbl_product');
        $query=$this->db->get();
        return $query->result();
    }
    function view_meta($num,$offset){
         $this->db->select('*');
         $this->db->from('tbl_meta');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query->result();
    }
    function view_metas(){
         $this->db->select('*');
         $this->db->from('tbl_meta');
        $query = $this->db->get();
        return $query->result();
    }
    function  update_meta($id,$arr){
        $this->db->where('fld_id', $id);
        $this->db->update('tbl_meta', $arr);
    }
    function delete_meta($id){
        $this->db->where('fld_id', $id);
        $this->db->delete('tbl_meta');
    }
    
}
?>
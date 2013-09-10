<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of iafm
 *
 * @author user
 */
class Faq_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function count_faqs(){
        $query = $this->db->get('tbl_faq');
        return $query->num_rows();
    }
    function faqs($num,$offset){
        $this->db->select('*');
        $this->db->from('tbl_faq');
        $this->db->order_by('fld_id','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query;
    }
    function select_all_faqtype()
    {
        $this->db->select('*');
        $this->db->from('tbl_faqtype');
        $this->db->order_by('fld_id','desc');
        $query = $this->db->get();
        return $query;
    }
    function InsertIAF($data){
        try{
            $this->db->insert('tbl_faq',$data);
        }catch (Exception $e){
            print_r($e);
        }
    }

    function GetIAFInfoById($id){
        $this->db->where('fld_id',$id);
        $query = $this->db->get('tbl_faq');
        return $query->row();
    }
    public function UpdateIAF($id,$data){
        try{
            $this->db->where('fld_id',$id);
            $this->db->update('tbl_faq',$data);
        }catch (Exception $e){
            print_r($e);
        }
    }
    function GetIAFByTitle($title){
        $this->db->select('fld_id');
        $this->db->where('fld_title', $title);
        return $this->db->get('tbl_faq')->row();
    }
    function deleteIAF($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_faq');
    }
    function count_faqtype(){
        $query = $this->db->get('tbl_faq');
        return $query->num_rows();
    }
    function faqtype($num,$offset){
        $this->db->select('*');
        $this->db->from('tbl_faqtype');
        $this->db->order_by('fld_id','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query;
    }
    function insert_faqtype($data)
    {
        $this->db->insert('tbl_faqtype',$data);
    }
    function update_faqtype($faqtype_id,$data)
    {
        $this->db->where('fld_id',$faqtype_id);
        $this->db->update('tbl_faqtype',$data);
    }
    function delete_faqtype($faqtype_id)
    {
        $this->db->where('fld_id',$faqtype_id);
        $this->db->delete('tbl_faqtype');
    }
    function sections()
    {
        $query = $this->db->get('tbl_faqtype');
        return $query;
    }
    function select_qna_of_section($section_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_faq');
        $this->db->where('fld_faqtype',$section_id);
        $query = $this->db->get();
        return $query;
    }
}

?>

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
class iafm extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function InsertIAF($data){
        try{
            $this->db->insert('tbl_iaf',$data);
        }catch (Exception $e){
            print_r($e);
        }
    }
    public function GetIAFInfo(){
        try{
            return $this->db->get('tbl_iaf')->result();
        }catch (Exception $e){
            print_r($e);
        }
    }
    public function GetIAFInfoById($id){
        try{
            $this->db->where('fld_id',$id);
            return $this->db->get('tbl_iaf')->result();
        }catch (Exception $e){
            print_r($e);
        }
    }
    public function UpdateIAF($id,$data){
        try{
            $this->db->where('fld_id',$id);
            $this->db->update('tbl_iaf',$data);
        }catch (Exception $e){
            print_r($e);
        }
    }
    function GetIAFByTitle($title){
        $this->db->select('fld_id');
        $this->db->where('fld_title', $title);
        return $this->db->get('tbl_iaf')->row();
    }
function deleteIAF($id){
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_iaf');
    }
}

?>

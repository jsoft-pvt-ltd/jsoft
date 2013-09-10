<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contact_lens_model
 *
 * @author user
 */
class Contact_lens_model extends CI_Model{
    
    function insert_brands($data){
        $this->db->insert('tbl_contact_lens_brands',$data);
    }
    function get_brands($select="*"){
        $this->db->select($select);
        return $this->db->get('tbl_contact_lens_brands');
    }
    function get_brand($id){
        return $this->db->get_where('tbl_contact_lens_brands',array('fld_id' => $id))->row();
    }
    function update_brands($data,$id,$flag){
        if($flag==true){
            $this->unlink_images($id, 'tbl_contact_lens_brands');
        }
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_contact_lens_brands',$data);
    }
    
    function update_lens($data,$id,$flag){
        if($flag==true){
            $this->unlink_images($id, 'tbl_contact_lens');
        }
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_contact_lens',$data);
    }
    
    function update_attr($data,$lens_id,$id)
    {
        $this->db->where('fld_contact_lens_id',$lens_id);
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_contact_lens_attributes',$data);
    }
    
    function delete_lens($id)
    {
        $this->unlink_images($id, 'tbl_contact_lens');
        $this->db->where('fld_contact_lens_id',$id);
        $this->db->delete('tbl_contact_lens_attributes');
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_contact_lens');
    }
    
    function delete_brands($id){
        $this->unlink_images($id,'tbl_contact_lens_brands');
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_contact_lens_brands');
    }
    function unlink_images($id,$tbl){
        $this->db->select('fld_location,fld_image');
        $this->db->where('fld_id',$id);
        $img = $this->db->get($tbl)->row();
        unlink(getcwd().'/'.$img->fld_location."/".$img->fld_image);
        unlink(getcwd().'/'.$img->fld_location."/thumbs/".$img->fld_image);
    }
    
    function insert_lens($data)
    {
        $this->db->insert('tbl_contact_lens',$data);
        return $this->db->insert_id();
    }
    
    function insert_lens_attribute($data)
    {
        $this->db->insert('tbl_contact_lens_attributes',$data);
    }
    
    function get_power($id)
    {
        $query = "Select * from tbl_contact_lens_attributes where fld_contact_lens_id=".$id." and (fld_type='power_plus' or fld_type='power_minus') order by fld_value asc";
//        $this->db->and_where('fld_contact_lens_id', $id);
//        $this->db->or_where('fld_type', 'power_plus');
//        $this->db->or_where('fld_type', 'power_minus');
//        $this->db->order_by('fld_value','asc');
        //return $this->db->get('tbl_contact_lens_attributes');
        return $this->db->query($query);
    }
    
    function get_axes($id)
    {
        $this->db->where('fld_contact_lens_id', $id);
        $this->db->where('fld_type', 'axis');
        return $this->db->get('tbl_contact_lens_attributes');
    }
    
    function get_cylinder($id)
    {
        $this->db->where('fld_contact_lens_id', $id);
        $this->db->where('fld_type', 'cylinder');
        return $this->db->get('tbl_contact_lens_attributes');
    }
    
    function get_diameter($id)
    {
        $this->db->where('fld_contact_lens_id', $id);
        $this->db->where('fld_type', 'diameter');
        return $this->db->get('tbl_contact_lens_attributes');
    }
    
    function get_base_curve($id)
    {
        $this->db->where('fld_contact_lens_id', $id);
        $this->db->where('fld_type', 'base_curve');
        return $this->db->get('tbl_contact_lens_attributes');
    }
    
    function get_sph($id)
    {
        $this->db->where('fld_contact_lens_id', $id);
        $this->db->where('fld_type', 'spherical');
        return $this->db->get('tbl_contact_lens_attributes');
    }
    
    function get_lens_name($id)
    {
        $this->db->select('fld_name');
        $this->db->where('fld_id', $id);
        return $this->db->get('tbl_contact_lens')->row();
    }
    
    function get_lens($id)
    {
        $this->db->select('*');
        $this->db->where('fld_id', $id);
        return $this->db->get('tbl_contact_lens')->row();
    }
    
    function get_contact_lenses($num=0,$offset=0)
    {
        $this->db->select('tbl_contact_lens.*,tbl_contact_lens_brands.fld_name as brand_name');
        $this->db->join('tbl_contact_lens_brands','tbl_contact_lens.fld_brand = tbl_contact_lens_brands.fld_id', 'inner');
        $this->db->order_by('fld_id','desc');
        $this->db->limit($num,$offset);
        return $this->db->get('tbl_contact_lens');
    }
    
    function count()
    {
        $query = $this->db->get('tbl_contact_lens');
        return $query->num_rows();
    }
    
    function delete_attr($id)
    {
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_contact_lens_attributes');
    }
}
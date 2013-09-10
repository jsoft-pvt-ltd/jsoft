<?php
class package_upgrade_model extends CI_Model{
    
    function get_all_package_upgrades(){
        $this->db->order_by('fld_id','desc');
        return $this->db->get('tbl_lens_upgrade')->result();
    }
    function get_upgrade_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_lens_upgrade')->row();
    }
    function get_all_lens_package_upgrades(){
        $this->db->order_by('fld_id','desc');
        return $this->db->get('tbl_lens_package_upgrade')->result();
    }
    function insert_package_upgrade_value($data){
        $this->db->insert('tbl_lens_package_upgrade',$data);
    }
    function delete_package_attribute_value($id){
        $this->db->where('fld_package_id',$id);
        $this->db->delete('tbl_lens_package_upgrade');
    }
    function lens_upgrades_by_attr_id($id){
        $this->db->where('fld_upgrade_id',$id);
        $data['upgrade_attr']=$this->db->get('tbl_lens_upgrade_attribute')->result();
        return $data;
    }
    function lens_upgrades_by_value_id($id){
        $this->db->where('fld_upgrade_attribute_id',$id);
        $data['upgrade_value']=$this->db->get('tbl_lens_upgrade_attribute_value')->result();
        return $data;
    }
    function lens_upgrades_by_id($id){
        $sql="SELECT tbl_lens_upgrade.* FROM tbl_lens_upgrade INNER JOIN tbl_lens_package_upgrade ON tbl_lens_upgrade.fld_id = tbl_lens_package_upgrade.fld_lens_upgrade_id WHERE tbl_lens_package_upgrade.fld_package_id = $id";
        $data['upgrades'] = $this->db->query($sql)->result();
        return $data;
    }
}
?>

<?php
class product_image_model extends CI_Model{
    
    function get_images_by_color_id($id,$product_id){
        $this->db->select('fld_name,fld_url,fld_primary');
        $this->db->where('fld_product',$product_id);
        $this->db->where('fld_color',$id);
        $this->db->limit(5,0);
        $data['images']= $this->db->get('tbl_product_image')->result();
        return $data;
    }
}
?>

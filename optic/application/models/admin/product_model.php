<?php 
class Product_model extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    function count()
    {
        $query = $this->db->get('tbl_product');
        return $query->num_rows();
    }
    function count_featured_product()
    {
        $this->db->where('fld_featured',1);
        $query = $this->db->get('tbl_product');
        return $query->num_rows();
    }
    function select($num=0,$offset=0)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->order_by('fld_id','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query;
    }
    function add_product($info)
    {
        $this->db->insert('tbl_product',$info);
        return $this->db->insert_id();
    }
    function insert_product_attribute($attribute)
    {
        $this->db->insert('tbl_product_attribute',$attribute);
    }
    function attributes($product_type_id)
    {
        $sql = 'select tbl_attributes.fld_id as attribute_id,tbl_attributes.fld_name as attribute,tbl_attribute_values.fld_id as attribute_id,tbl_attribute_values.fld_value as attribute_value, tbl_attribute_values.fld_parent_id from tbl_attributes inner join tbl_attribute_values on tbl_attributes.fld_id = tbl_attribute_values.fld_attribute_id where tbl_attributes.fld_product_type_id ='.$product_type_id;
       
        $query = $this->db->query($sql);
        return $query;
    }
    function lens_types()
    {
        $query = $this->db->get('tbl_lens_type');
        return $query;
    }
    function get_vendors($product_type)
    {
        $this->db->select('*');
        $this->db->from('tbl_vendor');
        $this->db->where('fld_product_type',$product_type);
        $query  = $this->db->get();
        return $query;
    }
    function get_product_type_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_product_type')->row();
    }
    function get_attributes_by_product_type($id){  //used
        $this->db->where('fld_product_type_id',$id);
        return $this->db->get('tbl_attributes');
    }
    function get_all_attribute_values_by_attr_ids($attributes){ ///used
        if(is_array($attributes->result()) && $attributes->num_rows()!=0){
            $where='(';
            foreach($attributes->result() as $attribute){
                $where = $where . "fld_attribute_id='".$attribute->fld_id."' OR ";
            }
            $where = substr($where, 0, -4).')';
            $this->db->where($where);
            return $this->db->get('tbl_attribute_values');
        }
    }
    function select_lens_pkg_attributes($lens_package_id)
    {
        $sql = 'select tbl_lens_package_attribute.* from tbl_lens_package_attribute inner join tbl_lens_package_attribute_value on tbl_lens_package_attribute.fld_id = tbl_lens_package_attribute_value.fld_lens_package_attribute_id where tbl_lens_package_attribute_value.fld_package_id ='.$lens_package_id;
        $query = $this->db->query($sql);
        return $query;
    }
    function select_best_seller_product($num=0, $offset=0){
        if($offset == 0 || $offset == NULL || $offset==''){
            $offset = 0;
        }
        $query = "SELECT tbl_product.*, tbl_categories.fld_name AS cat_name, tbl_sub_categories.fld_name AS sub_cat_name FROM tbl_product LEFT JOIN tbl_categories ON tbl_product.fld_category = tbl_categories.fld_id LEFT JOIN tbl_sub_categories on tbl_product.fld_subcategory = tbl_sub_categories.fld_id WHERE tbl_product.fld_category = 5 LIMIT ".$offset.','.$num;
        return $this->db->query($query);
    }
    
    function select_featured_product($num=0, $offset=0){
        if($offset == 0 || $offset == NULL || $offset==''){
            $offset = 0;
        }
        $query = "SELECT tbl_product.*, tbl_categories.fld_name AS cat_name, tbl_sub_categories.fld_name AS sub_cat_name FROM tbl_product LEFT JOIN tbl_categories ON tbl_product.fld_category = tbl_categories.fld_id LEFT JOIN tbl_sub_categories on tbl_product.fld_subcategory = tbl_sub_categories.fld_id WHERE tbl_product.fld_featured = 1 LIMIT ".$offset.','.$num;
        return $this->db->query($query);
    }
    function get_product_by_id($id){
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_product')->row();
    }
    function get_attr_color_by_id($id){
        $sql = "select tbl_attribute_values.fld_value,tbl_attribute_values.fld_id from tbl_attribute_values inner join tbl_product_attribute on tbl_attribute_values.fld_id = tbl_product_attribute.fld_value where tbl_attribute_values.fld_attribute_id =3 and tbl_product_attribute.fld_product=".$id;
        return $this->db->query($sql);
    }
    function get_product_info_by_id($id){ //fld_id of the tbl_temp
        $this->db->where('fld_id',$id);
        return $this->db->get('tbl_temp');
    }
    function update_temp($data, $id){ //fld id of tbl temp
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_temp',$data);
    }
    
    
    function get_selected_upgrade_attributes_by_upgrade_id($id){
        $this->db->where('fld_upgrade_id',$id);
        return $this->db->get('tbl_lens_upgrade_attribute')->row();
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                for categories page          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////  to get products by category id here  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
    
    function get_products_by_cat_id($num=0,$offset=0,$id,$admin=0){
        $sort_by = $this->session->userdata('sort_by');
        if($offset == 0 || $offset == NULL || $offset==''){
            $offset = 0;
        }
        $query = 'SELECT tbl_product.*,tbl_sub_categories.fld_name as sub_cat FROM tbl_product LEFT JOIN tbl_sub_categories ON tbl_product.fld_subcategory = tbl_sub_categories.fld_id WHERE tbl_product.fld_category = '.$id;
        
        if($admin==0){
            $query = $query. ' AND tbl_product.fld_status = 1';
        }
        if(isset($sort_by) && $sort_by!=''){
            $query = $query .$this->get_sorting_query($sort_by);
        }
        $query = $query. " LIMIT ".$offset.','.$num;
        return($this->db->query($query));
    }
    function get_products_by_sub_cat_id($num=0,$offset=0,$id ,$admin=0){
        $sort_by = $this->session->userdata('sort_by');
//        $this->db->where('fld_subcategory',$id);
//        $admin_id = $this->session->userdata('admin_id');
//        if($admin==0){$this->db->where('fld_status',1);}
//        $this->db->limit($num, $offset);
//        return $this->db->get('tbl_product');
        
        if($offset == 0 || $offset == NULL || $offset==''){
            $offset = 0;
        }
        $query = 'SELECT tbl_product.*,tbl_categories.fld_name as sub_cat FROM tbl_product LEFT JOIN tbl_categories ON tbl_product.fld_category = tbl_categories.fld_id WHERE tbl_product.fld_subcategory = '.$id;
        
        if($admin==0){
            $query = $query. ' AND tbl_product.fld_status = 1';
        }
        if(isset($sort_by) && $sort_by!=''){
            $query = $query .$this->get_sorting_query($sort_by);
        }
        $query = $query. " LIMIT ".$offset.','.$num;
        return($this->db->query($query));
        
    }
    function count_product_by_cat_id($id,$admin=0){
        $this->db->where('fld_category',$id);
        if($admin==0){$this->db->where('fld_status',1);}
        return $this->db->get('tbl_product')->num_rows();
    }
    function select_product($pid,$admin=0)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('fld_id',$pid);
        if($admin==0){$this->db->where('fld_status',1);}
        $query = $this->db->get();
        return $query->row();
    }
    function get_product_attributes($pid)
    {
        $this->db->select('*');
        $this->db->from('tbl_product_attribute');
        $this->db->where('fld_product',$pid);
        $query = $this->db->get();
        return $query;
    }

    function insert_product_info($data){
        $this->db->insert('tbl_temp',$data);
        return $this->db->insert_id();
    }
    function get_product_from_tbl_temp_by_user($data=0){
        if($data=='asc' || $data =='desc'){
            $this->db->order_by('fld_id',$data);
        }
        $this->db->where('fld_user',$this->session->userdata('userId'));
        return($this->db->get('tbl_temp'));
    }
    function get_product_from_tbl_temp_by_id($id){
        $query = 'SELECT tbl_temp.*, tbl_product.fld_category
                FROM tbl_temp LEFT JOIN tbl_product
                ON tbl_temp.fld_product = tbl_product.fld_id
                WHERE tbl_temp.fld_id = '.$id;
        return($this->db->query($query)->row());
    }
    function update_product($pid,$info)
    {
        $this->db->where('fld_id', $pid);
        $this->db->update('tbl_product', $info); 
    }
    function get_product_images($pid)
    {
        $this->db->select('*');
        $this->db->from('tbl_product_image');
        $this->db->where('fld_product',$pid);
        $query = $this->db->get();
        return $query;
    }
    function get_product_lens_compatibility($pid)
    {
        $this->db->select('*');
        $this->db->from('tbl_product_lens_compatibility');
        $this->db->where('fld_product',$pid);
        $query = $this->db->get();
        return $query;
    }
    function select_product_image_info($pimg_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_product_image');
        $this->db->where('fld_id',$pimg_id);
        $query = $this->db->get();
        return $query->row();
    }
    function delete_product_image_($pimg_id)
    {
        $this->db->where('fld_id', $pimg_id);
        $this->db->delete('tbl_product_image');
    }
    function select_to_unlink($pid, $color, $index)
    {
//        echo $pid.'<br/>'.$color.'<br/>'.$index;exit;
        $this->db->where('fld_product', $pid);
        $this->db->where('fld_primary', $index);
        $this->db->where('fld_color', $color);
        $query = $this->db->get('tbl_product_image');
        return $query->row();
    }
    function update_product_image($pid,$index,$data)
    {
        $this->db->where('fld_product',$pid);
        $this->db->where('fld_primary', $index);
        $this->db->where('fld_color',$data['fld_color']);
        $this->db->update('tbl_product_image',$data);
    }
    function delete_product($pid)
    {
        $this->db->where('fld_id', $pid);
        $this->db->delete('tbl_product');
    }
    function get_all_product_images($pid)
    {
        return $this->db->get_where('tbl_product_image',array('fld_product'=>$pid));
    }
    function delete_all_product_images($pid)
    {
        $this->db->where('fld_product', $pid);
        $this->db->delete('tbl_product_image');
    }
    function delete_product_attributes_and_values($pid)
    {
        $this->db->where('fld_product', $pid);
        $this->db->delete('tbl_product_attribute'); 
    }
    function delete_product_compatibility($pid)
    {
        $this->db->where('fld_product', $pid);
        $this->db->delete('tbl_product_lens_compatibility');
    }
    function insert_product_image($data)
    {
        $this->db->insert('tbl_product_image',$data);
    }
    function insert_product_compatibility($lens_compatibility)
    {
        $this->db->insert('tbl_product_lens_compatibility',$lens_compatibility);
    }
    function product_types()
    {
        $query = $this->db->get('tbl_product_type');
        return $query;
    }
    function categories()
    {
        $query = $this->db->get('tbl_categories');
        return $query;
    }
    function sub_categories($cat_id)
    {
        $query = $this->db->get_where('tbl_sub_categories', array('fld_category_id' => $cat_id));
        return $query;
    }
    function extract_user_info($id)
    {
        $query = $this->db->get_where('tbl_user_login',array('fld_id'=>$id));
        return $query->row();
    }
    function select_attr_info($attr_value_id)
    {
        $sql = 'select tbl_attributes.* from tbl_attributes inner join tbl_attribute_values on tbl_attributes.fld_id = tbl_attribute_values.fld_attribute_id where fld_parent_id ='.$attr_value_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    function carriers_countries()
    {
        $sql = 'select tbl_country.* from tbl_country inner join tbl_carrier on tbl_country.fld_id=tbl_carrier.fld_country group by tbl_country.fld_id';
        $query = $this->db->query($sql);
        return $query;
    }
    function insert_temp_presc($data){
        $this->db->insert('tbl_temp_presc_entry',$data);
    }
    
    function get_product_colours($pid)
    {
        $query = 'SELECT DISTINCT b.fld_value as fld_name ,a.fld_value, p.fld_color, p.fld_product
                FROM tbl_product_image as p
                INNER JOIN tbl_attribute_values as a 
                ON a.fld_id = p.fld_color
                INNER JOIN tbl_attribute_values as b 
                ON b.fld_parent_id = p.fld_color
                WHERE p.fld_product ='.$pid;
        
        
        
//        $this->db->select('a.fld_value,p.fld_color,p.fld_product');
//        $this->db->from('tbl_product_image as p');
//        $this->db->join('tbl_attribute_values as a','a.fld_id = p.fld_color','inner');
//        $this->db->where('p.fld_prasoduct',$pid);
//        $this->db->distinct();
        
        return $this->db->query($query)->result();
    }
    
    function delete_item($id){
        if($id==0){
            $this->db->trans_start();
                $this->db->select_max('fld_id');
                $this->db->where('fld_user',$this->session->userdata('userId'));
                $max_id = $this->db->get('tbl_temp')->row()->fld_id;
                $this->db->where('fld_id', $max_id);
                $this->db->delete('tbl_temp');
            $this->db->trans_complete();
        }else{
            $this->db->where('fld_id', $id);
            $this->db->delete('tbl_temp');
        }
    }
    function delete_color_images($color,$pid){
        $this->db->trans_start();
        $this->db->where('fld_product',$pid);
        $this->db->where('fld_color',$color);
        $images = $this->db->get('tbl_product_image')->result();
        foreach($images as $img){
             unlink(getcwd().'/'.$img->fld_url.'/'.$img->fld_name);
             unlink(getcwd().'/'.$img->fld_url.'/thumbs/'.$img->fld_name);
        }
        
        $this->db->where('fld_product',$pid);
        $this->db->where('fld_color',$color);
        $this->db->delete('tbl_product_image');
        
        $this->db->where('fld_product',$pid);
        $this->db->where('fld_value',$color);
        $this->db->delete('tbl_product_attribute');
        
        $this->db->trans_complete();
    }
    function insert_accessories($data){
        $this->db->insert('tbl_accessories',$data);
        return $this->db->insert_id();
    }
    function insert_accessories_attributes($data){
        $this->db->insert('tbl_accessories_attributes',$data);
    }
    function get_all_accessories($num,$offset){
        $this->db->select('tbl_accessories.*,tbl_accessories_attributes.fld_color,tbl_accessories_attributes.fld_location,tbl_accessories_attributes.fld_image,tbl_accessories_attributes.fld_qty');
        $this->db->join('tbl_accessories_attributes','tbl_accessories_attributes.fld_accessory_id = tbl_accessories.fld_id','inner');
        $this->db->order_by('tbl_accessories.fld_id','desc');
        $this->db->limit($num,$offset);
        $this->db->group_by('tbl_accessories.fld_id');
        return $this->db->get('tbl_accessories');
    }
    function get_accessory_info($id){
        $this->db->select('tbl_accessories.*,tbl_accessories_attributes.fld_color,tbl_accessories_attributes.fld_location,tbl_accessories_attributes.fld_image,tbl_accessories_attributes.fld_qty');
        $this->db->join('tbl_accessories_attributes','tbl_accessories_attributes.fld_accessory_id = tbl_accessories.fld_id','inner');
        $this->db->order_by('tbl_accessories.fld_id','desc');
        $this->db->group_by('tbl_accessories.fld_id');
        $this->db->where('tbl_accessories.fld_id',$id);
        return $this->db->get('tbl_accessories')->row();
    }
    function get_accessory_attr($id){
        $this->db->where('fld_accessory_id',$id);
        return $this->db->get('tbl_accessories_attributes')->result();
    }
    function update_accessories($data,$id){
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_accessories',$data);
    }
    
    function edit_color_attributes($data,$id,$flag){
        if($flag == TRUE)
        {
            $this->unlink_image('fld_id',$id, 'tbl_accessories_attributes');
        }
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_accessories_attributes',$data);
    }
    
    function featured($id,$data)
    {
        $this->db->where('fld_id',$id);
        $this->db->update('tbl_product',$data);
    }
    
    function delete_accessories($id){
        $this->db->trans_start();
        
        $this->unlink_image('fld_accessory_id', $id, 'tbl_accessories_attributes');
        
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_accessories');
        
        $this->db->where('fld_accessory_id',$id);
        $this->db->delete('tbl_accessories_attributes');
        
        $this->db->trans_complete();
    }
    function delete_color_attrs($id)
    {
        $this->db->trans_start();
        $this->unlink_image('fld_id',$id, 'tbl_accessories_attributes');
        $this->db->where('fld_id',$id);
        $this->db->delete('tbl_accessories_attributes');
        $this->db->trans_complete();
    }
    function unlink_image($fld, $id, $tbl){ //for removing a single image
        $this->db->select('fld_location,fld_image');
        $this->db->where($fld,$id);
        $img = $this->db->get($tbl)->row();
        unlink(getcwd().'/'.$img->fld_location."/".$img->fld_image);
        unlink(getcwd().'/'.$img->fld_location."/thumbs/".$img->fld_image);
    }
    function count_product_by_subcat_id($id,$admin=0){
        $this->db->where('fld_subcategory',$id);
        if($admin==0){$this->db->where('fld_status',1);}
        return $this->db->get('tbl_product')->num_rows();
    }
    function get_product_qty(){
        $this->db->trans_start();
        $id = 'sess_'.$this->session->userdata('fld_id');
        $this->db->select('fld_qty');
        $this->db->where('fld_user',$id);
        $result = $this->db->get('tbl_temp');
        $qty=new stdClass();
        if($result->num_rows()>0){
            foreach($result->result() as $row){
                $qty->temp+= $row->fld_qty;
            }
        }else $qty->temp = 0;
        $this->db->select('fld_qty');
        $this->db->where('fld_user_id',$id);
        $result = $this->db->get('tbl_temp_accessories');
        if($result->num_rows()>0){
            foreach($result->result() as $row){
                $qty->accessories+= $row->fld_qty;
            }
        }else $qty->accessories = 0;
        
        $this->db->select('fld_qty');
        $this->db->where('fld_user_id',$id);
        $result = $this->db->get('tbl_temp_contact_lenses');
        if($result->num_rows()>0){
            foreach($result->result() as $row){
                $qty->contact_lenses+= $row->fld_qty;
            }
        }else $qty->contact_lenses = 0;
        $this->db->trans_complete();
        return $qty;
    }
    function change_user_id($tbl,$fld){
        $id='sess_'.$this->session->userdata('fld_id');
        $this->db->where($fld,$id);
        $this->db->update($tbl,array($fld => $this->session->userdata('userId')));
    }
    function get_cart_items_info($id){
        $cart_items=new stdClass();
        $this->db->trans_start();
        
        $this->db->select('*');
        $this->db->where('fld_user',$id);
        $cart_items->frames = $this->db->get('tbl_temp');

        $this->db->select('*');
        $this->db->where('fld_user_id',$id);
        $cart_items->accessories = $this->db->get('tbl_temp_accessories');
        
        $this->db->select('*');
        $this->db->where('fld_user_id',$id);
        $cart_items->contact_lenses = $this->db->get('tbl_temp_contact_lenses');
        
        $this->db->trans_complete();
        return $cart_items;
    }
    function get_sorting_query($sort_by){
        $query = '';
        switch($sort_by){
            case 'random':
                $query = " ORDER BY RAND() ";
                break;
            case 'asc_price':
                $query = " ORDER BY fld_sp asc ";
                break;
            case 'desc_price':
                $query = " ORDER BY fld_sp desc ";
                break;
            case 'latest':
                $query = " ORDER BY fld_id desc ";
                break;
        }
        return $query;
    }
    
}
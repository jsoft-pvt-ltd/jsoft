<?php class Wishlist_model extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    function select_product_for_wishlist($pid)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('fld_id',$pid);
        $query = $this->db->get();
        return $query->row();
    }
    function insert_wishlist($product)
    {
        $this->db->select('*');
        $this->db->from('tbl_wishlist');
        $this->db->where('fld_product',$product->fld_id);
        $this->db->where('fld_user',$this->session->userdata('userId'));
        $query = $this->db->get();
        if($query->num_rows()==0)
        {
            $data = array(
                            'fld_user'=>$this->session->userdata('userId'),
                            'fld_product'=>$product->fld_id,
                            'fld_product_type'=>$product->fld_product_type,
                            'fld_product_category'=>$product->fld_category,
                            'fld_date'=>date("Y/m/d H:i:s")
                        );
            $this->db->insert('tbl_wishlist',$data);
            return "true";
        }
        else if($query->num_rows()<>0)
        {
            return "false";
        }
                
        
    }
    function select_all_my_wishlist($user)
    {
//        $this->db->select('*');
//        $this->db->from('tbl_wishlist');
//        $this->db->where('fld_user',$user);
//        $query = $this->db->get();
//        return $query;
        $sql = 'select tbl_product.*,tbl_wishlist.fld_id as wishlist_id from tbl_product inner join tbl_wishlist on tbl_product.fld_id = tbl_wishlist.fld_product where tbl_wishlist.fld_user = '.$user;
        $query = $this->db->query($sql);
        return $query;
    }
    function delete_product_from_wishlist($wishlist_id)
    {
        $this->db->delete('tbl_wishlist', array('fld_id' => $wishlist_id)); 
    }
}
?>

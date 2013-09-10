<?php class Order_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function count_orders()
    {
        $query = $this->db->get('tbl_order');
        return $query->num_rows();
    }
    function orders($num,$offset)
    {
        $this->db->select('*');
        $this->db->from('tbl_order');
        $this->db->limit($num,$offset);
        $this->db->order_by('fld_id','desc');
        $query = $this->db->get();
        return $query;
    }
    function count_search_orders($sql)
    {   
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    function search_orders($num,$offset,$sql)
    {
        if($offset=="")
        {
            $offset=0;
        }
        $sql = $sql." order by fld_id desc limit " .$offset . "," . $num;
        $query = $this->db->query($sql);
        return $query;
    }
    function delete_order($order_id)
    {
        $this->db->trans_start();
        $this->db->where('fld_id',$order_id);
        $this->db->delete('tbl_order');
        $this->db->where('fld_order',$order_id);
        $this->db->delete('tbl_order_item');
        $this->db->trans_complete();
                
    }
    function order_info($order_id)
    {
        $query = $this->db->get_where('tbl_order',array('fld_id'=>$order_id));
        return $query->row();
    }
    function order_items($order_id)
    {
        $query = $this->db->get_where('tbl_order_item',array('fld_order'=>$order_id));
        return $query;
    }
    function get_prescription_info($id){
        $this->db->where('fld_id',$id);
        return ($this->db->get('tbl_presc_entry')->row());
    }
}
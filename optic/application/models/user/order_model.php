<?php class Order_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function count_orders($user)
    {
        $query = $this->db->get_where('tbl_order', array('fld_user' => $user));
        return $query->num_rows();
    }
    function orders($limit,$offset,$user)
    {
       //$query = $this->db->get_where('tbl_order', array('fld_user' => $user), $limit, $offset);
       $this->db->select('*');
       $this->db->from('tbl_order');
       $this->db->where('fld_user',$user);
       $this->db->order_by('fld_id','desc');
       $this->db->limit($limit,$offset);
       $query = $this->db->get();
       return $query;
    }
}
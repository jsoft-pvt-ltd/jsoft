<?php class Promocode_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function check_promocode($promocode)
    {
        $query = $this->db->get('tbl_promocode');
        foreach($query->result() as $row)
        {
            $db_promocode="";
            $db_promo_code = explode(" ",$row->fld_promocode);
            for($i=0;$i<sizeof($db_promo_code);$i++){
                $db_promocode = $db_promocode.$db_promo_code[$i]."_";
            }
            $db_promocode = substr($db_promocode, 0,-1);
            $db_promocode = strtolower($db_promocode);
            
            if($promocode===$db_promocode)
            {
                return $row;
            }
        }
        return "nomatch";
    }
    function select_category($cat_id){
        $query = $this->db->get_where('tbl_categories',array('fld_id'=>$cat_id));
        return $query->row();
    }
    function get_total_cart_items(){
        $this->db->where('fld_user',$this->session->userdata('userId'));
        return $this->db->get('tbl_temp')->num_rows();
    }
}
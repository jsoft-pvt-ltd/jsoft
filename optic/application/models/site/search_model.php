<?php class Search_model extends CI_Model{
     public function __construct() {
         parent::__construct();
     }
     function count_search_product($sql)
     {
        $query = $this->db->query($sql);
        return $query->num_rows();
     }
     function search_product($num,$offset,$sql)
     {
         if($offset=="")
         {
             $offset=0;
         }
         
         $sql = $sql." limit " .$offset . "," . $num;
         $query = $this->db->query($sql);
         return $query;
     }
}
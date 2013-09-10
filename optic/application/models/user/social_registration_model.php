<?php

class Social_registration_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function SocialUserRegistration($username)
    {
//        $me = $this->session->userdata('me');
////        print_r($me);
//              
//        $query = $this->db->get_where('tbl_user_login', array('fld_username' => $username));
//        if($query->num_rows()>0)
//        {
//            return 0;
//        }
//        else
//        {
//            $data = array(
//                            'fld_username'   => $username,
//                            'fld_first_name' => $me['first_name'],
//                            'fld_last_name'  => $me['last_name'],
//                            'fld_email'      => $me['email']
//                        );
//            $this->db->insert('tbl_user_login', $data);
//        
//            $id = $this->db->insert_id();
//            if($id>0)
//            {
//                $data = array(
//                                'fld_user_id' => $id,
//                                'fld_signature' => $this->session->userdata('userSocialId'), 
//                                'fld_service'=> $this->session->userdata('service'),
//                                'fld_profile_url' => $me['link']
//                        );
//                $this->db->insert('tbl_user_social_login', $data);
//                return $id;
//            }
//        }
        
    }
}
?>
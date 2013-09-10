<?php
class Social_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function CheckSocialLogin($signature,$service)
    {
        $query = $this->db->get_where('tbl_user_social_login', array('fld_signature' => $signature,'fld_service'=>$service));
        return $query->row();
    }
    function Register_($username)
    {
        $query = $this->db->get_where('tbl_user_login', array('fld_username' => $username));
        if($query->num_rows()>0)
        {
            return 0;
        }
        else
        {
            $me = $this->session->userdata('me');
            $query_email = $this->db->get_where('tbl_user_login', array('fld_email' => $me['email']));
            if($query_email->num_rows()>0)
            {
                return "email";
            }
            else
            {
                $me = $this->session->userdata('me');
                $data = array(
                                'fld_username'   => $username,
                                'fld_first_name' => $me['first_name'],
                                'fld_last_name'  => $me['last_name'],
                                'fld_email'      => $me['email'],
                                'fld_date_registered'=>date("Y/m/d H:i:s")
                );
                $this->db->insert('tbl_user_login', $data);
                $id = $this->db->insert_id();
                if($id>0)
                {
                    $data = array(
                                    'fld_user_id' => $id,
                                    'fld_signature' => $this->session->userdata('userSocialId'), 
                                    'fld_service'=> $this->session->userdata('service'),
                                    'fld_profile_url' => $me['link']
                            );
                    $this->db->insert('tbl_user_social_login', $data);

                    //to give notice to admin that a new user has registered.
                    //inserts the user id into tbl_acc_notice;
                    $user['fld_user']=$id;
                    $user['fld_date']=date("Y/m/d H:i:s");
                    $this->load->model('user/login_model');
                    $this->login_model->acc_notice($user);

                    return $id;

                }
            
            }
        }
    }

    function ConnectSignature($data)
    {
        $this->db->insert('tbl_user_social_login', $data);
    }
    function SelectUserInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_user_login');
        $this->db->where('fld_id',$userId);
        $query = $this->db->get();
        return $query->row();
    }
}
?>

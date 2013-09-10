<?php class Role extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/role_model');
        $this->load->model('admin/privilege_model');
        $this->load->model('admin/user_model');
    }
    function index()
    {
        $this->load->helper('login_helper');admin_log();
        $data['roles']=$this->role_model->select_role();
        $data['title']="Role";
        $data['page']="admin/view_role";
        $this->load->view('admin/container',$data);
    }
    function insert()
    {
        $this->load->helper('login_helper');admin_log();
        $data['modules']=$this->privilege_model->select_modules();
        $data['title']="Add Role";
        $data['page']="admin/add_role";
        $this->load->view('admin/container',$data);
        
    }
    function create()
    {
        $this->load->helper('login_helper');admin_log();
        
        if($this->input->post('privilege'))
        {
            $role_id = $this->role_model->insert_role($this->input->post('role'));//returns the inserted role id
            $privileges = $this->input->post('privilege');
            $flag=0;$count=0;
            foreach($privileges as $privilege)
            {
                $temp = explode("_", $privilege);
                if($flag!=$temp[1])
                {
                    $temp_count[$count] = $temp[1];$count++;
                }
                $flag = $temp[1];

            }
            for($i=0;$i<sizeof($temp_count);$i++)
            {
                $data['fld_role_id']=$role_id;
                $data['fld_module_id']=$temp_count[$i];
                foreach($privileges as $privilege)
                {
                    $temp = explode("_", $privilege);

                    if($temp[0]=="insert"){ $data['fld_insert']=1;  }
                    if($temp[0]=="update"){ $data['fld_update']=1;  }
                    if($temp[0]=="delete"){ $data['fld_delete']=1;  }
                    if($temp[0]=="view")  { $data['fld_view']=1;    }
                }
                $this->privilege_model->insert_privilege($data);
                $this->session->set_flashdata('msg','New role is sucessfully added');
                redirect(base_url().'admin/role');
            }
        }
        else
        {
            $data['modules']=$this->privilege_model->select_modules();
            $data['title']="Add Role";
            $data['page']="admin/add_role";
            $data['error_message'] = "New role cannot be added because none prvileges were checked. Please check at least one privilege.";
            $this->load->view('admin/container',$data);
         }
    }
    function edit($role_id)
    {
        $this->load->helper('login_helper');admin_log();
        $data['role']=$this->role_model->select_role($role_id);
        $data['privilege_modules']=$this->privilege_model->select_modules();
        $data['title']="Edit Role";
        $data['page']="admin/edit_role";
        $this->load->view('admin/container',$data);
    }
    function update($role_id)
    {
        $this->load->helper('login_helper');admin_log();
        $this->role_model->update_role($role_id,$this->input->post('role'));
        $this->privilege_model->delete_privilege($role_id);
        $privileges = $this->input->post('privilege');
        $flag=0;$count=0;
        foreach($privileges as $privilege)
        {
            $temp = explode("_", $privilege);
            if($flag!=$temp[1])
            {
                $temp_count[$count] = $temp[1];$count++;
            }
            $flag = $temp[1];
            
        }
        for($i=0;$i<sizeof($temp_count);$i++)
        {
            $data['fld_role_id']=$role_id;
            $data['fld_module_id']=$temp_count[$i];
            foreach($privileges as $privilege)
            {
                $temp = explode("_", $privilege);
                              
                if($temp[0]=="insert"){ $data['fld_insert']=1;  }
                if($temp[0]=="update"){ $data['fld_update']=1;  }
                if($temp[0]=="delete"){ $data['fld_delete']=1;  }
                if($temp[0]=="view")  { $data['fld_view']=1;    }
            }
            $this->privilege_model->insert_privilege($data);
        }
        $this->session->set_flashdata('msg','The updation is sucessfully done.');
        redirect(base_url().'admin/role',$data);
    }
    function delete($role_id)
    {
        $this->load->helper('login_helper');admin_log();
        $this->role_model->delete_role($role_id);
        $this->privilege_model->delete_privilege($role_id);
//        $this->user_model->update_user($role_id);
        $this->user_model->delete_user($role_id);
        $this->session->set_flashdata('msg','The role is successfully deleted.');
        redirect(base_url().'admin/role');
    }
}
?>
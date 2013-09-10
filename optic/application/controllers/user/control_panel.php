<?php
class Control_panel extends CI_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('user/control_panel_model');
            $this->load->model('user/login_model');
            $this->load->library('folders');
            $this->load->helper('login_helper');
       }
       public function index()
       {
           if(IsLoggedIn()!=1)
           {
               redirect(base_url().'user/login');
           }
           $data['userInfo'] = $this->control_panel_model->ExtractUserInfo($this->session->userdata('userId'));
           $data['username'] = $data['userInfo']->fld_username;
           $data['title'] = 'Dashboard';
           $data['page'] = 'user/dashboard';
           $data['userId'] = $this->session->userdata('userId');
           $data['msg'] = $this->session->flashdata('msg');
           $this->load->view('user/container',$data);
       }
       function EditBasicInfo()
       {
           if(IsLoggedIn()!=1)
           {
               redirect(base_url().'user/login');
           }
           $userId = $this->session->userdata('userId');
           $data = array(
                            'fld_username'  =>$this->input->post('fld_username'),
                            'fld_first_name'=>$this->input->post('fld_first_name'),
                            'fld_last_name' =>$this->input->post('fld_last_name'),
                            'fld_email'     =>$this->input->post('fld_email'),
                            'fld_country'  =>$this->input->post('fld_country'),
                            'fld_state'  =>$this->input->post('fld_state'),
                            'fld_city'  =>$this->input->post('fld_city'),
                            'fld_contact_no'  =>$this->input->post('fld_contact_no'),
                            'fld_myself'  =>$this->input->post('fld_myself')
                            
           );
           $this->control_panel_model->EditBasicInfo_($userId,$data);
           $this->session->set_flashdata('msg','Your basic information is sucessfully updated.');
           redirect(base_url().'user/control_panel/index');
                   
       }
       function ProfilePic()
       {
           if(IsLoggedIn()!=1)
           {
               redirect(base_url().'user/login');
           }
           if($_FILES)
           {
               $destination='images/'.date("Y").'/'.date("m");
               $this->folders->makeDirectory(date('d'), $destination);
               $destination = $destination.'/'. date('d'); 
               $files=$_FILES;
               $imageNames = $this->folders->uploadFiles($files, $destination);
               $imageName = $imageNames[0];
               if(!empty($imageName))
               {
                   $data['fld_profile_pic'] = $imageName;
                   $data['fld_profile_pic_url'] = $destination;
                   $this->login_model->EditToActivateAccount($this->session->userdata('userId'),$data);
                   $this->session->set_flashdata('message', 'Profile pic successfully uploaded.');
               }
               
           }
           $data['title'] = "Profile Picture";
           $data['page']  = "user/profile_pic";
           $this->load->view('user/container',$data);
        }
        function ProfilePicEdit()
        {
            if(IsLoggedIn()!=1)
           {
               redirect(base_url().'user/login');
           }
            $this->load->helper('login_helper');
            $profilePicInfo = CheckProfilePicture();
            if(!empty($profilePicInfo))
            {
                unlink(getcwd().'/'.$profilePicInfo->fld_profile_pic_url.'/'.$profilePicInfo->fld_profile_pic);
                unlink(getcwd().'/'.$profilePicInfo->fld_profile_pic_url.'/thumbs/'.$profilePicInfo->fld_profile_pic);
            }
            $destination='images/'.date("Y").'/'.date("m");
            $this->folders->makeDirectory(date('d'), $destination);
            $destination = $destination.'/'. date('d'); 
            $files=$_FILES;
            $imageNames = $this->folders->uploadFiles($files, $destination);
            $imageName = $imageNames[0];
            if(!empty($imageName))
            {
                $data['fld_profile_pic'] = $imageName;
                $data['fld_profile_pic_url'] = $destination;
                $this->login_model->EditToActivateAccount($this->session->userdata('userId'),$data);
                $this->session->set_flashdata('message', 'Profile picture updated successfully.');
            }
            redirect(base_url().'user/control_panel/ProfilePic');
        }
        function change_password()
        {
            if(IsLoggedIn()!=1)
           {
               redirect(base_url().'user/login');
           }
            if($this->input->post())
            {
                if($this->input->post('fld_current_password'))
                {
                    $result = $this->control_panel_model->CheckForPassword($this->input->post('fld_current_password'));
                    if(isset($result->fld_id))
                    {
                        if($this->input->post('fld_new_password'))
                        {
                            if($this->input->post('fld_confirm_new_password'))
                            {
                                if($this->input->post('fld_new_password') == $this->input->post('fld_confirm_new_password'))
                                {
                                    $data = array(
                                                    'fld_password'=>md5($this->input->post('fld_new_password'))
                                            );
                                    $this->load->model('user/login_model');
                                    $this->login_model->EditToActivateAccount($this->session->userdata('userId'),$data);
                                    $data['success_message'] = "Your password has been successfully changed.";
//                                    $this->output->enable_profiler(TRUE);
                                }
                                else
                                {
                                    $data['error_message']="Passwords did not match.";
                                }
                            }
                            else
                            {
                                $data['error_message']="Confirm password is required.";
                            }
                        }
                        else
                        {
                            $data['error_message'] = "New password is required. ";
                        }
                    }
                    else
                    {
                        $data['error_message'] = "Your current password did not match.";
                    }
                }
                else
                {
                    $data['error_message'] = "Current password is required.";
                }

            }
            $data['username'] = $this->session->userdata('username');
            $data['title'] = 'Change Password';
            $data['page'] = 'user/change_password';
            $this->load->view('user/container',$data);
        }
}
?>

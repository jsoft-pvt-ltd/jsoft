<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of my_prescription
 *
 * @author user
 */
class my_prescription extends CI_Controller{
    public $flag = 0;
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->helper('login_helper');
        if(IsLoggedIn()){
            $data['title'] = "My Prescription";
            $this->load->model('user/my_prescription_model');
            $data['my_prescs'] = $this->my_prescription_model->get_my_prescription_by_user();
            $data['msg'] = $this->session->flashdata('msg');
            $this->load->view('site/header',$data);
            $this->load->view('user/my_prescription');
            $this->load->view('site/footer');
        }
        else redirect(base_url().'user/login');
    }
    function presc_uploader(){
        if($_FILES && $_FILES['prescription_upload']['error']==0){
            $this->load->library('folders');
            $this->folders->makeDirectory(date('d'),'prescriptions/'.date('Y').'/'.date('m'));
            $data['fld_patient_name'] = $_POST['patient_name'];
            $file_name = $this->folders->upload_files($_FILES, 'prescriptions/'.date('Y').'/'.date('m').'/'.date('d'));
            $data['fld_prescription_path'] = 'prescriptions/'.date('Y').'/'.date('m').'/'.date('d').'/'.$file_name;
            $data['fld_user'] = $this->session->userdata('userId');
            $this->load->model('user/my_prescription_model');
            $this->my_prescription_model->insert_presc($data);
            $this->session->set_flashdata('msg','Prescription uploaded successfully');
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }
    function insert_prescription(){
        $data=array(
            'fld_user' => $this->session->userdata('userId'),
            'fld_sph_od' => $_POST['sph_od'],
            'fld_sph_os' => $_POST['sph_os'],
            'fld_cyl_od' => $_POST['cyl_od'],
            'fld_cyl_os' => $_POST['cyl_os'],
            'fld_axis_od' => $_POST['axis_od'],
            'fld_axis_os' => $_POST['axis_os'],
            'fld_add_od' => $_POST['add_od'],
            'fld_add_os' => $_POST['add_os'],
            'fld_power_od' => $_POST['power_od'],
            'fld_power_os' => $_POST['power_os'],
            'fld_patient_name' => $_POST['patient_name'],
            'fld_pd' => $_POST['pd'],
            'fld_pd_right' => $_POST['pd_right'],
            'fld_pd_left' => $_POST['pd_left'],
            'fld_remarks' => $_POST['remarks']
        );
        $this->load->model('user/my_prescription_model');
        $this->my_prescription_model->insert_presc($data);
    }
}

?>

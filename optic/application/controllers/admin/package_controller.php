<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lens_package_controller
 *
 * @author user
 */
class package_controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/package_model');
        $this->load->model('admin/package_upgrade_model');
        $this->load->model('admin/package_attributes_model');
    }
    function index(){
        $this->load->helper('login_helper');admin_log();
        $data['title']="Lens Packages";
        $data['packages'] = $this->package_model->get_all_package();
        $data['attributes_id'] = $this->package_model->get_all_package_attributes_value_id();
        $data['upgrade_ids']=$this->package_upgrade_model->get_all_lens_package_upgrades();
        $data['attributes'] = $this->package_attributes_model->get_all_package_attributes();
        $data['package_upgrades']=$this->package_upgrade_model->get_all_package_upgrades();
        $this->load->view('admin/header',$data);
        $this->load->view('admin/package');
        $this->load->view('admin/footer');
    }
    function insert_package(){
        $this->load->helper('login_helper');admin_log();
        $temp = explode(' ',$_POST['temp_name']);
        if(sizeof($temp)>1) $temp = end($temp);
        else $temp='';
        $data = array(
            'fld_name'=>$_POST['name'],
            'fld_price'=>$_POST['price'],
            'fld_min'=>$_POST['min'],
            'fld_max'=>$_POST['max'],
            'fld_temp_name'=>$_POST['temp_name'],
            'fld_cyl_range'=>$_POST['cyl_range'],
            'fld_description'=>$_POST['description'],
            'fld_title' => $temp
        );
        $this->db->trans_start();
        $last_id = $this->package_model->insert_package($data);
        $data_attr['fld_package_id']=$last_id;
        $data_upgr['fld_package_id']=$last_id;
        foreach(array_keys($_POST['value']) as $key){
            $data_attr['fld_lens_package_attribute_id'] = $_POST['value'][$key];
            $flag=false;
            if($flag==false){
                foreach(array_keys($_POST['in_visibility']) as $keys){
                    $temp='';
                    $temp = $_POST['in_visibility'][$keys];
                    $temp = explode("_", $temp);
                    $id = $temp[0];
                    if($_POST['value'][$key] == $id && $flag==false){
                        $data_attr['fld_display']=$temp[1];
                        $flag=true;
                    }
                }
            }
            $this->package_model->insert_package_attribute_value($data_attr);
        }
        foreach(array_keys($_POST['upgrades']) as $key){
            $data_upgr['fld_lens_upgrade_id'] = $_POST['upgrades'][$key];
            $this->package_upgrade_model->insert_package_upgrade_value($data_upgr);
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Lens Package successfully inserted");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function edit_package($id){
        $this->load->helper('login_helper');admin_log();
        $temp = explode(' ',$_POST['edit_temp_name']);
        if(sizeof($temp)>1) $temp = end($temp);
        else $temp='';
        $data = array(
            'fld_name'=>$_POST['edit_name'],
            'fld_price'=>$_POST['edit_price'],
            'fld_min'=>$_POST['edit_min'],
            'fld_max'=>$_POST['edit_max'],
            'fld_temp_name'=>$_POST['edit_temp_name'],
            'fld_cyl_range'=>$_POST['edit_cyl_range'],
            'fld_description'=>$_POST['edit_description']
        );
        $this->db->trans_start();
        $last_id = $this->package_model->update_package($data,$id);
        $data_attr['fld_package_id']=$id;
        $data_upgr['fld_package_id']=$id;
        $this->package_model->delete_package_attribute_value($id);
        $this->package_upgrade_model->delete_package_attribute_value($id);//this deleates the lens packages
        foreach(array_keys($_POST['edit_package_attr']) as $key){
            $data_attr['fld_lens_package_attribute_id'] = $_POST['edit_package_attr'][$key];
            $flag=false;
            if($flag==false){
                foreach(array_keys($_POST['visibility']) as $keys){
                    $temp='';
                    $temp = $_POST['visibility'][$keys];
                    $temp = explode("_", $temp);
                    $id = $temp[0];
                    if($_POST['edit_package_attr'][$key] == $id && $flag==false){
                        $data_attr['fld_display']=$temp[1];
                        $flag=true;
                    }
                }
            }
            $this->package_model->insert_package_attribute_value($data_attr);
        }
        $this->package_upgrade_model->delete_package_attribute_value($id);
        foreach(array_keys($_POST['edit_upgrades']) as $key){
            $data_upgr['fld_lens_upgrade_id'] = $_POST['edit_upgrades'][$key];
            $this->package_upgrade_model->insert_package_upgrade_value($data_upgr);
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Lens Package successfully updated");</script>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function delete_package($id){
        $this->package_model->delete_package($id);
        $this->package_model->delete_package_attribute_value($id);
        $this->package_upgrade_model->delete_package_attribute_value($id);
    }
    
    function get_package_infos($id){
        echo json_encode($this->package_model->get_package_infos_by_id($id));
    }
    function get_package_attrs($id){
        echo json_encode($this->package_model->get_package_attrs_by_id($id));
    }
}
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categories_controller
 *
 * @author user
 */
class Category extends CI_Controller{
        function __construct() {
        parent::__construct();
        $this->load->model('site/categories_model');
        $this->load->model('site/sub_categories_model');
        $this->load->library('folders');
        header("Cache-Control: no-cache, must-revalidate");
        
    }
    function index()
    {
        $this->load->helper('login_helper');admin_log();
        $data['msg']=$this->session->flashdata('msg');
        $data['categories']=$this->categories_model->get_all_categories();
        if($data['categories']->num_rows()!=0){
            $data['sub_categories']=$this->sub_categories_model->get_all_sub_categories();
        }
        $data['title']="Categories";
        $data['page']="admin/categories";
        $this->load->view('admin/container',$data);
    }
    function insert_categories($id=0){
        $this->load->helper('login_helper');admin_log();
        $this->db->trans_start();
        $max_rank = $this->categories_model->get_max_rank();
        $max_rank+=1;
        $data_cat['fld_name']=$_POST['name'];
        $data_cat['fld_description']=$this->input->post('description');
        $data_cat['fld_rank']=$max_rank;
        $data_cat['fld_status']=1;
        
        $this->folders->makeDirectory(date('d'), 'images/'.date("Y").'/'.date("m"));
        $image['cat']=$_FILES['cat_image'];
        $fld_image = $this->folders->uploadFiles($image, 'images/'.date("Y").'/'.date("m").'/'.date("d"));
        $data_cat['fld_location'] = 'images/'.date("Y").'/'.date("m").'/'.date("d").'/';
        $data_cat['fld_image'] = $fld_image[0];
        $cat_id = $this->categories_model->insert_category($data_cat);
//        print_r($_FILES['subcat_image_new']);exit;
        $image_sub['sub']=$_FILES['subcat_image_new'];
        $images_names=$this->folders->uploadFiles($image_sub, $data_cat['fld_location']);
        foreach(array_keys($_POST['sub_name_new']) as $key) {
            if(!empty($_POST['sub_name_new'][$key])){
//                echo $_POST['sub_name_new'][$key];
                $max_rank = $this->sub_categories_model->get_max_rank_by_cat_id($cat_id);
                $max_rank+=1;
                $data_sub_cat= array(
                    'fld_name' => $_POST['sub_name_new'][$key],
                    'fld_description' => $_POST['sub_description_new'][$key],
                    'fld_category_id' => $cat_id,
                    'fld_rank'=>$max_rank,
                    'fld_status'=>$_POST['sub_status'][$key],
                    'fld_location'=>$data_cat['fld_location'],
                    'fld_image'=>$images_names[$key]
                );
                $this->sub_categories_model->insert_sub_category_values($data_sub_cat);
            }
        }
//        exit;
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Categories and its value succcessfully inserted.")</script>');
        redirect($_SERVER["HTTP_REFERER"]);
    }
    
    function interchange_rank($rank,$pos,$id=0,$sub_cid=0){ //$Id is the category id for sub categories and is optional $sub_cid is subcategory id
        echo 'heoo';
        print_r($this->output);
        echo "anjin";
        if($id!=0){
            $this->sub_categories_model->interchange_rank($rank,$pos,$id, $sub_cid);
        }
        else $this->categories_model->interchange_rank($rank,$pos);
        
    }
    function get_max_rank($id=0){
        echo $this->categories_model->get_max_rank($id);
    }
    function get_categories_n_subs_by_id($id){ ///this is category id;
        header('Content-type: application/javascript');
        $data['categories'] = $this->categories_model->get_categories_by_id($id);
        $data['sub_categories'] = $this->sub_categories_model->get_sub_categories_by_cat_id($id);
        echo json_encode($data);
    }
    function edit_categories($id){
//            echo '<pre>';
//            print_r($_POST);
//            exit;
        $this->load->helper('login_helper');admin_log();
        if($_FILES['image']['size'] == 0){
        $data_cat = array(
            'fld_name' => $_POST['name'],
            'fld_description'=> $_POST['description'],
            'fld_status'=>$_POST['status']
        );
        }else if($_FILES['image']['size']>0){
           $this->folders->makeDirectory(date('d'), 'images/'.date("Y").'/'.date("m"));
           $image['cat']=$_FILES['image'];
           $fld_image = $this->folders->uploadFiles($image, 'images/'.date("Y").'/'.date("m").'/'.date("d"));
           $data_cat = array(
                'fld_name' => $_POST['name'],
                'fld_description'=> $_POST['description'],
                'fld_status'=>$_POST['status'],
                'fld_location'=>'images/'.date("Y").'/'.date("m").'/'.date("d").'/',
                'fld_image'=>$fld_image[0]
            ); 
        }
        
        $this->db->trans_start();
        
        $this->categories_model->edit_categories($data_cat,$id);
        $flag = FALSE;
        $flag1= FALSE;
        foreach($_FILES['subcat_image_old']['name'] as $key=>$img)
        {
            if(strlen(trim($img))>0)$flag = TRUE;
        }
        
        if(isset($_FILES['subcat_image_new'])){
            foreach($_FILES['subcat_image_new']['name'] as $key=>$img)
            {
                if(strlen(trim($img))>0)$flag1 = TRUE;
            }
        }
        if($flag == TRUE)
        {
            $files = $_FILES['subcat_image_old'];
            $this->edit_with_image($files,$id);
        }else{
            $this->edit_without_image($id);
        }
        if($flag1 == TRUE)
        {
            $files = $_FILES['subcat_image_new'];
            $this->edit_with_new_image($files,$id);
        }
        $this->db->trans_complete();
        redirect($_SERVER["HTTP_REFERER"]);
    }
    
    function edit_without_image($id)
    {
        foreach(array_keys($_POST['sub_name']) as $key) { //managing child
            if(!empty($_POST['sub_cat_id'][$key])){
                if(empty($_POST['sub_name'][$key])){
                    $this->sub_categories_model->delete_sub_category($_POST['sub_cat_id'][$key]);
                }
                $data_sub_cat= array(
                    'fld_name' => $_POST['sub_name'][$key],
                    'fld_description' => $_POST['sub_description'][$key],
                    'fld_category_id'=>$id,
                    'fld_status'=>$_POST['sub_status'][$key]
                );
                $this->sub_categories_model->edit_sub_categories($data_sub_cat,$_POST['sub_cat_id'][$key]); //data, id[category id]
            }
            else{
                $max_rank = $this->sub_categories_model->get_max_rank_by_cat_id($id);
                $max_rank+=1;
                $data_sub_cat= array(
                    'fld_name' => $_POST['sub_name'][$key],
                    'fld_description' => $_POST['sub_description'][$key],
                    'fld_category_id'=>$id,
                    'fld_rank'=>$max_rank,
                    'fld_status'=>$_POST['sub_status'][$key]
                );
                $this->sub_categories_model->insert_sub_category_values($data_sub_cat);
            }
        }
    }
    
    function edit_with_image($files,$id)
    {
        $image_sub['sub']=$files;
        $location = 'images/'.date("Y").'/'.date("m").'/'.date("d").'/';
        $subcat_image_names=$this->folders->uploadFiles($image_sub, $location);
        foreach(array_keys($_POST['sub_name']) as $key=>$value) { //managing child
            if(empty($_POST['sub_name'][$key])){
                $this->sub_categories_model->delete_sub_category($_POST['sub_cat_id'][$key]);
            }
            if(strlen($subcat_image_names[$key])==0){
                $data_sub_cat= array(
                    'fld_name' => $_POST['sub_name'][$key],
                    'fld_description' => $_POST['sub_description'][$key],
                    'fld_category_id'=>$id,
                    'fld_status'=>$_POST['sub_status'][$key]
                );
            }else{
                $data_sub_cat= array(
                'fld_name' => $_POST['sub_name'][$key],
                'fld_description' => $_POST['sub_description'][$key],
                'fld_category_id'=>$id,
                'fld_status'=>$_POST['sub_status'][$key],
                'fld_location'=>$location,
                'fld_image'=>$subcat_image_names[$key]
            );
            }
        $this->sub_categories_model->edit_sub_categories($data_sub_cat,$_POST['sub_cat_id'][$key]); //data, id[category id]
        }
    }
    function edit_with_new_image($files, $id)
    {
        $max_rank = $this->categories_model->get_max_rank();
        $max_rank+=1;
        $image_sub['sub']=$files;
        $location = 'images/'.date("Y").'/'.date("m").'/'.date("d").'/';
        $subcat_image_names=$this->folders->uploadFiles($image_sub, $location);
        foreach(array_keys($_POST['sub_name_new']) as $key=>$value) { 
//            if($_POST['sub_name_new'][$key]!=''){
                $max_rank = $this->sub_categories_model->get_max_rank_by_cat_id($id);
                $max_rank+=1;
                if(strlen($subcat_image_names[$key])==0){
                    $data_sub_cat= array(
                    'fld_name' => $_POST['sub_name_new'][$key],
                    'fld_description' => $_POST['sub_description_new'][$key],
                    'fld_category_id'=>$id,
                    'fld_rank'=>$max_rank,
                    'fld_status'=>$_POST['sub_status'][$key]
                );
                }else{
                    $data_sub_cat= array(
                    'fld_name' => $_POST['sub_name_new'][$key],
                    'fld_description' => $_POST['sub_description_new'][$key],
                    'fld_category_id'=>$id,
                    'fld_rank'=>$max_rank,
                    'fld_status'=>$_POST['sub_status'][$key],
                    'fld_location'=>$location,
                    'fld_image'=>$subcat_image_names[$key]
                );
                $data_sub_cat['fld_rank']=$max_rank;
                }
                $this->sub_categories_model->insert_sub_category_values($data_sub_cat); //data, id[category id]
//            }
        }
    }
    
    function delete_categories($id){
        $this->load->helper('login_helper');admin_log();
        $max_rank = $this->categories_model->get_max_rank();
        $rank = $this->categories_model->get_rank_by_id($id);
        $cat_id=array();
        for($i=$rank;$i<=$max_rank;$i++){
            $cat_id[] = $this->categories_model->get_id_by_rank($i);
        }
        
        foreach($cat_id as $key=>$val) {
            $rank = $this->categories_model->get_rank_by_id($val);
            $data['fld_rank']= $rank-1;
            $this->update_rank($val,$data);
        }
         
        $this->categories_model->delete_category($id);
    }
    function update_rank($val, $data){
        $this->categories_model->update_rank($val,$data);
    }
    function delete_sub_category($id){
        $this->sub_categories_model->delete_sub_category($id);
    }
    
    function delete_image($id)
    {
        $image = $this->categories_model->get_image_by_id($id);
        //echo $image->fld_location.$image->fld_image;
        unlink(getcwd().'/'.$image->fld_location.$image->fld_image);
        unlink(getcwd().'/'.$image->fld_location.'thumbs/'.$image->fld_image);
    }
    
    function delete_subcat_image($id)
    {
        $subcat_image = $this->sub_categories_model->get_image_by_id($id);
        unlink(getcwd().'/'.$subcat_image->fld_location.$subcat_image->fld_image);
        unlink(getcwd().'/'.$subcat_image->fld_location.'thumbs/'.$subcat_image->fld_image);
    }
}

?>

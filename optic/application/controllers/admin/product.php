<?php class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/product_model');
    }
    function index()
    {
        $this->load->helper('login_helper');admin_log();
        $config['base_url'] = base_url().'admin/product/index';
        $config['total_rows'] = $this->product_model->count();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $this->load->library('pagination');
        $this->pagination->initialize($config); 
        $data['products'] = $this->product_model->select($config['per_page'],$this->uri->segment(4));
        $data['pagination'] = $this->pagination->create_links();
        $data['title']="Products | Optical Store Online";
        $data['page']="admin/products";
        $this->load->view('admin/container',$data);
    }
    function insert($id=4)
    {
        $this->load->helper('login_helper');admin_log();
        if($id!=0)
        {
            if($id==2){
                redirect(base_url().'admin/product/add_accessories/');
            }
            if($id==4){$data['size'] = 'size';}
            $data['product_type_id']=$id;
            $data['vendors'] = $this->product_model->get_vendors($id);
            $data['product_type']=$this->product_model->get_product_type_by_id($id);
            $data['attributes']=$this->product_model->get_attributes_by_product_type($id);
            $data['attributes_values']=$this->product_model->get_all_attribute_values_by_attr_ids($data['attributes']);
        }
        $data['page'] = "admin/add_product";
        $data['title'] = "Add Product";
        $data['product_types'] = $this->product_model->product_types();
        $data['categories']=$this->product_model->categories();
        $data['compatibilities']=$this->product_model->lens_types();//actually lens_type is compatibility
        $this->load->view('admin/container',$data);
    }
    function add_accessories($id = 0){
        $this->load->helper('login_helper');admin_log();
        if($id!=0){
            $data['edit_accessory'] = $this->product_model->get_accessory_info($id);
            $data['edit_attr'] = $this->product_model->get_accessory_attr($id);
            $data['title'] = "Edit ".$data['edit_accessory']->fld_name;
        }
        else $data['title'] = "Add Accessories";
        $data['msg_acc'] = $this->session->flashdata('msg');
        $data['page'] = "admin/add_accessories";
        $data['product_type_id']=2;
        $data['product_types'] = $this->product_model->product_types();
        
        $config['base_url'] = base_url().'admin/product/add_accessories/';
        $config['total_rows'] = $this->product_model->count();
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $this->load->library('pagination');
        $this->pagination->initialize($config); 
        $data['accessories'] = $this->product_model->get_all_accessories($config['per_page'],$this->uri->segment(5));
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('admin/container',$data);
    }
    function insert_accessories(){
        $this->load->helper('login_helper');admin_log();
        $CI=&get_instance();
        $CI->load->library('folders');
        $destination='images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $destination);
        $destination = $destination.'/'. date('d');
        $data = array(
            'fld_name'=>$this->input->post('name'),
            'fld_item_code'=>$this->input->post('item_code'),
            'fld_cp'=>$this->input->post('cp'),
            'fld_discount'=>$this->input->post('discount'),
            'fld_sp'=>$this->input->post('sp'),
            'fld_qty'=>$this->input->post('qty'),
            'fld_status'=>$this->input->post('status'),
            'fld_shelf_location'=>$this->input->post('shelf_loc'),
            'fld_description'=>$this->input->post('desc')
        );
        $this->db->trans_start();
        $accs_id = $this->product_model->insert_accessories($data);
        
        $files['image'] = $_FILES['image_new'];
        $images = $CI->folders->uploadFiles($files, $destination);   
        foreach($_POST['color_new'] as $key=>$value){
            $data_attr = array(
                'fld_color'=>$_POST['color_new'][$key],
                'fld_qty'=>$_POST['qty_color_new'][$key],
                'fld_location'=>$destination,
                'fld_image'=>$images[$key],
                'fld_accessory_id'=>$accs_id
            );
            
            $this->product_model->insert_accessories_attributes($data_attr);
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','Accessory <b>'. $this->input->post('name').'</b> is successfully inserted.');
        redirect($_SERVER['HTTP_REFERER']);
    }
    function update_accessories($id){
        $data = array(
            'fld_name'=>$this->input->post('name'),
            'fld_item_code'=>$this->input->post('item_code'),
            'fld_cp'=>$this->input->post('cp'),
            'fld_discount'=>$this->input->post('discount'),
            'fld_sp'=>$this->input->post('sp'),
            'fld_qty'=>$this->input->post('qty'),
            'fld_status'=>$this->input->post('status'),
            'fld_shelf_location'=>$this->input->post('shelf_loc'),
            'fld_description'=>$this->input->post('desc')
        );
        $this->db->trans_start();
        $this->product_model->update_accessories($data,$id);
//////////////////////////////////for images///////////////
        
        $flag = FALSE;
        $flag1= FALSE;
        foreach($_FILES['image_old']['name'] as $key=>$img)
        {
            if(strlen(trim($img))>0)$flag = TRUE;
        }
        if(isset($_FILES['image_new']['name'])){
            foreach($_FILES['image_new']['name'] as $key=>$img)
            {
                if(strlen(trim($img))>0)$flag1 = TRUE;
            }
        }
        if($flag == TRUE)
        {
            $files = $_FILES['image_old'];
            $this->edit_with_image($files,$id, $flag);
        }
        
        if($flag1 == TRUE)
        {
            $files = $_FILES['image_new'];
            $this->edit_with_new_image($files,$id);
        }
        if($flag == FALSE && $flag1 == FALSE){
            $this->edit_without_image($id);
        }
        ///////////////////////////images/////////////////////////////
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<b>'.$this->input->post('name').'</b> is successfully updated');
        redirect(base_url().'admin/product/add_accessories');
    }
    
    function edit_without_image($id)
    {
        foreach(array_keys($_POST['color_old']) as $key) { //managing child
                if(empty($_POST['color_old'][$key])){
                    $this->product_model->delete_color_attrs($_POST['attr_id'][$key]);
                }
                $data_attr= array(
                    'fld_color' => $_POST['color_old'][$key],
                    'fld_qty' => $_POST['qty_color_old'][$key],
                    'fld_accessory_id'=>$id,
                );
                $this->product_model->edit_color_attributes($data_attr,$_POST['attr_id'][$key]); //data, id[category id]
        if($_POST['color_new']){
            foreach(array_keys($_POST['color_new']) as $key)
                $data_attr_new= array(
                    'fld_color' => $_POST['color_new'][$key],
                    'fld_qty' => $_POST['qty_color_new'][$key],
                    'fld_accessory_id'=>$id,
                );
                $this->product_model->insert_accessories_attributes($data_attr_new);
            }
        }
    }
    
    function edit_with_image($files,$id,$flags)
    {
        $CI=&get_instance();
        $CI->load->library('folders');
        $location = 'images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $location);
        $location = $location.'/'.date('d');
        $image_attr['old_attr']=$files;
        $old_image_names=$CI->folders->uploadFiles($image_attr, $location);
        foreach(array_keys($_POST['color_old']) as $key=>$value) { //managing child
            if(empty($_POST['color_old'][$key])){
                $this->product_model->delete_color_attrs($_POST['attr_id'][$key]);
            }
            if(!isset($old_image_names[$key])){
                $data_attr= array(
                    'fld_color' => $_POST['color_old'][$key],
                    'fld_qty' => $_POST['qty_color_old'][$key],
                    'fld_accessory_id'=>$id
                );
                $flag=false;
            }else{
                $data_attr= array(
                    'fld_color' => $_POST['color_old'][$key],
                    'fld_qty' => $_POST['qty_color_old'][$key],
                    'fld_accessory_id'=>$id,
                    'fld_location'=>$location,
                    'fld_image'=>$old_image_names[$key]
                );
                $flag=true;
            }
        $this->product_model->edit_color_attributes($data_attr,$_POST['attr_id'][$key],$flag); //data, id[category id]
        $flag = false;
        }
//        exit;
    }
    
    function edit_with_new_image($files, $id)
    {
        $CI=&get_instance();
        $CI->load->library('folders');
        $location = 'images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $location);
        $location = $location.'/'.date('d');
        $image_attr['new_attr']=$files;
        $new_image_names=$CI->folders->uploadFiles($image_attr, $location);
        foreach(array_keys($_POST['color_new']) as $key=>$value) { 
                $data_attr= array(
                    'fld_color' => $_POST['color_new'][$key],
                    'fld_qty' => $_POST['qty_color_new'][$key],
                    'fld_accessory_id'=>$id,
                    'fld_location'=>$location,
                    'fld_image'=>$new_image_names[$key]
            );
            }
            $this->product_model->insert_accessories_attributes($data_attr);
    }
    
    function delete_accessories($id){
        $this->product_model->delete_accessories($id);
    }
    
    function subcategory($cat_id)
    {
        $this->load->helper('login_helper');admin_log();
        $sub_categories = $this->product_model->sub_categories($cat_id);
        echo json_encode($sub_categories->result());
    }
    function attributes($product_type_id)
    {
        $this->load->helper('login_helper');admin_log();
        $attributes = $this->product_model->attributes($product_type_id);
        echo json_encode($attributes->result());
    }
    function add()
    {
        $this->load->helper('login_helper');admin_log();
        $info = $this->post();
        $this->db->trans_start();
            $pid = $this->product_model->add_product($info);
            $this->attribute_arrangement($pid);
            $this->img_arrangement($pid);
            $this->compatibility_arrangement($pid);
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','The product is successfully inserted.');
        redirect(base_url().'admin/product');
    }
    function post()
    {
        $this->load->helper('login_helper');admin_log();
        $price = $this->input->post('price');
        $discount = $this->input->post('discount');
        $sp = $price * ($discount/100);
        $sp = $price-$sp;
        $selling_price = round($sp, 2);
        
        $data = array(
            'fld_name'=>trim($this->input->post('name')),
            'fld_description'=>$this->input->post('desc'),
            'fld_code'=>$this->input->post('code'),
            'fld_vendor'=>$this->input->post('vendor'),
            'fld_cp'=>$this->input->post('cp'),
            'fld_price'=>$this->input->post('price'),
            'fld_status'=>$this->input->post('status'),
            'fld_stock'=>$this->input->post('stock'),
            'fld_shelf'=>$this->input->post('shelf'),
            'fld_category'=>$this->input->post('category'),
            'fld_subcategory'=>$this->input->post('sub_category'),
            'fld_product_type'=>$this->input->post('product_type'),
            'fld_size_bridge_width'=>$this->input->post('bridge_width'),
            'fld_size_eye_size'=>$this->input->post('eye_size'),
            'fld_size_lens_height'=>$this->input->post('lens_height'),
            'fld_size_temple_arm'=>$this->input->post('temple_arm'),
            'fld_size_total_width'=>$this->input->post('total_width'),
            'fld_discount'=>$this->input->post('discount'),
            'fld_sp'=>$selling_price
        );
        return $data;
    }
    function attribute_arrangement($pid,$edit="false")
    {
        $this->load->helper('login_helper');admin_log();
        if($edit=="true")
        {
            $this->product_model->delete_product_attributes_and_values($pid);
        }
        if($this->input->post('attribute'))
        {
            $atrs = $this->input->post('attribute');
            $attribute['fld_product']=$pid;
            foreach($atrs as $atr)
            {
                $temp = explode("_", $atr);
                $attribute['fld_attribute'] = $temp[0];
                $attribute['fld_value']=$temp[1];
                $this->product_model->insert_product_attribute($attribute);
            }
        }
    }
    function img_arrangement($pid, $files='', $index=0)
    {
        if(empty($files)){
            $main_files = $_FILES;
            $checkImg = 0;
            $temp='';
        }else{
            $main_files = $files;
            $checkImg = $index;
            $temp='xyz';
        }
        $this->load->helper('login_helper');admin_log();
        $this->db->trans_start();
        $CI = & get_instance();
        $CI->load->library('folders');
        $destination='images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $destination);
        $destination = $destination.'/'. date('d');
//        $checkImg=0;
        foreach($main_files as $key=>$files)
        {
            if($checkImg==0)
            {
                $file['primary']=$files;
                $imageNames = $CI->folders->uploadFiles($file, $destination);
                foreach($imageNames as $imageName)
                {
                    $data = array(
                        'fld_product'=>$pid,
                        'fld_name'=>$imageName,
                        'fld_url'=>$destination,
                        'fld_primary'=>0                       
                    );
                    $data['fld_color']=$this->image_color($key);
                    $temp = $data['fld_color'];
                    $this->product_model->insert_product_image($data);
                }
            }
            if($checkImg!=0)
            {
                $temp1 = $this->image_color($key);
                if($temp != $temp1){
                    /*
                     * The below code is for the addition of new images from edit section
                     */
                    $temp_key = explode('_',$key);
                    if($temp_key[0]=='edit'){
                        $index=1;
                    }
                    else $index = 0;
                }else $index=1;
                for($j=0;$j<count($files['name']);$j++)
                {
                    if($files['name'][$j]!="")
                    {
                        $file['img']="";
                        $file['img']['name'] = $files['name'][$j];
                        $file['img']['type'] = $files['type'][$j];
                        $file['img']['tmp_name'] = $files['tmp_name'][$j];
                        $file['img']['error'] = $files['error'][$j];
                        $file['img']['size'] = $files['size'][$j];
                        $imageNames = $CI->folders->uploadFiles($file, $destination);
                        
                        foreach($imageNames as $imageName)
                        {
                            $data = array(
                                'fld_product'=>$pid,
                                'fld_name'=>$imageName,
                                'fld_url'=>$destination,
                                'fld_primary'=>$index
                            );
                            $data['fld_color']=$this->image_color($key);
                            $this->product_model->insert_product_image($data);
                            $index++;
                        }
                    }
                    $temp = $temp1;
                }
            }
            $checkImg++;
        }
        $this->db->trans_complete();
    }
    function image_color($key,$flag=0){ //$flag is to return the size of the array;
        $temp = explode('_',$key);
        return end($temp);
    }
    function img_arrangement_edit($pid)
    {
        $count_new = 0;
        $temp_key='';
        $this->load->helper('login_helper');admin_log();

        foreach($_FILES as $key=>$files){
            $temp = explode("_", $key);
            $color = end($temp);
            if($temp[0]=='edit'){
                $files_new[$key][$key]='';
                $files_new[$key][$key] = $files;
                if($temp_key!=$key){
                    if($temp[1]=='img'){
                        $count_new=1;
                    }
                    else $count_new=0;
                }
                $this->img_arrangement($pid, $files_new[$key], $count_new);
                $count_new++;
                $temp_key = $key;
            }
            else if($temp[0]=='old'){
                $old_file='';
                if($temp[1]=='primary'){
                    $old_file['primary'] = $_FILES[$key];
                }
                if($temp[1]=='img'){
                    $old_file['img'] = $_FILES[$key];
                }
                $this->update_old_file($pid,$old_file,$color);
            }
            else{
                if($temp[0]=='primary'){
                    if($files['name'][0]!="" || $files['name'][0]!=NULL ){
                        $this->update_file($pid, $files, $color, 0);
                    }
                }else{
                    foreach($_FILES[$key]['name'] as $sub_key=>$image_name){
                        if($image_name!="" || $image_name!=NULL ){
                            $this->update_file($pid, $files, $color, $sub_key);
                        }
                    }
                }
            }
        }
//        exit;
//        $this->db->trans_complete();
    }
    function update_old_file($pid,$old_file,$color){
	//echo '<pre>';
	//print_r($old_file);
        $CI = & get_instance();
        $CI->load->library('folders');
        $destination='images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $destination);
        $destination = $destination.'/'. date('d');
        $imageName = $CI->folders->uploadFiles($old_file, $destination);
        //print_r('image:'.$imageName);
        foreach($old_file as $key=>$values){
            $array_key = $key;
        }
//        echo $array_key.'<br/>';
//        $index;
		if(!empty($imageName)){
			if($array_key=='primary'){
				foreach($imageName as $key=>$img){
					$index[$key] = $key;
				}
			}
			if($array_key=='img'){
				foreach($imageName as $key=>$img){
					$index[$key] = $key+1;
				}
			}
			foreach($imageName as $key=>$image){
				$data['fld_name']=$image;
				$data['fld_url']=$destination;
				$data['fld_color']=$color;
				$indx=$index[$key];
				$pimg_infn = $this->product_model->select_to_unlink($pid, $color, $indx);
				if(!empty($pimg_infn))
				{
					unlink(getcwd().'/'.$pimg_infn->fld_url.'/'.$pimg_infn->fld_name);
					unlink(getcwd().'/'.$pimg_infn->fld_url.'/thumbs/'.$pimg_infn->fld_name);
					$this->product_model->update_product_image($pid,$indx,$data);
				}
			}
		}
        
    }
    function update_file($pid, $files, $color, $sub_key){
        $CI = & get_instance();
        $CI->load->library('folders');
        $destination='images/'.date("Y").'/'.date("m");
        $CI->folders->makeDirectory(date('d'), $destination);
        $destination = $destination.'/'. date('d');
        $file['img']='';
        $file['img']['name'] = $files['name'][$sub_key];
        $file['img']['type'] = $files['type'][$sub_key];
        $file['img']['tmp_name'] = $files['tmp_name'][$sub_key];
        $file['img']['error'] = $files['error'][$sub_key];
        $file['img']['size'] = $files['size'][$sub_key];
        if($sub_key==0){
            $index=0;
        }else $index = $sub_key+1;
        $imageName = $CI->folders->uploadFiles($file, $destination);
        $data = array(
                'fld_product'=>$pid,
                'fld_name'=>$imageName[0],
                'fld_url'=>$destination,
                'fld_primary'=>$index,
                'fld_color'=>$color
            );
        $pimg_infn = $this->product_model->select_to_unlink($pid, $color, $index);
        if(!empty($pimg_infn))
        {
            unlink(getcwd().'/'.$pimg_infn->fld_url.'/'.$pimg_infn->fld_name);
            unlink(getcwd().'/'.$pimg_infn->fld_url.'/thumbs/'.$pimg_infn->fld_name);
            $this->product_model->update_product_image($pid,$index,$data);
        }
        
    }
    function compatibility_arrangement($pid,$edit="false")
    {
        $this->load->helper('login_helper');admin_log();
        if($edit=="true")
        {
            $this->product_model->delete_product_compatibility($pid);
        }
        if($this->input->post('compatibility'))
        {
            $compatibilities = $this->input->post('compatibility');
            $lens_compatibility['fld_product']=$pid;
            foreach($compatibilities as $compatibility)
            {
                $lens_compatibility['fld_lens_type']=$compatibility;
                $this->product_model->insert_product_compatibility($lens_compatibility);
            }
        }
    }
    function edit($pid,$ptype_id)
    {
        $this->load->helper('login_helper');admin_log();
        $data['product_type_id']=$ptype_id;
        $data['vendors'] = $this->product_model->get_vendors($ptype_id);
        $data['product_type']=$this->product_model->get_product_type_by_id($ptype_id);
        $data['attributes']=$this->product_model->get_attributes_by_product_type($ptype_id);
        $data['attributes_values']=$this->product_model->get_all_attribute_values_by_attr_ids($data['attributes']);
        
        $data['product'] = $this->product_model->select_product($pid,1); //1 is to declare that this call is from admin side
        //gets product attributes and its values
        $data['p_attrs'] = $this->product_model->get_product_attributes($pid);
        //gets product images
        $data['p_imgs'] = $this->product_model->get_product_images($pid);
        $data['colours'] = $this->product_model->get_product_colours($pid);
        //gets product lens compatibility
        $data['p_lens_compatibility'] = $this->product_model->get_product_lens_compatibility($pid);
                      
        $data['page'] = "admin/edit_product";
        $data['title'] = "Edit Product| Optical Store Online";

        $data['categories']=$this->product_model->categories();
        $data['compatibilities']=$this->product_model->lens_types();//actually lens_type is compatibility
        $this->load->view('admin/container',$data);
                
    }
    function update($pid)
    {
        $this->load->helper('login_helper');admin_log();
        $info = $this->post();
       
        $this->db->trans_start();
        
        $this->product_model->update_product($pid,$info);
        $edit = "true";
        $this->attribute_arrangement($pid,$edit);
        $this->img_arrangement_edit($pid);
        $this->compatibility_arrangement($pid,$edit);
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','The product is successfully updated.');
        redirect(base_url().'admin/product/index');
    }
    function delete_product_images($pimg_id)
    {
        $pimg_info = $this->product_model->select_product_image_info($pimg_id);
        if(!empty($pimg_info))
        {
            unlink(getcwd().'/'.$pimg_info->fld_url.'/'.$pimg_info->fld_name);
            unlink(getcwd().'/'.$pimg_info->fld_url.'/thumbs/'.$pimg_info->fld_name);
            $this->product_model->delete_product_image_($pimg_id);
        }
        
    }
    function delete($pid)
    {
        $this->load->helper('login_helper');admin_log();
        $this->db->trans_start();
        //deletes the product from tbl_product
        $this->product_model->delete_product($pid);
        
        //deletes the products attributes and values frm tbl_product_attribute
        $this->product_model->delete_product_attributes_and_values($pid);
        
        //gets all images of product(i)first unlinks them and (ii) deletes them from tbl_product_image
        $product_images = $this->product_model->get_all_product_images($pid);
        if($product_images->num_rows()!=0)
        {
            foreach($product_images->result() as $product_image)
            {
                unlink(getcwd().'/'.$product_image->fld_url.'/'.$product_image->fld_name);
                unlink(getcwd().'/'.$product_image->fld_url.'/thumbs/'.$product_image->fld_name);
                $this->product_model->delete_all_product_images($pid);
            }
        }
        
        //deletes the product compatibility from tbl_product_lens_compatibility
        $this->product_model->delete_product_compatibility($pid);
        
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','The product is successfully deleted.');
        redirect(base_url().'admin/product');          
    }
    function delete_color_images($color,$pid){
        $this->load->model('admin/product_model');
        $this->product_model->delete_color_images($color, $pid);
    }
    
    function featured($id,$value)
    {
        $data['fld_featured'] = $value;
        $this->product_model->featured($id, $data);
    }
    
}
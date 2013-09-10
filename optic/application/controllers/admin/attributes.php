<?php
class Attributes extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('attributes_model');
        $this->load->model('attribute_values_model');
    }
    public function index($id=0){ //if redirected from the insert_attributes than it is product id
        $this->load->helper('login_helper');admin_log();
        
        if($id==0)$id="";
        $data['msg']=$this->session->flashdata('msg');
        $this->load->model('admin/product_type_model');
        $data['product_type']=$this->product_type_model->get_product_type_by_id($id);
        $data['attributes']=$this->attributes_model->get_attributes_by_product_type($id);
        $data['attributes_values']=$this->attribute_values_model->get_all_attribute_values_by_attr_ids($data['attributes']);
        $data['title']="Add Attributes";
        $data['page'] = "admin/attributes";
        $this->load->view('admin/container',$data);
        
    }
    public function insert_attributes($id=0){ //no id used until now
        $this->load->helper('login_helper');admin_log();
        $data_attr = array(     //goes into attributes
            'fld_price'=>$_POST['price']
            //'fld_has_image'=>'test.jpg'
        );
        $this->db->trans_start();
            $main_attr_id = $_POST['main_attr_id'];
            if($main_attr_id==0){
                $data_attr['fld_product_type_id']=$_POST['product_type'];
                $data_attr['fld_name']=$this->input->post('name');
                $last_id = $this->attributes_model->insert_attributes($data_attr);

                foreach(array_keys($_POST['value']) as $key) {
                    if(!empty($_POST['value'][$key])){
                        $data_attr_val= array(
                            'fld_value' => $_POST['value'][$key],
                            'fld_price' => $_POST['value_price'][$key],
                            'fld_attribute_id'=>$last_id,
                            'fld_parent_id'=>$main_attr_id     //if main_attr_id is zero it acts as parent id.
                        );
                        $this->attribute_values_model->insert_attribute_values($data_attr_val);
                    }
                }

            }
            else{
                $data_attr['fld_value']=$this->input->post('name');
                $data_attr['fld_attribute_id']=$main_attr_id;
                $data_attr['fld_parent_id']=0;               //The parent id for this is always zero coz it is always the first child of main attribute
                $last_id = $this->attribute_values_model->insert_attribute_values($data_attr);

                foreach(array_keys($_POST['value']) as $key) {
                    if(!empty($_POST['value'][$key])){
                        $data_attr_val= array(
                            'fld_value' => $_POST['value'][$key],
                            'fld_price' => $_POST['value_price'][$key],
                            'fld_attribute_id'=>$main_attr_id, //if main_attr_id in not zero then it acts as attribute id.
                            'fld_parent_id'=>$last_id     
                        );
                        $this->attribute_values_model->insert_attribute_values($data_attr_val);
                    }
                }
            }
       $this->db->trans_complete();
       $this->session->set_flashdata('msg','<script>alert("Attribute and its values are successfully inserted");</script>');
       redirect(base_url().'admin/attributes/index/'.$_POST['product_type']);
    }
    function delete_attributes($id){
        $this->load->helper('login_helper');admin_log();
        $this->attribute_values_model->delete_attribute_value($id);
    }
    function delete_main_attributes($id){
        $this->load->helper('login_helper');admin_log();
        $this->attributes_model->delete_attributes($id);
    }
    function edit_attributes($id=0){
        $this->load->helper('login_helper');admin_log();
        if(isset($_POST['product_type_id']) && $_POST['product_type_id']!=""){
            //print_r($_POST);exit;
            $id=$_POST['id'];
            $data_attr = array(
                'fld_name' => $_POST['name'],
                'fld_price' => $_POST['price'],
                'fld_product_type_id'=>$_POST['product_type_id']
            );
            $this->attributes_model->edit_attributes($data_attr,$id);
            $this->session->set_flashdata('msg','<script>alert("Attribute Successfully Updated");</script>');
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $parent_id = $_POST['parent_id'];//this is the parent id of the attribute. if the parent id is 0 then it has no parent.
        $level0_id = $_POST['level0_id'];
        $id = $_POST['id'];
        $data_attr = array(
            'fld_value' => $_POST['name'],
            'fld_price' => $_POST['price'],
            'fld_id'=>$id,
            'fld_attribute_id'=>$level0_id, //this is the main parent id under which all the attributes and its values are children
            'fld_parent_id'=>$parent_id
        );
        $this->db->trans_start();
        $this->attribute_values_model->edit_attribute_value($data_attr,$id);
        if(isset($_POST['value'])){
            foreach(array_keys($_POST['value']) as $key) { //managing child
                if(!empty($_POST['value_id'][$key])){
                    $data_attr_val= array(
                        'fld_value' => $_POST['value'][$key],
                        'fld_price' => $_POST['value_price'][$key],
                        'fld_id'=>$_POST['value_id'][$key],
                        'fld_attribute_id'=>$level0_id, //this is the main parent id under which all the attributes and its values are children
                        'fld_parent_id'=>$id //child's parent id is the id of the parent
                    );
                    $this->attribute_values_model->edit_attribute_value($data_attr_val,$data_attr_val['fld_id']);
                }
                else{
                    if(!empty($_POST['value'][$key])){
                        $data_attr_val= array(
                            'fld_value' => $_POST['value'][$key],
                            'fld_price' => $_POST['value_price'][$key],
                            'fld_attribute_id'=>$level0_id, //this is the main parent id under which all the attributes and its values are children
                            'fld_parent_id'=>$id //child's parent id is the id of the parent
                        );
                        $this->attribute_values_model->insert_attribute_values($data_attr_val);
                    }
                }
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg','<script>alert("Attribute Successfully Updated");</script>');
        redirect($_SERVER["HTTP_REFERER"]);
    }
    function get_attribute_by_id($id){
        $this->load->helper('login_helper');admin_log();
        echo json_encode($this->attributes_model->get_attribute_by_id($id));
    }
}

?>

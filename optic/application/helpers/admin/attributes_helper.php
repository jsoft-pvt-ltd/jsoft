<?php

function get_children($id){
    $CI =& get_instance();
    $CI->db->where('fld_parent_id',$id);
    return $CI->db->get('tbl_attribute_values');
}
function get_children_by_par_id($parent_id)
{
    $children = get_children($parent_id);
    $return_value = array();
    foreach($children->result() as $result)
    {
        $result->children = get_children_by_par_id($result->fld_id);
        $return_value[]= $result;
    }
    return ($return_value);
    
}
function get_each_child($child){
    foreach($child->children as $subchild){ 
        echo '<div style="margin-left:20px;" id="row_'.$subchild->fld_id.'">';
        echo $subchild->fld_value;
        echo '<div class="child_controls">';
            //echo $subchild->fld_id;
            echo '[ <a href="javascript:void(0);" onclick="edit_attr_values('.$subchild->fld_id.');">Edit</a> ]&nbsp;&nbsp;&nbsp;';
            echo '[ <a href="javascript:void(0);" class="delete" id="'.$subchild->fld_id.'" name="'.base_url().'admin/attributes/delete_attributes/'.$subchild->fld_id.'">Delete</a> ]';
        echo '</div>';
        get_each_child($subchild);
        echo '</div>';
    } 
}

function attributes_values(){
    $CI =& get_instance();
    return $CI->db->get('tbl_attribute_values');
}




?>

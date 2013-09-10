<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php $this->load->helper('admin/attributes_helper')?>
        <div class="operations">
            <div class="operation">
                Product Type: <input type="text" id="product_type_name" name="product_type_name" value="<?php echo $product_type->fld_name;?>" style="border:none;background: #f5f5f5;" readonly="readonly"/>
            </div>
        </div>
        <div class="attributes_container" id="att_cont_0">
            <div class="attributes">
                <a class="operation" href="javascript:void(0);" class="add_attributes_container" onclick="add_attributes_container(<?php echo $product_type->fld_id;?>);">
                    [ Add Attributes For : <?php echo $product_type->fld_name;?> ]
                </a>
            </div>
        </div>
        <?php if($attributes->num_rows()!=0):?>
        <table width="100%">
            <tr style="font-weight: bold;">
                <td>S.N</td>
                <td>Attributes</td>
                <td>Has Image</td>
                <td>Price</td>
                <td>Controller</td>
        <!--        <td colspan="2">Attribute Value<br/>Controller</td>-->
            </tr>
            <?php
            $count=1;
            foreach($attributes->result() as $attribute):?>
                <tr id="row_<?php echo $attribute->fld_id;?>">
                    <td>
                        <?php echo $count;?>
                    </td>
                    <td id="name_<?php echo $attribute->fld_id;?>">
                        <?php echo $attribute->fld_name;?>
                    </td>
                    <td>
                        <?php echo $attribute->fld_image;?>
                    </td>
                    <td>
                        <?php echo $attribute->fld_price;?>
                    </td>
                    <td>
        <!--                <a href="<?php echo base_url().'admin/attributes/edit_attribute/'.$attribute->fld_id;?>" class="edit" id="<?php echo $attribute->fld_id;?>" title="Edit">
                            Edit
                        </a>-->
                         <a class="operation" href="javascript:void(0);" onclick="edit_attr(this);" name="<?php echo base_url().'admin/attributes/get_attribute_by_id/'.$attribute->fld_id;?>">Edit</a>
                         |
        <!--            </td>
                    <td>-->
                        <a href="javascript:void(0)" class="operation delete" id="<?php echo $attribute->fld_id;?>" title="Delete" name="<?php echo base_url().'admin/attributes/delete_main_attributes/'.$attribute->fld_id;?>">
                            Delete
                        </a>
                        |
        <!--            </td>
                    <td colspan="2">-->
                        <a href="javascript:void(0);" class="operation add_attributes_container" onclick="add_attributes_container('<?php echo $product_type->fld_id.'_'.$attribute->fld_id;?>');">
                            Add Attribute values
                        </a>
                    </td>
                </tr>
                <tr id="row_<?php echo $attribute->fld_id;?>_tr">
                    <td>
                        &nbsp;
                    </td>
                    <td colspan="7">
                        <?php 
                        foreach($attributes_values->result() as $attribute_values){
                            if($attribute_values->fld_parent_id==0 && $attribute_values->fld_attribute_id==$attribute->fld_id){
                                echo '<div id="row_'.$attribute_values->fld_id.'">';
                                echo '&nbsp;&nbsp;&nbsp;'.$attribute_values->fld_value;

                                echo '<div class="child_controls">';
                                    //echo $attribute_values->fld_id;
                                    echo '<a class="operation" href="javascript:void(0);" onclick="edit_attr_values('.$attribute_values->fld_id.');">Edit</a> | ';
                                    echo '<a class="operation" href="javascript:void(0);" class="delete" id="'.$attribute_values->fld_id.'" name="'.base_url().'admin/attributes/delete_attributes/'.$attribute_values->fld_id.'">Delete</a>';
                                echo '</div>';
                                echo '</div>';
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                $children = get_children_by_par_id($attribute_values->fld_id);
                                if(!empty($children)){
        //                            echo '<div style="margin-left:20px;">';
                                    foreach($children as $child){//recursive level1
                                        echo '<div style="margin-left:20px;" id="row_'.$child->fld_id.'">';
                                            //echo '<div id="row_'.$child->fld_id.'">';
                                                echo $child->fld_value;
                                                echo '<div class="child_controls">';
                                                    //echo $child->fld_id;
                                                    echo '[ <a href="javascript:void(0);" onclick="edit_attr_values('.$child->fld_id.');">Edit</a> ]&nbsp;&nbsp;&nbsp;';
                                                    echo '[ <a href="javascript:void(0);" class="delete" id="'.$child->fld_id.'" name="'.base_url().'admin/attributes/delete_attributes/'.$child->fld_id.'">Delete</a> ]';
                                                echo '</div>';
                                                print_r(get_each_child($child));        //recursive to n level
                                            //echo '</div>';
                                        echo '</div>';
                                    }
        //                            echo '</div>';
                                }
                            }
                        }
                       ?>
                    </td>
                </tr>
            <?php 
            $count++;
            endforeach;?>
        </table>    
        <?php endif;?>
    </div>
</div>
<div class="overlay"></div>        
        
<div class="popup" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_attributes" id="frm_attributes" action="<?php echo base_url().'admin/attributes/insert_attributes';?>" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Attribute</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('edit_attribute');">
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
    
        <div class="attributes" id="new_attribute">
            <input type="hidden" id="product_type" name="product_type" value="">
            <input type="hidden" id="main_attr_id" name="main_attr_id" value="">
            <div class="label_input">
                <div class="label">Attribute</div> 
                <div class="input"><input type="text" id="name" name="name" maxlength="40" value=""/></div>
                <div class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price</div>
                <div class="input"><input type="text" id="price" name="price" maxlength="10" value=""></div>
            </div>
            <div class="clear"></div>
            <div class="attribute_values" id="values_0">
                <div class="label_input">
                    <div class="label">Attribute Value</div>
                    <div class="input"><input type="text" id="value[]" name="value[]" maxlength="40" value=""/></div>
                    <div class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price</div>
                    <div class="input"><input type="text" id="value_price[]" name="value_price[]" maxlength="10" value=""/></div>
                    <div class="sumation"><a href="javascript:void(0);" class="add_attribute_values" onclick="add_attribute_values(this.name);" name="values_0">[+]</a></div>
                </div>
            </div>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>
<div class="popup_edit" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_edit_attributes" id="frm_edit_attributes" action="<?php echo base_url().'admin/attributes/edit_attributes';?>" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Attribute</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('edit_attribute');">
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="attributes" id="edit_attribute">
            <input type="hidden" id="product_type" name="product_type" value="<?php echo $product_type->fld_id;?>"/>
            <input type="hidden" id="parent_id" name="parent_id" value=""/>
            <input type="hidden" id="id" name="id" value=""/>
            <input type="hidden" id="level0_id" name="level0_id" value=""/>
            <input type="hidden" id="product_type_id" name="product_type_id" value=""/>
            <div class="label_input">
                <div class="label">Attribute</div>
                <div class="input"><input type="text" id="name" name="name" maxlength="40" value=""/></div>
                <div class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price</div>
                <div class="input"><input type="text" id="price" name="price" maxlength="10" value=""/></div>
            </div>    
<!--            Image: 
                <input type="file" id="image[]" name="image[]"/> -->
                
            <div class="attribute_values" id="values_edit_0">
                <!--Values to be edited here come from javascript-->
            </div>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
            <!--<a href="javascript:void(0);" onclick="clear_popup('edit_attribute');">Cancel</a>-->
        </div>
        <div class="clear"></div>
    </form>
</div>
<style>
    div.label{width: 100px;padding-top:3px;}
    div.attribute_values{margin: 0;overflow: auto;}
    div.popup_actions{text-align: left;}
</style>    
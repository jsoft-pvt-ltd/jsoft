<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Categories</div>
            <!--:<input type="text" id="category" name="category" value="" style="border:none;"/>-->
        </div>
        <div class="categories_container" style="padding: 5px;border:1px solid #f0f0f0;">
            <div class="categories">
                    <a  class="operation" href="javascript:void(0);" class="add_attributes_container" onclick="categories_create_update(this);" name="<?php echo base_url().'admin/category/insert_categories';?>">
                  [ Add Categories ]
                </a>
            </div>
        </div>
        <div class="records">
            <table width="100%">
                <tr style="font-weight: bold;">
                    <td>S.N</td>
                    <td>Categories</td>
                    <td>Rank</td>
                    <td>Status</td>
                    <td>Controller</td>
                </tr>
                <?php
                $sn=1;
                foreach ($categories->result() as $category):?>
                    <tr id="row_<?php echo $category->fld_id;?>"  style="vertical-align: top;">
                        <td><?php echo $sn;?></td>
                        <td>
                            <?php echo $category->fld_name?><br>
                            <ul>
                                <?php foreach ($sub_categories->result() as $sub_category):?>
                                <?php if($sub_category->fld_category_id==$category->fld_id):?>
                                <li id="li_<?php echo $sub_category->fld_id;?>">
                                    <div>
                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sub_category->fld_name;?></span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;<div style="text-align:right;float:right;">
                                            [ <a href="javascript:" title="" onmouseover="this.title = this.id;" class="up_sub" id="<?php echo $sub_category->fld_rank.'_'.$category->fld_id.'_'.$sub_category->fld_id;?>">Up</a> ] 
                                            [ <a href="javascript:" title="" onmouseover="this.title = this.id;" class="down_sub" id="<?php echo $sub_category->fld_rank.'_'.$category->fld_id.'_'.$sub_category->fld_id;?>">Down</a> ]</div>
                                    </div>
                                </li>
                                <?php endif;?>
                                <?php endforeach;?>
                            </ul>
                        </td>
                        <td id="rank_<?php echo $category->fld_rank;?>">
                            <?php // echo $category->fld_rank?>
                            <a href="javascript:" class="up" id="<?php echo $category->fld_rank;?>">[ Up ]</a>
                            <a href="javascript:" class="down" id="<?php echo $category->fld_rank;?>">[ Down ]</a>
                        </td>
                        <td><?php
                                switch ($category->fld_status){
                                case 0:
                                    echo 'Invisible';
                                    break;
                                case 1:
                                    echo 'Visible';
                                    break;
                                default:
                                    break;
                                }
                            ?>
                        </td>
                        <td>
                            <a  class="operation" href="javascript:void(0);" onclick="categories_create_update(this);" id="<?php echo $category->fld_id;?>" name="<?php echo base_url().'admin/category/edit_categories/'.$category->fld_id;?>">
                                Edit
                            </a>
                            |
                            <a  class="operation delete" href="javascript:void(0);" id="<?php echo $category->fld_id;?>" name="<?php echo base_url().'admin/category/delete_categories/'.$category->fld_id;?>">
                            Delete
                            </a>
                        </td>                    
                    </tr>

                <?php
                $sn++;
                endforeach;
                ?>            
            </table>
        </div>
    </div>
</div>    
<div class="overlay"></div>
<div class="popup" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_categories" id="frm_categories" action="" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Category</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_category');">
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="attributes" id="new_category">
            
            <!--<input type="hidden" id="category_id" name="category_id" value="">-->
            <div class="label_input">
                <div class="label">Categories</div>
                <div class="input"><input type="text" id="name" name="name" maxlength="40" value=""/></div>
                <div class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status</div>
                <div class="input"><select id="status" name="status" value=""><option value="1">Show</option><option value="0">Hide</option></select></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Description</div>
                <div class="input_textarea"><textarea id="description" name="description" style="width:383px;"></textarea></div>
            </div>
               <div class="clear"></div> 
               <div class="label_input">
                   <div class="label">Image</div>
                   <div class="input"><input type="file" id="cat_image" name="cat_image"/> </div>
            </div>
            <div class="clear"></div><div class="clear"></div>
            <div class="sub_categories" id="values_0">
                <div class="label_input">
                    <div class="label">Sub Categories</div>
                    <div class="input"><input type="text" id="sub_name_new[]" name="sub_name_new[]" maxlength="40" value=""/></div>
                    <div class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status</div>
                    <div class="input"><select id="sub_status[]" name="sub_status[]" value=""><option value="1">Show</option><option value="0">Hide</option></select></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label">Description</div>
                    <div class="input_textarea"><textarea id="sub_description_new[]" name="sub_description_new[]" style="width:383px;"></textarea></div>
                <div class="clear"></div>
                    Image: <input type="file" id="subcat_image_new[]" name="subcat_image_new[]"/>
                    <!--<input type="file" id="subcat_image_extra" name="subcat_image_new[]" style="display:none;"/>-->
                    <div class="sumation"><a href="javascript:void(0);" class="add_attribute_values" onclick="add_sub_categories(this.name);" name="values_0">[+]</a></div>
                </div>  
            </div>
<!--        </div>-->
            <div class="clear"></div>
            <div class="popup_actions">
                <input type="submit" value="Done" name="submit"/>
            </div>
            <div class="clear"></div>
        </div>
    </form>
</div>
<div class="popup_edit" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_categories" id="frm_categories" action="" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Category</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_category');">
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="attributes" id="new_category">
            <input type="hidden" id="category_id" name="category_id" value="">
            <div class="label_input">
                <div class="label">Categories</div>
                <div class="input"><input type="text" id="name" name="name" maxlength="40" value=""/></div>
                <div class="label" style="text-align:right;margin-left: 80px;">Status</div>
                <div class="input" style="width:auto;margin-right:10px;"><select id="status" name="status" value=""><option value="1">Show</option><option value="0">Hide</option></select></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Description</div>
                <div class="input_textarea"><textarea id="description" name="description" style="width:250px;height:60px;"></textarea></div>
                <a href="javascript:void(0)" onclick="alter(this)" class="deleteImg" style="margin-left:96px;position: absolute;" id="delete"><img src="<?php echo base_url().'images/cancel.png'?>" height="15"/></a>
                    <img src="" id="img" width="115"/>
                    <input type="file" name="image" id="image" style="display: none;"/>
                
            </div>     
            <div class="clear"></div> 
            <div class="sub_categories" id="sub_cat_0"></div>
        </div>
        <div class="clear"></div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>
<style>
    div.label{width: 100px;padding-top:3px;}
    div.attribute_values{margin: 0;overflow: auto;}
    div.popup_actions{text-align: left;}
    div.sub_categories{margin:0;overflow: auto;}
    div.input_textarea{width:270px;float: left;height:auto;}
    input[type="file"] {width: 100px;}
</style>   
<script>
function alter(me)
{
    $(me).css('display','none');
    $('#img').css('display','none');
    $('#image').css('display','block');
}

function delete_subcat_image(me)
{
    var id = me.id;
    var base_url = "<?php echo base_url();?>";
    $.ajax({
        type: "POST",
        url: base_url+'admin/category/delete_subcat_image/'+id,
        success: function(){
            $(me).css('display','none');
            $('#img_'+id).css('display','none');
            $('#subcat_image_'+id).css('display','block');
        }

    });
}    
</script>
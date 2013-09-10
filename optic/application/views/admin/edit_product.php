<?php $this->load->helper('admin/attributes_helper')?>
<script>
function att(product_type_id)
{
    if(product_type_id=="" || product_type_id==null)
    {   product_type_id = 1;    }
    window.location.href="<?php echo base_url();?>admin/product/insert/" + product_type_id;
}

function subcategory(cat_id)
{
    var sub = "<?php echo $product->fld_subcategory;?>";
    var url = "<?php echo base_url();?>admin/product/subcategory/" + cat_id;
    $.getJSON(url, {ajax:1}, function(data)
    {
        var html = '<select name="sub_category" style="width:173px;">';
        $.each(data, function(index, array) {
        html = html +'<option value="' + array['fld_id'] +'"';
            if(array['fld_id']==sub){
                html = html + 'selected="selected"';
            }
            html = html + ' >' + array['fld_name']+'</option>';
        
        });
        html = html +'</select>';
        document.getElementById('sub_').innerHTML = 'Sub Category';
        $("#sub").html(html);
				
    });
}
function delete_product_image(pimg_id,div)
{
    if(confirm('Are you sure, to delete this product image?')==true)
    {
        url = "<?php echo base_url().'admin/product/delete_product_images/';?>" + pimg_id;
        $.post(url);
        $('#product_img_'+div).remove();
    }
   
}
</script>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>

    <div class="right_div">
        <form name="frm_product" id="frm_product" method="post" action="<?php echo base_url().'admin/product/update/'.$product->fld_id;?>" enctype="multipart/form-data">
        <div class="operations"><div class="operation">Edit the form below</div></div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div class="label" style="float: left;">Product Type</div>
            <div style="float: left;">
                <input type="radio" name="product_type" value="<?php echo $product_type->fld_id;?>" <?php if(isset($product_type_id)):?> checked="checked"<?php endif;?>>
                <?php echo $product_type->fld_name;?>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Name</div>
            <div style="float:left;"><input type="text" id="name" name="name" maxlength="30" value="<?php echo $product->fld_name;?>" class="input"></div>
        </div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Description</div>
            <div style="float:left;"><textarea name="desc" id="desc" class="input_textarea"><?php echo $product->fld_description;?></textarea></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Cost Price</div>
            <div style="float:left;"><input type="text" id="cp" name="cp" maxlength="30" value="<?php echo $product->fld_cp;?>" class="input" class="input"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Price</div>
            <div style="float:left;"><input type="text" id="price" name="price" maxlength="30" value="<?php echo $product->fld_price;?>" class="input"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Item Code</div>
            <div style="float:left;"><input type="text" id="code" name="code" maxlength="30" value="<?php echo $product->fld_code;?>" class="input"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Vendor</div>
            <div style="float:left;">
                <select name="vendor">
                    <?php foreach($vendors->result() as $vendor):?>
                    <option value="<?php echo $vendor->fld_id;?>" <?php if($vendor->fld_id==$product->fld_vendor){echo 'selected="selected"';}?>><?php echo $vendor->fld_name;?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Category</div>
            <div style="float:left;"><select name="category">
                    <option>Select Category</option>
                    <?php foreach($categories->result() as $category):?>
                    <option value="<?php echo $category->fld_id;?>" onclick="subcategory(<?php echo $category->fld_id;?>);" <?php if($category->fld_id==$product->fld_category):echo 'selected="selected"';endif;?>><?php echo $category->fld_name;?></option>
                    <?php endforeach;?>
                </select>
                
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">&nbsp;</div>
            <div id="sub" style="float: left;">
                <script>subcategory(<?php echo $product->fld_category;?>)</script>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div class="label" style="float:left;">Attributes</div>
            <div id="att" style="float: left;width:590px;margin: 0;">
               <?php if(isset($attributes) && $attributes->num_rows()!=0):?>
                    <?php foreach($attributes->result() as $attribute):?>
                        <div class="attributes" style="width:185px;float:left;margin: 0;">
                            <div class="attribute" style="color:#0a80e5;text-transform: capitalize;width:100%;"><?php echo $attribute->fld_name;?></div>
                            <?php foreach($attributes_values->result() as $attribute_values)
                            {
                                if($attribute_values->fld_parent_id==0 && $attribute_values->fld_attribute_id==$attribute->fld_id)
                                {
                                    if($attribute->fld_id==3 || strtolower($attribute_values->fld_value)=='color' || strtolower($attribute_values->fld_value)=='colors' || strtolower($attribute_values->fld_value)=='colour' || strtolower($attribute_values->fld_value)=='colours'){
                                        $id = 'id="'.$attribute->fld_id.'_'.$attribute_values->fld_id.'"';
                                        $class = 'class="frame_color"';
                                    }
                                    else {
                                        $id="";
                                        $class="";
                                    }
                                    echo '<div class="attribute_value">';
                                        echo '<input type="checkbox" '.$class.' name="attribute[]" '.$id.'  value="'.$attribute->fld_id.'_'.$attribute_values->fld_id.'"';
                                        foreach($p_attrs->result() as $p_attr)
                                        {
                                            if($attribute_values->fld_id == $p_attr->fld_value){
                                                echo 'checked="checked" id="'.$attribute_values->fld_value.'"';
                                            }
                                        }
                                        echo '>'.$attribute_values->fld_value;
                                    echo '</div>';
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                    $children = get_children_by_par_id($attribute_values->fld_id);
                                    if(!empty($children))
                                    {
                                        foreach($children as $child)
                                        {//recursive level1
                                            echo '<div style="margin-left:20px;" id="row_'.$child->fld_id.'" style="float:left;">';
                                            echo $child->fld_value;
                                            echo '<script>$("#'.$attribute->fld_id.'_'.$attribute_values->fld_id.'").attr("id","'.$attribute_values->fld_id.'_'.$child->fld_id.'_'.url_title($child->fld_value).'");</script>';
                                            print_r(get_each_child($child));        //recursive to n level
                                            echo '</div>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <div class="clear"></div>
        <div id="coloured_images"></div>
        <?php foreach($colours as $clr):?>
        <div class="<?php echo $clr->fld_value;?> images_for_<?php echo $clr->fld_color;?>">
        <div class="label" style="color:#0a80ae;float:none;">Images for <?php echo $clr->fld_name;?></div>
        
        <div class="clear"></div>
        <?php 
            $this->load->helper('admin/product_helper');
            $product_image = get_product_image($clr->fld_product, $clr->fld_color);
        ?>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Temple View</div>
            <div id="sub" style="float: left;">
                <input type="file" name="old_primary_<?php echo $clr->fld_color;?>[]">
                <!--<input type="file" name="primary_<?php echo $clr->fld_color;?>[]" style="display:none;">-->
            </div>
            <div style="float: left;" id="product_img_0">
                <?php foreach($product_image as $p_img):?>
                <?php if($p_img->fld_primary==0):?>
                    <img height="20" style="margin: 3px 0 -3px 3px;" alt="temple view" src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name;?>" />
<!--                    <a onclick="delete_product_image(<?php echo $p_img->fld_id;?>,0);">
                        <img width="15" style="margin: 3px 0 -3px 3px;opacity:0.5;" alt="recycle" title="recycles" src="<?php echo base_url().'images/recycle.png';?>">
                    </a>-->
                <?php endif;?>
                    <?php endforeach;?>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Top View</div>
            <div id="sub" style="float: left;"><input type="file" name="old_img_<?php echo $clr->fld_color;?>[]"></div>
            <div style="float: left;" id="product_img_1">
                <?php foreach($product_image as $p_img):?>
                    <?php if($p_img->fld_primary==1):?>
                        <img width="40" style="margin: 3px 0 -3px 3px;" alt="temple view" src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name;?>">
<!--                        <a onclick="delete_product_image(<?php echo $p_img->fld_id;?>,1);">
                            <img width="15" style="margin: 3px 0 -3px 3px;opacity:0.5;" alt="recycle" src="<?php echo base_url().'images/recycle.png';?>">
                        </a>-->
                        <?php break;?>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Side View</div>
            <div id="sub" style="float: left;"><input type="file" name="old_img_<?php echo $clr->fld_color;?>[]"></div>
            <div style="float: left;" id="product_img_2">
                <?php foreach($product_image as $p_img):?>
                    <?php if($p_img->fld_primary==2):?>
                        <img height="20" style="margin: 3px 0 -3px 3px;" alt="temple view" src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name;?>">
<!--                        <a onclick="//delete_product_image(<?php echo $p_img->fld_id;?>,2);">
                            <img width="15" style="margin: 3px 0 -3px 3px;opacity:0.5;" alt="recycle" src="<?php echo base_url().'images/recycle.png';?>">
                        </a>-->
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Front View</div>
            <div id="sub" style="float: left;"><input type="file" name="old_img_<?php echo $clr->fld_color;?>[]"></div>
            <div style="float: left;" id="product_img_3">
                <?php foreach($product_image as $p_img):?>
                    <?php if($p_img->fld_primary==3):?>
                        <img height="20" style="margin: 3px 0 -3px 3px;" alt="temple view" src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name;?>">
<!--                        <a onclick="delete_product_image(<?php echo $p_img->fld_id;?>,3);">
                            <img width="15" style="margin: 3px 0 -3px 3px;opacity:0.5;" alt="recycle" src="<?php echo base_url().'images/recycle.png';?>">
                        </a>-->
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Try On Image</div>
            <div id="sub" style="float: left;"><input type="file" name="old_img_<?php echo $clr->fld_color;?>[]"></div>
            <div style="float: left;" id="product_img_4">
                <?php foreach($product_image as $p_img):?>
                    <?php if($p_img->fld_primary==4):?>
                        <img height="20" style="margin: 3px 0 -3px 3px;" alt="temple view" src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name;?>">
<!--                        <a onclick="delete_product_image(<?php echo $p_img->fld_id;?>,4);">    
                            <img width="15" style="margin: 3px 0 -3px 3px;opacity:0.5;" alt="recycle" src="<?php echo base_url().'images/recycle.png';?>">
                        </a>-->
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <hr/>
        </div>
        <?php endforeach;?>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Lens Compatibility</div>
            <div id="sub" style="float: left;">
                <?php foreach($compatibilities->result() as $compatibility):?>
                        <input type="checkbox"  name="compatibility[]" value="<?php echo $compatibility->fld_id;?>" <?php foreach($p_lens_compatibility->result() as $plc):if($compatibility->fld_id==$plc->fld_lens_type):echo 'checked="checked"';endif;endforeach;?>><?php echo $compatibility->fld_name;?>
                <?php endforeach;?>
            </div>
        </div>
        <?php if($product_type_id == 4){?>
        <div id="frame-size">
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Frame size</div>
            <div id="sub" style="float: left;display:inline-block;">
                <div class="size">
                    <img src="<?php echo base_url().'images/size/bridge_width.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="bridge_width" id="bridge_width" value="<?php echo $product->fld_size_bridge_width;?>" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/eye_size.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="eye_size" id="eye_size" value="<?php echo $product->fld_size_eye_size;?>" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/lens_height.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="lens_height" id="lens_height" value="<?php echo $product->fld_size_lens_height;?>" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/temple_arm.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="temple_arm" id="temple_arm" value="<?php echo $product->fld_size_temple_arm;?>" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/total_width.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="total_width" id="total_width" value="<?php echo $product->fld_size_total_width;?>" style="width:33px;margin-left:10px" /> mm
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Discount</div>
            <div id="sub" style="float: left;">
                <input type="text"  name="discount" id="discount" class="num_only" value="<?php echo $product->fld_discount;?>" maxlength="2" style="width:20px;"> %
            </div>
        </div>
        </div>
        <?php }?>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Status</div>
            <div id="sub" style="float: left;">
                <select name="status">
                    <option value="1" <?php if($product->fld_status==1)echo 'selected="selected"';?>>Show</option>
                    <option value="0" <?php if($product->fld_status==0)echo 'selected="selected"';?>>Hide</option>
                </select></div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Quantity On Stock</div>
            <div id="sub" style="float: left;"><input type="text" name="stock" value="<?php echo $product->fld_stock;?>"  class="input"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Shelf Location</div>
            <div id="sub" style="float: left;"><input type="text" name="shelf" value="<?php echo $product->fld_shelf;?>" class="input"></div>
        </div>
        <div class="clear"></div>
        <div><input type="submit" class="submit" value="Submit"></div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<style>
    .size{
        display: inline-block;
    }
</style>
<script>
var count=0;
$(document).ready(function(){
    $('#frm_product').validate({
        rules:{

            name:{
                required:true   
            },
            cp:{
//                required:true,
                number:true
            },
            price:{
                required:true,
                number:true
            },
            code:{
                required:true   
            },
            stock:{
                required:true,
                number:true
            }
                      
        },
        messages:{

            name:{
                required:"Please enter name."   
            },
            cp:{
//                required:"Please enter cost price.",
                number:"Please enter numerical value."
            },
            price:{
                required:"Please enter price.",
                number:"Please enter numerical value."
            },
            code:{
                required:"Please enter code."   
            },
            stock:{
                required:"Please enter stock quantity.",
                number:"Please enter numerical value."
             }
            
        }
    });
    
    $(".num_only").keydown(function(event) {
        // Allow: backspace, delete, tab and escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
    
    $(".frame_color").click(function(){
        var id = this.id;
        var attr = id.split('_');
        var attr_id = attr[0];
        var attr_value = attr[2];
        var html = '<div class="images_for_'+attr_id+'"><div class="label" style="color:#0a80ae;float:none;">Images for: '+attr_value+'</div>';
        if($('#'+id).is(':checked')){
                html = html+image_html(attr_id)+"<hr></div>";
                $(html).insertAfter("#coloured_images");
        }
        else{
            if(confirm('Are you sure you want to remove this Value?')==true){
                $.ajax({
                    url:base_url+'admin/product/delete_color_images/'+attr_id+'/'+<?php echo $product->fld_id;?>,
                    type:'POST'
                });
                $(".images_for_"+attr_id).remove();
            }else{$(this).prop('checked','checked')}
        }
    });
});  
function image_html(attr_id){
//    if(count==0)attr_id="default_"+attr_id;
    var image_html =   '<div style="overflow: auto;">'+
                        '<div id="sub_"class="label" style="float:left;">Temple View</div>'+
                        '<div id="sub" style="float: left;">'+
                            '<input type="file" name="edit_primary_'+attr_id+'[]"/>'+
//                            '<input type="file" name="edit_primary_'+attr_id+'[]" style="display:none;"/>'+
                        '</div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_" class="label" style="float:left;">Top View</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="edit_img_'+attr_id+'[]"/></div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_" class="label" style="float:left;">Side View</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="edit_img_'+attr_id+'[]"/></div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_" class="label" style="float:left;">Front View</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="edit_img_'+attr_id+'[]"/></div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_" class="label" style="float:left;">Try On Image</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="edit_img_'+attr_id+'[]"/></div>'+
                    '</div>';
    return image_html;
}
</script>

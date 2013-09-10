<?php $this->load->helper('admin/attributes_helper')?>
<script>
    var count=0; //to select the primary and default frame in user page;
    $(function(){
        $('input:checkbox').removeAttr('checked');
    });    
function image_html(attr_id,count){
    if(count==0)attr_id="default_"+attr_id;
    var image_html =   '<div style="overflow: auto;">'+
                        '<div id="sub_"class="label" style="float:left;">Temple View</div>'+
                        '<div id="sub" style="float: left;">'+
                            '<input type="file" name="primary_'+attr_id+'[]">'+
                            '<input type="file" name="primary_'+attr_id+'[]" style="display:none;">'+
                        '</div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_"class="label" style="float:left;">Top View</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="img_'+attr_id+'[]"></div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_"class="label" style="float:left;">Side View</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="img_'+attr_id+'[]"></div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_"class="label" style="float:left;">Front View</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="img_'+attr_id+'[]"></div>'+
                    '</div>'+
                    '<div style="overflow: auto;">'+
                        '<div id="sub_"class="label" style="float:left;">Try On Image</div>'+
                        '<div id="sub" style="float: left;"><input type="file" name="img_'+attr_id+'[]"></div>'+
                    '</div>';
    return image_html;
}
function att(product_type_id)
{
    if(product_type_id=="" || product_type_id==null)
    {   product_type_id = 1;    }
    window.location.href="<?php echo base_url();?>admin/product/insert/" + product_type_id;
}

function subcategory(cat_id)
{
    var url = "<?php echo base_url();?>admin/product/subcategory/" + cat_id;
    $.getJSON(url, {ajax:1}, function(data)
    {
        var html = '<select name="sub_category" style="width:173px;">';
        $.each(data, function(index, array) {
        html = html +'<option value="' + array['fld_id'] +'">' + array['fld_name']+'</option>';
        
        });
        html = html +'</select>';
        document.getElementById('sub_').innerHTML = 'Sub Category';
        $("#sub").html(html);
				
    });
}

function add_coloured_images(attr){
    attr = attr.split("_");
    var attr_id = attr[0];
    var attr_value_id = attr[1];
    var attr_value = attr[2];
    var html = '<div class="images_for_'+attr_value+'"><div class="label" style="color:#0a80ae;float:none;">Images for :'+attr_value+'</div>';
    html = html+image_html(attr_id)+"</div><hr>";
    $(html).insertBefore("#coloured_images");
    
}
$(function(){
    $(".frame_color").click(function(){
        var id = this.id;
        var attr = id.split("_");
        var attr_id = attr[0];
        var attr_value_id = attr[1];
        var attr_value = attr[2].replace("-",' ');
        var html = '<div class="images_for_'+attr_id+'"><div class="label" style="color:#0a80ae;float:none;">Images for :'+attr_value+'</div>';
        if($('#'+id).is(':checked')){
            html = html+image_html(attr_id, count)+"<hr></div>";
            $(html).insertBefore("#coloured_images");
            count++;
        }
        else $(".images_for_"+attr_id).remove();
        
//        var html = '<div class="images_for_'+attr_value+'"><div class="label" style="color:#0a80ae;float:none;">Images for :'+attr_value+'</div>';
    });
});

function check_all(element)
{
    var i=-1;
    if($(element).is(':checked')){
            $(".compatibility").each(function(){
            if($(this).prop('checked')){
                i = 0;
            }
            if(i==0){
                $(this).prop('checked','checked');
            }else if(i==-1){
                $(this).removeProp('checked');
            }
            //alert(this.value);
        });
        }
}
</script>

<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations"><div class="operation">Fill the form below</div></div>
        <div class="clear"></div>
        <form name="frm_product" id="frm_product" method="post" action="<?php echo base_url();?>admin/product/add" enctype="multipart/form-data">
        <div style="overflow: auto;">
            <div class="label" style="float: left;">Product Type</div>
            <div style="float: left;">
            <?php foreach($product_types->result() as $product_type):?>
                <input type="radio" name="product_type" onclick="att(<?php echo $product_type->fld_id;?>);" value="<?php echo $product_type->fld_id;?>"
                    <?php if(isset($product_type_id)):?>
                        <?php if($product_type->fld_id==$product_type_id)echo 'checked="checked"';?>
                    <?php endif;?>   
                >
                    <?php echo $product_type->fld_name;?>
            <?php endforeach;?>
            </div>
        </div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Name</div>
            <div style="float:left;"><input type="text" id="name" name="name" maxlength="30" class="input"></div>
        </div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Description</div>
            <div style="float:left;"><textarea name="desc" id="desc" class="input_textarea"></textarea></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Cost Price</div>
            <div style="float:left;"><input type="text" id="cp" name="cp" maxlength="30" class="input"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Price</div>
            <div style="float:left;"><input type="text" id="price" name="price" maxlength="30" class="input"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Item Code</div>
            <div style="float:left;"><input type="text" id="code" name="code" maxlength="30" class="input"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow:auto;">
            <div class="label" style="float:left;">Vendor</div>
            <div style="float:left;">
                <select name="vendor">
                    <?php foreach($vendors->result() as $vendor):?>
                    <option value="<?php echo $vendor->fld_id;?>"><?php echo $vendor->fld_name;?></option>
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
                    <option value="<?php echo $category->fld_id;?>" onclick="subcategory(<?php echo $category->fld_id;?>);"><?php echo $category->fld_name;?></option>
                    <?php endforeach;?>
                </select>
                
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">&nbsp;</div>
            <div id="sub" style="float: left;"></div>
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
                                    echo '<input type="checkbox" name="attribute[]" value="'.$attribute->fld_id.'_'.$attribute_values->fld_id.'" '.$id.' '.$class.' >'.$attribute_values->fld_value;
                                    echo '</div>';
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                    $children = get_children_by_par_id($attribute_values->fld_id);
                                    if(!empty($children))
                                    {
                                        foreach($children as $child)
                                        {//recursive level1
                                            echo '<div style="margin-left:20px;" id="row_'.$child->fld_id.'">';
                                            echo $child->fld_value;
                                            echo '<script>$("#'.$attribute->fld_id.'_'.$attribute_values->fld_id.'").attr("id","'.$attribute_values->fld_id.'_'.$child->fld_id.'_'.url_title($child->fld_value).'");</script>'; //this script is to change the id of its checkbox so that it would be helpful to input the images for respective color;
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
        <div id="coloured_images"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Lens Compatibility</div>
            <div id="sub" style="float: left;">
                <?php foreach($compatibilities->result() as $compatibility):?>
                        <input type="checkbox"  name="compatibility" class="compatibility" value="<?php echo $compatibility->fld_id;?>" onclick="check_all(this);"><?php echo $compatibility->fld_name;?>
                <?php endforeach;?>
            </div>
        </div>
        <!--//////////////frame size/////////////////////////-->
        <?php if(isset($size)){?>
        <div id="frame-size">
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Frame size</div>
            <div id="sub" style="float: left;display:inline-block;">
                <div class="size">
                    <img src="<?php echo base_url().'images/size/eye_size.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="eye_size" id="eye_size" value="" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/bridge_width.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="bridge_width" id="bridge_width" value="" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/temple_arm.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="temple_arm" id="temple_arm" value="" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/lens_height.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="lens_height" id="lens_height" value="" style="width:33px;margin-left:10px" /> mm
                </div>
                <div class="size">
                    <img src="<?php echo base_url().'images/size/total_width.jpg'?>" style="width: 60px;" /><br/>
                    <input type="text" name="total_width" id="total_width" value="" style="width:33px;margin-left:10px" /> mm
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Discount</div>
            <div id="sub" style="float: left;">
                <input type="text"  name="discount" id="discount" class="num_only" value="" maxlength="2" style="width:20px;"> %
            </div>
        </div>
        </div>
        <?php }?>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Status</div>
            <div id="sub" style="float: left;">
                <select name="status">
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                </select></div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Quantity On Stock</div>
            <div id="sub" style="float: left;"><input type="text" class="input" name="stock"></div>
        </div>
        <div class="clear"></div>
        <div style="overflow: auto;">
            <div id="sub_"class="label" style="float:left;">Shelf Location</div>
            <div id="sub" style="float: left;"><input type="text" class="input" name="shelf"></div>
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
//        errorPlacement:function(error,element)
//        {
//            if(element.attr("name") == "fld_username") {error.appendTo('#username');$('#username').css('display','block');}
//            if(element.attr("name") == "fld_password") {error.appendTo('#password');$('#password').css('display','block');}
//        }
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
   
});    

</script>
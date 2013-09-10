<style>
    .clear_left{clear:left;}
    ._input{margin-bottom: 5px;}
</style>
<?php 
    if(isset($edit_accessory)){
        $id = '_'.$edit_accessory->fld_id;
        $name = $edit_accessory->fld_name;
        $item_code = $edit_accessory->fld_item_code;
        $color = $edit_accessory->fld_color;
        $cp = $edit_accessory->fld_cp;
        $dis = $edit_accessory->fld_discount;
        $sp = $edit_accessory->fld_sp;
        $qty = $edit_accessory->fld_qty;
        $shelf_loc = $edit_accessory->fld_shelf_location;
        $desc=$edit_accessory->fld_description;
        $status=$edit_accessory->fld_status;
        $img_loc =$edit_accessory->fld_location;
        $img = $edit_accessory->fld_image;
        $action = base_url().'admin/product/update_accessories/'.$edit_accessory->fld_id;
        $display ='display:inline-block';
        $display_file ='class="left" style="display:none"';
    }else{
        $id="";
        $name = "";
        $item_code = "";
        $color = "";
        $cp = "";
        $dis = "";
        $sp = "";
        $qty = "";
        $shelf_loc = "";
        $desc="";
        $status="";
        $action = base_url().'admin/product/insert_accessories';
        $display_file ='style="display:block"';
        $display ='display:none';
    }
?>

<div class="container">
    <?php echo $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if(isset($msg_acc)):?>
        <div class="flash_msg">
            <?php echo $msg_acc;?>
        </div>
        <?php endif;?>
        <div class="operations"><div class="operation">Fill the form below</div></div>
        <div style='border:1px solid #ccc;padding:2px 5px'>
            <a class="operation" href="<?php echo base_url().'admin/product'?>">[ View Frames ]</a>
            <?php 
                if(isset($edit_accessory))
                    echo '<a class="operation" href="'.base_url().'admin/product/add_accessories">[ Add Accessory ]</a>';
            ?>
        </div>
        <div class="clear"></div>
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
        <div class="accessories_input">
            <form name="frm_product" id="frm_product" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
                <div class="label">Name</div>
                <div class="_input" style="margin-top:5px;"><input type="text" value="<?php echo $name;?>" name="name" id="name" maxlength="40"/></div>
                <div class="clear_left label">Item Code</div>
                <div class="_input"><input type="text" value="<?php echo $item_code;?>" name="item_code" id="item_code" maxlength="40"/></div>
                <div class="clear_left label">Cost Price</div>
                <div class="_input"><input type="text" value="<?php echo $cp;?>" name="cp" id="cp" maxlength="7" onblur="check_disc();"/></div>
                <div class="clear_left label">Discount</div>
                <div class="_input"><input type="text" value="<?php echo $dis;?>" name="discount" id="discount" maxlength="2" onblur="set_sp();"/></div>
                <div class="clear_left label">Selling Price</div>
                <div class="_input"><input type="text" value="<?php echo $sp;?>" name="sp" id="sp" maxlength="7" readonly="readonly"/></div>
                <div class="clear_left label">Shelf Location</div>
                <div class="_input"><input type="text" value="<?php echo $shelf_loc;?>" name="shelf_loc" id="shelf_loc" maxlength="7"/></div>
                <div class="clear_left label">Description</div>
                <div class="_input"><textarea name="desc" id="desc" value=""><?php echo $desc;?></textarea></div>
                <div class="clear_left label">Status</div>
                <div class="_input">
                    <select name="status" id="status">
                        <option value="1" <?php if(isset($edit_accessory) && (1 == $status))echo 'selected="selected"'?>>Show</option>
                        <option value="0" <?php if(isset($edit_accessory) && (0 == $status))echo 'selected="selected"'?>>Hide</option>
                    </select>
                </div>
                <?php if($edit_attr):
                    foreach($edit_attr as $attr):
?><input type ="hidden" name="attr_id[]" id="attr_id[]" value="<?php echo $attr->fld_id;?>" />
                <div id="values_temp_<?php echo $attr->fld_id;?>">
                <div class="clear_left label">&nbsp;</div>
                    <div class="_input" style="display: inline-block;">Color<br/><input type="text" value="<?php echo $attr->fld_color;?>" name="color_old[]" id="color[]" maxlength="25"/></div>
                    <div class="_input" style="display: inline-block;">Quantity<br/><input type="text" onblur="set_qty();" value="<?php echo $attr->fld_qty;?>" name="qty_color_old[]" class="qty_color" id="qty_color[]" maxlength="7"/></div>
                    <div class="_input" style="display: inline-block;"><br/>
                        <input type="file" value="" name="image_old[]" id="image_<?php echo $attr->fld_id;?>" <?php echo $display_file?>/>
                        <div class="accessory_img_<?php echo $attr->fld_id;?>" style="<?php echo $display;?>">
                            <table>
                                <tr>
                                    <td>
                                        <img class="img" src="<?php echo base_url().$attr->fld_location.'/'.$attr->fld_image;?>" width="75" style="vertical-align: middle;<?php echo $display;?>"/>
                                    </td>
                                    <td>
                                        <a href="javascript:" onclick="browse_new_img(this)" id="<?php echo $attr->fld_id;?>">
                                            <img class="img" src="<?php echo base_url().'images/recycle.png'?>" style="<?php echo $display;?>"/><br/>
                                        </a>
                                    </td>
                                </tr>
                            </table>                            
                        </div>
                    </div><a href="javascript:void(0);" class="add_attribute_values" onclick="add_color(this.name);"  name="values_0">[+]</a>&nbsp;&nbsp;
                    <a href="javascript:void(0);" class="remove_attribute_values" onclick="hide_color(this.name);" name="values_temp_<?php echo $attr->fld_id;?>">[X]</a>
                </div>
                
                <?php endforeach;else:?>
                <div id="values_0">
                <div class="clear_left label">&nbsp;</div>
                    <div class="_input" style="display: inline-block;">Color<br/><input type="text" value="<?php echo $color;?>" name="color_new[]" id="color[]" maxlength="25"/></div>
                    <div class="_input" style="display: inline-block;">Quantity<br/><input type="text" onblur="set_qty();" value="<?php echo $qty;?>" name="qty_color_new[]" class="qty_color" id="qty_color[]" maxlength="7"/></div>
                    <div class="_input" style="display: inline-block;"><br/>
                        <input type="file" value="" name="image_new[]" id="image_[]" <?php echo $display_file?>/>
                    </div><a href="javascript:void(0);" class="add_attribute_values" onclick="add_color();"  name="values_0">[+]</a>&nbsp;&nbsp;
                </div>
                <?php endif;?>
            <div id="quantity">
                <div class="clear_left label">Total Quantity</div>
                <div class="_input"><input type="text" value="<?php echo $qty;?>" name="qty" id="qty" maxlength="7"/></div>
            </div>
                <input type="submit" value="Submit" name="submit" id="submit"/>
            </form>
        </div>
        <div class="accessories_info" id="accessories_info">
            <div class="table">
                <div class="tr headings">
                    <div class="td name">Name</div>
                    <div class="td image">Image</div>
                    <div class="td price">Price $</div>
                    <div class="td discount">Dis %</div>
                    <div class="td price">Dis Price $</div>
                    <div class="td shelf">Shelf</div>
                    <div class="td status">Status</div>
                    <div class="td">Controllers</div>
                </div>
                <?php foreach($accessories->result() as $key=>$accessory):?>
                <div class="tr" id="row_<?php echo $accessory->fld_id;?>">
                    <div class="td name"><?php echo $accessory->fld_name;?></div>
                    <div class="td image"><img src="<?php echo base_url().$accessory->fld_location.'/'.$accessory->fld_image;?>"/></div>
                    <div class="td price"><?php echo $accessory->fld_cp;?></div>
                    <div class="td discount"><?php echo $accessory->fld_discount;?></div>
                    <div class="td price"><?php echo $accessory->fld_sp;?></div>
                    <div class="td shelf"><?php echo $accessory->fld_shelf_location;?></div>
                    <div class="td status">
                        <?php
                        if($accessory->fld_status==0)
                            echo 'Hide';
                        else echo 'Show';
                        ?>
                    </div>
                    <div class="td">
                        <a class="operation" href="<?php echo base_url().'admin/product/add_accessories/'.$accessory->fld_id;?>">[ Edit ]</a>
                        <a class="operation delete" href="javascript:" id="<?php echo $accessory->fld_id;?>" name="<?php echo base_url().'admin/product/delete_accessories/'.$accessory->fld_id;?>">[ Delete ]</a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>


<script>
function att(product_type_id)
{
    if(product_type_id=="" || product_type_id==null)
    {   product_type_id = 1;    }
    window.location.href="<?php echo base_url();?>admin/product/insert/" + product_type_id;
}
//this.parent('.accessory_imge').hide();
function browse_new_img(element){
    $('.accessory_img_'+element.id).hide();
    $("#image_"+element.id).css({
        'display':'block',
        'float':'none'
    });
}
var cp;
var dis;
var sp;
var qty;
function populate(){
    cp = $('#cp').val();
    dis = $('#discount').val();
}
function calculate_sp(){
    sp = parseFloat(cp - (cp*dis/100)).toFixed(2);
}
function set_sp(){
    populate();
    calculate_sp();
    $('#sp').val(sp);
}
function check_disc(){
    populate();
    if(dis!='' || dis!=null){
        calculate_sp();
        $('#sp').val(sp);
    }
}
var count = 1;
function add_color()
{
    var html = "";
    var html = '<div id="values_'+count+'">'+
                    '<div class="clear_left label">&nbsp;</div>'+
                    '<div class="_input" style="display: inline-block;">Color<br/><input type="text" value="" name="color_new[]" id="color_new[]" maxlength="25"/></div>  '+
                    '<div class="_input" style="display: inline-block;">Quantity<br/><input type="text" value="" name="qty_color_new[]" class="qty_color" id="qty_color[]"onblur="set_qty();" maxlength="7"/></div>  '+
                    '<div class="_input" style="display: inline-block;"><br/>'+
                        '<input type="file" value="" name="image_new[]" id="image[]" />'+
                    '</div><a href="javascript:void(0);" class="add_attribute_values" onclick="add_color();"  name="values_'+count+'">[+]</a>&nbsp;&nbsp;'+
                    '<a href="javascript:void(0);" class="remove_attribute_values" onclick="hide_color(this.name);" name="values_'+count+'">[X]</a><br/>'+
                    '</div>';
                $(html).insertBefore('#quantity');
                count++
}

function hide_color(id)
{
    $('#'+id).find('input:text').val('');
//        attr('value','');
    $("#"+id).slideUp(200);
    set_qty();
}

function set_qty()
{
//    alert($('.qty_color').length);
    var sum = 0;
    $('.qty_color').each(function(){
        if($(this).val())
        sum += parseInt($(this).val(), 10);
    });
    $('#qty').val(sum);
}
</script>
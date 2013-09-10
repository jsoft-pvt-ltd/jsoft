<link rel='stylesheet' type='text/css' href="<?php echo base_url().'css/admin/contact_lens.css'?>"/>

<?php 
    if(isset($edit_lens)){
        $id = '_'.$edit_lens->fld_id;
        $name = $edit_lens->fld_name;
        $brand_id = $edit_lens->fld_brand;
        $cp = $edit_lens->fld_cp;
        $lens_per_box = $edit_lens->fld_lpb;
        $dis = $edit_lens->fld_discount;
        $sp = $edit_lens->fld_sp;
        $discount_price = $edit_lens->fld_discount_price;
        $qty = $edit_lens->fld_quantity;
        $desc=$edit_lens->fld_description;
        $img_loc =$edit_lens->fld_location;
        $img = $edit_lens->fld_image;
        $action = base_url().'admin/contact_lens/update_lens/'.$edit_lens->fld_id;
        $display ='display:inline-block';
        $display_file ='class="left" style="display:none"';
    }else{
        $id="";
        $name = "";
        $brand_id = "";
        $cp = "";
        $lens_per_box = "";
        $dis = "";
        $sp = "";
        $qty = "";
        $discount_price = '';
        $desc="";
        $action = base_url('admin/contact_lens/insert_lens');
        $display_file ='style="display:block"';
        $display ='display:none';
    }
?>

<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if(isset($msg1)):?>
        <div class="flash_msg">
            <?php echo $msg1;?>
        </div>
        <?php endif;?>
        <div class="operations">
            <div class="operation">
                Fill the form below
            </div>
        </div>
        <div class="actions">
            <a href="<?php echo base_url().'admin/contact_lens'?>" class="operation">[ View Contact Lens ]</a>
            <a href="<?php echo base_url().'admin/contact_lens/add_brands'?>" class="operation">[ Add Brands ]</a>
            <a href="<?php echo base_url().'admin/contact_lens/view_brands'?>" class="operation">[ View Brands ]</a>
        </div>
        <div class="lens_input">
            <form name="frm_product" id="frm_product" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
                <div class="input_holder">
                    <div class="label">Name</div>
                    <div class="_input" style="margin-top:5px;"><input type="text" value="<?php echo $name;?>" name="name" id="name" maxlength="40"/></div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Brand</div>
                    <div class="_input">
                        <select name="brand" id="brand">
                            <?php foreach($brands->result() as $brand):?>
                            <?php if($brand_id == $brand->fld_id):?>
                            <option value="<?php echo $brand->fld_id;?>" selected="selected"><?php echo $brand->fld_name?></option>
                            <?php else:?>
                            <option value="<?php echo $brand->fld_id;?>"><?php echo $brand->fld_name?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Image</div>
                    <div class="_input">
                        <input type="file" name="image" value="" id="image" <?php echo $display_file?>/>
                        <?php if(isset($edit_lens)):?>
                            <div class="edit_img">
                                <img src="<?php echo base_url().$img_loc.'/thumbs/'.$img;?>" height="30"/>
                                <img src="<?php echo base_url().'images/recycle.png'?>" style="cursor: pointer;" onclick="browse_new_img();"/>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Description</div>
                    <div class="_input">
                        <textarea id="desc" name="desc"><?php echo $desc;?></textarea>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Lenses Per Box</div>
                    <div class="_input">
                        <input type="text" name="lpb" id="lpb" maxlength="3" value="<?php echo $lens_per_box;?>"/>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Cost Price</div>
                    <div class="_input">
                        <input type="text" name="cp" id="cp" maxlength="7" value="<?php echo $cp;?>"/>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Selling Price</div>
                    <div class="_input">
                        <input type="text" name="sp" id="sp" maxlength="7" onblur="check_disc();" value="<?php echo $sp;?>"/>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Discount</div>
                    <div class="_input">
                        <input type="text" name="dis" id="dis" maxlength="2" value="<?php echo $dis;?>" onblur="set_new_sp();"/>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Dis. Price</div>
                    <div class="_input">
                        <input type="text" name="dis_price" id="dis_price" maxlength="7" readonly="readonly" value="<?php echo $discount_price;?>"/>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Quantity</div>
                    <div class="_input">
                        <input type="text" name="qty" id="qty" maxlength="4" value="<?php echo $qty;?>"/>
                    </div>
                </div>
                <input type="submit" value="Submit"/>
            </form>
        </div>
    </div>
</div>
<script>
var dis;
var sp;
var dis_price
function populate(){
    sp = $('#sp').val();
    dis = $('#dis').val();
}
function calculate_new_sp(){
    dis_price = parseFloat(sp - (sp*dis/100)).toFixed(2);
}
function set_new_sp(){
    populate();
    calculate_new_sp();
    $('#dis_price').val(dis_price);
}
function check_disc(){
    populate();
    if(dis!='' || dis!=null){
        calculate_new_sp();
        $('#dis_price').val(dis_price);
    }
}

function browse_new_img(element){
    $('.edit_img').hide();
    $("#image").css({
        'display':'block',
        'float':'none'
    });
}
</script>
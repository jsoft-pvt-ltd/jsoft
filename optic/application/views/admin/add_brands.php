<link rel='stylesheet' type='text/css' href="<?php echo base_url().'css/admin/contact_lens.css'?>"/>
<?php
if(isset($brand)){
    $name=$brand->fld_name;
    $desc=$brand->fld_description;
    $action=base_url().'admin/contact_lens/update_brands/'.$brand->fld_id;
    $browser_display = 'style="display:none;"';
    $img_display ='style="display:block"';
}else{
    $name="";
    $desc="";
    $action=base_url().'admin/contact_lens/insert_brands';
    $browser_display = 'style="display:block;"';
    $img_display ='style="display:none";';
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
            <a href="<?php echo base_url().'admin/contact_lens/add_lenses'?>" class="operation">[ Add Contact Lens ]</a>
            <a href="<?php echo base_url().'admin/contact_lens'?>" class="operation">[ View Contact Lens ]</a>
            <a href="<?php echo base_url().'admin/contact_lens/view_brands'?>" class="operation">[ View Brands ]</a>
        </div>
        <div class="brands_container">
            <form name="frm_product" id="frm_product" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
                <div class="input_holder">
                    <div class="label">Name</div>
                    <div class="_input" style="margin-top:5px;"><input type="text" value="<?php echo $name;?>" name="name" id="name" maxlength="40"/></div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Description</div>
                    <div class="_input">
                        <textarea name="desc" id="desc"><?php echo $desc;?></textarea>
                    </div>
                </div>
                <div class="input_holder">
                    <div class="clear_left label">Image</div>
                    <div class="_input">
                        <input type="file" name="image" value="" id="image" <?php echo $browser_display?>/>
                        <?php if(isset($brand)):?>
                            <div class="edit_img">
                                <img src="<?php echo base_url().$brand->fld_location.'/'.$brand->fld_image;?>"/>
                                <img src="<?php echo base_url().'images/recycle.png'?>" style="cursor: pointer;" onclick="set_browser();"/>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
                <input type="submit" value="Submit"/>
            </form>
        </div>
    </div>
</div>
<script>
    function set_browser(){
        $(".edit_img").hide();
        $('#image').show();
    }
</script>
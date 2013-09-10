<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation"><?php
                echo $title;
            ?></div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/package_attributes">[ View Package Attributes]</a>
        </div>
        <?php 
            if(isset($attribute->fld_name)){
                $action = base_url().'admin/package_attributes/update_package_attr/'.$attribute->fld_id;
            }else $action = base_url().'admin/package_attributes/insert_package_attr';
        ?>
        <form name="frm_package_attr" id="frm_package_attr" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
            <div class="clear"></div>
            <div style="overflow: auto;">
            <div class="label" style="float: left;">Package Attribute:</div>
            <input type="text" style="width:300px" name="package_attr" value="<?php if(isset($attribute->fld_name))echo $attribute->fld_name;?>">
            <br/>
            <input type="submit" name="submit" value="<?php if(isset($attribute->fld_name))echo 'Done';else echo 'Submit';?>">
        </form>
    </div>
</div>
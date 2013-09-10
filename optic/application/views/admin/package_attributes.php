<a href="javascript:void(0);" class="insert_package" onclick="manager();">
    [Add Package Attributes]
</a>

<div>
    <?php foreach($attributes->result() as $attribute):?>
    <?php echo $attribute->fld_name;?><br/>
    <?php endforeach;?>
</div>

<div class="overlay"></div>
<div class="popup">
    <form name="frm_package_attributes" id="frm_package_attributes" action="<?php echo base_url().'admin/package_attributes_controller/insert_package_attributes';?>" method="post" enctype="multipart/form-data">
    <div class="parent" id="new_package_value_0">
        Package Attribute: 
            <input type="text" id="name[]" name="name[]" maxlength="40" value=""/>
<!--        Price: 
            <input type="text" id="price[]" name="price[]" maxlength="10" value=""/>-->
            <a href="javascript:void(0);" onclick="add_package_attributes();">[+]</a>
    </div>
    <div class="popup_actions">
        <input type="submit" value="Done" name="submit"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="clear_popup('new_attribute');">Cancel</a>
    </div>
    </form>
</div>
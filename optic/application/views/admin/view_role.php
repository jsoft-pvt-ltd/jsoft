<script>
function toggle(element,id)
{
    ele = element.id;
   
    var element_id = element.id+id;
    $(element).next().next().toggle(50);
}
</script>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/role/index">View</a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/role/insert">Add</a></div>
        </div>
        <div class="clear"></div>
        <?php $count_role=1;?>
        <?php foreach($roles->result() as $role):?>
            <div>
                <div class="label" style="float: left;width: 130px;"><?php echo $count_role.' . '.$role->fld_role;?></div>
                <a class="operation" href="<?php echo base_url().'admin/role/edit/'.$role->fld_id;?>" onclick="return confirm('Please Confirm');">Edit</a>
                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <a class="operation" href="<?php echo base_url().'admin/role/delete/'.$role->fld_id;?>" onclick="return confirm('Please Confirm');">Delete</a>
            </div>
            <div class="clear"></div>
            
            <?php $this->load->helper('admin/privilege_helper');$privilege_modules = select($role->fld_id);?>
            <?php $count=1;?>
            <?php foreach($privilege_modules->result() as $privilege_module):?>
                <?php $module_name = explode(" ",$privilege_module->fld_name);?>
                <div id="<?php echo $module_name[0];?>" class="label role" style="margin-left: 130px;cursor: pointer;float:none;" onclick="toggle(this,<?php echo $privilege_module->fld_id;?>)"><?php echo ' &raquo; '.$privilege_module->fld_name;?></div>
                <div class="clear"></div>
                
                <?php $this->load->helper('admin/privilege_helper');$privilege = select_privilege($role->fld_id,$privilege_module->fld_id);?>
                <div id="<?php echo $module_name[0].$privilege_module->fld_id;?>" class="privileges" style="margin-left: 210px;display:none;">
                    <div class="privilege">
                        <input type="checkbox" name="privilege[]" <?php if($privilege->fld_insert==1)echo 'checked="checked"';?> value="insert_<?php echo $privilege_module->fld_id;?>" disabled="disabled">Insert</div>
                    <div class="privilege">
                        <input type="checkbox" name="privilege[]" <?php if($privilege->fld_update==1)echo 'checked="checked"';?> value="update_<?php echo $privilege_module->fld_id;?>" disabled="disabled">Update</div>
                    <div class="privilege">
                        <input type="checkbox" name="privilege[]" <?php if($privilege->fld_delete==1)echo 'checked="checked"';?> value="delete_<?php echo $privilege_module->fld_id;?>" disabled="disabled">Delete</div>
                    <div class="privilege">
                        <input type="checkbox" name="privilege[]" <?php if($privilege->fld_view==1)echo 'checked="checked"';?> value="view_<?php echo $privilege_module->fld_id;?>" disabled="disabled">View</div>
                </div>
                <div class="clear"></div>
                <?php $count++;?>
            <?php endforeach;?>
            <div class="clear"></div>
            <div class="clear"></div>
            <?php $count_role++;?>
        <?php endforeach;?>
    </div>
</div>

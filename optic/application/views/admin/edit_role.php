<script>
function toggle(element,id)
{
    var element_id = element.id+id;
    $('#'+element_id).toggle('slow');
}
</script>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/role/index">View</a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/role/insert">Add</a></div>
        </div>
        <div class="clear"></div>
        <form id="frm_create_role" name="frm_create_role" method="post" action="<?php echo base_url().'admin/role/update/'.$role->fld_id;?>" >
            <div>Please edit the form</div>
            <div class="clear"></div>
            <div class="label" style="float:none;">Role</div>
            <div class="clear"></div>
            <div><input type="text" class="input" id="role" name="role" maxlength="30" value="<?php if(isset($role->fld_role))echo $role->fld_role;?>"></div>
            <div class="clear"></div>
            <div class="label" style="background: #f0f0f0;padding: 5px 0;">Privilege Module(s)</div>
            <div class="clear"></div>
            <?php foreach($privilege_modules->result() as $privilege_module):?>
            <!--===================sabai modules haru===============================-->
            <?php $privilege_module_name = explode(" ",$privilege_module->fld_name);?>
            <div id="<?php echo $privilege_module_name[0];?>" class="label role" style="cursor:pointer;float:none;" onclick="toggle(this,<?php echo $privilege_module->fld_id;?>)">
                
                <?php $this->load->helper('admin/privilege_helper');$modules = select($role->fld_id);?>
<!--                <input type="checkbox" name="module" <?php foreach($modules->result() as $module):?><?php if($privilege_module->fld_id==$module->fld_id)echo 'checked="checked"';?><?php endforeach;?> disabled="disabled" >-->
                    <?php echo ' &raquo; '.$privilege_module->fld_name;?>
            </div>
            
            <div class="clear"></div>
            
            <div id="<?php echo $privilege_module_name[0].$privilege_module->fld_id;?>" class="privileges" style="display:none;margin-left: 110px;">
                                
                <?php $this->load->helper('admin/privilege_helper');$privilege = select_privilege($role->fld_id,$privilege_module->fld_id);?>
                                                
                <div class="privilege"><input type="checkbox" name="privilege[]" <?php if(!empty($privilege) && $privilege->fld_insert==1)echo 'checked="checked"';?> value="insert_<?php echo $privilege_module->fld_id;?>">Insert</div>
                <div class="privilege"><input type="checkbox" name="privilege[]" <?php if(!empty($privilege) && $privilege->fld_update==1)echo 'checked="checked"';?> value="update_<?php echo $privilege_module->fld_id;?>">Update</div>
                <div class="privilege"><input type="checkbox" name="privilege[]" <?php if(!empty($privilege) && $privilege->fld_delete==1)echo 'checked="checked"';?> value="delete_<?php echo $privilege_module->fld_id;?>">Delete</div>
                <div class="privilege"><input type="checkbox" name="privilege[]" <?php if(!empty($privilege) && $privilege->fld_view==1)echo 'checked="checked"';?> value="view_<?php echo $privilege_module->fld_id;?>">View</div>
                
                
            </div>
            <div class="clear"></div>
            <!--            ===================sabai modules haru===============================-->
            <?php endforeach;?>
            <div class="clear"></div>
            <div><input type="submit" class="submit" value="Edit Role"></div>
            
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#frm_create_role').validate({
        rules:{

            role:{
                required:true   
            }
                      
        },
        messages:{

            role:{
                required:"Please enter role."   
            }
            
        }
//        errorPlacement:function(error,element)
//        {
//            if(element.attr("name") == "fld_username") {error.appendTo('#username');$('#username').css('display','block');}
//            if(element.attr("name") == "fld_password") {error.appendTo('#password');$('#password').css('display','block');}
//        }
    });
   
});    

</script>    
    </div>
</div>
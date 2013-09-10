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
        <?php if(isset($error_message)):?><div class="error_msg" style="padding:3px;color: #e80000;"><?php echo $error_message;?></div><?php endif;?>
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/role/index">View</a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/role/insert">Add</a></div>
        </div>
        <div class="clear"></div>
        <form id="frm_create_role" name="frm_create_role" method="post" action="<?php echo base_url();?>admin/role/create" >
            <div>Please fill the form</div>
            <div class="clear"></div>
            <div class="label" style="float:none;">Role</div>
            <div class="clear"></div>
            <div><input type="text" class="input" id="role" name="role" maxlength="30" value=""></div>
            <div class="clear"></div>
            <div class="label" style="background: #f0f0f0;padding: 5px 0;">Privilege Module(s)</div>
            <div class="clear"></div>
            <?php foreach($modules->result() as $module):?>
            <?php $module_name = explode(" ",$module->fld_name);?>
            <div id="<?php echo $module_name[0];?>" class="label role" style="cursor:pointer;float:none;" onclick="toggle(this,<?php echo $module->fld_id;?>)"><?php echo ' &raquo; '.$module->fld_name;?></div>
            <div class="clear"></div>
            <div id="<?php echo $module_name[0].$module->fld_id;?>" class="privileges" style="display:none;margin-left: 110px;">
                <div class="privilege"><input type="checkbox" name="privilege[]" value="insert_<?php echo $module->fld_id;?>">Insert</div>
                <div class="privilege"><input type="checkbox" name="privilege[]" value="update_<?php echo $module->fld_id;?>">Update</div>
                <div class="privilege"><input type="checkbox" name="privilege[]" value="delete_<?php echo $module->fld_id;?>">Delete</div>
                <div class="privilege"><input type="checkbox" name="privilege[]" value="view_<?php echo $module->fld_id;?>">View</div>
            </div>
            <div class="clear"></div>
            <?php endforeach;?>
            <div class="clear"></div>
            <div><input type="submit" class="submit" value="Create Role"></div>
            
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
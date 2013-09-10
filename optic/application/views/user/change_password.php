<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/dashboard.css">
<div class="wrapper">
<div class="left_div">
    <?php $this->load->view('user/left_panel');?>
</div>
<div class="right_div margin_top">
    <h1>Change Your Password.</h1>
    <div class="hr"><hr/></div>
    <h3 class="margin_bottom">Please fill the form below to change your password.</h3>
    <?php if(isset($error_message)):?><div class="error_div"><?php echo $error_message;?></div><?php endif;?>
    <?php if(isset($success_message)):?><div class="success" style="width: 320px;"><?php echo $success_message;?></div><?php endif;?>
    <form id="frm_change_password" name="frm_change_password" method="post" action="<?php echo base_url();?>user/control_panel/change_password">
        <div><label>Current Password</label></div>
        <div class="clear"></div>
        <div><input type="password" id="fld_current_password" name="fld_current_password" class="input" maxlength="30"></div>
        <div class="clear"></div>
        <div><label>New Password</label></div>
        <div class="clear"></div>
        <div><input type="password" id="fld_new_password" name="fld_new_password" class="input" maxlength="30"></div>
        <div class="clear"></div>
        <div><label>Confirm new Password</label></div>
        <div class="clear"></div>
        <div><input type="password" id="fld_confirm_new_password" name="fld_confirm_new_password" class="input" maxlength="30"></div>
        <div class="clear"></div>
        <div class="clear"></div>
        <div class="clear"></div>
        <div><input type="submit" value="Submit" class="submit btn margin_top"></div>
    </form>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
<script>
$(document).ready(function(){
    $('#frm_change_password').validate({
            rules:{
                fld_current_password:{
                    required:true
                },
                fld_new_password:{
                    required:true   
                },
                fld_confirm_new_password:{
                    required:true
                } 

            },
            messages:{
                fld_current_password:{
                    required:"Please enter current password"
                },
                fld_new_password:{
                    required:"Please enter new password."   
                },

                fld_confirm_new_password:{
                    required:"please confirm new password."
                }

            }                  
        });
});
</script>
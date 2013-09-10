<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/reset_password.css">
<div class="wrapper">
    <div class="grid">
        <div id="sliding_div_title" class="sliding_div">
            <h3>Reset Password</h3>
        </div>
        <div id="sliding_div_content" class="sliding_div">
            <h4>Please fill the form to proceed.</h4>
            <?php if(isset($error_message)):?><div class="error_div"><?php echo $error_message;?></div><?php endif;?>
            <form id="frm_reset_password" name="frm_reset_password" method="post" action="<?php echo base_url().'user/forgot_password/ResetPassword';?>" >
                <div class="label_input">
                    <div class="label"><label>Username</label></div>
                    <div class="input">
                        <input type="text" id="fld_username" name="fld_username" value="<?php echo $username;?>" class="input" readonly="true">
                        <input type="hidden" id="hd_id" name="hd_id" value="<?php echo $id;?>" readonly="true">
                        <div id="username" class="validation_error_div"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>New Password</label></div>
                    <div class="input">
                        <input type="password" id="fld_new_password" name="fld_new_password" class="input" maxlength="30">
                        <div id="newpassword" class="validation_error_div"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Confirm new Password</label></div>
                    <div class="input">
                        <input type="password" id="fld_confirm_new_password" name="fld_confirm_new_password" class="input" maxlength="30">
                        <div id="confirmnewpassword" class="validation_error_div"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label">&nbsp;</div>
                    <div class="input"><input type="submit" value="Reset" class="submit"></div>
                </div>
                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
<script>
function maintain()
{
    var slide_flag = "<?php if(isset($error_message)) echo $error_message;?>";
    var grid_width = $('.grid').width();
    var half_grid_width = grid_width/2;
    var sliding_div_width = $('.sliding_div').width();
    var half_sliding_div_width = sliding_div_width/2;
    var desired_left_margin = half_grid_width-half_sliding_div_width;
    if(slide_flag=="")
    {
        var line = $('.sliding_div');

        line.animate({marginLeft:desired_left_margin+'px'},800,function(){
            $('.sliding_div').css('opacity',1);
        });
    }
    else
    {
         $(".sliding_div").css('margin-left',desired_left_margin+'px');
    }
            
}
$(document).ready(function(){
    maintain(); 
    $('#frm_reset_password').validate({
        rules:{

            fld_new_password:{
                required:true   
            },
            fld_confirm_new_password:{
                required:true
            } 
            
        },
        messages:{

            fld_new_password:{
                required:"Please enter new password."   
            },

            fld_confirm_new_password:{
                required:"please confirm new password."
            }
            
        },
        errorPlacement:function(error,element)
        {
            if(element.attr("name") == "fld_new_password") {error.appendTo('#newpassword');$('#newpassword').css('display','block');}
            if(element.attr("name") == "fld_confirm_new_password") {error.appendTo('#confirmnewpassword');$('#confirmnewpassword').css('display','block');}
        }
    });
});   
</script>
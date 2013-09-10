<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/user/login_unknown.css';?>">
<div class="wrapper">
    <div class="grid">
        <div id="sliding_div_title" class="sliding_div">
            <h3>Select An Account To Connect</h3>
        </div>
        <div id="sliding_div_content" class="sliding_div">
            <form action="<?php echo base_url()?>user/glogin/link" method="post" id="frm_link" name="frm_link">
                <h4>Sign in to your account.</h4>
                <?php if(isset($error_message)):?><div class="error"><?php echo $error_message;?></div><?php endif;?>
                <div class="label_input">
                    <div class="label"><label>Username</label></div>
                    <div class="input">
                        <input type="text" name="fld_username" id="fld_username" class="input" maxlength="20"/>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Password</label></div>
                    <div class="input">
                        <input type="password" name="fld_password" id="fld_password" class="input" maxlength="20"/>
                    </div>
                </div>
                <input type="hidden" name="link_login" id="link_login" value="connect"/>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label">&nbsp;</div>
                    <div class="input"><input type="submit" id="sign_in_submit" class="submit" value="Link"></div>
                </div>
            </form>
            <form action="<?php echo base_url()?>user/glogin/Register" method="post" id="frm_create_social_acc" name="frm_create_social_acc">
                <h4>Create a new account.</h4>
                    <?php if(isset($social_error_message)):?><div class="error"><?php echo $social_error_message;?></div><?php endif;?>
                    <div class="label_input">
                        <div class="label"><label>Username</label></div>
                        <div class="input">
                            <input type="text" id="fld_social_username" name="fld_social_username" class="input" maxlength="30">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="label_input">
                        <div class="label">&nbsp;</div>
                        <div class="input">
                            <input type="submit" id="sign_in_submit" class="submit" value="Create">
                        </div>
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
    var container_width = $('.container').width();
    var half_container_width = container_width/2;
    var sliding_div_width = $('.sliding_div').width();
    var half_sliding_div_width = sliding_div_width/2;
    var desired_left_margin = half_container_width-half_sliding_div_width;
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
   $('#frm_create_social_acc').validate({
        rules:{

            fld_social_username:{
                required:true   
            }
            
        },
        messages:{

            fld_social_username:{
                required:"Please enter username."   
            }
        }                  
    });
    //next form validation    
    $('#frm_link').validate({
        rules:{

            fld_username:{
                required:true   
            },
            fld_password:{
                required:true
            } 
            
        },
        messages:{

            fld_username:{
                required:"Please enter username."   
            },

            fld_password:{
                required:"Please enter password."
            }
            
        }
    });
});   
</script>
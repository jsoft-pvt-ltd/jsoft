<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/forgot_password.css">
<div class="wrapper">
    <div class="grid">
        <div id="sliding_div_title" class="sliding_div_title">
            <h1>Forgot Password</h1>
        </div>
        <div class="hr"><hr/></div>
        <div id="sliding_div_content" class="sliding_div">
            <h2>Please enter your email</h2>
            <?php if(isset($error_message)):?><div class="error_div"><?php echo $error_message;?></div><?php endif;?>
            <form id="frm_forgot_password" name="frm_forgot_password" method="post" action="<?php echo base_url().'user/forgot_password';?>" >
                <div class="label_input">
                    <div class="label"><label>Email</label></div>
                    <div class="input margin_bottom">
                        <input type="text" id="fld_email" name="fld_email" class="input" maxlength="30">
                        <div id="email" class="validation_error_div"></div>
                    </div>
                    <div class="margin_top"><input type="submit" value="Submit" class="btn submit"></div>
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
        var _line = $('.sliding_div_title');
        _line.animate({marginLeft:'0px'},500,function(){
            $('#sliding_div_title p').animate({'opacity':1},800);
            line.animate({marginLeft:desired_left_margin+'px'},800,function(){
                $('.sliding_div').css('opacity',1);
            });
        });
    }
    else
    {
        $(".sliding_div").css('margin-left',desired_left_margin+'px');
    }
            
}
$(document).ready(function(){
    maintain();
    $('#frm_forgot_password').validate({
        rules:{

            fld_email:{
                required:true,
                email:true
                
            }            
        },
        messages:{

            fld_email:{
                required:"Please enter email address.",
                email:"Please enter a valid email."
            }            
        },
        errorPlacement:function(error,element)
        {
            if(element.attr("name") == "fld_email")
            {
                error.appendTo('#email');$('#username').css('display','block');
            }
           
        }
    });
        
});
$(window).resize(function(){
    maintain();
});
</script>
</script>


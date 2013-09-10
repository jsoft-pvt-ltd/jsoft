<link rel="stylesheet" href="<?php echo base_url();?>css/user/login.css" type="text/css">
<div class="wrapper">
    <div class="grid">
        <div id="sliding_div_title" class="sliding_div_title">
           <h1>Welcome!</h1>
           <p>OpticStoreOnline.com guarantees all information provided by you will be kept secure and private. We do not share or make your information available to third party:</p>
        </div>
        <div class="hr">
            <hr>
        </div>
        <div id="sliding_div_content" class="sliding_div">
            <h2>Log In</h2>
            <?php if(isset($error_message)):?><div class="error_div"><?php echo $error_message;?></div><?php endif;?>
            <?php if($this->session->flashdata('message')):?><div class="success"><?php echo $this->session->flashdata('message');?></div><?php endif;?>
            <form id="frm_login" name="frm_login" action="<?php echo base_url()?>user/login" method="post">
                <div class="login_info">
                    <div class="label_input">
                        <div class="label">Username</div>
                        <div class="input">
                            <input type="text" id="fld_username" name="fld_username" class="input" maxlength="30"/>
                            <div id="username" class="validation_error_div"></div>
                        </div>
                    </div>    
                    <div class="clear"></div>
                    <div class="label_input">
                        <div class="label">Password</div>
                        <div class="input">
                            <input type="password" id="fld_password" name="fld_password" class="input" maxlength="30"/>
                            <div id="password" class="validation_error_div"></div>
                        </div>
                    </div>
                    
                    <div class="label_input margin_top">
                        <div class="input"><input type="submit" id="sign_in_submit" class="submit btn" value="Sign In"></div>
                    </div>    
                </div>
                <div class="clear"></div>
                <div class="link_holder">
                    <div class="left_link"><a href="<?php echo base_url()?>user/register">Register</a></div>
                    <div class="right_link"><a href="<?php echo base_url().'user/forgot_password';?>">Can't access your account?</a></div>
                </div>
                <div class="clear"></div>
                <p>OR SIGN IN USING</p>
                <div class="clear"></div>
                <div class="social margin_top">
                    <table style="margin-top:-10px;">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'user/fblogin/index';?>','mywin','width=500,height=300');check_flogin();">
                                    <img src="<?php echo base_url();?>skin/images/facebook.png" style="width: 40px;">
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'user/glogin/Index';?>','popUpWindow','left=400,top=150,height=400,width=500');check_glogin();">
                                    <img src="<?php echo base_url();?>skin/images/google.png" style="width: 40px;" >
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="alert('Sorry.Currently disabled.')">
                                    <img src="<?php echo base_url();?>skin/images/twitter.png" style="width: 40px;" >
                                </a>
                            </td>
                        </tr>
                    </table>
                 </div>
             </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
<script type="text/javascript">
function check_glogin()
{
    setTimeout("check_glogin",2000);
    var url = "<?php echo base_url();?>user/glogin/GCheckLoginIn";
    $.post(url,{google:"1"},function(data){
        if(data==1)
        {
             window.location.href= "<?php echo base_url();?>user/glogin/Manage";
        }
    })
}
function check_flogin()
{
    setTimeout("check_flogin()", 2000);
    var url = "<?php echo base_url().'user/fblogin/FCheckLoginIn';?>";
    $.post(url ,{facebook:"1"}, function(data){
        if(data==1)
        {
            window.location.href= "<?php echo base_url().'user/fblogin/Manage';?>";
        }
    });   
}
</script>
<script>
function maintain()
{
    var slide_flag = "<?php if(isset($error_message)) echo $error_message;?>";
    var container_width = $('.wrapper').width();
    var half_container_width = container_width/2;
    var sliding_div_width = $('.sliding_div').width();
    var half_sliding_div_width = sliding_div_width/2;
    var desired_left_margin = half_container_width-half_sliding_div_width;
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
    $('#frm_login').validate({
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
                required:"please enter password."
            }
            
        },
        errorPlacement:function(error,element)
        {
            if(element.attr("name") == "fld_username") {error.appendTo('#username');$('#username').css('display','block');}
            if(element.attr("name") == "fld_password") {error.appendTo('#password');$('#password').css('display','block');}
        }
    });
   
});
$(window).resize(function(){
    maintain();
});
</script>

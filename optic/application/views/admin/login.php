<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($title)) echo $title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="<?php echo base_url().'skin/js/jquery-1.8.3.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
        <style>
         body{background: #f5f5f5;font-family: open sans,sans-serif,arial;font-size: 14px;}
         .container{width: 400px;color:#333;opacity:0.8;border-radius: 2px;}
         .form_holder{background: #f6f6f6;box-shadow: 0 0 10px -4px #333;border: 1px solid #fff;}
         .clear{height: 10px;}
         .label{text-align: left;font-size: 14px;}
         .input{background: #fff;width: 300px;height: 30px;border: 1px solid #e0e0e0;}
         .submit {border: medium none;border-radius: 2px 2px 2px 2px;box-shadow: 0 0 2px #999999 inset;padding: 5px 10px;cursor:pointer;}
         .error_div {background: none repeat scroll 0 0 #f5f5f5;color: #e80000;padding: 10px;width: 380px;opacity: 0.8;border-radius: 2px;border: 1px solid #fff;box-shadow: 0 0 10px -4px #333;}
        </style>

    </head>
    <body>
        
        <div class="container">
            <?php if(isset($error_message)):?><div class="error_div"><?php echo $error_message;?></div><br/><?php endif;?>
            <?php if(isset($success_message)):?><div class="error_div"><?php echo $success_message;?></div><br/><?php endif;?>
           
            <div class="form_holder">
            <form id="frm_admin_login" name="frm_admin_login" method="post" action="<?php echo base_url();?>admin/login">
                <div style="padding:20px 50px;border-bottom: 1px solid #fff;" align="center"><img src="<?php echo base_url();?>images/logo.png"></div>
                <div class="clear"></div>
                <div style="padding:20px 50px;"> 
                    <div class="label">Username</div>
                    <div class="clear" style="height:5px;"></div>
                    <div><input type="text" id="fld_username" name="fld_username" maxlength="20" class="input" <?php if(isset($input)) echo 'value="'.$input['fld_username'].'"';?>></div>
                    <div class="clear"></div>
                    <div class="label">Password</div>
                    <div class="clear" style="height:5px;"></div>
                    <div><input type="password" id="fld_password" name="fld_password" maxlength="20" class="input" <?php if(isset($input)) echo 'value="'.$input['fld_password'].'"';?>></div>
                    <div class="clear"></div>
                    <div class="clear"></div>
                    <div><input type="submit" class="submit" value="View In"></div>
                    <div class="clear"></div>
                </div>
            </form>
            </div>    
            
        </div>
        <script>
            var window_width = $(window).width()/2-(200);
            var container_height = $('.container').height()/2;
            var window_height = $(window).height()/2 -(container_height);
            $('.container').css('margin-left',window_width);
            $('.container').css('margin-top',window_height);
            $(window).resize(function(){
                var window_width = $(window).width()/2-(200);
                var container_height = $('.container').height()/2;
                var window_height = $(window).height()/2 -(container_height);
                $('.container').css('margin-left',window_width);
                $('.container').css('margin-top',window_height);
            });
        </script> 
    </body>
</html>

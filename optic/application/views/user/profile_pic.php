<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/dashboard.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/profile_pic.css">
<div class="wrapper">
    <div class="left_div">
        <?php $this->load->view('user/left_panel');?>
    </div>
    <div class="right_div margin_top">
        <h1 class="margin_bottom">Profile Picture</h1>
        <div class="hr"><hr/></div>
        <?php $this->load->helper('login_helper');$profilePic = CheckProfilePicture();?>
        <?php if($profilePic->fld_profile_pic!=""):?>
            <h3>Edit your profile picture</h3>
            <?php if($this->session->flashdata('message')):?><div class="success"><?php echo $this->session->flashdata('message');?></div><?php endif;?> 
            <img src="<?php echo base_url().$profilePic->fld_profile_pic_url.'/thumbs/'.$profilePic->fld_profile_pic;?>">
            <div class="clear"></div>
            <form id="frm_profile_pic_insert" name="frm_profile_pic_insert" method="post" action="<?php echo base_url();?>user/control_panel/ProfilePicEdit" enctype="multipart/form-data">
        <?php else:?>
            <h4>Add a profile picture</h4>
            <?php if($this->session->flashdata('message')):?><div class="success" style="width: 268px;"><?php echo $this->session->flashdata('message');?></div><?php endif;?>
            <form id="frm_profile_pic_insert" name="frm_profile_pic_insert" method="post" action="<?php echo base_url();?>user/control_panel/ProfilePic" enctype="multipart/form-data">
        <?php endif;?>   
            <div class="label_input">
                <div class="input"><input type="file" name="img" required="required"></div>
                <div class="error_for_file"></div>
            </div>
            <div class="clear"></div>
        <?php if($profilePic->fld_profile_pic!=""):?>    
            <div><input type="submit" value="Edit Profile Picture" class="submit btn margin_top"></div>
        <?php else:?>
            <div><input type="submit" value="Upload Profile Picture" class="submit btn margin_top"></div>
        <?php endif;?>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
<script>
$(document).ready(function(){
    $('#frm_profile_pic_insert').validate({
        rules:{

            name:{
                required:true   
            }
        },
        messages:{

            name:{
                required:"Please select an image."   
            }
        },
        errorPlacement: function(error, element){
            if(element.attr("name") == "img")
            {
                error.appendTo($('.error_for_file'));
            }
       }

    });
});
</script>
<script>
function file_procedure(element)
{
    $('#the_real_file_input').click();
    $('#the_real_file_input').change(function(){
        var str = "";
        str = $(this).val();
        $('#filename').val(str);

    });
}
</script>
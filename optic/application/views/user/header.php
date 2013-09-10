<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($title))echo $title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo base_url().'css/user/style.css'?>" type="text/css">
        <script type="text/javascript" src="<?php echo base_url().'js/jquery.js'?>"></script>
    </head>
    <body>
        <div class="container">
            <div class="upper_div">
                <div class="site_logo"><img src="<?php echo base_url();?>images/logo.png"></div>
                <div class="profile_pic" align="right">
                    <?php $this->load->helper('login_helper');$profilePicInfo = CheckProfilePicture();?>
                    <?php if($this->session->userdata('userSocialId')):?>
                        <?php $me = $this->session->userdata('me');?>
                        <img class="header_profile_pic" src="<?php echo $me['profile_image_url'];?>">
                    <?php else:?>
                        <?php if($this->session->userdata('userId')):?>
                            <?php if(empty($profilePicInfo)):?>
                                <img class="header_profile_pic" src="<?php echo base_url().'skin/images/user.jpg';?>">
                            <?php else:?>
                            <?php //$this->load->helper('login_helper');$headerProfilePic = CheckProfilePicture($this->session->userdata('userId'));?>
                                <img class="header_profile_pic" src="<?php echo base_url().$profilePicInfo->fld_profile_pic_url.'/thumbs/'.$profilePicInfo->fld_profile_pic;?>">
                            <?php endif;?>
                        <?php endif;?>        
                    <?php endif;?>        
        
                </div>
            </div>
               

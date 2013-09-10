<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/left_panel.css">
<div class="left_panel margin_top">
<!--    <div class="dashboard_menu"><b>Settings</b></div>-->
    <h3 class="margin_bottom">Settings</h3>
    <div class="setting">
        <?php if(($this->uri->segment(3)=="" || $this->uri->segment(3)=="index") && $this->uri->segment(2)!='my_prescription'):?>
            <a href="<?php echo base_url();?>user/control_panel" class="hover">Basic Info</a>
        <?php else:?>
            <a href="<?php echo base_url();?>user/control_panel">Basic Info</a>
        <?php endif;?>
    </div>
    <div class="setting">
        <?php if($this->uri->segment(2)=="my_prescription"):?>
            <a href="#" class="hover">My Prescriptions</a>
        <?php else:?>
            <a href="<?php echo base_url().'user/my_prescription'?>">My Prescriptions</a>
        <?php endif;?>
    </div>
    <div class="setting">
        <?php if($this->uri->segment(3)=="ProfilePic"):?>
            <a href="<?php echo base_url();?>user/control_panel/ProfilePic" class="hover">Profile Picture</a>
        <?php else:?>
            <a href="<?php echo base_url();?>user/control_panel/ProfilePic">Profile Picture</a>
        <?php endif;?>
    </div>
    <div class="setting">
        <?php if($this->uri->segment(3)=="change_password"):?>
            <a href="<?php echo base_url()?>user/change_password" class="hover">Change Password</a>
        <?php else:?>
            <a href="<?php echo base_url()?>user/control_panel/change_password">Change Password</a>
        <?php endif;?>
    </div>
    <div class="setting">
        <?php if($this->uri->segment(2)=="wishlist"):?>
            <a href="<?php echo base_url();?>user/wishlist/edit_wishlist" class="hover">My Wishlist</a>
        <?php else:?>
            <a href="<?php echo base_url();?>user/wishlist/edit_wishlist">My Wishlist</a>
        <?php endif;?>
    </div>
    <div class="setting">
        <?php if($this->uri->segment(2)=="order"):?>
            <a href="<?php echo base_url();?>user/order/history" class="hover">Order History</a>
        <?php else:?>
            <a href="<?php echo base_url();?>user/order/history">Order History</a>
        <?php endif;?>
    </div>
    <div class="setting"><a href="<?php echo base_url()?>user/login/logout">Log Out</a></div>
</div>
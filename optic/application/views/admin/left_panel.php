<link rel="stylesheet" href="<?php echo base_url().'css/admin/left_panel.css';?>" type="text/css">
<div class="upper_div">
    <div class="site_logo"><img src="<?php echo base_url().'images/logo.png';?>"></div>
    <div class="notifications">
        <div class="end_user_notification">
            <?php $this->load->helper('admin/notification_helper');$new_user = select_new_user();?>
            <?php if($new_user->num_rows()!=0):?>
                <?php if($new_user->num_rows()==1):?><a href="<?php echo base_url().'admin/enduser';?>"><?php echo '<span style="color:#0a80e5;">[ '.$new_user->num_rows().' ] </span>';?>new user</a><?php endif;?>
                <?php if($new_user->num_rows()>1):?><a href="<?php echo base_url().'admin/enduser';?>"><?php echo '<span style="color:#0a80e5;">[ '.$new_user->num_rows().' ] </span>';?>new users</a><?php endif;?>
            <?php else:?>
                [ 0 ] new user
            <?php endif;?>
        </div>
    </div>
    
</div>
<div class="left_div">
    <div class="menus">
        <?php $this->load->helper('admin/module_helper');
        $modules = select_modules($this->session->userdata('admin_role_id'));?>
        <?php foreach($modules->result() as $module):?>
        <div class="menu">
            <?php $module_name = explode(" ",$module->fld_name);?>
            <div class="menu_title">
                <a href="<?php echo base_url().'admin/'.strtolower($module_name[0]);?>"><?php echo $module->fld_name;?></a>
            </div>
        </div>
        <?php endforeach;?>
        <div class="menu">
            <div class="menu_title"><a href="<?php echo base_url();?>admin/login/end">log Out</a></div>
        </div>
    </div>
</div>

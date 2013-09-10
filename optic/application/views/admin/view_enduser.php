<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <table width="100%">
            <tr style="font-weight: bold;">
                <td width="3%">S.N</td>
                <td width="15%">Name</td>
                <td width="20%">Email</td>
                <td width="10%">Contact No.</td>
                <td width="20%">Date Registered</td>
                <td width="10%">Country</td>
                <td width="15%">Profile Picture</td>
                <td width="5%">Status</td>
            </tr>
            <?php $count=1;?>
            <?php $this->load->helper('admin/notification_helper');$new_users = select_new_user();?>
                       
            <?php foreach($endusers->result() as $enduser):?>
            <tr id="<?php echo $enduser->fld_id;?>" <?php foreach($new_users->result() as $new_user):?><?php if($new_user->fld_user==$enduser->fld_id):?>style="background: #f5f5f5;"<?php else:?><?php endif;?><?php endforeach;?>>
                <td><?php echo $count;?></td>
                <td><?php echo $enduser->fld_first_name.' '.$enduser->fld_last_name;?></td>
                <td><?php echo $enduser->fld_email;?></td>
                <td><?php echo $enduser->fld_contact_no;?>
                <td><?php echo $enduser->fld_date_registered;?></td>
                <td><?php echo $enduser->fld_country;?></td>
                <td align="center">
                    <?php if($enduser->fld_profile_pic!=""):?>
                        <img src="<?php echo base_url().$enduser->fld_profile_pic_url.'/thumbs/'.$enduser->fld_profile_pic;?>" alt="profile pic" width="50">
                    <?php else:?>
                        N.A
                    <?php endif;?>
                </td>
                <td><?php if($enduser->fld_status==1){echo 'Active';}else{echo 'Inactive';}?></td>
            </tr>
            <?php $count++;?>            
            <?php endforeach;?>
            <tr>
                <td><?php echo $this->pagination->create_links();?></td>
            </tr>
        </table>
    </div>
</div>
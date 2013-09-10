<div class="container">
    <?php echo $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/user/index">View </a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/user/insert">Insert</a></div>
        </div>
        
        <table width="100%">
            <tr style="font-weight: bold;">
                <td width="5%">S.N</td>
                <td width="20%">Name</td>
                <td width="20%">Username</td>
                <td width="25%">Email</td>
                <td width="20%">Role</td>
                <td width="10%">Operation</td>
            </tr>
            <?php $count=1;?>
            <?php foreach($users->result() as $user):?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $user->fld_name;?></td>
                <td><?php echo $user->fld_username;?></td>
<!--                <td><?php echo $user->fld_password;?></td>-->
                <td><?php echo $user->fld_email;?></td>
                <?php $this->load->helper('admin/role_helper');$role = select_role($user->fld_role_id);?>
                <td><?php echo $role->fld_role;?></td>
                <td>
                    <a class="operation" href="<?php echo base_url().'admin/user/edit/'.$user->fld_id;?>">Edit</a>
                    |
                    <a class="operation" href="<?php echo base_url().'admin/user/delete/'.$user->fld_id;?>">Delete</a>
                </td>
            </tr>
            <?php $count++;?>
            <?php endforeach;?>
        </table>
            
        </div>
    </div>
</div>
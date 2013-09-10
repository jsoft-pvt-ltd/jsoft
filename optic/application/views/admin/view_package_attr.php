<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation"><?php echo $title;?></div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/package_attributes/add_package_attr">[ Add <?php echo $title;?>]</a>
            <!--<a class="operation" href="<?php echo base_url();?>admin/package_attributes">[ View <?php echo $title;?> ]</a>-->
        </div>
        <table width="100%">
            <tr>
                <td width="3%"><b>Sn.</b></td>
                <td width="82%"><b>Package Attributes</b></td>
                <td width="15%"><b>Controllers</b></td>
            </tr>
        <?php
            foreach($attributes->result() as $key=>$attribute){
        ?>
            <tr>
                <td width="3%"><?php echo $key+1?></td>
                <td width="82%"><?php echo $attribute->fld_name;?></td>
                <td width="15%">
                    <a class="operation" href="<?php echo base_url().'admin/package_attributes/add_package_attr/'.$attribute->fld_id;?>" title="Edit <?php echo $attribute->fld_name;?>"/>Edit</a> | 
                    <a class="operation" href="<?php echo base_url().'admin/package_attributes/delete_package_attr/'.$attribute->fld_id;?>" title="Delete <?php echo $attribute->fld_name;?>" onclick="return confirm('Sure you want to delte this?');">Delete</a></td>
            </tr>
        
        <?
            }
        ?>
        </table>
    </div>
</div>
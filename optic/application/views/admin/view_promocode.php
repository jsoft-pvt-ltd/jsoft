<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?>
            <div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div>
        <?php endif;?>
        <div class="operations">
            <div class="operation">Promocodes</div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/promocode/promocode_type">[ Promocode Type ]</a>
            <a class="operation" href="<?php echo base_url();?>admin/promocode/promocode_type">[ Add promocode ]</a>
        </div>
        <table width="100%">
            <tr>
<!--                <td width="3%"><b>Sn.</b></td>-->
                <td width="15%"><b>Promocode</b></td>
                <td width="10%"><b>Status</b></td>
                <td width="72%"><b>Controllers</b></td>
            </tr>
        <?php foreach($promocodes->result() as $promocode):?>

            <tr id="iaf<? echo $promocode->fld_id;?>">
<!--                <td style="vertical-align:top;"><?php echo $count.'.'; $count++; ?></td>-->
                <td style="vertical-align:top;"><?php echo $promocode->fld_promocode;?></td>
                <td style="vertical-align:top;"><?php if($promocode->fld_status==0){echo "Inactive";}else{echo "Active";}?></td>
                <td style="vertical-align:top;">
                    <?php if($promocode->fld_status==0):?>
                    <a class="operation" href="<?php echo base_url().'admin/promocode/activate_promocode/'.$promocode->fld_id;?>">Activate</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <?php elseif($promocode->fld_status==1):?>
                        <a class="operation" href="<?php echo base_url().'admin/promocode/deactivate_promocode/'.$promocode->fld_id;?>">Deactivate</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <?php endif;?>
                    <a class="operation" href="<?php echo base_url().'admin/promocode/edit_promocode/'.$promocode->fld_promocode_type.'/'.$promocode->fld_id;?>">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a class="operation" href="<?php echo base_url().'admin/promocode/delete_promocode/'.$promocode->fld_id;?>">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
        </table>
       <?php  echo $this->pagination->create_links();?>
    </div>
</div>

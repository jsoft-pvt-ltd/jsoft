<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation">Promocode Types</div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/promocode">[ Promocodes ]</a>
            <a class="operation" href="<?php echo base_url();?>admin/promocode/add_promocode_type">[ Add promocode type ]</a>
        </div>
<table width="100%">
    <tr>
        <td width="5%"><b>Sn.</b></td>
        <td width="70%"><b>Promocode Types</b></td>
        <td width="25%"><b>Controllers</b></td>
    </tr>
<?php $count=1; foreach($promocode_types->result() as $promocode_type):?>
    
    <tr>
        <td style="vertical-align:top;"><?php echo $promocode_type->fld_id;?></td>
        <td style="vertical-align:top;"><?php echo $promocode_type->fld_promocode_type;?></td>
        <td style="vertical-align:top;">
            <a class="operation" href="<?php echo base_url().'admin/promocode/add_promocode/'.$promocode_type->fld_id;?>">[ Add Promocode ]</a>
            <a class="operation" href="<?php echo base_url().'admin/promocode/edit_promocode_type/'.$promocode_type->fld_id;?>">[ Edit ]</a>
            <a class="operation" href="<?php echo base_url().'admin/promocode/delete_promocode_type/'.$promocode_type->fld_id;?>">[ Delete ]</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
       <?php  echo $this->pagination->create_links();?>
    </div>
</div>

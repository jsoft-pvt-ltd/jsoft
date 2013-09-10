<link rel='stylesheet' type='text/css' href="<?php echo base_url().'css/admin/contact_lens.css'?>"/>
<style>
    table td, table th {
        border-left: 1px solid #CCCCCC;
        border-top: 1px solid #CCCCCC;
        padding-left: 10px;
    }
    table thead th{
        padding-left:10px;
    }
    table th{
        background:#ccc;
        padding:3px 0px;
        text-align: left;
    }
</style>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if(isset($msg1)):?>
        <div class="flash_msg">
            <?php echo $msg1;?>
        </div>
        <?php endif;?>
        <div class="operations">
            <div class="operation">
                Fill the form below
            </div>
        </div>
        <div class="actions">
            <a href="<?php echo base_url().'admin/contact_lens/add_lenses'?>" class="operation">[ Add Contact Lens ]</a>
            <a href="<?php echo base_url().'admin/contact_lens/add_brands'?>" class="operation">[ Add Brands ]</a>
            <a href="<?php echo base_url().'admin/contact_lens/view_brands'?>" class="operation">[ View Brands ]</a>
        </div>
        
        <table cellspacing="0" cellpadding="0" style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;width:100%;margin-top:15px;">
            <thead>
            <th>S.No.</th>
            <th>Name</th>
            <!--<th>Description</th>-->
            <th>Brand Name</th>
            <th>Selling Price</th>
            <th>Image</th>
            <th>Operations</th>
            </thead>
            <tbody>
                <?php 
                $sn = 1;
                foreach($contact_lenses->result() as $lens):?>
                <tr id="row_<?php echo $lens->fld_id;?>">
                    <td><?php echo $sn;?></td>
                    <td><?php echo $lens->fld_name;?></td>
                    <!--<td><?php echo $lens->fld_description;?></td>-->
                    <td><?php echo $lens->brand_name;?></td>
                    <td><?php echo $lens->fld_sp;?></td>
                    <td><img src="<?php echo base_url().$lens->fld_location.'/thumbs/'.$lens->fld_image;?>" height="30"/></td>
                    <td>
                        <a class="operation" href="<?php echo base_url('admin/contact_lens/add_lenses/'.$lens->fld_id);?>">[ Edit ]</a> |
                        <a class="operation" href="javascript:void(0);" name="<?php echo base_url('admin/contact_lens/delete_lenses/'.$lens->fld_id);?>" class="delete" id="<?php echo $lens->fld_id;?>">[ Delete ]</a> | 
                        <a class="operation" href="<?php echo base_url('admin/contact_lens/add_attributes/'.$lens->fld_id);?>">[ View Attributes ]</a>
                    </td>
                </tr>
                <?php $sn++;endforeach;?>
            </tbody>
        </table>
    </div>
</div>
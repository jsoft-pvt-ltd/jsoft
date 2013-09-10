<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/vendor/index">View</a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/vendor/insert">Add</a></div>
        </div>
        <div class="clear"></div>
        <table width="100%">
            <tr style="font-weight:bold;">
                <td width="5%">S.N</td>
                <td width="15%">Name</td>
                <td width="15%">Address</td>
                <td width="15%">Tel No</td>
                <td width="15%">Mobile No</td>
                <td width="15%">Vendor For</td>
                <td width="20%">Operations</td>
            </tr>
            <?php $count=1;?>
            <?php foreach($vendors->result() as $vendor):?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $vendor->fld_name;?></td>
                <td><?php echo $vendor->fld_address;?></td>
                <td><?php echo $vendor->fld_telephone;?></td>
                <td><?php echo $vendor->fld_mobile;?></td>
                <td><?php $this->load->helper('product_info_helper');$ptname = get_product_type_name($vendor->fld_product_type);?> <?php echo $ptname->fld_name;?></td>
                <td>
                    <a class="operation" href="<?php echo base_url().'admin/vendor/edit/'.$vendor->fld_id;?>">Edit</a> |
                    <a class="operation" href="<?php echo base_url().'admin/vendor/delete/'.$vendor->fld_id;?>">Delete</a>
                </td>
                
            </tr>
            <?php $count++;?>
            <?php endforeach;?>
        </table>
    </div>
    <div class="pagination" align="center">
        <?php echo $this->pagination->create_links();?>
    </div>
           
</div>

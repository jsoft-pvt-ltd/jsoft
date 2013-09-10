<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/carrier/index">View</a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/carrier/insert">Add</a></div>
        </div>
        <div class="clear"></div>
        <table width="100%">
            <tr style="font-weight:bold;">
                <td width="5%">S.N</td>
                <td width="20%">Country</td>
                <td width="30%">Carrier</td>
                <td width="20%">Shipping Cost</td>
                <td width="25%">Operations</td>
            </tr>
            <?php $count=1;?>
            <?php foreach($carriers->result() as $carrier):?>
            <tr>
                <td><?php echo $count;?></td>
                <td>
                    <?php $this->load->helper('admin/country_helper');$country_name = get_country_name($carrier->fld_country);?>
                    <?php echo $country_name->fld_name;?></td>
                <td><?php echo $carrier->fld_carrier;?></td>
                <td><?php echo $carrier->fld_shipping_cost;?></td>
                <td>
                    <a class="operation" href="<?php echo base_url().'admin/carrier/edit/'.$carrier->fld_id;?>">Edit</a> |
                    <a class="operation" href="<?php echo base_url().'admin/carrier/delete/'.$carrier->fld_id;?>">Delete</a>
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

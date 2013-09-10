<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="flash_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation">Products</div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/product/insert">[ Add products ]</a>
            <a class="operation" href="<?php echo base_url();?>admin/product/add_accessories/#accessories_info">[ View Accessories ]</a>
        </div>
        
        <table width="100%">
            <tr style="font-weight: bold;">
                <td width="5%">S.N</td>
                <td width="15%">Product</td>
                <td width="15%">Item Code</td>
                <td width="15%">Vendor</td>
                <td width="15%">Image</td>
                <td width="15%">Shelf Loc.</td>
                <td width="5%">Status</td>
                <td width="5%">Editor's Pick</td>
                <td width="15%">Operations</td>
            </tr>
            <?php $count=1;?>
            <?php if(!empty($products)):?>
            <?php foreach($products->result() as $product):?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $product->fld_name;?></td>
                <td><?php echo $product->fld_code;?></td>
                <td>
                    <?php $this->load->helper('admin/vendor_helper');$vendor = get_vendor_of_product($product->fld_vendor);?>
                    <?php echo $vendor->fld_name;?>
                </td>
                <?php $this->load->helper('admin/image_helper');$primary_img = select_primary_image($product->fld_id);?>
                
                <td>
                    <?php if(!empty($primary_img)):?>
                        <img alt="product" src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>" height="30">
                    <?php else:?>
                        n.a
                    <?php endif;?>
                </td>
                <td><?php echo $product->fld_shelf;?></td>
                <td><?php if($product->fld_status==1){ echo "On";}else{echo "Off";}?></td>
                <td><input type="checkbox" name="<?php echo $product->fld_id;?>" id="feature_<?php echo $count;?>" onclick="feature(this);" value="" <?php if($product->fld_featured == 1)echo 'checked="checked"';?>></td>
                <td>
                    <a class="operation" href="<?php echo base_url().'admin/product/edit/'.$product->fld_id.'/'.$product->fld_product_type;?>">Edit </a>|
                    <a class="operation" href="<?php echo base_url().'admin/product/delete/'.$product->fld_id;?>">Delete</a>
                </td>    
            </tr>
            <?php $count++;?>
            <?php endforeach;?>
            <?php endif;?>
            <tr>
                <td><?php echo $pagination;?></td>
            </tr>
        </table>
    </div>
    
</div>

<script type="text/javascript">
    function feature(element)
    {
        var prod_id = element.name;
        var id = element.id;
        var value = 0;
        var chk = $('#'+id).is(':checked');
        if(chk == true){
            value = 1; 
        }else{
            value = 0;
        }
        var base_url = "<?php echo base_url();?>";
        $.ajax({
        type: "POST",
        url: base_url+'admin/product/featured/'+prod_id+'/'+value,
            success: function(){
                if(value == 1){
                    alert("Successfully added to featured");
                }else{
                    alert("Successfully removed from featured");
                }
            }
        });
    }
</script>

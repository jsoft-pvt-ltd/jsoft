<script src="<?php echo base_url();?>js/site/index.js" type="text/javascript"></script>
<?php 
    $this->load->helper('admin/image_helper');  //load helper here
?>
<link rel="stylesheet" href="<?php echo base_url();?>css/site/index.css"/>
<div class="pagination" style="border-bottom: 1px solid #CCCCCC;margin: 15px auto 15px;overflow: auto;padding-bottom: 20px;width: 1000px;text-align: center;">
    <?php echo $this->pagination->create_links();?>
</div>
<div class="wrapper" style="margin-top:20px;">
    <?php if($products->num_rows()!=0):?>
        <ul>
            <?php $count=0;?>
            <?php foreach($products->result() as $product):?>
            <?php $primary_img = select_primary_image($product->fld_id);?>
            <li class="product img_link">
                <ul>
                    <li>
                        <img alt="product" src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>" width="225">
                    </li>
                    <li>
                        <div class="left">Eye Wear: </div><div class="right bold"><?php echo $product->fld_name;?></div>
                    </li>
                    <li>
                        <!--<div class="left">Price: </div>-->
                        <div class="right price">$<?php echo $product->fld_price;?></div>
                    </li>
                    <li>
                        <div class="left wishlist">
                            <a href="javascript:void(0)" onclick="wishlist(<?php echo $product->fld_id;?>)" class="btn_wishlist">Add to Wishlist</a>
                        </div>
                        <div class="right">
                            <a href="<?php echo base_url().'site/cart_steps/index/'.$product->fld_id;?>" class="btn">Check It Out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <?$count++;?>
            <?php endforeach;?>
        </ul>
        <?php else:?>
        Sorry!! No any result found.
        <?php endif;?>
    </div>
    <div class="pagination" style="border-bottom: 1px solid #CCCCCC;margin: 0 auto 15px;overflow: auto;padding-bottom: 20px;width: 1000px;text-align: center;">
        <?php echo $this->pagination->create_links();?>
    </div>
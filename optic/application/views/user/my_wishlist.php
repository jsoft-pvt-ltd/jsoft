<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/dashboard.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/wishlist.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/site/index.css"/>
<?php $this->load->helper('admin/image_helper');?>
<div class="wrapper">
    <div class="left_div">
        <?php $this->load->view('user/left_panel');?>
    </div>
    <div class="right_div margin_top">
        <h1 class="margin_bottom">My Wishlist</h1>
        <p class="para">
            Wishlists let you keep track of your favorite products.
            <br/>
            Share your wishlist and encourage your family and friends to get you the stuff you love. And don't forget to return the favor! 

        </p>
        <div class="hr"><hr/></div>
        <h3 class="margin_bottom">Wishlist Contents</h3>
        <?php if(!empty($wishlists)):?>
        <ul>
            <?php $count=0;?>
            <?php foreach($wishlists->result() as $product):?>
            <?php if($count<=5):?>
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
                        <div class="right">
                            <a href="<?php echo base_url().'site/cart_steps/index/'.$product->fld_id;?>" class="btn">Buy</a>
                        </div>
                    </li>
                </ul>
            </li>
            <?php else: break;?>
            <?php endif;?>
            <?$count++;?>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
    </div>
</div>

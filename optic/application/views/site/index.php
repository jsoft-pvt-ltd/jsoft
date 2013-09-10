<link rel="stylesheet" href="<?php echo base_url();?>css/site/slider.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>css/site/index.css"/>
<style>
/*=====================================================*/

.temp_image > img {
    background: none repeat scroll 0 0 #FFFFFF;
    height: 300px;
    margin-left: 739px;
    margin-top: -309px;
    padding-left: 10px;
    position: absolute;
    width: 250px;
    z-index: 90;
}

/*=====================================================*/
</style>
<script src="<?php echo base_url();?>js/site/jquery.slides.min.js"></script>
<script src="<?php echo base_url();?>js/site/jquery.kwicks.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/site/index.js" type="text/javascript"></script>
<?php 
    $this->load->helper('admin/image_helper');  //load helper here
?>
<script>
    $(function() {
      $('#slides').slidesjs({
        height: 290,
        navigation:{
            active: false
        },
        play: {
          active: false,
          auto: true,
          interval: 4000,
          swap: false,
          pauseOnHover: true
        }
      });
    });
  </script>
    <div class="wrapper">
        <div class="intro">
            <div class="container">
                <div id="slides">
                  <img src="<?php echo base_url();?>images/banner_1.jpg" alt="photo abc">
                  <img src="<?php echo base_url();?>images/banner_2.jpg" alt="def">
                  <img src="<?php echo base_url();?>images/b.jpg" alt="ghi">
                </div>
                <div class="temp_image">
                    <img src="<?php echo base_url();?>images/b.jpg" alt="ghi">
                </div>
              </div>
        </div>
        <div class="help">
            <ul class="help_ul">
                <li>
                    <div class="icon">
                        <img src="<?php echo base_url().'images/buy_back.png'?>"
                    </div>
                    <div class="title">
                        <h1>Free 15-days returns.</h1>
                    </div>
                    <div class="desc">
                        We offer a no hassle, 15-days return policy from the day
we ship your order. We’ll even pick up the tab for return
shipping so you can shop risk-free.
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <img src="<?php echo base_url().'images/steps.jpg'?>"
                    </div>
                    <div class="title">
                        <h1>3 Easy Steps</h1>
                    </div>
                    <div class="desc">
                        Select Frame<br/>
                        Select Lens<br/>
                        Free Delivery<br/>
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <img src="<?php echo base_url().'images/acc_guarantee.jpg'?>"
                    </div>
                    <div class="title">
                        <h1>Accuracy Guaranteed</h1>
                    </div>
                    <div class="desc">
                        We offer a no hassle, 15-days return policy from the day
we ship your order. We’ll even pick up the tab for return
shipping so you can shop risk-free.
                    </div>
                </li>
            </ul>
        </div>
        <div class="ads">
            <div class="bg_bar"></div>
            <div class="ad">
                <img src="<?php echo base_url().'images/help_line.jpg'?>">
            </div>
            <div class="ad double_ad">
                <img src="<?php echo base_url().'images/banner4.jpg'?>">
            </div>
<!--            <div class="ad">
                ad 3 here
            </div>-->
        </div>
        <div class="glasses">
            <div class="left best_sellers">
                <h1>Best Seller</h1>
                <?php if($products->num_rows()>0):?>
                <ul>
                    <?php $count=0;?>
                    <?php foreach($products->result() as $product):?>
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
                                <?php if($product->fld_discount>0):?>
                                <div class="left discount"><?php echo $product->fld_discount;?>% off</div>
                                <div class="right price"><span class="old_price">$<?php echo $product->fld_price;?></span></div>
                                <?php endif;?>
                            </li>
                            <li>
                                <div class="right price">$<?php echo $product->fld_sp;?></div>
                            </li>
                            <li>
                                <div class="left wishlist">
                                    <a href="javascript:void(0)" onclick="wishlist(<?php echo $product->fld_id;?>)" class="btn_wishlist">Add to Wishlist</a>
                                </div>
                                <div class="right">
                                    <?php 
                                        if($product->sub_cat_name!="" || $product->sub_cat_name != NULL){
                                            $address = url_title(strtolower($product->cat_name)).'/'.url_title(strtolower($product->sub_cat_name));
                                        }
                                        else $address = url_title(strtolower($product->cat_name));
                                    ?>
                                    <a href="<?php echo base_url().$address.'/'.url_title(strtolower($product->fld_name)).'-'.$product->fld_id;?>" class="btn">Check It Out</a>
                                    <!--<a href="<?php echo base_url().'site/cart_steps/index/'.$product->fld_id;?>" class="btn">Check It Out</a>-->
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php else: break;?>
                    <?php endif;?>
                    <?$count++;?>
                    <?php endforeach;?>
                </ul>
                <?php else:?>
                    &nbsp;&nbsp;&nbsp;&nbsp;Sorry !!! No products at the moment.
                <?php endif;?>
            </div>
            <div class="clear">
            </div>
        </div>
        <div class="extra_info">
            <div class="accordion">
                <div class="accord-header">
                    <span class="sign">
                        <img src="<?php echo base_url().'images/open.png'?>" alt="openclose"/>
                    </span>
                    <h3 class="hTwo">Glasses From
                        <span class="price1 bold"> $6.00</span>
                    </h3>
                </div>
                <div class="accord-content">
                    <p>
                        <span>Glasses Includes:</span><br/>
                        Fashionable Prescription Eye Frame<br/>
                        Plastic 1.50 Index Prescription Lenses<br/>
                        Free Anti-Scratch Coating<br/>
                        Free UV Coating<br/>
                        Plastic 1.50 Index Prescription Lenses<br/>
                        Free Anti-Scratch Coating<br/>
                        Free UV Coating<br/>
                        Plastic 1.50 Index Prescription Lenses<br/>
                        Free Anti-Scratch Coating<br/>
                        Free UV Coating<br/>
                    </p>
                </div>
                <div class="accord-header">
                    <span class="sign">
                        <img src="<?php echo base_url().'images/open.png'?>" alt="openclose"/>
                    </span>
                    <h3 class="hTwo">Prescription Glasses</h3>
                </div>
                <div class="accord-content">
                    Pellentesque dapibus luctus pulvinar. Suspendisse a lacus felis. Donec convallis hendrerit sem vitae sollicitudin. Suspendisse potenti. Vivamus justo tortor, porttitor id imperdiet ac, blandit eget ante. Aenean id odio sed nisl euismod cursus vel eget velit. Vestibulum eget ipsum et ante dignissim suscipit.
                </div>
                <div class="accord-header">
                    <span class="sign">
                        <img src="<?php echo base_url().'images/open.png'?>" alt="openclose"/>
                    </span>
                    <h3 class="hTwo">Prescription Sunglasses</h3>
                </div>
                <div class="accord-content">
                    Pellentesque dapibus luctus pulvinar. Suspendisse a lacus felis. Donec convallis hendrerit sem vitae sollicitudin. Suspendisse potenti. Vivamus justo tortor, porttitor id imperdiet ac, blandit eget ante. Aenean id odio sed nisl euismod cursus vel eget velit. Vestibulum eget ipsum et ante dignissim suscipit.
                </div>
                <div class="accord-header">
                    <span class="sign">
                        <img src="<?php echo base_url().'images/open.png'?>" alt="openclose"/>
                    </span>
                    <h3 class="hTwo">Eyeglass Adjustment</h3>
                </div>
                <div class="accord-content">
                    Pellentesque dapibus luctus pulvinar. Suspendisse a lacus felis. Donec convallis hendrerit sem vitae sollicitudin. Suspendisse potenti. Vivamus justo tortor, porttitor id imperdiet ac, blandit eget ante. Aenean id odio sed nisl euismod cursus vel eget velit. Vestibulum eget ipsum et ante dignissim suscipit.
                </div>
            </div>

        </div>
    </div>
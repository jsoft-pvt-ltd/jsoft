<?php 
    $this->load->helper('admin/image_helper');
    $images = select_images($product_info->fld_id);//Load helpers and others here
?>
<link rel="stylesheet" href="<?php echo base_url().'css/site/selected_product.css'?>" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/site/tabs.css';?>"/>
<script type="text/javascript" src="<?php echo base_url().'js/site/jquery.tabify.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/site/selected_product.js'?>"></script>
<script src="<?php echo base_url();?>js/site/index.js" type="text/javascript"></script>
<?php if($this->uri->segment(1) == 'best-seller' || $this->uri->segment(1) == 'accessories'){?>
<?php 
    $selected = explode('-',$this->uri->segment(2));
?>
<div class="breadcrumb">
    <a href="<?php echo base_url();?>">Home</a> > <a href="<?php echo base_url().$this->uri->segment(1).'-'.$product_info->fld_category.'/9';?>"><?php echo $this->uri->segment(1);?></a> >  <?php echo $selected[0];?>
</div>
<?php }else{?>
<?php 
    $selected = explode('-',$this->uri->segment(3));
?>
<div class="breadcrumb">
    <a href="<?php echo base_url();?>">Home</a> > <a href="<?php echo base_url().$this->uri->segment(1).'-'.$product_info->fld_category.'/9';?>"><?php echo $this->uri->segment(1);?></a> > <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'-'.$product_info->fld_subcategory.'/9';?>"><?php echo $this->uri->segment(2);?></a> > <?php echo $selected[0];?>
</div>
<?php }?>
<div id="error_place" class="error_place" style="display:none;"><div class="error_title"></div></div>
<div class="wrapper">
    <?php if($this->session->userdata('promocode')==1 && $product_info->fld_category==$this->session->userdata('free_category')):?>
        <div class="promocode_result">
            <p>Please select through the process.The promocode you used is cost free in this category.
            The cost throughout the process is none.</p>
        </div>
    <?php endif;?>
    <div class="left items border_right">
        <h1><?php echo $product_info->fld_name;?></h1>
        <div class="img_views">
        <?php foreach($images->result() as $image):?>
        <?php if($image->fld_primary==0):?>
        <div class="primary_img">
            <img alt="product" src="<?php echo base_url().$image->fld_url.'/'.$image->fld_name;?>">
        </div>
        <?php endif;?>
        <div class="thumbs">
            <img alt="product" src="<?php echo base_url().$image->fld_url.'/thumbs/'.$image->fld_name;?>" class="thumb_imgs" width="142" onclick="change_image(this);">
        </div>
        <?php endforeach;?>
        </div>
        <div class="img_desc">
            <div class="usual_header" id="usual_header">
                <ul> 
                    <li>
                        <a class="selected presc_tab" href="#about_glass">
                            <h2>About <?php echo $product_info->fld_name;?></h2>
                        </a>
                    </li> 
                    <li>
                        <a class="presc_tab" href="#glass_measurement">
                            <h2>Measurements</h2>
                        </a>
                    </li> 
                </ul>
                <div id="about_glass" class="tabs">
                    <p>
                        <?php echo $product_info->fld_description;?>
                    </p>
                </div>
                <div id="glass_measurement" class="tabs">
                    <div id="frame_width" class="frame_desc"><?php echo $product_info->fld_size_total_width;?> mm</div>
                    <div id="lens_height" class="frame_desc"><?php echo $product_info->fld_size_lens_height;?> mm</div>
                    <div id="lens_width" class="frame_desc"><?php echo $product_info->fld_size_eye_size;?> mm</div>
                    <div id="temple_width" class="frame_desc"><?php echo $product_info->fld_size_temple_arm;?> mm</div>
                    <div id="bridge_width" class="frame_desc"><?php echo $product_info->fld_size_bridge_width;?> mm</div>
                    <img src="<?php echo base_url().'images/glass_measurement.png'?>" alt="Glass Measurement" title="glass_measurement"/>
                </div>
            </div>
        </div>
        <div id="fb-root"></div>
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <fb:comments  href="<?php echo current_url();?>" num_posts="5" width="728"></fb:comments> 
    </div>
    <div class="left extras">
        <div class="product_info">
            <h3 style="font-weight:bold;"><?php echo ucfirst($product->fld_name);?></h3>
<!--            <div class="info">
                1 Review(s) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;<a>Add Your Review</a>
            </div>-->
            <div class="info">
                <span>Availability: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="right">
                    <?php
                    if($product->fld_stock>0){
                        echo "<b style='color:#555555'>In Stock</b>";
                    }
                    else echo '<b>Out of Stock</b>';
                    ?>
                </span>
            </div>
            <div class="info">
                <?php if($product->fld_discount>0):?>
                <span>
                    <div class="left discount"><?php echo $product->fld_discount;?>% off</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="right price"><span class="old_price">$<?php echo $product->fld_price;?></span></div>
                </span>
                <!--<span class="right old_price">$ <?php echo $product->fld_price;?></span>-->
                    <?php endif;?>
            </div>
            <div class="info">
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="price right">$ <?php echo $product->fld_sp;?></span>
            </div>
            <div class="info">
                <span>
                    <a href="javascript:void(0)" onclick="wishlist(<?php echo $product_info->fld_id;?>)" >Add to Wishlist</a>
                </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><a>Email a Friend</a></span>
            </div>
        </div>
        <div class="product_attrs">
            <form name="frm_product_info" id="frm_product_info" method="post" action="<?php echo base_url().'site/cart_steps/steps/';?>">
                <div class="product_lens_type">
                    <input type="hidden" name="product_id" value="<?php echo $product_info->fld_id;?>">
                    <input type="hidden" name="cat_id" value="<?php echo $product_info->fld_category;?>">
                    <h3 class="margin_bottom">Select Lens Type</h3>
                    <?php foreach($compatibility->result() as $compat):?>
                        <?php foreach($lens_types->result() as $lens_id):?>
                        <?php if($lens_id->fld_lens_type == $compat->fld_id):?>
                            <input type="radio" name="lens_type" value="<?php echo $compat->fld_id;?>"/> <?php echo $compat->fld_name;?><br/>
                        <?php endif;?>
                               <?php endforeach;?>
                    <?php endforeach;?>
                </div>
                <div class="product_color">
                    <h3 class="margin_bottom">Frame Colors</h3>
                    <input type="hidden" value="3" name="color_id">
                    <?php 
                        foreach($colors->result() as $color){
                            $color_name = get_color_name($color->fld_id);
                            echo '<div class="colors left" title="'.$color_name.'" onclick="get_glasses('.$color->fld_id.','.$product_info->fld_id.');">
                                <input type="radio" name="color" value="'.$color->fld_id.'" class="left color_radios"/>';
//                            echo '<div class="color_box left" style="background:#'.$color->fld_value.'" title="'.$color_name.'"></div></div>';
                            echo $color_name.'</div>';
                        }
                    ?>
                </div>
                <div class="action_controller">
                    <input type="submit" value="Buy Now" class=" btn btn_buy_now"/>
                </div>
            </form>
        </div>
        <div class="measurements">
            <h3>Measurements</h3>
            <div class="measurement_info">
                <img src="<?php echo base_url().'images/Frame_measurement_front.jpg'?>" width="235"/><br/>
                <img src="<?php echo base_url().'images/Frame_measurement_side.jpg'?>" width="235"/>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().'js/jquery.validate.js';?>"></script>
<script type="text/javascript"> 
   $("#usual_header ul").idTabs(); 
</script>
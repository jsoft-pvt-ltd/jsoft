<link rel="stylesheet" href="<?php echo base_url().'css/site/categories.css';?>" type="text/css"/>
<script src="<?php echo base_url();?>js/site/index.js" type="text/javascript"></script>
<?php
//$this->session->set_userdata('fld_category_id',$category_info->fld_id);
    $this->load->helper('admin/image_helper');  //============================================================================[ Helpers here ]
?>
<div class="breadcrumb">
    <a href="<?php echo base_url();?>">Home</a> > accessories
</div>
<div class="wrapper">
    <?php if($this->session->userdata('promocode')==1 && $this->session->userdata('fld_category_id')==$this->session->userdata('free_category')):?>
        <div class="promocode_result">
            <p>Please select through the process.The promocode you used is cost free in this category.
            The cost throughout the process is none.</p>
        </div>
    <?php endif;?>
    <div class="description">
        <h1 class="margin_bottom">Accessories</h1>
        <h5>Accessories for your glasses.</h5>
    </div>
    <div class="categorized_items">
        <div class="left items border_right">
            <?php if(!empty($accessories)&& $total_items>9):?>
            <div class="controllers margin_right">
                <div class="sorting left margin_right">
                    Sort By: 
                    <select onchange="sort_by(this.value)">
                        <option value="random">Random</option>
                        <option value="asc_price">Asc Price</option>
                        <option value="desc_price">Desc Price</option>
                        <option value="latest">Latest</option>
                    </select>
                </div>
                
                <div class="items_to_display left">
                    Display:
                    <select onchange="display_items(this.value)" class="display_item">
                        <option value="9" <?php if($per_page==9) echo ' selected="selected"'?>>9 Items</option>
                        <option value="18" <?php if($per_page==18) echo ' selected="selected"'?>>18 Items</option>
                        <option value="36" <?php if($per_page==36) echo ' selected="selected"'?>>36 Items</option>
                        <option value="45" <?php if($per_page==45) echo ' selected="selected"'?>>45 Items</option>
                    </select>
                </div>
                <div class="pagination right">
                    pagination here
                    <?php echo $pagination;?>
                </div>
            </div>
            <?php endif;?>
            <div class="cat_glasses">
                <?php if($accessories->num_rows()!=0):?>
                <ul>
                    <?php foreach($accessories->result() as $accessory):?>
                    <li class="product img_link">
                        <ul>
                            <li>
                                <img alt="Accessory" src="<?php echo base_url().$accessory->fld_location.'/thumbs/'.$accessory->fld_image;?>" width="225">
                            </li>
                            <li>
                                <div class="left">Accessory: </div><div class="right bold"><?php echo $accessory->fld_name;?></div>
                            </li>
                            <li>
                                <!--<div class="left">Price: </div>
                                <div class="right"><span class="old_price">$<?php echo $accessory->fld_cp;?></span></div>-->
								<?php if($accessory->fld_discount>0):?>
                                <div class="left discount"><?php echo $accessory->fld_discount;?>% off</div>
                                <div class="right price"><span class="old_price">$<?php echo $accessory->fld_cp;?></span></div>
                                <?php endif;?>
                            </li>
                            <li>
                                <!--<div class="left">Price: </div>-->
                                <div class="right price">$<?php echo $accessory->fld_sp;?></div>
                            </li>
                            <li>
                                <div class="left wishlist">
                                    <a href="javascript:void(0)" onclick="wishlist(<?php echo $accessory->fld_accessory_id;?>)" class="btn_wishlist">Add to Wishlist</a>
                                </div>
                                <div class="right">
                                    <a href="<?php echo base_url().'site/accessories/selected_accessory/'.$accessory->fld_accessory_id;?>" class="btn">Check It Out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php else:?>
                    Sorry!! No any products at the moment.
                <?php endif;?>
            </div>
        </div>
        <div class="left extras">
            <div class="measurements" style="display: none;">
                <h3>Measurements</h3>
                <div class="measurement_info">
                    <img src="<?php echo base_url().'images/Frame_measurement_front.jpg'?>" width="235"/><br/>
                    <img src="<?php echo base_url().'images/Frame_measurement_side.jpg'?>" width="235"/>
                </div>
            </div>
            <div class="best_sellers">
                <h3>Best Sellers</h3>
                <?php if(!empty($best_sellers)):?>
                <ul>
                    <?php $count=0;?>
                    <?php foreach($best_sellers->result() as $best_seller):?>
                    <?php if($count<=5):?>
                    <?php $primary_img = select_primary_image($best_seller->fld_id);?>
                    <li class="product img_link">
                        <ul>
                            <li>
                                <img alt="product" src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>" width="225">
                            </li>
                            <li>
                                <div class="left">Eye Wear: </div><div class="right bold"><?php echo $best_seller->fld_name;?></div>
                            </li>
                            <li>
                                <!--<div class="right"><span class="old_price">$<?php echo $best_seller->fld_price;?></span></div>-->
								<?php if($best_seller->fld_discount>0):?>
                                <div class="left discount"><?php echo $best_seller->fld_discount;?>% off</div>
                                <div class="right price"><span class="old_price">$<?php echo $best_seller->fld_price;?></span></div>
                                <?php endif;?>
                            </li>
                            <li>
                                <div class="right price">$<?php echo $best_seller->fld_sp;?></div>
                            </li>
                            <li>
                                <div class="left wishlist"><a href="javascript:void(0)" onclick="wishlist(<?php echo $best_seller->fld_id;?>)" class="btn_wishlist">Add to Wishlist</a></div>
                                <div class="right">
                                    <?php 
                                        if($best_seller->sub_cat_name!="" || $best_seller->sub_cat_name != NULL){
                                            $address = url_title(strtolower($best_seller->cat_name)).'/'.url_title(strtolower($best_seller->sub_cat_name));
                                        }
                                        else $address = url_title(strtolower($best_seller->cat_name));
                                    ?>
                                    <a href="<?php echo base_url().$address.'/'.url_title(strtolower($best_seller->fld_name)).'-'.$best_seller->fld_id;?>" class="btn">Check It Out</a>
                                    <!--<a href="<?php echo base_url().'site/cart_steps/index/'.$best_seller->fld_id;?>" class="btn">Check It Out</a>-->
                                </div>
                            </li>
                            <li>
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
    </div>
</div>
<script>
    function display_items(nos){
        window.location.href='<?php echo base_url().'accessories/'?>'+nos;
    }
    
    function sort_by(value){
        var display_item = $(".display_item").val();
        location.href=base_url+'site/accessories/accesories_set_sort_by/'+value+'/'+display_item;
    }
</script>
<?php
    $sort_by = $this->session->userdata('sort_by');
?>

<link rel="stylesheet" href="<?php echo base_url().'css/site/categories.css';?>" type="text/css"/>
<script src="<?php echo base_url();?>js/site/index.js" type="text/javascript"></script>
<?php
$this->session->set_userdata('fld_category_id',$category_info->fld_id);
    $this->load->helper('admin/image_helper');  //============================================================================[ Helpers here ]
	$cat_id=0;
	$sub_cid=0;
?>
<?php if(isset($sub_cat) && $sub_cat == TRUE){?>
<?php 
    $selected = explode('-',$this->uri->segment(2));
?>
<div class="breadcrumb">
    <a href="<?php echo base_url();?>">Home</a> > <a href="<?php echo base_url().$this->uri->segment(1).'-'.$category_info->fld_category_id.'/9';?>"><?php echo $this->uri->segment(1);?></a> > <?php echo $selected[0];?>
</div>
<?php }else{
    $selected = explode('-',$this->uri->segment(1));
?>
<div class="breadcrumb">
    <a href="<?php echo base_url();?>">Home</a> > <?php echo $selected[0];?>
</div>
<?php }?>
<div class="wrapper">
    <?php if($this->session->userdata('promocode')==1 && $this->session->userdata('fld_category_id')==$this->session->userdata('free_category')):?>
        <div class="promocode_result">
            <p>Please select through the process.The promocode you used is cost free in this category.
            The cost throughout the process is none.</p>
        </div>
    <?php endif;?>
    <div class="description">
        <h1 class="margin_bottom"><?php echo($category_info->fld_name);?></h1>
        <h5><?php echo($category_info->fld_description);?></h5>
    </div>
    <div class="categorized_items">
        <div class="left items border_right">
		<?php //echo $products->num_rows();?>
            <?php if(!empty($products) && $total_items>9):?>
            <div class="controllers margin_right">
                <div class="sorting left margin_right">
                    Sort By: 
                    <select onchange="sort_by(this.value)">
                        <option <?php if($sort_by!='' && $sort_by == 'random')echo 'selected = "selected"';?> value="random">Random</option>
                        <option <?php if($sort_by!='' && $sort_by == 'asc_price')echo 'selected = "selected"';?>  value="asc_price">Asc Price</option>
                        <option <?php if($sort_by!='' && $sort_by == 'desc_price')echo 'selected = "selected"';?>  value="desc_price">Desc Price</option>
                        <option <?php if($sort_by!='' && $sort_by == 'latest')echo 'selected = "selected"';?>  value="latest">Latest</option>
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
                    <!--pagination here-->
                    <?php echo $pagination;?>
                </div>
            </div>
            <?php endif;?>
            <div class="cat_glasses">
                <?php if($products->num_rows()!=0):?>
                <ul>
                    <?php foreach($products->result() as $product):?>
					<?php $cat_id = $product->fld_category;?>
					<?php $sub_cid = $product->fld_subcategory;?>
                    <?php 
                    $primary_img = select_primary_image($product->fld_id);
                    if(empty($primary_img)){
                        $primary_img =  new stdClass();
                        $primary_img->fld_name='default.png';
                        $primary_img->fld_url = 'images';
                    }
                    ?>
                    <li class="product img_link">
                        <ul>
                            <li>
                                <img alt="product" src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>" width="225">
                            </li>
                            <li>
                                <div class="left"></div><div class="right bold"><?php echo $product->fld_name;?></div>
                            </li>
                            <li>
                                <!--<div class="left">Price: </div>-->
                                <?php if($product->fld_discount>0):?>
                                <div class="left discount"><?php echo $product->fld_discount;?>% off</div>
                                <div class="right price"><span class="old_price">$<?php echo $product->fld_price;?></span></div>
                                <?php endif;?>
                            </li>
                            <li>
                                <!--<div class="left">Price: </div>-->
                                <div class="right price">$<?php echo $product->fld_sp;?></div>
                            </li>
                            <li>
                                <div class="left wishlist">
                                    <a href="javascript:void(0)" onclick="wishlist(<?php echo $product->fld_id;?>)" class="btn_wishlist">Add to Wishlist</a>
                                </div>
                                <div class="right">
                                    <?php
                                    if(isset($sub_cat) && $sub_cat==true){
                                        if($product->sub_cat!="" || $product->sub_cat != NULL){
                                            $address = url_title(strtolower($product->sub_cat)).'/'.url_title(strtolower($category_info->fld_name));
                                        }
                                        else $address = url_title(strtolower($product->sub_cat));
                                    }
                                    else{
                                        if($product->sub_cat!="" || $product->sub_cat != NULL){
                                            $address = url_title(strtolower($category_info->fld_name)).'/'.url_title(strtolower($product->sub_cat));
                                        }
                                        else $address = url_title(strtolower($category_info->fld_name));
                                    }
                                    ?>
                                    <a href="<?php echo base_url().$address.'/'.url_title(strtolower($product->fld_name)).'-'.$product->fld_id;?>" class="btn">Check It Out</a>
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
			<?php if(!empty($products) && $total_items>9):?>
            <div class="controllers margin_right">
                <div class="sorting left margin_right">
                    Sort By: 
                    <select onchange="sort_by(this.value)">
                        <option <?php if($sort_by!='' && $sort_by == 'random')echo 'selected = "selected"';?> value="random">Random</option>
                        <option <?php if($sort_by!='' && $sort_by == 'asc_price')echo 'selected = "selected"';?>  value="asc_price">Asc Price</option>
                        <option <?php if($sort_by!='' && $sort_by == 'desc_price')echo 'selected = "selected"';?>  value="desc_price">Desc Price</option>
                        <option <?php if($sort_by!='' && $sort_by == 'latest')echo 'selected = "selected"';?>  value="latest">Latest</option>
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
                    <!--pagination here-->
                    <?php echo $pagination;?>
                </div>
            </div>
            <?php endif;?>
        </div>
        <div class="left extras">
            <div class="measurements">
                <h3>Featured Products</h3>
                <?php if(!empty($featured_products)):?>
                <ul>
                    <?php foreach($featured_products->result() as $featured):?>
                    <?php
                    $primary_img = select_primary_image($featured->fld_id);
                    if(empty($primary_img)){
                        $primary_img =  new stdClass();
                        $primary_img->fld_name='default.png';
                        $primary_img->fld_url = 'images';
                    }
                    ?>
                    <li class="product img_link">
                        <ul>
                            <li>
                                <img alt="product" src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>" width="225">
                            </li>
                            <li>
                                <div class="left"></div><div class="right bold"><?php echo $featured->fld_name;?></div>
                            </li>
                            <li>
                                <?php if($featured->fld_discount>0):?>
                                <div class="left discount"><?php echo $featured->fld_discount;?>% off</div>
                                <div class="right price"><span class="old_price">$<?php echo $featured->fld_price;?></span></div>
                                <?php endif;?>
                            </li>
                            <li>
                                <div class="right price">$<?php echo $featured->fld_sp;?></div>
                            </li>
                            <li>
                                <div class="left wishlist"><a href="javascript:void(0)" onclick="wishlist(<?php echo $featured->fld_id;?>)" class="btn_wishlist">Add to Wishlist</a></div>
                                <div class="right">
                                    <?php 
                                        if($featured->sub_cat_name!="" || $featured->sub_cat_name != NULL){
                                            $address = url_title(strtolower($featured->cat_name)).'/'.url_title(strtolower($featured->sub_cat_name));
                                        }
                                        else $address = url_title(strtolower($featured->cat_name));
                                    ?>
                                    <a href="<?php echo base_url().$address.'/'.url_title(strtolower($featured->fld_name)).'-'.$featured->fld_id;?>" class="btn">Check It Out</a>
                                </div>
                            </li>
                            <li>
                            </li>
                        </ul>
                    </li>
                    <?php endforeach;?>
                </ul>
                <div class="action_controller" style="width:235px;">
                    <a href="<?php echo base_url().'site/categories/featured_products';?>"><input type="button" value="See All" class="btn_buy_now btn" style="width:235px;"/></a>
                </div>
                <?php endif;?>
            </div>
            <div class="best_sellers">
                <h3>Best Sellers</h3>
                
                <?php if(!empty($best_sellers)):?>
                <ul>
                    <?php $count=0;?>
                    <?php foreach($best_sellers->result() as $best_seller):?>
                    <script>
                        var cat_id = '<?php echo $best_seller->fld_category;?>';
                        if(cat_id == '<?php echo $cat_id;?>'){
                            $(".best_sellers").hide();
                        }
                    </script>
                    <?php if($count<=5):?>
                    <?php 
                    $primary_img = select_primary_image($best_seller->fld_id);
                    if(empty($primary_img)){
                        $primary_img =  new stdClass();
                        $primary_img->fld_name='default.png';
                        $primary_img->fld_url = 'images';
                    }
                    ?>
                    <li class="product img_link">
                        <ul>
                            <li>
                                <img alt="product" src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>" width="225">
                            </li>
                            <li>
                                <div class="left"></div><div class="right bold"><?php echo $best_seller->fld_name;?></div>
                            </li>
                            <li>
                                <!--<div class="right"><span class="old_price">$<?php // echo $best_seller->fld_price;?></span></div>-->
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
<?php if(isset($sub_cat) && $sub_cat == TRUE){
    $subcat = url_title(strtolower($product->sub_cat)).'_'.url_title(strtolower($category_info->fld_name)).'_'.$sub_cid;
    ?>
<script>
    function display_items(nos){
        var subcat_id = <?php echo $sub_cid;?>;
        var cat_name = '<?php echo url_title(strtolower($cat_name->fld_name));?>';
        var subcat_name = '<?php echo(url_title(strtolower($category_info->fld_name)));?>';
        window.location.href='<?php echo base_url();?>'+cat_name+'/'+subcat_name+'-'+subcat_id+'/'+nos;
    }
    function sort_by(value){
        var subcat_id = '<?php echo $subcat;?>';
        var display_item = $(".display_item").val();
        location.href=base_url+'site/categories/subcat_set_sort_by/'+subcat_id+'/'+display_item+'/'+value;
    }
</script>
<?php }else{?>
<script>
    function display_items(nos){
        var cat_id = <?php echo $cat_id;?>;
        var cat_name = '<?php echo(url_title(strtolower($category_info->fld_name)));?>';
        window.location.href='<?php echo base_url();?>'+cat_name+'-'+cat_id+'/'+nos;
    }
    function sort_by(value){
        var cat_id = <?php echo $cat_id;?>;
        var display_item = $(".display_item").val();
        location.href=base_url+'site/categories/set_sort_by/'+cat_id+'/'+display_item+'/'+value;
    }
</script>
<?php }?>
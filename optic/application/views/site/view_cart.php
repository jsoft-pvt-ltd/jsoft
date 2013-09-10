<script>
    var num_cart_items = <?php
    if(isset($product_info_temp) && count($product_info_temp)>0):
        echo count($product_info_temp);
    else: echo 0;
    endif;
?>
</script>
<script src="<?php echo base_url().'js/site/promocode.js'?>"></script>
<script src="<?php echo base_url()?>js/admin/products.js"></script>
<script>
    function cart_items_count(){
        num_cart_items--;
        $('.num_cart_items').html(num_cart_items);
    }
</script>
<link rel="stylesheet" href="<?php echo base_url().'css/site/cart_steps.css'?>" type="text/css"/>
<script src="<?php echo base_url()?>js/site/cart_steps.js" type="text/javascript" charset="utf-8"></script>
<style>
    .shipping_details_holder {
        margin-left: 0px;
        padding-top: 15px;
        padding-left: 0px;
        border:none;
    }
</style>
<?php
    $category_id = $this->session->userdata('fld_category_id');
    $free_category = $this->session->userdata('free_category');
    $promocode = $this->session->userdata('promocode');
    if($category_id=="" || $category_id == NULL || $category_id==0){
        $category_id =0;
    }
    if($free_category=="" || $free_category == NULL || $free_category==0){
        $free_category =0;
    }
    if($promocode=="" || $promocode == NULL || $promocode==0){
        $promocode =0;
    }
?>
<script>
    current_category = <?php echo $category_id;?>;
    free_category = <?php echo $free_category;?>;
    promocode = <?php echo $promocode;?>;
    
</script>
<?php
    $this->load->helper('product_info_helper');
    $this->load->helper('admin/image_helper');
?>
<div class="wrapper">
<?php
    if((isset($product_info_temp) && count($product_info_temp)>0)|| (isset($accessories) && count($accessories)>0) || (isset($contact_lenses) && count($contact_lenses)>0)):
        $net_total=0;
?>
    <form style="margin-bottom: 15px;" id="paypalfrm" name="paypalfrm" action="<?php echo base_url();?>pay_pal/SetExpressCheckout.php" method="post">
        <div class="products left">
<?php
    foreach($product_info_temp as $keys => $items):
        $selected_product = get_product_info($product_info_temp[$keys]['fld_product']);
        $lens_type = get_lens_type_info($product_info_temp[$keys]['fld_lens_type']);
        $lens_package = get_lens_package_info($product_info_temp[$keys]['fld_lens_package']);
        $upgrades = get_upgrades($product_info_temp[$keys]['fld_lens_upgrade']);
        $color = get_product_color($product_info_temp[$keys]['fld_color']);
        $promo_flag = $product_info_temp[$keys]['fld_promo_flag'];
?>
        <div class="final_info clear border_right border_bottom" id="row_item_<?php echo $items['fld_id'];?>" style="margin-top: 18px;overflow:auto;padding-bottom: 15px;">
            <?php 
                if($selected_product->fld_stock==0){
                    echo '<div class="stock_empty">
                            <div class="info">
                                Sorry! <br/>
                                This Product Is Out Of Stock
                            </div>
                        </div>';
                    echo '<script>cart_items_count();</script>';
                }
            ?>
            <div class="final_product_image">
                <div class="left">
                    <?php
                        $p_img = select_primary_image($items['fld_product'], $items['fld_color']);
                    ?>
                    <div class="image_holder">
                        <img src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name;?>"/>
                    </div>
                </div>
                <div class="info right">
                    <b><?php echo $selected_product->fld_code;?><br/></b> <!--Item code-->
                    <input type="hidden" name="product_code[]" id="product_code[]" value="<?php echo $selected_product->fld_code;?>"/>
                    <?php if($promo_flag==true):
                    ?>
                        Price: 0<br/>
                        <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="0" />
                    <?php else:
                        ?>
                        Price: <?php echo $product_info_temp[$keys]['fld_product_price'];?><br/>
                        <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="<?php echo $product_info_temp[$keys]['fld_product_price'];?>" />
                    <?php endif;?>
                    Color: <?php echo $color;?><br/>
                    Qty: 1<br/>
                    <input type="hidden" name="itemQuantity[]" id="itemQuantity[]" value="1" />
                </div>
                <div class="clear">
                    Prescription: Skipped<br/><br/>
                    Lens Description:<br/>
                    Lens Type: 
                        <?php 
                            if(isset($lens_type->fld_name)){
                                echo $lens_type->fld_name;
                                echo "<input type='hidden' name='lens_type[]' id='lens_type' value='".$lens_type->fld_name."'/>";
                            }
                            else {
                                echo 'N/A';
                                echo "<input type='hidden' name='lens_type[]' id='lens_type[]' value='N/A'/>";
                            }
                        ?><br/>
                    Lens Package:
                        <?php 
                            if(isset($lens_package->fld_name)){
                                echo $lens_package->fld_name;
                                echo "<input type='hidden' name='lens_package[]' id='lens_package[]' value='".$lens_package->fld_name."'/>";
                            }
                            else {
                                echo 'N/A';
                                echo "<input type='hidden' name='lens_package[]' id='lens_package[]' value='N/A'/>";
                            }
                        ?><br/>
                    Price: 
                        <?php 
                            if(isset($lens_package->fld_price)){
                                if($promo_flag==true):
                                    echo '0';
                                    echo "<input type='hidden' name='lens_package_price[]' id='lens_package_price[]' value='0'/>";
                                else:
                                    echo $product_info_temp[$keys]['fld_lens_package_price'];
                                    echo "<input type='hidden' name='lens_package_price[]' id='lens_package_price[]' value='".$product_info_temp[$keys]['fld_lens_package_price']."'/>";
                                endif; 
                            }
                            else {
                                echo 'N/A';
                                echo "<input type='hidden' name='lens_package_price[]' id='lens_package_price[]' value='N/A'/>";
                            }
                        ?><br/>
                    Upgrades: 
                        <?php 
                            if(isset($upgrades['upgrade'])){
                                echo $upgrades['upgrade'].'<br/>';
                                echo "<input type='hidden' name='lens_upgrade[]' id='lens_upgrade[]' value='".$upgrades['upgrade']."'/>";
                                if($promo_flag==true):
                                    echo 'Price: 0';
                                    echo "<input type='hidden' name='lens_upgrade_price[]' id='lens_upgrade_price[]' value='0'/>";
                                else:
                                    echo 'Price: '.$product_info_temp[$keys]['fld_lens_upgrade_price'];
                                    echo "<input type='hidden' name='lens_upgrade_price[]' id='lens_upgrade_price[]' value='".$product_info_temp[$keys]['fld_lens_upgrade_price']."'/>";
                                endif; 
                            }
                            else {
                                echo 'N/A';
                                echo "<input type='hidden' name='lens_upgrade[]' id='lens_upgrade[]' value='N/A'/>";
                            }
                        ?><br/>
                        <?php 
                            if(isset($upgrades['upgrade_attr']))
                                echo $upgrades['upgrade_attr'].': '.$upgrades['upgrade_attr_value'];
                        ?><br/>
                        <?php
                            if(isset($lens_package->fld_price)){
                                $price_lens_package = $product_info_temp[$keys]['fld_lens_package_price'];
                            }
                            else {
                                $price_lens_package = 0;
                            }
                            if(isset($upgrades['price'])){
                                $price_upgrades = $product_info_temp[$keys]['fld_lens_upgrade_price'];
                            }else {
                                $price_upgrades = 0;
                            }
                        ?>
                        
                    <?php
                    if($promo_flag==true):
                        $total = 0;
                    else:
                        $total = $product_info_temp[$keys]['fld_product_price'] + $price_lens_package  + $price_upgrades;
                    endif; 
                    ?>
                    <b>Total</b><div class="right"><?php echo $total;?></div>
                    <input type='hidden' name='sub_total[]' id='sub_total[]' value='<?php echo $total;?>'/>
                    <?php $net_total = $net_total+$total;?>
                    <script>total_price = <?php echo $net_total;?></script>
                </div>
            </div>
            <div class="edit_delete">
                <div class="right">
                    <a href="javascript:void(0);" class="delete margin_right" id="item_<?php echo $items['fld_id'];?>" name="<?php echo base_url().'site/cart_steps/delete_item/0'?>" onclick="set_cart(<?php echo $net_total;?>,<?php echo $items['fld_qty'];?>,'frame');">Delete</a>
                </div>
            </div>
        </div>
<?php 
    endforeach;
    $grand_total = $net_total;
?>
    </div>
        
    <?php if(count($accessories)>0):$accessory_total = 0;$accessory_net_total = 0;?>
        <div class="accessories left">
            <?php foreach($accessories as $accessory):?>
            <div id="row_<?php echo 'acc_'.$accessory['fld_id'];?>">
                <div class="image td">
                    <img src="<?php echo base_url().$accessory['fld_location'].'/thumbs/'.$accessory['fld_image'];?>"/>
                </div>
                <div class="info td">
                    <b><?php echo $accessory['fld_name'];?></b><br/>
                    <input type="hidden" name="product_code[]" id="product_code[]" value="<?php echo $accessory['fld_name'];?>"/>
                    <?php echo 'Price:'. $accessory['fld_price'];?><br/>
                    <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="<?php echo $accessory['fld_price'];?>">
                    <?php echo 'Color: '.$accessory['fld_color'];?><br/>
                    <?php echo 'Qty: '.$accessory['fld_qty'];?><br/>
                    <?php echo 'Sub Total:'. $accessory['fld_price']*$accessory['fld_qty'];?><br/>
                    <input type="hidden" name="sub_total[]" id="sub_total[]" value="<?php echo $accessory['fld_price'];?>" />
                    <a href="<?php echo base_url().'site/accessories/selected_accessory/'.$accessory['fld_accessory_id'].'/'.$accessory['fld_id'];?>">Edit</a>
                    <input type="hidden" name="itemQuantity[]" id="itemQuantity[]" value="<?php echo $accessory['fld_qty'];?>" />
                    <?php $accessory_total = $accessory_total + $accessory['fld_price']*$accessory['fld_qty']?>
                </div>
                
            </div>
            <?php endforeach;?>
            <b>Total</b><div class="right"><?php echo $accessory_total;?></div>
                    <!--<input type='hidden' name='sub_total[]' id='sub_total[]' value='<?php echo $accessory_total;?>'/>-->
        </div>
        <?php $grand_total+=$accessory_total;?>
    <?php endif;?>
        <?php if(count($contact_lenses)>0):$contact_lens_total=0;?>
        <div class="contact_lenses left">
            <?php foreach($contact_lenses as $contact_lens):?>
            <div id="row_<?php echo 'c_lens'.$contact_lens['fld_id'];?>">
                <div class="image td">
                    <img src="<?php echo base_url().$contact_lens['fld_location'].'/thumbs/'.$contact_lens['fld_image'];?>"/>
                </div>
                <div class="info td">
                    <b><?php echo $contact_lens['fld_name'];?></b><br/>
                    <input type="hidden" name="product_code[]" id="product_code[]" value="<?php echo $contact_lens['fld_name'];?>"/>
                    <?php echo 'Price:'. $contact_lens['fld_price'];?><br/>
                    <?php  //for total price with the box;
                        $total_contact_lens_price = ($contact_lens['fld_boxes_right']+$contact_lens['fld_boxes_left'])*$contact_lens['fld_price'];
                    ?>
                    <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="<?php echo $total_contact_lens_price;?>">
                    <?php echo 'Boxes: '.$contact_lens['fld_boxes_right'].' [Rt], ',$contact_lens['fld_boxes_left'].' [Lft]';?><br/>
                    <?php echo 'Qty: '.$contact_lens['fld_qty'];?><br/>
                    <?php echo 'Sub Total: '.$total_contact_lens_price;?><br/>
                    <input type="hidden" name="itemQuantity[]" id="itemQuantity[]" value="<?php echo $contact_lens['fld_qty'];?>" />
                    <input type='hidden' name='sub_total[]' id='sub_total[]' value='<?php echo $total_contact_lens_price;?>'/>
                </div>
            </div>
            <?php $contact_lens_total = $contact_lens_total + $total_contact_lens_price;?>
            <?php endforeach;?>
            <b>Total</b><div class="right"><?php echo $contact_lens_total;?></div>
        </div>
        <?php $grand_total+=$contact_lens_total;?>
    <?php endif;?>
        <div class="clear grand_total">
            <hr/>
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Grand Total:&nbsp;&nbsp;&nbsp;<b style="font-size: 25px;color:#cf0000;">$ <?php echo $grand_total;?></b>
        </div>
    <div class="clear shipping_details_holder margin_top" style="width: 688px;">
        <div class="promotion_code">
            <b>Promotion Code: </b>
            <input id="promocode" type="text" name="promocode" id="promo_code"/>
            <a href="javascript:void(0);" onclick="check();">Check</a>
        </div>
        <div class="shipping_details">
            <b>Shipping Details</b>
            <div class="table">
                <div class="tr headings">
                    <div class="th">Country</div>
                    <div class="th">Carrier</div>
                    <div class="th">Shipping Cost</div>
                    <div class="th">Insurance Cost</div>
                </div>
                <?php foreach($carriers_country->result() as $ccountry):?>

                <div class="country">
                    <div class="tr">
                        <div class="td title">
                            <?php echo $ccountry->fld_name;?>
                        </div>
                    </div>
                    <?php $this->load->helper('admin/country_helper');$carriers = carriers($ccountry->fld_id);?>
                    <?php foreach($carriers->result() as $carrier):?>
                    <div class="tr">
                        <div class="td">
                            <input type="radio" name="carrier" value="<?php echo $carrier->fld_id;?>" onclick="set_carrier(value);"/>
                        </div>
                        <div class="td"><?php echo $carrier->fld_carrier;?></div>
                        <div class="td"><?php echo $carrier->fld_shipping_cost;?></div>
                        <div class="td"><?php echo $carrier->fld_insurance_cost;?></div>
                        <div class="shipping_info"></div>
                    </div>
                    <?php endforeach;?>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
        <input type="submit" value="" class="pay_pal_check_out" style="background: url(https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif);border: medium none;height: 38px;width: 145px;cursor: pointer;"/>
    </form>
<?php else: ?>
    <?php
        if(sizeof($this->config->item('total_cart_items'))>0):
//        foreach($this->cart->contents() as $items):
//    ?>
<!--        <div class="final_info left border_right margin_top" style="height:286px;">
            <div class="final_product_image">
                <img src="//<?php echo $items['options']['product_image'];?>"/>
            </div>

            Item Code: //<?php echo $items['options']['item_code'];?><br/>
            Price: //<?php echo $items['options']['product_price'];?><br/>
            Color: //<?php echo $items['options']['product_color'];?><br/>

            Prescription: Skipped<br/><br/>
            Lens Description:<br/>
            Lens Type: //<?php echo $items['options']['lens_type'];?><br/>
            Upgrades: //<?php echo $items['options']['lens_upgrade'];?><br/>
            Color: //<?php echo $items['options']['lens_upgrade_color'];?><br/>
            Price: //<?php echo $items['options']['lens_upgrade_price'];?><br/>
            <div class="total">
                <b>Total</b>
                <div class="right">//<?php echo $items['price'];?></div>
            </div>
        </div>-->
    <?php 
//        endforeach;
        else:
    ?>
    No any items in cart :(
    <?php endif;?>
<?php
    endif;
?>
</div><!--Wrapper class ends-->
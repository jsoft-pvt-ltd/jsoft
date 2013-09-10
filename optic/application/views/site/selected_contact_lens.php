<style>
    
.tr {
    display: table-row;
}
.td {
    display: table-cell;
    padding: 2px 5px;
}

</style>
<?php 
//    $this->load->helper('admin/image_helper');
//    $images = select_images($accessory->fld_id);//Load helpers and others here
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
    <a href="<?php echo base_url();?>">Home</a> > <a href="<?php echo base_url().$this->uri->segment(1).'-'.$accessory->fld_category.'/9';?>"><?php echo $this->uri->segment(1);?></a> >  <?php echo $selected[0];?>
</div>
<?php }else{?>
<?php 
    $selected = explode('-',$this->uri->segment(3));
?>
<div class="breadcrumb">
	Breadcrumb > Here
    <!--<a href="<?php echo base_url();?>">Home</a> > <a href="<?php echo base_url().$this->uri->segment(1).'-'.$accessory->fld_category.'/9';?>"><?php echo $this->uri->segment(1);?></a> > <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'-'.$accessory->fld_subcategory.'/9';?>"><?php echo $this->uri->segment(2);?></a> > <?php echo $selected[0];?>-->
</div>
<?php }?>


<div id="error_place" class="error_place" style="display:none;"><div class="error_title"></div></div>

<div class="wrapper">
    <?php if($this->session->userdata('promocode')==1 && $accessory->fld_category==$this->session->userdata('free_category')):?>
        <div class="promocode_result">
            <p>Please select through the process.The promocode you used is cost free in this category.
            The cost throughout the process is none.</p>
        </div>
    <?php endif;?>
    <div class="left items border_right">
        <h1><?php echo ucfirst($contact_lens->fld_name);?></h1>
        <div class="img_views">
        <div class="primary_img">
            <img alt="product" src="<?php echo base_url().$contact_lens->fld_location.'/'.$contact_lens->fld_image;?>">
        </div>
        
        </div>
        <div class="img_desc">
            <div class="usual_header" id="usual_header">
                <ul> 
                    <li>
                        <a class="selected presc_tab" href="#enter_presc">
                            <h2>Enter Prescription</h2>
                        </a>
                    </li>
                    <li>
                        <a class="presc_tab" href="#about_glass">
                            <h2>About <?php echo $contact_lens->fld_name;?></h2>
                        </a>
                    </li> 
                </ul>
                <div id="enter_presc" class="tabs">
                    <form action="<?php echo base_url().'site/contact_lens/cart'?>" method="post" name="frm_enter_presc" id="frm_enter_presc">
                    <?php if(isset($contact_lens_attr) && !empty($contact_lens_attr)):?>
                        <input type="hidden" value="<?php echo $contact_lens->fld_id;?>" name="fld_lens_id" id="fld_lens_id"/>
                        <input type="hidden" value="<?php echo $contact_lens->fld_name;?>" name="fld_name" id="fld_name"/>
                        <input type="hidden" value="<?php echo $contact_lens->fld_brand;?>" name="fld_brand" id="fld_brand"/>
                        <input type="hidden" value="<?php echo $contact_lens->fld_discount_price;?>" name="fld_price" id="fld_price"/>
                        <input type="hidden" value="<?php echo $contact_lens->fld_lpb;?>" name="fld_lpb" id="fld_lpb"/>
                        <input type="hidden" value="<?php echo $contact_lens->fld_location;?>" name="fld_location" id="fld_location"/>
                        <input type="hidden" value="<?php echo $contact_lens->fld_image;?>" name="fld_image" id="fld_image"/>
                    <div class="attributes">
                        <div class="lpb">
                            <?php echo $contact_lens->fld_lpb;?> Lenese Per Box
                        </div>
                        <div class="tr">
                            <div class="td">
                                
                            </div>
                            <?php if(isset($contact_lens_attr['power_minus']) || isset($contact_lens_attr['power_plus'])):?>
                            <div class="td">
                                Power
                            </div>
                            <?php endif;?>
<!--                            <div class="td">SPH</div>-->
                            <?php if(isset($contact_lens_attr['cylinder']) && !empty($contact_lens_attr['cylinder'])):?>
                            <div class="td">CYL</div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['base_curve']) && !empty($contact_lens_attr['base_curve'])):?>
                            <div class="td">BC</div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['axis']) && !empty($contact_lens_attr['axis'])):?>
                            <div class="td">AXIS</div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['diameter']) && !empty($contact_lens_attr['diameter'])):?>
                            <div class="td">DIA</div>
                            <?php endif;?>
                            <div class="td">Boxes</div>
                        </div>
                        <div class="tr">
                            <div class="td">
                                Left Eye:
                            </div>
                            <?php if(isset($contact_lens_attr['power_minus']) || isset($contact_lens_attr['power_plus'])):?>
                            <div class="td">
                                <select name="fld_power_left" id="fld_power_left">
                                    <?php foreach($contact_lens_attr['power_minus'] as $key=>$value):?>
                                        <option value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                    <?php foreach($contact_lens_attr['power_plus'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
<!--                            <div class="td">SPH</div>-->
                            <?php if(isset($contact_lens_attr['cylinder']) && !empty($contact_lens_attr['cylinder'])):?>
                            <div class="td">
                                <select name="fld_cyl_left">
                                    
                                    <?php foreach($contact_lens_attr['cylinder'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['base_curve']) && !empty($contact_lens_attr['base_curve'])):?>
                            <div class="td">
                                <select name="fld_base_curve_left">
                                    
                                    <?php foreach($contact_lens_attr['base_curve'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['axis']) && !empty($contact_lens_attr['axis'])):?>
                            <div class="td">
                                <select name="fld_axis_left">
                                    
                                    <?php foreach($contact_lens_attr['axis'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['diameter']) && !empty($contact_lens_attr['diameter'])):?>
                            <div class="td">
                                <select name="fld_diameter_left">
                                    
                                    <?php foreach($contact_lens_attr['diameter'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <div class="td">
                                <select name="fld_boxes_left">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6" selected="selected">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="tr">
                            <?php if(isset($contact_lens_attr['power_minus']) || isset($contact_lens_attr['power_plus'])):?>
                            <div class="td">Right Eye:</div>
                            <div class="td">
                                <select name="fld_power_right">
                                    <?php foreach($contact_lens_attr['power_minus'] as $key=>$value):?>
                                        <option value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                    <?php foreach($contact_lens_attr['power_plus'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
<!--                            <div class="td">SPH</div>-->
                            <?php if(isset($contact_lens_attr['cylinder']) && !empty($contact_lens_attr['cylinder'])):?>
                            <div class="td">
                                <select name="fld_cyl_right">
                                    
                                    <?php foreach($contact_lens_attr['cylinder'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['base_curve']) && !empty($contact_lens_attr['base_curve'])):?>
                            <div class="td">
                                <select name="fld_base_curve_right">
                                    
                                    <?php foreach($contact_lens_attr['base_curve'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['axis']) && !empty($contact_lens_attr['axis'])):?>
                            <div class="td">
                                <select name="fld_axis_right">
                                    
                                    <?php foreach($contact_lens_attr['axis'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <?php if(isset($contact_lens_attr['diameter']) && !empty($contact_lens_attr['diameter'])):?>
                            <div class="td">
                                <select name="fld_diameter_right">
                                    
                                    <?php foreach($contact_lens_attr['diameter'] as $key=>$value):?>
                                        <?
                                        if($value['fld_value']==0){
                                            $selected = 'selected="selected"';
                                        }else $selected='';
                                        ?>
                                        <option <?php echo $selected;?> value="<?php echo $value['fld_value'];?>"><?php echo $value['fld_value'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php endif;?>
                            <div class="td">
                                <select name="fld_boxes_right">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6" selected="selected">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                        <div class="patient_info">
                            Patient First Name: <input type="text" name="fld_patient_fname" id="fld_patient_fname"/>
                            Last Name: <input type="text" name="fld_patient_lname" id="fld_patient_lname"/>
                        </div>
                        <input type="submit" class="btn" value="Buy Now">
                    </form>
                </div>
                <div id="about_glass" class="tabs">
                    <p>
                        <?php echo $contact_lens->fld_description;?>
                    </p>
                </div>
            </div>
        </div>
        <div id="fb-root"></div>
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <fb:comments  href="<?php echo current_url();?>" num_posts="5" width="728"></fb:comments> 
    </div>
    <div class="left extras">
        <div class="product_info">
            <h3 style="font-weight:bold;"><?php echo ucfirst($contact_lens->fld_name);?></h3>
            <div class="info">
                <span>Availability: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="right">
                    <?php
                    if($contact_lens->fld_quantity>0){
                        echo "<b style='color:#555555'>In Stock</b>";
                    }
                    else echo '<b>Out of Stock</b>';
                    ?>
                </span>
            </div>
            <div class="info">
                <?php if($contact_lens->fld_discount>0):?>
                <span>
                    <div class="left discount"><?php echo $contact_lens->fld_discount;?>% off</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="right price"><span class="old_price">$<?php echo $contact_lens->fld_sp;?></span></div>
                </span>
                <!--<span class="right old_price">$ <?php echo $contact_lens->fld_discount_price;?></span>-->
                    <?php endif;?>
            </div>
            <div class="info">
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="price right">$ <?php echo $contact_lens->fld_discount_price;?></span>
            </div>
            <div class="info">
                <span>
                    <a href="javascript:void(0)" onclick="wishlist(<?php echo $contact_lens->fld_id;?>)" >Add to Wishlist</a>
                </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><a>Email a Friend</a></span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().'js/jquery.validate.js';?>"></script>
<script type="text/javascript"> 
   $("#usual_header ul").idTabs(); 
   function select_color(image, qty){
       image = base_url+image;
//       alert(attr_id+'---'+color_id+'---'+image);
       $('.primary_img img').attr("src",image);
       var i;
       var html="";
       for(i=1;i<=qty;i++){
           html=html+"<option value='"+i+"'>"+i+"</option>";
       }
       $("#qty").html(html);
       $('.qty').slideDown(400);
   }
   $(function(){
       $('#frm_accessory_info').validate({
        errorLabelContainer: "#error_place",
        rules:{
            color:{
                required:true
            }
        },
        messages:{
            color:{
                required:"Please select an <b>Accessory Color</b>. &raquo"
            }
        }
    });
   })
</script>

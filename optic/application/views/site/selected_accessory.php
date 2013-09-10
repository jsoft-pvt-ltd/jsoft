<?php 
    if(isset($temp)){?>
    <script>
        $(function(){
            $(".primary_img img").prop("src",base_url+'<?php echo $temp->fld_location.'/'.$temp->fld_image;?>');
            $("input[value='<?php echo $temp->fld_color?>']").attr('checked', true);
            $("input[value='<?php echo $temp->fld_color?>']").parent('div').addClass('selected_color');
            funct = $("input[value='<?php echo $temp->fld_color?>']").parent().prop('onclick');
            funct = String(funct); //converted the function to the string mode so that it becomes easy to replace
            funct = funct.replace('function ', '');//replacing the string
            pos = funct.indexOf("{") + 1;//selecting the string after the { bracket
            funct = (funct.slice(pos, -1));//slicint the } bracket
            funct = funct.substring(0, funct.length - 3);//removing the ) bracket
            funct = funct+',<?php echo $temp->fld_qty?>);';//appending the last parameter
            eval(funct);//executing the function
        })
    </script>

        
    <?php 
        }
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
        <h1><?php echo ucfirst($accessory->fld_name);?></h1>
        <div class="img_views">
        <div class="primary_img">
            <img alt="product" src="<?php echo base_url().$accessory->fld_location.'/'.$accessory->fld_image;?>">
        </div>
        <div class="thumbs">
            <?php 
                foreach($accessory_attr->result() as $attr){
                    echo '<img alt="product" src="'.base_url().$attr->fld_location."/thumbs/".$attr->fld_image.'" class="thumb_imgs" width="142" onclick="change_image(this);">';
                }
            ?>
            <!--<img alt="product" src="<?php echo base_url().$attr->fld_location.'/thumbs/'.$attr->fld_image;?>" class="thumb_imgs" width="142" onclick="change_image(this);">-->
        </div>
        </div>
        <div class="img_desc">
            <div class="usual_header" id="usual_header">
                <ul> 
                    <li>
                        <a class="selected presc_tab" href="#about_glass">
                            <h2>About <?php echo $accessory->fld_name;?></h2>
                        </a>
                    </li> 
                </ul>
                <div id="about_glass" class="tabs">
                    <p>
                        <?php echo $accessory->fld_description;?>
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
            <h3 style="font-weight:bold;"><?php echo ucfirst($accessory->fld_name);?></h3>
            <div class="info">
                <span>Availability: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="right">
                    <?php
                    if($accessory->fld_qty>0){
                        echo "<b style='color:#555555'>In Stock</b>";
                    }
                    else echo '<b>Out of Stock</b>';
                    ?>
                </span>
            </div>
            <div class="info">
                <?php if($accessory->fld_discount>0):?>
                <span>
                    <div class="left discount"><?php echo $accessory->fld_discount;?>% off</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="right price"><span class="old_price">$<?php echo $accessory->fld_cp;?></span></div>
                </span>
                <!--<span class="right old_price">$ <?php echo $accessory->fld_sp;?></span>-->
                    <?php endif;?>
            </div>
            <div class="info">
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="price right">$ <?php echo $accessory->fld_sp;?></span>
            </div>
            <div class="info">
                <span>
                    <a href="javascript:void(0)" onclick="wishlist(<?php echo $accessory->fld_accessory_id;?>)" >Add to Wishlist</a>
                </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><a>Email a Friend</a></span>
            </div>
        </div>
        <div class="product_attrs">
            <form name="frm_accessory_info" id="frm_accessory_info" method="post" action="<?php echo $action;?>">
                <div class="product_color">
                    <h3 class="margin_bottom">Accessory Colors</h3>
                    <input type="hidden" value="<?php echo $accessory->fld_item_code;?>" name="item_code"/>
                    <input type="hidden" value="<?php echo $accessory->fld_accessory_id;?>" name="id"/>
                    <input type="hidden" value="<?php echo $accessory->fld_sp;?>" name="price"/>
                    <?php 

                        foreach($accessory_attr->result() as $attr){
//                            if(isset($edit) && $attr->fld_color==$color){$class = 'selected_color';}else{$class = '';}
                            echo '<div class="colors left" title="'.$attr->fld_color.'" onclick="select_color(&#34'.$attr->fld_location.'/'.$attr->fld_image.'&#34,'.$attr->fld_qty.');">';?>
                                <input type="radio" name="color" value="<?php echo $attr->fld_color;?>" class="left color_radios"/>
                        <?php    echo $attr->fld_color.'</div>';
                        }
                    ?>
                </div>
                <div class="qty margin_bottom" style="display:none;">
                    <h3 class="margin_bottom">Quantity</h3>
                    <select class="qty" id="qty" name="qty" style="width:50px;">
                    </select>
                </div>
                <div class="action_controller">
                    <input type="submit" value="Buy Now" class=" btn btn_buy_now"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().'js/jquery.validate.js';?>"></script>
<script type="text/javascript"> 
   $("#usual_header ul").idTabs(); 
   function select_color(image, qty,selected_qty){
       image = base_url+image;
//       alert(attr_id+'---'+color_id+'---'+image);
       $('.primary_img img').attr("src",image);
       var i;
       var html="";
       for(i=1;i<=qty;i++){
           if((selected_qty!=null || selected_qty!="" || selected_qty!=0) && i==selected_qty){
               selected = 'selected="selected"';
           }else selected='';
           html=html+"<option "+selected+" value='"+i+"'>"+i+"</option>";
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

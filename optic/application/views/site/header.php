<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name ='title' content="<?php echo $title ?>"/>
        <meta name="Description" content="<?php
        if(isset($metaDescription)){
            echo $metaDescription;
        }
        ?>" />
        <title><?php echo $title?></title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/global.css'?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/site/header.css'?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/site/footer.css'?>"/>
        <!--<link href="<?php echo base_url();?>css/site/menuV2.css" rel="stylesheet" type="text/css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/site/tabs.css'?>"/>
        <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" />
        <?php
            $this->session->set_userdata('user_panel',TRUE);
            $this->load->helper('categories_helper');
            $this->load->helper('product_info_helper');
            $this->load->helper('login_helper');
//            $this->output->enable_profiler(TRUE);
        ?>
        <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";
            var logged_in = "<?php echo IsLoggedIn();?>"
        </script>
        <script type="text/javascript" src="<?php echo base_url().'js/variables.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'js/jquery-1.9.0.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'js/jquery-ui.js';?>" ></script>
        <script type="text/javascript" src="<?php echo base_url().'js/site/header.js'?>"></script>
        <!--<script src="<?php echo base_url();?>js/site/menuV2.js" type="text/javascript"></script>-->
        <script type="text/javascript" src="<?php echo base_url().'js/site/jquery.tabify.js';?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'js/site/search.js';?>"></script>

        <?php
            $categories=get_all_categories();
            if($categories->num_rows()!=0){
                $sub_categories = get_all_sub_categories();
            }
        ?>
    </head>
    <body>
        <div class="profile_pic" align="right">
            
            <?php if($this->session->userdata('userSocialId')):?>
                <?php $me = $this->session->userdata('me');?>
                <img class="header_profile_pic" src="<?php echo $me['profile_image_url'];?>">
            <?php else:?>
                <?php if($this->session->userdata('userId')):?>
                    <?php $this->load->helper('login_helper');$profilePicInfo = CheckProfilePicture();?>
                    <?php if($profilePicInfo->fld_profile_pic==""):?>
                        <img class="header_profile_pic" src="<?php echo base_url().'skin/images/user.jpg';?>">
                    <?php else:?>
                        <img class="header_profile_pic" src="<?php echo base_url().$profilePicInfo->fld_profile_pic_url.'/thumbs/'.$profilePicInfo->fld_profile_pic;?>">
                    <?php endif;?>
                <?php endif;?>        
            <?php endif;?>        

        </div>
        <div class="header">
            <div class="basic_menu">
                <div class="contents">
                    <ul class="left menu_ul">
                        <li><a href="<?php echo base_url()?>" title="Home">
                                <div class="home_img"></div>
                            </a> 
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>" title="About">About</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>" title="Business">Business</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>" title="Contact">Contact</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>help" title="Help">Help</a>
                        </li>
                    </ul>
                    <div class="user_bar right">
                        <ul>
                            <?php if(IsLoggedIn()!=1):?>
                                <li><a href="<?php echo base_url().'user/login'?>" title="Login">Login</a> | </li>
                                <li><a href="<?php echo base_url().'user/register'?>" title="Register">Register</a> </li>
                            <?php else:?>
                                <li><p class="left">Hello <b><?php echo ucfirst($this->session->userdata('username'));?></b>&nbsp;&nbsp;&nbsp;</p> </li>
                                <li><a href="<?php echo base_url().'user/control_panel'?>" title="Settings">Settings</a> | </li>
                                <li><a href="<?php echo base_url().'user/login/logout'?>" title="Logout">Logout</a> </li>
                            <?php endif;?>
                            <li>
                                <style>                                    
                                    .search_img {
                                        background: none repeat scroll 0 0 #333333;
                                        margin-left: 11px;
                                        margin-top: -7px;
                                        padding: 7px 8px;
                                        position: absolute;
                                    }
                                    .search_img_holder {
                                        height: 15px;
                                        width: 42px;
                                    }
                                    .search_img >li> img {
                                        vertical-align: middle;
                                    }
                                </style>
                                <!--<input type="text" class="basic_menu_search_bar" placeholder="search..." id="search_keyword" name="searc_keyword"/>-->
<!--                                <div class="search_img_holder">
                                    <div class="search_img">
                                        <img src="<?php echo base_url().'images/search.png'?>"/>
                                    </div>
                                </div>-->
                                <!--::::::::::::::::::::::::::::::::::::::::Search Navigation:::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
                                    <!--<div class="advanced_menu right" style="display:block;">-->
                                        <div class="search search_img_holder" style="margin-left: -1px;">
                                            <ul class="search_img">
                                                <li class="title">
                                                    <img src="<?php echo base_url().'images/search.png'?>"/>
                                                    <div class="sub_menu_holder search_menu">
                                                        <?php $this->load->helper('search_helper');$product_types = product_types();?>
                                                            <div class="sub_menu">
                                                                <div id="adv2"> 
                                                                    <div id="usual_header" class="usual_header"> 
                                                                        <ul> 
                                                                            <?php 
                                                                            $count=1;
                                                                            foreach($product_types->result() as $product_type):?>
                                                                            <li><a class="selected" href="#tab<?php echo $count;?>"><?php echo $product_type->fld_name;?></a></li> 
                                                                            <?php $count++;endforeach;?>
                                                                        </ul>
                                                                        <?php $count_tab=1;foreach($product_types->result() as $product_type):?>

                                                                            <div id="tab<?php echo $count_tab;?>" class="tabs">
                                                                                <?php 
//                                                                                    if($count_tab==1) echo '';
//                                                                                    else 
                                                                                        if($count_tab==2){;
                                                                                ?>
                                                                                <form id="frm_search<?php echo $count_tab;?>" name="frm_search<?php echo $count_tab;?>" method="get" action="<?php echo base_url().'site/search/index';?>" >
                                                                                <div class="catsh">
                                                                                    <?php $this->load->helper('search_helper');$cats = cats_subcats();?>
                                                                                    <?php foreach($cats as $category):?>
                                                                                    <div class="cath" id="cat_<?php echo $category['fld_id'];?>">
                                                                                        <input type="checkbox" name="cat[]" value="<?php echo $category['fld_id'];?>" onclick="check_all(<?php echo $count_tab;?>,<?php echo $category['fld_id'];?>)" <?php if(isset($ucat)){ for($c=0;$c<sizeof($ucat);$c++){  if($ucat[$c]==$category['fld_id']){  echo 'checked="true"';$cf="true";break;}}}?>>




                                                                                            <?php echo $category['fld_name'];?>
                                                                                        <div class="subcath">
                                                                                            <?php //$this->load->helper('search_helper');$subcats = subcategories($category->fld_id);?>
                                                                                            <ul>
                                                                                            <?php foreach($category['subcat'] as $subcat):?>

                                                                                                    <li>
                                                                                                        <input type="checkbox" name="sub[]" value="<?php echo $subcat['subcat_id'];?>" disabled="disabled" <?php if(isset($usub)){   for($s=0;$s<sizeof($usub);$s++){    if($usub[$s]==$subcat['subcat_id']){   echo 'checked="true"';break;}}}?>> <?php echo $subcat['subcat_name'];?>
                                                                                                    </li>


                                                                                            <?php endforeach;?>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php if(isset($ucat))
                                                                                    {
                                                                                       echo '<script>';
                                                                                       for($c=0;$c<sizeof($ucat);$c++)
                                                                                       {
                                                                                           echo 'prevent('.$count_tab.','.$ucat[$c].');';
                                                                                       }
                                                                                       echo '</script>';
                                                                                    }?>
                <!--:::::::::::::::::::::::::::::::::::::Range::::::::::::::::::::::::::::::::::-->                                                                    
                <script type="text/javascript">
                    var min = <?php echo $category['min_price'];?>;
                    var max = <?php echo $category['max_price'];?>;
                    $(document).ready(function() {
                        $( "#slider-range" ).slider({
                        range: true,
                        min: min,
                        max: max,
                        values: [ min , max ],
                        change: function( event, ui ) {
                            $( "#min_price" ).val(ui.values[ 0 ]);
                            $( "#max_price" ).val(ui.values[ 1 ]);
                            set_range(ui.values[ 0 ], ui.values[ 1 ]);
                        }
                        });
                        $( "#min_price" ).val( $( "#slider-range" ).slider( "values", 0 ));
                        $( "#max_price" ).val( $( "#slider-range" ).slider( "values", 1 ));
                    });
                </script>
                <!--::::::::::::::::::::::::::::::::::Range:::::::::::::::::::::::::::::::::::::::::-->                                                                    
                <?php endforeach;?>
                </div>
                <div class="atth">    
                <?php

                $this->load->helper('admin/attributes_helper');
                $attributes = attributes($product_type->fld_id);
                $attributes_values = attributes_values();


                /*-----------------------------------------------------------------attributes tree---------------------------------------------------------------------*/
                $attrs = get_attributes();        
                foreach($attrs as $key=>$value)
                    {
                        $attributess[$value->fld_id]['fld_id']=$value->fld_id;
                        $attributess[$value->fld_id]['fld_name']=$value->fld_name;
                        $attributess[$value->fld_id]['fld_product_type_id']=$value->fld_product_type_id;
                        $attributess[$value->fld_id]['fld_location']=$value->fld_location;
                        $attributess[$value->fld_id]['fld_image']=$value->fld_image;
                        $attributess[$value->fld_id]['attr'][$value->attr_id]=array(
                                                                                'attr_id'=>$value->attr_id,
                                                                                'attr_name'=>$value->attr_name,
                                                                                'parent_id'=>$value->parent_id,
                                                                                'fld_attribute_id'=>$value->fld_attribute_id,    
                                                                            );
                    }
                foreach($attributess as $keys=>$values){
                    echo '<div class="search_params left"> '.$values['fld_name'];
                    $tree ="";
                    foreach($values['attr'] as $node){
                            $new_node = new stdClass();
                            if($values['fld_id'] == $node['fld_attribute_id']){
                            foreach($node as $key=>$value){
                                $new_node->$key = $value;

                            }             

                            $nodes[$node['attr_id']] = array(
                                'value' =>$new_node
                            );

                            if ($node['parent_id']==0)
                            {
                                $tree[$node['attr_id']] = &$nodes[$node['attr_id']];
                            }else
                            {
                                if (($nodes[$node['parent_id']])==0){
                                    $nodes[$node['parent_id']] = array();
                                }
                                $nodes[$node['parent_id']][$node['attr_id']] = &$nodes[$node['attr_id']];
                            }
                        $node=""; }
                    }
                    displayArrayRecursively($values['fld_id'], $tree);
                    $temp = '';
                    echo '</div>';
                }
                ?>    
                </div>
                <!-- :::::::::::::::::::::::::::::::::::::::::::price range slider:::::::::::::::::::::::::::::::::::::::::-->

                <div>Price Range 
                    <p>Rs.<input type="text" id="min_price" name="min_price" style="border: 0; color: #333333;background: none; font-weight: bold;width:30px;">- Rs.<input type="text" id="max_price" name="max_price" style="border: 0; color: #333333;background: none; font-weight: bold;"></p>
                    <div id="slider-range"></div>
                </div>
                <br>
                <!-- :::::::::::::::::::::::::::::::::::::::::::price range slider:::::::::::::::::::::::::::::::::::::::::-->
                                                                                    <div class="submit">
                                                                                         <input type="submit" value="Search" class="submit">
                                                                                    </div>
                                                                                </form>
                                                                                <?php }?>
                                                                            </div>
                                                                        <?php $count_tab++;endforeach;?>
                                                                    </div>
                                                                </div>

                                                              <!--=======================================================================================-->
                                                            </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    <!--</div>-->
                                    <!--::::::::::::::::::::::::::::::::::::::::Search Navigation Ends:::::::::::::::::::::::::::::::::::::::::::::::::::-->
                    
                    
                    
                            </li>
                            <li class="my_cart">
                                <a href="<?php echo base_url();?>site/cart_steps/view_cart">
                                <div class="cart_icon right">
                                <!--<a href="<?php echo base_url();?>site/cart_steps/view_steps#final_product"><div class="cart_icon right">-->
                                    <img src="<?php echo base_url().'images/cart.png'?>" alt="Optic Store Online Cart" class="cart_img clear"/>
                                    <div class="num_cart_items right">
                                        <?php 
                                        $extra = $this->session->userdata('total_cart_item');
                                        if($extra>0){
                                            $extra = $this->session->userdata('total_cart_item');
                                        }else $extra=0;
                                        if(IsLoggedIn()){
                                            $qty = get_total_cart_qty($this->session->userdata('userId'));
                                                $total_cart_item = $qty->temp+$qty->accessories+$qty->contact_lenses;
                                                echo $total_cart_item;
                                        }
                                        else {
                                            $qty = get_total_cart_qty('sess_'.$this->session->userdata('fld_id'));
                                            $total_cart_item = $qty->temp+$qty->accessories+$qty->contact_lenses;
                                            echo $total_cart_item;
                                        }
                                        $this->config->set_item('total_cart_items', $total_cart_item);
                                        ?>
                                    </div>
                                </div>
                                </a>
                                <div class="cart_item_info_container" style="display:none;">
                                    <div class="abx">
                                        <img src="<?php echo base_url().'images/arrow_up.png'?>">
                                    </div>
                                    <div class="cart_item_info">
                                        <div>
                                            <div class="table">
                                                <div class="tr frame_cart" <?php if($qty->temp==0) echo 'style="display:none;"'?>>
                                                    <div class="td">
                                                        <img src="<?php echo base_url().'images/test.jpg';?>" width="100"/>
                                                    </div>
                                                    <div class="td">
                                                        <b>Frames</b><br/>
                                                        <span class="frame_qty">Qty: <span><?php echo $qty->temp;?></span></span>
                                                    </div>
                                                    <div class="td frame_price">
                                                        $ <span style="color:#000;font-weight: 600;"><?php echo $qty->temp_price?></span>
                                                    </div>
                                                </div>
                                                <div class="tr accessories_cart" <?php if($qty->accessories==0) echo 'style="display:none;"'?>>
                                                    <div class="td">
                                                        <img src="<?php echo base_url().'images/test.jpg';?>" width="100"/>
                                                    </div>
                                                    <div class="td">
                                                        <b>Accessories</b><br/>
                                                        <span class="qty_accessories">Qty: <span><?php echo $qty->accessories;?></span></span>
                                                    </div>
                                                    <div class="td qty_accessories_price">
                                                        $ <span style="color:#000;font-weight: 600;"><?php echo $qty->accessories_price?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="tr contact_lens" <?php if($qty->contact_lenses==0)echo 'style="display:none;"';?>>
                                                    <div class="td">
                                                        <img src="<?php echo base_url().'images/test.jpg';?>" width="100"/>
                                                    </div>
                                                    <div class="td">
                                                        <b>Contact Lenses</b><br/>
                                                        <span class="contact_lens_qty">Qty: <span><?php echo $qty->contact_lenses;?></span></span>
                                                    </div>
                                                    <div class="td contact_lens_price">
                                                        $ <span style="color:#000;font-weight: 600;"><?php echo ($qty->contact_lenses_price)?></span>
                                                    </div>
                                                </div>
                                                <div class="tr total">
                                                    <div class="td">

                                                    </div>
                                                    <div class="td" style="text-align: right;">
                                                        <b>Total</b>
                                                    </div>
                                                    <div class="td total_price">
                                                        $ <span style="color:#000;font-weight: 600;"><?php echo $qty->temp_price+$qty->accessories_price+$qty->contact_lenses_price?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="logo_content_menu">
                <div class="contents">
                    <div class="logo left">
                        <img src="<?php echo base_url().'images/logo.png'?>" alt="Opticstoreonline logo"/>
                    </div>
                    <div class="cat_menu right">
                        <ul class="cat_menu_ul">
                        <?php
                        foreach($categories->result() as $category):
                            if($category->fld_status!=0):
                        ?>
                            <li class="cat_menu_li">
                                <span class="link">
                                    <a href="<?php echo base_url().url_title(strtolower($category->fld_name)).'-'.$category->fld_id.'/9';?>">
                                        <h3><?php echo $category->fld_name?></h3>
                                    </a>
                                    <?php $has_child = has_child($category->fld_id);
                                        if($has_child==true):
                                    ?>
                                    <div class="menu_list"  style="opacity:0.5">
                                        <ul class="menu_list_ul">
                                            <li class="menu_list_li arrow">
                                                <img src="<?php echo base_url().'images/arrow_up.png'?>"/>
                                            </li>
                                            <?php
                                            foreach($sub_categories->result() as $sub_category):
                                                if($sub_category->fld_category_id==$category->fld_id && $sub_category->fld_status!=0):
                                            ?>
                                                <?php 
                                                    $sub_desc = substr(str_replace("'","&rsquo;",$sub_category->fld_description),0,200);
                                                    $sub_img = str_replace("'","&rsquo;",$sub_category->fld_name);
                                                ?>
                                                    <li class="menu_list_li">
                                                        <?php 
                                                            if($sub_category->fld_name!="" || $sub_category->fld_name != NULL){
                                                                $address = url_title(strtolower($category->fld_name)).'/'.url_title(strtolower($sub_category->fld_name));
                                                            }
                                                            else $address = url_title(strtolower(strtolower($category->fld_name)));
                                                            ?>
                                                        <a href="<?php echo base_url().$address.'-'.$sub_category->fld_id.'/9';?>" alt="<?php echo $sub_category->fld_name;?>" title="<?php echo $sub_category->fld_name;?>">
                                                        <div class="menu_list_img_div">
                                                            <span class="image">
                                                                <?php $front_view = get_random_cat_image($sub_category->fld_id);?>
                                                                <img src="<?php echo base_url().$sub_category->fld_location.$sub_category->fld_image;?>" style="width:100px;" class="menu_list_img"/>
                                                            </span>
                                                                <span class="desc">
                                                                    <?php echo $sub_category->fld_name; ?>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                        </ul>
                                    </div>
                                    <?php endif;?>
                                </span>
                            </li>
                        <?php
                            endif;
                        endforeach;
                        ?>
                            <li class="cat_menu_li">
                                <span class="link">
                                    <a href="<?php echo base_url().'accessories/9';?>">
                                        <h3>Accessories</h3>
                                    </a>
                                </span>
                            </li>
                            <li class="cat_menu_li">
                                <span class="link">
                                    <a href="<?php echo base_url().'contact_lens/9';?>">
                                        <h3>Contact Lens</h3>
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <script type="text/javascript"> 
            $("#usual_header ul").idTabs(); 
          </script>
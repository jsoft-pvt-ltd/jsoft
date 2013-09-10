<style>
div.label{padding-top: 6px;}
div.input{width: 500px;}
</style>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/carrier/index">View</a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/carrier/insert">Add</a></div>
        </div>
        <div class="clear"></div>
        <form id="frm_carrier" name="frm_carrier" method="post" action="<?php echo base_url().'admin/carrier/edit/'.$carrier->fld_id;?>">
            <div>Please fill the form</div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Country</div>
                <div class="input">
                    <select class="input" id="country" name="country" style="margin: 5px 0 0;width: 138px;"> 
                        <?php foreach($countries->result() as $country):?>
                            <option value="<?php echo $country->fld_id;?>"
                            <?php
                            if($country->fld_id==$carrier->fld_country)
                            {
                                echo 'selected="selected"';
                            }
                            ?>
                            ><?php echo $country->fld_name;?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Carrier</div>
                <div class="input"><input type="text" name="carrier" value="<?php if($carrier->fld_carrier!="")echo $carrier->fld_carrier;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Shipping Cost</div>
                <div class="input"><input type="text" name="shipping_cost" value="<?php if($carrier->fld_shipping_cost!="")echo $carrier->fld_shipping_cost;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Additional Cost</div>
                <div class="input"><input type="text" name="additional_cost" value="<?php if($carrier->fld_additional_cost!="")echo $carrier->fld_additional_cost;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Insurance Cost</div>
                <div class="input"><input type="text" name="insurance_cost" value="<?php if($carrier->fld_insurance_cost!="")echo $carrier->fld_insurance_cost;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Additional Insurance Cost</div>
                <div class="input"><input type="text" name="additional_insurance_cost" value="<?php if($carrier->fld_additional_insurance_cost!="")echo $carrier->fld_additional_insurance_cost;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">&nbsp;</div>
                <div class="input"><input type="submit" class="submit" value="Save"></div>
            </div>
            
            
            
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#frm_carrier').validate({
        rules:{

            country:{
                required:true   
            },
            carrier:{
                required:true   
            },
            shipping_cost:{
                required:true   
            }
//            additional_cost:{
//                required:true   
//            },
//            insurance_cost:{
//                required:true   
//            },
//            insurance_cost:{
//                required:true   
//            }
                      
        },
        messages:{

            country:{
                required:"Please enter country."   
            },
            carrier:{
                required:"Please enter carrier name."   
            },
            shipping_cost:{
                required:"Please enter shipping cost."   
            }
        }
//        errorPlacement:function(error,element)
//        {
//            if(element.attr("name") == "fld_username") {error.appendTo('#username');$('#username').css('display','block');}
//            if(element.attr("name") == "fld_password") {error.appendTo('#password');$('#password').css('display','block');}
//        }
    });
   
});    

</script>
<?php if(isset($carrier->fld_country)):?>
<script>
    var value = "<?php echo $carrier->fld_country;?>";
    $("#country option[value="+value+"]").prop("selected", true);
</script>  
<?php endif;?>
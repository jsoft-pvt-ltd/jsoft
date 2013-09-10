<style>
div.label{padding-top: 6px;}
div.input{width: 500px;}
</style>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/vendor/index">View</a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/vendor/insert">Add</a></div>
        </div>
        <div class="clear"></div>
        <form id="frm_vendor" name="frm_vendor" method="post" action="<?php echo base_url().'admin/vendor/edit/'.$vendor->fld_id;?>" >
            <div>Please fill the form</div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Vendor For</div>
                <div class="input">
                    <select class="input" id="vendorfor" name="vendorfor" style="margin: 5px 0 0;width: 138px;">
                        <option>Vendor For ?</option>
                        <?php foreach($product_types->result() as $product_type):?>
                        <option value="<?php echo $product_type->fld_id;?>" <?php if($product_type->fld_id==$vendor->fld_product_type):?><?php echo 'selected="selected"';?><?php endif;?>><?php echo $product_type->fld_name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Name</div>
                <div class="input"><input type="text" name="name" value="<?php if($vendor->fld_name!="")echo $vendor->fld_name;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Address</div>
                <div class="input"><input type="text" name="address" value="<?php if($vendor->fld_address!="")echo $vendor->fld_address;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Telephone No</div>
                <div class="input"><input type="text" name="telephone" value="<?php if($vendor->fld_telephone!="")echo $vendor->fld_telephone;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Mobile No</div>
                <div class="input"><input type="text" name="mobile" value="<?php if($vendor->fld_mobile!="")echo $vendor->fld_mobile;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Email</div>
                <div class="input"><input type="text" name="email" value="<?php if($vendor->fld_email!="")echo $vendor->fld_email;?>"></div>
            </div>
            <div class="clear"></div>
            <div class="label_input">
                <div class="label">Website</div>
                <div class="input"><input type="text" name="website" value="<?php if($vendor->fld_website!="")echo $vendor->fld_website;?>"></div>
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
    $('#frm_vendor').validate({
        rules:{

            vendorfor:{
                required:true   
            },
            name:{
                required:true   
            },
            address:{
                required:true   
            },
            telephone:{
                required:true   
            },
            email:{
                required:true   
            }
//            insurance_cost:{
//                required:true   
//            }
                      
        },
        messages:{

            vendorfor:{
                required:"Please select vendor."   
            },
            name:{
                required:"Please enter vendor name."   
            },
            address:{
                required:"Please enter address."   
            },
            telephone:{
                required:"Please enter telephone no."   
            },
            email:{
                required:"Please enter email."   
            }
        }
//       errorPlacement:function(error,element)
//       {
//           if(element.attr("name") == "fld_username") {error.appendTo('#username');$('#username').css('display','block');}
//           if(element.attr("name") == "fld_password") {error.appendTo('#password');$('#password').css('display','block');}
//       }
    });
   
});    

</script>
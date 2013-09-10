<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Product Type</div>
        </div>
        <form name="frm_product_type" id="frm_product_type" action="<?php echo base_url().'index.php/admin/product_type/insert_product_type/';?><?php if(isset($product_type->fld_id)) echo $product_type->fld_id;?>" method="post">
            <div class="clear"></div>
            &nbsp;Product Type&nbsp;&nbsp;&nbsp;
            <input type="text" id="name" name="name" class="input" maxlength="40" value="<?php if(isset($product_type->fld_name))echo $product_type->fld_name;?>"/>
            <input type="submit" id="submit" class="submit" value="<?php if(isset($product_type->fld_name))echo "Done";else echo "Submit";?>" name="submit"/>
            <div class="clear"></div>
        </form>
        <?php if($product_types->num_rows()!=0):?>
        <table width="100%">
            <tr style="font-weight: bold;">
                <td width="5%">S.N</td>
                <td width="20%">Product Type</td>
                <td width="75%">Operations</td>
            </tr>
            <?php
            $count=1;
            foreach($product_types->result() as $product_type):?>
                <tr id="row_<?php echo $product_type->fld_id;?>">
                    <td>
                        <?php echo $count;?>
                    </td>
                    <td id="name_<?php echo $product_type->fld_id;?>">
                        <?php echo $product_type->fld_name;?>
                    </td>
        <!--            <td><a href="javascript:void(0)" class="edit" id="<?php echo $product_type->fld_id;?>">Edit</a></td>-->
                    <td>
                        <a class="operation" href="<?php echo base_url().'admin/product_type/edit_product_type/'.$product_type->fld_id;?>" class="edit" id="<?php echo $product_type->fld_id;?>">Edit</a>
                        |
                        <a class="operation delete" href="javascript:void(0)" id="<?php echo $product_type->fld_id;?>" name="<?php echo base_url().'admin/product_type/delete_product_type/'.$product_type->fld_id;?>">Delete</a>
                        |
                        <a class="operation" href="<?php echo base_url().'admin/attributes/attributes/'.$product_type->fld_id;?>" class="add_attributes" id="add_attributes">Add attributes</a>
                    </td>
                </tr>
            <?php 
            $count++;
            endforeach;?>
        </table>
        <?php endif;?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#frm_product_type').validate({
        rules:{

            name:{
                required:true   
            }
                                
        },
        messages:{

            name:{
                required:"Please enter product type."   
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
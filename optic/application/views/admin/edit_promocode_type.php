<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation">Please insert the form below</div>
        </div>
        <form id="frm_product_type" name="frm_product_type" method="post" action="<?php echo base_url().'admin/promocode/edit_promocode_type/'.$promocode_type->fld_id;?>">
            <table width="100%">
                <tr>
                    <td>Promocode Type : </td>
                <tr>
                <tr>
                    <td><textarea name="promocode_type" rows="1" cols="95"><?php echo $promocode_type->fld_promocode_type;?></textarea></td>
                </tr>
                <tr><td><input type="submit" value="Submit"></td></tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#frm_product_type').validate({
        rules:{
            promocode_type:{
                required:true   
            }
        },
        messages:{
            promocode_type:{
                required:"Please enter promocode type."   
            }
        }
    });
   
});    
</script>
        
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation">Please insert the form below</div>
        </div>
        <?php if(isset($promocode)):?>
        <form id="frm_promocode" name="frm_promocode" method="post" action="<?php echo base_url().'admin/promocode/edit_promocode/'.$promocode_type->fld_id.'/'.$promocode->fld_id;?>">
        <?php else:?>
        <form id="frm_promocode" name="frm_promocode" method="post" action="<?php echo base_url().'admin/promocode/add_promocode/'.$promocode_type->fld_id;?>">
        <?php endif;?>    
            <table width="100%">
                <tr>
                    <td width="16%">Promocode Type </td>
                    <td width="84%">: <?php echo $promocode_type->fld_promocode_type;?></td>
                <tr>
                <tr>
                    <td>Promocode</td>
                    <td>: <input type="text" name="promocode" value="<?php if(isset($promocode))echo $promocode->fld_promocode;?>"></td>
                </tr>
                <tr>
                    <td>Category On Discount</td>
                    <td>: <select name="category">
                        <?php foreach ($categories->result() as $category):?>
                            <option value="<?php echo $category->fld_id;?>" <?php if(isset($promocode)){ if($promocode->fld_category==$category->fld_id){echo 'selected="selected"';}}?>><?php echo $category->fld_name;?></option>
                        <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#frm_promocode').validate({
        rules:{

            promocode:{
                required:true   
            }
        },
        messages:{

            promocode:{
                required:"Please enter promocode."   
            }
        }
    });
   
});    

</script>
        
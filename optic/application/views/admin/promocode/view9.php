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
                    <td style="vertical-align: top;" width="13%">Promocode Type </td>
                    <td width="87%">: <?php echo $promocode_type->fld_promocode_type;?></td>
                <tr>
                <tr>
                    <td>Promocode</td>
                    <td>: <input type="text" name="promocode" value="<?php if(isset($promocode)) echo $promocode->fld_promocode;?>"></td>
                </tr>
                <tr>
                    <td> % </td>
                    <td>: <input type="text" class="num_only" name="percentage" value="<?php if(isset($promocode)) echo $promocode->fld_percentage;?>" size="1"></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Category(s)</td>
                    <?php
                    if(isset($promocode))
                    {
                        $scategory = explode("-",$promocode->fld_category);
                    }
                    ?>
                    <td><?php foreach($categories->result() as $category):?>
                            <input type="checkbox" class="category" name="category[]" value="<?php echo $category->fld_id;?>" <?php if(isset($promocode)){ for($i=0;$i<sizeof($scategory);$i++){    if($scategory[$i]==$category->fld_id){  echo 'checked="checked"'; }}}?>>
                                <?php echo $category->fld_name;?><br/>
                         <?php endforeach;?>
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
        submitHandler: function(form) {
            if ($('.category:checked').length > 0){
                document.frm_promocode.submit();
            }else{
                alert('Please select at least one category.');
            }  
        },
        rules:{
            promocode:{
                required:true   
            },
            percentage:{
                required:true,
                number:true
            }
        },
        messages:{
            promocode:{
                required:"Please enter promocode."   
            },
            percentage:{
                required:"Please enter discount percentage."
            }
        }
    });
    $(".num_only").keydown(function(event){
        // Allow: backspace, delete, tab and escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
   
});    
</script>
        
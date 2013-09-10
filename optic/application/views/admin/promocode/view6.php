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
                    <td width="13%">Promocode Type </td>
                    <td width="87%">: <?php echo $promocode_type->fld_promocode_type;?></td>
                <tr>
                <tr>
                    <td>Promocode</td>
                    <td>: <input type="text" name="promocode" value="<?php if(isset($promocode)) echo $promocode->fld_promocode;?>"></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td> : <input type="text" name="start_date" id="start_date" value="<?php if(isset($promocode)) echo $promocode->fld_start_date;?>"></td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td> : <input type="text" name="end_date" id="end_date" value="<?php if(isset($promocode)) echo $promocode->fld_end_date;?>"></td>
                </tr>
                <tr>
                    <td> % </td>
                    <td> : <input type="text" name="percentage" value="<?php if(isset($promocode)) echo $promocode->fld_percentage;?>"  size="1"></td>
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
            },
            start_date:{
                required:true
            },
            end_date:{
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
            start_date:{
                required:"Please enter start date."
            },
            end_date:{
                required:"Please enter end date."
            },
            percentage:{
                required:"Please enter percentage.",
                number:"Please enter number."
            }
        }
    });
   
});    

</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/admin/jquery-ui.css';?>">
<script type="text/javascript" src="<?php echo base_url().'js/admin/jquery-ui.js"';?>"></script>
<script>
$(function(){
        $( "#start_date, #end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#start_date, #end_date" ).datepicker('option', {
                    beforeShow: customRange
        });

});
function customRange(input){
    if (input.id == 'end_date') {
          return {
            minDate: jQuery('#start_date').datepicker("getDate")
          };
    } else if (input.id == 'start_date') {
          return {
            maxDate: jQuery('#end_date').datepicker("getDate")
          };
    }
}
</script>
        
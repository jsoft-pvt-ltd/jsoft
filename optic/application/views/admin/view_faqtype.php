<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations" style="padding:5px;">
            <a class="operation" href="<?php echo base_url();?>admin/faq/faq">[ FAQ's ]</a>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <form id="frm_faqtype" name="frm_faqtype" method="post" action="<?php echo base_url();?>admin/faq/add_faqtype">
                <table width="100%">
                    <tr>
                        <td width="11%">FAQ's Section : </td>
                        <td width="79%"><input type="text" name="faqtype" size="50"></td>
                        <td width="10%"><input type="submit" value="Submit"></td> 
                    </tr>
                </table>
                    
            </form>
        </div>
                
        <table width="100%">
            <tr>
                <td width="5%"><b>Sn.</b></td>
                <td width="80%"><b>FAQ Section</b></td>
                <td width="15%"><b>Controllers</b></td>
            </tr>
            <?php foreach($faqtypes->result() as $faqtype):?>

            <tr id="iaf<? echo $faqtype->fld_id;?>">
                <td width="7%"><?php echo $faqtype->fld_id; ?></td>
                <td width="38%" id="<?php echo $faqtype->fld_id;?>">
                    <input type="text" class="input_section" id="section_<?php echo $faqtype->fld_id;?>" value="<?php echo $faqtype->fld_faqtype?>" size="50">
                </td>
                <td width="15%">
                    <a class="operation" href="javascript:void(0);" onclick="edit_faqtype(<?php echo $faqtype->fld_id;?>)">[ Edit ]</a>
                    <a class="operation" href="javascript:void(0);" onclick="delete_faqtype(<?php echo $faqtype->fld_id;?>)">[ Delete ]</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr style="text-align: center;">
                <td colspan="3"><?php echo $this->pagination->create_links();?></td>
            </tr>
        </table>
       
        
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#frm_faqtype').validate({
        rules:{

            faqtype:{
                required:true   
            }
        },
        messages:{

            faqtype:{
                required:"Please enter faq type."   
            }
        }
    });
   
});
var flag=0;
function edit_faqtype(id)
{
    var section = $('#section_'+id).val();
    section = section.replace(/^\s+/,"");//left trim
    section = section.replace(/\s+$/,"");//right trim
    if(flag==0)
    {
        flag=1;
        $('#'+id+' .input_section').css('border','1px solid #999');
        $('#'+id+' .input_section').css('padding','2px');
        
        var html = '<input type="button" id="btn" value="done" onclick="post('+id+');">';
        $('#'+id).append(html);
    }
           
}
function post(id)
{
    var editwala_faqtype = $('#section_'+id).val();
    $.ajax({
            type: "POST",
            url: base_url+'admin/faq/edit_faqtype/'+id,
            async: "FALSE",
            data: {
                    faqtype: editwala_faqtype
                    
                },
            success: function(edited){
                edited = edited.replace(/^\s+/,"");//left trim
                edited = edited.replace(/\s+$/,"");//right trim
                $('#section_'+id).val(edited);
                $('#'+id+' .input_section').css('border','none');
                $('#'+id+' .input_section').css('padding','0');
                $('#btn').remove();
                flag=0;
            }
         });
    
}
function delete_faqtype(id)
{
   $.ajax({
            type: "POST",
            url: base_url+'admin/faq/delete_faqtype/'+id,
            success: function(msg){
                    $('#'+id).parent().remove();
                
            }
         }); 
}
</script>
<style>
    .input_section{border:none;padding:0;}
</style>

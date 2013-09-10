<style>
.ast
{ color:#FF0000;
}
.error
{ 
  color:#FF0000;;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#frm").validate({
rules:{
question:{
	required : true
	
	},
ans:{
    required:true
}
},
messages : {
question:{
	required : "&nbsp; Enter Question."
	
},

ans:{
    required:"Provide some Description for your Question."
}
}
});
});

</script>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/faq/index">View FAQ's</a></div>
        </div>
        <form action="<?php echo base_url().'/admin/faq/insert';?>" method="post" name="frm" id="frm">
            <table>
                <tr>
                    <td>FAQ Section</td>
                    <td>
                        <select name="faqtype">
                            <?php foreach($faqtypes->result() as $faqtype):?>
                            <option value="<?php echo $faqtype->fld_id;?>"><?php echo $faqtype->fld_faqtype;?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Question : </td>
                    <td><textarea class="" name="question" id="meta" cols="55" rows="1"></textarea></td>
                </tr>
                <tr>
                    <td>Answer : </td>
                    <td><textarea class="" name="ans" id="keys" cols="55" rows="5"></textarea></td>
                </tr>
                <td>
                    <td><input type="submit" value="Submit"></td>
                    <td>&nbsp;</td>
                </td>
            </table> 
        </form>
    </div>
</div>
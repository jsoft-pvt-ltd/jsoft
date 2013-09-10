<style>
.ast
{ color:#FF0000;
}
.error
{ 
  color:#FF0000;;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
$("#frm").validate({
rules:{
title:{
	required : true
	
	},
url:{
    required:true
}
},
messages : {
title:{
	required : "&nbsp; Enter your Page Name."
	
},
url:{
    required:"Provide some Content for your Page."
}
}
});
});

</script>
<script type="text/javascript" src="<?php echo base_url();?>jscripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jscripts/jquery.validate.js"></script>


<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div>
            <form action="<?php echo base_url().'admin/dynamic/edit_link/'.$pages->fld_id; ?>" method="post" name="frm" id="frm" enctype="multipart/form-data">
                <div id="sub_" class="label" style="float:left; margin-bottom: 5px;">
                    Page Title:
                </div>
                <input type="text" name="title" id="title" class="input" value="<?php echo $pages->fld_page ?>"><br><br>
                <div id="sub_" class="label" style="float:left; margin-bottom: 5px;">
                    Page URL:
                </div>
                <input type="text" name="url" id="url" class="input" value="<?php echo $pages->fld_url ?>"><br>
                <div id="sub_" class="label" style="float:left; margin-bottom: 5px;"><br>
                    Alt Tag:
                </div><br>
                <input type="text" name="alt" id="alt" class="input" value="<?php echo $pages->fld_alt ?>"><br><br>
                <div id="sub_" class="label" style="float:left; margin-bottom: 5px;">
                    Target:
                </div>
                <select name="target" id="target">
                   <option value="blank">Blank</option>
                   <option>New</option>
               </select>
                
               <div style="margin-top:5px;"><input type="submit" class="submit" value="Submit"></div>
               
            </form>

        </div>
    </div>
</div>

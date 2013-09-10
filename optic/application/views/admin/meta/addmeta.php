<style>
.ast
{ color:#FF0000;
}
.error
{ 
  color:#FF0000;;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>jscripts/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#frm").validate({
rules:{
meta:{
	required : true
	
	},
title:{
	required : true
	
	},
keys:{
    required:true
}
},
messages : {
meta:{
	required : "&nbsp; Enter Meta field for your Page."
	
},
title:{
    required:"Please Insert title of the Page"
},
keys:{
    required:"Provide some Keywords for your Page."
}
}
});
});

</script>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <form action="<?php echo base_url().'/admin/meta/insert';?>" method="post" name="frm" id="frm" enctype="multipart/form-data">
            <div id="sub_" class="label" style="float:left; ">
                Title:</div><input type="text" name="title" id="title" /><br><br>
           <div id="sub_" class="label" style="float:left; "> Meta:</div><textarea class="" name="meta" id="meta" cols="55" rows="5"></textarea><br><br>
           <div id="sub_" class="label" style="float:left; "> Page:</div><select class="" name="page" id="page" >
                <?php foreach ($pages as $page)
                    {
                        echo '<option value="'.$page->fld_page.'">'.$page->fld_page.'</option>';
                } ?>
                 <?php foreach ($cats as $cat)
                    {
                        echo '<option value="'.$cat->fld_name.'">'.$cat->fld_name.'</option>';
                } ?>
                <?php foreach ($products as $prod)
                    {
                       echo '<option value="'.$prod->fld_name.'">'.$prod->fld_name.'</option>';
                } ?>
            </select><br><br>
            <div id="sub_" class="label" style="float:left; ">KeyWords:</div><textarea class="" name="keys" id="keys" cols="55" rows="5"></textarea><br><br>
            <div id="sub_" class="label" style="float:left; ">.</div><input type="submit" value="SUBMIT" name="btn1" id="btn1">
        </form>
    </div>
</div>
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
page:{
	required : true
	
	},
content:{
    required:true
}
},
messages : {
page:{
	required : "&nbsp; Enter your Page Name."
	
},
content:{
    required:"Provide some Content for your Page."
}
}
});
});

</script>
<script type="text/javascript" src="<?php echo base_url();?>jscripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jscripts/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">


tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        /*content_css : 'http://localhost/steamonline/css/example.css',*/

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});

</script>

<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div>
            <form action="<?php echo base_url().'admin/dynamic/update_eachpage/'.$pages->fld_id.'/'.$pages->fld_page; ?>" method="post" name="frm" id="frm" enctype="multipart/form-data">
               <div id="sub_" class="label" style="float:left; margin-bottom: 5px;"> Page Name:
               </div>
                <input type="text" name="page" id="page" value="<?php echo $pages->fld_page; ?>"><br>
                Page Content:<textarea name="content" id="content"><?php echo $pages->fld_content; ?></textarea>
                <div style="margin-top:5px;"><input type="submit" class="submit" value="Submit"></div>
            </form>
        </div>
    </div>
</div>
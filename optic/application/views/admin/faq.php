<?php 
$page =  strtolower($page);
    switch($page){
        case 'index':
            $page=0;break;
        case 'about':
            $page=1;break;
        case 'faq';
            $page=2;break;
    }
?>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">FAQ's</div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/faq/addFAQ">[ Add FAQ's ]</a>
        </div>
<table width="100%">
    <tr>
        <td width="5%"><b>Sn.</b></td>
        <td width="40%"><b>Question</b></td>
        <td width="40%"><b>Description</b></td>
        <td width="15%"><b>Controllers</b></td>
    </tr>
<?php $count=1; foreach($iafInfos as $iafInfo):?>
    
    <tr id="iaf<? echo $iafInfo->fld_id;?>">
        <td width="7%"><?php echo $count.'.'; $count++; ?></td>
        <td width="38%"><?php echo $iafInfo->fld_question?></td>
        <td width="40%"><?php echo $iafInfo->fld_description;?></td>   
        <td width="15%">
            <a class="operation" href="<?php echo base_url().'admin/faq/update/'.$iafInfo->fld_id;?>">[ Edit ]</a>
            <a class="operation" href="javascript:void(0);" onclick="DeleteThis(<? echo $iafInfo->fld_id;?>)">[ Delete ]</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
    </div>
</div>
<script>
function DeleteThis(id){
    var info = "";//'id=' + del_id;
    if(confirm("Sure you want to delete this update? There is NO undo!"))
    {
        $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>admin/faq/DeleteIAF/"+id,
        data: info,
        success: function(){alert("Successfully Deleted");
        }
        });
    $("#iaf"+id).slideUp(200);
    }
    return false;
}
</script>
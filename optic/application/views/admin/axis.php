<style>
    table{
/*        border-right:1px solid #ccc;
        border-bottom:1px solid #ccc;*/
    }
    table th,table td{
        text-align: left;
/*        border-left: 1px solid #ccc;
        border-top:1px solid #ccc;*/
        padding-left:51px;
    }
    table th{
        background:#ccc;
    }
</style>


<table style="width:100%;" cellspacing="0" cellpadding="0">
    <thead>
    <th>Lens Name</th>
    <th>Axis</th>
    <th>Operations</th>
    </thead>
<?php 
    foreach($axes->result() as $axis){
        ?>

    <tr id="row_<?php echo $axis->fld_id?>">
        <td><?php echo $lens_name->fld_name?></td>
        <td><label id="axis_value_<?php echo $axis->fld_id?>"><?php echo $axis->fld_value?></label>
            <form name="lens_axis" id="lens_axis_<?php echo $axis->fld_id?>" action="<?php echo base_url('admin/contact_lens/axis/'.$axis->fld_contact_lens_id.'/'.$axis->fld_id);?>" style="display: none;" method="post">
                <input type="text" name="axis" id="axis" value="<?php echo $axis->fld_value?>" />
                <input type="submit" name="submit" id="submit" value="submit"/>
            </form></td>
            <td>
                <a href="javascript:void(0);" id="<?php echo $axis->fld_id?>" onclick="show_form(this);">[ Edit ]</a> | <a href="javascript:void(0);" name="<?php echo base_url().'admin/contact_lens/delete_attr/'.$axis->fld_id;?>" class="delete" id="<?php echo $axis->fld_id?>">[ Delete ]</a>
            </td>
    </tr>
<?php        
    }
?>
</table>
<script type="text/javascript" src="<?php echo base_url().'js/jquery.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/admin/products.js'?>"></script>
<script type="text/javascript">
    function show_form(element)
    {
        $("#axis_value_"+element.id).hide();
        $("#lens_axis_"+element.id).css('display','block');
    }
    </script>
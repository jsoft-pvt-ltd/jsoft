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
    <th>Spherical</th>
    <th>Operations</th>
    </thead>
<?php 
    foreach($sph->result() as $sp){
        ?>

    <tr id="row_<?php echo $sp->fld_id?>">
        <td><?php echo $lens_name->fld_name?></td>
        <td>
            <label id="sph_value_<?php echo $sp->fld_id?>"><?php echo $sp->fld_value?></label>
            <form name="lens_sph" id="lens_sph_<?php echo $sp->fld_id?>" action="<?php echo base_url('admin/contact_lens/sph/'.$sp->fld_contact_lens_id.'/'.$sp->fld_id);?>" style="display: none;" method="post">
                <input type="text" name="sph" id="sph" value="<?php echo $sp->fld_value?>" />
                <input type="submit" name="submit" id="submit" value="submit"/>
            </form>
        </td>
        <td>
            <a href="javascript:void(0);" id="<?php echo $sp->fld_id?>" onclick="show_form(this);">[ Edit ]</a> | 
            <a href="javascript:void(0);" name="<?php echo base_url().'admin/contact_lens/delete_attr/'.$sp->fld_id;?>" class="delete" id="<?php echo $sp->fld_id?>">[ Delete ]</a>
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
        $("#sph_value_"+element.id).hide();
        $("#lens_sph_"+element.id).css('display','block');
    }
    </script>
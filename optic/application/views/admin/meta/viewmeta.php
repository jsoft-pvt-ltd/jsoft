
<div class="container">
    <?php echo $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Meta</div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/meta/add_meta">[ Add Meta ]</a>
        </div>
        
        <table width="100%">
            <tr style="font-weight: bold;">
                <td width="5%">S.N</td>
                <td width="10%">Page Name</td>
                <td width="25%">Keywords</td>
                <td width="35%">Meta Section</td>
                <td width="20%">Operations</td>
            </tr>
            <?php $count=1;?>
            <?php if(!empty($alldata)):?>
            <?php foreach($alldata as $data):?>
            <?php $meta=  str_replace(">", "&gt;", $data->fld_meta);
              $meta=  str_replace("<", "&lt;", $meta);
              $meta=  substr($meta,0,100);
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $data->fld_page;?></td>
                <td><?php echo $data->fld_keywords;?></td>
                <td><?php echo $meta;?></td>    
                <td>
                    <a class="operation" href="<?php echo base_url().'admin/meta/update_meta/'.$data->fld_id ?>">Edit </a>|
                    <a class="operation" href="<?php echo base_url().'admin/meta/delete_meta/'.$data->fld_id ?>">Delete</a>
                </td>    
            </tr>
            <?php $count++;?>
            <?php endforeach;?>
            <?php endif;?>
            <tr>
                <td><?php echo $pagination;?></td>
            </tr>
        </table>
    </div>
    
</div>

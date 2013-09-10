<!--<div>
    <?php foreach ($pages->result() as $page):?>
    <div>
       ID: <?php echo $page->fld_id; ?>
    </div>
    <div>
       Page Name: <?php echo $page->fld_page; ?>
    </div>
    <div>
       Page Content: <?php echo $page->fld_content; ?>
    </div>
        <?php endforeach; ?>
</div>-->
<div class="container">
    <?php echo $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Pages</div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/dynamic/add">[ Add Pages ]</a>
            <a class="operation" href="<?php echo base_url();?>admin/dynamic/addlink">[ Add Links ]</a>
        </div>
        
        <table width="100%">
            <tr style="font-weight: bold;">
                <td width="5%">S.N</td>
                <td width="20%">Page Name</td>
                <td width="45%">Page Content</td>
                <td width="30%">Operations</td>
            </tr>
            <?php $count=1;?>
            <?php if(!empty($pages)):?>
            <?php foreach($pages->result() as $page):?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $page->fld_page;?></td>
                    <td>
                        <?php if($page->fld_type=="1"): ?>
                        <?php echo substr($page->fld_content,0,100);  endif;?>
                        <?php if ($page->fld_type=="2"): ?>
                        <?php echo $page->fld_url; endif;?>
                        
                    </td>    
                    <td>
                        <?php if($page->fld_type=="1"): ?>
                        <a class="operation" href="<?php echo base_url().'admin/dynamic/update_page/'.$page->fld_id ?>">Edit </a>|
                        <a class="operation" href="<?php echo base_url().'admin/dynamic/delete_page/'.$page->fld_id; ?>">Delete</a>
                        <?php endif; if ($page->fld_type=="2"): ?>
                        <a class="operation" href="<?php echo base_url().'admin/dynamic/update_link/'.$page->fld_id ?>">Edit </a>|
                        <a class="operation" href="<?php echo base_url().'admin/dynamic/delete_link/'.$page->fld_id; ?>">Delete</a>
                        <?php endif; ?>
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

<?php // print_r($headers);print_r($footers);?>
<style>
    .my{
        margin: 0 auto;
        width: 1000px;
        margin-bottom:50px;
    }
    .my ul li {
        display: inline;
        margin-right: 10px;
        
    }
    a{
        color: #cf0000;
    }
    .my h1{
        color: #0A80E5;
    }
</style>
<div class="my">
    <h1>Header Menus</h1>
    <ul>
        <?php foreach ($headers as $header): 
            if($header->fld_type=='1'):?>
                <li><a href="<?php echo base_url().'admin/page_rank/each_page/'.$header->fld_id ?>"><?php echo $header->fld_page ?></a></li>
        <?php endif;
            if($header->fld_type=='2'): ?>
                <li><a href="<?php echo prep_url($header->fld_url); ?>"><?php echo $header->fld_page; ?></a></li>
        <?php endif; endforeach; ?>
    </ul>
</div>

<div class="my">
    <h1>Footer Menus</h1>
    <ul>
        <?php foreach ($footers as $footer): 
            if($footer->fld_type=='1'):?>
                <li><a href="<?php echo base_url().'admin/page_rank/each_page/'.$footer->fld_id;?>"><?php echo $footer->fld_page;?></a></li>
        <?php endif;
        if($footer->fld_type=='2'): ?>
            <li><a href="<?php echo prep_url($footer->fld_url); ?>"><?php echo $footer->fld_page;?></a></li>
        <?php endif; endforeach; ?>
    </ul>
</div>
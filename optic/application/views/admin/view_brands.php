<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/admin/contact_lens.css'?>"/>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">
                Fill the form below
            </div>
        </div>
        <div class="actions">
            <a href="<?php echo base_url().'admin/contact_lens/add_lenses'?>" class="operation">[ Add Contact Lens ]</a>
            <a href="<?php echo base_url().'admin/contact_lens'?>" class="operation">[ View Contact Lens ]</a>
            <a href="<?php echo base_url().'admin/contact_lens/add_brands'?>" class="operation">[ Add Brands ]</a>
        </div>
        <div class="brands_container">
            <div class="brands">
                <?php // if($brands->num_rows()>0):?>
                <div class="table">
                    <div class="tr headings">
                        <div class="td name">Name</div>
                        <div class="td image">Image</div>
                        <div class="td desc">Description</div>
                        <div class="td">Controllers</div>
                    </div>
                    <?php foreach($brands->result() as $brand):?>
                    <div class="tr" id="row_<?php echo $brand->fld_id;?>">
                        <div class="td name"><?php echo $brand->fld_name;?></div>
                        <div class="td image">
                            <img src="<?php echo base_url().$brand->fld_location.'/'.$brand->fld_image;?>"/>
                        </div>
                        <div class="td desc"><?php echo $brand->fld_description?></div>
                        <div class="td">
                            <a href="<?php echo base_url().'admin/contact_lens/add_brands/'.$brand->fld_id;?>" class="operation">[ Edit ]</a>
                            <a href="javascript:" class="operation delete" id="<?php echo $brand->fld_id;?>" name="<?php echo base_url().'admin/contact_lens/delete_brands/'.$brand->fld_id;?>">[ Delete ]</a>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
                <?php // else:?>
<!--                Sorry !!! No any brands available for now.<br/>
                Please -->
                <?php // endif;?>
            </div>
        </div>
    </div>
</div>
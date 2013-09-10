<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Lens Type</div>
        </div>
        <div style="padding: 5px;border: 1px solid #f0f0f0;">   
            <a href="javascript:void(0);" class="insert_lens operation" onclick="manager();">
                [ Add Lens Type ]
            </a>
            &nbsp;&nbsp;&nbsp;
            <a href="<?php echo base_url();?>admin/package_controller" class="insert_lens operation">
                [ Lens Package ]
            </a>
            &nbsp;&nbsp;&nbsp;
            <a href="<?php echo base_url();?>admin/upgrade_controller" class="insert_lens operation">
                [ Lens Upgrade ]
            </a>
        </div>
        <div class="clear"></div>
        <div>
            <?php foreach($lens_type->result() as $lens):?>
            <div id="row_<?php echo $lens->fld_id;?>">
                <div class="lens_type"><?php echo $lens->fld_name;?></div>
                <div class="edit_package right">
                    <a href="javascript:void(0);" id="edit_<?php echo $lens->fld_id;?>" class="operation" onclick="manager(id);populate_lens_type(id);">Edit</a> | 
                    <a href="javascript:void(0);" id="<?php echo $lens->fld_id;?>" class="operation delete" name="<?php echo base_url().'admin/lens_type/delete_lens_type/'.$lens->fld_id;?>">Delete</a>
                </div>
                <u class="margin_left">Lens Package:</u>
                <?php foreach($packages_id->result() as $package_id):?>
                    <?php if($package_id->fld_lens_type_id == $lens->fld_id):?>
                        <?php $this->load->helper('admin/package_helper');?>
                        <?php $package = get_package_name_by_id($package_id->fld_lens_package_id);?>
                        <div class="packages"><?php echo $package->fld_name;?></div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <?php endforeach;?>
            
        </div>
    </div>
</div>
<div class="overlay"></div>
<div class="popup" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_lens" id="frm_lens" action="<?php echo base_url().'admin/lens_type/insert_lens';?>" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Lens Type</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="parent" id="new_lens_0">
            <div class="label_input">
                <div class="label">Lens Type</div>
                <div class="input"><input type="text" id="name" name="name" maxlength="40" value=""/></div>
            </div>
        </div>   
        <div class="attributes_values" id="values_0" style="margin:10px;">
            Lens Packages<br/>
            <?php foreach($packages->result() as $package):?>
                <input type="checkbox" id="packages[]" name="packages[]" value="<?php echo $package->fld_id;?>"/>
                <?php echo $package->fld_temp_name;?><br/>
            <?php endforeach;?>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>


<div class="popup_edit" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_edit_lens" id="frm_edit_lens" action="" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Lens Type</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="parent" id="new_lens_0">
            <div class="label_input">
                <div class="label">Lens Type</div>
                <div class="input"><input type="text" id="edit_name" name="edit_name" maxlength="40" value=""/></div>
            </div>
        </div>   
        <div class="attributes_values" id="values_0" style="margin:10px;">
            Lens Packages<div class="right">Rank</div>
            <br/>
            <?php foreach($packages->result() as $package):?>
                <input type="checkbox" id="edit_packages[]" name="edit_packages[]" value="<?php echo $package->fld_id;?>" class="edit_packages"/>
                <?php echo $package->fld_temp_name;?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" value="" id="rank_<?php echo $package->fld_id;?>" size="1" class="right rank_box"/>
                <br/>
            <?php endforeach;?>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>


<style>
div.label{width: 100px;padding-top:3px;}
div.attribute_values{margin: 0;overflow: auto;}
div.popup_actions{text-align: left;}
div.sub_categories{margin:0;overflow: auto;}
div.input_textarea{width:400px;float: left;}
ul.lens_types{float: left;}
ul.lens_types li{padding: 3px;}
li.lens_type{width: 189px;padding: 3px;border:1px solid #f0f0f0;font-weight: bold;}
</style>  
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Lens Upgrades</div>
        </div>
        <div style="padding: 5px;border: 1px solid #f0f0f0;">   
            <a href="javascript:void(0);" class="insert_upgrade operation" onclick="manager();">
                [ Add Lens Upgrade ]
                <!--[Add Package Values]-->
            </a>
        </div>
        <div class="clear"></div>
        <div>
            <?php foreach($upgrades->result() as $upgrade):?>
            <div id="row_<?php echo $upgrade->fld_id;?>">
                <div class="label_input">
                    <div class="label" id="upgrade_name_<?php echo $upgrade->fld_id;?>"><?php echo $upgrade->fld_name;?></div>
                    <div class="label left" id="upgrade_price_<?php echo $upgrade->fld_id;?>"><?php echo $upgrade->fld_price;?></div>
                    <div class="label"><a class="operation" href="javascript:void(0);" onclick="add_upgrade_attribute(this);" id="<?php echo $upgrade->fld_id;?>" name="<?php echo $upgrade->fld_name;?>">[Add Attributes]</a></div>
                    <div class="label">
                        <a href="javascript:void(0);" onclick="manager(id);populate_upgrades(id);" id="edit_<?php echo $upgrade->fld_id;?>">Edit</a> | 
                        <a href="javascript:void(0);" class="delete" id="<?php echo $upgrade->fld_id;?>" name="<?php echo base_url().'admin/upgrade_controller/delete_upgrades/'.$upgrade->fld_id;?>">Delete</a>
                    </div>
                </div>
                <?php foreach($upgrades_attrs->result() as $attributes):?>
                <div id="row_<?php echo $upgrade->fld_id.'_'.$attributes->fld_id;?>">
                    <?php if($attributes->fld_upgrade_id == $upgrade->fld_id):?>
                        <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$attributes->fld_name;?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;
                                <a href="javascript:void(0);" onclick="popup_edit_attr();populate_upg_attr(id);" id="attr_<?php echo $attributes->fld_id;?>" class="link">Edit</a> | 
                                <a href="javascript:void(0);" class="delete link" id="<?php echo $upgrade->fld_id.'_'.$attributes->fld_id;?>" name="<?php echo base_url().'admin/upgrade_controller/delete_upg_attr/'.$attributes->fld_id;?>">Delete</a>
                        <br/>
                        <?php foreach($upgrades_attr_values->result() as $attributes_values):?>
                            <?php if($attributes_values->fld_upgrade_attribute_id == $attributes->fld_id):?>
                                <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$attributes_values->fld_name;?><br/>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
                <?php endforeach;?>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>

<div class="overlay"></div>
<div class="popup" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_lens_upgrade" id="frm_lens_upgrade" action="<?php echo base_url().'admin/upgrade_controller/insert_upgrade';?>" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Lens Upgrade</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">                
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="parent" id="new_upgrade_0">
        Upgrade: <input type="text" id="name[]" name="name[]" maxlength="40" value=""/>
        Price: <input type="text" id="price[]" name="price[]" maxlength="10" value=""/>
        <a href="javascript:void(0);" onclick="add_upgrade();">[+]</a>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>


<div class="popup_edit" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_edit_lens_upgrade" id="frm_edit_lens_upgrade" action="" method="post" enctype="multipart/form-data">
        <div class="form_edit_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Lens Upgrade</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">                
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="parent" id="new_upgrade_0">
        Upgrade: <input type="text" id="edit_upg_name" name="edit_upg_name" maxlength="40" value=""/>
        Price: <input type="text" id="edit_upg_price" name="edit_upg_price" maxlength="10" value=""/>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>



<div class="popup_attributes" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_lens_upgrade_attr" id="frm_lens_upgrade_attr" action="<?php echo base_url().'admin/upgrade_controller/insert_upgrade_attr';?>" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
<!--            <div style="float:left;">&nbsp;&nbsp;Lens Upgrade</div>-->
            <div style="float:left"><input type="text" maxlength="40" value="" readonly="readonly" id="title" style="border:none;background:none;"/></div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">                
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        
        <div class="parent" id="new_upgrade_0">
            <div class="label_input">
                <div class="label">Attribute</div>
                <div class="input"><input type="text" id="name" name="name" maxlength="40" value=""/></div>
            </div>    
            <input type="hidden" id="upgrade_id" name="upgrade_id" value=""/>
        </div>
        <div id="values_0" style="margin:10px;">
            <div class="label_input">
                <div class="label">Attribute Value</div>
                <div class="input"><input type="text" id="value[]" name="value[]" maxlength="40" value=""/></div>
                <div class="label">Attribute Extra</div>
                <div class="input"><input type="text" id="extra[]" name="extra[]" maxlength="40" value=""/></div>
                <div class="sumation"><a href="javascript:void(0);" onclick="add_upgrade_attr_value();">[+]</a></div>
            </div>

        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>


<div class="popup_attributes_edit" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_edit_lens_upgrade_attr" id="frm_edit_lens_upgrade_attr" action="" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left"><input type="text" maxlength="40" value="" readonly="readonly" id="title" style="border:none;background:none;"/></div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">                
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        
        <div class="parent" id="new_upgrade_0">
            <div class="label_input">
                <div class="label">Attribute</div>
                <div class="input"><input type="text" id="edit_attr_name" name="edit_attr_name" maxlength="40" value=""/></div>
            </div>    
            <!--<input type="hidden" id="edit_attr_upgrade_id" name="edit_attr_upgrade_id" value=""/>-->
        </div>
        <div id="edit_values_0" style="margin:10px;">
            <div class="label_input edit_attribute_values">
                <div class="label">Attribute Value</div>
                <div class="input"><input type="text" id="value[]" name="value[]" maxlength="40" value=""/></div>
                <div class="label">Attribute Extra</div>
                <div class="input"><input type="text" id="extra[]" name="extra[]" maxlength="40" value=""/></div>
                <div class="sumation"><a href="javascript:void(0);" onclick="add_edit_upgrade_attr_value();">[+]</a></div>
            </div>

        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>

<style>
    div.label{width: 100px;padding-top:3px;}
    div.label a, a.link{color:#0a80e5;}
    /*
    div.attribute_values{margin: 0;overflow: auto;}*/
    div.popup_actions{text-align: left;}
    .popup_attributes_edit {
        position: absolute;
        z-index: 1111;
    }
</style>
<style>   
.description > textarea {
    height: 155px;
    width: 250px;
}
</style>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Packages</div>
        </div>
        <div style="padding: 5px;border: 1px solid #f0f0f0;">

            <a href="javascript:void(0);" class="insert_package operation" onclick="manager();">
                [ Add Lens Package]
                <!--[Add Package Values]-->
            </a>
        </div>

        <div class="clear"></div>
        <div>
            <?php $i;$temp='';
            foreach($packages->result() as $package):
                $temp1 = substr(strstr($package->fld_temp_name," "), 1);
                if($temp!=$temp1)
                    echo '<div class="package_title">'.$temp1.'</div>';
                $temp=$temp1;
            ?>
            
            <div id="row_<?php echo $package->fld_id;?>">
                <div class="package_temp_name left"><?php echo $package->fld_temp_name;?></div>
                <div class="package_price left"><?php echo '$ '.$package->fld_price;?></div>
                <div class="edit_package right">
                    <a href="javascript:void(0)" id="toggle_<?php echo $package->fld_id;?>" class="operation toggle_view">View</a> | 
                    <a href="javascript:void(0);" id="edit_<?php echo $package->fld_id;?>" class="operation" onclick="manager(id);populate_package(id);">Edit</a> | 
                    <a href="javascript:void(0);" id="<?php echo $package->fld_id;?>" class="operation delete" name="<?php echo base_url().'admin/package_controller/delete_package/'.$package->fld_id;?>">Delete</a>
                </div>
                <div class="package_info" id="package_info_<?php echo $package->fld_id;?>">
                    <input type="hidden" id="package_cyl_range" value="<?php echo $package->fld_cyl_range;?>"/>
                    <input type="hidden" id="package_display_name" value="<?php echo $package->fld_name;?>"/>
                    <br/>
                    <div class="left"> Min : </div>
                    <div class="package_min left"><?php echo $package->fld_min;?></div>
                    <br/>
                    <div class="left"> Max : </div>
                    <div class="package_max left"><?php echo $package->fld_max;?></div>

                    <br/>
                    <div class="left"> Package Attributes : </div><br/>
                    <?php foreach($attributes_id->result() as $attribute_id):?>
                        <?php if($attribute_id->fld_package_id == $package->fld_id):?>
                            <?php $this->load->helper('admin/package_helper');?>
                            <?php $attribute_value = get_package_attribute_by_id($attribute_id->fld_lens_package_attribute_id);?>
                            <div class="package_attributes" id="package_attribute_<?php echo $attribute_value->fld_id;?>"><?php echo $attribute_value->fld_name;?></div>
                        <?php endif;?>
                    <?php endforeach;?>
                    <br/>
                    <div class="left"> Package Upgrades : </div><br/>
                    <?php foreach($upgrade_ids as $upgrade_id):?>
                        <?php if($upgrade_id->fld_package_id == $package->fld_id):?>
                            <?php  $this->load->helper('admin/package_helper');?>
                            <?php $attribute_value = get_upgrade_by_id($upgrade_id->fld_lens_upgrade_id);?>
                            <div class="package_up" id="package_up_<?php echo $attribute_value->fld_id;?>"><?php echo $attribute_value->fld_name;?></div>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div><br/>
            <?php endforeach;?>
        </div>
    </div>
</div>
<div class="overlay"></div>
<div class="popup" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_package" id="frm_lens_package" action="<?php echo base_url().'admin/package_controller/insert_package';?>" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Lens Package</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">                
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="parent" id="new_package">
            Package Name 
                &nbsp; : <input type="text" id="temp_name" name="temp_name" maxlength="40" value=""/>
            <div class="clear"></div>
            Display Name : <input type="text" id="name" name="name" maxlength="40" value=""/>
            <div class="clear"></div>
            Package Price 
                &nbsp;&nbsp;&nbsp; : <input type="text" id="price" name="price" maxlength="10" value=""/>
            <div class="clear"></div>
            Range Minimum
                : <input type="text" id="min" name="min" maxlength="10" size="3" value=""/>
            <div class="clear"></div>
            Range Maximum 
                : <input type="text" id="max" name="max" maxlength="10" size="3" value=""/>
            <div class="clear"></div>
            CYL Range: &#177; <input type="text" name="cyl_range" id="cyl_range" size="3" value=""/>
            <div class="clear"></div>
            <div class="attributes_values" id="values_0">
                Package Attributes:<br/>
                <table cellpadding="0" cellspacing="0">
                <?php foreach($attributes->result() as $attribute):?>
                    <tr>
                        <td><input type="checkbox" id="value[]" name="value[]" value="<?php echo $attribute->fld_id;?>"/></td>
                        <td><?php echo $attribute->fld_name;?></td>
                        <td>                        
                        <select class="right" name="in_visibility[]" id="in_select_<?php echo $attribute->fld_id;?>">
                            <option value="<?php echo $attribute->fld_id;?>_1">Show</option>
                            <option value="<?php echo $attribute->fld_id;?>_0">Hide</option>
                        </select>
                        </td>
                    </tr>
                <?php endforeach;?>
                </table>
            </div>
            <div class="clear"></div>
            <div class="attributes_values" id="values_1">
                Package Upgrades:<br/>
                <?php foreach($package_upgrades as $package_upgrade):?>
                    <input type="checkbox" id="upgrades[]" name="upgrades[]" value="<?php echo $package_upgrade->fld_id;?>"/>
                    <?php echo $package_upgrade->fld_name;?>
                    <br/>
                <?php endforeach;?>
            </div>
            <div class="description">
                Description:<br/>
                <textarea id="description" name="description"></textarea>
            </div>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>




<div class="popup_edit" style="background: none repeat scroll 0 0 #F5F5F5;border: 1px solid #FFFFFF;box-shadow: 0 0 10px -4px #E0E0E0;">
    <form name="frm_edit_package" id="frm_edit_package" action="" method="post" enctype="multipart/form-data">
        <div class="form_title" style="border-bottom: 1px solid #FFFFFF;box-shadow: 0 0 4px -3px #333333;padding: 5px;overflow: auto;">
            <div style="float:left;">&nbsp;&nbsp;Lens Package</div>
            <div style="float:right">
                <a href="javascript:void(0);" onclick="clear_popup('new_attribute');">                
                    <img src="<?php echo base_url();?>images/cancel.png" style="vertical-align: middle;right: 0;">
                </a>
            </div>
        </div>
        <div class="parent" id="new_package">
            Package Name
                &nbsp; : <input type="text" id="edit_temp_name" name="edit_temp_name" maxlength="40" value=""/>
            <div class="clear"></div>
            Display Name : <input type="text" id="edit_name" name="edit_name" maxlength="40" value=""/>
            <div class="clear"></div>
            Package Price 
                &nbsp;&nbsp;&nbsp; : <input type="text" id="edit_price" name="edit_price" maxlength="10" value=""/>
            <div class="clear"></div>
            Range Minimum
                : <input type="text" id="edit_min" name="edit_min" maxlength="10" size="3" value=""/>
            <div class="clear"></div>
            Range Maximum 
                : <input type="text" id="edit_max" name="edit_max" maxlength="10" size="3" value=""/>
            <div class="clear"></div>
            CYL Range: &#177; <input type="text" name="edit_cyl_range" id="edit_cyl_range" size="3" value=""/>
            <div class="clear"></div>
            
            <div class="attributes_values" id="values_0">
                Package Attributes:<br/>
                <table cellpadding="0" cellspacing="0">
                <?php foreach($attributes->result() as $attribute):?>
                    <tr>
                        <td><input type="checkbox" id="package_attr_<?php echo $attribute->fld_id;?>" name="edit_package_attr[]" value="<?php echo $attribute->fld_id;?>" class="edit_package_attr"/></td>
                        <td>&nbsp;<?php echo $attribute->fld_name;?></td>
                        <td>&nbsp;
                            <div id="display_<?php echo $attribute->fld_id;?>" class="left display" name="display" style="display:none;">
                            <select class="right" name="" id="select_<?php echo $attribute->fld_id;?>">
                                <option value="<?php echo $attribute->fld_id;?>_1">Show</option>
                                <option value="<?php echo $attribute->fld_id;?>_0">Hide</option>
                            </select>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;?>
                </table>
            </div>
            <div class="clear"></div>
            <div class="attributes_values" id="values_1">
                Package Upgrades:<br/>
                <?php foreach($package_upgrades as $package_upgrade):?>
                    <input type="checkbox" id="edit_upgrades[]" name="edit_upgrades[]" value="<?php echo $package_upgrade->fld_id;?>"/>
                    <?php echo $package_upgrade->fld_name;?><br/>
                <?php endforeach;?>
            </div>
            <div class="description">
                Description:<br/>
                <textarea id="edit_description" name="edit_description"></textarea>
            </div>
        </div>
        <div class="popup_actions">
            &nbsp;&nbsp;<input type="submit" value="Done" name="submit"/>
        </div>
        <div class="clear"></div>
    </form>
</div>

<style>
    div.popup_actions{text-align: left;}
</style>  
<form name="frm_attribute_values" id="frm_attribute_values" action="<?php echo base_url().'admin/attribute_values/insert_attribute_values/';?><?php if(isset($attribute_value->fld_id)) echo $attribute_value->fld_id;?>" method="post">
    Attribute: <select id="attribute" name="attribute">
        <option></option>
        <?php foreach($attributes->result() as $attribute):?>
        <option value="<?php echo $attribute->fld_id;?>" <?php
            if(isset($attribute_value->fld_value) && ($attribute_value->fld_attribute_id)==$attribute->fld_id)echo "selected='selected'";
        ?>><?php echo $attribute->fld_name;?></option>
        <?php endforeach;?>
    </select>
    <br/>
    Attribute Value: <input type="text" id="value" name="value" maxlength="100" value="<?php if(isset($attribute_value->fld_value))echo $attribute_value->fld_value;?>"/><br/>
    Price: <input type="text" id="price" name="price" maxlength="10" value="<?php if(isset($attribute_value->fld_price))echo $attribute_value->fld_price;?>"/><br/>
    <?php if($attribute_values->num_rows()!=0):?>
        Is Child of: <select name="parent_id" id="parent_id">
            <option value="0">None</option>
            <?php foreach($attribute_values->result() as $attribute_value1):?>
            <option value="<?php echo $attribute_value1->fld_id;?>" <?php
                if(isset($attribute_value->fld_value) && ($attribute_value->fld_parent_id)==$attribute_value1->fld_id)echo "selected='selected'";
            ?>><?php echo $attribute_value1->fld_value;?></option>
            <?php endforeach;?>
        </select>
        <br/>
        <?php endif;?>
    <input type="submit" id="submit" value="<?php if(isset($attribute_value->fld_value))echo "Done";else echo "Submit";?>" name="submit"/>
</form>
<?php if($attribute_values->num_rows()!=0):?>
<table>
    <tr>
        <td>
            S.N
        </td>
        <td>
            Attribute Values
        </td>
        <td>
            Price
        </td>
        <td colspan="2">Controller</td>
    </tr>
    <?php
    $count=1;
    foreach($attribute_values->result() as $attribute_value):?>
        <tr id="row_<?php echo $attribute_value->fld_id;?>">
            <td>
                <?php echo $count;?>
            </td>
            <td id="name_<?php echo $attribute_value->fld_id;?>">
                <?php echo $attribute_value->fld_value;?>
            </td>
<!--            <td><a href="javascript:void(0)" class="edit" id="<?php echo $attribute_value->fld_id;?>">Edit</a></td>-->
            <td>
                <?php echo $attribute_value->fld_price;?>
            </td>
            <td><a href="<?php echo base_url().'admin/attribute_values/edit_attribute_value/'.$attribute_value->fld_id;?>" class="edit" id="<?php echo $attribute_value->fld_id;?>" title="Edit">Edit</a></td>
            <td><a href="javascript:void(0)" class="delete" id="<?php echo $attribute_value->fld_id;?>" title="Delete" name="<?php echo base_url().'admin/attribute_values/delete_attribute_value/'.$attribute_value->fld_id;?>">Delete</a></td>
        </tr>
    <?php 
    $count++;
    endforeach;?>
</table>
<?php endif;?>

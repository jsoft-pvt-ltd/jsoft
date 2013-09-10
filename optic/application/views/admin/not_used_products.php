<form name="frm_products" id="frm_products" method="post" action="<?php echo base_url().'admin/products'?>">
    Frame Name: <input type="text" value="" id="frame_name" name="frame_name"/><br/>
    Item No.: <input type="text" value="" id="item_no" name="item_no"/><br/>
    Size.:<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S1<input type="text" value="" id="s1" name="s1"/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S2<input type="text" value="" id="s2" name="s2"/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S3<input type="text" value="" id="s3" name="s3"/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S4<input type="text" value="" id="s4" name="s4"/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S5<input type="text" value="" id="s5" name="s5"/>
    Description: <textarea id="frame_desc" name="frame_desc"></textarea><br/>
    Product Type: <select id="product_type" name="product_type">
        <option></option>
        <?php foreach($product_types->result() as $product_type):?>
        <option value="<?php echo $product_type->fld_id;?>" <?php
            if(isset($attribute->fld_name)&& ($attribute->fld_product_type_id)==$product_type->fld_id)echo "selected='selected'";
        ?>><?php echo $product_type->fld_name;?></option>
        <?php endforeach;?>
    </select>
    <br/>
    Compatibility: <select id="compatibility" name="compatibility">
        <option value="Single Vision">Single Vision</option>
        <option value="Bifocal">Bifocal</option>
        <option value="Progressive">Progressive</option>
        <option value="Trifocal">Trifocal</option>
    </select>
</form>
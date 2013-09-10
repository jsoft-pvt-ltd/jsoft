
<script type="text/javascript" src="<?php echo base_url().'js/jquery.js'?>"></script>
    <?php 
//    echo '<pre>';
//    print_r($accessories);
//    echo '</pre>';
    ?>
<div>
    <?php foreach($accessories as $accessory):
        ?>
    <div>
        <img src="<?php echo base_url($accessory['fld_location'].'/thumbs/'.$accessory['fld_image']);?>" id="image_<? echo $accessory['fld_id'];?>"/>
        <form name="attribute" class="attribute" method="post" action="<?php echo base_url().'site/accessories/cart'?>">
        <div>color</div>
        <select name="color" onchange="set_qty(this)" class="select_color">
            <?php foreach($accessory['attr'] as $key=>$attr):
            ?>
            <option value="<?php echo $key;?>" id="<?php echo $accessory['fld_id'].','.$attr['fld_qty'];?>" title="<?php echo base_url($attr['fld_location'].'/thumbs/'.$attr['fld_image']);?>"><?php echo $key;?></option>
        <?php 
        endforeach;
?></select>
        price:<?php echo $accessory['fld_sp'];?>
        <div id="qty" class="qty_holder">
            <select name="qty" id="select_qty_<? echo $accessory['fld_id'];?>" class="select_qty">
                
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $accessory['fld_id'];?>" id="id"/>
        <input type="hidden" name="price" value="<?php echo $accessory['fld_sp'];?>" id="price"/>
        <input type="hidden" name="item_code" value="<?php echo $accessory['fld_item_code'];?>" id="item_code"/>
        <input type="submit" name="submit" value="Add to Cart"/>
        </form>
    </div>
    
    <?php
    endforeach;
?>
    <? echo $this->pagination->create_links();?>
</div>
<script>
    function set_qty(element)
    {
        
       $("#select_qty_"+id).parent('div').show();
        var temp = element[element.selectedIndex].id;
        temp = temp.split(',');
        var qty = temp[1];
        var id = temp[0];
        var img_loc = element[element.selectedIndex].title;
        var html = '';
        for(i = 1; i<=qty; i++){
            html+= '<option value="'+i+'">'+i+'</option>';
        }
        $("#select_qty_"+id).html(html);
        $("#image_"+id).prop('src',img_loc);
    }
    $(function(){
        $(".select_color").each(function(){
            var temp = this[this.selectedIndex].id;
            temp = temp.split(',');
            var qty = temp[1];
            var id = temp[0];
            var html ='';
            for(i = 1; i<=qty; i++){
                 html+= '<option value="'+i+'">'+i+'</option>';
             }
             $("#select_qty_"+id).html(html);
        })
        
    $(".attribute").submit(function(){
        console.log(this);
            var id = $(this).find('input#id').val();
            var price = $(this).find('input#price').val();
            var item_code = $(this).find('input#item_code').val();
            var color = $(this).find('select.select_color').val();
            var qty = $(this).find('div select.select_qty').val();
            var data = new Array();
            data['id']=id;
            data['price']=price;
            data['item_code']=item_code;
            data['color']=color;
            data['qty']=qty;
            parent.add_accessory_to_cart(data);
        })
    });
    
    </script>
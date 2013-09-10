function manager(id){//product id & paren id
    if(id==0 || id==null){
        edit_div_show(".popup");
    }
    else{
        edit_div_show(".popup_edit")
    }
}

function popup_edit_attr(){
    edit_div_show(".popup_attributes_edit");
}
function populate_upg_attr(id){
    var temp = id.split('_');
    var org_id =  temp[1];
    var url=base_url+'admin/upgrade_controller/upgrade_attr_info/'+org_id;
    var html='';
    $("#frm_edit_lens_upgrade_attr").attr('action',base_url+"admin/upgrade_controller/edit_upgrade_attr/"+org_id);
    $.getJSON(url, {ajax:1}, function(data){
        $("#edit_attr_name").val(data['attr']['fld_name']);
        $.each(data['values'], function(index, array) {
            html = html + '<div class="label">Attribute Value</div>'+
                '<div class="input"><input type="text" id="value[]" name="value[]" maxlength="40" value="'+array['fld_name']+'"/></div>'+
                '<div class="label">Attribute Extra</div>'+
                '<div class="input"><input type="text" id="extra[]" name="extra[]" maxlength="40" value="'+array['fld_extra']+'"/></div>'+
                '<div class="sumation"><a href="javascript:void(0);" onclick="add_edit_upgrade_attr_value();">[+]</a></div><br/>'
        });
        $(".edit_attribute_values").html(html);
    });
}

function populate_package(id){
    var temp = id.split('_');
    var org_id =  temp[1];
    var package_temp_name;
    var package_price;
    var package_min;
    var package_max;
    var package_display;
    var package_cyl_range;
    var package_description;
    var package_attrs = new Array();
    $.ajax({
        url:base_url+'admin/package_controller/get_package_infos/'+org_id,
        type:'POST',
        dataType:'json',
        async:false,
        success:function(data){
            package_temp_name   = data.fld_temp_name;
            package_price       = data.fld_price;
            package_min         = data.fld_min;
            package_max         = data.fld_max;
            package_display     = data.fld_name;
            package_cyl_range   = data.fld_cyl_range;
            package_description = data.fld_description;
        }
    });
    $.ajax({
        url:base_url+'admin/package_controller/get_package_attrs/'+org_id,
        type:'POST',
        dataType:'json',
        async:false,
        success:function(attrs){
            $.each(attrs, function(key, val) {
                var temp = document.getElementById('select_'+val.fld_lens_package_attribute_id);
                for(i=0;i<temp.length;i++){
                    var value = val.fld_lens_package_attribute_id+"_"+val.fld_display;
                    if($(temp.options[i]).val()==value){
                        (temp.options[i]).selected = true;
                    }
                }
                $("#display_"+val.fld_package_id+" > select")
            });
        }
    });
    
    var parent_id       =   $("#"+id).parent().parent().attr('id');
    $(".display").css('display','none');
    $("#"+parent_id+" .package_attributes").each(function(){
        temp            =   (this.id).split('_');
        check_checkbox('edit_package_attr[]', temp[2]);
    })
    $("#"+parent_id+" .package_up").each(function(){
        temp            =   (this.id).split('_');
        check_checkbox('edit_upgrades[]', temp[2]);
    })
    $("#edit_name").val(package_display);
    $("#edit_temp_name").val(package_temp_name);
    $("#edit_cyl_range").val(package_cyl_range);
    $("#edit_price").val(package_price);
    $("#edit_min").val(package_min);
    $("#edit_max").val(package_max);
    $('#edit_description').html(package_description);
    $("#frm_edit_package").attr('action',base_url+"admin/package_controller/edit_package/"+org_id);
    return false;   
}

function populate_lens_type(id){
    var temp = id.split('_');
    var org_id =  temp[1];
    var url = base_url+"admin/lens_type/lens_type_info/"+org_id;
//    var parent_id = $("#"+id).parent().parent().attr('id');
    $.getJSON(url, {ajax:1}, function(data){
        $("#edit_name").val(data['lens_type']['fld_name']);
        $("#frm_edit_lens").attr('action',base_url+'admin/lens_type/edit_lens_type/'+org_id);
        $.each(data['upgrades'], function(index, array) {
            check_checkbox('edit_upgrades[]', array['fld_id']);
        });
        $.each(data['packages'], function(index, array) {
            check_checkbox('edit_packages[]', array['fld_id']);
        });
        set_rank_for_checked_packages();
    });
}

function populate_upgrades(id){
    var temp = id.split('_');
    var org_id =  temp[1];
    $("#frm_edit_lens_upgrade").attr('action',base_url+'admin/upgrade_controller/edit_upgrades/'+org_id);
    $("#edit_upg_name").val(($("#upgrade_name_"+org_id).html()));
    $("#edit_upg_price").val(($("#upgrade_price_"+org_id).html()));
}

var count=1;
function add_parent(){
    var html='<div class="parent" id="new_lens_'+count+'">'+
        'Lens Type: <input type="text" id="name[]" name="name[]" maxlength="40" value=""/>'+
    '</div>';
    $(html).insertAfter('#new_lens_'+(count-1));
    count++;
}

function check_checkbox(name, val){  //this is used to check a checkbox whose values is same as provided value
    var checkbox = document.getElementsByName(name);
    var display = document.getElementsByName('display');
    var value;
    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i].type === 'checkbox') {
            value = checkbox[i].value;
            if(value== val){
                checkbox[i].checked = true;
                if(name=='edit_package_attr[]'){
                    $("#"+display[i].id).css('display','block');
                    $("#"+display[i].id+" > select").prop('name','visibility[]');
                }
            }
        }
    }
}
$(function(){
    var rank = 1;
    $(".toggle_view").click(function(){
        if(($(this).html()).toLowerCase()=='view'){
            $(this).html('Hide');
        }else{
            $(this).html("View");
        }
        var temp = (this.id).split("_");
        id = temp[1];
        $("#package_info_"+id).toggle(200);
    });
    
    $(".edit_packages").click(function(){
        var temp  = $(this).next().val();
        if((this).checked==true){
            $(this).next().css('display','inline-block');
        }
        else{
           $(this).next().css('display','none');
        }
    })
    
})
function set_rank_for_checked_packages(){
    var lens_packages_chkbx = document.getElementsByName('edit_packages[]');
    for (var i = 0; i < lens_packages_chkbx.length; i++) {
        if (lens_packages_chkbx[i].type === 'checkbox') {
            if(lens_packages_chkbx[i].checked == true){
                $(lens_packages_chkbx[i]).next().css('display','inline-block');
                $(lens_packages_chkbx[i]).next().attr('name','edit_rank[]');
//alert('true');
            }
        }
    }
}
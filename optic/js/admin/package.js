/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var count=1;
function add_package_attributes(){
    var html = '<div class="parent" id="new_package_value_'+count+'">'+
        'Package Attribute: <input type="text" id="name[]" name="name[]" maxlength="40" value=""/>'+
//        ' Price: <input type="text" id="price[]" name="price[]" maxlength="10" value=""/>'+
    '</div>';
    $(html).insertAfter('#new_package_value_'+(count-1));
    count++;
}
var count_upg=1;
function add_upgrade(){
    var html='<div class="parent" id="new_upgrade_'+count_upg+'">'+
        'Upgrade: <input type="text" id="name[]" name="name[]" maxlength="40" value=""/>'+
        ' Price: <input type="text" id="price[]" name="price[]" maxlength="10" value=""/>'+
    '</div>';
    $(html).insertAfter('#new_upgrade_'+(count_upg-1));
    count_upg++;
}
function add_upgrade_attribute(element){
    var id=element.id;
    var name = element.name;
    edit_div_show(".popup_attributes");
    $(".popup_attributes #frm_lens_upgrade_attr #upgrade_id").attr('value',id);
    $(".popup_attributes #frm_lens_upgrade_attr #title").attr('value',name);
}
var count_up_attr=1;
function add_upgrade_attr_value(){
    var html ='<div style="margin:10px;" id="values_'+count_up_attr+'">'+
        'Attribute Value <input type="text" id="value[]" name="value[]" maxlength="40" value="" style="margin-left:20px;"/> '+
        'Attribute Extra <input type="text" id="extra[]" name="extra[]" maxlength="40" value="" style="margin-left:23px;"/>'+
    '</div>';
    $(html).insertAfter('#values_'+(count_up_attr-1));
    count_up_attr++
}
var count_edit_up_attr=1;
function add_edit_upgrade_attr_value(){
    var html ='<div style="margin:10px;" id="values_'+count_up_attr+'">'+
        'Attribute Value <input type="text" id="value[]" name="value[]" maxlength="40" value="" style="margin-left:20px;"/> '+
        'Attribute Extra <input type="text" id="extra[]" name="extra[]" maxlength="40" value="" style="margin-left:23px;"/>'+
    '</div>';
    $(html).insertAfter('#edit_values_'+(count_up_attr-1));
    count_edit_up_attr++
}


$(function(){
    $(".edit_package_attr").click(function(){
        var id=this.id;
        var temp = id.split("_");
        var next_id = temp.pop();//this provides the last value of array in javascript;
        if($(this).is(':checked')){
            $("#display_"+next_id).css('display','block');
            $("#display_"+next_id+" > select").prop('name','visibility[]');
        }else{
            $("#display_"+next_id).css('display','none');
            $("#display_"+next_id+" > select").prop('name','');
        }
    });
});
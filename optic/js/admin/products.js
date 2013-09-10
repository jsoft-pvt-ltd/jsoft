$(function(){
    $(".delete").click(function(){
        var id = this.id;
        var address = this.name;
        var string = (address.split("/"));
        if(confirm("Sure you want to delete this? There is NO undo!")){
            $.ajax({
                type: "POST",
                url: address,
                async:false,
                success: function(){
                    $("#row_"+id).slideUp(200,function(){
                        $("#row_"+id).remove();
                    });
                    $("#row_"+id+"_tr").slideUp(200);
                    setTimeout('alert("Successfully Deleted")',500);
                    set_total_cart_items(id);
                    if(string[5]=='delete_categories'){
                        window.location.reload();
                    }
                }
            });
        }
    });
});
function set_total_cart_items(id){
    setTimeout(function(){
        var x = $("#final_product").height();
    $(".cart_steps_content_holder").css("height",x+"px");
    },500);
    if(id.substr(0,4)=='cart'|| id.substr(0,4)=='item'){
        var no_items = $(".num_cart_items").html();
        if(no_items>0){
            no_items--;
            $(".num_cart_items").html(no_items);
            if(no_items==0){
                location.href=base_url;
            }
        }
    }
}
function add_attributes_container(id){//product id & paren id
    var pid = ""; //product id
    var main_attr_id = ""; //parent id
    try{
        id = id.split('_');
        pid = id[0]; //product id
        main_attr_id = id[1]; //parent id
    }catch(err){
        pid = id;
        main_attr_id = 0;
    }
    
    edit_div_show(".popup");
    
    $("#product_type").attr("value",pid);
    $("#main_attr_id").attr("value",main_attr_id);
}


var count=1;
function add_attribute_values(id){
    var html="";
    var html = html+'<div class="attribute_values" id="values_'+count+'">'+
            'Attribute Value: <input type="text" id="value[]" name="value[]" maxlength="40" value=""/>'+
            ' Price: <input type="text" id="value_price[]" name="value_price[]" maxlength="10" value=""/>'+
//                'Image: <input type="file" id="value_image[]" name="value_image[]"/>'+
                '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                '<a href="javascript:void(0);" class="add_attribute_values" onclick="add_attribute_values(name);"  name="values_'+count+'">[+]</a>&nbsp;&nbsp;'+
                '<a href="javascript:void(0);" class="remove_attribute_values" onclick="hide(name);" name="values_'+count+'">[X]</a>'+
            '<br/>'+
        '</div>';
$(html).insertAfter('#'+id);
count++;
}


var count_edit=1;
function add_attribute_values_edit(id){
    var html1="";
    var html1 = html1+'<div class="attribute_values" id="values_edit_'+count_edit+'">'+
            'Attribute Value: <input type="text" id="value[]" name="value[]" maxlength="40" value=""/>'+
            ' Price: <input type="text" id="value_price[]" name="value_price[]" maxlength="10" value=""/>'+
//                'Image: <input type="file" id="value_image[]" name="value_image[]"/>'+
                '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                '<a href="javascript:void(0);" class="add_attribute_values" onclick="add_attribute_values_edit(name);"  name="values_edit_'+count_edit+'">[+]</a>&nbsp;&nbsp;'+
                '<a href="javascript:void(0);" class="remove_attribute_values" onclick="hide(name);" name="values_edit_'+count_edit+'">[X]</a>'+
            '<br/>'+
        '</div>';
$(html1).insertAfter('#'+id);
count_edit++;
}


function hide(id){
    $('#'+id).find('input:text').attr('value','');
    $("#"+id).slideUp(200);
}

function clear_popup(id){
    try{
        $(".popup form")[0].reset();
        $(".popup_edit form")[0].reset();
        $(".popup_attributes form")[0].reset();
        $(".popup_attributes_edit form")[0].reset();
    }catch(error){}
    $(".overlay").css('display','none');
    $(".popup").css('display','none');
    $(".popup_edit").css('display','none');
    $(".popup_attributes").css('display','none');
    $(".popup_attributes_edit").css('display','none');
}

function edit_div_show(div){//may be both id or class////this parameter should be send with . or # to denote class or id respectively //in use
    var screen_height = $(window).height();
    var screen_width = $(window).width();
    var margin_left = (screen_width-$(div).width())/2;
    var margin_top = (screen_height-$(div).height())/2;
    $(".overlay").css("height",screen_height+"px");
    $(".overlay").css("width",screen_width+"px");
    $(".overlay").css("display","block");
    $(div).css("top",'0');
    $(div).css("margin-left",margin_left);
    $(div).css("margin-top",margin_top);
    $(div).fadeIn(500);
    
    $(window).resize(function(){
        setTimeout(function(){
            var screen_height = $(window).height();
            var screen_width = $(window).width();
            var margin_left = (screen_width-$(".popup").width())/2;
            var margin_top = (screen_height-$(".popup").height())/2;
            $(".overlay").css("height",screen_height+"px");
            $(".overlay").css("width",screen_width+"px");
            $(".overlay").css("display","block");
            $(div).css("margin-left",margin_left);
            $(div).css("margin-top",margin_top);
        }, 100);
    });
}


function edit_attr(element){
    edit_div_show(".popup_edit");
    
    var address = element.name;
    var id = address.substr(address.lastIndexOf("/") + 1);
    
    var url = address;
    $.getJSON(url, {ajax:1}, function(data){
        var id = data['fld_id'];
        var name = data['fld_name'];
        var product_type_id = data['fld_product_type_id'];
        var price = data['fld_price'];

        $("#edit_attribute #name").attr('value',name);
        $("#edit_attribute #price").attr('value',price);
        $("#edit_attribute #product_type_id").attr('value',product_type_id);
        $("#edit_attribute #id").attr('value',id);
    });
}

function edit_attr_values(id){
    edit_div_show(".popup_edit");    
    var url = base_url + "admin/attribute_values/get_attribute_values_by_id/" + id;
    $.getJSON(url, {ajax:1}, function(data){
        var parent_value = data['parent']['fld_value'];
        var parent_price = data['parent']['fld_price'];
        var parent_parentid = data['parent']['fld_parent_id'];
        var parent_attr_id = data['parent']['fld_id']; //id of self
        var level0_parent_id = data['parent']['fld_attribute_id'];

        $("#edit_attribute #name").attr('value',parent_value);
        $("#edit_attribute #price").attr('value',parent_price);
        $("#edit_attribute #parent_id").attr('value',parent_parentid);
        $("#edit_attribute #id").attr('value',parent_attr_id);
        $("#edit_attribute #level0_id").attr('value',level0_parent_id);

        var html="";
        if(data['child'].length==0){
            html = html + 'Attribute Value: <input type="text" id="value[]" name="value[]" maxlength="40"  value=""/>'+
                        'Price: <input type="text" id="value_price[]" name="value_price[]" maxlength="10" value=""/>'+
                        '<input type="hidden" id="value_id[]" name="value_id[]" value="">'+
                        '<input type="hidden" id="value_parent_id[]" name="value_parent_id[]" value="">'+
                        '&nbsp;&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0);" class="add_attribute_values" onclick="add_attribute_values_edit(this.name);" name="values_edit_0">[+]</a>&nbsp;&nbsp;<br/>';
        }
        $.each(data['child'], function(index, array) {
            var value = array['fld_value'];
            var price = array['fld_price'];
            var id = array['fld_id'];
            var parent_id = array['fld_parent_id'];
            html = html + '<div id="values_edit_temp_'+id+'">Attribute Value: <input type="text" id="value[]" name="value[]" maxlength="40"  value="'+value+'"/>'+
                        'Price: <input type="text" id="value_price[]" name="value_price[]" maxlength="10" value="'+price+'"/>'+
                        '<input type="hidden" id="value_id[]" name="value_id[]" value="'+id+'">'+
                        '<input type="hidden" id="value_parent_id[]" name="value_parent_id[]" value="'+parent_id+'">'+
                        '&nbsp;&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0);" class="add_attribute_values" onclick="add_attribute_values_edit(this.name);" name="values_edit_0">[+]</a>&nbsp;&nbsp;<br/>'+
                        '<a href="javascript:void(0);" class="remove_attribute_values" onclick="hide(name);" name="values_edit_temp_'+id+'">[X]</a></div>';
        });
        $("#values_edit_0").html(html)
    })
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                                                          ////////////////////////////////////////////////////////////////////////////////////////////////                  categories starts                       ////////////////////////////////////////////////////////////////////////////////////////////////                                                          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function categories_create_update(element){
    var id=element.id;
    var address = element.name;
    if(id=="" || id==null){
        edit_div_show(".popup");
        $(".popup form").attr('action',address);
    }
    else{
        edit_div_show(".popup_edit");
        $(".popup_edit form").attr('action',address);
        
        var url = base_url+"admin/category/get_categories_n_subs_by_id/"+id;
        $.getJSON(url, {ajax:1}, function(data){
            var id = data['categories']['fld_id'];
            var name = data['categories']['fld_name'];
            var description = data['categories']['fld_description'];
            var status = data['categories']['fld_status'];
            var location = data['categories']['fld_location'];
            var image = data['categories']['fld_image'];
            $("#new_category #img").attr('src',base_url + location + image);
            $("#new_category #delete").attr('id',id);

            $("#new_category #name").attr('value',name);
            $("#new_category #description").html(description);
            $("#new_category #category_id").attr('value',id);
            $("#new_category #status").attr('value',status);
            
            $('#new_category #status option').each(function(){
                var $this = $(this); // cache this jQuery object to avoid overhead
                //alert($this.val()+'_'+status);
                if ($this.val() == status) { // if this option's value is equal to our value
                    if($(this).prop('selected', true)){
                  //      alert(status+" select this option");
                    } // select this option
                    //
                    //return false; // break the loop, no need to look further
                }
            });
            
            var html="";
            if(data['sub_categories'].length==0){
                html = html + 'Sub Categories:&nbsp;&nbsp;&nbsp;<input type="text" id="sub_name_new[]" name="sub_name_new[]" maxlength="40"  value="" style="margin-right:140px;margin-left:2px"/>'+
                            ' Status: <select id="sub_status[]" name="sub_status[]">'+
                                '<option value="1">Show</option>'+
                                '<option value="0">Hide</option>'+
                            '</select><br/><div class="clear"></div>'+
                            '<div class="label">Description</div><textarea id="sub_description_new[]" name="sub_description_new[]" style="width:250px;height:60px;"></textarea>'+
                            '<input type="file" id="subcat_image_new[]" name="subcat_image_new[]" style="width:100px;margin-left:13px;position:absolute;margin-top:10px"/>'+
                            '<input type="hidden" id="sub_cat_id[]" name="sub_cat_id[]" value="">'+
                            '<a href="javascript:void(0);" style="margin-left: 10px;" class="add_attribute_values" onclick="add_sub_categories(this.name);" name="sub_cat_0">[+]</a>&nbsp;&nbsp;<br/>';
            }
            $.each(data['sub_categories'], function(index, array) {
                var id = array['fld_id'];
                var name = array['fld_name'];
                var description = array['fld_description'];
                var status = array['fld_status'];
                var subcat_location = array['fld_location'];
                var subcat_image = array['fld_image'];
                if(subcat_location){
                    var edit_image = '<a href="javascript:void(0)" onclick="delete_subcat_image(this)" class="deleteImg" style="margin-top:-13px;margin-left:95px;position: absolute;" id="'+id+'"><img src="'+base_url+'images/cancel.png" height="15"/></a>'+
                            '<img src="'+ base_url + subcat_location + subcat_image + '" id="img_'+id+'" width="115" style="margin-top:-13px;"/>'+
                            '<input type="file" name="subcat_image_old[]" id="subcat_image_'+id+'" style="display: none;"/>';
                }else{
                    var edit_image = '<input type="file" name="subcat_image_old[]" id="subcat_image_'+id+'" />';
                }
                var select_yes="";
                var select_no=""
                if(status==1){
                    select_yes="selected='selected'";
                    select_no="";
                }
                else{
                    select_yes="";
                    select_no="selected='selected'";
                }
                html = html + '<div id="sub_cat_temp'+id+'">Sub Category:<input type="text" id="sub_name[]" name="sub_name[]" maxlength="40"  value="'+name+'" style="margin-left:23px;margin-right:140px;"/>'+
                            ' Status: <select id="sub_status[]" name="sub_status[]">'+
                                '<option value="1" '+select_yes+'>Show</option>'+
                                '<option value="0" '+select_no+'>Hide</option>'+
                            '</select>'+'<div class="clear"></div>'+
                            '<div class="label">Description</div><div class="input_textarea"><textarea id="sub_description[]" style="width:250px;height:60px;float:left;" name="sub_description[]">'+description+'</textarea></div><br/>'+
                            
                            edit_image+
                            '<input type="hidden" id="sub_cat_id[]" name="sub_cat_id[]" value="'+id+'"><br/>'+
                            '<div style="text-align:right;margin-top:5px;margin-right:10px;">'+
                            '<a href="javascript:void(0);" class="add_attribute_values" onclick="add_sub_categories(this.name);" name="sub_cat_0">[+]</a>&nbsp;&nbsp; '+
                            '<a href="javascript:void(0);" id="'+id+'" onclick="hide(title);" title="sub_cat_temp'+id+'">[X]</a></div></div>';
            });
            $("#sub_cat_0").html(html)
        });
    }
}

var count=1;
function add_sub_categories(id){
    var html="";
    var html = html+'<div class="sub_categories" id="sub_cat_'+count+'">'+
            'Sub Categories:&nbsp;&nbsp;&nbsp;<input type="text" id="sub_name_new[]" name="sub_name_new[]" maxlength="40"  value="" style="margin-right:140px;margin-left:2px"/>'+
            ' Status: <select id="sub_status[]" name="sub_status[]">'+
                '<option value="1">Show</option>'+
                '<option value="0">Hide</option>'+
            '</select><br/><div class="clear"></div>'+
            '<div class="label">Description</div><textarea id="sub_description_new[]" name="sub_description_new[]" style="width:250px;height:60px;"></textarea>'+
            '<input type="file" id="subcat_image_new[]" name="subcat_image_new[]" style="width:100px;margin-left:13px;position:absolute;margin-top:10px"/>'+
            '<input type="hidden" id="sub_cat_id[]" name="sub_cat_id[]" value="">'+
            '<div class="added" style="text-align:right;">'+
                '<a href="javascript:void(0);" class="add_attribute_values" onclick="add_sub_categories(name);"  name="sub_cat_'+count+'">[+]</a>&nbsp;&nbsp;'+
                '<a href="javascript:void(0);" class="remove_attribute_values" onclick="hide(name);" name="sub_cat_'+count+'">[X]</a>'+
                '</div>'+
            '<br/>'+
        '</div>';
    $(html).insertAfter('#'+id);
    count++;
}


$(document).ready(function(){
    $(".up,.down").click(function(){
        var rank = this.id;
        
        var max_rank,min_rank,higher_rank,lower_rank;
        var max_min_rank = get_max_min_rank();
        max_min_rank = max_min_rank.split("-");
        max_rank = max_min_rank[0];
        min_rank = max_min_rank[1];
        var row = $(this).parents("tr:first");
        var rowid;
        
        var thisrow = $(this).closest('tr');//.attr('id');
        var higher_row = (thisrow.prev().attr('id'));
        higher_rank = (($("#"+higher_row+" td:nth-child(3)").attr('id')).split("_"))[1];
        var lower_row = (thisrow.next().attr('id'));
        lower_rank = (($("#"+lower_row+" td:nth-child(3)").attr('id')).split("_"))[1];
        
        
        //var td = $(this).parents("td");
        if ($(this).is(".up")) {
            if(rank!=max_rank){                                 //to not to move up than top most
                //for the current rank
                ($('#rank_'+rank+' a.up').attr('id',(parseInt(higher_rank))));
                ($('#rank_'+rank+' a.down').attr('id',(parseInt(higher_rank))));
                //for the above rank
                ($('#rank_'+(parseInt(higher_rank))+' a.up').attr('id',rank));
                ($('#rank_'+(parseInt(higher_rank))+' a.down').attr('id',rank));
                ($(this).parent().attr('id','rank_'+(parseInt(higher_rank))));
                rowid = (row.prev().attr('id'));
                $("#"+rowid+" td:nth-child(3)").attr('id','rank_'+rank);
                
                row.insertBefore(row.prev());
                interchange_rank(rank,higher_rank,'up');
            }
        } else {
            if(rank!=1){
                //for the current rank
                ($('#rank_'+rank+' a.up').attr('id',(parseInt(lower_rank))));
                ($('#rank_'+rank+' a.down').attr('id',(parseInt(lower_rank))));
                //for the above rank
                ($('#rank_'+(parseInt(rank, 10) - 1)+' a.up').attr('id',rank));
                ($('#rank_'+(parseInt(rank, 10) - 1)+' a.down').attr('id',rank));
                
                ($(this).parent().attr('id','rank_'+(parseInt(lower_rank))));
                rowid = (row.next().attr('id'));
                ($("#"+rowid+" td:nth-child(3)").attr('id','rank_'+rank));
                row.insertAfter(row.next());
                interchange_rank(rank,lower_rank,'down');
            }
        }
    });
});

function interchange_rank(rank,next_rank,position,cat_id, sub_cat_id){ //cat id is the optional parameter
    var address="";
    if(cat_id==null || cat_id ==''){
        address = base_url+"admin/category/interchange_rank/"+rank+"/"+next_rank+'/'+position;
    }
    else{
        address = base_url+"admin/category/interchange_rank/"+rank+"/"+next_rank+'/'+position+'/'+cat_id+"/"+sub_cat_id;
    }
    $.ajax({
        type: "GET",
        url: address,
        success: function(){
        }
    });
}

function get_max_min_rank(id){

    if(id=="" || id==null){
        id='';
    }
    var max_min_ranks=0;
    $.ajax({
        type: "POST",
        async: false,
        url: base_url+"admin/category/get_max_min_rank/"+id,
        success: function(data){
            max_min_ranks = data;
        }
    });
    return(max_min_ranks);
}

$(document).ready(function(){
    $(".up_sub,.down_sub").click(function(){
        var rank_id = this.id;
        rank_id = rank_id.split("_");
        var rank = (rank_id[0]);
        var cat_id = rank_id[1];
        var sub_cat_id = rank_id[2];
        var li;
        
        var max_rank,min_rank,higher_rank,lower_rank;
        var max_min_rank = get_max_min_rank(cat_id);
        max_min_rank = max_min_rank.split("-");
        max_rank = max_min_rank[0];
        min_rank = max_min_rank[1];
        
        //getting the higher rank;
        if($(this).closest('li').prev('li').find('a').attr('id')){
            temp = $(this).closest('li').prev('li').find('a').attr('id');
            higher_rank = temp.split('_')[0];
        }else higher_rank = 0;
        
        //getting the lower rank;
        if($(this).closest('li').next('li').find('a').attr('id')){
            temp = $(this).closest('li').next('li').find('a').attr('id');
            lower_rank = temp.split('_')[0];
        }else lower_rank = 0;
        
        if ($(this).is(".up_sub")) {
            if(rank!=max_rank && higher_rank!=0){ 

                li = $(this).closest('li');
                var prev = li.prev();
                if(prev.length){
                    li.detach().insertBefore(prev);
                }
//                for the current rank
                current_list_id = ($(li).attr('id'));
                ($(this).attr('id',(parseInt(higher_rank))+'_'+cat_id+"_"+sub_cat_id));
                ($('#'+current_list_id+' a.down_sub').attr('id',(parseInt(higher_rank))+'_'+cat_id+"_"+sub_cat_id));
                
                var prev_id = ($(prev).attr('id'));
                //for the above rank
                sub_cat_id_next = ($('#'+prev_id+' a.up_sub').attr('id')).split('_')[2];
                ($('#'+prev_id+' a.up_sub').attr('id',rank+"_"+cat_id+"_"+sub_cat_id_next));
                ($('#'+prev_id+' a.down_sub').attr('id',rank+"_"+cat_id+"_"+sub_cat_id_next));

                interchange_rank(rank,higher_rank,'up',cat_id,sub_cat_id);
            }
        } else {
            if(parseInt(rank)>parseInt(min_rank) && lower_rank!=0){
//                alert(rank+".."+min_rank);
                li = $(this).closest('li');
                var next = li.next();
                if(next.length){
                    li.detach().insertAfter(next);
                }
                
                //for the current rank
                ($(this).attr('id',(parseInt(lower_rank))+'_'+cat_id+"_"+sub_cat_id));
                ($('#'+rank+"_"+cat_id+'_'+sub_cat_id).attr('id',(parseInt(lower_rank))+'_'+cat_id+"_"+sub_cat_id));
                
                var next_id = ($(next).attr('id'));
                //for the above rank
                sub_cat_id_next = ($('#'+next_id+' a.up_sub').attr('id')).split('_')[2];
                ($('#'+next_id+' a.up_sub').attr('id',rank+"_"+cat_id+"_"+sub_cat_id_next));
                ($('#'+next_id+' a.down_sub').attr('id',rank+"_"+cat_id+"_"+sub_cat_id_next));
                interchange_rank(rank,lower_rank,'down',cat_id,sub_cat_id);
            }
        }
    });
});
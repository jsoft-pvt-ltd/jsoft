var left=0;
var steps=1;
avail_packages = new Array(); //this is the all the available packages.
recommended_package=0; //this is the recommended package according to the prescription.
recommended_flag = false;
var old_frame_price;
var old_accessory_price;
var old_contact_lens_price;
var old_frame_qty;
var old_accessory_qty;
var old_contact_lens_qty;
var old_total_price;

function move(param){            
    var line = $('.cart_steps_content_holder');
    line.animate(param,500);
}
function remove_checked(){
        $(".color_radio").prop('checked',false);
        $('.upgrade_colors').children('div').removeClass('border_click');
    }
    
//    function check_parent(umes){
//        $(".color_box").removeClass('border_click');
//        $(umes).parent('.upgrade_colors').children('div').addClass('border_click');
//        $(".my_checkBox").prop('checked',false);
//        $(umes).parent('div:first').parent('div:first').find('> .cart_title_holder').find('> input').prop('checked',true);
//    }
$(function(){
    function move(param)
        {            
            var line = $('.cart_steps_content_holder');
            line.animate(param,500);
        }
    
    $(".previous_cart").click(function(){
        validation=false;
        manage_nav('prev');
        prev_btn();
    });
    $(".next_cart").click(function(){
//        manage_nav('next');
//        next_btn();
    });
    $(".upgrades .upgrade_colors input").hover(function(){
        $(this).parent('.upgrade_colors').children('div').addClass('border');
    },function(){
        $(this).parent('.upgrade_colors').children('div').removeClass('border')
    });
    
    
    $(".step1").click(function(){
       if(logged_in != true){
           return false;
       }
    });
    
    $("#next_step1").click(function(){
       step_to_lens_package();
    });
    
    $(".upload_step1").click(function(){
        check_upload();
    });
    
    
    $(".step_4").click(function(){
        populate_value();
        var flag;
        var prescription;
        if(sph_od !="0" || cyl_od !="" || add_od!="" || axis_od !="" || sph_os !="0" || cyl_os !="" || add_os!="" || axis_os !=""){
            flag = check_presc_upload();
            if(flag!=1){
                prescription = 1
            }
            else if(flag==1) prescription = 2
        }
        else if(check_presc_upload()== 1){
            prescription = 2
        }
        else prescription = 1;
        var product_id = $("#cart_content #item_id").attr('value');
        var product_price = $("#cart_content #price").attr('value');
        var product_name = $("#cart_content #name").attr('value');
        var product_color = $("#cart_content #color").attr('value');
        var product_color_id = $("#cart_content #color_id").attr('value');
        var item_code =  $("#cart_content #item_code").attr('value');
        var lens_type =  $("#cart_content #lens_type").attr('value');
        var lens_type_id =  $("#cart_content #lens_type_id").attr('value');
        var lens_package = $("#cart_content #lens_package").attr('value');
        var lens_package_id = $("#cart_content #lens_package_id").attr('value');
        var lens_package_price = $("#cart_content #lens_package_price").attr('value');
        var lens_upgrade_id = $("#cart_content #lens_upgrade_id").attr('value');
        var lens_upgrade = $("#cart_content #lens_upgrade").attr('value');
        var lens_upgrade_color = $("#cart_content #lens_upgrade_color").attr('value');
        var lens_upgrade_value_id = $("#cart_content #lens_upgrade_value_id").attr('value');
        var lens_upgrade_attr_id = $("#cart_content #lens_upgrade_attr_id").attr('value');
        var lens_upgrade_price =  $("#cart_content #lens_upgrade_price").attr('value');
        $('.ui-widget-overlay.ui-front').show();
        $('.loading').show();
        $.ajax({
            type: "POST",
            url: base_url+'site/cart_steps/insert_to_cart',
            async: "FALSE",
            data: {
                    product_id: product_id,
                    product_price : product_price,
                    product_name : product_name,
                    product_color : product_color,
                    item_code : item_code,
                    lens_type : lens_type,
                    lens_package : lens_package,
                    lens_package_price : lens_package_price,
                    lens_upgrade : lens_upgrade,
                    lens_upgrade_color : lens_upgrade_color,
                    lens_upgrade_price : lens_upgrade_price,
                    product_color_id : product_color_id,
                    lens_type_id : lens_type_id,
                    lens_package_id : lens_package_id,
                    lens_upgrade_id : lens_upgrade_id,
                    lens_upgrade_value_id : lens_upgrade_value_id,
                    lens_upgrade_attr_id : lens_upgrade_attr_id,
                    prescription : prescription
                },
            success: function(flag){ 
                
                setTimeout(function(){
                    $('.ui-widget-overlay.ui-front').hide();
                    $('.loading').hide();
                });
                var no_items = $(".num_cart_items").html();
                no_items++;
                if(flag==true){
                    alert('This Item is added in the Cart');
                    $(".previus_cart").css('display','none');
                    $(".num_cart_items").html(no_items);
                    
                    $(".active_prev").addClass('deactive_prev');
                    $(".active_prev").removeClass('active_prev');
                }
                else{
                    $(".cart_items").css('display','none');
                    alert('Sorry!!! :(\nThis Item already exists in the Cart\nOr\nSystem crashed. Please contact to the admin.');
                    
                    $(".active_prev").addClass('deactive_prev');
                    $(".active_prev").removeClass('active_prev');
                }
                var x = $("#final_product").height();
                $(".cart_steps_content_holder").css("height",x+"px");
                var total_price = parseFloat(product_price)+parseFloat(lens_package_price)+parseFloat(lens_upgrade_price)
                total_price = total_price + " <input type='hidden' name='sub_total[]' id='sub_total[]' value='"+total_price+"'/>";
                $(".total .right").html(total_price);
                window.location.href = base_url+'site/cart_steps/view_cart';
//                next_btn();
            }
        });
    });
    
    $(".pay_pal_check_out").click(function(){
        var carrier;
        carrier = checked_buttons('carrier');
        if(carrier=="" || carrier==null){
            alert("Please select a carrier. Except these carriers we are not able to deliver the product.");
            return false;
        }
    });
    
    $(".final_checkout").click(function(){
        var carrier;
        carrier = checked_buttons('carrier');
        if(carrier=="" || carrier==null){
            alert("Please select a carrier. Except these carriers we are not able to deliver the product.");
            return false;
        }
        $.ajax({
            type: "POST",
            url: base_url+'site/cart_steps/purchased/'+carrier,
            $data:'',
            success: function(){
                window.location.href=base_url;
            }
        });
    });
    
    $('.use_presc').click(function(){
        $('.use_presc').html('Use This');
        $(this).html('On Use');
        var id = this.id;
        $.ajax({
            type:"POST",
            async:false,
            data:'',
            url:base_url+'site/cart_steps/set_on_session/'+id,
            success:function(){}
        });
    });
    
    $(".view_presc").click(function(){
        $(this).next().toggle(500);
    });
    
    $('.presc_use_next').click(function(){
        reuse_presc();
    });
    
    //===============================================================================
    $('.lu_next_btn').click(function()
    {
        step_to_accessories();
    });
    //===============================================================================
    
});


function set_powers(){
    power_os = parseFloat(calculate_power(sph_os, cyl_os)).toFixed(2);
    power_od = parseFloat(calculate_power(sph_od, cyl_od)).toFixed(2);

    if(power_os!=0 && power_od!=0){
         get_appro_power(power_os,power_od);  //get appropriate power for two powers
    }
    else if(power_os!=0 && power_od==0){
        greater_power = Math.ceil(power_os);
    }
    else if(power_os==0 && power_od!=0){
        greater_power = Math.ceil(power_od);
    }
    else{
        greater_power = 0;
    }
    }
function set_available_recommended_packages(){
        if(avail_packages.length>0){
            $(".packages").css('opacity','0.5');
            $(".packages").removeClass('recommended_package');
            $(".recommended").remove();
            $('input[name="lens_package"]').removeAttr('checked');
            $('input[name="lens_package"]').attr('disabled', 'disabled');
            $.each(avail_packages, function(index, infos) {
                $("#lens_package_"+infos).css('opacity','1');
                if(infos == recommended_package){
                    $("#lens_package_"+infos).addClass('recommended_package');
                    $('<span class="recommended">*</span>').insertAfter("#lens_package_"+infos+" span.price")
                }
                $("#radio_lens_package_"+infos).removeProp('disabled');
            });
            avail_packages.length =0;
            recommended_package=0;
            recommended_flag = false;
        }
        else $(".packages").css("opacity",'1');
    }
function check_for_siblings(element)
{
    if(check_upgrade_attributes())
    {
        accessories();
        next_btn();
    }
    else
    {
        alert('You must select an attribute.');
    }
 
}
function alter_disable_prop(element)
{
    var div_name = "lens_upgrade_attributes";
    var radios = document.getElementsByName(div_name);
    for (var i = 0; i < radios.length; i++)
    {
        if (radios[i].type === 'radio' && radios[i].checked) {
           $(radios[i]).prop('checked', false);
           $(radios[i]).next().removeClass('border_click');
           
        }
    }
    $(element).parent().siblings().find('input:radio').removeProp("disabled");
}
function next_btn(){
    if(left>(-3920)){
        left=parseInt(left)-parseInt(980);
        steps++;
        $(".cart_steps .current_step").removeClass("current_step");
        $("#step"+steps).children("div").addClass("current_step");
        move({marginLeft:left});
    }
}
function prev_btn(){
    if(left<0){
        left=parseInt(left)+parseInt(980);
        steps--;
        $(".cart_steps .current_step").removeClass("current_step");
        $("#step"+steps).children("div").addClass("current_step");
        move({marginLeft:left});
    }
}
function lens_upgrade(id){
    if(id=='' || id==null){
        id='';
    }
    var lens_package = checked_buttons('lens_package');
    if(lens_package=="" || lens_package==null)
    {
        alert ("Please Select a Lens Package From The List");
        return(false);
    }
    $(".next_cart").removeAttr('onclick');
    $(".next_cart").attr('onclick','step_to_accessories();')
    var address=base_url+"site/cart_steps/lens_upgrade/"+id;
    $.ajax({
        type: "POST",
        url: address,
        data: "lens_package="+lens_package,
        success: function(){
            var url = base_url+"site/cart_steps/lens_package_info/"+lens_package;
            set_package_info(url);
            get_upgrade_info(lens_package);
        }
    });
    next_btn();
}

//function get_upgrade_info(lens_package){
//    $.getJSON(base_url+"site/cart_steps/lens_upgrade_info/"+lens_package, {ajax:1}, function(data){
//        var html="";
//        $.each(data['upgrades'], function(index, array) {
//            var key=array['fld_id'];
//            html=html+"<div><div class='upgrades left'>";
//            html=html+"<div class='cart_title_holder'>";
//            html=html+"<input class='my_checkBox' onclick='remove_checked();' type='radio' name='lens_upgrade' value='"+array['fld_id']+"'/>";
//            html=html+"<span class='cart_title'>"+array['fld_name']+"</span><span class='price'>[ $"+array['fld_price']+" ]</span><br/></div>";
//            html=html+"<div class='attr_name attr_name_"+key+"'></div>";
//            $.getJSON(base_url+"site/cart_steps/lens_upgrade_attr_info/"+key, {ajax:1}, function(data){
//                var html_att=""
//                $.each(data['upgrade_attr'], function(index, array1) {
//                    html_att=html_att+"&nbsp;&nbsp;&nbsp;"+array1['fld_name']+"<br>";
//                    var nkey=array1['fld_id'];
//                    $.getJSON(base_url+"site/cart_steps/lens_upgrade_value_info/"+nkey, {ajax:1}, function(data){
//                       var html_val=""
//                       $.each(data['upgrade_value'], function(index, array2) {
//                           html_val=html_val+"<div class='upgrade_colors'>";
//                           html_val=html_val+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' class='color_radio' onclick='check_parent(this);' name='lens_upgrade_attributes' value='"+nkey+"_"+array2['fld_id']+"'/>";
//                           html_val=html_val+"<div class='color_box' style='background:#"+array2['fld_extra']+"'></div></div>";
//                           html_val=html_val+"<span>"+array2['fld_name']+"</span><br/></div>";
//                       });
//                       $(html_val).insertAfter(".attr_name_"+key);
//                    });
//                });
//                $(".attr_name_"+key).html(html_att);
//            });
//            html=html+"</div></div>";
//        });
//        $(".lens_upgrades").html(html);
//        if(data['upgrades'] == null || data['upgrades']=="")
//        {
//            var htmls="";
//            htmls="Sorry! No Upgrades Available For The Package You Selected.";
//            $(".lens_upgrades").html(htmls);
//        }
//    });
//}
function get_upgrade_info(lens_package){    
    $.getJSON(base_url+"site/cart_steps/lens_upgrade_info/"+lens_package, {ajax:1}, function(data){
        var html="";
        $.each(data['upgrades'], function(index, array) {
            var key=array['fld_id'];
            html=html+"<div><div class='upgrades left'>";
            html=html+"<div class='cart_title_holder'>";
            html=html+"<input class='my_checkBox' onclick='remove_checked();popup_attributes("+key+",&#34;"+array['fld_name']+"&#34;);' type='radio' name='lens_upgrade' value='"+key+"'/>";
            html=html+"<span class='cart_title'>"+array['fld_name']+"</span><span class='price'>[ $"+array['fld_price']+" ]</span>";
            html = html+ '<a onclick="javascript:void(0);window.open(&#39'+base_url+'site/cart_steps/descriptions/'+key+'/upgrade&#39,&#39'+array['fld_name']+'&#39,&#39width=500,height=700,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=0,left=0,top=0&#39);" title="Description for '+array['fld_name']+'">';
            html = html+ '<img src="'+base_url+'images/help.png" style="position: relative; width: 19px; margin-top: 4px; margin-left: 5px;"/></a><br/>'
            html = html+'</div>';
            html=html+"<div class='attr_name attr_name_"+key+"'></div>";
            html=html+"</div></div>";
        });
        
//        
//        echo '<a onclick="javascript:void(0);window.open(&#39'.base_url().'site/cart_steps/descriptions/'.$lens_package->fld_id.'/package&#39,&#39'.$lens_package->fld_name.'&#39,&#39width=500,height=700,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=0,left=0,top=0&#39);" title="Description for '.$lens_package->fld_name.'">';
//                                        echo '<img src="'.base_url().'images/help.png" style="position: relative; width: 19px; margin-top: 4px; margin-left: 5px;"/></a><br/>';
//                                        
        $(".lens_upgrades").html(html);
        if(data['upgrades'] == null || data['upgrades']=="")
        {
            var htmls="";
            htmls="Sorry! No Upgrades Available For The Package You Selected.";
            $(".lens_upgrades").html(htmls);
        }
    });
}
function set_package_info(url){
    $.getJSON(url, {ajax:1}, function(data){
        var html="";
        html = html+ "Lens Package: " +data['fld_name']+"<br/>";
        html = html+ ' ';
        if(promocode==true && current_category == free_category){
            html = html+ "Price: "+0;
            html = html + " <input type='hidden' name='lens_package_price[]' id='lens_package_price[]' value='0'>";
        }else{
            html = html+ "Price: "+data['fld_price'];
            html = html + "<input type='hidden' name='lens_package_price[]' id='lens_package_price[]' value='"+data['fld_price']+"'>";
        }
        $("#final_product .lens_package").html(html);
        $("#cart_content #lens_package").attr("value",data['fld_name']);
        $("#cart_content #lens_package_id").attr("value",data['fld_id']);
        if(promocode==true && current_category == free_category)
            $("#cart_content #lens_package_price").attr("value",0);
        else 
            $("#cart_content #lens_package_price").attr("value",data['fld_price']);
    });
}
function accessories(id){
    var lens_upgrade = checked_buttons('lens_upgrade');
    var lens_upgrade_attr = checked_buttons('lens_upgrade_attributes');
    var lua_split = lens_upgrade_attr.split('_'); //lua stands for lens upgrade attribute
    var attr = lua_split[0];
    var value = lua_split[1];
    var upgrades = lens_upgrade+"_"+lens_upgrade_attr;
    if(upgrades=='' || upgrades=='_' || upgrades=='__'){
        upgrades="";
    }
    if(id=="" || id==null){
        id="";
    }
    var address=base_url+"site/cart_steps/accessories/"+id;
    $.ajax({
        type: "POST",
        url: address,
        data: "fld_lens_upgrade="+lens_upgrade+"_"+lens_upgrade_attr,
        success: function(){
        }
    });
    if(upgrades!=""){
        var url= base_url+"site/cart_steps/get_upgrades/"+upgrades;
        $.getJSON(url, {ajax:1}, function(data){
            var html="";
            html = html+"Upgrades: "+data['upgrade']+"<br/>";
            html = html+ data["upgrade_attr"]+": "+data["upgrade_attr_value"]+"<br/>";
            if(promocode==true && current_category == free_category){
                html = html+ "Price: "+0;
                html = html + " <input type='hidden' name='lens_upgrade_price[]' id='lens_upgrade_price[]' value='0'/>";
            }
            else{ 
                html = html+ "Price: "+data["price"];
                html = html + " <input type='hidden' name='lens_upgrade_price[]' id='lens_upgrade_price[]' value='"+data["price"]+"'/>";
            }
            $("#final_product .upgrades_info").html(html);
            $("#cart_content #lens_upgrade").attr("value",data['upgrade']);
            $("#cart_content #lens_upgrade_color").attr("value",data['upgrade_attr_value']);
            if(promocode==true && current_category == free_category)
                $("#cart_content #lens_upgrade_price").attr("value",0);
            else
                $("#cart_content #lens_upgrade_price").attr("value",data['price']);

            $("#cart_content #lens_upgrade_attr_id").attr("value",attr);
            $("#cart_content #lens_upgrade_id").attr("value",lens_upgrade);
            $("#cart_content #lens_upgrade_value_id").attr("value",value);

        });
    }
}


function checked_buttons(name){ //return the checked radio buttons
    var radios = document.getElementsByName(name);
    var value="";
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            value = radios[i].value;
            return (value);
        }
    }
    return value;
}

function check_presc_upload(){
    var flag;
    $.ajax({
        type: "POST",
        url: base_url+'site/cart_steps/check_presc_upload',
        async:false,
        data: "",
        success: function(value){
            flag = value
        }
    });
    return flag;
}

function upload_prescription(){
    populate_value();
    power_od = calculate_power(sph_od, cyl_od);
    power_os = calculate_power(sph_os, cyl_os);
    address=base_url+"user/my_prescription/insert_prescription"
    $.ajax({
        type:"POST",
        url:address,
        async:false,
        data:{
            sph_od:sph_od,
            sph_os:sph_os,
            cyl_od:cyl_od,
            cyl_os:cyl_os,
            axis_od:axis_od,
            axis_os:axis_os,
            add_od:add_od,
            add_os:add_os,
            power_od:power_od,
            power_os:power_os,
            patient_name:patient_name,
            pd:pd,
            pd_right:pd_right,
            pd_left:pd_left,
            remarks:remarks
        },
        success:function(){
            window.location.reload();
        }
    });
}
function set_presc_type(val){
    $.ajax({
        url:base_url+'site/cart_steps/set_presc_type/'+val,
        type:'POST',
        async:false,
        data:''
    })
}
function set_session_values(){
    populate_value();
    power_od = calculate_power(sph_od, cyl_od);
    power_os = calculate_power(sph_os, cyl_os);
    $.ajax({
        type: "POST",
        url: base_url+'site/cart_steps/set_session_values',
        async: "FALSE",
        data: {
                power_od:power_od,
                power_os:power_os,
                sph_od:sph_od,
                cyl_od:cyl_od,
                add_od:add_od,
                axis_od:axis_od,
                sph_os:sph_os,
                cyl_os:cyl_os,
                add_os:add_os,
                axis_os:axis_os,
                pd:pd,
                pd_left:pd_left,
                pd_right:pd_right,
                patient_name:patient_name,
                remarks:remarks
            },
        success: function(){
    }
    });
}
function insert_carrier_detail(id){
    $.ajax({
        type:'POST',
        url:base_url+"site/cart_steps/insert_carrier_detail/"+id,
        success:function(){}
    })
}
function session_unset(){
    $.ajax({
        type:'POST',
        url:base_url+"site/cart_steps/session_unset",
        success:function(){}
    })
}
function set_carrier(value){
    $.ajax({
        type:'POST',
        url:base_url+"site/cart_steps/set_carrier/"+value,
        success:function(){}
    })
}

/*
 *  LENS PACKAGES INFOS
 *  this is a function to check the recommended and available packages accroding to the prescription entered.
 **/
function lens_packages_infos(){
    greater_cyl = compare(cyl_os, cyl_od);
    var url = base_url+"site/cart_steps/lens_package_info/0";
    $.ajax({
        dataType:"json",
        url: url,
        async:false,
        success:function(data){
            $.each(data, function(index, infos) {
                if(check_cyl(infos)){
                    if(check_pow(infos)){
                        if(recommended_flag != true)
                            check_recommended(infos);
                    }
                }
            });
        }
    });
}

function check_cyl(infos){
    if(parseFloat(greater_cyl)<=infos.fld_cyl_range && parseFloat(greater_cyl)>=0){
        return true;
    }else return false;
}

function check_pow(infos){
    if(parseFloat(power_od)<=infos.fld_max && parseFloat(power_od)>=infos.fld_min){
        if(parseFloat(power_os)<=infos.fld_max && parseFloat(power_os)>=infos.fld_min){
            avail_packages.push(infos.fld_id);
            return true;
        }else return false;
    }else return false;
}
function check_recommended(infos){
    if(parseFloat(greater_power-2)<=infos.fld_max && parseFloat(greater_power-2)>=infos.fld_min){
        recommended_package = infos.fld_id;
        recommended_flag = true;
    }
}
/**
 * GET_APPRO_POWER
 * this function returns appropriate power for the recommendation of the lens package
 **/
function get_appro_power(pow_1, pow_2){
    if((pow_1<0 && pow_2<0) || (pow_1>=0 && pow_2>=0)){
        greater_power = compare(pow_1, pow_2);
        if(greater_power == Math.abs(pow_1)){
            greater_power = change_to_ceil(pow_1); //this function changes to ceiling value with sign independent;
        }
        else greater_power = change_to_ceil(pow_2);
    }
    else if(pow_1<0 && pow_2>=0){
        greater_power = change_to_ceil(pow_1);
    }
    else{
        greater_power = change_to_ceil(pow_2);
    }
}
/**
 * CHANGE TO CEIL
 * this function returns the ceiling value regardless of the sign but returns the value as it was.
 * eg.:
 *  If value = -3.45 then it returns -4 instead of -3
 *  If value = 4.45 then it returns 5
 **/
function change_to_ceil(value){
    if(value<0){
        return Math.floor(value);
    }
    else return Math.ceil(value);
}


/**
 * EDITING OF THE ITEM IN CART
 **/

$(function(){
$(".next_cart").attr('onclick','step_to_lens_package();')
    $(".edit_entered_presc").click(function(){
        var id = (this.id).split("_")[1];
        validate();
       $(".presc_validation_error").hide();
       $(".presc_validation_error").html(overall_message);
       if(overall_message!='<b>You have following errors. Please show your patience to fill the prescription.</b>'){
           $(".presc_validation_error").html(overall_message);
           $(".presc_validation_error").slideDown(500);
       }
       else if(overall_message=='<b>You have following errors. Please show your patience to fill the prescription.</b>'){
           populate_value();
           set_powers();
            if(this.innerHTML=="Done"){
                upload_prescription();
            }
            lens_packages_infos();
            set_available_recommended_packages();
            set_presc_type(1);
            set_session_values();
            next_btn();
       }
       overall_message='<b>You have following errors. Please show your patience to fill the prescription.</b>';
    });
})
function manage_nav(side){
    if(side=='prev' && left!=0){
        next_left = left+980;
    }
    else if(side=='prev')next_left=0;
    
    if(next_left==0){
        $(".next_cart").attr('onclick','step_to_lens_package();')
    }
    if(next_left==-980){
        $(".next_cart").removeAttr('onclick');
        $(".next_cart").attr('onclick','lens_upgrade();')
    }
    if(next_left==-1960){
        $(".next_cart").removeAttr('onclick');
        $(".next_cart").attr('onclick','step_to_accessories();');
        $(".deactive_next").addClass('active_next');
        $(".deactive_next").removeClass('deactive_next');
    }
}
function step_to_lens_package(){
    validate();
    
    $(".presc_validation_error").hide();
    $(".presc_validation_error").html(overall_message);
    if(overall_message!='<b>You have following errors. Please show your patience to fill the prescription.</b>'){
        $(".presc_validation_error").html(overall_message);
        $(".presc_validation_error").slideDown(500,function(){
            var x = $("#step_one").height();
            $(".cart_steps_content_holder").animate({
                height:x + "px",
                linear:true
            },500);
        });
    }
    else if(overall_message=='<b>You have following errors. Please show your patience to fill the prescription.</b>'){
        
        $(".next_cart").removeAttr('onclick');
        $(".next_cart").attr('onclick','lens_upgrade();')
        
        populate_value();
        set_powers();

         if(this.innerHTML=="Done"){
             upload_prescription();
         }
         lens_packages_infos();
         set_available_recommended_packages();
         set_presc_type(1);
         set_session_values();
         next_btn();
    }
    overall_message='<b>You have following errors. Please show your patience to fill the prescription.</b>';
}
function step_to_accessories(){
    var name = "lens_upgrade";
    var radios = document.getElementsByName(name);
    for (var i = 0; i < radios.length; i++)
    {
        if (radios[i].type === 'radio' && radios[i].checked) {
            check_for_siblings(radios[i]);
        }
    }
    $(".next_cart").removeAttr('onclick');
    $(".active_next").addClass('deactive_next');
    $(".active_next").removeClass('active_next');
}
function popup_attributes(key, name){ //key is the id of attribute_ values
    $(".popup_attr_name").html('');
    $.getJSON(base_url+"site/cart_steps/lens_upgrade_attr_info/"+key, {ajax:1}, function(data){
        var html_att="";
        $.each(data['upgrade_attr'], function(index, array1) {
            html_att=html_att+"&nbsp;&nbsp;&nbsp;"+array1['fld_name']+"<br>";
            var nkey=array1['fld_id'];
            $.getJSON(base_url+"site/cart_steps/lens_upgrade_value_info/"+nkey, {ajax:1}, function(data){
               var html_val=""
               $.each(data['upgrade_value'], function(index, array2) {
                   html_val=html_val+"<div class='upgrade_colors'>";
                   html_val=html_val+"&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' class='color_radio' name='lens_upgrade_attributes' value='"+nkey+"_"+array2['fld_id']+"'/>";
                   html_val=html_val+"<span style='box-shadow: 0 4px 2px -2px #ccc;border-bottom:5px solid #"+array2['fld_extra']+";padding:0 3px;'>"+array2['fld_name']+"</span></div>";
                   html_val=html_val+"</div>";
               });
               $(".popup_attr_name").html(html_val);
            });
        });
        $(".popup_attr").html(html_att);
    });
    $( "#dialog-modal").attr('title',name);
    $( "#dialog-modal" ).dialog({
        modal: true,
        buttons: {
            Ok: function() {
                $(this).dialog( "close" );
                if(check_upgrade_attributes()){
                    $(".next_cart").removeAttr('onclick');
                    step_to_accessories();
                }else alert('You must select an attribute.');
            }
        }
    });
}
function check_upgrade_attributes(){
    var flag=false;
    var abc = document.getElementsByName("lens_upgrade_attributes");
    $(abc).each(function(){
        if($(this).is(':checked')){
            flag = true;
        }
    });
    return flag;
}
function check_upload(){
    if(!test){
        alert("Please upload the prescription.");
    }
    if(test){
        next_btn();
    }
    return false;
}
function reuse_presc(){
    var flag=false;
    $(".use_presc").each(function(){
        var value = (this).innerHTML;
        if(value=='On Use'){
            flag = true;
            set_presc_type(3);
            next_btn();
            return false;
        }
        else flag = false;
    })
    if(flag==false){
        alert('Please select a prescription for use.');
    }
}
function set_selected_option(param,val){
    $("#"+param+" option").each(function(){
        if(this.value==val){
            $(this).prop('selected','selected');
        }
    })
}
function remove_empty(param){
    if(param==null || param==0){
        return 0;
    }
    else return param;
}
function popup_description(description){
    $( "#popup_description").attr('title','name');
    $( "#popup_description" ).html(description);
    $( "#popup_description" ).dialog({
        modal: true,
        buttons: {
            Ok: function() {
                $(this).dialog( "close" );
            }
        }
    });
}
function populate_cart_attrs(){
    old_frame_price         = parseFloat($(".frame_price span").html());
    old_frame_qty           = parseInt($("span.frame_qty span").html());
    old_accessory_price     = parseFloat($(".qty_accessories_price span").html());
    old_accessory_qty       = parseInt($("span.qty_accessories span").html());
    old_contact_lens_price  = parseFloat($(".contact_lens_price span").html());
    old_contact_lens_qty    = parseInt($("span.contact_lens_qty span").html());
    old_total_price         = parseFloat($(".total_price span").html());
}
function set_cart(price, qty, product){
    price = parseFloat(price);
    qty = parseInt(qty);
    populate_cart_attrs();
    switch(product){
        case 'frame':
            new_price   = old_frame_price - ( price*qty );
            new_qty     = old_frame_qty - qty;
            if(new_qty==0){
                $(".frame_cart").hide();
            }
            $(".frame_price span").html(new_price);
            $("span.frame_qty span").html(new_qty);
            break;
        case 'accessory':
            new_price   = old_accessory_price - ( price*qty );
            new_qty     = old_accessory_qty - qty;
            if(new_qty==0){
                $(".accessory_cart").hide();
            }
            $(".qty_accessories_price span").html(new_price);
            $("span.qty_accessories span").html(new_qty)
            break;
        case 'contact_lens':
            new_price   = old_contact_lens_price - ( price*qty );
            new_qty     = old_contact_lens_qty - qty;
            if(new_qty==0){
                $(".contact_lens_cart").hide();
            }
            $(".contact_lens_price span").html(new_price);
            $("span.contact_lens_qty span").html(new_qty)
            break;
        default:break;
    }
    new_total_price = (old_total_price - ( price*qty )).toFixed(2);
    if(new_total_price==0){
        $(".total").hide();
    }
    $(".total_price span").html(new_total_price);
}
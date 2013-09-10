var nomatch = "nomatch";var flag=0;
var promocode;
var cart_items=0;
function check()
{
    if(flag==0)
    {
        var promocode = $('#promocode').val();
        var url = base_url + 'site/promocode/check';
        get_cart_items();
//        $.ajax({//});
//            url:url,
//            type:'POST',
//            dataType:'json',
//            async: false,
//            data:promocode,
//            success:function(data)
        $.getJSON(url,{data:promocode},function(data)
            {
                console.log(data);
                if(data.fld_promocode_type=="nomatch"){
                    alert("Promocode did not match.");
                    flag=0;
                }
                if(data.fld_promocode_type=="inactive"){
                    alert("Promocode is not active.");
                    flag=0;
                }
                if(data.fld_promocode_type=="exp"){
                    alert("The promocode date has expired.");
                }
                if(data.fld_promocode_type=="date"){
                    alert("The promocode date is invalid.");   
                }
                //CASE-1(BUY 1 GET 1)=========================================================================================
                else if(data.fld_promocode_type==1){
                    setTimeout(function(){check_cart_items(data, data.fld_promocode_type)}, 500);
                }
                //CASE-2(BUY 2 GET 1)=========================================================================================
                else if(data.fld_promocode_type==2){
                    if(cart_items<2){
                        alert('There must be at least two items in the cart to use this promocode');
                        flag=0;
                    }else{
                        var url = base_url + 'site/promocode/category/'+data.fld_category;
                        $.getJSON(url, function(category)
                        {
                            var html = '<div class="promocode_result">'+
                                            '<p>'+
                                                'With this promocode, you are eligible for buy 2 Get 1 package.To ensure select a frame from the '+
                                                '<a href="'+base_url+'site/categories/index/'+data.fld_category+'/9">'+category.fld_name+'</a>';
                                            '</p>'+
                                        '</div>';
                            $(html).insertAfter('.promotion_code');
                        });
                        flag=1;
                    }
                }
                //CASE-3(BUY 3 GET 1)=========================================================================================
                else if(data.fld_promocode_type==3){
                    if(cart_items<3){
                        alert('There must be at least three items in the cart to use this promocode');
                        flag=0;
                    }else{
                        var url = base_url + 'site/promocode/category/'+data.fld_category;
                        $.getJSON(url, function(category)
                        {
                            var html = '<div class="promocode_result">'+
                                            '<p>'+
                                                'With this promocode, you are eligible for buy 2 Get 1 package.To ensure select a frame from the '+
                                                '<a href="'+base_url+'site/categories/index/'+data.fld_category+'/9">'+category.fld_name+'</a>';
                                            '</p>'+
                                        '</div>';
                            $(html).insertAfter('.promotion_code');
                        });
                        flag=1;
                    }
                }
                //CASE-4(Free shipping to US on orders above x USD)============================================================
                else if(data.fld_promocode_type==4){
                    // the total_price is set on the view_cart as a global variable so it can be used here directly
                    if(total_price<data.fld_amt_above){
                        alert('The total cart amout is less than the required amount fot this promocode to be used.');
                        flag=0;
                    }else{
                        var html = '<div class="promocode_result">'+
                                        '<p>'+
                                            'With this promocode, you are eligible for free shipping'+
                                        '</p>'+
                                    '</div>';
                        $(html).insertAfter('.promotion_code');
                        flag=1;
                    }
                }
                //CASE-4(Free shipping to US on orders above x USD)============================================================
                else if(data.fld_promocode_type==4){

                }
//            }
        }); 
    }else{
        alert("You have already used your promocode.")
    }
}
function check_cart_items(data, type){
    if(cart_items<type){
        alert("There should be at least "+type+" item in the cart to use this promocode.");
        flag=0;

    }else{
        var url = base_url + 'site/promocode/category/'+data.fld_category;
        $.getJSON(url, function(category)
        {
            var html = '<div class="promocode_result">'+
                            '<p>'+
                                'With this promocode, you are eligible for buy 1 Get 1 package.To ensure select a frame from the '+
                                '<a href="'+base_url+'site/categories/index/'+data.fld_category+'/9'+'" onclick="set_promocode_true('+data.fld_category+');">'+category.fld_name+'</a>';
                            '</p>'+
                        '</div>';
            $(html).insertAfter('.promotion_code');
        });
        flag=1;
    }
}
function set_promocode_true(category){
    promocode = true;
    free_category = category;
    var url = base_url+'site/promocode/set_promocode_true/'+category;
    $.post(url);
}
function get_cart_items(){
    $.ajax({
        type:'POST',
        url:base_url+'site/promocode/get_total_cart_items',
        asycn:false,
        success:function(data){
            cart_items = data
        }
    })
    cart_items = cart_items;
}
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function wishlist(pid)
{
    var url = base_url+'user/wishlist/index/'+pid;
    $.ajax({
                type: "POST",
                url: url,
//                    beforeSend: function(){
//                                                $("#contains").html("<h1>Loading please wait</h1>"); 
//                                            },
                success: function(msg) {
                    if(msg=="    false")
                    {
                        alert("You have already added this product with same option.");
                    }
                    else if(msg=="    true")
                    {
                        if(confirm("The product has been added to your wishlist.Would you like to see your wishlist ?")==true)
                        {
                            window.location.href = base_url+'user/wishlist/edit_wishlist';
                        }
                    }
                    else if(msg=="    login")
                    {
                        if(confirm("You need to login before adding items to wishlist. Would you like to login now ?")==true)
                        {
                            window.location.href = base_url+'user/login';
                        }
                    }
                }
        });
}

function get_glasses(id,prod_id){
    $.getJSON(base_url+"site/cart_steps/glasses_view/"+id+"/"+prod_id, {ajax:1}, function(data){
        var html=""
            $.each(data['images'], function(index, array) {
                if (array['fld_primary']==0 || array['fld_primary']=="0")
                {
                    html=html+"<div class='primary_img'>";
                    html=html+"<img alt='product' src='"+base_url+array['fld_url']+"/"+array['fld_name']+"'></div>";
                }
                html=html+"<div class='thumbs'>";
                html=html+"<img alt='product' src='"+base_url+array['fld_url']+"/thumbs/"+array['fld_name']+"' class='thumb_imgs' onclick='change_image(this);' width='142'></div>";
            });
        $('.img_views').html(html);
    });
}

$(function() {
$(".accordion .accord-header").click(function() {
    var img_src = $(this).children('.sign').children('img').attr('src');
    img_src = img_src.split("/");

    if($(this).next("div").is(":visible")){
        $(this).next("div").slideUp(200);
        $(this).children('.sign').children('img').attr('src',base_url+'images/open.png');
    } else {
        $(".accordion .accord-content").slideUp(200);
        $(this).next("div").slideToggle("slow");
        $('.sign > img').attr('src',base_url+'images/open.png');
    }

    if(img_src.pop() == 'open.png'){
        $(this).children('.sign').children('img').attr('src',base_url+'images/close.png');
    }else{
        $(this).children('.sign').children('img').attr('src',base_url+'images/open.png');
    }
    });                        
});
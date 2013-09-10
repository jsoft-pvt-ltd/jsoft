$(function(){
    $(".contact_no").hover(function(){
        $('.contact_no').animate({
            width: 335
        }, 200,function(){
            $('.contact_no #phone_no').show(200);
        });
    },function(){
        $('.contact_no').stop().animate({
            width: 50
        }, 300);
        $('#phone_no').css('display','none');
    });

    
    $(".link").hover(function(){
        $(this).children('div').show();
        $(this).children('div.menu_list').animate({
            marginTop:'0px',
            opacity:1
        },200,'linear');
    },
        function(){
            var element = this;
            $(element).children('div').fadeOut(20,function(){
                $(element).children('div.menu_list').css({
                    marginTop:'30px',
                    opacity:0.5
                });
            });
        }
    )
        
    $(".my_cart").hover(function(){
        $('div.cart_item_info_container').show();
        $('div.cart_item_info_container').animate({
            marginTop:'0px',
            opacity:1
        },200,'linear');
    },
        function(){
            $('div.cart_item_info_container').fadeOut(0,function(){
                $('div.cart_item_info_container').css({
                    marginTop:'30px',
                    opacity:0.5
                });
            });
        }
    )
    
    $("#glasses").hover(function(){
        $(".glasses_menu").css('visibility',"visible");
        $('.show').css({
            display:'block',
            visibility:'visible',
            transition: '.11s ease-out 0.1s'
        });
        $(".show").parent('li').addClass('hovered');
    },function(){
        $(".glasses_menu").css({
            visibility:"hidden",
            transition: '.11s ease-out 0.1s'
        });
        $('ul.show').css({
            visibility:'hidden',
            transition: '.11s ease-out 0.1s'
        });
    });
    
    $(".search").hover(function(){
        $(".search_menu").css('visibility',"visible");
    }
    ,function(){
        $(".search_menu").css({
            visibility:"hidden",
            transition: '.11s ease-out 0.1s'
        });
    });
    
    $("ul#menuV2 > li").hover(function(){
        $(".show").parent('li').className = "hovered";
    },function(){
        $(".show").parent('li').removeClass("hovered");
    });
});
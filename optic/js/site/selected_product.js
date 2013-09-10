$(function(){
    $(".colors").hover(function(){
        $(this).children("div").addClass("border");
    }, function(){
        $(this).children("div").removeClass("border");
    })
    $(".colors").click(function(){
        $(".color_box").removeClass('border_click');
        $(this).children("div").addClass("border_click");
    });
    $(".thumb_imgs").click(function(){
//        alert(this.src);
        src = this.src.replace(/\b\/thumbs\b/g, '');
//        alert(src);
        $('.primary_img img').attr("src",src);
    })

    $('#frm_product_info').validate({
        errorLabelContainer: "#error_place",
        rules:{
            lens_type:{
                required:true   
            },
            color:{
                required:is_color_checked()
            }
        },
        messages:{
            lens_type:{
                required:"Please select a <b>Lens Type</b>. &raquo"
            },
            color:{
                required:"Please select a <b>Frame Color</b>. &raquo"
            }
        }
    });
    var margin_left = ($(window).width()-238)/2;
    var margin_top = ($(window).height()-110)/2;
    $("#error_place").css({
        'margin-left':margin_left,
        'margin-top':margin_top
    });
    
    
    $('.colors').click(function(){
        $('.colors').removeClass('selected_color');
        $('label.error:last-child').css('display','none');
        $(this).addClass('selected_color');
        $(this).children('.color_radios').prop('checked',true);
    })
    
    
});
function is_color_checked(){
    if($(".color_radios").is(":checked")){
        return false
    }else return true;
}
function change_image(element){
        src = element.src.replace(/\b\/thumbs\b/g, '');
        $('.primary_img img').attr("src",src);
}
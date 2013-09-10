/* idTabs ~ Sean Catchpole - Version 2.2 - MIT/GPL */
(function () {
    var dep = {
        "jQuery": "http://code.jquery.com/jquery-latest.min.js"
    };
    var init = function () {
        (function ($) {
            $.fn.idTabs = function () {
                var s = {};
                for (var i = 0; i < arguments.length; ++i) {
                    var a = arguments[i];
                    switch (a.constructor) {
                    case Object:
                        $.extend(s, a);
                        break;
                    case Boolean:
                        s.change = a;
                        break;
                    case Number:
                        s.start = a;
                        break;
                    case Function:
                        s.click = a;
                        break;
                    case String:
                        if (a.charAt(0) == '.') s.selected = a;
                        else if (a.charAt(0) == '!') s.event = a;
                        else s.start = a;
                        break;
                    }
                }
                if (typeof s['return'] == "function")
                    s.change = s['return'];
                return this.each(function () {
                    $.idTabs(this, s);
                });
            }
            $.idTabs = function (tabs, options) {
                var meta = ($.metadata) ? $(tabs).metadata() : {};
                var s = $.extend({}, $.idTabs.settings, meta, options);
                if (s.selected.charAt(0) == '.') s.selected = s.selected.substr(1);
                if (s.event.charAt(0) == '!') s.event = s.event.substr(1);
                if (s.start == null) s.start = -1;
                var showId = function () {
                    if ($(this).is('.' + s.selected))
                        return s.change;
                    var id = "#" + this.href.split('#')[1];
                    var aList = [];
                    var idList = [];
                    $("a", tabs).each(function () {
                        if (this.href.match(/#/)) {
                            aList.push(this);
                            idList.push("#" + this.href.split('#')[1]);
                        }
                    });
                    if (s.click && !s.click.apply(this, [id, idList, tabs, s])) return s.change;
                    for (i in aList) $(aList[i]).removeClass(s.selected);
                    for (i in idList) $(idList[i]).hide();
                    $(this).addClass(s.selected);
                    $(id).show();
                    return s.change;
                }
                var list = $("a[href*='#']", tabs).unbind(s.event, showId).bind(s.event, showId);
                list.each(function () {
                    $("#" + this.href.split('#')[1]).hide();
                });
                var test = false;
                if ((test = list.filter('.' + s.selected)).length);
                else if (typeof s.start == "number" && (test = list.eq(s.start)).length);
                else if (typeof s.start == "string" && (test = list.filter("[href*='#" + s.start + "']")).length);
                if (test) {
                    test.removeClass(s.selected);
                    test.trigger(s.event);
                }
                return s;
            }
            $.idTabs.settings = {
                start: 0,
                change: false,
                click: null,
                selected: ".selected",
                event: "!click"
            };
            $.idTabs.version = "2.2";
            $(function () {
                $(".idTabs").idTabs();
            });
        })(jQuery);
    }
    var check = function (o, s) {
        s = s.split('.');
        while (o && s.length) o = o[s.shift()];
        return o;
    }
    var head = document.getElementsByTagName("head")[0];
    var add = function (url) {
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = url;
        head.appendChild(s);
    }
    var s = document.getElementsByTagName('script');
    var src = s[s.length - 1].src;
    var ok = true;
    for (d in dep) {
        if (check(this, d)) continue;
        ok = false;
        add(dep[d]);
    }
    if (ok) return init();
    add(src);
})();
function show_tab(tab){
    $('#email_presc').hide();
    $('#enter_presc').hide(); 
    $('#reuse_presc').hide();
    $('#'+tab).show();
    $('#enter_presc_tab').removeClass('selected');
    $('#reuse_presc_tab').removeClass('selected');
    $('#email_presc_tab').removeClass('selected');
    $('#'+tab+'_tab').addClass('selected');
    if(tab=='enter_presc'){
        $(".next_cart").removeAttr('onclick');
        $(".next_cart").attr('onclick','step_to_lens_package();')
    }else if(tab=='email_presc'){
        $(".next_cart").removeAttr('onclick');
        $(".next_cart").attr('onclick','check_upload();')
    }else{
        $(".next_cart").removeAttr('onclick');
        $(".next_cart").attr('onclick','reuse_presc();')
    }
}
$(function(){
    $(".presc_tab").click(function(){
        var id = this.id;
        switch(id){
            case 'enter_presc_tab':
                $(".next_cart").removeAttr('onclick');
                $(".next_cart").attr('onclick','step_to_lens_package();');
                break;
            case 'email_presc_tab':
                $(".next_cart").removeAttr('onclick');
                $(".next_cart").attr('onclick','check_upload();');
                break;
            case 'reuse_presc_tab':
                $(".next_cart").removeAttr('onclick');
                $(".next_cart").attr('onclick','reuse_presc();')
                break;
            default:break;
        }
    })
})

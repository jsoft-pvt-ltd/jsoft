var power_od;
var power_os;
//Upper value
var sph_od;
var cyl_od;
var add_od;
var axis_od;
//lower value
var sph_os;
var cyl_os;
var add_os;
var axis_os;

var pd;
var pd_left;
var pd_right;
var patient_name;
var remarks;// for comments provided by the user.
var prescription_path;

$(function(){
    $('.view_presc').click(function(){
        $(".popup_presc").css('opacity',0);
        $(".popup_presc").show();
        setTimeout(function(){
            var top = (screen.height - $("div.popup_presc").height())/2;
            $(".popup_presc").css('margin-top',top);
            $(".popup_presc").animate({
                opacity:1
            },600);
        },10)
        var url=base_url+'admin/order/get_prescription_info/'+this.id;
            $.getJSON(url, {ajax:1}, function(data){
                set_presc_values(data);
                set_presc_table();
            });
    });
    $("#presc_done").click(function(){
        $(".popup_presc").fadeOut(600);
    })
})

function set_presc_values(data){
    power_od = check_empty_value(data['fld_power_od']);
    power_os = check_empty_value(data['fld_power_os']);
    //Upper value
    sph_od = check_empty_value(data['fld_sph_od']);
    cyl_od = check_empty_value(data['fld_cyl_od']);
    add_od = check_empty_value(data['fld_add_od']);
    axis_od = check_empty_value(data['fld_axis_od']);
    //lower value
    sph_os = check_empty_value(data['fld_sph_os']);
    cyl_os = check_empty_value(data['fld_cyl_os']);
    add_os = check_empty_value(data['fld_add_os']);
    axis_os = check_empty_value(data['fld_axis_os']);

    pd = check_empty_value(data['fld_pd']);
    pd_left = check_empty_value(data['fld_pd_left']);
    pd_right = check_empty_value(data['fld_pd_right']);
    patient_name = 'Prescription for: '+check_empty_value(data['fld_patient_name']);
    remarks = check_empty_value(data['fld_remarks']);
    prescription_path = check_empty_value(data['fld_prescription_path']);
}
function set_presc_table(){
    $("#power_od").html(power_od);
    $("#power_os").html(power_os);
    $("#sph_od").html(sph_od);
    $("#cyl_od").html(cyl_od);
    $("#add_od").html(add_od);
    $("#axis_od").html(axis_od);
    $("#sph_os").html(sph_os);
    $("#cyl_os").html(cyl_os);
    $("#add_os").html(add_os);
    $("#axis_os").html(axis_os);
    $("#pd").html(pd);
    $("#pd_left").html(pd_left);
    $("#pd_right").html(pd_right);
    $("#patient_name").html(patient_name);
    $("#remarks").html(remarks);
}
function check_empty_value(data){
    if(data=="" || data==null || data==0){
        return 'N/A';
    }
    else return data;
}
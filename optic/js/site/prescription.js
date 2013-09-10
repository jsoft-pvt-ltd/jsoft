function showItem(item){
        $("#both").toggle();
        $("#single").toggle();
    }
        var power_od = 0;
        var power_os = 0;
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
    function populate_value()
    {
        //Upper value
        sph_od = $('#sph_od').val();
        cyl_od = $('#cyl_od').val();
        if(sph_od=='SPH' || sph_od=="PLANO" || sph_od==""){
            sph_od=0;
        }
        if(cyl_od=='CYL' || cyl_od=="PLANO" || cyl_od==""){
            cyl_od=0;
        }
        add_od = $('#add_od').val();
        axis_od = $('#axis_od').val()

        //lower value

        sph_os = $('#sph_os').val();
        cyl_os = $('#cyl_os').val();
        if(sph_os=='SPH' || sph_os=="PLANO" || sph_os==""){
            sph_os=0;
        }
        if(cyl_os=='CYL' || cyl_os=="PLANO" || cyl_os==""){
            cyl_os=0;
        }
        add_os = $('#add_os').val();
        axis_os =$('#axis_os').val();
        
        // more infos
        remarks = $("#extraComment").val();
        pd = $('#PD').val();
        pd_left = $('#PD2').val();
        pd_right = $('#PD1').val();
        patient_name = $("#patientName").val();
    }

    function check_for_default()
    {
         if(sph_od =="0" &&  cyl_od =="" && add_od=="" &&  axis_od =="" && sph_os =="0" &&  cyl_os =="" && add_os=="" &&  axis_os =="")
             {
                 if(window.location == base_url+'user/my_prescription'){
                    var msg1 = 'At least insert value for either SPH OD or SPH OS.';
                    $('#sph_od').attr('style','border:3px solid #BB0000');
                    $('#sph_os').attr('style','border:3px solid #BB0000');
                    overall_message = overall_message+'<br/>'+msg1+'<br/>';
                     return true;
                 }
                 result = confirm("Do you want glasses with non-prescription lenses?");
                 if(result == true)
                     {
                         $('#sph_od').attr('style','border:1px solid #CCC');
                         $('#sph_os').attr('style','border:1px solid #CCC');
                         return true;
                     }
                 if(result == false)
                     {
                        var msg = 'At least insert value for either SPH OD or SPH OS.';
                        $('#sph_od').attr('style','border:3px solid #BB0000');
                        $('#sph_os').attr('style','border:3px solid #BB0000');
                        overall_message = overall_message+'<br/>'+msg+'<br/>';
                        return true;
                     }
             }
             else{
                 $('#sph_od').attr('style','border:1px solid #CCC');
                 $('#sph_os').attr('style','border:1px solid #CCC');
             }
             return false;

    }

function check_neg_pos()
{
 var flag_od = false;
 var flag_os = false;
 var msg = "";

    if((check_positive(sph_od) =="-" && check_positive(cyl_od) == "+") || (check_positive(sph_od) =="+" && check_positive(cyl_od) == "-") )
    {
        if(feedback_od!=true){
             flag_od = true;
             $('#sph_od').attr('style','border:3px solid #BB0000');
             $('#cyl_od').attr('style','border:3px solid #BB0000');
             msg = "The values you have entered for SPH and CYL is +ve and –ve in OD";
         }
    }

    if((check_positive(sph_os) =="-" && check_positive(cyl_os) == "+") || (check_positive(sph_os) =="+" && check_positive(cyl_os) == "-") )
    {
        if(feedback_os!=true){
             flag_os = true;
             $('#sph_os').attr('style','border:3px solid #BB0000');
             $('#cyl_os').attr('style','border:3px solid #BB0000');
              msg = msg +"\nThe values you have entered for SPH and CYL is +ve and –ve in OS";
         }
    }

    if (flag_od == true || flag_os == true)
    {
        var msg1 = msg+"\n\n\nIf the prescription is correct click Ok."
        var flag =confirm(msg1);
        if(flag == false)
            {
//                alert('Dont proceed with check out');
                overall_message = overall_message+'<br/>'+msg;
            }
         else if(flag == true)
        {
            feedback_od=true;
            feedback_os=true;
            $('#sph_od').attr('style','border:1px solid #ccc');
            $('#cyl_od').attr('style','border:1px solid #ccc');
            $('#sph_os').attr('style','border:1px solid #ccc');
            $('#cyl_os').attr('style','border:1px solid #ccc');
//                            alert('Proceed with check out');
        }
    }
    if((check_positive(sph_od)!=check_positive(sph_os)) && sph_od!=0 && sph_os!=0){
        if(feedback_sph!=true){
            msg = "The values you have entered for SPH OD and SPH OS is +ve and –ve.\n\n\nIf the prescription is correct click Ok.";

            var flag = confirm(msg);
            if(flag==true){
                feedback_sph=true;
                $('#sph_od').attr('style','border:1px solid #ccc');
                $('#sph_os').attr('style','border:1px solid #ccc');
                //proceed further.
            }
            else if(flag==false){
                overall_message = overall_message+'<br/>'+"The values you have entered for SPH OD and SPH OS is +ve and –ve.";
                $('#sph_od').attr('style','border:3px solid #BB0000');
                $('#sph_os').attr('style','border:3px solid #BB0000');
            }
        }
   }
   
   if((check_positive(cyl_od)=='-' && check_positive(cyl_os)=='+') ||(check_positive(cyl_od)=='+' && check_positive(cyl_os)=='-')){
       if(feedback_cyl!=true){
            msg = "The values you have entered for CYL OD and CYL OS is +ve and –ve.\n\n\nIf the prescription is correct click Ok.";
            var flag = confirm(msg);
            if(flag==true){
                feedback_cyl=true;
                $('#cyl_od').attr('style','border:1px solid #ccc');
                $('#cyl_os').attr('style','border:1px solid #ccc');
                //proceed further.
            }
            else if(flag==false){
                $('#cyl_od').attr('style','border:3px solid #BB0000');
                $('#cyl_os').attr('style','border:3px solid #BB0000');
                overall_message = overall_message+'<br/>'+'The values you have entered for CYL OD and CYL OS is +ve and –ve.';
            }
       }
   }
}

    function check_sph_value()
    {
        var od_flag=false;
        var os_flag=false;
        msg ="";
            if(sph_od=="0" && plano_od==false)
                {
                    msg = "Would you like a plano in OD";
                    od_flag=true;
                }
            if(sph_os=="0" && plano_os==false)
                {
                    msg = msg + "\nWould you like a plano lens in OS ";
                    os_flag=true;
                }
            if(msg!="")
                {
                    var flag = confirm(msg);
                    if(flag==true){
                        if(od_flag==false)plano_os = true;
                        if(os_flag==false)plano_od = true;
                    }
                    else{
                        overall_message = overall_message+'<br/>'+"Please insert at least value for either SPH OD or SPH OS ";
                    }
                }
    }



    function check_axis_cyl()
    {
        flag_cyl_od = false;
        flag_axis_od = false;
        flag_cyl_os = false;
        flag_axis_os = false;

            if(cyl_od !="")
                flag_cyl_od = true;
            if(axis_od!="")
                flag_axis_od = true;

               if(cyl_os !="")
                flag_cyl_os = true;
            if(axis_os!="")
                flag_axis_os = true;

            if((flag_cyl_od == false &&  flag_axis_od == true ) || (flag_cyl_od == true &&  flag_axis_od == false ) )
                {

                        if(flag_cyl_od == false)
                            {
                                $('#cyl_od').attr('style','border:3px solid #BB0000');
                                overall_message = overall_message+'<br/>'+"Please enter CYL value for OD ";
                            }
                        else if (flag_axis_od == false)
                            {
                                $('#axis_od').attr('style','border:3px solid #BB0000');
                                overall_message = overall_message+'<br/>'+"Please enter Axis value for OD ";
                            }
                }
            else{
                $('#cyl_od').attr('style','border:1px solid #ccc');
                $('#axis_od').attr('style','border:1px solid #ccc');
            }

                  if((flag_cyl_os == false &&  flag_axis_os == true ) || (flag_cyl_os == true &&  flag_axis_os == false ) )
                {

                        if(flag_cyl_os == false)
                            {
                                $('#cyl_os').attr('style','border:3px solid #BB0000');
                                overall_message = overall_message+'<br/>'+"Please enter CYL value for OS";
                            }
                        else if (flag_axis_os == false)
                            {
                                $('#axis_os').attr('style','border:3px solid #BB0000');
                                overall_message = overall_message+'<br/>'+"Please enter Axis value for OS";
                            }
                }
                else{
                    $('#cyl_os').attr('style','border:1px solid #ccc');
                    $('#axis_os').attr('style','border:1px solid #ccc');
                }

    }

    function check_add_power()
    {
        var disabled = $("#add_od").attr('disabled');
        if(disabled=='' || disabled==null){
            if(add_od==""&& (sph_od!=0 && sph_od!='')){
                $('#add_od').attr('style','border:3px solid #BB0000');
                overall_message = overall_message+"<br/>Please add power for OD.";
            }
            else $('#add_od').attr('style','border:1px solid #CCC');
            if(add_os=="" && (sph_os!=0 && sph_os!='')){
                $('#add_os').attr('style','border:3px solid #BB0000');
                overall_message = overall_message+"<br/>Please add power for OS.";
            }else $('#add_os').attr('style','border:1px solid #CCC');
           return false;
        }
    }

    function  validate()
    {
        populate_value();
        if(check_prism()==false){
            if(check_for_default()==false)
            {
                var flag = check_prism();
                if(flag==false){
                    check_sph_value();
                    check_neg_pos();
                    check_axis_cyl();
                    check_add_power();
                    check_patient_name();
                    check_pd();
                }
            }
        }else {
            $(".presc_validation_error").remove();
            var msg = '<div class="presc_validation_error">'+overall_message+'</div>';
            $(msg).insertBefore("#file_uploader");
            show_tab('email_presc');
        }
    }
    function check_prism(){
        var prism_value = checked_buttons('prism');
        if(prism_value=="Yes"){
            alert("You have selected Prism so, you don't need to fill prescription but you must upload your prescription.\nPlease upload your prescription");
            overall_message="You have selected Prism so, you don't need to fill prescription but you must upload your prescription.<br/>Please upload your prescription";
            return true;
        }
        return false;
    }
    function check_pd(){
        var display_single = $("#single").css('display');
        var display_both = $("#both").css('display');
        if(display_single=='block'){
            var pd = $("#PD").val();
            if(pd==""){
                $("#PD").css('border','3px solid #BB0000');
                overall_message=overall_message+'<br/>'+'Please select a value for PD';
            }else{
                $("#PD").css('border','1px solid #CCC');
            }
        }
        if(display_both=='block'){
            var pd1 = $("#PD1").val();
            var pd2 = $("#PD2").val();
            if(pd1==""){
                overall_message=overall_message+'<br/>'+'Please select a value for Right PD';
                $("#PD1").css('border','3px solid #BB0000');
            }else{
                $("#PD1").css('border','1px solid #CCC');
            }
            if(pd2==""){
                $("#PD2").css('border','3px solid #BB0000');
                overall_message=overall_message+'<br/>'+'Please select a value for Left PD';
            }else{
                $("#PD2").css('border','1px solid #CCC');
            }
        }
        //alert()
    }
    function check_patient_name(){
        patient_name = $("#patientName").val();
        if(patient_name=="" || patient_name==null){
            $("#patientName").css('border','3px solid #BB0000');
            overall_message=overall_message+'<br/>'+'Please insert the patient name';
        }
        else{
            $("#patientName").css('border','1px solid #ccc');
        }
    }

    function check_positive(val)
    {
        if(val>=0){
            return ('+')
        }else if(val<0) return ('-');
        else return ('+');
//         return val.charAt(0);
    }

    function calculate_power(sph, cyl){
        return parseFloat(sph) + parseFloat(cyl /2)
    }
    
    $(function(){

        if(lens == 1 || lens == 2){
            $("#add_od").removeAttr('disabled');
            $("#add_od_overlay").css('display','none');
            
            $("#add_os").removeAttr('disabled');
            $("#add_os_overlay").css('display','none');
        }
        else {
            $("#add_od").attr('disabled','disabled');
            $("#add_os").attr('disabled','disabled');
            $("#add_od_overlay").show();
            $("#add_os_overlay").show();
            $("#add_od_overlay, #add_os_overlay").click(function(){
                alert("The lens type you have selected is not Bifocal nor Progressive.\nIf your prescription defines these fields please go back and select either Bifocal or Progressive lens type.\nOR\nYou can email the prescription.\nThankyou.");;
            })
        }
    });
    
    function compare(x, y){ //returns greater value
        var a=Math.abs(x);
        var b=Math.abs(y);
        return Math.max(a,b);
    }
    
    $(function(){
        $('.presc_detail').click(function(){         
            var id = this.id;
            $("."+id).css('opacity',0);
            $("."+id).show();
            setTimeout(function(){
                var top = ($(window).height() - $("."+id).height())/2;
                $("."+id).css('margin-top',top);
                $("."+id).animate({
                    opacity:1
                },600);
            },10)
        });
    })
    
    function remove_popup(popup){
        if(popup=='popup_presc_upload'){
            $("."+popup+" form")[0].reset();
        }
        if(popup=='popup_presc_entry'){
            $txtfields = $('.'+popup).find('input[type=text]')
            $txtfields.val('');
            $('#extraComment').val('');
            $('.'+popup+' select').each(function(){
                $('#'+this.id).val($('#'+this.id).find('option[selected]').val());
            })
        }
        $("."+popup).fadeOut(400);
    }
    
    function get_power(element){
        var id=element.id;
        populate_value();
        if(id=="power_od"){
//            if(sph_od!=0 && sph_od!="PLANO" && sph_od!="SPH" && sph_od!="" && sph_od!=null && cyl_od!=0 && cyl_od!="PLANO" && cyl_od!="SPH" && cyl_od!="" && cyl_od!=null){
//            if(sph_od!="" && sph_od!=null && cyl_od!="" && cyl_od!=null){
                power_od = calculate_power(sph_od, cyl_od);
                power_od = parseFloat(power_od).toFixed(2); //rounding off to two decimal
                $(element).attr('value',power_od)
//            }
//            else alert('Some of the values are missing. \nPower cannot be calculated');
        }
        else{
//            if(sph_os!=0 && sph_os!="PLANO" && sph_os!="SPH" && sph_os!="" && sph_os!=null && cyl_os!=0 && cyl_os!="PLANO" && cyl_os!="SPH" && cyl_os!="" && cyl_os!=null){
//            if(sph_os!="" && sph_os!=null && cyl_os!="" && cyl_os!=null){
                power_os = calculate_power(sph_os, cyl_os);
                power_os = parseFloat(power_os).toFixed(2); //rounding off to two decimal
                $(element).attr('value',power_os)
//            }
//            else alert('Some of the values are missing. \nPower cannot be calculated');
        }
    }
<script>
        function movedown(rank){
             var max=get_max_frank();
             $("#auto").css('opacity','0.3');
        var address = base_url+"admin/page_rank/move_fdowns/"+rank;
            $.getJSON(address,{ajax:1},function(data){
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_frank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    if(array['fld_frank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_frank']+' onclick="movedown('+array['fld_frank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_frank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_frank']+' onclick="moveup('+array['fld_frank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a>'
                    if(array['fld_foption']=='1'){
                        html=html+'<a class="show operation"  id='+array['fld_frank']+' onclick="hide('+array['fld_id']+');" href="#"> - [Hide]</a>';
                    }
                    else if(array['fld_foption']=='0'){
                        html=html+'<a class="hide operation"  id='+array['fld_frank']+' onclick="show('+array['fld_id']+');" href="#"> - [Show]</a>';
                    }
                    html=html+'</td></tr>';
                    
                });
                $("#auto").html(html);
                $("#auto").css('opacity','1');
            }); }
        function moveup(rank){
             var max=get_max_frank();
             $("#auto").css('opacity','0.3');
        var address = base_url+"admin/page_rank/move_fups/"+rank;
            $.getJSON(address,{ajax:1},function(data){
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_frank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    
                    if(array['fld_frank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_frank']+' onclick="movedown('+array['fld_frank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_frank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_frank']+' onclick="moveup('+array['fld_frank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a>'
                    if(array['fld_foption']=='1'){
                        html=html+'<a class="show operation"  id='+array['fld_frank']+' onclick="hide('+array['fld_id']+');" href="#"> - [Hide]</a>';
                    }
                    else if(array['fld_foption']=='0'){
                        html=html+'<a class="hide operation"  id='+array['fld_frank']+' onclick="show('+array['fld_id']+');" href="#"> - [Show]</a>';
                    }
                    html=html+'</td></tr>';
                    
                });
                $("#auto").html(html);
                $("#auto").css('opacity','1');
            }); }
        
        function eraseCache(){
            $.ajax({
                url: "",
                context: document.body,
                success: function(s,x){
                    $('html[manifest=saveappoffline.appcache]').attr('content', '');
                        $(this).html(s);
                }
            }); 
        }
        
function get_max_rank(){
        var max_rank=0;
        $.ajax({
            type: "POST",
            async: false,
            url: base_url+"admin/page_rank/get_max_rank",
            success: function(data){
                max_rank = data;
            }
        });
        return(max_rank);
}
function get_max_frank(){
        var max_rank=0;
        $.ajax({
            type: "POST",
            async: false,
            url: base_url+"admin/page_rank/get_max_frank",
            success: function(data){
                max_rank = data;
            }
        });
        return(max_rank);
}

function show(id){
    var address = base_url+"admin/page_rank/showf/"+id;
     var max=get_max_frank();
    $("#auto").css('opacity','0.3');
    $.getJSON(address,{ajax:1},function(data){
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_frank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    
                    if(array['fld_frank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_frank']+' onclick="movedown('+array['fld_frank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_frank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_frank']+' onclick="moveup('+array['fld_frank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a>'
                    if(array['fld_foption']=='1'){
                        html=html+'<a class="show operation"  id='+array['fld_frank']+' onclick="hide('+array['fld_id']+');" href="#"> - [Hide]</a>';
                    }
                    else if(array['fld_foption']=='0'){
                        html=html+'<a class="hide operation"  id='+array['fld_frank']+' onclick="show('+array['fld_id']+');" href="#"> - [Show]</a>';
                    }
                    html=html+'</td></tr>';
                    
                });
                $("#auto").html(html);
                $("#auto").css('opacity','1');
            });
}

function hide(id){
    var address = base_url+"admin/page_rank/hidef/"+id;
     var max=get_max_frank();
    $("#auto").css('opacity','0.3');
    $.getJSON(address,{ajax:1},function(data){
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_frank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    
                    if(array['fld_frank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_frank']+' onclick="movedown('+array['fld_frank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_frank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_frank']+' onclick="moveup('+array['fld_frank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a>'
                    if(array['fld_foption']=='1'){
                        html=html+'<a class="show operation"  id='+array['fld_frank']+' onclick="hide('+array['fld_id']+');" href="#"> - [Hide]</a>';
                    }
                    else if(array['fld_foption']=='0'){
                        html=html+'<a class="hide operation"  id='+array['fld_frank']+' onclick="show('+array['fld_id']+');" href="#"> - [Show]</a>';
                    }
                    html=html+'</td></tr>';
                    
                });
                $("#auto").html(html);
                $("#auto").css('opacity','1');
            });
}
</script>
    
<div class="container">
    <?php echo $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation">Footer Menu Rank</div>
        </div>
        
        <table width="100%">
            <tr style="font-weight: bold;">
                <td width="20%">Page Rank</td>
                <td width="20%">Page ID</td>
                <td width="30%">Page Name</td>
                <td width="30%">Operations</td>
            </tr>
        </table>
        <table id="auto" width="100%">
            <?php if(!empty($alldata)):?>
            <?php foreach($alldata as $data):?>
            
            <tr>
                <td width="20%"><?php echo $data->fld_frank;?></td>
                <td width="20%"><?php echo $data->fld_id;?></td> 
                <td  width="30%"><?php echo $data->fld_page;?></td>
                <td  width="30%">
                    <?php if($max!==$data->fld_frank):?>
                    <a class="down operation"  id="<?php echo $data->fld_frank; ?>" onclick="movedown(<?php echo $data->fld_frank;?>);" href="#"><?php endif; ?>[Move Down]</a> 
                    
                    <?php if($data->fld_frank!=="1"): ?>
                    <a class="ups operation"  id="<?php echo $data->fld_frank;?>" onclick="moveup(<?php echo $data->fld_frank;?>);" href="#"><?php endif; ?>- [Move Up]</a>
                    <?php if($data->fld_foption=="0"):?>
                    <a class="show operation"  id="<?php echo $data->fld_frank; ?>" onclick="show(<?php echo $data->fld_id;?>);" href="#"> - [Show]</a>
                    <?php elseif ($data->fld_foption=="1"): ?>
                    <a class="hide operation"  id="<?php echo $data->fld_frank; ?>" onclick="hide(<?php echo $data->fld_id;?>);" href="#"> - [Hide]</a><?php endif; ?>
                </td>    
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </table>
        <div id="autos" style="margin-bottom:30px;">
            <table width="100%">
            </table>  
        </div>
        
        <a class="operation" href="<?php echo base_url() ?>admin/page_rank/manage_header">Header Menu Options &DoubleRightArrow;</a>
    </div>
    
</div>

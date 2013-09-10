<script>
        function moveup(rank){
            if (rank!==1)
                {
                //var htmls = '<h2 Style="color:#0A80E5; width:150px; font-size:25px; font-weight:bold; margin:0 auto; margin-top:100px;">Please Wait</h2>';
                //$("#auto").html(htmls);
             eraseCache();
             var max=get_max_rank();
             $("#auto").css('opacity','0.3');
        var address = base_url+"admin/page_rank/move_ups/"+rank;
            $.getJSON(address,{ajax:1},function(data){
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_rank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    
                    if(array['fld_rank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_rank']+' onclick="movedown('+array['fld_rank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_rank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_rank']+' onclick="moveup('+array['fld_rank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a>'
                    if(array['fld_option']=='1'){
                        html=html+'<a class="show operation"  id='+array['fld_rank']+' onclick="hide('+array['fld_id']+');" href="#"> - [Hide]</a>';
                    }
                    else if(array['fld_option']=='0'){
                        html=html+'<a class="hide operation"  id='+array['fld_rank']+' onclick="show('+array['fld_id']+');" href="#"> - [Show]</a>';
                    }
                    html=html+'</td></tr>';
                    
                });
                $("#auto").html(html);
                $("#auto").css('opacity','1');
            }); }
            else alert("Page on the top.");
        }
        
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
        
        function movedown(rank){
        var address = base_url+"admin/page_rank/move_downs/"+rank;
        var max=get_max_rank();
        if(rank==max){
            alert('Page is at last of the list.');
            }
            else {
                $("#auto").css('opacity','0.3');
                //var htmls = '<h2 Style="color:#0A80E5; width:150px; font-size:25px; font-weight:bold; margin:0 auto; margin-top:100px;">Please Wait</h2>';
                //$("#auto").html(htmls);
                eraseCache();
                $.getJSON(address,{ajax:1},function(data){
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_rank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    
                    if(array['fld_rank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_rank']+' onclick="movedown('+array['fld_rank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_rank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_rank']+' onclick="moveup('+array['fld_rank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a> </td></tr>';
                });
                $("#auto").html(html);
                $(".wait").html('');
                $("#auto").css('opacity','1');
            }); }
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

function show(id){
    var address = base_url+"admin/page_rank/show/"+id;
     var max=get_max_rank();
    $("#auto").css('opacity','0.3');
    $.getJSON(address,{ajax:1},function(data){
        alert(address)
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_rank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    
                    if(array['fld_rank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_rank']+' onclick="movedown('+array['fld_rank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_rank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_rank']+' onclick="moveup('+array['fld_rank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a>'
                    if(array['fld_option']=='1'){
                        html=html+'<a class="show operation"  id='+array['fld_rank']+' onclick="hide('+array['fld_id']+');" href="#"> - [Hide]</a>';
                    }
                    else if(array['fld_option']=='0'){
                        html=html+'<a class="hide operation"  id='+array['fld_rank']+' onclick="show('+array['fld_id']+');" href="#"> - [Show]</a>';
                    }
                    html=html+'</td></tr>';
                    
                });
                $("#auto").html(html);
                $("#auto").css('opacity','1');
            });
}

function hide(id){
    var address = base_url+"admin/page_rank/hide/"+id;
     var max=get_max_rank();
    $("#auto").css('opacity','0.3');
    $.getJSON(address,{ajax:1},function(data){
        alert(address)
                var html = '';
                $.each(data, function(index, array) {
                    html = html +'<tr><td width="20%">'+array['fld_rank']+'</td>';
                    html = html +'<td width="20%">'+array['fld_id']+'</td>';
                    html = html +'<td width="30%">'+array['fld_page']+'</td><td width="30%">';
                    
                    if(array['fld_rank']!==max){
                        html = html +'<a class="ups operation"  id='+array['fld_rank']+' onclick="movedown('+array['fld_rank']+');" href="#">';
                    }
                    html = html +'[Move Down]</a> - '
                    if(array['fld_rank']!=="1"){
                        html = html +'  <a class="ups operation"  id='+array['fld_rank']+' onclick="moveup('+array['fld_rank']+');" href="#">'
                    }
                    html=html + '[Move Up]</a>'
                    if(array['fld_option']=='1'){
                        html=html+'<a class="show operation"  id='+array['fld_rank']+' onclick="hide('+array['fld_id']+');" href="#"> - [Hide]</a>';
                    }
                    else if(array['fld_option']=='0'){
                        html=html+'<a class="hide operation"  id='+array['fld_rank']+' onclick="show('+array['fld_id']+');" href="#"> - [Show]</a>';
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
            <div class="operation">Page Rank Operations</div>
        </div>
        <div style="margin-left:20px;margin-top:20px;">
            1. <a class="operation"  href="<?php echo base_url(); ?>admin/page_rank/manage_header">Manage Header Menus</a><br><br>
            2. <a class="operation"   href="<?php echo base_url(); ?>admin/page_rank/manage_footer">Manage Footer Menus</a>
        </div>
    </div>
    
</div>

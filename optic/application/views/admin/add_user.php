<div class="container">
    <?php echo $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/user/index">View </a></div>
            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/user/insert">Insert</a></div>
        </div>
        <div class="clear"></div>
        <form id="frm_create_user" name="frm_create_user" method="post" action="<?php echo base_url();?>admin/user/create" >
            <div>Please fill the form</div>
            <div class="clear"></div>
            <div class="label">Name</div>
            <div class="clear"></div>
            <div><input type="text" class="input" id="name" name="name" maxlength="30" value=""></div>
            <div class="label">Username</div>
            <div class="clear"></div>
            <div><input type="text" class="input" id="username" name="username" maxlength="30" value=""></div>
            <div class="clear"></div>
            <div class="label">Password</div>
            <div class="clear"></div>
            <div><input type="password" class="input" id="password" name="password" maxlength="30" value=""></div>
            <div class="clear"></div>
            <div class="label">Email</div>
            <div class="clear"></div>
            <div><input type="text" class="input" id="email" name="email" maxlength="30" value=""></div>
            <div class="clear"></div>
            <div class="label">Role</div>
            <div class="clear"></div>
            <div>
                <select name="role">
                    <option>Select Role</option>
                     <?php foreach($roles->result() as $role):?>
                        <option value="<?php echo $role->fld_id;?>"><?php echo $role->fld_role;?></option>
                     <?php endforeach;?>
                </select>
            </div>
            <div class="clear"></div>
            <div><input type="submit" class="submit" value="Create User"></div>
            
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#frm_create_user').validate({
        rules:{

            name:{
                required:true   
            },
            username:{
                required:true   
            },
            password:{
                required:true   
            },
            email:{
                required:true,
                email:true
            }
                      
        },
        messages:{

            name:{
                required:"Please enter name."   
            },
            username:{
                required:"Please enter username."   
            },
            password:{
                required:"Please enter password."   
            },
            email:{
                required:"Please enter email.",
                email:"Please enter valid email."
             }
            
        }
//        errorPlacement:function(error,element)
//        {
//            if(element.attr("name") == "fld_username") {error.appendTo('#username');$('#username').css('display','block');}
//            if(element.attr("name") == "fld_password") {error.appendTo('#password');$('#password').css('display','block');}
//        }
    });
   
});    

</script>
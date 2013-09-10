<style>
#container{
    width:900px;
    margin:100px auto;
    height:300px;
    box-shadow:3px 3px 3px 3px #ccc;
}
#mail-header{
    width:100%;
    height:100px;
    background: #ccc;
}
#mail-contents{
     width:100%;
     height:200px;
     padding: 5px;
    
}
</style>
<div id="container">
    <div id="mail-header">
        
    </div>
    <div id="mail-contents">
       <p>Hello {username},</p>
       <br/>
       <p>The policy of giving a user his/her password is not a good practice because one might lose confidential information.So,keeping in mind the security of our user data, we are providing you a link so that you can reset your password.
       </p>
       <br/>
       <?php
        $params = '?id={id}&reset_token={reset_token}';
        ?>
       <p>
           <a target="_blank" href="<?php echo base_url().'user/forgot_password/ResetPassword/'.$params;?>">Please click here to reset your password.</a>
       </p>
            
    </div>
</div>
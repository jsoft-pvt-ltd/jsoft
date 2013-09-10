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
        <?php
        $params = '?id={id}&confirmKey={key}';
        ?>
        <p>Hello {username},</p>
        <a target="_blank" href="<?php echo base_url().'user/login/ActivateAccount/'.$params;?>">Please click on this link to activate your account</a>
        
    </div>
</div>
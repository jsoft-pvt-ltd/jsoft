<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo $descriptions->fld_name;?> | OpticStoreOnline
        </title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/global.css';?>">
        <style>
            body{margin:0;padding:0;}
            div.logo{border-bottom: 1px solid #366229;width:495px;margin-bottom:15px}
            div.logo>img{margin:5px;}
            div.wrapper{width:495px;margin:0 auto;padding:0;border:none;}
            div.container{margin:0 10px;}
            div.container > .title{border-top: 1px solid #CCCCCC;margin-top: 5px;}
            div.amount1{border-bottom: 1px solid #ccc;padding-bottom: 5px;margin-bottom:5px;}
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="logo left">
                <img src="<?php echo base_url().'images/logo.png'?>" alt="Opticstoreonline logo"/>
            </div>
            <div class="container">
                <h1><?php echo ucfirst($type);?> Description</h1>
                <div class="title">
                    <h2><?php echo $descriptions->fld_name;?></h2>
                </div>
                <div class="amount1">
                    Price: $ <?php echo $descriptions->fld_price;?>
                </div>
                <div class="attributes">
                    
                </div>
                <div class="description">
                    <p>
                        <?php echo $descriptions->fld_description;?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>

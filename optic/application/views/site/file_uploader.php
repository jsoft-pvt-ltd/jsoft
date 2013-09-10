<html>
    <head>
        <title>Upload Prescription</title>
        <style>
            body{
                font-family: Open sans;
                font-size: 14px;
                
            }
            label.error{
        background: -moz-linear-gradient(-45deg, rgba(76,76,76,0.45) 0%, rgba(89,89,89,0.45) 12%, rgba(102,102,102,0.45) 25%, rgba(71,71,71,0.45) 39%, rgba(44,44,44,0.45) 50%, rgba(0,0,0,0.45) 51%, rgba(17,17,17,0.45) 60%, rgba(43,43,43,0.45) 76%, rgba(28,28,28,0.45) 91%, rgba(19,19,19,0.45) 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(76,76,76,0.45)), color-stop(12%,rgba(89,89,89,0.45)), color-stop(25%,rgba(102,102,102,0.45)), color-stop(39%,rgba(71,71,71,0.45)), color-stop(50%,rgba(44,44,44,0.45)), color-stop(51%,rgba(0,0,0,0.45)), color-stop(60%,rgba(17,17,17,0.45)), color-stop(76%,rgba(43,43,43,0.45)), color-stop(91%,rgba(28,28,28,0.45)), color-stop(100%,rgba(19,19,19,0.45))); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(-45deg, rgba(76,76,76,0.45) 0%,rgba(89,89,89,0.45) 12%,rgba(102,102,102,0.45) 25%,rgba(71,71,71,0.45) 39%,rgba(44,44,44,0.45) 50%,rgba(0,0,0,0.45) 51%,rgba(17,17,17,0.45) 60%,rgba(43,43,43,0.45) 76%,rgba(28,28,28,0.45) 91%,rgba(19,19,19,0.45) 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(-45deg, rgba(76,76,76,0.45) 0%,rgba(89,89,89,0.45) 12%,rgba(102,102,102,0.45) 25%,rgba(71,71,71,0.45) 39%,rgba(44,44,44,0.45) 50%,rgba(0,0,0,0.45) 51%,rgba(17,17,17,0.45) 60%,rgba(43,43,43,0.45) 76%,rgba(28,28,28,0.45) 91%,rgba(19,19,19,0.45) 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(-45deg, rgba(76,76,76,0.45) 0%,rgba(89,89,89,0.45) 12%,rgba(102,102,102,0.45) 25%,rgba(71,71,71,0.45) 39%,rgba(44,44,44,0.45) 50%,rgba(0,0,0,0.45) 51%,rgba(17,17,17,0.45) 60%,rgba(43,43,43,0.45) 76%,rgba(28,28,28,0.45) 91%,rgba(19,19,19,0.45) 100%); /* IE10+ */
        background: linear-gradient(135deg, rgba(76,76,76,0.45) 0%,rgba(89,89,89,0.45) 12%,rgba(102,102,102,0.45) 25%,rgba(71,71,71,0.45) 39%,rgba(44,44,44,0.45) 50%,rgba(0,0,0,0.45) 51%,rgba(17,17,17,0.45) 60%,rgba(43,43,43,0.45) 76%,rgba(28,28,28,0.45) 91%,rgba(19,19,19,0.45) 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#734c4c4c', endColorstr='#73131313',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        border: 1px solid #FFFFFF;
        color: #FF0000;
        margin-left: -219px;
        margin-top: 25px;
        padding: 0 10px;
        position: absolute;
    }
        </style>
        <script type="text/javascript" src="<?php echo base_url().'js/jquery.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
        <script>
            $(document).ready(function(){
                $('#frm_prescription_upload').validate({
                    rules:{
                        prescription_upload:{
                            required:true
                        }
                    },
                    messages:{
                        prescription_upload:{
                            required:"Please upload a file."
                        }            
                    }
                });

            });
        </script>
    </head>
    <body>
        <?php 
            if(isset($presc_name)){
                echo "Your prescription has been uploaded successfully<br/>";
                echo "Your can proceed further now.<br/>";
                echo '<a href="javascript:void(0)" onclick="reupload_presc();" class="btn">Re-Upload Prescription</a>';
                $this->session->set_userdata('prescription','prescriptions/'.date('Y').'/'.date('m').'/'.date('d').'/'.$presc_name);
                $this->session->set_userdata('type','upload');
        ?>
        <script>
            window.parent.test = '<?php echo $presc_name?>';
        </script>
        <?php
            }
            else{
                if(isset($msg) && $msg!=""){
                    echo $msg;
                    $msg='';
                }
        ?>      
        <form name="frm_prescription_upload" id="frm_prescription_upload" method="post" action="<?php echo base_url().'site/cart_steps/file_uploader'?>" enctype="multipart/form-data"/>
            Upload your prescription: <input type="file" id="prescription_upload" name="prescription_upload"/>
            <input type="submit" value="Done" class="btn"/>
        </form>
        <p><b>Note: </b> .doc, .docx, .pdf, & Images only supported;</p><br/>
        <?php };?>
    </body>
</html>
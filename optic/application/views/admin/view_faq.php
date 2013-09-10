<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        <div class="operations">
            <div class="operation">FAQ's</div>
        </div>
        <div style="padding:5px;border:1px solid #f0f0f0;">
            <a class="operation" href="<?php echo base_url();?>admin/faq/faqtype">[ FAQ Section ]</a>
            <a class="operation" href="<?php echo base_url();?>admin/faq/addFAQ">[ Add FAQ's ]</a>
        </div>
<table width="100%">
    <tr>
        <td width="3%"><b>Sn.</b></td>
        <td width="15%"><b>Faq Section</b></td>
        <td width="30%"><b>Question</b></td>
        <td width="40%"><b>Description</b></td>
        <td width="15%"><b>Controllers</b></td>
    </tr>
<?php $count=1; foreach($faqs->result() as $faq):?>
    
    <tr id="iaf<? echo $faq->fld_id;?>">
        <td style="vertical-align:top;"><?php echo $count.'.'; $count++; ?></td>
        <?php $this->load->helper('admin/faq_helper');$faqtype = which_faqtype($faq->fld_faqtype);?>
        <td style="vertical-align:top;"><?php if(!empty($faqtype)):?><?php echo $faqtype->fld_faqtype;?><?php endif;?></td>
        <td style="vertical-align:top;">
            <?php if(strlen($faq->fld_question)>100){
                                    echo substr($faq->fld_question,0,100).'. . .';
                  }else{
                      echo $faq->fld_question;
                  } 
                                
            ?>
        </td>
        <td style="vertical-align:top;">
            <?php if(strlen($faq->fld_description)>100){
                                    echo substr($faq->fld_description,0,100).'. . .';
                  }else{
                      echo $faq->fld_description;
                  } 
                                
            ?>
        <td style="vertical-align:top;">
            <a class="operation" href="<?php echo base_url().'admin/faq/update/'.$faq->fld_id;?>">[ Edit ]</a>
            <a class="operation" href="<?php echo base_url().'admin/faq/DeleteIAF/'.$faq->fld_id;?>">[ Delete ]</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
       <?php  echo $this->pagination->create_links();?>
    </div>
</div>

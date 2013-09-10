<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/site/help.css">
<div class="wrapper">
    <div class="left_section">
        <!--<div class="icon_holder">
            <img src="<?php echo base_url();?>images/qna_icon.jpg" width="50%" height="65px;">
        </div>-->
        <h3>Sections</h3>
        <div class="separator"></div>
        <ul>
            <?php $first = 0;?>
            <?php foreach($sections->result() as $section):?>
                <?php if($first==0):?>
                    <?php $first = $section->fld_id;?>
                    <li class="active" onclick="help_qna(this,<?php echo $section->fld_id;?>);"><?php echo $section->fld_faqtype;?></li>
                <?php else:?>
                    <li onclick="help_qna(this,<?php echo $section->fld_id;?>);"><?php echo $section->fld_faqtype;?></li>
                <?php endif;?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="right_section">
        <!--<h3>Buying Eyeglasses Online Help</h3>
        <div class="help_form">
            <form>
                <input type="text" name="help_search" size="95" style="padding:5px;"></td>
                <input type="submit" class="btn_green" value="Search">
            </form>
        </div>-->
        <h3>Helps</h3>
        <div class="separator"></div>
        <?php $this->load->helper('admin/faq_helper');$qnas = help_qnas($first);?>
        <div class="help_container">
            <table width="100%" cellpadding="0" cellspacing="0">
                <?php $fans = 0;?>
                <?php foreach($qnas->result() as $qna):?>
                <tr style="cursor:pointer;color:#0A80E5;" onclick="toggle_them(this);">
                    <td>
                        <?php echo $qna->fld_question;?>
                    </td>
                </tr>
                <?php if($fans==0):?>
                <tr>
                <?php else:?>        
                <tr style="display: none;">
                <?php endif;?>
                    <td class="description">
                        <?php echo $qna->fld_description;?>
                        <div class="separator"></div>
                    </td>
                </tr>
                <?php $fans++;?>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div>
<script>
function toggle_them(element)
{
    $(element).next().toggle(1000);
}
function help_qna(element,section_id)
{
    $('.left_section ul li').removeClass('active');
    $(element).addClass('active');
    $.ajax({
            type: "POST",
            url: base_url+'admin/faq/qna_of_section/'+section_id,
            async: "FALSE",
            success: function(msg){
                $('.help_container').html(msg);
            }
         });
}
</script>


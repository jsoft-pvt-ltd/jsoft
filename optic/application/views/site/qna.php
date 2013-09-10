<table width="100%" cellpadding="0" cellspacing="0">
    <?php $fans = 0;?>
    <?php if($qnas->num_rows()==0):?>
    
        Sorry.No results found
        
    <?php else:?>
        
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
        
    <?php endif;?>
</table>

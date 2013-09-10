<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php //print_r($this->session->all_userdata());?>
        Welcome,<?php echo $this->session->userdata('admin_username');?>!
    </div>
</div>

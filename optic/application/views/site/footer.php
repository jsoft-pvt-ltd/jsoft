<div class="footer">
    <div class="social_n_info">
        <div class="partition_end border_right">
            <h1>Be In Touch</h1>
            <div class="be_in_touch margin_top">
                <img src="<?php echo base_url().'images/fb.jpg'?>" class="img_link"/>
                <img src="<?php echo base_url().'images/tw.jpg'?>" class="img_link margin_left3"/>
                <img src="<?php echo base_url().'images/wp.jpg'?>" class="img_link margin_left3"/>
                <!--<img src="<?php echo base_url().'images/rss.jpg'?>" class="img_link"/>-->
                <img src="<?php echo base_url().'images/live_chat.jpg'?>" class="img_link margin_left3"/>
            </div>
        </div>
        <div class="margin_left partition_center border_right">
            <h1>Frequently Asked Questions</h1>
            <div class="faq margin_top">
                <p>How to order?</p>
                <p>How to enter prescription?</p>
                <p>What is tinted lenses?</p>
                <p>How to select correct glasses?</p>
                <p class="right margin_right"><a href="javascript:void(0);">More &raquo;</a></p>
            </div>
        </div>
        <div class="margin_left partition_end">
            <h1>Contact Us</h1>
            <div class="contact_us margin_top">
                <p>203-989-0261</p>
                <p>service@opticstoreonline.com</p>
                <p>2366 Commonwealth ave, Apt 2-3</p>
                <p>Newton, Ma 02466</p>
            </div>
        </div>
    </div>
    <div class="payment_methods">
        <div class="left">
            <img src="<?php echo base_url().'images/verified.jpg'?>" alt="go_daddy_verification" style="height:36px;"/>
        </div>
        <div class="card right">
            <img src="<?php echo base_url().'images/paypal.jpg'?>" width="60" alt="paypal"/>
            <img src="<?php echo base_url().'images/american-express.jpg'?>" width="60" alt="american_express"/>
            <img src="<?php echo base_url().'images/mastercard.jpg'?>" width="60" alt="master_card"/>
            <img src="<?php echo base_url().'images/visa.jpg'?>" width="60" alt="visa"/>
            <img src="<?php echo base_url().'images/discover.jpg'?>" width="60" alt="discover"/>
        </div>
    </div>
    <div class="footer_menu">
        <div class="logo"><img src="<?php echo base_url().'images/logo_footer.png'?>" alt="optic store online logo"/></div>
        <?php 
            $this->load->helper('nav_menu_helper');
            $footers = get_footer_menu();
        ?>
        <div class="navigation">
            <ul class="nav_footer_ul">
                <?php foreach ($footers as $footer): 
                    if($footer->fld_type=='1'):?>
                    <li class="nav_footer_li"><a href="#"><?php echo $footer->fld_page ?></a></li>
                <?php endif;
                    if($footer->fld_type=='2'): ?>
                    <li class="nav_footer_li"><a href="<?php echo prep_url($footer->fld_url); ?>"><?php echo $footer->fld_page; ?></a></li>
                <?php endif; endforeach; ?>
            </ul>
            <p>
                Use of this site is subject to express terms of use. By using this site, you signify that you agree to be bound by these Universal Terms of Service<br/>
                Legal Privacy Policy<br/>
                &COPY; Copyright 2012-2013
            </p>
        </div>
    </div>
</div>
<?php if(isset($msg))echo $msg;?>
</body>
</html>

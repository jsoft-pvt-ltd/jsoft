<link rel='stylesheet' type='text/css' href="<?php echo base_url().'css/admin/contact_lens.css'?>"/>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if(isset($msg1)):?>
        <div class="flash_msg">
            <?php echo $msg1;?>
        </div>
        <?php endif;?>
        <div class="operations">
            <div class="operation">
                Fill the form below
            </div>
        </div>
        <div class="lens_input">
            <form name="frm_lens_power" id="frm_lens_power" method="post" action="<?php echo base_url().'admin/contact_lens/power/'.$lens_id;?>" enctype="multipart/form-data" target="power">
                <div class="input_holder">
                    <div class="label">Power</div>
                    <div class="_input" style="margin-top:5px;">
                        <input type="text" value="" name="power" id="power" maxlength="40"/>
                        <input type="submit" name="submit_power" value="Submit"/>
                    </div>
                </div>
            </form>
            <iframe id="power" name="power" src="<?php echo base_url().'admin/contact_lens/power/'.$lens_id;?>" class="power" scrolling="no">
    </iframe>
            <form name="frm_lens_axis" id="frm_lens_axis" method="post" action="<?php echo base_url().'admin/contact_lens/axis/'.$lens_id;?>" enctype="multipart/form-data" target="axis">
                <div class="input_holder">
                    <div class="label">Axis</div>
                    <div class="_input" style="margin-top:5px;">
                        <input type="text" value="" name="axis" id="axis" maxlength="40"/>
                        <input type="submit" name="submit_axis" value="Submit"/>
                    </div>
                </div>
            </form>
    <iframe id="axis" name="axis" src="<?php echo base_url().'admin/contact_lens/axis/'.$lens_id;?>" class="power" scrolling="no">
    </iframe>
            <form name="frm_cyl" id="frm_cyl" method="post" action="<?php echo base_url().'admin/contact_lens/cyl/'.$lens_id;?>" enctype="multipart/form-data" target="cyl">
                <div class="input_holder">
                    <div class="label">Cylinder</div>
                    <div class="_input" style="margin-top:5px;">
                        <input type="text" value="" name="cylinder" id="cylinder" maxlength="40"/>
                        <input type="submit" name="submit_cyl" value="Submit"/>
                    </div>
                </div>
            </form>
    <iframe id="cyl" name="cyl" src="<?php echo base_url().'admin/contact_lens/cyl/'.$lens_id;?>" class="power" scrolling="no">
    </iframe>
            <form name="frm_lens_diameter" id="frm_lens_diameter" method="post" action="<?php echo base_url().'admin/contact_lens/diameter/'.$lens_id;?>" enctype="multipart/form-data" target="diameter">
                <div class="input_holder">
                    <div class="label">Diameter</div>
                    <div class="_input" style="margin-top:5px;">
                        <input type="text" value="" name="diameter" id="diameter" maxlength="40"/>
                        <input type="submit" name="submit_diameter" value="Submit"/>
                    </div>
                </div>
            </form>
    <iframe id="diameter" name="diameter" src="<?php echo base_url().'admin/contact_lens/diameter/'.$lens_id;?>" class="power" scrolling="no">
    </iframe>
            <form name="frm_lens_base_curve" id="frm_lens_base_curve" method="post" action="<?php echo base_url().'admin/contact_lens/base_curve/'.$lens_id;?>" enctype="multipart/form-data" target="base_curve">
                <div class="input_holder">
                    <div class="label">Base Curve</div>
                    <div class="_input" style="margin-top:5px;">
                        <input type="text" value="" name="base_curve" id="base_curve" maxlength="40"/>
                        <input type="submit" name="submit_base_curve" value="Submit"/>
                    </div>
                </div>
            </form>
    <iframe id="base_curve" name="base_curve" src="<?php echo base_url().'admin/contact_lens/base_curve/'.$lens_id;?>" class="power" scrolling="no">
    </iframe>
    
    <form name="frm_sph" id="frm_sph" method="post" action="<?php echo base_url().'admin/contact_lens/sph/'.$lens_id;?>" enctype="multipart/form-data" target="sph">
                <div class="input_holder">
                    <div class="label">Spherical Value</div>
                    <div class="_input" style="margin-top:5px;">
                        <input type="text" value="" name="sph" id="sph" maxlength="40"/>
                        <input type="submit" name="submit_sph" value="Submit"/>
                    </div>
                </div>
            </form>
    <iframe id="sph" name="sph" src="<?php echo base_url().'admin/contact_lens/sph/'.$lens_id;?>" class="power" scrolling="no">
    </iframe>
        </div>
    </div>
</div>

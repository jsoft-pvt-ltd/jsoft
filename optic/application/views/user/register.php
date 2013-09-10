<?php $this->load->view('site/header');?>
<link rel="stylesheet" href="<?php echo base_url();?>css/user/register.css" type="text/css">
<div class="wrapper">
    <div class="grid">
        <div id="sliding_div_title" class="sliding_div_title">
            <h1>New To Optic Store Online? Take a moment to register for free!</h1>
            <p>By creating an account with OpticStoreOnline.com it will not only allow you to shop faster but get many other advantages like:</p>
<!--                <p><input type="checkbox" disabled="disabled">Hold your favorite glasses on hold for 48 hrs
                <input type="checkbox" disabled="disabled">Add multiple prescriptions of your family members<br/>
                <input type="checkbox" disabled="disabled">Check your order status
                <input type="checkbox" disabled="disabled">Obtain history of your order purchased
                <input type="checkbox" disabled="disabled">Get 5% off on all orders</p>-->
        </div>
        <div class="hr">
            <hr/>
        </div>
        <div class="sliding_div" id="sliding_div_content">
            <h2>Register</h2>
            <?php if(isset($error_message)):?><div class="error_div"><?php echo $error_message;?></div><?php endif;?>
            <form id="frm_register" name="frm_register" action="<?php echo base_url()?>user/register" method="post">
                <div class="label_input">
                    <div class="label"><label>Username</label></div>
                    <div class="input"><input type="text" id="fld_username" name="fld_username" class="input" maxlength="30" value="<?php if(isset($user_post['fld_username'])) echo $user_post['fld_username'];?>"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Password</label></div>
                    <div class="input"><input type="password" id="fld_password" name="fld_password" class="input" maxlength="30" /></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Confirm Password</label></div>
                    <div class="input"><input type="password" id="fld_confirm_password" name="fld_confirm_password" class="input" maxlength="30"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>First Name</label></div>
                    <div class="input"><input type="text" id="fld_first_name" name="fld_first_name" class="input" maxlength="30" value="<?php if(isset($user_post['fld_first_name'])) echo $user_post['fld_first_name'];?>"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Last Name</label></div>
                    <div class="input"><input type="text" id="fld_last_name" name="fld_last_name" class="input" maxlength="30" value="<?php if(isset($user_post['fld_last_name'])) echo $user_post['fld_last_name'];?>"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Email</label></div>
                    <div class="input"><input type="text" id="fld_email" name="fld_email" class="input" maxlength="30" value="<?php if(isset($user_post['fld_email'])) echo $user_post['fld_email'];?>"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Country</label></div>
                    <div class="input">
                        <select class="input" id="fld_country" name="fld_country" style="margin: 5px 0 0;width: 180px;"> 
                            <option value="Afghanistan" >Afghanistan</option>
                            <option value="Albania" >Albania</option>
                            <option value="Algeria" >Algeria</option>
                            <option value="Andorra" >Andorra</option>
                            <option value="Antigua and Barbuda" >Antigua and Barbuda</option>
                            <option value="Argentina" >Argentina</option>
                            <option value="Armenia" >Armenia</option>
                            <option value="Australia" >Australia</option>
                            <option value="Austria" >Austria</option>
                            <option value="Azerbaijan" >Azerbaijan</option>
                            <option value="Bahamas" >Bahamas</option>
                            <option value="Bahrain" >Bahrain</option>
                            <option value="Bangladesh" >Bangladesh</option>
                            <option value="Barbados" >Barbados</option>
                            <option value="Belarus" >Belarus</option>
                            <option value="Belgium" >Belgium</option>
                            <option value="Belize" >Belize</option>
                            <option value="Benin" >Benin</option>
                            <option value="Bhutan" >Bhutan</option>
                            <option value="Bolivia" >Bolivia</option>
                            <option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
                            <option value="Botswana" >Botswana</option>
                            <option value="Brazil" >Brazil</option>
                            <option value="Brunei" >Brunei</option>
                            <option value="Bulgaria" >Bulgaria</option>
                            <option value="Burkina Faso" >Burkina Faso</option>
                            <option value="Burundi" >Burundi</option>
                            <option value="Cambodia" >Cambodia</option>
                            <option value="Cameroon" >Cameroon</option>
                            <option value="Canada" >Canada</option>
                            <option value="Cape Verde" >Cape Verde</option>
                            <option value="Central African Republic" >Central African Republic</option>
                            <option value="Chad" >Chad</option>
                            <option value="Chile" >Chile</option>
                            <option value="China" >China</option>
                            <option value="Colombia" >Colombia</option>
                            <option value="Comoros" >Comoros</option>
                            <option value="Congo" >Congo</option>
                            <option value="Costa Rica" >Costa Rica</option>
                            <option value="Côte d'Ivoire" >Côte d'Ivoire</option>
                            <option value="Croatia" >Croatia</option>
                            <option value="Cuba" >Cuba</option>
                            <option value="Cyprus" >Cyprus</option>
                            <option value="Czech Republic" >Czech Republic</option>
                            <option value="Denmark" >Denmark</option>
                            <option value="Djibouti" >Djibouti</option>
                            <option value="Dominica" >Dominica</option>
                            <option value="Dominican Republic" >Dominican Republic</option>
                            <option value="East Timor" >East Timor</option>
                            <option value="Ecuador" >Ecuador</option>
                            <option value="Egypt" >Egypt</option>
                            <option value="El Salvador" >El Salvador</option>
                            <option value="Equatorial Guinea" >Equatorial Guinea</option>
                            <option value="Eritrea" >Eritrea</option>
                            <option value="Estonia" >Estonia</option>
                            <option value="Ethiopia" >Ethiopia</option>
                            <option value="Fiji" >Fiji</option>
                            <option value="Finland" >Finland</option>
                            <option value="France" >France</option>
                            <option value="Gabon" >Gabon</option>
                            <option value="Gambia" >Gambia</option>
                            <option value="Georgia" >Georgia</option>
                            <option value="Germany" >Germany</option>
                            <option value="Ghana" >Ghana</option>
                            <option value="Greece" >Greece</option>
                            <option value="Grenada" >Grenada</option>
                            <option value="Guatemala" >Guatemala</option>
                            <option value="Guinea" >Guinea</option>
                            <option value="Guinea-Bissau" >Guinea-Bissau</option>
                            <option value="Guyana" >Guyana</option>
                            <option value="Haiti" >Haiti</option>
                            <option value="Honduras" >Honduras</option>
                            <option value="Hong Kong" >Hong Kong</option>
                            <option value="Hungary" >Hungary</option>
                            <option value="Iceland" >Iceland</option>
                            <option value="India" >India</option>
                            <option value="Indonesia" >Indonesia</option>
                            <option value="Iran" >Iran</option>
                            <option value="Iraq" >Iraq</option>
                            <option value="Ireland" >Ireland</option>
                            <option value="Israel" >Israel</option>
                            <option value="Italy" >Italy</option>
                            <option value="Jamaica" >Jamaica</option>
                            <option value="Japan" >Japan</option>
                            <option value="Jordan" >Jordan</option>
                            <option value="Kazakhstan" >Kazakhstan</option>
                            <option value="Kenya" >Kenya</option>
                            <option value="Kiribati" >Kiribati</option>
                            <option value="North Korea" >North Korea</option>
                            <option value="South Korea" >South Korea</option>
                            <option value="Kuwait" >Kuwait</option>
                            <option value="Kyrgyzstan" >Kyrgyzstan</option>
                            <option value="Laos" >Laos</option>
                            <option value="Latvia" >Latvia</option>
                            <option value="Lebanon" >Lebanon</option>
                            <option value="Lesotho" >Lesotho</option>
                            <option value="Liberia" >Liberia</option>
                            <option value="Libya" >Libya</option>
                            <option value="Liechtenstein" >Liechtenstein</option>
                            <option value="Lithuania" >Lithuania</option>
                            <option value="Luxembourg" >Luxembourg</option>
                            <option value="Macedonia" >Macedonia</option>
                            <option value="Madagascar" >Madagascar</option>
                            <option value="Malawi" >Malawi</option>
                            <option value="Malaysia" >Malaysia</option>
                            <option value="Maldives" >Maldives</option>
                            <option value="Mali" >Mali</option>
                            <option value="Malta" >Malta</option>
                            <option value="Marshall Islands" >Marshall Islands</option>
                            <option value="Mauritania" >Mauritania</option>
                            <option value="Mauritius" >Mauritius</option>
                            <option value="Mexico" >Mexico</option>
                            <option value="Micronesia" >Micronesia</option>
                            <option value="Moldova" >Moldova</option>
                            <option value="Monaco" >Monaco</option>
                            <option value="Mongolia" >Mongolia</option>
                            <option value="Montenegro" >Montenegro</option>
                            <option value="Morocco" >Morocco</option>
                            <option value="Mozambique" >Mozambique</option>
                            <option value="Myanmar" >Myanmar</option>
                            <option value="Namibia" >Namibia</option>
                            <option value="Nauru" >Nauru</option>
                            <option value="Nepal" >Nepal</option>
                            <option value="Netherlands" >Netherlands</option>
                            <option value="New Zealand" >New Zealand</option>
                            <option value="Nicaragua" >Nicaragua</option>
                            <option value="Niger" >Niger</option>
                            <option value="Nigeria" >Nigeria</option>
                            <option value="Norway" >Norway</option>
                            <option value="Oman" >Oman</option>
                            <option value="Pakistan" >Pakistan</option>
                            <option value="Palau" >Palau</option>
                            <option value="Panama" >Panama</option>
                            <option value="Papua New Guinea" >Papua New Guinea</option>
                            <option value="Paraguay" >Paraguay</option>
                            <option value="Peru" >Peru</option>
                            <option value="Philippines" >Philippines</option>
                            <option value="Poland" >Poland</option>
                            <option value="Portugal" >Portugal</option>
                            <option value="Puerto Rico" >Puerto Rico</option>
                            <option value="Qatar" >Qatar</option>
                            <option value="Romania" >Romania</option>
                            <option value="Russia" >Russia</option>
                            <option value="Rwanda" >Rwanda</option>
                            <option value="Saint Kitts and Nevis" >Saint Kitts and Nevis</option>
                            <option value="Saint Lucia" >Saint Lucia</option>
                            <option value="Saint Vincent and the Grenadines" >Saint Vincent and the Grenadines</option>
                            <option value="Samoa" >Samoa</option>
                            <option value="San Marino" >San Marino</option>
                            <option value="Sao Tome and Principe" >Sao Tome and Principe</option>
                            <option value="Saudi Arabia" >Saudi Arabia</option>
                            <option value="Senegal" >Senegal</option>
                            <option value="Serbia and Montenegro" >Serbia and Montenegro</option>
                            <option value="Seychelles" >Seychelles</option>
                            <option value="Sierra Leone" >Sierra Leone</option>
                            <option value="Singapore" >Singapore</option>
                            <option value="Slovakia" >Slovakia</option>
                            <option value="Slovenia" >Slovenia</option>
                            <option value="Solomon Islands" >Solomon Islands</option>
                            <option value="Somalia" >Somalia</option>
                            <option value="South Africa" >South Africa</option>
                            <option value="Spain" >Spain</option>
                            <option value="Sri Lanka" >Sri Lanka</option>
                            <option value="Sudan" >Sudan</option>
                            <option value="Suriname" >Suriname</option>
                            <option value="Swaziland" >Swaziland</option>
                            <option value="Sweden" >Sweden</option>
                            <option value="Switzerland" >Switzerland</option>
                            <option value="Syria" >Syria</option>
                            <option value="Taiwan" >Taiwan</option>
                            <option value="Tajikistan" >Tajikistan</option>
                            <option value="Tanzania" >Tanzania</option>
                            <option value="Thailand" >Thailand</option>
                            <option value="Togo" >Togo</option>
                            <option value="Tonga" >Tonga</option>
                            <option value="Trinidad and Tobago" >Trinidad and Tobago</option>
                            <option value="Tunisia" >Tunisia</option>
                            <option value="Turkey" >Turkey</option>
                            <option value="Turkmenistan" >Turkmenistan</option>
                            <option value="Tuvalu" >Tuvalu</option>
                            <option value="Uganda" >Uganda</option>
                            <option value="Ukraine" >Ukraine</option>
                            <option value="United Arab Emirates" >United Arab Emirates</option>
                            <option value="United Kingdom" >United Kingdom</option>
                            <option value="United States" >United States</option>
                            <option value="Uruguay" >Uruguay</option>
                            <option value="Uzbekistan" >Uzbekistan</option>
                            <option value="Vanuatu" >Vanuatu</option>
                            <option value="Vatican City" >Vatican City</option>
                            <option value="Venezuela" >Venezuela</option>
                            <option value="Vietnam" >Vietnam</option>
                            <option value="Yemen" >Yemen</option>
                            <option value="Zambia" >Zambia</option>
                            <option value="Zimbabwe" >Zimbabwe</option>
                        </select>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>State</label></div>
                    <div class="input"><input type="text" id="fld_state" name="fld_state" class="input" maxlength="30" value="<?php if(isset($user_post['fld_state'])) echo $user_post['fld_state'];?>"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>City</label></div>
                    <div class="input"><input type="text" id="fld_city" name="fld_city" class="input" maxlength="30" value="<?php if(isset($user_post['fld_city'])) echo $user_post['fld_city'];?>"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Contact No</label></div>
                    <div><input type="text" id="fld_contact_no" name="fld_contact_no" class="input" maxlength="30" value="<?php if(isset($user_post['fld_contact_no'])) echo $user_post['fld_contact_no'];?>"/></div>
                </div>
                <div class="clear"></div>
                <div class="label_input">
                    <div class="label"><label>Myself</label></div>
                    <div class="input"><textarea name="fld_myself" id="fld_myself" class="input" rows="3" cols="18" style="font-size: 14px;"><?php if(isset($user_post['fld_myself'])) echo $user_post['fld_myself'];?></textarea></div>
                </div>
                <div class="clear"></div>
                <div class="label_input margin_top">
                    <div class="input"><input type="submit" id="sign_in_submit" class="submit btn" value="Register"></div>
                </div>
                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
<script>
function maintain()
{
    var slide_flag = "<?php if(isset($error_message)) echo $error_message;?>";
    var container_width = $('.wrapper').width();
    var half_container_width = container_width/2;
    var sliding_div_width = $('.sliding_div').width();
    var half_sliding_div_width = sliding_div_width/2;
    var desired_left_margin = half_container_width-half_sliding_div_width;
    if(slide_flag=="")
    {
        var line = $('.sliding_div');
        var _line = $('.sliding_div_title');

        _line.animate({marginLeft:'0px'},500,function(){
            $('#sliding_div_title p').animate({'opacity':1},800);
            line.animate({marginLeft:desired_left_margin+'px'},800,function(){
                $('.sliding_div').css('opacity',1);
            });
        });
    }
    else
    {
         $(".sliding_div").css('margin-left',desired_left_margin+'px');
    }
            
}
$(document).ready(function(){
    maintain();
    $('#frm_register').validate({
        rules:{

            fld_username:{
                required:true   
            },
            fld_password:{
                required:true
            },
            fld_confirm_password:{
                required:true
            },
            fld_first_name:{
                required:true
            },
            fld_email:{
                required:true,
                email:true
                
            },
            fld_contact_no:{
                required:true
            }
            
        },
        messages:{

            fld_username:{
                required:"Please enter username."   
            },

            fld_password:{
                required:"please enter password."
            },
            fld_confirm_password:{
                required:"Please confirm password."
            },
            fld_first_name:{
                required:"Please enter first name."
            },
            fld_email:{
                required:"Please enter email.",
                email:"Please enter valid email."
            },
            fld_contact_no:{
                required:"Please enter contact number."
            }
            
        }                  
    });
});
$(window).resize(function(){
    maintain();
});
</script>
<?php if(isset($user_post['fld_country'])):?>
<script>
    var value = "<?php echo $user_post['fld_country'];?>";
    $("#fld_country option[value="+value+"]").prop("selected", true);
</script>  
<?php endif;?>
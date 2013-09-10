<link href="<?php echo base_url().'css/user/dashboard.css'?>" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/upload_presc.css">
<script type="text/javascript" src="<?php echo base_url();?>skin/js/jquery.validate_new.js"></script>
<script>var greater_power = 0;</script>
<script>var cart_total_items = <?php echo $this->cart->total_items();?></script>
<script src="<?php echo base_url().'js/site/prescription.js'?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>js/site/cart_steps.js" type="text/javascript" charset="utf-8"></script>
<div class="wrapper">
    <div class="left_div">
    <?php $this->load->view('user/left_panel');?>
    </div>
    <div class="right_div margin_top">
        <h1 class="margin_bottom">My Prescriptions</h1>
        <div class="hr"><hr/></div>
        <?php if(isset($msg))echo '<p style="color:#555">'.$msg.'</p>';?>
        <div class="prescriptions">
            <?php if($my_prescs->num_rows()==0):?>
                <p>No any prescription uploaded.</p>
            <?php else:?>
                <?php foreach($my_prescs->result() as $presc):?>
                    <?php if($presc->fld_prescription_path!=""):?>
                        Prescription of <u><?php echo ucfirst($presc->fld_patient_name);?></u>
                        <a href="<?php echo base_url().$presc->fld_prescription_path;?>" target="_blank">View File</a>
                        <div class="right">
                            <a href="javascript:void(0);" class="delete_presc" id="<?php echo $presc->fld_id;?>">Delete</a>
                        </div>
                        <div class="hr_normal"><hr/></div>
                    <?php else:?>
                        Prescription of <u><?php echo ucfirst($presc->fld_patient_name);?></u>
                        <div class="right">
                            <a href="javascript:void(0);" class="delete_presc" id="<?php echo $presc->fld_id;?>">Delete</a>
                        </div>
                        <a href="javascript:void(0);" class="view_presc">View This</a>
                        <table class="presc_tbl_user">
                            <tr>
                                <th class="presc_title">&nbsp;</th>
                                <th class="presc_title">SPH</th>
                                <th class="presc_title">CYL</th>
                                <th class="presc_title">Axis</th>
                                <th class="presc_title">Add</th>
                            </tr>
                            <tr>
                                <th>OD</th>
                                <td><?php echo $presc->fld_sph_od;?></td>
                                <td><?php echo $presc->fld_cyl_od;?></td>
                                <td><?php echo $presc->fld_axis_od;?></td>
                                <td><?php echo $presc->fld_add_od;?></td>
                            </tr>
                            <tr>
                                <th>OS</th>
                                <td><?php echo $presc->fld_sph_os;?></td>
                                <td><?php echo $presc->fld_cyl_os;?></td>
                                <td><?php echo $presc->fld_axis_os;?></td>
                                <td><?php echo $presc->fld_add_os;?></td>
                            </tr>
                            <tr>
                                <?php if($presc->fld_pd!=''):?>
                                <th>PD</th>
                                <td colspan="4"><?php echo $presc->fld_pd?></td>
                                <?php else:?>
                                <th>PD Right</th>
                                <td><?php echo $presc->fld_pd_right?></td>
                                <th>PD Left</th>
                                <td><?php echo $presc->fld_pd_left?></td>
                                <td>&nbsp;</td>
                                <?php endif;?>
                            </tr>
                            <tr>
                                <th>Remarks</th>
                                <td colspan="4"><?php echo $presc->fld_remarks?></td>
                            </tr>
                        </table>
                        <div class="hr_normal"><hr/></div>
                    <?php endif;?>                    
                <?php endforeach;?>
            <?php endif;?>
        </div>
        
        <div class="add_presc">
            <a href="javascript:void(0);" class="presc_detail" id="popup_presc_upload">Upload Prescription</a>
            <a href="javascript:void(0);" class="presc_detail" id="popup_presc_entry">Enter Prescription</a>
        </div>
        
        
        
        
        <div class="popup_presc_upload">
            <form name="frm_prescription_upload" id="frm_prescription_upload" method="post" action="<?php echo base_url().'user/my_prescription/presc_uploader'?>" enctype="multipart/form-data">
                <div class="presc_wrapper">
                    <div id="upload_prescription" class="upload_prescription">        
                        Patient Name<br/><input type="text" value="" name="patient_name" id="patient_name"/><br/>
                        Prescription<br/><input type="file" id="prescription_upload" name="prescription_upload"/>
                        <p style="line-height: 15px;" class="margin_top"><b>Note: </b> .doc, .docx, .pdf, & Images only supported;</p>
                    </div>
                    <div class="action_btn">
                        <input type="submit" value="Done" class="btn"/>
                        <input type="button" value="Cancel" class="btn" onclick="remove_popup('popup_presc_upload');"/> 
                    </div>
                </div>
            </form>
        </div>
        
        <script>
            $(document).ready(function(){
                $('#frm_prescription_upload').validate({
                    rules:{
                        patient_name:{
                            required:true
                        },
                        prescription_upload:{
                            required:true
                        }
                    },
                    messages:{
                        patient_name:{
                            required:"Please provide a patient name."
                        },
                        prescription_upload:{
                            required:"Please upload a file."
                        }            
                    }
                });

            });
        </script>
        
        
        <div class="popup_presc_entry">
            <div class="presc_wrapper">
                <div id="enter_presc">
                    <div class="presc_validation_error" style='color:#CF0000;'></div>
                    <table class="tbl_enter_prescription">
                        <tr>
                            <th class="presc_title">&nbsp;</th>
                            <th class="presc_title">SPH</th>
                            <th class="presc_title">CYL</th>
                            <th class="presc_title">Axis</th>
                            <th class="presc_title">Add</th>
                        </tr>
                        <tr>
                            <th>OD</th>
                            <td>
                                <select name="sph_od" id="sph_od">
                                    <option value="0">(SPH)none</option>
                                    <option value="-17" >-17.00</option>
                                    <option value="-16.75" >-16.75</option>
                                    <option value="-16.5" >-16.50</option>
                                    <option value="-16.25" >-16.25</option>
                                    <option value="-16" >-16.00</option>
                                    <option value="-15.75" >-15.75</option>
                                    <option value="-15.5" >-15.50</option>
                                    <option value="-15.25" >-15.25</option>
                                    <option value="-15" >-15.00</option>
                                    <option value="-14.75" >-14.75</option>
                                    <option value="-14.5" >-14.50</option>
                                    <option value="-14.25" >-14.25</option>
                                    <option value="-14" >-14.00</option>
                                    <option value="-13.75" >-13.75</option>
                                    <option value="-13.5" >-13.50</option>
                                    <option value="-13.25" >-13.25</option>
                                    <option value="-13" >-13.00</option>
                                    <option value="-12.75" >-12.75</option>
                                    <option value="-12.5" >-12.50</option>
                                    <option value="-12.25" >-12.25</option>
                                    <option value="-12" >-12.00</option>
                                    <option value="-11.75" >-11.75</option>
                                    <option value="-11.5" >-11.50</option>
                                    <option value="-11.25" >-11.25</option>
                                    <option value="-11" >-11.00</option>
                                    <option value="-10.75" >-10.75</option>
                                    <option value="-10.5" >-10.50</option>
                                    <option value="-10.25" >-10.25</option>
                                    <option value="-10" >-10.00</option>
                                    <option value="-9.75" >-9.75</option>
                                    <option value="-9.5" >-9.50</option>
                                    <option value="-9.25" >-9.25</option>
                                    <option value="-9" >-9.00</option>
                                    <option value="-8.75" >-8.75</option>
                                    <option value="-8.5" >-8.50</option>
                                    <option value="-8.25" >-8.25</option>
                                    <option value="-8" >-8.00</option>
                                    <option value="-7.75" >-7.75</option>
                                    <option value="-7.5" >-7.50</option>
                                    <option value="-7.25" >-7.25</option>
                                    <option value="-7" >-7.00</option>
                                    <option value="-6.75" >-6.75</option>
                                    <option value="-6.5" >-6.50</option>
                                    <option value="-6.25" >-6.25</option>
                                    <option value="-6" >-6.00</option>
                                    <option value="-5.75" >-5.75</option>
                                    <option value="-5.5" >-5.50</option>
                                    <option value="-5.25" >-5.25</option>
                                    <option value="-5" >-5.00</option>
                                    <option value="-4.75" >-4.75</option>
                                    <option value="-4.5" >-4.50</option>
                                    <option value="-4.25" >-4.25</option>
                                    <option value="-4" >-4.00</option>
                                    <option value="-3.75" >-3.75</option>
                                    <option value="-3.5" >-3.50</option>
                                    <option value="-3.25" >-3.25</option>
                                    <option value="-3" >-3.00</option>
                                    <option value="-2.75" >-2.75</option>
                                    <option value="-2.5" >-2.50</option>
                                    <option value="-2.25" >-2.25</option>
                                    <option value="-2" >-2.00</option>
                                    <option value="-1.75" >-1.75</option>
                                    <option value="-1.5" >-1.50</option>
                                    <option value="-1.25" >-1.25</option>
                                    <option value="-1" >-1.00</option>
                                    <option value="-0.75" >-0.75</option>
                                    <option value="-0.5" >-0.50</option>
                                    <option value="-0.25" >-0.25</option>
                                    <option value="0" selected="selected">0.00</option>
                                    <option value="SPH">SPH</option>
                                    <option value="PLANO">PLANO</option>
                                    <option value="+0.25" >+0.25</option>
                                    <option value="+0.5" >+0.50</option>
                                    <option value="+0.75" >+0.75</option>
                                    <option value="+1" >+1.00</option>
                                    <option value="+1.25" >+1.25</option>
                                    <option value="+1.5" >+1.50</option>
                                    <option value="+1.75" >+1.75</option>
                                    <option value="+2" >+2.00</option>
                                    <option value="+2.25" >+2.25</option>
                                    <option value="+2.5" >+2.50</option>
                                    <option value="+2.75" >+2.75</option>
                                    <option value="+3" >+3.00</option>
                                    <option value="+3.25" >+3.25</option>
                                    <option value="+3.5" >+3.50</option>
                                    <option value="+3.75" >+3.75</option>
                                    <option value="+4" >+4.00</option>
                                    <option value="+4.25" >+4.25</option>
                                    <option value="+4.5" >+4.50</option>
                                    <option value="+4.75" >+4.75</option>
                                    <option value="+5" >+5.00</option>
                                    <option value="+5.25" >+5.25</option>
                                    <option value="+5.5" >+5.50</option>
                                    <option value="+5.75" >+5.75</option>
                                    <option value="+6" >+6.00</option>
                                    <option value="+6.25" >+6.25</option>
                                    <option value="+6.5" >+6.50</option>
                                    <option value="+6.75" >+6.75</option>
                                    <option value="+7" >+7.00</option>
                                    <option value="+7.25" >+7.25</option>
                                    <option value="+7.5" >+7.50</option>
                                    <option value="+7.75" >+7.75</option>
                                    <option value="+8" >+8.00</option>
                                    <option value="+8.25" >+8.25</option>
                                    <option value="+8.5" >+8.50</option>
                                    <option value="+8.75" >+8.75</option>
                                    <option value="+9" >+9.00</option>
                                    <option value="+9.25" >+9.25</option>
                                    <option value="+9.5" >+9.50</option>
                                    <option value="+9.75" >+9.75</option>
                                    <option value="+10" >+10.00</option>
                                    <option value="+10.25" >+10.25</option>
                                    <option value="+10.5" >+10.50</option>
                                    <option value="+10.75" >+10.75</option>
                                    <option value="+11" >+11.00</option>
                                    <option value="+11.25" >+11.25</option>
                                    <option value="+11.5" >+11.50</option>
                                    <option value="+11.75" >+11.75</option>
                                    <option value="+12" >+12.00</option>
                                    <option value="+12.25" >+12.25</option>
                                    <option value="+12.5" >+12.50</option>
                                    <option value="+12.75" >+12.75</option>
                                    <option value="+13" >+13.00</option>
                                    <option value="+13.25" >+13.25</option>
                                    <option value="+13.5" >+13.50</option>
                                    <option value="+13.75" >+13.75</option>
                                    <option value="+14" >+14.00</option>
                                    <option value="+14.25" >+14.25</option>
                                    <option value="+14.5" >+14.50</option>
                                    <option value="14.75" >+14.75</option>
                                    <option value="+15" >+15.00</option>
                                    <option value="+15.25" >+15.25</option>
                                    <option value="+15.5" >+15.50</option>
                                    <option value="15.75" >+15.75</option>
                                    <option value="+16" >+16.00</option>
                                    <option value="+16.25" >+16.25</option>
                                    <option value="+16.5" >+16.50</option>
                                    <option value="+16.75" >+16.75</option>
                                    <option value="+17" >+17.00</option>
                                </select>
                            </td>
                            <td>
                                <select name="cyl_od" id="cyl_od">
                                    <option value="0">(CYL)none</option>
                                    <option value="-4" >-4.00</option>
                                    <option value="-3.75" >-3.75</option>
                                    <option value="-3.5" >-3.50</option>
                                    <option value="-3.25" >-3.25</option>
                                    <option value="-3" >-3.00</option>
                                    <option value="-2.75" >-2.75</option>
                                    <option value="-2.5" >-2.50</option>
                                    <option value="-2.25" >-2.25</option>
                                    <option value="-2" >-2.00</option>
                                    <option value="-1.75" >-1.75</option>
                                    <option value="-1.5" >-1.50</option>
                                    <option value="-1.25" >-1.25</option>
                                    <option value="-1" >-1.00</option>
                                    <option value="-0.75" >-0.75</option>
                                    <option value="-0.5" >-0.50</option>
                                    <option value="-0.25" >-0.25</option>
                                    <option value="" selected="selected">0.00</option>
                                    <option value="CYL">CYL</option>
                                    <option value="PLANO">PLANO</option>
                                    <option value="+0.25" >+0.25</option>
                                    <option value="+0.5" >+0.50</option>
                                    <option value="+0.75" >+0.75</option>
                                    <option value="+1" >+1.00</option>
                                    <option value="+1.25" >+1.25</option>
                                    <option value="+1.5" >+1.50</option>
                                    <option value="+1.75" >+1.75</option>
                                    <option value="+2" >+2.00</option>
                                    <option value="+2.25" >+2.25</option>
                                    <option value="+2.5" >+2.50</option>
                                    <option value="+2.75" >+2.75</option>
                                    <option value="+3" >+3.00</option>
                                    <option value="+3.25" >+3.25</option>
                                    <option value="+3.5" >+3.50</option>
                                    <option value="+3.75" >+3.75</option>
                                    <option value="+4" >+4.00</option>
                                </select>
                            </td>
                            <td>
                                <select name="axis_od" id="axis_od">
                                    <option value="">(Axis)none</option>
                                    <option value="" selected="selected">0</option>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                    <option value="9" >9</option>
                                    <option value="10" >10</option>
                                    <option value="11" >11</option>
                                    <option value="12" >12</option>
                                    <option value="13" >13</option>
                                    <option value="14" >14</option>
                                    <option value="15" >15</option>
                                    <option value="16" >16</option>
                                    <option value="17" >17</option>
                                    <option value="18" >18</option>
                                    <option value="19" >19</option>
                                    <option value="20" >20</option>
                                    <option value="21" >21</option>
                                    <option value="22" >22</option>
                                    <option value="23" >23</option>
                                    <option value="24" >24</option>
                                    <option value="25" >25</option>
                                    <option value="26" >26</option>
                                    <option value="27" >27</option>
                                    <option value="28" >28</option>
                                    <option value="29" >29</option>
                                    <option value="30" >30</option>
                                    <option value="31" >31</option>
                                    <option value="32" >32</option>
                                    <option value="33" >33</option>
                                    <option value="34" >34</option>
                                    <option value="35" >35</option>
                                    <option value="36" >36</option>
                                    <option value="37" >37</option>
                                    <option value="38" >38</option>
                                    <option value="39" >39</option>
                                    <option value="40" >40</option>
                                    <option value="41" >41</option>
                                    <option value="42" >42</option>
                                    <option value="43" >43</option>
                                    <option value="44" >44</option>
                                    <option value="45" >45</option>
                                    <option value="46" >46</option>
                                    <option value="47" >47</option>
                                    <option value="48" >48</option>
                                    <option value="49" >49</option>
                                    <option value="50" >50</option>
                                    <option value="51" >51</option>
                                    <option value="52" >52</option>
                                    <option value="53" >53</option>
                                    <option value="54" >54</option>
                                    <option value="55" >55</option>
                                    <option value="56" >56</option>
                                    <option value="57" >57</option>
                                    <option value="58" >58</option>
                                    <option value="59" >59</option>
                                    <option value="60" >60</option>
                                    <option value="61" >61</option>
                                    <option value="62" >62</option>
                                    <option value="63" >63</option>
                                    <option value="64" >64</option>
                                    <option value="65" >65</option>
                                    <option value="66" >66</option>
                                    <option value="67" >67</option>
                                    <option value="68" >68</option>
                                    <option value="69" >69</option>
                                    <option value="70" >70</option>
                                    <option value="71" >71</option>
                                    <option value="72" >72</option>
                                    <option value="73" >73</option>
                                    <option value="74" >74</option>
                                    <option value="75" >75</option>
                                    <option value="76" >76</option>
                                    <option value="77" >77</option>
                                    <option value="78" >78</option>
                                    <option value="79" >79</option>
                                    <option value="80" >80</option>
                                    <option value="81" >81</option>
                                    <option value="82" >82</option>
                                    <option value="83" >83</option>
                                    <option value="84" >84</option>
                                    <option value="85" >85</option>
                                    <option value="86" >86</option>
                                    <option value="87" >87</option>
                                    <option value="88" >88</option>
                                    <option value="89" >89</option>
                                    <option value="90" >90</option>
                                    <option value="91" >91</option>
                                    <option value="92" >92</option>
                                    <option value="93" >93</option>
                                    <option value="94" >94</option>
                                    <option value="95" >95</option>
                                    <option value="96" >96</option>
                                    <option value="97" >97</option>
                                    <option value="98" >98</option>
                                    <option value="99" >99</option>
                                    <option value="100" >100</option>
                                    <option value="101" >101</option>
                                    <option value="102" >102</option>
                                    <option value="103" >103</option>
                                    <option value="104" >104</option>
                                    <option value="105" >105</option>
                                    <option value="106" >106</option>
                                    <option value="107" >107</option>
                                    <option value="108" >108</option>
                                    <option value="109" >109</option>
                                    <option value="110" >110</option>
                                    <option value="111" >111</option>
                                    <option value="112" >112</option>
                                    <option value="113" >113</option>
                                    <option value="114" >114</option>
                                    <option value="115" >115</option>
                                    <option value="116" >116</option>
                                    <option value="117" >117</option>
                                    <option value="118" >118</option>
                                    <option value="119" >119</option>
                                    <option value="120" >120</option>
                                    <option value="121" >121</option>
                                    <option value="122" >122</option>
                                    <option value="123" >123</option>
                                    <option value="124" >124</option>
                                    <option value="125" >125</option>
                                    <option value="126" >126</option>
                                    <option value="127" >127</option>
                                    <option value="128" >128</option>
                                    <option value="129" >129</option>
                                    <option value="130" >130</option>
                                    <option value="131" >131</option>
                                    <option value="132" >132</option>
                                    <option value="133" >133</option>
                                    <option value="134" >134</option>
                                    <option value="135" >135</option>
                                    <option value="136" >136</option>
                                    <option value="137" >137</option>
                                    <option value="138" >138</option>
                                    <option value="139" >139</option>
                                    <option value="140" >140</option>
                                    <option value="141" >141</option>
                                    <option value="142" >142</option>
                                    <option value="143" >143</option>
                                    <option value="144" >144</option>
                                    <option value="145" >145</option>
                                    <option value="146" >146</option>
                                    <option value="147" >147</option>
                                    <option value="148" >148</option>
                                    <option value="149" >149</option>
                                    <option value="150" >150</option>
                                    <option value="151" >151</option>
                                    <option value="152" >152</option>
                                    <option value="153" >153</option>
                                    <option value="154" >154</option>
                                    <option value="155" >155</option>
                                    <option value="156" >156</option>
                                    <option value="157" >157</option>
                                    <option value="158" >158</option>
                                    <option value="159" >159</option>
                                    <option value="160" >160</option>
                                    <option value="161" >161</option>
                                    <option value="162" >162</option>
                                    <option value="163" >163</option>
                                    <option value="164" >164</option>
                                    <option value="165" >165</option>
                                    <option value="166" >166</option>
                                    <option value="167" >167</option>
                                    <option value="168" >168</option>
                                    <option value="169" >169</option>
                                    <option value="170" >170</option>
                                    <option value="171" >171</option>
                                    <option value="172" >172</option>
                                    <option value="173" >173</option>
                                    <option value="174" >174</option>
                                    <option value="175" >175</option>
                                    <option value="176" >176</option>
                                    <option value="177" >177</option>
                                    <option value="178" >178</option>
                                    <option value="179" >179</option>
                                </select>
                            </td>
                            <td>
                                <select name="add_od" id="add_od" class="cls_add">
                                    <option value="">(Add)none</option>
                                    <option value="1" >+1.00</option>
                                    <option value="1.25" >+1.25</option>
                                    <option value="1.5" >+1.50</option>
                                    <option value="1.75" >+1.75</option>
                                    <option value="2" >+2.00</option>
                                    <option value="2.25" >+2.25</option>
                                    <option value="2.5" >+2.50</option>
                                    <option value="2.75" >+2.75</option>
                                    <option value="3" >+3.00</option>
                                    <option value="3.25" >+3.25</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                OS
                            </th>
                            <td>
                                <select name="sph_os" id="sph_os">
                                    <option value="0">(SPH)none</option>
                                    <option value="-17" >-17.00</option>
                                    <option value="-16.75" >-16.75</option>
                                    <option value="-16.5" >-16.50</option>
                                    <option value="-16.25" >-16.25</option>
                                    <option value="-16" >-16.00</option>
                                    <option value="-15.75" >-15.75</option>
                                    <option value="-15.5" >-15.50</option>
                                    <option value="-15.25" >-15.25</option>
                                    <option value="-15" >-15.00</option>
                                    <option value="-14.75" >-14.75</option>
                                    <option value="-14.5" >-14.50</option>
                                    <option value="-14.25" >-14.25</option>
                                    <option value="-14" >-14.00</option>
                                    <option value="-13.75" >-13.75</option>
                                    <option value="-13.5" >-13.50</option>
                                    <option value="-13.25" >-13.25</option>
                                    <option value="-13" >-13.00</option>
                                    <option value="-12.75" >-12.75</option>
                                    <option value="-12.5" >-12.50</option>
                                    <option value="-12.25" >-12.25</option>
                                    <option value="-12" >-12.00</option>
                                    <option value="-11.75" >-11.75</option>
                                    <option value="-11.5" >-11.50</option>
                                    <option value="-11.25" >-11.25</option>
                                    <option value="-11" >-11.00</option>
                                    <option value="-10.75" >-10.75</option>
                                    <option value="-10.5" >-10.50</option>
                                    <option value="-10.25" >-10.25</option>
                                    <option value="-10" >-10.00</option>
                                    <option value="-9.75" >-9.75</option>
                                    <option value="-9.5" >-9.50</option>
                                    <option value="-9.25" >-9.25</option>
                                    <option value="-9" >-9.00</option>
                                    <option value="-8.75" >-8.75</option>
                                    <option value="-8.5" >-8.50</option>
                                    <option value="-8.25" >-8.25</option>
                                    <option value="-8" >-8.00</option>
                                    <option value="-7.75" >-7.75</option>
                                    <option value="-7.5" >-7.50</option>
                                    <option value="-7.25" >-7.25</option>
                                    <option value="-7" >-7.00</option>
                                    <option value="-6.75" >-6.75</option>
                                    <option value="-6.5" >-6.50</option>
                                    <option value="-6.25" >-6.25</option>
                                    <option value="-6" >-6.00</option>
                                    <option value="-5.75" >-5.75</option>
                                    <option value="-5.5" >-5.50</option>
                                    <option value="-5.25" >-5.25</option>
                                    <option value="-5" >-5.00</option>
                                    <option value="-4.75" >-4.75</option>
                                    <option value="-4.5" >-4.50</option>
                                    <option value="-4.25" >-4.25</option>
                                    <option value="-4" >-4.00</option>
                                    <option value="-3.75" >-3.75</option>
                                    <option value="-3.5" >-3.50</option>
                                    <option value="-3.25" >-3.25</option>
                                    <option value="-3" >-3.00</option>
                                    <option value="-2.75" >-2.75</option>
                                    <option value="-2.5" >-2.50</option>
                                    <option value="-2.25" >-2.25</option>
                                    <option value="-2" >-2.00</option>
                                    <option value="-1.75" >-1.75</option>
                                    <option value="-1.5" >-1.50</option>
                                    <option value="-1.25" >-1.25</option>
                                    <option value="-1" >-1.00</option>
                                    <option value="-0.75" >-0.75</option>
                                    <option value="-0.5" >-0.50</option>
                                    <option value="-0.25" >-0.25</option>
                                    <option value="0" selected="selected">0.00</option>
                                    <option value="SPH">SPH</option>
                                    <option value="PLANO">PLANO</option>
                                    <option value="+0.25" >+0.25</option>
                                    <option value="+0.5" >+0.50</option>
                                    <option value="+0.75" >+0.75</option>
                                    <option value="+1" >+1.00</option>
                                    <option value="+1.25" >+1.25</option>
                                    <option value="+1.5" >+1.50</option>
                                    <option value="+1.75" >+1.75</option>
                                    <option value="+2" >+2.00</option>
                                    <option value="+2.25" >+2.25</option>
                                    <option value="+2.5" >+2.50</option>
                                    <option value="+2.75" >+2.75</option>
                                    <option value="+3" >+3.00</option>
                                    <option value="+3.25" >+3.25</option>
                                    <option value="+3.5" >+3.50</option>
                                    <option value="+3.75" >+3.75</option>
                                    <option value="+4" >+4.00</option>
                                    <option value="+4.25" >+4.25</option>
                                    <option value="+4.5" >+4.50</option>
                                    <option value="+4.75" >+4.75</option>
                                    <option value="+5" >+5.00</option>
                                    <option value="+5.25" >+5.25</option>
                                    <option value="+5.5" >+5.50</option>
                                    <option value="+5.75" >+5.75</option>
                                    <option value="+6" >+6.00</option>
                                    <option value="+6.25" >+6.25</option>
                                    <option value="+6.5" >+6.50</option>
                                    <option value="+6.75" >+6.75</option>
                                    <option value="+7" >+7.00</option>
                                    <option value="+7.25" >+7.25</option>
                                    <option value="+7.5" >+7.50</option>
                                    <option value="+7.75" >+7.75</option>
                                    <option value="+8" >+8.00</option>
                                    <option value="+8.25" >+8.25</option>
                                    <option value="+8.5" >+8.50</option>
                                    <option value="+8.75" >+8.75</option>
                                    <option value="+9" >+9.00</option>
                                    <option value="+9.25" >+9.25</option>
                                    <option value="+9.5" >+9.50</option>
                                    <option value="+9.75" >+9.75</option>
                                    <option value="+10" >+10.00</option>
                                    <option value="+10.25" >+10.25</option>
                                    <option value="+10.5" >+10.50</option>
                                    <option value="+10.75" >+10.75</option>
                                    <option value="+11" >+11.00</option>
                                    <option value="+11.25" >+11.25</option>
                                    <option value="+11.5" >+11.50</option>
                                    <option value="+11.75" >+11.75</option>
                                    <option value="+12" >+12.00</option>
                                    <option value="+12.25" >+12.25</option>
                                    <option value="+12.5" >+12.50</option>
                                    <option value="+12.75" >+12.75</option>
                                    <option value="+13" >+13.00</option>
                                    <option value="+13.25" >+13.25</option>
                                    <option value="+13.5" >+13.50</option>
                                    <option value="+13.75" >+13.75</option>
                                    <option value="+14" >+14.00</option>
                                    <option value="+14.25" >+14.25</option>
                                    <option value="+14.5" >+14.50</option>
                                    <option value="14.75" >+14.75</option>
                                    <option value="+15" >+15.00</option>
                                    <option value="+15.25" >+15.25</option>
                                    <option value="+15.5" >+15.50</option>
                                    <option value="15.75" >+15.75</option>
                                    <option value="+16" >+16.00</option>
                                    <option value="+16.25" >+16.25</option>
                                    <option value="+16.5" >+16.50</option>
                                    <option value="+16.75" >+16.75</option>
                                    <option value="+17" >+17.00</option>
                                </select>
                            </td>
                            <td>
                                <select name="cyl_os" id="cyl_os">
                                   <option value="0">(CYL)none</option>
                                    <option value="-4" >-4.00</option>
                                    <option value="-3.75" >-3.75</option>
                                    <option value="-3.5" >-3.50</option>
                                    <option value="-3.25" >-3.25</option>
                                    <option value="-3" >-3.00</option>
                                    <option value="-2.75" >-2.75</option>
                                    <option value="-2.5" >-2.50</option>
                                    <option value="-2.25" >-2.25</option>
                                    <option value="-2" >-2.00</option>
                                    <option value="-1.75" >-1.75</option>
                                    <option value="-1.5" >-1.50</option>
                                    <option value="-1.25" >-1.25</option>
                                    <option value="-1" >-1.00</option>
                                    <option value="-0.75" >-0.75</option>
                                    <option value="-0.5" >-0.50</option>
                                    <option value="-0.25" >-0.25</option>
                                    <option value="" selected="selected">0.00</option>
                                    <option value="CYL">CYL</option>
                                    <option value="PLANO">PLANO</option>
                                    <option value="+0.25" >+0.25</option>
                                    <option value="+0.5" >+0.50</option>
                                    <option value="+0.75" >+0.75</option>
                                    <option value="+1" >+1.00</option>
                                    <option value="+1.25" >+1.25</option>
                                    <option value="+1.5" >+1.50</option>
                                    <option value="+1.75" >+1.75</option>
                                    <option value="+2" >+2.00</option>
                                    <option value="+2.25" >+2.25</option>
                                    <option value="+2.5" >+2.50</option>
                                    <option value="+2.75" >+2.75</option>
                                    <option value="+3" >+3.00</option>
                                    <option value="+3.25" >+3.25</option>
                                    <option value="+3.5" >+3.50</option>
                                    <option value="+3.75" >+3.75</option>
                                    <option value="+4" >+4.00</option>
                                </select>
                            </td>
                            <td>
                                <select name="axis_os" id="axis_os">
                                    <option value="">(Axis)none</option>
                                    <option value="" selected="selected">0</option>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                    <option value="9" >9</option>
                                    <option value="10" >10</option>
                                    <option value="11" >11</option>
                                    <option value="12" >12</option>
                                    <option value="13" >13</option>
                                    <option value="14" >14</option>
                                    <option value="15" >15</option>
                                    <option value="16" >16</option>
                                    <option value="17" >17</option>
                                    <option value="18" >18</option>
                                    <option value="19" >19</option>
                                    <option value="20" >20</option>
                                    <option value="21" >21</option>
                                    <option value="22" >22</option>
                                    <option value="23" >23</option>
                                    <option value="24" >24</option>
                                    <option value="25" >25</option>
                                    <option value="26" >26</option>
                                    <option value="27" >27</option>
                                    <option value="28" >28</option>
                                    <option value="29" >29</option>
                                    <option value="30" >30</option>
                                    <option value="31" >31</option>
                                    <option value="32" >32</option>
                                    <option value="33" >33</option>
                                    <option value="34" >34</option>
                                    <option value="35" >35</option>
                                    <option value="36" >36</option>
                                    <option value="37" >37</option>
                                    <option value="38" >38</option>
                                    <option value="39" >39</option>
                                    <option value="40" >40</option>
                                    <option value="41" >41</option>
                                    <option value="42" >42</option>
                                    <option value="43" >43</option>
                                    <option value="44" >44</option>
                                    <option value="45" >45</option>
                                    <option value="46" >46</option>
                                    <option value="47" >47</option>
                                    <option value="48" >48</option>
                                    <option value="49" >49</option>
                                    <option value="50" >50</option>
                                    <option value="51" >51</option>
                                    <option value="52" >52</option>
                                    <option value="53" >53</option>
                                    <option value="54" >54</option>
                                    <option value="55" >55</option>
                                    <option value="56" >56</option>
                                    <option value="57" >57</option>
                                    <option value="58" >58</option>
                                    <option value="59" >59</option>
                                    <option value="60" >60</option>
                                    <option value="61" >61</option>
                                    <option value="62" >62</option>
                                    <option value="63" >63</option>
                                    <option value="64" >64</option>
                                    <option value="65" >65</option>
                                    <option value="66" >66</option>
                                    <option value="67" >67</option>
                                    <option value="68" >68</option>
                                    <option value="69" >69</option>
                                    <option value="70" >70</option>
                                    <option value="71" >71</option>
                                    <option value="72" >72</option>
                                    <option value="73" >73</option>
                                    <option value="74" >74</option>
                                    <option value="75" >75</option>
                                    <option value="76" >76</option>
                                    <option value="77" >77</option>
                                    <option value="78" >78</option>
                                    <option value="79" >79</option>
                                    <option value="80" >80</option>
                                    <option value="81" >81</option>
                                    <option value="82" >82</option>
                                    <option value="83" >83</option>
                                    <option value="84" >84</option>
                                    <option value="85" >85</option>
                                    <option value="86" >86</option>
                                    <option value="87" >87</option>
                                    <option value="88" >88</option>
                                    <option value="89" >89</option>
                                    <option value="90" >90</option>
                                    <option value="91" >91</option>
                                    <option value="92" >92</option>
                                    <option value="93" >93</option>
                                    <option value="94" >94</option>
                                    <option value="95" >95</option>
                                    <option value="96" >96</option>
                                    <option value="97" >97</option>
                                    <option value="98" >98</option>
                                    <option value="99" >99</option>
                                    <option value="100" >100</option>
                                    <option value="101" >101</option>
                                    <option value="102" >102</option>
                                    <option value="103" >103</option>
                                    <option value="104" >104</option>
                                    <option value="105" >105</option>
                                    <option value="106" >106</option>
                                    <option value="107" >107</option>
                                    <option value="108" >108</option>
                                    <option value="109" >109</option>
                                    <option value="110" >110</option>
                                    <option value="111" >111</option>
                                    <option value="112" >112</option>
                                    <option value="113" >113</option>
                                    <option value="114" >114</option>
                                    <option value="115" >115</option>
                                    <option value="116" >116</option>
                                    <option value="117" >117</option>
                                    <option value="118" >118</option>
                                    <option value="119" >119</option>
                                    <option value="120" >120</option>
                                    <option value="121" >121</option>
                                    <option value="122" >122</option>
                                    <option value="123" >123</option>
                                    <option value="124" >124</option>
                                    <option value="125" >125</option>
                                    <option value="126" >126</option>
                                    <option value="127" >127</option>
                                    <option value="128" >128</option>
                                    <option value="129" >129</option>
                                    <option value="130" >130</option>
                                    <option value="131" >131</option>
                                    <option value="132" >132</option>
                                    <option value="133" >133</option>
                                    <option value="134" >134</option>
                                    <option value="135" >135</option>
                                    <option value="136" >136</option>
                                    <option value="137" >137</option>
                                    <option value="138" >138</option>
                                    <option value="139" >139</option>
                                    <option value="140" >140</option>
                                    <option value="141" >141</option>
                                    <option value="142" >142</option>
                                    <option value="143" >143</option>
                                    <option value="144" >144</option>
                                    <option value="145" >145</option>
                                    <option value="146" >146</option>
                                    <option value="147" >147</option>
                                    <option value="148" >148</option>
                                    <option value="149" >149</option>
                                    <option value="150" >150</option>
                                    <option value="151" >151</option>
                                    <option value="152" >152</option>
                                    <option value="153" >153</option>
                                    <option value="154" >154</option>
                                    <option value="155" >155</option>
                                    <option value="156" >156</option>
                                    <option value="157" >157</option>
                                    <option value="158" >158</option>
                                    <option value="159" >159</option>
                                    <option value="160" >160</option>
                                    <option value="161" >161</option>
                                    <option value="162" >162</option>
                                    <option value="163" >163</option>
                                    <option value="164" >164</option>
                                    <option value="165" >165</option>
                                    <option value="166" >166</option>
                                    <option value="167" >167</option>
                                    <option value="168" >168</option>
                                    <option value="169" >169</option>
                                    <option value="170" >170</option>
                                    <option value="171" >171</option>
                                    <option value="172" >172</option>
                                    <option value="173" >173</option>
                                    <option value="174" >174</option>
                                    <option value="175" >175</option>
                                    <option value="176" >176</option>
                                    <option value="177" >177</option>
                                    <option value="178" >178</option>
                                    <option value="179" >179</option>
                                </select>
                            </td>
                            <td>
                                  <select name="add_os" id="add_os" class="cls_add">
                                      <option value="">(Add)none</option>
                                      <option value="1" >+1.00</option>
                                      <option value="1.25" >+1.25</option>
                                      <option value="1.5" >+1.50</option>
                                      <option value="1.75" >+1.75</option>
                                      <option value="2" >+2.00</option>
                                      <option value="2.25" >+2.25</option>
                                      <option value="2.5" >+2.50</option>
                                      <option value="2.75" >+2.75</option>
                                      <option value="3" >+3.00</option>
                                      <option value="3.25" >+3.25</option>
                                  </select>
                            </td>
                            <!--<td><input type="text" value="" name="power_os" id="power_os" onfocus="get_power(this)"></td>-->
                        </tr>
                    </table>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyPadding">
                     <tr class="rowPadding" align="left">
                     <td style="width:170px;" align="right">Patient Name:</td>
                     <td align="left" style="padding-left:10px;" colspan="2"><input name="patientName" id="patientName" type="text" value=""/></td>
                     </tr>
                     <tr class="rowPadding" align="center">
                     <td colspan="3" align="left" style="padding-left:10px;">&nbsp;</td>
                     </tr>
                     <tr class="rowPadding" >
                     <td style="width:170px;" align="right">PD:</td>
                     <td style="padding-left:10px;" align="left" id="PDShow"><div id="single" style="width:200px; ">
                     <select name="PD" id="PD" class="formText" style="width:100px;">
                     <option value="">(PD)none</option>
                     <option value="38" >38.00</option>
                     <option value="38.5" >38.50</option>
                     <option value="39" >39.00</option>
                     <option value="39.5" >39.50</option>
                     <option value="40" >40.00</option>
                     <option value="40.5" >40.50</option>
                     <option value="41" >41.00</option>
                     <option value="41.5" >41.50</option>
                     <option value="42" >42.00</option>
                     <option value="42.5" >42.50</option>
                     <option value="43" >43.00</option>
                     <option value="43.5" >43.50</option>
                     <option value="44" >44.00</option>
                     <option value="44.5" >44.50</option>
                     <option value="45" >45.00</option>
                     <option value="45.5" >45.50</option>
                     <option value="46" >46.00</option>
                     <option value="46.5" >46.50</option>
                     <option value="47" >47.00</option>
                     <option value="47.5" >47.50</option>
                     <option value="48" >48.00</option>
                     <option value="48.5" >48.50</option>
                     <option value="49" >49.00</option>
                     <option value="49.5" >49.50</option>
                     <option value="50" >50.00</option>
                     <option value="50.5" >50.50</option>
                     <option value="51" >51.00</option>
                     <option value="51.5" >51.50</option>
                     <option value="52" >52.00</option>
                     <option value="52.5" >52.50</option>
                     <option value="53" >53.00</option>
                     <option value="53.5" >53.50</option>
                     <option value="54" >54.00</option>
                     <option value="54.5" >54.50</option>
                     <option value="55" >55.00</option>
                     <option value="55.5" >55.50</option>
                     <option value="56" >56.00</option>
                     <option value="56.5" >56.50</option>
                     <option value="57" >57.00</option>
                     <option value="57.5" >57.50</option>
                     <option value="58" >58.00</option>
                     <option value="58.5" >58.50</option>
                     <option value="59" >59.00</option>
                     <option value="59.5" >59.50</option>
                     <option value="60" >60.00</option>
                     <option value="60.5" >60.50</option>
                     <option value="61" >61.00</option>
                     <option value="61.5" >61.50</option>
                     <option value="62" >62.00</option>
                     <option value="62.5" >62.50</option>
                     <option value="63" >63.00</option>
                     <option value="63.5" >63.50</option>
                     <option value="64" >64.00</option>
                     <option value="64.5" >64.50</option>
                     <option value="65" >65.00</option>
                     <option value="65.5" >65.50</option>
                     <option value="66" >66.00</option>
                     <option value="66.5" >66.50</option>
                     <option value="67" >67.00</option>
                     <option value="67.5" >67.50</option>
                     <option value="68" >68.00</option>
                     <option value="68.5" >68.50</option>
                     <option value="69" >69.00</option>
                     <option value="69.5" >69.50</option>
                     <option value="70" >70.00</option>
                     <option value="70.5" >70.50</option>
                     <option value="71" >71.00</option>
                     <option value="71.5" >71.50</option>
                     <option value="72" >72.00</option>
                     <option value="72.5" >72.50</option>
                     <option value="73" >73.00</option>
                     <option value="73.5" >73.50</option>
                     <option value="74" >74.00</option>
                     <option value="74.5" >74.50</option>
                     <option value="75" >75.00</option>
                     <option value="75.5" >75.50</option>
                     <option value="76" >76.00</option>
                     <option value="76.5" >76.50</option>
                     <option value="77" >77.00</option>
                     <option value="77.5" >77.50</option>
                     <option value="78" >78.00</option>
                     <option value="78.5" >78.50</option>
                     <option value="79" >79.00</option>
                     <option value="79.5" >79.50</option>
                     <option value="80" >80.00</option>
                     <option value="80.5" >80.50</option>
                     <option value="81" >81.00</option>
                     <option value="81.5" >81.50</option>
                     <option value="82" >82.00</option>
                     <option value="82.5" >82.50</option>
                     <option value="83" >83.00</option>
                     <option value="83.5" >83.50</option>
                     <option value="84" >84.00</option>
                     <option value="84.5" >84.50</option>
                     <option value="85" >85.00</option>
                     <option value="85.5" >85.50</option>
                     <option value="86" >86.00</option>
                     <option value="86.5" >86.50</option>
                     <option value="87" >87.00</option>
                     <option value="87.5" >87.50</option>
                     <option value="88" >88.00</option>
                     <option value="88.5" >88.50</option>
                     <option value="89" >89.00</option>
                     <option value="89.5" >89.50</option>
                     <option value="90" >90.00</option>
                     </select></div>
                     <div id="both" style="clear:both; float:left; width:200px; display:none;"><div style="clear:both; float:left; width:100px;">
                     <select name="PD1" id="PD1" class="formText" style="width:100px; ">
                     <option value="">RightPD</option>
                     <option value="19" >19.00</option>
                     <option value="19.5" >19.50</option>
                     <option value="20" >20.00</option>
                     <option value="20.5" >20.50</option>
                     <option value="21" >21.00</option>
                     <option value="21.5" >21.50</option>
                     <option value="22" >22.00</option>
                     <option value="22.5" >22.50</option>
                     <option value="23" >23.00</option>
                     <option value="23.5" >23.50</option>
                     <option value="24" >24.00</option>
                     <option value="24.5" >24.50</option>
                     <option value="25" >25.00</option>
                     <option value="25.5" >25.50</option>
                     <option value="26" >26.00</option>
                     <option value="26.5" >26.50</option>
                     <option value="27" >27.00</option>
                     <option value="27.5" >27.50</option>
                     <option value="28" >28.00</option>
                     <option value="28.5" >28.50</option>
                     <option value="29" >29.00</option>
                     <option value="29.5" >29.50</option>
                     <option value="30" >30.00</option>
                     <option value="30.5" >30.50</option>
                     <option value="31" >31.00</option>
                     <option value="31.5" >31.50</option>
                     <option value="32" >32.00</option>
                     <option value="32.5" >32.50</option>
                     <option value="33" >33.00</option>
                     <option value="33.5" >33.50</option>
                     <option value="34" >34.00</option>
                     <option value="34.5" >34.50</option>
                     <option value="35" >35.00</option>
                     <option value="35.5" >35.50</option>
                     <option value="36" >36.00</option>
                     <option value="36.5" >36.50</option>
                     <option value="37" >37.00</option>
                     <option value="37.5" >37.50</option>
                     <option value="38" >38.00</option>
                     <option value="38.5" >38.50</option>
                     <option value="39" >39.00</option>
                     <option value="39.5" >39.50</option>
                     <option value="40" >40.00</option>
                     <option value="40.5" >40.50</option>
                     <option value="41" >41.00</option>
                     <option value="41.5" >41.50</option>
                     <option value="42" >42.00</option>
                     <option value="42.5" >42.50</option>
                     <option value="43" >43.00</option>
                     <option value="43.5" >43.50</option>
                     <option value="44" >44.00</option>
                     <option value="44.5" >44.50</option>
                     <option value="45" >45.00</option>
                     </select></div><div style="float:left; width:100px;">
                     <select name="PD2" id="PD2" class="formText" style="width:100px; ">
                     <option value="">LeftPD</option>
                     <option value="19" >19.00</option>
                     <option value="19.5" >19.50</option>
                     <option value="20" >20.00</option>
                     <option value="20.5" >20.50</option>
                     <option value="21" >21.00</option>
                     <option value="21.5" >21.50</option>
                     <option value="22" >22.00</option>
                     <option value="22.5" >22.50</option>
                     <option value="23" >23.00</option>
                     <option value="23.5" >23.50</option>
                     <option value="24" >24.00</option>
                     <option value="24.5" >24.50</option>
                     <option value="25" >25.00</option>
                     <option value="25.5" >25.50</option>
                     <option value="26" >26.00</option>
                     <option value="26.5" >26.50</option>
                     <option value="27" >27.00</option>
                     <option value="27.5" >27.50</option>
                     <option value="28" >28.00</option>
                     <option value="28.5" >28.50</option>
                     <option value="29" >29.00</option>
                     <option value="29.5" >29.50</option>
                     <option value="30" >30.00</option>
                     <option value="30.5" >30.50</option>
                     <option value="31" >31.00</option>
                     <option value="31.5" >31.50</option>
                     <option value="32" >32.00</option>
                     <option value="32.5" >32.50</option>
                     <option value="33" >33.00</option>
                     <option value="33.5" >33.50</option>
                     <option value="34" >34.00</option>
                     <option value="34.5" >34.50</option>
                     <option value="35" >35.00</option>
                     <option value="35.5" >35.50</option>
                     <option value="36" >36.00</option>
                     <option value="36.5" >36.50</option>
                     <option value="37" >37.00</option>
                     <option value="37.5" >37.50</option>
                     <option value="38" >38.00</option>
                     <option value="38.5" >38.50</option>
                     <option value="39" >39.00</option>
                     <option value="39.5" >39.50</option>
                     <option value="40" >40.00</option>
                     <option value="40.5" >40.50</option>
                     <option value="41" >41.00</option>
                     <option value="41.5" >41.50</option>
                     <option value="42" >42.00</option>
                     <option value="42.5" >42.50</option>
                     <option value="43" >43.00</option>
                     <option value="43.5" >43.50</option>
                     <option value="44" >44.00</option>
                     <option value="44.5" >44.50</option>
                     <option value="45" >45.00</option>
                     </select></div></div></td>
                     <td align="left" style="padding-left:10px;"><input name="PDSelect" id="PDSelect" type="checkbox" value="1" onclick="showItem('PD');"/><span style="padding-top:0px; vertical-align: middle; padding-bottom:5px;">Click here if you have two PD numbers, Left and Right</span></td>
                     </tr>
                     <tr class="rowPadding" align="center">
                     <td colspan="3" align="left" style="padding-left:10px;">&nbsp;</td>
                     </tr>
                     <tr class="rowPadding" align="center">
                     <td align="right" valign="top">&nbsp;</td>
                     <td colspan="2" align="left" style="padding-left:10px; text-decoration:underline; font-size:14px;"><span><a href="pdfFiles/ruler.pdf"class="link" style="cursor:pointer; text-decoration:underline; font-size:14px;" target="_blank" >PD measurement help</a></span></td>

                     </tr>
                     <tr class="rowPadding" align="center">
                     <td align="right" valign="top">&nbsp;</td>
                     <td colspan="2" align="left" style="padding-left:10px;">
                     <span class="boldText" style=" color:#CC3333; font-style:italic;">Before printing the file please make sure that Page scalin is selected to none
                    </span>
                     </td>
                     </tr>
                     <tr class="rowPadding" align="center">
                     <td colspan="3" align="left" style="padding-left:10px;">&nbsp;</td>
                     </tr>
                     <tr class="rowPadding" align="center">
                     <td align="left" valign="top">Prism Required:<br/>
                      <input name="prism" type="radio" value="Yes" id="prism_yes" class="prism"/> Yes<br/>
                      <input name="prism" type="radio" value="No" checked='checked' id="prism_no" class="prism"/> No
                     </td>
                     <td align="left" colspan="2" style="padding-left:10px;">
                         Any Extra Comments<br/>
                         <textarea name="extraComment" id="extraComment" cols="3" rows="2" style="width:600px; height:40px;" placeholder="Extra Comments"></textarea>
                     </td>
                     </tr>
                     </table>
                </div>
                <div class="action_btn">
                    <a href="javascript:void(0);" class="btn" id="next_step1">Done</a>
                    <a href="javascript:void(0);" class="btn" onclick="remove_popup('popup_presc_entry')">Cancel</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
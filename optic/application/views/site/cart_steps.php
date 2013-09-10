<link rel="stylesheet" href="<?php echo base_url()?>css/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo base_url().'css/site/cart_steps.css'?>" type="text/css"/>
<script src="<?php echo base_url()?>js/jquery-ui.js"></script>
<script src="<?php echo base_url()?>js/admin/products.js"></script>
<script>var greater_power = 0;</script>
<script>var cart_total_items = <?php echo $this->cart->total_items();?></script>
<?php
    $category_id = $this->session->userdata('fld_category_id');
    $free_category = $this->session->userdata('free_category');
    $promocode = $this->session->userdata('promocode');
    if($category_id=="" || $category_id == NULL || $category_id==0){
        $category_id =0;
    }
    if($free_category=="" || $free_category == NULL || $free_category==0){
        $free_category =0;
    }
    if($promocode=="" || $promocode == NULL || $promocode==0){
        $promocode =0;
    }
?>
<script>
    current_category = <?php echo $category_id;?>;
    free_category = <?php echo $free_category;?>;
    promocode = <?php echo $promocode;?>;
    
</script>
<script src="<?php echo base_url().'js/site/prescription.js'?>"></script>
<script src="<?php echo base_url().'js/site/promocode.js'?>"></script>
<script src="<?php echo base_url()?>js/site/cart_steps.js" type="text/javascript" charset="utf-8"></script>
<style>
    .visibility_0{
        display:none;
    }
</style>
<?php
    $this->load->helper('product_info_helper');
    $this->load->helper('admin/image_helper');
    $this->load->helper('login_helper');
?>
<?php
    if(isset($product_info))
        $info = $product_info;
    else $info = $product_info_temp;
    $primary_img = select_primary_image($info['fld_product'],$this->session->userdata('fld_color'));
?>
<div class="ui-widget-overlay ui-front" style="display:none;"></div>
<!--<div class="loading" style="display:none;position: absolute;z-index: 100;"><img src="<?php echo base_url().'images/loading.gif';?>"/></div>-->
<div id="dialog_modal_loading" title="Please Wait" style="display:none;">
    <div>
        <img src="<?php echo base_url().'images/loading.gif';?>"/>
    </div>
</div>
<div id="dialog-modal" title="" style="display:none;">
    <div class="popup_attr"></div>
    <div class="popup_attr_name"></div>
</div>
<div id="popup_description" title="" style="display:none;"></div>
<div class="cart_slider">
    <?php if($this->session->userdata('promocode')==1 && $this->session->userdata('fld_category_id')==$this->session->userdata('free_category')):?>
        <div class="promocode_result">
            <p>Please select through the process.The promocode you used is cost free in this category.
            The cost throughout the process is none.</p>
        </div>
    <?php endif;?>
    <div class="active_prev"></div>
    <div class="previous_cart"></div>
    <div class="active_next"></div>
    <div class="next_cart"></div>
    <div class="cart_steps">
        <div class="steps_line"><hr></div>
        <ul class="cart_steps_ul">
            <li class="cart_steps_li" id="step1">
                <div class="current_step steps">
                    <h2>Enter Prescription</h2>
                    <div class="step_count">
                        <div class="oval">
                            <span>Step 1</span>
                        </div>
                    </div>
                </div>
            </li>
            <li class="cart_steps_li" id="step2">
                <div class="steps">
                    <h2>Lens Packages</h2>
                    <div class="step_count">
                        <div class="oval">
                            <span>Step 2</span>
                        </div>
                    </div>
                </div>
            </li>
            <li class="cart_steps_li" id="step3">
                <div class="steps">
                    <h2>Lens Upgrade</h2>
                    <div class="step_count">
                        <div class="oval">
                            <span>Step 3</span>
                        </div>
                    </div>
                </div>
            </li>
            <li class="cart_steps_li" id="step4">
                <div class="steps">
                    <h2>Accessories</h2>
                    <div class="step_count">
                        <div class="oval">
                            <span>Step 4</span>
                        </div>
                    </div>
                </div>
            </li>
            <li class="cart_steps_li" id="step5">
                <div class="steps">
                    <h2>Check Out</h2>
                    <div class="step_count">
                        <div class="oval">
                            <span>Step 5</span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="cart_steps_view_port">
        <div class="cart_steps_content_holder" style="height:455px;">
            <div class="cart_steps_content" id="step_one">
                <div class="steps_wrapper" style="margin-top:0px;">
                    <div id="adv2"> 
                        <div id="usual_cat" class="usual_cat">
                            <div class="step1_img">
                                <img src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>"/>
                            </div>
                        <ul> 
                          <li><a class="selected presc_tab" href="#enter_presc" id="enter_presc_tab">Enter Prescription</a></li> 
                          <li><a class="presc_tab" href="#email_presc" id="email_presc_tab">Email Prescription</a></li> 
                          <li><a class="presc_tab" href="#reuse_presc" id="reuse_presc_tab">Re-use Prescription</a></li> 
                        </ul> 
                          <div id="enter_presc" class="tabs">

                      <?php 
                          $row = $info;
                          $lens_type = $row['fld_lens_type'];
                      ?>
                      <script>lens = <?php echo $lens_type;?>;</script>
                      <div class="presc_validation_error"></div>
                            <div id="dialog_modal" title="Prescriptions" style="display:none;">
                                <p>
                                <div class="circle">
                                    <div class="ui-icon ui-icon-alert"></div>
                                </div>
                                    <div class="message" id="message"></div>
                                </p>
                            </div>
                      <table class="tbl_enter_prescription">
                          <tr>
                              <th class="presc_title">
                                  &nbsp;
                              </th>
                              <th class="presc_title">
                                  SPH
                              </th>
                              <th class="presc_title">
                                  CYL
                              </th>
                              <th class="presc_title">
                                  Axis
                              </th>
                              <th class="presc_title">
                                  Add
                              </th>
                              <th>
                                  Power
                              </th>
                          </tr>
                          <tr>
                              <th>
                                  OD
                              </th>
                              <td>
                                  <select name="sph_od" id="sph_od">
                                      <option value="">(SPH)none</option>
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
                                      <option value="">(CYL)none</option>
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
                                  <div id="add_od_overlay"></div>
                                  <select name="add_od" id="add_od">
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
                              <td><input type="text" value="" name="power_od" id="power_od" onfocus="get_power(this);"></td>
                          </tr>
                          <tr>
                              <th>
                                  OS
                              </th>
                              <td>
                                  <select name="sph_os" id="sph_os">
                                      <option value="">(SPH)none</option>
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
                                      <option value="">(CYL)none</option>
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
                                  <div id="add_os_overlay"></div>
                                    <select name="add_os" id="add_os">
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
                              <td><input type="text" value="" name="power_os" id="power_os" onfocus="get_power(this)"></td>
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
                      
                        <div class="slider_nav">
                            <div class="left">
                                <a href="javascript:void(0);" onclick="" class="btn step1 prev_btn">BACK</a>
                            </div>
                            <div class="right">
                                <a href="javascript:void(0);" onclick="" class="btn step1" id="next_step1">NEXT</a>
                            </div>
                        </div>
                          </div> 


                        <div id="email_presc" class="tabs">
                            <iframe scrollin="no" id="file_uploader" class="file_uploader" src="<?php echo base_url().'site/cart_steps/file_uploader'?>"></iframe><br/>
                            Please email us your doctors prescription to <a href="service@opticstoreonline.com"/>service@opticstoreonline.com</a>. Please remember to mention your <b><i>order #</i></b> and the <b><i>name</i></b> on the subject of your email or on the prescription
                            <div class="slider_nav">
                                <div class="left">
                                    <a href="javascript:void(0);" onclick="" class="btn step1 prev_btn">BACK</a>
                                </div>
                                <div class="right">
                                    <a href="javascript:void(0);" onclick="" class="btn upload_step1">NEXT</a>
                                </div>
                            </div>
                        </div> 

                        <div id="reuse_presc" class="tabs">
                            <?php if($my_prescs->num_rows()==0):?>
                                    No any prescription uploaded.
                                <?php else:?>
                                    <?php foreach($my_prescs->result() as $presc):?>
                                        <?php if($presc->fld_prescription_path!=""):?>
                                            Prescription of <u><?php echo ucfirst($presc->fld_patient_name);?></u>
                                            <div class="right">
                                                <a href="javascript:void(0);" class="use_presc" id="<?php echo $presc->fld_id;?>">Use This</a>
                                            </div>
                                            <a href="<?php echo base_url().$presc->fld_prescription_path;?>" target="_blank">View This</a>
                                            <hr/>
                                        <?php else:?>
                                            Prescription of <u><?php echo ucfirst($presc->fld_patient_name);?></u>
                                            <div class="right">
                                                <a href="javascript:void(0);" class="use_presc" id="<?php echo $presc->fld_id;?>">Use This</a>
                                            </div>
                                            <a href="javascript:void(0);" class="view_presc">View This</a>
                                            <table class="presc_tbl">
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
                                            <hr/>
                                        <?php endif;?>                    
                                    <?php endforeach;?>
                                <?php endif;?>


                            <div class="slider_nav">
                                <div class="left">
                                    <a href="javascript:void(0);" onclick="" class="btn step1 prev_btn">BACK</a>
                                </div>
                                <div class="right">
                                    <a href="javascript:void(0);" onclick="" class="btn presc_use_next">NEXT</a>
                                </div>
                            </div>
                        </div> 
                      </div> 

                      <script type="text/javascript"> 
                        $("#usual_cat ul").idTabs(); 
                      </script>
                    </div>
                </div>
            </div>
            <div class="cart_steps_content" id="step_two">
                <div class="steps_wrapper">
                    <span>* <em> is the <b>recommended package</b>. for your item.</em></span>
                    <div class="left glass_img">
                        <img src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>"/>
                    </div>
                    <div class="left lens_packages">
                        <?php
                            $available_packages = get_packages_by_lens_type($info['fld_lens_type']);
                            foreach($lens_packages->result() as $lens_package){
                                foreach($available_packages->result() as $package){
                                    if($package->fld_lens_package_id==$lens_package->fld_id){                                        
                                        echo '<div id="lens_package_'.$lens_package->fld_id.'" class="packages">';
                                        echo '<div class="cart_title_holder">';
                                        echo '<input type="radio" value="'.$package->fld_lens_package_id.'" name="lens_package" id="radio_lens_package_'.$lens_package->fld_id.'" disabled="disabled"/>';
                                        echo '<span class="cart_title">'.$lens_package->fld_name.'</span><span class="price"> [ $'.$lens_package->fld_price.' ]'.'</span>';
                                        echo '<a onclick="javascript:void(0);window.open(&#39'.base_url().'site/cart_steps/descriptions/'.$lens_package->fld_id.'/package&#39,&#39'.$lens_package->fld_name.'&#39,&#39width=500,height=700,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=0,left=0,top=0&#39);" title="Description for '.$lens_package->fld_name.'">';
                                        echo '<img src="'.base_url().'images/help.png" style="position: relative; width: 19px; margin-top: 4px; margin-left: 5px;"/></a><br/>';
                                        echo '</div>';
                                        $all_packages_attr = get_all_package_attr();
                                        $packages_attr = get_attributes_of_package($package->fld_lens_package_id);
                                        foreach($all_packages_attr->result() as $all_package_attr){
                                            $flag=0;
                                                foreach($packages_attr->result() as $package_attr){
                                                    if($package_attr->fld_lens_package_attribute_id==$all_package_attr->fld_id){
                                                        echo '<div class="visibility_'.$package_attr->fld_display.'"><div class="availability"><img src="'.base_url().'images/tick.png"/></div>';
                                                        $flag=1;
                                                    }
                                                }
                                                if($flag!=1)
                                                    echo '<div class="visibility_1"><div class="availability"><img src="'.base_url().'images/cross1.png'.'"/></div>';
                                            echo '&nbsp;<div class="availability">'.$all_package_attr->fld_name.'</div></div>';
                                        }
                                        echo '</div>';
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="slider_nav">
                        <div class="left">
                            <a href="javascript:void(0);" onclick="" class="btn step2 prev_btn">BACK</a>
                        </div>
                        <div class="right">
                            <a href="javascript:void(0);" onclick="lens_upgrade();" class="btn next_btn">NEXT</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart_steps_content" id="step_three">
                <div class="steps_wrapper">
                        <div class="left glass_img">
                            <img src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name;?>"/>
                        </div>
                        <div class="left lens_upgrades">
                            Please Wait For a While Until Your Upgrades are Modified...
                        </div>
                    <div class="slider_nav">
                        <div class="left">
                            <a href="javascript:void(0);" onclick="" class="btn step3 prev_btn">BACK</a>
                        </div>
                        <div class="right">
                            <a href="javascript:void(0);" class="btn lu_next_btn">NEXT</a>
                        </div>
                    </div>
                    </div>
            </div>

            <div class="cart_steps_content" id="step_four">
                <div class="steps_wrapper">
                    <?php
                        $selected_product = get_product_info($info['fld_product']);
                        $lens_type = get_lens_type_info($info['fld_lens_type']);
                        $color = get_product_color($info['fld_color']);
                    ?>
                    Please Skip this for the moment. Thank you.
                    <a href="javascript:" class="next_btn step_4">[skip]</a>
                    <div name="cart_content" id="cart_content">
                        <input type="hidden" id="item_id" name="item_id" value="<?php echo $selected_product->fld_id;?>"/>
                        <input type="hidden" id="price" name="price" value="<?php
                                    if($this->session->userdata('promocode')==1 && $this->session->userdata('fld_category_id')==$this->session->userdata('free_category'))
                                        echo 0.00;
                                    else
                                        echo $selected_product->fld_sp;
                                ?>"/>
                        <input type="hidden" id="name" name="name" value="<?php echo $selected_product->fld_name;?>"/>
                        <input type="hidden" id="color" name="color" value="<?php echo $color;?>"/>
                        <input type="hidden" id="color_id" name="color_id" value="<?php echo $info['fld_color'];?>"/>
                        <input type="hidden" id="item_code" name="item_code" value="<?php echo $selected_product->fld_code;?>"/>
                        <input type='hidden' id="lens_type" name="lens_type" value="<?php echo $lens_type->fld_name;?>"/>
                        <input type='hidden' id="lens_type_id" name="lens_type_id" value="<?php echo $info['fld_lens_type'];?>"/>
                        <input type='hidden' id="lens_package" name="lens_package" value=""/>
                        <input type='hidden' id="lens_package_price" name="lens_package_price" value=""/>
                        <input type='hidden' id="lens_upgrade" name="lens_upgrade" value=""/>
                        <input type='hidden' id="lens_upgrade_attr_id" name="lens_upgrade_attr_id" value=""/>
                        <input type='hidden' id="lens_upgrade_color" name="lens_upgrade_color" value=""/>
                        <input type='hidden' id="lens_upgrade_value_id" name="lens_upgrade_value_id" value=""/>
                        <input type='hidden' id="lens_package_id" name="lens_package_id" value=""/>
                        <input type='hidden' id="lens_upgrade_id" name="lens_upgrade_id" value=""/>
                        <input type='hidden' id="lens_upgrade_price" name="lens_upgrade_price" value=""/>
                        <input type='hidden' id="prescription" name="prescription" value=""/>
                    </div>
                </div>
                <iframe name="accessories" src="<?php echo base_url('site/cart_steps/step_four');?>" style="border: medium none;height: 385px;margin-left: 43px;width: 896px;"></iframe>
            </div>
            
<!--=========================================================================================
    STEP FIVE
==========================================================================================-->            
            <?php /*?>
            <div class="cart_steps_content" id="final_product">
                <div class="steps_wrapper" id="final_product_wrapper">
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
                    <form style="float:right;margin-top:-10px;margin-bottom: 15px;" id="paypalfrm" name="paypalfrm" action="<?php echo base_url();?>pay_pal/SetExpressCheckout.php" method="post">
                        <div class="final_info left border_right margin_top">
                    <?php
                        if($this->cart->total_items()>0 && IsLoggedIn()!=true):
                    ?>
                            <div class="final_product_image" id="row_<?php echo $product_temp->fld_id?>">
                                <div class="left">
                                    <img src="<?php echo base_url().$primary_img->fld_url.'/thumbs/'.$primary_img->fld_name?>" style="width:100px;"/>
                                </div>
                                <div class="info right">
                                    <b><?php echo $selected_product->fld_code;?><br/></b>
                                    <?php
                                        if($this->session->userdata('promocode')==1 && $this->session->userdata('fld_category_id')==$this->session->userdata('free_category')):
                                    ?>
                                        <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="0"/>
                                        Price: 0<br/>
                                    <?php else:
                                        ?>
                                        <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="<?php echo $selected_product->fld_sp;?>"/>
                                        Price: <?php echo $price1 = $selected_product->fld_sp;?><br/>
                                    <?php endif;?>
                                    Color: <?php echo $color;?><br/>
                                </div>
                                <div class="clear">
                                    Prescription: Skipped<br/><br/>
                                    Lens Description:<br/>
                                    Lens Type: <?php echo $lens_type->fld_name;?><br/>
                                    <div class="lens_package"></div>                
                                    <div class="upgrades_info"></div>
                                    <div class="total">
                                        <b>Total</b>
                                        <div class="right"></div>
                                    </div>
                                </div>
                                <div class="edit_delete">
<!--                                    <div class="left">
                                        Edit
                                    </div>-->
                                    <div class="right">
                                        Delete
                                    </div>
                                </div>
                            </div>
                    <?php
//                            $count = 1;
                            foreach($this->cart->contents() as $items):
                    ?>
                            <div class="final_product_image" id="row_<?php echo $product_temp->fld_id;?>">
                                <div class="left">
                                    <?php
                                        $p_img = select_primary_image($items['id']);
                                    ?>
                                    <img src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name?>" style="width:100px;"/>
                                </div>
                                <div class="info right">
                                    <b><?php echo $items['options']['item_code'];?><br/></b> <!--Item code-->
                                    
                                    <?php if($this->session->userdata('promocode')==1 && $this->session->userdata('fld_category_id')==$this->session->userdata('free_category')):
                                    ?>
                                        Price: 0<br/>
                                    <?php else:
                                        ?>
                                        
                                        Price: <?php echo $items['options']['product_price'];?><br/>
                                    <?php endif;?>
                                    
                                    Color: <?php echo $items['options']['product_color'];?><br/>
                                </div>
                                <div class="clear">
                                    Prescription: Skipped<br/><br/>
                                    Lens Description:<br/>
                                    Lens Type: <?php echo $items['options']['lens_type'];?><br/>
                                    Lens Package: <?php echo $items['options']['lens_package'];?><br/>
                                    Price: <?php echo $items['options']['lens_package_price'];?><br/>
                                    Upgrades: <?php echo $items['options']['lens_upgrade'];?><br/>
                                    Color: <?php echo $items['options']['lens_upgrade_color'];?><br/>
                                    Price: <?php echo $items['options']['lens_upgrade_price'];?><br/>
                                    <b>Total</b><div class="right"><?php echo $items['price'];?></div>
                                </div>
                                <div class="edit_delete">
<!--                                    <div class="left">
                                        Edit
                                    </div>-->
                                    <div class="right">
                                        Delete
                                    </div>
                                </div>
                            </div>
                    <?php 
                        endforeach;
                        $this->cart->destroy();?>
                    <?php endif;?>
                            <?php if(IsLoggedIn()):?>
                    <?php
                        foreach($product_info_tbl_temp->result() as $product_temp):
                            $selected_product_temp = get_product_info($product_temp->fld_product);
                            $lens_type_temp = get_lens_type_info($product_temp->fld_lens_type);
                            $color_temp = get_product_color($product_temp->fld_color);
                            $lens_package_temp = get_lens_package_info($product_temp->fld_lens_package);
                            $upgrades = get_upgrades($product_temp->fld_lens_upgrade);
                    ?>
                        <div class="final_product_image" id="row_item_<?php echo $product_temp->fld_id;?>">
                            <div class="left">
                                <?php
                                    $p_img = select_primary_image($product_temp->fld_product);
                                ?>
                                <img src="<?php echo base_url().$p_img->fld_url.'/thumbs/'.$p_img->fld_name?>" style="width:100px;"/>
                            </div>
                            <div class="info right">
                                <b><?php echo $selected_product_temp->fld_code;?><br/></b> <!--Item code-->
                                <input type="hidden" name="product_code[]" id="product_code[]" value="<?php echo $selected_product_temp->fld_code;?>"/>
                                <?php if($product_temp->fld_promo_flag ==1):?>
                                    Price: 0<br/>
                                    <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="0" />
                                <?php else:
                                    ?>
                                    Price: <?php echo $product_temp->fld_product_price;?><br/>
                                    <input type="hidden" name="itemAmount[]" id="itemAmount[]" value="<?php echo $product_temp->fld_product_price;?>" />
                                <?php endif;?>
                                Color: <?php echo $color_temp;?><br/>
                                Qty: 1<br/>
                                <input type="hidden" name="itemQuantity[]" id="itemQuantity[]" value="1" />
                            </div>
                            <div class="clear">
                                Prescription: Skipped<br/><br/>
                                Lens Description:<br/>
                                Lens Type: <?php echo $lens_type_temp->fld_name;?><br/>
                                Lens Package: <?php echo $lens_package_temp->fld_name;?><br/>
                                
                                <?php if($product_temp->fld_promo_flag ==1):?>
                                    Price: 0<br/>
                                    <input type='hidden' name='lens_package_price[]' id='lens_package_price[]' value='0'>
                                <?php else:?>
                                    Price: <?php echo $product_temp->fld_lens_package_price;?><br/>
                                    <input type='hidden' name='lens_package_price[]' id='lens_package_price[]' value='<?php echo $product_temp->fld_lens_package_price;?>'>
                                <?php endif;?>
                                Upgrades: <?php echo $upgrades['upgrade'];?><br/>
                                Color: <?php echo $upgrades['upgrade_attr_value']?><br/>
                                <?php if($product_temp->fld_promo_flag ==1):?>
                                    Price: 0<br/>
                                    <input type='hidden' name='lens_upgrade_price[]' id='lens_upgrade_price[]' value='0'/>"
                                <?php else:?>
                                    Price: <?php echo $product_temp->fld_lens_upgrade_price;?><br/>
                                    <input type='hidden' name='lens_upgrade_price[]' id='lens_upgrade_price[]' value='<?php echo $product_temp->fld_lens_upgrade_price;?>'/>
                                <?php endif;?>
                                <?php
                                    if(isset($product_temp->fld_lens_upgrade_price)){
                                        $price_lens_package = $product_temp->fld_lens_upgrade_price;
                                    }
                                    else $price_lens_package = 0;
                                    if(isset($product_temp->fld_lens_package_price)){
                                        $price_upgrades = $product_temp->fld_lens_package_price;
                                    }else $price_upgrades =0;
                                ?>
                                <b>Total</b><div class="right">
                                    <?php if($product_temp->fld_promo_flag ==1):
                                            echo 0;
                                            echo "<input type='hidden' name='sub_total[]' id='sub_total[]' value='0'/>";
                                        else:
                                            echo $total = $selected_product_temp->fld_sp + $price_lens_package  + $price_upgrades;
                                            echo "<input type='hidden' name='sub_total[]' id='sub_total[]' value='".$total."'/>";
                                        endif;
                                    ?>
                                </div>
                            </div>
                            <div class="edit_delete">
<!--                                <div class="left">
                                    <a href="<?echo base_url().'site/cart_steps/steps/'.$product_temp->fld_id?>">Edit</a>
                                </div>-->
                                <div class="right">
                                    <a href="javascript:void(0);" id="item_<?php echo $product_temp->fld_id;?>" class="delete" name="<?php echo base_url().'site/cart_steps/delete_item/'.$product_temp->fld_id;?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php 
                            endforeach;
                        endif;
                    ?>
                    </div>
                    <div class="left shipping_details_holder margin_top">
                        <div class="promotion_code">
                            <b>Promotion Code: </b>
                            <input id="promocode" type="text" name="promocode" id="promo_code"/>
                            <a href="javascript:void(0);" onclick="check();">Check</a>
                        </div>
                        <div class="shipping_details">
                            <b>Shipping Details</b>
                            <div class="table">
                                <div class="tr headings">
                                    <div class="th">Country</div>
                                    <div class="th">Carrier</div>
                                    <div class="th">Shipping Cost</div>
                                    <div class="th">Insurance Cost</div>
                                </div>
                                <?php foreach($carriers_country->result() as $ccountry):?>
                                
                                <div class="country">
                                    <div class="tr">
                                        <div class="td title">
                                            <?php echo $ccountry->fld_name;?>
                                        </div>
                                    </div>
                                    <?php $this->load->helper('admin/country_helper');$carriers = carriers($ccountry->fld_id);?>
                                    <?php foreach($carriers->result() as $carrier):?>
                                    <div class="tr">
                                        <div class="td">
                                            <input type="radio" name="carrier" value="<?php echo $carrier->fld_id;?>" class="carrier"/>
                                        </div>
                                        <div class="td"><?php echo $carrier->fld_carrier;?></div>
                                        <div class="td"><?php echo $carrier->fld_shipping_cost;?></div>
                                        <div class="td"><?php echo $carrier->fld_insurance_cost;?></div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
<!--                    <div class="slider_nav">
                        <div class="right">
                        </div>
                    </div>-->
                    <input type="submit" value="" style="background: url(https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif);border: medium none;height: 38px;width: 145px;cursor: pointer;"/>
                    </form>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
                </div>
            </div><?php */?>
        </div>
    </div><!--Cart_steps_content_holder ends-->
</div>
<?php 
    $this->load->helper('product_info_helper');
    if(IsLoggedIn()){
        $qty = get_total_cart_qty($this->session->userdata('userId'));
            $total_cart_item = $qty->temp+$qty->accessories+$qty->contact_lenses;
//            echo $total_cart_item;
    }
    else {
        $qty = get_total_cart_qty('sess_'.$this->session->userdata('fld_id'));
        $total_cart_item = $qty->temp+$qty->accessories+$qty->contact_lenses;
//        echo $total_cart_item.'-----'.$qty->temp_price;
    }
    $this->config->set_item('total_cart_items', $total_cart_item);
?>
<script>
    $('a.paypal_btn').click(function(){
        var href = $("a.paypal_btn").attr("href");
        if(href =="" || href == null){
            alert('Please choose a carrier for shipping.');
            return false;
        }
        else return true;
    });
    $(".carrier").click(function(){
        $('a.paypal_btn').attr("href",base_url+'cart_steps/purchase_paypal')
        $.ajax({
            type:"POST",
            async:false,
            url:base_url+"site/cart_steps/set_carrier/"+this.value,
            success:function(){}
        })
    })
    
    function add_accessory_to_cart(cart)
    {
        alert(cart['id']);
        var no_items = $(".num_cart_items").html();
        alert(no_items);
        no_items=parseInt(cart['qty'])+parseInt(no_items);
        $(".num_cart_items").html(no_items);
        var old_price = parseFloat($(".qty_accessories_price span").html());
        var old_qty = parseFloat($("span.qty_accessories span").html());
        var tot_accessory_price = ((parseFloat(cart['price'])*parseInt(cart['qty'])) + old_price).toFixed(2);
        var tot_accessory_qty = parseInt(cart['qty']) +old_qty;
        var old_total = (parseFloat($(".total_price span").html())+(parseFloat(cart['price'])*parseInt(cart['qty']))).toFixed(2);
        $(".total_price span").html(old_total);
        $(".accessories_cart").show();$(".num_cart_items").html(no_items);
        $('.qty_accessories').html(tot_accessory_qty);
        $('.qty_accessories_price').html(tot_accessory_price);
    }
</script>

<?php
if(isset($info['edit']) && $info['edit']==true){
?>
<script>
    set_selected_option('sph_od',remove_empty('<?php echo $info['sph_od']?>'));
    set_selected_option('sph_os',remove_empty('<?php echo $info['sph_os']?>'));
    set_selected_option('cyl_od',remove_empty('<?php echo $info['cyl_od']?>'));
    set_selected_option('cyl_os',remove_empty('<?php echo $info['cyl_os']?>'));
    set_selected_option('sph_od',remove_empty('<?php echo $info['sph_od']?>'));
    set_selected_option('axis_os',remove_empty('<?php echo $info['axis_os']?>'));
    set_selected_option('axis_od',remove_empty('<?php echo $info['axis_od']?>'));
    set_selected_option('add_od',remove_empty('<?php echo $info['add_od']?>'));
    set_selected_option('add_os',remove_empty('<?php echo $info['add_os']?>'));
    $('#patientName').val('<?php echo $info['patient_name'];?>');
    set_selected_option('PD',remove_empty('<?php echo $info['pd']?>'));
    set_selected_option('PD2',remove_empty('<?php echo $info['pd_left']?>'));
    set_selected_option('PD1',remove_empty('<?php echo $info['pd_right']?>'));
    $('#remarks').html('<?php echo $info['remarks'];?>')
    $("#next_step1").addClass("edit_entered_presc");
    $("#next_step1").attr("id","edit_<?php echo $info['fld_product'];?>");
    
</script>
<?
}
?>

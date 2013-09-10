<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/prescription.css">
<script src="<?php echo base_url().'js/admin/view_order_detail.js'?>" type="text/javascript"></script>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/order/index">Order Detail</a></div>
        </div>
        <div class="clear"></div>
        
        <table width="100%" cellpadding="5" cellspacing="0">
            <tr>
                <td colspan="4"><b>Order # : <?php echo $order->fld_id;?></b></td>
            </tr>
            <tr style="background:#f5f5f5;font-weight: bold;">
                <td colspan="2">Payment Information</td><td colspan="2" style="text-align:right;">Order Date : <?php echo $order->fld_date;?></td>
            </tr>
            <tr>
                <td width="15%">Name : </td><td width="35%"><?php echo $order->fld_first_name.' '.$order->fld_last_name;?></td>
                <td width="15%">Payment Status : </td><td width="35%"><?php echo $order->fld_payment_status;?></td>
            </tr>
            <tr>
                <td width="15%">Email : </td><td width="35%"><?php echo $order->fld_email;?></td>
                <td width="15%">Order No : </td><td width="35%"><?php echo $order->fld_id;?></td>
            </tr>
            <tr>
                <td width="15%">&nbsp;</td><td width="35%">&nbsp;</td>
                <td width="15%">Transaction Id : </td><td width="35%">N.A</td>
            </tr>
            <tr style="background:#f5f5f5;font-weight: bold;">
                <td colspan="4">Product Detail</td>
            </tr>
            
            <tr>
                <td colspan="4" style="border:1px solid #f5f5f5;">
                    
                    <table width="100%">
                        <tr>
                            <td><b>Product</b></td>
                            <td><b>Price</b></td>
                            <td><b>Lens Type</b></td>
                            <td><b>Frame Color</b></td>
                            <td><b>Prescription</b></td>
                            <td><b>Lens Package</b></td>
                            <td><b>Price</b></td>
                            <td><b>Lens Upgrade</b></td>
                            <td><b>Attribute</b></td>
                            <td><b>Price</b></td>
<!--                            <td><b>Accessories</b></td>-->
                            <td><b>Amount</b></td>
                        </tr>
                        <?php $total=0.00;$i=1;?>
                        <?php foreach($order_items->result() as $order_item):?>
                        <tr>
                            <td>
                                <?php echo $order_item->fld_product;?>
                            </td>
                            <td>    
                                <?php echo $order_item->fld_product_price;?>
                            </td>
                            <td>
                                <?php echo $order_item->fld_lens_type;?>
                            </td>
                            <?php $this->load->helper('admin/order_helper');$frame_color = frame_color($order_item->fld_id);?>
                            <td>
                                <?php echo $frame_color->fld_attribute_value;?>
                            </td>
                            <td>
                                <?php
                                $presc = prescription($order_item->fld_id);
                                    switch ($order_item->fld_prescription){
                                        case 1:
                                            echo '<a href="javascript:void(0);" style="color:#0a80e5;" class="view_presc" id="'.$presc->fld_id.'" title="Prescription for: '.$presc->fld_patient_name.'">View Presc</a>';
                                        break;
                                        case 2:
                                            echo '<a href="'.base_url().$presc->fld_prescription_path.'" target="_blank" style="color:#0a80e5;" title="'.$presc->fld_patient_name.'">View File</a>';
                                        break;
                                    }
                                ?>
                                
                            </td>
                            <td>
                                <?php echo $order_item->fld_lens_package;?>
                            </td>
                            <td>
                                <?php echo $order_item->fld_lens_package_price;?>
                            </td>
                            <td>
                                <?php echo $order_item->fld_lens_upgrade;?>
                            </td>
                            <td>
                                <?php $this->load->helper('admin/order_helper');$lens_up_attr = lens_up_attr($order_item->fld_id);?>
                                <?php echo $lens_up_attr->fld_upgrade_attribute_value;?> 
                            </td>
                            <td>
                                <?php echo $order_item->fld_lens_upgrade_price;?>
                            </td>
                                
<!--                            <td>none</td>-->
                            <td>
                                <?php $product_total[$i] = $order_item->fld_product_price + $order_item->fld_lens_package_price + $order_item->fld_lens_upgrade_price;?>
                                <?php echo number_format((float)$product_total[$i], 2, '.', '');?>
                                <?php $total = number_format((float)$total+$product_total[$i], 2, '.', '');?>
                            </td>
                            
                        </tr>
                        <?php $i++;?>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="10" style="text-align: right;">
                                <b>Total</b>
                            </td>
                            <td style="border-top: 1px solid #333;">
                                <?php echo $total;?>
                            </td>
                        </tr>
                    </table>
                    
                   
                </td>
            </tr>
            <tr style="background:#f5f5f5;font-weight: bold;">
                <td colspan="4">Shipping Information</td>
            </tr>
            <tr>
                <td>Shipping By : </td><td colspan="3"><?php echo $order->fld_carrier;?></td> 
            </tr>
            <tr>
                <td>Shipping Status : </td><td colspan="3"><?php echo $order->fld_status;?></td> 
            </tr>
            <tr>
                <td>Insurance Cost : </td><td colspan="3"><?php echo $order->fld_insurance_cost;?></td> 
            </tr>
            <tr>
                <td>Shipping Cost : </td><td colspan="3"><?php echo $order->fld_shipping_cost;?></td> 
            </tr>
            <tr style="background:#f5f5f5;font-weight: bold;">
                <td colspan="4">Address Detail</td>
            </tr>
            <tr>
                <td colspan="2">Shippping Address</td>
                <td colspan="2">Billing Address</td>
            </tr>
            <tr>
                <td width="15%">Name : </td><td width="35%"><?php echo $order->fld_first_name.' '.$order->fld_last_name;?></td>
                <td width="15%">Name : </td><td width="35%"></td>
            </tr>
            <tr>
                <td width="15%" style="vertical-align:top;">Address : </td>
                <td width="35%">
                    <?php if($order->fld_city!="") echo $order->fld_city.'<br/>';?>
                    <?php if($order->fld_state!="")echo $order->fld_state;?>,
                    <?php if($order->fld_country!="")echo $order->fld_country;?>
                </td>
                <td width="15%">Address : </td><td width="35%"></td>
            </tr>
            <tr>
                <td width="15%">Postal Code : </td><td width="35%">N.A</td>
                <td width="15%">Postal Code : </td><td width="35%"></td>
            </tr>
            <tr>
                <td width="15%">Contact No : </td><td width="35%"><?php echo $order->fld_contact_no;?></td>
                <td width="15%">Contact No : </td><td width="35%"></td>
            </tr>
            <tr style="background:#f5f5f5;font-weight: bold;">
                <td colspan="4">Payment Detail</td>
            </tr>
            <tr>
                <td>Total Payment : </td>
                <td>
                    <?php $total_payment = number_format((float)$total+$order->fld_insurance_cost+$order->fld_shipping_cost, 2, '.', '');?>
                    <?php echo $total_payment;?>
                </td>
                <td>Payment Status : </td><td><?php echo $order->fld_payment_status;?></td>
            </tr>
            <tr>
                <td>Transaction ID : </td><td colspan="3">N.A</td>
            </tr>
            
            
            
        </table>
    </div>
</div>



<div class="popup_presc">
    <div class="presc_wrapper">
        <table class="presc_tbl">
            <tr>
                <th id="patient_name" colspan="6">Prescription for: </th>
            </tr>
            <tr>
                <th class="presc_title">&nbsp;</th>
                <th class="presc_title">SPH</th>
                <th class="presc_title">CYL</th>
                <th class="presc_title">Axis</th>
                <th class="presc_title">Add</th>
                <th class='presc_title'>Power</th>
            </tr>
            <tr>
                <th>OD</th>
                <td id="sph_od"></td>
                <td id="cyl_od"></td>
                <td id="axis_od"></td>
                <td id="add_od"></td>
                <td id="power_od"></td>
            </tr>
            <tr>
                <th>OS</th>
                <td id="sph_os"></td>
                <td id="cyl_os"></td>
                <td id="axis_os"></td>
                <td id="add_os"></td>
                <td id="power_os"></td>
            </tr>
            <tr>
                <th>PD</th>
                <td colspan="5" id="pd"></td>
            </tr>
            <tr>
                <th>PD Right</th>
                <td id="pd_right" colspan="2"></td>
                <th>PD Left</th>
                <td id="pd_left" colspan="2"></td>                
            </tr>
            <tr>
                <th>Remarks</th>
                <td colspan="5" id="remarks"></td>
            </tr>
        </table>
        <div class="action_btn">
            <a class="btn" id="presc_done">Done</a>
            <a class="btn">Export To PDF</a>
        </div>
    </div>
</div>
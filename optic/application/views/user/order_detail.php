<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/user/dashboard.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/prescription.css">
<script src="<?php echo base_url().'js/admin/view_order_detail.js'?>" type="text/javascript"></script>
<div class="wrapper">
    <div class="left_div">
        <?php $this->load->view('user/left_panel');?>
    </div>
    <div class="right_div margin_top">
        <h1 class="margin_bottom">Order Detail</h1>
        <div class="hr"><hr/></div>
        <h3>Order Summary</h3>
        <p>
            <b>Invoice :</b><?php echo $order->fld_invoice;?><br/>
            <b>Order No : </b><?php echo $order->fld_id;?><br/>
            <b>Order Status : </b><?php echo $order->fld_status;?><br/>
            <b>Total Payment : </b>
                                    <?php $total=0.00;$i=1;?>
                                    <?php foreach($order_items->result() as $order_item):?>
                                    <?php $product_total[$i] = $order_item->fld_product_price + $order_item->fld_lens_package_price + $order_item->fld_lens_upgrade_price;?>
                                    <?php number_format((float)$product_total[$i], 2, '.', '');?>
                                    <?php $total = number_format((float)$total+$product_total[$i], 2, '.', '');?>
                                    <?php $total_payment = number_format((float)$total+$order->fld_insurance_cost+$order->fld_shipping_cost, 2, '.', '');?>
                                    <?php endforeach;?><span style="color:#e80000;">$<?php echo $total_payment;?></span><br/>
            <b>Payment Status : </b><?php echo $order->fld_payment_status;?><br/>
            <b>Transition Id :  </b><?php echo $order->fld_txn_id;?><br/>
            <b>Order Date : </b><?php echo $order->fld_date;?><br/>
        </p>
        <div class="hr"><hr/></div>
        <h3>Order Item(s)</h3>
        
        <?php foreach($order_items->result() as $order_item):?>
        <div class="item">
            <div class="item_info">
                <b>Eye wear : </b><?php echo $order_item->fld_product;?><br/>
                <b>Quantity : </b>1<br/>
                <b>Frame Color : </b><?php $this->load->helper('admin/order_helper');$frame_color = frame_color($order_item->fld_id);?>
                                     <?php echo $frame_color->fld_attribute_value;?><br/>
                <b>Frame Price : </b><span style="color:#e80000;">$<?php echo $order_item->fld_product_price;?></span>
            </div>

            <div class="lens_info">
                <b>Lens Type : </b><?php echo $order_item->fld_lens_type;?><br/>
                <b>Lens Package : </b><?php echo $order_item->fld_lens_package;?>
                <span style="color:#e80000;">$<?php echo $order_item->fld_lens_package_price;?></span>
                <br/>
                <?php echo $this->load->helper('admin/order_helper');$lens_pkg_attrs = lens_pkg_attrs($order_item->fld_id);?>
                <?php foreach($lens_pkg_attrs->result() as $lens_pkg_attr):?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &bigstar;&nbsp;<?php echo $lens_pkg_attr->fld_lens_attribute;?><br/>
                <?php endforeach;?>
                <b>Lens Upgrade : </b><?php echo $order_item->fld_lens_upgrade;?>
                <span style="color:#e80000;">$<?php echo $order_item->fld_lens_upgrade_price;?></span>
                <br/>
                <?php $this->load->helper('admin/order_helper');$lens_up_attr = lens_up_attr($order_item->fld_id);?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &bigstar;&nbsp;<?php echo $lens_up_attr->fld_upgrade_attribute_value;?> 
            </div>
            <div class="prescription">
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
            </div>
            <div class="sub_total">
                Sub Total Price : <?php $product_total[$i] = $order_item->fld_product_price + $order_item->fld_lens_package_price + $order_item->fld_lens_upgrade_price;?>
                <span style="color:#e80000;">$<?php echo number_format((float)$product_total[$i], 2, '.', '');?></span>
            </div>
        </div>
        <br/>
        <?php endforeach;?>
        <div class="hr"><hr style="margin:-20px 0;;padding:0;"/></div>
        <div class="shipping">
            <h3>Shipping Information</h3>
            <b>Shipping By : </b><?php echo $order->fld_carrier;?><br/>
            <b>Shipping Status : </b><?php echo $order->fld_payment_status;?><br/>
            <b>Insurance Cost : </b><span style="color:#e80000;">$<?php echo $order->fld_insurance_cost;?></span><br/>
            <b>Shipping Cost : </b><span style="color:#e80000;">$<?php echo $order->fld_shipping_cost;?></span><br/>
            
        </div>
        <div class="total">
            <?php $total_payment = number_format((float)$total+$order->fld_insurance_cost+$order->fld_shipping_cost, 2, '.', '');?>
            <?php //echo $total_payment;?>
            <br/>
            Total Amount : <span style="color:#e80000;">$<?php echo $total_payment;?></span>
        </div>
        
    </div>
</div>
<style>
    div.item{overflow: auto;padding-bottom: 20px;border-bottom: 1px solid #f5f5f5;}
    div.item_info{float:left;width: 300px;}
    div.lens_info{float:left;}
    div.sub_total{text-align: right;float:left;width: 100%;}
    div.total{width: 100%;text-align: right;}
    div.shipping{padding-top: 30px;padding-bottom: 20px;border-bottom: 1px solid #f5f5f5;}
</style>


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
            <!--<a class="btn">Export To PDF</a>-->
        </div>
    </div>
</div>
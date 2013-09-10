<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/admin/jquery-ui.css';?>">
<script type="text/javascript" src="<?php echo base_url().'js/admin/jquery-ui.js"';?>"></script>
<script>
$(function() {
            $( "#txtCheckin, #txtCheckout" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#txtCheckin, #txtCheckout" ).datepicker('option', {
                    beforeShow: customRange
                    });
//                     $("input[name='txtCheckin']").val("<?php if(isset($txtCheckin))echo $txtCheckin; ?>");
//                     $("input[name='txtCheckout']").val("<?php if(isset($txtCheckout))echo $txtCheckout; ?>");
//                     $("input[name='fld_order_by']").val("<?php if(isset($fld_order_by))echo $fld_order_by; ?>");
//                     document.getElementById('fld_city').selectedIndex =  getIndex(document.getElementById("fld_city"), '<?php if(isset($fld_city)) echo $fld_city; ?>');
});
function customRange(input) {
		  if (input.id == 'txtCheckout') {
			return {
			  minDate: jQuery('#txtCheckin').datepicker("getDate")
			};
		  } else if (input.id == 'txtCheckin') {
			return {
			  maxDate: jQuery('#txtCheckout').datepicker("getDate")
			};
		  }
		}
</script>
<div class="container">
    <?php $this->load->view('admin/left_panel');?>
    <div class="right_div">
        <?php if($this->session->flashdata('msg')):?><div class="sess_msg"><?php echo $this->session->flashdata('msg');?></div><?php endif;?>
        
        <div class="operations">
            <div class="operation"><a href="<?php echo base_url();?>admin/order/index">Order Manager</a></div>
<!--            <div class="operation" style="color:#fff;">|</div>
            <div class="operation"><a href="<?php echo base_url();?>admin/order/insert">Add</a></div>-->
        </div>
        <div class="order_search" style="border: 1px solid #F0F0F0;padding: 5px 0;">
            <form name="frm_order_search" method="get" action="<?php echo base_url().'admin/order/search';?>">
                <table width="100%">
                    <tr>
                        <td>Order By</td>
                        <td><input type="text" name="orderby" value="<?php if(isset($orderby))echo $orderby;?>"></td>
                        <td>Invoice</td>
                        <td><input type="text" name="invoice" value="<?php if(isset($invoice))echo $invoice;?>"></td>
                        <td>Status</td>
                        <td>
                            <select name="status" id="status">
                                <option value="">status</option>
                                <option value="New Order">New Order</option>
                                <option value="Hold">Hold</option>
                                <option value="Under Process">Under Process</option>
                                <option value="Lens On Order">Lens On Order</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Canceled">Canceled</option>
                                <option value="Need more info">Need more info</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Date From</td>
                        <td><input type="text" name="txtCheckin" id="txtCheckin" value="<?php if(isset($txtCheckin))echo $txtCheckin;?>"></td>
                        <td>Date To</td>
                        <td><input type="text" name="txtCheckout" id="txtCheckout" value="<?php if(isset($txtCheckout))echo $txtCheckout;?>"></td>
                        <td colspan="2"><input type="submit" value="Search Order"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="clear"></div>
        <table width="100%">
            <tr style="font-weight:bold;">
<!--                <td width="5%">S.N</td>-->
                <td width="10%">Order No</td>
                <td width="15%">Order By</td>
                <td width="10%">Order Date</td>
                <td width="10%">Invoice</td>
                <td width="5%">Discount</td>
                <td width="15%">Payment Status</td>
                <td width="15%">Status</td>
                
                <td width="30%">Operations</td>
            </tr>
            <?php //$count=1;?>
            <?php foreach($orders->result() as $order):?>
            <tr>
<!--                <td><?php echo $count;?></td>-->
                <td><?php echo $order->fld_id;?></td>
                <td><?php echo $order->fld_first_name.' '.$order->fld_last_name;?></td>
                <td><?php echo $order->fld_date;?></td>
                <td><?php echo $order->fld_invoice;?></td>
                <td><?php if($order->fld_promocode_discount==0.00){echo 'na';}else{echo $order->fld_promocode_discount;}?></td>
                <td><?php echo $order->fld_payment_status;?></td>
                <td><?php echo $order->fld_status;?></td>
                <td>
                    <a class="operation" href="<?php echo base_url().'admin/order/detail/'.$order->fld_id;?>">Detail</a> |
<!--                    <a class="operation" href="<?php echo base_url().'admin/order/edit/'.$order->fld_id;?>">Edit</a> |-->
                    <a class="operation" href="javascript:void(0);">Edit</a> |
                    <a class="operation" href="<?php echo base_url().'admin/order/delete/'.$order->fld_id;?>">Delete</a>
                </td>
                
            </tr>
            <?php //$count++;?>
            <?php endforeach;?>
        </table>
    </div>
    <div class="pagination" align="center">
        <?php echo $this->pagination->create_links();?>
    </div>
           
</div>
<style>
div.label{padding-top: 6px;width:100px;}
div.input{}
</style>
<?php if(isset($status)):?>
<script>
    var value = "<?php echo $status;?>";
    $("#status option[value="+value+"]").prop("selected", true);
</script>  
<?php endif;?>
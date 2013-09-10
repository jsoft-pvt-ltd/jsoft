<?php

//print_r($_POST);exit;

$dbusername     = 'root'; //db username
$dbpassword     = ''; //db password
$dbhost     = 'localhost'; //db host
$dbname     = 'db_optic';
//$dbusername     = 'jhamel_thangka'; //db username
//$dbpassword     = 'nepal123'; //db password
//$dbhost     = 'localhost'; //db host
//$dbname     = 'jhamel_thangka';
$shipping_country;
$shipping_country_id;
$carrier;
$shipping_cost;
$add_shipping_cost;
$insurance_cost;
$add_insurance_cost;

$total_shipping;
$total_insurance;
 $conn = mysql_connect($dbhost,$dbusername,$dbpassword);
            if (!$conn)
            {
             die('Could not connect: ' . mysql_error());
            }
        mysql_select_db($dbname, $conn);
        
        $query ='SELECT tbl_country.fld_name, tbl_carrier.*
            FROM tbl_country LEFT JOIN tbl_carrier 
            ON tbl_country.fld_id = tbl_carrier.fld_country 
            WHERE tbl_carrier.fld_id ='.$_REQUEST['carrier'];
        $result = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_array($result)){
            $shipping_country       =   $row['fld_name'];
            $shipping_country_id    =   $row['fld_country'];
            $carrier                =   $row['fld_carrier'];
            $shipping_cost          =   $row['fld_shipping_cost'];
            $add_shipping_cost      =   $row['fld_additional_cost'];
            $insurance_cost         =   $row['fld_insurance_cost'];
            $add_insurance_cost     =   $row['fld_additional_insurance_cost'];
        }
        $total_shipping     =   $shipping_cost+$add_shipping_cost;
        $total_insurance    =   $insurance_cost + $add_insurance_cost;
     
mysql_close(); 

$url = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
$path = $url.'pay_pal/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('lib/PPLoggingManager.php');

$logger = new PPLoggingManager('SetExpressCheckout');

//$url = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
$returnUrl = "$url/GetExpressCheckout.php";
$cancelUrl = "http://localhost/optic/site/cart_steps/view_cart" ;

$currencyCode = $_REQUEST['currencyCode'];
$shippingTotal = new BasicAmountType($currencyCode, $total_shipping);
$handlingTotal = new BasicAmountType($currencyCode, $_REQUEST['handlingTotal']);
$insuranceTotal = new BasicAmountType($currencyCode, $total_insurance);

$address = new AddressType();
$address->CityName = $_REQUEST['city'];
$address->Name = $_REQUEST['name'];
$address->Street1 = $_REQUEST['street'];
$address->StateOrProvince = $_REQUEST['state'];
$address->PostalCode = $_REQUEST['postalCode'];
$address->Country = $_REQUEST['countryCode'];
$address->Phone = $_REQUEST['phone'];

$paymentDetails = new PaymentDetailsType();
$itemTotalValue = 0;
$taxTotalValue = 0;
session_start();
for($i=0; $i<count($_REQUEST['sub_total']); $i++) {
	$itemAmount = new BasicAmountType($currencyCode, $_REQUEST['sub_total'][$i]);	
	$itemTotalValue += $_REQUEST['sub_total'][$i] * $_REQUEST['itemQuantity'][$i]; 
	$taxTotalValue += $_REQUEST['itemSalesTax'][$i] * $_REQUEST['itemQuantity'][$i];
	$itemDetails = new PaymentDetailsItemType();
	$itemDetails->Name = $_REQUEST['product_code'][$i];
	$itemDetails->Amount = $itemAmount;
	$itemDetails->Quantity = $_REQUEST['itemQuantity'][$i];
	$itemDetails->ItemCategory = $_REQUEST['itemCategory'][$i];
	$itemDetails->Tax = new BasicAmountType($currencyCode, $_REQUEST['itemSalesTax'][$i]);	
	
	$paymentDetails->PaymentDetailsItem[$i] = $itemDetails;	
}

$orderTotalValue = $shippingTotal->value + $handlingTotal->value +
$insuranceTotal->value +
$itemTotalValue + $taxTotalValue;

$paymentDetails->ShipToAddress = $address;
$paymentDetails->ItemTotal = new BasicAmountType($currencyCode, $itemTotalValue);
$paymentDetails->OrderTotal = new BasicAmountType($currencyCode, $orderTotalValue);
$paymentDetails->TaxTotal = new BasicAmountType($currencyCode, $taxTotalValue);
$paymentDetails->PaymentAction = $_REQUEST['paymentType'];

$paymentDetails->HandlingTotal = $handlingTotal;
$paymentDetails->InsuranceTotal = $insuranceTotal;
$paymentDetails->ShippingTotal = $shippingTotal;

if(isset($_REQUEST['notifyURL']))
{
	$paymentDetails->NotifyURL = $_REQUEST['notifyURL'];
}
$_SESSION['payment'] = $paymentDetails;
$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
$setECReqDetails->PaymentDetails[0] = $paymentDetails;
$setECReqDetails->CancelURL = $cancelUrl;
$setECReqDetails->ReturnURL = $returnUrl;

// Shipping details
$setECReqDetails->NoShipping = $_REQUEST['noShipping'];
$setECReqDetails->AddressOverride = $_REQUEST['addressOverride'];
$setECReqDetails->ReqConfirmShipping = $_REQUEST['reqConfirmShipping'];

// Billing agreement
$billingAgreementDetails = new BillingAgreementDetailsType($_REQUEST['billingType']);
$billingAgreementDetails->BillingAgreementDescription = $_REQUEST['billingAgreementText'];
$setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);

// Display options
$setECReqDetails->cppheaderimage = $_REQUEST['cppheaderimage'];
$setECReqDetails->cppheaderbordercolor = $_REQUEST['cppheaderbordercolor'];
$setECReqDetails->cppheaderbackcolor = $_REQUEST['cppheaderbackcolor'];
$setECReqDetails->cpppayflowcolor = $_REQUEST['cpppayflowcolor'];
$setECReqDetails->cppcartbordercolor = $_REQUEST['cppcartbordercolor'];
$setECReqDetails->cpplogoimage = $_REQUEST['cpplogoimage'];
$setECReqDetails->PageStyle = $_REQUEST['pageStyle'];
$setECReqDetails->BrandName = $_REQUEST['brandName'];

// Advanced options
$setECReqDetails->AllowNote = $_REQUEST['allowNote'];

$setECReqType = new SetExpressCheckoutRequestType();
$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
$setECReq = new SetExpressCheckoutReq();
$setECReq->SetExpressCheckoutRequest = $setECReqType;

$paypalService = new PayPalAPIInterfaceServiceService();
try {
	/* wrap API method calls on the service object with a try catch */
	$setECResponse = $paypalService->SetExpressCheckout($setECReq);
} catch (Exception $ex) {
    include_once("../pay_pal/Error.php");
	exit;
}

if(isset($setECResponse)) {
	if($setECResponse->Ack =='Success') {
		$token = $setECResponse->Token;
		// Redirect to paypal.com here
//		header('Location: https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . $token);
        echo '<script>window.location="https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token='.$token.'"</script>';
		//echo" <a href=$payPalURL><b>* Redirect to PayPal to login </b></a><br>";
	}
}
//require_once '../pay_pal/Response.php';
//redirect('https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=')
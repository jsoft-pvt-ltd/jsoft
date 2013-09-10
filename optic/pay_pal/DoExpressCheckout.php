<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('lib/PPLoggingManager.php');
session_start();
$url = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']);

$logger = new PPLoggingManager('DoExpressCheckout');
$token =urlencode( $_REQUEST['Token']);
$payerId=urlencode(  $_REQUEST['PayerID']);
$paymentAction = urlencode(  $_REQUEST['paymentAction']);

// ------------------------------------------------------------------
// this section is optional if parameters required for DoExpressCheckout is retrieved from your database
$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);
$getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();
$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;

$paypalService = new PayPalAPIInterfaceServiceService();
try {
	/* wrap API method calls on the service object with a try catch */
	$getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
} catch (Exception $ex) {
	include_once("Error.php");
	exit;
}
//----------------------------------------------------------------------------

$orderTotal = new BasicAmountType();
$orderTotal->currencyID = $_REQUEST['currencyCode'];
$orderTotal->value = $_REQUEST['amt'];

$paymentDetails= new PaymentDetailsType();
$paymentDetails->OrderTotal = $orderTotal;
if(isset($_REQUEST['notifyURL']))
{
	$paymentDetails->NotifyURL = $_REQUEST['notifyURL'];
}

$DoECRequestDetails = new DoExpressCheckoutPaymentRequestDetailsType();
$DoECRequestDetails->PayerID = $payerId;
$DoECRequestDetails->Token = $token;
$DoECRequestDetails->PaymentAction = $paymentAction;
$DoECRequestDetails->PaymentDetails[0] = $_SESSION['payment'];
//$DoECRequestDetails->PaymentDetails[0] = $paymentDetails;

$DoECRequest = new DoExpressCheckoutPaymentRequestType();
$DoECRequest->DoExpressCheckoutPaymentRequestDetails = $DoECRequestDetails;


$DoECReq = new DoExpressCheckoutPaymentReq();
$DoECReq->DoExpressCheckoutPaymentRequest = $DoECRequest;
try {
	/* wrap API method calls on the service object with a try catch */
	$DoECResponse = $paypalService->DoExpressCheckoutPayment($DoECReq);
} catch (Exception $ex) {
	include_once("Error.php");
	exit;
}
if(isset($DoECResponse)) {
	if(isset($DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo)) {
		$txn_id = $DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->TransactionID;
        $total_amt = $DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->GrossAmount->value;
        $payment_status = $DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->PaymentStatus;
        $_SESSION['txn_id'] = $txn_id;
        $_SESSION['total_amt'] = $total_amt;
        $_SESSION['payment_status'] = $payment_status;
        
        echo '<script>window.location="http://localhost/optic/site/cart_steps/purchased_paypal"</script>';
	}
    else echo 'There is a problem: Please report to your web Administrator.';
}
require_once 'Response.php';
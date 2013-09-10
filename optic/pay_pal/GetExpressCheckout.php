<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('lib/PPLoggingManager.php');
//session_start();

$logger = new PPLoggingManager('GetExpressCheckout');

$token = $_REQUEST['token'];

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
if(isset($getECResponse)) {
	if($getECResponse->Ack=="Success"){
        $token = $getECResponse->GetExpressCheckoutDetailsResponseDetails->Token;
        $payerID = $_REQUEST['PayerID'];
        $payerStatus = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerStatus;
       //echo '<a href="http://localhost/optic/pay_pal/DoExpressCheckout.php?Token='.$token.'&PayerID='.$payerID.'">continue</a>';
        echo '<script>window.location = "http://localhost/optic/pay_pal/DoExpressCheckout.php?Token='.$token.'&PayerID='.$payerID.'"</script>';
//        exit;
//         header('Location: http://localhost/optic/pay_pal/DoExpressCheckout.php?Token='.$token. '&PayerID='.$payerID);
    };
}
require_once 'Response.php';
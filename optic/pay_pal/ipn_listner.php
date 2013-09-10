<?php
    $mode       = 'sandbox'; //Sandbox for testing or empty ''
    $dbusername     = 'root'; //db username
    $dbpassword     = ''; //db password
    $dbhost     = 'localhost'; //db host
    $dbname     = 'db_optic'; //db name
//    $mode       = 'sandbox'; //Sandbox for testing or empty ''
//    $dbusername     = 'root'; //db username
//    $dbpassword     = ''; //db password
//    $dbhost     = 'localhost'; //db host
//    $dbname     = 'db_thangka';

    
    
    
    
    
//            $fld_paypal_trans_id = $_POST['txn_id'];
//            $fld_paypal_payer_id = $_POST['payer_id'];
//            $fld_first_name = $_POST['first_name'];
//            $fld_last_name = $_POST['last_name'];
//            $fld_email = $_POST['payer_email'];
//            $fld_email = $_POST[' receiver_email'];
//            $fld_paypal_trans_date = $_POST['payment_date'];
//            date_default_timezone_set('Asia/Katmandu');
//            $fld_trans_date = date("Y-m-d");
//            $fld_payment_status = $_POST['payment_status'];
//            $fld_country = $_POST['address_country'];
//            $fld_state =$_POST['address_state'];
//            $fld_city = $_POST['address_city'];
//            $fld_street = $_POST['address_street'];
//            $fld_rowid = $_POST['item_number1'];
//            $fld_rowid = explode("_", $fld_rowid);
//            $userId = $fld_rowid[1];
//            
//            $data = array(
//                'post' => $_POST,
//                'userId' => $userId
//            );
//            print_r($data);
//            file_put_contents("abc.txt", print_r($data,TRUE));
//            exit;
    
    
    
    
    
    
    
    
    
    
    
// random number generator
$pwd="";

for($i=0;$i<8;$i++)
{
$num=rand(48,122);
  if(($num > 97 && $num < 122))
  {
      $pwd.=chr($num);
  }
  else if(($num > 65 && $num < 90))
  {
      $pwd.=chr($num);
  }
  else if(($num >48 && $num < 57))
  {
      $pwd.=chr($num);
  }
  else if($num==95)
  {
      $pwd.=chr($num);
  }
  else
  {
      $i--;
  }
}
$invoice = $pwd; 
//// random number generator
    //===================================================================================================================

    if($_POST)
    {
        
        if($mode=='sandbox')
        {
            $paypalmode     =   '.sandbox';
        }
        $req = 'cmd=' . urlencode('_notify-validate');
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$paypalmode.'.sandbox.paypal.com'));
        $res = curl_exec($ch);
        curl_close($ch);

        if (strcmp ($res, "VERIFIED") == 0)
        {
            $txn_id = $_POST['txn_id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $payer_email = $_POST['payer_email'];
            $country = $_POST['address_country'];
            $state =$_POST['address_state'];
            $city = $_POST['address_city'];
            $street = $_POST['address_street'];
            $zip = $_POST['address_zip'];
            
            $data = array(
                'post' => $_POST
            );
            file_put_contents("abc.txt", print_r($data,TRUE));
            
    $conn = mysql_connect($dbhost,$dbusername,$dbpassword);
    if (!$conn)
    {
     die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($dbname, $conn);
    
    $query = "INSERT INTO tbl_shipping_details(
            fld_country,
            fld_state,
            fld_city,
            fld_street,
            fld_zip,
            fld_payer_email,
            fld_txn_id,
            fld_first_name,
            fld_last_name
        ) VALUES(
            '$country',
            '$state',
            '$city',
            '$street',
            '$zip',
            '$payer_email',
            '$txn_id',
            '$first_name',
            '$last_name'
        )";
    
    mysql_query($query);          
    mysql_close($conn);
    }
}
?>
<?php ob_start(); require_once("includes/smme-header.php");
require_once("class/wallet-payment.class.php");
$sitename = "www.paypal.com";
$req='cmd=_notify-synch';
$tx_id = $_GET['tx'];
//HARAHUL
//$auth_token = "-MH8BaLPze62eBDWQfupjK63k99cuqY1XiZf0Vt_5RQ3DdbWQAATQFhGBSi";
//BHAVESH
$auth_token = "GN4hBl5ao6R4jXDWm6UTBVOxcFC96SHk5A2_9Q0GYIkzodTJHjOe3mC4EcW";
//Bhavesh Hd
//$auth_token = "J7g9YodF2d-zAz39lEMRuX5_OXHyaKDSih41XI30mvJl26dh1s_673MHbnq";
$req.= "&tx=$tx_id&at=$auth_token";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://$sitename/cgi-bin/webscr");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $sitename"));
$res = curl_exec($ch);
curl_close($ch);
if(!$res){
header("location:smme-dashboard.php");
}else{
$lines = explode("\n", $res);
$paydetails = array();
if (strcmp ($lines[0], "SUCCESS") == 0) {
for ($i=1; $i<count($lines);$i++){
list($key,$val) = explode("=", $lines[$i]);
$paydetails[urldecode($key)] = urldecode($val);
}
$item_name=$paydetails['item_name'];
$item_transaction = $paydetails['txn_id']; 
$item_price = $paydetails['payment_gross']; 
$item_currency = $paydetails['mc_currency']; 
$payer_email=$paydetails['payer_email']; 
$receiver_email=$paydetails['receiver_email']; 
$date=$paydetails['payment_date'];
$wallet=new wallet(); 	

if($wallet->checkautopaymentpaypal()==1){
$pstatus=$wallet->addbalance($item_name,$item_transaction,$item_price,$item_currency,$payer_email,$receiver_email,$date);	
header("location:smme-dashboard.php");  
}else{
header("location:smme-paymentalert.php");  
}
}
else if (strcmp ($lines[0], "FAIL") == 0) {
header("location:smme-dashboard.php");
}
}
require_once("includes/smme-footer.php");
?>
<?php require_once("class/secureapi.class.php");
$res=json_decode($_GET['request'],true);
$email=$res['email'];
$scode=$res['scode'];
$key=$res['key'];
$perform=$res['perform'];
if(isset($_GET['request']) && $_GET['request']!=""){
$obj=new apiclass();
$ipcheck=$obj->ipblocklist($_SERVER['REMOTE_ADDR']);
if($ipcheck==0){
$logincheck=$obj->checkapidetails($email,$scode,$key);
if($logincheck==1){
if($perform=="neworder"){
$service=$res['orders'][0]['service'];
$type=$res['orders'][0]['type'];
$count=$res['orders'][0]['count'];
$data=$res['orders'][0]['data'];
$returncode=$obj->makeorder($email,$scode,$key,$service,$type,$count,$data);	
}
else if($perform=="orderdetails"){
$orderid=$res['orderno'];		
$returncode=$obj->getorderdetails($email,$scode,$key,$orderid);	
}
}else {
$obj->addwrongdetails($email,$scode,$key);
$returncode=array("Code"=>"999","Message"=>"Auth Failed");	
}
}
else {
$returncode=array("Code"=>"1000","Message"=>"Auth Failed");	
}
print_r(json_encode($returncode));
}
?>
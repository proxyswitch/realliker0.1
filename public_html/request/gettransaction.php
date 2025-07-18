<?php require_once("../class/usertransaction.class.php");
if(isset($_POST['action']) && $_POST['action']=="transaction"){
$transactionobj=new transaction();
$res=$transactionobj->usertransaction($_POST['page'],5);
if(is_array($res)){
$msgs='<table class="ordertable table">
<thead><tr>
<th>Transaction No</th>
<th>Date</th>
<th>Details</th>
<th>Before Balance</th>
<th>Amount</th>
<th>Credit/Debit</th>
<th>After Balance</th>
</tr></thead><tbody>';
foreach($res[0] as $row){
if($row['perform']=='-'){
$paymentoperation="Debited";	
}else{
$paymentoperation="Credited";
}
if($row['orderid']!=0 && $row['perform']=="-" ){
$purchase=$transactionobj->getpaymentorderdetails($row['orderid']);
$purchase=$purchase['count']." ".$purchase['display'];
}else if($row['orderid']!=0 && $row['perform']=="+" ){
$ress=$transactionobj->getpaymentorderdetails($row['orderid']);
if($ress['refundreason']!=""){
$refundreason=" ( ".$ress['refundreason']." )";	
}else{
$refundreason="";	
}
$purchase="Refund for order no: ".$row['orderid']." and Reference Transaction No: T".$ress['txno']."<br>".$ress['count']." ".$ress['display'].$refundreason;
}else{
$purchase=$transactionobj->getadmintransactionitem($row['admintxid']);
}

$msgs.='<tr>
<td>'.$row['id'].'</td>
<td>'.date("d-m-Y h:i:s a",strtotime($row['dates'])).'</td>
<td>'.$purchase.'</td>
<td>$'.$row['bbalance'].'</td>
<td>$'.$row['amount'].'</td>
<td>'.$paymentoperation.'</td>
<td>$'.$row['abalance'].'</td>
</tr>';
}
$msgs.='</tbody></table>';
$msg='<div class="pagloading text-center" style="display:none;"><img src="img/ajax-load.gif" class="orderajaximage"> Processing please wait ...</div>';

$msgs=$msgs.$res[1].$msg;
echo $msgs;
}else {
	
echo "<div class='text-center'>No Record Found</div>";	
	
	}
}


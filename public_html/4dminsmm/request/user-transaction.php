<?php require_once("../class/user-transaction.class.php");
$admin=new usertransaction();
if($_POST['process']=="getrecords"){
$msgs="";	
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<div class="col-md-3 col-xs-offset-4"><p>Total Amount Credited : $'.number_format((float)$res[2], 2, '.', '').'</p>';
$msgs.='<p>Total Amount Debited  : $'.number_format((float)$res[3], 2, '.', '').'</p></div>';
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Tx No</th>
<th>Order No</th>
<th>UserName</th>
<th>Details</th>
<th>Before Balance</th>
<th>Price</th>
<th>Credit/Debit</th>
<th>After Balance</th>
<th>Created Date</th>
</tr>
</thead>   
<tbody>';
$i=1;
foreach($res[0] as $rows){
	
if($rows['perform']=="-"){
$operation="Debited";	
}else{
$operation="Credited";	
}	
if($rows['orderid']!=0 && $rows['perform']=="-" ){
$purchase=$admin->getordertransactionitem($rows['orderid']);
$purchase=$purchase['count']." ".$purchase['display'];
}else if($rows['orderid']!=0 && $rows['perform']=="+" ){
$ress=$admin->getordertransactionitem($rows['orderid']);
if($ress['refundreason']!=""){
$refundreason=" ( ".$ress['refundreason']." )";	
}else{
$refundreason="";	
}
$purchase="Refund for order no: ".$rows['orderid']." and Reference Transaction No: ".$ress['txno']."<br>".$ress['count']." ".$ress['display'].$refundreason;
}else{
$purchase=$admin->getadmintransactionitem($rows['admintxid']);
}
if($rows['orderid']==0){
$orderid="Admin tx: ".$rows['admintxid'];	
}else{
$orderid=$rows['orderid'];	
}
$msgs.='<tr>
<td>'.$rows['id'].'</td>
<td>'.$orderid.'</td>
<td>'.$rows['username'].'</td>
<td>'.$purchase.'</td>
<td>$'.$rows['bbalance'].'</td>
<td>$'.$rows['amount'].'</td>
<td>'.$operation.'</td>
<td>$'.$rows['abalance'].'</td>
<td>'.date("d-m-Y",strtotime($rows['dates'])).'</td>
</tr>';
$i++;
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}else{
	
$msgs.="<p class='text-center message'>".$r."</p>";	
	
	}
echo $msgs; 
}
elseif($_POST['process']=="changestatus"){
$r=$admin->changestatus($_POST['ids'],$_POST['status']);
echo  $r;
}
elseif($_POST['process']=="deleteorder"){
$r=$admin->deleteorder($_POST['ids']);
echo $r;
}
elseif($_POST['process']=="getorderdetails"){
$r=$admin->orderdetailsforrecreation($_POST['id']);
echo $r['orderid'].",".$r['orderid'].",".$r['count'].",".$r['url'].",".$r['status'].",".$r['Revertbalance'].",".$r['finishcount'].",".$r['refundreason'].",".$r['startcount'];
}
elseif($_POST['process']=="singleorderupdate"){
echo $r=$admin->singleorderupdate($_POST['orderno'],$_POST['url'],$_POST['status'],$_POST['refundamount'],$_POST['startcount'],$_POST['finishcount'],$_POST['reason']);
}




?>
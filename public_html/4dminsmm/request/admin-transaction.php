<?php require_once("../class/admin-transaction.class.php");
$admin=new admintransaction();
if($_POST['process']=="getrecords"){
$msgs="";	
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<div class="col-md-3 col-xs-offset-4"><p>Total Amount Credited : $'.number_format((float)$res[2], 2, '.', '').'</p>';
$msgs.='<p>Total Amount Debited  : $'.number_format((float)$res[3], 2, '.', '').'</p></div>';
$msgs.='<table class="table">
<thead>
<tr>
<th>Admin Tx</th>
<th>UserName</th>
<th>Item Name</th>
<th>Transaction Id</th>
<th>Amount</th>
<th>Payer Email</th>
<th>Receiver Email</th>
<th>From</th>
<th>Ip Address</th>
<th>Date</th>
</tr>
</thead>   
<tbody>';
$i=1;
foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['roteid'].'</td>
<td>'.$rows['username'].'</td>
<td>'.$rows['reason'].'</td>
<td>'.$rows['txid'].'</td>
<td>$'.$rows['amount'].'</td>
<td>'.$rows['payer_email'].'</td>
<td>'.$rows['receiver_email'].'</td>
<td>'.$rows['opfrom'].'</td>
<td>'.$rows['ipaddress'].'</td>
<td>'.date("m-d-Y h:i:s a",strtotime($rows['date'])).'</td>
</tr>';
$i++;
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}else{
$msgs.="<p class='text-center message'>".$res."</p>";
	
	
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
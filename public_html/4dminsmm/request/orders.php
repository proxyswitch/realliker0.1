<?php require_once("../class/orders.class.php");
$admin=new orders();
if($_POST['process']=="getrecords"){
$msgs="";	
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<thead>
<tr>
<th>Select</th>
<th>Tx No</th>
<th>UserName</th>
<th>Order No</th>
<th>Api Order No</th>
<th>Api Provider</th>
<th>Service</th>
<th>Url & Mentions</th>
<th>From</th>
<th>Start Count</th>
<th>Current Count</th>
<th>Remain Count</th>
<th>Price</th>
<th>Before Balance</th>
<th>After Balance</th>
<th>Refunded Amount</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
<th>Refunded<br> Tx No</th>
<th>Auto OrderId</th>
</tr>
</thead>   
<tbody>';
$i=1;
foreach($res[0] as $rows){
$refundtxno="";
$refundedamount=0;
if($rows['status']=="Refunded"){
$refundtxno=$rows['rtxno'];	
$refundedamount=$admin->getrefundedamount($rows['rtxno']);	
}	
if($rows['finishcount']==0){	
$requiredcount=$rows['count']+$rows['startcount'];
$leftcount=$requiredcount-$rows['startcount'];
}else {
$requiredcount=$rows['count']+$rows['startcount'];	
$leftcount=$requiredcount-$rows['finishcount'];
}
$currentcount=$rows['finishcount'];
if($rows['apipo']==0){
$apiprovider="None";	
}else{
$apiprovider=$admin->getapiprovidernamebyid($rows['apipo']);	
}
if($rows['apfrom']==1){
$apfrom="Api";
}else{
$apfrom="Panel";
}
$action='<div class="edit option" sid='.$rows['id'].' pid='.$rows['smmeid'].'>Edit</div>';  			
$msgs.='<tr>
<td><input type="checkbox" value='.$rows['id'].' class="selectmulti"></td>
<td>'.$rows['txno'].'</td>
<td>'.$rows['username'].'</td>
<td>'.$rows['id'].'</td>
<td>'.$rows['apiorderid'].'</td>
<td>'.$apiprovider.'</td>
<td>'.$rows['count']." ".$rows['display'].'</td>
<td><p >'.$rows['url'].'</p> & <p>'.$rows['extdata'].' & <p>'.$rows['icomments'].'</p></td>
<td>'.$apfrom.'</td>
<td>'.$rows['startcount'].'</td>
<td>'.$currentcount.'</td>
<td>'.$leftcount.'</td>
<td>$'.$rows['price'].'</td>
<td>$'.$rows['bbalance'].'</td>
<td>$'.$rows['abalance'].'</td>
<td>$'.$refundedamount.'</td>
<td ><label class="label rs'.$rows['status'].'">'.$rows['status'].'</label></td>
<td>'.date("d-m-y h:m:i a",strtotime($rows['date'])).'</td>
<td>'.$action.'</td>
<td>'.$refundtxno.'</td>
<td>'.$rows['autoorderid'].'</td>
</tr>';
$i++;
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
$msgs.='<div class="statustable">
<input type="button" class="mybutton selectall btn" value="Select All">
<input type="button" class="mybutton deselectall btn" value="Deselect All">
<input type="button" class="mybutton sprocessing btn" value="Processing">
<input type="button" class="mybutton sproceed btn" value="Proceed">
<input type="button" class="mybutton scomplete btn" value="Complete">
<input type="button" class="srefund btn" value="Refund">
<input type="button" class="serror btn" value="Error">
<input type="button" class="sdelete btn" value="Delete">
</div>';
}else{
$msgs='<div class="text-center message">'.$res.'</div>';	
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
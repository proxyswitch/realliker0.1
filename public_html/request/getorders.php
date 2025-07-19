<?php require_once("../class/userorders.class.php");
if(isset($_POST['action']) && $_POST['action']=="orders"){
$ordersobj=new orders();
$res=$ordersobj->getorders($_POST['search'],$_POST['page'],10);	
if(is_array($res)){
$msgs='<table class="table">
<thead><tr>
<th>Order No</th>
<th>Type</th>
<th>Price</th>
<th>Username/Url</th>
<th>Begin</th>
<th>Start/Current/Remain</th>
<th>Status</th>
<th>Action</th>
</tr></thead><tbody>';
foreach($res[0] as $row){
$orderid=$row['id'];
$count=$row['count'];
$type=$row['display'];
$price=$row['price'];
$url=$row['url'];
if($row['refundreason']!=""){
$errortext="( ".$row['refundreason']." )";
}else {
$errortext="";
}
$starttime=date("d-m-y h:m:i a",strtotime($row['date']));
$finishtime="";
if($row['status']=="Completed" || $row['status']=="Refunded"){
$finishtime=date("d-m-y h:i:s a",strtotime($row['ftime']));	
}
$status=$row['status'];
$actionButtons="";
if($row['finishcount']==0){	
$requiredcount=$row['count']+$row['startcount'];
$leftcount=$requiredcount-$row['startcount'];
}else {
$requiredcount=$row['count']+$row['startcount'];	
$leftcount=$requiredcount-$row['finishcount'];
}
if($row['autoorderid']==0){
$autoo="";
}else{
$autoo="<br>Auto-".$row['autoorderid'];
}

if($status=="Completed"){
 $actionButtons='<button class="orderRefillBtn btn btn-xs btn-info" data-id="'.$orderid.'">Refill</button>';
}else{
 $actionButtons="";
}


$stcurcom=$row['startcount']."/&nbsp;".$row['finishcount']."/&nbsp;".$leftcount;
$msgs.='<tr>
<td>'.$orderid.$autoo.'</td>
<td>'.$count." ".$type.'</td>
<td>$'.$price.'</td>
<td>
<span style="word-break: break-all;">'.$url.'<br>&'.$row['extdata'].''.$row['icomments'].'</span></td>
<td>'.$starttime.'</td>
<td>'. $stcurcom.'</td>
<td><label class="label rs'.$status.'">'.$status.'</label>&nbsp;<br>'.$errortext.'</td><td>'.$actionButtons.'</td>
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
?>
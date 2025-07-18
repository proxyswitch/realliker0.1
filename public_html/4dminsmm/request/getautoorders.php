<?php require_once("../class/userautoorders.class.php");
if(isset($_POST['action']) && $_POST['action']=="orders"){
$ordersobj=new autoorders();
$res=$ordersobj->getorders($_POST['search'],$_POST['page'],10);	
if(is_array($res)){
$msgs='<table class="table">
<thead><tr>
<th>Select</th>
<th>Auto Order Id</th>
<th>User</th>
<th>Instagram UserName</th>
<th>Instagram Url</th>
<th>Service</th>
<th>Count</th>
<th>Price Per Count</th>
<th>No of Post</th>
<th>Order/Nop</th>
<th>Status</th>
<th>Creation Date</th>
<th>LastChecked Date</th>
</tr></thead><tbody>';
foreach($res[0] as $row){
$serde=$ordersobj->getpriceforservice($row['serviceid'],$row['id']);

$orderadded=$ordersobj->getnoorderbyautoorder($row['id']);
$price=$serde[0];
$peritem=$serde[1];
if($row['userprivatestatus']==1){
$privateaccount="- Private Account";    
}else{
$privateaccount="";    
}
$msgs.='<tr>
<td><input type="checkbox" value='.$row['id'].' class="selectmulti"></td>
<td>'.$row['id'].'</td>
<td>'.$row['email'].'</td>
<td>'.$row['instaid'].'</td>
<td>'.$row['iusername'].' '.$privateaccount.'</td>
<td>'.$row['display'].'</td>
<td>'.$row['count'].'</td>
<td>$'.$price.'/'.$peritem.'</td>
<td>'.$row['noofpost'].'</td>
<td>'.$orderadded.'/'.$row['noofpost'].'</td>
<td>'.$row['autostatus'].'</td>
<td>'.date("d-m-y",strtotime($row['cdate'])).'</td>
<td>'.date("d-m-y",$row['lastchecked']).'</td>
</tr>';
}
$msgs.='</tbody></table>';

$msg='<div class="pagloading text-center" style="display:none;"><img src="img/ajax-load.gif" class="orderajaximage"> Processing please wait ...</div>';
$msgs=$msgs.$res[1].$msg;
$msgs.='<div class="statustable">
<input type="button" class="mybutton selectall btn" value="Select All">
<input type="button" class="mybutton deselectall btn" value="Deselect All">
<input type="button" class="mybutton sstart btn" value="Start">
<input type="button" class="mybutton spause btn" value="Pause">
<input type="button" class="mybutton scancel btn" value="Cancel">
</div>';

echo $msgs;
}else {
echo "<div class='text-center'>No Record Found</div>";	
}
}else if(isset($_POST['action']) && $_POST['action']=="autoorderaction"){
$ordersobj=new autoorders();
$ordersobj->changeautostatus123(trim($_POST['ids']),trim($_POST['status']));	
}
?>
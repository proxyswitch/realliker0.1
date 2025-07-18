<?php require_once("../class/userautoorders.class.php");
if(isset($_POST['action']) && $_POST['action']=="orders"){
$ordersobj=new autoorders();
$res=$ordersobj->getorders($_POST['search'],$_POST['page'],10);	
if(is_array($res)){
$msgs='<table class="table">
<thead><tr>
<th>Auto OrderId</th>
<th>UserName</th>
<th>Url</th>
<th>Service</th>
<th>Count</th>
<th>Price Per Count</th>
<th>No of Post</th>
<th>Order/Nop</th>
<th>Status</th>
<th>Creation Date</th>
<th>Last Checked Date</th>
<th>Action</th>
</tr></thead><tbody>';
foreach($res[0] as $row){
$serde=$ordersobj->getpriceforservice($row['serviceid']);
$orderadded=$ordersobj->getnoorderbyautoorder($row['id']);
$price=$serde[0];
$peritem=$serde[1];

if($row['status']=="1" || $row['status']=="2" || $row['status']=="3" || $row['status']=="5"){
$action='<input type="button" name="autoaction" id="'.$row['id'].'" value="Pause" class="btn btn-primary autoaction">';	
}else if($row['status']=="7"){
$action='<input type="button" name="autoaction" id="'.$row['id'].'" class="btn btn-primary autoaction" value="Start">';	
}else{
$action="";	
}
if($row['userprivatestatus']==1){
    
$accountprivate=" - Private Account";    
}else{
$accountprivate="";    
}
$msgs.='<tr>
<td>'.$row['id'].'</td>
<td>'.$row['instaid'].'</td>
<td>'.$row['iusername'].' '.$accountprivate.'</td>
<td>'.$row['display'].'</td>
<td>'.$row['count'].'</td>
<td>$'.$price.'/'.$peritem.'</td>
<td>'.$row['noofpost'].'</td>
<td>'.$orderadded.'/'.$row['noofpost'].'</td>
<td>'.$row['autostatus'].'</td>
<td>'.date("d-m-y",strtotime($row['cdate'])).'</td>
<td>'.date("d-m-y",$row['lastchecked']).'</td>
<td>'.$action.'</td>
</tr>';
}
$msgs.='</tbody></table>';
$msg='<div class="pagloading text-center" style="display:none;"><img src="img/ajax-load.gif" class="orderajaximage"> Processing please wait ...</div>';
$msgs=$msgs.$res[1].$msg;
echo $msgs;
}else {
echo "<div class='text-center'>No Record Found</div>";	
}


}else if(isset($_POST['action']) && $_POST['action']=="autoorderaction"){
$ordersobj=new autoorders();
$ordersobj->changeautostatus123(trim($_POST['id']),trim($_POST['status']));	
}
?>
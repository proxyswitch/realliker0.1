<?php require_once("../class/userticket.class.php");
if(isset($_POST['action']) && $_POST['action']=="tickets"){
$ordersobj=new tickets();
$res=$ordersobj->gettickets($_POST['page'],10);	
if(is_array($res)){
$msgs='<table class="table">
<thead><tr>
<th>Ticket No</th>
<th>Subject</th>
<th>Status</th>
<th>Created Date</th>
<th>Action</th>
</tr>
</thead><tbody>';
foreach($res[0] as $row){
if($row['status']==0){
$status="Open";	
$view="<a href='smme-tickets.php?ticket=".$row['id']."'>Reply</a>";
}else {
$status="Closed";	
$view="<a href='smme-tickets.php?ticket=".$row['id']."'>View</a>";
}
if($row['usernoti']==1){
$noti='<img src="../img/icon_new.gif">';
}else{
$noti="";
}
$msgs.='<tr>
<td>'.$row['id'].'</td>
<td>'.$row['subject'].'</td>
<td>'.$status." ".$noti.'</td>
<td>'.date("d-m-Y h:i:s a",strtotime($row['cdate'])).'</td>
<td>'.$view.'</td>
</tr>';
}
$msgs.='</tbody></table>';
$msgs=$msgs.$res[1];
echo $msgs;
}
}
else if(isset($_POST['replybox']) && $_POST['csrfToken']==$_SESSION['csrfTOken']){
$ordersobj=new tickets();
$res=$ordersobj->updateticket($_POST['ticketno'],$_POST['replybox']);	
echo $res;	
}
else if(isset($_POST['subject']) && $_POST['subject']!="" && $_POST['csrfToken']==$_SESSION['csrfTOken']){
$ordersobj=new tickets();
$res=$ordersobj->createticket($_POST['subject'],$_POST['message']);	
echo $res;	
}
?>
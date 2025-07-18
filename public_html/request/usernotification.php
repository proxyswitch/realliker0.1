<?php require_once("../class/usernotification.class.php");
if(isset($_POST['action']) && $_POST['action']=="notificationalert"){
$obj=new notification();
$res=$obj->getnotificationalert();
echo $res[0]."#".$res[1];
}
else if(isset($_POST['action']) && $_POST['action']=="notificationlist"){
$obj=new notification();
$res=$obj->getnotificationlist();
if(is_array($res)){
$msg="";
foreach($res as $noti){
$msg.= '<li class="notidate">'.date("d-m-y h:m:i a",strtotime($noti['cdate'])).'</li>';
$msg.= '<li>'.$noti['content'].'</li>';	
}
echo $msg;
}else{
echo '<li>u dont have any notification</li>';	
}
}
else if(isset($_POST['action']) && $_POST['action']=="notificationoff"){
$obj=new notification();
$res=$obj->notificationalertoff();
}

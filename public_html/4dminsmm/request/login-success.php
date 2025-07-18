<?php require_once("../class/login-success.class.php");
$admin=new loginsuccess();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>UserName</th>
<th>Login Time</th>
<th>Logout TIme</th>
<th>Ip address</th>
<th>Ip Status</th>
<th>Action</th>
</tr>
</thead>   
<tbody>';

foreach($res[0] as $rows){

if($rows['status']==1){
$ipstatus="Banned";
}
else{
$ipstatus="UnBanned";	
	}	
	
$msgs.='<tr>
<td>'.$rows['username'].'</td>
<td>'.date("d-m-y h:i:s a",strtotime($rows['logintime'])).'</td>
<td>'.date("d-m-y h:i:s a",strtotime($rows['logouttime'])).'</td>
<td>'.$rows['ipaddress'].'</td>
<td>'.$ipstatus.'</td>
<td class="center act" >
<span class="banip option" id="'.$rows['id'].'">Ban ip</span>
<span class="unbanip option" id="'.$rows['id'].'">UnBan ip</span>
</td></tr>';

}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="banip"){
echo $res=$admin->banip($_POST['id']);
}
elseif($_POST['process']=="unbanip"){
echo $res=$admin->unbanip($_POST['id']);
}

?>
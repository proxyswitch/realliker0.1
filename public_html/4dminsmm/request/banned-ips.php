<?php require_once("../class/banned-ips.class.php");
$admin=new bannedips();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Ipaddress</th>
<th>From</th>
<th>TIme</th>
<th>Action</th>
</tr>
</thead>   
<tbody>';
foreach($res[0] as $rows){
if($rows['from']==1){
$ipstatus="Admin";
}
else{
$ipstatus="Auto";	
}	
$msgs.='<tr>
<td>'.$rows['ipaddress'].'</td>
<td>'.$ipstatus.'</td>
<td>'.date("d-m-y h:i:s a",strtotime($rows['cdate'])).'</td>
<td class="center act" >
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
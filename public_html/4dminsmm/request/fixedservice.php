<?php require_once("../class/fixedservice.class.php");
$admin=new fixedservice();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Provider Name</th>
<th>Fixed Service</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>';

foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['provider'].'</td>
<td>'.$rows['service'].'</td>

<td class="center act" >
<span class="edit option" id="'.$rows['id'].'" service="'.$rows['service'].'" provider="'.$rows['providerid'].'">Edit</span>
<span class="delete option" id="'.$rows['id'].'">Delete</span>
</td></tr>';

}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="updatefixedservice"){
echo $res=$admin->updatefixedservice($_POST['provider'],$_POST['service'],$_POST['id']);
}
elseif($_POST['process']=="deletefixedservice"){ 
$r=$admin->deletefixedservice($_POST['id']);
echo $r;
}elseif($_POST['process']=="createfixedservice"){

$r=$admin->createfixedservice($_POST['provider'],$_POST['service']);
echo $r;
} 
?>
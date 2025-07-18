<?php require_once("../class/groups.class.php");
$admin=new groups();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Group Name</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>';

foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['group_name'].'</td>
<td class="center act" >
<span class="edit option" id="'.$rows['id'].'" groupname="'.$rows['group_name'].'">Edit</span>
<span class="delete option" id="'.$rows['id'].'">Delete</span>
</td></tr>';

}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="updategroup"){
echo $res=$admin->updategroup($_POST['id'],$_POST['groupname']);
}
elseif($_POST['process']=="deletegroup"){ 
$r=$admin->deletegroup($_POST['id']);
echo $r;
}elseif($_POST['process']=="creategroup"){
$r=$admin->creategroup($_POST['groupname']);
echo $r;
} 
?>
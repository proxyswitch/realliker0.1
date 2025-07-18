<?php require_once("../class/setting.class.php");
$admin=new setting();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Skype</th>
<th>From Email</th>
<th>Support Email</th>
<th>Paypal Email</th>
<th>Minimum Amount (Paypal)</th>
<th>Minimum Amount (2Checkout)</th>
<th>Action</th></tr>
</thead>   
<tbody>';	
foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['skype'].'</td>
<td>'.$rows['fromemail'].'</td>
<td>'.$rows['supportemail'].'</td>
<td>'.$rows['paypalemail'].'</td>
<td>'.$rows['minimum_pay'].'</td>
<td>'.$rows['2minimum_pay'].'</td>
<td class="center act" >
<span class="edit option" skype="'.$rows['skype'].'" fromemail="'.$rows['fromemail'].'" supportemail="'.$rows['supportemail'].'" paypalemail="'.$rows['paypalemail'].'" minimumamt="'.$rows['minimum_pay'].'" minimumamt2="'.$rows['2minimum_pay'].'">Edit</span>
</td></tr>';
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="updatesetting"){
echo $res=$admin->updatesetting($_POST['skype'],$_POST['fromemail'],$_POST['supportemail'],$_POST['paypalemail'],$_POST['minimumamt'],$_POST['minimumamt2']);
}
?>
<?php require_once("../class/users.class.php");
$admin=new users();
if($_POST['process']=="getrecords"){
$msgs="";	
$r=$admin->getrocords($_POST['username'],(int)$_POST['page'],10);
if(is_array($r)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Select</th>
<th>UserName</th>
<th>Email</th>
<th>Name</th>
<th>Group</th>
<th>Balance</th>
<th>Status</th>
<th>Verified</th>
<th>2Checkout</th>
<th>2Checkout Auto Payment</th>
<th>Paypal Aut Payment</th>
<th>Creation Date</th>
<th>Ip Address</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>';
foreach($r[0] as $rows){
if($rows['reason']==''){$reason="";}else { $reason=" (".$rows['reason'].")";}	
if($rows['status']=='0'){$activestatus="Active";}else { $activestatus="Deactive";}
if($rows['verified']==0){$verified="No";}else { $verified="Yes";
}

if($rows['2co']==0){$pco="No";}else { $pco="Yes";
}
if($rows['2choauto']==0){$paco="No";}else { $paco="Yes";
}	
if($rows['payauto']==0){$paypalaco="No";}else { $paypalaco="Yes";
}	

	
$msgs.='<tr>
<td><input type="checkbox" value='.$rows['id'].' class="selectmulti"></td>
<td>'.$rows['username'].'</td>
<td>'.$rows['email'].'</td>
<td>'.$rows['name'].'</td>
<td>'.$rows['group_name'].'</td>
<td>$'.$rows['balance'].'</td>
<td><span class="label label-success">'.$activestatus.'<br>'.$reason.'</span></td>
<td>'.$verified.'</td>
<td>'.$pco.'</td>
<td>'.$paco.'</td>
<td>'.$paypalaco.'</td>
<td>'.date("d-m-Y",strtotime($rows['date'])).'</td>
<td>'.$rows['ipaddress'].'</td>
<td class="optionleft">
<span class="edit option"  id="'.$rows['id'].'" username="'.$rows['username'].'" email="'.$rows['email'].'" name="'.$rows['name'].'"  skype="'.$rows['skype'].'"  group="'.$rows['groups'].'" activate="'.$rows['status'].'" pcheckout="'.$rows['2co'].'" chauto="'.$rows['2choauto'].'" payauto="'.$rows['payauto'].'">Edit</span>
<span class="changepass option" id="'.$rows['id'].'">Change Passsword</span><br>
<span class="addbalance option" id="'.$rows['email'].'">Add Balance</span>
<span class="delete option" id="'.$rows['email'].'">Delete</span></td></tr>';
}
$msgs.='</tbody></table>';
$msgs.=$r[1];
$msgs.='<div class="statustable"><input type="button" class="sactivate btn" value="Activate"><input type="button" class="sdeactivate btn" value="Deactivate"><input type="button" class="sdelete btn" value="Delete"><input type="button" class="deselectall btn" value="Deselect All"><input type="button" class="mybutton selectall btn" value="Select All"><input type="button" class="mybutton resendemailverify btn" value="Resend Verify Email"></div>';
}else{
$msgs.="<p class='text-center message'>".$r."</p>";	
}
echo $msgs; 
}
elseif($_POST['process']=="changestatus"){
$r=$admin->changestatus($_POST['ids'],$_POST['status']);
echo  $r;
}
elseif($_POST['process']=="multiuserdelete"){
$r=$admin->multiuserdelete($_POST['ids']);
echo $r;
}
elseif($_POST['process']=="deleteuser"){
$r=$admin->deleteuser($_POST['username']);
echo $r;
}
elseif($_POST['process']=="makebalance"){
echo $r=$admin->addbalance($_POST['username'],(float)$_POST['amt'],$_POST['operation'],$_POST['reason']);
}
elseif($_POST['process']=="changepassword"){
echo $r=$admin->changepassword($_POST['unpass'],(int)$_POST['upid']);	
}
elseif($_POST['process']=="editprofile"){
echo $r=$admin->profileupdate($_POST['uid'],$_POST['username'],$_POST['email'],$_POST['name'],$_POST['skype'],$_POST['group'],$_POST['status'],$_POST['pcheckout'],$_POST['checkoutauto'],$_POST['paypalauto']);
} 
elseif($_POST['process']=="createuser"){
echo $r=$admin->createuser($_POST['email'],$_POST['password'],$_POST['name'],$_POST['skype'],$_POST['group'],$_POST['status'],$_POST['pcheckout'],$_POST['checkoutauto'],$_POST['paypalauto']);
} 
elseif($_POST['process']=="resendemailverification"){
$r=$admin->resendemailverification($_POST['ids']);
}


?>
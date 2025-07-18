<?php require_once("../class/profit.class.php");
$admin=new profit();
if($_POST['process']=="getrecords"){
$msgs="";	
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Total amount of Sale</th>
<th>Total amount of Buy</th>
<th>Total amount of Profit</th>
</tr>
</thead>   
<tbody>';
$tosale=0;
$tobuy=0;
$toprofit=0;		
foreach($res[2] as $rows1){
$tosale +=$rows1['price'];
$tobuy +=$rows1['oprice'];
$toprofit +=number_format((float)($rows1['price']-$rows1['oprice']), 2, '.', '');
}	
$msgs.='<tr>
<td>$'.number_format((float)$tosale, 2, '.', '').'</td> 
<td>$'.number_format((float)$tobuy, 2, '.', '').'</td>
<td class="center">$'.number_format((float)$toprofit, 2, '.', '').'</td>
</tr>';
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Sl.No</th>
<th>UserName</th>
<th>Order No</th>
<th>Service</th>
<th>Url</th>
<th>Sell Price</th>
<th>Buy Price</th>
<th>Profit</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>   
<tbody>';
$i=1;
foreach($res[0] as $rows){ 
$msgs.='<tr>
<td>'.$i.'</td>
<td>'.$rows['username'].'</td>
<td>'.$rows['id'].'</td>
<td>'.$rows['count']." ".$rows['display'].'</td>
<td>'.$rows['url'].'</td>
<td>$'.$rows['price'].'</td>
<td>$'.$rows['oprice'].'</td>
<td>$'.number_format((float)($rows['price']-$rows['oprice']), 2, '.', '').'</td>
<td>'.$rows['status'].'</td>
<td>'.date("d-m-Y h:i:s a",strtotime($rows['date'])).'</td>
</tr>';
$i++;
}
$msgs.='</tbody></table>';	
$msgs.=$res[1];	
}else{
$msgs.="<p class='text-center message'>".$res."</p>";	
}
echo $msgs;
}
?>
<?php require_once("../class/trackorder.class.php");
if(isset($_POST['email']) && $_POST['orderno']!="" && $_POST['csrfToken']==$_SESSION['trackorderid']){
$smmeobj=new smmetrackorder();
$res=$smmeobj->orderdetails($_POST['orderno'],$_POST['email']);	
echo $res;
}
?>
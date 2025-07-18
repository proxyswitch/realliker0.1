<?php require_once("../class/registeration.class.php");
if(isset($_POST['email']) && $_POST['csrfToken']==$_SESSION['siteregid']){
$smmeobj=new smmeregister();
$res=$smmeobj->smmeuserreg($_POST['email'],$_POST['name'],$_POST['skype'],$_POST['password']);	
echo $res;
}
?>
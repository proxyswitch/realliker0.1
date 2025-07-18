<?php require_once("../class/resetpassword.class.php");
if(isset($_POST['email']) && $_POST['csrfToken']==$_SESSION['siteforgetid']){
$smmeobj=new smmeresetpassword();
echo $res=$smmeobj->smmeusergetpassword($_POST['email']);	
}
?>
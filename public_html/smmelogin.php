<?php ob_start(); require_once("class/userlogin.class.php");
if(isset($_POST['uname']) && $_POST['csrfToken']==$_SESSION['sitelogid']){
$smmeobj=new smmelogin();
$res=$smmeobj->userlogin($_POST['uname'],$_POST['password']);
echo $res;
}else{
header("location:index.php?msg=failed");
}
?>
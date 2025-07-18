<?php require_once("../class/userprofile.class.php");
if(isset($_POST['currentpassword']) && isset($_POST['password']) && $_POST['csrfToken']==$_SESSION['csrfTOken']){
$smmeobj=new profile();
$res=$smmeobj->changepassword($_POST['currentpassword'],$_POST['password']);
echo $res;
}
?>
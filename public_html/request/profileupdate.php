<?php require_once("../class/userprofile.class.php");
if(isset($_POST['name']) && $_POST['csrfToken']==$_SESSION['csrfTOken']){
$smmeobj=new profile();
$res=$smmeobj->profileupdate($_POST['name'],$_POST['skype']);
echo $res;
}
?>
<?php ini_set('session.cookie_httponly', true);
ob_start();
if(isset($_POST['login']) && $_SERVER['REMOTE_ADDR']!="")
{
require_once("class/login.class.php");
$obj=new login();
$obj->adminlogin($_POST['username'],$_POST['password'],$_POST['pin']);
}else {
header("location:index.php?act=failed");
}
ob_end_flush();
?>
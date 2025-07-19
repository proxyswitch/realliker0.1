<?php ob_start(); require("class/common.class.php");
if(!isset($_SESSION['smmmebhaveshadmin']) && $_SESSION['smmmebhaveshadmin']==""){
header("location:index.php");	
}
$adminobj=new common();
$status=$adminobj->status();
$group=$adminobj->usergroup();
$orderstatus=$adminobj->orderstatus();
$autoorderstatus=$adminobj->autoorderstatus();
$userlist=$adminobj->allusers();
$servicelist=$adminobj->getservicedisplay();
$getserviceprovider=$adminobj->serviceproviderlist();
$apikeylist=$adminobj->activeapikeys();

$usersupalert=$adminobj->checkreplyalert();


?>
<html>
<head>
<title>smme - Admin</title>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$(".date").datepicker();
});
</script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet"  href="css/jquery-ui.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="holepanel">
<div class="header">
<div class="container">
<ul class="nav navbar-link topmenu">
<li class="pull-left"><a href="smme-dashboard.php">Home</a></li>
<li class="pull-left"><a href="smme-users.php">Manage Users</a></li>
<li class="pull-left"><a href="#" class="btn dropdown-toggle" data-toggle="dropdown" >Manage Orders  <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
<li class=""><a href="smme-orders.php">Manage User Orders</a></li>
<li class=""><a href="smme-autoorders.php">Manage User Auto Orders</a></li>
</ul>
</li>



<li class="pull-left"><a href="#" class="btn dropdown-toggle" data-toggle="dropdown" >Manage Payment Transaction  <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
<li class=""><a href="smme-user-transaction.php">User Transaction</a></li>
<li class=""><a href="smme-admin-transaction.php">Admin Transaction</a>
<li class=""><a href="smme-service-profit.php">Service Profit</a>
<li class=""><a href="smme-service-statistics.php">Service Statistics</a>
</ul>
</li>
<li class="pull-left"><a href="smme-tickets.php">Manage Tickets <br> <?php if($usersupalert>0){?><img src="../img/icon_new.gif" align="right"> <?php } ?></a></li>
<li class="pull-left"><a href="smme-groups.php">Manage Groups</a></li>
<li class="pull-left"><a href="smme-services.php" class="btn dropdown-toggle" data-toggle="dropdown" >Manage Social Services <span class="caret"></span></a>
<ul  class="dropdown-menu" role="menu" aria-labelledby="dLabel">
<li class=""><a href="smme-serviceprovider.php">Manage Social Provider</a></li>
<li class=""><a href="smme-fixedservice.php">Manage Fixed Service by Provider</a></li>
<li class=""><a href="smme-admin-service.php">Manage Services</a>
</ul></li>
<li class="pull-left"><a href="smme-histroy.php" class="btn dropdown-toggle" data-toggle="dropdown" >Manage Histroy <span class="caret"></span></a>
<ul  class="dropdown-menu" role="menu" aria-labelledby="dLabel">
<li class=""><a href="smme-users-login-success.php">Success Histroy</a></li>
<li class=""><a href="smme-users-login-failed.php">Failed Histroy</a></li>
<li class=""><a href="smme-banned-ips.php">Banned Ip List</a></li>
</ul>
</li>
<li class="pull-left"><a href="#" class="btn dropdown-toggle" data-toggle="dropdown" >Manage Setting <span class="caret"></span></a>
<ul  class="dropdown-menu" role="menu" aria-labelledby="dLabel">
<li class=""><a href="smme-users-pages.php">Page setting</a></li>
<li class=""><a href="smme-users-notification.php">User Notification</a></li>
<li class=""><a href="smme-admin-profile.php">Profile</a></li>
<li class=""><a href="smme-users-api.php">Users Api</a></li>
<li class=""><a href="smme-admin-setting.php">Site Setting</a></li>
<li class=""><a href="manage-payment-methods.php">Payment Methods</a></li>
<li class=""><a href="smme-api-fetcher.php">Api Fetcher</a></li>
<li class=""><a href="smme-logout.php">Logout</a>
</ul>
</li>
</ul>
</div>
</div>
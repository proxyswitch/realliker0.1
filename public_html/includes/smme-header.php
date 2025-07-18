<?php ob_start(); require_once("class/userprofile.class.php");
if(!isset($_SESSION['smmebhaveshsitelike']) || $_SESSION['smmebhaveshsitelike']==""){
header("location:index.php");	
}
$profileobj=new profile();
if(isset($_POST['acceptdis']) && $_POST['acceptdis']=="accept" && $_POST['csfr']==$_SESSION['accepdiscsfr']){
$profileobj->accpetdisclaimer();	
}
$userprofile=$profileobj->profiledetails($_SESSION['smmebhaveshsitelike']);
if($userprofile['verified']==0){
header("location:smme-account-activate.php");
}
if($userprofile['disclaimer']==0){
header("location:smme-accept-disclaimer.php");	
}
$topalert=$profileobj->sitecontent("topalert");
$admin=$profileobj->adminconfig();

$usersalert=$profileobj->checkreplyalert();


?>
<html>
<head>
<meta name="pragma" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SmmeXchange - Panel</title>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/sitecommon.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet"  href="css/jquery-ui.css">
<link rel="stylesheet" href="css/smmestyle.css">
</head>
<body>
<div class="holepanel">
<div class="clearfix"></div>
<div class="container">
<div class="pull-left col-lg-4">
<marquee direction="left" class="padding5"><?=$topalert;?></marquee>
</div>
<div class="pull-right walletmenu col-lg-8">
<ul class="nav">
<li class="pull-right"><a href="smme-logout.php">Logout</a></li>
<li class="pull-right"><a href="smme-api.php">Api</a></li>
<li class="pull-right"><a href="smme-profile.php">Profile</a></li>
<li class="pull-right"><a href="smme-addwallet.php">Add Balance</a></li>
<li class="pull-right"><a href="smme-tickets.php">Support <br> <?php if($usersalert>0){?><img align="right" src="img/icon_new.gif"><?php }?></a></li>
<li class="pull-right"><a href="smme-price-list.php">Price List</a></li>
<li class="pull-right"><a href="smme-faq.php">Faq</a></li>
<li class="pull-right roundcircle notifi"><a href="#" class="round">0</a>
<img src="img/icon_new.gif" class="newnoti">
<div class="useralertnoti">
<div class="useralerttitle text-center">Notification</div>
<div class="useralertcontent"><ul class="nav usernotilist">
<li>Please Wait</li>
</ul></div>
</div>
</li>
<li class="pull-right"><a href="#">Balance: <span class="bal">$<?=$userprofile['balance'];?></span></a></li>
</ul>
</div>
</div>
<div class="header">
<div class="container">
<ul class="nav navbar-link topmenu">
<li class="pull-left"><a href="smme-dashboard.php">Home</a></li>
<li class="pull-left"><a href="smme-facebook.php">Facebook</a></li>
<li class="pull-left"><a href="smme-twitter.php">Twitter</a></li>
<li class="pull-left"><a href="smme-instagaram.php">Instagram</a></li>
<li class="pull-left"><a href="smme-threads.php">Theards</a></li>
<li class="pull-left"><a href="smme-youtube.php">Youtube</a></li>
<li class="pull-left"><a href="smme-tiktok.php">Tik Tok</a></li>
<li class="pull-left"><a href="smme-orders.php">Orders</a></li>
<li class="pull-left"><a href="smme-autoorders.php">Auto Orders</a></li>
<li class="pull-left"><a href="smme-transaction.php">Transaction</a></li>

</ul>
</div>
</div>
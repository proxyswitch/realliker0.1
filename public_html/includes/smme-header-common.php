<html>
<head>
<meta name="pragma" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>SmmeXchange</title>
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
<div class="pull-left col-lg-8">
<marquee direction="left" class="padding5"><?=$topalert;?></marquee>
</div>
<div class="pull-right walletmenu col-lg-4">
<ul class="nav">
<li class="pull-right"><a href="smme-logout.php">Logout</a></li>
<li class="pull-right roundcircle notifi"><a href="#" class="round">0</a>
<img src="img/icon_new.gif" class="newnoti">
<div class="useralert">
<div class="useralerttitle text-center">Notification</div>
<div class="useralertcontent"><ul class="nav usernotilist">
<li>Please Wait</li>
</ul></div>
</div>
</li>
<li class="pull-right"><a href="#">Wallet Balance: <span class="bal">$<?=$userprofile['balance'];?></span></a></li>
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
<li class="pull-left"><a href="smme-threads.php">Threads</a></li>
<li class="pull-left"><a href="smme-youtube.php">Youtube</a></li>
<li class="pull-left"><a href="smme-tiktok.php">Tik Tok</a></li>
<li class="pull-left"><a href="smme-orders.php">Orders</a></li>
<li class="pull-left"><a href="smme-transaction.php">Transaction</a></li>


</ul>
</div>
</div>
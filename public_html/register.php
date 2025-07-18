<?php session_start();
if(!isset($_SESSION['siteregid'])){
$_SESSION['siteregid']=base64_encode( openssl_random_pseudo_bytes(32));
}
if(isset($_SESSION['smmebhaveshsitelike']) && $_SESSION['smmebhaveshsitelike']!=""){
header("location:smme-dashboard.php");	
}
?>
<html>
<head>
<title>SmmeXchange - Register</title>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet"  href="css/jquery-ui.css">
<link rel="stylesheet" href="css/smmestyle.css">
</head>
<body>
<div class="holepanel">
<div class="header">
<div class="container">
<ul class="nav pull-right normalmenu"><li class="pull-left"><a href="index">Login</a></li><li class="pull-left"><a href="#" class="active">Register</a></li><li class="pull-left"><li class="pull-left"><a href="aboutus">About Us</a></li><li class="pull-left"><a href="privacypolicy">Privacy Policy</a></li><li class="pull-left"><a href="terms">Terms Of Service</a></li><li class="pull-left"><a href="contact-us">Contact Us</a></li></ul>
</div>
</div>
 
<div class="container content">
<div class="row">
<center>NEW USERS REGISTRATIONS CLOSED !!<br> YOU CAN CONTACT US IF YOU NEED ACCOUNT . <br>

Email: Support@smmexchange.com
<br>
Skype: Smmexchange </center>

</div>
</div>
<div class="row">
<div class="regalert useralert text-center"></div>
</div>
</div>
<div class="footer"><div class="container"><div class="text-center">&copy; 2015 smmexchange.com</div></div></div>
</div>
</div>
</body>
</html>
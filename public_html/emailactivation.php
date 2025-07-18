<?php ob_start(); require_once("class/accountverification.class.php");
$_SESSION['emailvid']=rand(2,55);
?>
<html>
<head>
<title>smme - Verification</title>
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
<ul class="nav pull-right normalmenu"><li class="pull-left"><a href="index">Login</a></li><li class="pull-left"><a href="register" class="active">Register</a></li><li class="pull-left"><a href="aboutus">About Us</a></li><li class="pull-left"><a href="privacypolicy">Privacy Policy</a></li><li class="pull-left"><a href="contact-us">Contact Us</a></li></ul>
</div>
</div>

<div class="container content">
<div class="row">
<?php if(isset($_GET['email']) && $_GET['email']!="" && isset($_GET['emailtoken']) && $_GET['emailtoken']!="")
{
$verify=new accountverification();
$res=$verify->verifyemail($_GET['email'],$_GET['emailtoken']);
if($res==0){?>
<div class="text-center">Your Account Verified Successfully.</div>
<?php
if(isset($_SESSION['smmebhaveshsitelike']) && $_SESSION['smmebhaveshsitelike']!=""){
header("location:smme-accept-disclaimer.php");	
}
} if($res==1){?>
<div class="text-center">Your Account Already Verified.</div>
<?php }
 if($res==2){?>
<div class="text-center">Issue On Verification Please Contact Our Support Team.</div>
<?php }
}else{?>
<div class="text-center">Dont Make Fool Us.</div>
<?php } ?>
</div>
</div>
<div class="footer"><div class="container"><div class="text-center">&copy; 2015 smmexchange.com</div></div></div>
</div>
</div>
</body>
</html>
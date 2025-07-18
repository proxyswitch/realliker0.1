<?php session_start();
if(isset($_SESSION['smmebhaveshsitelike']) && $_SESSION['smmebhaveshsitelike']!=""){
header("location:smme-dashboard.php");	
}
if(!isset($_SESSION['siteforgetid'])){
$_SESSION['siteforgetid']=base64_encode( openssl_random_pseudo_bytes(32));
}
?>
<html>
<head>
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
<ul class="nav pull-right normalmenu"><li class="pull-left"><a href="index">Login</a></li><li class="pull-left"><a href="register">Register</a></li><li class="pull-left"><a href="aboutus">About Us</a></li><li class="pull-left"><a href="privacypolicy">Privacy Policy</a></li><li class="pull-left"><a href="contact-us">Contact Us</a></li></ul>
</div>
</div>

<div class="container content">
<div class="row">
<div class="col-md-4 col-md-offset-4 loginformpanel">
<h5 class="text-center title">Reset Password Form</h5>
<form name="forgetpass" action="" method="post" class="forgetpass">
<div class="form-group">
<label>Email</label>
<input type="text" name="email" value="" class="form-control required" autocomplete="off">
<input type='hidden' name='csrfToken' value='<?=$_SESSION['siteforgetid'];?>' />
</div>
<input type="submit" name="forgetpasssub" value="Submit" class="btn">
</form>
</div>
</div>
<div class="row">
<div class="fogalert useralert text-center"></div>
</div>
</div>
</div>
<div class="footer"><div class="container"><div class="text-center">&copy; 2015 smmeexchange.com</div></div></div>
</div>
</div>
</body>
</html>
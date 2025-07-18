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
<center>Please Fill Correct Details <br> New Users Your Email Will Be Your Username !!</center>
<div class="col-md-4 col-md-offset-4 loginformpanel">
<h5 class="text-center title">Registeration Form</h5>
<form name="register" action="" method="post" class="register">
<div class="form-group">
<label>Email</label>
<input type="text" name="email" value="" class="form-control required email" autocomplete="off">
</div>
<div class="form-group">
<label>Full Name</label>
<input type="text" name="name" value="" class="form-control required" autocomplete="off" maxlength="15">
</div>
<div class="form-group">
<label>Skype</label>
<input type="text" name="skype" value="" class="form-control" autocomplete="off" maxlength="20">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" value="" class="form-control required" id="password" autocomplete="off" minlength="5" maxlength="12">
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="cpassword" value="" equalto="#password" id="cpassword" class="form-control required" autocomplete="off" minlength="5" maxlength="12">
</div>
<input type='hidden' name='csrfToken' value='<?=$_SESSION['siteregid'];?>' />
<input type="submit" name="regsub" value="Register" class="btn">
<input type="reset" name="clear" value="Clear" class="btn">
<a href="index">Login to our site? Click here</a>
</form>
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
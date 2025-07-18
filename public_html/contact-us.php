<?php session_start();
$_SESSION['contactusid']=rand(2,22);
?>
<html>
<head>
<title>SmmeXchange - Contact Us</title>
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
<ul class="nav pull-right normalmenu"><li class="pull-left"><a href="index">Login</a></li><li class="pull-left"><a href="register">Register</a></li><li class="pull-left"><a href="order-track">Track Order</a></li><li class="pull-left"><a href="aboutus">About Us</a></li><li class="pull-left"><a href="privacypolicy">Privacy Policy</a></li><li class="pull-left"><a href="terms">Terms Of Service</a></li><li class="pull-left"><a href="#" class="active">Contact Us</a></li></ul>
</div>
</div>

<div class="container content">
<div class="normalcontent">
<h4 class="title text-center">Contact us</h4>
<div class="cont">
<div class="row">
<div class="col-md-4">
<h5 class="text-center title">Fill the form to contact us.</h5>
<form name="contactus" action="" method="post" class="contactus">
<div class="form-group">
<label>Email</label>
<input type="text" name="email" value="" class="form-control required email" autocomplete="off">
</div>
<div class="form-group">
<label>Name</label>
<input type="text" name="name" value="" class="form-control required" autocomplete="off">
</div>
<div class="form-group">
<label>Message</label>
<textarea name="message" class="required form-control" autocomplete="off"></textarea></div>
<input type="hidden" name="csrf" value="<?=$_SESSION['contactusid'];?>" />
<input type="submit" name="regsub" value="Submit" class="btn">
<input type="reset" name="clear" value="Clear" class="btn">
</form>
<div class="alert text-center"></div>
</div>
<div class="col-md-8">
<h5 class="text-center title">Also u can contact us via:</h5>
<p>Email: Support@smmexchange.com</p>
<p>Skype: Smmexchange</p>
</div>
</div>
</div>
</div>
</div>
<div class="footer"><div class="container"><div class="text-center">&copy; 2015 smmexchange.com</div></div></div>
</div>
</div>
</body>
</html>
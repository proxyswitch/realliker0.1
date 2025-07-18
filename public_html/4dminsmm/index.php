<?php session_start();
if(isset($_SESSION['smmmebhaveshadmin']) && $_SESSION['smmmebhaveshadmin']!=""){
header("location:dashboard.php");	
}
$_SESSION['logincsrf']=rand();
?>
<html>
<head>
<title>smme - Admin</title>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet"  href="css/jquery-ui.css">
<link rel="stylesheet" href="css/style.css">
<script>
$(document).ready(function(){
$(".login").validate();	
});
</script>
</head>
<body>
<div class="holepanel">
<div class="header">
<div class="container">
<h5 class="text-center">Admin Panel</h5>
</div>
</div>
<div class="content container">
<div class="col-lg-4 col-xs-offset-4">
<form name="login" class="login" action="adminlogin.php" method="post">
<div class="form-group">
<label>UserName</label>
<input type="text" name="username" value="" class="form-control required" minlenght="5" autocomplete="off">
<input type="hidden" name="csrf" value="<?=$_SESSION['logincsrf'];?>">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" value="" class="form-control required" minlenght="5" autocomplete="off">
</div>
<div class="form-group">
<label>Pin</label>
<input type="password" name="pin" value="" class="form-control required" autocomplete="off">
</div>
<div class="text-center">
<input type="submit" name="login" value="login" class="btn">
<input type="reset" name="clear" value="clear" class="btn">
</div>
</form>
</div>
</div>
<div class="footer"><div class="container"><div class="text-center">&copy; 2015 smmexchange.com</div></div></div>
</div>
</div>
</body>
</html>
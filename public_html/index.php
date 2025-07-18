<?php session_start();
if(isset($_SESSION['smmebhaveshsitelike']) && $_SESSION['smmebhaveshsitelike']!=""){
header("location:smme-dashboard.php");	
}
if(!isset($_SESSION['sitelogid'])){
$_SESSION['sitelogid']=base64_encode( openssl_random_pseudo_bytes(32));
}
?>
<html>
<head>
<title>SmmExchange - Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Social Media Market, Realiable SMM Reseller Panel, Smm Marketing">		
    <meta name="keywords" content="Buy Instagram Followers,Facebook Likes, Facebook Page Likes, Facebook Video Views, Instagram Followers, Instagram Views, Instagram Likes, Instagram Live ,Twitter Retweets, Twitter Followers, Twitter Likes, ,Youtube Likes, Youtube Video Views, Youtube Dislikes, Youtube Views , Musical.ly Likes, Musical.ly Followers, Musical.ly Hearts, Quality ,Cheap ,Instant ,Fast ,Snapchat ,Comments ,Arab, Indian, brazil ">
    <meta name="google-site-verification" content="xxrTo9iFy2hKCYYBbk7f7k9PySXDQ79yBaqbN1P5Gy4" />
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
<ul class="nav pull-right normalmenu"><li class="pull-left"><a href="#" class="active">Login</a></li><li class="pull-left"><a href="register">Register</a></li><li class="pull-left"><a href="aboutus">About Us</a></li><li class="pull-left"><a href="privacypolicy">Privacy Policy</a></li><li class="pull-left"><a href="terms">Terms Of Service</a></li><li class="pull-left"><a href="contact-us">Contact Us</a></li></ul>
</div>
</div>
<div class="container content">
<div class="row">
<div class="col-md-4 loginformpanel">
<h5 class="text-center title">Login Details</h5>
<form name="login" action="smmelogin.php" method="post" class="login">
<div class="form-group">
<label>Email</label>
<input type="text" name="uname" value="" class="form-control required" autocomplete="off">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" value="" class="form-control required" autocomplete="off" minlength="5" maxlength="30">
</div>
<input type='hidden' name='csrfToken' value='<?=$_SESSION['sitelogid'];?>' />
<input type="submit" name="loginsub" value="Login" class="btn">
<input type="reset" name="clear" value="Clear" class="btn">
<a href="forgetpassword.php">Forget Password? Click here</a>
</form>
<div class="row">
<div class="logalert useralert text-center alert">
<?php if(isset($_GET['msg'])&& $_GET['msg']=="failed"){
echo "Check your login details.";}?></br>
<?php
if(isset($_GET['msg'])&& $_GET['attempts']!=""){
$limit=3;
$remain=$limit-(int)$_GET['attempts'];	
?>Your have remaining attempt <?=$remain;}
if(isset($remain)&& $remain==0){
echo "</br>Your account temporary disabled!<br>Contact support team!";	
}?>
</div>
</div>
<h4>For Support</h4>
<h5>Skype: Smmexchange <img src="img/skype.png"><br>
E-mail: Support@smmexchange.com <img src="img/email.png"></h5>
</div>
<div class="col-md-7 indexcontent pull-right">
<h3><u>Welcome to <span style="color:#FF0000">SmmExchange</span></u></h3>
<b><p style="color:#9f9f9f">We are a marketing company that promotes <span style="color:white">YouTube, Instagram, Facebook, Twitter, SoundCloud, Snapchat, Periscope, Pintrest </span> and <span style="color:white">Vine</span> with even <span style="color:white">more Networks</span> added each month.</p>

<p style="color:#9f9f9f"><span style="color:white">The most trusted company in this type of business,</span> join us today and become famous tomorrow, <span style="color:white">get real, high-quality Twitter, Pinterest, followers, likes, repins, favorites, retweets, revines, and comments. Real, cheap and instant Vimeo and Youtube views, likes, comments and subscribers. SoundCloud plays and many more.</span></p>
<p style="color:#9f9f9f">
We have become a growing and trusted provider and with an excellent, friendly and prompt customer support, we have also proven to be the most leading, reliable and cheapest provider on the Internet for the last four years. <span style="color:white">Once registered you'll have access to our User-friendly Tracking Panel where you'll be able to track your orders online without any fuss.</span></p></b>

<div class="stepsSection">
        <div class="text-center col-md-4">
            <img src="img/icon1.png" alt=" Twitter" />
            <p class="stepP">STEP ONE<p>
            <p class="stepT">CREATE ACCOUNT &amp; LOGIN</p>
        </div>
        <div class="text-center col-md-4">
             <img src="img/icon2.png" alt=" Instagram" />
            <p class="stepP">STEP TWO<p>
            <p class="stepT">PURCHASE ANY SERVICES</p>
        </div> 
        <div class="text-center col-md-4">
             <img src="img/icon3.png" alt=" Youtube" />
            <p class="stepP">STEP THREE<p>
            <p class="stepT">TRACK &amp RECEIVE YOUR ORDER</p>
        </div> 
        </div>    
            

<h3><u>Features Of Our <span style="color:#FF0000">Services</u></span></h3>
<br><br>
01. Great Dashboard , Full Mobile Support.
<br><br>
02. Fast result.
<br><br>
03. Instant Start Of All Services.
<br><br>
04. <span style="color:#FF0000"><b>24/7</b></span> Support.
<br><br>
05. Only High-Quality And Great Result.
<br><br>
06. Affordable Prices
<br><br>
07. For Developers And People Who Care About Their Time We Have <span style="color:#FF0000"><b>API.</b></span>
<br><br>
</div>
</div>
</div>
<div class="footer"><div class="container"><div class="text-center">&copy; 2017 smmexchange.com</div></div></div>
</div>
</div>
</body>
</html>
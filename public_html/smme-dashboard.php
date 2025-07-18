<?php ob_start(); include("includes/smme-header.php");?>
<div class="container content">
<div class="table">
<h4 class="text-center">Welcome <?=$userprofile['name'];?></h4>
</div>
<div class="table">
<h4 class="text-center"><?=$topalert;?></h4>
</div>
<div class="col-md-12 col-md-offset-1">
<div class="shortbox col-md-3">
<h4 class="title text-center">Account Created</h4>
<div class="shortboxcontent text-center">@<?=$profileobj->userreview("cdate");?></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">Account Verified</h4>
<div class="shortboxcontent text-center"><?=$profileobj->userreview("accverified");?></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">Accept Disclaimer</h4>
<div class="shortboxcontent text-center"><?=$profileobj->userreview("accdisclimer");?></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">Current Wallet Balance</h4>
<div class="shortboxcontent text-center">$<?=$profileobj->userreview("balance");?></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">yesterday Placed orders</h4>
<div class="shortboxcontent text-center"><?=$profileobj->userreview("yesterdayorders");?></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">Today Placed orders</h4>
<div class="shortboxcontent text-center"><?=$profileobj->userreview("todayorders");?></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">Last logged</h4>
<div class="shortboxcontent text-center"><?=$profileobj->userreview("lastlogged");?></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">Action</h4>
<div class="shortboxcontent text-center"><a href="smme-addwallet">Click here to add wallet balance</a></div>
</div>
<div class="shortbox col-md-3">
<h4 class="title text-center">Action</h4>
<div class="shortboxcontent text-center"><a href="smme-profile">Click here to update profile</a></div>
</div>
</div>
</div>
<?php include("includes/smme-footer.php");
?>
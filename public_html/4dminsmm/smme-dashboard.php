<?php ob_start(); include("includes/smme-header.php");
include("class/dashboard.class.php");
$review=new dashboard();
?>
<div class="container content">
<h5 class="text-center title">Site Review</h5>
<div class="col-md-12 col-md-offset-1">
<div class="shortbox col-md-3">
<h5 class="title text-center">Total Users</h5>
<div class="shortboxcontent text-center"><?=$review->review("totalusers");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Total Disabled Users</h5>
<div class="shortboxcontent text-center"><?=$review->review("disabledusers");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Verified Users</h5>
<div class="shortboxcontent text-center"><?=$review->review("verifiedusers");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Banned Ips</h5>
<div class="shortboxcontent text-center"><?=$review->review("bannedips");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Yesterday logged Users</h5>
<div class="shortboxcontent text-center"><?=$review->review("yesterdaylogged");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Today logged Users</h5>
<div class="shortboxcontent text-center"><?=$review->review("todaylogged");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Failed Login Attempts</h5>
<div class="shortboxcontent text-center"><?=$review->review("failedattempts");?>/<?=$review->review("todayfailedattempts");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Wallet Balance from site</h5>
<div class="shortboxcontent text-center">$<?=$review->review("totalbalance");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Yesterday Placed Orders</h5>
<div class="shortboxcontent text-center"><?=$review->review("yesterdayorders");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Today placed Orders</h5>
<div class="shortboxcontent text-center"><?=$review->review("todayorders");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">New Users (Today)</h5>
<div class="shortboxcontent text-center"><?=$review->review("newusers");?></div>
</div>
<div class="shortbox col-md-3">
<h5 class="title text-center">Today Received Payment (paypal)</h5>
<div class="shortboxcontent text-center">$<?=$review->review("todaypaypal");?></div>
</div>
</div>
</div>
<?php include("includes/smme-footer.php");?>
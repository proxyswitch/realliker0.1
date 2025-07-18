<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
include("class/oldcommonsetting.class.php");
$commonobj=new common();
$service=$commonobj->getservicedetailsbyname("vine");
$sitecontent=$commonobj->sitecontent("vine");
$orderstatus=$commonobj->orderstatuslist();
$oldcommonobj=new oldcommon();
$oldorderstatus=$oldcommonobj->oldorderstatuslist();
?>
<script src="js/users-old-orders.js"></script>
<div class="container content">
<div class="row">
<p class="text-center">Manage Old Orders</p>
<div id="content"></div>
</div>
</div>
<?php include("includes/smme-footer.php");?>
<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$sitecontent=$commonobj->sitecontent("faq");
?>
<div class="container content">
<?=$sitecontent;?>
</div>
<?php include("includes/smme-footer.php");
?>
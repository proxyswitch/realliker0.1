<?php require_once("class/userprofile.class.php");
$profileobj=new profile();
$userprofile=$profileobj->profiledetails($_SESSION['smmebhaveshsitelike']);
if($userprofile['verified']==0){
header("location:smme-account-activate.php");
}
if($userprofile['disclaimer']==1){
header("location:smme-dashboard.php");
}
$topalert=$profileobj->sitecontent("topalert");
$admin=$profileobj->adminconfig();
include("includes/smme-header-common.php");
$_SESSION['accepdiscsfr']=rand(3,44);
?>
<div class="container content">
<div class="activationpanel">
<h3 class="text-center">Terms of Service Agreement:</h3>
<p>The use of services provided by Smmexchange.com establishes agreement to these terms. By registering or using our services you agree that you have read and fully understood the following
Terms of Service and Smmexchange.com will not be help liable for loss in any way for users who have not read the below terms of service.</p>

<p>1. General
By placing an order with Smmexchange.com you automatically accept all the below listed term of services weather you read them or not.
We reserve the right to change these terms of service without notice. You are expected to read all terms of service before placing every order to insure you are up to date with any changes or any future changes.
You will only use the Smmexchange.com website in a manner which follows all agreements made with All Social Media Platforms on their individual Terms of Service page.
Smmexchange.com rates are subject to change at any time without notice. The payment/refund policy stays in effect in the case of rate changes.
Disclaimer: Smmexchange.com will not be responsible for any damages you or your business may suffer.
Liabilities: Smmexchange.com is in no way liable for any account suspension or Anything else done by Instagram, Twitter Or Any Other social media website .</p>

<p>2. Service
Smmexchange.com will only be used to promote your social media account and help boost your "Appearance" only.
We DO NOT guarantee your new fans will interact with you, we simply guarantee you to get the services you pay for, guarantee 1 day.
You will not upload anything into the Smmexchange.com site including nudity or any material that is not accepted or suitable for the social media community.</p>

<p>3. Payment/Refund Policy
No refunds will be made. After a deposit has been completed, there is no way to reverse it. You must use your balance on orders from Smmexchange.com
You agree that once you complete a payment, you will not file a dispute or a chargeback against us for any reason.
If you file a dispute or chargeback against us after a deposit, we reserve the right to terminate all future orders, ban you from our site. We also reserve the right to take away any Service we delivered to your or your clients account.
Fraudulent activity such as using unauthorized or stolen credit cards will lead to termination of your account. There are no exceptions.</p>


<form name="acceptdisclaimer" action="smme-dashboard.php" class="discaimeraccept" method="post">
<div class="text-center">
<div class="checkbox">
<label>
<input type="checkbox" name="acceptdis" value="accept">Accept Disclaimer</label>
<input type="hidden" name="csfr" value="<?=$_SESSION['accepdiscsfr'];?>">
</div>
</div>
<div class="text-center">
<input type="submit" name="activate" value="Accept & Go" class="btn"></div>
</form>
<div class="row">
<div class="activealert alert"></div>
</div>
</div>
</div>
<?php include("includes/smme-footer.php");?>
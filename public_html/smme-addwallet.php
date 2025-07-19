<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$sitecontent=$commonobj->sitecontent("addbalance");
$paymentConfig = include(dirname(__FILE__)."/config/payment_methods.php");
?>
<div class="container content">
<div class="col-md-6 col-md-offset-3">
<div class="serviceform">
<h5 class="text-center title">Add Wallet Balance from Paypal <?php if($userprofile['2co']==1){?>or Payeer + Btc <?php }?></h5>
<form name="addbalance" class="addbalance" action="" method="post">

<div class="form-group">
<label>Payment Option</label>
<select name="payvia" class="form-control payvia required">
<option value="">Select</option>
<?php if(!empty($paymentConfig['paypal'])): ?>
<option value="paypal">Paypal</option>
<?php endif; ?>
<?php if($userprofile['2co']==1 && !empty($paymentConfig['2checkout'])): ?>
<option value="2checkout">Payeer + Btc</option>
<?php endif; ?>
<?php if(!empty($paymentConfig['payeer'])): ?>
<option value="payeer">Payeer</option>
<?php endif; ?>
<?php if(!empty($paymentConfig['paytm'])): ?>
<option value="paytm">Paytm</option>
<?php endif; ?>
</select>
</div>


<div class="form-group">
<label>Amount</label>
<input type="text" name="amount" id="amount" value="" class="required number form-control">
</div>
<input type='hidden' name='csrfToken' value='<?=$_SESSION['csrfTOken'];?>' />
<input type="hidden" name="minamt" id="minamt" value="<?=$admin['minimum_pay'];?>" disabled="disabled" />
<input type="hidden" name="minamt1" id="minamt1" value="<?=$admin['2minimum_pay'];?>" disabled="disabled" />
<input type="hidden" name="minamt2" id="minamt2" value="<?=$admin['2minimum_pay'];?>" disabled="disabled" />
<input type="hidden" name="minamt3" id="minamt3" value="<?=$admin['2minimum_pay'];?>" disabled="disabled" />
<div class="text-center"><input type="submit" name="addbalancebtn" value="Submit" class="btn btn-default">
<input type="reset" name="clear" value="Clear" class="btn btn-default"></div>
</form>
<div class="text-center margin10">Minimum Required Amount for paypal: $<?=$admin['minimum_pay'];?></div>
<div class="text-center"><?=$sitecontent;?></div>
<?php if($userprofile['2co']==1){?>
<div class="text-center margin10">Minimum Required Amount for Payeer + Btc: $<?=$admin['2minimum_pay'];?></div>

<div>&nbsp;&nbsp; If you have paid via 2checkout then please contact support to give transaction  &nbsp;&nbsp; number then only we can add amount in your account. </div>

<div><h2>Bonus:</h2>
<b></b>✮ 5% Bonus on Paypal Payments  Minimum Payment $50  <br>
✮ 13% Bonus on Paypal Payments  Minimum Payment $100 </b> </div>

<div><h2>PayPal:</h2>
<b></b>✮ Auto Upload Enabled - Instant Secure Payments<br>
✕ Deactivated For New Users<br>
✮ New Users MUST contact us on Skype <a href="skype:smmexchange?add" target="_blank">- Here -</a></b>
<div><h2>Other Payment Methods: </h2>
✮ Please Open a Ticket For Other Payment Methods <a href="http://www.smmexchange.com/smme-tickets.php" target="_blank">- Here -</a></div>
<br><br><br>
</div>


<?php } ?>

</div>
</div>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalprocess" class="paypalform" style="display:none;">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?=$admin['paypalemail'];?>">
<input type="hidden" name="item_name" value="Payment for user: <?=$_SESSION['smmebhaveshsitelike'];?>">
<input type='hidden' name='item_number' value='1'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='currency_code' value='USD'>
<input type='hidden' name='rm' value='2'>
<input type='hidden' name='notify_url' value='http://www.smmexchange.com/smme-notify.php'>
<input type='hidden' name='cancel_return' value='http://www.smmexchange.com/smme-cancel.php'>
<input type="hidden" name="return" value="http://www.smmexchange.com/smme-return.php">
<input class="amount"  type="text" name="amount" value="">
</form>
<?php if($userprofile['2co']==1){?>
<form action="https://www.realliker.com/2co/index.php" method="post" id="2coprocess" class="2coform" style="display:none;">
<input type="hidden" name="productname" value="<?=$userprofile['username'];?>">
<input class="amount"  type="text" name="amount" value="">
</form>
<?php } ?>
<form action="payeer/process.php" method="post" id="payeerprocess" class="payeerform" style="display:none;">
<input class="amount" type="text" name="amount" value="">
</form>
<form action="paytm/process.php" method="post" id="paytmprocess" class="paytmform" style="display:none;">
<input class="amount" type="text" name="amount" value="">
</form>
</div>
<?php include("includes/smme-footer.php");?>
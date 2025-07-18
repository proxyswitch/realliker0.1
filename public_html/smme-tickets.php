<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$service=$commonobj->getservicedetailsbyname("tickets");
$sitecontent=$commonobj->sitecontent("tickets");
?>
<script src="js/usertickets.js"></script>
<div class="container content">
<?php 
if(isset($_GET['msg']) && $_GET['msg']=="ctsuccess" || isset($_GET['msg']) && $_GET['msg']=="tusuccess"){ ?>
<div class="text-center alert">We will review get back to u soon.</div>
<?php }
if(isset($_GET['msg']) && $_GET['msg']=="ctfailed"){ ?>
<div class="text-center alert">Issue on ticket creation.</div>
<?php  }
if(isset($_GET['ack']) && $_GET['ack']=="new"){ ?>
<div class="col-md-6 col-md-offset-3">
<div class="serviceform">
<h5 class="text-center title">New Ticket Form</h5>
<form name="createticket" action="" class="createticket" method="post">
<div class="form-group">
<label>Subject</label>
<input type="text" name="subject" class="form-control required" id="subject">
</div>
<div class="form-group">
<label>Message</label>
<textarea name="message" class="form-control required" id="message"></textarea>
<input type='hidden' name='csrfToken' value='<?=$_SESSION['csrfTOken'];?>' />
</div>
<div class="text-center">
<input type="submit" name="newticket" value="Create Ticket" class="btn">
<input type="reset" name="Clear" value="Clear" class="btn">
<a href="smme-tickets.php" class="btn">Back</a>
</div>
</form>
</div>
</div>

	
<?php } else if(isset($_GET['ticket']) && $_GET['ticket']!=""){?>
<div class="row">
<?php	
$ticket=(int)$_GET['ticket'];	
include("class/userticket.class.php");
$ticketobj=new tickets();
$ticketrecord=$ticketobj->viewticket($ticket);
foreach($ticketrecord as $ticketconversation){
if($ticketconversation['status']==0){
$reply=1;	
}else {
$reply=0;	
	}
if($ticketconversation['from']==0){
$from="<span class='white'>You</span>";	
}else {
$from="<span class='green'>Admin</span>";	
}	
echo "From: ".$from;
echo "<br>";
echo "<br>";
echo "Date: ".date("d-n-y h:i:s a",strtotime($ticketconversation['tcdate']));
echo "<br>";
echo "<br>";
echo "Message: ".$ticketconversation['content'];
echo "<br>";
echo "<br>";
}
if($reply==1){?>
<form name="replyticket" action="" class="replyticekt" method="post">
<input type="hidden" name="ticketno" value="<?=$ticket;?>">
<div class="form-group">
<label>Reply to admin</label>
<textarea name="replybox" class="form-control required" id="replybox"></textarea>
</div>
<input type='hidden' name='csrfToken' value='<?=$_SESSION['csrfTOken'];?>' />
<div class="text-center">
<input type="submit" name="updateticket" value="Reply to admin" class="btn">
<input type="reset" name="Clear" value="Clear" class="btn">
<a href="smme-tickets.php" class="btn">Back</a>
</div>
</form>
<?php }?></div><?php } else {?>

<a href="smme-tickets.php?ack=new" class="btn">New Ticket</a>
<div id="content"></div>
<?php } ?>
</div>
<?php include("includes/smme-footer.php");?>
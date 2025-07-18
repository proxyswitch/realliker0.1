<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/banned-ips.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Banned Ip Address</h5>
<div class="commonalert text-center"></div>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label>Ip Address</label>
<input type="text" name="ipaddress" id="ipaddress" value="" class="form-control required" />
</div>
<div class="text-center">
<input type="button" name="add" value="Ban Ip" class="btn banip"/>
<input type="button" name="refresh" value="Refresh" id="refresh" class="btn refresh" />
<input type="button" name="search" value="Search" id="search" class="btn search" />
</div>
</div>
</div>
<div id="content"></div>
</div>
<?php include("includes/smme-footer.php");?>
<?php ob_start();
include("includes/smme-header.php");
$orders = json_decode(file_get_contents("data/dripfeed_orders.json"), true);
if(!is_array($orders)) $orders = [];
?>
<div class="container content">
<h4 class="text-center">Drip-feed Orders</h4>
<table class="ordertable table">
<thead><tr><th>ID</th><th>Runs</th><th>Interval</th><th>Link</th><th>Status</th></tr></thead>
<tbody>
<?php foreach($orders as $o): ?>
<tr>
<td><?=htmlspecialchars($o['id'])?></td>
<td><?=htmlspecialchars($o['runs'])?></td>
<td><?=htmlspecialchars($o['interval'])?></td>
<td><?=htmlspecialchars($o['link'])?></td>
<td><?=htmlspecialchars($o['status'])?></td>
</tr>
<?php endforeach; ?>
<?php if(empty($orders)): ?>
<tr><td colspan="5" class="text-center">No drip-feed orders</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
<?php include("includes/smme-footer.php");

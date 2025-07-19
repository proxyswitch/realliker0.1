<?php ob_start();
include("includes/smme-header.php");
$panels = json_decode(file_get_contents("data/child_panels.json"), true);
if(!is_array($panels)) $panels = [];
?>
<div class="container content">
<h4 class="text-center">Child Panels</h4>
<table class="ordertable table">
<thead><tr><th>ID</th><th>Domain</th><th>Status</th><th>Renewal Date</th></tr></thead>
<tbody>
<?php foreach($panels as $p): ?>
<tr>
<td><?=htmlspecialchars($p['id'])?></td>
<td><?=htmlspecialchars($p['domain'])?></td>
<td><?=htmlspecialchars($p['status'])?></td>
<td><?=htmlspecialchars($p['renewal'])?></td>
</tr>
<?php endforeach; ?>
<?php if(empty($panels)): ?>
<tr><td colspan="4" class="text-center">No child panels</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
<?php include("includes/smme-footer.php");

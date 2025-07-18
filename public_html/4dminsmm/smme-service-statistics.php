<?php include("includes/smme-header.php");
require_once("class/statistics.class.php");
$obj=new statistics();
?>
<script type="text/javascript" src="js/TableBarChart.js"></script>
<link rel="stylesheet" href="css/TableBarChart.css"/>
<div class="container content">
<table id="source" style="display:none;">
<thead>
<tr>
<th></th>
<th>Overall Order Statistics (Completed)
Total Orders:<?=$obj->statisticsorder("");?></th>
</tr>
</thead>
<tbody>
<tr>
<th>Facebook</th>
<td><?=$obj->statisticsorder("Facebook");?></td>
</tr>
<tr>
<th>Twitter</th>
<td><?=$obj->statisticsorder("Twitter");?></td>
</tr>
<tr>
<th>Instagram</th>
<td><?=$obj->statisticsorder("Instagram");?></td>
</tr>
<tr>
<th>Vine</th>
<td><?=$obj->statisticsorder("Vine");?></td>
</tr>
<tr>
<th>Soundcloud</th>
<td><?=$obj->statisticsorder("Soundcloud");?></td>
</tr>
<tr>
<th>Youtube</th>
<td><?=$obj->statisticsorder("youtube");?></td>
</tr>
</tbody>
</table>
<!--   Income statistics          -->
<table id="oincomesta" style="display:none;">
<thead>
<tr>
<th></th>
<th>Overall Income Statistics (Completed)
Total Income: $<?=round($obj->statisticsincome(""));?></th>
</tr>
</thead>
<tbody>
<tr>
<th>Facebook</th>
<td><?=(int)$obj->statisticsincome("Facebook");?></td>
</tr>
<tr>
<th>Twitter</th>
<td><?=(int)$obj->statisticsincome("Twitter");?></td>
</tr>
<tr>
<th>Instagram</th>
<td><?=(int)$obj->statisticsincome("Instagram");?></td>
</tr>
<tr>
<th>Vine</th>
<td><?=(int)$obj->statisticsincome("Vine");?></td>
</tr>
<tr>
<th>Soundcloud</th>
<td><?=(int)$obj->statisticsincome("Soundcloud");?></td>
</tr>
<tr>
<th>Youtube</th>
<td><?=(int)$obj->statisticsincome("Youtube");?></td>
</tr>
</tbody>
</table>
<div class="row">
<h4 class="text-center title">Your Social Services Statistics</h4>
<div class="col-md-6">
<div id="target" class="chart1">
</div>
</div>
<div class="col-md-6">
<div id="target" class="chart2">
</div>
</div> 
</div>
</div>
<script type="text/javascript" src="js/statistics.js"></script>
<?php include("includes/smme-footer.php");?>
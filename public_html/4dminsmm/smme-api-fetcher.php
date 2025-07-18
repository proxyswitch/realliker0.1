<?php ob_start(); include("includes/smme-header.php"); ?>
<?php require_once("class/api_fetcher.class.php"); ?>
<div class="content container">
<h5 class="text-center title">API Fetcher</h5>
<?php
$result = '';
if (isset($_POST['url'])) {
    $fetcher = new api_fetcher();
    $method = isset($_POST['method']) ? $_POST['method'] : 'POST';
    $params = [];
    if (!empty($_POST['params'])) {
        parse_str($_POST['params'], $params);
    }
    $result = $fetcher->fetch($_POST['url'], $params, $method);
}
?>
<form method="post">
    <div class="form-group">
        <label>URL</label>
        <input type="text" name="url" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Params (query string format)</label>
        <input type="text" name="params" class="form-control" />
    </div>
    <div class="form-group">
        <label>Method</label>
        <select name="method" class="form-control">
            <option value="POST">POST</option>
            <option value="GET">GET</option>
        </select>
    </div>
    <div class="text-center">
        <input type="submit" value="Fetch" class="btn" />
    </div>
</form>
<?php if ($result !== '') { ?>
<div class="alert alert-info" style="margin-top:20px; white-space: pre-wrap;">
<?php echo htmlspecialchars($result); ?>
</div>
<?php } ?>
</div>
<?php include("includes/smme-footer.php"); ?>

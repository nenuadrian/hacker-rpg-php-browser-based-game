<?php echo View::forge('global/header'); ?>

<?php print_r($item); ?>

<form method="post">
<div class="row">
<div class="col-md-9">
	<select name="server" class="form-control">
	<?php foreach($servers as $server): ?>
	<option value="<?php echo $server['server_id']; ?>"><?php echo $server['ip']; ?> - <?php echo $server['hostname']; ?></option>
	<?php endforeach; ?>
	</select>
	</div>
	<div class="col-md-3">
	<button class="btn btn-default" type="submit">buy</button>
	</div>
	</div>
</form>

<?php echo View::forge('global/footer'); ?>
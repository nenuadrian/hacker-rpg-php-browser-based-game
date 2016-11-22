<?php echo View::forge('global/header'); ?>

<div class="container">
	<form method="post">

	<div class="text-center">			
	<select name="cpu" class="form-control">
		<?php foreach(Config::get('hardware')['cpu'] as $k => $item): ?>
			<option value="<?php echo $k; ?>"><?php echo $item['name']; ?> Priced: <?php echo $item['price']; ?></option>
		<?php endforeach; ?>
	</select>
	<select name="ram" class="form-control">
		<?php foreach(Config::get('hardware')['ram'] as $k => $item): ?>
			<option value="<?php echo $k; ?>"><?php echo $item['name']; ?> Priced: <?php echo $item['price']; ?></option>
		<?php endforeach; ?>
	</select>
	<select name="ssd" class="form-control">
	<?php foreach(Config::get('hardware')['ssd'] as $k => $item): ?>
			<option value="<?php echo $k; ?>"><?php echo $item['name']; ?> Priced: <?php echo $item['price']; ?></option>
		<?php endforeach; ?>
	</select>
	<button type="submit" class="btn btn-default" name="create" value="true">create</button>
	</div>
	</form>
</div>
<?php echo View::forge('global/footer'); ?>
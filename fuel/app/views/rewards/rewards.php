<?php echo View::forge('global/header'); ?>

<div class="container">
<?php foreach($rewards as $reward): ?>
	<a class="row" href="<?php echo Uri::create('rewards/reward/' . $reward['reward_id']); ?>">
		<div class="col-md-6">
			<?php echo $reward['title']; ?>
		</div>
		<div class="col-md-3">
			<?php echo $reward['created_at']; ?>
		</div>
		<div class="col-md-3">
			<?php echo $reward['claimed']; ?>
		</div>
	</a>
<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>

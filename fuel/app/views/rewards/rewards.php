<?php echo View::forge('global/header'); ?>

<div class="container">
<?php foreach($rewards as $reward): ?>
	<div>
		<a href="<?php echo Uri::create('rewards/reward/' . $reward['reward_id']); ?>">
				<h3><?php echo $reward['title']; ?></h3>
				<p><small>
					<?php echo $reward['created_at']; ?> - 	<?php echo $reward['claimed']; ?>
				</small></p>
		</a>
	</div>
<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>

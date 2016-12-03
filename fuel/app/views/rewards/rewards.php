<?php echo View::forge('global/header'); ?>

<div class="container">
	<?php if (!$rewards): ?>
		<div class="alert alert-info text-center">
			You have not earned any rewards yet. Get to it already!
		</div>
	<?php endif; ?>
<?php foreach($rewards as $reward): ?>
	<div class="well">
		<a href="<?php echo Uri::create('rewards/reward/' . $reward['reward_id']); ?>">
				<strong><?php echo $reward['claimed'] ? '' : '[NOT CLAIMED] ';?><?php echo $reward['title']; ?></strong><br/>
				<small>
					received <?php echo $reward['created_at']; ?>
				</small>
		</a>
	</div>
<?php endforeach; ?>
<div class="text-center">
	<?php echo str_replace(array('<div', '<span'), array('<ul', '<li'), html_entity_decode($pagination)); ?>
</div>
</div>
<?php echo View::forge('global/footer'); ?>

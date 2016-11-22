<?php echo View::forge('global/header'); ?>

<div class="container">
<?php foreach($rewards as $reward): ?>
	<a href="<?php echo Uri::create('rewards/reward/' . $reward['reward_id']); ?>">Reward <?php echo $reward['claimed']; ?></a>
<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>
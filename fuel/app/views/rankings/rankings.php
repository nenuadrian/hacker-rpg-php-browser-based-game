<?php echo View::forge('global/header'); ?>

<div class="container">
	<?php foreach($rankings as $rank): ?>
		<div class="row">
			<div class="col-xs-2 text-center">
				<?php echo number_format($rank['ranking']); ?>
			</div>
			<div class="col-xs-6">
				<a href="<?php echo Uri::create('hacker/access/' . $rank['username']); ?>"><?php echo $rank['username']; ?></a>
			</div>
			<div class="col-xs-4 text-center">
				<?php echo number_format($rank['ranking_points']); ?><span class="hidden-xs"> points</span>
			</div>
		</div>
	<?php endforeach; ?>
	<?php print_r($pagination); ?>
</div>

<?php echo View::forge('global/footer'); ?>

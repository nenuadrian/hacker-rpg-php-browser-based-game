<?php echo View::forge('global/header'); ?>

<div class="container">
	<?php foreach($rankings as $rank): ?>
		<div class="well">
		<div class="row">
			<div class="col-xs-2 text-center">
			<div style="    font-size: 40px;margin-bottom: -20px;"><?php echo number_format($rank['ranking']); ?></div>
			</div>
			<div class="col-xs-10">
				<p style="margin:0"><a href="<?php echo Uri::create('hacker/access/' . $rank['username']); ?>"><?php echo $rank['username']; ?></a></p>
				<small><?php echo number_format($rank['ranking_points']); ?> points</small>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="text-center">
		<?php echo str_replace(array('<div', '<span'), array('<ul', '<li'), html_entity_decode($pagination)); ?>
	</div>
</div>

<?php echo View::forge('global/footer'); ?>

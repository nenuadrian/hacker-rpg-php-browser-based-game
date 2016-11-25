<?php echo View::forge('global/header'); ?>

<div class="container">
	<?php foreach($rankings as $rank): ?>
		<div class="row">
			<div class="col-xs-2 text-center">
			<h3><?php echo number_format($rank['ranking']); ?></h3>
			</div>
			<div class="col-xs-10">
				<p style="margin:0"><a href="<?php echo Uri::create('hacker/access/' . $rank['username']); ?>"><?php echo $rank['username']; ?></a></p>
				<small><?php echo number_format($rank['ranking_points']); ?><span class="hidden-xs"> points</span></small>
			</div>
		</div>
	<?php endforeach; ?>
	<?php print_r($pagination); ?>
</div>

<?php echo View::forge('global/footer'); ?>

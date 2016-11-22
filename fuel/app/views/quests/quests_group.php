<?php echo View::forge('global/header'); ?>

<div style="padding:40px;">
	<div class="row">
	<?php foreach($quests as $q): ?>
		<div class="col-md-6">
		<div class="well well-dark">
		  	<h3 class="text-center"><?php echo $q['name']; ?></h3>

		  	<a href="<?php echo Uri::create('quests/play/' . $q['quest_id']);?>">play</a>
		<?php echo html_entity_decode($q['summary']); ?>
		  	</div>

		
		</div>
	<?php endforeach; ?>
	</div>
</div>
<?php echo View::forge('global/footer'); ?>
<?php use \Model\Hacker;

echo View::forge('global/header'); ?>

<div class="container">

	<div class="row">
	<div class="col-md-9">
	<?php print_R($availableQuests); ?>


	</div>
	<div class="col-md-3 text-center">
	<h3>LEVEL <?php echo Auth::get('level'); ?></h3><br/>
	<?php echo View::forge('components/progress-bar', array(
		'current' => Auth::get('experience') / (Hacker::experience(Auth::get('level') + 1) / 100),
		'type' => 'SemiCircle',
		'text' => Auth::get('experience') . ' / ' . Hacker::experience(Auth::get('level') + 1),
		'id' => 'exp_container'
		)); ?>

	<a href="<?php echo Uri::create('world'); ?>" class="btn">world</a>
	</div>
	</div>

	<div class="row">
	<div class="col-md-6">
	<?php foreach($tasks as $task): ?>
		<div class="text-center">
		<div style="display:inline-block; max-width:100px;margin-top:50px">
		<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task['remaining'], 'duration' => $task['task_duration'], 'hide_bottom_count' => true, 'id' => $task['task_id'])); ?>
		</div>
	</div>
	<?php endforeach; ?>
	</div>
	<div class="col-md-6">
		<h3 class="text-right">hackery quote</h3>
		<blockquote>
			<?php echo $quote['content']; ?>
			<?php if ($quote['author']): ?>
				<small><?php echo $quote['author']; ?></small>
			<?php endif; ?>
		</blockquote>
	</div>
	</div>

</div>

<?php echo View::forge('global/footer'); ?>
